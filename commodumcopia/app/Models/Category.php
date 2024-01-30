<?php


/*
titel: Category
beschrijving: Dit model vertegenwoordigt een categorie in de webshop. Ook is de relatie met de subcategorieën en de producten vastgelegd. 
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 19 jun 2023
laatste wijzigingsdatum: 29 jun 2023
*/

namespace App\Models;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Het model voor de categorieën
class Category extends Model
{
    use HasFactory;

    // Een categorie kan meerdere sub-categorieën hebben
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    // Meerdere producten kunnen tot dezelfde categorie behoren
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
