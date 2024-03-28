<?php

namespace Database\Factories;

use App\Models\Itinerary;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\user;



class ItineraryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Itinerary::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(), // Créez un utilisateur fictif pour associer à l'itinéraire
            'titre' => $this->faker->sentence,
            'categorie' => $this->faker->word,
            'duree' => $this->faker->randomElement(['1 jour', '2 jours', '3 jours']),
            // Ajoutez d'autres attributs selon votre modèle
        ];
    }
}
