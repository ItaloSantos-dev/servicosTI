<?php 
namespace App\UseCases\Client;

use App\Models\Client;
use App\Models\User;

class RegisterClient 
{
    public function execute(array $data): void
    {
        $data['telephone'] = preg_replace('/\D/', '', $data['telephone']);
        $data['role'] = '0';
        $data['cpf'] = preg_replace('/\D/', '', $data['cpf']);
        $novoUsuario = User::create($data);
        Client::create(['user_id' => $novoUsuario->id]);
    }
}