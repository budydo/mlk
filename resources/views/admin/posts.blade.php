{{-- resources/views/admin/posts.blade.php --}}
{{-- Halaman untuk admin mengelola blog posts --}}
@extends('layouts.dashboard')

@section('title','Kelola Blog - Admin')

@section('content')
    {{-- Render komponen Livewire PostManager untuk admin --}}
    @livewire('post-manager')
@endsection
