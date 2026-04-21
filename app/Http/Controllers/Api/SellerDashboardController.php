<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; // Import Product model
use App\Models\Order;   // Import Order model
use App\Models\OrderItem; // Import OrderItem model
use Illuminate\Support\Facades\Response; // Import Response facade

class SellerDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Check if the user has the 'seller' role
        if ($user->role !== 'seller') {
             return Response::json(['success' => false, 'message' => 'Unauthorized: User is not a seller.'], 403);
        }

        // Fetch products added by this seller
        $products = Product::where('seller_id', $user->id)
            ->with(['categories', 'media'])
            ->latest()
            ->get();

        // Fetch orders related to this seller's products
        $sellerProductIds = $products->pluck('id')->toArray();

        // Find OrderItems that belong to these seller products
        $orderItems = OrderItem::whereIn('product_id', $sellerProductIds)
            ->with(['order' => function($query) {
                $query->with(['orderItems', 'user']);
            }])
            ->get();

        // Get unique orders from these order items, filtering out any null orders
        $orders = $orderItems->map(fn($item) => $item->order)->filter()->unique('id')->values();

        // Prepare Statistics
        $stats = [
            'total_products' => $products->count(),
            'total_orders' => $orders->count(),
            'pending_orders' => $orders->where('order_status', 'pending')->count(),
            'confirmed_orders' => $orders->where('order_status', 'confirmed')->count(),
            'delivered_orders' => $orders->where('order_status', 'delivered')->count(),
            'total_sales' => $orderItems->sum('total_cost'),
        ];

        // Format Seller Data for API
        $sellerData = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'mobile' => $user->mobile,
            'address' => $user->address,
            'image' => $user->image ? asset('storage/product_images/' . $user->image) : asset('img/profile.jpg'),
            'status' => $user->is_approve ? 'Active' : 'Pending Approval',
        ];

        // Transform Product Data to include full image URLs
        $transformedProducts = $products->map(function($product) {
            return [
                'id' => $product->id,
                'name' => $product->name_en,
                'stock' => $product->stock,
                'price' => $product->price,
                'image' => asset('storage/product_images/' . $product->fi()),
                'sku' => $product->sku,
            ];
        });

        return Response::json([
            'success' => true,
            'message' => 'Seller dashboard data retrieved successfully.',
            'data' => [
                'seller' => $sellerData,
                'stats' => $stats,
                'recent_orders' => $orders->take(10), // Limit to 10 for dashboard
                'products' => $transformedProducts,
            ]
        ]);
    }
}
