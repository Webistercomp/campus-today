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
            'material_type_id' => 1, //skd
            'code' => 'twk1',
            'title' => 'SKD Teks TWK',
            'description' => 'Deskripsi Materi',
            'type' => 'teks',
            'group' => 'twk'
        ]);
        
        Material::create([
            'material_type_id' => 1, //skd
            'code' => 'tiu1',
            'title' => 'SKD Teks TIU',
            'description' => 'Deskripsi Materi',
            'type' => 'teks',
            'group' => 'tiu'
        ]);

        Material::create([
            'material_type_id' => 1, //skd
            'code' => 'tkp1',
            'title' => 'SKD Teks TKP',
            'description' => 'Deskripsi Materi',
            'type' => 'teks',
            'group' => 'tkp'
        ]);

        Material::create([
            'material_type_id' => 1, //skd
            'code' => 'twk2',
            'title' => 'SKD Video TWK',
            'description' => 'Deskripsi Materi',
            'type' => 'video',
            'group' => 'twk'
        ]);
        
        Material::create([
            'material_type_id' => 1, //skd
            'code' => 'tiu2',
            'title' => 'SKD Video TIU',
            'description' => 'Deskripsi Materi',
            'type' => 'video',
            'group' => 'tiu'
        ]);

        Material::create([
            'material_type_id' => 1, //skd
            'code' => 'tkp2',
            'title' => 'SKD Video TKP',
            'description' => 'Deskripsi Materi',
            'type' => 'video',
            'group' => 'tkp'
        ]);
    }
}
