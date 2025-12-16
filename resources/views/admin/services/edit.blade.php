{{-- resources/views/admin/services/edit.blade.php --}}
@extends('layouts.dashboard')

@section('title','Edit Layanan')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            @include('admin.services.form')
        </form>
    </div>
@endsection
