{{-- resources/views/project-show.blade.php --}}
@extends('layouts.app')

@section('title', $project->title . ' — Proyek')

@section('content')
<section class="py-14">
  <div class="max-w-4xl mx-auto px-4 sm:px-6">
    <div class="bg-white p-6 rounded-xl shadow">
      <h1 class="text-3xl font-extrabold">{{ $project->title }}</h1>
      @if($project->cover_image)
        <img src="{{ imageUrl($project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-64 object-cover rounded-md mt-4" />
      @endif
      <p class="text-slate-600 mt-4">{{ $project->excerpt }}</p>
      <div class="prose mt-6">{!! nl2br(e($project->description)) !!}</div>
    </div>
  </div>
</section>
@endsection
