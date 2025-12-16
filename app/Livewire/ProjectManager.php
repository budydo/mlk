<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

/**
 * Komponen Livewire untuk Admin mengelola Projects (Proyek/Portofolio)
 * Struktur serupa dengan ServiceManager agar tampilan dan fungsionalitas konsisten.
 */
class ProjectManager extends Component
{
    use WithPagination;
    use WithFileUploads;

    // Field form
    public $title = '';
    public $slug = '';
    public $excerpt = '';
    public $description = '';
    public $is_published = false;
    public $is_featured = false;

    // Upload dan URL gambar
    public $thumbnail_image = null; // object UploadedFile
    public $image_url = ''; // jika user memasukkan link eksternal
    public $image_path = ''; // path final yang disimpan ke DB

    // State
    public $showForm = false;
    public $editingId = null;
    public $searchTerm = '';

    // Filter untuk menampilkan hanya proyek yang dipublikasikan
    public $onlyPublished = false; // jika true, query akan memfilter hanya is_published = 1

    // Validasi
    protected $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:191',
        'excerpt' => 'nullable|string',
        'description' => 'nullable|string',
        'image_path' => 'nullable|string',
        'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
        'image_url' => 'nullable|url',
        'is_published' => 'nullable|boolean',
        'is_featured' => 'nullable|boolean',
    ];

    protected $messages = [
        'title.required' => 'Judul proyek wajib diisi.',
        'slug.required' => 'Slug wajib diisi.',
        'thumbnail_image.image' => 'File harus berupa gambar.',
        'thumbnail_image.mimes' => 'Format gambar harus JPG, PNG, atau JPEG.',
        'thumbnail_image.max' => 'Ukuran gambar maksimal 4MB.',
    ];

    // Render daftar projects dengan pagination dan filter pencarian
    public function render()
    {
        $projects = Project::query()
            // Filter pencarian berdasar judul atau slug
            ->when($this->searchTerm, function ($q) {
                $q->where('title', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('slug', 'like', '%' . $this->searchTerm . '%');
            })
            // Opsi filter: hanya yang dipublikasikan
            ->when($this->onlyPublished, function ($q) {
                $q->where('is_published', 1);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.project-manager', compact('projects'));
    }

    // Tampilkan form create
    public function showCreateForm()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->editingId = null;
    }

    // Tampilkan form edit dan isi data
    public function showEditForm($id)
    {
        $project = Project::findOrFail($id);

        $this->editingId = $id;
        $this->title = $project->title;
        $this->slug = $project->slug;
        $this->excerpt = $project->excerpt;
        $this->description = $project->description;
        $this->is_published = (bool) $project->is_published;
        $this->is_featured = (bool) $project->is_featured;

        // Atur image path / url
        $this->image_path = $project->cover_image;
        if (!empty($project->cover_image) && preg_match('/^https?:\/\//i', $project->cover_image)) {
            $this->image_url = $project->cover_image;
            $this->thumbnail_image = null;
        } else {
            $this->image_url = '';
            $this->thumbnail_image = null;
        }

        $this->showForm = true;
    }

    // Upload handler untuk thumbnail_image
    public function updatedThumbnailImage()
    {
        if (!$this->thumbnail_image) return;

        try {
            $this->validateOnly('thumbnail_image');
            $path = $this->thumbnail_image->store('projects', 'public');
            $this->image_path = $path;
            $this->image_url = '';
            $this->dispatch('notify', message: 'Gambar berhasil diunggah', type: 'success');
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Error upload: ' . $e->getMessage(), type: 'error');
            $this->thumbnail_image = null;
        }
    }

    // Handler saat user memasukkan image_url
    public function updatedImageUrl()
    {
        if (!empty($this->image_url)) {
            if (!filter_var($this->image_url, FILTER_VALIDATE_URL)) {
                $this->addError('image_url', 'Link gambar harus berupa URL yang valid (http/https).');
                return;
            }
            $this->image_path = $this->image_url;
            $this->thumbnail_image = null;
            $this->dispatch('notify', message: 'Link gambar berhasil disimpan', type: 'success');
        }
    }

    // Simpan project: create / update
    public function save()
    {
        $this->validate();

        try {
            // Cek slug unik
            if ($this->editingId) {
                $slugExists = Project::where('slug', $this->slug)
                    ->where('id', '!=', $this->editingId)
                    ->exists();
            } else {
                $slugExists = Project::where('slug', $this->slug)->exists();
            }

            if ($slugExists) {
                $this->addError('slug', 'Slug sudah digunakan oleh proyek lain.');
                return;
            }

            $data = [
                'title' => $this->title,
                'slug' => $this->slug,
                'excerpt' => $this->excerpt,
                'description' => $this->description,
                'cover_image' => $this->image_path,
                'is_published' => $this->is_published,
                'is_featured' => $this->is_featured,
            ];

            if ($this->editingId) {
                Project::find($this->editingId)->update($data);
                $message = 'Proyek berhasil diperbarui.';
            } else {
                Project::create($data);
                $message = 'Proyek berhasil ditambahkan.';
            }

            $this->showForm = false;
            $this->resetForm();
            $this->dispatch('notify', message: $message, type: 'success');
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Terjadi kesalahan: ' . $e->getMessage(), type: 'error');
        }
    }

    // Hapus project
    public function delete($id)
    {
        try {
            Project::findOrFail($id)->delete();
            $this->dispatch('notify', message: 'Proyek berhasil dihapus.', type: 'success');
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Terjadi kesalahan saat menghapus: ' . $e->getMessage(), type: 'error');
        }
    }

    /**
     * Toggle status publikasi proyek (is_published) dari tabel.
     * Membalik nilai boolean dan menyimpan perubahan.
     */
    public function togglePublished($id)
    {
        try {
            $project = Project::findOrFail($id);
            $project->is_published = ! (bool) $project->is_published;
            $project->save();
            $this->dispatch('notify', message: 'Status publikasi berhasil diperbarui.', type: 'success');
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Gagal memperbarui status: ' . $e->getMessage(), type: 'error');
        }
    }

    // Batal dan reset form
    public function cancel()
    {
        $this->showForm = false;
        $this->resetForm();
    }

    // Reset semua property form
    private function resetForm()
    {
        $this->reset([
            'title', 'slug', 'excerpt', 'description', 'thumbnail_image', 'image_url', 'image_path', 'is_published', 'is_featured', 'editingId'
        ]);
    }
}
