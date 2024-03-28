<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }
}




namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Itinerary;

class ItineraryTest extends TestCase
{
    public function test_it_can_create_itinerary()
    {
        // Créer un nouvel itinéraire
        $itinerary = Itinerary::create([
            'user_id' => 1,
            'title' => 'Test Itinerary',
            'category' => 'Test Category',
            'duration' => 'Test Duration'
        ]);

        // Vérifier si l'itinéraire a été créé avec succès
        $this->assertNotNull($itinerary);
        $this->assertEquals('Test Itinerary', $itinerary->title);
    }
}

