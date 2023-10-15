<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
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

Route::get('/', function () {
    return Inertia::render('Homepage', [
        'title' => 'Campus Today | E-Learning CPNS'
    ]);
})->name('base');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/materi/skd', function () {
        return Inertia::render('Materi/Skd', ['title' => 'Materi SKD']);
    })->name('materi.skd');
    Route::get('/materi/skb', function () {
        return Inertia::render('Materi/Skb', ['title' => 'Materi SKB']);
    })->name('materi.skb');

    Route::get('/materi/skd/teks', function () {
        return Inertia::render('Materi/SkdTeks', ['title' => 'Materi Teks SKD']);
    })->name('materi.skd.teks');
    Route::get('/materi/skb/teks', function () {
        return Inertia::render('Materi/SkbTeks', ['title' => 'Materi Teks SKB']);
    })->name('materi.skb.teks');

    Route::get('materi/skd/teks/twk', function () {
        return Inertia::render('Materi/SkdTeksTwk', ['title' => 'TWK | Teks']);
    })->name('materi.skd.teks.twk');

    Route::get('/materi/skd/video', function () {
        return Inertia::render('Materi/SkdVideo', ['title' => 'Materi Video SKD']);
    })->name('materi.skd.video');
    Route::get('/materi/skb/video', function () {
        return Inertia::render('Materi/SkbVideo', ['title' => 'Materi Video SKB']);
    })->name('materi.skb.video');

    Route::get('/materi/skd/video/twk', function () {
        return Inertia::render('Materi/SkdVideoTwk', ['title' => 'TWK | Video']);
    })->name('materi.skd.video.twk');

    Route::get('/materi/complete', function () {
        return Inertia::render('Materi/Completed', ['title' => 'Completed', 'name' => 'Farhan Hikmatullah D']);
    })->name('materi.complete');

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

require __DIR__ . '/auth.php';
