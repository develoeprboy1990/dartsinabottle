<?php

namespace App\Http\Controllers;

use App\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents=Content::orderBy('id','DESC')->get();
        //dd($contents);
        return view('user.admin.contents',['contents'=>$contents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.admin.add-content');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $existing_content=Content::where('title',$request['title'])->count();
        if($existing_content > 0){
        return redirect('admin/content')->with('successmessage','Failure! Content with this title already exists');

        }
        else
        {
        $content= new Content;
        $content->title=$request['title'];
        $content->content=$request['content'];
        $content->save();
        return redirect('admin/content')->with('successmessage','Content added successfully');
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
        $content=Content::where('id',$id)->first();
        return view('user.admin.edit-content',['content'=>$content]);
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
        $content=Content::where('id',$id)->first();
        $content->title=$request['title'];
        $content->content=$request['content'];
        $content->save();

        return redirect('admin/content')->with('successmessage','Content edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Content::where('id',$id)->delete();
       return redirect('admin/content')->with('successmessage','Content deleted successfully');
    }
}
