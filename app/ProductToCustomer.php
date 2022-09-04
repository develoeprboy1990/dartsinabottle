<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductToCustomer extends Model
{
    protected $table = 'product_to_customer';  
    
     public function getUser(){

        return $this->belongsTo('App\User', 'user_id', 'id');

    }
    public function getProduct(){

        return $this->belongsTo('App\Product', 'product_id', 'id');

    }
}