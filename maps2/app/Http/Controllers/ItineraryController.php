<?php




namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\Itinerary;

class ItineraryController extends Controller
{
 
    public function store(Request $request)
    {
        $request->validate([

            'titre' => 'required|string',
            'categorie' => 'required|string',
            'duree' => 'required|string',
            'image' => 'required|string',
            // Add other necessary fields here
        ]);

        // Create a new itinerary
        $itineraire = new Itinerary();
        $itineraire->titre = $request->titre;
        $itineraire->categorie = $request->categorie;
        $itineraire->duree = $request->duree;
        $itineraire->image = $request->image;
        $itineraire->user_id=auth()->user()->id;
        // Assign other necessary fields here
        $itineraire->save();

        return response()->json(['message' => 'Itinéraire créé avec succès'], 201);
    }


    public function show($id)
    {
        $itineraire = Itinerary::find($id);
        if (!$itineraire) {
            return response()->json(['message' => 'Itinéraire non trouvé'], 404);
        }
        return response()->json($itineraire, 200);
    }

  
    public function update(Request $request, $id)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'duree' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Recherche de l'itinéraire
        $itinerary = Itinerary::findOrFail($id);

        // Vérification que l'utilisateur connecté est le propriétaire de l'itinéraire
        if ($itinerary->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Mise à jour de l'itinéraire
        $itinerary->update($request->all());

        return response()->json($itinerary, 200);
    }

    /**
     * Remove the specified itinerary from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Recherche de l'itinéraire
        $itinerary = Itinerary::findOrFail($id);

        // Vérification que l'utilisateur connecté est le propriétaire de l'itinéraire
        if ($itinerary->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Suppression de l'itinéraire
        $itinerary->delete();

        return response()->json(['message' => 'Itinerary deleted successfully'], 200);
    }
}

