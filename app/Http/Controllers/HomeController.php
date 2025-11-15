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
         * Ambil layanan yang dipublikasikan, maksimal 9 untuk ditampilkan di bagian layanan utama.
         */
        $services = Service::where('is_published', 1)
            ->orderBy('id', 'asc')
            ->take(9)
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
