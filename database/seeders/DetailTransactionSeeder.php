<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailTransactionSeeder extends Seeder
{
    public function run()
    {
        DB::table('detail_transactions')->insert([
            [
                'transactions_id' => 1,
                'menus_id' => 1,
                'portion_size' => 'small',
                'quantity' => 1,
                'total' => 25000,
                'notes' => 'Pedas level 2',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2)
            ],
            [
                'transactions_id' => 1,
                'menus_id' => 2,
                'portion_size' => 'medium',
                'quantity' => 1,
                'total' => 8000,
                'notes' => 'Es sedikit',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2)
            ],
            [
                'transactions_id' => 2,
                'menus_id' => 1,
                'portion_size' => 'large',
                'quantity' => 1,
                'total' => 25000,
                'notes' => 'Tidak pedas',
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay()
            ],
            [
                'transactions_id' => 2,
                'menus_id' => 3,
                'portion_size' => 1,
                'quantity' => 1,
                'total' => 15000,
                'notes' => 'Tambahkan saus',
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay()
            ]
        ]);
    }
}