<?php
namespace App\Models;

// On remplace le Model de base par Authenticatable
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Utilisateur extends Authenticatable
{
    use Notifiable;

    protected $table = 'utilisateur';
    
    // Ajoute 'password' dans les fillable (déjà fait, c'est bien)
    protected $fillable = ['nom', 'prenom', 'email', 'password', 'roles', 'status'];

    // On cache le mot de passe pour la sécurité
    protected $hidden = ['password', 'remember_token'];

    public function reservation(): HasMany
    {
        return $this->hasMany(Reservation::class, 'utilisateur_id');
    }

    public function ressources(): HasMany
    {
        return $this->hasMany(Ressource::class, 'utilisateur_id');
    }
}