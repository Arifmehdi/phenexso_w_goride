<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    /**
     * Display a listing of the resource (authenticated user's cart).
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $cartItems = collect();
        $user = Auth::guard('sanctum')->user();

        if ($user) {
            // User is authenticated, retrieve cart by user_id
            $cartItems = Cart::where('user_id', $user->id)
                                ->with('product')
                                ->get();
        } else {
            // User is a guest, retrieve cart by session_id from request/header
            $sessionId = $this->getGuestSessionId($request);
            if ($sessionId) {
                $cartItems = Cart::where('session_id', $sessionId)
                                    ->with('product')
                                    ->get();
            }
        }

        return CartResource::collection($cartItems);
    }

    /**
     * Add a product to the cart or update its quantity.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\CartResource|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'session_id' => 'nullable|string', // Accept session_id from request
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        if ($product->stock < $request->quantity) {
            return response()->json(['message' => 'Not enough stock available'], 422);
        }

        $cartData = [
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ];

        $user = Auth::guard('sanctum')->user();

        if ($user) {
            $cartData['user_id'] = $user->id;
            $cart = Cart::updateOrCreate(
                ['user_id' => $user->id, 'product_id' => $request->product_id],
                $cartData
            );
        } else {
            $sessionId = $this->getGuestSessionId($request);
            if (!$sessionId) {
                return response()->json(['message' => 'session_id is required for guest users.'], 400);
            }
            $cartData['session_id'] = $sessionId;
            $cart = Cart::updateOrCreate(
                ['session_id' => $sessionId, 'product_id' => $request->product_id],
                $cartData
            );
        }

        return new CartResource($cart->load('product'));
    }

    /**
     * Remove the specified resource from storage (a cart item).
     *
     * @param  \App\Models\Cart  $cart
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Cart $cart, Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        if ($user) {
            // Authenticated user: ensure the cart item belongs to them
            if ($cart->user_id !== $user->id) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
        } else {
            // Guest user: ensure the cart item belongs to their session
            $sessionId = $this->getGuestSessionId($request);
            if ($cart->session_id !== $sessionId) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
        }

        $cart->delete();

        return response()->json(['message' => 'Item removed from cart successfully'], 204);
    }

    /**
     * Get or generate a unique session ID for guest users.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    private function getGuestSessionId(Request $request): ?string
    {
        // Prioritize session_id from request body or header for stateless API
        if ($request->has('session_id')) {
            return $request->session_id;
        }
        
        if ($request->header('X-Session-ID')) {
            return $request->header('X-Session-ID');
        }

        // Fallback to Laravel session for web compatibility
        return Session::get('session_id');
    }

    /**
     * Merge guest cart items with the authenticated user's cart.
     * This method should be called after a user logs in.
     *
     * @param int $userId The ID of the authenticated user.
     * @param string|null $guestSessionId The session ID of the guest user.
     * @return void
     */
    public function mergeGuestCart(int $userId, ?string $guestSessionId): void
    {
        if (!$guestSessionId) {
            return;
        }

        $guestCartItems = Cart::where('session_id', $guestSessionId)->get();

        foreach ($guestCartItems as $guestCartItem) {
            $existingCartItem = Cart::where('user_id', $userId)
                                    ->where('product_id', $guestCartItem->product_id)
                                    ->first();

            if ($existingCartItem) {
                // If the product already exists in the user's cart, update the quantity
                $existingCartItem->quantity += $guestCartItem->quantity;
                $existingCartItem->save();
                $guestCartItem->delete(); // Remove the guest cart item
            } else {
                // Otherwise, assign the guest cart item to the user
                $guestCartItem->user_id = $userId;
                $guestCartItem->session_id = null; // Clear the session_id
                $guestCartItem->save();
            }
        }

        Session::forget('session_id'); // Clear the guest session ID from the session
    }
}
