<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\MaterialType;
use App\Models\Packet;
use App\Models\Role;
use App\Models\Testimoni;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    function home() {
        $packets = Packet::all();
        $testimonis = Testimoni::where('active', 1)->get();
        foreach($testimonis as $testimoni) {
            $testimoni->photo = asset('storage/testimoni/photo/'.$testimoni->photo);
        }
        return Inertia::render('Homepage', [
            'title' => 'Campus Today | E-Learning CPNS',
            'packets' => $packets,
            'testimonis' => $testimonis
        ]);
    }

    function dashboard() {
        $materialTypes = MaterialType::all();
        $articles = Article::all();

        // update role user if expired
        $user = User::find(auth()->user()->id);
        $now = Carbon::now();
        $expired_at = Carbon::parse($user->expired_at);
        if($now > $expired_at) {
            $user->role_id = 1;
            $user->expired_at = null;
            $user->save();
        }
        $role = Role::find($user->role_id);

        return Inertia::render('Dashboard', [
            'materialTypes' => $materialTypes,
            'articles' => $articles,
            'role' => $role
        ]);
    }
}
