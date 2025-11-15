{{-- File: resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Beranda — MANDIRI LESTARI KONSULTAN')

@section('content')
    {{-- HERO SLIDER --}}
    <section class="relative">
      <div id="slider" class="relative overflow-hidden">
        <div class="relative h-[68vh] lg:h-[76vh]">
          <!-- slides -->
          <div class="slide absolute inset-0 opacity-0 transition-opacity duration-800 ease-out" data-index="0">
            <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?q=80&w=1920&auto=format&fit=crop" alt="restorasi lahan" class="w-full h-full object-cover" />
            <div class="absolute inset-0 hero-mask"></div>
            <div class="absolute inset-0 max-w-7xl mx-auto px-6 flex items-center">
              <div class="w-full lg:w-1/2 text-white py-12">
                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold slide-title">Restorasi Lahan & Pemulihan Ekosistem</h2>
                <p class="mt-4 text-lg sm:text-xl text-slate-200/90">
                  Program revegetasi, rehabilitasi, dan pemantauan agar fungsi ekologis pulih dan komunitas berdaya.
                </p>
                <div class="mt-8 flex gap-3">
                  <a href="#projects" class="px-5 py-3 rounded-md btn-primary shadow">Lihat Studi Kasus</a>
                  <a href="#consult" class="px-5 py-3 rounded-md btn-ghost">Minta Penawaran</a>
                </div>
              </div>
            </div>
          </div>

          <div class="slide absolute inset-0 opacity-0 transition-opacity duration-800 ease-out" data-index="1">
            <img src="https://images.unsplash.com/photo-1496307042754-b4aa456c4a2d?q=80&w=1920&auto=format&fit=crop" alt="amdal" class="w-full h-full object-cover" />
            <div class="absolute inset-0 hero-mask"></div>
            <div class="absolute inset-0 max-w-7xl mx-auto px-6 flex items-center">
              <div class="w-full lg:w-1/2 text-white py-12">
                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold slide-title">AMDAL & Studi Dampak Yang Kuat</h2>
                <p class="mt-4 text-lg sm:text-xl text-slate-200/90">
                  Dokumen teknis komprehensif dan rekomendasi mitigasi yang dapat dipertanggungjawabkan.
                </p>
                <div class="mt-8 flex gap-3">
                  <a href="#services" class="px-5 py-3 rounded-md btn-primary shadow">Lihat Layanan</a>
                  <a href="#contact" class="px-5 py-3 rounded-md btn-ghost">Konsultasi Via Email</a>
                </div>
              </div>
            </div>
          </div>

          <div class="slide absolute inset-0 opacity-0 transition-opacity duration-800 ease-out" data-index="2">
            <img src="https://images.unsplash.com/photo-1506784983877-45594efa4cbe?q=80&w=1920&auto=format&fit=crop" alt="pemberdayaan masyarakat" class="w-full h-full object-cover" />
            <div class="absolute inset-0 hero-mask"></div>
            <div class="absolute inset-0 max-w-7xl mx-auto px-6 flex items-center">
              <div class="w-full lg:w-1/2 text-white py-12">
                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold slide-title">Pemberdayaan Komunitas & Dampak Sosial</h2>
                <p class="mt-4 text-lg sm:text-xl text-slate-200/90">
                  Program yang memperkuat kapasitas lokal untuk hasil yang berkelanjutan.
                </p>
                <div class="mt-8 flex gap-3">
                  <a href="#projects" class="px-5 py-3 rounded-md btn-primary shadow">Study Pemberdayaan</a>
                  <a href="#insights" class="px-5 py-3 rounded-md btn-ghost">Baca Insight</a>
                </div>
              </div>
            </div>
          </div>
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
    <section id="services" class="py-14">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-10">
          <h3 class="text-2xl font-extrabold">Layanan Utama Kami</h3>
          <p class="text-slate-600 mt-2">Dari perizinan hingga program pemberdayaan — layanan komprehensif yang disesuaikan dengan kebutuhan proyek Anda.</p>
        </div>

        <div class="space-y-10">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-center reveal" data-reveal>
            <div class="rounded-lg overflow-hidden">
              <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1200&auto=format&fit=crop" alt="UKL-UPL" class="w-full h-72 object-cover" />
            </div>
            <div>
              <h4 class="text-xl font-semibold">Upaya Pengelolaan & Pemantauan Lingkungan (UKL-UPL)</h4>
              <p class="mt-3 text-slate-600">Rencana teknis pengelolaan lingkungan dan sistem pemantauan untuk memastikan operasi usaha berjalan sesuai kepatuhan lingkungan.</p>
              <ul class="mt-4 space-y-2 text-sm text-slate-600">
                <li>• Penyusunan UKL-UPL & rencana pemantauan</li>
                <li>• Pelatihan tim lapangan & SOP pemantauan</li>
                <li>• Dashboard pemantauan & laporan berkala</li>
              </ul>
              <div class="mt-4"><a href="#" class="text-emerald-600 font-medium">Pelajari lebih lanjut →</a></div>
            </div>
          </div>

          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-center reveal" data-reveal>
            <div class="order-2 lg:order-1">
              <h4 class="text-xl font-semibold">Analisis Mengenai Dampak Lingkungan (AMDAL)</h4>
              <p class="mt-3 text-slate-600">Kajian dampak komprehensif, identifikasi mitigasi, dan rekomendasi kebijakan untuk memenuhi persyaratan regulator.</p>
              <ul class="mt-4 space-y-2 text-sm text-slate-600">
                <li>• Studi baseline lingkungan & sosio-ekonomi</li>
                <li>• Analisis dampak & matriks mitigasi</li>
                <li>• Konsultasi publik & fasilitasi AMDAL</li>
              </ul>
              <div class="mt-4"><a href="#" class="text-emerald-600 font-medium">Pelajari lebih lanjut →</a></div>
            </div>
            <div class="order-1 lg:order-2 rounded-lg overflow-hidden">
              <img src="https://images.unsplash.com/photo-1509395176047-4a66953fd231?q=80&w=1200&auto=format&fit=crop" alt="AMDAL" class="w-full h-72 object-cover" />
            </div>
          </div>

          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-center reveal" data-reveal>
            <div class="rounded-lg overflow-hidden">
              <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=1200&auto=format&fit=crop" alt="Pemberdayaan" class="w-full h-72 object-cover" />
            </div>
            <div>
              <h4 class="text-xl font-semibold">Pemberdayaan Komunitas & Program Sosial</h4>
              <p class="mt-3 text-slate-600">Desain intervensi sosial yang meningkatkan kapasitas ekonomi dan sosial komunitas terdampak.</p>
              <ul class="mt-4 space-y-2 text-sm text-slate-600">
                <li>• Pelatihan keterampilan & inkubasi usaha</li>
                <li>• Evaluasi dampak sosial & indikator</li>
                <li>• Monitoring berkelanjutan & adaptasi program</li>
              </ul>
              <div class="mt-4"><a href="#" class="text-emerald-600 font-medium">Pelajari lebih lanjut →</a></div>
            </div>
          </div>
        </div>
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
          <a href="#" class="text-sm text-emerald-600">Lihat Semua →</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <article class="bg-white rounded-xl overflow-hidden shadow reveal" data-reveal>
            <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1200&auto=format&fit=crop" class="w-full h-44 object-cover" />
            <div class="p-4">
              <div class="text-xs text-slate-400">2024 • Restorasi</div>
              <h4 class="font-semibold mt-2">Restorasi Hutan Pesisir — Kabupaten X</h4>
              <p class="mt-2 text-sm text-slate-500">Revegetasi & pemberdayaan komunitas nelayan.</p>
            </div>
          </article>

          <article class="bg-white rounded-xl overflow-hidden shadow reveal" data-reveal>
            <img src="https://images.unsplash.com/photo-1509395176047-4a66953fd231?q=80&w=1200&auto=format&fit=crop" class="w-full h-44 object-cover" />
            <div class="p-4">
              <div class="text-xs text-slate-400">2023 • SIPA</div>
              <h4 class="font-semibold mt-2">Pengusahaan Air Tanah — Kota Y</h4>
              <p class="mt-2 text-sm text-slate-500">Pemantauan kualitas & rekomendasi izin.</p>
            </div>
          </article>

          <article class="bg-white rounded-xl overflow-hidden shadow reveal" data-reveal>
            <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=1200&auto=format&fit=crop" class="w-full h-44 object-cover" />
            <div class="p-4">
              <div class="text-xs text-slate-400">2022 • Pemberdayaan</div>
              <h4 class="font-semibold mt-2">Agroforestry — Desa A</h4>
              <p class="mt-2 text-sm text-slate-500">Pelatihan & market linkage untuk kelompok tani.</p>
            </div>
          </article>
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
      /* HERO SLIDER */
      const slides = Array.from(document.querySelectorAll(".slide"));
      const dotsContainer = document.getElementById("dots");
      let active = 0;
      let autoplayInterval = null;
      const AUTOPLAY_MS = 6000;

      function showSlide(i) {
        slides.forEach((s) => { s.style.opacity = "0"; s.setAttribute("aria-hidden", "true"); });
        const slide = slides[i];
        if (!slide) return;
        slide.style.opacity = "1";
        slide.setAttribute("aria-hidden", "false");
        Array.from(dotsContainer.children).forEach((d, idx) => {
          d.classList.toggle("bg-white", idx === i);
          d.classList.toggle("bg-white/30", idx !== i);
        });
        active = i;
      }

      slides.forEach((s, idx) => {
        const dot = document.createElement("button");
        dot.className = idx === 0 ? "w-3 h-3 rounded-full bg-white" : "w-3 h-3 rounded-full bg-white/30";
        dot.setAttribute("aria-label", "Slide " + (idx + 1));
        dot.addEventListener("click", () => { pauseAutoplay(); showSlide(idx); startAutoplay(); });
        dotsContainer.appendChild(dot);
      });

      function nextSlide() { showSlide((active + 1) % slides.length); }
      function prevSlide() { showSlide((active - 1 + slides.length) % slides.length); }

      document.getElementById("next").addEventListener("click", () => { pauseAutoplay(); nextSlide(); startAutoplay(); });
      document.getElementById("prev").addEventListener("click", () => { pauseAutoplay(); prevSlide(); startAutoplay(); });

      function startAutoplay() { autoplayInterval = setInterval(nextSlide, AUTOPLAY_MS); }
      function pauseAutoplay() { if (autoplayInterval) { clearInterval(autoplayInterval); autoplayInterval = null; } }

      document.getElementById("slider").addEventListener("mouseenter", pauseAutoplay);
      document.getElementById("slider").addEventListener("mouseleave", startAutoplay);
      showSlide(0);
      startAutoplay();

      /* REVEAL ON SCROLL */
      const reveals = document.querySelectorAll("[data-reveal]");
      const io = new IntersectionObserver((entries) => {
        entries.forEach((e) => {
          if (e.isIntersecting) { e.target.classList.add("show"); io.unobserve(e.target); }
        });
      }, { threshold: 0.12 });
      reveals.forEach((r) => { r.classList.add("reveal"); io.observe(r); });

      /* TESTIMONIALS */
      const testimonials = [
        { name: "Maria Sharapova", title: "Managing Director, Themewagon Inc.", photo: "https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=400&auto=format&fit=crop", text: "Tim Mandiri Lestari sangat profesional. Studi dampak dan pelaksanaan di lapangan berjalan rapi dan transparan." },
        { name: "Budi Santoso", title: "Direktur PT. Mitra Hijau", photo: "https://images.unsplash.com/photo-1545996124-2d19f8f2b6a8?q=80&w=400&auto=format&fit=crop", text: "Pendekatannya partisipatif — komunitas lokal benar-benar dilibatkan. Hasilnya terukur." },
        { name: "Siti Maryam", title: "Kepala Desa Seruni", photo: "https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?q=80&w=400&auto=format&fit=crop", text: "Tim ramah dan cepat menanggapi kebutuhan kami. Programnya bermanfaat untuk mata pencaharian." },
      ];
      const testiList = document.getElementById("testiList");
      let testiIndex = 0;
      function renderTestimonials() {
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
        const width = testiList.children[0]?.getBoundingClientRect().width || 0;
        testiList.style.transform = `translateX(${-testiIndex * width}px)`;
      }
      document.getElementById("testiNext").addEventListener("click", () => { testiIndex = Math.min(testimonials.length - 1, testiIndex + 1); updateTestiPosition(); });
      document.getElementById("testiPrev").addEventListener("click", () => { testiIndex = Math.max(0, testiIndex - 1); updateTestiPosition(); });
      setInterval(() => { testiIndex = (testiIndex + 1) % testimonials.length; updateTestiPosition(); }, 5000);
      window.addEventListener("resize", updateTestiPosition);
      renderTestimonials();

      /* LOGOS marquee */
      const logos = [
        "https://dummyimage.com/160x60/eee/aaa.png&text=Partner+1",
        "https://dummyimage.com/160x60/eee/aaa.png&text=Partner+2",
        "https://dummyimage.com/160x60/eee/aaa.png&text=Partner+3",
        "https://dummyimage.com/160x60/eee/aaa.png&text=Partner+4",
        "https://dummyimage.com/160x60/eee/aaa.png&text=Partner+5",
        "https://dummyimage.com/160x60/eee/aaa.png&text=Partner+6",
      ];
      const logoTrack = document.getElementById("logoTrack");
      logos.forEach((src) => {
        const el = document.createElement("div"); el.className = "opacity-80"; el.innerHTML = `<img src="${src}" alt="client logo" class="h-12 object-contain">`; logoTrack.appendChild(el);
      });
      logos.forEach((src) => {
        const el = document.createElement("div"); el.className = "opacity-80"; el.innerHTML = `<img src="${src}" alt="client logo" class="h-12 object-contain">`; logoTrack.appendChild(el);
      });
      let logoOffset = 0;
      function tickLogos() { logoOffset -= 0.2; logoTrack.style.transform = `translateX(${logoOffset}px)`; if (Math.abs(logoOffset) > logoTrack.scrollWidth / 2) logoOffset = 0; requestAnimationFrame(tickLogos); }
      tickLogos();

      /* keyboard a11y for hero */
      document.addEventListener("keydown", (e) => {
        if (e.key === "ArrowRight") { pauseAutoplay(); nextSlide(); startAutoplay(); }
        if (e.key === "ArrowLeft") { pauseAutoplay(); prevSlide(); startAutoplay(); }
      });
    </script>
    @endpush
@endsection
