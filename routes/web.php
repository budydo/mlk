<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;

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

// DEBUG ROUTE - untuk test image URLs (akan dihapus nanti)
Route::get('/debug-services', function () {
    $services = \App\Models\Service::where('is_published', 1)->get();
    return view('debug.services', ['services' => $services]);
})->name('debug.services');

Route::get('/layanan', [ServiceController::class, 'index'])->name('services.index');
Route::get('/layanan/{slug}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/proyek', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/proyek/{slug}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{slug}', [PortfolioController::class, 'show'])->name('portfolio.show');

Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about');

Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak/kirim', [ContactController::class, 'send'])->name('contact.send');

// Blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Group admin — memerlukan autentikasi dan role admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->names('users');
    Route::resource('services', App\Http\Controllers\Admin\ServiceController::class)->names('services');
    Route::resource('projects', App\Http\Controllers\Admin\ProjectController::class)->names('projects');
    Route::resource('contact-messages', App\Http\Controllers\Admin\ContactMessageController::class)->only(['index','show','destroy'])->names('contact-messages');
    Route::post('contact-messages/{contactMessage}/reply', [App\Http\Controllers\Admin\ContactMessageController::class, 'reply'])->name('contact-messages.reply');
});

// Group editor — memerlukan autentikasi dan role editor
Route::middleware(['auth', 'role:editor'])->prefix('editor')->name('editor.')->group(function () {
    Route::get('/', [App\Http\Controllers\Editor\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('home-contents', App\Http\Controllers\Editor\HomeContentController::class)->names('home-contents');
    Route::resource('services', App\Http\Controllers\Editor\ServiceController::class)->names('services');
    Route::resource('projects', App\Http\Controllers\Editor\ProjectController::class)->names('projects');
    Route::resource('contact-messages', App\Http\Controllers\Editor\ContactMessageController::class)->only(['index', 'show', 'destroy'])->names('contact-messages');
    // Route untuk mengirim balasan oleh editor (mirip seperti admin)
    Route::post('contact-messages/{contactMessage}/reply', [App\Http\Controllers\Editor\ContactMessageController::class, 'reply'])->name('contact-messages.reply');
});

// Auth routes (login, register, password, dll.)
require __DIR__.'/auth.php';
