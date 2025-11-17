<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

/**
 * ServiceController untuk Editor.
 * 
 * Catatan: Livewire EditorServiceManager sekarang menangani semua operasi CRUD.
 * Method di controller ini tersedia untuk backward compatibility.
 */
class ServiceController extends Controller
{
    /**
     * Daftar layanan - Livewire akan menangani semua CRUD
     * Method ini hanya menampilkan view dengan komponen Livewire
     */
    public function index()
    {
        // Livewire EditorServiceManager component akan menangani semua logika
        return view('editor.services.index');
    }

    /**
     * Method create, store, update, destroy sekarang dihandle oleh Livewire
     * Jika ingin backward compatibility, method ini bisa dihapus
     * atau diganti dengan redirect ke halaman editor services index
     */
    public function create()
    {
        // Redirect ke halaman index dimana Livewire akan menampilkan form
        return redirect()->route('editor.services.index');
    }

    public function store(Request $request)
    {
        // Livewire menangani store operation
        return redirect()->route('editor.services.index');
    }

    public function show(Service $service)
    {
        // Redirect ke halaman index untuk edit
        return redirect()->route('editor.services.index');
    }

    public function edit(Service $service)
    {
        // Redirect ke halaman index dimana Livewire akan menampilkan form
        return redirect()->route('editor.services.index');
    }

    public function update(Request $request, Service $service)
    {
        // Livewire menangani update operation
        return redirect()->route('editor.services.index');
    }

    public function destroy(Service $service)
    {
        // Livewire menangani delete operation
        return redirect()->route('editor.services.index');
    }
}
