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
            'video_type_id' => 1,
            'name' => 'Video 1',
            'description' => 'Video 1',
            'link' => 'https://youtu.be/dQw4w9WgXcQ?si=HJBWrvmuOeHtUaZY',
        ]);
    }
}
