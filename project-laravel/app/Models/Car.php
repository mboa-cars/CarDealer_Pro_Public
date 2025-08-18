<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand', 'model', 'year', 'price', 'description', 'image', 'type', 'city', 'mileage', 'state',
        'vin', 'fuel_type', 'address', 'phone', 'user_id', 'features', 'video_url', 'is_published',
    ];

    protected $casts = [
        'features' => 'array',
        'price' => 'decimal:2',
        'mileage' => 'integer',
        'year' => 'integer',
    ];

    public function images()
    {
        return $this->hasMany(CarImage::class)->orderBy('position');
    }

    public function favorites()
    {
        return $this->hasMany(\App\Models\Favorite::class);
    }

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorites', 'car_id', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getMainImageAttribute()
    {
        // D'abord, essayer de récupérer la première image de la relation
        $mainImage = $this->images()->first();
        if ($mainImage) {
            return $mainImage->image_url;
        }

        // Si pas d'image dans la relation, utiliser le champ image direct
        if ($this->image) {
            if (str_starts_with($this->image, 'http')) {
                return $this->image;
            }

            // Pour les images stockées dans storage/app/public
            return asset('storage/'.$this->image);
        }

        // Image par défaut si aucune image n'est trouvée
        return asset('images/car-png-39071.png');
    }

    public function getFormattedPriceAttribute()
    {
        return '$'.number_format($this->price, 0, '', ',');
    }

    public function getFormattedMileageAttribute()
    {
        return number_format($this->mileage, 0, '', ',').' miles';
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
