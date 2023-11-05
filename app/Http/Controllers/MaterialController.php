<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Material;
use App\Models\MaterialType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MaterialController extends Controller {
    function materialType($type) {
        if($type == "videoseries") {
            return redirect()->route('material.type.video', $type);
        }
        return Inertia::render('Materi/Type', [
            'title' => 'Materi',
            'type' => $type
        ]);
    }

    function materialTeks($type) {
        $materials = Material::with('materialType')
            ->whereHas('materialType', function ($q) use ($type) {
                $q->where('code', $type);
            })
            ->where('type', 'teks')
            ->get();
        return Inertia::render('Materi/Teks', [
            'title' => 'Judul',
            'type' => $type,
            'materials' => $materials,
        ]);
    }

    function materialTeksSubtype($type, $materialcode, $id = null) {
        $material = Material::with('materialType')
            ->where('code', $materialcode)
            ->where('type', 'teks')
            ->first();
        $chapters = Chapter::where('material_id', $material->id)->get();
        if ($id == null) {
            $chapter = $chapters[0];
            $nextChapter = $chapters[1] ?? null;
        } else {
            $chapterIndex = $chapters->search(function ($chapter) use ($id) {
                return $chapter->id == $id;
            });
            $chapter = $chapters[$chapterIndex];
            $nextChapter = $chapters[$chapterIndex + 1] ?? null;
            if (!$chapter) {
                return abort(404);
            } else if ($chapter->material_id != $material->id) {
                return abort(404);
            }
        }

        return Inertia::render('Materi/TeksSubtype', [
            'title' => $material->title,
            'type' => $type,
            'material' => $material,
            'chapters' => $chapters,
            'chapter' => $chapter,
            'nextChapter' => $nextChapter,
        ]);
    }

    function materialVideo($type) {
        $materialType = MaterialType::where('code', $type)->first();
        $materials = Material::with('materialType')
            ->whereHas('materialType', function ($q) use ($type) {
                $q->where('code', $type);
            })
            ->where('type', 'video')
            ->get();
        return Inertia::render('Materi/Video', [
            'title' => $materialType->name,
            'type' => $type,
            'materialType' => $materialType,
            'materials' => $materials
        ]);
    }

    function materialVideoSubtype($type, $materialcode, $id = null) {
        $material = Material::with('materialType')
            ->where('code', $materialcode)
            ->where('type', 'video')
            ->first();
        $chapters = Chapter::where('material_id', $material->id)->get();
        if ($id == null) {
            $chapter = $chapters[0];
            $nextChapter = $chapters[1] ?? null;
        } else {
            $chapterIndex = $chapters->search(function ($chapter) use ($id) {
                return $chapter->id == $id;
            });
            $chapter = $chapters[$chapterIndex];
            $nextChapter = $chapters[$chapterIndex + 1] ?? null;
            if (!$chapter) {
                return abort(404);
            } else if ($chapter->material_id != $material->id) {
                return abort(404);
            }
        }

        return Inertia::render('Materi/VideoSubtype', [
            'type' => $type,
            'material' => $material,
            'chapters' => $chapters,
            'chapter' => $chapter,
            'nextChapter' => $nextChapter,
        ]);
    }

    function complete($materialid) {
        $user = Auth::user();
        $material = Material::find($materialid);
        return Inertia::render('Materi/Completed', [
            'title' => 'Completed',
            'user' => $user,
            'material' => $material
        ]);
    }
}
