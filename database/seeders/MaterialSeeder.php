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
        // Video Series
        Material::create([
            'material_type_id' => 1, 
            'group_id' => 1,
            'roles' => '[3,4,5,6]',
            'title' => 'Video Series Literasi Bahasa Indonesia',
            'code' => 'vs1',
            'description' => 'Video Series Literasi Bahasa Indonesia',
            'type' => 'video',
        ]);
        Material::create([
            'material_type_id' => 1, 
            'group_id' => 2,
            'roles' => '[3,4,5,6]',
            'title' => 'Video Series Literasi Bahasa Inggris',
            'code' => 'vs2',
            'description' => 'Video Series Literasi Bahasa Inggris',
            'type' => 'video',
        ]);
        Material::create([
            'material_type_id' => 1, 
            'group_id' => 5,
            'roles' => '[3,4,5,6]',
            'title' => 'Video Series Penalaran Umum',
            'code' => 'vs3',
            'description' => 'Video Series Penalaran Umum',
            'type' => 'video',
        ]);

        // SKD
        Material::create([
            'material_type_id' => 2, //skd
            'group_id' => 6,
            'roles' => '[2,3,4,6]',
            'code' => 'twk1',
            'title' => 'SKD Teks TWK',
            'description' => 'Deskripsi Materi',
            'type' => 'teks',
        ]);
        
        Material::create([
            'material_type_id' => 2, //skd
            'group_id' => 7,
            'roles' => '[2,3,4,6]',
            'code' => 'tiu1',
            'title' => 'SKD Teks TIU',
            'description' => 'Deskripsi Materi',
            'type' => 'teks',
        ]);

        Material::create([
            'material_type_id' => 2, //skd
            'group_id' => 8,
            'roles' => '[2,3,4,6]',
            'code' => 'tkp1',
            'title' => 'SKD Teks TKP',
            'description' => 'Deskripsi Materi',
            'type' => 'teks',
        ]);

        Material::create([
            'material_type_id' => 2, //skd
            'group_id' => 6,
            'roles' => '[2,3,4,6]',
            'code' => 'twk2',
            'title' => 'SKD Video TWK',
            'description' => 'Deskripsi Materi',
            'type' => 'video',
        ]);
        
        Material::create([
            'material_type_id' => 2, //skd
            'group_id' => 7,
            'roles' => '[2,3,4,6]',
            'code' => 'tiu2',
            'title' => 'SKD Video TIU',
            'description' => 'Deskripsi Materi',
            'type' => 'video',
        ]);

        Material::create([
            'material_type_id' => 2, //skd
            'group_id' => 8,
            'roles' => '[2,3,4,6]',
            'code' => 'tkp2',
            'title' => 'SKD Video TKP',
            'description' => 'Deskripsi Materi',
            'type' => 'video',
        ]);

        // SKB
        Material::create([
            'material_type_id' => 3, // skb
            'group_id' => 6,
            'roles' => '[2,3,5,6]',
            'code' => 'twk3',
            'title' => 'SKB Teks TWK',
            'description' => 'Deskripsi Materi',
            'type' => 'teks',
        ]);
        
        Material::create([
            'material_type_id' => 3,
            'group_id' => 7,
            'roles' => '[2,3,5,6]',
            'code' => 'tiu3',
            'title' => 'SKB Teks TIU',
            'description' => 'Deskripsi Materi',
            'type' => 'teks',
        ]);

        Material::create([
            'material_type_id' => 3,
            'group_id' => 8,
            'roles' => '[2,3,5,6]',
            'code' => 'tkp3',
            'title' => 'SKB Teks TKP',
            'description' => 'Deskripsi Materi',
            'type' => 'teks',
        ]);

        Material::create([
            'material_type_id' => 3,
            'group_id' => 6,
            'roles' => '[2,3,5,6]',
            'code' => 'twk4',
            'title' => 'SKB Video TWK',
            'description' => 'Deskripsi Materi',
            'type' => 'video',
        ]);
        
        Material::create([
            'material_type_id' => 3,
            'group_id' => 7,
            'roles' => '[2,3,5,6]',
            'code' => 'tiu4',
            'title' => 'SKB Video TIU',
            'description' => 'Deskripsi Materi',
            'type' => 'video',
        ]);

        Material::create([
            'material_type_id' => 3,
            'group_id' => 8,
            'roles' => '[2,3,5,6]',
            'code' => 'tkp4',
            'title' => 'SKB Video TKP',
            'description' => 'Deskripsi Materi',
            'type' => 'video',
        ]);
    }
}
