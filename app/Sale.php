<?php

namespace App;

use App\Providers\ItemCategoryServiceProvider;
use Illuminate\Database\Eloquent\Model;

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

    protected $guarded = [];


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


    /**
     * Accessors
     */
    public function getCategoryNameAttribute()
    {
        $category_id = $this->category;
        return self::categoryToName($category_id);
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


    protected function changeSalesState($new)
    {
        $this->is_open = $new;
        $this->save();

        return $this;
    }

    public function openSales()
    {
        return $this->changeSalesState(1);
    }

    public function closeSales()
    {
        return $this->changeSalesState(0);
    }

}
