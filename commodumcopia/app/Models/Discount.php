<?php


/*
titel: Discount
beschrijving: Dit model vertegenwoordigt een korting in je webshop. Ook is de relatie met het product en met een product in een bestaande order vastgelegd. 
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 19 jun 2023
laatste wijzigingsdatum: 18 jul 2023
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Het model voor de kortingen
class Discount extends Model
{
    use HasFactory;

    // Meerdere producten kunnen dezelfde korting hebben
    public function products()
    {
        return $this->hasMany(Product::class);
    }
        // Meerdere producten in een order kunnen dezelfde korting hebben
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
