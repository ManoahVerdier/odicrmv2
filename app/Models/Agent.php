<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use HasFactory, softDeletes;

    protected $guarded = ['id', 'updated_at', 'deleted_at', 'created_at'];

    protected $excludeVisible = ['client_id', 'updated_at', 'created_at', 'deleted_at', 'code_societe', 'active', 'branch_id', 'id'];
    protected $excludeList = ['client_id', 'updated_at', 'created_at', 'deleted_at', 'code_societe', 'branch_id'];

    /**
     * Fourni les noms des colonnes
     *
     * @return Illuminate\Support\Collection
     */
    public static function columnsVisible()
    {
        $obj = Agent::first() ?? new Agent;
        $columns = array_diff(array_keys($obj->attributesToArray()), $obj->excludeVisible); 
        foreach ($columns as $key=>$field) {
            $columns["$key"]=$obj->table.'.'.$field;
        }
        return $columns;
    }

    public static function columnsList()
    {
        $obj = Agent::first() ?? new Agent;
        $agent = array_diff(array_keys($obj->attributesToArray()),$obj->excludeList);
        foreach ($agent as $key=>$field) {
            $agent["$key"]='agents.'.$field;
        }

        $branch = collect(Branch::columnsVisible())->except(0);


        return array_diff(array_merge($agent, $branch->toArray()), $obj->excludeList);
    }

    /**
     * Lien vers la societe associé
     *
     * @return \App\models\Branch
     */
    function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
