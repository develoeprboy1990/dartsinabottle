<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerCustomPaymentType extends Model
{
    public function getPaymentType(){

    	return $this->belongsTo('App\PaymentType','payment_type_id','id');
    }
}
