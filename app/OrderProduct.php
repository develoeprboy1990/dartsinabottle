<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    public function getBledSize(){

    	return $this->belongsTo('App\BadgeBledSize','badge_bled_size_id','id');
    }

     public function getBadgeType(){

    	return $this->belongsTo('App\BadgeType','badge_type_id','id');
    }

    public function getBadgebgColor(){

    	return $this->belongsTo('App\BadgeColor','badge_full_bg_color_id','id');
    }

    public function getBleedColor(){

    	return $this->belongsTo('App\BadgeColor','badge_color_id','id');
    }

    public function getProduct(){
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }

    public function getPackage(){
        return $this->belongsTo('App\Package', 'package_id', 'id');
    }
}