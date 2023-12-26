<?php

namespace App\Http\Controllers;

use App\Models\MinatBakat;
use App\Models\MinatBakatAnswer;
use App\Models\Wartegg;
use App\Models\WarteggTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class MinatBakatController extends Controller {
    function index() {
        return Inertia::render('MinatBakat/Index', ['title' => 'Tes Minat Bakat']);
    }

    function teskoran() {
        return Inertia::render('MinatBakat/TesKoran', ['title' => 'Tes Koran']);
    }

    function teswartegg() {
        return Inertia::render('MinatBakat/TesWartegg', ['title' => 'Tes Wartegg']);
    }

    function tav() {
        $tav = MinatBakat::with('minatBakatQuestions.minatBakatAnswer')->where('type', 'tav')->get()[0];
        return Inertia::render('MinatBakat/TesAnalogiVerbal', ['title' => 'Tes Analogi Verbal', 'data' => $tav]);
    }

    function tavScoring(Request $request) {
        $tav = $request->data;
        $score = 0;
        $jumlah_benar = 0;
        $jumlah_salah = 0;
        $jumlah_kosong = 0;
        foreach ($tav['tav_data'] as $data) {
            if ($data['answer_id'] == null) {
                $jumlah_kosong++;
            } else {
                $answer = MinatBakatAnswer::find($data['answer_id']);
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
            'jumlah_kosong' => $jumlah_kosong
        ]);
    }

    function tavResult(Request $request) {
        $tav_result_data = $request->data['result'];
        $minatbakat = MinatBakat::find($request->data['minatbakat_id']);

        return Inertia::render('MinatBakat/ResultPage', ['title' => 'Hasil Tes Analogi Verbal', 'result' => $tav_result_data, 'minatbakat' => $minatbakat]);
    }

    function epps() {
        $epps = MinatBakat::with('minatBakatQuestions.minatBakatAnswer')->where('type', 'epps')->get()[0];
        return Inertia::render('MinatBakat/EPPS', ['title' => 'EPPS', 'data' => $epps]);
    }

    function eppsScoring(Request $request) {
        $epps = $request->data;
        $score = 0;
        $jumlah_benar = 0;
        $jumlah_salah = 0;
        $jumlah_kosong = 0;
        foreach ($epps['epps_data'] as $data) {
            if ($data['answer_id'] == null) {
                $jumlah_kosong++;
            } else {
                $answer = MinatBakatAnswer::find($data['answer_id']);
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
            'jumlah_kosong' => $jumlah_kosong
        ]);
    }

    function eppsResult(Request $request) {
        $epps_result_data = $request->data['result'];
        $minatbakat = MinatBakat::find($request->data['minatbakat_id']);

        return Inertia::render('MinatBakat/ResultPage', ['title' => 'Hasil Tes Analogi Verbal', 'result' => $epps_result_data, 'minatbakat' => $minatbakat]);
    }

    function tesmtk() {
        $mtk = MinatBakat::with('minatBakatQuestions.minatBakatAnswer')->where('type', 'mtk')->get()[0];
        return Inertia::render('MinatBakat/TesMatematika', ['title' => 'Tes Matematika', 'data' => $mtk]);
    }

    function tesmtkScoring(Request $request) {
        $tesmtk = $request->data;
        $score = 0;
        $jumlah_benar = 0;
        $jumlah_salah = 0;
        $jumlah_kosong = 0;
        foreach ($tesmtk['tesmtk_data'] as $data) {
            if ($data['answer_id'] == null) {
                $jumlah_kosong++;
            } else {
                $answer = MinatBakatAnswer::find($data['answer_id']);
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
            'jumlah_kosong' => $jumlah_kosong
        ]);
    }

    function tesmtkResult(Request $request) {
        $tesmtk_result = $request->data['result'];
        $minatbakat = MinatBakat::find($request->data['minatbakat_id']);

        return Inertia::render('MinatBakat/ResultPage', ['title' => 'Hasil Tes Analogi Verbal', 'result' => $tesmtk_result, 'minatbakat' => $minatbakat]);
    }

    function testWartegg() {
        $hasil_wartegg = Wartegg::where('user_id', Auth::id())->orderby('created_at', 'DESC')->first();

        if ($hasil_wartegg) return redirect(route('minatbakat.teswartegg.hasil'));

        return Inertia::render('MinatBakat/TesWartegg/Index', ['title' => 'Tes Wartegg']);
    }

    function storeTestWartegg(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        $path = storage_path('/app/public/images');
        !is_dir($path) && mkdir($path, 0777, true);

        $file = $request->file('image');
        $file->move($path, $file->getClientOriginalName());

        $img_url = asset('storage/images/' . $file->getClientOriginalName());

        $newWartegg = new Wartegg;
        $newWartegg->user_id = Auth::id();
        $newWartegg->filename = $file->getClientOriginalName();
        $newWartegg->img_url = $img_url;
        $newWartegg->status = 'pending';

        $newWartegg->save();

        return response()->json(['status' => 'success', 'msg' => 'Sukses menyimpan jawaban', 'img_url' => $img_url]);
    }

    function hasilTestWartegg() {
        $hasil_wartegg = Wartegg::where('user_id', Auth::id())->orderby('created_at', 'DESC')->first();

        return Inertia::render('MinatBakat/TesWartegg/Hasil', ['title' => 'Hasil Tes Wartegg', 'hasil_wartegg' => $hasil_wartegg]);
    }
}
