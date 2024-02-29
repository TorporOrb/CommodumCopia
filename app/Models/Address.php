<?php


/*
titel: Address
beschrijving: Dit model vertegenwoordigt de adresgegevens van een klant. Ook is de relatie met de klant vastgelegt.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 10 jul 2023
laatste wijzigingsdatum: 11 jul 2023
*/

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;
    // Via een formulier in te vullen gegevens
    protected $fillable = [
        'address',
        'city',
        'postal_code',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
