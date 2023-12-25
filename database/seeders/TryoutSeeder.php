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
                    'description' => 'Tryout ' . ($j + 1),
                    'is_event' => false,
                    'active' => 1,
                ]);
            }
        }
        
        Tryout::create([
            'material_type_id' => 2,
            'code' => 'event1',
            'name' => 'Event Tryout ' . ($j + 1),
            'time' => 100,
            'description' => 'Event Tryout ' . ($j + 1),
            'roles' => '[1]',
            'is_event' => true,
            'start_datetime' => '2021-09-28 00:00:00',
            'end_datetime' => '2021-09-28 23:59:59',
            'active' => 1,
        ]);
    }
}
