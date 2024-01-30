<?php


/*
titel: OrderProduct
beschrijving: Dit model vertegenwoordigt een product in een order. Ook is de relatie met de order, het product en de korting vastgelegd. 
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 15 jul 2023
laatste wijzigingsdatum: 18 jul 2023
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $table = 'order_product';
    // Via een formulier in te vullen gegevens
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'set_price',
    ];
        // Relatie met de Order model, een orderproduct behoort toe aan een order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    // Relatie met de Product model, 
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    // Relatie met de Discount model. Of en welke korting een product in een order heeft
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    
}
