<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Offer extends Model
{
    protected $table = 'offers';
    protected $primaryKey = 'id';

    protected $casts = [
        'created_at' => 'date',
        'updated_at' => 'date',
        'closed' => 'boolean'
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
    public function item()
    {
        return $this->hasOne('App\Sale', 'id', 'item_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'from');
    }



    /**
     * Query Builders Scopes
     */
    public function scopeOngoingOffer($query)
    {
        return $query->where('closed', 0);
    }

    public function scopeClosedOffer($query)
    {
        return $query->where('closed', 1);
    }




    /**
     * Accessors
     */
    public function getOfferLinkAttribute()
    {
        return route('offer', [
            'item' => $this->item->token,
            'offer' => $this->token
        ]);
    }

    public function getCreateReplyLinkAttribute()
    {
        return "#";
    }

    public function getOfferRepliesLinkAttribute()
    {
        return "#";
    }

    public function getCloseOfferLinkAttribute()
    {
        return "#";
    }



    /**
     * Methods
     */

}
