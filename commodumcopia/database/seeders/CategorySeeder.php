<?php

/*
titel: CategorySeeder
beschrijving: De CategorySeeder vult de database met categorie data. 
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 23 jun 2023
laatste wijzigingsdatum: 23 jun 2023
*/

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // De categorienamen. 
        $categories = [
            ['name' => 'Bakkerij'],
            ['name' => 'Dranken'],
            ['name' => 'Granen'],
            ['name' => 'Groente en Fruit'],
            ['name' => 'Kant en Klaar'],
            ['name' => 'Kruiden'],
            ['name' => 'Verzorging'],
            ['name' => 'Vlees en Vega'],
            ['name' => 'Zuivel'],
        ];
        // Het pad naar de afbeelding. 
        foreach ($categories as $category) {
            $image = strtolower(str_replace(' ', '_', $category['name'])) . '.jpg';
            $category['image'] = '/banners/' . $image;
            Category::create($category);
        }
    }
}
