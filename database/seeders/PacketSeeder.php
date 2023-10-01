<?php

namespace Database\Seeders;

use App\Models\Packet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PacketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Packet::create([
            'role_id' => 1,
            'name' => 'Packet Mandiri 1',
            'price_not_discount' => 100000,
            'price_discount' => 90000,
            'discount' => 10,
            'description' => 'Packet Mandiri 1',
            'benefits' => json_encode([
                'benefit 1',
                'benefit 2',
                'benefit 3',
            ]),
            'icon' => null,
            'type' => 'mandiri'
        ]);
        Packet::create([
            'role_id' => 1,
            'name' => 'Packet Bimbel 1',
            'price_not_discount' => 100000,
            'price_discount' => 80000,
            'discount' => 20,
            'description' => 'Packet Bimbel 1',
            'benefits' => json_encode([
                'benefit 1',
                'benefit 2',
                'benefit 3',
            ]),
            'icon' => null,
            'type' => 'bimbel'
        ]);
    }
}
