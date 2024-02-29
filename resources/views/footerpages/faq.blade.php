{{--
titel: Address index Blade
beschrijving: De pagine mmet veelgestelde vragen.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 18 jun 2023
laatste wijzigingsdatum: 29 jun 2023
--}}

<x-layout>
    <div class="center">
        <div class="faq_page">
            <h1 class="black_h1">Klantenservice</h1>
            <br>
            <h2 class="blue_h2">Hoe kunnen we je helpen?</h2>
            <br>
        </div>
    </div>
    <div style="text-align: center; width: 40rem;" class="mx-auto">
        {{-- Afbeelding --}}
        <img src="{{ asset('images/faq.jpg') }}" height="400px;"  style="border-radius: 10px;" alt="Helpdesk">
    </div>
    <div class="center">
        <div class="faq_section">
            <br>
            <h2 class="blue_h2">Veel gestelde vragen: </h2>
            <br>
            <h3>Is dit een echte winkel?</h3>
            <p>Dit is geen echte winkel. Dit is een schoolproject vanuit het LOI voor het vak webdevelopment.
            </p>
            <h3>Hoe moet ik betalen? </h3>
            <p>Dit is geen echte winkel. Dit is een schoolproject vanuit het LOI voor het vak webdevelopment.
            </p>
            <h3>Hoe lang duurt het voor ik de door mij bestelde producten ontvang? </h3>
            <p>Dit is geen echte winkel. Dit is een schoolproject vanuit het LOI voor het vak webdevelopment.
            </p>
        </div>



        <div class="contact_section">
            <h2 class="blue_h2">Neem contact op</h2>
            <p>Staat je vraag niet tussen de veelgestelde vragen? Neem dan gerust contact op met de klantenservice:
            </p>
            {{-- Stuur een vraag. (Ik check de inbox practisch nooit overigens) --}}
            <a href="mailto:CommodumCopia@outlook.com">CommodumCopia@outlook.com</a>
        </div>
    </div>

</x-layout>
