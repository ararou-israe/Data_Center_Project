<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Ressource;

class Categorie extends Model
{
    protected $table = 'categorie';

    protected $fillable = ['nom',];

    // Une catégorie contient plusieurs ressources
    public function ressource()
    {
        return $this->hasMany(Ressource::class, 'categorie_id');
    }
}