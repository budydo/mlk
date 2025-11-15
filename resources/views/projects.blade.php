{{-- resources/views/projects.blade.php --}}
@extends('layouts.app')

@section('title','Proyek — Perusahaan')

@section('content')
<section class="py-14">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <h2 class="text-3xl font-extrabold mb-6">Proyek Terpilih</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($projects as $project)
        <article class="bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition">
          @if($project->cover_image)
            <img src="{{ imageUrl($project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-48 object-cover" />
          @endif
          <div class="p-4">
            <h3 class="text-xl font-semibold">{{ $project->title }}</h3>
            <p class="text-sm text-slate-600 mt-2">{{ $project->excerpt }}</p>
            <div class="mt-3 text-right"><a href="{{ route('projects.show',$project->slug) }}" class="text-emerald-600 font-medium">Lihat detail →</a></div>
          </div>
        </article>
      @endforeach
    </div>
  </div>
</section>
@endsection
