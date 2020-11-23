<?php

namespace App\Models;
use ClientFields;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldValue extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    /**
     * Retourne le champ associé
     * Dans l'une des tables structure cibles possible
     * parmi clients, deals, contacts, etc.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function field()
    {
        return $this->morphTo(
            "mainField", 
            "target_class", 
            "field_name", 
            "field_name"
        );
    }
}
