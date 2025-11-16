@extends('layouts.app')

@section('title','Dashboard Editor')

@section('content')
<section class="py-10">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <h1 class="text-3xl font-extrabold mb-2">Dashboard Editor</h1>
    <p class="text-gray-600 mb-6">Kelola konten home, layanan, proyek, dan pesan kontak.</p>

    <!-- Statistik Kartu -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
      <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-sm font-medium text-gray-500">Home Contents</div>
        <div class="text-3xl font-bold text-gray-900 mt-2">{{ $homeContentsCount }}</div>
      </div>

      <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-sm font-medium text-gray-500">Layanan</div>
        <div class="text-3xl font-bold text-blue-900 mt-2">{{ $servicesCount }}</div>
      </div>

      <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-sm font-medium text-gray-500">Proyek</div>
        <div class="text-3xl font-bold text-green-900 mt-2">{{ $projectsCount }}</div>
      </div>

      <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-sm font-medium text-gray-500">Pesan Kontak</div>
        <div class="text-3xl font-bold text-red-900 mt-2">{{ $messagesCount }}</div>
        <p class="text-xs text-gray-600 mt-1">{{ $unhandledMessages }} belum ditangani</p>
      </div>
    </div>

    <!-- Menu Cepat -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <a href="{{ route('editor.home-contents.index') }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition p-6">
        <h3 class="text-lg font-semibold text-gray-900">🏠 Home Contents</h3>
        <p class="mt-2 text-gray-600 text-sm">Kelola konten halaman beranda.</p>
        <div class="mt-4 inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">
          {{ $homeContentsCount }} konten
        </div>
      </a>

      <a href="{{ route('editor.services.index') }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition p-6">
        <h3 class="text-lg font-semibold text-gray-900">📋 Layanan</h3>
        <p class="mt-2 text-gray-600 text-sm">Kelola daftar layanan perusahaan.</p>
        <div class="mt-4 inline-block bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full">
          {{ $servicesCount }} layanan
        </div>
      </a>

      <a href="{{ route('editor.projects.index') }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition p-6">
        <h3 class="text-lg font-semibold text-gray-900">📊 Proyek</h3>
        <p class="mt-2 text-gray-600 text-sm">Kelola portofolio dan proyek.</p>
        <div class="mt-4 inline-block bg-purple-100 text-purple-800 text-xs px-3 py-1 rounded-full">
          {{ $projectsCount }} proyek
        </div>
      </a>

      <a href="{{ route('editor.contact-messages.index') }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition p-6">
        <h3 class="text-lg font-semibold text-gray-900">💬 Pesan Kontak</h3>
        <p class="mt-2 text-gray-600 text-sm">Lihat dan kelola pesan dari pengunjung.</p>
        <div class="mt-4 inline-block bg-orange-100 text-orange-800 text-xs px-3 py-1 rounded-full">
          {{ $messagesCount }} pesan
        </div>
      </a>
    </div>
  </div>
</section>
@endsection
