<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BadgeLine;

class BadgeLineController extends Controller
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
       $badge_lines=BadgeLine::orderBy('id','DESC')->get(); 
       return view('user.admin.badge-line',['badge_lines'=>$badge_lines]);
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
        $existing_line=BadgeLine::where(['name'=>$request['line_name']])->first();    
        if($existing_line)
        {
        return redirect()->back()->with('successmessage','Badge with this Line already exists');

        }
        else{

            $badge_line=new BadgeLine;
            $badge_line->name=$request['line_name'];
            $badge_line->price=$request['price'];
            $badge_line->save();
        }
       

        return redirect()->back()->with('successmessage','Bade Line added successfully');
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
        $badge_line = BadgeLine::where('id',$id)->first();
       
       return response()->json([

        'result'=>$badge_line

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
       
            $error=true;

           $badge_line = BadgeLine::where('id',$id)->first();


           if($badge_line){

            
              $badge_line->price=$request['price'];  

              $badge_line->save();

              $error=false;

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
        BadgeLine::where('id',$id)->delete();
        return redirect()->back()->with('successmessage','Record Deleted Successfully');
    }
}
