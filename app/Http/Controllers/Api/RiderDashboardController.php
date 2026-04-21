<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle; // Import Vehicle model
use App\Models\VehicleAssignment; // Import VehicleAssignment model
use App\Models\Order; // Import Order model
use App\Models\Driver; // Import Driver model
use App\Models\Product; // Import Product model
use App\Http\Resources\OrderResource; // Import OrderResource
use Illuminate\Support\Facades\Response;

class RiderDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Check if the user has the 'rider' role
        if ($user->role !== 'rider') {
            return Response::json(['message' => 'Unauthorized: User is not a rider.'], 403);
        }

        // Fetch assigned vehicle details
        $vehicle = $user->vehicle ? $user->vehicle : null;

        // Fetch orders currently assigned to this rider
        $ordersQuery = Order::where('driver_id', $user->id)
                            ->with(['orderItems.product', 'user'])
                            ->orderBy('created_at', 'desc');
        
        $assignedOrders = (clone $ordersQuery)->get();

        // Fetch products currently assigned to this rider
        $assignedProducts = Product::where('rider_id', $user->id)
                                    ->with('media')
                                    ->latest()
                                    ->get();

        // Prepare Statistics
        $stats = [
            'total_orders' => $assignedOrders->count(),
            'pending_orders' => $assignedOrders->where('order_status', 'pending')->count(),
            'confirmed_orders' => $assignedOrders->where('order_status', 'confirmed')->count(),
            'shipped_orders' => $assignedOrders->where('order_status', 'shipped')->count(),
            'delivered_orders' => $assignedOrders->where('order_status', 'delivered')->count(),
            'total_products' => $assignedProducts->count(),
        ];

        // Format Rider Data for API
        $riderData = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'mobile' => $user->mobile,
            'license_no' => $user->license_no,
            'address' => $user->address,
            'image' => $user->image ? asset('storage/product_images/' . $user->image) : asset('img/profile.jpg'),
            'status' => $user->is_approve ? 'Active' : 'Pending Approval',
        ];

        return Response::json([
            'success' => true,
            'message' => 'Rider dashboard data retrieved successfully.',
            'data' => [
                'rider' => $riderData,
                'stats' => $stats,
                'assigned_vehicle' => $vehicle,
                'recent_orders' => OrderResource::collection($assignedOrders->take(10)), // Use OrderResource
                'assigned_products' => $assignedProducts->take(10), // Limit products too
            ]
        ]);
    }

    public function assignedProducts(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'rider') {
            return Response::json(['message' => 'Unauthorized: User is not a rider.'], 403);
        }

        $products = Product::where('rider_id', $user->id)
                            ->with(['categories', 'media'])
                            ->latest()
                            ->paginate(20);

        return Response::json([
            'success' => true,
            'message' => 'Assigned products retrieved successfully.',
            'data' => $products
        ]);
    }

    /**
     * Get the active orders for the rider.
     */
    public function activeOrders(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'rider') {
            return Response::json(['message' => 'Unauthorized: User is not a rider.'], 403);
        }

        $activeOrders = Order::where('driver_id', $user->id)
            ->whereNotIn('order_status', ['delivered', 'canceled'])
            ->with(['orderItems.product', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return Response::json([
            'success' => true,
            'message' => 'Active orders retrieved successfully.',
            'data' => OrderResource::collection($activeOrders)
        ]);
    }

    /**
     * Show details of a specific order assigned to the rider.
     */
    public function showOrder(Request $request, $id)
    {
        $user = $request->user();

        if ($user->role !== 'rider') {
            return Response::json(['message' => 'Unauthorized: User is not a rider.'], 403);
        }

        $order = Order::where('driver_id', $user->id)
            ->with(['orderItems.product', 'user', 'vehicle'])
            ->find($id);

        if (!$order) {
            return Response::json([
                'success' => false,
                'message' => 'Order not found or not assigned to you.'
            ], 404);
        }

        return Response::json([
            'success' => true,
            'message' => 'Order details retrieved successfully.',
            'data' => new OrderResource($order)
        ]);
    }

    /**
     * Update the status of an order assigned to the rider.
     */
    public function updateOrderStatus(Request $request, $id)
    {
        $user = $request->user();

        if ($user->role !== 'rider') {
            return Response::json(['message' => 'Unauthorized: User is not a rider.'], 403);
        }

        $request->validate([
            'status' => 'required|in:shipped,delivered,canceled',
            'order_note' => 'nullable|string|max:1000'
        ]);

        $order = Order::where('driver_id', $user->id)->find($id);

        if (!$order) {
            return Response::json([
                'success' => false,
                'message' => 'Order not found or not assigned to you.'
            ], 404);
        }

        $status = $request->status;
        $updateData = ['order_status' => $status];

        if ($request->has('order_note')) {
            $updateData['order_note'] = $request->order_note;
        }

        if ($status === 'shipped') {
            $updateData['shiped_at'] = now();
        } elseif ($status === 'delivered') {
            $updateData['delivered_at'] = now();
            $updateData['payment_status'] = 'paid'; // Assuming cash on delivery or similar
        } elseif ($status === 'canceled') {
            $updateData['canceled_at'] = now();
        }

        $order->update($updateData);

        return Response::json([
            'success' => true,
            'message' => "Order status updated to {$status} successfully.",
            'data' => new OrderResource($order->load(['orderItems.product', 'user']))
        ]);
    }
}
