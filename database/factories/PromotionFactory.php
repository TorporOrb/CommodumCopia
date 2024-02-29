<?php


/*
titel: PromotionFactory
beschrijving: De PromotionFactory maakt een promotie aan met dummy data om testen uit  te kunnen voeren.
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 14 aug 2023
laatste wijzigingsdatum: 14 aug 2023
*/

namespace Database\Factories;

use App\Models\Promotion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Promotion>
 */
class PromotionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Promotion::class;
    // Definieer de standaard attributen voor het adres
    public function definition(): array
    {
        // Dummy data voor het test object. 
        return [
            'header' => 'Meer Spaanse weken.',
            'sub_header' => 'Disfrute de su muchos comida',
            'text' => 'Ook de gehele maand juni hebben wij een Spaanse afdeling. Tapashapjes, sangria, churros. Alles om je even helemaal in Spanje te wanen. Nu alleen nog aan je baas uitleggen dat je in de middag je siësta hebt.',
            'image' => '/uploads/te5RjE9LNFb1AosdzFoy684V2YgdCLkgJc3phc8f.png',
        ];
    }
}
