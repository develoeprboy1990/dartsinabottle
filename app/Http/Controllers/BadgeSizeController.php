<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BadgeSize;
use App\BadgeType;
use App\BadgeSizeTypes;
use App\BadgeDiscount;
use File;

class BadgeSizeController extends Controller
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
        $badge_types = BadgeType::all();
       $badge_sizes=BadgeSize::orderBy('id','DESC')->get(); 
       return view('user.admin.add-badge-size',['badge_sizes'=>$badge_sizes,'badge_types'=>$badge_types]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // return view('user.admin.badge-size');
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $existing_size=BadgeSize::where(['size_from'=>$request['size_from'],'size_to'=>$request['size_to']])->first();    
        if($existing_size)
        {
        return redirect()->back()->with('successmessage','Bade with this size aalready exists');

        }
        else{

            if($request->hasFile('image') && $request->image->isValid())
            {
                $extension=$request->image->extension();
                $filename=date('m-d-Y').mt_rand(999,999999).'__'.time().'.'.$extension;
                $request->image->move(public_path('uploads/badge_img'),$filename);

               
            }

            else
            {
                $filename=null;
            }

            if($request->hasFile('empty_image') && $request->empty_image->isValid())
            {
                $extension=$request->empty_image->extension();
                $empty_image_file='empty_'.date('m-d-Y').mt_rand(999,999999).'__'.time().'.'.$extension;
                $request->empty_image->move(public_path('uploads/badge_img'),$empty_image_file);

                
            }

            else
            {
                $empty_image_file=null;
            }

            if($request->hasFile('transparent_image') && $request->transparent_image->isValid())
            {
                $extension=$request->transparent_image->extension();
                $transparent_image_file='empty_'.date('m-d-Y').mt_rand(999,999999).'__'.time().'.'.$extension;
                $request->transparent_image->move(public_path('uploads/badge_img'),$transparent_image_file);

                
            }

            else
            {
                $transparent_image_file=null;
            }

            $badge_size=new BadgeSize;
            $badge_size->size_from=$request['size_from'];
            $badge_size->size_to=$request['size_to'];
            $badge_size->price=$request['price'];
            $badge_size->weight=$request['weight'];
            $badge_size->image=$filename;
            $badge_size->empty_image=$empty_image_file;
            $badge_size->transparent_image=$transparent_image_file;
            $badge_size->save();

            foreach ($request->a_badge_types as $a_badge_type) {
            $badge_size_type = new BadgeSizeTypes;
            $badge_size_type->badge_size_id = $badge_size->id;
            $badge_size_type->badge_type_id = $a_badge_type;
            $badge_size_type->save();
        }
        }
       

        return redirect()->back()->with('successmessage','Bade Size added successfully');
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
       $badge_size = BadgeSize::where('id',$id)->first();
       $badge_size_types = BadgeSizeTypes::where('badge_size_id' , $id)->pluck('badge_type_id')->toArray();
       return response()->json([

        'result'=>$badge_size,
        'badge_size_types'=>$badge_size_types

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
       $existing_size=BadgeSize::where(['size_from'=>$request['size_from'],'size_to'=>$request['size_to']])->where('id','<>',$id)->first();    
        if($existing_size)
        {
            
            $error=true;

        }

        else{


           $badge_size = BadgeSize::where('id',$id)->first();


           if($badge_size){

              $badge_size->size_from=$request['size_from'];  
              $badge_size->size_to=$request['size_to'];  
              $badge_size->weight=$request['weight'];  
              $badge_size->price=$request['price'];  

              $badge_size->save();

              $error=false;

            } 
          }

        $delete_badge_type_size = BadgeSizeTypes::where('badge_size_id',$request->badge_size_id)->first();
        if($delete_badge_type_size != null)
        {
            BadgeSizeTypes::where('badge_size_id',$request->badge_size_id)->delete();
        }
        foreach ($request->a_badge_sizes as $a_badge_size) {
            $badge_size_type = new BadgeSizeTypes;
            $badge_size_type->badge_size_id = $request->badge_size_id;
            $badge_size_type->badge_type_id = $a_badge_size;
            $badge_size_type->save();
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
        BadgeSize::where('id',$id)->delete();
        BadgeSizeTypes::where('badge_size_id',$id)->delete();
        BadgeDiscount::where('badge_size_id',$id)->delete();
        return redirect()->back()->with('successmessage','Record Deleted Successfully');
    }

    
}
