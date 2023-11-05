<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Video::create([
            'material_type_id' => 1, //skd
            'roles' => '[3,4,5,6]',
            'name' => 'Video Series SKD',
            'description' => 'Video Series SKD Description',
            'link' => 'https://youtu.be/dQw4w9WgXcQ?si=HJBWrvmuOeHtUaZY',
        ]);
        Video::create([
            'material_type_id' => 1, //skd
            'roles' => '[3,4,5,6]',
            'name' => 'Video Series UM',
            'description' => 'Video Series UM Description',
            'link' => 'https://youtu.be/dQw4w9WgXcQ?si=HJBWrvmuOeHtUaZY',
        ]);
        Video::create([
            'material_type_id' => 2, //skd
            'roles' => '[2,3,4,6]',
            'name' => 'Video 1',
            'description' => 'Video 1',
            'link' => 'https://youtu.be/dQw4w9WgXcQ?si=HJBWrvmuOeHtUaZY',
        ]);
    }
}
