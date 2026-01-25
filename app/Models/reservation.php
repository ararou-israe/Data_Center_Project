<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

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
   
    public function utilisateur(): BelongsTo
    {
       
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }

    public function ressource(): BelongsTo
    {
       
        return $this->belongsTo(Ressource::class, 'ressource_id');
    }

    
    public function getPeriodeAttribute()
    {
        return $this->start_at . ' au ' . $this->end_at;
    }
}