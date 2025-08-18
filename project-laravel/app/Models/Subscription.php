<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscriber_id',
        'seller_id',
        'is_active',
        'subscribed_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'subscribed_at' => 'datetime',
    ];

    /**
     * Relation : L'abonné (utilisateur qui s'abonne)
     */
    public function subscriber()
    {
        return $this->belongsTo(User::class, 'subscriber_id');
    }

    /**
     * Relation : Le vendeur suivi
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    /**
     * Scope pour les abonnements actifs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Vérifier si un utilisateur est abonné à un vendeur
     */
    public static function isSubscribed($subscriberId, $sellerId)
    {
        return static::where('subscriber_id', $subscriberId)
            ->where('seller_id', $sellerId)
            ->where('is_active', true)
            ->exists();
    }

    /**
     * Créer ou réactiver un abonnement
     */
    public static function subscribe($subscriberId, $sellerId)
    {
        return static::updateOrCreate(
            [
                'subscriber_id' => $subscriberId,
                'seller_id' => $sellerId,
            ],
            [
                'is_active' => true,
                'subscribed_at' => now(),
            ]
        );
    }

    /**
     * Désabonner (désactiver l'abonnement)
     */
    public static function unsubscribe($subscriberId, $sellerId)
    {
        return static::where('subscriber_id', $subscriberId)
            ->where('seller_id', $sellerId)
            ->update(['is_active' => false]);
    }
}
