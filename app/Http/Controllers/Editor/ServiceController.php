<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

/**
 * ServiceController untuk Editor
 * 
 * Catatan: Livewire EditorServiceManager sekarang menangani semua operasi CRUD.
 * Method di controller ini tersedia untuk backward compatibility dan hanya
 * menampilkan view dengan komponen Livewire EditorServiceManager.
 * 
 * Alasan menggunakan Livewire:
 * - Real-time updates tanpa page reload
 * - Performa lebih cepat (tidak perlu HTTP request ke controller)
 * - State management otomatis di component
 * - Validasi form langsung (bukan form tradisional)
 */
class ServiceController extends Controller
{
    /**
     * Daftar layanan - Livewire EditorServiceManager menangani semua CRUD
     * Method ini hanya menampilkan view dengan komponen Livewire
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Livewire EditorServiceManager component akan menangani semua logika CRUD
        // termasuk: create, store, update, destroy, delete, dan pencarian
        return view('editor.services.index');
    }

    /**
     * Redirect ke index - Livewire menampilkan form create di sana
     */
    public function create()
    {
        // Redirect ke halaman index dimana Livewire akan menampilkan form create
        return redirect()->route('editor.services.index');
    }

    /**
     * Store operation - dihandle oleh Livewire EditorServiceManager
     */
    public function store(Request $request)
    {
        // Livewire menangani store operation secara real-time
        return redirect()->route('editor.services.index');
    }

    /**
     * Show operation - dihandle oleh Livewire EditorServiceManager
     */
    public function show(Service $service)
    {
        // Redirect ke halaman index untuk edit
        return redirect()->route('editor.services.index');
    }

    /**
     * Edit operation - dihandle oleh Livewire EditorServiceManager
     */
    public function edit(Service $service)
    {
        // Redirect ke halaman index dimana Livewire akan menampilkan form edit
        return redirect()->route('editor.services.index');
    }

    /**
     * Update operation - dihandle oleh Livewire EditorServiceManager
     */
    public function update(Request $request, Service $service)
    {
        // Livewire menangani update operation secara real-time
        return redirect()->route('editor.services.index');
    }

    /**
     * Delete operation - dihandle oleh Livewire EditorServiceManager
     */
    public function destroy(Service $service)
    {
        // Livewire menangani delete operation secara real-time
        return redirect()->route('editor.services.index');
    }
}
