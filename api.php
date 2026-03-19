<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\SpaceController;
use App\Http\Controllers\Api\TourController;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\BoatController;
use App\Http\Controllers\Api\FlightController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\NotificationController;

/*
|--------------------------------------------------------------------------
| API Routes — v1
| Consumed by the MoonBnb Flutter mobile app (Flutter 3.10.6)
| Auth: Laravel Sanctum (Bearer token)
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {

    /*
    |------------------------------------------------------------------
    | Public — no auth required
    |------------------------------------------------------------------
    */

    // Authentication
    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
        Route::post('/reset-password', [AuthController::class, 'resetPassword']);
        Route::post('/social/{provider}', [AuthController::class, 'socialLogin']);
    });

    // Hotels
    Route::get('/hotels', [HotelController::class, 'index']);
    Route::get('/hotels/{slug}', [HotelController::class, 'show']);
    Route::get('/hotels/{id}/availability', [HotelController::class, 'availability']);

    // Spaces
    Route::get('/spaces', [SpaceController::class, 'index']);
    Route::get('/spaces/{slug}', [SpaceController::class, 'show']);
    Route::get('/spaces/{id}/availability', [SpaceController::class, 'availability']);

    // Tours
    Route::get('/tours', [TourController::class, 'index']);
    Route::get('/tours/{slug}', [TourController::class, 'show']);

    // Cars
    Route::get('/cars', [CarController::class, 'index']);
    Route::get('/cars/{slug}', [CarController::class, 'show']);
    Route::get('/cars/{id}/availability', [CarController::class, 'availability']);

    // Events
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/events/{slug}', [EventController::class, 'show']);

    // Boats
    Route::get('/boats', [BoatController::class, 'index']);
    Route::get('/boats/{slug}', [BoatController::class, 'show']);

    // Flights
    Route::get('/flights', [FlightController::class, 'index']);
    Route::post('/flights/search', [FlightController::class, 'search']);

    // Locations
    Route::get('/locations', [LocationController::class, 'index']);
    Route::get('/locations/{slug}', [LocationController::class, 'show']);

    // Reviews (public read)
    Route::get('/reviews/{serviceType}/{serviceId}', [ReviewController::class, 'index']);

    // News
    Route::get('/news', [NewsController::class, 'index']);
    Route::get('/news/{slug}', [NewsController::class, 'show']);

    // App config (currencies, languages, settings)
    Route::get('/config', function () {
        return response()->json([
            'supported_locales' => ['en', 'ja'],
            'currencies'        => ['USD', 'EUR', 'JPY'],
            'version'           => config('moonbnb.app_version'),
            'force_update'      => false,
        ]);
    });

    /*
    |------------------------------------------------------------------
    | Protected — Bearer token required (Laravel Sanctum)
    |------------------------------------------------------------------
    */

    Route::middleware('auth:sanctum')->group(function () {

        // Auth
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::post('/auth/refresh', [AuthController::class, 'refresh']);

        // User Profile
        Route::get('/user', [UserController::class, 'profile']);
        Route::put('/user', [UserController::class, 'update']);
        Route::put('/user/password', [UserController::class, 'updatePassword']);
        Route::post('/user/avatar', [UserController::class, 'uploadAvatar']);
        Route::delete('/user', [UserController::class, 'deleteAccount']);

        // Bookings
        Route::prefix('bookings')->group(function () {
            Route::get('/', [BookingController::class, 'index']);
            Route::post('/', [BookingController::class, 'store']);
            Route::get('/{id}', [BookingController::class, 'show']);
            Route::post('/{id}/cancel', [BookingController::class, 'cancel']);
            Route::get('/{id}/invoice', [BookingController::class, 'invoice']);
        });

        // Payments
        Route::prefix('payments')->group(function () {
            Route::post('/stripe/intent', [PaymentController::class, 'stripeIntent']);
            Route::post('/stripe/confirm', [PaymentController::class, 'stripeConfirm']);
            Route::post('/razorpay/order', [PaymentController::class, 'razorpayOrder']);
            Route::post('/razorpay/verify', [PaymentController::class, 'razorpayVerify']);
        });

        // Reviews (write)
        Route::post('/reviews', [ReviewController::class, 'store']);
        Route::put('/reviews/{id}', [ReviewController::class, 'update']);
        Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);

        // Wishlist
        Route::get('/wishlist', [WishlistController::class, 'index']);
        Route::post('/wishlist/{serviceType}/{serviceId}', [WishlistController::class, 'toggle']);

        // Notifications
        Route::get('/notifications', [NotificationController::class, 'index']);
        Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead']);
        Route::post('/notifications/{id}/read', [NotificationController::class, 'markRead']);
        Route::post('/notifications/fcm-token', [NotificationController::class, 'updateFcmToken']);
    });
});

/*
|--------------------------------------------------------------------------
| Catch-all — 404 for undefined API routes
|--------------------------------------------------------------------------
*/

Route::fallback(function () {
    return response()->json([
        'success' => false,
        'message' => 'API endpoint not found.',
    ], 404);
});
