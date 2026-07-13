<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

/**
 * Admin CRUD for the ride app's home-screen banners. These feed the app's
 * GET /api/banners endpoint (BannerController@index), so a banner added here
 * shows on the passenger home slider immediately (while active + not expired).
 */
class BannerController extends Controller
{
    public function index()
    {
        if (function_exists('menuSubmenu')) {
            menuSubmenu('banners', 'bannersSM');
        }
        $banners = Banner::orderBy('sort_order')->orderByDesc('id')->paginate(15);
        return view('admin.banners.index', compact('banners'));
    }

    public function store(Request $request)
    {
        $data = $this->resolve($request, null);
        if (empty($data['image_url'])) {
            return back()->withErrors(['image' => 'Upload an image or provide an image URL.'])->withInput();
        }
        Banner::create($data);
        return back()->with('success', 'Banner created successfully.');
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);
        $banner->update($this->resolve($request, $banner));
        return back()->with('success', 'Banner updated successfully.');
    }

    public function destroy($id)
    {
        Banner::findOrFail($id)->delete();
        return back()->with('success', 'Banner deleted.');
    }

    /**
     * Validate + build the save array. An uploaded file wins over the URL
     * field; on edit the existing image is kept if neither is supplied.
     */
    private function resolve(Request $request, ?Banner $existing): array
    {
        $request->validate([
            'title'      => 'nullable|string|max:255',
            'link'       => 'nullable|string|max:500',
            'image'      => 'nullable|image|max:4096',
            'image_url'  => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer|min:0',
            'expires_at' => 'nullable|date',
        ]);

        $imageUrl = $existing?->image_url;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = 'banner_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('banners'), $name);
            $imageUrl = url('banners/' . $name);
        } elseif ($request->filled('image_url')) {
            $imageUrl = trim($request->image_url);
        }

        return [
            'title'      => $request->title,
            'link'       => $request->link,
            'image_url'  => $imageUrl,
            'sort_order' => $request->sort_order ?? 0,
            'is_active'  => $request->has('is_active'),
            'expires_at' => $request->expires_at ?: null,
        ];
    }
}
