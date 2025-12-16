@extends('layouts.dashboard')

@section('title','Kelola Layanan')

@section('content')
    {{-- Tampilkan pesan sukses bila ada --}}
    @if(session('success'))
        <div class="max-w-6xl mx-auto px-4 sm:px-6 mb-4">
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-2 rounded">{{ session('success') }}</div>
        </div>
    @endif

    {{-- Sertakan partial tabel yang sama, dengan prefix route editor --}}
    @include('admin.services.table', ['routePrefix' => 'editor.services'])
@endsection
