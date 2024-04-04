<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use Illuminate\Support\Facades\Auth;

class VisitsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'itinerary_id' => 'required|exists:itineraries,id',
        ]);

        $visit = Visit::create([
            'itinerary_id' => $request->itinerary_id,
            'user_id' => Auth::id(), 
        ]);

        return response()->json(['message' => 'Visite créée avec succès', 'visit' => $visit], 201);
    }
}
