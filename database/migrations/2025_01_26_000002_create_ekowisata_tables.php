<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('province_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('category')->default('Nature'); // Marine, Mountain, Wildlife, Heritage, Beach, Lake, Nature
            $table->decimal('price', 12, 2);
            $table->integer('quota_per_day')->default(50);
            $table->string('location');
            $table->string('photo')->nullable();
            $table->decimal('rating', 2, 1)->default(4.5);
            $table->integer('bookings_count')->default(0);
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });

        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('destination_id')->constrained()->onDelete('cascade');
            $table->string('duration');
            $table->decimal('price', 15, 2);
            $table->integer('max_participants')->default(20);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('bookings_count')->default(0);
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });

        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('invoice_code')->unique();
            $table->decimal('total_amount', 12, 2);
            $table->enum('status', ['UNPAID', 'PAID', 'EXPIRED', 'CANCELLED'])->default('UNPAID');
            $table->timestamp('due_date');
            $table->string('payment_proof')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('destination_id')->constrained()->onDelete('cascade');
            $table->foreignId('package_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('invoice_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone')->nullable();
            $table->string('institution')->nullable();
            $table->date('visit_date');
            $table->integer('participants')->default(1);
            $table->decimal('total_amount', 15, 2);
            $table->enum('status', ['Pending', 'Confirmed', 'Cancelled'])->default('Pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('packages');
        Schema::dropIfExists('destinations');
    }
};
