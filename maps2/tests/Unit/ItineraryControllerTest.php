<?php



namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Itinerary;

class ItineraryControllerTest extends TestCase
{
    public function testIndexMethod()
    {
        $user = User::factory()->create();
    
        $itineraryData = [
            'user_id' => $user->id,
            'titre' => 'Nom de l\'itinéraire',
            'categorie' => 'Catégorie de l\'itinéraire',
            'duree' => 'Durée de l\'itinéraire',
        ];
    
        $itinerary = Itinerary::create($itineraryData);
    
        $response = $this->get('/api/itineraries');
    
        $response->assertJsonFragment(['titre' => 'Nom de l\'itinéraire']);
        $response->assertJsonFragment(['categorie' => 'Catégorie de l\'itinéraire']);
        $response->assertJsonFragment(['duree' => 'Durée de l\'itinéraire']);
    
        $response->assertStatus(200);
    
        $itinerary->delete();
    
        $user->delete();
    }
    


 
    
}
