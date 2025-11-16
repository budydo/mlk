@extends('layouts.app')

@section('title','Pesan Kontak')

@section('content')
<section class="py-10">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <h1 class="text-3xl font-extrabold mb-6">Pesan Kontak</h1>

    <div class="bg-white rounded-lg shadow overflow-hidden">
      <table class="min-w-full">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengirim</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subjek</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @forelse ($messages as $m)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $m->name }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($m->subject, 60) }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $m->created_at->format('d M Y') }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                <a href="{{ route('editor.contact-messages.show', $m) }}" class="text-blue-600 hover:text-blue-900">Buka</a>
                <form action="{{ route('editor.contact-messages.destroy', $m) }}" method="POST" style="display:inline;">@csrf @method('DELETE')
                  <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Hapus pesan ini?')">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="px-6 py-4 text-center text-gray-600">Tidak ada pesan.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-6">
      {{ $messages->links() }}
    </div>
  </div>
</section>
@endsection
