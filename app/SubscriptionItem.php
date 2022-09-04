<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionItem extends Model
{

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['subscription_id','package_id',
        'total_qty', 's_i_sub_total', 's_i_d_t','sort_1','sort_2','sort_3','s_i_d_t','stripe_id','stripe_plan','quantity'
    ];

    public function getProduct(){
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }

    public function getPackage(){
        return $this->belongsTo('App\Package', 'package_id', 'id');
    }
}