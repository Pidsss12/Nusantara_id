<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('invoice_code')->nullable()->unique()->after('booking_code');
            $table->enum('payment_status', ['Unpaid', 'Pending', 'Paid', 'Refunded'])->default('Unpaid')->after('status');
            $table->timestamp('invoice_date')->nullable()->after('payment_status');
            $table->timestamp('payment_date')->nullable()->after('invoice_date');
            $table->string('payment_method')->nullable()->after('payment_date');
            $table->text('payment_proof')->nullable()->after('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'invoice_code', 
                'payment_status', 
                'invoice_date', 
                'payment_date', 
                'payment_method',
                'payment_proof'
            ]);
        });
    }
};
