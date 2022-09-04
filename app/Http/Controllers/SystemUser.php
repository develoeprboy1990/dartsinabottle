<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserRole;
use App\User;

class SystemUser extends Controller
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
        $user_roles=UserRole::where('id','<>',1)->get();

        $results=UserRole::select('users.*','users.id as u_id','user_roles.*','user_roles.id as role_id')->join('users','user_roles.id','=','users.user_role_id')->where('users.user_role_id',2)->orWhere('users.user_role_id',3)->orderBy('users.id','DESC')->get();
        
        return view('user.admin.system-user',['user_roles'=>$user_roles,'results'=>$results]);    
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
        $existing_user=User::where('email',$request['email'])->first();
        if($existing_user){

           $error=true; 

        }
        else
        {
            $user= new User;
            $user->first_name=$request['first_name'];
            $user->last_name=$request['last_name'];
            $user->email=$request['email'];
            $user->password=bcrypt($request['password']);
            $user->status=1;
            $user->user_role_id=$request['user_role'];
            $user->save();

            $error=false; 

        }
        return response()->json([
            'error'=>$error
            ]);
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
       $user_roles=UserRole::where('id','<>',1)->get();

       $user=User::find($id);

       return response()->json([
            'user_roles'=>$user_roles,
            'user'=>$user
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
        $check_existing_user=User::where(['email'=>$request['email']])->where('id','<>',$id)->first();
        if($check_existing_user){

            $error=true;
        }
        else
        {
           $user=User::where('id',$id)->first(); 
           $user->first_name=$request['first_name'];
           $user->last_name=$request['last_name'];
           $user->email=$request['email'];
           $user->user_role_id=$request['user_role_id'];
           $user->save();
           $error=false;
        }

        return response()->json([
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
        User::where('id',$id)->delete();
        return redirect()->back()->with('successmessage','System User Deleted Successfully');
    }
}
