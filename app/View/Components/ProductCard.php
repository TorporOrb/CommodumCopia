<?php


/*
titel: ProductCard
beschrijving: De productcard helpt met het gebruiken van het productcard component. 
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 20 jun 2023
laatste wijzigingsdatum: 20 jun 2023
*/

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-card');
    }
}
