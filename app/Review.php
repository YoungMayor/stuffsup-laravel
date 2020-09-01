<?php

namespace App;

use App\Events\ReviewMade;
use App\Events\ReviewUpdated;
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

    protected $dispatchesEvents = [
        'created' => ReviewMade::class,
        'updated' => ReviewUpdated::class
    ];

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
        return $this->hasOne('App\User', 'id', 'reviewer_id');
    }



    /**
     * Query Builders Scopes
     */





    /**
     * Accessors
     */

    public function getEditReviewLinkAttribute()
    {
        return "#";
        return route('reply.edit', [
            'item' => $this->offer->item->token,
            'offer' => $this->offer->token,
            'reply' => $this->token,
            'token' => $this->user->generateToken('edit reply')
        ]);
    }

    public function getDeleteReviewLinkAttribute()
    {
        return "#";
        return route('reply.delete', [
            'item' => $this->offer->item->token,
            'offer' => $this->offer->token,
            'reply' => $this->token,
            'token' => $this->user->generateToken('delete reply')
        ]);
    }

    public function getIAmAuthorAttribute()
    {
        return Auth::check() && $this->reviewer_id == Auth::id();
    }



    /**
     * Methods
     */

}
