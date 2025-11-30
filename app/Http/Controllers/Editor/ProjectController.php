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
        // Berikan data projects paginasi untuk view blade (server-side pagination)
        $projects = Project::orderBy('created_at', 'desc')->paginate(10);
        return view('editor.projects.index', compact('projects'));
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
        return view('editor.projects.edit', compact('project'));
    }

    /**
     * Update operation - dihandle oleh Livewire EditorProjectManager
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:191',
            'is_published' => 'sometimes|boolean',
        ]);

        if (array_key_exists('is_published', $data)) {
            $project->is_published = (bool) $data['is_published'];
        }
        if (array_key_exists('title', $data)) {
            $project->title = $data['title'];
        }
        if (array_key_exists('slug', $data)) {
            $project->slug = $data['slug'];
        }

        $project->save();

        return redirect()->route('editor.projects.index')->with('success', 'Project berhasil diperbarui.');
    }

    /**
     * Delete operation - dihandle oleh Livewire EditorProjectManager
     */
    public function destroy(Project $project)
    {
        $project->delete();

        // Jika request adalah AJAX, kembalikan JSON
        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('editor.projects.index')->with('success', 'Project berhasil dihapus.');
    }
}
