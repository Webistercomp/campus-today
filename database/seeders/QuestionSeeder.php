<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Question::create([
            'tryout_id' => 1,
            'question' => 'What is the meaning of life?',
            'type' => 'twk'
        ]);
        Question::create([
            'tryout_id' => 1,
            'question' => 'Are you having existentialism crisis?',
            'type' => 'tiu'
        ]);
        Question::create([
            'tryout_id' => 1,
            'question' => 'Why are you doing all this?',
            'type' => 'tkp'
        ]);
    }
}
