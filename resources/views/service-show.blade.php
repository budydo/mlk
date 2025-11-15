{{-- resources/views/service-show.blade.php --}}
@extends('layouts.app')

@section('title', $service->title . ' — Layanan')

@section('content')
<section class="py-14">
  <div class="max-w-4xl mx-auto px-4 sm:px-6">
    <div class="bg-white p-6 rounded-xl shadow">
      <h1 class="text-3xl font-extrabold">{{ $service->title }}</h1>
      <p class="text-slate-600 mt-4">{{ $service->excerpt }}</p>
      <div class="prose mt-6">{!! nl2br(e($service->description)) !!}</div>
    </div>
  </div>
</section>
@endsection
