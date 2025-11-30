@extends('layouts.dashboard')

@section('title','Edit Proyek')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">Edit Proyek</h2>

        @if(session('success'))
            <div class="mb-4 text-green-700 bg-green-100 px-4 py-2 rounded">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.projects.update', $project) }}">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Judul</label>
                <input type="text" name="title" value="{{ old('title', $project->title) }}" class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $project->slug) }}" class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" name="is_published" value="1" class="form-checkbox" @if($project->is_published) checked @endif>
                    <span class="ml-2">Publikasikan</span>
                </label>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded">Simpan</button>
                <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 bg-slate-200 rounded">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
