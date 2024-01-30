<?php

/*
titel: Categorie Test
beschrijving: De testen die de processen met betrekking tot de categorieën controleren.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 22 aug 2023
laatste wijzigingsdatum: 28 aug 2023
*/

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategorieTest extends TestCase
{
    use DatabaseTransactions;
    
    public function testCategoriesIndex()
    {
        // Bestaande categorieën ophalen uit de database
        $categorieën = Category::all();

        // Stuur een GET-verzoek naar de categorieën index route
        $reactie = $this->get(route('categories.index'));

        // Verifiëren dat de reactie een succesvolle statuscode heeft
        $reactie->assertStatus(200);

        // Verifiëren dat de reactieweergave de namen van de categorieën bevat
        foreach ($categorieën as $categorie) {
            $reactie->assertSee($categorie->name);
        }
    }

    public function testCategoryShow()
    {
        // Aannemende dat je bestaande records in je database hebt
        $categorie = Category::first();
        $subcategorieën = SubCategory::where('category_id', $categorie->id)->get();
        $productenPerSubcategorie = [];

        foreach ($subcategorieën as $subcategorie) {
            $producten = Product::where('sub_category_id', $subcategorie->id)->get();
            $productenPerSubcategorie[$subcategorie->id] = $producten;
        }

        // Stuur een GET-verzoek naar de categorie weergave route
        $reactie = $this->get(route('categories.show', ['id' => $categorie->id]));

        // Verifiëren dat de reactie een succesvolle statuscode heeft
        $reactie->assertStatus(200);

        // Verifiëren dat de reactieweergave categorie-, subcategorie- en productnamen bevat
        $reactie->assertSee($categorie->name);
        foreach ($subcategorieën as $subcategorie) {
            $reactie->assertSee($subcategorie->name);
            foreach ($productenPerSubcategorie[$subcategorie->id] as $product) {
                $reactie->assertSee($product->name);
            }
        }
    }
}