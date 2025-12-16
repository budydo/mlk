@extends('layouts.app')

@section('title','Kelola Posting (Editor)')

@section('content')
    @include('admin.posts.table', ['routePrefix' => 'editor.posts'])
@endsection
