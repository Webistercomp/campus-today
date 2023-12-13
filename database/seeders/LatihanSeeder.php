<?php

namespace Database\Seeders;

use App\Models\GroupType;
use App\Models\Latihan;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $code = ['skd', 'skb', 'um', 'utbk'];
        $group = GroupType::all();
        $roles = Role::all();
        for($i=2; $i<=5; $i++) {
            for($j=0;$j<3;$j++) {
                Latihan::create([
                    'material_type_id' => $i,
                    'code' => 'to' . $code[$i-2] . ($j + 1),
                    'name' => 'Tryout ' . ($j + 1),
                    'description' => 'Tryout ' . ($j + 1),
                    'active' => 1,
                    'group_id' => rand(1, count($group)),
                    'roles' => '[1]',
                ]);
            }
        }
    }
}
