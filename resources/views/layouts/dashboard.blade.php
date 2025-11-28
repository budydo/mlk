{{-- resources/views/layouts/dashboard.blade.php --}}
{{-- Layout dashboard dengan sidebar kiri, konten kanan, tanpa navbar atas, notifikasi & user menu di kanan atas, serta tombol toggle sidebar. --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
<!--
    Layout dashboard meniru Spike Tailwind:
    - Sidebar kiri dengan logo, menu utama, highlight, dan toggle
    - Header putih minimalis, hanya bell & user
    - Konten utama rapi dan responsif
-->
<!--
    Wrapper utama: gunakan `h-screen` agar layout memenuhi tinggi viewport.
    Dengan ini kita bisa membuat kolom kanan (konten) dan sidebar memiliki
    area scroll terpisah menggunakan `overflow-auto` pada konten dan
    `overflow-y-auto` pada nav sidebar.
-->
<div x-data="{ sidebarOpen: true }" class="h-screen flex">
    <!-- Sidebar: tetap pada kolom kiri, tinggi disesuaikan oleh parent (`h-screen`).
         Sidebar dan header memiliki tinggi yang sama (h-16) dan border untuk alignment. -->
    <aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="h-full bg-white border-r border-gray-200 flex flex-col transition-all duration-200 shadow-lg z-20 sticky top-0">
        <!-- Logo dan tombol toggle: border-b agar selaras dengan header di kolom kanan -->
        <div class="flex items-center justify-between h-16 px-6 border-b border-gray-200 shrink-0">
            <a href="{{ route(request()->is('admin*') ? 'admin.dashboard' : 'editor.dashboard') }}" class="flex items-center gap-3">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-indigo-100">
                    <span class="text-2xl font-extrabold text-indigo-600">M</span>
                </span>
                <span x-show="sidebarOpen" class="text-2xl font-bold text-gray-800 tracking-tight transition-all">LK</span>
            </a>
            <button @click="sidebarOpen = !sidebarOpen" class="ml-2 p-2 rounded hover:bg-gray-100 focus:outline-none">
                <svg x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <svg x-show="!sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
        <!-- Section judul menu -->
        <div x-show="sidebarOpen" class="px-8 pt-6 pb-2 text-xs font-semibold text-gray-400 tracking-widest uppercase">Menu</div>
        <!-- Menu Sidebar: area menu bisa discroll sendiri saat panjang -->
        <nav class="flex-1 flex flex-col gap-1 px-2 pb-6 overflow-y-auto">
            <!-- Menu utama dengan SVG/heroicons -->
            <a href="{{ route(request()->is('admin*') ? 'admin.dashboard' : 'editor.home-contents.index') }}" class="flex items-center px-6 py-2.5 rounded-lg hover:bg-indigo-50 text-gray-700 font-medium gap-4 transition group">
                <!-- Home Icon -->
                <svg class="w-6 h-6 group-hover:text-indigo-600 text-gray-400 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12l2-2m0 0l7-7 7 7m-9 2v6a2 2 0 002 2h4a2 2 0 002-2v-6m-5 0h6"/></svg>
                <span x-show="sidebarOpen" class="transition-all text-base">Home Contents</span>
            </a>
            <a href="{{ route(request()->is('admin*') ? 'admin.services.index' : 'editor.services.index') }}" class="flex items-center px-6 py-2.5 rounded-lg hover:bg-indigo-50 text-gray-700 font-medium gap-4 transition group">
                <!-- Cog Icon (Layanan) -->
                <svg class="w-6 h-6 group-hover:text-indigo-600 text-gray-400 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0a1.724 1.724 0 002.573.965c.797-.602 1.885.091 1.623.986a1.724 1.724 0 001.516 2.36c.958.11 1.32 1.36.564 1.93a1.724 1.724 0 000 2.764c.756.57.394 1.82-.564 1.93a1.724 1.724 0 00-1.516 2.36c.262.895-.826 1.588-1.623.986a1.724 1.724 0 00-2.573.965c-.3.921-1.603.921-1.902 0a1.724 1.724 0 00-2.573-.965c-.797.602-1.885-.091-1.623-.986a1.724 1.724 0 00-1.516-2.36c-.958-.11-1.32-1.36-.564-1.93a1.724 1.724 0 000-2.764c-.756-.57-.394-1.82.564-1.93a1.724 1.724 0 001.516-2.36c-.262-.895.826-1.588 1.623-.986a1.724 1.724 0 002.573-.965z"/><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span x-show="sidebarOpen" class="transition-all text-base">Layanan</span>
            </a>
            <a href="{{ route(request()->is('admin*') ? 'admin.projects.index' : 'editor.projects.index') }}" class="flex items-center px-6 py-2.5 rounded-lg hover:bg-indigo-50 text-gray-700 font-medium gap-4 transition group">
                <!-- Briefcase Icon (Proyek) -->
                <svg class="w-6 h-6 group-hover:text-indigo-600 text-gray-400 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 3v4M8 3v4m-6 4h20"/></svg>
                <span x-show="sidebarOpen" class="transition-all text-base">Proyek</span>
            </a>
            <a href="{{ route(request()->is('admin*') ? 'admin.posts.index' : 'editor.posts.index') }}" class="flex items-center px-6 py-2.5 rounded-lg hover:bg-indigo-50 text-gray-700 font-medium gap-4 transition group">
                <!-- Document Icon (Blog) -->
                <svg class="w-6 h-6 group-hover:text-indigo-600 text-gray-400 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M7 7h10M7 11h10M7 15h6"/><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/></svg>
                <span x-show="sidebarOpen" class="transition-all text-base">Blog</span>
            </a>
            <a href="{{ route(request()->is('admin*') ? 'admin.contact-messages.index' : 'editor.contact-messages.index') }}" class="flex items-center px-6 py-2.5 rounded-lg hover:bg-indigo-50 text-gray-700 font-medium gap-4 transition group">
                <!-- Mail Icon (Kontak) -->
                <svg class="w-6 h-6 group-hover:text-indigo-600 text-gray-400 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <span x-show="sidebarOpen" class="transition-all text-base">Kontak</span>
            </a>
            @if(request()->is('admin*'))
            <a href="{{ route('admin.projects.index') }}" class="flex items-center px-6 py-2.5 rounded-lg hover:bg-indigo-50 text-gray-700 font-medium gap-4 transition group">
                <!-- Cog Icon (Manajemen Proyek) -->
                <svg class="w-6 h-6 group-hover:text-indigo-600 text-gray-400 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0a1.724 1.724 0 002.573.965c.797-.602 1.885.091 1.623.986a1.724 1.724 0 001.516 2.36c.958.11 1.32 1.36.564 1.93a1.724 1.724 0 000 2.764c.756.57.394 1.82-.564 1.93a1.724 1.724 0 00-1.516 2.36c.262.895-.826 1.588-1.623.986a1.724 1.724 0 00-2.573.965c-.3.921-1.603.921-1.902 0a1.724 1.724 0 00-2.573-.965c-.797.602-1.885-.091-1.623-.986a1.724 1.724 0 00-1.516-2.36c-.958-.11-1.32-1.36-.564-1.93a1.724 1.724 0 000-2.764c-.756-.57-.394-1.82.564-1.93a1.724 1.724 0 001.516-2.36c-.262-.895.826-1.588 1.623-.986a1.724 1.724 0 002.573-.965z"/><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span x-show="sidebarOpen" class="transition-all text-base">Manajemen Proyek</span>
            </a>
            @endif
        </nav>
    </aside>
    <!-- Konten kanan: kolom vertikal dengan header, area konten (scrollable), dan footer.
         Gunakan `h-screen` agar kolom ini mengambil sisa tinggi setelah sidebar. -->
    <div class="flex-1 flex flex-col h-screen">
        <!-- Header modern ala Spike Tailwind: gunakan `shrink-0` agar tidak ikut scroll.
             Tinggi header (h-16) harus sama dengan logo section sidebar agar align rapi. -->
        <header class="flex items-center justify-between h-16 px-8 bg-white border-b border-gray-200 shadow-sm shrink-0">
            <div class="flex-1"></div>
            <!-- Aksi kanan: bell & user -->
            <div class="flex items-center gap-4">
                <button class="relative p-2 rounded-full hover:bg-gray-100 focus:outline-none">
                    <!-- Bell Icon -->
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center p-2 rounded-full hover:bg-gray-100 focus:outline-none">
                        <!-- User Icon -->
                        <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M5.121 17.804A9 9 0 1112 21a9 9 0 01-6.879-3.196z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg z-50">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profil</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Pengaturan</a>
                        <form method="POST" action="{{ route('logout') }}">@csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        <!-- Konten Halaman: buat area utama yang dapat discroll terpisah dari sidebar.
             Gunakan `overflow-auto` agar area ini yang discroll, bukan seluruh halaman. -->
        <main class="flex-1 overflow-auto p-8 bg-gray-50">
            @yield('content')
        </main>

        <!-- Footer konten: selalu berada di bawah kolom konten dengan shrink-0 agar tidak ikut mengecil.
             `shrink-0` penting agar footer tidak tiba-tiba hilang saat konten panjang. -->
        <footer class="bg-white border-t border-gray-200 p-4 text-center text-sm text-gray-500 shrink-0">
            {{-- Komentar: &copy; menampilkan symbol ©, ganti tahun atau nama sesuai kebutuhan Anda --}}
            &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
        </footer>
    </div>
</div>
@stack('scripts')
<!--
    Komentar:
    - Gunakan Alpine.js untuk interaktivitas toggle sidebar dan dropdown user.
    - Pastikan sudah include Alpine.js di app.js atau layout utama.
    - Untuk ikon, gunakan Material Icons atau Heroicons sesuai kebutuhan.
    - Struktur dan style sudah mengadopsi TailAdmin agar lebih profesional dan modern.
-->
</body>
</html>
