<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroupType;
use App\Models\Material;
use App\Models\MaterialType;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class MateriController extends Controller
{
    function index() {
        $materials = Material::all();
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        return view('admin.materi.index', compact('materials', 'user', 'menu'));
    }
    
    function show($id) {
        $material = Material::find($id);
        $material->totalChapter = $material->chapters->count();
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        return view('admin.materi.show', compact('material', 'user', 'menu'));
    }

    function edit($id) {
        $materialTypes = MaterialType::all();
        $material = Material::find($id);
        $groups = GroupType::all();
        $roles = Role::all();
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        return view('admin.materi.edit', compact('materialTypes', 'material', 'groups', 'roles', 'user', 'menu'));
    }

    function update(Request $request, $id) {
        $material = Material::find($id);
        $material->update($request->all());
        return redirect()->route('admin.materi.index');
    }

    function destroy($id) {
        $material = Material::find($id);
        $material->delete();
        return redirect()->route('admin.materi.index');
    }
}
