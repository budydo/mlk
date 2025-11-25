{{-- resources/views/editor/posts.blade.php --}}
{{-- Halaman untuk editor mengelola blog posts --}}
@extends('layouts.dashboard')

@section('title','Kelola Blog - Editor')

@section('content')
    {{-- Render komponen Livewire PostManager untuk editor --}}
    @livewire('post-manager')
@endsection
