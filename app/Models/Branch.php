<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, softDeletes;

    protected $guarded = ['id', 'updated_at', 'deleted_at', 'created_at'];

    protected $excludeVisible = ['client_id', 'updated_at', 'created_at', 'deleted_at', 'id', 'code'];
    protected $excludeList = ['client_id', 'updated_at', 'created_at', 'deleted_at'];


    /**
     * Fourni les noms des colonnes
     *
     * @return Illuminate\Support\Collection
     */
    public static function columns()
    {
        if (Branch::first() ?? false) {
            return array_diff(array_keys(Branch::first()->attributesToArray()), Branch::first()->excludeList); 
        } else {
            return array('id','name');
        }
    }

    /**
     * Fourni les noms des colonnes
     *
     * @return Illuminate\Support\Collection
     */
    public static function columnsVisible()
    {
        $obj = Branch::first() ?? new Branch;
        $columns = array_diff(array_keys($obj->attributesToArray()), $obj->excludeVisible); 
        foreach ($columns as $key=>$field) {
            $columns["$key"]=$obj->table.'.'.$field;
        }
        return $columns;
    }

    function agents()
    {
        return $this->hasMany(Agent::class);
    }
}
