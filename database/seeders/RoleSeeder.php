<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Gratis'
        ]);
        Role::create([
            'name' => 'Friendly'
        ]);
        Role::create([
            'name' => 'Ambisius'
        ]);
        Role::create([
            'name' => 'Premium'
        ]);
        Role::create([
            'name' => 'Platinum'
        ]);
        Role::create([
            'name' => 'Gold'
        ]);
        Role::create([
            'name' => 'Admin'
        ]);
    }
}
