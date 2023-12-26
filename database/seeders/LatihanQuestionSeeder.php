<?php

namespace Database\Seeders;

use App\Models\Latihan;
use App\Models\LatihanQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LatihanQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $latihans = Latihan::all();
        foreach($latihans as $latihan) {
            for($i=0; $i<10; $i++) {
                LatihanQuestion::create([
                    'latihan_id' => $latihan->id,
                    'group_type_id' => null,
                    'question' => 'Soal ke-'.($i+1),
                    'pembahasan' => 'Pembahasan soal ke-'.($i+1).'.',
                ]);
            }
        }
    }
}
