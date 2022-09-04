<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CardFont;

class CardFontController extends Controller
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
//        $arrContextOptions=array(
//     "ssl"=>array(
//         "verify_peer"=>false,
//         "verify_peer_name"=>false,
//     ),
// );  

//        $get_fonts=file_get_contents("https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBycroL5OHx-D4959_0jD6Bk7Ey8L3nFKE", false, stream_context_create($arrContextOptions));

//        dd($get_fonts);

       

        $badge_fonts=CardFont::orderBy('id','DESC')->get(); 
        // dd($badge_fonts);
        return view('user.admin.card-font',['badge_fonts'=>$badge_fonts]);



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
        $existing_font=CardFont::where(['font_family_name'=>$request['font_family_name']])->first();    
        if($existing_font)
        {
        return redirect()->back()->with('successmessage','Badge with this font family already exists');

        }
        else{

            $card_font=new CardFont;
            $card_font->title=$request['title'];
            $card_font->font_family_name=$request['font_family_name'];
            $card_font->price=$request['price'];
            $card_font->save();
        }
       

        return redirect()->back()->with('successmessage','Badge Font Family Added Successfully');
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
         $badge_font = CardFont::where('id',$id)->first();
       
       return response()->json([

        'result'=>$badge_font

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
         $existing_font=CardFont::where(['font_family_name'=>$request['font_family_name']])->where('id','<>',$id)->first();    
        if($existing_font)
        {
            
            $error=true;

        }

        else{


           $card_font = CardFont::where('id',$id)->first();


           if($card_font){

              $card_font->title=$request['title']; 
              $card_font->font_family_name=$request['font_family_name']; 
              $card_font->price=$request['price'];  
              $card_font->save();
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
         CardFont::where('id',$id)->delete();
        return redirect()->back()->with('successmessage','Record Deleted Successfully');
    }
}
