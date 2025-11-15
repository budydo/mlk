<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Minimal routes untuk MVP publik. HomeController hanya menampilkan view
| beranda (resources/views/home.blade.php) yang sudah kita konversi.
| Nanti kita tambah group middleware untuk /admin, auth, dll.
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|-- contoh placeholder route untuk admin/dashboard (nanti di-protect dengan auth)
|   Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
|
| jika menggunakan Livewire di route publik, kamu bisa langsung return view
| yang memuat <livewire:... /> component.
*/
