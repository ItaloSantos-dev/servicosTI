<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employee;
use App\Models\Order;
use App\Models\OrderTypes;
use App\Models\User;
use App\useCases\admin\CreateOrderAdmin;
use App\useCases\admin\UpdateOrderAdmin;
use App\useCases\order\CancellationOrder;
use App\useCases\order\RegisterOrder;
use App\useCases\order\UpdateOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
    private RegisterOrder $registerOrder;

    private CreateOrderAdmin $createOrderAdmin;
    private UpdateOrder $updateOrder;
    private UpdateOrderAdmin $updateOrderAdmin;
    private CancellationOrder $cancellationOrder;

    public function __construct() {
        $this->registerOrder = new RegisterOrder();
        $this->updateOrder = new UpdateOrder();
        $this->updateOrderAdmin = new UpdateOrderAdmin();
        $this->cancellationOrder = new CancellationOrder();
        $this->createOrderAdmin = new CreateOrderAdmin();
    }
    /**
     * Display a listing of the resource.
     */
    public function indexOrdersOfAdmin(){
        $ordersCount=[
            'in_analysis' => Order::where('status', 'in_analysis')->count(),
            'scheduled' => Order::where('status', 'scheduled')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'canceled' => Order::where('status', 'canceled')->count(),
        ];
        $orders = Order::with('client.user', 'employees.user', 'TypeOrder')->orderBy('order_date', 'desc')->paginate(10);
        return view('user.admin.orders', compact('orders','ordersCount'));
    }


    public function indexOrdersOfClient(Request $request)
    {
        $user = $request->user()->load(['client']);
        $orders = $user->client->orders()->orderBy('order_date', 'desc')->with('TypeOrder')->paginate(10);
        return view('user.client.orders', compact('user', 'orders'));
    }

    public function showForAdmin($id){
        $order = Order::with('client.user', 'employees.user', 'TypeOrder')->find($id);
        return view('user.admin.order', compact('order'));
    }

    public function indexOrdersOfEmployee(Request $request){
        $employeeWithOrders = $request->user()->load('employee');
        $orders = $employeeWithOrders->employee->orders()->orderBy('order_date', 'asc')->with('TypeOrder')->paginate(10);
        return view('user.employee.orders', compact('orders'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function createOfClient()
    {
        $orderTypes = OrderTypes::all();
        return view('user.client.newOrder', compact('orderTypes'));
    }

    public function createOfAdmin()
    {
        $orderTypes = OrderTypes::all();
        $employees = Employee::with('user')->get();
        $clients = Client::with('user')->get();

        return view('user.admin.newOrder', compact('orderTypes', 'employees', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeOfClient(Request $request)
    {
        $password = $request->validate(['password'=>'required']);

        $credentials = $request->validate([
            'type_id'=>'required|numeric',
            'description'=>'required|string',
            'address'=>'required|string'
        ]);
        if(!$request->user()->checkPassword($password['password'])){
            return redirect()->back()->with('info', 'Senha incorreta');
        }

        $newOrder =  $this->registerOrder->execute($credentials);
        if(!$newOrder){
            return redirect()->back()->with('info', 'falha ao criar pedido');
        }
        return redirect()->route('client.orders');


    }

    public  function storeOfAdmin (Request $request)
    {
        $password = $request->validate(['password'=>'required']);

        $credentials = $request->validate([
            'client_id' =>'required|numeric',
            'type_id'=>'required|numeric',
            'scheduling_date' =>'nullable',
            'description'=>'required|string',
            'address'=>'required|string'
        ]);
        $employees = $request->validate(['employees'=>'nullable']);
        if(!$request->user()->checkPassword($password['password'])){
            return redirect()->back()->with('info', 'Senha incorreta');
        }
        $newOrder = $this->createOrderAdmin->execute($credentials, $employees);
        if(!$newOrder){
            return redirect()->back()->with('info', 'falha ao criar pedido');
        }
        if(!empty($employees)){
            $newOrder->employees()->attach($employees['employees']);
        }
        return redirect()->route('admin.orders');

    }


    /**
     * Display the specified resource.
     */
    public function showForEmployee(string $id)
    {
        $order = Order::with('client.user:id,name','typeOrder')->findOrFail($id);
        return view('user.employee.order', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editOfClient(string $id)
    {
        $order = Order::with('TypeOrder')->findOrFail($id);
        $orderTypes = OrderTypes::all();
        return view('user.client.updateOrder', compact('order', 'orderTypes'));
    }

    public function editOfAdmin(string $id){
        $order = Order::with('TypeOrder', 'employees.user', 'client.user')->findOrFail($id);
        $typeOrders = OrderTypes::all();
        $employees = Employee::with('user')->get();
        return view('user.admin.updateOrder', compact('order', 'typeOrders', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateOfClient(Request $request, string $id)
    {
        $password = $request->validate(['password'=>'required']);

        if(!$request->user()->checkPassword($password['password'])){
            return redirect()->back()->with('info', 'Senha incorreta');
        }
        $credentials = $request->validate([
            'type_id'=>'required|numeric',
            'description'=>'required|string',
            'address'=>'required|string'
        ]);
        if(!$this->updateOrder->execute($id, $credentials)){
            redirect()->back()->with('info', 'falha ao editar pedido');
        }
        return redirect()->route('client.orders');

    }

    public function updateOfAdmin(Request $request, string $id){

        $credentials = $request->validate([
            'password'=>'required',
        ]);
        if(!$request->user()->checkPassword($credentials['password'])){
            return redirect()->back()->with('info', 'Senha incorreta');
        }
        $credentials = $request->validate([
            'type_id'=>'required|numeric',
            'description'=>'required|string',
            'scheduling_date'=>'nullable',
            'address'=>'required|string',
            'employees'=>'nullable'
        ]);
        if(!$this->updateOrderAdmin->execute($id, $credentials)){
            redirect()->back()->with('info', 'falha ao editar pedido');
        }
        return redirect()->route('admin.orders');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyOfClient(Request $request, string $id)
    {
        $credentials = $request->validate([
            'password'=>'required',
            'reason_for_cancellation'=>'required|string',
        ]);
        if(!$request->user()->checkPassword($credentials['password'])){
            return redirect()->back()->with('info', 'Senha incorreta');
        }

        if(!$this->cancellationOrder->execute($id, $credentials)){
            return redirect()->back()->with('info', 'Falha ao cancelar pedido');
        }
        return redirect()->route('client.orders');

    }

    public function destroyOfAdmin(Request $request, string $id){
        $credentials = $request->validate([
            'password'=>'required',
            'reason_for_cancellation'=>'required|string',
        ]);
        if(!$request->user()->checkPassword($credentials['password'])){
            return redirect()->back()->with('info', 'Senha incorreta');
        }

        if(!$this->cancellationOrder->execute($id, $credentials)){
            return redirect()->back()->with('info', 'Falha ao cancelar pedido');
        }
        return redirect()->route('admin.orders');
    }
}
