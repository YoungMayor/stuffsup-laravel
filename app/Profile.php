<?php

namespace App;

use App\Providers\StateMapServiceProvider;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = [];


    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    /**
     * Query Builder Scopes
     */



    /**
     * Accessors
     */
    public function getFullNameAttribute()
    {
        return $this->first_name ." ". $this->last_name;
    }

    public function getStateNameAttribute()
    {
        return StateMapServiceProvider::$___state_map[$this->state]['name'];
    }
}
