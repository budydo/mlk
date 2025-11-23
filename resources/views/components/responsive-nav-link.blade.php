@props(['active'])

@php
    /**
     * Komponen responsive-nav-link untuk mobile menu
     * Styling block aktif dengan warna tema emerald (hijau), konsisten dengan nav-link desktop
     * - Saat aktif: background emerald muda, text emerald gelap, left border emerald
     * - Saat tidak aktif: background transparans, hover background gray yang subtle
     */
    $classes = ($active ?? false)
        // Styling saat AKTIF: left border emerald, background emerald muda, text emerald
        ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-emerald-600 text-start text-base font-medium text-emerald-700 bg-emerald-50 focus:outline-none focus:text-emerald-800 focus:bg-emerald-100 focus:border-emerald-700 transition duration-300 ease-in-out'
        // Styling saat TIDAK AKTIF: text gray, hover background gray, transisi smooth
        : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-emerald-700 hover:bg-emerald-50 hover:border-emerald-300 focus:outline-none focus:text-emerald-800 focus:bg-emerald-50 focus:border-emerald-300 transition duration-300 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
