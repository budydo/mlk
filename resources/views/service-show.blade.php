{{-- resources/views/service-show.blade.php --}}
@extends('layouts.app')

@section('title', $service->title . ' — Layanan')

@section('content')
<section class="py-14">
  <div class="max-w-4xl mx-auto px-4 sm:px-6">
    <a href="{{ route('services.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-6">
      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
      </svg>
      Kembali
    </a>

    <div class="bg-white rounded-xl shadow overflow-hidden">
      @if($service->image_path)
        <img src="{{ imageUrl($service->image_path) }}" alt="{{ $service->title }}" class="w-full h-100 object-cover">
      @endif
      
      <div class="p-6">
        <h1 class="text-3xl font-extrabold">{{ $service->title }}</h1>
        <p class="text-slate-600 mt-4">{{ $service->excerpt }}</p>
        <div class="prose mt-6">{!! nl2br(e($service->description)) !!}</div>
      </div>
    </div>
  </div>
</section>
@endsection
