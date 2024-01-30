<?php

/*
titel: Address Test
beschrijving: De testen die de processen met betrekking tot de producten in de webshop controleren.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 7 aug 2023
laatste wijzigingsdatum: 28 aug 2023
*/

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    public function testProductShow()
    {
        // Haal een product uit de database. 
        $product = Product::first();

        // Stuur een GET-verzoek naar de productweergave-route
        $response = $this->get(route('products.show', ['product' => $product->id]));

        // Verifieer dat de respons een succesvolle statuscode heeft
        $response->assertStatus(200);

        // Verifieer dat de responsweergave de productnaam en kortingsdetails bevat
        $response->assertSee($product->name);
        if ($product->discount) {
            $response->assertSee($product->discount->percentage);
            $response->assertSee($product->discount->expiration_date);
        }
    }
}
