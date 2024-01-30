<?php

/*
titel: DatabaseSeeder
beschrijving: In de DatabaseSeeder geef je aan welke seeder gerunt moeten worden.  
auteur: Pascal Thomasse Mol
versie: 8
aanmaakdatum: 23 jun 2023
laatste wijzigingsdatum: 18 jul 2023
*/

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()->count(2)->create();
        // User::factory()->admin()->count(2)->create();
        // User::factory()->editor()->count(2)->create();


        // $this->call(DiscountSeeder::class);

        // $this->call(CategorySeeder::class);
        // $this->call(SubCategorySeeder::class);
        // $this->call(AddressSeeder::class);


    }
}