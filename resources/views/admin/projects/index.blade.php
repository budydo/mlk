{{-- resources/views/admin/projects/index.blade.php --}}
@extends('layouts.dashboard')

@section('title','Kelola Proyek')

@section('content')
    {{-- Menampilkan daftar proyek menggunakan pagination server-side (non-Livewire) --}}
    @if(session('success'))
        <div class="max-w-6xl mx-auto px-4 sm:px-6 mb-4">
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-2 rounded">{{ session('success') }}</div>
        </div>
    @endif
    @include('admin.projects.table')
@endsection
