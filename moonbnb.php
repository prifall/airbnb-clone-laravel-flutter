<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Version
    |--------------------------------------------------------------------------
    */
    'app_version' => env('APP_VERSION', '1.2.0'),

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Prefix
    |--------------------------------------------------------------------------
    | The URL segment used to access the admin panel.
    | Example: "admin" => yoursite.com/admin
    */
    'admin_prefix' => env('ADMIN_PREFIX', 'admin'),

    /*
    |--------------------------------------------------------------------------
    | Supported Booking Modules
    |--------------------------------------------------------------------------
    | Enable or disable individual booking verticals.
    */
    'modules' => [
        'hotel'  => env('MODULE_HOTEL',  true),
        'space'  => env('MODULE_SPACE',  true),
        'tour'   => env('MODULE_TOUR',   true),
        'car'    => env('MODULE_CAR',    true),
        'event'  => env('MODULE_EVENT',  true),
        'boat'   => env('MODULE_BOAT',   true),
        'flight' => env('MODULE_FLIGHT', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Supported Locales
    |--------------------------------------------------------------------------
    */
    'locales' => [
        'en' => 'English',
        'ja' => 'Japanese',
    ],

    /*
    |--------------------------------------------------------------------------
    | Currencies
    |--------------------------------------------------------------------------
    */
    'currencies' => [
        'USD' => ['symbol' => '$',  'name' => 'US Dollar'],
        'EUR' => ['symbol' => '€',  'name' => 'Euro'],
        'JPY' => ['symbol' => '¥',  'name' => 'Japanese Yen'],
        'GBP' => ['symbol' => '£',  'name' => 'British Pound'],
    ],
    'default_currency' => env('DEFAULT_CURRENCY', 'USD'),

    /*
    |--------------------------------------------------------------------------
    | Google reCAPTCHA
    |--------------------------------------------------------------------------
    */
    'recaptcha' => [
        'site_key'   => env('RECAPTCHA_SITE_KEY'),
        'secret_key' => env('RECAPTCHA_SECRET_KEY'),
        'enabled'    => env('RECAPTCHA_ENABLED', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Map Provider
    |--------------------------------------------------------------------------
    */
    'map_provider' => env('MAP_PROVIDER', 'leaflet'),  // leaflet | google
    'google_maps_api_key' => env('GOOGLE_MAPS_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | File Upload
    |--------------------------------------------------------------------------
    */
    'upload' => [
        'max_size_mb'      => env('UPLOAD_MAX_MB', 10),
        'allowed_image_types' => ['jpg', 'jpeg', 'png', 'webp'],
        'image_quality'    => 85,
        'thumb_width'      => 400,
        'thumb_height'     => 300,
    ],

    /*
    |--------------------------------------------------------------------------
    | Booking Settings
    |--------------------------------------------------------------------------
    */
    'booking' => [
        'min_advance_hours'    => env('BOOKING_MIN_ADVANCE_HOURS', 1),
        'cancellation_hours'   => env('BOOKING_CANCELLATION_HOURS', 24),
        'service_fee_percent'  => env('BOOKING_SERVICE_FEE_PERCENT', 10),
        'tax_percent'          => env('BOOKING_TAX_PERCENT', 5),
        'auto_confirm'         => env('BOOKING_AUTO_CONFIRM', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Pagination Defaults
    |--------------------------------------------------------------------------
    */
    'per_page' => [
        'listings' => 12,
        'bookings' => 10,
        'reviews'  => 10,
        'news'     => 9,
        'api'      => 20,
    ],

    /*
    |--------------------------------------------------------------------------
    | Review Settings
    |--------------------------------------------------------------------------
    */
    'reviews' => [
        'require_booking'  => true,   // user must have a booking to leave a review
        'auto_approve'     => false,  // require admin approval before displaying
        'dimensions'       => ['cleanliness', 'accuracy', 'checkin', 'communication', 'location', 'value'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Social Login Providers
    |--------------------------------------------------------------------------
    */
    'social_providers' => [
        'google'   => env('SOCIAL_GOOGLE_ENABLED',   true),
        'facebook' => env('SOCIAL_FACEBOOK_ENABLED', true),
    ],

];
