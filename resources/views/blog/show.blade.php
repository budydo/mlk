{{-- resources/views/blog/show.blade.php --}}
@extends('layouts.app')

@section('title', $post->title)

@section('content')
<section class="py-12">
  <div class="max-w-4xl mx-auto px-4 sm:px-6">
    <h1 class="text-3xl font-extrabold">{{ $post->title }}</h1>
    <div class="mt-4 text-sm text-slate-500">Diterbitkan: {{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}</div>

    <div class="mt-6 prose max-w-none">{!! $post->content !!}</div>
  </div>
</section>
@endsection
