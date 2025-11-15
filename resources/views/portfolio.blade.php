{{-- resources/views/portfolio.blade.php --}}
{{-- Halaman portofolio yang menampilkan proyek-proyek yang telah dikerjakan perusahaan. --}}
@extends('layouts.app')

@section('title', 'Portfolio — Proyek & Studi Kasus')

@section('content')
<section class="py-14">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="text-center mb-10">
      <h2 class="text-3xl font-extrabold">Portofolio Proyek Kami</h2>
      <p class="text-slate-600 mt-2">
        Koleksi proyek-proyek yang telah kami selesaikan dengan hasil yang terukur dan berkelanjutan.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @forelse($projects->take(12) as $project)
        <article class="bg-white rounded-xl overflow-hidden shadow hover:shadow-xl transition transform hover:scale-105">
          {{-- Gambar Proyek --}}
          @if($project->cover_image)
            <div class="relative h-48 overflow-hidden">
              <img src="{{ imageUrl($project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover" />
              <div class="absolute inset-0 bg-black/20 hover:bg-black/30 transition"></div>
            </div>
          @else
            <div class="h-48 bg-gradient-to-br from-blue-100 to-emerald-100 flex items-center justify-center">
              <div class="text-blue-600 text-4xl font-bold">P</div>
            </div>
          @endif

          {{-- Konten Proyek --}}
          <div class="p-6">
            <h3 class="text-xl font-semibold line-clamp-2">{{ $project->title }}</h3>
            <p class="text-sm text-slate-600 mt-3 line-clamp-3">{{ $project->excerpt }}</p>

            {{-- Link Detail --}}
            <div class="mt-4">
              <a href="{{ route('projects.show', $project->slug) }}" class="inline-flex items-center text-emerald-600 font-medium hover:text-emerald-700 transition">
                Lihat Detail Proyek
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </a>
            </div>
          </div>
        </article>
      @empty
        <div class="col-span-full text-center py-16">
          <p class="text-slate-600 text-lg">Tidak ada proyek dalam portofolio saat ini.</p>
        </div>
      @endforelse
    </div>

    {{-- CTA Konsultasi --}}
    <div class="mt-16">
      <div class="bg-gradient-to-r from-emerald-50 to-blue-50 rounded-xl p-8 text-center">
        <h3 class="text-2xl font-extrabold">Tertarik Bekerja Sama?</h3>
        <p class="text-slate-600 mt-2">Hubungi kami untuk mendiskusikan kebutuhan proyek Anda.</p>
        <div class="mt-6 flex gap-3 justify-center">
          <a href="{{ route('contact') }}" class="px-6 py-3 rounded-md btn-primary text-white">Hubungi Kami</a>
          <a href="https://wa.me/6281340699907" target="_blank" class="px-6 py-3 rounded-md border border-emerald-600 text-emerald-600 hover:bg-emerald-50">
            Chat WhatsApp
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
