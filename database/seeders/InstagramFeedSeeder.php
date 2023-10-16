<?php

namespace Database\Seeders;

use App\Models\InstagramFeed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstagramFeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InstagramFeed::create([
            'link' => 'https://www.instagram.com/campus.today/',
        ]); 
    }
}
