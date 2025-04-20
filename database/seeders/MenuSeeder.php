<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('menus')->insert([
            [
                'name' => 'Nasi Goreng Spesial',
                'description' => 'Nasi goreng dengan campuran daging dan sayuran',
                'nutrition_fact' => 'Kalori: 500, Protein: 20g',
                'price' => 25000,
                'stock' => 50,
                'image_path' => 'menus/nasi-goreng.jpg',
                'categories_id' => 2, 
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Es Teh Manis',
                'description' => 'Es teh dengan gula spesial',
                'nutrition_fact' => 'Kalori: 150, Gula: 20g',
                'price' => 8000,
                'stock' => 100,
                'image_path' => 'menus/es-teh.jpg',
                'categories_id' => 6, 
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Kentang Goreng',
                'description' => 'Kentang goreng renyah dengan bumbu spesial',
                'nutrition_fact' => 'Kalori: 300, Lemak: 15g',
                'price' => 15000,
                'stock' => 30,
                'image_path' => 'menus/kentang-goreng.jpg',
                'categories_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
