<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\State;
use App\City;

class CountryStateCity extends Controller
{
    

   public function filterState(){

        if(isset($_GET['country_id'])){
       		
       		$country_id=$_GET['country_id'];

        }	
       
       $states = State::where(['country_id'=>$country_id])->orderBy('name','ASC')->get();
       
       return response()->json(
        $states
        );

    }

    public function filterCity(){

       if(isset($_GET['state_id'])){	
        $state_id=$_GET['state_id'];
    	}
    	
       $cities = City::where(['state_id'=>$state_id])->get();
       
       return response()->json(
        $cities
        );

    }



}
