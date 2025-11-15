{{-- resources/views/about.blade.php --}}
@extends('layouts.app')

@section('title','Tentang Kami — Perusahaan')

@section('content')
<section class="py-14 bg-white">
  <div class="max-w-5xl mx-auto px-4 sm:px-6">
    <h2 class="text-3xl font-extrabold">Tentang Kami</h2>

    <div class="mt-6 space-y-6">
      <div>
        <h3 class="text-xl font-semibold">Sejarah Perusahaan</h3>
        <div class="text-slate-600 mt-2">{!! nl2br(e(optional($history)->value ?? 'Kami belum menambahkan sejarah perusahaan.')) !!}</div>
      </div>

      <div>
        <h3 class="text-xl font-semibold">Visi</h3>
        <div class="text-slate-600 mt-2">{!! nl2br(e(optional($vision)->value ?? '-')) !!}</div>
      </div>

      <div>
        <h3 class="text-xl font-semibold">Misi</h3>
        <div class="text-slate-600 mt-2">{!! nl2br(e(optional($mission)->value ?? '-')) !!}</div>
      </div>

      <div>
        <h3 class="text-xl font-semibold">Tim Kami</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">
          @foreach($team as $member)
            <div class="bg-white p-4 rounded-lg shadow">
              @if($member->photo)
                <img src="{{ $member->photo }}" alt="{{ $member->name }}" class="w-full h-36 object-cover rounded" />
              @endif
              <h4 class="mt-3 font-semibold">{{ $member->name }}</h4>
              <div class="text-sm text-slate-500">{{ $member->role }}</div>
              <p class="text-sm mt-2 text-slate-600">{{ Str::limit($member->bio, 120) }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
