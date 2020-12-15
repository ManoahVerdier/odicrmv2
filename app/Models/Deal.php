<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deal extends Model
{
    use HasFactory, softDeletes;

    protected $exclude_extended = ['branch_id', 'agent_id', 'step_id', 'other_id', 'target', 'target_id', 'target_class'];
    protected $exclude = ['updated_at', 'created_at', 'deleted_at'];

    public static function columnsWithExtended()
    {
        $obj = new Deal;
        $deal = Deal::columns();
        $deal = array_diff($deal, $obj->exclude_extended);
        foreach ($deal as $key=>$field) {
            $deal["$key"]='deals.'.$field;
        }

        $deal[0]="deals.id";

        $agent = Agent::columnsVisible();

        $branch = Branch::columnsVisible();
        
        
        return array_diff(
            array_merge(
                $deal, 
                $agent,
                $branch
            ), 
            $obj->exclude_extended
        );
    }

    /**
     * Fourni les noms des colonnes
     *
     * @return array
     */
    public static function columns()
    {
        if (Deal::first() ?? false) {
            return array_diff(array_keys(Deal::first()->attributesToArray()), Deal::first()->exclude); 
        } else {
            return array();
        }
    }
}
