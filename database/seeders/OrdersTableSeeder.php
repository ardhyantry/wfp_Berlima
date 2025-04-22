<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('orders')->insert([
            [
                'transactions_id' => 1,
                'menus_id'        => 1,
                'portion_size'    => 'medium',
                'quantity'        => 2,
                'total'           => 50000,
                'notes'           => 'Tanpa sambal',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'transactions_id' => 1,
                'menus_id'        => 3,
                'portion_size'    => 'large',
                'quantity'        => 1,
                'total'           => 15000,
                'notes'           => null,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'transactions_id' => 2,
                'menus_id'        => 2,
                'portion_size'    => 'small',
                'quantity'        => 3,
                'total'           => 24000,
                'notes'           => 'Gula sedikit',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ]);
    }
}
