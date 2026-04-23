<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageContentController extends Controller
{
    public function index()
    {
        menuSubmenu('page_contents', 'all_page_contents');
        $pageContents = PageContent::latest()->paginate(20);
        return view('admin.page_contents.index', compact('pageContents'));
    }

    public function create()
    {
        menuSubmenu('page_contents', 'create_page_content');
        return view('admin.page_contents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'page_slug' => 'required|unique:page_contents',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'highlights' => 'nullable|array',
            'meta' => 'nullable|array',
        ]);

        PageContent::create([
            'page_slug' => $request->page_slug,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'content' => $request->content,
            'highlights' => $request->highlights,
            'meta' => $request->meta,
            'addedby_id' => Auth::id(),
        ]);

        return redirect()->route('admin.page_contents.index')->with('success', 'Page content created successfully.');
    }

    public function edit($id)
    {
        menuSubmenu('page_contents', 'edit_page_content');
        $pageContent = PageContent::findOrFail($id);
        return view('admin.page_contents.edit', compact('pageContent'));
    }

    public function update(Request $request, $id)
    {
        $pageContent = PageContent::findOrFail($id);

        $request->validate([
            'page_slug' => 'required|unique:page_contents,page_slug,' . $id,
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'highlights' => 'nullable|array',
            'meta' => 'nullable|array',
        ]);

        $pageContent->update([
            'page_slug' => $request->page_slug,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'content' => $request->content,
            'highlights' => $request->highlights,
            'meta' => $request->meta,
            'editedby_id' => Auth::id(),
        ]);

        return redirect()->route('admin.page_contents.index')->with('success', 'Page content updated successfully.');
    }

    public function destroy($id)
    {
        $pageContent = PageContent::findOrFail($id);
        $pageContent->delete();

        return redirect()->route('admin.page_contents.index')->with('success', 'Page content deleted successfully.');
    }
}
