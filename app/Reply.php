<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Reply extends Model
{
    use SoftDeletes;


    protected $table = 'replies';
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
    public function offer()
    {
        return $this->hasOne('App\Offer', 'id', 'offer_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'from');
    }



    /**
     * Query Builders Scopes
     */





    /**
     * Accessors
     */

    public function getEditReplyLinkAttribute()
    {
        return route('reply.edit', [
            'item' => $this->offer->item->token,
            'offer' => $this->offer->token,
            'reply' => $this->token,
            'token' => $this->user->generateToken('edit reply')
        ]);
    }

    public function getDeleteReplyLinkAttribute()
    {
        return route('reply.delete', [
            'item' => $this->offer->item->token,
            'offer' => $this->offer->token,
            'reply' => $this->token,
            'token' => $this->user->generateToken('delete reply')
        ]);
    }

    public function getIAmAuthorAttribute()
    {
        return Auth::check() && $this->from == Auth::id();
    }



    /**
     * Methods
     */

}
