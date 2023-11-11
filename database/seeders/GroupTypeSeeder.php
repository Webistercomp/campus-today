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
            'name' => 'Fisika',
            'code' => 'fis',
        ]);
        GroupType::create([
            'name' => 'Biologi',
            'code' => 'bio',
        ]);
        GroupType::create([
            'name' => 'Kimia',
            'code' => 'kim',
        ]);
        GroupType::create([
            'name' => 'Matematika',
            'code' => 'mtk',
        ]);
        GroupType::create([
            'name' => 'Tes Wawasan Kebangsaan',
            'code' => 'twk',
        ]);
        GroupType::create([
            'name' => 'Tes Intelegensi Umum',
            'code' => 'tiu',
        ]);
        GroupType::create([
            'name' => 'Tes Karakteristik Pribadi',
            'code' => 'tkp',
        ]);
    }
}
