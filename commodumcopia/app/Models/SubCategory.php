<?php


/*
titel: SubCategory
beschrijving: Dit model vertegenwoordigt een subcategorie in de webshop. 
    Ook is vastgelegd tot welke categorie deze behoort en welke producten er toe behoren. 
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 19 jun 2023
laatste wijzigingsdatum: 29 jun 2023
*/

namespace App\Models;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Het subcategorie model
class SubCategory extends Model
{
    use HasFactory;

    // Meerdere subcategorieën kunnen tot dezelfde categorie behoren
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Meerdere producten kunnen tot dezelfde subcategorie behoren
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
