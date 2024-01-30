<?php

/*
titel: ProductFactory
beschrijving: De ProductFactory maakt een product aan met dummy data om testen uit  te kunnen voeren.
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 14 aug 2023
laatste wijzigingsdatum: 14 aug 2023
*/

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;
    // Definieer de standaard attributen voor het adres
    public function definition(): array
    {
        // Dummy data voor het test object. 
        return [
            'name' => $this->faker->word,
            'body' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(1, 1, 10),
            'category_id' => 1,
            'sub_category_id' => 1,
            'discount_id' => 1,
            'image' => $this->faker->imageUrl(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
