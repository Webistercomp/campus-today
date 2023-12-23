<?php

namespace Database\Seeders;

use App\Models\LatihanAnswer;
use App\Models\LatihanQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LatihanAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $latihanQuestions = LatihanQuestion::all();
        foreach($latihanQuestions as $question) {
            for($i=0; $i<5; $i++) {
                LatihanAnswer::create([
                    'latihan_question_id' => $question->id,
                    'answer' => 'Jawaban ' . ($i+1),
                    'bobot' => ($i == 0 ? 1 : 0)
                ]);
            }
        }
    }
}
