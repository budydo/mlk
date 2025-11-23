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
          {{-- Jika ada cover image, bungkus gambar dengan <a> agar link bisa diklik dan overlay bekerja --}}
          @if($post->cover_image)
            {{-- Tambahkan kelas relative pada container link agar overlay absolute bekerja --}}
            <a href="{{ route('blog.show', $post->slug) }}" class="group block rounded-md overflow-hidden relative">
              {{-- Gambar cover artikel --}}
              <img src="{{ imageUrl($post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-40 object-cover transition-transform duration-300 ease-in-out transform group-hover:scale-105" />
              {{-- Overlay (ikon) yang muncul saat hover pada link --}}
              <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18.5a7.5 7.5 0 006.15-1.85z" />
                </svg>
              </div>
            </a>
          @else
            <div class="w-full h-40 bg-slate-100 rounded-md flex items-center justify-center text-slate-400 text-sm">Tidak ada cover</div>
          @endif

          <h3 class="font-semibold mt-3">{{ $post->title }}</h3>
          <p class="text-sm text-slate-600 mt-2 line-clamp-3">{!! $post->excerpt !!}</p>
          <div class="mt-3"><a href="{{ route('blog.show', $post->slug) }}" class="text-emerald-600 text-sm">Baca.. →</a></div>
        </article>
      @empty
        <div class="col-span-full text-center py-12">Belum ada artikel.</div>
      @endforelse
    </div>

    <div class="mt-8">{{ $posts->links() }}</div>
  </div>
</section>
@endsection
