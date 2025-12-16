{{-- resources/views/admin/posts/table.blade.php --}}
<div class="py-6">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <form method="GET" action="{{ route($routePrefix . '.index') }}" class="flex-1 flex gap-3 items-center">
            <input type="text" name="q" value="{{ old('q', $q ?? '') }}" placeholder="Cari posting..." class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
            <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-md">Cari</button>
        </form>

        <form method="GET" action="{{ route($routePrefix . '.index') }}" class="flex items-center gap-3">
            <input type="hidden" name="q" value="{{ $q ?? '' }}">
            <label class="inline-flex items-center text-sm text-slate-700">
                <input type="checkbox" name="onlyPublished" value="1" @if(!empty($onlyPublished)) checked @endif class="w-4 h-4 text-emerald-600 rounded">
                <span class="ml-2">Tampilkan hanya yang dipublikasikan</span>
            </label>
            <button type="submit" class="px-3 py-2 bg-slate-100 text-slate-700 rounded">Terapkan</button>
        </form>

        <div>
            <a href="{{ route($routePrefix . '.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-md">+ Tambah Posting</a>
        </div>
    </div>

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
                        <tr class="hover:bg-slate-50 transition" data-post-id="{{ $post->id }}">
                            <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $post->title }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $post->slug }}</td>
                            <td class="px-6 py-4 text-sm">
                                <form method="POST" action="{{ route($routePrefix . '.update', $post) }}" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="title" value="{{ $post->title }}">
                                    <input type="hidden" name="slug" value="{{ $post->slug }}">
                                    <input type="hidden" name="is_published" value="{{ $post->is_published ? '0' : '1' }}">

                                    <button type="submit" class="inline-flex items-center gap-3 px-2 py-1 rounded hover:bg-slate-50 focus:outline-none" aria-label="Toggle published status">
                                        @if($post->is_published)
                                            <span class="inline-flex items-center justify-center w-6 h-6 bg-emerald-600 text-white rounded-full">✓</span>
                                            <span class="ml-2 px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-medium">Dipublikasikan</span>
                                        @else
                                            <span class="inline-flex items-center justify-center w-6 h-6 bg-slate-200 text-slate-600 rounded-full"></span>
                                            <span class="ml-2 px-3 py-1 bg-slate-100 text-slate-800 rounded-full text-xs font-medium">Draf</span>
                                        @endif
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-sm text-right space-x-2">
                                <a href="{{ route($routePrefix . '.edit', $post) }}" class="text-emerald-600 hover:text-emerald-800 font-medium transition">Edit</a>
                                <button type="button" onclick="deletePost({{ $post->id }}, '{{ route($routePrefix . '.index') }}')" class="text-red-600 hover:text-red-800 ml-3">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="px-6 py-4 border-t border-slate-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-slate-600">Menampilkan halaman {{ $posts->currentPage() }} dari {{ $posts->lastPage() }}</div>
                    <div>
                        {{ $posts->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        @else
            <div class="px-6 py-10 text-center text-slate-500"><p class="text-lg">Tidak ada posting.</p></div>
        @endif
    </div>
</div>

<script>
function deletePost(postId, baseIndexUrl) {
    if (!confirm('Hapus posting ini?')) return;

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const deleteUrl = baseIndexUrl + '/' + postId;

    fetch(deleteUrl, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            const row = document.querySelector(`tr[data-post-id="${postId}"]`);
            if (row) {
                row.style.opacity = '0.5';
                setTimeout(() => row.remove(), 300);
            }
            const msg = document.createElement('div');
            msg.className = 'fixed top-4 right-4 bg-green-100 text-green-800 px-4 py-3 rounded shadow-lg z-50';
            msg.textContent = 'Posting berhasil dihapus';
            document.body.appendChild(msg);
            setTimeout(() => msg.remove(), 3000);
        }
    })
    .catch(err => console.error('Error:', err));
}
</script>
