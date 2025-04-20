<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    public function run()
    {
        DB::table('order_status')->insert([
            [
                'transactions_id' => 1,
                'status_type' => 'ready',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2)->addHours(1)
            ],
            [
                'transactions_id' => 2,
                'status_type' => 'processing',
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay()
            ]
        ]);
    }
}