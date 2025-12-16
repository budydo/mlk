{{-- resources/views/livewire/editor-service-manager.blade.php --}}
{{-- DEPRECATED: Modul Services sudah dipindahkan ke implementasi server-side (non-Livewire).
     Jangan gunakan file ini lagi; gunakan route /editor/services atau /admin/services untuk akses. --}}
<div class="py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="mb-6">
            <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded">Perhatian: Livewire EditorServiceManager tidak lagi digunakan. Gunakan halaman Admin/Editor Services (non-Livewire).</div>
        </div>

        {{-- Search Bar --}}
        <div class="mb-6">
            <input 
                type="text"
                wire:model.live="searchTerm"
                placeholder="Cari layanan..."
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
            >
        </div>

        {{-- Form Tambah/Edit --}}
        @if($this->showForm)
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-bold mb-4">
                    {{ $this->editingId ? 'Edit Layanan' : 'Tambah Layanan Baru' }}
                </h2>

                <form wire:submit="save" class="space-y-4">
                    {{-- Title --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Judul <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text"
                            wire:model="title"
                            placeholder="Masukkan judul layanan"
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
                            placeholder="Contoh: layanan-konsultasi"
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                        >
                        @error('slug') 
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    {{-- Excerpt --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Ringkasan
                        </label>
                        <textarea 
                            wire:model="excerpt"
                            placeholder="Ringkasan singkat tentang layanan"
                            rows="3"
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                        ></textarea>
                    </div>

                    {{-- Deskripsi Lengkap --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Deskripsi Lengkap
                        </label>
                        <textarea 
                            wire:model="description"
                            placeholder="Deskripsi detail tentang layanan"
                            rows="5"
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                        ></textarea>
                    </div>

                    <!-- Gambar Layanan: Upload atau Link Eksternal -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-3">
                            Gambar Layanan (Upload atau Link Eksternal)
                        </label>

                        {{-- PILIHAN 1: Upload File Gambar Lokal --}}
                        <div class="mb-4 pb-4 border-b border-slate-200">
                            <label class="block text-sm text-slate-600 mb-2 font-medium">
                                📤 Upload File Gambar
                            </label>
                            <input 
                                type="file"
                                wire:model="thumbnail_image"
                                accept="image/jpeg,image/png,image/jpg"
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg"
                            >
                            {{-- Tampilkan error jika upload file gagal validasi --}}
                            @error('thumbnail_image') 
                                <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> 
                            @enderror
                            <p class="text-slate-500 text-xs mt-1">Format: JPG, PNG. Maksimal 4MB. File akan disimpan lokal di server.</p>
                        </div>

                        {{-- PILIHAN 2: Link Eksternal Gambar (Unsplash, Pexels, dll) --}}
                        <div class="mb-4">
                            <label class="block text-sm text-slate-600 mb-2 font-medium">
                                🔗 Atau Masukkan Link Eksternal
                            </label>
                            <input 
                                type="url"
                                wire:model.live="image_url"
                                placeholder="Contoh: https://images.unsplash.com/photo-..."
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg"
                            >
                            {{-- Tampilkan error jika URL tidak valid --}}
                            @error('image_url') 
                                <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> 
                            @enderror
                            <p class="text-slate-500 text-xs mt-1">Masukkan URL lengkap gambar dari internet (http/https).</p>
                        </div>

                        {{-- PREVIEW GAMBAR --}}
                        @if($this->image_path)
                            <div class="mt-4">
                                <p class="text-sm text-slate-700 mb-2 font-medium">Preview Gambar:</p>
                                @php
                                    // Periksa apakah image_path adalah URL lengkap atau path lokal
                                    $imgIsUrl = filter_var($this->image_path, FILTER_VALIDATE_URL);
                                @endphp
                                @if($imgIsUrl)
                                    {{-- Jika URL eksternal, tampilkan langsung dengan placeholder fallback --}}
                                    {{-- Fallback gambar jika URL eksternal gagal dimuat; onerror dinolkan agar tidak memicu loop. --}}
                                    <img 
                                        src="{{ $this->image_path }}" 
                                        alt="Preview" 
                                        class="h-40 object-cover rounded" 
                                        onerror="this.onerror=null;this.src='data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20width%3D%27400%27%20height%3D%27300%27%3E%3Crect%20width%3D%27100%25%27%20height%3D%27100%25%27%20fill%3D%27%23f3f4f6%27/%3E%3Ctext%20x%3D%2750%25%27%20y%3D%2750%25%27%20dominant-baseline%3D%27middle%27%20text-anchor%3D%27middle%27%20fill%3D%27%2373747a%27%20font-size%3D%2718%27%3EGambar%20Tidak%20Ditemukan%3C/text%3E%3C/svg%3E'">
                                @else
                                    {{-- Jika path lokal di storage, tampilkan via asset() helper --}}
                                    {{-- Fallback gambar jika asset lokal gagal dimuat; clear onerror to prevent infinite loop. --}}
                                    <img 
                                        src="{{ asset('storage/' . $this->image_path) }}" 
                                        alt="Preview" 
                                        class="h-40 object-cover rounded" 
                                        onerror="this.onerror=null;this.src='data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20width%3D%27400%27%20height%3D%27300%27%3E%3Crect%20width%3D%27100%25%27%20height%3D%27100%25%27%20fill%3D%27%23f3f4f6%27/%3E%3Ctext%20x%3D%2750%25%27%20y%3D%2750%25%27%20dominant-baseline%3D%27middle%27%20text-anchor%3D%27middle%27%20fill%3D%27%2373747a%27%20font-size%3D%2718%27%3EGambar%20Tidak%20Ditemukan%3C/text%3E%3C/svg%3E'">
                                @endif
                            </div>
                        @else
                            {{-- Jika belum ada gambar, tampilkan area placeholder --}}
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

                    {{-- Fitur Dinamis (Replace JSON Manual) --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Fitur Layanan
                        </label>
                        {{-- Container untuk menampilkan list fitur yang sudah ditambahkan --}}
                        <div class="mb-4 space-y-2">
                            {{-- Jika ada fitur, tampilkan dalam bentuk list yang bisa dihapus --}}
                            @if(!empty($this->features) && count($this->features) > 0)
                                @foreach($this->features as $index => $feature)
                                    <div class="flex items-center justify-between bg-emerald-50 border border-emerald-200 rounded-lg px-4 py-2">
                                        {{-- Tampilkan teks fitur --}}
                                        <span class="text-slate-800">{{ $feature }}</span>
                                        {{-- Tombol hapus fitur --}}
                                        <button
                                            type="button"
                                            wire:click="removeFeature({{ $index }})"
                                            class="text-red-600 hover:text-red-800 text-sm font-medium"
                                        >
                                            Hapus
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                {{-- Pesan jika belum ada fitur --}}
                                <p class="text-slate-500 text-sm italic">Belum ada fitur. Tambahkan fitur di bawah.</p>
                            @endif
                        </div>

                        {{-- Input untuk menambah fitur baru --}}
                        <div class="flex gap-2">
                            {{-- Text input untuk fitur baru --}}
                            <input
                                type="text"
                                wire:model="newFeature"
                                placeholder="Masukkan nama fitur (contoh: Konsultasi Gratis)"
                                class="flex-1 px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                            >
                            {{-- Tombol untuk menambah fitur --}}
                            <button
                                type="button"
                                wire:click="addFeature"
                                class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition"
                            >
                                + Tambah
                            </button>
                        </div>
                        <p class="text-slate-500 text-xs mt-1">Tambahkan fitur satu per satu. Tidak perlu JSON!</p>
                    </div>

                    {{-- Icon (Kept as manual input for advanced users) --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Icon (Tabler Icons atau class) - <span class="text-xs text-slate-500">Opsional</span>
                        </label>
                        <input 
                            type="text"
                            wire:model="icon"
                            placeholder="Contoh: tabler-icon-briefcase"
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                        >
                    </div>

                    {{-- Published Status --}}
                    <div class="flex items-center">
                        <input 
                            type="checkbox"
                            wire:model="is_published"
                            id="is_published"
                            class="w-4 h-4 text-emerald-600 rounded"
                        >
                        <label for="is_published" class="ml-2 text-sm font-medium text-slate-700">
                            Publikasikan Layanan Ini
                        </label>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex gap-3 pt-4">
                        <button 
                            type="submit"
                            class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition"
                        >
                            {{ $this->editingId ? 'Update' : 'Simpan' }}
                        </button>
                        <button 
                            type="button"
                            wire:click="cancel"
                            class="px-4 py-2 bg-slate-300 text-slate-700 rounded-lg hover:bg-slate-400 transition"
                        >
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        @endif

        {{-- Tabel Services --}}
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if($services->count() > 0)
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
                        @foreach($services as $service)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 text-sm font-medium text-slate-900">
                                    {{ $service->title }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $service->slug }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if($service->is_published)
                                        <span class="px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-medium">
                                            Dipublikasikan
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-slate-100 text-slate-800 rounded-full text-xs font-medium">
                                            Draf
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-right space-x-2">
                                    {{-- Tombol Edit --}}
                                    <button 
                                        wire:click="showEditForm({{ $service->id }})"
                                        class="text-emerald-600 hover:text-emerald-800 font-medium transition"
                                    >
                                        Edit
                                    </button>
                                    
                                    {{-- Tombol Hapus dengan konfirmasi --}}
                                    <button 
                                        wire:click="delete({{ $service->id }})"
                                        wire:confirm="Apakah Anda yakin ingin menghapus layanan ini?"
                                        class="text-red-600 hover:text-red-800 font-medium transition"
                                    >
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="px-6 py-4 border-t border-slate-200">
                    {{ $services->links() }}
                </div>
            @else
                <div class="px-6 py-10 text-center text-slate-500">
                    <p class="text-lg">Belum ada layanan. <a href="#" wire:click="showCreateForm" class="text-emerald-600 hover:underline">Buat yang baru</a></p>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Toast Notification Script --}}
@script
<script>
    // Listening untuk event notify dari Livewire
    // Event dikirim dari komponen PHP menggunakan: $this->dispatch('notify', message: 'text', type: 'success/error')
    Livewire.on('notify', (data) => {
        // data adalah object dengan properti: message, type
        // Jangan gunakan data[0] karena itu adalah index array yang salah
        const message = data.message || 'Terjadi kesalahan';
        const type = data.type || 'error';
        
        // Buat element untuk notifikasi toast
        const toast = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-emerald-600' : 'bg-red-600';
        toast.className = `fixed top-4 right-4 px-6 py-3 text-white rounded-lg shadow-lg ${bgColor} z-50`;
        toast.textContent = message;
        
        // Tambahkan ke body element
        document.body.appendChild(toast);
        
        // Hapus toast setelah 3 detik otomatis
        setTimeout(() => {
            toast.remove();
        }, 3000);
    });
</script>
@endscript
