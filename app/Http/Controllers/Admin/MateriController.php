<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\GroupType;
use App\Models\Material;
use App\Models\MaterialType;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class MateriController extends Controller
{
    function index(Request $request)
    {
        $materials = Material::with('chapters')->get();
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        $materialTypes = MaterialType::all();
        $groupTypes = GroupType::all();
        $tipemateri = $request->tipemateri;
        $grouptype = $request->grouptype;
        $tipepembelajaran = $request->tipepembelajaran;
        if($request->has('tipemateri') && $tipemateri != 'all') {
            $materials = $materials->where('material_type_id', $tipemateri);
        }
        if($request->has('grouptype') && $grouptype != 'all') {
            $materials = $materials->where('group_id', $grouptype);
        }
        if($request->has('tipepembelajaran') && $tipepembelajaran != 'all') {
            $materials = $materials->where('type', $tipepembelajaran);
        }
        foreach($materials as $materi) {
            $materi->jumlah_bab = $materi->chapters->count();
        }

        return view('admin.materi.index', compact('materials', 'user', 'menu', 'materialTypes', 'groupTypes', 'tipemateri', 'grouptype', 'tipepembelajaran'));
    }

    function create()
    {
        $materialTypes = MaterialType::all();
        $groups = GroupType::all();
        $roles = Role::all();
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        return view('admin.materi.create', compact('materialTypes', 'groups', 'roles', 'user', 'menu'));
    }

    function store(Request $request)
    {
        $request->validate([
            'material_type_id' => 'required',
            'group_id' => 'required',
            'roles' => 'required',
            'title' => 'required',
            'code' => 'required',
            'description' => '',
            'type' => 'required',
        ]);
        $newMaterial = new Material();
        $newMaterial->material_type_id = $request->material_type_id;
        $newMaterial->group_id = $request->group_id;
        $newMaterial->title = $request->title;
        $newMaterial->code = $request->code;
        $newMaterial->description = $request->description;
        $newMaterial->type = $request->type;
        $newMaterial->roles = json_encode(explode(',', $request->roles)); // roles = 1,2,3
        $newMaterial->save();
        return redirect()->route('admin.materi.index');
    }

    // function show($id)
    // {
    //     $material = Material::find($id);
    //     $material->totalChapter = $material->chapters->count();
    //     $roles = '';
    //     foreach (json_decode($material->roles) as $role) {
    //         $roles .= Role::find($role)->name . ', ';
    //     }
    //     $material->roles = substr($roles, 0, -2);
    //     $user = Auth::user();
    //     $menu = Route::getCurrentRoute()->getName();
    //     $menu = explode('.', $menu)[1];
    //     return view('admin.materi.show', compact('material', 'user', 'menu'));
    // }

    function edit($id)
    {
        $materialTypes = MaterialType::all();
        $material = Material::find($id);
        $material->roles = implode(',', json_decode($material->roles));
        $groups = GroupType::all();
        $roles = Role::all();
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        foreach($material->chapters as $chapter) {
            if($chapter->link != null) {
                $chapter->link = '/storage/materi/video/' . $chapter->link;
            }
        }
        return view('admin.materi.edit', compact('materialTypes', 'material', 'groups', 'roles', 'user', 'menu'));
    }

    function update(Request $request, $id)
    {
        $material = Material::find($id);
        $material->update($request->all());
        $material->roles = json_encode(explode(',', $request->roles));
        $material->save();
        return redirect()->route('admin.materi.index');
    }

    function destroy($id)
    {
        $material = Material::find($id);
        $chapters = Chapter::where('material_id', $material->id)->get();
        foreach($chapters as $chapter) {
            $chapter->delete();
        }
        $material->delete();
        return redirect()->route('admin.materi.index');
    }

    function getYoutubeEmbedUrl($url)
    {
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }

        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }
        return 'https://www.youtube.com/embed/' . $youtube_id;
    }

    function createChapter(Request $request)
    {
        $chapter = new Chapter();
        $chapter->material_id = $request->material_id;
        $chapter->judul = $request->judul;
        $chapter->subjudul = $request->subjudul;
        $chapter->body = $request->body;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/materi/file'), $filename);
            $chapter->file = $filename;
        }
        if ($request->link) {
            $url = $request->link;
            $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
            $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

            if (preg_match($longUrlRegex, $url, $matches)) {
                $youtube_id = $matches[count($matches) - 1];
            }

            if (preg_match($shortUrlRegex, $url, $matches)) {
                $youtube_id = $matches[count($matches) - 1];
            }
            $chapter->link = 'https://www.youtube.com/embed/' . $youtube_id ;
        } else {
            $chapter->link = null;
        }
        $chapter->save();

        return redirect()->route('admin.materi.edit', $request->material_id);
    }

    function updateChapter(Request $request, $id)
    {
        $chapter = Chapter::find($request->chapter_id);
        $chapter->judul = $request->judul;
        $chapter->subjudul = $request->subjudul;
        $chapter->body = $request->body;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/materi/file'), $fileName);

            // remove old file
            $oldFile = $chapter->file;
            if ($oldFile != null) {
                $oldFile = public_path('storage/materi/file') . '/' . $oldFile;
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }

            $chapter->file = $fileName;
        }
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $videoName = time() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('storage/materi/video'), $videoName);

            // remove old video
            $oldVideo = $chapter->link;
            if ($oldVideo != null) {
                $oldVideo = public_path('storage/materi/video') . '/' . $oldVideo;
                if (file_exists($oldVideo)) {
                    unlink($oldVideo);
                }
            }
            $chapter->link = $videoName;

            // $url = $request->link;
            // $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
            // $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

            // if (preg_match($longUrlRegex, $url, $matches)) {
            //     $youtube_id = $matches[count($matches) - 1];
            // }

            // if (preg_match($shortUrlRegex, $url, $matches)) {
            //     $youtube_id = $matches[count($matches) - 1];
            // }
            // $chapter->link = 'https://www.youtube.com/embed/' . $youtube_id;
        }
        $chapter->save();

        return redirect()->route('admin.materi.edit', $request->material_id);
    }

    function deleteChapter($id)
    {
        $chapter = Chapter::find($id);
        
        // remove file from db
        $oldFile = $chapter->file;
        if($oldFile != null) {
            $oldFile = public_path('storage/materi/file') . '/' . $oldFile;
            if(file_exists($oldFile)) {
                unlink($oldFile);
            }
        }
        $chapter->file = null;
        $chapter->delete();
        
        return redirect()->route('admin.materi.edit', $chapter->material_id);
    }

    function deleteChapterFile($id) {
        $chapter = Chapter::find($id);
        $oldFile = $chapter->file;
        if($oldFile != null) {
            $oldFile = public_path('storage/materi/file') . '/' . $oldFile;
            if(file_exists($oldFile)) {
                unlink($oldFile);
            }
        }
        $chapter->file = null;
        $chapter->save();
        
        return redirect()->route('admin.materi.edit', $chapter->material_id);
    }

    function deleteChapterVideo($id) {
        $chapter = Chapter::find($id);
        $chapter->link = null;
        $chapter->save();
        
        return redirect()->route('admin.materi.edit', $chapter->material_id);
    }
}
