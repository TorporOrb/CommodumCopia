<?php

/*
titel: Order Test
beschrijving: De testen die de processen met betrekking tot de klantorders controleren.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 23 aug 2023
laatste wijzigingsdatum: 28 aug 2023
*/

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
use App\Models\Discount;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Helpers\OrderUtils;

class OrderTest extends TestCase
{
    use DatabaseTransactions;
    
    public function testOrderCreationAndCartEmptying()
    {
        // Maak een gebruiker, adres en een product aan
        $user = User::factory()->create();
        $address = Address::factory()->create(['user_id' => $user->id]);
        $product = Product::factory()->create();


        // Authenticeer de gebruiker
        $this->actingAs($user);

        // Voeg een product toe aan de winkelwagen van de gebruiker
        $quantity = 2;
        $user->cartItems()->create([
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);

        // Stel de leveringsdatum en -tijd in de sessie in
        $deliveryDate = '2023-08-25';
        $deliveryTime = '08:00-22:00';
        Session::put('delivery_date', $deliveryDate);
        Session::put('delivery_time', $deliveryTime);

        // Doe een POST-verzoek naar de opslagroute
        $response = $this->post(route('orders.store'), [
            'deliveryDate' => $deliveryDate,
            'deliveryTime' => $deliveryTime,
            'productTotal' => 10,
            'shippingCost' => 10.00,
        ]);

        // Verifieer dat de respons doorverwijst naar de home-route
        $response->assertRedirect(route('home'));

        // Verifieer dat de order- en order_product-records zijn aangemaakt
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'total_products' => 10,
            'delivery_address' => $address->address,
            'delivery_price' => 10.00,
        ]);
        $this->assertDatabaseHas('order_product', [
            'order_id' => Order::latest()->first()->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'set_price' => $product->price,
        ]);

        // Verifieer dat de winkelwagen van de gebruiker leeg is
        $this->assertEquals(0, $user->cartItems()->count());

        // Verifieer dat de leveringsdatum en -tijd uit de sessie zijn verwijderd
        $this->assertNull(Session::get('delivery_date'));
        $this->assertNull(Session::get('delivery_time'));
    }


    public function testOrderCreationWithDifferentDiscounts()
    {
        // Maak een gebruiker aan
        $user = User::factory()->create();

         // Maak producten aan met kortingen en stel de prijs in op 1
        $products = [];
        for ($i = 1; $i <= 7; $i++) {
            $products[] = Product::factory()->create(['price' => 1]);
        }

        // Stel kortingswaarden in voor de producten
        foreach ($products as $index => $product) {
            $discountId = $index + 1; // Aannemende dat kortings-ID's beginnen vanaf 1
            $product->discount_id = $discountId;
            $product->save();

            // Voeg voor elk product een winkelwagenitem toe
            $user->cartItems()->create([
                'product_id' => $product->id,
                'quantity' => 3, // Pas de hoeveelheid aan indien nodig
            ]);
        }

        // Simuleer een sessie met leveringsdatum en -tijd
        $this->session([
            'delivery_date' => '2023-08-25',
            'delivery_time' => '08:00-22:00',
        ]);

        // Bezoek de pagina om een bestelling te maken
        $response = $this->actingAs($user)->get(route('orders.create'));

         // Haal winkelwagenitems op uit de weergave
         $cartItems = $response->original->getData()['cartItems'];

         

        // Voer verificaties uit om de weergegeven informatie te controleren
        $response->assertStatus(200);
        $response->assertViewHas('cartItems');

        // Verifieer productnamen
        foreach ($products as $product) {
            $response->assertSee($product->name);
        }

        // Verifieer producttotalen
        foreach ($cartItems as $item) {
            $calculatedTotal = OrderUtils::calculateTotal($item); // Gebruik de hulpfunctie
            $this->assertEquals($calculatedTotal, $item['total']);
        }        
    }
}
