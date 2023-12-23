<?php

namespace App\Http\Controllers;

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
        return Inertia::render('MinatBakat/TesAnalogiVerbal', ['title' => 'Tes Analogi Verbal']);
    }

    function epps() {
        return Inertia::render('MinatBakat/EPPS', ['title' => 'EPPS']);
    }

    function tesmtk() {
        return Inertia::render('MinatBakat/TesMatematika', ['title' => 'Tes Matematika']);
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
