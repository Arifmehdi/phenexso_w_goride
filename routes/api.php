<?php

use App\Http\Controllers\Api\AuthController as ApiAuthController;
use App\Http\Controllers\Auth\AuthController; // Import the newly created AuthController
use App\Http\Controllers\Api\ProductController; // Import ProductController
use App\Http\Controllers\Api\ProductCategoryController; // Import ProductCategoryController
use App\Http\Controllers\Api\CartController; // Import CartController
use App\Http\Controllers\Api\OrderController; // Import OrderController
use App\Http\Controllers\Api\UnitController; // Import UnitController
use App\Http\Controllers\ChatController; // Import OrderController
use App\Http\Controllers\Api\UserController; // Import UserController
use App\Http\Controllers\Api\ContactFormController; // Import ContactFormController
use App\Http\Controllers\Api\SellerDashboardController; // Import SellerDashboardController
use App\Http\Controllers\Api\RiderDashboardController; // Import RiderDashboardController
use App\Http\Controllers\NotificationController; // Import RiderDashboardController
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [ApiAuthController::class, 'login']);
Route::post('/register', [ApiAuthController::class, 'register']);

// Password Reset Routes
Route::post('/forgot-password', [ApiAuthController::class, 'forgotPassword'])->name('password.email');
Route::post('/reset-password', [ApiAuthController::class, 'resetPassword'])->name('password.reset');

// Public API routes for products
Route::get('products', [ProductController::class, 'index']);
Route::get('products/{product}', [ProductController::class, 'show']);
Route::get('products/{product}/overview', [ProductController::class, 'overview']);
Route::get('products/{product}/no-description', [ProductController::class, 'withoutDescription']);
Route::get('products-no-description', [ProductController::class, 'indexWithoutDescription']);
Route::get('products/by-slug/{slug}', [ProductController::class, 'getProductsBySlug']);
Route::apiResource('product-categories', ProductCategoryController::class);
Route::get('units', [UnitController::class, 'index']);

// Cart routes accessible to both authenticated and guest users
Route::apiResource('cart', CartController::class)->only(['index', 'store', 'destroy']);
Route::post('orders', [OrderController::class, 'store']);

// API route for contact form submission
Route::post('/contact', [ContactFormController::class, 'store']);

// notification route
Route::get('/notifications', [NotificationController::class, 'index']);
Route::get('/notifications/ip', [NotificationController::class, 'ipNotifications']);
Route::post('/notifications/read/{id}', [NotificationController::class, 'markAsRead']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [ApiAuthController::class, 'logout']);
    Route::get('/user', [ApiAuthController::class, 'me']);
    // 
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead']);

    Route::apiResource('products', ProductController::class)->except(['index', 'show']);
    Route::post('products/bulk-store', [ProductController::class, 'bulkStore']);
    // Authenticated API routes for Cart and Orders
    // Route::apiResource('cart', CartController::class)->only(['index', 'store', 'destroy']);
    Route::apiResource('orders', OrderController::class)->except(['store']);
    Route::get('order-list', [OrderController::class, 'simpleList']);
    Route::apiResource('users', UserController::class); // New Route for User management
    Route::patch('/user/profile', [UserController::class, 'updateMyProfile']);
    Route::patch('/user/password', [UserController::class, 'changePassword']);

    // Dashboard routes for Seller and Rider
    Route::get('/seller/dashboard', [SellerDashboardController::class, 'index']);
    Route::get('/seller/products', [ProductController::class, 'sellerProducts']);
    Route::get('/seller/orders', [OrderController::class, 'sellerOrders']);
    Route::patch('/seller/products/{product}', [ProductController::class, 'sellerUpdate']);
    Route::get('/rider/dashboard', [RiderDashboardController::class, 'index']);
    Route::get('/rider/assigned-products', [RiderDashboardController::class, 'assignedProducts']);
    Route::get('/rider/active-orders', [RiderDashboardController::class, 'activeOrders']);
    Route::get('/rider/orders/{order}', [RiderDashboardController::class, 'showOrder']);
    Route::post('/rider/orders/{order}/update-status', [RiderDashboardController::class, 'updateOrderStatus']);


    // routes/api.php
    Route::get('/test-relationships', function() {
        $user = \App\Models\User::first();
        
        // Test 1: Check if user has conversations
        $conversations = $user->conversations;
        // dd('User conversations:', $conversations);
        
        // Test 2: Create a conversation
        $conversation = \App\Models\Conversation::create([
            'type' => 'private',
            'created_by' => $user->id
        ]);
        
        // Test 3: Add participants
        $participant = \App\Models\User::where('id', '!=', $user->id)->first();
        
        $cp = \App\Models\ConversationParticipant::create([
            'conversation_id' => $conversation->id,
            'user_id' => $participant->id,
            'is_admin' => false
        ]);
        
        dd('Created participant:', $cp);
    });

        // Chat Routes
    Route::prefix('chat')->group(function () {


        Route::post('send', [ChatController::class, 'send']);
        Route::get('messages', [ChatController::class, 'messages']);
        Route::post('read', [ChatController::class, 'markAsRead']);
        // Conversations
        Route::get('conversations', [ChatController::class, 'getConversations']);
        Route::post('conversations', [ChatController::class, 'createConversation']);
        Route::get('conversations/{conversation}', [ChatController::class, 'getConversation']);
        Route::post('conversations/{conversation}/add-participant', [ChatController::class, 'addParticipant']);
        Route::delete('conversations/{conversation}/remove-participant/{user}', [ChatController::class, 'removeParticipant']);
        
        // Messages
        Route::get('conversations/{conversation}/messages', [ChatController::class, 'getMessages']);
        Route::post('conversations/{conversation}/messages', [ChatController::class, 'sendMessage']);
        Route::post('messages/{message}/read', [ChatController::class, 'markAsRead']);
        Route::delete('messages/{message}', [ChatController::class, 'deleteMessage']);
        
        // Users
        Route::get('users/search', [ChatController::class, 'searchUsers']);
        Route::get('users/{user}/conversation', [ChatController::class, 'getOrCreatePrivateConversation']);
    });
});



