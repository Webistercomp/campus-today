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
            'judul' => 'Judul 1',
            'subjudul' => 'Subjudul 1',
            'body' => 'Lorem ipsum dolor sit amet'
        ]);
        Chapter::create([
            'material_id' => 1,
            'judul' => 'Judul 2',
            'subjudul' => 'Subjudul 2',
            'body' => 'Lorem ipsum dolor sit amet'
        ]);
        Chapter::create([
            'material_id' => 1,
            'judul' => 'Judul 3',
            'subjudul' => 'Subjudul 3',
            'body' => 'Lorem ipsum dolor sit amet'
        ]);
    }
}
