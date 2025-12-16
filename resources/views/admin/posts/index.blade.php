{{-- resources/views/admin/posts/index.blade.php --}}
@extends('layouts.dashboard')

@section('title','Kelola Posting')

@section('content')
    {{-- Pesan sukses jika ada --}}
    @if(session('success'))
        <div class="max-w-6xl mx-auto px-4 sm:px-6 mb-4">
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-2 rounded">{{ session('success') }}</div>
        </div>
    @endif

    {{-- Sertakan partial tabel dan kontrol pencarian/filter --}}
    @include('admin.posts.table', ['routePrefix' => 'admin.posts'])
@endsection
