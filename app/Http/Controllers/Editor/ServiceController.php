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
        // Menangani pencarian dan filter untuk tampilan editor (non-Livewire)
        $q = request()->input('q', '');
        $onlyPublished = request()->has('onlyPublished') && request()->input('onlyPublished') == '1';

        $query = Service::query()
            ->when($q, function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                      ->orWhere('slug', 'like', "%{$q}%");
            })
            ->when($onlyPublished, function ($query) {
                $query->where('is_published', 1);
            })
            ->orderBy('created_at', 'desc');

        $services = $query->paginate(10)->withQueryString();

        return view('editor.services.index', compact('services', 'q', 'onlyPublished'));
    }

    /**
     * Redirect ke index - Livewire menampilkan form create di sana
     */
    public function create()
    {
        return view('editor.services.create');
    }

    /**
     * Store operation - dihandle oleh Livewire EditorServiceManager
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:191',
            'slug' => 'required|string|max:191|unique:services,slug',
            'excerpt' => 'nullable|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'image_url' => 'nullable|string|max:1000',
            'features' => 'nullable|array',
            'is_published' => 'sometimes|boolean',
        ]);

        if ($request->hasFile('thumbnail_image')) {
            $file = $request->file('thumbnail_image');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $dest = public_path('images/services');
            if (!file_exists($dest)) mkdir($dest, 0755, true);
            $file->move($dest, $filename);
            $data['image_path'] = 'images/services/' . $filename;
        } elseif (!empty($data['image_url'])) {
            $data['image_path'] = $data['image_url'];
        }

        $data['features'] = $data['features'] ?? [];
        $data['is_published'] = isset($data['is_published']) ? (bool) $data['is_published'] : false;

        Service::create($data);

        return redirect()->route('editor.services.index')->with('success', 'Layanan berhasil ditambahkan.');
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
        return view('editor.services.edit', compact('service'));
    }

    /**
     * Update operation - dihandle oleh Livewire EditorServiceManager
     */
    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title' => 'required|string|max:191',
            'slug' => 'required|string|max:191|unique:services,slug,' . $service->id,
            'excerpt' => 'nullable|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'image_url' => 'nullable|string|max:1000',
            'features' => 'nullable|array',
            'is_published' => 'sometimes|boolean',
        ]);

        if ($request->hasFile('thumbnail_image')) {
            // Hapus file lama jika disimpan di folder public/images/services
            if (!empty($service->image_path) && strpos($service->image_path, 'images/') === 0) {
                $old = public_path($service->image_path);
                if (file_exists($old)) @unlink($old);
            }
            $file = $request->file('thumbnail_image');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $dest = public_path('images/services');
            if (!file_exists($dest)) mkdir($dest, 0755, true);
            $file->move($dest, $filename);
            $data['image_path'] = 'images/services/' . $filename;
        } elseif (!empty($data['image_url'])) {
            $data['image_path'] = $data['image_url'];
        }

        $data['features'] = $data['features'] ?? [];
        $data['is_published'] = isset($data['is_published']) ? (bool) $data['is_published'] : false;

        $service->update($data);

        return redirect()->route('editor.services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    /**
     * Delete operation - dihandle oleh Livewire EditorServiceManager
     */
    public function destroy(Service $service)
    {
        // Hapus file lokal jika ada
        if (!empty($service->image_path) && strpos($service->image_path, 'images/') === 0) {
            $path = public_path($service->image_path);
            if (file_exists($path)) @unlink($path);
        }

        $service->delete();

        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('editor.services.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
