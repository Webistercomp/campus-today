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
            'name' => 'Literasi Bahasa Indonesia',
            'code' => 'literasiindonesia',
        ]);
        GroupType::create([
            'material_type_id' => 1,
            'name' => 'Literasi Bahasa Inggris',
            'code' => 'literasiinggris',
        ]);
        GroupType::create([
            'material_type_id' => 1,
            'name' => 'Penalaran Kuantitatif',
            'code' => 'penalarankuantitatif',
        ]);
        GroupType::create([
            'material_type_id' => 1,
            'name' => 'Penalaran Matematika',
            'code' => 'penalaranmtk',
        ]);
        GroupType::create([
            'material_type_id' => 1,
            'name' => 'Penalaran Umum',
            'code' => 'penalaranumum',
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
    }
}
