<?php

use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\EventTryoutController as AdminEventTryoutController;
use App\Http\Controllers\Admin\LatihanController as AdminLatihanController;
use App\Http\Controllers\Admin\MateriController;
use App\Http\Controllers\Admin\MinatBakatController as AdminMinatBakatController;
use App\Http\Controllers\Admin\PacketController as AdminPacketController;
use App\Http\Controllers\Admin\TryoutController as AdminTryoutController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\EventTryOutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MinatBakatController;
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
    Route::get('/tryout/insight/{id_tryout}', [TryoutController::class, 'insight'])->name('tryout.insight');
    Route::get('/tryout/ranking/{id_tryout}', [TryoutController::class, 'ranking'])->name('tryout.ranking');
    Route::get('/tryout/success/{id}', [TryoutController::class, 'success'])->name('tryout.success');
    Route::get('/tryout/failed/{id}', [TryoutController::class, 'failed'])->name('tryout.failed');
    Route::get('/tryout/confirm/{id}', [TryoutController::class, 'confirm'])->name('tryout.confirm');
    Route::get('/tryout/test/{id}', [TryoutController::class, 'test'])->name('tryout.test');
    Route::get('/tryout/{type}', [TryoutController::class, 'type'])->name('tryout.type');
    Route::post('/tryout/scoring', [TryoutController::class, 'scoring'])->name('tryout.scoring');
    Route::post('/tryout', [TryoutController::class, 'start_tryout'])->name('tryout.start');

    Route::get('/event-tryout', [TryoutController::class, 'eventTryoutConfirm'])->name('event-tryout.confirm');
    Route::get('/event-tryout/test/{id}', [TryoutController::class, 'eventTryoutTest'])->name('event-tryout.test');
    Route::get('/event-tryout/over', [TryoutController::class, 'eventIsOver'])->name('event-tryout.over');

    Route::get('/latihan/test/{id}', [LatihanController::class, 'test'])->name('latihan.test');
    Route::post('/latihan/scoring', [LatihanController::class, 'scoring'])->name('latihan.scoring');
    Route::post('/latihan/result/{latihan_id}', [LatihanController::class, 'result'])->name('latihan.result');

    Route::get('/articles', [ArticleController::class, 'index'])->name('article.index');
    Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('article.show');

    Route::get('/minat-bakat', function () {
        return Inertia::render('MinatBakat/Index', ['title' => 'Tes Minat Bakat']);
    })->name('minatbakat');
    Route::get('/minat-bakat/tes-koran', function () {
        return Inertia::render('MinatBakat/TesKoran', ['title' => 'Tes Koran']);
    })->name('minatbakat.teskoran');

    Route::get('/minat-bakat/tes-wartegg', [MinatBakatController::class, 'testWartegg'])->name('minatbakat.teswartegg');
    Route::post('/minat-bakat/tes-wartegg', [MinatBakatController::class, 'storeTestWartegg'])->name('minatbakat.teswartegg.store');
    Route::get('/minat-bakat/tes-wartegg/hasil', [MinatBakatController::class, 'hasilTestWartegg'])->name('minatbakat.teswartegg.hasil');

    Route::get('/minat-bakat/tes-analogi-verbal', [MinatBakatController::class, 'tav'])->name('minatbakat.tav');
    Route::post('/minat-bakat/tes-analogi-verbal/scoring', [MinatBakatController::class, 'tavScoring'])->name('minatbakat.tav.scoring');
    Route::post('/minat-bakat/tes-analogi-verbal/result', [MinatBakatController::class, 'tavResult'])->name('minatbakat.tav.result');

    Route::get('/minat-bakat/epps', [MinatBakatController::class, 'epps'])->name('minatbakat.epps');
    Route::post('/minat-bakat/epps/scoring', [MinatBakatController::class, 'eppsScoring'])->name('minatbakat.epps.scoring');
    Route::post('/minat-bakat/epps/result', [MinatBakatController::class, 'eppsResult'])->name('minatbakat.epps.result');

    Route::get('/minat-bakat/tes-matematika', [MinatBakatController::class, 'tesmtk'])->name('minatbakat.tesmtk');
    Route::post('/minat-bakat/tes-matematika/scoring', [MinatBakatController::class, 'tesmtkScoring'])->name('minatbakat.tesmtk.scoring');
    Route::post('/minat-bakat/tes-matematika/result', [MinatBakatController::class, 'tesmtkResult'])->name('minatbakat.tesmtk.result');
});

require __DIR__ . '/auth.php';

Route::get('/article', [ArticleController::class, 'index'])->name('article.index');
Route::get('/article/{id}', [ArticleController::class, 'show'])->name('article.show');

Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'loginForm'])->name('admin.loginForm');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::middleware('checkAdmin')->group(function () {
        Route::get('', [AdminController::class, 'index'])->name('admin.home');

        Route::get('users', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('users/{id}', [UserController::class, 'show'])->name('admin.user.show');
        Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::put('users/{id}', [UserController::class, 'update'])->name('admin.user.update');
        Route::delete('users/{id}', [UserController::class, 'destroy'])->name('admin.user.delete');

        Route::get('packets', [AdminPacketController::class, 'index'])->name('admin.packet.index');
        Route::get('packets/create', [AdminPacketController::class, 'create'])->name('admin.packet.create');
        Route::post('packets', [AdminPacketController::class, 'store'])->name('admin.packet.store');
        Route::get('packets/{id}', [AdminPacketController::class, 'show'])->name('admin.packet.show');
        Route::get('packets/edit/{id}', [AdminPacketController::class, 'edit'])->name('admin.packet.edit');
        Route::put('packets/{id}', [AdminPacketController::class, 'update'])->name('admin.packet.update');
        Route::delete('packets/{id}', [AdminPacketController::class, 'destroy'])->name('admin.packet.delete');

        Route::get('tryouts', [AdminTryoutController::class, 'index'])->name('admin.tryout.index');
        Route::get('tryouts/create', [AdminTryoutController::class, 'create'])->name('admin.tryout.create');
        Route::post('tryouts', [AdminTryoutController::class, 'store'])->name('admin.tryout.store');
        Route::get('tryouts/{id}', [AdminTryoutController::class, 'show'])->name('admin.tryout.show');
        Route::get('tryouts/{id}', [AdminTryoutController::class, 'show'])->name('admin.tryout.show');
        Route::get('tryouts/edit/{id}', [AdminTryoutController::class, 'edit'])->name('admin.tryout.edit');
        Route::put('tryouts/{id}', [AdminTryoutController::class, 'update'])->name('admin.tryout.update');
        Route::delete('tryouts/{id}', [AdminTryoutController::class, 'destroy'])->name('admin.tryout.delete');

        Route::post('question', [AdminTryoutController::class, 'updateQuestion'])->name('admin.question.update');
        Route::delete('question/{question_id}', [AdminTryoutController::class, 'deleteQuestion'])->name('admin.question.delete');

        Route::get('latihans', [AdminLatihanController::class, 'index'])->name('admin.latihan.index');
        Route::get('latihans/create', [AdminLatihanController::class, 'create'])->name('admin.latihan.create');
        Route::post('latihans/store', [AdminLatihanController::class, 'store'])->name('admin.latihan.store');
        Route::get('latihans/{id}', [AdminLatihanController::class, 'show'])->name('admin.latihan.show');
        Route::get('latihans/edit/{id}', [AdminLatihanController::class, 'edit'])->name('admin.latihan.edit');
        Route::put('latihans/{id}', [AdminLatihanController::class, 'update'])->name('admin.latihan.update');
        Route::delete('latihans/{id}', [AdminLatihanController::class, 'destroy'])->name('admin.latihan.delete');

        Route::get('event-tryout', [AdminEventTryoutController::class, 'index'])->name('admin.event.index');
        Route::get('event-tryout/create', [AdminEventTryoutController::class, 'create'])->name('admin.event.create');
        Route::post('event-tryout', [AdminEventTryoutController::class, 'store'])->name('admin.event.store');
        Route::get('event-tryout/{id}', [AdminEventTryoutController::class, 'show'])->name('admin.event.show');
        Route::get('event-tryout/edit/{id}', [AdminEventTryoutController::class, 'edit'])->name('admin.event.edit');
        Route::put('event-tryout/{id}', [AdminEventTryoutController::class, 'update'])->name('admin.event.update');
        Route::delete('event-tryout/{id}', [AdminEventTryoutController::class, 'destroy'])->name('admin.event.delete');

        Route::get('materi', [MateriController::class, 'index'])->name('admin.materi.index');
        Route::get('materi/create', [MateriController::class, 'create'])->name('admin.materi.create');
        Route::post('materi/store', [MateriController::class, 'store'])->name('admin.materi.store');
        Route::get('materi/{id}', [MateriController::class, 'show'])->name('admin.materi.show');
        Route::get('materi/edit/{id}', [MateriController::class, 'edit'])->name('admin.materi.edit');
        Route::put('materi/{id}', [MateriController::class, 'update'])->name('admin.materi.update');
        Route::delete('materi/{id}', [MateriController::class, 'destroy'])->name('admin.materi.delete');

        Route::get('article', [AdminArticleController::class, 'index'])->name('admin.article.index');
        Route::get('article/create', [AdminArticleController::class, 'create'])->name('admin.article.create');
        Route::post('article', [AdminArticleController::class, 'store'])->name('admin.article.store');
        Route::get('article/{id}', [AdminArticleController::class, 'show'])->name('admin.article.show');
        Route::get('article/edit/{id}', [AdminArticleController::class, 'edit'])->name('admin.article.edit');
        Route::put('article/{id}', [AdminArticleController::class, 'update'])->name('admin.article.update');
        Route::delete('article/{id}', [AdminArticleController::class, 'destroy'])->name('admin.article.delete');

        Route::get('minatbakat', [AdminMinatBakatController::class, 'index'])->name('admin.minatbakat.index');
        Route::get('minatbakat/{id}', [AdminMinatBakatController::class, 'show'])->name('admin.minatbakat.show');
        Route::get('minatbakat/edit/{id}', [AdminMinatBakatController::class, 'edit'])->name('admin.minatbakat.edit');
        Route::put('minatbakat/{id}', [AdminMinatBakatController::class, 'update'])->name('admin.minatbakat.update');
        Route::delete('minatbakat/{id}', [AdminMinatBakatController::class, 'destroy'])->name('admin.minatbakat.delete');
    });
});
