<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\PacketMandiri;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DatabaseSeeder::call([
            RoleSeeder::class,
            UserSeeder::class,
            PacketSeeder::class,
            TryoutSeeder::class,
            QuestionSeeder::class,
            AnswerSeeder::class,
            MaterialTypeSeeder::class,
            MaterialSeeder::class,
            ChapterSeeder::class,
            VideoTypeSeeder::class,
            VideoSeeder::class,
            ScheduleBimbelSeeder::class,
            EventTryOutSeeder::class,
            ParticipantSeeder::class,
            ArticleSeeder::class,
            InstagramFeedSeeder::class,
        ]);
    }
}
