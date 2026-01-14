<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $table = 'reservation';

    protected $fillable = [
        'utilisateur_id',
        'ressource_id',
        'status',
        'justification',
        'date_debut',
        'date_fin',
        'decision_note',
    ];

    // La réservation appartient à un utilisateur
    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }

    // La réservation appartient à une ressource
    public function ressource(): BelongsTo
    {
        return $this->belongsTo(Ressource::class, 'ressource_id');
    }
}
