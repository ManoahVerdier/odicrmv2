<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class Client extends Model
{
    use HasFactory,softDeletes;

    protected $guarded = ['id'];

    protected $exclude = ['client_id', 'updated_at', 'created_at', 'deleted_at'];

    /**
     * Lien vers les données de contrat
     *
     * @return \app\models\ClientContract
     */
    public function contract() 
    {
        return $this->hasOne(ClientContract::class);
    }

    /**
     * Lien vers les données de contrat
     *
     * @return \app\models\ClientCommercial
     */
    public function commercial() 
    {
        return $this->hasOne(ClientCommercial::class);
    }

    /**
     * Fourni les noms des colonnes
     *
     * @return Illuminate\Support\Collection
     */
    public static function columns()
    {
        if (Client::first() ?? false) {
            return array_diff(array_keys(Client::first()->attributesToArray()), Client::first()->exclude); 
        } else {
            return array();
        }
    }

    public static function columnsWithExtended()
    {
        $client = Client::columns();
        
        $client[0]="clients.id";

        $contract = ClientContract::columns();
        
        $commercial = ClientCommercial::columns();
        
        return array_merge($client, $contract, $commercial);
    }
}
