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

    function create() {
        $materialTypes = MaterialType::all();
        $groups = GroupType::all();
        $roles = Role::all();
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        return view('admin.materi.create', compact('materialTypes', 'groups', 'roles', 'user', 'menu'));
    }

    function store(Request $request) {
        $request->validate([
            'material_type_id' => 'required',
            'group_id' => 'required',
            'roles' => 'required',
            'title' => 'required',
            'code' => 'required',
            'description' => 'required',
            'type' => 'required',
        ]);
        $newMaterial = new Material();
        $newMaterial->material_type_id = $request->material_type_id;
        $newMaterial->group_id = $request->group_id;
        $newMaterial->title = $request->title;
        $newMaterial->code = $request->code;
        $newMaterial->description = $request->description;
        $newMaterial->type = $request->type;
        $newMaterial->save();
        return redirect()->route('admin.materi.index');
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
