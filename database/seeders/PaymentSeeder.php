<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payments')->insert([
            ['transaction_id' => 1, 'payment_method' => 'Credit Card', 'amount_paid' => 150.00, 'payment_date' => now()],
            ['transaction_id' => 2, 'payment_method' => 'Bank Transfer', 'amount_paid' => 200.00, 'payment_date' => now()],
        ]);
    }
}

