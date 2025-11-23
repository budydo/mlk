<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\HomeContent;
use App\Models\Service;
use App\Models\Project;
use App\Models\Post;
use App\Models\ContactMessage;

/**
 * DashboardController untuk Editor.
 * Menampilkan statistik konten dan akses manajemen konten.
 */
class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard editor dengan statistik konten.
     */
    public function index()
    {
        $homeContentsCount = HomeContent::count();
        $servicesCount = Service::count();
        $projectsCount = Project::count();
        // Tambahan: hitung jumlah posting blog
        $postsCount = Post::count();
        $messagesCount = ContactMessage::count();
        $unhandledMessages = ContactMessage::where('is_handled', false)->count();

        return view('editor.dashboard', compact(
            'homeContentsCount', 'servicesCount', 'projectsCount', 'postsCount',
            'messagesCount', 'unhandledMessages'
        ));
    }
}
