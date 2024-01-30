<?php


/*
titel: Order
beschrijving: Dit model vertegenwoordigt een klantorder. Ook is de relatie met de gebruiker en de producten in de order vastgelegd.
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 06 jul 2023
laatste wijzigingsdatum: 17 jul 2023
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    // Via een formulier in te vullen gegevens
    protected $fillable = [
        'delivery_address',
        'delivery_city',
        'delivery_end_time',
        'delivery_price',
        'delivery_start_time',
        'order_date',
        'postal_code',
        'total_products',
        'user_id',
    ];
    // Relatie met de OrderProduct model, een order heeft meerdere orderproducten
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
    // Relatie met de User model, een order behoort toe aan een gebruiker
    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
