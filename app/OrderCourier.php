<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderCourier extends Model
{
    public function getCourier(){

    	return $this->belongsTo('App\Courear', 'courear_id', 'id');

    }
}
