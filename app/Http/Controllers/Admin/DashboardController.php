<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeContent;
use App\Models\Service;
use App\Models\Project;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Middleware closure untuk membatasi akses hanya untuk admin/editor
        $this->middleware(function ($request, $next) {
            $user = $request->user();
            if (! $user || ! in_array($user->role, ['admin','editor'])) {
                abort(403, 'Akses terlarang.');
            }
            return $next($request);
        });
    }

    /**
     * Tampilkan dashboard admin sederhana.
     */
    public function index()
    {
        // Ambil ringkasan singkat
        $servicesCount = Service::count();
        $projectsCount = Project::count();
        $messagesCount = ContactMessage::where('is_handled', false)->count();

        return view('admin.dashboard', compact('servicesCount','projectsCount','messagesCount'));
    }
}
