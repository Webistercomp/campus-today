<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\GroupType;
use App\Models\Latihan;
use App\Models\Material;
use App\Models\MaterialType;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class LatihanController extends Controller
{
    function index() {
        $latihans = Latihan::all();
        foreach($latihans as $latihan) {
            $latihan->jumlah_soal = $latihan->questions->count();
        }
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        return view('admin.latihan.index', compact('latihans', 'user', 'menu'));
    }

    function create() {
        $materialTypes = MaterialType::all();
        $materials = Material::all();
        $chapters = Chapter::all();
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        $roles = Role::all();
        return view('admin.latihan.create', compact('user', 'menu', 'roles', 'materialTypes', 'materials', 'chapters'));
    }

    function store(Request $request) {
        $request->validate([
            'chapter_id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);
        $newLatihan = new Latihan();
        $newLatihan->chapter_id = $request->chapter_id;
        $newLatihan->name = $request->name;
        $newLatihan->description = $request->description;
        if(!$request->has('active')) {
            $newLatihan->active = 0;
        } else {
            $newLatihan->active = 1;
        }
        $newLatihan->save();
        return redirect()->route('admin.latihan.index');
    }
 
    function show($id) {
        $latihan = Latihan::with('questions')->find($id);
        $latihan->jumlah_soal = $latihan->questions->count();
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        return view('admin.latihan.show', compact('latihan', 'user', 'menu'));
    }
    
    function edit($id) {
        $latihan = Latihan::with('chapter.material')->find($id);
        $materialTypeID = $latihan->chapter->material->material_type_id;
        $materialID = $latihan->chapter->material_id;
        $chapterID = $latihan->chapter_id;
        $materialTypes = MaterialType::all();
        $materials = Material::all();
        $chapters = Chapter::all();
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        return view('admin.latihan.edit', compact('latihan', 'user', 'menu', 'materialTypes', 'materials', 'chapters', 'materialTypeID', 'materialID', 'chapterID'));
    }

    function update(Request $request, $id) {
        $request->validate([
            'chapter_id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);
        $latihan = Latihan::find($id);
        $latihan->chapter_id = $request->chapter_id;
        $latihan->name = $request->name;
        $latihan->description = $request->description;
        if(!$request->has('active')) {
            $latihan->active = 0;
        } else {
            $latihan->active = 1;
        }
        $latihan->save();
        return redirect()->route('admin.latihan.show', $id);
    }

    function destroy($id) {
        $latihan = Latihan::find($id);
        $latihan->delete();
        return redirect()->route('admin.latihan.index');
    }
}
