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
            if($question->groupType->code == 'twk') {
                for($i=1; $i<=5; $i++) {
                    Answer::create([
                        'question_id' => $question->id,
                        'answer' => 'Jawaban ' . $i,
                        'bobot' => $i,
                    ]);
                } 
            } else if($question->groupType->code == 'tkp' || $question->groupType->code == 'tiu') {
                for($i=1; $i<=5; $i++) {
                    $correct_answer = rand(1,5);
                    Answer::create([
                        'question_id' => $question->id,
                        'answer' => 'Jawaban ' . $i,
                        'bobot' => ($correct_answer == $i ? 5 : 0),
                    ]);
                }
            } else {
                $correct_answer = rand(0, 3);
                for($i=0; $i<5; $i++) {
                    Answer::create([
                        'question_id' => $question->id,
                        'answer' => 'Jawaban ' . $i,
                        'bobot' => ($correct_answer == $i ? 1 : 0),
                    ]); 
                }
            }
        }
    }
}
