@extends('layouts.app')

@section('title','Home Contents')

@section('content')
<section class="py-10">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-extrabold">Kelola Home Contents</h1>
      <a href="{{ route('editor.home-contents.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-md hover:bg-emerald-700">
        + Tambah Content
      </a>
    </div>

    @if ($message = Session::get('success'))
      <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">{{ $message }}</div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
      <table class="min-w-full">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Section</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Dibuat</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @forelse ($contents as $content)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $content->section }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($content->title, 50) }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                {{ $content->created_at->format('d M Y') }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                <a href="{{ route('editor.home-contents.edit', $content) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                <form action="{{ route('editor.home-contents.destroy', $content) }}" method="POST" style="display:inline;">
                  @csrf @method('DELETE')
                  <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Hapus konten ini?')">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="px-6 py-4 text-center text-gray-600">Tidak ada konten.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-6">
      {{ $contents->links() }}
    </div>
  </div>
</section>
@endsection
