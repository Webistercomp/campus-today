<?php

namespace Database\Seeders;

use App\Models\ScheduleBimbel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleBimbelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ScheduleBimbel::create([
            'packet_id' => 2,
            'name' => 'Jadwal Paket Bimbel 1',
            'day' => json_encode(['senin', 'selasa', 'rabu', 'kamis', 'jumat']),
            'time' => json_encode(['08:00', '10:00', '13:00', '15:00', '17:00']),
        ]);
    }
}
