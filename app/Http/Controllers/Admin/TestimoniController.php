<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonis = Testimoni::all();
        $user = Auth::user();
        $menu = 'testimoni';
        return view('admin.testimoni.index', compact('testimonis', 'user', 'menu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $menu = 'testimoni';
        return view('admin.testimoni.create', compact('user', 'menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $testimoni = new Testimoni();
        $testimoni->name = $request->name;
        $testimoni->testimoni = $request->testimoni;
        $testimoni->institusi_sebelumnya = $request->institusi_sebelumnya;
        $testimoni->institusi_sekarang = $request->institusi_sekarang;
        if($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('storage/testimoni/photo'), $photo_name);
            $testimoni->photo = $photo_name;
        }
        if($request->active == 'on') {
            $testimoni->active = true;
        } else {
            $testimoni->active = false;
        }
        $testimoni->save();
        return redirect()->route('admin.testimoni.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimoni $testimoni)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $testimoni = Testimoni::find($id);
        $testimoni->photo = asset('storage/testimoni/photo/' . $testimoni->photo);
        $user = Auth::user();
        $menu = 'testimoni';
        return view('admin.testimoni.edit', compact('testimoni', 'user', 'menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $testimoni = Testimoni::find($id);
        $testimoni->name = $request->name;
        $testimoni->testimoni = $request->testimoni;
        $testimoni->institusi_sebelumnya = $request->institusi_sebelumnya;
        $testimoni->institusi_sekarang = $request->institusi_sekarang;
        if($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('storage/testimoni/photo'), $photo_name);
            $testimoni->photo = $photo_name;
        }
        if($request->active == 'on') {
            $testimoni->active = true;
        } else {
            $testimoni->active = false;
        }
        $testimoni->save();
        return redirect()->route('admin.testimoni.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimoni $testimoni)
    {
        //
    }
}
