<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = [

            [
                'id' => 1,
                'order_id' => 3, // order completed
                'discount_coupon_id' => 4, // JUN-20
                'discount' => 10.00, // desconto manual
                'additional_fee' => 0.00,
                'final_amount' => 150.00 - (150 * 0.20) - 10.00, // 150 - 30 - 10 = 110
                'payment_method_id' => 1,
                'invoice_number' => 'INV-20260109-0003',
                'payment_status' => 'conclued',
                'paid_at' => '2026-01-09 16:30:00',
            ],

            [
                'id' => 2,
                'order_id' => 5,
                'discount_coupon_id' => 2, // JUN-10
                'discount' => 0.00,
                'additional_fee' => 5.00,
                'final_amount' => 90.00 - (90 * 0.10) + 5.00, // 90 - 9 + 5 = 86
                'payment_method_id' => 2,
                'invoice_number' => 'INV-20260107-0005',
                'payment_status' => 'conclued',
                'paid_at' => '2026-01-07 15:00:00',
            ],

            [
                'id' => 3,
                'order_id' => 8,
                'discount_coupon_id' => 8, // NATAL-20
                'discount' => 0.00,
                'additional_fee' => 0.00,
                'final_amount' => 120.00 - (120 * 0.20), // 96
                'payment_method_id' => 1,
                'invoice_number' => 'INV-20260106-0008',
                'payment_status' => 'conclued',
                'paid_at' => '2026-01-06 14:00:00',
            ],

            [
                'id' => 4,
                'order_id' => 9,
                'discount_coupon_id' => 10, // AMAR-10
                'discount' => 5.00,
                'additional_fee' => 0.00,
                'final_amount' => 150.00 - (150 * 0.10) - 5.00, // 150 - 15 - 5 = 130
                'payment_method_id' => 3,
                'invoice_number' => 'INV-20260105-0009',
                'payment_status' => 'conclued',
                'paid_at' => '2026-01-05 14:30:00',
            ],

            [
                'id' => 5,
                'order_id' => 13,
                'discount_coupon_id' => 16, // BLACK-50
                'discount' => 0.00,
                'additional_fee' => 10.00,
                'final_amount' => 80.00 - (80 * 0.50) + 10.00, // 80 - 40 + 10 = 50
                'payment_method_id' => 2,
                'invoice_number' => 'INV-20260104-0013',
                'payment_status' => 'conclued',
                'paid_at' => '2026-01-04 16:00:00',
            ],

            [
                'id' => 6,
                'order_id' => 14,
                'discount_coupon_id' => 19, // VIP-30
                'discount' => 0.00,
                'additional_fee' => 0.00,
                'final_amount' => 100.00 - (100 * 0.30), // 70
                'payment_method_id' => 1,
                'invoice_number' => 'INV-20260103-0014',
                'payment_status' => 'conclued',
                'paid_at' => '2026-01-03 20:30:00',
            ],

            [
                'id' => 7,
                'order_id' => 16,
                'discount_coupon_id' => 5, // NATAL-5
                'discount' => 0.00,
                'additional_fee' => 0.00,
                'final_amount' => 120.00 - (120 * 0.05), // 114
                'payment_method_id' => 2,
                'invoice_number' => 'INV-20260102-0016',
                'payment_status' => 'conclued',
                'paid_at' => '2026-01-02 14:00:00',
            ],

            [
                'id' => 8,
                'order_id' => 18,
                'discount_coupon_id' => 12, // AMAR-20
                'discount' => 10.00,
                'additional_fee' => 0.00,
                'final_amount' => 150.00 - (150 * 0.20) - 10.00, // 150 - 30 - 10 = 110
                'payment_method_id' => 3,
                'invoice_number' => 'INV-20260101-0018',
                'payment_status' => 'conclued',
                'paid_at' => '2026-01-01 14:30:00',
            ],

            [
                'id' => 9,
                'order_id' => 21,
                'discount_coupon_id' => 2, // JUN-10
                'discount' => 0.00,
                'additional_fee' => 0.00,
                'final_amount' => 110.00 - (110 * 0.10), // 99
                'payment_method_id' => 1,
                'invoice_number' => 'INV-20260101-0021',
                'payment_status' => 'conclued',
                'paid_at' => '2026-01-01 15:00:00',
            ],

            [
                'id' => 10,
                'order_id' => 24,
                'discount_coupon_id' => 11, // AMAR-15
                'discount' => 5.00,
                'additional_fee' => 0.00,
                'final_amount' => 150.00 - (150 * 0.15) - 5.00, // 150 - 22.5 - 5 = 122.5
                'payment_method_id' => 2,
                'invoice_number' => 'INV-20260102-0024',
                'payment_status' => 'conclued',
                'paid_at' => '2026-01-02 14:00:00',
            ],
            [
                'order_id' => 1,
                'discount_coupon_id' => null,
                'discount' => 0.00,
                'additional_fee' => 0.00,
                'final_amount' => 120.00,
                'payment_method_id' => 1,
                'invoice_number' => 'INV-0001',
                'payment_status' => 'waiting',
                'paid_at' => null,
            ],
            [
                'order_id' => 2,
                'discount_coupon_id' => null,
                'discount' => 0.00,
                'additional_fee' => 0.00,
                'final_amount' => 85.50,
                'payment_method_id' => 2,
                'invoice_number' => 'INV-0002',
                'payment_status' => 'conclued',
                'paid_at' => '2026-01-10 14:30:00',
            ],
            [
                'order_id' => 4,
                'discount_coupon_id' => null,
                'discount' => 0.00,
                'additional_fee' => 0.00,
                'final_amount' => 210.00,
                'payment_method_id' => 1,
                'invoice_number' => 'INV-0004',
                'payment_status' => 'canceled',
                'paid_at' => null,
            ],
            [
                'order_id' => 6,
                'discount_coupon_id' => null,
                'discount' => 0.00,
                'additional_fee' => 0.00,
                'final_amount' => 60.00,
                'payment_method_id' => 3,
                'invoice_number' => 'INV-0006',
                'payment_status' => 'waiting',
                'paid_at' => null,
            ],
            [
                'order_id' => 7,
                'discount_coupon_id' => null,
                'discount' => 0.00,
                'additional_fee' => 0.00,
                'final_amount' => 150.00,
                'payment_method_id' => 2,
                'invoice_number' => 'INV-0007',
                'payment_status' => 'conclued',
                'paid_at' => '2026-01-11 09:15:00',
            ],
            [
                'order_id' => 10,
                'discount_coupon_id' => null,
                'discount' => 0.00,
                'additional_fee' => 0.00,
                'final_amount' => 99.90,
                'payment_method_id' => 1,
                'invoice_number' => 'INV-0010',
                'payment_status' => 'waiting',
                'paid_at' => null,
            ],
            [
                'order_id' => 11,
                'discount_coupon_id' => null,
                'discount' => 0.00,
                'additional_fee' => 0.00,
                'final_amount' => 180.00,
                'payment_method_id' => 2,
                'invoice_number' => 'INV-0011',
                'payment_status' => 'canceled',
                'paid_at' => null,
            ],
            [
                'order_id' => 12,
                'discount_coupon_id' => null,
                'discount' => 0.00,
                'additional_fee' => 0.00,
                'final_amount' => 75.00,
                'payment_method_id' => 3,
                'invoice_number' => 'INV-0012',
                'payment_status' => 'waiting',
                'paid_at' => null,
            ],
            [
                'order_id' => 15,
                'discount_coupon_id' => null,
                'discount' => 0.00,
                'additional_fee' => 0.00,
                'final_amount' => 250.00,
                'payment_method_id' => 1,
                'invoice_number' => 'INV-0015',
                'payment_status' => 'conclued',
                'paid_at' => '2026-01-12 18:40:00',
            ],
            [
                'order_id' => 17,
                'discount_coupon_id' => null,
                'discount' => 0.00,
                'additional_fee' => 0.00,
                'final_amount' => 130.00,
                'payment_method_id' => 2,
                'invoice_number' => 'INV-0017',
                'payment_status' => 'waiting',
                'paid_at' => null,
            ],
            [
                'order_id' => 19,
                'discount_coupon_id' => null,
                'discount' => 0.00,
                'additional_fee' => 0.00,
                'final_amount' => 95.00,
                'payment_method_id' => 3,
                'invoice_number' => 'INV-0019',
                'payment_status' => 'canceled',
                'paid_at' => null,
            ],
            [
                'order_id' => 20,
                'discount_coupon_id' => null,
                'discount' => 0.00,
                'additional_fee' => 0.00,
                'final_amount' => 170.00,
                'payment_method_id' => 1,
                'invoice_number' => 'INV-0020',
                'payment_status' => 'waiting',
                'paid_at' => null,
            ],
            [
                'order_id' => 22,
                'discount_coupon_id' => null,
                'discount' => 0.00,
                'additional_fee' => 0.00,
                'final_amount' => 170.00,
                'payment_method_id' => 1,
                'invoice_number' => 'INV-0020',
                'payment_status' => 'waiting',
                'paid_at' => null,
            ],
            [
                'order_id' => 26,
                'discount_coupon_id' => null,
                'discount' => 0.00,
                'additional_fee' => 0.00,
                'final_amount' => 170.00,
                'payment_method_id' => 1,
                'invoice_number' => 'INV-0020',
                'payment_status' => 'waiting',
                'paid_at' => null,
            ],
            [
                'order_id' => 30,
                'discount_coupon_id' => null,
                'discount' => 0.00,
                'additional_fee' => 0.00,
                'final_amount' => 170.00,
                'payment_method_id' => 1,
                'invoice_number' => 'INV-0020',
                'payment_status' => 'waiting',
                'paid_at' => null,
            ],

        ];

        foreach ($payments as $payment){
            Payment::factory()->create($payment);
        }

    }
}
