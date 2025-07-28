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
            $table->index('brand');
            $table->index('model');
            $table->index('type');
            $table->index('year');
            $table->index('price');
            $table->index('city');
            $table->index('state');
            $table->index('mileage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropIndex(['brand']);
            $table->dropIndex(['model']);
            $table->dropIndex(['type']);
            $table->dropIndex(['year']);
            $table->dropIndex(['price']);
            $table->dropIndex(['city']);
            $table->dropIndex(['state']);
            $table->dropIndex(['mileage']);
        });
    }
};
