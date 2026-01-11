<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderType;
use App\useCases\admin\CreateOrderTypeAdmin;
use App\useCases\admin\UpdateOrderTypeAdmin;
use Illuminate\Http\Request;

class OrderTypeController extends Controller
{
    private CreateOrderTypeAdmin $createOrderTypeAdmin;
    private UpdateOrderTypeAdmin $updateOrderTypeAdmin;
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->createOrderTypeAdmin = new CreateOrderTypeAdmin();
        $this->updateOrderTypeAdmin = new UpdateOrderTypeAdmin();
    }

    public function index()
    {
        $orderTypes = OrderType::paginate(10);
        return view('user.admin.orderType.orderTypes', compact('orderTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.admin.orderType.newOrderType');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $password = $request->validate(['password'=>'required|string']);
        if (!$request->user()->checkPassword($password['password'])){
            return redirect()->back()->with('info', 'Senha incorreta');
        }
        $credentials = $request->validate([
            'name'=>'required|string|max:100',
            'amount'=>'required|numeric|min:1'
        ]);
        $newTypeOrder = $this->createOrderTypeAdmin->execute($credentials);
        if(!$newTypeOrder){
            return  redirect()->back()->with('info', 'falha ao criar novo tipo de pedido');
        }
        return redirect()->route('admin.orderTypes');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $orderType = OrderType::find($id);
        return view('user.admin.orderType.updateOrderType', compact('orderType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $password = $request->validate([
            'password'=>'required|string'
        ]);
        if(!auth()->user()->checkPassword($password['password'])){
            return redirect()->back()->with('info', 'Senha incorreta');
        }
        $credential = $request->validate([
            'name'=>'required|string',
            'amount'=>'required|numeric',
            'active'=>'nullable'
        ]);

        if(!$this->updateOrderTypeAdmin->execute($id, $credential)){
            return redirect()->back()->with('info', 'Erro ao salvar alterações');
        }
        return redirect()->route('admin.orderTypes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
