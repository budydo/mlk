@props(['active'])

@php
    /**
     * Komponen nav-link dengan styling block aktif dan hover effect yang proper
     * Bekerja dengan JavaScript scrollspy yang menambahkan class 'nav-active'
     * 
     * Penjelasan:
     * - px-3 py-1.5: padding kecil agar efek hover dan background tidak memenuhi seluruh tinggi navbar
     * - rounded-lg: sudut melengkung untuk efek block modern
     * - transition-all duration-300: transisi smooth untuk semua property (background, shadow, color)
     * - Shadow ditambahkan untuk depth visual pada state aktif dan hover
     */
    
    // Base class: styling dasar yang berlaku untuk semua menu (padding kecil, rounded, transisi)
    $baseClasses = 'inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium leading-5 transition-all duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2';
    
    // State class: styling yang berubah sesuai :active parameter (dari PHP atau JavaScript)
    $stateClasses = ($active ?? false)
        // Styling AKTIF: background block solid emerald, text putih, shadow untuk depth
        ? 'bg-emerald-600 text-white shadow-md'
        // Styling TIDAK AKTIF: text gray, hover background emerald muda dengan shadow subtle
        : 'text-gray-700 hover:bg-emerald-100 hover:text-emerald-700 hover:shadow-sm';
    
    // Gabungkan base dan state class
    $classes = $baseClasses . ' ' . $stateClasses;
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

<style>
  /**
   * CSS rule untuk class 'nav-active' yang ditambahkan oleh JavaScript scrollspy saat user scroll
   * !important memastikan styling ini selalu diterapkan dan tidak di-override
   * shadow-md memberikan efek kedalaman visual pada menu yang aktif
   */
  a.nav-active {
    @apply bg-emerald-600 text-white shadow-md !important;
    transition: all 300ms ease-in-out;
  }
  
  /**
   * Hover effect pada menu aktif: shadow membesar untuk feedback visual
   */
  a.nav-active:hover {
    @apply shadow-lg !important;
    transform: translateY(-2px);
  }
  
  /**
   * Hover effect pada menu yang tidak aktif
   */
  a:not(.nav-active):hover {
    @apply shadow-md;
  }
</style>
