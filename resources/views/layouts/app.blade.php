{{-- File: resources/views/layouts/app.blade.php --}}
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>@yield('title', 'MANDIRI LESTARI KONSULTAN') — Portfolio & Services</title>
    <meta name="description" content="@yield('meta_description', 'MANDIRI LESTARI KONSULTAN — AMDAL, UKL-UPL, ANDALALIN, SLF, PBG, SIPA, PIEL Banjir. Solusi ilmiah dan pemberdayaan masyarakat.')" />

    {{-- NOTE:
        Untuk fase development cepat kita pakai Tailwind CDN. 
        Untuk produksi/distribusi, sebaiknya gunakan Tailwind via npm + build (Vite/Mix).
    --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Livewire styles (jika kamu pasang Livewire) --}}
    @if (class_exists(\Livewire\Livewire::class))
        @livewireStyles
    @endif

    {{-- Styles khusus proyek (variabel warna, helper classes). --}}
    <style>
        :root {
            --accent-dark: #063b35;
            --accent: #0ea5a3;
        }
        .brand {
            background: linear-gradient(90deg, var(--accent-dark), var(--accent));
            color: #fff;
        }
        .hero-mask {
            background: linear-gradient(
                90deg,
                rgba(3, 7, 18, 0.55) 0%,
                rgba(3, 7, 18, 0.1) 50%,
                rgba(3, 7, 18, 0.55) 100%
            );
        }
        .slide-title {
            text-shadow: 0 8px 28px rgba(2, 6, 23, 0.35);
        }
        .control {
            background: rgba(255, 255, 255, 0.08);
            width: 44px;
            height: 44px;
            display: grid;
            place-items: center;
            border-radius: 999px;
        }
        .card-glass {
            background: linear-gradient(
                180deg,
                rgba(255, 255, 255, 0.88),
                rgba(250, 250, 250, 0.86)
            );
            border: 1px solid rgba(10, 10, 10, 0.04);
            box-shadow: 0 10px 30px rgba(10, 10, 10, 0.06);
            border-radius: 12px;
        }
        .reveal {
            opacity: 0;
            transform: translateY(18px) scale(0.995);
            transition: all 700ms cubic-bezier(0.2, 0.9, 0.25, 1);
        }
        .reveal.show {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        .fade-in { opacity: 0; transition: opacity 700ms ease; }
        .fade-in.show { opacity: 1; }

        /* helper */
        .btn-primary {
            background: var(--accent-dark);
            color: white;
        }
        .btn-ghost {
            border: 1px solid rgba(0,0,0,0.06);
            background: transparent;
        }

        /* small responsive tweak for testimonial cards width used in home */
        @media (min-width: 768px) {
            .md\:min-w-1\/3 { min-width: calc(100% / 3); }
        }
    </style>

    @stack('head')
</head>
<body class="antialiased text-slate-800 bg-slate-50">

    {{-- TOPBAR --}}
    <div class="bg-slate-900 text-slate-200 text-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 flex items-center justify-between h-9">
        <div class="flex items-center gap-4">
          <span class="flex items-center gap-2">
            {{-- ikon simple --}}
            <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/>
            </svg>
            MANDIRI LESTARI KONSULTAN
          </span>
        </div>
        <div class="flex items-center gap-6">
          <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2M7 21v-4a4 4 0 014-4h1"/>
            </svg>
            +62 813-4069-9907
          </div>
          <div class="hidden sm:flex items-center gap-2 text-slate-300">
            <svg class="w-4 h-4 text-amber-400" viewBox="0 0 20 20" fill="currentColor">
              <path d="M2 5a2 2 0 012-2h8a2 2 0 012 2v3H2V5zM2 9h14v6a2 2 0 01-2 2H4a2 2 0 01-2-2V9z"/>
            </svg>
            Mon–Sat 08:00–18:00
          </div>
        </div>
      </div>
    </div>

    {{-- NAVBAR --}}
    <header class="bg-white sticky top-0 z-40 shadow-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between h-16">
          <a href="{{ url('/') }}" class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-md brand flex items-center justify-center font-bold text-lg shadow-sm">
              {{-- Ganti ML dengan logo jika sudah ada --}}
              ML
            </div>
            <div>
              <div class="text-lg font-semibold">MANDIRI LESTARI KONSULTAN</div>
              <div class="text-xs text-slate-500 -mt-1">Konsultan Lingkungan & Pemberdayaan</div>
            </div>
          </a>

          <nav class="hidden lg:flex items-center gap-8 text-sm">
            <a href="{{ url('/') }}" class="nav-link text-slate-700 hover:underline">Home</a>
            <a href="#services" class="nav-link text-slate-700">Layanan</a>
            <a href="#projects" class="nav-link text-slate-700">Portofolio</a>
            <a href="#why" class="nav-link text-slate-700">Kenapa Kami</a>
            <a href="#contact" class="nav-link text-slate-700">Kontak</a>
          </nav>

          <div class="flex items-center gap-3">
            <a href="#consult" class="hidden md:inline-flex items-center gap-2 px-4 py-2 rounded-md btn-primary shadow">Minta Konsultasi</a>
            <a href="https://wa.me/6281340699907" target="_blank" class="ml-2 inline-flex items-center gap-2 px-4 py-2 rounded-md border border-slate-200 hover:bg-slate-50 text-sm">
              <svg class="w-4 h-4 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              Hubungi WA
            </a>
          </div>
        </div>
      </div>
    </header>

    {{-- MAIN CONTENT SLOT --}}
    <main>
        @yield('content')
    </main>

    {{-- Floating WhatsApp CTA --}}
    <a href="https://wa.me/6281340699907" target="_blank" rel="noopener" class="fixed right-5 bottom-5 z-50 bg-emerald-500 hover:bg-emerald-600 text-white p-4 rounded-full shadow-lg flex items-center gap-2">
      <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <path d="M16.5 7.5A4.5 4.5 0 1 0 8 16.5L7 18l1.5-.5A8 8 0 1 1 21 7a.5.5 0 0 0-.5-.5h-4z" stroke-width="1.2"/>
      </svg>
      <span class="hidden sm:inline">Chat via WhatsApp</span>
    </a>

    {{-- Livewire scripts --}}
    @if (class_exists(\Livewire\Livewire::class))
        @livewireScripts
    @endif

    {{-- Tempat untuk script tambahan per-page --}}
    @stack('scripts')

</body>
</html>
