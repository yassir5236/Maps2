<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use Illuminate\Support\Facades\Validator;



class DestinationController extends Controller
{
   
    public function store(Request $request, $itinerary_id)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'lieu_logement' => 'required|string|max:255',
            'itineraire_id' => 'required|exists:itineraries,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Création de la destination
        $destination = Destination::create([
            'nom' => $request->nom,
            'lieu_logement' => $request->lieu_logement,
            'itineraire_id' => $itinerary_id
        ]);

        return response()->json($destination, 201);
    }

    public function show($id)
    {
        $destination = Destination::findOrFail($id);
        return response()->json($destination, 200);
    }


    public function update(Request $request, $id)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'lieu_logement' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Recherche de la destination
        $destination = Destination::findOrFail($id);

        // Mise à jour de la destination
        $destination->update($request->all());

        return response()->json($destination, 200);
    }


    public function destroy($id)
    {
        // Recherche de la destination
        $destination = Destination::findOrFail($id);

        // Suppression de la destination
        $destination->delete();

        return response()->json(['message' => 'Destination deleted successfully'], 200);
    }
}
