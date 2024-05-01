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
            'material_type_id' => 3,
            'name' => 'Matematika SKB',
            'code' => 'mtkskb',
        ]);
        GroupType::create([
            'material_type_id' => 3,
            'name' => 'Fisika SKB',
            'code' => 'fisskb',
        ]);
        GroupType::create([
            'material_type_id' => 3,
            'name' => 'Bahasa Inggris SKB',
            'code' => 'bingskb',
        ]);
        GroupType::create([
            'material_type_id' => 4,
            'name' => 'Literasi Bahasa Indonesia',
            'code' => 'literasiindonesia',
        ]);
        GroupType::create([
            'material_type_id' => 4,
            'name' => 'Literasi Bahasa Inggris',
            'code' => 'literasiinggris',
        ]);
        GroupType::create([
            'material_type_id' => 2,
            'name' => 'Tes Wawasan Kebangsaan',
            'code' => 'twk',
            'ambang_batas' => 65,
        ]);
        GroupType::create([
            'material_type_id' => 2,
            'name' => 'Tes Intelegensi Umum',
            'code' => 'tiu',
            'ambang_batas' => 80,
        ]);
        GroupType::create([
            'material_type_id' => 2,
            'name' => 'Tes Karakteristik Pribadi',
            'code' => 'tkp',
            'ambang_batas' => 156,
        ]);
        GroupType::create([
            'material_type_id' => 4,
            'name' => 'Penalaran Kuantitatif',
            'code' => 'penalarankuantitatif',
        ]);
        GroupType::create([
            'material_type_id' => 4,
            'name' => 'Penalaran Matematika',
            'code' => 'penalaranmtk',
        ]);
        GroupType::create([
            'material_type_id' => 4,
            'name' => 'Penalaran Umum',
            'code' => 'penalaranumum',
        ]);
        GroupType::create([
            'material_type_id' => 5,
            'name' => 'Matematika UM',
            'code' => 'mtkum',
        ]);
        GroupType::create([
            'material_type_id' => 5,
            'name' => 'Fisika UM',
            'code' => 'fisum',
        ]);
        GroupType::create([
            'material_type_id' => 5,
            'name' => 'Biologi UM',
            'code' => 'bioum',
        ]);
        GroupType::create([
            'material_type_id' => 5,
            'name' => 'Kimia UM',
            'code' => 'kimum',
        ]);
    }
}
