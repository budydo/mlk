{{-- resources/views/admin/projects/index.blade.php --}}
@extends('layouts.app')

@section('title','Kelola Proyek')

@section('content')
<section class="py-10">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-extrabold">Kelola Proyek</h1>
      <a href="{{ route('admin.projects.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-md">Tambah Proyek</a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
      <table class="min-w-full divide-y">
        <thead class="bg-slate-50">
          <tr>
            <th class="px-6 py-3 text-left text-sm font-medium text-slate-600">Judul</th>
            <th class="px-6 py-3 text-left text-sm font-medium text-slate-600">Slug</th>
            <th class="px-6 py-3 text-right text-sm font-medium text-slate-600">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y">
          @foreach($projects as $p)
            <tr>
              <td class="px-6 py-4">{{ $p->title }}</td>
              <td class="px-6 py-4">{{ $p->slug }}</td>
              <td class="px-6 py-4 text-right">
                <a href="#" class="text-emerald-600">Edit</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>
@endsection
