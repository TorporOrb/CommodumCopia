<?php


/*
titel: CartItem
beschrijving: Dit model vertegenwoordigt een item in het winkelmandje van een klant. Ook is de relatie met de gebruiker en met het product vastgelegd.
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 03 jul 2023
laatste wijzigingsdatum: 03 jul 2023
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    // Via een formulier in te vullen gegevens
    protected $fillable = [
        'product_id',
        'quantity',
    ];
        // Relatie met de User model, een CartItem behoort toe aan een gebruiker
    public function user()
    {
        return $this->belongsTo(User::class);
    }
        // Relatie met de Product model, een CartItem behoort toe aan een product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
