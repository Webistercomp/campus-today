<?php

namespace App\Http\Controllers;

use App\Models\Latihan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LatihanController extends Controller
{
    function test($id) {
        $latihan = Latihan::with('questions.answers')->find($id);
        for($i=0; $i<count($latihan->questions); $i++) {
            $latihan->questions[$i]->no = ($i + 1);
            $latihan->questions[$i]->jawaban = null;
        }
        // dd($latihan);

        return Inertia::render('Latihan/Index', [
            'title' => 'Latihan Soal', 
            'name' => 'Farhan Hikmatullah D',
            'latihan' => $latihan,
        ]);
    }

    function success() {
        return Inertia::render('Latihan/LatihanSuccess', [
            'title' => 'Latihan Selesai', 
            'name' => 'Farhan Hikmatullah D'
        ]);
    }

    function failed() {
        return Inertia::render('Latihan/LatihanFailed', [
            'title' => 'Latihan Selesai', 
            'name' => 'Farhan Hikmatullah D'
        ]);
    }
}
