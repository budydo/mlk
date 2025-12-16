{{-- resources/views/admin/posts/create.blade.php --}}
@extends('layouts.dashboard')

@section('title','Tambah Posting')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.posts.form')
        </form>
    </div>
@endsection
