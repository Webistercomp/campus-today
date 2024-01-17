<?php

namespace Database\Seeders;

use App\Models\Latihan;
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
        $tryouts = Tryout::with('materialType')->get();
        foreach($tryouts as $tryout) {
            if($tryout->materialType->code == "um" || $tryout->materialType->code == "utbk") {
                for($i=0; $i<5; $i++) {
                    Question::create([
                        'tryout_id' => $tryout->id,
                        'group_type_id' => rand(1,4),
                        'question' => 'Question ' . $i,
                        'pembahasan' => 'Pembahasan ' . $i,
                    ]);
                }
            } else if($tryout->materialType->code == "skd" || $tryout->materialType->code == "skb"){
                for($i=0; $i<5; $i++) {
                    Question::create([
                        'tryout_id' => $tryout->id,
                        'group_type_id' => rand(5,7),
                        'question' => 'Question ' . $i,
                        'pembahasan' => 'Pembahasan ' . $i,
                    ]);
                }
            } else {

            }
        }

        $latihans = Latihan::with('materialType')->get();
        foreach($latihans as $latihan) {
            if($latihan->materialType->code == "um" || $latihan->materialType->code == "utbk") {
                for($i=0; $i<5; $i++) {
                    Question::create([
                        'tryout_id' => $latihan->id,
                        'group_type_id' => rand(1,4),
                        'question' => 'Question ' . $i,
                        'pembahasan' => 'Pembahasan ' . $i,
                    ]);
                }
            } else if($latihan->materialType->code == "skd" || $latihan->materialType->code == "skb"){
                for($i=0; $i<5; $i++) {
                    Question::create([
                        'tryout_id' => $latihan->id,
                        'group_type_id' => rand(5,7),
                        'question' => 'Question ' . $i,
                        'pembahasan' => 'Pembahasan ' . $i,
                    ]);
                }
            } else {

            }
        }
    }
}
