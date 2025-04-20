<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@resto.com',
                'phone_number' => '081234567890',
                'username' => 'admin',
                'password' => Hash::make('1'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Customer',
                'email' => 'customer@resto.com',
                'phone_number' => '081234567891',
                'username' => 'customer',
                'password' => Hash::make('1'),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
