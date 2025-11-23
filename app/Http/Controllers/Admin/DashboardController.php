<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeContent;
use App\Models\Service;
use App\Models\Project;
use App\Models\Post;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard admin dengan statistik pengguna dan konten.
     */
    public function index()
    {
        $usersCount = \App\Models\User::count();
        $adminsCount = \App\Models\User::where('role', 'admin')->count();
        $editorsCount = \App\Models\User::where('role', 'editor')->count();
        $servicesCount = Service::count();
        $projectsCount = Project::count();
        // Tambahan: hitung jumlah posting blog
        $postsCount = Post::count();
        $messagesCount = ContactMessage::where('is_handled', false)->count();

        return view('admin.dashboard', compact(
            'usersCount', 'adminsCount', 'editorsCount',
            'servicesCount', 'projectsCount', 'postsCount', 'messagesCount'
        ));
    }
}
