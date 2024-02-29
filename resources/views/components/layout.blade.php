<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

{{--
titel: Layout Blade
beschrijving: De basis pagina. Hier staan de header, footer en navbar en komt de pagina die ingeladen wordt in het slot gedeelte.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 18 jun 2023
laatste wijzigingsdatum: 20 jul 2023
--}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    {{-- De css stylesheets --}}
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/footerpages.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/forms.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/posts.css') }}" rel="stylesheet">

</head>

<body>
    <div class="page-wrapper">
        <div class="header-navbar-container"
            style="background-image: url('{{ asset('images/header-background.jpg') }}'); background-size: cover;">
            {{-- De header --}}
            <div class="page-header">
                <x-page-header/>
            </div>
            {{-- De navigatiebalk --}}
            <div class="page-navbar">
                <x-page-navbar/>
            </div>
        </div>
        {{-- Hier komen de succes meldingen. Bijvoorbeeld bij een geslaagde inlog --}}
        <x-success-banner/>
        {{-- Hier komen de fail meldingen. Bijvoorbeeld bij een mislukte actie die authenticatie vereist --}}
        <x-fail-banner/>
        {{-- Als je niet ingelogd bent staat er een link naar het registratieformulier in beeld --}}
        <x-register-link/>


        <main class="page-content">
            {{-- Hier wordt de pagina ingeladen --}}
            {{ $slot }}
        </main>
        {{-- De footer. Hier staan links naar bijvoorbeeld de contact en de about-us pagina --}}
        <footer class="page-footer">
            <x-page-footer/>
        </footer>
    </div>

    {{-- Bootstrap en j-query --}}
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    {{-- Icoontjes. Voor de social links in de footer --}}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
</body>

</html>
