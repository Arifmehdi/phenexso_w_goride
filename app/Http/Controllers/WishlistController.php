<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    // Wishlist Page
    public function index()
    {
        $ip = request()->ip(); // Unique user

        $wishlists = Wishlist::with('product')
            ->where('user_ip', $ip)
            ->get();

        return view('website.wishlist', compact('wishlists'));
    }

    // Add to Wishlist
    public function add(Request $request)
    {
        $ip = $request->ip();

        $product_id = $request->product_id;

        // Already added check
        $exists = Wishlist::where('product_id', $product_id)
                ->where('user_ip', $ip)
                ->first();

        if (!$exists) {
            Wishlist::create([
                'product_id' => $product_id,
                'user_ip' => $ip,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Added to Wishlist Successfully!'
        ]);
    }

    // Remove item
    public function remove(Request $request)
    {
        Wishlist::where('id', $request->id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Removed Successfully!'
        ]);
    }
}


