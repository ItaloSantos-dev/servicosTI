<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function DashBoard(Request $request){
        $employeeLoged = $request->user()->load('employee');
        $ordersCompletedCount = $employeeLoged->employee->ordersCompleted()->count();
        $ordersScheduled = $employeeLoged->employee->ordersScheduled()->paginate(10);
        $avgRating = $employeeLoged->employee->ordersCompleted()->avg('rating');

        return view('user.employee.dashboard', compact('employeeLoged', 'ordersCompletedCount','avgRating', 'ordersScheduled'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
