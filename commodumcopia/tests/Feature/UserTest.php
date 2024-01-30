<?php

/*
titel: User Test
beschrijving: De testen die de processen met betrekking tot het inloggen, outloggen, registreren en de bescherming tegen brute force aanvallen controleren.
auteur: Pascal Thomasse Mol
versie: 3
aanmaakdatum: 08 aug 2023
laatste wijzigingsdatum: 28 aug 2023
*/

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    // Test inloggen met rate limiting
    public function test_login_with_rate_limiting()
    {
        // Bereid gebruikersgegevens voor
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Simuleer te veel mislukte inlogpogingen
        for ($i = 1; $i <= 5; $i++) {
            RateLimiter::shouldReceive('tooManyAttempts')->andReturn(true);
        }

        // Probeer in te loggen
        $response = $this->post(route('login'), [
            'email' => 'test@example.com',
            'password' => 'incorrect-password',
        ]);

        // Controleer of de reactie de foutmelding bevat
        $response->assertSessionHas('error', 'Te veel inlogpogingen. Probeer het later opnieuw.');
    }

    // Test correct inloggen
    public function test_correct_login()
    {
        // Bereid gebruikersgegevens voor
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Probeer in te loggen met de juiste referenties
        $response = $this->post(route('login'), [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        // Controleer of de reactie doorverwijst naar de home route met een succesbericht
        $response->assertRedirect(route('home'));
        $response->assertSessionHas('success', 'Je bent ingelogd.');        
    }

    public function testUserCanLogout()
    {
        // Maak een gebruiker aan en log hen in
        $user = User::factory()->create();
        Auth::login($user);

        // Simuleer een uitlogverzoek
        $response = $this->post(route('logout'));

        // Voer verificaties uit
        $response->assertRedirect(route('home'));
        $this->assertGuest(); // Verifieer dat de gebruiker is uitgelogd
    }

    // Test gebruiker kan registreren en adres opslaan
    public function test_user_can_register_and_store_address()
    {
        // Voorbereiden van gebruikers- en adresgegevens
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'street_name' => 'Sample Street',
            'house_number' => '123',
            'postal_code' => '12345',
            'city' => 'Sample City',
        ];

        // Act: Simuleer een HTTP POST-verzoek naar de opslagroute met gebruikersgegevens
        $response = $this->post(route('register.submit'), $userData);

        // Assert: Controleer of de reactie een doorverwijzingsstatuscode heeft (wat duidt op succesvolle registratie)
        $response->assertStatus(302);

        // Assert: Controleer of de gebruiker correct in de database is opgeslagen
        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'role' => 'user',
        ]);

        // Assert: Controleer of het adres correct in de database is opgeslagen
        $user = User::where('email', 'john@example.com')->first();
        $this->assertDatabaseHas('addresses', [
            'user_id' => $user->id,
            'address' => 'Sample Street 123',
            'postal_code' => '12345',
            'city' => 'Sample City',
        ]);
    }

    // Test gebruiker kan zich niet registreren als admin
    public function test_user_cannot_register_as_admin()
    {
        // Voorbereiden van gebruikersgegevens met rol ingesteld op 'admin'
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'admin',
            'street_name' => 'Sample Street',
            'house_number' => '123',
            'postal_code' => '12345',
            'city' => 'Sample City',
        ];

        // Act: Simuleer een HTTP POST-verzoek naar de opslagroute met gebruikersgegevens
        $response = $this->post(route('register.submit'), $userData);

        // Assert: Controleer of de reactie een doorverwijzingsstatuscode heeft
        $response->assertStatus(302);

        // Assert: Controleer of de gebruiker correct in de database is opgeslagen met de rol "user"
        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'role' => 'user',
        ]);

        // Assert: Controleer of het adres correct in de database is opgeslagen
        $user = User::where('email', 'john@example.com')->first();
        $this->assertDatabaseHas('addresses', [
            'user_id' => $user->id,
            'address' => 'Sample Street 123',
            'postal_code' => '12345',
            'city' => 'Sample City',
        ]);
    }
}
