{{-- resources/views/admin/projects/table.blade.php --}}
<div class="py-6">
    {{-- Form pencarian dan filter (GET) agar state dapat di-share via URL --}}
    <div class="max-w-6xl mx-auto px-4 sm:px-6 mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <form method="GET" action="{{ route('admin.projects.index') }}" class="flex-1 flex gap-3 items-center">
            <input type="text" name="q" value="{{ old('q', $q ?? '') }}" placeholder="Cari proyek..." class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
            <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-md">Cari</button>
        </form>

        <form method="GET" action="{{ route('admin.projects.index') }}" class="flex items-center gap-3">
            <input type="hidden" name="q" value="{{ $q ?? '' }}">
            <label class="inline-flex items-center text-sm text-slate-700">
                <input type="checkbox" name="onlyPublished" value="1" @if(!empty($onlyPublished)) checked @endif class="w-4 h-4 text-emerald-600 rounded">
                <span class="ml-2">Tampilkan hanya yang dipublikasikan</span>
            </label>
            <button type="submit" class="px-3 py-2 bg-slate-100 text-slate-700 rounded">Terapkan</button>
        </form>
    </div>

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
                        <tr class="hover:bg-slate-50 transition" data-project-id="{{ $project->id }}">
                            <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $project->title }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $project->slug }}</td>
                            <td class="px-6 py-4 text-sm">
                                {{-- Form PATCH sederhana: tombol menampilkan badge dan mengirimkan nilai kebalikan supaya toggle terjadi --}}
                                <form method="POST" action="{{ route('admin.projects.update', $project) }}" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="title" value="{{ $project->title }}">
                                    <input type="hidden" name="slug" value="{{ $project->slug }}">
                                    {{-- kirim nilai yang berlawanan untuk toggle --}}
                                    <input type="hidden" name="is_published" value="{{ $project->is_published ? '0' : '1' }}">

                                    <button type="submit" class="inline-flex items-center gap-3 px-2 py-1 rounded hover:bg-slate-50 focus:outline-none" aria-label="Toggle published status">
                                        @if($project->is_published)
                                            <span class="inline-flex items-center justify-center w-6 h-6 bg-emerald-600 text-white rounded-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414L8.414 15l-4.121-4.121a1 1 0 011.414-1.414L8.414 12.586l7.879-7.879a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                            <span class="ml-2 px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-medium">Dipublikasikan</span>
                                        @else
                                            <span class="inline-flex items-center justify-center w-6 h-6 bg-slate-200 text-slate-600 rounded-full"></span>
                                            <span class="ml-2 px-3 py-1 bg-slate-100 text-slate-800 rounded-full text-xs font-medium">Draf</span>
                                        @endif
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-sm text-right space-x-2">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="text-emerald-600 hover:text-emerald-800 font-medium transition">Edit</a>
                                <button type="button" onclick="deleteProject({{ $project->id }})" class="text-red-600 hover:text-red-800 ml-3">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="px-6 py-4 border-t border-slate-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-slate-600">Menampilkan halaman {{ $projects->currentPage() }} dari {{ $projects->lastPage() }}</div>
                    <div>
                        {{ $projects->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        @else
            <div class="px-6 py-10 text-center text-slate-500"><p class="text-lg">Tidak ada proyek.</p></div>
        @endif
    </div>
</div>

<script>
function deleteProject(projectId) {
    if (!confirm('Hapus proyek ini?')) return;

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`/admin/projects/${projectId}`, {
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
            const row = document.querySelector(`tr[data-project-id="${projectId}"]`);
            if (row) {
                row.style.opacity = '0.5';
                setTimeout(() => row.remove(), 300);
            }
            const msg = document.createElement('div');
            msg.className = 'fixed top-4 right-4 bg-green-100 text-green-800 px-4 py-3 rounded shadow-lg z-50';
            msg.textContent = 'Project berhasil dihapus';
            document.body.appendChild(msg);
            setTimeout(() => msg.remove(), 3000);
        }
    })
    .catch(err => console.error('Error:', err));
}
</script>
