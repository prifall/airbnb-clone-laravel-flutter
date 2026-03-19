import 'package:flutter/material.dart';

/// Central configuration for the MoonBnb Flutter app.
/// Adjust baseUrl and other constants per environment.
class AppConfig {
  AppConfig._();

  // ── App identity ─────────────────────────────────────────────────
  static const String appName    = 'MoonBnb';
  static const String appVersion = '1.2.0';
  static const int    buildNumber = 12;

  // ── API base URL ─────────────────────────────────────────────────
  // Change this to your production URL before releasing.
  static const String baseUrl = String.fromEnvironment(
    'API_BASE_URL',
    defaultValue: 'https://moonbnb.goodcoderz.com/api/v1',
  );

  // ── HTTP timeouts (seconds) ───────────────────────────────────────
  static const int connectTimeout = 15;
  static const int receiveTimeout = 30;
  static const int sendTimeout    = 30;

  // ── Pagination ────────────────────────────────────────────────────
  static const int defaultPageSize = 20;

  // ── Map defaults ──────────────────────────────────────────────────
  static const double defaultLat  = 48.8566;   // Paris
  static const double defaultLng  = 2.3522;
  static const double defaultZoom = 12.0;

  // ── Supported booking modules ─────────────────────────────────────
  static const List<String> bookingModules = [
    'hotel',
    'space',
    'tour',
    'car',
    'event',
    'boat',
    'flight',
  ];

  // ── Localization ──────────────────────────────────────────────────
  static const List<Locale> supportedLocales = [
    Locale('en', 'US'),
    Locale('ja', 'JP'),
  ];
  static const Locale fallbackLocale = Locale('en', 'US');

  // ── Hive box names ────────────────────────────────────────────────
  static const String userBox      = 'user_box';
  static const String settingsBox  = 'settings_box';
  static const String cacheBox     = 'cache_box';

  // ── Secure storage keys ───────────────────────────────────────────
  static const String tokenKey     = 'auth_token';
  static const String userDataKey  = 'user_data';

  // ── Cache durations ───────────────────────────────────────────────
  static const Duration listCacheDuration   = Duration(minutes: 10);
  static const Duration detailCacheDuration = Duration(minutes: 30);
  static const Duration configCacheDuration = Duration(hours: 6);

  // ── Review rating dimensions ──────────────────────────────────────
  static const List<String> ratingDimensions = [
    'cleanliness',
    'accuracy',
    'checkin',
    'communication',
    'location',
    'value',
  ];

  // ── Cabin classes for flights ─────────────────────────────────────
  static const List<String> cabinClasses = [
    'economy',
    'premium',
    'business',
    'first',
    'vip',
  ];
}
