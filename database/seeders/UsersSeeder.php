<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'is_admin' => 1,
            'is_agent' => 0,
            'is_customer' => 0
        ]);

        User::create([
            'name' => 'agent',
            'email' => 'agent@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'is_admin' => 0,
            'is_agent' => 1,
            'is_customer' => 0
        ]);

        User::create([
            'name' => 'customer',
            'email' => 'customer@example.com',
            'password' => bcrypt('password'),
            'phone' => '081234567890',
            'address' => 'Jl. Example No. 123, Medan',
            'email_verified_at' => now(),
            'is_admin' => 0,
            'is_agent' => 0,
            'is_customer' => 1
        ]);
    }
}
