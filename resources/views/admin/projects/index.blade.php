{{-- resources/views/admin/projects/index.blade.php --}}
@extends('layouts.dashboard')

@section('title','Kelola Proyek')

@section('content')
    {{-- Menggunakan komponen Livewire ProjectManager agar tampilan seragam dengan manajemen layanan --}}
    @livewire('project-manager')
@endsection
