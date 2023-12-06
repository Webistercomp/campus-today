<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function index() {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    function show($id) {
        $user = Auth::user();
        $selectedUser = User::find($id);
        return view('admin.user.show', compact('user', 'selectedUser'));
    }

    function edit($id) {
        $user = Auth::user();
        $selectedUser = User::find($id);
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'selectedUser', 'roles'));
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
