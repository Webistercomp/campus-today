<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\EventTryOutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialSKDController;
use App\Http\Controllers\PacketController;
use App\Http\Controllers\ProfileController;
use App\Models\Packet;
use App\Http\Controllers\TryoutController;
use App\Models\Article;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/materi/complete/{materialid}', [MaterialController::class, 'complete'])->name('material.complete');
    Route::get('/materi/{type}', [MaterialController::class, 'materialType'])->name('material.type');
    Route::get('/materi/{type}/teks', [MaterialController::class, 'materialTeks'])->name('material.type.teks');
    Route::get('/materi/{type}/teks/{materialcode}/{id?}', [MaterialController::class, 'materialTeksSubtype'])->name('material.type.teks.subtype');
    Route::get('/materi/{type}/video', [MaterialController::class, 'materialVideo'])->name('material.type.video');
    Route::get('/materi/{type}/video/{materialcode}/{id?}', [MaterialController::class, 'materialVideoSubtype'])->name('material.type.video.subtype');

    Route::get('/paket', [PacketController::class, 'index'])->name('paket.index');
    Route::get('/paket/{packet_id}', [PacketController::class, 'show'])->name('paket.show');
    Route::get('/paket/{packet_id}/checkout', [PacketController::class, 'checkout'])->name('paket.checkout');
    Route::get('/paket/{packet_id}/checkout/payment', [PacketController::class, 'payment'])->name('paket.payment');
    Route::get('/paket/{packet_id}/checkout/verification', [PacketController::class, 'verification'])->name('paket.verification');
    Route::post('/paket', [PacketController::class, 'store'])->name('paket.store');

    Route::get('/tryout', [TryoutController::class, 'index'])->name('tryout');
    Route::get('/tryout/hasil', [TryoutController::class, 'hasil'])->name('tryout.hasil');
    Route::get('/tryout/insight', [TryoutController::class, 'insight'])->name('tryout.insight');
    Route::get('/tryout/ranking', [TryoutController::class, 'ranking'])->name('tryout.ranking');
    Route::get('/tryout/success/{id}', [TryoutController::class, 'success'])->name('tryout.success');
    Route::get('/tryout/failed/{id}', [TryoutController::class, 'failed'])->name('tryout.failed');
    Route::get('/tryout/confirm/{id}', [TryoutController::class, 'confirm'])->name('tryout.confirm');
    Route::get('/tryout/test/{id}', [TryoutController::class, 'test'])->name('tryout.test');
    Route::get('/tryout/{type}', [TryoutController::class, 'type'])->name('tryout.type');
    Route::post('/tryout/scoring', [TryoutController::class, 'scoring'])->name('tryout.scoring');
    Route::post('/tryout', [TryoutController::class, 'start_tryout'])->name('tryout.start');

    Route::get('/event-tryout', [TryoutController::class, 'eventTryoutConfirm'])->name('event-tryout.confirm');
    Route::get('/event-tryout/test/{id}', [TryoutController::class, 'eventTryoutTest'])->name('event-tryout.test');

    Route::get('/latihan', function () {
        return Inertia::render('Latihan/Index', ['title' => 'Latihan Soal']);
    })->name('latihan');
    Route::get('/latihan/success', function () {
        return Inertia::render('Latihan/LatihanSuccess', ['title' => 'Latihan Selesai', 'name' => 'Farhan Hikmatullah D']);
    })->name('latihan.success');
    Route::get('/latihan/failed', function () {
        return Inertia::render('Latihan/LatihanFailed', ['title' => 'Latihan Selesai', 'name' => 'Farhan Hikmatullah D']);
    })->name('latihan.failed');

    Route::get('/articles', [ArticleController::class, 'index'])->name('article.index');
    Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('article.show');
});

Route::prefix('materiskd')->group(function () {
    Route::get('/', [MaterialSKDController::class, 'index'])->name('materiskd.index');
    Route::get('/teks', [MaterialSKDController::class, 'teks'])->name('materiskd.teks');
    Route::get('/teks/{id}', [MaterialSKDController::class, 'teks_show'])->name('materiskd.teks_show');
    Route::get('/video', [MaterialSKDController::class, 'video'])->name('materiskd.video');
    Route::get('/video/{id}', [MaterialSKDController::class, 'video_show'])->name('materiskd.video_show');
});

require __DIR__ . '/auth.php';


Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'loginForm'])->name('admin.loginForm');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::middleware('checkAdmin')->group(function () {
        Route::get('', [AdminController::class, 'index'])->name('admin.home');
    });
});
