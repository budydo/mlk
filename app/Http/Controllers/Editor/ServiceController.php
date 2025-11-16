<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

/**
 * ServiceController untuk Editor.
 */
class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::paginate(15);
        return view('editor.services.index', compact('services'));
    }

    public function create()
    {
        return view('editor.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:services,slug',
            'excerpt' => 'nullable|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'image_path' => 'nullable|string',
            'features' => 'nullable|json',
            'is_published' => 'boolean',
        ]);

        Service::create($validated);

        return redirect()->route('editor.services.index')
            ->with('success', 'Service berhasil dibuat.');
    }

    public function show(Service $service)
    {
        return view('editor.services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('editor.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:services,slug,' . $service->id,
            'excerpt' => 'nullable|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'image_path' => 'nullable|string',
            'features' => 'nullable|json',
            'is_published' => 'boolean',
        ]);

        $service->update($validated);

        return redirect()->route('editor.services.index')
            ->with('success', 'Service berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('editor.services.index')
            ->with('success', 'Service berhasil dihapus.');
    }
}
