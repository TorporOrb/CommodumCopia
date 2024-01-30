{{--
titel: Page Navbar Blade
beschrijving: De navigatiebalk.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 24 jun 2023
laatste wijzigingsdatum: 20 jul 2023
--}}

<nav class="navbar navbar-expand-lg navbar-light" style="width: 100vw;">
    {{-- De dropdown met de link naar de categorie pagina en de zoekbalk --}}
    <div class="custom-dropdown">
        <button class="nav-link dropdown-toggle rounded mx-2" type="button" id="navbarDropdown" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Producten
        </button>
        <div class="dropdown-menu text-center" aria-labelledby="navbarDropdown">
            {{-- Link naar de categorie pagina --}}
            <a href="{{ route('categories.index') }}">
                <p class="pl-3">Categorieën</p>
            </a>
            {{-- De zoekbalk --}}
            <form action="{{ route('search.index') }}" method="GET">
                <input type="text" name="keyword" placeholder="Zoeken..." class="mx-2"
                    onkeydown="if (event.keyCode === 13) { event.preventDefault(); this.closest('form').submit(); }">
            </form>
        </div>
    </div>
    
    <div style="margin-left: auto; margin-right: 2rem; display: flex;">
        @auth
        {{-- Link naar het winkelwagentje --}}
        <a href="{{ route('cart.show') }}" class="nav-link p-2">
            <ion-icon size="large" name="cart-outline"></ion-icon>
        </a>
        {{-- Link naar het profiel --}}
        <a href="{{ route('profile.index') }}" class="nav-link p-2">
            <ion-icon size="large" name="person-outline"></ion-icon>
        </a>
        @endauth
    </div>
    
    
    <div class="ml-auto">
        {{-- Alleen als je ingelogd bent --}}
        @auth
            <div class="row">
                {{-- Admin only --}}
                @if (auth()->user()->isAdmin())
                    {{-- Link naar de Admin pagina --}}
                    <a href="{{ route('admin.index') }}">
                        <button class="button_1 mr-2 mb-2">Admin</button>
                    </a>
                    {{-- Stop Admin only --}}
                @endif
                {{-- Uitloggen --}}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="button_1">Uitloggen</button>
                </form>
            </div>
            {{-- Als je niet ingelogd bent --}}
        @else
            {{-- Inlog formulier --}}
            <div class="login-box" style="margin-right:2rem; ">
                <form action="{{ route('login') }}" method="POST">
                    {{-- cross site request forgery beveiliging --}}
                    @csrf
                    <div class="input-group">
                        <input type="email" placeholder="Je Mail Adres" id="email" class="form-control"
                            name="email" />
                        <input type="password" placeholder="Je Wachtwoord" id="password" class="form-control"
                            name="password" />
                    </div>
                    {{-- Foutmelding --}}
                    @if (session('error'))
                        <span class="fail">{{ session('error') }}</span>
                    @endif
                    {{-- Inlog knop --}}
                    <div class="loginbutton">
                        <button type="submit" class="button_1">Inloggen</button>
                    </div>
                </form>
            </div>
        @endauth
    </div>
</nav>
<br>
