<?php

/*
titel: DiscountSeeder
beschrijving: De DiscountSeeder vult de database met korting data. 
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 23 jun 2023
laatste wijzigingsdatum: 23 jun 2023
*/

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiscountSeeder extends Seeder
{
    public function run(): void
    {
        // De data van de kortingen. 
        DB::table('discounts')->insert([
            ['name' => '5%', 'value' => 5],
            ['name' => '10%', 'value' => 10],
            ['name' => '15%', 'value' => 15],
            ['name' => '20%', 'value' => 20],
            ['name' => '25%', 'value' => 25],
            ['name' => '3 halen, 2 betalen', 'value' => null],
            ['name' => '2 halen, 1 betalen', 'value' => null],
        ]);
    }
}