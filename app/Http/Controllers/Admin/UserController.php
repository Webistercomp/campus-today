<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function index(Request $request) {
        $users = User::where('email_verified_at', '!=', null);
        if($request->has('role') && $request->role != 'all') {
            $users = $users->where('role_id', $request->role);
        }
        $users = $users->get();
        $menu = Route::currentRouteName();
        $menu = explode('.', $menu)[1];
        $user = Auth::user();
        $roles = Role::all();
        $requestroleid = $request->role;
        return view('admin.user.index', compact('users', 'menu', 'roles', 'user', 'requestroleid'));
    }

    function show($id) {
        $user = Auth::user();
        $selectedUser = User::find($id);
        $menu = Route::currentRouteName();
        $menu = explode('.', $menu)[1];
        return view('admin.user.show', compact('user', 'menu', 'selectedUser'));
    }

    function edit($id) {
        $user = Auth::user();
        $selectedUser = User::find($id);
        $roles = Role::all();
        $menu = Route::currentRouteName();
        $menu = explode('.', $menu)[1];
        return view('admin.user.edit', compact('user', 'menu', 'selectedUser', 'roles'));
    }

    function update(Request $request, $id) {
        $user = User::find($id);
        $user->update($request->all());
        return redirect()->route('admin.user.show', $id);
    }

    function destroy($id) {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.user.index');
    }
}
