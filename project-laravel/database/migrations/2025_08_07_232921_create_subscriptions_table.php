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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscriber_id')->constrained('users')->onDelete('cascade'); // L'utilisateur qui s'abonne
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade'); // Le vendeur suivi
            $table->boolean('is_active')->default(true); // Statut de l'abonnement
            $table->timestamp('subscribed_at')->useCurrent(); // Date d'abonnement
            $table->timestamps();
            
            // Index unique pour éviter les doublons
            $table->unique(['subscriber_id', 'seller_id']);
            
            // Index pour les requêtes
            $table->index(['subscriber_id', 'is_active']);
            $table->index(['seller_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
