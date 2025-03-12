<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('transactions')->insert([
            ['customer_id' => 1, 'order_number' => 'ORD001', 'total_amount' => 150.00, 'status' => 'completed'],
            ['customer_id' => 2, 'order_number' => 'ORD002', 'total_amount' => 200.00, 'status' => 'pending'],
        ]);
    }
}

