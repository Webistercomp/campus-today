<?php

namespace Database\Seeders;

use App\Models\MinatBakat;
use App\Models\MinatBakatQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MinatBakatQuestionSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        // Tes Analogi Verbal
        MinatBakatQuestion::create([
            'minat_bakat_id' => 1,
            'question' => "Mobil – Bensin = Pelari – ...",
        ]);
        MinatBakatQuestion::create([
            'minat_bakat_id' => 1,
            'question' => "Dingin – Selimut = Hujan – ...",
        ]);
        MinatBakatQuestion::create([
            'minat_bakat_id' => 1,
            'question' => "Semir – Sepatu = Sikat – ...",
        ]);
        MinatBakatQuestion::create([
            'minat_bakat_id' => 1,
            'question' => "Kepala – Pusing = Perut – ...",
        ]);
        MinatBakatQuestion::create([
            'minat_bakat_id' => 1,
            'question' => "Bugil – Pakaian = Gundul – ...",
        ]);

        // Tes EPPS
        MinatBakatQuestion::create([
            'minat_bakat_id' => 2,
            'question' => "1",
        ]);
        MinatBakatQuestion::create([
            'minat_bakat_id' => 2,
            'question' => "2",
        ]);
        MinatBakatQuestion::create([
            'minat_bakat_id' => 2,
            'question' => "3",
        ]);
        MinatBakatQuestion::create([
            'minat_bakat_id' => 2,
            'question' => "4",
        ]);
        MinatBakatQuestion::create([
            'minat_bakat_id' => 2,
            'question' => "5",
        ]);

        // Tes Matematika
        MinatBakatQuestion::create([
            'minat_bakat_id' => 3,
            'question' => "3 X 4 = ",
        ]);
        MinatBakatQuestion::create([
            'minat_bakat_id' => 3,
            'question' => "4 X 5 = ",
        ]);
        MinatBakatQuestion::create([
            'minat_bakat_id' => 3,
            'question' => "3 X 8 = ",
        ]);
        MinatBakatQuestion::create([
            'minat_bakat_id' => 3,
            'question' => "1 X 4 = ",
        ]);
        MinatBakatQuestion::create([
            'minat_bakat_id' => 3,
            'question' => "100 X 9 = ",
        ]);
    }
}
