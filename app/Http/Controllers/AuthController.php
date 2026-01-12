<?php

namespace App\Http\Controllers;

use App\UseCases\Client\RegisterClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private RegisterClient $registerClient;

    public function __construct()
    {
        $this->registerClient = new RegisterClient();
    }

    public function ShowRegisterForms()
    {
        return view('auth.register');
    }

    public function Register(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'cpf' => 'required|string|unique:users,cpf|cpf',
            'date_birth' => 'required|date',
            'telephone' => 'required|string|size:15|unique:users,telephone|celular_com_ddd',
        ]);
        $this->registerClient->execute($credentials);


        return redirect()->route('registerForms')->with('info', 'Registro criado com sucesso! Agora realize Login');
    }

    public function ShowLoginForms()
    {
        return view('auth.login');
    }

    public function Login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        if(Auth::attempt($credentials)){
            return redirect()->route('home');
        }
        else{
            return redirect()->route('login')->with('info', 'Email ou senha inválido');
        }
    }

    public function Logout(Request $request){

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
