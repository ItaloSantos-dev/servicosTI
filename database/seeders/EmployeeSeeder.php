<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            ['user_id' => 3, 'credential' => 'IT050406'],
            ['user_id' => 4, 'credential' => 'JO050406'],
            ['user_id' => 8, 'credential' => 'LU050406'],

        ];
        foreach ($employees as $employee){
            Employee::factory()->create($employee);
        }
    }
}
