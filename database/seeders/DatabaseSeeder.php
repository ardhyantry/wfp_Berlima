<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            IngredientSeeder::class,
            MenuSeeder::class,
            MenuIngredientSeeder::class,
            TransactionSeeder::class,
            OrderStatusSeeder::class,
            DetailTransactionSeeder::class,
        ]);
    }
}