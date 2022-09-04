<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingDetail extends Model
{
    
	public function getCountry(){

    	return $this->belongsTo('App\Country','country_id','id');
    }

    public function getCity(){

    	return $this->belongsTo('App\City','city_id','id');
    }

     public function getState(){

    	return $this->belongsTo('App\State','state_id','id');
    }
}
