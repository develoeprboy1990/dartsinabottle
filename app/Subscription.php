<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Subscription extends Model
{

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['order_number','user_id',
        'order_type', 'payment_type_id', 'payment_status','sort_1','sort_2','sort_3','shipping_id','sub_total','discounted_total','deposit_cost','total','status',
        'stripe_plan','quantity','stripe_id'
    ];


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
        return $this->hasOne('App\SubscriptionItem','subscription_id','id');
    }

    public function lent_darts($user_id)
    {
        $lent_darts = Product::where('user_id',$user_id)->first();

        if($lent_darts)
        {
            return true;
        }else{
            return false;
        }
    }
    
}