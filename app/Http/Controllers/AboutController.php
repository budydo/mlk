<?php

namespace App\Http\Controllers;

use App\Models\HomeContent;
use App\Models\TeamMember;

class AboutController extends Controller
{
    /**
     * Tampilkan halaman tentang kami dengan data sejarah, visi/misi, dan tim.
     */
    public function index()
    {
        // Ambil konten home yang relevan jika tersedia
        $history = HomeContent::where('key','history')->first();
        $vision = HomeContent::where('key','vision')->first();
        $mission = HomeContent::where('key','mission')->first();

        // Ambil anggota tim yang aktif
        $team = TeamMember::where('is_active', true)->get();

        return view('about', compact('history','vision','mission','team'));
    }
}

