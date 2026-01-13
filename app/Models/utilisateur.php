<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;
use App\Models\Ressource;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Utilisateur extends Model
{
    protected $table = 'utilisateur';
    protected $fillable = ['nom', 'prenom', 'email', 'password', 'roles', 'status',];

    // Un utilisateur peut faire plusieurs réservations
    public function reservation()
    {
     return $this->hasMany(Reservation::class, 'utilisateur_id');
    }

    // Un utilisateur (responsable) peut gérer plusieurs ressources
    public function ressources()
    {
        return $this->hasMany(Ressource::class, 'utilisateur_id');
    }
}
