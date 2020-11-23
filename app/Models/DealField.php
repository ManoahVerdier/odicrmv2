<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealField extends Model
{
    use HasFactory;

    /**
     * Retourne le champ associé
     * Dans l'une des tables structure cibles possible
     * parmi clients, deals, contacts, etc.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function fieldvalues()
    {
        return $this->morphMany(
            FieldValue::class, 
            "listable", 
            "target_class", 
            "field_name", 
            "field_name"
        );
    }
}
