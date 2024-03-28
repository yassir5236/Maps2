<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = ['itinerary_id', 'user_id'];

    // Relation avec l'itinéraire
    public function itinerary()
    {
        return $this->belongsTo(Itinerary::class);
    }

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

