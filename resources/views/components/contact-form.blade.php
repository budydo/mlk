{{-- resources/views/components/contact-form.blade.php --}}
{{-- Komponen form kontak yang dapat di-include di beberapa halaman tanpa mengubah backend. --}}
<div>
  {{-- Menampilkan notifikasi sukses jika ada --}}
  @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
  @endif

  {{-- Form akan posting ke route yang sama seperti halaman kontak: route('contact.send')
       Perubahan: hilangkan wrapper `bg-white p-6 rounded-xl shadow` agar form dapat ditempatkan
       di dalam kartu putih besar yang dibuat di `home.blade.php`. Struktur data dan field tetap sama. --}}
  <form action="{{ route('contact.send') }}" method="post" class="space-y-4">
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
        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2 rounded-md bg-emerald-600 text-white font-semibold shadow">Kirim Pesan
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </button>
      </div>
    </div>
  </form>
</div>
