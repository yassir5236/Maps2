<?php
// app/Models/UserItinerary.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserItinerary extends Model
{
    use HasFactory;

    protected $table = 'user_itinerary';

    protected $fillable = [
        'user_id',
        'itinerary_id',
    ];
}

