<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\GroupType;
use App\Models\MaterialType;
use App\Models\Question;
use App\Models\Role;
use App\Models\Tryout;
use App\Models\TryoutHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class TryoutController extends Controller
{
    function index()
    {
        $tryouts = Tryout::where('is_event', 0)->get();
        foreach ($tryouts as $tryout) {
            $roles = '';
            foreach (json_decode($tryout->roles) as $role) {
                $roles .= Role::find($role)->name . ', ';
            }
            $tryout->roles = substr($roles, 0, -2);
        }
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        foreach ($tryouts as $tryout) {
            $tryout->jumlah_soal = $tryout->questions()->count();
        }
        return view('admin.tryout.index', compact('tryouts', 'user', 'menu'));
    }

    function create()
    {
        $materialTypes = MaterialType::all();
        $groups = GroupType::all();
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        $roles = Role::all();
        return view('admin.tryout.create', compact('user', 'menu', 'roles', 'materialTypes', 'groups'));
    }

    function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'material_type_id' => 'required',
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
        $newTryout->time = $request->time;
        $newTryout->description = $request->description;
        $newTryout->is_event = 0;
        if (!$request->has('active')) {
            $newTryout->active = 0;
        }
        $newTryout->save();
        return redirect()->route('admin.tryout.index');
    }

    function show($id)
    {
        $tryout = Tryout::find($id);
        $roles = '';
        foreach (json_decode($tryout->roles) as $role) {
            $roles .= Role::find($role)->name . ', ';
        }
        $tryout->roles = substr($roles, 0, -2);
        $questions = Tryout::with('questions.answers')->find($id)->questions;
        $tryout->questions = $questions;
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        return view('admin.tryout.show', compact('tryout', 'user', 'menu'));
    }

    function edit($id)
    {
        $tryout = Tryout::find($id);
        $tryout->roles = implode(',', json_decode($tryout->roles));
        $materialTypes = MaterialType::all();
        $questions = Tryout::with('questions.answers')->find($id)->questions;
        $tryout->questions = $questions;
        $groupTypes = GroupType::all();
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        $roles = Role::all();
        return view('admin.tryout.edit', compact('tryout', 'user', 'menu', 'roles', 'materialTypes', 'groupTypes'));
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'material_type_id' => 'required',
        ]);
        $tryout = Tryout::find($id);
        $tryout->material_type_id = $request->material_type_id;
        $roles = explode(',', $request->roles);
        for($i = 0; $i < count($roles); $i++) {
            $roles[$i] = intval($roles[$i]);
        }
        $tryout->roles = json_encode($roles);
        $tryout->name = $request->name;
        $tryout->code = $request->code;
        $tryout->time = $request->time;
        $tryout->description = $request->description;
        if (!$request->has('active')) {
            $tryout->active = 0;
        } else {
            $tryout->active = 1;
        }
        $tryout->save();
        return redirect()->route('admin.tryout.edit', $id);
    }

    function delete($id)
    {
        $tryout = Tryout::find($id);
        $tryout->delete();
        return redirect()->route('admin.tryout.index');
    }

    function updateQuestion(Request $request)
    { // bobot is still not yet developed
        $request->validate([
            'question_id' => 'required',
            'question' => 'required',
            'answers' => 'required',
        ]);
        $tryout = Tryout::find($request->tryout_id);
        if (str_contains($request->question_id, "new")) {
            $newQuestion = new Question();
            $newQuestion->tryout_id = $request->tryout_id;
            $newQuestion->group_type_id = $request->group_type;
            $newQuestion->question = $request->question;
            $newQuestion->pembahasan = $request->pembahasan;
            $newQuestion->save();
            $lastQuestionId = $newQuestion->id;
            $index = 0;
            foreach ($request->answers as $answer) {
                $newAnswer = new Answer();
                $newAnswer->question_id = $lastQuestionId;
                $newAnswer->answer = $answer;
                $newAnswer->bobot = (int) $request->bobot[$index];
                $newAnswer->save();
                $index++;
            }
            if($tryout->is_event == 0) {
                return redirect()->route('admin.tryout.edit', $request->tryout_id);
            } else {
                return redirect()->route('admin.event.edit', $request->tryout_id);
            }
        } else {
            $question = Question::find($request->question_id);
            $question->question = $request->question;
            $question->group_type_id = $request->group_type;
            $question->pembahasan = $request->pembahasan;
            $question->save();
            if ($question->answers->count() < count($request->answers)) {
                for ($i = 0; $i < $question->answers->count(); $i++) {
                    $answer = $question->answers[$i];
                    $answer->answer = $request->answers[$i];
                    $answer->save();
                }
                for ($i = $question->answers->count(); $i < count($request->answers); $i++) {
                    $answer = new Answer();
                    $answer->question_id = $question->id;
                    $answer->answer = $request->answers[$i];
                    $answer->bobot = 1;
                    $answer->save();
                }
            } else if ($question->answers->count() > count($request->answers)) {
                for ($i = 0; $i < count($request->answers); $i++) {
                    $answer = $question->answers[$i];
                    $answer->answer = $request->answers[$i];
                    $answer->save();
                }
                for ($i = count($request->answers); $i < $question->answers->count(); $i++) {
                    $answer = $question->answers[$i];
                    $answer->delete();
                }
            } else {
                for ($i = 0; $i < count($request->answers); $i++) {
                    $answer = $question->answers[$i];
                    $answer->answer = $request->answers[$i];
                    $answer->bobot = (int) $request->bobot[$i];
                    $answer->save();
                }
            }
            if($tryout->is_event == 0) {
                return redirect()->route('admin.tryout.edit', $request->tryout_id);
            } else {
                return redirect()->route('admin.event.edit', $request->tryout_id);
            }
        }
    }

    function deleteQuestion($question_id)
    {
        $question = Question::find($question_id);
        foreach ($question->answers as $answer) {
            $answer->delete();
        }
        $question->delete();
        $tryout = Tryout::find($question->tryout_id);
        if($tryout->is_event == 0) {
            return redirect()->route('admin.tryout.edit', $question->tryout_id);
        } else {
            return redirect()->route('admin.event.edit', $question->tryout_id);
        }
    }

    function historyIndex() {
        $user = Auth::user();
        $menu = 'tryouthistory';
        $tryoutHistories = TryoutHistory::whereHas('tryout', function($query) {
            $query->where('is_event', 0);
        })->get();
        foreach($tryoutHistories as $tryoutHistory) {
            $start_tryout = Carbon::parse($tryoutHistory->start_timestamp);
            $end_tryout = Carbon::parse($tryoutHistory->end_timestamp);
            $tryoutHistory->duration = $start_tryout->diff($end_tryout)->format('%H:%I:%S');
        }
        return view('admin.tryouthistory.index', compact('user', 'menu', 'tryoutHistories'));
    }

    function historyShow($id) {
        $user = Auth::user();
        $menu = 'tryouthistory';
        $tryoutHistory = TryoutHistory::find($id);
        $start_tryout = Carbon::parse($tryoutHistory->start_timestamp);
        $end_tryout = Carbon::parse($tryoutHistory->end_timestamp);
        $tryoutHistory->duration = $start_tryout->diff($end_tryout)->format('%H:%I:%S');
        return view('admin.tryouthistory.show', compact('user', 'menu', 'tryoutHistory'));
    }
}
