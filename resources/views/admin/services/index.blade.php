{{-- resources/views/admin/services/index.blade.php --}}
@extends('layouts.app')

@section('title','Kelola Layanan')

@section('content')
    {{-- Menggunakan komponen Livewire ServiceManager --}}
    @livewire('service-manager')
@endsection
