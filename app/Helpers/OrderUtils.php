<?php

/*
titel: OrderUtils
beschrijving:  De OrderUtils is een helperclass met een statische functie genaamd om de totaalkosten van een kortingsproduct op meerdere plekken te kunnen gebruiken.
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 28 aug 2023
laatste wijzigingsdatum: 28 aug 2023
*/

namespace App\Helpers;

class OrderUtils
{
    public static function calculateTotal($item)
    {
        // Haal het product en de hoeveelheid op uit het item
        $product = $item['product'];
        $quantity = $item['quantity'];

        // Haal de korting van het product op
        $discount = $product->discount;

        // Als er een korting is
        if ($discount) {
            // Controleer welk type korting het is
            if ($discount->name === '3 halen, 2 betalen') {
                // Bereken de totaalprijs voor de "3 halen, 2 betalen" korting
                $total = ($quantity % 3 === 0) ?
                    ($quantity / 3) * 2 * $product->price :
                    (int) ($quantity / 3) * 2 * $product->price + ($quantity % 3) * $product->price;
            } elseif ($discount->name === '2 halen, 1 betalen') {
                // Bereken de totaalprijs voor de "2 halen, 1 betalen" korting
                $total = ($quantity % 2 === 0) ?
                    ($quantity / 2) * $product->price :
                    (int) ($quantity / 2) * $product->price + ($quantity % 2) * $product->price;
            } else {
                // Bereken de totaalprijs voor andere kortingen
                $discountedPrice = $product->price - ($product->price * ($discount->value / 100));
                $total = $discountedPrice * $quantity;
            }

            // Geef de totaalprijs met juiste opmaak terug
            return number_format($total, 2);
        }

        // Als er geen korting is, bereken de totaalprijs zonder korting
        return number_format($product->price * $quantity, 2);
    }
}