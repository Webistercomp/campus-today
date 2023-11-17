<?php

namespace Database\Seeders;

use App\Models\GroupType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GroupType::create([
            'material_type_id' => 1,
            'name' => 'Matematika',
            'code' => 'mtk',
        ]);
        GroupType::create([
            'material_type_id' => 1,
            'name' => 'Fisika',
            'code' => 'fis',
        ]);
        GroupType::create([
            'material_type_id' => 1,
            'name' => 'Biologi',
            'code' => 'bio',
        ]);
        GroupType::create([
            'material_type_id' => 1,
            'name' => 'Kimia',
            'code' => 'kim',
        ]);
        GroupType::create([
            'material_type_id' => 2,
            'name' => 'Tes Wawasan Kebangsaan',
            'code' => 'twk',
        ]);
        GroupType::create([
            'material_type_id' => 2,
            'name' => 'Tes Intelegensi Umum',
            'code' => 'tiu',
        ]);
        GroupType::create([
            'material_type_id' => 2,
            'name' => 'Tes Karakteristik Pribadi',
            'code' => 'tkp',
        ]);
    }
}
