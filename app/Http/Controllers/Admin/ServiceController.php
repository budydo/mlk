<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

/**
 * ServiceController untuk Admin
 * 
 * Catatan: Livewire ServiceManager sekarang menangani semua operasi CRUD.
 * Method di controller ini tersedia untuk backward compatibility dan hanya
 * menampilkan view dengan komponen Livewire ServiceManager.
 * 
 * Alasan menggunakan Livewire:
 * - Real-time updates tanpa page reload
 * - Performa lebih cepat (tidak perlu HTTP request ke controller)
 * - State management otomatis di component
 * - Validasi form langsung (bukan form tradisional)
 */
class ServiceController extends Controller
{
    public function __construct()
    {
        // Middleware untuk membatasi akses: hanya admin dan editor
        $this->middleware(function ($request, $next) {
            $user = $request->user();
            if (! $user || ! in_array($user->role, ['admin', 'editor'])) {
                abort(403, 'Akses terlarang.');
            }
            return $next($request);
        });
    }

    /**
     * Daftar layanan - Livewire ServiceManager menangani semua CRUD
     * Method ini hanya menampilkan view dengan komponen Livewire
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Livewire ServiceManager component akan menangani semua logika CRUD
        // termasuk: create, store, update, destroy, delete, dan pencarian
        return view('admin.services.index');
    }

    /**
     * Redirect ke index - Livewire menampilkan form create di sana
     */
    public function create()
    {
        // Redirect ke halaman index dimana Livewire akan menampilkan form create
        return redirect()->route('admin.services.index');
    }

    /**
     * Store operation - dihandle oleh Livewire ServiceManager
     */
    public function store(Request $request)
    {
        // Livewire menangani store operation secara real-time
        return redirect()->route('admin.services.index');
    }

    /**
     * Show operation - dihandle oleh Livewire ServiceManager
     */
    public function show(Service $service)
    {
        // Redirect ke halaman index untuk edit
        return redirect()->route('admin.services.index');
    }

    /**
     * Edit operation - dihandle oleh Livewire ServiceManager
     */
    public function edit(Service $service)
    {
        // Redirect ke halaman index dimana Livewire akan menampilkan form edit
        return redirect()->route('admin.services.index');
    }

    /**
     * Update operation - dihandle oleh Livewire ServiceManager
     */
    public function update(Request $request, Service $service)
    {
        // Livewire menangani update operation secara real-time
        return redirect()->route('admin.services.index');
    }

    /**
     * Delete operation - dihandle oleh Livewire ServiceManager
     */
    public function destroy(Service $service)
    {
        // Livewire menangani delete operation secara real-time
        return redirect()->route('admin.services.index');
    }
}
