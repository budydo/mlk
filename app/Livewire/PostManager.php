<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;

/**
 * Komponen Livewire untuk Admin/Editor mengelola Posts (Blog)
 * Dengan error handling yang jelas dan detail logging
 */
class PostManager extends Component
{
    use WithPagination;
    use WithFileUploads;

    // Field form untuk post
    public $title = '';
    public $slug = '';
    public $excerpt = '';
    public $content = '';
    public $is_published = false;

    // Upload dan URL gambar cover
    public $cover_image_upload = null;
    public $cover_image_url = '';
    public $cover_image_path = '';

    // State untuk UI
    public $showForm = false;
    public $editingId = null;
    public $searchTerm = '';

    // Validasi form
    protected $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:191',
        'excerpt' => 'nullable|string|max:500',
        'content' => 'nullable|string',
        'is_published' => 'nullable|boolean',
        'cover_image_upload' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
    ];

    // Pesan validasi dalam Bahasa Indonesia
    protected $messages = [
        'title.required' => 'Judul posting blog wajib diisi.',
        'slug.required' => 'Slug wajib diisi.',
        'cover_image_upload.image' => 'File harus berupa gambar yang valid.',
        'cover_image_upload.mimes' => 'Format gambar harus JPG atau PNG saja.',
        'cover_image_upload.max' => 'Ukuran gambar terlalu besar, maksimal 4MB.',
    ];

    // Render daftar posts dengan pagination dan filter pencarian
    public function render()
    {
        // Query dengan filter pencarian berdasarkan title atau slug
        $posts = Post::query()
            ->when($this->searchTerm, function ($q) {
                $q->where('title', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('slug', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.post-manager', compact('posts'));
    }

    // Tampilkan form create dengan field kosong
    public function showCreateForm()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->editingId = null;
    }

    // Tampilkan form edit dan isi dengan data post yang ada
    public function showEditForm($id)
    {
        $post = Post::findOrFail($id);

        $this->editingId = $id;
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->excerpt = $post->excerpt;
        $this->content = $post->content;
        $this->is_published = (bool) $post->is_published;

        // Atur cover_image_path dan tentukan apakah dari URL eksternal atau file lokal
        $this->cover_image_path = $post->cover_image ?? '';
        if (!empty($post->cover_image) && preg_match('/^https?:\/\//i', $post->cover_image)) {
            $this->cover_image_url = $post->cover_image;
            $this->cover_image_upload = null;
        } else {
            $this->cover_image_url = '';
            $this->cover_image_upload = null;
        }

        $this->showForm = true;
    }

    // Handler saat user memasukkan cover_image_url (link eksternal)
    public function updatedCoverImageUrl()
    {
        if (!empty($this->cover_image_url)) {
            if (filter_var($this->cover_image_url, FILTER_VALIDATE_URL)) {
                $this->cover_image_path = $this->cover_image_url;
                $this->cover_image_upload = null;
            }
        }
    }

    // Simpan post: create atau update - DENGAN ERROR HANDLING LENGKAP
    public function save()
    {
        try {
            // ==================== STEP 1: Validasi file upload ====================
            if ($this->cover_image_upload) {
                Log::info('🔍 Upload file detected', [
                    'filename' => $this->cover_image_upload->getClientOriginalName(),
                    'size' => $this->cover_image_upload->getSize() . ' bytes',
                    'mime' => $this->cover_image_upload->getMimeType(),
                ]);

                // Validasi file terhadap rules
                try {
                    $this->validateOnly('cover_image_upload');
                    Log::info('✅ File upload validation PASSED');
                } catch (\Illuminate\Validation\ValidationException $e) {
                    Log::error('❌ File upload validation FAILED', [
                        'errors' => $e->errors(),
                    ]);
                    
                    // Ambil pesan error dari validator
                    $errorMsg = implode(', ', array_merge(...array_values($e->errors())));
                    $this->dispatch('notify', 
                        message: 'Validasi gambar gagal: ' . $errorMsg, 
                        type: 'error'
                    );
                    return;
                }

                // Coba simpan file ke storage
                try {
                    Log::info('💾 Attempting to store file to: storage/app/public/posts');
                    $path = $this->cover_image_upload->store('posts', 'public');
                    Log::info('✅ File stored successfully', ['path' => $path]);
                    $this->cover_image_path = $path;
                    $this->cover_image_url = '';
                } catch (\Exception $e) {
                    Log::error('❌ File storage FAILED', [
                        'error_message' => $e->getMessage(),
                        'error_code' => $e->getCode(),
                    ]);
                    $this->dispatch('notify', 
                        message: 'Gagal menyimpan gambar: ' . $e->getMessage(), 
                        type: 'error'
                    );
                    return;
                }
            }

            // ==================== STEP 2: Validasi form fields ====================
            Log::info('🔍 Validating form fields (title, slug, excerpt, content)');
            $this->validate([
                'title' => 'required|string|max:255',
                'slug' => 'required|string|max:191',
                'excerpt' => 'nullable|string|max:500',
                'content' => 'nullable|string',
                'is_published' => 'nullable|boolean',
            ]);
            Log::info('✅ Form validation PASSED');

            // ==================== STEP 3: Cek slug duplikat ====================
            Log::info('🔍 Checking slug uniqueness: ' . $this->slug);
            if ($this->editingId) {
                $exists = Post::where('slug', $this->slug)
                    ->where('id', '!=', $this->editingId)
                    ->exists();
            } else {
                $exists = Post::where('slug', $this->slug)->exists();
            }

            if ($exists) {
                Log::warning('❌ Slug already exists', ['slug' => $this->slug]);
                $this->addError('slug', 'Slug sudah digunakan.');
                return;
            }
            Log::info('✅ Slug is unique');

            // ==================== STEP 4: Handle external image URL ====================
            if (!empty($this->cover_image_url)) {
                Log::info('🔍 External URL provided: ' . $this->cover_image_url);
                if (filter_var($this->cover_image_url, FILTER_VALIDATE_URL)) {
                    $this->cover_image_path = $this->cover_image_url;
                    Log::info('✅ External URL accepted');
                } else {
                    Log::warning('❌ Invalid URL format', ['url' => $this->cover_image_url]);
                }
            }

            // ==================== STEP 5: Prepare data for save ====================
            Log::info('📝 Preparing data for database save');
            $data = [
                'title' => $this->title,
                'slug' => $this->slug,
                'excerpt' => $this->excerpt,
                'content' => $this->content,
                'cover_image' => $this->cover_image_path ?: null,
                'is_published' => (bool) $this->is_published,
                'published_at' => $this->is_published ? now() : null,
            ];

            // ==================== STEP 6: Save to database ====================
            Log::info('💾 Saving to database');
            if ($this->editingId) {
                Post::find($this->editingId)->update($data);
                $msg = 'Posting blog berhasil diperbarui.';
                Log::info('✅ Post updated successfully', ['id' => $this->editingId]);
            } else {
                $post = Post::create($data);
                $msg = 'Posting blog berhasil ditambahkan.';
                Log::info('✅ Post created successfully', ['id' => $post->id]);
            }

            // ==================== STEP 7: Reset and notify ====================
            Log::info('🎉 Operation completed successfully');
            $this->showForm = false;
            $this->resetForm();
            $this->dispatch('notify', message: $msg, type: 'success');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('❌ Validation Exception', [
                'errors' => $e->errors(),
                'message' => $e->getMessage(),
            ]);
            $errorMsg = implode(', ', array_merge(...array_values($e->errors())));
            $this->dispatch('notify', 
                message: 'Error validasi: ' . $errorMsg, 
                type: 'error'
            );
        } catch (\Exception $e) {
            Log::error('❌ Unexpected Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            $this->dispatch('notify', 
                message: 'Error: ' . $e->getMessage(), 
                type: 'error'
            );
        }
    }

    // Hapus post dengan konfirmasi
    public function delete($id)
    {
        try {
            Post::findOrFail($id)->delete();
            Log::info('✅ Post deleted successfully', ['id' => $id]);
            $this->dispatch('notify', message: 'Posting blog berhasil dihapus.', type: 'success');
        } catch (\Exception $e) {
            Log::error('❌ Failed to delete post', ['id' => $id, 'error' => $e->getMessage()]);
            $this->dispatch('notify', message: 'Terjadi kesalahan saat menghapus: ' . $e->getMessage(), type: 'error');
        }
    }

    // Toggle status publikasi post
    public function togglePublished($id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->is_published = ! (bool) $post->is_published;
            $post->published_at = $post->is_published ? now() : null;
            $post->save();
            Log::info('✅ Post publication status toggled', ['id' => $id, 'is_published' => $post->is_published]);
            $this->dispatch('notify', message: 'Status publikasi berhasil diperbarui.', type: 'success');
        } catch (\Exception $e) {
            Log::error('❌ Failed to toggle publication status', ['id' => $id, 'error' => $e->getMessage()]);
            $this->dispatch('notify', message: 'Gagal memperbarui status: ' . $e->getMessage(), type: 'error');
        }
    }

    // Batal dan tutup form
    public function cancel()
    {
        $this->showForm = false;
        $this->resetForm();
    }

    // Reset semua property form ke nilai default
    private function resetForm()
    {
        $this->reset([
            'title', 'slug', 'excerpt', 'content', 'cover_image_upload', 'cover_image_url',
            'cover_image_path', 'is_published', 'editingId'
        ]);
    }
}
