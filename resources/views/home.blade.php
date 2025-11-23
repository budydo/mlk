{{-- File: resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Beranda — MANDIRI LESTARI KONSULTAN')

@section('content')
    {{-- CSS kecil: gunakan variable CSS untuk scroll-margin agar anchor tidak tertutup navbar sticky --}}
    <style>
      :root { --nav-height: 64px; }
      /* pastikan semua section memperhitungkan tinggi navbar saat di-scroll ke anchor */
      section { scroll-margin-top: calc(var(--nav-height) + 12px); }
      
      /**
       * Styling tambahan untuk transisi navbar yang halus
       * - Elemen nav-link mendapat transition duration-300 untuk perubahan warna/background yang smooth
       * - Focus ring juga menambah polish saat keyboard navigation
       */
      @media (prefers-reduced-motion: no-preference) {
        /* Pastikan transisi berjalan smooth untuk semua browser */
        a[class*="nav-link"] {
          transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1);
        }
      }
    </style>
    {{-- HERO SLIDER — Konten dinamis dari database (home_contents) --}}
    <section id="hero" class="relative">
      <div id="slider" class="relative overflow-hidden">
        <div class="relative h-[68vh] lg:h-[76vh]">
          {{-- Tampilkan slide dari database --}}
          @if($heroContents && count($heroContents) > 0)
            @foreach($heroContents as $content)
              <div class="slide absolute inset-0 {{ $loop->first ? 'opacity-100' : 'opacity-0' }} transition-opacity duration-800 ease-out" data-index="{{ $loop->index }}">
                {{-- Gambar Hero dari database atau Unsplash --}}
                @if($content->image_path)
                  <img src="{{ asset($content->image_path) }}" alt="{{ $content->title }}" class="w-full h-full object-cover" />
                @else
                  {{-- Fallback: gradient warna jika gambar tidak ada --}}
                  <div class="w-full h-full bg-gradient-to-r from-emerald-600 to-blue-600"></div>
                @endif
                <div class="absolute inset-0 hero-mask"></div>
                <div class="absolute inset-0 max-w-7xl mx-auto px-6 flex items-center">
                  <div class="w-full lg:w-1/2 text-white py-12">
                    <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold slide-title">{{ $content->title }}</h2>
                    <p class="mt-4 text-lg sm:text-xl text-slate-200/90">{{ $content->description }}</p>
                    @if($content->button_text && $content->button_url)
                      <div class="mt-8 flex gap-3">
                        <a href="{{ $content->button_url }}" class="px-5 py-3 rounded-md btn-primary shadow">
                          {{ $content->button_text }}
                        </a>
                        <a href="#consult" class="px-5 py-3 rounded-md btn-ghost">Minta Penawaran</a>
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            @endforeach
          @else
            {{-- Fallback: Tampilkan slide statis jika tidak ada data dari database --}}
            <div class="slide absolute inset-0 opacity-100 transition-opacity duration-800 ease-out" data-index="0">
              <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?q=80&w=1920&auto=format&fit=crop" alt="restorasi lahan" class="w-full h-full object-cover" />
              <div class="absolute inset-0 hero-mask"></div>
              <div class="absolute inset-0 max-w-7xl mx-auto px-6 flex items-center">
                <div class="w-full lg:w-1/2 text-white py-12">
                  <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold slide-title">Restorasi Lahan & Pemulihan Ekosistem</h2>
                  <p class="mt-4 text-lg sm:text-xl text-slate-200/90">Program revegetasi, rehabilitasi, dan pemantauan agar fungsi ekologis pulih dan komunitas berdaya.</p>
                  <div class="mt-8 flex gap-3">
                    <a href="#projects" class="px-5 py-3 rounded-md btn-primary shadow">Lihat Studi Kasus</a>
                    <a href="#consult" class="px-5 py-3 rounded-md btn-ghost">Minta Penawaran</a>
                  </div>
                </div>
              </div>
            </div>
          @endif
        </div>

        {{-- nav controls --}}
        <div class="absolute inset-0 pointer-events-none">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 h-full flex items-center justify-between">
            <button id="prev" class="control pointer-events-auto -ml-2" aria-label="Prev slide">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
              </svg>
            </button>
            <button id="next" class="control pointer-events-auto -mr-2" aria-label="Next slide">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
              </svg>
            </button>
          </div>
        </div>

        <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 z-30">
          <div id="dots" class="flex items-center gap-2 bg-black/20 px-3 py-1 rounded-full"></div>
        </div>
      </div>
    </section>

    {{-- ABOUT SECTION (sesuai permintaan: tampil seperti gambar2) --}}
    <section id="about" class="py-16 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
          <div class="reveal" data-reveal>
            {{-- Gambar atau ilustrasi tentang perusahaan --}}
            <img src="{{ asset('images/home/4.png') }}" alt="Tentang kami" class="w-full rounded-xl shadow-lg object-cover h-96" />
          </div>

          <div class="reveal" data-reveal>
            <h3 class="text-3xl font-extrabold">Tentang Mandiri Lestari Konsultan</h3>
            <p class="mt-4 text-slate-600 text-lg leading-relaxed">Mandiri Lestari Konsultan adalah mitra profesional yang berkomitmen menghadirkan solusi lingkungan dan perencanaan yang tepat, terpadu, dan sesuai regulasi. Setiap proyek ditangani dengan pendekatan ilmiah, ketelitian teknis, serta integritas tinggi demi memastikan hasil yang akurat dan dapat dipertanggungjawabkan. Kami mengutamakan kualitas layanan, kepastian proses, serta pendampingan yang jelas sejak tahap awal hingga penerbitan dokumen final. Didukung oleh tenaga ahli berpengalaman, pemahaman mendalam terhadap kebijakan pemerintah, serta rekam jejak yang terbukti, Mandiri Lestari Konsultan menjadi pilihan tepat bagi perusahaan yang membutuhkan kepastian, efisiensi, dan kepatuhan dalam setiap kegiatan pembangunan.</p>
            {{-- <ul class="mt-6 space-y-3">
              <li class="flex items-start gap-3">
                <span class="text-emerald-600 font-bold mt-1">•</span>
                <span class="text-slate-700">Perencanaan & Perizinan Lingkungan</span>
              </li>
              <li class="flex items-start gap-3">
                <span class="text-emerald-600 font-bold mt-1">•</span>
                <span class="text-slate-700">Revegetasi & Rehabilitasi Ekosistem</span>
              </li>
              <li class="flex items-start gap-3">
                <span class="text-emerald-600 font-bold mt-1">•</span>
                <span class="text-slate-700">Pemantauan & Evaluasi Proyek</span>
              </li>
            </ul> --}}
            <div class="mt-6">
              <a href="{{ route('about') ?? '#' }}" class="inline-block px-6 py-3 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700 transition">Pelajari Lebih Lanjut →</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- PROCESS SECTION (work process sesuai gambar3) --}}
    <section id="process" class="py-16 bg-slate-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-8">
          <h3 class="text-2xl font-extrabold">Alur Kerja Kami</h3>
          <p class="text-slate-600 mt-2">Tahapan terstruktur untuk memastikan hasil yang transparan, terukur, dan berkelanjutan.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
          {{-- Step 1 --}}
          <div class="bg-white p-6 rounded-xl shadow text-center reveal" data-reveal>
            <div class="w-16 h-16 rounded-full bg-emerald-50 flex items-center justify-center mx-auto">
              <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
              </svg>
            </div>
            <h4 class="mt-4 font-semibold">Assessment</h4>
            <p class="mt-2 text-sm text-slate-600">Penilaian kondisi lapangan dan pengumpulan data baseline.</p>
          </div>

          {{-- Step 2 --}}
          <div class="bg-white p-6 rounded-xl shadow text-center reveal" data-reveal>
            <div class="w-16 h-16 rounded-full bg-emerald-50 flex items-center justify-center mx-auto">
              <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
              </svg>
            </div>
            <h4 class="mt-4 font-semibold">Perencanaan</h4>
            <p class="mt-2 text-sm text-slate-600">Desain intervensi teknis & program partisipatif bersama pemangku kepentingan.</p>
          </div>

          {{-- Step 3 --}}
          <div class="bg-white p-6 rounded-xl shadow text-center reveal" data-reveal>
            <div class="w-16 h-16 rounded-full bg-emerald-50 flex items-center justify-center mx-auto">
              <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
              </svg>
            </div>
            <h4 class="mt-4 font-semibold">Implementasi</h4>
            <p class="mt-2 text-sm text-slate-600">Pelaksanaan lapangan dengan mitra lokal dan monitoring berkala.</p>
          </div>

          {{-- Step 4 --}}
          <div class="bg-white p-6 rounded-xl shadow text-center reveal" data-reveal>
            <div class="w-16 h-16 rounded-full bg-emerald-50 flex items-center justify-center mx-auto">
              <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
              </svg>
            </div>
            <h4 class="mt-4 font-semibold">Evaluasi & Scale</h4>
            <p class="mt-2 text-sm text-slate-600">Evaluasi dampak dan rencana perluasan program jika sukses.</p>
          </div>
        </div>
      </div>
    </section>

    {{-- WHY --}}
    <section id="why" class="py-14 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">
          <div class="lg:col-span-2 reveal" data-reveal>
            <img src="{{ asset('images/home/why.png') }}" alt="why choose" class="w-full rounded-xl shadow-lg object-cover h-96" />
          </div>

          <div class="reveal" data-reveal>
            <h3 class="text-2xl font-extrabold">Kenapa Memilih MANDIRI LESTARI</h3>
            <p class="mt-3 text-slate-600">Kami memadukan kompetensi teknis, pengalaman lapangan, dan pendekatan partisipatif untuk solusi yang tahan uji.</p>

            <div class="mt-6 space-y-5">
              <div class="flex gap-3 items-start">
                <div class="w-10 h-10 rounded-md bg-emerald-50 flex items-center justify-center text-emerald-600 font-bold">✔</div>
                <div>
                  <div class="font-semibold">Profesional & Terukur</div>
                  <div class="text-sm text-slate-600">Tim ahli dengan rekam jejak proyek regulasi & restorasi.</div>
                </div>
              </div>

              <div class="flex gap-3 items-start">
                <div class="w-10 h-10 rounded-md bg-emerald-50 flex items-center justify-center text-emerald-600 font-bold">★</div>
                <div>
                  <div class="font-semibold">Pendekatan Partisipatif</div>
                  <div class="text-sm text-slate-600">Program yang dirancang bersama komunitas lokal agar hasil lestari.</div>
                </div>
              </div>

              <div class="flex gap-3 items-start">
                <div class="w-10 h-10 rounded-md bg-emerald-50 flex items-center justify-center text-emerald-600 font-bold">⏱</div>
                <div>
                  <div class="font-semibold">Respons Cepat & Efisien</div>
                  <div class="text-sm text-slate-600">Notifikasi & koordinasi melalui WhatsApp / Email untuk percepatan respon.</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- STAT / CTA --}}
    <section class="py-12 bg-slate-800 text-slate-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="bg-slate-900/60 p-10 rounded-xl">
          <div class="flex flex-col items-center justify-center text-center">
            <div class="reveal max-w-2xl" data-reveal>
              <h4 class="text-2xl font-extrabold text-white">Ambil langkah yang tepat, wujudkan hal besar.</h4>
                <p class="mt-2 text-slate-200/90">Dari studi kelayakan hingga implementasi lapangan — kami hadirkan solusi lingkungan yang terukur, terpercaya, dan berdampak nyata. Lebih dari 100 proyek telah kami wujudkan bersama mitra di seluruh nusantara.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- TESTIMONIALS --}}
    <section class="py-14 bg-slate-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-8">
          <h3 class="text-2xl font-extrabold">Testimoni Klien</h3>
          <p class="text-slate-600 mt-2">Pendapat beberapa klien setelah bekerja sama dengan kami.</p>
        </div>

        <div class="relative">
          <div id="testiTrack" class="overflow-hidden">
            <div id="testiList" class="flex gap-6 transition-transform duration-500"></div>
          </div>

          <div class="flex items-center justify-center gap-3 mt-6">
            <button id="testiPrev" class="px-3 py-2 rounded-md btn-ghost">‹</button>
            <button id="testiNext" class="px-3 py-2 rounded-md btn-ghost">›</button>
          </div>
        </div>
      </div>
    </section>

    {{-- LOGOS --}}
    {{-- <section class="py-8">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-6">
          <h4 class="text-lg font-semibold">Perusahaan yang pernah bekerja sama</h4>
        </div>

        <div class="overflow-hidden">
          <div id="logoTrack" class="logo-track flex gap-10 items-center"></div>
        </div>
      </div>
    </section> --}}

    {{-- PORTFOLIO --}}
    <section id="projects" class="py-12 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between mb-6">
          <h3 class="text-2xl font-extrabold">Portofolio Terpilih</h3>
          <a href="{{ route('portfolio.index') }}" class="text-sm text-emerald-600">Lihat Semua →</a>
        </div>

        {{-- Grid portofolio — menampilkan hanya proyek unggulan (featured projects) yang sudah dipublikasikan --}}
        {{-- Query ini mengambil proyek dengan is_featured=1 dan is_published=1, diurutkan dari yang terbaru --}}
        @php
          use App\Models\Project;
          // Ambil proyek yang ditandai sebagai unggulan (is_featured=1) dan sudah dipublikasikan (is_published=1)
          // Gunakan scope 'featured' yang sudah didefinisikan di model Project untuk hasil yang konsisten
          $latestProjects = Project::query()
            ->where('is_featured', 1)       // Filter: hanya proyek yang is_featured=true
            ->where('is_published', 1)      // Filter: hanya proyek yang dipublikasikan
            ->orderBy('created_at', 'desc') // Urutkan dari terbaru ke terlama
            ->take(6)                       // Batasi maksimal 6 proyek
            ->get();
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          @forelse($latestProjects as $project)
            <article class="bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition reveal" data-reveal>
              {{-- Gambar Proyek --}}
              @if($project->cover_image)
                <img src="{{ imageUrl($project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-44 object-cover" />
              @else
                <div class="w-full h-44 bg-gradient-to-br from-emerald-100 to-blue-100 flex items-center justify-center">
                  <div class="text-emerald-600 text-2xl font-bold">P</div>
                </div>
              @endif
              <div class="p-4">
                <h4 class="font-semibold mt-2 line-clamp-2">{{ $project->title }}</h4>
                <p class="mt-2 text-sm text-slate-500 line-clamp-2">{{ $project->excerpt }}</p>
                <div class="mt-3">
                  <a href="{{ route('portfolio.show', $project->slug) }}" class="text-emerald-600 text-sm font-medium hover:text-emerald-700">
                    Lihat Detail →
                  </a>
                </div>
              </div>
            </article>
          @empty
            {{-- Fallback: Tampilkan pesan jika tidak ada proyek unggulan --}}
            <div class="col-span-full text-center py-12">
              <p class="text-slate-600">Tidak ada proyek unggulan yang tersedia saat ini.</p>
            </div>
          @endforelse
        </div>
      </div>
    </section>
    {{-- CTA Gelap: Tambahkan div call-to-action antara Portofolio dan section berikutnya
         Desain ini mengacu pada gambar lampiran: latar gelap, judul besar, teks pendukung, dan tombol aksi.
         Komentar pada elemen membantu Anda memahami struktur dan styling menggunakan Tailwind CSS. --}}
    <section aria-label="cta-project" class="py-20 bg-slate-900 text-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center">
          {{-- Judul besar: perhatikan ukuran untuk responsif --}}
          <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight">
            Punya Ide Proyek?
            <br>
            Mari Diskusikan Proyek Anda!
          </h2>

          {{-- Deskripsi singkat di bawah judul --}}
          <p class="mt-6 text-slate-300 max-w-2xl mx-auto text-sm sm:text-base">
            Kami selalu terbuka untuk membahas proyek baru dan ide kreatif. Hubungi kami untuk menjalin kolaborasi dan mewujudkan ide menjadi kenyataan.
          </p>

          {{-- Tombol aksi utama: gunakan warna aksen (mis. ungu/emerald sesuai konsep) --}}
          <div class="mt-8">
            <a href="#contact" class="inline-flex items-center gap-3 px-6 py-3 rounded-md bg-violet-600 hover:bg-violet-500 text-white font-semibold shadow-lg transition">
              {{-- Teks tombol --}}
              Mari Bekerja Bersama
              {{-- Ikon panah sederhana (SVG) --}}
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
          </div>
        </div>
      </div>
    </section>

    {{-- SEPARATOR DIBAWAH PORTFOLIO (teks bahasa Indonesia) --}}
    {{-- <section class="py-8 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-center">
          <div class="w-full border-t border-slate-200"></div>
          <div class="px-6 text-center">
            <div class="text-sm text-slate-600">Ingin melihat lebih banyak studi kasus dan portofolio kami?</div>
          </div>
          <div class="w-full border-t border-slate-200"></div>
        </div>
      </div>
    </section> --}}

    {{-- BLOG SECTION (tambahkan pada navigasi) --}}
    <section id="blog" class="py-12 bg-slate-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between mb-6">
          <h3 class="text-2xl font-extrabold">Artikel & Insight</h3>
          <a href="{{ route('blog.index') ?? '#' }}" class="text-sm text-emerald-600">Lihat Semua →</a>
        </div>

        {{-- Jika variable $posts tersedia, tampilkan, jika tidak tampilkan placeholder --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          @if(isset($posts) && count($posts) > 0)
            @foreach($posts->take(3) as $post)
              <article class="bg-white rounded-xl p-4 shadow">
                <h4 class="font-semibold">{{ $post->title }}</h4>
                <p class="mt-2 text-sm text-slate-600 line-clamp-3">{{ $post->excerpt ?? Str::limit(strip_tags($post->content ?? ''), 120) }}</p>
                <div class="mt-3"><a href="{{ route('blog.show', $post->slug) }}" class="text-emerald-600 text-sm">Baca →</a></div>
              </article>
            @endforeach
          @else
            {{-- Placeholder jika tidak ada artikel --}}
            <div class="col-span-full text-center py-12">
              <p class="text-slate-600">Belum ada artikel. Kunjungi blog untuk update konten terbaru.</p>
            </div>
          @endif
        </div>
      </div>
    </section>

    {{-- SERVICES SECTION — Menampilkan layanan utama perusahaan (pindah sesuai urutan) --}}
    <section id="services" class="py-14 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-12">
          <h3 class="text-2xl font-extrabold">Layanan Utama Kami</h3>
          <p class="text-slate-600 mt-2">Dari perizinan hingga program pemberdayaan — layanan komprehensif yang disesuaikan dengan kebutuhan proyek Anda.</p>
        </div>

        <div class="space-y-16">
          @forelse(($services ?? collect())->take(3) as $service)
            @if($service->is_published)
            <div class="reveal" data-reveal>
              <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center {{ $loop->odd ? '' : 'lg:flex-row-reverse' }}">
                <div class="service-image {{ $loop->odd ? 'lg:order-1' : 'lg:order-2' }}">
                  @if($service->image_path)
                    <img src="{{ imageUrl($service->image_path) }}" alt="{{ $service->title }}" class="w-full h-90 object-cover rounded-xl shadow-lg" />
                  @else
                    <div class="w-full h-80 bg-gradient-to-br from-emerald-100 to-blue-100 rounded-xl shadow-lg flex items-center justify-center">
                      <div class="text-emerald-600 text-5xl font-bold">📋</div>
                    </div>
                  @endif
                </div>

                <div class="service-content slide-in-text {{ $loop->odd ? 'lg:order-2' : 'lg:order-1' }}">
                  <h4 class="text-3xl font-extrabold text-gray-900">{{ $service->title }}</h4>
                  <p class="mt-4 text-slate-600 text-lg leading-relaxed">{{ $service->excerpt }}</p>
                  @if($service->features && is_array($service->features) && count($service->features) > 0)
                    <ul class="mt-6 space-y-3">
                      @foreach($service->features as $feature)
                        <li class="flex items-start gap-3">
                          <span class="text-emerald-600 font-bold mt-1">•</span>
                          <span class="text-slate-700">{{ $feature }}</span>
                        </li>
                      @endforeach
                    </ul>
                  @endif

                  <div class="mt-8">
                    <a href="{{ route('services.show', $service->slug) }}" class="inline-block px-6 py-3 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700 transition">
                      Pelajari lebih lanjut →
                    </a>
                  </div>
                </div>
              </div>
            </div>
            @endif
          @empty
            <div class="text-center py-12">
              <p class="text-slate-600 text-lg">Belum ada layanan yang dipublikasikan.</p>
            </div>
          @endforelse
        </div>

        @if(($services ?? collect())->count() > 3)
          <div class="mt-16 pt-16 border-t">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
              @forelse(($services ?? collect())->skip(3) as $service)
                @if($service->is_published)
                <article class="reveal bg-white rounded-xl p-6 shadow hover:shadow-lg transition" data-reveal>
                  <div class="flex items-start gap-4">
                    @if($service->cover_image)
                      <img src="{{ $service->image_path }}" alt="{{ $service->title }}" class="w-12 h-12 object-contain" />
                    @else
                      <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-md flex items-center justify-center font-bold">S</div>
                    @endif
                    <div>
                      <h5 class="text-lg font-semibold">{{ $service->title }}</h5>
                      <p class="text-sm text-slate-600 mt-2">{{ $service->excerpt }}</p>
                      <div class="mt-3"><a href="{{ route('services.show', $service->slug) }}" class="text-emerald-600 font-medium text-sm">Pelajari lebih lanjut →</a></div>
                    </div>
                  </div>
                </article>
                @endif
              @empty
              @endforelse
            </div>
          </div>
        @endif
      </div>
    </section>

    {{-- CONTACT SECTION: tampilkan kartu putih besar dengan dua kolom (info | form)
         Komponen form dipakai kembali tanpa mengubah field (komponen hanya menyediakan field).
         Kartu dibuat agar muncul menonjol dan sebagian tumpang tindih dengan footer gelap di bawahnya. --}}
    <section id="contact" class="relative bg-white pt-24 pb-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        {{-- Kartu putih besar; gunakan -mb untuk overlap dengan footer di bawahnya --}}
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden -mt-20 mb-8">
          <div class="grid grid-cols-1 md:grid-cols-2">
            {{-- Kolom kiri: informasi kontak dan ringkasan --}}
            <div class="p-10 bg-white">
              <h3 class="text-2xl font-extrabold">Let's discuss your Project</h3>
              <p class="mt-4 text-slate-600">Kami tersedia untuk diskusi proyek dan kerja sama. Isi form di sebelah kanan atau hubungi langsung melalui kontak di bawah.</p>

              {{-- Kontak info: alamat, email, telepon --}}
              <div class="mt-8 space-y-6">
                <div class="flex items-start gap-4">
                  <div class="w-10 h-10 rounded-md bg-emerald-50 text-emerald-600 flex items-center justify-center">📍</div>
                  <div>
                    <div class="text-sm text-slate-500">Alamat</div>
                    <div class="font-semibold">Paccinang 2 No. 36 B RT.001 Tello Baru, Panakkukang, Kota Makassar</div>
                  </div>
                </div>

                <div class="flex items-start gap-4">
                  <div class="w-10 h-10 rounded-md bg-emerald-50 text-emerald-600 flex items-center justify-center">✉️</div>
                  <div>
                    <div class="text-sm text-slate-500">Email</div>
                    <div class="font-semibold">natsirimran39@gmail.com</div>
                  </div>
                </div>

                <div class="flex items-start gap-4">
                  <div class="w-10 h-10 rounded-md bg-emerald-50 text-emerald-600 flex items-center justify-center">📞</div>
                  <div>
                    <div class="text-sm text-slate-500">Telepon</div>
                    <div class="font-semibold">+62 813-4069-9907</div>
                  </div>
                </div>
              </div>

              {{-- Social icons sederhana --}}
              <div class="mt-8 flex items-center gap-3">
                <a href="#" class="w-9 h-9 rounded-full bg-emerald-600 text-white flex items-center justify-center">f</a>
                <a href="#" class="w-9 h-9 rounded-full bg-emerald-600 text-white flex items-center justify-center">in</a>
                <a href="#" class="w-9 h-9 rounded-full bg-emerald-600 text-white flex items-center justify-center">ig</a>
              </div>
            </div>

            {{-- Kolom kanan: form kontak (komponen) --}}
            <div class="p-10 bg-white border-l">
              {{-- Kita sertakan komponen contact-form yang sekarang berisi <form> tanpa wrapper card
                  agar tetap menggunakan struktur field yang sama (tidak mengubah backend). --}}
              @include('components.contact-form')
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-slate-800 text-slate-200 py-12">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div>
            <a href="{{ route('home') }}" class="flex items-center gap-3">
              <span class="inline-flex items-center justify-center w-10 h-10 rounded-md bg-emerald-50">
                <span class="text-2xl font-extrabold" style="color:#059669;">M</span>
              </span>
              <span class="text-white font-bold">LK</span>
            </a>
            <p class="mt-4 text-sm text-slate-300">Mandiri Lestari Konsultan — Solusi restorasi, perizinan, dan pengembangan kapasitas komunitas yang berkelanjutan.</p>
          </div>

          <div>
            <h5 class="font-semibold text-white">Navigasi</h5>
            <ul class="mt-3 space-y-2 text-sm text-slate-300">
              <li><a href="{{ route('home') }}#about" class="hover:text-white">Tentang</a></li>
              <li><a href="{{ route('home') }}#projects" class="hover:text-white">Portofolio</a></li>
              <li><a href="{{ route('home') }}#services" class="hover:text-white">Layanan</a></li>
              <li><a href="{{ route('home') }}#contact" class="hover:text-white">Kontak</a></li>
            </ul>
          </div>

          <div>
            <h5 class="font-semibold text-white">Hubungi Kami</h5>
            <div class="mt-3 text-sm text-slate-300">
              <div>WA: <a href="https://wa.me/6281340699907" class="text-emerald-300">+62 813-4069-9907</a></div>
              <div class="mt-1">Email: <a href="natsirimran@gmail.com" class="text-emerald-300">natsirimran@gmail.com</a></div>
            </div>
            <div class="mt-4 flex gap-3">
              <a href="#" class="w-8 h-8 bg-emerald-600 rounded flex items-center justify-center">F</a>
              <a href="#" class="w-8 h-8 bg-emerald-600 rounded flex items-center justify-center">T</a>
            </div>
          </div>
        </div>

        <div class="mt-8 border-t border-slate-700 pt-6 text-sm text-slate-400 text-center">© {{ date('Y') }} Mandiri Lestari Konsultan. Semua hak dilindungi.</div>
      </div>
    </footer>

    {{-- Scroll to top button --}}
    <button id="scrollTopBtn" aria-label="Scroll to top" class="fixed bottom-6 right-6 z-50 opacity-0 pointer-events-none w-12 h-12 rounded-full shadow-lg bg-emerald-600 text-white flex items-center justify-center hover:bg-emerald-700">↑</button>

    {{-- SCRIPTS (hero slider, reveal, testi, logos) --}}
    @push('scripts')
    <script>
      // HERO SLIDER - Simple and Direct
      let sliderState = {
        slides: [],
        dots: [],
        active: 0,
        autoplayInterval: null,
        AUTOPLAY_MS: 6000
      };

      function initSlider() {
        sliderState.slides = Array.from(document.querySelectorAll(".slide"));
        if (sliderState.slides.length === 0) return;

        const dotsContainer = document.getElementById("dots");
        if (!dotsContainer) return;

        // Create dots
        sliderState.slides.forEach((_, idx) => {
          const dot = document.createElement("button");
          dot.type = "button";
          dot.className = idx === 0 ? "w-3 h-3 rounded-full bg-white" : "w-3 h-3 rounded-full bg-white/30";
          dot.setAttribute("aria-label", "Slide " + (idx + 1));
          dot.addEventListener("click", () => {
            pauseAutoplay();
            showSlide(idx);
            startAutoplay();
          });
          dotsContainer.appendChild(dot);
          sliderState.dots.push(dot);
        });

        // Button handlers
        const nextBtn = document.getElementById("next");
        const prevBtn = document.getElementById("prev");
        
        if (nextBtn) {
          nextBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            pauseAutoplay();
            showSlide(sliderState.active + 1);
            startAutoplay();
          });
        }
        
        if (prevBtn) {
          prevBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            pauseAutoplay();
            showSlide(sliderState.active - 1);
            startAutoplay();
          });
        }

        // Slider hover
        const sliderElement = document.getElementById("slider");
        if (sliderElement) {
          sliderElement.addEventListener("mouseenter", pauseAutoplay);
          sliderElement.addEventListener("mouseleave", startAutoplay);
        }

        // Keyboard navigation
        document.addEventListener("keydown", (e) => {
          if (e.key === "ArrowRight") {
            pauseAutoplay();
            showSlide(sliderState.active + 1);
            startAutoplay();
          } else if (e.key === "ArrowLeft") {
            pauseAutoplay();
            showSlide(sliderState.active - 1);
            startAutoplay();
          }
        });

        // Initialize
        showSlide(0);
        startAutoplay();
      }

      function showSlide(idx) {
        if (sliderState.slides.length === 0) return;
        
        const nextIdx = ((idx % sliderState.slides.length) + sliderState.slides.length) % sliderState.slides.length;
        
        // Update slides
        sliderState.slides.forEach((slide, i) => {
          if (i === nextIdx) {
            slide.classList.remove("opacity-0");
            slide.classList.add("opacity-100");
          } else {
            slide.classList.remove("opacity-100");
            slide.classList.add("opacity-0");
          }
        });

        // Update dots
        sliderState.dots.forEach((dot, i) => {
          if (i === nextIdx) {
            dot.classList.remove("bg-white/30");
            dot.classList.add("bg-white");
          } else {
            dot.classList.remove("bg-white");
            dot.classList.add("bg-white/30");
          }
        });

        sliderState.active = nextIdx;
      }

      function startAutoplay() {
        if (sliderState.slides.length > 1) {
          sliderState.autoplayInterval = setInterval(() => {
            showSlide(sliderState.active + 1);
          }, sliderState.AUTOPLAY_MS);
        }
      }

      function pauseAutoplay() {
        if (sliderState.autoplayInterval) {
          clearInterval(sliderState.autoplayInterval);
          sliderState.autoplayInterval = null;
        }
      }

      // Initialize when DOM is ready
      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSlider);
      } else {
        initSlider();
      }

      // REVEAL ON SCROLL
      const reveals = document.querySelectorAll("[data-reveal]");
      const io = new IntersectionObserver((entries) => {
        entries.forEach((e) => {
          if (e.isIntersecting) { 
            e.target.classList.add("show"); 
            io.unobserve(e.target); 
          }
        });
      }, { threshold: 0.12 });
      reveals.forEach((r) => { 
        r.classList.add("reveal"); 
        io.observe(r); 
      });

      // TESTIMONIALS
      const testimonials = [
        { name: "Maria Sharapova", title: "Managing Director, Themewagon Inc.", photo: "https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=400&auto=format&fit=crop", text: "Tim Mandiri Lestari sangat profesional. Studi dampak dan pelaksanaan di lapangan berjalan rapi dan transparan." },
        { name: "Budi Santoso", title: "Direktur PT. Mitra Hijau", photo: "https://images.unsplash.com/photo-1545996124-2d19f8f2b6a8?q=80&w=400&auto=format&fit=crop", text: "Pendekatannya partisipatif — komunitas lokal benar-benar dilibatkan. Hasilnya terukur." },
        { name: "Siti Maryam", title: "Kepala Desa Seruni", photo: "https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?q=80&w=400&auto=format&fit=crop", text: "Tim ramah dan cepat menanggapi kebutuhan kami. Programnya bermanfaat untuk mata pencaharian." },
      ];
      const testiList = document.getElementById("testiList");
      let testiIndex = 0;
      
      function renderTestimonials() {
        if (!testiList) return;
        testiList.innerHTML = "";
        testimonials.forEach((t) => {
          const card = document.createElement("div");
          card.className = "min-w-full md:min-w-1/3 p-4";
          card.innerHTML = `
            <div class="bg-white rounded-xl p-6 shadow">
              <div class="flex gap-4 items-center">
                <img src="${t.photo}" alt="${t.name}" class="w-14 h-14 rounded-full object-cover">
                <div>
                  <div class="font-semibold">${t.name}</div>
                  <div class="text-xs text-slate-500">${t.title}</div>
                </div>
              </div>
              <p class="mt-4 text-slate-600">${t.text}</p>
            </div>
          `;
          testiList.appendChild(card);
        });
        updateTestiPosition();
      }
      
      function updateTestiPosition() {
        if (!testiList || testiList.children.length === 0) return;
        const width = testiList.children[0].getBoundingClientRect().width;
        testiList.style.transform = `translateX(${-testiIndex * width}px)`;
      }
      
      const testiNext = document.getElementById("testiNext");
      const testiPrev = document.getElementById("testiPrev");
      if (testiNext) testiNext.addEventListener("click", () => { 
        testiIndex = Math.min(testimonials.length - 1, testiIndex + 1); 
        updateTestiPosition(); 
      });
      if (testiPrev) testiPrev.addEventListener("click", () => { 
        testiIndex = Math.max(0, testiIndex - 1); 
        updateTestiPosition(); 
      });
      
      setInterval(() => { 
        testiIndex = (testiIndex + 1) % testimonials.length; 
        updateTestiPosition(); 
      }, 5000);
      
      window.addEventListener("resize", updateTestiPosition);
      renderTestimonials();

      // LOGOS marquee
      const logos = [
        "https://dummyimage.com/160x60/eee/aaa.png&text=Partner+1",
        "https://dummyimage.com/160x60/eee/aaa.png&text=Partner+2",
        "https://dummyimage.com/160x60/eee/aaa.png&text=Partner+3",
        "https://dummyimage.com/160x60/eee/aaa.png&text=Partner+4",
        "https://dummyimage.com/160x60/eee/aaa.png&text=Partner+5",
        "https://dummyimage.com/160x60/eee/aaa.png&text=Partner+6",
      ];
      const logoTrack = document.getElementById("logoTrack");
      if (logoTrack) {
        logos.forEach((src) => {
          const el = document.createElement("div"); 
          el.className = "opacity-80"; 
          el.innerHTML = `<img src="${src}" alt="client logo" class="h-12 object-contain">`; 
          logoTrack.appendChild(el);
        });
        logos.forEach((src) => {
          const el = document.createElement("div"); 
          el.className = "opacity-80"; 
          el.innerHTML = `<img src="${src}" alt="client logo" class="h-12 object-contain">`; 
          logoTrack.appendChild(el);
        });
        let logoOffset = 0;
        function tickLogos() { 
          logoOffset -= 0.2; 
          logoTrack.style.transform = `translateX(${logoOffset}px)`; 
          if (Math.abs(logoOffset) > logoTrack.scrollWidth / 2) logoOffset = 0; 
          requestAnimationFrame(tickLogos); 
        }
        tickLogos();
      }
      // SCROLLSPY - highlight nav items berdasarkan section yang aktif
      (function(){
        const sectionIds = ['hero','about','process','projects','blog','services','contact'];
        
        // Dapatkan semua anchor di desktop nav yang merujuk ke section di halaman
        // Selector: hanya targetkan desktop nav (.desktop-nav) agar tidak mengaktifkan duplicate mobile links
        const navLinks = Array.from(document.querySelectorAll('nav .desktop-nav a[href*="#"]'))
          .filter(a => {
            const href = a.getAttribute('href');
            // Filter hanya links yang benar-benar anchor (mengandung # dan match dengan section IDs)
            return href && sectionIds.some(id => href.includes('#' + id));
          });

        // DEBUG: log berapa nav links yang ditemukan
        console.log('[Scrollspy Init] Ditemukan ' + navLinks.length + ' nav links');
        navLinks.forEach((a, idx) => {
          console.log('[Scrollspy Init] Link ' + idx + ':', a.href, a.textContent);
        });

        // DEBUG: juga log struktur nav
        const navElement = document.querySelector('nav');
        console.log('[Scrollspy Init] Nav element found:', !!navElement);
        if (navElement) {
          const allNavAnchors = navElement.querySelectorAll('a');
          console.log('[Scrollspy Init] Total <a> tags in nav:', allNavAnchors.length);
          allNavAnchors.forEach((a, idx) => {
            console.log('[Scrollspy Init] All nav <a> ' + idx + ':', a.href, '|', a.textContent);
          });
        }

        /**
         * Fungsi setActive: menandai link mana yang aktif berdasarkan section yang sedang terlihat
         * Menambahkan class 'nav-active' pada link aktif untuk styling block emerald
         * Menghapusnya dari link lainnya untuk menampilkan styling default/hover
         */
        const setActive = (id) => {
          console.log('[Scrollspy] setActive called with id:', id);
          let foundMatch = false;
          navLinks.forEach(a => {
            const href = a.getAttribute('href');
            if (href && href.includes('#' + id)) {
              // Tambahkan class 'nav-active' untuk menandai link aktif dengan background block emerald
              a.classList.add('nav-active');
              console.log('[Scrollspy] Added nav-active to:', a.textContent, '(href:', href + ')', 'class=', a.className);
              foundMatch = true;
            } else {
              // Hapus class 'nav-active' dari link yang tidak aktif (akan menampilkan hover effect)
              if (a.classList.contains('nav-active')) {
                a.classList.remove('nav-active');
                console.log('[Scrollspy] Removed nav-active from:', a.textContent);
              }
            }
          });
          if (!foundMatch) {
            console.warn('[Scrollspy] No match found for id:', id);
          }
        };

        // Hitung tinggi navbar agar smooth scroll dan observer memperhitungkannya
        const navEl = document.querySelector('nav');
        const navHeight = navEl ? navEl.getBoundingClientRect().height : 0;
        // Simpan nilai tinggi navbar ke CSS variable agar scroll-margin-top bekerja
        document.documentElement.style.setProperty('--nav-height', navHeight + 'px');

        // IntersectionObserver yang memperhitungkan tinggi navbar dengan rootMargin
        const io2 = new IntersectionObserver((entries) => {
          entries.forEach(e => {
            if (e.isIntersecting) {
              setActive(e.target.id);
            }
          });
        }, { rootMargin: `-${navHeight}px 0px -40% 0px`, threshold: 0.15 });

        // Observe setiap section dengan ID yang ada di sectionIds
        sectionIds.forEach(id => {
          const el = document.getElementById(id);
          if (el) io2.observe(el);
        });

        // Smooth scroll for anchor links (internal) dan perhitungkan offset navbar
        document.querySelectorAll('a[href^="#"]').forEach(a => {
          a.addEventListener('click', (e) => {
            const href = a.getAttribute('href');
            // Hanya tangani anchor yang benar-benar relatif (mis. '#about')
            if (href && href.startsWith('#')) {
              const target = document.querySelector(href);
              if (target) {
                e.preventDefault();
                // Hitung posisi target dikurangi tinggi navbar agar terlihat rapih
                const targetY = target.getBoundingClientRect().top + window.pageYOffset - navHeight - 12;
                window.scrollTo({ top: targetY, behavior: 'smooth' });
                // update url tanpa reload
                history.replaceState(null, null, href);
              }
            }
          });
        });

        // Scroll to top button behavior
        const scrollBtn = document.getElementById('scrollTopBtn');
        const toggleScrollBtn = () => {
          if (!scrollBtn) return;
          if (window.scrollY > 300) {
            scrollBtn.classList.remove('opacity-0','pointer-events-none');
            scrollBtn.classList.add('opacity-100');
          } else {
            scrollBtn.classList.add('opacity-0','pointer-events-none');
            scrollBtn.classList.remove('opacity-100');
          }
        };
        window.addEventListener('scroll', toggleScrollBtn);
        scrollBtn && scrollBtn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
      })();
      </script>
    @endpush
@endsection
