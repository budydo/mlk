{{-- resources/views/admin/posts.blade.php --}}
{{-- Halaman untuk admin mengelola blog posts --}}
@extends('layouts.dashboard')

@section('title','Kelola Blog - Admin')

@section('content')
    {{-- Gunakan implementasi server-side: sertakan index yang menampilkan table dan kontrol --}}
    @include('admin.posts.index')
@endsection
