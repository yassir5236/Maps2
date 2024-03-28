<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use Illuminate\Support\Facades\Auth;

class VisitsController extends Controller
{
    // Méthode pour créer une visite
    public function store(Request $request)
    {
        // Validation des données de la requête
        $request->validate([
            'itinerary_id' => 'required|exists:itineraries,id',
        ]);

        // Création de la visite
        $visit = Visit::create([
            'itinerary_id' => $request->itinerary_id,
            'user_id' => Auth::id(), // Ajout de l'ID de l'utilisateur authentifié
        ]);

        // Réponse de succès
        return response()->json(['message' => 'Visite créée avec succès', 'visit' => $visit], 201);
    }
}
