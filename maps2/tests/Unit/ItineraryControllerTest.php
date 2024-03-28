<?php



namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Itinerary;

class ItineraryControllerTest extends TestCase
{
    public function testIndexMethod()
    {
        // Créez un utilisateur fictif pour associer à l'itinéraire
        $user = User::factory()->create();
    
        // Créez un nouvel itinéraire avec une valeur pour user_id
        $itineraryData = [
            'user_id' => $user->id, // Associez l'itinéraire à l'utilisateur fictif créé ci-dessus
            'titre' => 'Nom de l\'itinéraire',
            'categorie' => 'Catégorie de l\'itinéraire',
            'duree' => 'Durée de l\'itinéraire',
        ];
    
        $itinerary = Itinerary::create($itineraryData);
    
        // Appelez votre méthode index
        $response = $this->get('/api/itineraries');
    
        // Assurez-vous que la réponse contient les données de l'itinéraire créé
        $response->assertJsonFragment(['titre' => 'Nom de l\'itinéraire']);
        $response->assertJsonFragment(['categorie' => 'Catégorie de l\'itinéraire']);
        $response->assertJsonFragment(['duree' => 'Durée de l\'itinéraire']);
    
        // Assurez-vous que le code de réponse est 200 (OK)
        $response->assertStatus(200);
    
        // Supprimez l'itinéraire créé pour nettoyer la base de données
        $itinerary->delete();
    
        // Supprimez également l'utilisateur créé
        $user->delete();
    }
    


 
    
}
