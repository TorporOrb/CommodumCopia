{{--
titel: Address index Blade
beschrijving: De index pagina voor de administratieve taken.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 20 jun 2023
laatste wijzigingsdatum: 30 jun 2023
--}}

{{-- De index pagina voor de administratieve taken. --}}
<x-layout>
    <div class="container">
        <h1 class="row py-5 display-4" style="border-bottom: 2px solid #2691d9;">Admin Home</h1>
        <br>
        {{-- Producten aanmaken en aanpassen --}}
        <h2 class="display-6" >Product Beheer</h2>
        <br>
        <div class="row py-5" style="border-bottom: 2px solid #2691d9;">
            <div class="col-md-6">
                <div class="text-center image-container">
                    {{-- link naar de create product pagina --}}
                    <a href="{{ route('products.create')}}">
                        <h4 class="lead">Product Aanmaken</h4>
                        <img src="{{ asset('images/product.png') }}"  style="width:100px; margin-top:1rem;" alt="post">
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                {{-- link naar de pagina om gemaakte producten te beheren --}}
                <a href="{{ route('products.index')}}">
                    <div class="text-center image-container">
                        <h4 class="lead">Product Aanpassen</h4>
                        <img src="{{ asset('images/editProduct.png') }}" style="width:100px; margin-top:1rem;" alt="edit">
                    </div>
                </a>
            </div>
        </div>
        <br>  
        {{-- Posts aanmaken en aanpassen --}}
        <h2 class="display-6">Post Beheer</h2>
        <br>
        <div class="row py-5" style="border-bottom: 2px solid #2691d9;">
            <div class="col-md-6">
                <div class="text-center image-container">
                    {{-- link naar de create product pagina --}}
                    <a href="{{ route('posts.create')}}">
                        <h4 class="lead">Post Aanmaken</h4>
                        <img src="{{ asset('images/post.png') }}"  style="width:100px; margin-top:1rem;" alt="post">
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                {{-- link naar de pagina om gemaakte producten te beheren --}}
                <a href="{{ route('posts.index')}}">
                    <div class="text-center image-container">
                        <h4 class="lead">Post Aanpassen</h4>
                        <img src="{{ asset('images/editPost.png') }}" style="width:100px; margin-top:1rem;" alt="edit">
                    </div>
                </a>
            </div>
        </div>
        <br>  
        {{-- Promoties aanmaken en aanpassen --}}
        <h2 class="display-6">Promotie Beheer</h2>
        <br>
        <div class="row py-5" style="border-bottom: 2px solid #2691d9;">
            <div class="col-md-6">
                <div class="text-center image-container">
                    {{-- link naar de create product pagina --}}
                    <a href="{{ route('promotions.create')}}">
                        <h4 class="lead">Promotie Aanmaken</h4>
                        <img src="{{ asset('images/promotion.png') }}"  style="width:100px; margin-top:1rem;" alt="post">
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                {{-- link naar de pagina om gemaakte producten te beheren --}}
                <a href="{{ route('promotions.index')}}">
                    <div class="text-center image-container">
                        <h4 class="lead">Promotie Aanpassen</h4>
                        <img src="{{ asset('images/editPromotion.png') }}" style="width:100px; margin-top:1rem;" alt="edit">
                    </div>
                </a>
            </div>
        </div>
        <br>  
        {{-- Gebruikers aanmaken en aanpassen --}}
        <h2 class="display-6">Gebruikers Beheer</h2>
        <br>
        <div class="row py-5" style="border-bottom: 2px solid #2691d9;">
            <div class="col-md-6">
                <div class="text-center image-container">
                    {{-- link naar de create product pagina --}}
                    <a href="{{ route('admin.users.create')}}">
                        <h4 class="lead">Gebruiker Aanmaken</h4>
                        <img src="{{ asset('images/user.jpg') }}" style="width:100px; margin-top:1rem;" alt="post">
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                {{-- link naar de pagina om gemaakte producten te beheren --}}
                <a href="{{ route('admin.users.index')}}">
                    <div class="text-center image-container">
                        <h4 class="lead">Gebruiker Aanpassen</h4>
                        <img src="{{ asset('images/users.jpg') }}" style="width:100px; margin-top:1rem;" alt="edit">
                    </div>
                </a>
            </div>
        </div>
        <br>  
        {{-- Gebruikers aanmaken en aanpassen --}}
        <h2 class="display-6">Orders Beheren</h2>
        <br>
        <div class="row py-5" style="border-bottom: 2px solid #2691d9;">
            <div class="col-md-6">
                <div class="text-center image-container">
                    {{-- link naar de create product pagina --}}
                    <a href="{{ route('admin.orders.index') }}">
                        <h4 class="lead">Orders inzien</h4>
                        <img src="{{ asset('images/orders.png') }}" style="width:100px; margin-top:1rem;" alt="post">
                    </a>
                </div>
            </div>           
        </div>
</x-layout>