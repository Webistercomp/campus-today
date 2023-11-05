<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = Material::all();
        foreach($materials as $material) {
            for($i = 1; $i <= 3; $i++) {
                Chapter::create([
                    'material_id' => $material->id,
                    'judul' => $material->title . ' Bab ' . $i,
                    'subjudul' => 'Subjudul',
                    'body' => 'Lorem ipsum dolor sit amet'
                ]);
            }
        }
    }
}
