<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'updated_at', 'deleted_at', 'created_at'];

    protected $excludeVisible = ['updated_at', 'created_at', 'deleted_at', 'id', 'icon', 'percent', 'means_active'];
    protected $excludeList = ['updated_at', 'created_at', 'deleted_at'];


    /**
     * Fourni les noms des colonnes
     *
     * @return Illuminate\Support\Collection
     */
    public static function columns()
    {
        if (Step::first() ?? false) {
            return array_diff(array_keys(Step::first()->attributesToArray()), Step::first()->excludeList); 
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
        $obj = Step::first() ?? new Step;
        $columns = array_diff(array_keys($obj->attributesToArray()), $obj->excludeVisible); 
        foreach ($columns as $key=>$field) {
            $columns["$key"]=$obj->table.'.'.$field;
        }
        return $columns;
    }
}
