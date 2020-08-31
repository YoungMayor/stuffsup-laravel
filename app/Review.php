<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Review extends Model
{
    protected $table = 'reviews';
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

    public function reviewer()
    {
        return $this->hasOne('App\User', 'id', 'review_id');
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
