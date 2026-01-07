<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employee;
use App\Models\Service_Types;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function DashBoard(Request $request){
        $roleUser = $request->user()->role;
        switch ($roleUser) {
            case '0':
                return redirect()->route('client.dashboard');
                break;
            case '1':
                return redirect()->route('employee.dashboard');

                break;
            case '2':
                return redirect()->route('admin.dashboard');
                break;
            default:
                # code...
                break;
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
