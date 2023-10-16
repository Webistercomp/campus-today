<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Material::create([
            'material_type_id' => 1,
            'title' => 'TWK - Judul Materi',
            'description' => 'Deskripsi Materi',
            'type' => 'teks'
        ]);
        
        Material::create([
            'material_type_id' => 1,
            'title' => 'TWK Video - Judul Materi',
            'description' => 'Deskripsi Materi Video',
            'type' => 'video'
        ]);
    }
}
