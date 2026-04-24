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
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $highlights = $request->highlights;
        if (is_string($highlights)) {
            $highlights = json_decode($highlights, true);
        }

        $meta = $request->meta;
        if (is_string($meta)) {
            $meta = json_decode($meta, true);
        } else {
            $meta = $meta ?: [];
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $request->page_slug . '.' . $file->getClientOriginalExtension();
            $file->storeAs('page_contents', $imageName, 'public');
            $meta['image'] = $imageName;
        }

        PageContent::create([
            'page_slug' => $request->page_slug,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'content' => $request->content,
            'highlights' => $highlights,
            'meta' => $meta,
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
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $highlights = $request->highlights;
        if (is_string($highlights)) {
            $highlights = json_decode($highlights, true);
        }

        $meta = $request->meta;
        if (is_string($meta)) {
            $meta = json_decode($meta, true);
        } else {
            $meta = $meta ?: [];
        }

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if (isset($meta['image']) && $meta['image']) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete('page_contents/' . $meta['image']);
            }
            $file = $request->file('image');
            $imageName = time() . '_' . $request->page_slug . '.' . $file->getClientOriginalExtension();
            $file->storeAs('page_contents', $imageName, 'public');
            $meta['image'] = $imageName;
        }

        // Handle Home page app mockup image
        if ($request->page_slug == 'home') {
            if ($request->hasFile('app_mockup_image')) {
                if (isset($meta['app_mockup_image']) && $meta['app_mockup_image']) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete('page_contents/' . $meta['app_mockup_image']);
                }
                $file = $request->file('app_mockup_image');
                $imageName = time() . '_app_mockup.' . $file->getClientOriginalExtension();
                $file->storeAs('page_contents', $imageName, 'public');
                $meta['app_mockup_image'] = $imageName;
            }

            if ($request->hasFile('hero_bg_image')) {
                if (isset($meta['hero_bg_image']) && $meta['hero_bg_image']) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete('page_contents/' . $meta['hero_bg_image']);
                }
                $file = $request->file('hero_bg_image');
                $imageName = time() . '_hero_bg.' . $file->getClientOriginalExtension();
                $file->storeAs('page_contents', $imageName, 'public');
                $meta['hero_bg_image'] = $imageName;
            }
        }

        // Handle dynamic fleet item images
        if ($request->page_slug == 'fleet' && isset($meta['fleet_items'])) {
            $fleet_images = $request->file('fleet_item_images');
            foreach ($meta['fleet_items'] as $index => &$item) {
                if (isset($fleet_images[$index])) {
                    // Delete old item image if it's not a static asset
                    if (isset($item['image']) && $item['image'] && strpos($item['image'], 'goride/') === false) {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete('page_contents/' . $item['image']);
                    }
                    
                    $file = $fleet_images[$index];
                    $imageName = time() . '_fleet_' . $index . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('page_contents', $imageName, 'public');
                    $item['image'] = $imageName;
                }
            }
        }

        // Handle dynamic tour item images
        if ($request->page_slug == 'tours' && isset($meta['tour_items'])) {
            $tour_images = $request->file('tour_item_images');
            foreach ($meta['tour_items'] as $index => &$item) {
                if (isset($tour_images[$index])) {
                    // Delete old item image if it's not a static asset
                    if (isset($item['image']) && $item['image'] && strpos($item['image'], 'goride/') === false) {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete('page_contents/' . $item['image']);
                    }
                    
                    $file = $tour_images[$index];
                    $imageName = time() . '_tour_' . $index . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('page_contents', $imageName, 'public');
                    $item['image'] = $imageName;
                }
            }
        }

        $pageContent->update([
            'page_slug' => $request->page_slug,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'content' => $request->content,
            'highlights' => $highlights,
            'meta' => $meta,
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
