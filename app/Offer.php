<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offers';
    protected $primaryKey = 'id';

    protected $casts = [
        'created_at' => 'date',
        'updated_at' => 'date',
    ];

    // public $timestamps = false;

    protected $guarded = [];



    /**
     * Relationships
     */
    public function item()
    {
        return $this->hasOne('App\Sale', 'id', 'item_id');
    }

    public function from()
    {
        return $this->hasOne('App\User', 'id', 'from');
    }



    /**
     * Query Builders Scopes
     */




    /**
     * Accessors
     */



    /**
     * Methods
     */

}
