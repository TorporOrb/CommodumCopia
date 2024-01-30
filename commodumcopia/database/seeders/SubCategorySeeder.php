<?php

/*
titel: Sub-CategorySeeder
beschrijving: De SubCategorySeeder vult de database met sub-categorie data. 
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 23 jun 2023
laatste wijzigingsdatum: 23 jun 2023
*/

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // De data voor de sub-categorieën.
        SubCategory::create([
            'name' => 'Brood',
            'image' => '/banners/brood.jpg',
            'category_id' => 1,
        ]);

        SubCategory::create([
            'name' => 'Gebak',
            'image' => '/banners/gebak.jpg',
            'category_id' => 1,
        ]);

        SubCategory::create([
            'name' => 'Ontbijt',
            'image' => '/banners/ontbijt.jpg',
            'category_id' => 1,
        ]);

        SubCategory::create([
            'name' => 'Koffie',
            'image' => '/banners/koffie.jpg',
            'category_id' => 2,
        ]);

        SubCategory::create([
            'name' => 'Thee',
            'image' => '/banners/thee.jpg',
            'category_id' => 2,
        ]);

        SubCategory::create([
            'name' => 'Smoothies',
            'image' => '/banners/smoothies.jpg',
            'category_id' => 2,
        ]);

        SubCategory::create([
            'name' => 'Pasta',
            'image' => '/banners/pasta.jpg',
            'category_id' => 3,
        ]);

        SubCategory::create([
            'name' => 'Ontbijtgranen',
            'image' => '/banners/ontbijtgranen.jpg',
            'category_id' => 3,
        ]);

        SubCategory::create([
            'name' => 'Wereldkeuken',
            'image' => '/banners/wereldkeuken.jpg',
            'category_id' => 3,
        ]);

        SubCategory::create([
            'name' => 'Groente',
            'image' => '/banners/groente.jpg',
            'category_id' => 4,
        ]);

        SubCategory::create([
            'name' => 'Fruit',
            'image' => '/banners/fruit.jpg',
            'category_id' => 4,
        ]);

        SubCategory::create([
            'name' => 'Soep',
            'image' => '/banners/soep.jpg',
            'category_id' => 5,
        ]);

        SubCategory::create([
            'name' => 'Maaltijd',
            'image' => '/banners/maaltijd.jpg',
            'category_id' => 5,
        ]);

        SubCategory::create([
            'name' => 'Verse kruiden',
            'image' => '/banners/verse_kruiden.jpg',
            'category_id' => 6,
        ]);

        SubCategory::create([
            'name' => 'Gedroogde kruiden',
            'image' => '/banners/gedroogde_kruiden.jpg',
            'category_id' => 6,
        ]);

        SubCategory::create([
            'name' => 'Douche producten',
            'image' => '/banners/douche_producten.jpg',
            'category_id' => 7,
        ]);

        SubCategory::create([
            'name' => 'Make-up',
            'image' => '/banners/makeup.jpg',
            'category_id' => 7,
        ]);

        SubCategory::create([
            'name' => 'Vlees',
            'image' => '/banners/vlees.jpg',
            'category_id' => 8,
        ]);

        SubCategory::create([
            'name' => 'Vega',
            'image' => '/banners/vega.jpg',
            'category_id' => 8,
        ]);

        SubCategory::create([
            'name' => 'Dierlijk',
            'image' => '/banners/dierlijk.jpg',
            'category_id' => 9,
        ]);

        SubCategory::create([
            'name' => 'Plantaardig',
            'image' => '/banners/plantaardig.jpg',
            'category_id' => 9,
        ]);
    }
}
