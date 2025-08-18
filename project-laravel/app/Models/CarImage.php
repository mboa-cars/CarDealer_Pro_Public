<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarImage extends Model
{
    protected $fillable = [
        'car_id',
        'image',
        'position',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function getImageUrlAttribute()
    {
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        // Vérifier si l'image existe dans storage/app/public (où les nouvelles images sont stockées)
        if (file_exists(storage_path('app/public/'.$this->image))) {
            return asset('storage/'.$this->image);
        }

        // Vérifier si l'image existe dans public/images
        if (file_exists(public_path('images/'.$this->image))) {
            return asset('images/'.$this->image);
        }

        // Si aucune image n'est trouvée, retourner null pour ne pas afficher d'image par défaut
        return null;
    }
}
