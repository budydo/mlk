<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

/**
 * Controller server-side untuk mengelola Post di area Editor.
 * Implementasi mengikuti Admin PostController untuk konsistensi.
 */
class PostController extends Controller
{
    public function index()
    {
        $q = request()->input('q', '');
        $onlyPublished = request()->has('onlyPublished') && request()->input('onlyPublished') == '1';

        $query = Post::query()
            ->when($q, function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                      ->orWhere('slug', 'like', "%{$q}%");
            })
            ->when($onlyPublished, function ($query) {
                $query->where('is_published', 1);
            })
            ->orderBy('created_at', 'desc');

        $posts = $query->paginate(10)->withQueryString();

        return view('editor.posts.index', compact('posts', 'q', 'onlyPublished'));
    }

    public function create()
    {
        return view('editor.posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:191|unique:posts,slug',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'image_url' => 'nullable|string|max:1000',
            'is_published' => 'sometimes|boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $dest = public_path('images/posts');
            if (!file_exists($dest)) mkdir($dest, 0755, true);
            $file->move($dest, $filename);
            $data['cover_image'] = 'images/posts/' . $filename;
        } elseif (!empty($data['image_url'])) {
            $data['cover_image'] = $data['image_url'];
        }

        $data['is_published'] = isset($data['is_published']) ? (bool) $data['is_published'] : false;
        $data['published_at'] = $data['is_published'] ? now() : null;

        Post::create([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'excerpt' => $data['excerpt'] ?? null,
            'content' => $data['content'] ?? null,
            'cover_image' => $data['cover_image'] ?? null,
            'is_published' => $data['is_published'],
            'published_at' => $data['published_at'],
        ]);

        return redirect()->route('editor.posts.index')->with('success', 'Posting berhasil ditambahkan.');
    }

    public function edit(Post $post)
    {
        return view('editor.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:191|unique:posts,slug,' . $post->id,
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'image_url' => 'nullable|string|max:1000',
            'is_published' => 'sometimes|boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            if (!empty($post->cover_image) && strpos($post->cover_image, 'images/') === 0) {
                $old = public_path($post->cover_image);
                if (file_exists($old)) @unlink($old);
            }
            $file = $request->file('cover_image');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $dest = public_path('images/posts');
            if (!file_exists($dest)) mkdir($dest, 0755, true);
            $file->move($dest, $filename);
            $data['cover_image'] = 'images/posts/' . $filename;
        } elseif (!empty($data['image_url'])) {
            $data['cover_image'] = $data['image_url'];
        }

        $data['is_published'] = isset($data['is_published']) ? (bool) $data['is_published'] : false;
        $data['published_at'] = $data['is_published'] ? now() : null;

        $post->update([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'excerpt' => $data['excerpt'] ?? null,
            'content' => $data['content'] ?? null,
            'cover_image' => $data['cover_image'] ?? $post->cover_image,
            'is_published' => $data['is_published'],
            'published_at' => $data['published_at'],
        ]);

        return redirect()->route('editor.posts.index')->with('success', 'Posting berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        if (!empty($post->cover_image) && strpos($post->cover_image, 'images/') === 0) {
            $path = public_path($post->cover_image);
            if (file_exists($path)) @unlink($path);
        }

        $post->delete();

        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('editor.posts.index')->with('success', 'Posting berhasil dihapus.');
    }
}
