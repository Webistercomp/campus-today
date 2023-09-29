<?php

namespace Database\Seeders;

use App\Models\VideoType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VideoType::create([
            'packet_id' => 1,
            'name' => 'Video Type 1',
            'description' => 'Video Type 1'
        ]);
    }
}
