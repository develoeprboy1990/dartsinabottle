<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BadgeColor;

class BadgeColorController extends Controller
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
       $badge_colors=BadgeColor::orderBy('id','DESC')->get(); 
        // dd($badge_colors);
        return view('user.admin.badge-color',['badge_colors'=>$badge_colors]);
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
     
        $existing_color=BadgeColor::where(['hexa_value'=>$request['hexa_value']])->first();    
        if($existing_color)
        {
        return redirect()->back()->with('successmessage','Badge with this color already exists');

        }
        else{

            $badge_color=new BadgeColor;
            $badge_color->title=$request['title'];
            $badge_color->hexa_value=$request['hexa_value'];
            $badge_color->cmyk=$request['cmyk'];
            $badge_color->price=$request['price'];
            $badge_color->save();
        }
       

        return redirect()->back()->with('successmessage','Bade Color added successfully');
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
        $badge_color = BadgeColor::where('id',$id)->first();
       
       return response()->json([

        'result'=>$badge_color

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
        // print_r($request->all());
         $existing_color=BadgeColor::where(['hexa_value'=>$request['hexa_value']])->where('id','<>',$id)->first();    
        if($existing_color)
        {
            
            $error=true;

        }

        else{


           $badge_color = BadgeColor::where('id',$id)->first();


           if($badge_color){

              $badge_color->title=$request['title'];  
              $badge_color->hexa_value=$request['hexa_value'];  
              $badge_color->cmyk=$request['cmyk'];  
              $badge_color->price=$request['price'];  

              $badge_color->save();

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
        BadgeColor::where('id',$id)->delete();
        return redirect()->back()->with('successmessage','Record Deleted Successfully');
    }
}
