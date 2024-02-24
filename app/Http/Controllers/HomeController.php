<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\MaterialType;
use App\Models\Packet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    function home() {
        $packets = Packet::all();
        return Inertia::render('Homepage', [
            'title' => 'Campus Today | E-Learning CPNS',
            'packets' => $packets
        ]);
    }

    function dashboard() {
        $materialTypes = MaterialType::all();
        $articles = Article::all();

        // update role user if expired
        // $user = User::find(auth()->user()->id);
        // $now = Carbon::now();
        // $expired_at = Carbon::parse($user->expired_at);
        // if($now > $expired_at) {
        //     $user->role_id = 1;
        //     $user->save();
        // }
        $role = auth()->user()->role;

        return Inertia::render('Dashboard', [
            'materialTypes' => $materialTypes,
            'articles' => $articles,
            'role' => $role
        ]);
    }
}
