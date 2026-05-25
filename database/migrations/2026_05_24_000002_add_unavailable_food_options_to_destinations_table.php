<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->text('unavailable_restaurants')->nullable()->after('unavailable_hotels');
            $table->text('unavailable_menus')->nullable()->after('unavailable_restaurants');
        });
    }

    public function down(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn(['unavailable_restaurants', 'unavailable_menus']);
        });
    }
};
