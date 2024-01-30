<?php

/*
titel: CartController
beschrijving:  De CartController is verantwoordelijk voor het beheren van de winkelwagenfunctionaliteit in de applicatie. Het heeft twee methoden:
- De addToCart-methode voegt een item toe aan de winkelwagen. 
- De show-methode toont de inhoud van de winkelwagen aan de gebruiker.
- De increaseQuantity-methode verhoogt de hoeveelheid van een item in de winkelwagen.
- De decreaseQuantity-methode verlaagt de hoeveelheid van een item in de winkelwagen, en verwijdert het item als de hoeveelheid 1 is.
- De CalculateTotal-methode berekent de totaalprijs van een item met eventuele korting.
Het script krijgt nog een addQuantity en decreaseQuantity methode maar die zijn niet nodig voor de frontend. 
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 06 jul 2023
laatste wijzigingsdatum: 20 jul 2023
*/

namespace App\Http\Controllers;
use App\Helpers\OrderUtils;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Voeg een item toe aan de winkelwagen.
     */
    public function addToCart(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->back()->with('failure', 'Gelieve eerst in te loggen alvorens items aan het winkelmandje toe te voegen.');
        }
        
        $validatedData = $request->validate([
            'product_id' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
        ]);
    
        $user = Auth::user();
        $productId = $validatedData['product_id'];
        $quantity = $validatedData['quantity'];
    
        $user->cartItems()->create([
            'product_id' => $productId,
            'quantity' => $quantity,
        ]);
    
        // Doorsturen en succesbericht toevoegen
    
        return redirect()->back()->with('success', 'Item toegevoegd.');
    }

    /**
     * Weergave van de winkelwagen met de items.
     */
    public function show()
    {
        $user = Auth::user();
        $cartItems = $user->cartItems()->with('product.discount')->get()
            ->groupBy('product_id')
            ->map(function ($items) {
                return [
                    'id' => $items->first()->id,
                    'product' => $items->first()->product,
                    'quantity' => $items->sum('quantity'),
                    'total' => OrderUtils::calculateTotal($items->first())
                ];
            });

        return view('cart.show', compact('cartItems'));
    }

    // Verhoog de hoeveelheid van een item in de winkelwagen.
    public function increaseQuantity($cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);
        $cartItem->quantity++;
        $cartItem->save();

        return redirect()->back();
    }
      
    /**
     * Verlaag de hoeveelheid van een item in de winkelwagen.
     * Als de hoeveelheid 1 is, wordt het item uit de winkelwagen verwijderd.
     */
    public function decreaseQuantity($cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);
        if ($cartItem->quantity > 1) {
            $cartItem->quantity--;
            $cartItem->save();
        } else {
            $cartItem->delete();
        }

        return redirect()->back();
    }
  
}