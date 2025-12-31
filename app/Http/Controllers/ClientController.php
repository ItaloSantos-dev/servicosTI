<?php

namespace App\Http\Controllers;

use App\UseCases\Client\RegisterClient;
use Exception;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private RegisterClient $registerClient;

    public function __construct()
    {
        $this->registerClient = new RegisterClient();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $credentials = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'cpf' => 'required|string|unique:users|cpf',
            'date_birth' => 'required|date',
            'telephone' => 'required|string|size:15|unique:users|celular_com_ddd',
        ]);
        $this->registerClient->execute($credentials);
        

        return redirect()->route('client.create')->with('info', 'Registro criado com sucesso! Agora realize Login');
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
