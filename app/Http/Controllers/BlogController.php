<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

/**
 * BlogController — menampilkan daftar artikel dan detail.
 */
class BlogController extends Controller
{
    /**
     * Tampilkan daftar artikel (index).
     */
    public function index()
    {
        $posts = Post::published()->orderBy('published_at','desc')->paginate(10);
        return view('blog.index', compact('posts'));
    }

    /**
     * Tampilkan detail artikel berdasarkan slug.
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('blog.show', compact('post'));
    }
}
