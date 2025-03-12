<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('customers')->insert([
            ['name' => 'John Doe', 'email' => 'john@example.com','password' => 'halo'],
            ['name' => 'Jane Smith', 'email' => 'jane@example.com', 'password' => 'halo'],
        ]);
    }
}

