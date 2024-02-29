<?php

/*
titel: LfiRfi Test
beschrijving: De testen die de processen met betrekking tot de beveiligen van LFI/RFI controleren.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 22 aug 2023
laatste wijzigingsdatum: 28 aug 2023
*/

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LfiRfiTest extends TestCase
{
    use DatabaseTransactions;
    
    public function testLfiVulnerability()
    {
        // Maak een admin gebruiker aan
        $adminUser = User::factory()->create([
            'role' => 'admin',
        ]);

        // Simuleer authenticatie als de admin gebruiker
        $this->actingAs($adminUser);

        $maliciousImage = UploadedFile::fake()->createWithContent('malicious.php', '<script>alert("Kwaadaardig Script");</script>');

        // Verstuur een POST verzoek met geldige gegevens
        $response = $this->post('/posts/store', [
            'header' => 'Geldige Header',
            'sub_header' => 'Geldige Sub Header',
            'text' => 'Geldige Tekst',
            'image' => $maliciousImage,
        ]);
        
        $response->assertSessionHasErrors(['image' => 'The image field must be a file of type: jpeg, png, jpg, gif.']);
    }

}

