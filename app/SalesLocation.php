<?php

namespace App;

use App\Providers\StateMapServiceProvider;
use Illuminate\Database\Eloquent\Model;

class SalesLocation extends Model
{
    protected $table = 'sales_locations';
    protected $primaryKey = 'id';

    // public $timestamps = false;

    protected $guarded = [];


    /**
     * Relationships
     */
    public function item()
    {
        return $this->hasOne('App\Sale', 'id', 'item_id');
    }


    /**
     * Acccessors
     */
    public function getStateNameAttribute()
    {
        $state_id = $this->state;
        $states = StateMapServiceProvider::$___state_map;

        if (!isset($states[$state_id])){
            return "No Delivery State Given";
        }else{
            return $states[$state_id]['name'];
        }
    }
}
