<?php

namespace Database\Seeders;

use App\Models\OrderType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderTypes = [
            ['name' => 'Informática Básica',        'amount' => 80.00,  'active' => 1],
            ['name' => 'Suporte Técnico',           'amount' => 100.00, 'active' => 1],
            ['name' => 'Programação',               'amount' => 150.00, 'active' => 1],
            ['name' => 'Manutenção de Computador',  'amount' => 120.00, 'active' => 1],
            ['name' => 'Instalação de Software',    'amount' => 90.00,  'active' => 1],
            ['name' => 'Configuração de Sistema',   'amount' => 110.00, 'active' => 1],
            ['name' => 'Redes e Internet',          'amount' => 130.00, 'active' => 1],
            ['name' => 'Segurança da Informação',   'amount' => 160.00, 'active' => 1],
            ['name' => 'Banco de Dados',             'amount' => 150.00, 'active' => 1],
            ['name' => 'Desenvolvimento Web',        'amount' => 180.00, 'active' => 1],
            ['name' => 'Desenvolvimento Mobile',     'amount' => 180.00, 'active' => 1],
            ['name' => 'Infraestrutura de TI',       'amount' => 140.00, 'active' => 1],
            ['name' => 'Automação de Sistemas',      'amount' => 170.00, 'active' => 1],
            ['name' => 'Consultoria Técnica',        'amount' => 200.00, 'active' => 1],
            ['name' => 'Suporte Remoto',              'amount' => 60.00,  'active' => 1],
        ];
        foreach ($orderTypes as $orderType){
            OrderType::factory()->create($orderType);
        }

    }
}
