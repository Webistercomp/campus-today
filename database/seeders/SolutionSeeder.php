<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SolutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = Question::all();
        foreach ($questions as $question) {
            $question->solution()->create([
                'solution' => 'Pembahasan untuk soal dengan id ' . $question->id,
            ]);
        }
    }
}
