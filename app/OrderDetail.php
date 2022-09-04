<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    
	 public function getUser(){

    	return $this->belongsTo('App\User', 'user_id', 'id');

    }

    public function getShippingDetail(){

        return $this->belongsTo('App\ShippingDetail', 'shipping_id', 'id');

    }

    public function getBillingDetail()
    {
        return $this->hasOne('App\BillingDetail','order_details_id','id');
    }

    public function getAuthorizeProfile()
    {
        return $this->hasOne('App\AuthorizeCustomerProfile','user_id','user_id')->where('status',1);
    }
    
    public function getOrderAsset(){
        return $this->hasMany('App\OrderAsset','order_detail_id','id');

    }

     public function getCustomBadgeDetail(){

        return $this->belongsTo('App\CustomBadgeDetail', 'custom_badge_detail_id', 'id');

    }

      public function getPaymentType(){

        return $this->belongsTo('App\PaymentType', 'payment_type_id', 'id');

    }

    public function getProductDetail()
    {
        return $this->hasOne('App\OrderProduct','order_details_id','id');
    }

   




}
