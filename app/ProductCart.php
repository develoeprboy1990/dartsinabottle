<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
   protected $table = 'product_carts';  

   public function getProduct(){
    	return $this->belongsTo('App\Product', 'product_id', 'id');
    }
    
}
