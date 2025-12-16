<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

/**
 * Komponen Livewire untuk Editor mengelola Projects
 * Mirip dengan ProjectManager namun bisa dikustomisasi untuk role editor.
 */
class EditorProjectManager extends Component
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
    public $thumbnail_image = null;
    public $image_url = '';
    public $image_path = '';

    // State
    public $showForm = false;
    public $editingId = null;
    public $searchTerm = '';

    // Filter untuk menampilkan hanya proyek yang dipublikasikan pada tampilan editor
    public $onlyPublished = false; // jika true, hanya menampilkan proyek dengan is_published = 1

    protected $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:191',
        'excerpt' => 'nullable|string',
        'description' => 'nullable|string',
        'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
        'image_url' => 'nullable|url',
        'image_path' => 'nullable|string',
        'is_published' => 'nullable|boolean',
        'is_featured' => 'nullable|boolean',
    ];

    protected $messages = [
        'title.required' => 'Judul proyek wajib diisi.',
    ];

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

        return view('livewire.editor-project-manager', compact('projects'));
    }

    public function showCreateForm()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->editingId = null;
    }

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

    public function updatedThumbnailImage()
    {
        if (!$this->thumbnail_image) return;

        $this->validateOnly('thumbnail_image');
        $path = $this->thumbnail_image->store('projects', 'public');
        $this->image_path = $path;
        $this->image_url = '';
        $this->dispatch('notify', message: 'Gambar berhasil diunggah', type: 'success');
    }

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

    public function save()
    {
        $this->validate();

        if ($this->editingId) {
            $slugExists = Project::where('slug', $this->slug)->where('id', '!=', $this->editingId)->exists();
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
    }

    public function delete($id)
    {
        Project::findOrFail($id)->delete();
        $this->dispatch('notify', message: 'Proyek berhasil dihapus.', type: 'success');
    }

    /**
     * Toggle status publikasi proyek (is_published) untuk Editor.
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

    public function cancel()
    {
        $this->showForm = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset(['title','slug','excerpt','description','thumbnail_image','image_url','image_path','is_published','is_featured','editingId']);
    }
}
