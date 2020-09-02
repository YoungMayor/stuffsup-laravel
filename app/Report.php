<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Report extends Model
{
    protected $table = 'reports';
    protected $primaryKey = 'id';

    protected $casts = [
        'created_at' => 'date',
        'updated_at' => 'date',
    ];

    // public $timestamps = false;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'token';
    }



    /**
     * Relationships
     */
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function reporter()
    {
        return $this->hasOne('App\User', 'id', 'reporter_id');
    }



    /**
     * Query Builders Scopes
     */





    /**
     * Accessors
     */

    public function getIAmAuthorAttribute()
    {
        return Auth::check() && $this->reporter_id == Auth::id();
    }



    /**
     * Methods
     */

}
