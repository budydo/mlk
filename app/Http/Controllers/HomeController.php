<?php

namespace App\Http\Controllers;

use App\Models\HomeContent;
use App\Models\Service;
use App\Models\Project;
use Illuminate\Http\Request;

/**
 * HomeController — Mengelola tampilan halaman beranda (home).
 */
class HomeController extends Controller
{
    /**
     * Tampilkan halaman beranda dengan konten hero slider, layanan, dan proyek unggulan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        /**
         * Ambil konten hero slider yang dipublikasikan, diurutkan berdasarkan order.
         */
        $heroContents = HomeContent::published()->get();

        /**
         * Ambil layanan yang dipublikasikan.
         *
         * Catatan: sebelumnya dibatasi `take(9)` sehingga layanan baru yang
         * melebihi batas tidak tampil di beranda. Untuk memastikan semua
         * layanan yang dipublikasikan muncul (dan kemudian diatur tampilan
         * di view), kita ambil seluruh record yang berstatus publikasi.
         */
        $services = Service::where('is_published', 1)
            ->orderBy('id', 'asc')
            ->get();

        /**
         * Ambil proyek unggulan yang dipublikasikan untuk bagian portfolio.
         * Maksimal 12 proyek untuk ditampilkan di beranda.
         */
        $featuredProjects = Project::featured()
            ->take(12)
            ->get();

        return view('home', compact('heroContents', 'services', 'featuredProjects'));
    }
}
