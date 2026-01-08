<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function DashBoard(){

        $clients = User::whereHas('client.orders')->get();
        $employee = User::whereHas('employee.orders')->get();
        $orders = Order::with('TypeOrder','employees','client')->get();
        $ordersCurrentMonth = Order::scheduledthisMonth()->with('client.user')->get();
        $ordersCount=[
            'in_analysis' => Order::where('status', 'in_analysis')->count(),
            'scheduled' => Order::where('status', 'scheduled')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'canceled' => Order::where('status', 'canceled')->count(),
        ];
        $avgRating = Order::avg('rating');

        return view('user.admin.dashboard', compact('clients', 'employee', 'orders', 'ordersCurrentMonth', 'ordersCount', 'avgRating'));
    }
}
