<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Categorie;
use App\Models\Reservation;


class Ressource extends Model
{
    protected $table = 'ressource';

    protected $fillable = [
        'categorie_id',
        'code',
        'nom',
        'etat',
        'description',
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

    

    // Une ressource peut avoir plusieurs réservations dans le temps
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'ressource_id');
    }
}
