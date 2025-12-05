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
        <div class="text-slate-600 mt-2">
          <p class="mt-4">
            CV. Mandiri Lestari Konsultan adalah perusahaan jasa konsultan yang beralamat di Jalan Paccinang 2 NO. 36B Tello Baru Kota Makassar yang telah berdiri seak 24 November 2017 yang dinyatakan dalam akte Notaris Ahmad Ali Taufik, SH.,M.Hum.,M.Kn dengan Akte Nomor 02, memberikan jasa pelayanan konsultan, jasa konsultansi bidang konsultan lingkungan, perencanaan dan transportasi.
          </p>
          <p class="mt-4">
            Oleh karna itu kami CV. Mandiri Lestari Konsultan mencoba tetap eksis guna mewujudkan impian-impian dalam suatu orientasi yang menghasilkan suatu karya-karya yang diinginkan untuk masa yang akan datang. Dengan tujuan yang mulia serta idealisme yang tinggi, kami tetap konsisten dengan komitmen awal pada saat mendirikan perusahaan konsultan. Dimana tenaga-tenaga ahli potensial kami yang telah banyak menghasilkan karya-karya nyata dalam suatu pelaksanaan perencanaan proyek baik proyek pemerintahan maupun swasta, yang telah diselesaikan dan diterima dengan baik.
          </p>
          <p class="mt-4">
            Dalam memasuki Era Pasar Bebas, dimana tuntutan pembagunan semakin memerlukan tenaga 
            terampil dan cakap dibidangnya. Untuk itu untuk mengantisipasi hal ini CV. Mandiri Lestari Konsultan yang didukung oleh tenaga tenaga muda potensial yang mempunyai pengalaman dan keahlian dibidangnya masing-masing, serta cara kerja profesional, berusaha tampil bersama pelaku pembagunan lainnya untuk mengembangkan kemampuan dan potensi yang dimilikinya demi bangsa dan negara.
          </p>
        </div>
      </div>

      <div>
        <h3 class="text-xl font-semibold">Visi</h3>
        <div class="text-slate-600 mt-2">Menjadi perusahaan yang terus berkembang dan maju dengan mengutamakan kualitas dan kepuasan pelanggan serta untuk mensejahterakan karyawan. Menjadi perusahaan swasta Indonesia yang unggul, professional dan terdepan dalam melayani klien maupun mitra bisnis.</div>
      </div>

      <div>
        <h3 class="text-xl font-semibold">Misi</h3>
        <div class="text-slate-600 mt-2">
          <ul class="list-disc list-inside space-y-2">
            <li>Memberikan pelayanan terbaik secara professional, sistematis dan teknologi yang terintegrasi.</li>
            <li>Menghadirkan kegiatan operasional dan layanan yang terencana dan tepat sasaran.</li>
            <li>Menjalin hubungan kerjasama yang baik dengan partner jangka pendek maupun jangka panjang.</li>
            <li>Memberikan keuntungan yang maksimal bagi perusahaan dan seluruh Stakeholder.</li>
          </ul>
        </div>
      </div>

      <div>
        <h3 class="text-xl font-semibold">Tim Kami</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">
          @foreach($team as $member)
            <div class="bg-white p-4 rounded-lg shadow">
              @if($member->photo)
                <img src="{{ $member->photo }}" alt="{{ $member->name }}" class="w-full h-60 object-cover rounded" />
              @endif
              <h4 class="mt-3 font-semibold">{{ $member->name }}</h4>
              <div class="text-sm text-slate-500">{{ $member->role }}</div>
              <p class="text-sm mt-2 text-slate-600">{{ Str::limit($member->bio, 120) }}</p>
            </div>
          @endforeach
          <div class="bg-white p-4 rounded-lg shadow">
            <img src="https://images.unsplash.com/photo-1615109398623-88346a601842?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-full h-60 object-cover rounded" />
            <h4 class="mt-3 font-semibold">Muhammad Natsir Imran</h4>
            <div class="text-sm text-slate-500">Founder</div>
            <p class="text-sm mt-2 text-slate-600">Profesional berpengalaman dalam mengelola administrasi dan koordinasi tim.</p>
          </div>
          <div class="bg-white p-4 rounded-lg shadow">
            <img src="https://images.unsplash.com/photo-1615109398623-88346a601842?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-full h-60 object-cover rounded" />
            <h4 class="mt-3 font-semibold">Bung Hendra</h4>
            <div class="text-sm text-slate-500">Direktur</div>
            <p class="text-sm mt-2 text-slate-600">Profesional berpengalaman dalam mengelola administrasi dan koordinasi tim.</p>
          </div>
          <div class="bg-white p-4 rounded-lg shadow">
            <img src="https://images.unsplash.com/photo-1615109398623-88346a601842?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-full h-60 object-cover rounded" />
            <h4 class="mt-3 font-semibold">Kurnia</h4>
            <div class="text-sm text-slate-500">Sekertaris</div>
            <p class="text-sm mt-2 text-slate-600">Profesional berpengalaman dalam mengelola administrasi dan koordinasi tim.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
