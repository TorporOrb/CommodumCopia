<?php

/*
titel: Search Test
beschrijving: De testen die de processen met betrekking tot de zoekbalk controleren.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 23 aug 2023
laatste wijzigingsdatum: 28 aug 2023
*/

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchTest extends TestCase
{
    use DatabaseTransactions;
    
    public function testSearchWithKeywordAardbei()
    {
        // Maak producten die overeenkomen met de zoekcriteria
        Product::factory()->create(['name' => 'Heerlijk Aardbeienijs']);
        Product::factory()->create(['name' => 'Aardbei Smoothie']);
        // Maak producten die niet moeten overeenkomen met de zoekcriteria
        Product::factory()->create(['name' => 'Chocoladereep']);
        Product::factory()->create(['name' => 'Vanille-ijs']);

        // Voer een zoekopdracht uit voor het trefwoord "aardbei"
        $response = $this->get(route('search.index', ['keyword' => 'aardbei']));

        // Verificaties
        $response->assertStatus(200);
        $response->assertViewHas('products');

        // Controleer of producten met "aardbei" worden weergegeven
        $response->assertSee('Heerlijk Aardbeienijs');
        $response->assertSee('Aardbei Smoothie');
        // Controleer of producten zonder "aardbei" niet worden weergegeven
        $response->assertDontSee('Chocoladereep');
        $response->assertDontSee('Vanille-ijs');
    }

    public function testSearchWithKeywordChoc()
    {
        // Maak producten die overeenkomen met de zoekcriteria
        Product::factory()->create(['name' => 'Chocoladereep']);
        Product::factory()->create(['name' => 'Choco Koekjes']);
        // Maak producten die niet moeten overeenkomen met de zoekcriteria
        Product::factory()->create(['name' => 'Heerlijk Aardbeienijs']);
        Product::factory()->create(['name' => 'Aardbei Smoothie']);

        // Voer een zoekopdracht uit voor het trefwoord "choc"
        $response = $this->get(route('search.index', ['keyword' => 'choc']));

        // Verificaties
        $response->assertStatus(200);
        $response->assertViewHas('products');

        // Controleer of producten met "choc" worden weergegeven
        $response->assertSee('Chocoladereep');
        $response->assertSee('Choco Koekjes');
        // Controleer of producten zonder "choc" niet worden weergegeven
        $response->assertDontSee('Heerlijk Aardbeienijs');
        $response->assertDontSee('Aardbei Smoothie');
    }
}

