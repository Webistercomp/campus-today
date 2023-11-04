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
            'material_type_id' => 1,
            'code' => 'toskd1',
            'name' => 'Tryout 1',
            'time' => 1,
            'description' => 'Tryout 1'
        ]);
        Tryout::create([
            'material_type_id' => 2,
            'code' => 'toskb1',
            'name' => 'Tryout 2',
            'time' => 1,
            'description' => 'Tryout 2'
        ]);
        Tryout::create([
            'material_type_id' => 3,
            'code' => 'toutbk1',
            'name' => 'Tryout 3',
            'time' => 1,
            'description' => 'Tryout 3'
        ]);
        Tryout::create([
            'material_type_id' => 4,
            'code' => 'toum1',
            'name' => 'Tryout 4',
            'time' => 1,
            'description' => 'Tryout 4'
        ]);
    }
}
