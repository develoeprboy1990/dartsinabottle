<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use App\Subscription;

class User extends Authenticatable
{
    use Notifiable,Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','stripe_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public  function  getCustomerGroup(){

        return $this->belongsTo('App\CustomerGroup','customer_group_id','id');
      
      // $customer_group=  CustomerGroup::where('id',$id)->value('name');
       
      // return $customer_group; 
    }

    public  function  getCountry(){
    
      return $this->belongsTo('App\Country','country_id','id');
      
    }

     public  function  getState(){
    
      return $this->belongsTo('App\State','state_id','id');
      
    }

     public  function  getCity(){
    
      return $this->belongsTo('App\City','city_id','id');
      
    }

    public  function  getShippingDetail(){
        return $this->hasOne('App\ShippingDetail','user_id','id');
    }

    public  function  getCart(){
        return $this->hasOne('App\Cart','user_id','id');
    }

    public  function  getSubscription(){
    
      return $this->belongsTo('App\Subscription','id','user_id');
      
    }

    public  function  check_deporit($user_id){

        $user_supcription = Subscription::where('user_id',$user_id)->orderBy('id', 'desc')->first();

        if($user_supcription->choice == 'Lend')
        {
            return 40;
        }else{
            return 50;
        }
      
    }

    


}
