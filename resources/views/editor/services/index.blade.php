@extends('layouts.dashboard')

@section('title','Kelola Layanan')

@section('content')
    {{-- Menggunakan komponen Livewire EditorServiceManager --}}
    @livewire('editor-service-manager')
@endsection
