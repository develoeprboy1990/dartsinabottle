<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserRole;

class RoleManagement extends Controller
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
        $roles=UserRole::where('id','<>',1)->orderBy('id','DESC')->get();
        return view('user.admin.role',['roles'=>$roles]);
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
        $existing_role=UserRole::where(['title'=>$request['title']])->first();    
        if($existing_role)
        {
        return redirect()->back()->with('successmessage','Failed! Role already exists');

        }
        else{

            $user_role=new UserRole;
            $user_role->title=$request['title'];
            $user_role->save();
        }
       

        return redirect()->back()->with('successmessage','Role added successfully');
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
       $user_role = UserRole::where('id',$id)->first();
       
       return response()->json([

        'result'=>$user_role

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
        
         $existing_role=UserRole::where(['title'=>$request['title']])->where('id','<>',$id)->first();    
        if($existing_role)
        {
            
            $error=true;

        }

        else{


           $user_role = UserRole::where('id',$id)->first();


           if($user_role){

              
              $user_role->title=$request['title'];  
              $user_role->save();
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
        UserRole::where('id',$id)->delete();    
        return redirect()->back()->with('successmessage','Role deleted successfully');

    }
}
