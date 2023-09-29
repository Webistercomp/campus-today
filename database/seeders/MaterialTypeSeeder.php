<?php

namespace Database\Seeders;

use App\Models\MaterialType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MaterialType::create([
            'packet_id' => 1,
            'name' => 'Materi Type 1',
            'description' => 'Materi Type 1'
        ]);
    }
}
