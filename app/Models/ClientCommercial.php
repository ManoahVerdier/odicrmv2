<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientCommercial extends Model
{
    use HasFactory,softDeletes;

    protected $table = 'clients_commercials';
    protected $guarded = ['id', 'client_id', 'updated_at', 'created_at', 'deleted_at'];
    protected $exclude = ['id', 'client_id', 'updated_at', 'created_at', 'deleted_at'];

    /**
     * Lien vers le client associé
     *
     * @return \App\models\Client
     */
    public function client()
    {
        return $this->belongsTo(Clients::class);
    }

    /**
     * Lien vers le commercial associé
     *
     * @return \App\models\Agent
     */
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    /**
     * Fourni les noms des colonnes
     *
     * @return Illuminate\Support\Collection
     */
    public static function columns()
    {
        if (ClientCommercial::first() ?? false) {
            return array_diff(array_keys(ClientCommercial::first()->attributesToArray()), ClientCommercial::first()->exclude); 
        } else {
            return array();
        }
    }
}
