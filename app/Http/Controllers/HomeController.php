<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman beranda.
     *
     * Saat ini halaman statis (Blade) — nanti kita bisa menggantinya dengan
     * data dari DB (portfolios, articles, testimonials) yang diambil di sini
     * dan dikirim ke view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // TODO: di iterasi berikutnya kita ambil data portofolio, artikel, logo klien, dsb.
        // Contoh: $portfolios = Portfolio::published()->take(6)->get();
        return view('home');
    }
}
