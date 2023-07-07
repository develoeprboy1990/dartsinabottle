<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentType;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_types=PaymentType::where('status',1)->get();
        return view('user.admin.payment-types',['payment_types'=>$payment_types]);
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
        //
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
        $payment_type=PaymentType::where('id',$id)->first();
        // Credit Card
        if($payment_type->id == 1){
            return view('user.admin.edit-credit-card-payment-type',['payment_type'=>$payment_type]);
        }
        //Wire
        elseif($payment_type->id == 2){
            return view('user.admin.edit-wire-payment-type',['payment_type'=>$payment_type]);
        } 
        //Check
        elseif($payment_type->id == 3){
            return view('user.admin.edit-check-payment-type',['payment_type'=>$payment_type]);
        }
        elseif($payment_type->id == 4){
            return view('user.admin.edit-paypal-payment-type',['payment_type'=>$payment_type]);
        }
        elseif($payment_type->id == 5){
            return view('user.admin.edit-stripe-payment-type',['payment_type'=>$payment_type]);
        }
       
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
        
        $payment_type=PaymentType::where('id',$id)->first();
        
        //Credit Card
        if($id ==1){
            $payment_type->api_key=$request['api_key'];
            $payment_type->secret_key=$request['secret_key'];

               if($request['payment_account_type'] == "test")
               {
                    $payment_type->login_id_test=$request['login_id_test'];
                    $payment_type->transaction_key_test=$request['transaction_key_test'];
               } 
               else if($request['payment_account_type'] == "live")
               {
                    $payment_type->login_id_live=$request['login_id_live'];
                    $payment_type->transaction_key_live=$request['transaction_key_live'];
               }
               
               $payment_type->save();
        }

        //Wire
        elseif($id == 2){
            $payment_type->wire_detail=$request['wire_detail'];
            
        }
        //Check
        elseif($id== 3){
            $payment_type->check_detail=$request['check_detail'];
        }
        //PayPal
        elseif($id ==4){
            $payment_type->api_key=$request['api_key'];
            $payment_type->secret_key=$request['secret_key'];

               if($request['payment_account_type'] == "test")
               {
                    $payment_type->test_email=$request['test_email'];
                    $payment_type->login_id_test=$request['login_id_test'];
                    $payment_type->transaction_key_test=$request['transaction_key_test'];
               } 
               else if($request['payment_account_type'] == "live")
               {
                    $payment_type->live_email=$request['live_email'];
                    $payment_type->login_id_live=$request['login_id_live'];
                    $payment_type->transaction_key_live=$request['transaction_key_live'];
               }
               
               $payment_type->save();
        }
        //Stripe
        elseif($id ==5){

               if($request['payment_account_type'] == "developer")
               {
                    $payment_type->api_key=$request['api_key'];
                    $payment_type->secret_key=$request['secret_key'];
               }
               else if($request['payment_account_type'] == "test")
               {
                    $payment_type->login_id_test=$request['login_id_test'];
                    $payment_type->transaction_key_test=$request['transaction_key_test'];
               } 
               else if($request['payment_account_type'] == "live")
               {
                    $payment_type->login_id_live=$request['login_id_live'];
                    $payment_type->transaction_key_live=$request['transaction_key_live'];
               }
               
               $payment_type->save();
        }
        
        $payment_type->save();

      

        
        return redirect('admin/payment-types')->with('successmessage','Success! Payment Type Edited Successfully');

    }

    private function updateConfigurations()
    {
      $stripe_detail = PaymentType::where('id', 5)->where('status', 1)->first();
    
      $path = base_path('.env');
      if (file_exists($path)) {
        if ($stripe_detail->active_account == 'test') {
          $STRIPE_KEY    = $stripe_detail->login_id_test;
          $STRIPE_SECRET = $stripe_detail->transaction_key_test;
        } elseif ($stripe_detail->active_account == 'developer') {
          $STRIPE_KEY    =  $stripe_detail->api_key;
          $STRIPE_SECRET = $stripe_detail->secret_key;
        } else {
          $STRIPE_KEY    =  $stripe_detail->login_id_live;
          $STRIPE_SECRET = $stripe_detail->transaction_key_live;
        }
  dd(env('STRIPE_KEY'));
        file_put_contents($path, str_replace(
          'STRIPE_KEY=' . env('STRIPE_KEY'),
          'STRIPE_KEY=' . $STRIPE_KEY,
          file_get_contents($path)
        ));
  
        file_put_contents($path, str_replace(
          'STRIPE_SECRET=' . env('STRIPE_SECRET'),
          'STRIPE_SECRET=' . $STRIPE_SECRET,
          file_get_contents($path)
        ));
      }
    }

    public function choosePaymentAccountTypeProcess(Request $request){

      $payment_type = PaymentType::where('id',$request['payment_type_id'])->first();
      if($payment_type)
      {
        $payment_type->active_account= $request['active_account'];
        $payment_type->save();


        $this->updateConfigurations();
      }
     return redirect('admin/payment-types')->with('successmessage','Payment detail edited successfully');
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
