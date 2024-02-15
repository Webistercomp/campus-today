<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\MaterialType;
use App\Models\Packet;
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
        $role = auth()->user()->role;
        return Inertia::render('Dashboard', [
            'materialTypes' => $materialTypes,
            'articles' => $articles,
            'role' => $role
        ]);
    }
}
