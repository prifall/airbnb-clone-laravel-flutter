<div align="center">
 
<img src="https://moonbnb.goodcoderz.com/uploads/0000/7/2026/01/29/logo.png" alt="MoonBnb Logo" width="200"/>
 
# 🌙 MoonBnb — Airbnb Clone
 
### A full-stack travel & accommodation booking platform built with Laravel + Flutter.  
Replicates the core experience of Airbnb with extended support for Hotels, Spaces, Tours, Cars, Events, Boats & Flights.
 
[![Live Demo](https://img.shields.io/badge/Live%20Demo-moonbnb.goodcoderz.com-brightgreen?style=for-the-badge&logo=google-chrome)](https://moonbnb.goodcoderz.com/)
[![PHP](https://img.shields.io/badge/PHP-Laravel-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com/)
[![Flutter](https://img.shields.io/badge/Flutter-3.10.6-02569B?style=for-the-badge&logo=flutter)](https://flutter.dev/)
[![MySQL](https://img.shields.io/badge/Database-MySQL-4479A1?style=for-the-badge&logo=mysql)](https://www.mysql.com/)
 
</div>
 
---
 
## 📌 Table of Contents
 
- [Overview](#-overview)
- [Live Demo](#-live-demo)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Project Structure](#-project-structure)
- [Getting Started](#-getting-started)
  - [Prerequisites](#prerequisites)
  - [Backend Installation](#backend-installation-laravel)
  - [Mobile App Installation](#mobile-app-installation-flutter)
  - [Environment Configuration](#environment-configuration)
- [Modules](#-modules)
- [API Overview](#-api-overview)
- [Security](#-security)
- [Server Deployment](#-server-deployment)
- [Screenshots](#-screenshots)
- [Contributing](#-contributing)
 
---
 
## 🌍 Overview
 
**MoonBnb** is a production-ready Airbnb-style clone that goes beyond just property rentals. It is a full-featured travel marketplace supporting multiple booking verticals — from hotels and vacation spaces to guided tours, car rentals, boat charters, and events.
 
The platform ships with:
- A **PHP/Laravel** web application with multiple homepage layouts
- A **Flutter** mobile app for iOS and Android
- A **MySQL** relational database
- **Google reCAPTCHA** for spam and bot protection
- **Multi-language support** (English, Japanese and extensible)
- A **vendor/host dashboard** for listing management
 
---
 
## 🔗 Live Demo
 
> **Web:** [https://moonbnb.goodcoderz.com/](https://moonbnb.goodcoderz.com/)
 
| Role | Email | Password |
|------|-------|----------|
| Admin | admin@demo.com | password |
| Vendor/Host | vendor@demo.com | password |
| Guest | guest@demo.com | password |
 
---
 
## ✨ Features
 
### 🏠 Core Booking Verticals
 
| Module | Features |
|--------|----------|
| **Hotels** | List view, Map view, Detail page, Room types, Availability calendar |
| **Spaces** | Vacation rentals with sq. meters, bedrooms, bathrooms, guests capacity |
| **Tours** | Duration, group size, discount pricing, guide info |
| **Car Rentals** | Transmission, seats, doors, daily pricing |
| **Events** | Start time, duration, capacity, ticketing |
| **Boats** | Crew, cabins, length, speed, charter pricing |
| **Flights** | One-way/return search, cabin class (Economy, Business, First Class, Premium, VIP) |
 
### 🗺️ Search & Discovery
 
- Smart search with location autocomplete
- Date range picker (Check-in / Check-out)
- Guest/room/traveler count selectors
- **Dual layout**: List view + Interactive Map view for all verticals
- Location detail pages (e.g., `/location/paris`)
- Destination cards with live listing counts
 
### 👤 User & Vendor Management
 
- User registration, login, forgot password
- Vendor/Host onboarding flow (`/page/become-a-vendor`)
- User profile and booking management
- Review & rating system (Cleanliness, Accuracy, Check-in, Communication)
- Guest/host messaging
 
### 🌐 Multi-Tenant & Content Features
 
- Multiple homepage layouts (Default, v2, Hotel, Tour Agency, Tour, Space, Car)
- Blog/News system with categories and SEO slugs
- Pricing/subscription plans (`/plan`)
- Newsletter subscription
- Contact page with form
- Multi-language support (English 🇺🇸 / Japanese 🇯🇵)
 
### 🔒 Security & Payments
 
- Google reCAPTCHA on all public forms
- Secure payment gateway integration
- 100% secure payment badge support (Visa, Mastercard, etc.)
- CSRF protection via Laravel
- Authenticated API with token-based sessions
 
---
 
## 🛠️ Tech Stack
 
| Layer | Technology |
|-------|------------|
| **Backend Framework** | Laravel (PHP) |
| **Web Platform** | PHP / Laravel Blade + REST API |
| **Database** | MySQL |
| **Mobile App** | Flutter 3.10.6 (iOS & Android) |
| **Security** | Google reCAPTCHA |
| **Server Compatibility** | AWS, DigitalOcean, Vultr, Private VPS |
 
### Additional Libraries & Tools
 
**Backend (Laravel)**
```
laravel/framework
laravel/sanctum          # API authentication
laravel/telescope        # Debugging (dev only)
spatie/laravel-permission # Role & permission management
intervention/image       # Image upload & resizing
laravel/socialite        # OAuth (Google, Facebook)
maatwebsite/excel        # Excel export
barryvdh/laravel-dompdf  # PDF generation
```
 
**Frontend (Blade/Web)**
```
Bootstrap 5
jQuery
Select2
Flatpickr (date picker)
Leaflet.js / Google Maps  (map view)
SweetAlert2
Swiper.js
```
 
**Mobile (Flutter 3.10.6)**
```
dio                      # HTTP client
flutter_bloc             # State management
go_router                # Navigation
cached_network_image     # Image caching
flutter_secure_storage   # Secure token storage
google_maps_flutter      # Map integration
table_calendar           # Booking calendar
image_picker             # Upload photos
flutter_stripe / razorpay # Payment
```
 
---
 
## 📁 Project Structure
 
```
moonbnb/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/           # Flutter API endpoints
│   │   │   ├── Auth/          # Login, Register, Password reset
│   │   │   ├── Admin/         # Admin panel controllers
│   │   │   ├── Vendor/        # Vendor/host controllers
│   │   │   └── Frontend/      # Public-facing web controllers
│   │   └── Middleware/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Hotel.php
│   │   ├── Space.php
│   │   ├── Tour.php
│   │   ├── Car.php
│   │   ├── Event.php
│   │   ├── Boat.php
│   │   ├── Flight.php
│   │   ├── Booking.php
│   │   ├── Review.php
│   │   └── Location.php
│   └── Services/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   ├── frontend/
│   │   ├── admin/
│   │   └── vendor/
│   ├── lang/
│   │   ├── en/
│   │   └── ja/
│   └── assets/
├── routes/
│   ├── web.php
│   └── api.php
├── mobile/                    # Flutter app
│   ├── lib/
│   │   ├── screens/
│   │   ├── widgets/
│   │   ├── blocs/
│   │   ├── models/
│   │   ├── services/
│   │   └── main.dart
│   └── pubspec.yaml
├── public/
├── storage/
├── .env.example
└── composer.json
```
 
---
 
## 🚀 Getting Started
 
### Prerequisites
 
- PHP >= 8.1
- Composer >= 2.x
- MySQL >= 8.0
- Node.js >= 18.x & NPM
- Flutter SDK 3.10.6
- Android Studio / Xcode (for mobile)
 
---
 
### Backend Installation (Laravel)
 
```bash
# 1. Clone the repository
git clone https://github.com/your-username/moonbnb.git
cd moonbnb
 
# 2. Install PHP dependencies
composer install
 
# 3. Install frontend assets
npm install && npm run build
 
# 4. Copy and configure environment
cp .env.example .env
 
# 5. Generate application key
php artisan key:generate
 
# 6. Run database migrations and seed demo data
php artisan migrate --seed
 
# 7. Link storage for file uploads
php artisan storage:link
 
# 8. Start the development server
php artisan serve
```
 
The web app will be available at: `http://localhost:8000`
 
---
 
### Mobile App Installation (Flutter)
 
```bash
# Navigate to the Flutter app directory
cd mobile
 
# Get Flutter dependencies
flutter pub get
 
# Run on Android emulator or connected device
flutter run
 
# Build release APK
flutter build apk --release
 
# Build release iOS
flutter build ios --release
```
 
---
 
### Environment Configuration
 
Edit your `.env` file with the following keys:
 
```env
# Application
APP_NAME=MoonBnb
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000
 
# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=moonbnb
DB_USERNAME=root
DB_PASSWORD=
 
# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_FROM_ADDRESS=contact@moonbnb.test
MAIL_FROM_NAME="${APP_NAME}"
 
# Google reCAPTCHA
RECAPTCHA_SITE_KEY=
RECAPTCHA_SECRET_KEY=
 
# Google Maps (for map views)
GOOGLE_MAPS_API_KEY=
 
# Social Login (optional)
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
FACEBOOK_CLIENT_ID=
FACEBOOK_CLIENT_SECRET=
 
# Payment Gateway (choose one or more)
STRIPE_KEY=
STRIPE_SECRET=
RAZORPAY_KEY=
RAZORPAY_SECRET=
 
# File Storage
FILESYSTEM_DISK=public
```
 
---
 
## 📦 Modules
 
### 🏨 Hotels
- Room-based pricing with per-night rates
- Star ratings and guest review scores
- Check-in/check-out availability
- Featured listing support
 
### 🏡 Spaces (Vacation Rentals)
- Bedrooms / Bathrooms / Guests / Area (m²)
- Discount / sale price support
- Property type classification
- Calendar-based availability
 
### 🧭 Tours
- Duration display (e.g. `5H`, `2 Days`)
- Discount percentage badges
- Group capacity configuration
- Category & highlight tags
 
### 🚗 Cars
- Transmission type (Auto/Manual)
- Seat and door configuration
- Daily rental pricing with optional discounts
 
### 🎉 Events
- Timed start with duration
- Capacity & ticket management
- Venue location with map
 
### ⛵ Boats
- Crew, cabins, length (meters), speed (km/h)
- Charter pricing
 
### ✈️ Flights
- Origin/destination + departure/return dates
- Cabin class segmentation: Economy, Premium, Business, First Class, VIP
 
---
 
## 🔌 API Overview
 
The backend exposes a RESTful API consumed by the Flutter mobile app.
 
```
Base URL: /api/v1/
 
Authentication:
  POST   /auth/login
  POST   /auth/register
  POST   /auth/forgot-password
  POST   /auth/logout
 
Listings:
  GET    /hotels
  GET    /hotels/{slug}
  GET    /spaces
  GET    /spaces/{slug}
  GET    /tours
  GET    /cars
  GET    /events
  GET    /boats
  GET    /flights
 
Bookings:
  GET    /bookings
  POST   /bookings
  GET    /bookings/{id}
  DELETE /bookings/{id}
 
Reviews:
  POST   /reviews
  GET    /reviews/{service_type}/{id}
 
Locations:
  GET    /locations
  GET    /locations/{slug}
 
User:
  GET    /profile
  PUT    /profile
  GET    /wishlist
  POST   /wishlist/{id}
```
 
All protected routes require: `Authorization: Bearer {token}`
 
---
 
## 🔒 Security
 
| Feature | Implementation |
|---------|---------------|
| Bot & spam protection | Google reCAPTCHA v2/v3 on all public forms |
| CSRF Protection | Laravel built-in CSRF middleware |
| API Authentication | Laravel Sanctum (token-based) |
| Input Validation | Laravel FormRequest validation |
| SQL Injection | Eloquent ORM with parameterized queries |
| XSS Protection | Blade templating auto-escaping |
| Role & Permissions | Spatie Laravel Permission package |
| Password Hashing | bcrypt (Laravel default) |
 
---
 
## ☁️ Server Deployment
 
MoonBnb is compatible with any standard LAMP/LEMP stack host.
 
### Supported Environments
 
| Provider | Type | Notes |
|----------|------|-------|
| **AWS** | Cloud | EC2 + RDS + S3 recommended |
| **DigitalOcean** | Cloud | App Platform or Droplet |
| **Vultr** | Cloud VPS | 2GB RAM minimum recommended |
| **Private VPS** | Self-hosted | Ubuntu 22.04 LTS recommended |
 
### Quick Deployment (Ubuntu VPS)
 
```bash
# Install dependencies
sudo apt update
sudo apt install php8.2 php8.2-{cli,fpm,mbstring,xml,bcmath,mysql,curl,zip,gd} \
    nginx mysql-server composer nodejs npm -y
 
# Configure Nginx
sudo nano /etc/nginx/sites-available/moonbnb
 
# Set file permissions
sudo chown -R www-data:www-data /var/www/moonbnb
sudo chmod -R 775 /var/www/moonbnb/storage
 
# Run migrations
php artisan migrate --force --seed
 
# Set up queue worker (optional, for emails/notifications)
php artisan queue:work --daemon
```
 
> For production, set `APP_ENV=production` and `APP_DEBUG=false` in your `.env`.
 
---
 
## 📱 Screenshots
 
| Home Page | Hotel Listing | Space Detail |
|-----------|--------------|--------------|
| *(add screenshot)* | *(add screenshot)* | *(add screenshot)* |
 
| Map View | Tour Booking | Mobile App |
|----------|-------------|------------|
| *(add screenshot)* | *(add screenshot)* | *(add screenshot)* |
 
> 💡 Replace placeholders with real screenshots from [https://moonbnb.goodcoderz.com/](https://moonbnb.goodcoderz.com/)
 
---
 
## 🤝 Contributing
 
Contributions, issues and feature requests are welcome!
 
```bash
# Fork the repo and create your branch
git checkout -b feature/your-feature-name
 
# Make your changes and commit
git commit -m "feat: add your feature description"
 
# Push and open a Pull Request
git push origin feature/your-feature-name
```
 
Please follow [Conventional Commits](https://www.conventionalcommits.org/) for commit messages.
 
---
