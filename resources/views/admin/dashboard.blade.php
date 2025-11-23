{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.app')

@section('title','Dashboard Admin')

@section('content')
<section class="py-10">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <h1 class="text-3xl font-extrabold mb-2">Dashboard Admin</h1>
    <p class="text-gray-600 mb-6">Kelola pengguna, layanan, proyek, dan pesan kontak.</p>

    <!-- Statistik Kartu -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
      <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-sm font-medium text-gray-500">Total Pengguna</div>
        <div class="text-3xl font-bold text-gray-900 mt-2">{{ $usersCount }}</div>
      </div>

      <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-sm font-medium text-gray-500">Admin</div>
        <div class="text-3xl font-bold text-blue-900 mt-2">{{ $adminsCount }}</div>
      </div>

      <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-sm font-medium text-gray-500">Editor</div>
        <div class="text-3xl font-bold text-green-900 mt-2">{{ $editorsCount }}</div>
      </div>

      <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-sm font-medium text-gray-500">Pesan Belum Ditangani</div>
        <div class="text-3xl font-bold text-red-900 mt-2">{{ $messagesCount }}</div>
      </div>
    </div>

    <!-- Menu Cepat -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <a href="{{ route('admin.users.index') }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition p-6">
        <h3 class="text-lg font-semibold text-gray-900">👤 Kelola Pengguna</h3>
        <p class="mt-2 text-gray-600 text-sm">Tambah, edit, atau hapus pengguna sistem.</p>
        <div class="mt-4 inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">
          {{ $usersCount }} pengguna
        </div>
      </a>

      <a href="{{ route('admin.services.index') }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition p-6">
        <h3 class="text-lg font-semibold text-gray-900">📋 Kelola Layanan</h3>
        <p class="mt-2 text-gray-600 text-sm">Kelola daftar layanan perusahaan.</p>
        <div class="mt-4 inline-block bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full">
          {{ $servicesCount }} layanan
        </div>
      </a>

      <a href="{{ route('admin.projects.index') }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition p-6">
        <h3 class="text-lg font-semibold text-gray-900">📊 Kelola Proyek</h3>
        <p class="mt-2 text-gray-600 text-sm">Kelola portofolio dan proyek.</p>
        <div class="mt-4 inline-block bg-purple-100 text-purple-800 text-xs px-3 py-1 rounded-full">
          {{ $projectsCount }} proyek
        </div>
      </a>

      <a href="{{ route('admin.posts.index') }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition p-6">
        <h3 class="text-lg font-semibold text-gray-900">📝 Kelola Blog</h3>
        <p class="mt-2 text-gray-600 text-sm">Kelola postingan dan artikel blog.</p>
        <div class="mt-4 inline-block bg-orange-100 text-orange-800 text-xs px-3 py-1 rounded-full">
          {{ $postsCount }} postingan
        </div>
      </a>

      <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900">📈 Ringkasan</h3>
        <div class="mt-4 space-y-2 text-sm text-gray-600">
          <p>• {{ $usersCount }} Total Pengguna</p>
          <p>• {{ $adminsCount }} Admin, {{ $editorsCount }} Editor</p>
          <p>• {{ $servicesCount }} Layanan, {{ $projectsCount }} Proyek, {{ $postsCount }} Blog</p>
          <p>• {{ $messagesCount }} Pesan Tertunda</p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
