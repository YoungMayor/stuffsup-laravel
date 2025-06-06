<?php

namespace App;

use App\Providers\ItemCategoryServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Sale extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';

    protected $casts = [
        'created_at' => 'date',
        'updated_at' => 'date',
        'is_public' => 'boolean',
        'is_open' => 'boolean',
    ];

    // public $timestamps = false;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'seller',
        'seller.profile',
        'images',
        'locations'
    ];

    /**
     * The relationship counts that should be eager loaded on every query.
     *
     * @var array
     */
    protected $withCount = [
        'offers',
        'images',
        'locations'
    ];

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'token';
    }


    /**
     * Relationships
     */
    public function seller()
    {
        return $this->hasOne('App\User', 'id', 'seller_id');
    }

    public function images()
    {
        return $this->hasMany('App\SalesImage', 'item_id', 'id');
    }

    public function locations()
    {
        return $this->hasMany('App\SalesLocation', 'item_id', 'id');
    }

    public function offers()
    {
        return $this->hasMany('App\Offer', 'item_id', 'id');
    }


    /**
     * Query Builders Scopes
     */
    public function scopePublicAuction($query)
    {
        return $query->where('is_public', 1);
    }

    public function scopePrivateAuction($query)
    {
        return $query->where('is_public', 0);
    }

    public function scopeOngoingSales($query)
    {
        return $query->where('is_open', 1);
    }

    public function scopeClosedSales($query)
    {
        return $query->where('is_open', 0);
    }

    public function scopeFromState($query, $location)
    {
        $query = $query
            ->join('sales_locations', 'sales.id', 'sales_locations.item_id')
            ->addSelect('sales.created_at as created_at');

        // $query->orWhere('sales_locations.state', '0');

        if ($location == "0"){
            return $query;
        }else{
            return $query->where('sales_locations.state', $location);
        }
    }

    public function scopeInCategory($query, $category)
    {
        return $query->where('sales.category', 'LIKE', "$category%");
    }

    public function scopeSearchFor($query, $search)
    {
        return $query
            ->where('sales.title', 'LIKE', "%$search%")
            ->orWhere('sales.description', 'LIKE', "%$search%");
    }


    /**
     * Accessors
     */
    public function getCategoryNameAttribute()
    {
        $category_id = $this->category;
        return self::categoryToName($category_id);
    }

    public function getMainImageAttribute()
    {
        if ($this->images->all()){
            return $this->images()->first()->image_meta;
        }else{
            return null;
        }
    }

    public function getCreateOfferLinkAttribute()
    {
        return route('offer.create', [
            'item' => $this->token
        ]);
    }

    public function getItemLinkAttribute()
    {
        return route('item', [
            'item' => $this->token
        ]);
    }

    public function getItemOffersLinkAttribute()
    {
        return route('item.offers', [
            'item' => $this->token
        ]);
    }

    public function getCloseSaleLinkAttribute()
    {
        return route('sale.close', [
            'item' => $this->token,
            'token' => $this->seller->generateToken('close sale')
        ]);
    }

    public function getIAmSellerAttribute()
    {
        return Auth::check() && $this->seller_id == Auth::id();
    }


    /**
     * Methods
     */
    public static function categoryToName($category_id)
    {
        $category_flow = str_split($category_id, 2);
        $categories = ItemCategoryServiceProvider::$___categories;

        $res = $categories;
        $flow_depth = count($category_flow);
        foreach ($category_flow as $key => $flow) {
            if ($key == 0){
                // the first
                if (isset($res[$flow])){
                    $res = $res[$flow];
                }else{
                    return null;
                }
            }else{
                //every other
                if (isset($res['sub'], $res['sub'][$flow])){
                    $res = $res['sub'][$flow];
                }else{
                    return null;
                }
            }
        }
        if (isset($res['sub'])){
            return $res['sub'][10]['name'];
        }else{
            return $res['name'];
        }
    }

    protected function changeAuctionState($new)
    {
        $this->is_public = $new;
        $this->save();

        return $this;
    }

    public function makeAuctionPublic()
    {
        return $this->changeAuctionState(1);
    }

    public function makeAuctionPrivate()
    {
        return $this->changeAuctionState(0);
    }


    protected function changeSalesState($new, $reason = null)
    {
        $this->is_open = $new;
        $this->reason_for_close = $reason;
        $this->closed_at = strlen($reason) > 1 ? now() : null;
        $this->save();

        return $this;
    }

    public function openSales()
    {
        return $this->changeSalesState(1);
    }

    public function closeSales($reason = null)
    {
        return $this->changeSalesState(0, $reason);
    }

}
