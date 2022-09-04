<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\User;
use Auth;
use App\HomePageUrl;

class GeneralFunctionController extends Controller
{
   
   public function getCartCountForWordPress(){

   	if(isset($_COOKIE["user_cookie"]))
   	{ 

	   	$cart_count=Cart::where('user_cookie',$_COOKIE["user_cookie"])->sum('total_badge_qty');
	   	
	   	return response()->json([
	   		"cart_count"=>$cart_count
	   		]);

   	}
   	else
   	{
   		return response()->json([
   			"cart_count"=>0
   			]);
   	}

   }

   public function getUserStatusForWordPress(){
      $url = HomePageUrl::first();
      if(Auth::check()){
            return response()->json([
            "login_status"=>'<a href="'.@$url->url.'/order/dashboard" class="elementor-button-link elementor-button elementor-size-sm account" role="button">
                  <span class="elementor-button-content-wrapper">
                  <span class="elementor-button-text">My Account</span>
      </span>
               </a><a href="'.@$url->url.'/order/logout" class="elementor-button-link elementor-button elementor-size-sm logout" role="button">
                  <span class="elementor-button-content-wrapper">
                  <span class="elementor-button-text">Logout</span>
      </span>
               </a>'
            ]);
      }   
      else
      {
         return response()->json([
            "login_status"=>'<a href="'.@$url->url.'/order/login" class="elementor-button-link elementor-button elementor-size-sm" role="button">
                  <span class="elementor-button-content-wrapper">
                  <span class="elementor-button-text">Login</span>
                  </span>
               </a>'
            ]);
      }

   }

}