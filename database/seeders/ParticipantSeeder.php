<?php

namespace Database\Seeders;

use App\Models\Participant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Participant::create([
            'event_try_out_id' => 1,
            'user_id' => 1,
            'score1' => 0,
            'score2' => 0,
            'score3' => 0,
            'final_score' => 0,
            'status' => 'lulus'
        ]);
    }
}
