@extends('layouts.dashboard')

@section('title','Kelola Proyek')

@section('content')
    {{-- Menggunakan komponen Livewire EditorProjectManager agar konsisten dengan tampilan Layanan --}}
    @livewire('editor-project-manager')
@endsection
