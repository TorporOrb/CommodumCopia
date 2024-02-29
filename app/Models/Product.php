<?php


/*
titel: Product
beschrijving: Dit model vertegenwoordigt een product in de webshop. 
    Ook is de relatie met de korting, de categorie, de sub-categorie, een product in je winkelmand en een product in een order vastgelegd.
auteur: Pascal Thomasse Mol
versie: 3
aanmaakdatum: 19 jun 2023
laatste wijzigingsdatum: 15 jul 2023
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Het product model
class Product extends Model
{
    use HasFactory;

    // Meerdere producten kunnen dezelfde korting hebben
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    // Meerdere producten kunnen tot dezelfde categorie behoren
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Meerdere producten kunnen tot dezelfde subcategorie behoren
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    // Relatie met de CartItem model, een product kan meerdere keren in verschillende winkelwagens voorkomen
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    // Relatie met de OrderProduct model, een product kan meerdere keren in verschillende orders voorkomen
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    // De velden die met een formulier ingevuld kunnen worden
    protected $fillable = [
        'name',
        'body',
        'price',
        'category_id',
        'sub_category_id', 
        'discount_id',
        'image',
    ];
}