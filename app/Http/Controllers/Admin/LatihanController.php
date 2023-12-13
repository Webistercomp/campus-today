<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroupType;
use App\Models\Latihan;
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

    function show($id) {
        $latihan = Latihan::find($id);
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        return view('admin.latihan.show', compact('latihan', 'user', 'menu'));
    }
    
    function edit($id) {
        $latihan = Latihan::find($id);
        $materialTypes = MaterialType::all();
        $groups = GroupType::all();
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        $roles = Role::all();
        return view('admin.latihan.edit', compact('latihan', 'user', 'menu', 'roles', 'materialTypes', 'groups'));
    }

    function update(Request $request, $id) {
        $latihan = Latihan::find($id);
        
        $latihan->update($request->all());
        return redirect()->route('admin.latihan.index');
    }

    function destroy($id) {
        $latihan = Latihan::find($id);
        $latihan->delete();
        return redirect()->route('admin.latihan.index');
    }
}
