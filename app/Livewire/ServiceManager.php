<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ServiceManager extends Component
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
    
    // Properties untuk gambar - user bisa upload lokal atau link eksternal
    public $thumbnail_image = null; // File upload lokal dari user (Livewire file upload)
    public $image_url = ''; // Link eksternal gambar (dari unsplash, pexels, dll)
    public $image_path = ''; // Path gambar tersimpan (dari upload lokal atau link eksternal)

    // Properties untuk fitur dinamis (bukan JSON manual)
    // Array ini menampung list fitur yang akan disimpan ke database sebagai JSON
    public $features = []; // Contoh: ['Fitur 1', 'Fitur 2']
    public $newFeature = ''; // Input field sementara untuk menambah fitur baru

    // State management
    public $showForm = false;
    public $editingId = null;
    public $searchTerm = '';
    // Filter: jika true, hanya tampilkan layanan yang dipublikasikan
    public $onlyPublished = false;

    // Rules untuk validasi
    protected $rules = [
        'title' => 'required|string|max:191',
        'slug' => 'required|string|max:191',
        'excerpt' => 'nullable|string',
        'description' => 'nullable|string',
        'icon' => 'nullable|string',
        'image_path' => 'nullable|string', // Path gambar final (dari upload atau link eksternal)
        'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096', // Max 4MB, format jpg/jpeg/png
        'image_url' => 'nullable|url', // Link eksternal harus URL valid
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
     * Mount component - panggil saat component dimuat
     */
    public function mount()
    {
        // Inisialisasi jika diperlukan
    }

    /**
     * Render component dengan data services
     */
    public function render()
    {
        // Ambil services berdasarkan search term atau semua jika kosong
        $services = Service::query()
            // Jika user mengetik kata pencarian, cari di title atau slug
            ->when($this->searchTerm, function ($q) {
                $q->where('title', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('slug', 'like', '%' . $this->searchTerm . '%');
            })
            // Jika toggle onlyPublished aktif, tambahkan kondisi is_published = 1
            ->when($this->onlyPublished, function ($q) {
                $q->where('is_published', 1);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.service-manager', compact('services'));
    }

    /**
     * Reset pagination saat filter berubah sehingga hasil kembali ke halaman 1.
     * Livewire memanggil method ini otomatis ketika property `onlyPublished` di-update.
     */
    public function updatedOnlyPublished()
    {
        $this->resetPage();
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
        $this->image_path = $service->image_path;
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
     * 
     * CATATAN: Upload diproses langsung saat user memilih file (real-time)
     * agar user bisa preview gambar sebelum submit form
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
            // Livewire's WithFileUploads trait menangani temporary file upload
            // File akan disimpan ke storage/app/public/services/{nama-file}
            $path = $this->thumbnail_image->store('services', 'public');

            // Set image_path ke path relatif dari folder public
            // Path akan disimpan ke database dalam format: 'services/nama-file.jpg'
            $this->image_path = $path;
            
            // Kosongkan image_url karena user memilih upload file lokal, bukan link eksternal
            $this->image_url = '';

            // Tampilkan notifikasi sukses ke user
            $this->dispatch('notify', message: 'Gambar berhasil diunggah', type: 'success');
        } catch (\Exception $e) {
            // Jika terjadi error (validasi, akses file, dll), tampilkan pesan error detail
            $this->dispatch('notify', message: 'Error upload: ' . $e->getMessage(), type: 'error');
            
            // Reset thumbnail_image agar user bisa coba upload lagi
            $this->thumbnail_image = null;
        }
    }

    /**
     * Method dipanggil saat user mengubah field image_url (link eksternal).
     * Validasi bahwa link adalah URL yang valid.
     */
    public function updatedImageUrl()
    {
        // Jika image_url tidak kosong, validasi format URL-nya
        if (!empty($this->image_url)) {
            try {
                // Validasi URL menggunakan filter bawaan PHP
                if (!filter_var($this->image_url, FILTER_VALIDATE_URL)) {
                    // Jika bukan URL valid, tampilkan pesan error dan kosongkan field
                    $this->addError('image_url', 'Link gambar harus berupa URL yang valid (dimulai dengan http:// atau https://).');
                    return;
                }

                // Jika URL valid, gunakan sebagai image_path
                $this->image_path = $this->image_url;
                
                // Kosongkan thumbnail_image karena user memilih link eksternal, bukan upload lokal
                $this->thumbnail_image = null;

                $this->dispatch('notify', message: 'Link gambar berhasil disimpan', type: 'success');
            } catch (\Exception $e) {
                // Jika terjadi error, tampilkan pesan error
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
            $this->dispatch('notify', message: 'Layanan berhasil dihapus.', type: 'success');
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Terjadi kesalahan saat menghapus: ' . $e->getMessage(), type: 'error');
        }
    }

    /**
     * Toggle status publikasi layanan (is_published) secara cepat dari tabel.
     *
     * Method ini membalik nilai boolean `is_published` dan menyimpan perubahan
     * ke database. Dipanggil dari view saat admin/editor klik checkbox toggle.
     *
     * @param int $id
     * @return void
     */
    public function togglePublished($id)
    {
        try {
            $service = Service::findOrFail($id);

            // Balikkan nilai is_published
            $service->is_published = ! (bool) $service->is_published;
            $service->save();

            // Kirim notifikasi ke frontend (Livewire listener di view akan menampilkan toast)
            // PENTING: message harus string, bukan array
            $this->dispatch('notify', message: 'Status publikasi berhasil diperbarui.', type: 'success');
        } catch (\Exception $e) {
            // Jika terjadi error, kirim pesan error
            $this->dispatch('notify', message: 'Gagal memperbarui status: ' . $e->getMessage(), type: 'error');
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
     * Digunakan setelah form ditutup atau data berhasil disimpan
     */
    private function resetForm()
    {
        // Reset menggunakan method reset() dari Livewire untuk clear semua property
        // Ini sangat penting untuk membersihkan file upload yang sudah dipilih
        $this->reset([
            'title',           // Judul layanan
            'slug',            // URL slug
            'excerpt',         // Ringkasan singkat
            'description',     // Deskripsi lengkap
            'icon',            // Icon layanan
            'image_path',      // Path gambar final (lokal atau eksternal)
            'thumbnail_image', // File upload yang dipilih (hapus object UploadedFile agar bersih)
            'image_url',       // Link eksternal gambar
            'features',        // Array daftar fitur
            'newFeature',      // Input sementara fitur baru
            'is_published',    // Status publikasi
            'editingId',       // ID layanan saat edit mode
        ]);
    }
}
