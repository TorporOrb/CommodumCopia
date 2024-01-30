<?php

/*
titel: OrderController
beschrijving: De OrderController is verantwoordelijk voor het beheren van bestellingen op de website.
    De index-methode toont alle bestellingen van de ingelogde gebruiker, waarbij de bestellingen worden gesorteerd op nieuwste eerst.
    De show-methode haalt een individuele bestelling op met het gegeven ID.
    De create-methode toont het formulier voor het plaatsen van een nieuwe bestelling.
    De store-methode verwerkt het opslaan van een nieuwe bestelling.
auteur: Pascal Thomasse Mol
versie: 4
aanmaakdatum:  06 jul 2023
laatste wijzigingsdatum: 29 aug 2023
*/

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CartItem;
use App\Helpers\OrderUtils;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders()->latest()->get();

        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $user = Auth::user();
        $order = Order::findOrFail($id);

        // Controleer of de gebruiker een admin is of dat de order van de gebruiker is
        if (!$user->isAdmin() && $order->user_id !== $user->id) {
            return redirect()->route('home')->with('error', 'Deze order is niet openbaar toegankelijk.');
        }
        
        $orderProducts = $order->orderProducts()->with('product')->get();
        
        $orderProducts->each(function ($orderProduct) {
            $orderProduct->total = OrderUtils::calculateTotal($orderProduct);
        });
        
        $productTotal = $orderProducts->sum('total');
        $productTotal = number_format($productTotal, 2);
        
        return view('orders.show', compact('order', 'orderProducts', 'productTotal'));
    }

    
    public function create()
    {
        $user = Auth::user();
        $cartItems = $user->cartItems()->with('product.discount')->get()
            ->groupBy('product_id')
            ->map(function ($items) {
                return [
                    'id' => $items->first()->id,
                    'product' => $items->first()->product,
                    'quantity' => $items->sum('quantity'),
                    'total' => OrderUtils::calculateTotal($items->first()),
                ];
            });

        // Bereken het totaalbedrag van de producten
        $productTotal = $cartItems->sum('total');
        $productTotal = number_format($productTotal, 2);

        $deliveryDate = session('delivery_date');
        $deliveryTime = session('delivery_time');

        // Bereken het totaalbedrag inclusief verzendkosten
        $shippingCost = 0;
        if ($deliveryTime === "08:00-22:00") {
            $shippingCost = 4.95;
        } elseif ($deliveryTime === "16:00-22:00") {
            $shippingCost = 6.95;
        } elseif ($deliveryTime === "19:00-21:00") {
            $shippingCost = 7.50;
        } elseif ($deliveryTime === "20:00-22:00") {
            $shippingCost = 7.50;
        }
        $shippingCost = number_format($shippingCost, 2);
        

        $total = $productTotal + $shippingCost;
        $total = number_format($total, 2);

        return view('orders.create', compact('cartItems', 'deliveryDate', 'deliveryTime', 'productTotal', 'productTotal', 'shippingCost'));
    }

    public function store(Request $request)
    {
        // Valideer de invoergegevens van het formulier
        $validatedData = $request->validate([
            'deliveryDate' => 'required',
            'deliveryTime' => 'required',
            'productTotal' => 'required|numeric',
            'shippingCost' => 'required|numeric',
        ]);
        
        // Haal de huidige gebruiker op
        $user = Auth::user();
        
        // Haal de bezorgtijd op uit de gevalideerde gegevens
        $deliveryTime = $validatedData['deliveryTime'];       
        
        // Haal het adres van de gebruiker op
        $userAddress = $user->addresses()->latest()->first();
        // Maak het order record aan
        $order = Order::create([
            'delivery_address' => $userAddress->address,
            'postal_code' => $userAddress->postal_code,
            'delivery_city' => $userAddress->city,            
            'delivery_end_time' => trim(explode('-', $deliveryTime)[1]),
            'delivery_price' => $validatedData['shippingCost'],
            'delivery_start_time' => trim(explode('-', $deliveryTime)[0]),
            'order_date' => $validatedData['deliveryDate'],            
            'total_products' => $validatedData['productTotal'],
            'user_id' => Auth::user()->id,          
        ]);
        
        // Haal de producten in het winkelwagentje van de gebruiker op
        $cartItems = $user->cartItems()->with('product')->get()
            ->groupBy('product_id')
            ->map(function ($items) {
                return [
                    'id' => $items->first()->id,
                    'product' => $items->first()->product,
                    'quantity' => $items->sum('quantity'),
                ];
            });

        // Maak de order_product records aan voor elk product in het winkelwagentje
        foreach ($cartItems as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item['product']->id,
                'quantity' => $item['quantity'],
                'set_price' => $item['product']->price,
            ]);
        }
        
        // Verwijder de producten uit het winkelwagentje van de gebruiker
        $user->cartItems()->delete();
        
        // Verwijder de bezorgdatum en bezorgtijd uit de sessie
        session()->forget('delivery_date');
        session()->forget('delivery_time');

        // Stuur de gebruiker terug naar de homepagina met een succesbericht
        return redirect()->route('home')->with('success', 'Bestelling succesvol geplaatst.');
    }

}

   