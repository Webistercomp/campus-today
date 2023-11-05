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
            'code' => 'videoseries',
            'name' => 'Video Series',
            'description' => 'Video Series Description',
        ]);
        MaterialType::create([
            'code' => 'skd',
            'name' => 'Materi SKD',
            'description' => 'SKD adalah singkatan dari Seleksi Kompetensi Dasar yang dilakukan Pemerintah pada seleksi CPNS dan PPPK'
        ]);
        MaterialType::create([
            'code' => 'skb',
            'name' => 'Materi SKB',
            'description' => 'Materi SKB'
        ]);
        MaterialType::create([
            'code' => 'utbk',
            'name' => 'Materi UTBK',
            'description' => 'Materi UTBK'
        ]);
        MaterialType::create([
            'code' => 'um',
            'name' => 'Materi UM',
            'description' => 'Materi UM'
        ]);
    }
}
