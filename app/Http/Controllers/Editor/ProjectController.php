<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

/**
 * ProjectController untuk Editor.
 */
class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::paginate(15);
        return view('editor.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('editor.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:projects,slug',
            'excerpt' => 'nullable|string',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|string',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        Project::create($validated);

        return redirect()->route('editor.projects.index')
            ->with('success', 'Project berhasil dibuat.');
    }

    public function show(Project $project)
    {
        return view('editor.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('editor.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:projects,slug,' . $project->id,
            'excerpt' => 'nullable|string',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|string',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $project->update($validated);

        return redirect()->route('editor.projects.index')
            ->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('editor.projects.index')
            ->with('success', 'Project berhasil dihapus.');
    }
}
