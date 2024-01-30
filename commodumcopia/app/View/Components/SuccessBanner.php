<?php

/*
titel: SuccesBanner
beschrijving: De succesbanner helpt met het gebruiken van het succesbanner component. 
auteur: Pascal Thomasse Mol
versie: 1
aanmaaktdatum: 27 jun 2023
laatste wijzigingsdatum: 27 jun 2023
*/

namespace App\View\Components;

use Illuminate\View\Component;

class SuccessBanner extends Component
{
    public function render()
    {
        return view('components.success-banner');
    }
}