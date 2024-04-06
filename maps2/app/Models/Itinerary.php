<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'titre', // Modifiez cette colonne pour correspondre au nom dans votre formulaire HTML
        'categorie',
        'duree',
        'image',
    ];

    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }
}
