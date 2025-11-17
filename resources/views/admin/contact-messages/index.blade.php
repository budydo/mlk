@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Pesan Kontak</h1>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel daftar pesan --}}
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-sm">Nama Pengirim</th>
                    <th class="px-4 py-3 text-left font-semibold text-sm">Email</th>
                    <th class="px-4 py-3 text-left font-semibold text-sm">Telepon</th>
                    <th class="px-4 py-3 text-left font-semibold text-sm">Subject</th>
                    <th class="px-4 py-3 text-left font-semibold text-sm">Diterima</th>
                    <th class="px-4 py-3 text-left font-semibold text-sm">Status</th>
                    <th class="px-4 py-3 text-center font-semibold text-sm">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $m)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-sm">{{ $m->name }}</td>
                    <td class="px-4 py-3 text-sm">
                        <a href="mailto:{{ $m->email }}" class="text-blue-600 hover:underline">
                            {{ $m->email }}
                        </a>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        @if($m->phone)
                            <a href="https://wa.me/{{ str_replace(['+', '-', ' '], '', $m->phone) }}" 
                               target="_blank" 
                               class="text-green-600 hover:underline">
                                {{ $m->phone }}
                            </a>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-sm">{{ $m->subject ?? '-' }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">
                        {{ $m->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        @if($m->is_handled)
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">
                                ✓ Ditangani
                            </span>
                        @else
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">
                                ⧗ Baru
                            </span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-sm text-center">
                        <div class="flex gap-2 justify-center">
                            {{-- Link ke halaman detail/balas --}}
                            <a href="{{ route('admin.contact-messages.show', $m) }}" 
                               class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs font-medium transition">
                                Lihat
                            </a>

                            {{-- Form hapus dengan konfirmasi --}}
                            <form action="{{ route('admin.contact-messages.destroy', $m) }}" 
                                  method="POST" 
                                  style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Hapus pesan ini dan semua balasannya?')"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-medium transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                        Belum ada pesan masuk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $messages->links() }}
    </div>
</div>
@endsection
