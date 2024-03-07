<?php

namespace App\Http\Controllers;

use App\Models\Latihan;
use App\Models\LatihanAnswer;
use App\Models\LatihanQuestion;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LatihanController extends Controller {
    function test($id) {
        $latihan = Latihan::with('questions.answers', 'chapter.material')->where('active', 1)->where('chapter_id', $id)->first();
        if(!$latihan || $latihan->questions->count() == 0) {
            return redirect()->back()->with('error', 'Latihan tidak ditemukan atau belum ada soal');
        }
        $user = Auth::user();
        for ($i = 0; $i < count($latihan->questions); $i++) {
            $latihan->questions[$i]->no = ($i + 1);
            $latihan->questions[$i]->jawaban = null;
        }
        $chapter = $latihan->chapter;
        $material = $chapter->material;
        $materialType = $material->materialType;
        
        return Inertia::render('Latihan/Index', [
            'title' => 'Latihan Soal',
            'user' => $user,
            'latihan' => $latihan,
            'chapter' => $chapter,
            'material' => $material,
            'materialType' => $materialType
        ]);
    }

    function result(Request $request) {
        $data = $request->data;
        return Inertia::render('Latihan/Result', [
            'title' => 'Latihan Selesai',
            'user' => Auth::user(),
            'latihan' => Latihan::with('questions.answers')->find($request->latihan_id),
            'jumlah_benar' => $data['jumlah_benar'],
            'jumlah_salah' => $data['jumlah_salah'],
            'jumlah_tidak_diisi' => $data['jumlah_tidak_diisi'],
            'latihan_user_data' => $data['latihan_user_data']
        ]);
    }

    function scoring(Request $request) {
        $request->validate([
            'latihan_id' => 'required',
            'user_id' => 'required',
            'latihan_data' => 'required',
        ]);
        $latihan = Latihan::with('questions.answers')->find($request->latihan_id);
        $score = 0;
        $jumlah_benar = 0;
        $jumlah_salah = 0;
        $jumlah_tidak_diisi = 0;
        foreach ($request->latihan_data as $data) {
            if ($data['answer_id'] == null) {
                $jumlah_tidak_diisi++;
            } else {
                $answer = LatihanAnswer::find($data['answer_id']);
                if ($answer->bobot == 0) {
                    $jumlah_salah++;
                } else {
                    $jumlah_benar++;
                    $score += $answer->bobot;
                }
            }
        }
        return response()->json([
            'score' => $score,
            'jumlah_benar' => $jumlah_benar,
            'jumlah_salah' => $jumlah_salah,
            'jumlah_tidak_diisi' => $jumlah_tidak_diisi,
            'latihan_user_data' => $request->latihan_data,
        ]);
    }
}
