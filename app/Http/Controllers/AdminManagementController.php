<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\OrderDetail;
use App\OrderProduct;
use App\Courear;
use App\OrderCourier;
use App\DesignerShipperNote;
use App\ShippingCountryState;
use App\WeightManagement;
use App\Country;
use App\State;
use App\OrderAsset;
use App\OrderNote;
use App\CustomerNote;
use App\ShippingDetail;
use App\CustomBadgeDetail;
use App\CustomBadgeExample;
use App\CustomBadgeAsset;
use App\CustomBadgeQuote;
use App\CustomBadgeQuoteFile;
use App\Chat;
use App\UserMessage;
use App\PaymentType;
use App\CustomerCustomPaymentType;
use App\OrderWireCheckDetail;
use App\OrderReminderInformation;
use App\CustomerGroup;
use App\HomePageUrl;
use App\CardFont;
use Mail;
use Auth;
use File;
use Hash;
use App\BadgeColor;
use App\BadgeType;
use App\BadgeBledSize;
use App\BadgeSize;
use App\Rules\Captcha;
use App\Product;
use App\ProductToCustomer;
use App\Subscription;
use App\SubscriptionItem;
use Carbon\Carbon;
use App\SubscriptionBilling;

class AdminManagementController extends Controller
{
	public function __construct(){

        $this->middleware('adminlogin',['except' =>['login','processLogin','logout']]);
        
        $this->middleware('shipper',['except' =>['login','processLogin','logout','pendingShip','orderDetail','approveBadgeShipping','getBadgeDetail','uploadAssetProcess','viewOrderAsset','viewCustomerOrderAsset','deleteOrderAsset','addOrderNote','deleteOrderNote','shipWireCheckOrderWithPayment','shipWireCheckOrderWithOutPayment','shipWireCheckOrderWhosePaymentIsDone']]);
        
        $this->middleware('designer',['except' =>['login','processLogin','logout','pendingDesign','orderDetail','approveBadgeDesign','getBadgeDetail','uploadAssetProcess','viewOrderAsset','viewCustomerOrderAsset','deleteOrderAsset','addOrderNote','deleteOrderNote']]);


	}

	public function login(){

	return view('user.admin.login');	

	}

	public function processLogin(Request $request){

    $this->validate($request , [
        'g-recaptcha-response' => new Captcha(),
      ]);

	$user=User::where('email',$request['email'])->first();


  	 if($user){

            if($user->status==1){

                  
                if(Auth::attempt(['email'=>$request['email'],'password'=>$request['password'],'status'=>1,'user_role_id'=>1])){

                    return redirect('admin/dashboard');
                }

                // user_role_id=2 is for designer
                elseif(Auth::attempt(['email'=>$request['email'],'password'=>$request['password'],'status'=>1,'user_role_id'=>2])){
                    return redirect('admin/orders/pending-design');

                }

                // user_role_id=3 is for shipper
                elseif(Auth::attempt(['email'=>$request['email'],'password'=>$request['password'],'status'=>1,'user_role_id'=>3])){
                    return redirect('admin/orders/pending-shipment');

                }
               
                else{
                
                    return redirect('admin/login')->with('successmessage','Invalid username or password.');    
                }

            }
            else{
            return redirect('admin/login')->with('successmessage','Your account is not activated yet');

            }
              
        }
        else
        {

           return redirect('admin/login')->with('successmessage','User with email does not exist');


        }


	}

    public function changePassword(){

        return view('user.admin.change-password');

    }

    public function processChangePassword(Request $request){

        $user=User::where('id',$request['user_id'])->first();

         if (Hash::check($request['current_password'], $user->getAuthPassword()))
         {

            if($request['current_password'] == $request['new_password'])
            {
            
                return redirect('admin/change-password')->with('successmessage','Please choose a different new password');

            }
            elseif($request['new_password'] != $request['confirm_password'])
            {
            
                return redirect('admin/change-password')->with('successmessage','Sorry! Your confirm new password doesnot match with your new password');

            }
           
            $user->password= bcrypt($request['new_password']);
            $user->save();

         }  
         else{
                return redirect('admin/change-password')->with('successmessage','Your current password is not correct');
         }   

        Auth::logout(); 
        return redirect('admin/login')->with('successmessage','Password updated successfully');


    }

    public function dashboard(){
        $active_users = User::where('user_status',1)->count();
        // dd($active_users);
        $pending_shipments = Subscription::where('status',2)->count();
        // dd($pending_shipments);
        $shipped_orders = Subscription::where('status',1)->count();
       return view('user.admin.dashboard',compact('active_users','pending_shipments','shipped_orders'));

    }

    public function pendingDesign(){   //For Designer 

       $order_details=OrderDetail::where(['status'=>0])->orderBy('id','DESC')->get();      
       // dd($order_details);
       return view('user.admin.pending-design',['order_details'=>$order_details]);


    }

    public function pendingShip(){
       $order_details=Subscription::where(['status'=>2])->orderBy('id','DESC')->get();   
       return view('user.admin.pending-ship',['order_details'=>$order_details]);
    } 

    public function shippedOrders(){

      $order_details=Subscription::where('status',1)->orderBy('id','DESC')->get();      
      return view('user.admin.shipped-orders',['order_details'=>$order_details]);
    } 

    public function cancelledOrders(){
       $order_details=Subscription::where(['status'=>3,'isunsubscribe'=>1])->orderBy('id','DESC')->get();      
       return view('user.admin.cancelled-orders',['order_details'=>$order_details]);
    }

    public function orderDetail($id,$type=null){
        
        $order_detail=Subscription::where(['id'=>$id])->first();      
        $order_product=SubscriptionItem::where('subscription_id',$order_detail->id)->orderBy('id','DESC')->first();
       
        $order_notes=OrderNote::where('order_id',$order_detail->id)->get();

        $product_to_customers = ProductToCustomer::where('user_id',$order_detail->user_id)->get();
        //dd();

        $product_already_send = ProductToCustomer::where('user_id',$order_detail->user_id)->pluck('product_id')->toArray();

        $products = Product::where('user_id','<>',$order_detail->user_id)->where('active_status','1')->whereNotIn('id', $product_already_send)->get();
       
        
        if($type == "shipped"){
        //Shipped 
        return view('user.admin.order-detail-shipped',['order_detail'=>$order_detail,'order_product'=>$order_product,'order_notes'=>$order_notes,'product_to_customers'=>$product_to_customers]);

        }elseif($type == "cancelled"){
        //Cancelled
        return view('user.admin.order-detail-cancelled',['order_detail'=>$order_detail,'order_product'=>$order_product,'order_notes'=>$order_notes,'product_to_customers'=>$product_to_customers]);

        }
        else{
        //Pending Shipment
        return view('user.admin.order-detail',['order_detail'=>$order_detail,'order_product'=>$order_product,'order_notes'=>$order_notes,'products'=>$products,'product_to_customers'=>$product_to_customers]);
        } 


    }

    public function cancelOrder(){

      if(isset($_GET['order_id'])){  
      $order_id=$_GET['order_id'];
      }

      Subscription::where('id',$order_id)->update(['status' => '3']);

      return response()->json(
          [
          "ok",
          ]
          );
    }

    public function addSystemUser(){

    	return view('user.admin.add-system-user');

    }

    public function viewCustomers($status){

        if($status == "active")
        {
            $users=User::where(['status'=>1,'user_role_id'=>4,'user_status'=>1])->orderBy('id','DESC')->get();    
        }
        elseif($status =="pending"){

            $users=User::where(['status'=>0,'user_role_id'=>4,'user_status'=>0])->orderBy('id','DESC')->get();    


        }
        elseif($status == "suspended"){
            $users=User::where(['user_role_id'=>4,'user_status'=>2])->orderBy('id','DESC')->get();    

        }
        
        $customer_groups=CustomerGroup::orderBy('id','DESC')->get();
        $countries=Country::get();
        return view('user.admin.customers',['users'=>$users,'status'=>$status,'customer_groups'=>$customer_groups,'countries'=>$countries]);

    }

    public function viewCustomerDetail($user_id){

    $user_detail=User::where(['id'=>$user_id])->first();  
    $customer_notes=CustomerNote::where('customer_id',$user_id)->get();
    $user_shipping_details=ShippingDetail::where('user_id',$user_id)->get();
    $payment_types=PaymentType::where('id','<>',1)->where('id','<>',2)->where('id','<>',3)->get();

    $customer_custom_payment_types=CustomerCustomPaymentType::where('user_id',$user_id)->get();
    $customer_groups=CustomerGroup::orderBy('id','DESC')->get();
        // dd($user_shipping_details);
        return view('user.admin.customer-details',['user_detail'=>$user_detail,'customer_notes'=>$customer_notes,'user_shipping_details'=>$user_shipping_details,'payment_types'=>$payment_types,'customer_custom_payment_types'=>$customer_custom_payment_types,'customer_groups'=>$customer_groups]);

    }

    public function assignCustomPaymentTypeToCustomers(Request $request){

        $error=false;
        $user_id=$request['user_id'];
        $payment_types=$request['payment_type'];

        CustomerCustomPaymentType::where('user_id',$user_id)->delete();
        
        foreach($payment_types as  $result){

            $customer_custom_payment_type=new CustomerCustomPaymentType;
            $customer_custom_payment_type->user_id=$user_id;
            $customer_custom_payment_type->payment_type_id=$result;
            $customer_custom_payment_type->save();
        }

        return response()->json([
            "error"=>$error
            ]);


    }

    public function suspendedAccount($user_id){

        $user=User::where(['id'=>$user_id])->first();
        if($user){

            $user->user_status=2;
            $user->save();

        }
        return redirect('admin/customers/suspended')->with('successmessage','User Account is suspended successfully');

    }

    public function activateSuspendedAccount($user_id){

        $user=User::where(['id'=>$user_id])->first();
        if($user){

            $user->user_status=1;
            $user->save();

        }
        return redirect('admin/customers/active')->with('successmessage','User Account is activated successfully');

    }

    public function filterProduct(){
        
        if(isset($_GET['weight_id'])){
            $weight_id=$_GET['weight_id'];
        }   

        if(isset($_GET['order_details_id'])){
            $order_details_id=$_GET['order_details_id'];
        }   

        $order_detail=Subscription::where(['id'=>$order_details_id])->first();

        $product_already_send = ProductToCustomer::where('user_id',$order_detail->user_id)->pluck('product_id')->toArray();
        $products = Product::where('user_id','<>',$order_detail->user_id)->where('product_weight_range',$weight_id)->where('active_status','1')->whereNotIn('id', $product_already_send)->get();

       return response()->json(
        $products
        );
    }

    public function shipOrderWhosePaymentIsDone(Request $request){
        $error=false;
        //1= Shipped, 2=Pending Shipped 
        $order_detail=Subscription::where('id',$request['order_details_id'])->whereIn('status', [1, 2])->first();
        if($order_detail){
            
            //cheking of how many darts send in last 30 days...
            //$invoice = $order_detail->getUser->subscription('default')->upcomingInvoice();
            //dd($invoice);

            $per_month_limit = $order_detail->getProductDetail->getPackage->darts_set;

            $subscription_billing=SubscriptionBilling::where('subscription_id',$order_detail->id)->orderBy('id','DESC')->first();

            $current_month_count = ProductToCustomer::where('user_id',$order_detail->user_id)->where('subscription_billing_id',$subscription_billing->id)->whereIn('status',['Shipped','Returned','Sold'])->count();

            if($current_month_count < $per_month_limit)
            {    

                $user_id = $order_detail->user_id;

                $product_to_customer=new ProductToCustomer;
                $product_to_customer->subscription_id=$request['order_details_id'];
                $product_to_customer->user_id=$order_detail->user_id;
                $product_to_customer->product_id=$request['product_id'];
                $product_to_customer->subscription_billing_id=$subscription_billing->id;
                $product_to_customer->status='Shipped';
                $product_to_customer->save();

                $product=Product::where('id',$request['product_id'])->first();
                $product->active_status = 2; //2 means product is now reserved
                $product->save();

                $order_detail->status=1;   //1 means order is now shipped
                $order_detail->save();

                $lent_darts = Product::where('user_id',$user_id)->where('active_status','!=',3)->get();
                $need_to_set = false;
                foreach($lent_darts as $lent_dart)
                {
                    if($lent_dart->product_price_type == 'not_for_sale')
                    {
                        $need_to_set = true;
                    }
                }
                if($need_to_set)
                {
                    $set_price = "<br><br>Don’t forget, you can set a price for your lent darts in the ‘My Darts’ section of our website.";
                }else{
                    $set_price = "";
                }


                $user=User::where('id',$user_id)->first();
                $data = array(
                'firstname'      => $user->first_name,
                'lastname'       => $user->last_name,
                'email'          => $user->email,
                'message_body'   => 'Your dartsinabottle are on their way. <br> They should arrive in 2-4 working days.'.$set_price,

                ); 
                Mail::send('emails.send-message-customer',  $data, function ($message) use ($data) {
                $message->to($data['email'])
                ->subject('Your dartsinabottle are on their way');
                });
                return response()->json([
                "error"=>'success'
                ]);
            }
            return response()->json([
                "error"=>'limit reached'
                ]);
        }
        return response()->json([
                "error"=>'no subscribtion'
                ]);

    }

    public function confirmReturnDarts(){

        if(isset($_GET['order_detail_id'])){
            $order_detail_id=$_GET['order_detail_id'];
        }   
        $error=false;
        $order_detail=Subscription::where('id',$order_detail_id)->first();
        if($order_detail){
            $today=strtotime(date('Y-m-d'));

            $product_to_customer=ProductToCustomer::where('subscription_id',$order_detail_id)->where('status','Shipped')->first();
            $product_to_customer->status = 'Returned';
            $product_to_customer->returned_at = Carbon::now();
            $product_to_customer->save();

            $product=Product::where('id',$product_to_customer->product_id)->first();
            $product->active_status = 1; //1 means product is now active
            $product->save();

            $order_detail->status=2;   //2 means order is in Pending Ship
            $order_detail->save();

              return response()->json([
                "error"=>$error
                ]);
            

        }
    }

    public function shippingManagement(){

        $countries=Country::all(); 

        // $details=ShippingCountryState::select('shipping_country_states.*','countries.name as country_name','states.name as state_name')
        //        ->join('countries','shipping_country_states.country_id','=','countries.id')
        //            ->join('states','shipping_country_states.state_id','=','states.id')
        //             ->get();

        $states=State::where('country_id',231)->get();

        $shipping_details=ShippingCountryState::all();

        if($shipping_details->count())
        {
        $i=0;           
        foreach($shipping_details as $shipping_detail){

           $country=Country::where('id',$shipping_detail->country_id)->first();

          if($shipping_detail->state_id != null)
          {
           $state=State::where('id',$shipping_detail->state_id)->first(); 
           $state_name=$state->name;
          }
          else
          {
            $state_name="N/A";
          }
            $details[$i]=array(

                 'id'=>$shipping_detail->id,   
                 'country_name'=>$country->name,   
                 'state_name'=>$state_name,


               );

           $i++;
        }
      }
      else
      {
        $details=null;
      }

        // dd($arr);

         // dd($details);          
        return view('user.admin.shipping-management',['countries'=>$countries,'states'=>$states,'details'=>$details]);

    }

    public function processShippingManagement(Request $request){
        // dd($request->all());

       if(!empty($request['ship_management_state_select']))
       { 
        // dd('state selected');
        foreach($request['ship_management_state_select'] as $state){
         
            $check_already_exist=ShippingCountryState::where(['state_id'=>$state,'country_id'=>$request['ship_management_country_select'] ])->count();
            // dd($check_already_exist);
            // ->orWhere(['country_id'=>$request['ship_management_country_select'],'state_id'=>null ])
            // $check_already_exist_second=ShippingCountryState::where(['country_id'=>$request['ship_management_country_select'],'state_id'=>null ])->count();

            // dd($check_already_exist_second);

            if($check_already_exist == 0)
            {

            $s_c_s=new ShippingCountryState; //$s_c_s (shipping country state)
            
            $s_c_s->country_id=$request['ship_management_country_select'];    
            $s_c_s->state_id=$state;
            $s_c_s->counter=$request['weight_price_counter'];
            $s_c_s->status=1;

            $s_c_s->save();

            for($i=1;$i<=$request['weight_price_counter'];$i++)
            {
                $w_m=new WeightManagement;  //$w_m(weight management)
                
                if($i==1)
                {
                    $w_m->weight_from=$request['weight_from'];      
                    $w_m->weight_to=$request['weight_to'];      
                    $w_m->amount=$request['amount'];
                    $w_m->shipping_country_states_id=$s_c_s->id;    
                }
                else{   
                    $w_m->weight_from=$request['weight_from'.$i];      
                    $w_m->weight_to=$request['weight_to'.$i];      
                    $w_m->amount=$request['amount'.$i];  
                    $w_m->shipping_country_states_id=$s_c_s->id;    

                }

                $w_m->save();
            }   

            
            }

         } //foreach
        } //if
        else
        {
            // dd('state not selected');

            $check_already_exist=ShippingCountryState::where(['country_id'=>$request['ship_management_country_select'],'status'=>0 ])->count(); 

            // dd($check_already_exist);   
            if($check_already_exist == 0)
            {
            $s_c_s=new ShippingCountryState; //$s_c_s (shipping country state)
            
            $s_c_s->country_id=$request['ship_management_country_select'];    
            $s_c_s->state_id=null;
            $s_c_s->counter=$request['weight_price_counter'];
            $s_c_s->status=0;
            $s_c_s->save();

            for($i=1;$i<=$request['weight_price_counter'];$i++)
            {
                $w_m=new WeightManagement;  //$w_m(weight management)
                
                if($i==1)
                {
                    $w_m->weight_from=$request['weight_from'];      
                    $w_m->weight_to=$request['weight_to'];      
                    $w_m->amount=$request['amount'];
                    $w_m->shipping_country_states_id=$s_c_s->id;    
                }
                else{   
                    $w_m->weight_from=$request['weight_from'.$i];      
                    $w_m->weight_to=$request['weight_to'.$i];      
                    $w_m->amount=$request['amount'.$i];  
                    $w_m->shipping_country_states_id=$s_c_s->id;    

                }

                $w_m->save();
            } //for loop   


          }  

        } //else
        return redirect('admin/shipping-management')->with('successmessage','Record inserted successfully');     
    }

    public function getWeightPrice(){

        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }


        $shipping_country_states=ShippingCountryState::where(['id'=>$id])->first();

        $details=WeightManagement::where(['shipping_country_states_id'=>$shipping_country_states->id])->get();

        return response()->json(
            [
            
             'details'=>$details,
             'counter'=>$shipping_country_states->counter,
             'shipping_country_states_id'=>$shipping_country_states->id 
            
            ]
            );

    }

    public function processEditShippingManagement(Request $request){

        WeightManagement::where([ 'shipping_country_states_id'=>$request['shipping_country_states_id'] ])->delete();

        $s_c_s=ShippingCountryState::where(['id'=>$request['shipping_country_states_id']])->first();
        $s_c_s->counter=$request['weight_price_counter_modal'];
        $s_c_s->save();

        for($i=1;$i<=$request['weight_price_counter_modal'];$i++) 
            {
                $w_m=new WeightManagement;  //$w_m(weight management)
                
                if($i==1)
                {
                    $w_m->weight_from=$request['weight_from'];      
                    $w_m->weight_to=$request['weight_to'];      
                    $w_m->amount=$request['amount'];
                    $w_m->shipping_country_states_id=$request['shipping_country_states_id'];    
                }
                else{   
                    $w_m->weight_from=$request['weight_from'.$i];      
                    $w_m->weight_to=$request['weight_to'.$i];      
                    $w_m->amount=$request['amount'.$i];  
                    $w_m->shipping_country_states_id=$request['shipping_country_states_id'];    

                }

                $w_m->save();
            }   

        return redirect('admin/shipping-management')->with('successmessage','Record updated successfully');


    }

    public function deleteShippingManagment($id){

        ShippingCountryState::where('id',$id)->delete();
        WeightManagement::where('shipping_country_states_id',$id)->delete();

        return redirect('admin/shipping-management')->with('successmessage','Record deleted successfully');

    }
    
    public function uploadAssetProcess(Request $request){
        // dd($request->all());
        $order_detail=OrderDetail::select('user_id')->where('id',$request['order_detail_id'])->first();
        $user_id=$order_detail->user_id;
         
        $dir_path= public_path('uploads/order_assets/'.$user_id);    
        

        if(!is_dir($dir_path))
        {
         mkdir($dir_path);
        }
        // else
        // {
        //   echo "not found";  
        // }

        // exit();
        $counter=$request['asset_counter'];
        for($i=1;$i<=$counter;$i++){

            if($i ==1){
                $order_asset=new OrderAsset;
                

                if($request->hasFile('asset_file') && $request->asset_file->isValid())
                {
                    $extension=$request->asset_file->extension();
                    $filename=date('m-d-Y').mt_rand(999,999999).'__'.time().'.'.$extension;
                    
                    $request->asset_file->move(public_path('uploads/order_assets/'.$user_id),$filename);

                   
                }

                else
                {
                    $filename=null;
                }

                $order_asset->asset_file_name=$request['asset_file_name'];
                $order_asset->asset_file=$filename;
                $order_asset->order_detail_id=$request['order_detail_id'];
                $order_asset->asset_counter=$request['asset_counter'];
            }
            else
            {
                $order_asset=new OrderAsset;
                

                if($request->hasFile('asset_file'.$i) && $request['asset_file'.$i]->isValid())
                {
                    $extension=$request['asset_file'.$i]->extension();
                    $filename=date('m-d-Y').mt_rand(999,999999).'__'.time().'.'.$extension;
                    $request['asset_file'.$i]->move(public_path('uploads/order_assets/'.$user_id),$filename);
                }
                else
                {
                    $filename=null;
                }

                $order_asset->asset_file_name=$request['asset_file_name'.$i];
                $order_asset->asset_file=$filename;
                $order_asset->order_detail_id=$request['order_detail_id'];
                $order_asset->asset_counter=$request['asset_counter'];
                
            } //else
            
            $order_asset->save();

        } //for loop

        return redirect()->back();

    }

    public function viewOrderAsset(){
        

        if(isset($_GET['order_detail_id'])){
            $order_detail_id=$_GET['order_detail_id'];
        } 

        $order_detail=OrderDetail::select('user_id')->where('id',$order_detail_id)->first();
        $user_id=$order_detail->user_id;
        $assets=OrderAsset::where('order_detail_id',$order_detail_id)->get();

        return response()->json([
            'assets'=>$assets,
            'user_id'=>$user_id
            ]);


    }

    public function viewCustomerOrderAsset($user_id){

        $order_details=OrderDetail::where('user_id',$user_id)->orderBy('id','DESC')->get();
        // dd($order_details);
        return view('user.admin.view-customer-order-assets',['order_details'=>$order_details,'user_id'=>$user_id]);
    }

    public function deleteOrderAsset(){

       if(isset($_GET['order_asset_id'])){
        $order_asset_id=$_GET['order_asset_id'];
       }
       if(isset($_GET['user_id'])){
        $user_id=$_GET['user_id'];
       } 


       $order_asset = OrderAsset::where('id',$order_asset_id)->first();
       File::delete(public_path('uploads/order_assets/'.$user_id.'/'.$order_asset->asset_file));
       OrderAsset::where('id',$order_asset_id)->delete();

       return response()->json([
        'error'=>false
        ]);


    }

    public function addOrderNote(Request $request){

        $order_note=new OrderNote;
        $order_note->order_id=$request['order_id'];
        $order_note->note_description=$request['note_description'];
        $order_note->note_reminder_date=$request['note_reminder_date'];
        $order_note->save();

        $order_note_id=$order_note->id;
        $note_description=$order_note->note_description;
        $note_reminder_date=$order_note->note_reminder_date;
        $count_rows=OrderNote::where('order_id',$request['order_id'])->count();
            
        return response()->json(
          [
          'order_note_id'=>$order_note_id,
          'note_description'=>$note_description,
          'note_reminder_date'=>$note_reminder_date,
          'count_rows'=>$count_rows,
          ]
          );
      

    }

    public function deleteOrderNote(){
      if(isset($_GET['order_note_id'])){  

      $order_note_id=$_GET['order_note_id'];
      }

      OrderNote::where('id',$order_note_id)->delete();

      // return redirect()->back()->with('successmessage','Order Note deleted successfully');
      return response()->json(
          [
          "ok",
          ]
          );

    }

    public function addCustomerNote(Request $request){
  
        $customer_note=new CustomerNote;
        $customer_note->customer_id=$request['user_id'];
        $customer_note->note_description=$request['note_description'];
        $customer_note->save();

        $note_description=$customer_note->note_description;
        $customer_note_id=$customer_note->id;

        $count_rows=CustomerNote::where('customer_id',$request['user_id'])->count();
        
        
      

        return response()->json(
          [
          'customer_note_id'=>$customer_note_id,
          'note_description'=>$note_description,
          'count_rows'=>$count_rows,
          ]
          );
      

    }

    public function deleteCustomerNote(){

      if(isset($_GET['customer_note_id'])){  
            $customer_note_id=$_GET['customer_note_id'];
      }
      CustomerNote::where('id',$customer_note_id)->delete();

      return response()->json(
          [
          "ok",
          ]
          );

    }


    public function updateDepositToCustomer(Request $request){

        $user=User::where('id',$request['user_id'])->first();
        $user->deposit_cost = $request['deposit_cost'];
        $user->save();

        return redirect('admin/customer/'.$request['user_id'].'/detail')->with('successmessage','Deposit update successfully');
    }

    public function sendMessageToCustomer(Request $request){

       
    
              /*  $chat= new Chat;
                // $chat->from_id=Auth::user()->id;
                $chat->from_id=1;
                $chat->to_id=$request['user_id'];
                $chat->read_status=0;
                $chat->sent_by=1;
                $chat->save();
        
                $user_message= new UserMessage;
                $user_message->chat_id=$chat->id;
                // $user_message->from_id=Auth::user()->id;
                $user_message->from_id=1;
                $user_message->to_id=$request['user_id'];
                $user_message->message=$request['message_body'];
                $user_message->save();
*/
                $user=User::where('id',$request['user_id'])->first();

                $data = array(
                            'firstname'      => $user->first_name,
                            'lastname'       => $user->last_name,
                            'email'          => $user->email,
                            'message_body'   => $request['message_body']
                            
                        ); 

                Mail::send('emails.send-message-customer',  $data, function ($message) use ($data) {
                  $message->to($data['email'])
                          ->subject('New Message');
                      });

       
            return redirect('admin/customer/'.$request['user_id'].'/detail')->with('successmessage','Message sent successfully');
        
         
       
        

    }

    public function inbox(){

    $chats=Chat::where('archive_status',0)->orderBy('updated_at','DESC')->get();
       $i=0;

       if($chats->count())
       {
       foreach($chats as $chat)
       {

            if($chat->from_id==1)
            {
                $from_id=$chat->to_id;
            }
            else
            {
                $from_id=$chat->from_id;

            }
            $user= User::where('id',$from_id)->first();
            $user_messages=UserMessage::where('chat_id',$chat->id)->orderBy('created_at','DESC')->first();   

            $left_chat_menu[$i]=array(  

                'first_name'=>$user->first_name,
                'last_name'=>$user->last_name,
                'user_id' =>$user->id,
                'latest_message'=>$user_messages->message,
                'created_at'=>$user_messages->created_at,
                'chat_id'=>$chat->id,
                'read_status'=>$chat->read_status,
                'sent_by'=>$chat->sent_by

                );

            $i++;

       }
      }
      else
      {

        $left_chat_menu=null;
      }
       
 
       return view('user.admin.inbox',['left_chat_menu'=>$left_chat_menu]);

    }

    public function fetchChatContent(){


       $chat_id=$_GET['chat_id'];
        
        $chat=Chat::where('id',$chat_id)->first();
        
        
        if($chat)
        {

             if($chat->sent_by==0) //agar user ne behja ha then update karo
             { 
                $chat->read_status=1;
                $chat->save();
             }

        }

        $user_messages=UserMessage::where(['chat_id'=>$chat_id])->get();

        $i=0;
        foreach($user_messages as $user_message)
        {   
            $from=User::select('users.id','users.first_name','users.last_name')->where('id',$user_message->from_id)->first();
            $to=User::select('users.id','users.first_name','users.last_name')->where('id',$user_message->to_id)->first();
            
            $result[$i]= array(
                'from_id'=>$from->id,
                'to_id'=>$to->id,
                'from'=>$from->first_name." ".$from->last_name,
                'to'=>$to->first_name." ".$to->last_name,
                'message'=>$user_message->message,
                'created_at'=>date('Y-m-d H:i:s',strtotime($user_message->created_at))

                );

            $i++;
        }
        return response()->json(
            [
                    
                'result'=>$result


            ]
            );


    }

    public function sendMessageToCustomerFromChatBox(Request $request){

     // $existing_chat=Chat::where('to_id',$request['user_id'])->orWhere('from_id',$request['user_id'])->first(); 

     $existing_chat=Chat::where('id',$request['chat_id'])->first();

      if($existing_chat)
        {
           
                $user_message= new UserMessage;
                $user_message->chat_id=$existing_chat->id;
                // $user_message->from_id=Auth::user()->id;
                $user_message->from_id=1;
                $user_message->to_id=$request['user_id'];
                $user_message->message=$request['message_body'];
                $user_message->save(); 

                $existing_chat->read_status=0;
                $existing_chat->sent_by=1;
                $existing_chat->updated_at=date('Y-m-d H:i:s');


                $existing_chat->save(); 
        
        }
        else
        {
                $chat= new Chat;
                // $chat->from_id=Auth::user()->id;
                $chat->from_id=1;
                $chat->to_id=$request['user_id'];
                $chat->read_status=0;
                $chat->sent_by=1;
                $chat->save();
        
                $user_message= new UserMessage;
                $user_message->chat_id=$chat->id;
                // $user_message->from_id=Auth::user()->id;
                $user_message->from_id=1;
                $user_message->to_id=$request['user_id'];
                $user_message->message=$request['message_body'];
                $user_message->save();
        }

       
        // $user=User::where(['id'=>Auth::user()->id])->first();
        $user=User::where(['id'=>1])->first();

        if($request['redirect_page']=="ok")
        {
            return redirect('admin/inbox')->with('successmessage','Message sent successfully');
        }
        else
        {
        return response()->json([
              'from'=>$user->first_name." ".$user->last_name,
              'message_body'=>$request['message_body'],
              'created_at'=>date('Y-m-d H:i:s',strtotime($user_message->created_at))
            ]);
        
        }

    }

    public function archive(){

      $chats=Chat::where('archive_status',1)->orderBy('updated_at','DESC')->get();
       $i=0;

       if($chats->count())
       {
       foreach($chats as $chat)
       {

            if($chat->from_id==1)
            {
                $from_id=$chat->to_id;
            }
            else
            {
                $from_id=$chat->from_id;

            }
            $user= User::where('id',$from_id)->first();
            $user_messages=UserMessage::where('chat_id',$chat->id)->orderBy('created_at','DESC')->first();   

            $left_chat_menu[$i]=array(  

                'first_name'=>$user->first_name,
                'last_name'=>$user->last_name,
                'user_id' =>$user->id,
                'latest_message'=>$user_messages->message,
                'created_at'=>$user_messages->created_at,
                'chat_id'=>$chat->id,
                'read_status'=>$chat->read_status,
                'sent_by'=>$chat->sent_by

                );

            $i++;

       }
      }
      else
      {

        $left_chat_menu=null;
      }
       
 
       return view('user.admin.archive',['left_chat_menu'=>$left_chat_menu]);


    }

    public function moveChatToArchive($chat_id){

       

       $chat=Chat::where('id',$chat_id)->first();
       if($chat)
       {

         $chat->archive_status=1;
         $chat->save(); 

       }

       return redirect('admin/archive')->with('successmessage','Chat is closed successfully');

    }

    public function assignCustomerGroup(Request $request){

    $user=User::where('id',$request['user_id'])->first();
    $user->customer_group_id=$request['customer_group'];
    $user->save();

    return redirect('admin/customers/active')->with('successmessage','Success! Customer Group Assigned Successfully');


  }

    public function autoCompleteAdvanceSearch(){

    $term = $_GET['term'];

    if( isset($_GET['type'])){
      $type=$_GET['type'];
    }


   if($type == "first_name"){

   $first_names = User::select('first_name')->get();
            $result = array();
            foreach ($first_names as $first_name) {
               $firstNameLabel = $first_name->first_name;
               if ( strpos( strtoupper($firstNameLabel), strtoupper($term) )!== false ) {
                  array_push( $result, array('label' => $first_name->first_name));
               }
            }
   }
 
  elseif($type == "last_name"){

   $last_names = User::select('last_name')->get();
            $result = array();
            foreach ($last_names as $last_name) {
               $lastNameLabel = $last_name->last_name;
               if ( strpos( strtoupper($lastNameLabel), strtoupper($term) )!== false ) {
                  array_push( $result, array('label' => $last_name->last_name));
               }
            }
   }
   
   elseif($type == "email"){

    $emails = User::select('email')->get();
            $result = array();
            foreach ($emails as $email) {
               $emailLabel = $email->email;
               if ( strpos( strtoupper($emailLabel), strtoupper($term) )!== false ) {
                  array_push( $result, array('label' => $email->email));
               }
            }
   }

  //   if($type == "country"){

  //        $countries = Country::select('name')->groupBy('name')->get();
  //           $result = array();
  //           foreach ($countries as $country) {
  //              $countryLabel = $country->name;
  //              if ( strpos( strtoupper($countryLabel), strtoupper($term) )!== false ) {
  //                 array_push( $result, array('label' => $country->name));
  //              }
  //           }



  //   }

  //   if($type == "state"){

  //        $states = State::select('name')->groupBy('name')->get();
  //           $result = array();
  //           foreach ($states as $state) {
  //              $stateLabel = $state->name;
  //              if ( strpos( strtoupper($stateLabel), strtoupper($term) )!== false ) {
  //                 array_push( $result, array('label' => $state->name));
  //              }
  //           }

  //   }

  //   if($type == "city"){

  //        $cities = City::select('name')->groupBy('name')->get();
  //           $result = array();
  //           foreach ($cities as $city) {
  //              $cityLabel = $city->name;
  //              if ( strpos( strtoupper($cityLabel), strtoupper($term) )!== false ) {
  //                 array_push( $result, array('label' => $city->name));
  //              }
  //           }



  //   }
    return response()->json(
      $result
      );

  }

    public function advanceSearchUser(Request $request){


    // print_r($request->all());
    // exit();

    $page_status=$request['page_status'];
    $first_name=$request['first_name_advance_search'];
    $last_name=$request['last_name_advance_search'];
    $email=$request['email_advance_search'];
    $group_name=$request['group_name'];
    $country=$request['country_advance_search'];
    $state=$request['state_advance_search'];
    $city=$request['city_advance_search'];



    // $users=User::select('users.*','users.id as user_table_id','users.created_at as user_created_at','users.updated_at as user_updated_at','user_details.*','user_details.id as user_details_id','countries.name as country_name','states.name as state_name','cities.name as city_name','customer_groups.name as group_name')->join('user_details','users.id','=','user_details.user_id')->join('countries','user_details.business_country','=','countries.id')->join('states','user_details.business_state','=','states.id')->join('cities','user_details.business_city','=','cities.id')->join('customer_groups','users.customer_group_id','=','customer_groups.id');

    // ->join('shipping_details','users.id','=','shipping_details.user_id')

     $users=User::select('users.*','users.id as user_table_id','users.created_at as user_created_at','users.updated_at as user_updated_at','users.status as email_status','user_details.*','user_details.id as user_details_id','customer_groups.name as group_name','countries.name as country_name','states.name as state_name','cities.name as city_name')->join('user_details','users.id','=','user_details.user_id')->join('countries','users.country_id','=','countries.id')->join('states','users.state_id','=','states.id')->join('cities','users.city_id','=','cities.id')->join('customer_groups','users.customer_group_id','=','customer_groups.id');

    // if()

     if ($first_name){
                $users->where(function ($q) use ($first_name) {
                  $q->where('users.first_name', '=', $first_name);
                    
                        
                });
     }

     if ($last_name){
                $users->where(function ($q) use ($last_name) {
                  $q->where('users.last_name', '=', $last_name);
                        
                });
     }

    if ($email){
                $users->where(function ($q) use ($email) {
                  $q->where('users.email', '=', $email);
                        
                });
     }

     if ($country){
                $users->where(function ($q) use ($country) {
                  $q->where('users.country_id', '=', $country);
                        
                });
     }

     if ($state){
                $users->where(function ($q) use ($state) {
                  $q->where('users.state_id', '=', $state);
                        
                });
     }

     if ($city){
                $users->where(function ($q) use ($city) {
                  $q->where('users.city_id', '=', $city);
                        
                });
     }

     /*if ($group_name){
                $users->where(function ($q) use ($group_name) {
                  $q->where('users.customer_group_id', '=', $group_name);
                        
                });
     }*/

     if ($page_status =="active"){
                $users->where(function ($q) use ($page_status) {
                $q->where(['users.status'=>1,'users.user_role_id'=>4,'users.user_status'=>1]);
                        
                });
     }

     if($page_status =="pending"){

       $users->where(function ($q) use ($page_status) {
                $q->where(['users.status'=>0,'users.user_role_id'=>4,'users.user_status'=>0]);
                  
                        
                });

     }

     if($page_status =="suspended"){

       $users->where(function ($q) use ($page_status) {
                $q->where(['users.user_role_id'=>4,'users.user_status'=>2]);
                 
                        
                });

     }

     $users=$users->orderBy('users.id','DESC')->get();


  
    return response()->json([
      'user_details'=>$users
      ]);



  }

    public function sendMailToSelectedUsers(Request $request){

    $error=false;

    $subject_mail=$request['subject'];
    $message_body=$request['message'];

    $user_emails=explode(',',$request['user_email_arr']);

        foreach ($user_emails as $result) {
            
            $user=User::where('email',$result)->first();

             $data = array(
                           
                            'firstname'           => $user->first_name,
                            'lastname'            => $user->last_name,
                            'email'               => $result,
                            'message_body'        => $message_body
                             
                    ); 

            Mail::send('emails.send-mail-to-users',  $data, function ($message) use ($data,$subject_mail) {
                  $message->to($data['email'])
                          ->subject($subject_mail);
                      });

        }  

        return response()->json([
        "error"=>$error
        ]); 


  }

    public function sendMailToAllUsers(Request $request){
    $error=false;

    $subject_mail=$request['subject'];
    $message_body=$request['message'];

    

    $page_status=$request['page_status'];
    $first_name=$request['first_name_mail_modal'];
    $last_name=$request['last_name_mail_modal'];
    $email=$request['email_mail_modal'];
    $group_name=$request['group_name_mail_modal'];
    $country=$request['country_mail_modal'];
    $state=$request['state_mail_modal'];
    $city=$request['city_mail_modal'];

    // $users=User::select('users.*','users.id as user_table_id','users.created_at as user_created_at','users.updated_at as user_updated_at','users.status as email_status','user_details.*','user_details.id as user_details_id','customer_groups.name as group_name')->join('user_details','users.id','=','user_details.user_id')->join('customer_groups','users.customer_group_id','=','customer_groups.id');

    $users=User::select('users.*','users.id as user_table_id','users.created_at as user_created_at','users.updated_at as user_updated_at','users.status as email_status','user_details.*','user_details.id as user_details_id','customer_groups.name as group_name','countries.name as country_name','states.name as state_name','cities.name as city_name')->join('user_details','users.id','=','user_details.user_id')->join('countries','users.country_id','=','countries.id')->join('states','users.state_id','=','states.id')->join('cities','users.city_id','=','cities.id')->join('customer_groups','users.customer_group_id','=','customer_groups.id');

    // if()

     if ($first_name){
                $users->where(function ($q) use ($first_name) {
                  $q->where('users.first_name', '=', $first_name);
                    
                        
                });
     }

     if ($last_name){
                $users->where(function ($q) use ($last_name) {
                  $q->where('users.last_name', '=', $last_name);
                        
                });
     }

    if ($email){
                $users->where(function ($q) use ($email) {
                  $q->where('users.email', '=', $email);
                        
                });
     }

    
     if ($country){
                $users->where(function ($q) use ($country) {
                  $q->where('users.country_id', '=', $country);
                        
                });
     }

     if ($state){
                $users->where(function ($q) use ($state) {
                  $q->where('users.state_id', '=', $state);
                        
                });
     }

     if ($city){
                $users->where(function ($q) use ($city) {
                  $q->where('users.city_id', '=', $city);
                        
                });
     }


      if ($group_name){
                $users->where(function ($q) use ($group_name) {
                  $q->where('users.customer_group_id', '=', $group_name);
                        
                });
     }

     if ($page_status =="active"){
                $users->where(function ($q) use ($page_status) {
                $q->where(['users.status'=>1,'users.user_role_id'=>4,'users.user_status'=>1]);
                        
                });
     }

     if($page_status =="pending"){

       $users->where(function ($q) use ($page_status) {
                $q->where(['users.status'=>0,'users.user_role_id'=>4,'users.user_status'=>0]);
                  
                        
                });

     }

     if($page_status =="suspended"){

       $users->where(function ($q) use ($page_status) {
                $q->where(['users.user_role_id'=>4,'users.user_status'=>2]);
                 
                        
                });

     }

     $users=$users->orderBy('users.id','DESC')->get();


     foreach($users as $result){



      $data = array(
                           
                            'firstname'           => $result->first_name,
                            'lastname'            => $result->last_name,
                            'email'               => $result->email,
                            'message_body'        => $message_body
                             
                    ); 

       Mail::send('emails.send-mail-to-users',  $data, function ($message) use ($data,$subject_mail) {
                  $message->to($data['email'])
                          ->subject($subject_mail);
                      }); 

     }

     return response()->json([
        "error"=>$error
        ]);


  }

    public function setHomePageUrl(){

    
    $home_page_url= HomePageUrl::where('id',1)->first();
    $admin_1= HomePageUrl::where('id',2)->first();
    $admin_2= HomePageUrl::where('id',3)->first();
    return view('user.admin.home-page-url',['home_page_url'=>$home_page_url,'admin_1'=>$admin_1,'admin_2'=>$admin_2]);
  



  }

    public function setHomePageUrlProcess(Request $request){
    // dd($request->all());
    foreach($request->except('_token') as $key => $value)
    {
        // dd($key , $value);
        $home_page_url=HomePageUrl::where('id',$key)->first();

        $home_page_url->url= $value;
        $home_page_url->save();
    }

    return redirect()->back()->with('successmessage','Home Page Url updated successfully');



  }

    public function logout(){


    	Auth::logout();
    	return redirect('admin/login');
    }
    
}