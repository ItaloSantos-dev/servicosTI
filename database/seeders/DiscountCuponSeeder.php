<?php

namespace Database\Seeders;

use App\Models\DiscountCupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountCuponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $discounts = [
            ['slug' => 'JUN-5',    'amount' => 5,  'active' => 1, 'minimum_amount' => 50.00],
            ['slug' => 'JUN-10',   'amount' => 10, 'active' => 1, 'minimum_amount' => 80.00],
            ['slug' => 'JUN-15',   'amount' => 15, 'active' => 1, 'minimum_amount' => 120.00],
            ['slug' => 'JUN-20',   'amount' => 20, 'active' => 1, 'minimum_amount' => 150.00],

            ['slug' => 'NATAL-5',  'amount' => 5,  'active' => 1, 'minimum_amount' => 60.00],
            ['slug' => 'NATAL-10', 'amount' => 10, 'active' => 1, 'minimum_amount' => 100.00],
            ['slug' => 'NATAL-15', 'amount' => 15, 'active' => 1, 'minimum_amount' => 140.00],
            ['slug' => 'NATAL-20', 'amount' => 20, 'active' => 1, 'minimum_amount' => 180.00],

            ['slug' => 'AMAR-5',   'amount' => 5,  'active' => 1, 'minimum_amount' => 70.00],
            ['slug' => 'AMAR-10',  'amount' => 10, 'active' => 1, 'minimum_amount' => 110.00],
            ['slug' => 'AMAR-15',  'amount' => 15, 'active' => 1, 'minimum_amount' => 150.00],
            ['slug' => 'AMAR-20',  'amount' => 20, 'active' => 1, 'minimum_amount' => 200.00],

            ['slug' => 'BLACK-25', 'amount' => 25, 'active' => 1, 'minimum_amount' => 250.00],
            ['slug' => 'BLACK-30', 'amount' => 30, 'active' => 1, 'minimum_amount' => 300.00],
            ['slug' => 'BLACK-40', 'amount' => 40, 'active' => 1, 'minimum_amount' => 400.00],
            ['slug' => 'BLACK-50', 'amount' => 50, 'active' => 1, 'minimum_amount' => 500.00],

            ['slug' => 'VIP-10',   'amount' => 10, 'active' => 1, 'minimum_amount' => 120.00],
            ['slug' => 'VIP-20',   'amount' => 20, 'active' => 1, 'minimum_amount' => 200.00],
            ['slug' => 'VIP-30',   'amount' => 30, 'active' => 1, 'minimum_amount' => 300.00],
            ['slug' => 'VIP-50',   'amount' => 50, 'active' => 1, 'minimum_amount' => 600.00],
        ];

        foreach ($discounts as $discount){
            DiscountCupon::factory()->create($discount);
        }

    }
}
