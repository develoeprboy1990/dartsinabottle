<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DefaultWeightManagement;


class DefaultWeightPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details=DefaultWeightManagement::orderBy('id','DESC')->get();
        return view('user.admin.weight-price',['details'=>$details]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('user.admin.add-weight-price');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dwm=new DefaultWeightManagement;
        $dwm->weight_from=$request['weight_from']; 
        $dwm->weight_to=$request['weight_to'];
        $dwm->amount=$request['amount']; 

        $dwm->save();

        return redirect('admin/weight-price')->with('successmessage','Record inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $dwm = DefaultWeightManagement::where(['id'=>$id])->first();
       return view('user.admin.edit-weight-price',['dwm'=>$dwm]); 
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
        $dwm = DefaultWeightManagement::where(['id'=>$id])->first();

        $dwm->weight_from=$request['weight_from'];
        $dwm->weight_to=$request['weight_to'];
        $dwm->amount=$request['amount'];

        $dwm->save();

        return redirect('admin/weight-price')->with('successmessage','Record edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DefaultWeightManagement::where('id',$id)->delete();
        return redirect('admin/weight-price')->with('successmessage','Record deleted successfully');

    }
}
