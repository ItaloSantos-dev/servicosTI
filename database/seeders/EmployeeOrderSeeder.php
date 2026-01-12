<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderEmployees = [
            ['order_id' => 1,  'employee_id' => 1],
            ['order_id' => 2,  'employee_id' => 2],
            ['order_id' => 3,  'employee_id' => 3],
            ['order_id' => 4,  'employee_id' => 1],
            ['order_id' => 5,  'employee_id' => 2],
            ['order_id' => 6,  'employee_id' => 3],
            ['order_id' => 7,  'employee_id' => 1],
            ['order_id' => 8,  'employee_id' => 2],
            ['order_id' => 9,  'employee_id' => 3],
            ['order_id' => 10, 'employee_id' => 1],
            ['order_id' => 11, 'employee_id' => 2],
            ['order_id' => 12, 'employee_id' => 3],
            ['order_id' => 13, 'employee_id' => 1],
            ['order_id' => 14, 'employee_id' => 2],
            ['order_id' => 15, 'employee_id' => 3],
            ['order_id' => 16, 'employee_id' => 1],
            ['order_id' => 17, 'employee_id' => 2],
            ['order_id' => 18, 'employee_id' => 3],
            ['order_id' => 19, 'employee_id' => 1],
            ['order_id' => 20, 'employee_id' => 2],
            ['order_id' => 21, 'employee_id' => 3],
            ['order_id' => 22, 'employee_id' => 1],
            ['order_id' => 23, 'employee_id' => 2],
            ['order_id' => 24, 'employee_id' => 3],
            ['order_id' => 25, 'employee_id' => 1],
            ['order_id' => 26, 'employee_id' => 2],
            ['order_id' => 27, 'employee_id' => 3],
            ['order_id' => 28, 'employee_id' => 1],
            ['order_id' => 29, 'employee_id' => 2],
            ['order_id' => 30, 'employee_id' => 3],
        ];

        foreach ($orderEmployees as $orderEmployee){
            DB::table('employee_order')->insert($orderEmployee);
        }
    }
}
