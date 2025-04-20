<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ingredients')->insert([
            ['name' => 'Daging Sapi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ayam', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ikan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nasi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sayuran', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bumbu Rahasia', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Es Batu', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gula', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Susu', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Coklat', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
