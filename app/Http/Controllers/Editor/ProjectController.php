<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

/**
 * ProjectController untuk Editor
 * 
 * Catatan: Livewire EditorProjectManager sekarang menangani semua operasi CRUD.
 * Method di controller ini tersedia untuk backward compatibility dan hanya
 * menampilkan view dengan komponen Livewire EditorProjectManager.
 */
class ProjectController extends Controller
{
    /**
     * Daftar proyek - Livewire EditorProjectManager menangani semua CRUD
     * Method ini hanya menampilkan view dengan komponen Livewire
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Livewire EditorProjectManager component akan menangani semua logika CRUD
        // termasuk: create, store, update, destroy, delete
        return view('editor.projects.index');
    }

    /**
     * Redirect ke index - Livewire menampilkan form create di sana
     */
    public function create()
    {
        // Redirect ke halaman index dimana Livewire akan menampilkan form create
        return redirect()->route('editor.projects.index');
    }

    /**
     * Store operation - dihandle oleh Livewire EditorProjectManager
     */
    public function store(Request $request)
    {
        // Livewire menangani store operation secara real-time
        return redirect()->route('editor.projects.index');
    }

    /**
     * Show operation - dihandle oleh Livewire EditorProjectManager
     */
    public function show(Project $project)
    {
        // Redirect ke halaman index untuk edit
        return redirect()->route('editor.projects.index');
    }

    /**
     * Edit operation - dihandle oleh Livewire EditorProjectManager
     */
    public function edit(Project $project)
    {
        // Redirect ke halaman index dimana Livewire akan menampilkan form edit
        return redirect()->route('editor.projects.index');
    }

    /**
     * Update operation - dihandle oleh Livewire EditorProjectManager
     */
    public function update(Request $request, Project $project)
    {
        // Livewire menangani update operation secara real-time
        return redirect()->route('editor.projects.index');
    }

    /**
     * Delete operation - dihandle oleh Livewire EditorProjectManager
     */
    public function destroy(Project $project)
    {
        // Livewire menangani delete operation secara real-time
        return redirect()->route('editor.projects.index');
    }
}
