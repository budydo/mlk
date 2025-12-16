{{-- resources/views/editor/posts.blade.php --}}
{{-- Halaman untuk editor mengelola blog posts --}}
@extends('layouts.dashboard')

@section('title','Kelola Blog - Editor')

@section('content')
    {{-- Gunakan implementasi server-side: sertakan index yang menampilkan table dan kontrol --}}
    @include('editor.posts.index')
@endsection
