@extends('layouts.dashboard')

@section('title','Kelola Proyek')

@section('content')
    {{-- Menampilkan daftar proyek menggunakan pagination server-side (non-Livewire) --}}
    @include('editor.projects.table')
@endsection
