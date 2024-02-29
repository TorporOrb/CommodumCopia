<?php

/*
titel: AdminOrderController
beschrijving:  De AdminOrderController is verantwoordelijk voor het inzien van orders voor beheerders.
Bij het aanmaken van een nieuwe gebruiker worden de adresgegevens doorgegeven aan de adrescontroller zodat de logica met betrekking tot adressen op één plaats blijft.
    De index-methode toont alle gebruikers in paginavorm met paginering.
    De userOrders-methode toont alle klantorders van één gebruiker.
    De show-methode toont een specifieke klantorder.  
auteur: Pascal Thomasse Mol
versie: 6
aanmaakdatum: 26 aug 2023
laatste wijzigingsdatum: 28 aug 2023
*/

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Helpers\OrderUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    public function index()
    {
        // Toon een gepagineerde lijst van gebruikers met 15 gebruikers per pagina
        $users = User::paginate(15);
        return view('admin.orders.index', compact('users'));
    }
    
    public function userOrders(User $user)
    {
        // Toon bestellingen van een specifieke gebruiker
        $orders = $user->orders;
        return view('admin.orders.user_orders', compact('user', 'orders'));
    }

    public function show(User $user, Order $order)
    {
        // Haal de momenteel ingelogde gebruiker op
        $loggedInUser = Auth::user();
    
        // Controleer of de ingelogde gebruiker een beheerder is of de gebruiker van de bestelling overeenkomt met de ingelogde gebruiker
        if (!$loggedInUser->isAdmin() && $order->user_id !== $loggedInUser->id) {
            return redirect()->route('home')->with('error', 'Deze order is niet openbaar toegankelijk.');
        }
    
        // Laad de bestelde producten samen met hun bijbehorende producten
        $orderProducts = $order->orderProducts()->with('product')->get();
    
        // Bereken de totaalprijs voor elk besteld product
        $orderProducts->each(function ($orderProduct) {
            $orderProduct->total = OrderUtils::calculateTotal($orderProduct);
        });
    
        // Bereken de totaalprijs voor de bestelling
        $productTotal = $orderProducts->sum('total');
        $productTotal = number_format($productTotal, 2);
    
        // Geef de weergave terug met de benodigde gegevens
        return view('admin.orders.show', compact('user', 'order', 'orderProducts', 'productTotal'));
    }
    
}