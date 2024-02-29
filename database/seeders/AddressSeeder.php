<?php

/*
titel: AddressSeeder
beschrijving: De AddressSeeder vult de database met testdata van adressen. 
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 10 jul 2023
laatste wijzigingsdatum: 10 jul 2023
*/

namespace Database\Seeders;

use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Mogelijke straatnamen
        $streets = [
            'Hoofdstraat', 'Kerkstraat', 'Dorpsstraat', 'Marktstraat', 'Schoolstraat',
            'Wilhelminastraat', 'Beatrixstraat', 'Julianalaan', 'Emmastraat', 'Prins Hendrikstraat',
        ];
        // Mogelijke stadnamen. 
        $cities = [
            'Amsterdam', 'Rotterdam', 'Den Haag', 'Utrecht', 'Eindhoven',
            'Groningen', 'Tilburg', 'Almere', 'Breda', 'Nijmegen',
        ];

        $users = User::all();
        // Maak voor elke gebruikr een adres aan. 
        $users->each(function ($user) use ($streets, $cities) {
            $address = new Address([
                'address' => $this->getRandomValue($streets) . ' ' . mt_rand(1, 100),
                'city' => $this->getRandomValue($cities),
                'postal_code' => $this->generatePostalCode(),
            ]);
            $user->addresses()->save($address);
        });
    }

    // Genereer een willekeurige waarde. 
    private function getRandomValue(array $array)
    {
        return $array[array_rand($array)];
    }

    // Genereer een postcode. 
    private function generatePostalCode()
    {
        $digits = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $letters = chr(rand(65, 90)) . chr(rand(65, 90));

        return $digits . $letters;
    }
}
