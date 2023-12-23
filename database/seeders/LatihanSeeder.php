<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\GroupType;
use App\Models\Latihan;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chapters = Chapter::all();
        foreach($chapters as $chapter) {
            Latihan::create([
                'chapter_id' => $chapter->id,
                'name' => 'Latihan ' . $chapter->judul,
                'description' => 'Latihan ' . $chapter->subjudul,
                'active' => 1,
            ]);
        }
    }
}
