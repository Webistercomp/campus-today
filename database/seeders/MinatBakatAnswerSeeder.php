<?php

namespace Database\Seeders;

use App\Models\MinatBakatAnswer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MinatBakatAnswerSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        // Tes Analogi Verbal
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 1,
            'answer' => 'Makanan',
            'bobot' => 1,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 1,
            'answer' => 'Sepatu',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 1,
            'answer' => 'Kaos',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 1,
            'answer' => 'Lintasan',
            'bobot' => 0,
        ]);

        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 2,
            'answer' => 'Air',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 2,
            'answer' => 'Payung',
            'bobot' => 1,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 2,
            'answer' => 'Dingin',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 2,
            'answer' => 'Basah',
            'bobot' => 0,
        ]);

        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 3,
            'answer' => 'Kuku',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 3,
            'answer' => 'Rambut',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 3,
            'answer' => 'Televisi',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 3,
            'answer' => 'Gigi',
            'bobot' => 1,
        ]);

        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 4,
            'answer' => 'Batuk',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 4,
            'answer' => 'Pilek',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 4,
            'answer' => 'Mules',
            'bobot' => 1,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 4,
            'answer' => 'Gemuk',
            'bobot' => 0,
        ]);

        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 5,
            'answer' => 'Botak',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 5,
            'answer' => 'Kepala',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 5,
            'answer' => 'Cukup',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 5,
            'answer' => 'Rambut',
            'bobot' => 1,
        ]);

        // Tes EPPS
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 6,
            'answer' => 'Saya suka menolong teman-teman saya, bila mereka berada dalam kesulitan.',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 6,
            'answer' => 'Saya ingin melakukan pekerjaan apa saja sebaik mungkin.',
            'bobot' => 0,
        ]);

        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 7,
            'answer' => 'Saya ingin mengetahui bagaimana pandangan orang-orang besar mengenai berbagai masalah yang menarik perhatian saya.',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 7,
            'answer' => 'Saya ingin menjadi seorang ahli yang diakui dalam salah satu pekerjaan atau sedang khusus.',
            'bobot' => 0,
        ]);

        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 8,
            'answer' => 'Saya ingin agar setiap pekerjaan tulisan saya teliti, rapi, dan tersusun dengan baik.',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 8,
            'answer' => 'Saya ingin menjadi seorang ahli yang diakui dalam salah satu pekerjaan, jabatan atau bidang khusus.',
            'bobot' => 0,
        ]);

        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 9,
            'answer' => 'Saya suka menceritakan cerita-cerita lucu dan lelucon-lelucon waktu pesta.',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 9,
            'answer' => 'Saya ingin menulis roman atau sandiwara hebat.',
            'bobot' => 0,
        ]);

        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 10,
            'answer' => 'Saya ingin dapat berbuat sekehendak hati saya.',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 10,
            'answer' => 'Saya ingin bisa mengatakan bahwa saya telah melakukan dengan baik suatu.',
            'bobot' => 0,
        ]);

        // Tes Matematika
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 11,
            'answer' => '12',
            'bobot' => 1,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 11,
            'answer' => '8',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 11,
            'answer' => '6',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 11,
            'answer' => '20',
            'bobot' => 0,
        ]);

        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 12,
            'answer' => '12',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 12,
            'answer' => '8',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 12,
            'answer' => '20',
            'bobot' => 1,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 12,
            'answer' => '20',
            'bobot' => 0,
        ]);

        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 13,
            'answer' => '12',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 13,
            'answer' => '24',
            'bobot' => 1,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 13,
            'answer' => '20',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 13,
            'answer' => '20',
            'bobot' => 0,
        ]);

        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 14,
            'answer' => '12',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 14,
            'answer' => '24',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 14,
            'answer' => '20',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 14,
            'answer' => '4',
            'bobot' => 1,
        ]);

        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 15,
            'answer' => '900',
            'bobot' => 1,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 15,
            'answer' => '24',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 15,
            'answer' => '20',
            'bobot' => 0,
        ]);
        MinatBakatAnswer::create([
            'minat_bakat_question_id' => 15,
            'answer' => '4',
            'bobot' => 0,
        ]);
    }
}
