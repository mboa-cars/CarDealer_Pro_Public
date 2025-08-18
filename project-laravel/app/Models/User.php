<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'is_admin',
        'plan',
        'plan_started_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'plan_started_at' => 'datetime',
        ];
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Obtenir le nombre maximum de voitures selon le plan.
     */
    public function getCarLimitAttribute(): ?int
    {
        $plans = config('plans');
        $planKey = $this->plan ?? 'standard';
        $limit = $plans[$planKey]['car_limit'] ?? $plans['standard']['car_limit'];

        return $limit === null ? null : (int) $limit;
    }

    /**
     * Savoir si l'utilisateur peut publier une nouvelle voiture selon son plan.
     */
    public function canPublishMoreCars(): bool
    {
        if ($this->isAdmin()) {
            return true;
        }
        $limit = $this->car_limit;
        if ($limit === null) {
            return true; // illimité
        }
        $current = $this->cars()->count();

        return $current < $limit;
    }

    /**
     * Changer de plan.
     */
    public function switchPlan(string $plan): void
    {
        $this->update([
            'plan' => $plan,
            'plan_started_at' => now(),
        ]);
    }

    public function carsFavorited()
    {
        return $this->belongsToMany(Car::class, 'favorites', 'user_id', 'car_id');
    }

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    /**
     * Vérifier si l'utilisateur est administrateur
     */
    public function isAdmin(): bool
    {
        return $this->is_admin === true;
    }

    /**
     * Définir l'utilisateur comme administrateur
     */
    public function makeAdmin(): void
    {
        $this->update(['is_admin' => true]);
    }

    /**
     * Retirer les droits d'administrateur
     */
    public function removeAdmin(): void
    {
        $this->update(['is_admin' => false]);
    }

    /**
     * Relation : Abonnements de cet utilisateur (il suit d'autres vendeurs)
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'subscriber_id');
    }

    /**
     * Relation : Abonnés de cet utilisateur (d'autres utilisateurs le suivent)
     */
    public function subscribers()
    {
        return $this->hasMany(Subscription::class, 'seller_id');
    }

    /**
     * Relation : Les vendeurs que cet utilisateur suit
     */
    public function following()
    {
        return $this->belongsToMany(User::class, 'subscriptions', 'subscriber_id', 'seller_id')
            ->wherePivot('is_active', true);
    }

    /**
     * Relation : Les utilisateurs qui suivent ce vendeur
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'subscriptions', 'seller_id', 'subscriber_id')
            ->wherePivot('is_active', true);
    }

    /**
     * Vérifier si cet utilisateur suit un vendeur spécifique
     */
    public function isFollowing($sellerId)
    {
        return Subscription::isSubscribed($this->id, $sellerId);
    }

    /**
     * Obtenir le nombre d'abonnés de ce vendeur
     */
    public function getFollowersCountAttribute()
    {
        return $this->subscribers()->where('is_active', true)->count();
    }

    /**
     * Obtenir le nombre d'abonnements de cet utilisateur
     */
    public function getFollowingCountAttribute()
    {
        return $this->subscriptions()->where('is_active', true)->count();
    }

    /**
     * Get reviews written by this user
     */
    public function reviewsWritten()
    {
        return $this->hasMany(SellerReview::class, 'reviewer_id');
    }

    /**
     * Get reviews received as a seller
     */
    public function reviewsReceived()
    {
        return $this->hasMany(SellerReview::class, 'seller_id');
    }

    /**
     * Get average rating as a seller
     */
    public function getAverageRatingAttribute()
    {
        $reviews = $this->reviewsReceived()->verified();
        if ($reviews->count() === 0) {
            return null;
        }

        return round($reviews->avg('rating'), 1);
    }

    /**
     * Get total number of reviews as a seller
     */
    public function getReviewsCountAttribute()
    {
        return $this->reviewsReceived()->verified()->count();
    }
}
