<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'=>'admin', 'surname'=>'dobom', 'email'=>'admin@gmail.com', 'cpf'=>'34745986009', 'telephone'=>'99981587631', 'date_birth'=>'2005-08-02', 'role'=>'2',
                'password'=>'$2y$12$4t6QLUopdPPMXbhcjBamRe92qCaeUjedq1JWx.vdhDhS/SJQBu4au', 'created_at'=>now(), 'updated_at'=>now()

            ],
            [
                'name'=>'clarice', 'surname'=>'freire', 'email'=>'clarice@gmail.com', 'cpf'=>'39548288044', 'telephone'=>'84925492646', 'date_birth'=>'2005-08-02', 'role'=>'0',
                'password'=>'$2y$12$4t6QLUopdPPMXbhcjBamRe92qCaeUjedq1JWx.vdhDhS/SJQBu4au', 'created_at'=>now(), 'updated_at'=>now()
            ],
            [
                'name'=>'italo', 'surname'=>'santos', 'email'=>'italo@gmail.com', 'cpf'=>'87235175060', 'telephone'=>'97924593986', 'date_birth'=>'2005-08-02', 'role'=>'1',
                'password'=>'$2y$12$4t6QLUopdPPMXbhcjBamRe92qCaeUjedq1JWx.vdhDhS/SJQBu4au', 'created_at'=>now(), 'updated_at'=>now()
            ],
            [
                'name'=>'joao', 'surname'=>'pereira', 'email'=>'joao@gmail.com', 'cpf'=>'12345678901', 'telephone'=>'11987654321', 'date_birth'=>'2001-03-15', 'role'=>'1',
                'password'=>'$2y$12$4t6QLUopdPPMXbhcjBamRe92qCaeUjedq1JWx.vdhDhS/SJQBu4au', 'created_at'=>now(), 'updated_at'=>now()
            ],
            [
                'name'=>'maria', 'surname'=>'oliveira', 'email'=>'maria@gmail.com', 'cpf'=>'23456789012', 'telephone'=>'21998765432', 'date_birth'=>'1999-11-22', 'role'=>'0',
                'password'=>'$2y$12$4t6QLUopdPPMXbhcjBamRe92qCaeUjedq1JWx.vdhDhS/SJQBu4au', 'created_at'=>now(), 'updated_at'=>now()
            ],
            [
                'name'=>'carlos', 'surname'=>'silva', 'email'=>'carlos@gmail.com', 'cpf'=>'34567890123', 'telephone'=>'31991234567', 'date_birth'=>'1995-06-10', 'role'=>'0',
                'password'=>'$2y$12$4t6QLUopdPPMXbhcjBamRe92qCaeUjedq1JWx.vdhDhS/SJQBu4au', 'created_at'=>now(), 'updated_at'=>now()
            ],
            [
                'name'=>'ana', 'surname'=>'rodrigues', 'email'=>'ana@gmail.com', 'cpf'=>'45678901234', 'telephone'=>'41999887766', 'date_birth'=>'2003-01-05', 'role'=>'0',
                'password'=>'$2y$12$4t6QLUopdPPMXbhcjBamRe92qCaeUjedq1JWx.vdhDhS/SJQBu4au', 'created_at'=>now(), 'updated_at'=>now()
            ],
            [
                'name'=>'lucas', 'surname'=>'ferreira', 'email'=>'lucas@gmail.com', 'cpf'=>'56789012345', 'telephone'=>'51988776655', 'date_birth'=>'1998-09-18', 'role'=>'1',
                'password'=>'$2y$12$4t6QLUopdPPMXbhcjBamRe92qCaeUjedq1JWx.vdhDhS/SJQBu4au', 'created_at'=>now(), 'updated_at'=>now()
            ],

        ];

        foreach ($users as $user){
            User::factory()->create($user);
        }
    }
}
