<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

/**
 * ServiceController untuk Admin
 * 
 * Catatan: Livewire ServiceManager sekarang menangani semua operasi CRUD.
 * Method di controller ini tersedia untuk backward compatibility dan hanya
 * menampilkan view dengan komponen Livewire ServiceManager.
 * 
 * Alasan menggunakan Livewire:
 * - Real-time updates tanpa page reload
 * - Performa lebih cepat (tidak perlu HTTP request ke controller)
 * - State management otomatis di component
 * - Validasi form langsung (bukan form tradisional)
 */
class ServiceController extends Controller
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
     * Daftar layanan - Livewire ServiceManager menangani semua CRUD
     * Method ini hanya menampilkan view dengan komponen Livewire
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Menangani parameter pencarian dan filter publikasi untuk tampilan admin (server-side)
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

        // Kirim data pencarian dan filter ke view agar state tetap
        return view('admin.services.index', compact('services', 'q', 'onlyPublished'));
    }

    /**
     * Tampilkan form create (non-Livewire)
     */
    public function create()
    {
        return view('admin.services.create');
    }



    /**
     * Store operation - dihandle oleh Livewire ServiceManager
     */
    public function store(Request $request)
    {
        // Validasi input
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

        // Tangani upload file jika ada — simpan ke public/images/services
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

        // Simpan features (array) sebagai JSON lewat Eloquent casting
        $data['features'] = $data['features'] ?? [];
        $data['is_published'] = isset($data['is_published']) ? (bool) $data['is_published'] : false;

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    /**
     * Show operation - dihandle oleh Livewire ServiceManager
     */
    public function show(Service $service)
    {
        // Redirect ke halaman index untuk edit
        return redirect()->route('admin.services.index');
    }

    /**
     * Edit operation - dihandle oleh Livewire ServiceManager
     */
    public function edit(Service $service)
    {
        // Tampilkan halaman edit (server-side)
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update operation - dihandle oleh Livewire ServiceManager
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

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    /**
     * Delete operation - dihandle oleh Livewire ServiceManager
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

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
