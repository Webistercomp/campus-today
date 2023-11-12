<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\MaterialType;
use App\Models\Question;
use App\Models\Tryout;
use App\Models\TryoutHistory;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TryoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materialTypes = MaterialType::where('code', '!=', 'videoseries')->get();
        return Inertia::render('TryOut/Index', [
            'title' => 'TryOut',
            'materialTypes' => $materialTypes
        ]);
    }

    public function hasil() {
        return Inertia::render('TryOut/Hasil', ['title' => 'Hasil TryOut']);
    }

    public function confirm($id) {
        $user = Auth::user();
        $tryoutHistory = TryoutHistory::where('user_id', $user->id)
                        ->where('tryout_id', $id)
                        ->first();
        $now = Carbon::now();
        if($tryoutHistory && $now <= $tryoutHistory->finish_timestamp) {
            return redirect()->route('tryout.test', $id);
        }
        $tryout = Tryout::with('materialType', 'questions.answers')->find($id);

        $tryout->jumlah_soal = $tryout->questions->count();
        $jumlah_soal = [];
        if($tryout->materialType->code == "um" || $tryout->materialType->code == "utbk") {
            $jumlah_soal['mtk'] = $tryout->questions->where('group_type_id', 1)->count();
            $jumlah_soal['fis'] = $tryout->questions->where('group_type_id', 2)->count();
            $jumlah_soal['bio'] = $tryout->questions->where('group_type_id', 3)->count();
            $jumlah_soal['kim'] = $tryout->questions->where('group_type_id', 4)->count();
        } else if($tryout->materialType->code == "skd" || $tryout->materialType->code == "skb"){
            $jumlah_soal['twk'] = $tryout->questions->where('group_type_id', 5)->count();
            $jumlah_soal['tiu'] = $tryout->questions->where('group_type_id', 6)->count();
            $jumlah_soal['tkp'] = $tryout->questions->where('group_type_id', 7)->count();
        } else {

        }
        return Inertia::render('TryOut/Confirm', [
            'title' => 'Nama TryOut',
            'user_id' => $user->id,
            'tryout' => $tryout,
            'jumlah_soal' => $jumlah_soal,
            'code' => $tryout->materialType->code,
        ]);
    }

    public function test($id) {
        $user = Auth::user();
        $tryoutHistory = TryoutHistory::where('user_id', $user->id)
                        ->where('tryout_id', $id)
                        ->latest()
                        ->first();
        $now = Carbon::now();
        if(!$tryoutHistory || $now > $tryoutHistory->finish_timestamp) {
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
        if($now <= $finishTimestamp) {
            return Inertia::render('TryOut/Test', $data);
        } else {
            return redirect()->route('tryout.confirm', $id);
        }
    }

    public function start_tryout(Request $request) {
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
        return redirect()->route('tryout.confirm', $request->tryout_id);
    }

    public function success() {
        return Inertia::render('TryOut/TryOutSuccess', ['title' => 'Nama TryOut', 'name' => 'Farhan Hikmatullah D']);
    }

    public function failed() {
        return Inertia::render('TryOut/TryOutFailed', ['title' => 'Nama TryOut', 'name' => 'Farhan Hikmatullah D']);
    }

    public function type($type) {
        $tryouts = Tryout::whereHas('materialType', function($query) use ($type) {
            $query->where('code', $type);
        })->get();
        foreach($tryouts as $tryout) {
            $tryout->jumlah_soal = $tryout->questions()->count();
        } 
        return Inertia::render('TryOut/Type', [
            'title' => 'TryOut',
            'tryouts' => $tryouts,
            'type' => $type,
        ]);
    }

    public function scoring(Request $request) {
        $tryout = Tryout::find($request->tryout_id);
        $finishTimestamp = Carbon::now();
        $tryoutHistory = TryoutHistory::where('user_id', $request->user_id)
                        ->where('tryout_id', $request->tryout_id)
                        ->latest()
                        ->first();
        foreach($request->tryout_data as $data) {
            $answer = Answer::find($data['answer_id']);
            $tryoutHistory->score += $answer->bobot;
        }
        $tryoutHistory->finish_timestamp = $finishTimestamp;
        $tryoutHistory->save();

        return response()->json([
            'message' => 'success',
            'data' => $tryoutHistory
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tryout $tryout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tryout $tryout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tryout $tryout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tryout $tryout)
    {
        //
    }
}
