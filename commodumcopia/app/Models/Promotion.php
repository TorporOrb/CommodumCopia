<?php


/*
titel: Promotion
beschrijving: Dit model vertegenwoordigt een promotie in de webshop.
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 19 jun 2023
laatste wijzigingsdatum: 1 jul 2023
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Het promotie model
class Promotion extends Model
{
    use HasFactory;
    
    // De velden die met een formulier ingevuld kunnen worden
    protected $fillable = [
        'header',
        'sub_header',
        'text',
        'image',        
    ];
}
