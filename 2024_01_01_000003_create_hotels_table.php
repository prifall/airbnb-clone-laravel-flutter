<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('location_id')->constrained()->cascadeOnDelete();

            // Identity
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            // Media
            $table->string('banner_image')->nullable();
            $table->json('gallery')->nullable();

            // Pricing
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->string('price_type')->default('night');  // night | week | month

            // Classification
            $table->unsignedTinyInteger('star_rating')->default(0);    // 1–5 stars
            $table->string('hotel_class')->nullable();                  // budget | mid | luxury

            // Location
            $table->string('address')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            // Amenities & policies (JSON arrays)
            $table->json('amenities')->nullable();
            $table->json('check_in_out')->nullable();  // {check_in: "14:00", check_out: "12:00"}
            $table->json('policies')->nullable();

            // Meta
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            // Status
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('view_count')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['location_id', 'is_active']);
            $table->index(['is_featured', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
