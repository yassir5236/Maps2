<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Itinerary;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItineraryFilterTest extends TestCase
{
    use RefreshDatabase;

    public function testFiltreMethod()
    {
        // Créer quelques itinéraires fictifs à l'aide de la factory
        Itinerary::factory()->create([
            'categorie' => 'Adventure',
            'duree' => '3 days',
        ]);

        // Ajouter d'autres itinéraires fictifs au besoin...

        $response = $this->post('/api/itineraries/filtre', [
            'categorie' => 'Adventure',
            'duree' => '3 days',
        ]);
        // Assurez-vous que le code de réponse est 200 (OK)
        $response->assertStatus(200);

        // Vérifier que la réponse contient les données filtrées
        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment(['categorie' => 'Adventure']);
        $response->assertJsonFragment(['duree' => '3 days']);
    }
}
