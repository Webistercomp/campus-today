<?php

namespace Database\Seeders;

use App\Models\Chapter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Chapter::create([
            'material_id' => 1,
            'judul' => 'Bab 1',
            'subjudul' => 'Subjudul',
            'body' => 'Lorem ipsum dolor sit amet'
        ]);
        Chapter::create([
            'material_id' => 1,
            'judul' => 'Bab 2',
            'subjudul' => 'Subjudul',
            'body' => 'Lorem ipsum dolor sit amet'
        ]);
        Chapter::create([
            'material_id' => 1,
            'judul' => 'Bab 3',
            'subjudul' => 'Subjudul',
            'body' => 'Lorem ipsum dolor sit amet'
        ]);
    }
}
