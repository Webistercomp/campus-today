<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
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
        $articles = Article::all();
        return Inertia::render('Dashboard', [
            'articles' => $articles
        ]);
    }
}
