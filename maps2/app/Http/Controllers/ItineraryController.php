<?php




namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Destination;

use Illuminate\Http\Request;
use App\Models\Itinerary;

class ItineraryController extends Controller
{


    public function index()
    {
        $itineraries = Itinerary::all();
        return response()->json(['itineraries' => $itineraries], 200);
    }








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
        $itineraire->user_id = auth()->user()->id;
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


















    public function addDestinations(Request $request, $itineraryId)

    {
        // Valider les données de la requête
        $request->validate([
            'destinations' => 'required|array',
            'destinations.*.nom' => 'required|string',
            'destinations.*.lieu_logement' => 'required|string',
        ]);

        // Récupérer l'itinéraire correspondant
        $itinerary = Itinerary::findOrFail($itineraryId);

        // Créer et attacher les destinations à l'itinéraire
        foreach ($request->destinations as $destinationData) {
            $destination = new Destination([
                'nom' => $destinationData['nom'],
                'lieu_logement' => $destinationData['lieu_logement'],
            ]);

            $itinerary->destinations()->save($destination);
        }

        return response()->json(['message' => 'Destinations créées avec succès'], 201);
    }







    public function search(Request $request)
    {
        // Récupérer les paramètres de requête
        $category = $request->query('categorie');
        $duration = $request->query('duree');
    
        // Commencer avec une requête de base pour les itinéraires
        $query = Itinerary::query();
    
        // Filtrer par catégorie si elle est spécifiée
        if ($category) {
            $query->where('categorie', $category);
        }
    
        // Filtrer par durée si elle est spécifiée
        if ($duration) {
            $query->where('duree', $duration);
        }
    
        // Exécuter la requête
        $results = $query->get();
    
        // Retourner les résultats au format JSON
        return response()->json($results);
    }
    

    public function filtre(Request $request)
{
    $query = Itinerary::query();

    // Filtrer par catégorie si le paramètre de requête 'categorie' est présent
    if ($request->has('categorie')) {
        $query->where('categorie', $request->categorie);
    }

    // Filtrer par durée si le paramètre de requête 'duree' est présent
    if ($request->has('duree')) {
        $query->where('duree', $request->duree);
    }

    // Récupérer les itinéraires filtrés
    $itineraries = $query->get();

    return response()->json(['data' => $itineraries], 200);
}

    
    

    
}
