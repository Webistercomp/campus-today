<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\GroupType;
use App\Models\Latihan;
use App\Models\LatihanAnswer;
use App\Models\LatihanQuestion;
use App\Models\Material;
use App\Models\MaterialType;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class LatihanController extends Controller
{
    function index(Request $request) {
        $latihans = Latihan::with('chapter.material')->get();
        $materials = Material::all();
        $chapters = Chapter::all();
        $chapterid = $request->chapterid;
        $active = $request->active;
        if($chapterid && $chapterid != 'all') {
            $latihans = $latihans->where('chapter_id', $chapterid);
        }
        if($active && $active != 'all') {
            $latihans = $latihans->where('active', $active);
        }
        foreach($latihans as $latihan) {
            $latihan->jumlah_soal = $latihan->questions->count();
        }
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        return view('admin.latihan.index', compact('latihans', 'user', 'menu', 'materials', 'chapters', 'chapterid', 'active'));
    }

    function create() {
        $materialTypes = MaterialType::all();
        $materials = Material::all();
        $chapters = Chapter::all();
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        $roles = Role::all();
        return view('admin.latihan.create', compact('user', 'menu', 'roles', 'materialTypes', 'materials', 'chapters'));
    }

    function store(Request $request) {
        $request->validate([
            'chapter_id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);
        $newLatihan = new Latihan();
        $newLatihan->chapter_id = $request->chapter_id;
        $newLatihan->name = $request->name;
        $newLatihan->description = $request->description;
        if(!$request->has('active')) {
            $newLatihan->active = 0;
        } else {
            $newLatihan->active = 1;
        }
        $newLatihan->save();
        return redirect()->route('admin.latihan.index');
    }
 
    function show($id) {
        $latihan = Latihan::with('questions')->find($id);
        $latihan->jumlah_soal = $latihan->questions->count();
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        return view('admin.latihan.show', compact('latihan', 'user', 'menu'));
    }
    
    function edit($id) {
        $latihan = Latihan::with('chapter.material')->find($id);
        $materialTypeID = $latihan->chapter->material->material_type_id ?? '';
        $materialID = $latihan->chapter->material_id ?? '';
        $chapterID = $latihan->chapter_id;
        $materialTypes = MaterialType::all();
        $materials = Material::all();
        $chapters = Chapter::all();
        $user = Auth::user();
        $groupTypes = GroupType::all();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];
        return view('admin.latihan.edit', compact('latihan', 'user', 'menu', 'materialTypes', 'materials', 'chapters', 'materialTypeID', 'materialID', 'chapterID', 'groupTypes'));
    }

    function update(Request $request, $id) {
        $request->validate([
            'chapter_id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);
        $latihan = Latihan::find($id);
        $latihan->chapter_id = $request->chapter_id;
        $latihan->name = $request->name;
        $latihan->description = $request->description;
        if(!$request->has('active')) {
            $latihan->active = 0;
        } else {
            $latihan->active = 1;
        }
        $latihan->save();
        return redirect()->route('admin.latihan.show', $id);
    }

    function destroy($id) {
        $latihan = Latihan::find($id);
        $latihan->delete();
        return redirect()->route('admin.latihan.index');
    }

    function updateQuestion(Request $request)
    { // bobot is still not yet developed
        // dd($request);
        $request->validate([
            'question_id' => 'required',
            'question' => 'required',
            'answers' => 'required',
        ]);
        $latihan = Latihan::find($request->latihan_id);
        // dd($latihan, $request->latihan_id);
        if (str_contains($request->question_id, "new")) {
            $newQuestion = new LatihanQuestion();
            $newQuestion->latihan_id = $request->latihan_id;
            $newQuestion->group_type_id = $request->group_type;
            $newQuestion->question = $request->question;
            $newQuestion->pembahasan = $request->pembahasan;
            $newQuestion->save();
            $lastQuestionId = $newQuestion->id;
            $index = 0;
            foreach ($request->answers as $answer) {
                $newAnswer = new LatihanAnswer();
                $newAnswer->latihan_question_id = $lastQuestionId;
                $newAnswer->answer = $answer;
                $newAnswer->bobot = (int) $request->bobot[$index];
                $newAnswer->save();
                $index++;
            }
            return redirect()->route('admin.latihan.edit', $request->latihan_id);
        } else {
            $question = LatihanQuestion::find($request->question_id);
            $question->question = $request->question;
            $question->pembahasan = $request->pembahasan;
            $question->group_type_id = $request->group_type;
            $question->save();
            if ($question->answers->count() < count($request->answers)) {
                for ($i = 0; $i < $question->answers->count(); $i++) {
                    $answer = $question->answers[$i];
                    $answer->answer = $request->answers[$i];
                    $answer->save();
                }
                for ($i = $question->answers->count(); $i < count($request->answers); $i++) {
                    $answer = new LatihanAnswer();
                    $answer->latihan_question_id = $question->id;
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
            return redirect()->route('admin.latihan.edit', $request->latihan_id);
        }
    }

    function deleteQuestion($question_id)
    {
        $question = LatihanQuestion::find($question_id);
        foreach ($question->answers as $answer) {
            $answer->delete();
        }
        $question->delete();
        $latihan = Latihan::find($question->latihan_id);
        return redirect()->route('admin.latihan.edit', $question->latihan_id);
    }
}
