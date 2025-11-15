{{-- File: resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Beranda — MANDIRI LESTARI KONSULTAN')

@section('content')
    {{-- HERO SLIDER — Konten dinamis dari database (home_contents) --}}
    <section class="relative">
      <div id="slider" class="relative overflow-hidden">
        <div class="relative h-[68vh] lg:h-[76vh]">
          {{-- Tampilkan slide dari database --}}
          @if($heroContents && count($heroContents) > 0)
            @foreach($heroContents as $content)
              <div class="slide absolute inset-0 {{ $loop->first ? 'opacity-100' : 'opacity-0' }} transition-opacity duration-800 ease-out" data-index="{{ $loop->index }}">
                {{-- Gambar Hero dari database atau Unsplash --}}
                @if($content->image_path)
                  <img src="{{ imageUrl($content->image_path) }}" alt="{{ $content->title }}" class="w-full h-full object-cover" />
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

    {{-- SERVICES --}}
    <section id="services" class="py-14 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-12">
          <h3 class="text-2xl font-extrabold">Layanan Utama Kami</h3>
          <p class="text-slate-600 mt-2">Dari perizinan hingga program pemberdayaan — layanan komprehensif yang disesuaikan dengan kebutuhan proyek Anda.</p>
        </div>

        {{-- Featured Services dengan layout bergantian --}}
        <div class="space-y-16">
          @foreach(($services ?? collect())->take(3) as $service)
            <div class="reveal" data-reveal>
              <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center {{ $loop->odd ? '' : 'lg:flex-row-reverse' }}">
                {{-- Gambar Layanan --}}
                <div class="service-image {{ $loop->odd ? 'lg:order-1' : 'lg:order-2' }}">
                  @if($service->image_path)
                    <img src="{{ imageUrl($service->image_path) }}" alt="{{ $service->title }}" class="w-full h-80 object-cover rounded-xl shadow-lg" />
                  @else
                    <div class="w-full h-80 bg-gradient-to-br from-emerald-100 to-blue-100 rounded-xl shadow-lg flex items-center justify-center">
                      <div class="text-emerald-600 text-5xl font-bold">📋</div>
                    </div>
                  @endif
                </div>

                {{-- Konten Layanan --}}
                <div class="service-content slide-in-text {{ $loop->odd ? 'lg:order-2' : 'lg:order-1' }}">
                  <h4 class="text-3xl font-extrabold text-gray-900">{{ $service->title }}</h4>
                  <p class="mt-4 text-slate-600 text-lg leading-relaxed">{{ $service->description ?? $service->excerpt }}</p>
                  
                  @if($service->features)
                    <ul class="mt-6 space-y-3">
                      @foreach(json_decode($service->features, true) ?? [] as $feature)
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
          @endforeach
        </div>

        {{-- Grid layanan tambahan (jika ada lebih dari 3) --}}
        @if(($services ?? collect())->count() > 3)
          <div class="mt-16 pt-16 border-t">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
              @foreach(($services ?? collect())->skip(3)->take(6) as $service)
                <article class="reveal bg-white rounded-xl p-6 shadow hover:shadow-lg transition" data-reveal>
                  <div class="flex items-start gap-4">
                    @if($service->icon)
                      <img src="{{ $service->icon }}" alt="{{ $service->title }}" class="w-12 h-12 object-contain" />
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
              @endforeach
            </div>
          </div>
        @endif
      </div>
    </section>

    {{-- WHY --}}
    <section id="why" class="py-14 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">
          <div class="lg:col-span-2 reveal" data-reveal>
            <img src="https://images.unsplash.com/photo-1517685352821-92cf88aee5a5?q=80&w=1200&auto=format&fit=crop" alt="why choose" class="w-full rounded-xl shadow-lg object-cover h-96" />
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
    <section class="py-12 bg-[url('https://images.unsplash.com/photo-1499346030926-9a72daac6c63?q=80&w=1600&auto=format&fit=crop')] bg-center bg-cover">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="bg-black/45 p-10 rounded-xl text-white">
          <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
              <h4 class="text-2xl font-extrabold">Take the right step, do the big things.</h4>
              <p class="mt-2 text-slate-200/80">Kami mendukung proyek dengan data, metode dan mitra di lapangan.</p>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 text-center">
              <div>
                <div class="text-2xl font-bold">52</div>
                <div class="text-sm text-slate-200">Cases Solved</div>
              </div>
              <div>
                <div class="text-2xl font-bold">164</div>
                <div class="text-sm text-slate-200">Trained Experts</div>
              </div>
              <div>
                <div class="text-2xl font-bold">38</div>
                <div class="text-sm text-slate-200">Branches</div>
              </div>
              <div>
                <div class="text-2xl font-bold">100</div>
                <div class="text-sm text-slate-200">Satisfied Clients</div>
              </div>
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
    <section class="py-8">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-6">
          <h4 class="text-lg font-semibold">Perusahaan yang pernah bekerja sama</h4>
        </div>

        <div class="overflow-hidden">
          <div id="logoTrack" class="logo-track flex gap-10 items-center"></div>
        </div>
      </div>
    </section>

    {{-- PORTFOLIO --}}
    <section id="projects" class="py-12 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between mb-6">
          <h3 class="text-2xl font-extrabold">Portofolio Terpilih</h3>
          <a href="{{ route('portfolio.index') }}" class="text-sm text-emerald-600">Lihat Semua →</a>
        </div>

        {{-- Grid portofolio — menampilkan 6 proyek terbaru berdasarkan created_at (terbaru ke terlama) --}}
        @php
          use App\Models\Project;
          $latestProjects = Project::query()
            ->where('is_published', 1)
            ->orderBy('created_at', 'desc')
            ->take(6)
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

    {{-- CONTACT CTA (tetap ada) --}}
    <section id="contact" class="py-12">
      <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="card-glass p-8">
          <div class="flex flex-col md:flex-row items-center gap-6">
            <div class="flex-1">
              <h4 class="text-xl font-extrabold">Mulai konsultasi proyek Anda</h4>
              <p class="mt-2 text-slate-600">Isi form singkat atau hubungi langsung via WhatsApp. Semua notifikasi diarahkan ke WA +62 813-4069-9907 dan email kami.</p>
            </div>
            <div class="flex gap-3">
              <a href="#consult" class="px-5 py-3 rounded-md btn-primary">Minta Penawaran</a>
              <a href="https://wa.me/6281340699907" target="_blank" class="px-5 py-3 rounded-md border border-slate-200">Chat WA</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- Livewire consult component (modal & toast handling ada di component) --}}
    @if (class_exists(\Livewire\Livewire::class))
        @livewire('consult-request')
    @else
        {{-- Fallback: include a simple link/modal prompt if Livewire tidak terpasang --}}
        <div class="max-w-4xl mx-auto px-4 sm:px-6 py-6 text-center text-sm text-slate-600">
            <em>Livewire belum terdeteksi — untuk interaksi form yang dinamis, pasang Livewire (lihat dokumentasi).</em>
        </div>
    @endif

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
    </script>
    @endpush
@endsection
