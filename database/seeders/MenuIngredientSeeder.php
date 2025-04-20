<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('menus_has_ingredients')->insert([
            ['menus_id' => 1, 'ingredients_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['menus_id' => 1, 'ingredients_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['menus_id' => 1, 'ingredients_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['menus_id' => 2, 'ingredients_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['menus_id' => 2, 'ingredients_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['menus_id' => 3, 'ingredients_id' => 5, 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
