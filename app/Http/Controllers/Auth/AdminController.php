<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Article;
use App\Models\Latihan;
use App\Models\Material;
use App\Models\Packet;
use App\Models\PacketHistory;
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
        $jumlah_user = User::get()->count();
        $jumlah_user_admin = User::where('is_admin', 0)->get()->count();
        $jumlah_user_nonadmin = $jumlah_user - $jumlah_user_admin;

        $jumlah_tryout = Tryout::where('is_event', 0)->get()->count();
        $jumlah_tryout_active = Tryout::where('active', 1)->where('is_event', 0)->get()->count();
        $jumlah_tryout_nonactive = $jumlah_tryout - $jumlah_tryout_active;

        $jumlah_latihan = Latihan::get()->count();
        $jumlah_latihan_active = Latihan::where('active', 1)->get()->count();
        $jumlah_latihan_nonactive = $jumlah_latihan - $jumlah_latihan_active;

        $jumlah_event_tryout = Tryout::where('is_event', 1)->get()->count();
        $jumlah_event_tryout_active = Tryout::where('active', 1)->where('is_event', 1)->get()->count();
        $jumlah_event_tryout_nonactive = $jumlah_event_tryout - $jumlah_event_tryout_active;

        $jumlah_article = Article::get()->count();
        $jumlah_article_active = Article::where('active', 1)->get()->count();
        $jumlah_article_nonactive = $jumlah_article - $jumlah_article_active;

        $jumlah_packet_history = PacketHistory::get()->count();
        $jumlah_packet_history_pending = PacketHistory::where('status', 'pending')->count();
        $jumlah_packet_history_verification = PacketHistory::where('status', 'verification')->count();
        $jumlah_packet_history_success = PacketHistory::where('status', 'success')->count();
        $jumlah_packet_history_failed = PacketHistory::where('status', 'failed')->count();

        $jumlah_packet = Packet::get()->count();

        $jumlah_materi = Material::get()->count();

        $menu = Route::currentRouteName();
        $menu = explode('.', $menu)[0];
        return view('admin.index', compact('user', 'menu', 'jumlah_user', 'jumlah_user_admin', 'jumlah_user_nonadmin', 'jumlah_tryout', 'jumlah_tryout_active', 'jumlah_tryout_nonactive', 'jumlah_latihan', 'jumlah_latihan_active', 'jumlah_latihan_nonactive', 'jumlah_event_tryout', 'jumlah_event_tryout_active', 'jumlah_event_tryout_nonactive', 'jumlah_article', 'jumlah_article_active', 'jumlah_article_nonactive', 'jumlah_packet_history', 'jumlah_packet_history_pending', 'jumlah_packet_history_verification', 'jumlah_packet_history_success', 'jumlah_packet_history_failed', 'jumlah_packet', 'jumlah_materi', 'jumlah_latihan'));
    }

    function uploadImage(Request $request) {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
         
            $request->file('upload')->move(public_path('images'), $fileName);
    
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/'.$fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
                
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }
}
