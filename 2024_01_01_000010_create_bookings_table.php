<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();   // e.g. MBK-2026-00123

            // Who booked
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Polymorphic: hotel | space | tour | car | event | boat | flight
            $table->morphs('bookable');

            // Dates
            $table->dateTime('check_in')->nullable();
            $table->dateTime('check_out')->nullable();

            // Guests / passengers
            $table->unsignedSmallInteger('adults')->default(1);
            $table->unsignedSmallInteger('children')->default(0);
            $table->unsignedSmallInteger('infants')->default(0);
            $table->unsignedSmallInteger('rooms')->default(1);

            // Flight-specific cabin class
            $table->string('cabin_class')->nullable();   // economy | premium | business | first | vip

            // Pricing breakdown
            $table->decimal('base_price', 10, 2)->default(0);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('tax_amount', 10, 2)->default(0);
            $table->decimal('service_fee', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->string('currency', 3)->default('USD');

            // Payment
            $table->string('payment_method')->nullable();    // stripe | razorpay | paypal | cash
            $table->string('payment_status')->default('pending'); // pending | paid | failed | refunded
            $table->string('payment_intent_id')->nullable(); // Stripe PaymentIntent ID
            $table->string('transaction_id')->nullable();

            // Booking status
            $table->string('status')->default('pending');    // pending | confirmed | cancelled | completed | no_show

            // Extra
            $table->text('special_requests')->nullable();
            $table->json('meta')->nullable();                // flight seats, car pickup location, etc.

            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id', 'status']);
            $table->index(['bookable_type', 'bookable_id']);
            $table->index('booking_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
