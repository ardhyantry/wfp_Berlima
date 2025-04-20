<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Appetizer',
                'image_path' => 'categories/appetizer.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Main Course',
                'image_path' => 'categories/main-course.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Snack',
                'image_path' => 'categories/snack.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dessert',
                'image_path' => 'categories/dessert.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Coffee',
                'image_path' => 'categories/coffee.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Non Coffee',
                'image_path' => 'categories/non-coffee.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}