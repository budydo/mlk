{{-- resources/views/blog/index.blade.php --}}
@extends('layouts.app')

@section('title','Blog — MLK')

@section('content')
<section class="py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <h2 class="text-3xl font-extrabold mb-6">Artikel & Insight</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      @forelse($posts as $post)
        <article class="bg-white rounded-xl p-4 shadow">
          <h3 class="font-semibold">{{ $post->title }}</h3>
          <p class="text-sm text-slate-600 mt-2 line-clamp-3">{!! $post->excerpt !!}</p>
          <div class="mt-3"><a href="{{ route('blog.show', $post->slug) }}" class="text-emerald-600 text-sm">Baca →</a></div>
        </article>
      @empty
        <div class="col-span-full text-center py-12">Belum ada artikel.</div>
      @endforelse
    </div>

    <div class="mt-8">{{ $posts->links() }}</div>
  </div>
</section>
@endsection
