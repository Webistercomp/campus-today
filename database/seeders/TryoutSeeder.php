<?php

namespace Database\Seeders;

use App\Models\Tryout;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TryoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tryout::create([
            'packet_id' => 1,
            'name' => 'Tryout 1',
            'time' => 1,
            'description' => 'Tryout 1'
        ]);
    }
}
