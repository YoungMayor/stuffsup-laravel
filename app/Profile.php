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

    public function getAvatarUrlAttribute()
    {
        return "/assets/img/profile.jpg";
    }

    public function getEditAboutLinkAttribute()
    {
        return route('profile.edit.about', [
            'token' => $this->user->generateToken('edit about'),
        ]);
    }

    public function getEditContactLinkAttribute()
    {
        return route('profile.edit.contact', [
            'token' => $this->user->generateToken('edit contact'),
        ]);
    }

    public function getEditLocationLinkAttribute()
    {
        return route('profile.edit.location', [
            'token' => $this->user->generateToken('edit location'),
        ]);
    }

    public function getEditPasswordLinkAttribute()
    {
        return route('profile.edit.password', [
            'token' => $this->user->generateToken('edit password'),
        ]);
    }
}
