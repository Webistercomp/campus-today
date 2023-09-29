<?php

namespace Database\Seeders;

use App\Models\RoleMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoleMenu::create([
            'role_id' => 1,
            'packet_type_id' => 1
        ]);
    }
}
