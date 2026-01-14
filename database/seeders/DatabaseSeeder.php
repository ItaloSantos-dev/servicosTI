<?php

namespace Database\Seeders;

use App\Models\DiscountCupon;
use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            ClientSeeder::class,
            OrderTypeSeeder::class,
            OrderSeeder::class,
            EmployeeSeeder::class,
            EmployeeOrderSeeder::class,
            DiscountCuponSeeder::class,
            PaymentMethodSeeder::class,
            PaymentSeeder::class
        ]);

    }
}
