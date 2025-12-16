{{-- resources/views/admin/services/form.blade.php --}}
{{-- Form ini digunakan untuk create dan edit (method dan action disediakan oleh parent view) --}}
@php /**
    Variabel yang tersedia:
    - $service (opsional, untuk edit)
*/ @endphp

<div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-bold mb-4">{{ isset($service) ? 'Edit Layanan' : 'Tambah Layanan Baru' }}</h2>

    {{-- Pastikan parent view mengatur method dan action form. Tambahkan enctype untuk upload file. --}}
    {{-- Contoh di create: <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data"> --}}

    {{-- Judul --}}
    <div class="mb-4">
        <label class="block text-sm font-medium text-slate-700 mb-1">Judul <span class="text-red-500">*</span></label>
        <input type="text" name="title" value="{{ old('title', $service->title ?? '') }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg" placeholder="Masukkan judul layanan">
        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    {{-- Slug --}}
    <div class="mb-4">
        <label class="block text-sm font-medium text-slate-700 mb-1">Slug <span class="text-red-500">*</span></label>
        <input type="text" name="slug" value="{{ old('slug', $service->slug ?? '') }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg" placeholder="contoh: layanan-konsultasi">
        @error('slug') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    {{-- Excerpt --}}
    <div class="mb-4">
        <label class="block text-sm font-medium text-slate-700 mb-1">Ringkasan</label>
        <textarea name="excerpt" rows="3" class="w-full px-3 py-2 border border-slate-300 rounded-lg" placeholder="Ringkasan singkat">{{ old('excerpt', $service->excerpt ?? '') }}</textarea>
    </div>

    {{-- Description --}}
    <div class="mb-4">
        <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Lengkap</label>
        <textarea name="description" rows="5" class="w-full px-3 py-2 border border-slate-300 rounded-lg" placeholder="Deskripsi detail">{{ old('description', $service->description ?? '') }}</textarea>
    </div>

    {{-- Gambar (upload atau URL) --}}
    <div class="mb-4">
        <label class="block text-sm font-medium text-slate-700 mb-1">Gambar Layanan (Upload atau Link Eksternal)</label>
        <input type="file" name="thumbnail_image" accept="image/*" class="w-full px-3 py-2 border border-slate-300 rounded-lg mb-2">
        <input type="text" name="image_url" value="{{ old('image_url', $service->image_path ?? '') }}" placeholder="Atau masukkan URL atau path lokal (contoh: images/services/7.png) — kosongkan jika tidak ingin mengganti" class="w-full px-3 py-2 border border-slate-300 rounded-lg">
        @error('thumbnail_image') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        @error('image_url') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        <p class="text-slate-500 text-xs mt-1">Jika upload digunakan, file akan disimpan di <code>public/images/services</code> dan field akan menyimpan nilai seperti <code>images/services/...</code>.</p>

        {{-- Preview gambar bila ada --}}
        @if(old('image_url', $service->image_path ?? false))
            @php
                $img = old('image_url', $service->image_path ?? '');
                $isUrl = filter_var($img, FILTER_VALIDATE_URL);
                $isPublicFile = $img && (strpos($img, 'images/') === 0 || file_exists(public_path($img)));
            @endphp
            <div class="mt-3">
                @if($isUrl)
                    {{-- Jika URL eksternal tidak dapat dimuat, fallback menggunakan inline SVG. onerror dinolkan agar tidak memicu loop permintaan. --}}
                    <img src="{{ $img }}" alt="Preview" class="h-40 object-cover rounded" onerror="this.onerror=null;this.src='data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20width%3D%27400%27%20height%3D%27300%27%3E%3Crect%20width%3D%27100%25%27%20height%3D%27100%25%27%20fill%3D%27%23f3f4f6%27/%3E%3Ctext%20x%3D%2750%25%27%20y%3D%2750%25%27%20dominant-baseline%3D%27middle%27%20text-anchor%3D%27middle%27%20fill%3D%27%2373747a%27%20font-size%3D%2718%27%3EGambar%20Tidak%20Ditemukan%3C/text%3E%3C/svg%3E'">
                @elseif($isPublicFile)
                    <img src="{{ asset($img) }}" alt="Preview" class="h-40 object-cover rounded" onerror="this.onerror=null;this.src='data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20width%3D%27400%27%20height%3D%27300%27%3E%3Crect%20width%3D%27100%25%27%20height%3D%27100%25%27%20fill%3D%27%23f3f4f6%27/%3E%3Ctext%20x%3D%2750%25%27%20y%3D%2750%25%27%20dominant-baseline%3D%27middle%27%20text-anchor%3D%27middle%27%20fill%3D%27%2373747a%27%20font-size%3D%2718%27%3EGambar%20Tidak%20Ditemukan%3C/text%3E%3C/svg%3E'">
                @else
                    <img src="{{ asset('storage/' . ltrim($img, '/')) }}" alt="Preview" class="h-40 object-cover rounded" onerror="this.onerror=null;this.src='data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20width%3D%27400%27%20height%3D%27300%27%3E%3Crect%20width%3D%27100%25%27%20height%3D%27100%25%27%20fill%3D%27%23f3f4f6%27/%3E%3Ctext%20x%3D%2750%25%27%20y%3D%2750%25%27%20dominant-baseline%3D%27middle%27%20text-anchor%3D%27middle%27%20fill%3D%27%2373747a%27%20font-size%3D%2718%27%3EGambar%20Tidak%20Ditemukan%3C/text%3E%3C/svg%3E'">
                @endif
            </div>
        @endif
    </div>

    {{-- Fitur (dynamic) --}}
    <div class="mb-4">
        <label class="block text-sm font-medium text-slate-700 mb-1">Fitur Layanan</label>
        <div id="features-container" class="space-y-2 mb-2">
            @php $featuresOld = old('features', $service->features ?? []); @endphp
            @if(!empty($featuresOld) && count($featuresOld) > 0)
                @foreach($featuresOld as $fidx => $f)
                    <div class="flex gap-2 items-center">
                        <input type="text" name="features[]" value="{{ $f }}" class="flex-1 px-3 py-2 border border-slate-300 rounded-lg">
                        <button type="button" class="btn-remove-feature px-3 py-2 bg-red-600 text-white rounded">Hapus</button>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="flex gap-2">
            <input id="new-feature-input" type="text" class="flex-1 px-3 py-2 border border-slate-300 rounded-lg" placeholder="Masukkan fitur baru">
            <button id="add-feature-btn" type="button" class="px-4 py-2 bg-emerald-600 text-white rounded">+ Tambah</button>
        </div>
        <p class="text-slate-500 text-xs mt-1">Tambahkan fitur satu per satu. Field akan dikirim sebagai array <code>features[]</code>.</p>
    </div>

    {{-- Icon --}}
    <div class="mb-4">
        <label class="block text-sm font-medium text-slate-700 mb-1">Icon (opsional)</label>
        <input type="text" name="icon" value="{{ old('icon', $service->icon ?? '') }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg" placeholder="Contoh: tabler-icon-briefcase">
    </div>

    {{-- Published --}}
    <div class="mb-4">
        <label class="inline-flex items-center">
            <input type="checkbox" name="is_published" value="1" @if(old('is_published', $service->is_published ?? false)) checked @endif class="w-4 h-4 text-emerald-600">
            <span class="ml-2">Publikasikan</span>
        </label>
    </div>

    {{-- Buttons --}}
    <div class="flex gap-3">
        <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded">Simpan</button>
        <a href="{{ route('admin.services.index') }}" class="px-4 py-2 bg-slate-300 text-slate-700 rounded">Batal</a>
    </div>
</div>

@push('scripts')
<script>
    // Script kecil untuk menambah/hapus input fitur (client-side)
    document.addEventListener('click', function(e) {
        if (e.target && e.target.id === 'add-feature-btn') {
            const val = document.getElementById('new-feature-input').value.trim();
            if (!val) return;
            const container = document.getElementById('features-container');
            const wrapper = document.createElement('div');
            wrapper.className = 'flex gap-2 items-center';
            wrapper.innerHTML = `<input type="text" name="features[]" value="${val}" class="flex-1 px-3 py-2 border border-slate-300 rounded-lg"> <button type="button" class="btn-remove-feature px-3 py-2 bg-red-600 text-white rounded">Hapus</button>`;
            container.appendChild(wrapper);
            document.getElementById('new-feature-input').value = '';
        }

        if (e.target && e.target.classList.contains('btn-remove-feature')) {
            e.target.closest('div').remove();
        }
    });
</script>
@endpush
