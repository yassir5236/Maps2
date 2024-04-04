<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use Illuminate\Support\Facades\Validator;



class DestinationController extends Controller
{
   
    public function store(Request $request, $itinerary_id)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'lieu_logement' => 'required|string|max:255',
            'itineraire_id' => 'required|exists:itineraries,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

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
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'lieu_logement' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $destination = Destination::findOrFail($id);

        $destination->update($request->all());

        return response()->json($destination, 200);
    }


    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);

        $destination->delete();

        return response()->json(['message' => 'Destination deleted successfully'], 200);
    }

    
}
