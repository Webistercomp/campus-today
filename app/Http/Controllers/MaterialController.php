<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\GroupType;
use App\Models\Material;
use App\Models\MaterialType;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MaterialController extends Controller
{
    function materialType($type)
    {
        if ($type == "videoseries") {
            return redirect()->route('material.type.video', $type);
        }
        $groups = GroupType::whereHas('materialType', function ($q) use ($type) {
            $q->where('code', $type);
        })->get();
        return Inertia::render('Materi/Type', [
            'title' => 'Materi',
            'type' => $type,
            'groups' => $groups
        ]);
    }

    function materialTeks($type)
    {
        $materials = Material::with('materialType', 'groupType')
            ->whereHas('materialType', function ($q) use ($type) {
                $q->where('code', $type);
            })
            ->where('type', 'teks')
            ->get();
        $material_type = MaterialType::where('code', $type)->first();
        $groupTypes = GroupType::where('material_type_id', $material_type->id)->get();
        return Inertia::render('Materi/Teks', [
            'title' => "Materi Teks " . strtoupper($type),
            'type' => $type,
            'materials' => $materials,
            'groupTypes' => $groupTypes
        ]);
    }

    function materialTeksSubtype($type, $materialcode, $id = null)
    {
        $role_user = Auth::user()->role;
        $material = Material::with('materialType')
            ->where('code', $materialcode)
            ->where('type', 'teks')
            ->first();
        $material_roles = json_decode($material->roles);
        if (!in_array($role_user->id, $material_roles) && $role_user->id != 7) {
            session()->flash('type', 'info');
            session()->flash('msg', 'Paket ada masih ' . Auth::user()->role->name . ', upgrade paket Anda untuk menikmati layanan lainnya');
            return redirect()->route('material.type.teks', $type);
        }
        $chapters = Chapter::where('material_id', $material->id)->get();
        if ($chapters->count() == 0) {
            session()->flash('type', 'info');
            session()->flash('msg', 'Mohon maaf, materi ini belum tersedia');
            return redirect()->back();
        }
        foreach ($chapters as $chapter) {
            if ($chapter->file) {
                $chapter->file = env('APP_URL') . '/storage/materi/file/' . $chapter->file;
            }
        }
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

    function materialVideo($type)
    {
        $materialType = MaterialType::where('code', $type)->first();
        $materials = Material::with('materialType', 'groupType')
            ->whereHas('materialType', function ($q) use ($type) {
                $q->where('code', $type);
            })
            ->where('type', 'video')
            ->get();
        $groupTypes = GroupType::where('material_type_id', $materialType->id)->get();
        return Inertia::render('Materi/Video', [
            'title' => "Materi Video " . strtoupper($type),
            'type' => $type,
            'materialType' => $materialType,
            'materials' => $materials,
            'groupTypes' => $groupTypes
        ]);
    }

    function materialVideoSubtype($type, $materialcode, $id = null)
    {
        $role_user = Auth::user()->role;
        $material = Material::with('materialType')
            ->where('code', $materialcode)
            ->where('type', 'video')
            ->first();
        if ($material == null) {
            return abort(404);
        }
        $material_roles = json_decode($material->roles);
        if (!in_array($role_user->id, $material_roles) && $role_user->id != 7) {
            session()->flash('type', 'info');
            session()->flash('msg', 'Paket ada masih ' . Auth::user()->role->name . ', upgrade paket Anda untuk menikmati layanan lainnya');
            return redirect()->route('material.type.video', $type);
        }
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

        $chapter->link = asset("storage/materi/video/" . $chapter->link);

        return Inertia::render('Materi/VideoSubtype', [
            'type' => $type,
            'material' => $material,
            'chapters' => $chapters,
            'chapter' => $chapter,
            'nextChapter' => $nextChapter,
        ]);
    }

    function complete($materialid)
    {
        $user = Auth::user();
        $material = Material::with('materialType')->find($materialid);
        $materialType = $material->materialType;
        return Inertia::render('Materi/Completed', [
            'title' => 'Completed',
            'user' => $user,
            'material' => $material,
            'materialType' => $materialType,
        ]);
    }
}
