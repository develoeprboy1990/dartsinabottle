<?php

namespace App\Http\Controllers;

use App\CustomerGroup;
use Illuminate\Http\Request;

class CustomerGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function index()
    {
        $customer_groups=CustomerGroup::orderBy('id','DESC')->get();
        return view('user.admin.customer-groups',['customer_groups'=>$customer_groups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.admin.add-customer-group');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $existing_group=CustomerGroup::where('name',$request['name'])->count();
        if($existing_group > 0){
        return redirect('admin/customer-groups')->with('successmessage','Failure! Customer Group with this name already exists');

        }
        else
        {
        $customer_group= new CustomerGroup;
        $customer_group->name=$request['name'];
        $customer_group->save();

        return redirect('admin/customer-groups')->with('successmessage','Customer Group added successfully');
        }      

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

        $customer_group=CustomerGroup::where('id',$id)->first();
        return view('user.admin.edit-customer-group',['customer_group'=>$customer_group]);
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
        $customer_group=CustomerGroup::where('id',$id)->first();
        $customer_group->name=$request['name'];
        $customer_group->save();

        return redirect('admin/customer-groups')->with('successmessage','Customer Group edited successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
