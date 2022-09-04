<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';  
    
     public function getUser(){

        return $this->belongsTo('App\User', 'user_id', 'id');

    }

     public function getCurrentHolder()
    {
        return $this->hasOne('App\ProductToCustomer','product_id','id')->where('status','Shipped');
    }
    
}
