<?php

namespace Database\Seeders;

use App\Models\PacketHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PacketHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PacketHistory::create([
            'packet_id' => 1,
            'user_id' => 1,
            'status' => 'pending',
            'expired_at' => '2022-12-31 23:59:59',
        ]);
    }
}
