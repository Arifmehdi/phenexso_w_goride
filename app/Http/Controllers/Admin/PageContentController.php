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
        menuSubmenu('pagecontents', 'pageContentsAll');
        $pageContents = PageContent::latest()->paginate(20);
        return view('admin.page_contents.index', compact('pageContents'));
    }

    public function create()
    {
        menuSubmenu('pagecontents', 'createPageContent');
        return view('admin.page_contents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'page_slug' => 'required|unique:page_contents',
            'title' => 'nullable|string|max:255',
            'title_bn' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'subtitle_bn' => 'nullable|string',
            'description' => 'nullable|string',
            'description_bn' => 'nullable|string',
            'content' => 'nullable|string',
            'content_bn' => 'nullable|string',
        ]);

        $highlights = $request->highlights;
        if (is_string($highlights)) {
            $highlights = json_decode($highlights, true);
        }

        $highlights_bn = $request->highlights_bn;
        if (is_string($highlights_bn)) {
            $highlights_bn = json_decode($highlights_bn, true);
        }

        $meta = $request->meta;
        if (is_string($meta)) {
            $meta = json_decode($meta, true);
        }

        $meta_bn = $request->meta_bn;
        if (is_string($meta_bn)) {
            $meta_bn = json_decode($meta_bn, true);
        }

        PageContent::create([
            'page_slug' => $request->page_slug,
            'title' => $request->title,
            'title_bn' => $request->title_bn,
            'subtitle' => $request->subtitle,
            'subtitle_bn' => $request->subtitle_bn,
            'description' => $request->description,
            'description_bn' => $request->description_bn,
            'content' => $request->content,
            'content_bn' => $request->content_bn,
            'highlights' => $highlights,
            'highlights_bn' => $highlights_bn,
            'meta' => $meta,
            'meta_bn' => $meta_bn,
            'addedby_id' => Auth::id(),
        ]);

        return redirect()->route('admin.page_contents.index')->with('success', 'Page content created successfully.');
    }

    public function show($id)
    {
        menuSubmenu('pagecontents', 'pageContentsAll');
        $pageContent = PageContent::findOrFail($id);
        return view('admin.page_contents.show', compact('pageContent'));
    }

    public function edit($id)
    {
        menuSubmenu('pagecontents', 'pageContentsAll');
        $pageContent = PageContent::findOrFail($id);
        return view('admin.page_contents.edit', compact('pageContent'));
    }

    public function update(Request $request, $id)
    {
        $pageContent = PageContent::findOrFail($id);

        $request->validate([
            'page_slug' => 'required|unique:page_contents,page_slug,' . $id,
            'title' => 'nullable|string|max:255',
            'title_bn' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'subtitle_bn' => 'nullable|string',
            'description' => 'nullable|string',
            'description_bn' => 'nullable|string',
            'content' => 'nullable|string',
            'content_bn' => 'nullable|string',
        ]);

        $highlights = $request->highlights;
        if (is_string($highlights)) {
            $highlights = json_decode($highlights, true);
        }

        $highlights_bn = $request->highlights_bn;
        if (is_string($highlights_bn)) {
            $highlights_bn = json_decode($highlights_bn, true);
        }

        $meta = $request->meta;
        if (is_string($meta)) {
            $meta = json_decode($meta, true);
        }

        $meta_bn = $request->meta_bn;
        if (is_string($meta_bn)) {
            $meta_bn = json_decode($meta_bn, true);
        }

        $pageContent->update([
            'page_slug' => $request->page_slug,
            'title' => $request->title,
            'title_bn' => $request->title_bn,
            'subtitle' => $request->subtitle,
            'subtitle_bn' => $request->subtitle_bn,
            'description' => $request->description,
            'description_bn' => $request->description_bn,
            'content' => $request->content,
            'content_bn' => $request->content_bn,
            'highlights' => $highlights,
            'highlights_bn' => $highlights_bn,
            'meta' => $meta,
            'meta_bn' => $meta_bn,
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
