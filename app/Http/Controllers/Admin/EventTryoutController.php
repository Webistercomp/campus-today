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

class EventTryoutController extends Controller
{
    function index() {
        $tryouts = Tryout::where('is_event', 1)->get();
        foreach($tryouts as $tryout) {
            $roles = '';
            foreach(json_decode($tryout->roles) as $role) {
                $roles .= Role::find($role)->name . ', ';
            }
            $tryout->roles = substr($roles, 0, -2);
        }
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        foreach($tryouts as $tryout) {
            $tryout->jumlah_soal = $tryout->questions()->count();
        }
        return view('admin.event.index', compact('tryouts', 'user', 'menu'));
    }

    function create() {
        $materialTypes = MaterialType::all();
        $groups = GroupType::all();
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        $roles = Role::all();
        return view('admin.event.create', compact('user', 'menu', 'roles', 'materialTypes', 'groups'));
    }

    function store(Request $request) {
        $request->validate([
            'material_type_id' => 'required',
            'roles' => 'required', 
            'name' => 'required',
            'code' => 'required',
            'description' => 'required',
            'start_datetime' => 'required',
            'end_datetime' => 'required',
            'time' => 'required',
        ]);
        $newTryout = new Tryout();
        $newTryout->material_type_id = $request->material_type_id;
        $roles = explode(',', $request->roles);
        for($i = 0; $i < count($roles); $i++) {
            $roles[$i] = intval($roles[$i]);
        }
        $newTryout->roles = json_encode($roles);
        $newTryout->name = $request->name;
        $newTryout->code = $request->code;
        $newTryout->description = $request->description;
        $newTryout->time = $request->time;
        $newTryout->start_datetime = $request->start_datetime;
        $newTryout->end_datetime = $request->end_datetime;
        $newTryout->is_event = 1;
        if($request->has('active')) {
            $newTryout->active = 1;
        } else {
            $newTryout->active = 0;
        }
        $newTryout->save();
        return redirect()->route('admin.event.index');
    }
    
    function show($id) {
        $tryout = Tryout::find($id);
        $tryout->roles = implode(',', json_decode($tryout->roles));
        $tryout->jumlah_question = $tryout->questions()->count();
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        return view('admin.event.show', compact('tryout', 'user', 'menu'));
    }
    
    function edit($id) {
        $tryout = Tryout::find($id);
        $tryout->roles = implode(',', json_decode($tryout->roles));
        $materialTypes = MaterialType::all();
        $groupTypes = GroupType::all();
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        $roles = Role::all();
        return view('admin.event.edit', compact('tryout', 'user', 'menu', 'roles', 'materialTypes', 'groupTypes'));
    }

    function update(Request $request, $id) {
        $request->validate([
            'material_type_id' => 'required',
            'roles' => 'required', 
            'name' => 'required',
            'code' => 'required',
            'description' => 'required',
            'start_datetime' => 'required',
            'end_datetime' => 'required',
            'time' => 'required',
        ]);
        $tryout = Tryout::find($id);
        $tryout->material_type_id = $request->material_type_id;
        $tryout->roles = json_encode(explode(',', $request->roles));
        $tryout->name = $request->name;
        $tryout->code = $request->code;
        $tryout->description = $request->description;
        $tryout->time = $request->time;
        $tryout->start_datetime = $request->start_datetime;
        $tryout->end_datetime = $request->end_datetime;
        $tryout->is_event = 1;
        if($request->has('active')) {
            $tryout->active = 1;
        } else {
            $tryout->active = 0;
        }
        $tryout->save();
        return redirect()->route('admin.event.index');
    }

    function destroy($id) {
        $tryout = Tryout::with('questions.answers')->find($id);
        foreach($tryout->questions as $question) {
            foreach($question->answers as $answer) {
                $answer->delete();
            }
            $question->delete();
        }
        $tryout->delete();
        return redirect()->route('admin.event.index');
    }
}
