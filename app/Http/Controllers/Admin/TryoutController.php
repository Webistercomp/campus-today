<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroupType;
use App\Models\MaterialType;
use App\Models\Role;
use App\Models\Tryout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class TryoutController extends Controller
{
    function index() {
        $tryouts = Tryout::all();
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        foreach($tryouts as $tryout) {
            $tryout->jumlah_soal = $tryout->questions()->count();
        }
        return view('admin.tryout.index', compact('tryouts', 'user', 'menu'));
    }
    
    function show($id) {
        $tryout = Tryout::find($id);
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        return view('admin.tryout.show', compact('tryout', 'user', 'menu'));
    }
    
    function edit($id) {
        $tryout = Tryout::find($id);
        $materialTypes = MaterialType::all();
        $groups = GroupType::all();
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        $roles = Role::all();
        return view('admin.tryout.edit', compact('tryout', 'user', 'menu', 'roles', 'materialTypes', 'groups'));
    }

    function update(Request $request, $id) {
        $tryout = Tryout::find($id);
        
        $tryout->update($request->all());
        return redirect()->route('admin.tryout.index');
    }

    function delete($id) {
        $tryout = Tryout::find($id);
        $tryout->delete();
        return redirect()->route('admin.tryout.index');
    }
}
