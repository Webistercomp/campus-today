<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\GroupType;
use App\Models\MaterialType;
use App\Models\Question;
use App\Models\Role;
use App\Models\Tryout;
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
        $newTryout->group_id = $request->group_id;
        $newTryout->roles = $request->roles;
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
        $tryout = Tryout::find($id);

        $tryout->update($request->all());
        return redirect()->route('admin.tryout.index');
    }

    function delete($id)
    {
        $tryout = Tryout::find($id);
        $tryout->delete();
        return redirect()->route('admin.tryout.index');
    }

    function updateQuestion(Request $request)
    {
        $request->validate([
            'question_id' => 'required',
            'question' => 'required',
            'answers' => 'required',
        ]);
        if (str_contains($request->question_id, "new")) {
            $newQuestion = new Question();
            $newQuestion->tryout_id = $request->tryout_id;
            $newQuestion->group_type_id = $request->group_type;
            $newQuestion->question = $request->question;
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
            return redirect()->route('admin.tryout.edit', $request->tryout_id);
        } else {
            $question = Question::find($request->question_id);
            $question->question = $request->question;
            $question->group_type_id = $request->group_type;
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
            return redirect()->route('admin.tryout.edit', $question->tryout_id);
        }
    }

    function deleteQuestion($question_id)
    {
        $question = Question::find($question_id);
        foreach ($question->answers as $answer) {
            $answer->delete();
        }
        $question->delete();
        return redirect()->route('admin.tryout.edit', $question->tryout_id);
    }
}
