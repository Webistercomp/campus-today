<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Tryout;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tryouts = Tryout::all();
        foreach($tryouts as $tryout) {
            for($i=0; $i<5; $i++) {
                Question::create([
                    'tryout_id' => $tryout->id,
                    'question' => 'Question ' . $i,
                    'type' => $tryout->code,
                ]);
            }
        }
    }
}
