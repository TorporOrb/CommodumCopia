{{--
titel: Page Footer Blade
beschrijving: De Footer met de links naar de socials en informatiepagina's .
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 18 jun 2023
laatste wijzigingsdatum: 17 jul 2023
--}}

<div class="bg-light vw-100 mt-5 pt-1">
    <div class="container">
      <div class="row h-50 align-items-center">
        {{-- De socials --}}
        <div class="col bg-white p-2 m-4 rounded text-center mb-4 mb-md-0">
          <a href="https://facebook.com">
            <ion-icon name="logo-facebook" size="large"></ion-icon>
          </a>
          <a href="https://instagram.com">
            <ion-icon name="logo-instagram" size="large"></ion-icon>
          </a>
          <a href="https://youtube.com">
            <ion-icon name="logo-youtube" size="large"></ion-icon>
          </a>
          <a href="https://twitter.com">
            <ion-icon name="logo-twitter" size="large"></ion-icon>
          </a>
        </div>
        {{-- Mailinglist --}}
        <div class="w-100 mb-4 d-md-none"></div> 
        <div class="col bg-white p-3 m-4 rounded text-center">
          <a href="{{ route('mailingList') }}">Nieuwsbrief</a>
        </div>
        {{-- Klantenservice --}}
        <div class="col bg-white p-3 m-4 rounded text-center">
          <a href="{{ route('faq') }}">Klantenservice</a>
        </div>
      </div>
    </div>
  
  
  <div class="container my-3">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
      {{-- Algemene voorwaarden --}}
      <div class="col my-3">
        <a href="{{ route('terms') }}">Algemene Voorwaarden</a>
      </div>
      {{-- Levering informatie --}}
      <div class="col my-3">
        <a href="{{ route('delivery') }}">Levering en verzending</a>
      </div>
      {{-- Privacy --}}
      <div class="col my-3">
        <a href="{{ route('privacy') }}">Privacybeleid</a>
      </div>
      {{-- About us --}}
      <div class="col my-3">
        <a href="{{ route('about') }}">Onze Organisatie</a>
      </div>
    </div>
  </div>
</div>