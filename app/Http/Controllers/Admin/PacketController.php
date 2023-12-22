<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Packet;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class PacketController extends Controller
{
    function index() {
        $packets = Packet::all();
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        return view('admin.packet.index', compact('packets', 'user', 'menu'));
    }

    function create() {
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        $roles = Role::all();
        return view('admin.packet.create', compact('user', 'menu', 'roles'));
    }

    function store(Request $request) {
        $packet = new Packet();
        $packet->role_id = $request->role_id;
        $packet->name = $request->name;
        $packet->price_not_discount = $request->price_not_discount;
        $packet->price_discount = $request->price_discount;
        $packet->discount = $request->discount;
        $packet->description = $request->description;
        $packet->type = $request->type;

        if($request->has('benefits_x') && $request->has('benefits_y')) {
            $benefits = ['x' => [], 'y' => []];
            $benefits['x'] = explode(',', $request->benefits_x);
            $benefits['y'] = explode(',', $request->benefits_y);
            $packet->benefits = json_encode($benefits);
        }

        if($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $request->file('icon')->storeAs('public/packet/icon', $filename);
            $packet->icon = $filename;
        }
        $packet->save();

        return redirect()->route('admin.packet.index');
    }

    function show($id) {
        $packet = Packet::find($id);
        $packet->benefits_x = json_decode($packet->benefits)->x;
        $packet->benefits_y = json_decode($packet->benefits)->y;
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        return view('admin.packet.show', compact('packet', 'user', 'menu'));
    }

    function edit($id) {
        $packet = Packet::find($id);
        $packet->benefits_x = join(',', json_decode($packet->benefits)->x);
        $packet->benefits_y = join(',', json_decode($packet->benefits)->y);
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        $roles = Role::all();
        return view('admin.packet.edit', compact('packet', 'user', 'menu', 'roles'));
    }

    function update(Request $request, $id) {
        $packet = Packet::find($id);
        $packet->name = $request->name;
        $packet->role_id = $request->role_id;
        $packet->price_not_discount = $request->price_not_discount;
        $packet->price_discount = $request->price_discount;
        $packet->discount = $request->discount;
        $packet->description = $request->description;
        $packet->type = $request->type;

        if($request->has('benefits_x') && $request->has('benefits_y')) {
            $benefits = ['x' => [], 'y' => []];
            $benefits['x'] = explode(',', $request->benefits_x);
            $benefits['y'] = explode(',', $request->benefits_y);
            $packet->benefits = json_encode($benefits);
        }

        if($request->hasFile('icon')) {
            if($packet->icon != null && Storage::exists('public/packet/icon/' . $packet->icon)) {
                Storage::delete('public/packet/icon/' . $packet->icon);
            }
            $file = $request->file('icon');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $request->file('icon')->storeAs('public/packet/icon', $filename);
            $packet->icon = $filename;
        }
        $packet->save();

        return redirect()->route('admin.packet.index');
    }

    function destroy($id) {
        $packet = Packet::find($id);
        if($packet->icon != null && Storage::exists('public/packet/icon/' . $packet->icon)) {
            Storage::delete('public/packet/icon/' . $packet->icon);
        }
        $packet->delete();

        return redirect()->route('admin.packet.index');
    }
}
