<?php

namespace App;

use App\Facades\SalesImage as FacadesSalesImage;
use Illuminate\Database\Eloquent\Model;

class SalesImage extends Model
{
    protected $table = 'sales_images';
    protected $primaryKey = 'id';

    // public $timestamps = false;

    protected $guarded = [];


    /**
     * Relationships
     */
    public function item()
    {
        return $this->hasOne('App\Sale', 'id', 'item_id');
    }


    /**
     * Accessors
     */
    public function getImageURLAttribute()
    {
        return FacadesSalesImage::getURL($this->image_token);

    }

    public function getPreviewURLAttribute()
    {
        return FacadesSalesImage::getURL($this->preview_token);
    }

    public function getAllURLAttribute()
    {
        return [
            'full' => $this->getImageURLAttribute(),
            'preview' => $this->getPreviewURLAttribute()
        ];
    }

    public function getImageMetaAttribute()
    {
        return [
            'caption' => $this->caption,
            'links' => $this->all_url
        ];
    }
}
