<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BadgeDiscount;
use App\BadgeSize;

class BadgeDiscountController extends Controller
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
       $badge_details=BadgeDiscount::select('badge_discounts.*','badge_sizes.*','badge_discounts.id as discount_id','badge_sizes.id as size_id')->join('badge_sizes','badge_discounts.badge_size_id','=','badge_sizes.id')->orderBy('badge_discounts.id','DESC')->get();

       // dd($badge_details);

       $badge_sizes=BadgeSize::all(); 
       // $badge_details=BadgeDiscount::all(); 
       // dd($badge_sizes);
       return view('user.admin.badge-discount',['badge_sizes'=>$badge_sizes,'badge_details'=>$badge_details]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       foreach($request['badge_size_id'] as $badge_size_id){

          $check_existing_discount= BadgeDiscount::where(['badge_size_id'=>$badge_size_id,'quantity_from'=> $request['quantity_from'],'quantity_to'=>$request['quantity_to']])->count();
         if($check_existing_discount < 1){

          $badge_discount=  new BadgeDiscount;
          $badge_discount->badge_size_id=$badge_size_id;
          $badge_discount->quantity_from=$request['quantity_from'];
          $badge_discount->quantity_to=$request['quantity_to'];
          $badge_discount->discount_percent=$request['discount_percent'];
          $badge_discount->save();
         }   

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
        $badge_sizes=BadgeSize::all();

        $badge_discount=BadgeDiscount::where('id',$id)->first();  
        
        return response()->json([
            'badge_sizes'=>$badge_sizes,
            'badge_discount'=>$badge_discount,

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
        $existing_discount=BadgeDiscount::where([ 'badge_size_id'=>$request['badge_size_id'],'quantity_from'=>$request['quantity_from'],'quantity_to'=>$request['quantity_to'],'discount_percent'=>$request['discount_percent']])->where('id','<>',$id)->first();    
        if($existing_discount)
        {
            
            $error=true;

        }

        else{


           $badge_discount = BadgeDiscount::where('id',$id)->first();


           if($badge_discount){

              $badge_discount->badge_size_id=$request['badge_size_id'];  
              $badge_discount->quantity_from=$request['quantity_from'];  
              $badge_discount->quantity_to=$request['quantity_to'];  
              $badge_discount->discount_percent=$request['discount_percent'];  
              $badge_discount->save();
              $error=false;

            } 
          }
      
       return  response()->json([
        'error'=>$error
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
        BadgeDiscount::where('id',$id)->delete();
        return redirect()->back()->with('successmessage','Record deleted Successfully');
    }
}
