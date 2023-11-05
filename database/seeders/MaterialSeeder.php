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
            'roles' => '[3,4,5,6]',
            'title' => 'Video Series SKD',
            'code' => 'vs1',
            'description' => 'Video Series SKD Description',
            'type' => 'video',
            'group' => 'vs'
        ]);
        Material::create([
            'material_type_id' => 1, 
            'roles' => '[3,4,5,6]',
            'title' => 'Video Series SKB',
            'code' => 'vs2',
            'description' => 'Video Series UM Description',
            'type' => 'video',
            'group' => 'vs'
        ]);
        Material::create([
            'material_type_id' => 1, 
            'roles' => '[3,4,5,6]',
            'title' => 'Video Series UM',
            'code' => 'vs3',
            'description' => 'Video Series UM',
            'type' => 'video',
            'group' => 'vs'
        ]);

        // SKD
        Material::create([
            'material_type_id' => 2, //skd
            'roles' => '[2,3,4,6]',
            'code' => 'twk1',
            'title' => 'SKD Teks TWK',
            'description' => 'Deskripsi Materi',
            'type' => 'teks',
            'group' => 'twk'
        ]);
        
        Material::create([
            'material_type_id' => 2, //skd
            'roles' => '[2,3,4,6]',
            'code' => 'tiu1',
            'title' => 'SKD Teks TIU',
            'description' => 'Deskripsi Materi',
            'type' => 'teks',
            'group' => 'tiu'
        ]);

        Material::create([
            'material_type_id' => 2, //skd
            'roles' => '[2,3,4,6]',
            'code' => 'tkp1',
            'title' => 'SKD Teks TKP',
            'description' => 'Deskripsi Materi',
            'type' => 'teks',
            'group' => 'tkp'
        ]);

        Material::create([
            'material_type_id' => 2, //skd
            'roles' => '[2,3,4,6]',
            'code' => 'twk2',
            'title' => 'SKD Video TWK',
            'description' => 'Deskripsi Materi',
            'type' => 'video',
            'group' => 'twk'
        ]);
        
        Material::create([
            'material_type_id' => 2, //skd
            'roles' => '[2,3,4,6]',
            'code' => 'tiu2',
            'title' => 'SKD Video TIU',
            'description' => 'Deskripsi Materi',
            'type' => 'video',
            'group' => 'tiu'
        ]);

        Material::create([
            'material_type_id' => 2, //skd
            'roles' => '[2,3,4,6]',
            'code' => 'tkp2',
            'title' => 'SKD Video TKP',
            'description' => 'Deskripsi Materi',
            'type' => 'video',
            'group' => 'tkp'
        ]);

        // SKB
        Material::create([
            'material_type_id' => 3, // skb
            'roles' => '[2,3,5,6]',
            'code' => 'twk3',
            'title' => 'SKB Teks TWK',
            'description' => 'Deskripsi Materi',
            'type' => 'teks',
            'group' => 'twk'
        ]);
        
        Material::create([
            'material_type_id' => 3,
            'roles' => '[2,3,5,6]',
            'code' => 'tiu3',
            'title' => 'SKB Teks TIU',
            'description' => 'Deskripsi Materi',
            'type' => 'teks',
            'group' => 'tiu'
        ]);

        Material::create([
            'material_type_id' => 3,
            'roles' => '[2,3,5,6]',
            'code' => 'tkp3',
            'title' => 'SKB Teks TKP',
            'description' => 'Deskripsi Materi',
            'type' => 'teks',
            'group' => 'tkp'
        ]);

        Material::create([
            'material_type_id' => 3,
            'roles' => '[2,3,5,6]',
            'code' => 'twk4',
            'title' => 'SKB Video TWK',
            'description' => 'Deskripsi Materi',
            'type' => 'video',
            'group' => 'twk'
        ]);
        
        Material::create([
            'material_type_id' => 3,
            'roles' => '[2,3,5,6]',
            'code' => 'tiu4',
            'title' => 'SKB Video TIU',
            'description' => 'Deskripsi Materi',
            'type' => 'video',
            'group' => 'tiu'
        ]);

        Material::create([
            'material_type_id' => 3,
            'roles' => '[2,3,5,6]',
            'code' => 'tkp4',
            'title' => 'SKB Video TKP',
            'description' => 'Deskripsi Materi',
            'type' => 'video',
            'group' => 'tkp'
        ]);
    }
}
