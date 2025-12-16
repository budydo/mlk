{{-- resources/views/editor/services/edit.blade.php --}}
@extends('layouts.dashboard')

@section('title','Edit Layanan (Editor)')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <form method="POST" action="{{ route('editor.services.update', $service) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            @include('admin.services.form') {{-- reuse admin form for consistency --}}
        </form>
    </div>
@endsection
