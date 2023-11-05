<?php

namespace App\Http\Controllers;

use App\Models\MaterialType;
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
        $materialTypes = MaterialType::all();
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
        $tryout = Tryout::with('materialType', 'questions.answers')->find($id);
        $tryoutHistory = TryoutHistory::where('user_id', $user->id)
                        ->where('tryout_id', $tryout->id)
                        ->first();
        if($tryoutHistory) {
            $finishTimestamp = Carbon::parse($tryoutHistory->finish_timestamp);
            $now = Carbon::now();
            $timeLeft = $finishTimestamp->diffInSeconds($now); // seconds
            if($now <= $finishTimestamp) {
                return Inertia::render('TryOut/Test', [
                    'title' => 'Nama Tryout',
                    'user' => $user,
                    'tryout' => $tryout,
                    'tryoutHistory' => $tryoutHistory,
                    'timeLeft' => $timeLeft,
                ]);
            }
        }

        $tryout->jumlah_soal = $tryout->questions->count();
        $tryout->jumlah_twk = $tryout->questions->where('type', 'twk')->count();
        $tryout->jumlah_tiu = $tryout->questions->where('type', 'tiu')->count();
        $tryout->jumlah_tkp = $tryout->questions->where('type', 'tkp')->count();
        return Inertia::render('TryOut/Confirm', [
            'title' => 'Nama TryOut',
            'user_id' => $user->id,
            'tryout' => $tryout,
        ]);
    }

    public function start_tryout($user_id, $tryout_id) {
        $tryout = Tryout::find($tryout_id);
        $tryout_time = $tryout->time;
        $start = Carbon::now();
        $finish = Carbon::now()->addMinutes($tryout_time);
        TryoutHistory::create([
            'user_id' => $user_id,
            'tryout_id' => $tryout_id,
            'start_timestamp' => $start->toDateTimeString(),
            'finish_timestamp' => $finish->toDateTimeString(),
        ]);
        return redirect()->route('tryout.confirm', $tryout_id);
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
            'title' => 'TryOut SKD',
            'tryouts' => $tryouts
        ]);
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
