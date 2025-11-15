<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Rute publik untuk viewer (tidak memerlukan autentikasi): home, layanan,
| proyek, tentang kami, dan kontak. Rute admin berada pada prefix /admin
| dan dilindungi middleware 'auth'.
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/layanan', [ServiceController::class, 'index'])->name('services.index');
Route::get('/layanan/{slug}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/proyek', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/proyek/{slug}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{slug}', [PortfolioController::class, 'show'])->name('portfolio.show');

Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about');

Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak/kirim', [ContactController::class, 'send'])->name('contact.send');

// Group admin — memerlukan autentikasi
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('services', App\Http\Controllers\Admin\ServiceController::class)->names('services');
    Route::resource('projects', App\Http\Controllers\Admin\ProjectController::class)->names('projects');
});

// Auth routes (login, register, password, dll.)
require __DIR__.'/auth.php';
