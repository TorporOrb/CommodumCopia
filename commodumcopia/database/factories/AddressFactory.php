<?php

/*
titel: AddresFactory
beschrijving: De AddressFactory maakt een adres aan met dummy data om testen uit  te kunnen voeren.
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 10 jul 2023
laatste wijzigingsdatum: 10 jul 2023
*/

namespace Database\Factories;

use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    // Definieer de standaard attributen voor het adres
    public function definition()
    {
        // Het adres is opgebouwd uit de straat en het huisnummer. 
        $streetName = $this->faker->streetName;
        $houseNumber = $this->faker->buildingNumber;        
        // Dummy data voor het test object. 
        return [
            'address' => $streetName . ' ' . $houseNumber,
            'postal_code' => $this->faker->postcode,
            'city' => $this->faker->city,
            'user_id' => function () {return User::inRandomOrder()->first()->id;},
        ];
    }
}
