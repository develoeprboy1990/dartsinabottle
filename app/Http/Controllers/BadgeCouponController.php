<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BadgeCoupon;
use App\BadgeSize;
use App\OrderDetail;

class BadgeCouponController extends Controller
{
     public function __construct(){

        $this->middleware('adminlogin');
        $this->middleware('shipper');
        $this->middleware('designer');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $badge_coupons=BadgeCoupon::all(); 

       return view('user.admin.badge-coupon',['badge_coupons'=>$badge_coupons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    $check_existing_coupon= BadgeCoupon::where(['coupon_code'=> $request['coupon_code'],'type'=>$request['type'],'discount'=>$request['discount'],'number_to_be_used'=>$request['number_to_be_used'],'expiry_date'=>$request['expiry_date']])->count();

         if($check_existing_coupon < 1){
          $badge_coupon=  new BadgeCoupon;
          $badge_coupon->coupon_code=$request['coupon_code'];
          $badge_coupon->type=$request['type'];
          $badge_coupon->discount=$request['discount'];
          $badge_coupon->number_to_be_used=$request['number_to_be_used'];
          $badge_coupon->expiry_date=$request['expiry_date'];
          $badge_coupon->save();
         }  

     
     return redirect()->back()->with('successmessage','Bade Discount added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $badge_coupon=BadgeCoupon::where('id',$id)->first();  
        
        return response()->json([
            'badge_coupon'=>$badge_coupon,

            ]);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $existing_coupon=BadgeCoupon::where(['coupon_code'=>$request['coupon_code'],'type'=>$request['type'],'discount'=>$request['discount'],'number_to_be_used'=>$request['number_to_be_used'],'expiry_date'=>$request['expiry_date']])->where('id','<>',$id)->first();    
        if($existing_coupon)
        {
            $error=true;
        }
        else{
           $badge_coupon = BadgeCoupon::where('id',$id)->first();
           if($badge_coupon){
              $badge_coupon->coupon_code=$request['coupon_code'];  
              $badge_coupon->type=$request['type'];  
              $badge_coupon->discount=$request['discount'];  
              $badge_coupon->discount=$request['discount'];  
              $badge_coupon->number_to_be_used=$request['number_to_be_used'];  
              $badge_coupon->expiry_date=$request['expiry_date']; 
              $badge_coupon->save();
              $error=false;

            } 
          }
 
       return  response()->json([
        'error'=>$error,
        'badge_size_id'=>$request['badge_size_id']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BadgeCoupon::where('id',$id)->delete();
        return redirect()->back()->with('successmessage','Record deleted Successfully');
    }

    public function check_coupon(Request $request){
   
   /*   $coupon_limit_not_exceed = $coupon_exist=BadgeCoupon::where('coupon_code',$request['coupon_code'])
    ->where('status','Active')
    ->where('expiry_date','>=',date('Y-m-d'))
    ->where('number_to_be_used','>',0)->first();
   */
      $msg = '';
      $error = false;
      $subtotal = $request['subtotal'];
      $coupon_discount = 0;
     

  $coupon_exist=BadgeCoupon::where('coupon_code',$request['coupon_code'])->where('status','Active')->first();
  if($coupon_exist)
  {
    if($coupon_exist->expiry_date >=date('Y-m-d'))
    {
         
        if($coupon_exist->number_to_be_used > 0)
        {
          $user_used=OrderDetail::where('coupon_code',$request['coupon_code'])
          ->where('user_id','=',$request['user_id'])->first();
          if($user_used){
          $error = true;
          $msg = 'Soory, you already used this Promo Code.';
          } 
          else{
          if($coupon_exist['type'] == 'Fixed')
          {
            if($coupon_exist['discount'] <= $subtotal ){
        $coupon_discount = $coupon_exist['discount'];
        $subtotal = $subtotal - $coupon_exist['discount'];
        $msg =  '$'.$coupon_exist['discount'].' discount is applied on Sub total';

            }
            else
            {
            $error = true;
            $msg = 'Soory, Promo Code price is greater then the subtotal.';
            }
          }
          else
          {
         // $x = $coupon_exist['discount'];
         // $y = $subtotal;
         // $percent = $x/$y;          
//$percent_friendly = number_format( $percent * 100, 2 );


$myNumber = $subtotal;
 
//I want to get 25% of 928.
$percentToGet = $coupon_exist['discount'];
 
//Convert our percentage value into a decimal.
$percentInDecimal = $percentToGet / 100;
 
//Get the result.
$percent_friendly = $percentInDecimal * $myNumber;

          if( $percent_friendly <= $subtotal ){
          $coupon_discount = $percent_friendly;
          $subtotal = $subtotal - $percent_friendly;
          $msg = $coupon_exist['discount'].'% discount is applied on this Order';
          }
          else
          {
          $error = true;
          $msg = $percent_friendly.'Soory, Promo Code price is greater then the subtotal.';
          }
          }
        }

        }else{
          $error=true;
          $msg = 'Sorry, this Promo Code limit exceeded.';
        }

    }else{
      $error=true;
      $msg = 'Sorry, this Promo Code is expired.';
    }
}
  else{
  $error=true;
  $msg = 'Sorry, this Promo Code is not valid.';  
  }



      return  response()->json([
        'error'=>$error,
        'msg'=>$msg,
        'coupon_discount'=>$coupon_discount,
        'subtotal'=>$subtotal
        ]);

    }

}
