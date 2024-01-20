<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MinatBakat;
use App\Models\MinatBakatAnswer;
use App\Models\MinatBakatQuestion;
use App\Models\Wartegg;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use stdClass;

class MinatBakatController extends Controller
{
    function Index()
    {
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];

        $wartegg = new stdClass();
        $wartegg->pending = Wartegg::where('status', '=', 'pending')->get()->count();
        $wartegg->completed = Wartegg::where('status', '=', 'completed')->get()->count();

        $tav = MinatBakat::with('minatBakatQuestions')->where('type', '=', 'tav')->get()[0]->minatBakatQuestions->count();
        $epps = MinatBakat::with('minatBakatQuestions')->where('type', '=', 'epps')->get()[0]->minatBakatQuestions->count();
        $mtk = MinatBakat::with('minatBakatQuestions')->where('type', '=', 'mtk')->get()[0]->minatBakatQuestions->count();

        return view('admin.minatbakat.index', compact('user', 'menu', 'wartegg', 'tav', 'epps', 'mtk'));
    }

    function Show($type)
    {
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];

        if ($type == 'wartegg') {
            $warteggs = Wartegg::select('warteggs.id', 'user_id', 'users.name', 'filename', 'img_url', 'status', 'analysis')->join('users', 'warteggs.user_id', '=', 'users.id')->get();

            return view('admin.minatbakat.wartegg_index', compact('user', 'menu', 'warteggs'));
        }

        $minatbakat =  MinatBakat::with('minatBakatQuestions.minatBakatAnswer')->where('type', $type)->get()[0];

        return view('admin.minatbakat.show', compact('user', 'menu', 'minatbakat'));
    }

    function Edit($id)
    {
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];

        $minatbakat = MinatBakat::with('minatBakatQuestions.minatBakatAnswer')->find($id);

        return view('admin.minatbakat.edit', compact('user', 'menu', 'minatbakat'));
    }

    function Update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'type' => 'required'
        ]);
        $minatbakat = MinatBakat::find($id);
        $minatbakat->title = $request->title;
        $minatbakat->desc = $request->desc;
        $minatbakat->type = $request->type;
        $minatbakat->save();

        return redirect()->route('admin.minatbakat.edit', $id);
    }

    function questionCreate(Request $request)
    {
        $newMinatBakatQuestion = new MinatBakatQuestion();
        $newMinatBakatQuestion->minat_bakat_id = $request->minatbakat_id;
        $newMinatBakatQuestion->question = $request->question;
        $newMinatBakatQuestion->save();
        $lastCreateID = $newMinatBakatQuestion->id;
        for ($i = 0; $i < count($request->answers); $i++) {
            $newMinatBakatAnswer = new MinatBakatAnswer();
            $newMinatBakatAnswer->minat_bakat_question_id = $lastCreateID;
            $newMinatBakatAnswer->answer = $request->answers[$i];
            $newMinatBakatAnswer->bobot = $request->bobot[$i];
            $newMinatBakatAnswer->save();
        }

        return redirect()->route('admin.minatbakat.edit', $request->minatbakat_id);
    }

    function questionUpdate(Request $request, $id)
    {
        $request->validate([
            'question_id' => 'required',
            'question' => 'required',
            'answers' => 'required',
        ]);
        $minatBakatQuestion = MinatBakatQuestion::with('minatBakatAnswer')->find($request->id);
        $minatBakatQuestion->question = $request->question;
        $minatBakatQuestion->save();
        for ($i = 0; $i < $minatBakatQuestion->minatBakatAnswer->count(); $i++) {
            $answer = $minatBakatQuestion->minatBakatAnswer[$i];
            $answer->answer = $request->answers[$i];
            $answer->bobot = (int) $request->bobot[$i];
            $answer->save();
        }
        $minatBakatQuestion->save();

        return redirect()->route('admin.minatbakat.edit', $request->minatbakat_id);
    }

    function questionDestroy(Request $request, $id)
    {
        $mbQuestion = MinatBakatQuestion::with('minatBakatAnswer')->find($id);
        foreach ($mbQuestion->minatBakatAnswer as $answer) {
            $answer->delete();
        }
        $mbQuestion->delete();

        return redirect()->route('admin.minatbakat.edit', $request->minatbakat_id);
    }

    function warteggShow($id)
    {
        $user = Auth::user();
        $menu = Route::getCurrentRoute()->getName();
        $menu = explode('.', $menu)[1];

        $wartegg = Wartegg::find($id);

        return view('admin.minatbakat.wartegg_show', compact('user', 'menu', 'wartegg'));
    }

    function warteggUpdate(Request $request, $id)
    {
        $wartegg = Wartegg::find($id);
        $wartegg->analysis = $request->analisis;
        $wartegg->status = $request->status;
        $wartegg->save();

        return redirect()->route('admin.minatbakat.wartegg.show', $id);
    }

    function warteggDestroy($id)
    {
        $wartegg = Wartegg::find($id);
        if (Storage::exists('public/images/' . $wartegg->filename)) {
            Storage::delete('public/images/' . $wartegg->filename);
        }
        $wartegg->delete();

        return redirect()->route('admin.minatbakat.show', 'wartegg');
    }
}
