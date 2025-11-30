{{-- resources/views/admin/projects/table.blade.php --}}
<div class="py-6">
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
                                @if($project->is_published)
                                    <span class="px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-medium">Dipublikasikan</span>
                                @else
                                    <span class="px-3 py-1 bg-slate-100 text-slate-800 rounded-full text-xs font-medium">Draf</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-right space-x-2">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="text-emerald-600 hover:text-emerald-800 font-medium transition">Edit</a>
                                <button type="button" onclick="deleteProject({{ $project->id }})" class="text-red-600 hover:text-red-800 ml-3">Hapus</button>
                                {{-- Toggle publish via PATCH form --}}
                                <form method="POST" action="{{ route('admin.projects.update', $project) }}" class="inline-block ml-3">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="title" value="{{ $project->title }}">
                                    <input type="hidden" name="slug" value="{{ $project->slug }}">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="hidden" name="is_published" value="0">
                                        <input type="checkbox" name="is_published" value="1" onchange="this.form.submit()" class="form-checkbox h-4 w-4 text-emerald-600" @if($project->is_published) checked @endif>
                                    </label>
                                </form>
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
