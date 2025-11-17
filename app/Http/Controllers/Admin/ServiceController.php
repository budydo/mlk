<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct()
    {
        // Batasi akses: hanya admin/editor
        $this->middleware(function ($request, $next) {
            $user = $request->user();
            if (! $user || ! in_array($user->role, ['admin','editor'])) {
                abort(403, 'Akses terlarang.');
            }
            return $next($request);
        });
    }

    /**
     * Daftar layanan - Livewire akan menangani semua CRUD
     * Method ini hanya menampilkan view dengan komponen Livewire
     */
    public function index()
    {
        // Livewire ServiceManager component akan menangani semua logika
        return view('admin.services.index');
    }

    /**
     * Method create, store, update, destroy sekarang dihandle oleh Livewire
     * Jika ingin backward compatibility, method ini bisa dihapus
     * atau diganti dengan redirect ke halaman admin services index
     */
    public function create()
    {
        // Redirect ke halaman index dimana Livewire akan menampilkan form
        return redirect()->route('admin.services.index');
    }

    public function store(Request $request)
    {
        // Livewire menangani store operation
        return redirect()->route('admin.services.index');
    }

    public function edit(Service $service)
    {
        // Redirect ke halaman index dimana Livewire akan menampilkan form
        return redirect()->route('admin.services.index');
    }

    public function update(Request $request, Service $service)
    {
        // Livewire menangani update operation
        return redirect()->route('admin.services.index');
    }

    public function destroy(Service $service)
    {
        // Livewire menangani delete operation
        return redirect()->route('admin.services.index');
    }
}
