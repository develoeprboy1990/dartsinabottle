<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Courear;

class CourearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courears=Courear::all();
        return view('user.admin.courear',['courears'=>$courears]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('user.admin.add-courear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $courear= new Courear;
        $courear->name=$request['name'];
        $courear->tracking_link=$request['tracking_link'];
        $courear->save();

       return redirect('admin/courier')->with('successmessage','Courier added successfully');     
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
       $courear=Courear::where('id',$id)->first();

       return view('user.admin.edit-courear',['courear'=>$courear]); 
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
       $courear= Courear::where('id',$id)->first();
       $courear->name=$request['name'];
       $courear->tracking_link=$request['tracking_link'];
       $courear->save();

       return redirect('admin/courier')->with('successmessage','Courier edited successfully');     


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Courear::where('id',$id)->delete();
       return redirect('admin/courier')->with('successmessage','Courier deleted successfully');     


    }
}
