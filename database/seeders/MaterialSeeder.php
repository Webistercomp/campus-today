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
        // SKD
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

        // SKB
        Material::create([
            'material_type_id' => 2,
            'code' => 'twk3',
            'title' => 'SKB Teks TWK',
            'description' => 'Deskripsi Materi',
            'type' => 'teks',
            'group' => 'twk'
        ]);
        
        Material::create([
            'material_type_id' => 2,
            'code' => 'tiu3',
            'title' => 'SKB Teks TIU',
            'description' => 'Deskripsi Materi',
            'type' => 'teks',
            'group' => 'tiu'
        ]);

        Material::create([
            'material_type_id' => 2,
            'code' => 'tkp3',
            'title' => 'SKB Teks TKP',
            'description' => 'Deskripsi Materi',
            'type' => 'teks',
            'group' => 'tkp'
        ]);

        Material::create([
            'material_type_id' => 2,
            'code' => 'twk4',
            'title' => 'SKB Video TWK',
            'description' => 'Deskripsi Materi',
            'type' => 'video',
            'group' => 'twk'
        ]);
        
        Material::create([
            'material_type_id' => 2,
            'code' => 'tiu4',
            'title' => 'SKB Video TIU',
            'description' => 'Deskripsi Materi',
            'type' => 'video',
            'group' => 'tiu'
        ]);

        Material::create([
            'material_type_id' => 2,
            'code' => 'tkp4',
            'title' => 'SKB Video TKP',
            'description' => 'Deskripsi Materi',
            'type' => 'video',
            'group' => 'tkp'
        ]);
    }
}
