<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    /**
     * Retourne le champ associé
     * Dans l'une des tables structure cibles possible
     * parmi clients, deals, contacts, etc.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function values()
    {
        return $this->hasMany(
            FieldValue::class
        );
    }

    
}
