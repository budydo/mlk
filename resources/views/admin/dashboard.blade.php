{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.app')

@section('title','Dashboard Admin')

@section('content')
<section class="py-10">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <h1 class="text-2xl font-extrabold mb-6">Dashboard Admin</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-white p-4 rounded-lg shadow">
        <div class="text-sm text-slate-500">Layanan</div>
        <div class="text-2xl font-bold">{{ $servicesCount }}</div>
      </div>

      <div class="bg-white p-4 rounded-lg shadow">
        <div class="text-sm text-slate-500">Proyek</div>
        <div class="text-2xl font-bold">{{ $projectsCount }}</div>
      </div>

      <div class="bg-white p-4 rounded-lg shadow">
        <div class="text-sm text-slate-500">Pesan Kontak Baru</div>
        <div class="text-2xl font-bold">{{ $messagesCount }}</div>
      </div>
    </div>

    <div class="mt-6">
      <a href="{{ route('admin.services.index') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-md">Kelola Layanan</a>
      <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 ml-2 bg-slate-700 text-white rounded-md">Kelola Proyek</a>
    </div>
  </div>
</section>
@endsection
