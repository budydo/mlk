{{-- resources/views/services.blade.php --}}
@extends('layouts.app')

@section('title','Layanan — Perusahaan')

@section('content')
<section class="py-14">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="text-center mb-10">
      <h2 class="text-3xl font-extrabold">Layanan Kami</h2>
      <p class="text-slate-600 mt-2">Layanan komprehensif dari perizinan hingga program pemberdayaan, disesuaikan dengan kebutuhan proyek Anda.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse($services->take(9) as $service)
        <article class="bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition">
          @php
            $serviceImage = $service->image_path ?? $service->cover_image ?? null;
          @endphp
          @if($serviceImage)
            <img src="{{ imageUrl($serviceImage) }}" alt="{{ $service->title }}" class="w-full h-40 object-cover" />
          @else
            <div class="w-full h-40 bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center">
              <div class="text-emerald-600 text-4xl font-bold">S</div>
            </div>
          @endif
          <div class="p-6">
            <h3 class="text-xl font-semibold">{{ $service->title }}</h3>
            <p class="text-sm text-slate-600 mt-2">{{ $service->excerpt }}</p>
            <div class="mt-4">
              <a href="{{ route('services.show', $service->slug) }}" class="text-emerald-600 font-medium hover:text-emerald-700">
                Pelajari lebih lanjut →
              </a>
            </div>
          </div>
        </article>
      @empty
        <div class="col-span-full text-center py-12">
          <p class="text-slate-600">Tidak ada layanan yang tersedia saat ini.</p>
        </div>
      @endforelse
    </div>
  </div>
</section>
@endsection
