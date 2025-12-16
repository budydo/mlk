{{-- resources/views/livewire/editor-project-manager.blade.php --}}
{{-- Komponen Livewire untuk Editor mengelola proyek: desain dan fungsionalitas mirip dengan admin --}}
<div class="py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-extrabold text-slate-900">Kelola Proyek</h1>
            @if(!$this->showForm)
                <button wire:click="showCreateForm" class="px-4 py-2 bg-emerald-600 text-white rounded-md hover:bg-emerald-700 transition">+ Tambah Proyek</button>
            @endif
        </div>

        {{-- Filter & Search: pencarian + checkbox untuk menampilkan hanya yang dipublikasikan --}}
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            {{-- Input pencarian --}}
            <div class="flex-1">
                <input type="text" wire:model.live="searchTerm" placeholder="Cari proyek..." class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
            </div>

            {{-- Checkbox filter publikasi --}}
            <div class="flex items-center gap-3">
                <label class="inline-flex items-center text-sm text-slate-700">
                    <input type="checkbox" wire:model="onlyPublished" class="w-4 h-4 text-emerald-600 rounded">
                    <span class="ml-2">Tampilkan hanya yang dipublikasikan</span>
                </label>
                <span class="text-xs text-slate-400">(Filter ini hanya menampilkan proyek dengan is_published = 1)</span>
            </div>
        </div>

        {{-- Form create/edit --}}
        @if($this->showForm)
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-bold mb-4">{{ $this->editingId ? 'Edit Proyek' : 'Tambah Proyek Baru' }}</h2>
                <form wire:submit="save" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Judul <span class="text-red-500">*</span></label>
                        <input type="text" wire:model="title" placeholder="Masukkan judul proyek" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Slug <span class="text-red-500">*</span></label>
                        <input type="text" wire:model="slug" placeholder="Contoh: proyek-abc" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                        @error('slug') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Ringkasan</label>
                        <textarea wire:model="excerpt" rows="3" class="w-full px-3 py-2 border border-slate-300 rounded-lg"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Lengkap</label>
                        <textarea wire:model="description" rows="5" class="w-full px-3 py-2 border border-slate-300 rounded-lg"></textarea>
                    </div>

                    {{-- Gambar --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-3">Gambar Cover (Upload atau Link Eksternal)</label>
                        <div class="mb-4 pb-4 border-b border-slate-200">
                            <label class="block text-sm text-slate-600 mb-2 font-medium">📤 Upload File Gambar</label>
                            <input type="file" wire:model="thumbnail_image" accept="image/jpeg,image/png,image/jpg" class="w-full px-3 py-2 border border-slate-300 rounded-lg">
                            @error('thumbnail_image') <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> @enderror
                            <p class="text-slate-500 text-xs mt-1">Format: JPG, PNG. Maksimal 4MB.</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm text-slate-600 mb-2 font-medium">🔗 Atau Masukkan Link Eksternal</label>
                            <input type="url" wire:model.live="image_url" placeholder="Contoh: https://images.unsplash.com/photo-..." class="w-full px-3 py-2 border border-slate-300 rounded-lg">
                        </div>

                        @if($this->image_path)
                            <div class="mt-4">
                                <p class="text-sm text-slate-700 mb-2 font-medium">Preview Gambar:</p>
                                @php $imgIsUrl = filter_var($this->image_path, FILTER_VALIDATE_URL); @endphp
                                @if($imgIsUrl)
                                    <img src="{{ $this->image_path }}" alt="Preview" class="h-40 object-cover rounded" onerror="this.onerror=null;this.src='data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20width%3D%27400%27%20height%3D%27300%27%3E%3Crect%20width%3D%27100%25%27%20height%3D%27100%25%27%20fill%3D%27%23f3f4f6%27/%3E%3Ctext%20x%3D%2750%25%27%20y%3D%2750%25%27%20dominant-baseline%3D%27middle%27%20text-anchor%3D%27middle%27%20fill%3D%27%2373747a%27%20font-size%3D%2718%27%3EGambar%20Tidak%20Ditemukan%3C/text%3E%3C/svg%3E'">
                                @else
                                    <img src="{{ asset('storage/' . $this->image_path) }}" alt="Preview" class="h-40 object-cover rounded" onerror="this.onerror=null;this.src='data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20width%3D%27400%27%20height%3D%27300%27%3E%3Crect%20width%3D%27100%25%27%20height%3D%27100%25%27%20fill%3D%27%23f3f4f6%27/%3E%3Ctext%20x%3D%2750%25%27%20y%3D%2750%25%27%20dominant-baseline%3D%27middle%27%20text-anchor%3D%27middle%27%20fill%3D%27%2373747a%27%20font-size%3D%2718%27%3EGambar%20Tidak%20Ditemukan%3C/text%3E%3C/svg%3E'">
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center gap-6">
                        <label class="inline-flex items-center"><input type="checkbox" wire:model="is_published" class="w-4 h-4 text-emerald-600 rounded"><span class="ml-2 text-sm">Publikasikan</span></label>
                        <label class="inline-flex items-center"><input type="checkbox" wire:model="is_featured" class="w-4 h-4 text-emerald-600 rounded"><span class="ml-2 text-sm">Tandai Unggulan</span></label>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">{{ $this->editingId ? 'Update' : 'Simpan' }}</button>
                        <button type="button" wire:click="cancel" class="px-4 py-2 bg-slate-300 text-slate-700 rounded-lg hover:bg-slate-400 transition">Batal</button>
                    </div>
                </form>
            </div>
        @endif

        {{-- Tabel --}}
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if($projects->count() > 0)
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
                        @foreach($projects as $project)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $project->title }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $project->slug }}</td>
                                <td class="px-6 py-4 text-sm">
                                    {{-- Tombol status yang rapi dan dapat diklik untuk toggle publikasi --}}
                                    <div class="flex items-center">
                                        <button wire:click="togglePublished({{ $project->id }})" class="inline-flex items-center gap-3 px-2 py-1 rounded hover:bg-slate-50 focus:outline-none" aria-label="Toggle published status">
                                            @if($project->is_published)
                                                <span class="inline-flex items-center justify-center w-6 h-6 bg-emerald-600 text-white rounded-full">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414L8.414 15l-4.121-4.121a1 1 0 011.414-1.414L8.414 12.586l7.879-7.879a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                                <span class="ml-2 px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-medium">Dipublikasikan</span>
                                            @else
                                                <span class="inline-flex items-center justify-center w-6 h-6 bg-slate-200 text-slate-600 rounded-full">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 20 20" fill="none" aria-hidden="true"></svg>
                                                </span>
                                                <span class="ml-2 px-3 py-1 bg-slate-100 text-slate-800 rounded-full text-xs font-medium">Draf</span>
                                            @endif
                                        </button>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-right space-x-2">
                                    <button wire:click="showEditForm({{ $project->id }})" class="text-emerald-600 hover:text-emerald-800 font-medium transition">Edit</button>
                                    <button wire:click="delete({{ $project->id }})" wire:confirm="Apakah Anda yakin ingin menghapus proyek ini?" class="text-red-600 hover:text-red-800 font-medium transition">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="px-6 py-4 border-t border-slate-200">
                    {{--
                        Pagination kustom untuk Livewire Editor.
                        Menggunakan method Livewire `previousPage`, `nextPage`, dan `gotoPage`
                        agar klik pagination selalu memicu XHR Livewire.
                    --}}
                    @if($projects->lastPage() > 1)
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-slate-600">Menampilkan halaman {{ $projects->currentPage() }} dari {{ $projects->lastPage() }}</div>
                            <div class="flex items-center space-x-2">
                                {{-- Tombol Previous --}}
                                <button
                                    wire:click="previousPage"
                                    data-lw-prev
                                    @if($projects->onFirstPage()) disabled @endif
                                    class="px-3 py-1 border rounded text-sm bg-white hover:bg-slate-50 disabled:opacity-50"
                                >&laquo;</button>

                                {{-- Tombol nomor halaman --}}
                                @for($i = 1; $i <= $projects->lastPage(); $i++)
                                    <button
                                        wire:click="gotoPage({{ $i }})"
                                        data-lw-page="{{ $i }}"
                                        class="px-3 py-1 rounded text-sm {{ $projects->currentPage() == $i ? 'bg-emerald-600 text-white' : 'bg-white hover:bg-slate-50' }}"
                                    >{{ $i }}</button>
                                @endfor

                                {{-- Tombol Next --}}
                                <button
                                    wire:click="nextPage"
                                    data-lw-next
                                    @if($projects->currentPage() == $projects->lastPage()) disabled @endif
                                    class="px-3 py-1 border rounded text-sm bg-white hover:bg-slate-50 disabled:opacity-50"
                                >&raquo;</button>
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="px-6 py-10 text-center text-slate-500"><p class="text-lg">Tidak ada proyek. <a href="#" wire:click="showCreateForm" class="text-emerald-600 hover:underline">Buat yang baru</a></p></div>
            @endif
        </div>
    </div>
</div>

@script
<script>
    Livewire.on('notify', (data) => {
        const message = data.message || 'Terjadi kesalahan';
        const type = data.type || 'error';
        const toast = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-emerald-600' : 'bg-red-600';
        toast.className = `fixed top-4 right-4 px-6 py-3 text-white rounded-lg shadow-lg ${bgColor} z-50`;
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    });
</script>
@endscript

@push('scripts')
<script>
    // Minimal component-level marker
    (function() {
        if (!window._LW_PaginationInitialized) {
            window._LW_PaginationInitialized = true;
            console.debug('[EditorProjectManager] Marking Livewire pagination as initialized by layout global handler');
        }
    })();
</script>
@endpush
