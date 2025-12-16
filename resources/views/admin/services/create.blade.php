{{-- resources/views/admin/services/create.blade.php --}}
@extends('layouts.dashboard')

@section('title','Tambah Layanan')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.services.form')
        </form>
    </div>
@endsection
