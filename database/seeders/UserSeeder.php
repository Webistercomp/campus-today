<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role_id' => 7,
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'is_admin' => 1,
        ]);
        User::create([
            'role_id' => 1,
            'name' => 'User',
            'email' => 'user@mail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);
    }
}
