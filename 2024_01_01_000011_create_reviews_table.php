<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('booking_id')->nullable()->constrained()->nullOnDelete();

            // Polymorphic: points to hotel | space | tour | car | event | boat
            $table->morphs('reviewable');

            // Overall rating
            $table->decimal('rating', 3, 1)->default(5.0);  // 0.0 – 5.0

            // Dimension ratings (Airbnb-style)
            $table->decimal('rating_cleanliness', 3, 1)->nullable();
            $table->decimal('rating_accuracy', 3, 1)->nullable();
            $table->decimal('rating_checkin', 3, 1)->nullable();
            $table->decimal('rating_communication', 3, 1)->nullable();
            $table->decimal('rating_location', 3, 1)->nullable();
            $table->decimal('rating_value', 3, 1)->nullable();

            // Content
            $table->string('title')->nullable();
            $table->text('content')->nullable();

            // Status
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_featured')->default(false);

            // Vendor reply
            $table->text('vendor_reply')->nullable();
            $table->timestamp('vendor_replied_at')->nullable();

            $table->timestamps();

            $table->index(['reviewable_type', 'reviewable_id', 'is_approved']);
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
