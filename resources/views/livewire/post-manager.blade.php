{{-- resources/views/livewire/post-manager.blade.php --}}
{{-- Komponen untuk mengelola Blog Posts (Posting Blog) --}}
<div class="py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        {{-- Header Section --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-extrabold text-slate-900">Kelola Blog</h1>
            @if(!$this->showForm)
                <button 
                    wire:click="showCreateForm"
                    class="px-4 py-2 bg-emerald-600 text-white rounded-md hover:bg-emerald-700 transition"
                >
                    + Tambah Postingan
                </button>
            @endif
        </div>

        {{-- Search Bar: memudahkan pencarian posting berdasarkan judul/slug --}}
        <div class="mb-6">
            <input 
                type="text"
                wire:model.live="searchTerm"
                placeholder="Cari postingan..."
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
            >
        </div>

        {{-- Form Tambah/Edit Posting --}}
        @if($this->showForm)
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-bold mb-4">
                    {{ $this->editingId ? 'Edit Postingan Blog' : 'Tambah Postingan Blog Baru' }}
                </h2>

                <form wire:submit="save" class="space-y-4" enctype="multipart/form-data">
                    {{-- Title --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Judul <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text"
                            wire:model="title"
                            placeholder="Masukkan judul posting blog"
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                        >
                        @error('title') 
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Slug <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text"
                            wire:model="slug"
                            placeholder="Contoh: memulai-perjalanan-hijau"
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                        >
                        @error('slug') 
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    {{-- Excerpt (Ringkasan Singkat) --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Ringkasan Singkat</label>
                        <textarea 
                            wire:model="excerpt"
                            placeholder="Ringkasan singkat tentang postingan (preview di halaman blog)"
                            rows="2"
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                        ></textarea>
                        @error('excerpt') 
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    {{-- Content (Isi Lengkap) --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Isi Postingan</label>
                        <textarea 
                            wire:model="content"
                            placeholder="Tuliskan isi lengkap posting blog di sini (bisa berisi HTML)"
                            rows="8"
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent font-mono"
                        ></textarea>
                        @error('content') 
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    {{-- Gambar Cover: Upload atau Link Eksternal --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-3">Gambar Cover (Upload atau Link Eksternal)</label>

                        <div class="mb-4 pb-4 border-b border-slate-200">
                            <label class="block text-sm text-slate-600 mb-2 font-medium">📤 Upload File Gambar</label>
                            <input 
                                type="file"
                                wire:model="cover_image_upload"
                                accept="image/jpeg,image/png,image/jpg"
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg"
                            >
                            {{-- Loading indicator saat upload --}}
                            <div wire:loading wire:target="cover_image_upload" class="text-emerald-600 text-sm mt-2">
                                <span class="inline-block animate-spin">⏳</span> Sedang mengunggah gambar...
                            </div>
                            @error('cover_image_upload') 
                                <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> 
                            @enderror
                            <p class="text-slate-500 text-xs mt-1">Format: JPG, PNG. Maksimal 4MB. File akan disimpan lokal di server.</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm text-slate-600 mb-2 font-medium">🔗 Atau Masukkan Link Eksternal</label>
                            <input 
                                type="url"
                                wire:model.live="cover_image_url"
                                placeholder="Contoh: https://images.unsplash.com/photo-..."
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg"
                            >
                            @error('cover_image_url') 
                                <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> 
                            @enderror
                            <p class="text-slate-500 text-xs mt-1">Masukkan URL lengkap gambar dari internet (http/https).</p>
                        </div>

                        {{-- Preview gambar cover --}}
                        @if($this->cover_image_path)
                            <div class="mt-4">
                                <p class="text-sm text-slate-700 mb-2 font-medium">Preview Gambar:</p>
                                @php 
                                    // Cek apakah cover_image_path adalah URL eksternal atau path lokal
                                    $imgIsUrl = filter_var($this->cover_image_path, FILTER_VALIDATE_URL);
                                @endphp
                                @if($imgIsUrl)
                                    {{-- Gambar dari URL eksternal --}}
                                    <img src="{{ $this->cover_image_path }}" alt="Preview" class="h-40 object-cover rounded" onerror="this.src='https://via.placeholder.com/400x300?text=Gambar+Tidak+Ditemukan'">
                                @else
                                    {{-- Gambar dari file lokal --}}
                                    <img src="{{ asset('storage/' . $this->cover_image_path) }}" alt="Preview" class="h-40 object-cover rounded" onerror="this.src='https://via.placeholder.com/400x300?text=Gambar+Tidak+Ditemukan'">
                                @endif
                            </div>
                        @else
                            {{-- Placeholder jika belum ada gambar --}}
                            <div class="mt-4">
                                <p class="text-sm text-slate-700 mb-2 font-medium">Preview Gambar:</p>
                                <div class="h-40 bg-slate-100 rounded flex items-center justify-center border-2 border-dashed border-slate-300">
                                    <div class="text-center">
                                        <span class="text-slate-400 text-4xl">🖼️</span>
                                        <p class="text-slate-400 text-sm mt-2">Belum ada gambar</p>
                                        <p class="text-slate-300 text-xs">Upload file atau masukkan link</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Published Status --}}
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" wire:model="is_published" class="w-4 h-4 text-emerald-600 rounded">
                            <span class="ml-2 text-sm font-medium text-slate-700">Publikasikan Postingan Ini</span>
                        </label>
                        <p class="text-slate-500 text-xs mt-1">Postingan akan tampil di halaman Blog jika dipublikasikan.</p>
                    </div>

                    {{-- Buttons: Simpan atau Batal --}}
                    <div class="flex gap-3 pt-4 border-t border-slate-200">
                        <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium">
                            {{ $this->editingId ? 'Update Postingan' : 'Simpan Postingan' }}
                        </button>
                        <button type="button" wire:click="cancel" class="px-4 py-2 bg-slate-300 text-slate-700 rounded-lg hover:bg-slate-400 transition font-medium">Batal</button>
                    </div>
                </form>
            </div>
        @endif

        {{-- Tabel Daftar Postingan Blog --}}
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if($posts->count() > 0)
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Judul</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Slug</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Status</th>
                            <th class="px-6 py-3 text-right text-sm font-semibold text-slate-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach($posts as $post)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $post->title }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $post->slug }}</td>
                                <td class="px-6 py-4 text-sm">
                                    {{-- Toggle status publikasi langsung dari tabel --}}
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" wire:click="togglePublished({{ $post->id }})" class="form-checkbox h-4 w-4 text-emerald-600" @if($post->is_published) checked @endif>
                                        <span class="ml-2 text-sm">
                                            @if($post->is_published)
                                                <span class="px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-medium">Dipublikasikan</span>
                                            @else
                                                <span class="px-3 py-1 bg-slate-100 text-slate-800 rounded-full text-xs font-medium">Draf</span>
                                            @endif
                                        </span>
                                    </label>
                                </td>
                                <td class="px-6 py-4 text-sm text-right space-x-2">
                                    <button wire:click="showEditForm({{ $post->id }})" class="text-emerald-600 hover:text-emerald-800 font-medium transition">Edit</button>
                                    <button wire:click="delete({{ $post->id }})" wire:confirm="Apakah Anda yakin ingin menghapus postingan ini?" class="text-red-600 hover:text-red-800 font-medium transition">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination Links --}}
                <div class="px-6 py-4 border-t border-slate-200">{{ $posts->links() }}</div>
            @else
                {{-- Pesan jika tidak ada postingan --}}
                <div class="px-6 py-10 text-center text-slate-500">
                    <p class="text-lg">Tidak ada postingan blog. <a href="#" wire:click="showCreateForm" class="text-emerald-600 hover:underline">Buat yang baru</a></p>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- JavaScript untuk menangani notifikasi toast --}}
@script
<script>
    // Listener untuk event 'notify' yang dikirim dari Livewire component
    // Menampilkan toast notification dengan pesan success atau error
    Livewire.on('notify', (data) => {
        const message = data.message || 'Terjadi kesalahan';
        const type = data.type || 'error';
        const toast = document.createElement('div');
        // Tentukan warna background berdasarkan type (success = hijau, error = merah)
        const bgColor = type === 'success' ? 'bg-emerald-600' : 'bg-red-600';
        toast.className = `fixed top-4 right-4 px-6 py-3 text-white rounded-lg shadow-lg ${bgColor} z-50`;
        toast.textContent = message;
        document.body.appendChild(toast);
        // Hapus toast setelah 3 detik
        setTimeout(() => toast.remove(), 3000);
    });
</script>
@endscript
