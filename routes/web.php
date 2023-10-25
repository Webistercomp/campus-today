<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialSKDController;
use App\Http\Controllers\ProfileController;
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/materi/complete/{materialid}', [MaterialController::class, 'complete'])->name('material.complete');
    Route::get('/materi/{type}', [MaterialController::class, 'materialType'])->name('material.type');
    Route::get('/materi/{type}/teks', [MaterialController::class, 'materialTeks'])->name('material.type.teks');
    Route::get('/materi/{type}/teks/{materialcode}/{id?}', [MaterialController::class, 'materialTeksSubtype'])->name('material.type.teks.subtype');
    Route::get('/materi/{type}/video', [MaterialController::class, 'materialVideo'])->name('material.type.video');
    Route::get('/materi/{type}/video/{materialcode}/{id?}', [MaterialController::class, 'materialVideoSubtype'])->name('material.type.video.subtype');

    Route::get('/beli-paket', function () {
        return Inertia::render('BeliPaket/index', ['title' => 'Beli Paket']);
    })->name('belipaket');
    Route::get('/beli-paket/friendly', function () {
        return Inertia::render('BeliPaket/Deskripsi', ['title' => 'Paket Friendly', 'nama_paket' => 'Friendly']);
    })->name('belipaket.friendly');
    Route::get('/beli-paket/friendly/checkout', function () {
        return Inertia::render('BeliPaket/Checkout', ['title' => 'Checkout', 'nama_paket' => 'Friendly']);
    })->name('belipaket.friendly.checkout');
    Route::get('/beli-paket/friendly/checkout/payment', function () {
        return Inertia::render('BeliPaket/Payment', ['title' => 'Pembayaran', 'nama_paket' => 'Friendly']);
    })->name('belipaket.friendly.checkout.payment');
    Route::get('/beli-paket/friendly/checkout/verification', function () {
        return Inertia::render('BeliPaket/Verification', ['title' => 'Pembayaran', 'nama_paket' => 'Friendly']);
    })->name('belipaket.friendly.checkout.verification');
});

Route::prefix('materiskd')->group(function() {
    Route::get('/', [MaterialSKDController::class, 'index'])->name('materiskd.index');
    Route::get('/teks', [MaterialSKDController::class, 'teks'])->name('materiskd.teks');
    Route::get('/teks/{id}', [MaterialSKDController::class, 'teks_show'])->name('materiskd.teks_show');
    Route::get('/video', [MaterialSKDController::class, 'video'])->name('materiskd.video');
    Route::get('/video/{id}', [MaterialSKDController::class, 'video_show'])->name('materiskd.video_show');
});

require __DIR__ . '/auth.php';


Route::prefix('admin')->group(function() {
    Route::get('login', [AdminController::class, 'loginForm'])->name('admin.loginForm');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::middleware('checkAdmin')->group(function() {
        Route::get('', [AdminController::class, 'index'])->name('admin.home');
    });
});