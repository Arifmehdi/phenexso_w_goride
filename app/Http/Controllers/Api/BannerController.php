<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Public feed for the passenger app home slider — active, non-expired only.
     */
    public function index()
    {
        $banners = Banner::where('is_active', true)
            ->where(fn($q) => $q->whereNull('expires_at')->orWhere('expires_at', '>', now()))
            ->orderBy('sort_order')
            ->get(['id', 'title', 'image_url', 'link']);

        return response()->json(['success' => true, 'banners' => $banners]);
    }

    // ── Admin management (shared by web + Flutter admin) ────────────────

    /**
     * Full list for admins — includes inactive/expired banners.
     */
    public function adminIndex(Request $request)
    {
        if ($resp = $this->denyIfNotAdmin($request)) return $resp;

        $banners = Banner::orderBy('sort_order')->orderByDesc('id')->get();

        return response()->json([
            'success' => true,
            'banners' => $banners,
        ]);
    }

    public function store(Request $request)
    {
        if ($resp = $this->denyIfNotAdmin($request)) return $resp;

        $data = $this->resolve($request, null);
        if (empty($data['image_url'])) {
            return response()->json([
                'success' => false,
                'message' => 'Upload an image or provide an image URL.',
            ], 422);
        }

        $banner = Banner::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Banner created.',
            'banner'  => $banner,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        if ($resp = $this->denyIfNotAdmin($request)) return $resp;

        $banner = Banner::find($id);
        if (!$banner) {
            return response()->json(['success' => false, 'message' => 'Banner not found.'], 404);
        }

        $banner->update($this->resolve($request, $banner));
        return response()->json([
            'success' => true,
            'message' => 'Banner updated.',
            'banner'  => $banner->fresh(),
        ]);
    }

    public function destroy(Request $request, $id)
    {
        if ($resp = $this->denyIfNotAdmin($request)) return $resp;

        $banner = Banner::find($id);
        if (!$banner) {
            return response()->json(['success' => false, 'message' => 'Banner not found.'], 404);
        }

        $banner->delete();
        return response()->json(['success' => true, 'message' => 'Banner deleted.']);
    }

    // ── Helpers ─────────────────────────────────────────────────────────

    /**
     * Only admins may manage banners. Returns a 403 JSON response for
     * non-admins, or null to continue.
     */
    private function denyIfNotAdmin(Request $request)
    {
        $u = $request->user();
        $isAdmin = $u && (($u->role ?? null) === 'admin' || $u instanceof \App\Models\Admin);
        if (!$isAdmin) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        return null;
    }

    /**
     * Validate + build the save array. An uploaded file wins over the URL
     * field; on edit the existing image is kept if neither is supplied.
     * Images are written to public/banners so both the web admin and the
     * API write to the same place.
     */
    private function resolve(Request $request, ?Banner $existing): array
    {
        $request->validate([
            'title'      => 'nullable|string|max:255',
            'link'       => 'nullable|string|max:500',
            'image'      => 'nullable|image|max:10240', // up to 10 MB (large 4727x2000 art)
            'image_url'  => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer|min:0',
            'expires_at' => 'nullable|date',
        ]);

        $imageUrl = $existing?->image_url;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = 'banner_' . time() . '_' . mt_rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('banners'), $name);
            $imageUrl = url('banners/' . $name);
        } elseif ($request->filled('image_url')) {
            $imageUrl = trim($request->image_url);
        }

        // is_active: accept a real boolean from JSON/multipart; default true on
        // create when the field is absent, keep existing value on edit.
        if ($request->has('is_active')) {
            $isActive = $request->boolean('is_active');
        } else {
            $isActive = $existing?->is_active ?? true;
        }

        // On a partial update (e.g. an active-toggle that sends only is_active)
        // keep the existing title/link rather than wiping them to null.
        return [
            'title'      => $request->has('title') ? $request->title : ($existing?->title),
            'link'       => $request->has('link') ? $request->link : ($existing?->link),
            'image_url'  => $imageUrl,
            'sort_order' => $request->filled('sort_order') ? (int) $request->sort_order : ($existing?->sort_order ?? 0),
            'is_active'  => $isActive,
            'expires_at' => $request->filled('expires_at') ? $request->expires_at : ($existing?->expires_at),
        ];
    }
}
