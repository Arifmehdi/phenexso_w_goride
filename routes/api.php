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
use App\Http\Controllers\Api\RideMatchingController; // Import RideMatchingController
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

// Public API - Get driver ratings
Route::get('/driver-ratings/{driverId}', [\App\Http\Controllers\Api\DriverRatingController::class, 'driverRatings']);

// Public API - Get website parameters (per_km_rate for fare calculation)
// Optional ?lat=&lng= includes the active surge multiplier for that point.
Route::get('/website-parameters', function (\Illuminate\Http\Request $request) {
    $param = \App\Models\WebsiteParameter::first();
    $surgeMultiplier = 1.0;
    if ($request->filled('lat') && $request->filled('lng')) {
        $surgeMultiplier = \App\Models\SurgeZone::multiplierFor(
            (float) $request->lat, (float) $request->lng
        );
    }
    return response()->json([
        'success' => true,
        'data' => [
            'per_km_rate' => (float) ($param?->per_km_rate ?? 20.00),
            'base_fare' => 50.00,
            'currency' => 'BDT',
            'surge_multiplier' => $surgeMultiplier,
        ]
    ]);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [ApiAuthController::class, 'logout']);

    // ── FCM Token ──
    // auth()->user() returns the correct model automatically:
    //   rider/corporate/admin → User (users.fcm_token)
    //   driver               → Driver (drivers.fcm_token)
    Route::post('/user/fcm-token', function (\Illuminate\Http\Request $request) {
        $request->validate(['fcm_token' => 'required|string']);
        auth()->user()->update(['fcm_token' => $request->fcm_token]);
        return response()->json(['success' => true]);
    });

    // ── Profile Completion ──
    Route::get('/user/profile-completion', [App\Http\Controllers\Api\ProfileCompletionController::class, 'completion']);
    Route::post('/user/complete-profile', [App\Http\Controllers\Api\ProfileCompletionController::class, 'updateProfile']);

    // ── Admin Approval Routes ──
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/admin/pending-approvals', [App\Http\Controllers\Api\AdminApprovalController::class, 'pendingApprovals']);
        Route::post('/admin/users/{id}/approve-reject', [App\Http\Controllers\Api\AdminApprovalController::class, 'approveReject']);
        Route::get('/admin/approval-stats', [App\Http\Controllers\Api\AdminApprovalController::class, 'stats']);
    });
    Route::get('/user', [ApiAuthController::class, 'me']);
    // 
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead']);

    // ── Driver Ratings ──
    Route::post('/driver-ratings', [\App\Http\Controllers\Api\DriverRatingController::class, 'store']);
    Route::get('/driver-ratings/check/{rideRequestId}', [\App\Http\Controllers\Api\DriverRatingController::class, 'checkRating']);

    // ── Ride Matching & History System ──
    Route::post('/ride-requests/match', [\App\Http\Controllers\Api\RideMatchingController::class, 'matchAndOffer']);
    Route::post('/ride-requests/{rideId}/decline', [\App\Http\Controllers\Api\RideMatchingController::class, 'declineAndTransfer']);
    Route::post('/ride-offers/{offerId}/respond', [\App\Http\Controllers\Api\RideMatchingController::class, 'respondToOffer']);
    Route::get('/ride-requests/{id}/offers', [\App\Http\Controllers\Api\RideMatchingController::class, 'rideOffers']);
    Route::get('/ride-requests/{id}/detail', [\App\Http\Controllers\Api\RideMatchingController::class, 'rideDetail']);
    Route::get('/ride-history', [\App\Http\Controllers\Api\RideMatchingController::class, 'rideHistory']);
    Route::get('/rider/stats', [\App\Http\Controllers\Api\RideMatchingController::class, 'riderStats']);

    // Resolve the Laravel ride id from a Firestore trip id. Lets the app sync
    // status/payment even when the numeric id wasn't captured during the
    // real-time (Firestore) accept handshake — the fix for rides stuck 'pending'.
    Route::get('/trips/{firebaseTripId}/resolve', function ($firebaseTripId) {
        $ride = \App\Models\RideRequest::where('firebase_trip_id', $firebaseTripId)
            ->latest('id')->first();
        return response()->json(['success' => (bool) $ride, 'ride_id' => $ride?->id]);
    });
    Route::post('/ride-requests/{id}/payment', [\App\Http\Controllers\Api\RideMatchingController::class, 'updatePayment']);
    Route::post('/driver/toggle-online', [\App\Http\Controllers\Api\RideMatchingController::class, 'toggleOnline']);
    Route::post('/ride-requests/{id}/assign-driver', [\App\Http\Controllers\Api\RideMatchingController::class, 'assignDriver']);

    // Original Ride Request Routes
    Route::post('/ride-requests', [\App\Http\Controllers\Api\RideRequestController::class, 'store']);
    Route::patch('/ride-requests/{id}/status', [\App\Http\Controllers\Api\RideRequestController::class, 'updateStatus']);
    Route::post('/update-location', [\App\Http\Controllers\Api\RideRequestController::class, 'updateLocation']);
    Route::get('/nearby-drivers', [\App\Http\Controllers\Api\RideRequestController::class, 'nearbyDrivers']);
    Route::get('/active-ride', [\App\Http\Controllers\Api\RideRequestController::class, 'activeRide']);

    Route::apiResource('products', ProductController::class)->except(['index', 'show']);
    Route::post('products/bulk-store', [ProductController::class, 'bulkStore']);
    // Authenticated API routes for Cart and Orders
    // Route::apiResource('cart', CartController::class)->only(['index', 'store', 'destroy']);
    Route::apiResource('orders', OrderController::class)->except(['store']);
    Route::get('order-list', [OrderController::class, 'simpleList']);
    Route::apiResource('users', UserController::class); // New Route for User management
    Route::patch('/user/profile', [UserController::class, 'updateMyProfile']);
    Route::patch('/user/password', [UserController::class, 'changePassword']);

    // ── Saved Addresses ──
    Route::apiResource('/user/saved-addresses', \App\Http\Controllers\Api\SavedAddressController::class);

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

    // ── Wallet (Task 21-22) ──
    Route::get('/wallet/balance', [\App\Http\Controllers\Api\WalletController::class, 'balance']);
    Route::get('/wallet/transactions', [\App\Http\Controllers\Api\WalletController::class, 'transactions']);
    Route::post('/wallet/top-up', [\App\Http\Controllers\Api\WalletController::class, 'topUp']);
    Route::post('/ride-requests/{rideId}/pay-wallet', [\App\Http\Controllers\Api\WalletController::class, 'payForRide']);


    // ── Driver Earnings (Task 26) ──
    Route::get('/driver/earnings', [\App\Http\Controllers\Api\EarningsController::class, 'index']);

    // ── Receipt PDF (Task 29) ──
    Route::get('/ride-requests/{rideId}/receipt', [\App\Http\Controllers\Api\EarningsController::class, 'receiptPdf']);

    // ── Driver Verification / Profile Completion ──
    Route::get('/driver/profile-status', [\App\Http\Controllers\Api\DriverProfileController::class, 'status']);
    Route::post('/driver/profile/update', [\App\Http\Controllers\Api\DriverProfileController::class, 'update']);
    // Admin verification
    Route::get('/admin/drivers/verification', [\App\Http\Controllers\Api\DriverProfileController::class, 'verificationList']);
    Route::get('/admin/drivers/{driver}/verification', [\App\Http\Controllers\Api\DriverProfileController::class, 'adminShow']);
    Route::post('/admin/drivers/{driver}/verify', [\App\Http\Controllers\Api\DriverProfileController::class, 'review']);

    // ── Phase 6: Safety Features ──
    Route::post('/sos/trigger',              [\App\Http\Controllers\Api\SosController::class, 'trigger']);
    Route::post('/sos/alerts/{alert}/resolve', [\App\Http\Controllers\Api\SosController::class, 'resolve']);
    Route::get('/admin/sos/alerts',          [\App\Http\Controllers\Api\SosController::class, 'index']);
    Route::post('/ride-requests/{rideId}/tracking-token', [\App\Http\Controllers\Api\TripTrackingController::class, 'generateToken']);

    // ── Phase 3: Driver Management ──
    // Task 30: Document upload
    Route::post('/driver/upload-document', [\App\Http\Controllers\Api\DriverDocumentController::class, 'upload']);
    Route::get('/driver/my-documents', [\App\Http\Controllers\Api\DriverDocumentController::class, 'myDocuments']);
    // Admin document review
    Route::get('/admin/documents/pending', [\App\Http\Controllers\Api\DriverDocumentController::class, 'pending']);
    Route::post('/admin/documents/{document}/review', [\App\Http\Controllers\Api\DriverDocumentController::class, 'review']);

    // Task 32/33: Driver stats
    Route::get('/driver/stats', [\App\Http\Controllers\Api\DriverStatsController::class, 'stats']);

    // Task 31: Vehicle API
    Route::get('/vehicles', function () {
        $user = auth()->user();
        $vehicles = \App\Models\Vehicle::whereHas('drivers', fn($q) => $q->where('user_id', $user->id))
            ->orWhere('user_id', $user->id)->get();
        return response()->json(['success' => true, 'vehicles' => $vehicles]);
    });

    // Task 35: OTP (public routes below, auth routes here for resend)
    Route::post('/auth/resend-otp', [\App\Http\Controllers\Api\OtpController::class, 'send']);

    // Task 36: Notifications already exist at /api/notifications

    // ══════════════════════════════════════════════════════════════════
    //  new_api.txt feature set
    // ══════════════════════════════════════════════════════════════════

    // ── Admin: dashboard, live map, reports ──
    Route::get('/admin/dashboard-stats',   [\App\Http\Controllers\Api\AdminDashboardController::class, 'dashboardStats']);
    Route::get('/admin/active-rides',      [\App\Http\Controllers\Api\AdminDashboardController::class, 'activeRides']);
    Route::get('/admin/reports/revenue',   [\App\Http\Controllers\Api\AdminDashboardController::class, 'revenueReport']);
    Route::get('/admin/reports/rides',     [\App\Http\Controllers\Api\AdminDashboardController::class, 'ridesReport']);
    Route::get('/admin/reports/drivers',   [\App\Http\Controllers\Api\AdminDashboardController::class, 'driversReport']);
    Route::post('/admin/notifications/broadcast', [\App\Http\Controllers\Api\AdminDashboardController::class, 'broadcastNotification']);

    // ── Support Tickets ──
    Route::post('/support-tickets',              [\App\Http\Controllers\Api\SupportTicketController::class, 'store']);
    Route::get('/support-tickets',                [\App\Http\Controllers\Api\SupportTicketController::class, 'index']);
    Route::get('/support-tickets/{ticket}',        [\App\Http\Controllers\Api\SupportTicketController::class, 'show']);
    Route::post('/support-tickets/{ticket}/reply', [\App\Http\Controllers\Api\SupportTicketController::class, 'reply']);
    Route::get('/admin/support-tickets',            [\App\Http\Controllers\Api\SupportTicketController::class, 'adminIndex']);
    Route::patch('/admin/support-tickets/{ticket}', [\App\Http\Controllers\Api\SupportTicketController::class, 'adminUpdate']);

    // ── Payments: ShurjoPay (bKash/Nagad) ──
    Route::post('/payment/shurjopay/initiate', [\App\Http\Controllers\Api\RidePaymentController::class, 'shurjopayInitiate']);
    Route::post('/payment/shurjopay/callback', [\App\Http\Controllers\Api\RidePaymentController::class, 'shurjopayCallback']);

    // ── Trip share link — GET alias alongside the existing POST (token-creation) ──
    Route::get('/ride-requests/{rideId}/tracking-token', [\App\Http\Controllers\Api\TripTrackingController::class, 'generateToken']);

    // ── Owner ──
    Route::get('/owner/dashboard', [\App\Http\Controllers\Api\OwnerController::class, 'dashboard']);
    Route::get('/owner/fleet',     [\App\Http\Controllers\Api\OwnerController::class, 'fleet']);
    Route::get('/owner/earnings',  [\App\Http\Controllers\Api\OwnerController::class, 'earnings']);

    // ── Corporate ──
    Route::get('/corporate/dashboard',              [\App\Http\Controllers\Api\CorporateController::class, 'dashboard']);
    Route::post('/corporate/ride-request',          [\App\Http\Controllers\Api\CorporateController::class, 'createRideRequest']);
    Route::get('/corporate/billing',                [\App\Http\Controllers\Api\CorporateController::class, 'billing']);
    Route::get('/corporate/billing/{month}/pdf',    [\App\Http\Controllers\Api\CorporateController::class, 'billingPdf']);

    // ── Ride Pooling ──
    Route::get('/ride-requests/pool/available', [\App\Http\Controllers\Api\RidePoolController::class, 'available']);

    // ── Referrals ──
    Route::get('/referrals', [\App\Http\Controllers\Api\ReferralController::class, 'stats']);

    // ── Surge Pricing (admin) ──
    Route::get('/admin/surge',        [\App\Http\Controllers\Api\SurgeController::class, 'index']);
    Route::post('/admin/surge',       [\App\Http\Controllers\Api\SurgeController::class, 'store']);
    Route::patch('/admin/surge/{zone}', [\App\Http\Controllers\Api\SurgeController::class, 'update']);

    // ── Driver Payouts (admin) ──
    Route::get('/admin/payouts/pending',  [\App\Http\Controllers\Api\DriverPayoutController::class, 'pending']);
    Route::post('/admin/payouts/process', [\App\Http\Controllers\Api\DriverPayoutController::class, 'process']);
    Route::get('/admin/payouts/export',   [\App\Http\Controllers\Api\DriverPayoutController::class, 'export']);

    // ── Rider Rating by Driver (Task 20) ──
    Route::post('/rider-ratings', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'ride_request_id' => 'required|integer',
            'rider_id'        => 'required|integer',
            'rating'          => 'required|integer|min:1|max:5',
            'tags'            => 'nullable|array',
        ]);
        $driver = auth()->user();
        \App\Models\RiderRating::updateOrCreate(
            ['ride_request_id' => $request->ride_request_id, 'driver_id' => $driver->id],
            ['rider_id' => $request->rider_id, 'rating' => $request->rating,
             'review' => $request->review, 'tags' => $request->tags]
        );
        return response()->json(['success' => true]);
    });
});

// ── Banners — public (Task 25) ──
Route::get('/banners', [\App\Http\Controllers\Api\BannerController::class, 'index']);

// ── Promo code validation — public (no login needed to check a code + fare) ──
Route::post('/promo/validate', [\App\Http\Controllers\Api\PromoCodeController::class, 'checkCode']);

// ── Public trip tracking — no auth (Task 50) ──
Route::get('/public/track/{token}',          [\App\Http\Controllers\Api\TripTrackingController::class, 'publicTrack']);
Route::get('/public/track/{token}/location', function (string $token) {
    $record = \App\Models\TripTrackingToken::where('token', $token)
        ->where('expires_at', '>', now())->first();
    if (!$record) return response()->json(['error' => 'Expired'], 404);
    $ride = \App\Models\RideRequest::find($record->ride_request_id);
    $driver = $ride ? \App\Models\Driver::find($ride->driver_id) : null;
    return response()->json([
        'lat' => $driver?->latitude,
        'lng' => $driver?->longitude,
    ]);
});

// ── OTP — public (Task 35) ──
Route::post('/auth/send-otp',   [\App\Http\Controllers\Api\OtpController::class, 'send']);
Route::post('/auth/verify-otp', [\App\Http\Controllers\Api\OtpController::class, 'verify']);



