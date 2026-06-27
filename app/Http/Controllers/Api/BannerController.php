<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::where('is_active', true)
            ->where(fn($q) => $q->whereNull('expires_at')->orWhere('expires_at', '>', now()))
            ->orderBy('sort_order')
            ->get(['id', 'title', 'image_url', 'link']);

        return response()->json(['success' => true, 'banners' => $banners]);
    }
}
