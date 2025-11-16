<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\HomeContent;
use Illuminate\Http\Request;

/**
 * HomeContentController untuk Editor.
 * Mengelola home content (create, read, update, delete).
 */
class HomeContentController extends Controller
{
    public function index()
    {
        $contents = HomeContent::paginate(15);
        return view('editor.home-contents.index', compact('contents'));
    }

    public function create()
    {
        return view('editor.home-contents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'section' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image_path' => 'nullable|string',
        ]);

        HomeContent::create($validated);

        return redirect()->route('editor.home-contents.index')
            ->with('success', 'Home content berhasil dibuat.');
    }

    public function show(HomeContent $homeContent)
    {
        return view('editor.home-contents.show', compact('homeContent'));
    }

    public function edit(HomeContent $homeContent)
    {
        return view('editor.home-contents.edit', compact('homeContent'));
    }

    public function update(Request $request, HomeContent $homeContent)
    {
        $validated = $request->validate([
            'section' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image_path' => 'nullable|string',
        ]);

        $homeContent->update($validated);

        return redirect()->route('editor.home-contents.index')
            ->with('success', 'Home content berhasil diperbarui.');
    }

    public function destroy(HomeContent $homeContent)
    {
        $homeContent->delete();

        return redirect()->route('editor.home-contents.index')
            ->with('success', 'Home content berhasil dihapus.');
    }
}
