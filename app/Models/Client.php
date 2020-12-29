<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory,softDeletes;

    protected $guarded = ['id', 'updated_at', 'deleted_at', 'created_at'];

    protected $exclude = ['client_id', 'updated_at', 'created_at', 'deleted_at', 'branch_id'];

    protected $exclude_extended = ['branch_code', 'agent_id'];

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
     * Lien vers les données de contrat
     *
     * @return \app\models\Branch
     */
    public function branch() 
    {
        return $this->hasOne(Branch::class);
    }

    /**
     * Liste les deals liés
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function deals()
    {
        return $this->morphMany(
            Deal::class, 
            "mainTarget", 
            "target_class", 
            "target_id", 
            "id"
        );
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
        
        foreach ($client as $key=>$field) {
            $client["$key"]='clients.'.$field;
        }

        $client[0]="clients.id";
        
        $contract = ClientContract::columns();
        
        $commercial = ClientCommercial::columns();

        $agent = Agent::columnsVisible();

        $branch = Branch::columnsVisible();
        
        $obj = new Client;
        return array_diff(
            array_merge(
                $client, 
                $contract, 
                $commercial,
                $agent,
                $branch
            ), 
            $obj->exclude_extended
        );
    }
}
