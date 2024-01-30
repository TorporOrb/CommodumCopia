<?php

/*
titel: PostFactory
beschrijving: De PostFactory maakt een post aan met dummy data om testen uit  te kunnen voeren.
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 10 jul 2023
laatste wijzigingsdatum: 10 jul 2023
*/

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Post::class;
    // Definieer de standaard attributen voor het adres
    public function definition(): array
    {
        // Dummy data voor het test object. 
        return [
            'header' => 'Sample Post Header',
            'sub_header' => 'Sample Post Subheader',
            'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vehicula, urna vel euismod consectetur, nisi dolor posuere tellus, quis bibendum ligula nisl vel justo. Suspendisse potenti. Nulla facilisi.',
            'image' => '/uploads/sample-image.png',
        ];
    }
}
