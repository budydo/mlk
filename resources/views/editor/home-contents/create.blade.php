@extends('layouts.app')

@section('title','Tambah Home Content')

@section('content')
<section class="py-10">
  <div class="max-w-2xl mx-auto px-4 sm:px-6">
    <h1 class="text-3xl font-extrabold mb-6">Tambah Home Content</h1>

    @if ($errors->any())
      <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('editor.home-contents.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow">
      @csrf

      <div class="mb-4">
        <label for="section" class="block text-sm font-medium text-gray-700">Section</label>
        <input type="text" id="section" name="section" value="{{ old('section') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500" placeholder="e.g., hero, about, features">
      </div>

      <div class="mb-4">
        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500">
      </div>

      <div class="mb-4">
        <label for="content" class="block text-sm font-medium text-gray-700">Konten</label>
        <textarea id="content" name="content" rows="6" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500">{{ old('content') }}</textarea>
      </div>

      <div class="mb-6">
        <label for="image_path" class="block text-sm font-medium text-gray-700">Image Path (URL)</label>
        <input type="text" id="image_path" name="image_path" value="{{ old('image_path') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500">
      </div>

      <div class="flex space-x-3">
        <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-md hover:bg-emerald-700">Simpan</button>
        <a href="{{ route('editor.home-contents.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500">Batal</a>
      </div>
    </form>
  </div>
</section>
@endsection
