{{-- resources/views/admin/posts/form.blade.php --}}
@php /**
    Variabel yang tersedia:
    - $post (opsional, untuk edit)
*/ @endphp

<div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-bold mb-4">{{ isset($post) ? 'Edit Posting' : 'Tambah Posting Baru' }}</h2>

    {{-- Title --}}
    <div class="mb-4">
        <label class="block text-sm font-medium text-slate-700 mb-1">Judul <span class="text-red-500">*</span></label>
        <input type="text" name="title" value="{{ old('title', $post->title ?? '') }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg" placeholder="Masukkan judul">
        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    {{-- Slug --}}
    <div class="mb-4">
        <label class="block text-sm font-medium text-slate-700 mb-1">Slug <span class="text-red-500">*</span></label>
        <input type="text" name="slug" value="{{ old('slug', $post->slug ?? '') }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg" placeholder="contoh: artikel-baru">
        @error('slug') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    {{-- Excerpt --}}
    <div class="mb-4">
        <label class="block text-sm font-medium text-slate-700 mb-1">Ringkasan</label>
        <textarea name="excerpt" rows="3" class="w-full px-3 py-2 border border-slate-300 rounded-lg" placeholder="Ringkasan singkat">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
    </div>

    {{-- Content --}}
    <div class="mb-4">
        <label class="block text-sm font-medium text-slate-700 mb-1">Konten</label>
        <textarea name="content" rows="6" class="w-full px-3 py-2 border border-slate-300 rounded-lg" placeholder="Isi artikel">{{ old('content', $post->content ?? '') }}</textarea>
    </div>

    {{-- Cover image --}}
    <div class="mb-4">
        <label class="block text-sm font-medium text-slate-700 mb-1">Gambar Sampul (Upload atau Link Eksternal)</label>
        <input type="file" name="cover_image" accept="image/*" class="w-full px-3 py-2 border border-slate-300 rounded-lg mb-2">
        <input type="text" name="image_url" value="{{ old('image_url', $post->cover_image ?? '') }}" placeholder="Atau masukkan URL atau path lokal (contoh: images/posts/1.jpg) — kosongkan jika tidak ingin mengganti" class="w-full px-3 py-2 border border-slate-300 rounded-lg">
        @error('cover_image') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        @error('image_url') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        <p class="text-slate-500 text-xs mt-1">Jika upload digunakan, file akan disimpan di <code>public/images/posts</code>.</p>

        {{-- Preview gambar bila ada --}}
        @if(old('image_url', $post->cover_image ?? false))
            @php
                $img = old('image_url', $post->cover_image ?? '');
                $isUrl = filter_var($img, FILTER_VALIDATE_URL);
                $isPublicFile = $img && (strpos($img, 'images/') === 0 || file_exists(public_path($img)));
            @endphp
            <div class="mt-3">
                @if($isUrl)
                    <img src="{{ $img }}" alt="Preview" class="h-40 object-cover rounded" onerror="this.onerror=null;this.src='data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20width%3D%27400%27%20height%3D%27300%27%3E%3Crect%20width%3D%27100%25%27%20height%3D%27100%25%27%20fill%3D%27%23f3f4f6%27/%3E%3Ctext%20x%3D%2750%25%27%20y%3D%2750%25%27%20dominant-baseline%3D%27middle%27%20text-anchor%3D%27middle%27%20fill%3D%27%2373747a%27%20font-size%3D%2718%27%3EGambar%20Tidak%20Ditemukan%3C/text%3E%3C/svg%3E'">
                @elseif($isPublicFile)
                    <img src="{{ asset($img) }}" alt="Preview" class="h-40 object-cover rounded" onerror="this.onerror=null;this.src='data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20width%3D%27400%27%20height%3D%27300%27%3E%3Crect%20width%3D%27100%25%27%20height%3D%27100%25%27%20fill%3D%27%23f3f4f6%27/%3E%3Ctext%20x%3D%2750%25%27%20y%3D%2750%25%27%20dominant-baseline%3D%27middle%27%20text-anchor%3D%27middle%27%20fill%3D%27%2373747a%27%20font-size%3D%2718%27%3EGambar%20Tidak%20Ditemukan%3C/text%3E%3C/svg%3E'">
                @else
                    <img src="{{ asset('storage/' . ltrim($img, '/')) }}" alt="Preview" class="h-40 object-cover rounded" onerror="this.onerror=null;this.src='data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20width%3D%27400%27%20height%3D%27300%27%3E%3Crect%20width%3D%27100%25%27%20height%3D%27100%25%27%20fill%3D%27%23f3f4f6%27/%3E%3Ctext%20x%3D%2750%25%27%20y%3D%2750%25%27%20dominant-baseline%3D%27middle%27%20text-anchor%3D%27middle%27%20fill%3D%27%2373747a%27%20font-size%3D%2718%27%3EGambar%20Tidak%20Ditemukan%3C/text%3E%3C/svg%3E'">
                @endif
            </div>
        @endif
    </div>

    {{-- Published --}}
    <div class="mb-4">
        <label class="inline-flex items-center">
            <input type="checkbox" name="is_published" value="1" @if(old('is_published', $post->is_published ?? false)) checked @endif class="w-4 h-4 text-emerald-600">
            <span class="ml-2">Publikasikan</span>
        </label>
    </div>

    <div class="flex gap-3">
        <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded">Simpan</button>
        <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 bg-slate-300 text-slate-700 rounded">Batal</a>
    </div>
</div>
