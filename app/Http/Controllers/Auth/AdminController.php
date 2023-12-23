<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Article;
use App\Models\Latihan;
use App\Models\Material;
use App\Models\Packet;
use App\Models\Tryout;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{
    function loginForm() {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->route('admin.home');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.loginForm');
    }

    function index() {
        $user = Auth::user();
        $jumlah_user = User::where('is_admin', 0)->get()->count();

        $jumlah_tryout = Tryout::where('active', 1)
            ->where('is_event', 0)
            ->get()
            ->count();

        $jumlah_latihan = Latihan::where('active', 1)
            ->get()
            ->count();

        $jumlah_event_tryout = Tryout::where('active', 1)
            ->where('is_event', 1)
            ->get()
            ->count();

        $jumlah_article = Article::get()->count();

        $jumlah_packet = Packet::get()->count();

        $jumlah_materi = Material::get()->count();
        $menu = Route::currentRouteName();
        $menu = explode('.', $menu)[0];
        return view('admin.index', compact('user', 'menu', 'jumlah_user', 'jumlah_tryout', 'jumlah_event_tryout', 'jumlah_article', 'jumlah_packet', 'jumlah_materi', 'jumlah_latihan'));
    }
}
