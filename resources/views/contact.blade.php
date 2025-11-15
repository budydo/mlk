{{-- resources/views/contact.blade.php --}}
@extends('layouts.app')

@section('title','Kontak — Perusahaan')

@section('content')
<section class="py-14">
  <div class="max-w-3xl mx-auto px-4 sm:px-6">
    <h2 class="text-3xl font-extrabold mb-6">Kontak</h2>

    @if(session('success'))
      <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <form action="{{ route('contact.send') }}" method="post" class="bg-white p-6 rounded-xl shadow">
      @csrf
      <div class="grid grid-cols-1 gap-4">
        <div>
          <label class="block text-sm font-medium text-slate-700">Nama</label>
          <input type="text" name="name" required value="{{ old('name') }}" class="mt-1 block w-full border rounded-md p-3" />
          @error('name') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div>
          <label class="block text-sm font-medium text-slate-700">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full border rounded-md p-3" />
          @error('email') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div>
          <label class="block text-sm font-medium text-slate-700">Telepon</label>
          <input type="text" name="phone" value="{{ old('phone') }}" class="mt-1 block w-full border rounded-md p-3" />
          @error('phone') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div>
          <label class="block text-sm font-medium text-slate-700">Pesan</label>
          <textarea name="message" rows="6" required class="mt-1 block w-full border rounded-md p-3">{{ old('message') }}</textarea>
          @error('message') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="text-right">
          <button type="submit" class="px-4 py-2 rounded-md bg-emerald-600 text-white">Kirim Pesan</button>
        </div>
      </div>
    </form>
  </div>
</section>
@endsection
