<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\MaterialType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MaterialSKDController extends Controller
{
    function index() {
        return Inertia::render('Materi/SKD/Index');
    }

    function teks() {
        return Inertia::render('Materi/SKD/Teks');
    }

    function teks_show($id) {
        $chapter = Chapter::with('material')->find($id);
        return Inertia::render('Materi/SKD/TeksShow', [
            'chapter' => $chapter
        ]);
    }
    
    function video() {
        return Inertia::render('Materi/SKD/Video');
    }

    function video_show($id) {
        $chapter = Chapter::with('material')->find($id);
        return Inertia::render('Materi/SKD/VideoShow', [
            'chapter' => $chapter
        ]);
    }
}
