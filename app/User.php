<?php

namespace App;

use App\Providers\StateMapServiceProvider;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User  extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }


    /**
     * Relationships
     */
    public function profile()
    {
        return $this->hasOne('App\Profile')->withDefault([
            'avatar_token' => null,
            'first_name' => 'Unknown',
            'last_name' => 'User',
            'state' => StateMapServiceProvider::$___valid_map_sample['state'],
            'city' => 'unset',
            'address' => 'unknown',
            'about' => '...'
        ]);
    }

    public function sales()
    {
        return $this->hasMany('App\Sale', 'seller_id', 'id');
    }

    public function offers()
    {
        return $this->hasMany('App\Offer', 'from', 'id');
    }

    public function replies()
    {
        return $this->hasMany('App\Reply', 'from', 'id');
    }

    public function reviews_made()
    {
        return $this->hasMany('App\Review', 'reviewer_id', 'id');
    }

    public function reviews_received()
    {
        return $this->hasMany('App\Review', 'user_id', 'id');
    }

    public function reports_made()
    {
        return $this->hasMany('App\Report', 'reporter_id', 'id');
    }

    public function reports_received()
    {
        return $this->hasMany('App\Report', 'user_id', 'id');
    }


    /**
     * Methods
     */
    public function generateToken($action = 'default')
    {
        return md5(date('YMd') . $action . $this->id . env('APP_KEY'));
    }

    public function getReviewOnUser(User $user)
    {
        $review = $this
            ->reviews_made()
            ->where('user_id', $user->id)
            ->first();

        return [
            'review' => $review ? $review->review : '',
            'rating' => $review ? $review->rating : ''
        ];
    }

    public function getReviewFromUser(User $user)
    {
        $review = $this
            ->reviews_received()
            ->where('reviewer_id', $user->id)
            ->first();

        return [
            'review' => $review ? $review->review : '',
            'rating' => $review ? $review->rating : ''
        ];
    }


     /**
      * Accessors
      */
    public function getUserLinkAttribute()
    {
        return route('profile', [
            'user' => $this->name
        ]);
    }

    public function getUserSalesLinkAttribute()
    {
        return route('user.market', [
            'user' => $this->name
        ]);
    }

    public function getUserSalesPeekLinkAttribute()
    {
        return route('profile.peek.market', [
            'user' => $this->name
        ]);
    }

    public function getReceivedReviewsLinkAttribute()
    {
        return "#";
    }

    public function getReceivedReviewsPeekLinkAttribute()
    {
        return route('profile.peek.reviews', [
            'user' => $this->name
        ]);
    }

    public function getCreateReportLinkAttribute()
    {
        return route('user.create.report', [
            'user' => $this->name
        ]);
    }

    public function getCreateReviewLinkAttribute()
    {
        return route('user.create.review', [
            'user' => $this->name
        ]);
    }

    public function getAverageRatingAttribute()
    {
        return [
            'made' => $this->reviews_made()->avg('rating'),
            'received' => $this->reviews_received()->avg('rating'),
        ];
    }

}
