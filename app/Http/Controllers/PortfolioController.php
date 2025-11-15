<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

/**
 * PortfolioController — Kelola halaman portofolio yang menampilkan proyek-proyek perusahaan.
 */
class PortfolioController extends Controller
{
    /**
     * Tampilkan halaman portofolio dengan daftar proyek.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil proyek yang dipublikasikan, diurutkan berdasarkan pembaruan terbaru terlebih dahulu
        $projects = Project::where('is_published', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('portfolio', compact('projects'));
    }

    /**
     * Tampilkan detail proyek berdasarkan slug.
     *
     * @param string $slug — slug proyek
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $project = Project::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Ambil proyek lainnya untuk "lihat juga" atau navigasi
        $relatedProjects = Project::where('is_published', true)
            ->where('id', '!=', $project->id)
            ->take(3)
            ->get();

        return view('project-show', compact('project', 'relatedProjects'));
    }
}
