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
            'description' => 'Video series CPNS di platform pembelajaran menyajikan materi pelajaran terstruktur, membantu calon peserta dalam persiapan ujian dengan metode visual.',
        ]);
        MaterialType::create([
            'code' => 'skd',
            'name' => 'Materi SKD',
            'description' => 'SKD (Seleksi Kompetensi Dasar) adalah latihan ujian tertulis yang mengevaluasi pemahaman dan keterampilan dasar calon pegawai.'
        ]);
        MaterialType::create([
            'code' => 'skb',
            'name' => 'Materi SKB',
            'description' => 'SKB adalah simulasi ujian komputer yang menilai kemampuan teknis dan keterampilan calon pegawai dalam suatu bidang pekerjaan.'
        ]);
        MaterialType::create([
            'code' => 'utbk',
            'name' => 'Materi UTBK',
            'description' => 'UTBK (Ujian Tulis Berbasis Komputer) adalah simulasi ujian elektronik yang mempersiapkan peserta menghadapi ujian seleksi perguruan tinggi.'
        ]);
        MaterialType::create([
            'code' => 'um',
            'name' => 'Materi UM',
            'description' => 'UM (Ujian Mandiri) adalah latihan tes yang membantu siswa mempersiapkan diri untuk ujian masuk perguruan tinggi secara mandiri.'
        ]);
    }
}
