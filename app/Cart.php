<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $fillable = [
        'user_cookie', 'user_id', 'package_id','price','deposit_cost','darts_set','darts_interval','choice'
    ];


    public function getSize(){

    	return $this->belongsTo('App\BadgeSize', 'badge_size_id', 'id');

    }

    public function getProduct(){
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }

    public function getBadgeColor(){

    	return $this->belongsTo('App\BadgeColor', 'badge_color_id', 'id');

    }

    public function getCardFont(){

    	return $this->belongsTo('App\CardFont', 'card_font_id', 'id');

    }

     public function getBadgeType(){

    	return $this->belongsTo('App\BadgeType', 'badge_type_id', 'id');

    }

    public function getBadgeBled(){

    	return $this->belongsTo('App\BadgeBledSize', 'badge_bled_size_id', 'id');

    }


}
