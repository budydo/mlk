<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

/**
 * ProjectController untuk Admin
 * 
 * Catatan: Livewire ProjectManager sekarang menangani semua operasi CRUD.
 * Method di controller ini tersedia untuk backward compatibility dan hanya
 * menampilkan view dengan komponen Livewire ProjectManager.
 */
class ProjectController extends Controller
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
     * Daftar proyek - Livewire ProjectManager menangani semua CRUD
     * Method ini hanya menampilkan view dengan komponen Livewire
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Livewire ProjectManager component akan menangani semua logika CRUD
        // termasuk: create, store, update, destroy, delete
        return view('admin.projects.index');
    }

    /**
     * Redirect ke index - Livewire menampilkan form create di sana
     */
    public function create()
    {
        // Redirect ke halaman index dimana Livewire akan menampilkan form create
        return redirect()->route('admin.projects.index');
    }

    /**
     * Store operation - dihandle oleh Livewire ProjectManager
     */
    public function store(Request $request)
    {
        // Livewire menangani store operation secara real-time
        return redirect()->route('admin.projects.index');
    }

    /**
     * Show operation - dihandle oleh Livewire ProjectManager
     */
    public function show(Project $project)
    {
        // Redirect ke halaman index untuk edit
        return redirect()->route('admin.projects.index');
    }

    /**
     * Edit operation - dihandle oleh Livewire ProjectManager
     */
    public function edit(Project $project)
    {
        // Redirect ke halaman index dimana Livewire akan menampilkan form edit
        return redirect()->route('admin.projects.index');
    }

    /**
     * Update operation - dihandle oleh Livewire ProjectManager
     */
    public function update(Request $request, Project $project)
    {
        // Livewire menangani update operation secara real-time
        return redirect()->route('admin.projects.index');
    }

    /**
     * Delete operation - dihandle oleh Livewire ProjectManager
     */
    public function destroy(Project $project)
    {
        // Livewire menangani delete operation secara real-time
        return redirect()->route('admin.projects.index');
    }
}
