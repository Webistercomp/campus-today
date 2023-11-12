<?php

namespace Database\Seeders;

use App\Models\MaterialType;
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
        $code = ['skd', 'skb', 'um', 'utbk'];
        for($i=2; $i<=5; $i++) {
            for($j=0;$j<3;$j++) {
                Tryout::create([
                    'material_type_id' => $i,
                    'code' => 'to' . $code[$i-2] . ($j + 1),
                    'name' => 'Tryout ' . ($j + 1),
                    'time' => 100,
                    'description' => 'Tryout ' . ($j + 1)
                ]);
            }
        }
        
    }
}
