{{-- resources/views/admin/posts/edit.blade.php --}}
@extends('layouts.dashboard')

@section('title','Edit Posting')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            @include('admin.posts.form')
        </form>
    </div>
@endsection
