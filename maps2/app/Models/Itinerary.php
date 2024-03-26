<?php

// app/Models/Itinerary.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'titre',
        'categorie',
        'duree',
        'image',
    ];
}
