<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            ['name'=>'credit_card'],
            ['name'=>'debit_card'],
            ['name'=>'pix'],
            ['name'=>'bank_slip'],
        ];
        foreach ($paymentMethods as $paymentMethod){
            PaymentMethod::factory()->create($paymentMethod);
        }
    }
}
