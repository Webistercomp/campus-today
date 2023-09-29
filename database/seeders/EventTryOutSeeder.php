<?php

namespace Database\Seeders;

use App\Models\EventTryOut;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventTryOutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EventTryOut::create([
            'name' => 'Try Out 1',
            'description' => 'Try Out 1',
            'datetime' => '2021-08-01 08:00:00',
            'time' => 120,
        ]);
    }
}
