<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterialSKDController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.loginForm');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
    //Admin Home page after login
    Route::group(['middleware'=>'checkAdmin'], function() {
        Route::get('/home', [AdminController::class, 'index'])->name('admin.home');
    });
});



// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/test-react', function () {
//     return Inertia::render('Test', [
//         'company' => 'Webister',
//         'initSetup' => '17-09-2023'
//     ]);
// });