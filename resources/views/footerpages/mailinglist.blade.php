{{--
titel: Mailinglist Blade
beschrijving: De pagina waar je je in kan schrijven op de mailinglist .
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 18 jun 2023
laatste wijzigingsdatum: 29 jun 2023
--}}

<x-layout>
    <div class="center">
        <br>
        <h2 class="blue_h2">Meld je nu aan voor de nieuwsbrief!</h2>
        <br>
        <p>Wil je altijd op de hoogte zijn van de lopende acties?</p>
        <p>Dan is de nieuwsbrief echt iets voor u.</p>
        <br>
        {{-- Het inschrijf formulier --}}
        <form method="POST" action="{{ route('sendEmail') }}">
            {{-- cross site request forgery beveiliging --}}
            @csrf
            <label class="mx-2">Email:</label>
            <input type="email" name="email" required>
            <br>
            {{-- Eventuele foutmelding --}}
            @error('email')
            <span class="fail">{{ $message }}</span>
            @enderror
            @if (session('email_success'))
            {{-- Succes bericht --}}
            <span class="success">Bedankt voor het aanmelden op de nieuwsbrief.</span>
            @endif
            <br>
            <button class="submitbutton" style="width:70%" type="submit">Schrijf je nu in</button>
        </form>
    </div>
</x-layout>
