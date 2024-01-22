<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BadgeSize;
use App\User;
use App\Product;
use Mail;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){

        $this->middleware('adminlogin');
    } 

    public function index()
    {
        $users=User::where('user_status',1)->where('shipping_detail_status',1)->orWhere('user_role_id',1)->orderBy('id','ASC')->get();
        $products = Product::latest()->get();
        return view('user.admin.product.index',compact('products','users'));
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
        if($request->hasFile('image') && $request->image->isValid())
        {
            $extension=$request->image->extension();
            $filename=date('m-d-Y').mt_rand(999,999999).'__'.time().'.'.$extension;
            $request->image->move(public_path('uploads/darts_img'),$filename);
        }
        else
        {
            $filename=null;
        }
        
        $product = new Product;
        $product->user_id = $request->user_id;  
        $product->product_name  = $request->title;
        $product->product_image = $filename;
        $product->product_price_type = $request->product_price_type;
        $product->product_price = $request->price;
        $product->product_description = $request->description;
        $product->product_weight_range = $request->weight_range;
        $product->product_weight  = $request->product_weight;
        $product->product_length  = $request->product_length;
        $product->product_width  = $request->product_width;
        $product->save();

        $product_picture = asset('public/uploads/darts_img/'.$filename);

        $products = Product::where('user_id', $request->user_id)->count();
        $user = User::where('id', $request->user_id)->first();

        if($request->product_price_type == 'for_sale')
        {
            $product_price = '£'.$request->price;
        }else{
            $product_price = 'not for sale';
        }

        $data = array(
            'firstname'       => $user->first_name,
            'lastname'        => $user->last_name,
            'email'           => $user->email,
            'product_name'    => $request->title,
            'product_weight'  => $request->product_weight,
            'product_length'  => $request->product_length.'*'.$request->product_width,
            'product_price'   => $product_price,
            'product_picture' => $product_picture
            );

        if($products == 1)
        {
            //Email to Customer who send First Lent darts.
            Mail::send('emails.email-to-first-lent-darts',  $data, function ($message) use ($data) {
            $message->to($data['email'])
            ->subject('Your barrels have been added to our system');
            });
        }else if($products > 1){
            //Email to Customer who send Additional Lent darts.
            Mail::send('emails.email-to-additional-lent-darts',  $data, function ($message) use ($data) {
            $message->to($data['email'])
            ->subject('Your additional barrels have been added to our system');
            });
        }

        return redirect()->back()->with('successmessage','Product added successfully');
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
       $product = Product::where('id',$id)->first();
       return response()->json([
        'product'=>$product
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

        $product = Product::find($id);

        $product->product_name = $request->e_title;
        $product->product_price = $request->e_price;
        $product->product_price_type = $request->e_price_type;
        $product->product_description = $request->e_description;
        $product->product_weight = $request->e_weight;
        $product->product_length  = $request->e_length;
        $product->product_width  = $request->e_width;
        
        $product->user_id = $request->e_user_id;
        $product->product_weight_range = $request->e_weight_range;

        if($request->hasFile('e_image') && $request->e_image->isValid())
        {
            $extension=$request->e_image->extension();
            $filename=date('m-d-Y').mt_rand(999,999999).'__'.time().'.'.$extension;
            $request->e_image->move(public_path('uploads/darts_img'),$filename);
            $product->product_image = $filename;
        }

        $product->save();

        $error = false;
        
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
        // dd($id);
        Product::where('id',$id)->delete();
        return redirect()->back()->with('successmessage','Record Deleted Successfully');
    }
}