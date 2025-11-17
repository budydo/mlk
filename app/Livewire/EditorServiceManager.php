<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

/**
 * Komponen Livewire untuk Editor mengelola Services
 * Hampir sama dengan ServiceManager untuk Admin,
 * tapi khusus untuk role Editor
 */
class EditorServiceManager extends Component
{
    use WithPagination;
    use WithFileUploads;

    // Properties untuk form input field
    public $title = '';
    public $slug = '';
    public $excerpt = '';
    public $description = '';
    public $icon = '';
    public $is_published = false;
    // File upload lokal dari user
    public $thumbnail_image = null; // File upload lokal dari user
    // Link eksternal gambar (jika user memberikan URL instead of upload)
    public $image_url = ''; // Link eksternal gambar
    // Path final yang digunakan untuk menyimpan ke DB (bisa berasal dari upload atau dari image_url)
    public $image_path = ''; // Path final (dari upload atau link eksternal)

    // Properties untuk fitur dinamis (bukan JSON manual)
    // Array ini menampung list fitur yang akan disimpan ke database sebagai JSON
    public $features = []; // Contoh: ['Fitur 1', 'Fitur 2']
    public $newFeature = ''; // Input field sementara untuk menambah fitur baru

    // State management
    public $showForm = false;
    public $editingId = null;
    public $searchTerm = '';

    // Rules untuk validasi
    protected $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:191',
        'excerpt' => 'nullable|string',
        'description' => 'nullable|string',
        'icon' => 'nullable|string',
        // image_path menyimpan path final (dari upload atau URL eksternal)
        'image_path' => 'nullable|string',
        // thumbnail_image: file upload lokal, batasi ke jpeg/png/jpg dan 4MB
        'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096', // Max 4MB
        // image_url: jika user memasukkan link eksternal, harus berupa URL valid
        'image_url' => 'nullable|url',
        'features' => 'nullable|array', // Sekarang array, bukan JSON string
        'is_published' => 'nullable|boolean',
    ];

    // Pesan error custom
    protected $messages = [
        'title.required' => 'Judul layanan wajib diisi.',
        'slug.required' => 'Slug wajib diisi.',
        'thumbnail_image.image' => 'File harus berupa gambar.',
        'thumbnail_image.mimes' => 'Format gambar harus JPG, PNG, atau JPEG.',
        'thumbnail_image.max' => 'Ukuran gambar maksimal 4MB.',
    ];

    /**
     * Render component dengan data services
     */
    public function render()
    {
        // Ambil services berdasarkan search term atau semua jika kosong
        $services = Service::query()
            ->when($this->searchTerm, function ($q) {
                $q->where('title', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('slug', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.editor-service-manager', compact('services'));
    }

    /**
     * Tampilkan form untuk tambah layanan
     */
    public function showCreateForm()
    {
        // Reset form terlebih dahulu
        $this->resetForm();
        $this->showForm = true;
        $this->editingId = null;
    }

    /**
     * Tampilkan form untuk edit layanan
     */
    public function showEditForm($id)
    {
        // Ambil data service dari database
        $service = Service::findOrFail($id);
        
        // Isi form dengan data service
        $this->editingId = $id;
        $this->title = $service->title;
        $this->slug = $service->slug;
        $this->excerpt = $service->excerpt;
        $this->description = $service->description;
        $this->icon = $service->icon;
        // Tentukan sumber gambar: apakah URL eksternal atau path lokal
        $this->image_path = $service->image_path;
        // Jika image_path berisi URL (http/https), simpan ke image_url
        if (!empty($service->image_path) && preg_match('/^https?:\/\//i', $service->image_path)) {
            // External image: set image_url agar input URL menampilkan nilai
            $this->image_url = $service->image_path;
            // Tidak ada file upload lokal untuk diisi
            $this->thumbnail_image = null;
            // image_path tetap berisi URL karena itulah nilai final yang disimpan
            $this->image_path = $service->image_path;
        } else {
            // Lokal path: tidak ada URL eksternal
            $this->image_url = '';
            // thumbnail_image tidak dapat direstore sebagai file, tetap null
            $this->thumbnail_image = null;
            // image_path tetap berisi path lokal (mis. 'services/filename.jpg')
            $this->image_path = $service->image_path;
        }
        // Convert fitur dari JSON ke array untuk ditampilkan di form dinamis
        $this->features = is_array($service->features) ? $service->features : [];
        $this->is_published = (bool) $service->is_published;
        
        $this->showForm = true;
    }

    /**
     * Tambahkan fitur baru ke list fitur dinamis.
     * Method ini dipanggil saat user klik tombol "Tambah Fitur"
     */
    public function addFeature()
    {
        // Validasi input field newFeature tidak boleh kosong
        if (empty(trim($this->newFeature))) {
            $this->dispatch('notify', message: 'Masukkan teks fitur terlebih dahulu', type: 'error');
            return;
        }

        // Tambahkan fitur baru ke array features
        $this->features[] = trim($this->newFeature);
        
        // Reset input field setelah ditambahkan
        $this->newFeature = '';
    }

    /**
     * Hapus fitur dari list berdasarkan index.
     * Method ini dipanggil saat user klik tombol "Hapus" di setiap fitur
     *
     * @param int $index Index fitur dalam array
     */
    public function removeFeature($index)
    {
        // Hapus fitur pada index tertentu
        unset($this->features[$index]);
        
        // Re-index array agar tidak ada gap (penting saat render)
        $this->features = array_values($this->features);
    }

    /**
     * Handle upload gambar thumbnail.
     * Method ini dipanggil otomatis saat user memilih file di input
     * Livewire memanggil method ini via hook updated{PropertyName}
     */
    public function updatedThumbnailImage()
    {
        // Periksa apakah ada file yang dipilih user
        if (!$this->thumbnail_image) {
            return;
        }

        try {
            // Validasi file terlebih dahulu sebelum upload
            // File harus berupa image, format jpeg/png/jpg, dan maksimal 4MB (4096KB)
            $this->validateOnly('thumbnail_image');

            // Simpan file ke folder storage/app/public/services
            // Parameter 'public' berarti disk adalah 'public' (storage/app/public)
            $path = $this->thumbnail_image->store('services', 'public');

            // Set image_path ke path relatif dari folder public
            // Path akan disimpan ke database dalam format: 'services/nama-file.jpg'
            $this->image_path = $path;

            // Kosongkan image_url karena user memilih upload file lokal, bukan link eksternal
            $this->image_url = '';

            $this->dispatch('notify', message: 'Gambar berhasil diunggah', type: 'success');
        } catch (\Exception $e) {
            // Jika terjadi error, tampilkan pesan error detail kepada user
            $this->dispatch('notify', message: 'Error upload: ' . $e->getMessage(), type: 'error');
            
            // Reset thumbnail_image agar user bisa coba upload lagi
            $this->thumbnail_image = null;
        }
    }

    /**
     * Handle perubahan pada input `image_url`.
     * Livewire akan memanggil updatedImageUrl() saat properti `image_url` berubah.
     * Method ini melakukan validasi URL dan jika valid, menetapkan `image_path`
     * ke URL tersebut serta mereset `thumbnail_image` karena sumber gambar sekarang eksternal.
     */
    public function updatedImageUrl()
    {
        // Jika image_url tidak kosong, validasi format URL-nya
        if (!empty($this->image_url)) {
            try {
                // Validasi URL menggunakan filter bawaan PHP
                // URL harus dimulai dengan http:// atau https://
                if (!filter_var($this->image_url, FILTER_VALIDATE_URL)) {
                    // Jika bukan URL valid, tampilkan pesan error
                    $this->addError('image_url', 'Link gambar harus berupa URL yang valid (dimulai dengan http:// atau https://).');
                    return;
                }

                // Jika URL valid, gunakan sebagai image_path untuk disimpan ke database
                $this->image_path = $this->image_url;
                
                // Kosongkan thumbnail_image karena user memilih link eksternal, bukan upload lokal
                $this->thumbnail_image = null;

                $this->dispatch('notify', message: 'Link gambar berhasil disimpan', type: 'success');
            } catch (\Exception $e) {
                // Jika terjadi error, tampilkan pesan error kepada user
                $this->dispatch('notify', message: 'Error validasi URL: ' . $e->getMessage(), type: 'error');
            }
        }
    }

    /**
     * Simpan service (create atau update).
     * Fitur sekarang disimpan langsung sebagai array (casting model akan convert ke JSON).
     * 
     * Flow:
     * 1. Validasi semua input
     * 2. Periksa slug unik
     * 3. Tangani gambar (upload lokal atau URL eksternal)
     * 4. Simpan ke database
     */
    public function save()
    {
        // Validasi input terlebih dahulu
        // Ini akan memvalidasi: title, slug, thumbnail_image, image_url, dll
        $this->validate();

        try {
            // Validasi slug unik (kecuali untuk data yang sedang diedit)
            if ($this->editingId) {
                // Saat edit: slug harus unik untuk service ID lain
                $slugExists = Service::where('slug', $this->slug)
                    ->where('id', '!=', $this->editingId)
                    ->exists();
            } else {
                // Saat create: slug harus unik di semua service
                $slugExists = Service::where('slug', $this->slug)->exists();
            }

            if ($slugExists) {
                $this->addError('slug', 'Slug sudah digunakan oleh service lain.');
                return;
            }

            // Siapkan data untuk disimpan ke database
            $data = [
                'title' => $this->title,
                'slug' => $this->slug,
                'excerpt' => $this->excerpt,
                'description' => $this->description,
                'icon' => $this->icon,
                'image_path' => $this->image_path, // Sudah berisi path lokal atau URL eksternal
                'is_published' => $this->is_published,
                // Features sudah dalam bentuk array, model akan otomatis cast ke JSON
                'features' => !empty($this->features) ? $this->features : [],
            ];

            // Simpan atau update service
            if ($this->editingId) {
                // Update service yang ada
                Service::find($this->editingId)->update($data);
                $message = 'Layanan berhasil diperbarui.';
            } else {
                // Buat service baru
                Service::create($data);
                $message = 'Layanan berhasil ditambahkan.';
            }

            // Reset form dan tampilkan pesan sukses
            $this->showForm = false;
            $this->resetForm();
            $this->dispatch('notify', message: $message, type: 'success');

        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Terjadi kesalahan: ' . $e->getMessage(), type: 'error');
        }
    }

    /**
     * Hapus service
     */
    public function delete($id)
    {
        try {
            Service::findOrFail($id)->delete();
            // Message harus string, bukan array
            $this->dispatch('notify', message: 'Layanan berhasil dihapus.', type: 'success');
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Terjadi kesalahan saat menghapus: ' . $e->getMessage(), type: 'error');
        }
    }

    /**
     * Batalkan form dan reset
     */
    public function cancel()
    {
        $this->showForm = false;
        $this->resetForm();
    }

    /**
     * Reset semua form fields ke nilai default
     */
    private function resetForm()
    {
        // Reset menggunakan method reset() dari Livewire untuk clear semua property
        // Penting: thumbnail_image harus di-reset untuk membersihkan file upload yang sudah dipilih
        $this->reset([
            'title',           // Judul layanan
            'slug',            // URL slug
            'excerpt',         // Ringkasan singkat
            'description',     // Deskripsi lengkap
            'icon',            // Icon layanan
            'image_path',      // Path gambar final (lokal atau eksternal)
            'thumbnail_image', // File upload yang dipilih (hapus object UploadedFile)
            'image_url',       // Link eksternal gambar
            'features',        // Array daftar fitur
            'newFeature',      // Input sementara fitur baru
            'is_published',    // Status publikasi
            'editingId',       // ID layanan saat edit
        ]);
    }
}
