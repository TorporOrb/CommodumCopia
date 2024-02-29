{{--
titel: Post Card Blade
beschrijving: Het herbruikbare post component.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 22 jun 2023
laatste wijzigingsdatum: 06 jul 2023
--}}

@props(['post'])


<div class="postComponent container">
    {{-- Link naar de betreffende post --}}
    <a href="{{ route('posts.show', ['id' => $post->id]) }}">
        {{-- De afbeelding --}}
        <img src="{{ asset(str_replace('uploads/', 'uploads/image/', $post->image)) }}" class="rounded"
            style="width: 100%;" alt="Post Image">
    </a>
    {{-- De headers --}}
    <div class="headerTL">
        <h1>{{ $post->header }}</h1>
        <h2>{{ $post->sub_header }}</h2>
    </div>
    {{-- De tekst --}}
    <div class="textBL">
        <h4>{{ $post->text }}</h4>
    </div>
</div>
