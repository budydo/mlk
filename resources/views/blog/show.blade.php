{{-- resources/views/blog/show.blade.php --}}
@extends('layouts.app')

@section('title', $post->title)

@section('content')
<section class="py-12">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 mb-4">
    <a href="{{ route('blog.index') }}" class="text-blue-500 hover:underline">Kembali</a>
  </div>
  <div class="max-w-4xl mx-auto px-4 sm:px-6">
    @if($post->cover_image)
            <div class="relative group block overflow-hidden rounded-md">
              <button type="button" aria-label="Lihat gambar secara penuh" class="w-full text-left p-0 m-0" onclick="openCoverModal()">
              <img src="{{ imageUrl($post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover transition-transform duration-300 ease-in-out transform group-hover:scale-105" />
              <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18.5a7.5 7.5 0 006.15-1.85z" />
                </svg>
              </div>
              </button>
            </div>

            <!-- Modal (same page) -->
            <div id="cover-modal" role="dialog" aria-modal="true" aria-label="Gambar sampul" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-70 p-4">
              <div class="relative max-w-4xl w-full">
              <button type="button" aria-label="Tutup gambar" class="absolute top-2 right-2 text-white bg-black bg-opacity-40 rounded-full w-9 h-9 flex items-center justify-center" onclick="closeCoverModal()">
                <span class="sr-only">Tutup</span>
                ×
              </button>
              <img src="{{ imageUrl($post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-auto rounded-md shadow-lg" />
              </div>
            </div>

            <script>
              function openCoverModal() {
              const el = document.getElementById('cover-modal');
              if (!el) return;
              el.classList.remove('hidden');
              el.classList.add('flex');
              // optional: prevent background scrolling
              document.documentElement.style.overflow = 'hidden';
              }
              function closeCoverModal() {
              const el = document.getElementById('cover-modal');
              if (!el) return;
              el.classList.add('hidden');
              el.classList.remove('flex');
              document.documentElement.style.overflow = '';
              }
              // close on ESC
              document.addEventListener('keydown', function(e) {
              if (e.key === 'Escape') closeCoverModal();
              });
              // close when clicking outside image
              document.addEventListener('click', function(e) {
              const el = document.getElementById('cover-modal');
              if (!el) return;
              if (!el.classList.contains('hidden') && e.target === el) closeCoverModal();
              });
            </script>
          @else
            <div class="w-full h-40 bg-slate-100 rounded-md flex items-center justify-center text-slate-400 text-sm">Tidak ada cover</div>
          @endif
    <h1 class="text-3xl font-extrabold">{{ $post->title }}</h1>
    <div class="mt-4 text-sm text-slate-500">Diterbitkan: {{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}</div>

    <div class="mt-6 prose max-w-none">{!! $post->content !!}</div>
  </div>
</section>
@endsection
