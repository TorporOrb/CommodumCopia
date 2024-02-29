<?php

/*
titel: Homepage Test
beschrijving: De test die de processen met betrekking tot de homepage controleren.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 14 aug 2023
laatste wijzigingsdatum: 28 aug 2023
*/

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomePageTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index_method_returns_correct_data()
    {
        // Haal de nieuwste promotie en post op uit de database
        $latestPromotion = Promotion::latest()->first();
        $latestPost = Post::latest()->first();

        // Voer de index methode uit
        $response = $this->get(route('home'));

        // Verifieer dat de respons succesvol is
        $response->assertStatus(200);

        // Verifieer dat de weergave de juiste gegevens heeft
        $response->assertViewHas('latestPromotion', function ($viewData) use ($latestPromotion) {
            return $viewData->id === $latestPromotion->id;
        });

        $response->assertViewHas('latestPost', function ($viewData) use ($latestPost) {
            return $viewData->id === $latestPost->id;
        });

        // Verifieer dat er drie producten zijn met een niet-nul discount_id
        $response->assertViewHas('discountedProducts', function ($viewData) {
            $discountedProducts = $viewData->toArray();
            $hasThreeDiscountedProducts = count($discountedProducts) === 3 &&
                collect($discountedProducts)->every(function ($product) {
                    return $product['discount_id'] !== 0;
                });

            return $hasThreeDiscountedProducts;
        });
    }
}
