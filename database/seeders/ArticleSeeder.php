<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0; $i<5; $i++) {
            Article::create([
                'title' => 'Article ' . ($i + 1),
                'description' => 'Article ' . ($i + 1),
                'body' => 'The Body Content of Article ' . ($i + 1) . ', bla bla bla.',
                'active' => 1,
            ]);
        }
    }
}
