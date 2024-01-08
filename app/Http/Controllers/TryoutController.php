<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\MaterialType;
use App\Models\Participant;
use App\Models\Question;
use App\Models\Tryout;
use App\Models\TryoutHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Database\Eloquent\Builder;


class TryoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index() { // material type lists
        $materialTypes = MaterialType::where('code', '!=', 'videoseries')->get();
        return Inertia::render('TryOut/Index', [
            'title' => 'TryOut',
            'materialTypes' => $materialTypes
        ]);
    }

    public function hasil() { // hasil tryout, list tryout yang sudah pernah diikuti
        $user = Auth::user();
        $tryoutHistories = TryoutHistory::where('user_id', $user->id)
            ->with('tryout.materialType', 'tryout.questions')
            ->get();
        foreach ($tryoutHistories as $tryoutHistory) {
            $tryoutHistory->tryout->jumlah_soal = $tryoutHistory->tryout->questions->count();
        }
        return Inertia::render('TryOut/Hasil', [
            'title' => 'Hasil TryOut',
            'tryoutHistories' => $tryoutHistories
        ]);
    }

    public function confirm($id) { // sebelum mengerjakan tryout
        $user = Auth::user();
        $tryoutHistory = TryoutHistory::where('user_id', $user->id)
            ->where('tryout_id', $id)
            ->first();
        $now = Carbon::now();
        // check whether its event of tryout
        $tryout = Tryout::with('materialType', 'questions.answers')->find($id);
        if ($tryout->is_event || !$tryout->active) {
            return abort(404);
        }
        // check if user has tryout history
        if ($tryoutHistory && $now <= $tryoutHistory->finish_timestamp) {
            return redirect()->route('tryout.test', $id);
        }

        // hitung jumlah soal
        $tryout->jumlah_soal = $tryout->questions->count();
        $jumlah_soal = [];
        if ($tryout->materialType->code == "um" || $tryout->materialType->code == "utbk") {
            $jumlah_soal['mtk'] = $tryout->questions->where('group_type_id', 1)->count();
            $jumlah_soal['fis'] = $tryout->questions->where('group_type_id', 2)->count();
            $jumlah_soal['bio'] = $tryout->questions->where('group_type_id', 3)->count();
            $jumlah_soal['kim'] = $tryout->questions->where('group_type_id', 4)->count();
        } else if ($tryout->materialType->code == "skd" || $tryout->materialType->code == "skb") {
            $jumlah_soal['twk'] = $tryout->questions->where('group_type_id', 5)->count();
            $jumlah_soal['tiu'] = $tryout->questions->where('group_type_id', 6)->count();
            $jumlah_soal['tkp'] = $tryout->questions->where('group_type_id', 7)->count();
        }

        // return view
        return Inertia::render('TryOut/Confirm', [
            'title' => 'Nama TryOut',
            'user_id' => $user->id,
            'tryout' => $tryout,
            'jumlah_soal' => $jumlah_soal,
            'code' => $tryout->materialType->code,
        ]);
    }

    public function eventTryoutConfirm() { // sebelum mengerjakan event tryout
        $user = Auth::user();
        $tryout = Tryout::with('materialType', 'questions.answers')
            ->where('is_event', true)
            ->where('active', true)
            ->latest()
            ->first();
        $tryoutHistory = TryoutHistory::where('user_id', $user->id)
            ->where('tryout_id', $tryout->id)
            ->latest()
            ->first();
        $now = Carbon::now()->addHours(7);
        $start_tryout = Carbon::parse($tryout->start_datetime);
        $end_tryout = Carbon::parse($tryout->end_datetime);
        // check whether its event of tryout
        // check if user has tryout history

        if ($now < $start_tryout || $now > $end_tryout) {
            return redirect()->route('event-tryout.over');
        } else if ($tryoutHistory && $now <= $tryoutHistory->finish_timestamp) {
            return redirect()->route('event-tryout.test', $tryout->id);
        }

        // hitung jumlah soal
        $tryout->jumlah_soal = $tryout->questions->count();
        $jumlah_soal = [];
        if ($tryout->materialType->code == "um" || $tryout->materialType->code == "utbk") {
            $jumlah_soal['mtk'] = $tryout->questions->where('group_type_id', 1)->count();
            $jumlah_soal['fis'] = $tryout->questions->where('group_type_id', 2)->count();
            $jumlah_soal['bio'] = $tryout->questions->where('group_type_id', 3)->count();
            $jumlah_soal['kim'] = $tryout->questions->where('group_type_id', 4)->count();
        } else if ($tryout->materialType->code == "skd" || $tryout->materialType->code == "skb") {
            $jumlah_soal['twk'] = $tryout->questions->where('group_type_id', 5)->count();
            $jumlah_soal['tiu'] = $tryout->questions->where('group_type_id', 6)->count();
            $jumlah_soal['tkp'] = $tryout->questions->where('group_type_id', 7)->count();
        }

        // return view
        return Inertia::render('TryOut/Confirm', [
            'title' => 'Nama TryOut',
            'user_id' => $user->id,
            'tryout' => $tryout,
            'jumlah_soal' => $jumlah_soal,
            'code' => $tryout->materialType->code,
        ]);
    }

    public function test($id) { // mengerjakan tryout
        $user = Auth::user();
        $tryoutHistory = TryoutHistory::where('user_id', $user->id)
            ->where('tryout_id', $id)
            ->latest()
            ->first();
        $now = Carbon::now();
        if (!$tryoutHistory || $now > $tryoutHistory->finish_timestamp) {
            return redirect()->route('tryout.confirm', $id);
        }
        $tryout = Tryout::with('materialType', 'questions.answers')->find($id);
        $finishTimestamp = Carbon::parse($tryoutHistory->finish_timestamp);
        $now = Carbon::now();
        $timeLeft = $finishTimestamp->diffInSeconds($now); // seconds
        $data = [
            'title' => 'Nama Tryout',
            'user' => $user,
            'tryout' => $tryout,
            'tryoutHistory' => $tryoutHistory,
            'timeLeft' => $timeLeft,
            'axios_base_url' => env('AXIOS_BASE_URL'),
        ];
        if ($now <= $finishTimestamp) {
            return Inertia::render('TryOut/Test', $data);
        } else {
            return redirect()->route('tryout.confirm', $id);
        }
    }

    public function eventTryoutTest($id) { // mengerjakan event tryout
        $user = Auth::user();
        $tryoutHistory = TryoutHistory::where('user_id', $user->id)
            ->where('tryout_id', $id)
            ->latest()
            ->first();
        $now = Carbon::now();
        if (!$tryoutHistory || $now > $tryoutHistory->finish_timestamp) {
            return redirect()->route('tryout.confirm', $id);
        }
        $tryout = Tryout::with('materialType', 'questions.answers')->find($id);
        $finishTimestamp = Carbon::parse($tryoutHistory->finish_timestamp);
        $now = Carbon::now();
        $timeLeft = $finishTimestamp->diffInSeconds($now); // seconds
        $data = [
            'title' => 'Nama Tryout',
            'user' => $user,
            'tryout' => $tryout,
            'tryoutHistory' => $tryoutHistory,
            'timeLeft' => $timeLeft,
            'axios_base_url' => env('AXIOS_BASE_URL'),
        ];
        if ($now <= $finishTimestamp) {
            return Inertia::render('TryOut/Test', $data);
        } else {
            return redirect()->route('event-tryout.confirm', $id);
        }
    }

    public function start_tryout(Request $request) { // start tryout, store tryout history
        $tryout = Tryout::find($request->tryout_id);
        $tryout_time = $tryout->time;
        $start = Carbon::now();
        $finish = Carbon::now()->addMinutes($tryout_time);
        TryoutHistory::create([
            'user_id' => $request->user_id,
            'tryout_id' => $request->tryout_id,
            'start_timestamp' => $start->toDateTimeString(),
            'finish_timestamp' => $finish->toDateTimeString(),
        ]);
        if (!$tryout->is_event) {
            return redirect()->route('tryout.confirm', $request->tryout_id);
        } else {
            return redirect()->route('event-tryout.confirm', $request->tryout_id);
        }
    }

    public function success($id) { // setelah mengerjakan tryout
        $user = Auth::user();
        $tryoutHistory = TryoutHistory::where('user_id', $user->id)
            ->where('tryout_id', $id)
            ->latest()
            ->first();
        return Inertia::render('TryOut/TryOutSuccess', [
            'title' => 'Nama TryOut',
            'user' => $user,
            'tryout_history' => $tryoutHistory
        ]);
    }

    public function failed() { // setelah mengerjakan tryout
        return Inertia::render('TryOut/TryOutFailed', ['title' => 'Nama TryOut', 'name' => 'Farhan Hikmatullah D']);
    }

    public function type($type) { // list tryout by type
        $tryouts = Tryout::whereHas('materialType', function ($query) use ($type) {
            $query->where('code', $type);
        })
            ->where('is_event', 0)
            ->get();
        foreach ($tryouts as $tryout) {
            $tryout->jumlah_soal = $tryout->questions()->count();
        }
        return Inertia::render('TryOut/Type', [
            'title' => 'TryOut',
            'tryouts' => $tryouts,
            'type' => $type,
        ]);
    }

    public function scoring(Request $request) { // scoring tryout
        $tryout = Tryout::find($request->tryout_id);
        if (!$tryout->is_event) { // cek apakah tryout biasa atau event tryout
            $tryoutHistory = TryoutHistory::where('user_id', $request->user_id)
                ->where('tryout_id', $request->tryout_id)
                ->latest()
                ->first();
            $finishTimestamp = Carbon::now(); // set finish timestamp to now
            $tryoutHistory->finish_timestamp = $finishTimestamp;
            $dataAnswers = []; // array of answers
            foreach ($request->tryout_data as $data) { 
                $answer = Answer::find($data['answer_id']);
                if($answer == null) { // kalau jawaban kosong
                    $dataAnswer = [
                        'question_id' => $data['question_id'],
                        'answer_id' => null,
                    ];
                    array_push($dataAnswers, $dataAnswer);
                } else {
                    $tryoutHistory->score += $answer->bobot; // penghitungan score
                    $dataAnswer = [
                        'question_id' => $data['question_id'],
                        'answer_id' => $data['answer_id'],
                    ];
                    array_push($dataAnswers, $dataAnswer);
                }
            }
            $tryoutHistory->answers = json_encode($dataAnswers); // set answers
            $tryoutHistory->save();

            return response()->json([
                'message' => 'success',
                'data' => $tryoutHistory
            ], 200);
        } else {
            $finishTimestamp = Carbon::now();
            $tryoutHistory = TryoutHistory::where('user_id', $request->user_id)
                ->where('tryout_id', $request->tryout_id)
                ->latest()
                ->first();
            $detailScore = [];
            $dataAnswers = [];
            foreach ($request->tryout_data as $data) {
                $answer = Answer::find($data['answer_id']);
                if($answer == null) { // kalau jawaban kosong
                    $dataAnswer = [
                        'question_id' => $data['question_id'],
                        'answer_id' => null,
                    ];
                    array_push($dataAnswers, $dataAnswer);
                } else {
                    $tryoutHistory->score += $answer->bobot; // penghitungan score
                    $dataAnswer = [
                        'question_id' => $data['question_id'],
                        'answer_id' => $data['answer_id'],
                    ];
                    array_push($dataAnswers, $dataAnswer);
                }
                $question = Question::with('groupType')->find($data['question_id']);
                if (!array_key_exists($question->groupType->code, $detailScore)) {
                    $detailScore[$question->groupType->code] = 0;
                }
                $detailScore[$question->groupType->code] += $answer->bobot;
            }
            $tryoutHistory->answers = json_encode($dataAnswers);
            $tryoutHistory->finish_timestamp = $finishTimestamp;
            $tryoutHistory->save();

            Participant::create([
                'user_id' => $request->user_id,
                'tryout_id' => $request->tryout_id,
                'final_score' => $tryoutHistory->score,
                'detail_score' => json_encode($detailScore),
            ]);

            return response()->json([
                'message' => 'success',
                'data' => $tryoutHistory
            ], 200);
        }
    }

    public function insight($id_tryout_history) { // pembahasan tryout
        $tryoutHistory = TryoutHistory::with('tryout.questions.answers', 'tryout.questions.solution')->where('user_id', Auth::user()->id)
            ->find($id_tryout_history);
        $no = 1;
        $answers = json_decode($tryoutHistory->answers);
        foreach ($tryoutHistory->tryout->questions as $question) {
            $question->no = $no++;
            $question->jawaban = $question->answers->sortByDesc('bobot')->first()->id;
            foreach($answers as $answer) {
                if ($answer->question_id == $question->id) {
                    $answerFromDB = Answer::find($answer->answer_id);
                    if($answerFromDB == null) {
                        $question->jawaban_user_id = null;
                        $question->jawaban_user_bobot = 0;
                        $question->jawaban_user = null;
                        break;
                    } else {
                        $question->jawaban_user_id = $answerFromDB->id;
                        $question->jawaban_user_bobot = $answerFromDB->bobot;
                        $question->jawaban_user = $answerFromDB->answer;
                        break;
                    }
                }
            }
        }
        return Inertia::render('TryOut/Insight', [
            'title' => 'Pembahasan TryOut',
            'tryoutName' => $tryoutHistory->tryout->name,
            'tryout' => $tryoutHistory->tryout,
            'tryoutHistory' => $tryoutHistory,
        ]);
    }

    public function ranking($id_tryout) { // ranking event tryout
        $tryout = Tryout::find($id_tryout);
        return Inertia::render('TryOut/Ranking', [
            'title' => 'Ranking TryOut',
            'tryoutName' => $tryout->name,
            'tryout' => $tryout,
        ]);
    }

    public function eventIsOver() { // event tryout is over
        $user = Auth::user();
        $tryout = Tryout::with('materialType', 'questions.answers')
            ->where('is_event', true)
            ->where('active', true)
            ->latest()
            ->first();
        $tryoutHistory = TryoutHistory::where('user_id', $user->id)
            ->where('tryout_id', $tryout->id)
            ->latest()
            ->first();
        $now = Carbon::now();
        $start_tryout = Carbon::parse($tryout->start_datetime);
        $end_tryout = Carbon::parse($tryout->end_datetime);
        // check whether its event of tryout
        // check if user has tryout history

        if ($now > $start_tryout && $now < $end_tryout) {
            return redirect()->route('event-tryout.confirm');
        }

        return Inertia::render('TryOut/EventIsOver', [
            'title' => 'Event TryOut',
        ]);
    }
}
