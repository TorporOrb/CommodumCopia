<?php

/*
titel: ReturnButton
beschrijving: De returnbutton helpt met het gebruiken van het returnbutton component. 
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 28 jun 2023
laatste wijzigingsdatum: 28 jun 2023
*/

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReturnButton extends Component
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
        return view('components.return-button');
    }
}
