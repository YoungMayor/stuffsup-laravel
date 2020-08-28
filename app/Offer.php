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

    public function replies()
    {
        return $this->hasMany('App\Reply', 'offer_id', 'id');
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
        return route('reply.create', [
            'item' => $this->item->token,
            'offer' => $this->token
        ]);
    }

    public function getOfferRepliesLinkAttribute()
    {
        return route('offer.replies', [
            'item' => $this->item->token,
            'offer' => $this->token
        ]);
    }

    public function getCloseOfferLinkAttribute()
    {
        return route('offer.close', [
            'item' => $this->item->token,
            'offer' => $this->token,
            'token' => $this->item->seller->generateToken('close offer')
        ]);
    }



    /**
     * Methods
     */
    protected function changeOfferState($new, $reason = null)
    {
        $this->closed = $new;
        $this->reason_for_close = $reason;
        $this->save();

        return $this;
    }

    public function openOffer()
    {
        return $this->changeOfferState(0);
    }

    public function closeOffer($reason = null)
    {
        return $this->changeOfferState(1, $reason);
    }

}
