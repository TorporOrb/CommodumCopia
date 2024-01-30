<?php

/*
titel: Sql Injection Test
beschrijving: De testen die de processen met betrekking tot de beveiliging tegen SQL injecties controleren.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 22 aug 2023
laatste wijzigingsdatum: 28 aug 2023
*/

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SQLInjectionTest extends TestCase
{
    use DatabaseTransactions;

    public function testSqlInjectionProtection()
    {
        // Simuleer een poging tot SQL-injectie
        $response = $this->get('/search', ['keyword' => "' OF '1'='1"]);

        // Controleer of de reactie de verwachte validatiefoutmelding bevat
        $response->assertSessionHasErrors('keyword');
    }
}
