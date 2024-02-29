<?php


/*
titel: User
beschrijving: Dit model vertegenwoordigt een gebruiker in de webshop. 
    Ook wordt er gekeken of een gebruiker admin rechten heeft en wordt de relatie met het winkelmandje, de adresgegevens en de order vastgelegd. 
auteur: Pascal Thomasse Mol
versie: 3
aanmaakdatum: 19 jun 2023
laatste wijzigingsdatum: 20 jul 2023
*/

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Address;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    // De velden die met een formulier ingevuld kunnen worden
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // Methode om te controleren of de gebruiker een admin is
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    // Relatie met de CartItem model, een gebruiker kan meerdere winkelwagenitems hebben
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
        // Relatie met de Address model, een gebruiker kan meerdere adressen hebben
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
        // Relatie met de Order model, een gebruiker kan meerdere orders hebben
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
