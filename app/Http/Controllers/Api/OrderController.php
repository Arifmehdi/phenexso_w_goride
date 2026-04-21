<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart; // Assuming cart is used to place order
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource (authenticated user's orders).
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                        ->with(['orderItems', 'user']) // Eager load relationships
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return OrderResource::collection($orders);
    }

    /**
     * Get a simple list of all orders (Public/Flutter optimized).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function simpleList()
    {
        $orders = Order::select('id', 'name', 'grand_total', 'payment_status', 'order_status', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'All orders retrieved successfully.',
            'data' => $orders
        ]);
    }

    /**
     * Display a listing of orders for the currently authenticated seller.
     * 
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function sellerOrders()
    {
        $orders = Order::where('user_id', Auth::id())
                        ->with(['orderItems', 'user']) // Eager load relationships
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage (place an order from cart).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\OrderResource|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $userId = $user ? $user->id : null;
        $sessionId = $request->header('X-Session-ID') ?: $request->session_id;

        if ($userId) {
            $cartItems = Cart::where('user_id', $userId)->with('product')->get();
        } elseif ($sessionId) {
            $cartItems = Cart::where('session_id', $sessionId)->with('product')->get();
        } else {
            return response()->json(['message' => 'Your cart is empty or session session_id is missing.'], 400);
        }

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Your cart is empty.'], 400);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address_title' => 'required|string|max:1000',
            'payment_method' => 'required|string|max:50',
            'order_note' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        return DB::transaction(function () use ($request, $userId, $cartItems, $sessionId) {
            // Update or Create Delivery Location if user is authenticated
            if ($userId) {
                \App\Models\DeliveryLocation::updateOrCreate(
                    ['user_id' => $userId],
                    [
                        'name' => $request->name,
                        'mobile' => $request->mobile,
                        'email' => $request->email,
                        'address_title' => $request->address_title,
                    ]
                );
            }

            $ws = \App\Models\WebsiteParameter::first();
            
            $subtotal = $cartItems->sum(function ($item) {
                return $item->quantity * ($item->product->final_price ?? 0);
            });
            
            $deliveryCost = $ws->shipping_cahrge ?? 0;
            $grandTotal = $subtotal + $deliveryCost;

            $order = Order::create([
                'user_id' => $userId,
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'address_title' => $request->address_title,
                'subtotal' => $subtotal,
                'grand_total' => $grandTotal,
                'payment_method' => $request->payment_method,
                'payment_status' => 'unpaid',
                'payment_gateway' => $request->payment_method,
                'delivery_cost' => $deliveryCost,
                'order_note' => $request->order_note,
                'pending_at' => now(),
                'addedby_id' => $userId,
            ]);

            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'user_id' => $userId,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'product_price' => $cartItem->product->final_price ?? 0,
                    'product_name' => $cartItem->product->name_en ?? $cartItem->product->name_bn,
                    'total_cost' => $cartItem->quantity * ($cartItem->product->final_price ?? 0),
                    'addedby_id' => $userId,
                ]);

                // Decrement product stock
                if ($cartItem->product) {
                    $cartItem->product->decrement('stock', $cartItem->quantity);
                }
            }

            // Clear the cart
            if ($userId) {
                Cart::where('user_id', $userId)->delete();
            } else {
                Cart::where('session_id', $sessionId)->delete();
            }

            return new OrderResource($order->load(['orderItems', 'user']));
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \App\Http\Resources\OrderResource|\Illuminate\Http\JsonResponse
     */
    public function show(Order $order)
    {
        // Ensure the order belongs to the authenticated user
        if ($order->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $order->load(['orderItems', 'user', 'payments']); // Eager load relationships
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \App\Http\Resources\OrderResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Order $order)
    {
        // Ensure the order belongs to the authenticated user or is an admin action
        // For simplicity, we'll assume only the user can update their own order,
        // or an admin would have a separate route/policy.
        if ($order->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'mobile' => 'sometimes|required|string|max:20',
            'email' => 'sometimes|required|email|max:255',
            'address_title' => 'sometimes|required|string|max:255',
            'payment_method' => 'sometimes|required|string|max:50',
            'payment_status' => 'sometimes|required|string|max:50', // Allow updating payment status
            'delivery_cost' => 'sometimes|numeric|min:0',
            'order_note' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $order->update($request->all());

        return new OrderResource($order->load(['orderItems', 'user', 'payments']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Order $order)
    {
        // Ensure the order belongs to the authenticated user or is an admin action
        if ($order->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $order->delete();

        return response()->json(['message' => 'Order deleted successfully'], 204);
    }
}