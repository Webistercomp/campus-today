<?php

namespace Database\Seeders;

use App\Models\MinatBakat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MinatBakatSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        //
        MinatBakat::create([
            'title' => 'Tes Analogi Verbal',
            'desc' => 'Penilaian Kepribadian',
            'type' => 'tav'
        ]);
        MinatBakat::create([
            'title' => 'EPPS',
            'desc' => 'Penilaian Kepribadian',
            'type' => 'epps'
        ]);
        MinatBakat::create([
            'title' => 'Tes Matematika',
            'desc' => 'Penilaian Kepribadian',
            'type' => 'mtk'
        ]);
    }
}
