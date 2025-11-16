@extends('layouts.app')

@section('title','Tambah Layanan')

@section('content')
<section class="py-10">
  <div class="max-w-2xl mx-auto px-4 sm:px-6">
    <h1 class="text-3xl font-extrabold mb-6">Tambah Layanan Baru</h1>

    @if ($errors->any())
      <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('editor.services.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow">
      @csrf

      <div class="mb-4">
        <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
      </div>

      <div class="mb-4">
        <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
        <input type="text" id="slug" name="slug" value="{{ old('slug') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
      </div>

      <div class="mb-4">
        <label for="excerpt" class="block text-sm font-medium text-gray-700">Ringkasan</label>
        <textarea id="excerpt" name="excerpt" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">{{ old('excerpt') }}</textarea>
      </div>

      <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea id="description" name="description" rows="6" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">{{ old('description') }}</textarea>
      </div>

      <div class="mb-4">
        <label for="is_published" class="block text-sm font-medium text-gray-700">
          <input type="checkbox" id="is_published" name="is_published" value="1" @checked(old('is_published'))>
          Dipublikasikan
        </label>
      </div>

      <div class="flex space-x-3">
        <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-md">Simpan</button>
        <a href="{{ route('editor.services.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded-md">Batal</a>
      </div>
    </form>
  </div>
</section>
@endsection
