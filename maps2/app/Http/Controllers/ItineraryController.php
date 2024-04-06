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
        ]);

        $itineraire = new Itinerary();
        $itineraire->titre = $request->titre;
        $itineraire->categorie = $request->categorie;
        $itineraire->duree = $request->duree;
        $itineraire->image = $request->image;
        $itineraire->user_id = auth()->user()->id;
        $itineraire->save();

        return response()->json(['message' => 'Itineraire cree avec succes'], 201);
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
    $validator = Validator::make($request->all(), [
        'titre' => 'string|max:255',
        'categorie' => 'string|max:255',
        'duree' => 'string|max:255',
        'image' => 'string|max:255',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $itinerary = Itinerary::findOrFail($id);

    if ($itinerary->user_id !== Auth::id()) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $itinerary->fill($request->only(['titre', 'categorie', 'duree', 'image']));
    $itinerary->save();

    return response()->json(['message' => 'Mise à jour partielle réussie']);
}








    public function destroy($id)
    {
        $itinerary = Itinerary::findOrFail($id);

        if ($itinerary->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $itinerary->delete();

        return response()->json(['message' => 'Itinerary deleted successfully'], 200);
    }


















    public function addDestinations(Request $request, $itineraryId)

    {
        $request->validate([
            'destinations' => 'required|array',
            'destinations.*.nom' => 'required|string',
            'destinations.*.lieu_logement' => 'required|string',
        ]);

        $itinerary = Itinerary::findOrFail($itineraryId);

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
        $category = $request->query('categorie');
        $duration = $request->query('duree');
        $titre = $request->query('titre');
    
        $query = Itinerary::query();
    
        if ($category) {
            $query->where('categorie', $category);
        }
    
        if ($duration) {
            $query->where('duree', $duration);
        }

        if ($titre) {
            $query->where('titre', $titre);
        }
    
        $results = $query->get();
    
        return response()->json($results);
    }
    
    
    

    public function filtre(Request $request)
{
    $query = Itinerary::query();

    if ($request->has('categorie')) {
        $query->where('categorie', $request->categorie);
    }

    if ($request->has('duree')) {
        $query->where('duree', $request->duree);
    }

    $itineraries = $query->get();

    return response()->json(['data' => $itineraries], 200);
}

    
    

    
}
