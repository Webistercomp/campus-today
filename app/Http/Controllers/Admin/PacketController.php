<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Packet;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class PacketController extends Controller
{
    function index() {
        $packets = Packet::all();
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        return view('admin.packet.index', compact('packets', 'user', 'menu'));
    }

    function show($id) {
        $packet = Packet::find($id);
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        return view('admin.packet.show', compact('packet', 'user', 'menu'));
    }

    function edit($id) {
        $packet = Packet::find($id);
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        $roles = Role::all();
        return view('admin.packet.edit', compact('packet', 'user', 'menu', 'roles'));
    }

    function update(Request $request, $id) {
        // dd($request);
        $packet = Packet::find($id);
        $packet->name = $request->name;
        $packet->role_id = $request->role_id;
        $packet->price_not_discount = $request->price_not_discount;
        $packet->price_discount = $request->price_discount;
        $packet->discount = $request->discount;
        $packet->description = $request->description;
        $packet->benefits = $request->benefits;
        $packet->icon = $request->icon;
        $packet->type = $request->type;
        $packet->save();

        return redirect()->route('admin.packet.index');
    }

    function destroy($id) {
        $packet = Packet::find($id);
        $packet->delete();

        return redirect()->route('admin.packet.index');
    }
}
