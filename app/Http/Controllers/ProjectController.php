<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Tampilkan daftar proyek.
     */
    public function index()
    {
        $projects = Project::where('is_published', true)->orderBy('created_at', 'desc')->get();
        return view('projects', compact('projects'));
    }

    /**
     * Tampilkan detail proyek.
     */
    public function show($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        return view('project-show', compact('project'));
    }
}
