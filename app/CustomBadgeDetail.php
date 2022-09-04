<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomBadgeDetail extends Model
{
    public function getUser(){

    	return $this->belongsTo('App\User', 'user_id', 'id');

    }

    public function getCustomBadgeExample(){
        return $this->hasMany('App\CustomBadgeExample','custom_badge_detail_id','id');

    }

    public function getCustomBadgeAsset(){
        return $this->hasMany('App\CustomBadgeAsset','custom_badge_detail_id','id');

    }

}
