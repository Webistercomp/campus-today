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
            'roles' => '[2, 3, 4, 6]',
            'code' => 'skd',
            'name' => 'Materi SKD',
            'description' => 'SKD adalah singkatan dari Seleksi Kompetensi Dasar yang dilakukan Pemerintah pada seleksi CPNS dan PPPK'
        ]);
        MaterialType::create([
            'roles' => '[2, 3, 5, 6]',
            'code' => 'skb',
            'name' => 'Materi SKB',
            'description' => 'Materi SKB'
        ]);
        MaterialType::create([
            'roles' => '[2, 3, 5, 6]',
            'code' => 'utbk',
            'name' => 'Materi UTBK',
            'description' => 'Materi UTBK'
        ]);
        MaterialType::create([
            'roles' => '[2, 3, 6]',
            'code' => 'um',
            'name' => 'Materi UM',
            'description' => 'Materi UM'
        ]);
    }
}
