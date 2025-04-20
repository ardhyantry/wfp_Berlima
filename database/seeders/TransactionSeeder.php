<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        DB::table('transactions')->insert([
            [
                'subtotal' => 33000,
                'discount' => 0,
                'total' => 33000,
                'order_type' => 'take_away',
                'payment_type' => 'qris',
                'users_id' => 2,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2)
            ],
            [
                'subtotal' => 40000,
                'discount' => 5000,
                'total' => 35000,
                'order_type' => 'dine_in',
                'payment_type' => 'e_wallet',
                'users_id' => 2,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay()
            ]
        ]);
    }
}