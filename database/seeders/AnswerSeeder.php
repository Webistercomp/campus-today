<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = Question::all();
        foreach($questions as $question) {
            $correct_answer = rand(0, 4);
            for($i=0; $i<4; $i++) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer' => 'Jawaban ' . $i,
                    'is_correct' => ($correct_answer == $i ? true : false),
                ]); 
            }
        }
    }
}
