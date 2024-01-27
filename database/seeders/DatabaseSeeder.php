<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DatabaseSeeder::call([
            RoleSeeder::class, // permanent
            UserSeeder::class, 
            PacketSeeder::class, // permanent
            GroupTypeSeeder::class, // permanent
            TryoutSeeder::class,
            MaterialTypeSeeder::class,
            QuestionSeeder::class,
            AnswerSeeder::class,
            MaterialSeeder::class,
            ChapterSeeder::class,
            ArticleSeeder::class,
            InstagramFeedSeeder::class,
            LatihanSeeder::class,
            LatihanQuestionSeeder::class,
            LatihanAnswerSeeder::class,
            MinatBakatSeeder::class,
            MinatBakatQuestionSeeder::class,
            MinatBakatAnswerSeeder::class,
        ]);
    }
}
