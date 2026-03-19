<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\HotelController;
use App\Http\Controllers\Frontend\SpaceController;
use App\Http\Controllers\Frontend\TourController;
use App\Http\Controllers\Frontend\CarController;
use App\Http\Controllers\Frontend\EventController;
use App\Http\Controllers\Frontend\BoatController;
use App\Http\Controllers\Frontend\FlightController;
use App\Http\Controllers\Frontend\LocationController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\Frontend\PlanController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Vendor\VendorDashboardController;
use App\Http\Controllers\Vendor\VendorListingController;
use App\Http\Controllers\Admin\AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// ── Home & Static Pages ─────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/page/{slug}', [HomeController::class, 'page'])->name('page');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/plan', [PlanController::class, 'index'])->name('plan');

// ── Hotels ──────────────────────────────────────────────────────────────
Route::prefix('hotel')->name('hotel.')->group(function () {
    Route::get('/', [HotelController::class, 'index'])->name('index');
    Route::get('/{slug}', [HotelController::class, 'show'])->name('show');
});

// ── Spaces ──────────────────────────────────────────────────────────────
Route::prefix('space')->name('space.')->group(function () {
    Route::get('/', [SpaceController::class, 'index'])->name('index');
    Route::get('/{slug}', [SpaceController::class, 'show'])->name('show');
});

// ── Tours ───────────────────────────────────────────────────────────────
Route::prefix('tour')->name('tour.')->group(function () {
    Route::get('/', [TourController::class, 'index'])->name('index');
    Route::get('/{slug}', [TourController::class, 'show'])->name('show');
});

// ── Cars ────────────────────────────────────────────────────────────────
Route::prefix('car')->name('car.')->group(function () {
    Route::get('/', [CarController::class, 'index'])->name('index');
    Route::get('/{slug}', [CarController::class, 'show'])->name('show');
});

// ── Events ──────────────────────────────────────────────────────────────
Route::prefix('event')->name('event.')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::get('/{slug}', [EventController::class, 'show'])->name('show');
});

// ── Boats ───────────────────────────────────────────────────────────────
Route::prefix('boat')->name('boat.')->group(function () {
    Route::get('/', [BoatController::class, 'index'])->name('index');
    Route::get('/{slug}', [BoatController::class, 'show'])->name('show');
});

// ── Flights ─────────────────────────────────────────────────────────────
Route::get('/flight', [FlightController::class, 'index'])->name('flight.index');
Route::get('/flight/search', [FlightController::class, 'search'])->name('flight.search');

// ── Locations ───────────────────────────────────────────────────────────
Route::get('/location/{slug}', [LocationController::class, 'show'])->name('location.show');

// ── News / Blog ─────────────────────────────────────────────────────────
Route::prefix('news')->name('news.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/category/{slug}', [NewsController::class, 'category'])->name('category');
    Route::get('/{slug}', [NewsController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');

    // Social OAuth
    Route::get('/auth/{provider}', [SocialController::class, 'redirect'])->name('social.redirect');
    Route::get('/auth/{provider}/callback', [SocialController::class, 'callback'])->name('social.callback');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Bookings
    Route::prefix('bookings')->name('booking.')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->name('index');
        Route::post('/', [BookingController::class, 'store'])->name('store');
        Route::get('/{id}', [BookingController::class, 'show'])->name('show');
        Route::post('/{id}/cancel', [BookingController::class, 'cancel'])->name('cancel');
        Route::get('/{id}/invoice', [BookingController::class, 'invoice'])->name('invoice');
    });

    // Reviews
    Route::post('/reviews', [ReviewController::class, 'store'])->name('review.store');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/{type}/{id}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    // Newsletter
    Route::post('/newsletter/subscribe', [HomeController::class, 'newsletterSubscribe'])->name('newsletter.subscribe');
});

/*
|--------------------------------------------------------------------------
| Vendor Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    Route::get('/', [VendorDashboardController::class, 'index'])->name('dashboard');
    Route::get('/listings', [VendorListingController::class, 'index'])->name('listings');
    Route::get('/listings/create/{type}', [VendorListingController::class, 'create'])->name('listings.create');
    Route::post('/listings/{type}', [VendorListingController::class, 'store'])->name('listings.store');
    Route::get('/listings/{type}/{id}/edit', [VendorListingController::class, 'edit'])->name('listings.edit');
    Route::put('/listings/{type}/{id}', [VendorListingController::class, 'update'])->name('listings.update');
    Route::delete('/listings/{type}/{id}', [VendorListingController::class, 'destroy'])->name('listings.destroy');
    Route::get('/bookings', [VendorDashboardController::class, 'bookings'])->name('bookings');
    Route::get('/earnings', [VendorDashboardController::class, 'earnings'])->name('earnings');
    Route::get('/reviews', [VendorDashboardController::class, 'reviews'])->name('reviews');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix(config('moonbnb.admin_prefix', 'admin'))
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        // Full admin CRUD routes are registered via AdminRouteServiceProvider
    });

/*
|--------------------------------------------------------------------------
| Language Switch
|--------------------------------------------------------------------------
*/

Route::get('/set-lang/{locale}', function (string $locale) {
    $supported = ['en', 'ja'];
    if (in_array($locale, $supported)) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');
