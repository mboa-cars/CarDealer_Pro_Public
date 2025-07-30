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
        Schema::table('cars', function (Blueprint $table) {
            $table->string('vin')->nullable()->after('mileage');
            $table->string('fuel_type')->nullable()->after('vin');
            $table->string('address')->nullable()->after('fuel_type');
            $table->string('phone')->nullable()->after('address');
            $table->foreignId('user_id')->nullable()->after('phone')->constrained()->onDelete('cascade');
            $table->json('features')->nullable()->after('user_id');
            $table->string('video_url')->nullable()->after('features');
            $table->boolean('is_published')->default(true)->after('video_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn([
                'vin', 'fuel_type', 'address', 'phone', 'user_id', 
                'features', 'video_url', 'is_published'
            ]);
        });
    }
}; 