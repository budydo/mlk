<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = $request->user();
            if (! $user || ! in_array($user->role, ['admin','editor'])) {
                abort(403, 'Akses terlarang.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $projects = Project::orderBy('created_at','desc')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:191',
            'slug' => 'required|string|max:191|unique:projects,slug',
            'cover_image' => 'nullable|string',
            'excerpt' => 'nullable|string',
            'description' => 'nullable|string',
            'is_published' => 'nullable|boolean',
        ]);
        $data['is_published'] = !empty($data['is_published']);
        Project::create($data);
        return redirect()->route('admin.projects.index')->with('success','Proyek berhasil ditambahkan.');
    }
}
