<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Tampilkan daftar layanan publik.
     */
    public function index()
    {
        // Ambil layanan yang dipublikasikan
        $services = Service::where('is_published', true)->get();
        return view('services', compact('services'));
    }

    /**
     * Tampilkan detail layanan berdasarkan slug.
     */
    public function show($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        return view('service-show', compact('service'));
    }
}
