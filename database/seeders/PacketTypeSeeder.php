<?php

namespace Database\Seeders;

use App\Models\PacketType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PacketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PacketType::create([
            'name' => 'Mandiri',
        ]);
        PacketType::create([
            'name' => 'Bimbel',
        ]);
    }
}
