<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Categorie;
use App\Models\Reservation;
use App\Models\Utilisateur;


class Ressource extends Model
{
    protected $table = 'ressource';

    protected $fillable = [
        'categorie_id',
        'utilisateur_id',
        'code',
        'nom',
        'etat',
        'cpu',
        'ram',
        'storage',
        'os',
    ];

    // Une ressource appartient à une catégorie
    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    // Responsable/gestionnaire de la ressource (peut être null)
    public function responsable(): BelongsTo
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }

    // Une ressource peut avoir plusieurs réservations dans le temps
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'ressource_id');
    }
}
