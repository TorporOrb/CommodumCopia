<?php

/*
titel: Cart Test
beschrijving: De testen die de processen met betrekking tot het winkelmandje controleren.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 23 aug 2023
laatste wijzigingsdatum: 28 aug 2023
*/

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CartTest extends TestCase
{
    use DatabaseTransactions;

    public function testCartShow()
    {
        // Maak een gebruiker aan
        $gebruiker = User::factory()->create();

        // Maak producten aan indien nodig (vervang dit met je logica voor het aanmaken van producten)
        $product1 = Product::factory()->create();
        $product2 = Product::factory()->create();

        // Voeg winkelwagenitems toe voor de gebruiker
        $gebruiker->cartItems()->create([
            'product_id' => $product1->id,
            'quantity' => 2,
        ]);

        $gebruiker->cartItems()->create([
            'product_id' => $product2->id,
            'quantity' => 3,
        ]);

        // Simuleer authenticatie als de gebruiker
        $this->actingAs($gebruiker);

        // Stuur een GET-verzoek naar de route voor het tonen van de winkelwagen
        $reactie = $this->get(route('cart.show'));

        // Controleer of de reactie een succesvolle statuscode heeft
        $reactie->assertStatus(200);

        // Voeg meer beweringen toe op basis van de verwachte weergave-inhoud
        // Bijvoorbeeld, controleer of de productnamen en aantallen aanwezig zijn in de reactie-weergave
        $reactie->assertSee($product1->name);
        $reactie->assertSee($product2->name);
        $reactie->assertSee('2'); // Aantal van product1
        $reactie->assertSee('3'); // Aantal van product2
        // Controleer of de links met de juiste URL's aanwezig zijn
        $reactie->assertSee(route('products.show', ['product' => $product1->id]));
        $reactie->assertSee(route('products.show', ['product' => $product2->id]));
    }

    public function testAddToCart()
    {
        // Maak een gebruiker aan
        $gebruiker = User::factory()->create();

        // Maak een product aan
        $product = Product::factory()->create();

        // Simuleer een POST-verzoek om een product aan de winkelwagen toe te voegen
        $reactie = $this->actingAs($gebruiker)->post(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        // Controleer of het winkelwagenitem aan de winkelwagen van de gebruiker is toegevoegd
        $this->assertDatabaseHas('cart_items', [
            'user_id' => $gebruiker->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        // Controleer de reactie
        $reactie->assertRedirect();
        $reactie->assertSessionHas('success', 'Item toegevoegd.');
    }
}
