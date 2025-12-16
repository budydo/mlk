@extends('layouts.app')

@section('title','Tambah Posting (Editor)')

@section('content')
    <div class="max-w-2xl mx-auto px-4 sm:px-6">
        <form method="POST" action="{{ route('editor.posts.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.posts.form') {{-- reuse admin form for consistency --}}
        </form>
    </div>
@endsection
