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
     * Daftar layanan (CRUD sederhana untuk dashboard).
     */
    public function index()
    {
        $services = Service::orderBy('created_at','desc')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:191',
            'slug' => 'required|string|max:191|unique:services,slug',
            'excerpt' => 'nullable|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'is_published' => 'nullable|boolean',
        ]);
        $data['is_published'] = !empty($data['is_published']);
        Service::create($data);
        return redirect()->route('admin.services.index')->with('success','Layanan berhasil ditambahkan.');
    }

    // Edit, update, delete bisa ditambahkan serupa.
}
