<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients=[
            ['user_id' => 2],
            ['user_id' => 5],
            ['user_id' => 6],
            ['user_id' => 7],
        ];
        foreach ($clients as $client){
            Client::factory()->create($client);
        }
    }
}
