<?php

/*
titel: Post Test
beschrijving: De testen die de processen met betrekking tot de blogposts controleren.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 08 aug 2023
laatste wijzigingsdatum: 22 aug 2023
*/

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostTest extends TestCase
{
    use DatabaseTransactions;
    
    public function test_post_title_is_displayed_in_show_view()
    {
        $post = new Post([
            'header' => 'Test Header',
            'sub_header' => 'Test Subheader',
            'text' => 'Test Tekst',
            'image' => '/uploads/test-afbeelding.png',
        ]);

        // Bewaar de post
        $post->save();
        // Actie: Simuleer een HTTP GET-verzoek naar de weergaveroute voor de aangemaakte post
        $response = $this->get(route('posts.show', ['id' => $post->id]));
        // Assertie: Controleer of de reactie een succesvolle statuscode heeft
        $response->assertStatus(200);
        // Assertie: Controleer of de posttitel aanwezig is in de reactie-inhoud
        $response->assertSee($post->header);
    }
}
