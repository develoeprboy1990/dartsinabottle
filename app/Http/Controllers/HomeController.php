<?php

namespace App\Http\Controllers;

require 'vendor/autoload.php';

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

define("AUTHORIZENET_LOG_FILE", "phplog");

use Illuminate\Http\Request;
use App\User;
use App\UserDetail;
use App\Country;
use App\State;
use App\City;
use App\Package;
use App\BadgeSize;
use App\BadgeColor;
use App\CardFont;
use App\BadgeLine;
use App\BadgeBledSize;
use App\BadgeDiscount;
use App\OrderDetail;
use App\OrderProduct;
use App\BillingDetail;
use App\ShippingDetail;
use App\AuthorizeCustomerProfile;
use App\AuthorizeTransactionDetail;
use App\Cart;
use App\DefaultWeightManagement;
use App\ShippingCountryState;
use App\WeightManagement;
use App\CustomBadgeDetail;
use App\CustomBadgeExample;
use App\CustomBadgeAsset;
use App\CustomBadgeQuote;
use App\CustomBadgeQuoteFile;
use App\Chat;
use App\UserMessage;
use App\PaymentType;
use App\CustomerCustomPaymentType;
use App\OrderReminderInformation;
use App\OrderWireCheckDetail;
use App\OrderCourier;
use App\Content;
use DB;
use Mail;
use Auth;
use Corcel;
use Hash;
use App\Post;
use App\Menu;
use App\BadgeCoupon;
use App\BadgeType;
use App\BadgeSizeTypes;
use App\Rules\Captcha;
use App\Helpers\MyHelper;
use App\Product;
use App\ProductToCustomer;
use App\ProductCart;
use App\HomePageUrl;
use App\UserWeightPrefrences;
use App\Subscription;
use App\SubscriptionItem;
use Stripe;
use Illuminate\Support\Facades\Redirect;
use App\SubscriptionBilling;
use Carbon\Carbon;
use Laravel\Cashier\Cashier;

use Srmklive\PayPal\Services\PayPal as PayPalClient;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    //$this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  // public function index()
  // {
  //     return view('home');
  // }


  public function sendForgotPasswordLink()
  {

    return view('user.customer.forget-password-form');
  }

  public function sendForgotPasswordLinkProcess(Request $request)
  {
    // dd($request->all());
    $user = User::where('email', $request['email'])->first();

    if ($user) {

      if ($user->password_reset_token == null) {
        $password_reset_token = md5(uniqid());
        $user->password_reset_token = $password_reset_token;
        $user->save();

        $data = array(
          'firstname'      => $user->first_name,
          'lastname'       => $user->last_name,
          'email'          => $request['email'],
          'password_reset_token' => $password_reset_token,
          'user_id'        => $user->id
        );

        Mail::send('emails.send-password-reset-link',  $data, function ($message) use ($data) {
          $message->to($data['email'])
            ->subject('dartsinabottle Password Reset');
        });

        return redirect('login')->with('successmessage', 'Please check your email');
      } else {

        return redirect('login')->with('successmessage', 'Already set');
      }
    }
  }

  public function forgotPassword($user_id, $password_reset_token)
  {

    $user = User::where('id', $user_id)->first();

    if ($user) {

      if ($user->password_reset_token == null) {
        return redirect('login')->with('successmessage', 'This link is now expired');
      } else {
        // dd($user->password_reset_token);
        if ($user->password_reset_token == $password_reset_token) {
          return view('user.customer.forgot-password', ['user_id' => $user_id, 'password_reset_token' => $password_reset_token]);
        } else {
          return redirect('login')->with('successmessage', 'Something went wrong');
        }
      }
    }
  }

  public function processForgotPassword(Request $request)
  {

    $user = User::where('id', $request['user_id'])->first();

    if ($user) {


      if ($request->password != $request->confirm_password) {

        return redirect()->back()->with('successmessage', 'Error! Password and Confirm Password not matched');
      }

      if (($user->password_reset_token != null) && ($user->password_reset_token == $request['password_reset_token'])) {
        $user->password = bcrypt($request['password']);
        $user->password_reset_token = null;
        $user->save();

        $data = array(
          'firstname'      => $user->first_name,
          'lastname'       => $user->last_name,
          'email'          => $user->email,
          'password'       => $request['password']
        );

        Mail::send('emails.send-forgot-password',  $data, function ($message) use ($data) {
          $message->to($data['email'])
            ->subject('dartsinabottle Password');
        });

        return redirect('login')->with('successmessage', 'Congratulations your password is reset. Please login');
      } else {

        return redirect('login')->with('successmessage', 'Something went wrong');
      }
    }
  }

  public function signup()
  {
    return view('user.customer.signup');
  }

  public function processSignup(Request $request)
  {
    $check_existing_user = User::where('email', $request['email'])->count();

    if ($check_existing_user > 0) {

      $error = true;
    } else {
      $activation_code = md5(uniqid());

      $user = new User;
      $user->first_name = $request['first_name'];
      $user->last_name = $request['last_name'];
      $user->email = $request['email'];
      $user->password = bcrypt($request['password']);
      $user->user_role_id = 4;
      $user->activation_code = $activation_code;
      $user->save();

      $user_detail = new UserDetail;
      $user_detail->user_id = $user->id;
      $user_detail->save();

      $data = array(
        'firstname'      => $request['first_name'],
        'lastname'       => $request['last_name'],
        'email'          => $request['email'],
        'password'       => $request['password'],
        'activation_code' => $activation_code,
        'user_id'        => $user->id
      );

      Mail::send('emails.account-activation',  $data, function ($message) use ($data) {
        $message->to($data['email'])
          ->subject('dartsinabottle Account Activation');
      });

      $error = false;
    }

    return response()->json([
      'error' => $error

    ]);
  }

  public function activateAccount($id, $activation_code)
  {
    $user = User::where('id', $id)->first();
    if ($user) {

      if ($user->status == 0) {

        if ($user->activation_code == $activation_code) {
          $user->status = 1;
          // $user->account_status=1;
          $user->user_status = 1;
          $user->save();

          return redirect('login')->with('successmessage', 'You have successfully activated your account. You may login now.');
        } else {

          return redirect('signup')->with('successmessage', 'Activation code invalid');
        }
      } else {

        return redirect('signup')->with('successmessage', 'User is already activated');
      }
    } else {
      return redirect('signup')->with('successmessage', 'User with this email not found');
    }
  }

  public function login()
  {
    return view('user.customer.login');
  }

  public function processLogin(Request $request)
  {
    $this->validate($request, [
      'g-recaptcha-response' => new Captcha(),
    ]);
    // dd($request->all());
    $user = User::where('email', $request['email'])->first();

    if ($user) {

      if ($user->status != 2) {


        if ($user->status == 1) {




          if (Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'status' => 1, 'user_role_id' => 4], false)) {

            if ($user->shipping_detail_status == 0) {
              // dd(Auth::user()->id);
              return redirect('add-shipping-detail');
            } else {

              $subscription = Subscription::where('user_id', $user->id)->whereIn('status', [1, 2, 4])->first();
              if ($subscription) {
                return redirect('dashboard');
              } else if (isset($_COOKIE['user_cookie'])) {
                return redirect('checkout');
              } else {
                return redirect('subscribe');
              }
            }
          } else {
            return redirect('login')->with('successmessage', 'Invalid username or password.');
          }
        } else {


          return redirect('login')->with('successmessage', 'Your account is not activated yet. Please check your inbox or request a new email.')->with('user_id', $user->id);
        }
      } else {
        return redirect('login')->with('successmessage', 'Your account is suspended');
      }

      //else 

    } else {

      return redirect('login')->with('successmessage', 'You missed the board! No user with that email found. Please try again.');
    }
  }

  public function resendActivationEmail(Request $request)
  {
    $user = User::where('id', $request->user_id)->first();
    // dd($user);

    $data = array(
      'firstname'      => $user->first_name,
      'lastname'       => $user->last_name,
      'email'          => $user->email,
      'password'       => $user->password,
      'activation_code' => $user->activation_code,
      'user_id'        => $user->id
    );

    Mail::send('emails.account-activation',  $data, function ($message) use ($data) {
      $message->to($data['email'])
        ->subject('dartsinabottle Account Activation');
    });
    return response()->json(['success' => true]);
  }

  public function changePassword()
  {
    return view('user.customer.change-password');
  }

  public function processChangePassword(Request $request)
  {
    $user = User::where('id', $request['user_id'])->first();

    if (Hash::check($request['current_password'], $user->getAuthPassword())) {

      if ($request['current_password'] == $request['new_password']) {

        return redirect('change-password')->with('successmessage', 'Please choose a different new password');
      } elseif ($request['new_password'] == $request['confirm_password']) {

        return redirect('change-password')->with('successmessage', 'Sorry! Your confirm new password doesnot match with your new password');
      }

      $user->password = bcrypt($request['new_password']);
      $user->save();
    } else {
      return redirect('change-password')->with('successmessage', 'Your current password is not correct');
    }

    Auth::logout();
    return redirect('login')->with('successmessage', 'Password updated successfully');
  }

  public function updatePayPalEmail()
  {
    return view('user.customer.update-pyapal-email');
  }

  public function processupdatePayPalEmail(Request $request)
  {
    $user = User::where('id', $request['user_id'])->first();
    $user->paypal_email = $request['paypal_email'];
    $user->save();
    return redirect('update-paypal-email')->with('successmessage', 'PayPal Email updated successfully');
  }

  public function index()
  {
    return view('user.customer.index');
  }

  public function browse()
  {
    $packages = Package::all();
    $light_products = Product::where('product_weight_range', 'Light')->where('active_status', '1')->count();

    $medium_products = Product::where('product_weight_range', 'Medium')->where('active_status', '1')->count();

    $heavy_products = Product::where('product_weight_range', 'Heavy')->where('active_status', '1')->count();

    return view('user.customer.browse', ['packages' => $packages, 'light_products' => $light_products, 'medium_products' => $medium_products, 'heavy_products' => $heavy_products]);
  }

  /*  public function browseDetail($type=null,$sortby=null){      

    if($sortby == '')
    { $sortby = 'ASC'; }
    else{
     $sorting =  explode('_',$sortby);
     $sortby = $sorting[1];
    }

    
     if(Auth::check())
     {
      $products = Product::where('product_weight_range',$type)->where('user_id', '<>', Auth::user()->id)->orderBy('product_weight', $sortby)->get();
     $order_details = Subscription::where(['user_id' => Auth::user()->id])->where(['status'=>4])->orderBy('id', 'DESC')->first();
      }else{
        $products = Product::where('product_weight_range',$type)->orderBy('product_weight', $sortby)->get();
        $order_details = array();
      }
//dd($order_details);



    return view('user.customer.browse-detail',['products'=>$products,'type'=>$type,'sortby'=>$sortby,'order_details' => $order_details]);
        


    }
*/

  public function browseLight($sortby = null)
  {

    $type = 'Light';

    if ($sortby == '') {
      $sortby = 'ASC';
    } else {
      $sorting =  explode('_', $sortby);
      $sortby = $sorting[1];
    }


    if (Auth::check()) {
      $products = Product::where('product_weight_range', $type)->where('user_id', '<>', Auth::user()->id)->orderBy('product_weight', $sortby)->get();
      $order_details = Subscription::where(['user_id' => Auth::user()->id])->where(['status' => 4])->orderBy('id', 'DESC')->first();
    } else {
      $products = Product::where('product_weight_range', $type)->orderBy('product_weight', $sortby)->get();
      $order_details = array();
    }
    //dd($order_details);



    return view('user.customer.browse-light', ['products' => $products, 'type' => $type, 'sortby' => $sortby, 'order_details' => $order_details]);
  }

  public function browseMedium($sortby = null)
  {

    $type = 'Medium';

    if ($sortby == '') {
      $sortby = 'ASC';
    } else {
      $sorting =  explode('_', $sortby);
      $sortby = $sorting[1];
    }


    if (Auth::check()) {
      $products = Product::where('product_weight_range', $type)->where('user_id', '<>', Auth::user()->id)->orderBy('product_weight', $sortby)->get();
      $order_details = Subscription::where(['user_id' => Auth::user()->id])->where(['status' => 4])->orderBy('id', 'DESC')->first();
    } else {
      $products = Product::where('product_weight_range', $type)->orderBy('product_weight', $sortby)->get();
      $order_details = array();
    }
    //dd($order_details);

    return view('user.customer.browse-medium', ['products' => $products, 'type' => $type, 'sortby' => $sortby, 'order_details' => $order_details]);
  }

  public function browseHeavy($sortby = null)
  {

    $type = 'Heavy';

    if ($sortby == '') {
      $sortby = 'ASC';
    } else {
      $sorting =  explode('_', $sortby);
      $sortby = $sorting[1];
    }


    if (Auth::check()) {
      $products = Product::where('product_weight_range', $type)->where('user_id', '<>', Auth::user()->id)->orderBy('product_weight', $sortby)->get();
      $order_details = Subscription::where(['user_id' => Auth::user()->id])->where(['status' => 4])->orderBy('id', 'DESC')->first();
    } else {
      $products = Product::where('product_weight_range', $type)->orderBy('product_weight', $sortby)->get();
      $order_details = array();
    }
    //dd($order_details);

    return view('user.customer.browse-heavy', ['products' => $products, 'type' => $type, 'sortby' => $sortby, 'order_details' => $order_details]);
  }


  public function verifyCustomerChoice(Request $request)
  {
    $user = User::where('id', Auth::user()->id)->first();

    $subscription = Subscription::where('user_id', $user->id)->whereIn('status', [4])->first();

    if ($subscription) {
      if ($subscription->choice == 'Lend') {
        $lent_darts = Product::where('user_id', $user->id)->first();

        if ($lent_darts) {
          return response()->json([
            'error' => false,
            'title' => 'Request barrels',
            'text' => 'Are you sure you want these?',
            'error_type' => 0
          ]);
        } else {
          return response()->json([
            'error' => true,
            'title' => 'Error!',
            'text' => 'We have not received your lent darts yet. Please await confirmation via email.',
            'error_type' => 1
          ]);
        }
      } else if ($subscription->choice == 'Deposit') {
        return response()->json([
          'error' => false,
          'title' => 'Request barrels',
          'text' => 'Are you sure you want these?',
          'error_type' => 0
        ]);
      }
    } else {
      return response()->json([
        'error' => true,
        'title' => 'Error!',
        'text' => 'Supscription not found.',
        'error_type' => 2
      ]);
    }
  }

  public function shipOrderWhosePaymentIsDone(Request $request)
  {
    $error = false;
    //1= Shipped, 2=Pending Shipped , 3=Cancelled ,4=Pending

    $user = User::where('id', Auth::user()->id)->first();
    $order_detail = Subscription::where('user_id', $user->id)->whereIn('status', [4])->first();
    if ($order_detail) {

      //cheking of how many darts send in last 30 days...
      //$invoice = $order_detail->getUser->subscription('default')->upcomingInvoice();
      //dd($invoice);

      $per_month_limit = $order_detail->getProductDetail->getPackage->darts_set;

      $subscription_billing = SubscriptionBilling::where('subscription_id', $order_detail->id)->orderBy('id', 'DESC')->first();

      $current_month_count = ProductToCustomer::where('user_id', $order_detail->user_id)->where('subscription_billing_id', $subscription_billing->id)->whereIn('status', ['Shipped', 'Returned', 'Sold'])->count();

      if ($current_month_count < $per_month_limit) {

        $user_id = $order_detail->user_id;

        $product_to_customer = new ProductToCustomer;
        $product_to_customer->subscription_id = $order_detail->id;
        $product_to_customer->user_id = $order_detail->user_id;
        $product_to_customer->product_id = $request['product_id'];
        $product_to_customer->subscription_billing_id = $subscription_billing->id;
        $product_to_customer->status = 'Shipped';
        $product_to_customer->save();

        $product = Product::where('id', $request['product_id'])->first();
        $product->active_status = 2; //2 means product is now reserved
        $product->save();

        $order_detail->status = 2;   //2 means order is now pending shipped
        $order_detail->save();

        $lent_darts = Product::where('user_id', $user_id)->where('active_status', '!=', 3)->get();
        $need_to_set = false;
        foreach ($lent_darts as $lent_dart) {
          if ($lent_dart->product_price_type == 'not_for_sale') {
            $need_to_set = true;
          }
        }
        if ($need_to_set) {
          $set_price = "<br><br>If you wish to purchase the barrels, please check your ‘Current Darts’ section to see if they are for sale.<br><br>If you don’t like them, or wish to request the next set in your subscription, please return them in the included bottle and prepaid envelope. (Please use the bottle for returns, as it will protect the barrels in transit.)";
        } else {
          $set_price = "";
        }


        $user = User::where('id', $user_id)->first();
        $data = array(
          'firstname'      => $user->first_name,
          'lastname'       => $user->last_name,
          'email'          => $user->email,
          'message_body'   => 'Your dartsinabottle will be posted in the next 24 hours. <br> We hope you enjoy playing with them.' . $set_price,

        );
        Mail::send('emails.send-message-customer',  $data, function ($message) use ($data) {
          $message->to($data['email'])
            ->subject('Your dartsinabottle will be posted soon.');
        });
        return response()->json([
          "error" => 'success'
        ]);
      }
      return response()->json([
        "error" => 'limit reached'
      ]);
    }
    return response()->json([
      "error" => 'no subscribtion'
    ]);
  }


  public function shop()
  {
    $packages = Package::all();
    return view('user.customer.shop', ['packages' => $packages]);
  }

  public function AboutUs()
  {
    return view('user.customer.aboutus');
  }

  public function getFaq()
  {
    return view('user.customer.faq');
  }

  public function ContactUs()
  {
    return view('user.customer.contactus');
  }
  public function PrivayPolicy()
  {
    return view('user.customer.privay-policy');
  }
  public function TermOfService()
  {
    return view('user.customer.term-of-service');
  }
  public function getPackage($id)
  {
    $package = Package::where('id', $id)->first();
    $html = "";
    if ($package !== null) {
      $array = explode('.', $package->price);
      $html = '<div class="price-header">
              <div class="col-xs-6">
              <h3 class="title">' . $package->darts_set . ' SETS</h3>
              </div>
              <div class="col-xs-6">';
      for ($set = 1; $set <= $package->darts_set; $set++) {
        $html .= '<img src=' . asset("public/uploads/bottle.png") . ' alt="selected badge" class="bottle-img">';
      }
      $html .= '</div>
            </div>
                <div class="price-value">
              <div class="value">
                <span class="currency">£' . $array[0] . '.' . $array[1] . '</span>
                <span class="month">/month</span>
              </div>
            </div>
                <ul class="deals">' . $package->description . '</ul>';
    }
    return response()->json([

      'html' => $html,
      'package_id' => $id

    ]);
  }

  public function cart(Request $request)
  {

    // dd($request->all());
    // $user = Auth::User();
    if (isset($_COOKIE["user_cookie"])) {

      $check_user = Cart::where('user_cookie', $_COOKIE["user_cookie"])->count();
      /*$check_user_p=ProductCart::where('user_cookie',$_COOKIE["user_cookie"])->count();*/
      //if($check_user || $check_user_p) {
      if ($check_user) {
        $user_cookie = $_COOKIE["user_cookie"];
        Cart::where('user_cookie', $user_cookie)->delete();
      } else {
        $user_cookie = uniqid();
        setcookie("user_cookie", $user_cookie, time() + (86400 * 30), "/");
      }
    } else {
      $user_cookie = uniqid();
      setcookie("user_cookie", $user_cookie, time() + (86400 * 30), "/");
    }


    $package = Package::where('id', $request['package_id'])->first();

    $website_setting = HomePageUrl::where('id', 1)->first();

    $cart = new Cart;
    $cart->user_cookie = $user_cookie;
    // $cart->user_id = $user->id;
    $cart->package_id = $request['package_id'];
    $cart->choice = $request['choice_id'];
    $cart->price = $package->price;
    $cart->darts_set = $package->darts_set;
    $cart->darts_interval = $package->darts_interval;
    $cart->total_qty = 1;
    if ($request['choice_id'] == 'Lend')
      $cart->deposit_cost = $website_setting->lend_deposit_cost;
    else
      $cart->deposit_cost = $website_setting->deposit_cost;

    $cart->save();
    return redirect('cart');
  }

  public function getCart()
  {
    if (isset($_COOKIE["user_cookie"])) {
      $result_cart = Cart::where('user_cookie', $_COOKIE["user_cookie"])->orderBy('id', 'DESC')->first();
      $package = Package::where('id', $result_cart->package_id)->first();

      /*$product_cart = ProductCart::where('user_cookie',$_COOKIE["user_cookie"])->orderBy('id','DESC')->get();
        */

      // dd($cart);
      // $this->getTotal($_COOKIE["user_cookie"]);
      if ($result_cart->count()) {
        $original_total = 0;
        $discounted_total = 0;
        $i = 0;

        $array = explode('.', $result_cart->price);
        // dd($result_cart);
        if ($result_cart->product_id == null) {
          $get_cart[$i] = array(
            'cart_id' => $result_cart->id,
            'package_id' => $result_cart->package_id,
            'sort_1' => $result_cart->sort_1,
            'sort_2' => $result_cart->sort_2,
            'sort_3' => $result_cart->sort_3,
            'amount_prefix' => $array[0],
            'amount_sufix' => $array[1],
            'subtotal' => $result_cart->price,
            'darts_set' => $result_cart->darts_set,
            'darts_interval' => $result_cart->darts_interval,
            'total_qty' => $result_cart->total_qty,
            'product_id' => @$result_cart->product_id,
            'description' => @$package->description,
            'deposit_cost' => @$result_cart->deposit_cost,
            'original_total' => ($result_cart->price + $result_cart->deposit_cost)

          );
        } else {
          $get_cart[$i] = array(
            'cart_id' => $result_cart->id,
            'subtotal' => $result_cart->price,
            'total_qty' => $result_cart->total_qty,
            'product_id' => $result_cart->product_id
          );
        }
        $i++;
      } // if(count(cart))
      else {
        $get_cart = null;
      }
    } //isset cookie end
    else {
      $get_cart = null;
      $product_cart = null;
    }
    return view('user.customer.cart', ['get_cart' => $get_cart]);
  }

  public function addShippingDetail()
  {
    $states = State::where('country_id', 230)->orderBy('name', 'ASC')->get();
    $user = User::where('id', Auth::user()->id)->first();

    $shipping_detail =  ShippingDetail::where('user_id', Auth::user()->id)->first();

    return view('user.customer.add-shipping-detail', ['states' => $states, 'user' => $user, 'shipping_detail' => $shipping_detail]);
  }

  public function addShippingDetailProcess(Request $request)
  {
    $postcode = $request['shipping_zip'];

    $postcode = strtoupper(str_replace(' ', '', $postcode));
    if (preg_match("/(^[A-Z]{1,2}[0-9R][0-9A-Z]?[\s]?[0-9][ABD-HJLNP-UW-Z]{2}$)/i", $postcode) || preg_match("/(^[A-Z]{1,2}[0-9R][0-9A-Z]$)/i", $postcode)) {
      //return true;
    } else {
      return back()->withInput($request->input())->with('errormessage', 'Please enter a valid zipcode!');
    }

    $shipping_detail =  ShippingDetail::where('user_id', Auth::user()->id)->first();

    if (!$shipping_detail)
      $shipping_detail = new ShippingDetail;

    $shipping_detail->user_id = Auth::user()->id;
    $shipping_detail->first_name = Auth::user()->first_name;
    $shipping_detail->last_name = Auth::user()->last_name;
    $shipping_detail->email = $request['shipping_email'];
    $shipping_detail->country_id = 230;
    //$shipping_detail->state_id = $request['state_id'];
    $shipping_detail->city_id = $request['city_id'];
    $shipping_detail->address = $request['shipping_address'];
    $shipping_detail->address_2 = $request['shipping_address_2'];
    $shipping_detail->zip = $request['shipping_zip'];
    $shipping_detail->phone = $request['shipping_phone'];
    $shipping_detail->save();

    $user = User::where('id', Auth::user()->id)->first();
    $user->shipping_detail_status = 1;

    // First Shipping Detail added to users so that we can use them in adavnce search
    $user->country_id = 230;
    //$user->state_id = $request['state_id'];
    $user->city_id = $request['city_id'];
    $user->save();

    if (isset($_COOKIE['user_cookie'])) {
      return redirect('checkout');
    } else {
      return redirect('subscribe');
    }
  }

  public function addMoreShippingDetail(Request $request)
  {
    $shipping_detail = new ShippingDetail;
    $shipping_detail->user_id = Auth::user()->id;
    $shipping_detail->email = $request['shipping_email'];
    $shipping_detail->country_id = 231;
    $shipping_detail->state_id = $request['state_id'];
    $shipping_detail->city_id = $request['city_id'];
    $shipping_detail->address = $request['shipping_address'];
    $shipping_detail->phone = $request['shipping_phone'];
    $shipping_detail->zip = $request['shipping_zip'];
    $shipping_detail->save();

    return response()->json([
      "ok"
    ]);
  }

  public function getBill($user_cookie = null)
  {

    if ($user_cookie != null) {
      $result_cart = Cart::where('user_cookie', $user_cookie)->orderBy('id', 'DESC')->first();

      // $this->getTotal($_COOKIE["user_cookie"]);
      if ($result_cart->count()) {
        $i = 0;
        $total_items = 0;
        $total_sub_total = 0;
        $total_discounted_total = 0;
        $weight = 0.0;


        if ($result_cart->product_id == null) {

          $s_i_sub_total = $result_cart->price;
        } else {
          $s_i_sub_total = $result_cart->price * $result_cart->total_badge_qty;
        }


        $badge_discount = BadgeDiscount::where('badge_size_id', $result_cart->package_id)->where('quantity_from', '<=', $result_cart->total_qty)->where('quantity_to', '>=', $result_cart->total_qty)->first();
        // dd($badge_discount);

        $total_sub_total = $total_sub_total + $s_i_sub_total;

        $total_items = $total_items + $result_cart->total_qty;



        // $total_single_item=$total_single_item+$result_cart['']
        // dd($total_sub_total);
        if ($badge_discount) {

          $discount_percent = $badge_discount->discount_percent;
          $discount_margin = ($s_i_sub_total * $discount_percent) / 100;
          $s_i_d_t = $s_i_sub_total - $discount_margin;
          // $total_discounted_total=$total_discounted_total+$s_i_d_t;


        } else {
          $discount_percent = 0;
          $discount_margin = 0;
          $s_i_d_t = $s_i_sub_total;
          // $total_discounted_total=$total_sub_total;

        }

        // $original_total=$original_total+$s_i_sub_total;
        $total_discounted_total = ($total_discounted_total + $s_i_sub_total) - $discount_margin;


        // dd($badge_full_bg_color);
        if ($result_cart->product_id == null) {
          $get_cart[$i] = array(
            'cart_id' => $result_cart->id,
            'product_id' => $result_cart->product_id,
            'total_qty' => ($result_cart->total_qty),
            's_i_sub_total' => $s_i_sub_total,
            'discount_percent' => $discount_percent,
            's_i_d_t' => $s_i_d_t,
            'package_id' => $result_cart->package_id,
            'sort_1' => $result_cart->sort_1,
            'sort_2' => $result_cart->sort_2,
            'sort_3' => $result_cart->sort_3

          );
        } else {
          $get_cart[$i] = array(
            'cart_id' => $result_cart->id,
            'product_id' => $result_cart->product_id,
            'total_qty' => $result_cart->total_qty,
            's_i_sub_total' => $s_i_sub_total,
            'discount_percent' => $discount_percent,
            's_i_d_t' => $s_i_d_t

          );
        }



        $weight = '';

        // Shipping Cost Start
        $shipping_details = ShippingDetail::where('user_id', Auth::user()->id)->get();
        // dd($shipping_details);
        $ship_country_id = $shipping_details[0]->country_id;
        $ship_state_id = $shipping_details[0]->state_id;
        $ship_city_id = $shipping_details[0]->city_id;

        $shipping_country_state = ShippingCountryState::where(['state_id' => $ship_state_id])->first();
        if ($shipping_country_state) {
          //custom settings
          $weight_management = WeightManagement::where('shipping_country_states_id', $shipping_country_state->id)
            ->where('weight_from', '<=', $weight)
            ->where('weight_to', '>=', $weight)
            ->first();




          if ($weight_management) {

            $shipping_cost = $weight_management->amount;
            // dd($shipping_cost);

          } else {


            $check_country = ShippingCountryState::where(['country_id' => $ship_country_id, 'status' => 0])->first();

            if ($check_country) {

              $weight_management = WeightManagement::where('shipping_country_states_id', $check_country->id)->where('weight_from', '<=', $weight)
                ->where('weight_to', '>=', $weight)
                ->first();

              if ($weight_management) {
                $shipping_cost = $weight_management->amount;
              } else {
                $default_weight_management = DefaultWeightManagement::where('weight_from', '<=', $weight)->where('weight_to', '>=', $weight)->first();

                if (!empty($default_weight_management)) {
                  $shipping_cost = $default_weight_management->amount;
                } else {

                  $shipping_cost = null;
                }
              }
            } else {

              // dd('else case');
              $default_weight_management = DefaultWeightManagement::where('weight_from', '<=', $weight)->where('weight_to', '>=', $weight)->first();

              if ($default_weight_management) {
                $shipping_cost = $default_weight_management->amount;
              } else {
                // dd("else else case");
                // return redirect('cart')->with('successmessage','Shipping price not defined');
                $shipping_cost = null;
              }
            }
          }
        } else {

          $check_country = ShippingCountryState::where(['country_id' => $ship_country_id, 'status' => 0])->first();
          if ($check_country) {
            // dd("test"); 
            $weight_management = WeightManagement::where('shipping_country_states_id', $check_country->id)->where('weight_from', '<=', $weight)
              ->where('weight_to', '>=', $weight)
              ->first();
            // dd($weight_management);      

            if ($weight_management) {
              $shipping_cost = $weight_management->amount;
            } else {

              // dd("Default case");

              $default_weight_management = DefaultWeightManagement::where('weight_from', '<=', $weight)->where('weight_to', '>=', $weight)->first();
              // dd($weight);
              // dd($default_weight_management);
              if ($default_weight_management) {
                $shipping_cost = $default_weight_management->amount;
              } else {
                // dd("else else case");
                $shipping_cost = null;
              }
            }
          }
          //Default settings
          else {
            $default_weight_management = DefaultWeightManagement::where('weight_from', '<', $weight)->where('weight_to', '>', $weight)->first();
            if ($default_weight_management) {
              $shipping_cost =  $default_weight_management->amount;
            } else {
              // dd("else else case");
              $shipping_cost = null;
            }
          }
        }

        if ($ship_state_id == 3930) {
          $state_tax = $total_discounted_total * (7 / 100);
        } else {
          $state_tax = 0;
        }

        if ($shipping_cost != null) {
          $final_total = $total_discounted_total + $shipping_cost + $state_tax;
        } else {

          $final_total = $total_discounted_total;
        }

        if ($result_cart->deposit_cost != null) {
          $final_total = $final_total + $result_cart->deposit_cost;
        }


        // Shipping Cost End 

        $get_total_values = array(
          "total_sub_total" => round($total_sub_total, 2),
          "total_discounted_total" => round($total_discounted_total, 2),
          "total_items" => $total_items,
          "weight" => $weight,
          "shipping_cost" => number_format($shipping_cost, 2),
          "state_tax" => number_format($state_tax, 2),
          "deposit_cost" => number_format($result_cart->deposit_cost, 2),
          "final_total" => round($final_total, 2)

        );
        // $get_cart['total_sub_total']=$total_sub_total;
        // $get_cart['total_discounted_total']=$total_discounted_total;
        // $get_cart['total_items']=$total_items;

      } // if(count(cart))
      else {
        $get_cart = null;
        $get_total_values = null;
      }
    } //if user_cookie end
    else {
      $get_cart = null;
      $get_total_values = null;
    }

    // dd($get_cart);

    $get_result_array = array(
      'get_cart' => $get_cart,
      'get_total_values' => $get_total_values
    );

    // dd($get_result_array);
    return $get_result_array;
  }

  public function reOrder($order_number)
  {
    if (isset($_COOKIE['user_cookie'])) {
      $user_cookie = $_COOKIE['user_cookie'];
    } else {
      $user_cookie = uniqid();
      setcookie("user_cookie", $user_cookie, time() + (86400 * 30), "/");
    }

    $order_detail = OrderDetail::where(['order_number' => $order_number, 'user_id' => Auth::user()->id])->first();

    if ($order_detail) {
      $order_products = OrderProduct::where('order_details_id', $order_detail->id)->get();

      foreach ($order_products as $result) {

        $cart = new Cart;
        $cart->user_cookie = $user_cookie;
        $cart->total_badge_qty = $result['total_badge_qty'];
        $cart->badge_size_id = $result['badge_size_id'];
        $cart->badge_color_id = $result['badge_color_id'];
        $cart->card_font_id = $result['card_font_id'];
        $cart->selectcolor = $result['font_color'];
        $cart->badge_line_id = $result['badge_line_id'];
        $cart->enterText = $result['enterText'];
        $cart->enterText2 = $result['enterText2'];
        $cart->back_side_text = $result['back_side_text'];
        $cart->back_side_text2 = $result['back_side_text2'];
        $cart->side = $result['side'];
        $cart->save();
      } //foreach

    } //count($order_detail)

    return redirect('cart');
  }

  public function checkout()
  {
    if (!Auth::check()) {

      return redirect('login');
    } else {
      $user = User::where('id', Auth::user()->id)->first();
      if ($user->shipping_detail_status == 0) {
        return redirect('add-shipping-detail');
      } else {
        $check_cart = Cart::where('user_cookie', $_COOKIE['user_cookie'])->count();
        if ($check_cart < 1) {

          return redirect('subscribe');
        } else {


          if (isset($_COOKIE["user_cookie"])) {
            $shipping_detail = ShippingDetail::where('user_id', Auth::user()->id)->get();
            $user = User::where('id', Auth::user()->id)->first();
            $states = State::where('country_id', 230)->orderBy('name', 'ASC')->get();

            $shipping_cities = City::where('state_id', $shipping_detail[0]->state_id)->get();

            $get_result_array = $this->getBill($_COOKIE["user_cookie"]);


            $ordered_items = Cart::select('package_id', 'price', 'darts_set', 'darts_interval', 'sort_1', 'sort_2', 'sort_3', 'choice', 'total_qty')->where('user_cookie', $_COOKIE["user_cookie"])->first();

            $payment_types = PaymentType::where('id', '<>', 2)->get();
            $customer_custom_payment_types = CustomerCustomPaymentType::where('user_id', Auth::user()->id)->where('payment_type_id', '<>', 2)->get();

            $wire_detail = PaymentType::where('id', 2)->first();
            $check_detail = PaymentType::where('id', 3)->first();
            $paypal_detail = PaymentType::where('id', 4)->first();
            $stripe_detail = PaymentType::where('id', 5)->first();
            // dd($get_result_array);


            $platform_fee = Package::where('id', $ordered_items->package_id)->first();

            $paypal_fee = $platform_fee->paypal_fee;
            $stripe_fee = $platform_fee->stripe_fee;

            return view('user.customer.checkout-test', ['shipping_detail' => $shipping_detail, 'user' => $user, 'states' => $states, 'shipping_cities' => $shipping_cities, 'get_result_array' => $get_result_array, 'ordered_items' => $ordered_items, 'payment_types' => $payment_types, 'customer_custom_payment_types' => $customer_custom_payment_types, 'wire_detail' => $wire_detail, 'check_detail' => $check_detail, 'paypal_detail' => $paypal_detail, 'stripe_detail' => $stripe_detail, 'paypal_fee' => $paypal_fee, 'stripe_fee' => $stripe_fee]);
          } else {

            return view('user.customer.shop');
          }
        }
      }
    }
  }

  function getCustomerPaymentProfile($customerProfileId, $customerPaymentProfileId)
  {
    // dd($customerProfileId);
    /* Create a merchantAuthenticationType object with authentication details
         retrieved from the constants file */
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    // $merchantAuthentication->setName('3H98caYa');
    // $merchantAuthentication->setTransactionKey('622q3v3vTS5AT59V');
    $my_helper =  new MyHelper;
    $result_helper = $my_helper->getAuthorizeApiCredentials();

    $merchantAuthentication->setName($result_helper['login_id']);
    $merchantAuthentication->setTransactionKey($result_helper['transaction_key']);

    // Set the transaction's refId
    $refId = 'ref' . time();
    //request requires customerProfileId and customerPaymentProfileId
    $request = new AnetAPI\GetCustomerPaymentProfileRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setCustomerProfileId($customerProfileId);
    $request->setCustomerPaymentProfileId($customerPaymentProfileId);
    $controller = new AnetController\GetCustomerPaymentProfileController($request);

    if ($result_helper['account_mode'] == "test") {
      $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
    } else {
      $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
    }

    if (($response != null)) {
      if ($response->getMessages()->getResultCode() == "Ok") {
        // echo "GetCustomerPaymentProfile SUCCESS: " . "\n";
        // echo "Customer Payment Profile Id: " . $response->getPaymentProfile()->getCustomerPaymentProfileId() . "\n";
        // echo "Customer Payment Profile Billing Address: " . $response->getPaymentProfile()->getbillTo()->getAddress(). "\n";
        // echo "Customer Payment Profile Card Last 4 " . $response->getPaymentProfile()->getPayment()->getCreditCard()->getCardNumber(). "\n";


        //-------------- below is the code of subscription but we donot need in this case-----------
        // if($response->getPaymentProfile()->getSubscriptionIds() != null) 
        // {
        //   if($response->getPaymentProfile()->getSubscriptionIds() != null)
        //   {
        //     echo "List of subscriptions:";
        //     foreach($response->getPaymentProfile()->getSubscriptionIds() as $subscriptionid)
        //       echo $subscriptionid . "\n";
        //   }
        // }

        $return_data = array(
          "error_type" => "no_error",
          "last_4_digit" => $response->getPaymentProfile()->getPayment()->getCreditCard()->getCardNumber(),
          "custom_error_check" => false
        );
      } else {
        // 1504216997
        // echo "GetCustomerPaymentProfile ERROR :  Invalid response\n";
        $errorMessages = $response->getMessages()->getMessage();
        //   echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
        $return_data = array(
          "error_type" => "invalid_response",
          "error_message" => $response->getMessages()->getMessage(),
          "error_response" => $errorMessages[0]->getCode() . "  " . $errorMessages[0]->getText() . "\n",
        );
      }
    } else {
      // echo "NULL Response Error";
      $return_data = array(
        "error_type" => "null_response",
      );
    }
    return $return_data;
  }

  public function editCart()
  {
    if (isset($_GET['cart_id'])) {

      $cart_id = $_GET['cart_id'];
    }
    $cart = Cart::where('id', $cart_id)->first();
    return response()->json([
      'cart' => $cart,
    ]);
  }

  public function editProductCart()
  {

    if (isset($_GET['cart_id'])) {
      $cart_id = $_GET['cart_id'];
    }

    $cart = ProductCart::where('id', $cart_id)->first();

    return response()->json([
      'cart' => $cart,
    ]);
  }

  public function editCartProcess(Request $request)
  {
    // dd($request->all());
    if ($request->cart_id) {
      // dd('cart_id');
      $cart = Cart::where('id', $request['cart_id'])->first();


      if ($cart) {

        $cart->total_badge_qty = $request['total_badge_qty'];
        $cart->save();
        $error = false;
      } else {
        $error = true;
      }
      // dd($cart);
    } else if ($request->prod_cart_id) {
      // dd('prod_cart_id');
      $cart = ProductCart::where('id', $request['prod_cart_id'])->first();


      if ($cart) {

        $cart->total_badge_qty = $request['total_badge_qty'];
        $cart->save();
        $error = false;
      } else {
        $error = true;
      }
    }
    return response()->json([
      'error' => $error
    ]);
  }

  public function deleteCartItem()
  {

    if (isset($_GET['cart_id'])) {
      $cart_id = $_GET['cart_id'];
    }

    Cart::where('id', $cart_id)->delete();

    return response()->json([
      "ok"
    ]);
  }

  public function deleteProductCartItem()
  {

    if (isset($_GET['cart_id'])) {
      $cart_id = $_GET['cart_id'];
    }

    ProductCart::where('id', $cart_id)->delete();

    return response()->json([
      "ok"
    ]);
  }

  public function userShippingInformation()
  {
    // dd("test");
    if (isset($_GET['id'])) {
      $error = false;
      $id = $_GET['id'];
      $shipping_detail = ShippingDetail::where('id', $id)->first();
      $state = State::where('id', $shipping_detail->state_id)->first();
      $city = City::where('id', $shipping_detail->city_id)->first();

      // New shipping details logic started
      $states = State::where('country_id', 231)->get();
      $cities = City::where('state_id', $shipping_detail->state_id)->get();
      // New shipping details logic ended

      //new code for get shipping cost
      if (isset($_COOKIE['user_cookie'])) {
        $user_cookie = $_COOKIE['user_cookie'];
      } else {
        $user_cookie = null;
      }

      if ($user_cookie != null) {
        $cart = Cart::where('user_cookie', $user_cookie)->orderBy('id', 'DESC')->get();

        // $this->getTotal($_COOKIE["user_cookie"]);
        if ($cart) {
          $i = 0;
          $total_items = 0;
          $total_sub_total = 0;
          $total_discounted_total = 0;
          $weight = 0.0;


          foreach ($cart as $result_cart) {
            $badge_size = BadgeSize::where('id', $result_cart->badge_size_id)->first();
            if ($result_cart->product_id == null) {
              if ($result_cart->side == "single_side") {
                $side = 1;
              } else {
                $side = 2;
              }



              $badge_color = BadgeColor::where('id', $result_cart->badge_color_id)->first();
              $card_font = CardFont::where('id', $result_cart->card_font_id)->first();
              $badge_line = BadgeLine::where('id', $result_cart->badge_line_id)->first();

              if ($badge_line) {
                $badge_line_price = $badge_line->price;
              } else {
                $badge_line_price = 0;
              }
              $badge_bled_size = BadgeBledSize::find($result_cart->badge_bled_size_id);
              $badge_bled_rate = $badge_bled_size->price;
              // dd($badge_bled_rate); 
              $badge_type_a = BadgeType::find($result_cart->badge_type_id);
              $badge_type_price = $badge_type_a->price;

              /******************/

              if ($result_cart->side == "single_side") {
                $badge_bled_size_price = $badge_bled_size->price;
                $badge_type_price = $badge_type_a->price;
              } else {
                $badge_bled_size_price = ($badge_bled_size->double_side_price + $badge_bled_size->price);
                $badge_type_price = ($badge_type_a->double_side_price + $badge_type_a->price);
              }

              $s_i_sub_total = (($badge_size->price + $badge_color->price + $card_font->price + $badge_line_price + $badge_bled_size_price + $badge_type_price) * $result_cart->total_badge_qty);
            } else {
              $s_i_sub_total = $result_cart->getProduct->price * $result_cart->total_badge_qty;
            }
            $badge_discount = BadgeDiscount::where('badge_size_id', $result_cart->badge_size_id)->where('quantity_from', '<=', $result_cart->total_badge_qty)->where('quantity_to', '>=', $result_cart->total_badge_qty)->first();
            // dd($badge_discount);

            $total_sub_total = $total_sub_total + $s_i_sub_total;

            $total_items = $total_items + $result_cart->total_badge_qty;
            $weight = $weight + ($badge_size->weight * $result_cart->total_badge_qty);

            // $total_single_item=$total_single_item+$result_cart['']
            // dd($total_sub_total);
            if ($badge_discount) {

              $discount_percent = $badge_discount->discount_percent;
              $discount_margin = ($s_i_sub_total * $discount_percent) / 100;
              $s_i_d_t = $s_i_sub_total - $discount_margin;
              // $total_discounted_total=$total_discounted_total+$s_i_d_t;


            } else {
              $discount_percent = 0;
              $discount_margin = 0;
              $s_i_d_t = $s_i_sub_total;
              // $total_discounted_total=$total_sub_total;

            }

            // $original_total=$original_total+$s_i_sub_total;
            $total_discounted_total = ($total_discounted_total + $s_i_sub_total) - $discount_margin;





            if ($result_cart->product_id == null) {
              $get_cart[$i] = array(
                'cart_id' => $result_cart->id,
                'product_id' => $result_cart->product_id,
                'empty_image' => ($badge_size->count() > 0 ? $badge_size->empty_image : null),
                'size_from' => ($badge_size->count() > 0 ? $badge_size->size_from : null),
                'size_to' => ($badge_size->count() > 0 ? $badge_size->size_to : null),
                'hexa_value' => ($badge_color->count() > 0 ? $badge_color->hexa_value : null),
                'font_family_name' => ($card_font->count() > 0 ? $card_font->font_family_name : null),
                'font_color' => $result_cart->selectcolor,
                'enterText' => $result_cart->enterText,
                'enterText2' => $result_cart->enterText2,
                'total_badge_qty' => ($result_cart->total_badge_qty),
                's_i_sub_total' => $s_i_sub_total,
                'discount_percent' => $discount_percent,
                's_i_d_t' => $s_i_d_t,
                'badge_size_id' => $badge_size->id,
                'badge_color_id' => $badge_color->id,
                'card_font_id' => $card_font->id,
                'badge_line_id' => $badge_line->id,
                'side' => ($side == 1) ? 'single_side' : 'double_side'

              );
            } else {
              $get_cart[$i] = array(
                'cart_id' => $result_cart->id,
                'product_id' => $result_cart->product_id,
                'size_from' => $result_cart->getProduct->size_from,
                'size_to' => $result_cart->getProduct->size_to,
                'total_badge_qty' => $result_cart->total_badge_qty,
                's_i_sub_total' => $s_i_sub_total,
                'description' => $result_cart->getProduct->description,
                'title' => $result_cart->getProduct->title,
                'image' => $result_cart->getProduct->image,
                'discount_percent' => $discount_percent,
                's_i_d_t' => $s_i_d_t,
              );
            }

            $i++;
          } //foreach



          // Shipping Cost Start
          // $shipping_details=ShippingDetail::where('user_id',Auth::user()->id)->get();

          $ship_country_id = $shipping_detail->country_id;
          $ship_state_id = $shipping_detail->state_id;
          $ship_city_id = $shipping_detail->city_id;




          $shipping_country_state = ShippingCountryState::where(['state_id' => $ship_state_id])->first();
          if ($shipping_country_state) {
            //custom settings
            $weight_management = WeightManagement::where('shipping_country_states_id', $shipping_country_state->id)
              ->where('weight_from', '<=', $weight)
              ->where('weight_to', '>=', $weight)
              ->first();




            if ($weight_management) {

              $shipping_cost = $weight_management->amount;
              // dd($shipping_cost);

            } else {


              $check_country = ShippingCountryState::where(['country_id' => $ship_country_id, 'status' => 0])->first();

              if ($check_country) {

                $weight_management = WeightManagement::where('shipping_country_states_id', $check_country->id)->where('weight_from', '<=', $weight)
                  ->where('weight_to', '>=', $weight)
                  ->first();

                if ($weight_management) {
                  $shipping_cost = $weight_management->amount;
                } else {
                  $default_weight_management = DefaultWeightManagement::where('weight_from', '<=', $weight)->where('weight_to', '>=', $weight)->first();

                  if ($default_weight_management) {
                    $shipping_cost = $default_weight_management->amount;
                  } else {

                    $shipping_cost = null;
                  }
                }
              } else {

                // dd('else case');
                $default_weight_management = DefaultWeightManagement::where('weight_from', '<=', $weight)->where('weight_to', '>=', $weight)->first();

                if ($default_weight_management) {
                  $shipping_cost = $default_weight_management->amount;
                } else {
                  // dd("else else case");
                  // return redirect('cart')->with('successmessage','Shipping price not defined');
                  $shipping_cost = null;
                }
              }
            }
          } else {

            $check_country = ShippingCountryState::where(['country_id' => $ship_country_id, 'status' => 0])->first();

            if ($check_country) {
              // dd("test"); 
              $weight_management = WeightManagement::where('shipping_country_states_id', $check_country->id)->where('weight_from', '<=', $weight)
                ->where('weight_to', '>=', $weight)
                ->first();
              // dd($weight_management);      

              if ($weight_management) {
                $shipping_cost = $weight_management->amount;
              } else {

                // dd("Default case");

                $default_weight_management = DefaultWeightManagement::where('weight_from', '<=', $weight)->where('weight_to', '>=', $weight)->first();
                // dd($weight);
                // dd($default_weight_management);
                if ($default_weight_management) {
                  $shipping_cost = $default_weight_management->amount;
                } else {
                  // dd("else else case");
                  $shipping_cost = null;
                }
              }
            }



            //Default settings
            else {

              $default_weight_management = DefaultWeightManagement::where('weight_from', '<', $weight)->where('weight_to', '>', $weight)->first();

              if ($default_weight_management) {
                $shipping_cost =  $default_weight_management->amount;
              } else {
                // dd("else else case");
                $shipping_cost = null;
              }
            }
          }

          if ($ship_state_id == 3930) {
            $state_tax = $total_discounted_total * (7 / 100);
          } else {
            $state_tax = 0;
          }

          if ($shipping_cost != null) {
            $final_total = $total_discounted_total + $shipping_cost + $state_tax;
          } else {

            $final_total = $total_discounted_total;
          }


          // New Code for get shipping cost ended

          $get_total_values = array(

            "total_sub_total" => round($total_sub_total, 2),
            "total_discounted_total" => round($total_discounted_total, 2),
            "total_items" => $total_items,
            "weight" => $weight,
            "state_tax" => number_format($state_tax, 2),
            "shipping_cost" => number_format($shipping_cost, 2),
            "final_total" => round($final_total, 2)

          );
          // dd($get_total_values);
          // $get_cart['total_sub_total']=$total_sub_total;
          // $get_cart['total_discounted_total']=$total_discounted_total;
          // $get_cart['total_items']=$total_items;

        } // if(count(cart))
        else {
          $get_cart = null;
          $get_total_values = null;
        }
      } //if user_cookie end
      else {
        $get_cart = null;
        $get_total_values = null;
      }
      //new code ended

    } //end of top most if
    else {
      $shipping_detail = null;
      $error = true;
    }
    return response()->json([
      'error' => $error,
      'shipping_detail' => $shipping_detail,
      'state' => $state->name,
      'city' => $city->name,
      'states' => $states,
      'cities' => $cities,
      'get_total_values' => $get_total_values
    ]);
  }

  public function getSameBillingAddress()
  {

    if (isset($_GET['id'])) {
      $error = false;
      $id = $_GET['id'];
      $shipping_detail = ShippingDetail::where('id', $id)->first();
      $states = State::where('country_id', 231)->get();
      $cities = City::where('state_id', $shipping_detail->state_id)->get();
    } else {
      $shipping_detail = null;
      $error = true;
      $states = null;
      $cities = null;
    }
    return response()->json([
      'error' => $error,
      'shipping_detail' => $shipping_detail,
      'states' => $states,
      'cities' => $cities
    ]);
  }

  public function getSameBillingAddressOnCheckBox()
  {

    if (isset($_GET['state_id'])) {

      $error = false;
      $country_id = $_GET['country_id'];
      $state_id = $_GET['state_id'];
      $states = State::where('country_id', 230)->get();
      $cities = City::where('state_id', $state_id)->get();

      return response()->json([
        'error' => $error,
        'states' => $states,
        'cities' => $cities
      ]);
    }
  }

  public function checkOrder()
  {
    $user                = User::where('id', Auth::user()->id)->first();
    $subscription = Subscription::where('user_id', $user->id)->whereIn('status', [1, 2, 4])->first();
    if ($subscription) {
      return response()->json([
        'error' => true,
        'error_type' => 1 // 1 means customer have already active subscribtion.
      ]);
    } else {
      return response()->json([
        'error' => false,
        'error_type' => 0 // 1 means customer have already active subscribtion.
      ]);
    }
  }

  public function placeOrder(Request $request)
  {
    $user                = auth()->user();
    $order_number        = strtotime(date('H:i:s')) . mt_rand(999, 999999);
    $payment_type_detail = PaymentType::where('id', $request['payment_type_id'])->first();
    $package             = Package::where('id', $request['package_id'])->first();
    $website_setting     = HomePageUrl::where('id', 1)->first();

    if ($request['choice'] == 'Lend') {
      if ($package->id == 1) {
        $oneTimeFee = 41.99;
      } else {
        $oneTimeFee = 42.49;
      }
    } else {
      if ($package->id == 1) {
        $oneTimeFee = 51.99;
      } else {
        $oneTimeFee = 52.49;
      }
    }
    // Cart
    $carts = Cart::where(['user_cookie' => $_COOKIE['user_cookie']])->get();

    if ($carts->count()) {

      // For Stripe
      if ($request['payment_type_id'] == 5) {
        $app_id = '';
        $payment_mode = '';
        if ($payment_type_detail->active_account == 'developer') {
          $payment_mode = 'test';
          $app_id = $package->stripe_app_id_developer;
        } elseif ($payment_type_detail->active_account == 'test') {
          $payment_mode = 'test';
          $app_id = $package->stripe_app_id_test;
        } elseif ($payment_type_detail->active_account == 'live') {
          $payment_mode = 'live';
          $app_id = $package->stripe_app_id_live;
        }

        $email_payment_type = "Stripe";
        $input              = $request->all();
        $token              =  $request->stripeToken;
        $paymentMethod      = $request->paymentMethod;

        try {
          Stripe\Stripe::setApiKey(config('app.STRIPE_SECRET'));
          if (empty($user->stripe_id)) {
            $stripeCustomer = $user->createAsStripeCustomer();
          }

          \Stripe\Customer::createSource($user->stripe_id, ['source' => $token]);


          /* $stripe = new \Stripe\StripeClient('sk_test_4eC39HqLyjWDarjtT1zdp7dc');

                    $stripe->subscriptions->create(
                    [
                    'customer' => '{{CUSTOMER_ID}}',
                    'items' => [['price' => '{{RECURRING_PRICE_ID}}']],
                    'add_invoice_items' => [['price' => '{{PRICE_ID}}']],
                    'payment_behavior' => 'default_incomplete',
                    ]
                    );*/
          $order_detail  = $user->newSubscription($payment_mode, $app_id)->create($paymentMethod, ['email' => $user->email]);
          if ($request['choice'] == 'Lend') {
            if ($package->id == 1) {
              $depositFee =  4199; //£40+£1.99= 41.99
              $oneTimeFee = 41.99;
            } else {
              $depositFee = 4249; //£40+£2.49 = 42.49
              $oneTimeFee = 42.49;
            }
          } else {
            if ($package->id == 1) {
              $depositFee =  5199; //£50+£1.99= 41.99
              $oneTimeFee = 51.99;
            } else {
              $depositFee = 5249; //£50+£2.49 = 42.49
              $oneTimeFee = 52.49;
            }
          }
          $oneTime = $user->invoiceFor('Deposit Fee', $depositFee);
          /* FOR MULTIPLE PRICES REPLACE ABOVE CODE WITH BELOW.
                      $order_detail  = $user->newSubscription('default', [
                      'price_1KstwXFbVyliLyasV8R4LIcz',
                      'price_1KstwXFbVyliLyasyeJhZR67',
                  ])->create($paymentMethod, ['email' => $user->email]);
                  */
          $order_detail->payment_status = 1; //means payment done because this is credit card
        } catch (Exception $e) {
          return response()->json(['error' => true]);
        }
      } // END IF

      $shipping_detail = ShippingDetail::where(['user_id' => $user->id])->first();
      if ($shipping_detail) {
        $get_shipping_id             = $shipping_detail->id;
      }
      $ship_data   = ShippingDetail::where('id', $get_shipping_id)->first();
      if ($ship_data->count() > 0) {
        $s_country = Country::where('id', $ship_data->country_id)->first();
      }


      $payThroughPaypal = false;
      if ($request['payment_type_id'] == 4) {
        $email_payment_type = "PayPal";
        //$order_detail->payment_status = 1; //means payment done because this is credit card

        if ($payment_type_detail->active_account == 'test') {
          $payment_mode = 'test';


          if ($request['choice'] == 'Lend') {
            if ($package->id == 1) {
              $plan_id = $package->paypal_test_plan_id;
            } else {
              $plan_id = $package->paypal_test_plan_id;
            }
          } else {
            if ($package->id == 1) {
              $plan_id = "PROD-4N425584YW1006331";
            } else {
              $plan_id = "P-79E335870W187463FMPT6BSQ";
            }
          }

          $email_address = $payment_type_detail->test_email;
        } elseif ($payment_type_detail->active_account == 'live') {
          $payment_mode = 'live';

          if ($request['choice'] == 'Lend') {
            if ($package->id == 1) {
              $plan_id = $package->paypal_live_plan_id;
            } else {
              $plan_id = $package->paypal_live_plan_id;
            }
          } else {
            if ($package->id == 1) {
              //$plan_id = "PROD-5VW259311F4711419";
              $plan_id = "P-0EN64503J89360240MPT5DMI";
            } else {
              //$plan_id = "PROD-7BC72928DP025612G";
              $plan_id = "P-5MS96692BR076842BMPT5HNY";
            }
          }

          $email_address = $payment_type_detail->live_email;
        }
        $arrayObj = array(
          "plan_id" => $plan_id,
          "start_time" => date("Y-m-d") . "T23:20:50.52Z",
          "quantity" => "1",
          "shipping_amount" => array(
            "currency_code" => "GBP",
            "value" => "0"
          ),
          "subscriber" => array(
            "name" => array(
              "given_name" => $shipping_detail->first_name,
              "surname" => $shipping_detail->last_name
            ),
            "email_address" => $email_address,
            "shipping_address" => array(
              "name" => array(
                "full_name" =>  $shipping_detail->first_name . ' ' . $shipping_detail->last_name
              ),
              "address" => array(
                "address_line_1" => $shipping_detail->address,
                "address_line_2" => $shipping_detail->address_2,
                "admin_area_1"   => $shipping_detail->city_id,
                "postal_code"    =>  $shipping_detail->zip,
                "country_code"   => "UK"
              )
            )
          ),
          "application_context" => array(
            "brand_name" => "dartsinabottle",
            "locale" => "en-US",
            "shipping_preference" => "SET_PROVIDED_ADDRESS",
            "user_action" => "SUBSCRIBE_NOW",
            "payment_method" => array(
              "payer_selected" => "PAYPAL",
              "payee_preferred" => "IMMEDIATE_PAYMENT_REQUIRED"
            ),
            "return_url" => url('returnUrl'),
            "cancel_url" => url('cancelUrl')
          )
        );
        $payThroughPaypal = true;
        //dd($arrayObj);
        $response = $this->paypalSend($arrayObj);
        $order_detail  = Subscription::create(['stripe_id' => $response->id, 'stripe_status' => "$response->status", 'payment_status' => '0', 'status' => '0', 'quantity' => 1]);
        $order_product = SubscriptionItem::create(['subscription_id' => $order_detail->id, 'stripe_id' => "$response->id", 'stripe_plan' => "$response->id", 'quantity' => 1]);
      }

      $order_detail->order_number     = $order_number;
      $order_detail->user_id          =  $user->id;
      $order_detail->sort_1           = $request['sort_1'];
      $order_detail->sort_2           = $request['sort_2'];
      $order_detail->sort_3           = $request['sort_3'];
      $order_detail->choice           = $request['choice'];
      $order_detail->shipping_id      = $get_shipping_id;
      $order_detail->ship_cost        = $request['shipping_cost'];
      $order_detail->state_tax        = $request['state_tax'];
      $order_detail->sub_total        = $request['sub_total'];
      $order_detail->discounted_total = $request['discounted_total'];
      $order_detail->coupon_discount  = $request['coupon_discount'];
      //$order_detail->coupon_code=$request['coupon_code'];
      $order_detail->deposit_cost     = $request['deposit_cost'];
      $order_detail->total            = $request['amount'];
      $order_detail->payment_type_id  = $request['payment_type_id'];
      $order_detail->customer_internal_reference_no = $request['customer_internal_reference_no'];
      $order_detail->order_note       = $request['order_note'];
      if ($request['payment_type_id'] == 5) {
        //Stripe
        $order_detail->status           = 4;
        //means that the order will go directly to pending 
      }

      $order_detail->save();
      $order_detail_id                  = $order_detail->id;
      $billing_detail                   = new BillingDetail;
      $billing_detail->user_id          =  $user->id;
      $billing_detail->order_details_id = $order_detail_id;
      $billing_detail->email            = $request['billing_email'];
      $billing_detail->country_id       = 230;
      $billing_detail->city_id          = $request['billing_city'];
      $billing_detail->address          = $request['billing_address'];
      $billing_detail->address_2          = $request['billing_address_2'];
      $billing_detail->zip              = $request['billing_zip_code'];
      $billing_detail->phone            = $request['billing_phone_number'];
      $billing_detail->save();

      $get_result_array                  = $this->getBill($_COOKIE['user_cookie']);

      if ($get_result_array['get_cart'] != null) {
        //email array 
        $email_counter                     = 0;
        foreach ($get_result_array['get_cart'] as $get_cart) {

          $order_product                   = SubscriptionItem::where('subscription_id', $order_detail_id)->first();
          $order_product->package_id       = $get_cart['package_id'];
          $order_product->total_qty        = $get_cart['total_qty'];
          $order_product->s_i_sub_total    = $get_cart['s_i_sub_total'];
          $order_product->discount_percent = $get_cart['discount_percent'];
          $order_product->s_i_d_t          = $get_cart['s_i_d_t'];
          $order_product->save();

          $email_products_array[$email_counter] = array(
            'package_id'               => $order_product->getPackage->darts_set . ' SETS/MONTH',
            'sort_1'                   => $order_product->sort_1,
            'sort_2'                   => $order_product->sort_2,
            'sort_3'                   => $order_product->sort_3,
            'product_original_total'   => $order_product->s_i_sub_total,
            'product_discounted_total' => $order_product->s_i_d_t
          );
          $email_counter++;
        }
      } //if $get_carts !=null

      $subscription_billing                     = new SubscriptionBilling;
      $subscription_billing->subscription_id    = $order_detail_id;
      $subscription_billing->plan_created       = date("Y-m-d H:i:s");
      $subscription_billing->period_start       = date("Y-m-d H:i:s");
      $subscription_billing->period_end         = date('Y-m-d H:i:s', strtotime("+30 days"));
      $subscription_billing->status             = '1';
      $subscription_billing->save();
    }

    Cart::where(['user_cookie' => $_COOKIE['user_cookie']])->delete();
    //Order Email starting point 

    $data = array(
      'firstname'       =>  $user->first_name,
      'lastname'        =>  $user->last_name,
      'email'           =>  $user->email,
      'order_number'    => $order_number,
      'sort_1'          => $request['sort_1'],
      'sort_2'          => $request['sort_2'],
      'sort_3'          => $request['sort_3'],
      'choice'          => $request['choice'],
      'shipping_country' => $s_country->name,
      'shipping_city'   => $ship_data->city_id,
      'shipping_email'  => $ship_data->email,
      'shipping_address'  => $ship_data->address,
      'shipping_address_2'  => $ship_data->address_2,
      'shipping_phone'  => $ship_data->phone,
      'shipping_zip'    => $ship_data->zip,
      'payment_type'    => $email_payment_type,
      /*'total_weight_of_products'=>$request['total_weight_of_products'], */
      'total_ship_cost' => $request['shipping_cost'],
      'state_tax' => $request['state_tax'],
      'original_total'  => $request['sub_total'],
      'discounted_total' => $request['discounted_total'],
      'oneTimeFee'       => $oneTimeFee,
      'coupon_discount' => $request['coupon_discount'],
      /*'coupon_code' => $request['coupon_code'],*/
      'final_total_with_shipping_cost' => $request['amount'],
      'billing_detail' => $billing_detail,
      'email_products_array' => $email_products_array
    );

    if ($request['payment_type_id'] == 5) {

      Mail::send('emails.order-email',  $data, function ($message) use ($data) {
        $message->to($data['email'])
          ->cc(['sales@dartsinabottle.com', 'dartsinabottle.com+1493fc9a1f@invite.trustpilot.com'])
          ->subject('dartsinabottle Order Information');
      });
    }

    if ($payThroughPaypal) {
      if (isset($response) && $response->status == 'APPROVAL_PENDING') {
        session(['data' => $data]);
        //return Redirect::to($response->links[0]->href);        

        return response()->json([
          'error' => false,
          'payment' => 'paypal',
          'redirect' => $response->links[0]->href,
          'error_type' => 0  // 1 means customer have already active subscribtion.
        ]);
      } else {
        return response()->json([
          'error' => true
        ]);
      }
    }

    return response()->json([
      'error' => false
    ]);
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

  public function paywithStripe()
  {
    //echo config('app.STRIPE_SECRET');
    //$this->updateConfigurations();
    dd(env('STRIPE_KEY'));
    return view('user.customer.pay-with-stripe');
  }

  public function postStripe(Request $request)
  {

    $user                = auth()->user();
    Stripe\Stripe::setApiKey(config('app.STRIPE_SECRET'));

    // $stripeuser = Cashier::findBillable($user->stripe_id);
    if (empty($user->stripe_id)) {
      $stripeCustomer = $user->createAsStripeCustomer();
    }
    $balance = $user->balance();
    dd($balance);
  }

  private function paypalSend($arrayObj)
  {
    $key        = base64_encode(config('app.Client_ID') . ':' . config('app.SECRET'));
    $jsonString = json_encode($arrayObj);
    $url        = "https://api-m.paypal.com/v1/billing/subscriptions";
    if (config('paypal.mode') == 'sandbox') {
      $url        = "https://api-m.sandbox.paypal.com/v1/billing/subscriptions";
    }
    $curl       = curl_init();
    curl_setopt(
      $curl,
      CURLOPT_HTTPHEADER,
      array(
        'Content-Type: application/json',
        'Authorization: Basic ' . $key . '',
        'PayPal-Request-Id: SUBSCRIPTION-21092019-001'
      )
    );
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 1);
    curl_setopt($curl, CURLOPT_POST, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_VERBOSE, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonString);

    $result = curl_exec($curl);
    if ($result === FALSE) {
      echo curl_error($curl);
    }
    curl_close($curl);
    $lines    = explode("\n", $result);
    if (config('paypal.mode') == 'sandbox') {
      $response = json_decode(end($lines));
    } else {
      $response = json_decode(end($lines));
    }
    return  $response; //['status'=>$response->status,'redirecUrl'=>$response->links[0]->href];
  }

  public function myTesting()
  {

    $key        = base64_encode(config('app.Client_ID') . ':' . config('app.SECRET'));
    $url        = "https://api-m.paypal.com/v1/billing/subscriptions";
    if (config('paypal.mode') == 'sandbox') {
      $url      = "https://api-m.sandbox.paypal.com/v1/billing/subscriptions";
    }

    $user               = auth()->user();
    $invoice = $user->upcomingInvoice();
    dd($invoice);
    $arrayObj = array(
      "plan_id" => "P-8YP765731P759873TMJRQK4Y",
      "start_time" => "2022-05-09T23:20:50.52Z",
      "quantity" => "1",
      "shipping_amount" => array(
        "currency_code" => "USD",
        "value" => "24"
      ),
      "subscriber" => array(
        "name" => array(
          "given_name" => $user->first_name,
          "surname" => $user->last_name
        ),
        "email_address" => config('app.PAYPAL_EMAIL'),
        "shipping_address" => array(
          "name" => array(
            "full_name" => $user->first_name . ' ' . $user->last_name
          ),
          "address" => array(
            "address_line_1" => "2211 N First Street",
            "address_line_2" => "Building 17",
            "admin_area_2" => "San Jose",
            "admin_area_1" => "CA",
            "postal_code" => "95131",
            "country_code" => "US"
          )
        )
      ),
      "application_context" => array(
        "brand_name" => "dartsinabottle",
        "locale" => "en-US",
        "shipping_preference" => "SET_PROVIDED_ADDRESS",
        "user_action" => "SUBSCRIBE_NOW",
        "payment_method" => array(
          "payer_selected" => "PAYPAL",
          "payee_preferred" => "IMMEDIATE_PAYMENT_REQUIRED"
        ),
        "return_url" => url('returnUrl'),
        "cancel_url" => url('cancelUrl')
      )
    );
  }

  public function orderThankYouPage(Request $request)
  {
    if (!Auth::check()) {
      return redirect('login');
    } else {
      $content = Content::where('title', 'Thank You Page')->first();
      $subscription = Subscription::where('user_id', Auth::user()->id)->whereIn('status', [4])->orderBy('id', 'DESC')->first();
      if ($request['from_checkout'] == 'yes') {
        if ($subscription->choice == 'Lend') {
          return view('user.customer.order-thankyou-page', ['content' => $content, 'subscription' => $subscription]);
        } else {
          return view('user.customer.thankyou-page', ['content' => $content, 'subscription' => $subscription]);
        }
      } else {
        return redirect()->back();
      }
    }
  }

  public function returnUrl()
  {
    if (!Auth::check()) {
      return redirect('login');
    } else {
      $response = request()->all();
      $subscription  = Subscription::where('stripe_id', $response['subscription_id'])->first();
      $email_payment_type = 'PayPal';
      $order_product = SubscriptionItem::where('subscription_id', $subscription->id)->first();
      $email_products_array[0] = array(
        'package_id'               => $order_product->getPackage->darts_set . ' SETS/MONTH',
        'sort_1'                   => $order_product->sort_1,
        'sort_2'                   => $order_product->sort_2,
        'sort_3'                   => $order_product->sort_3,
        'product_original_total'   => $order_product->s_i_sub_total,
        'product_discounted_total' => $order_product->s_i_d_t
      );

      $package             = Package::where('id', $order_product->getPackage->id)->first();
      $website_setting     = HomePageUrl::where('id', 1)->first();

      //$oneTimeFee = $website_setting->deposit_cost+$package->paypal_fee;


      $billing_detail = BillingDetail::where('order_details_id', $subscription->id)->first();


      if ($subscription->choice == 'Lend') {
        if ($package->id == 1) {
          $oneTimeFee = 41.99;
        } else {
          $oneTimeFee = 42.49;
        }
      } else {
        if ($package->id == 1) {
          $oneTimeFee = 51.99;
        } else {
          $oneTimeFee = 52.49;
        }
      }

      $data = array(
        'firstname'            => $subscription->getUser->first_name,
        'lastname'             => $subscription->getUser->last_name,
        'email'                => $subscription->getUser->email,
        'order_number'         => $subscription->order_number,
        'sort_1'               => $subscription->sort_1,
        'sort_2'               => $subscription->sort_2,
        'sort_3'               => $subscription->sort_3,
        'choice'               => $subscription->choice,
        'shipping_city'        => $subscription->getShippingDetail->city_id,
        'shipping_email'       => $subscription->getShippingDetail->email,
        'shipping_address'     => $subscription->getShippingDetail->address,
        'shipping_address_2'   => $subscription->getShippingDetail->address_2,
        'shipping_phone'       => $subscription->getShippingDetail->phone,
        'shipping_zip'         => $subscription->getShippingDetail->zip,
        'payment_type'         => $email_payment_type,
        'total_ship_cost'      => $subscription->ship_cost,
        'state_tax'            => $subscription->state_tax,
        'original_total'       => $subscription->sub_total,
        'discounted_total'     => $subscription->discounted_total,
        'oneTimeFee'           => $oneTimeFee,
        'coupon_discount'      => $subscription->coupon_discount,
        /*'coupon_code' => $subscription->coupon_code,*/
        'final_total_with_shipping_cost' => $subscription->amount,
        'billing_detail'       => $billing_detail,
        'email_products_array' => $email_products_array
      );

      if (!empty($subscription)) {
        $subscription->status = 4;
        $subscription->payment_status = 1;
        $subscription->save();
      }

      Mail::send('emails.order-email',  $data, function ($message) use ($data) {
        $message->to($data['email'])
          ->cc(['sales@dartsinabottle.com', 'dartsinabottle.com+1493fc9a1f@invite.trustpilot.com'])
          ->subject('dartsinabottle Order Information');
      });

      $content = Content::where('title', 'Thank You Page')->first();
      return view('user.customer.order-thankyou-page', ['content' => $content, 'subscription' => $subscription]);
    }
  }

  public function cancelUrl()
  {
    if (!Auth::check()) {
      return redirect('login');
    } else {
      return redirect('checkout');
    }
  }

  public function getLentDarts()
  {
    $products = Product::where('user_id', Auth::user()->id)->latest()->get();
    return view('user.customer.lent-darts', compact('products'));
  }

  public function getNewLentDarts()
  {
    $products = Product::where('user_id', Auth::user()->id)->latest()->get();
    return view('user.customer.lent-darts', compact('products'));
  }

  public function choosePriceProductTypeProcess(Request $request)
  {
    $product = Product::where('id', $request['product_id'])->first();
    if ($product) {
      if ($request['product_price_type'] == '') {
        return response()->json([
          'error' => true,
          'title' => 'Error!',
          'text' => 'Product price type cannot be null.',
          'error_type' => 1
        ]);
      }
      if ($request['product_price_type'] == 'for_sale') {
        if ($request['product_price'] == '') {
          return response()->json([
            'error' => true,
            'title' => 'Error!',
            'text' => 'Product price cannot be null.',
            'error_type' => 1
          ]);
        } /*else if ($request['paypal_email'] == '') {
          return response()->json([
            'error' => true,
            'title' => 'Error!',
            'text' => 'Paypal Email cannot be null.',
            'error_type' => 1
          ]);
        }*/
        $product->product_price = $request['product_price'];
        $product->product_price_type = $request['product_price_type'];
        //User::where('id',  Auth::user()->id)->update(['paypal_email' =>  $request['paypal_email']]);
        $product->save();
        return response()->json([
          'error' => false,
          'title' => 'Price Set Successfully!',
          'text' => 'Your lent darts are set to sell for £' . $request['product_price'] . '.',
          'error_type' => 0
        ]);
      } else {
        $product->product_price = NULL;
        $product->product_price_type = $request['product_price_type'];
        $product->save();
        return response()->json([
          'error' => false,
          'title' => 'Success!',
          'text' => 'Your lent darts are not for sale.',
          'error_type' => 0
        ]);
      }
      return response()->json([
        'error' => false,
        'title' => 'Error!',
        'text' => 'Product not found.',
        'error_type' => 1
      ]);
    }



    //    return redirect('lent-darts')->with('successmessage', 'Product price edited successfully');
  }

  public function revertPriceProductTypeProcess(Request $request)
  {
    $product = Product::where('id', $request['product_id'])->first();
    if ($product) {

      $product->product_price = NULL;
      $product->product_price_type = 'not_for_sale';
      $product->save();
      return response()->json([
        'error' => false,
        'title' => 'Success!',
        'text' => 'Your lent darts are not for sale.',
        'error_type' => 0
      ]);
    }
  }

  public function setPayPalEmail(Request $request)
  {
    if (isset($_GET['paypal_email'])) {
      $paypal_email = $_GET['paypal_email'];
    }
    if ($paypal_email == '') {
      return response()->json([
        'error' => true,
        'title' => 'Error!',
        'text' => 'Paypal Email cannot be null.',
        'error_type' => 1
      ]);
    }
    User::where('id',  Auth::user()->id)->update(['paypal_email' =>  $paypal_email]);

    return response()->json([
      'error' => false,
      'title' => 'Paypal Email',
      'text' => 'Paypal email set successfully!',
      'error_type' => 0
    ]);
  }



  public function getCurrentDarts()
  {
    $product = ProductToCustomer::where('user_id', Auth::user()->id)->where('status', 'Shipped')->latest()->first();
    return view('user.customer.current-darts', compact('product'));
  }

  public function getBorrowedDarts()
  {
    $products = ProductToCustomer::where('user_id', Auth::user()->id)->whereIn('status', ['Returned', 'Sold'])->latest()->get();
    return view('user.customer.borrowed-darts', compact('products'));
  }

  public function getBuyDarts()
  {
    $product = ProductToCustomer::where('user_id', Auth::user()->id)->where('status', 'Shipped')->latest()->first();
    return view('user.customer.customer-panel.current-darts', compact('product'));
  }

  public function createTransaction()
  {
    if (isset($_GET['order_detail_id'])) {
      $order_detail_id = $_GET['order_detail_id'];
    }
    $order_detail_id   = session('order_detail_id');
    $error             = false;
    $order_detail      = Subscription::where('id', $order_detail_id)->first();

    if ($order_detail) {
      $today                            = strtotime(date('Y-m-d'));
      $product_to_customer              = ProductToCustomer::where('subscription_id', $order_detail_id)->where('status', 'Shipped')->first();
      $product_to_customer->status      = 'Sold';
      $product_to_customer->returned_at = Carbon::now();
      $product_to_customer->save();

      $product = Product::where('id', $product_to_customer->product_id)->first();
      $product->active_status = 3; //1 means product is now active
      $darts_owner = $product->user_id;
      $product_name = $product->product_name;
      $product_weight = $product->product_weight;
      $product_price = $product->product_price;
      $product_picture = asset('public/uploads/darts_img/' . $product->product_image);
      $product->save();
      //Paypal 
      //payment_type_id = 4
      $order_detail->status = 4;   //2 means order is in Pending Ship
      $order_detail->save();
      //==================================================================================

      //Email to Seller who sell his darts..
      $seller_fee = 0;
      $seller_total = 0;

      $seller_fee = (10 / 100) * $product_price;
      $seller_total = $product_price - $seller_fee;

      $user = User::where('id', $darts_owner)->first();

      $data_seller = array(
        'firstname'       => $user->first_name,
        'lastname'        => $user->last_name,
        'email'           => $user->email,
        'product_name'    => $product_name,
        'product_weight'  => $product_weight,
        'product_price'   => $product_price,
        'product_picture' => $product_picture,
        'seller_fee'      => number_format((float)$seller_fee, 2, '.', ''),
        'seller_total'    => number_format((float)$seller_total, 2, '.', '')
      );
      Mail::send('emails.email-to-seller',  $data_seller, function ($message) use ($data_seller) {
        $message->to($data_seller['email'])
          ->cc(['sales@dartsinabottle.com'])
          ->subject("You've sold some darts");
      });
      //==================================================================================

      //Email to Buyer who buy the darts.
      $buyer_fee = 0;
      $buyer_total = 0;

      if ($product_price >= 39.00) {
        $buyer_fee = 2.99;
        $buyer_total = $product_price + $buyer_fee;
      } else {
        $buyer_fee = (($product_price * 1.075) - $product_price);
        $buyer_total  = $product_price + $buyer_fee;
      }

      $data_buyer = array(
        'firstname'       => $order_detail->getUser->first_name,
        'lastname'        => $order_detail->getUser->last_name,
        'email'           => $order_detail->getUser->email,
        'product_name'    => $product_name,
        'product_weight'  => $product_weight,
        'product_price'   => $product_price,
        'product_picture' => $product_picture,
        'seller_fee'      => $seller_fee,
        'buyer_fee'       => number_format((float)$buyer_fee, 2, '.', ''),
        'buyer_total'     => number_format((float)$buyer_total, 2, '.', '')
      );

      Mail::send('emails.email-to-buyer',  $data_buyer, function ($message) use ($data_buyer) {
        $message->to($data_buyer['email'])
          ->subject('dartsinabottle Purchase Confirmation');
      });
      //==================================================================================
      return redirect()
        ->route('borrowedDarts')
        ->with('successmessage', 'Purchase complete.  We are pleased you found darts that talk to you!');
    }
  }

  public function confirmBuyDarts(Request $request)
  {
    $provider = new PayPalClient;
    $provider->setApiCredentials(config('paypal'));
    $paypalToken = $provider->getAccessToken();


    if (!empty(request()->get('order_detail_id'))) {
      $order_detail_id = request()->get('order_detail_id');
      session(['order_detail_id' => $order_detail_id]);
    }
    $error = false;
    $product_price = 0;
    $order_detail = Subscription::where('id', $order_detail_id)->first();

    if ($order_detail) {
      $today = strtotime(date('Y-m-d'));

      $product_to_customer = ProductToCustomer::where('subscription_id', $order_detail_id)->where('status', 'Shipped')->first();

      $product = Product::where('id', $product_to_customer->product_id)->first();

      $product_price = $product->product_price;
      if ($product_price >= 39.00) {
        $product_price = $product_price + 2.99;
      } else {
        $amount = (($product_price * 1.075) - $product_price);
        $product_price  = $product_price  + $amount;
      }
    }

    $response = $provider->createOrder([
      "intent" => "CAPTURE",
      "application_context" => [
        "return_url" => route('successTransaction'),
        "cancel_url" => route('cancelTransaction'),
      ],
      "purchase_units" => [
        0 => [
          "amount" => [
            "currency_code" => "gbp",
            "value" => number_format((float)$product_price, 2, '.', '')
          ],
          "description" => $product->product_name,
          /*'payment_instruction' => [
            'platform_fees' => [
              0 => [
                'amount' => [
                  'currency_code' => 'gbp',
                  'value' => '400.00'
                ],
                'payee' => [
                  'email_address' => 'sb-yeeog15235003@personal.example.com'
                ]

              ]

            ]
          ]*/
        ]
      ]
    ]);

    if (isset($response['id']) && $response['id'] != null) {
      // redirect to approve href
      foreach ($response['links'] as $links) {
        if ($links['rel'] == 'approve') {
          return response()->json([
            "error" => false,
            'redirect' => $links['href'],
          ]);
        }
      }

      return response()->json([
        "error" => true
      ]);
    } else {
      return response()->json([
        "error" => true
      ]);
    }
  }

  /**
   * success transaction.
   *
   * @return \Illuminate\Http\Response
   */
  public function successTransaction(Request $request)
  {
    $provider = new PayPalClient;
    $provider->setApiCredentials(config('paypal'));
    $provider->getAccessToken();
    $response = $provider->capturePaymentOrder($request['token']);

    if (isset($response['status']) && $response['status'] == 'COMPLETED') {
      return redirect()

        ->route('createTransaction')
        ->with('success', 'Transaction complete.');
    } else {
      return redirect()
        ->route('createTransaction')
        ->with('error', $response['message'] ?? 'Something went wrong.');
    }
  }

  /**
   * cancel transaction.
   *
   * @return \Illuminate\Http\Response
   */
  public function cancelTransaction(Request $request)
  {
    //dd($request->all());
    return redirect()
      ->route('currentDarts')
      ->with('cancelmessage', 'You cancelled the transaction.');

    /*return redirect()
            ->route('createTransaction')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');*/
  }

  public function dashboard()
  {
    return view('user.customer.dashboard');
  }

  public function orders($status)
  {
    $order_details = Subscription::where(['user_id' => Auth::user()->id])->orderBy('id', 'DESC')->get();
    return view('user.customer.orders-listing', ['order_details' => $order_details]);
  }

  public function orderDetail($id)
  {
    $order_detail = Subscription::where(['id' => $id, 'user_id' => Auth::user()->id])->first();
    if ($order_detail) {

      $order_product = SubscriptionItem::where('subscription_id', $order_detail->id)->orderBy('id', 'DESC')->first();
      $order_courier = OrderCourier::where('order_detail_id', $id)->first();
      $order_reminder_information = OrderReminderInformation::where('order_detail_id', $id)->first();
      $order_wire_check_detail = OrderWireCheckDetail::where('order_detail_id', $id)->first();

      $product_to_customers = ProductToCustomer::where('user_id', $order_detail->user_id)->get();

      $product_already_send = ProductToCustomer::where('user_id', $order_detail->user_id)->pluck('product_id')->toArray();

      $products = Product::where('user_id', '<>', $order_detail->user_id)->where('active_status', '1')->whereNotIn('id', $product_already_send)->get();



      return view('user.customer.order-detail', [
        'order_detail' => $order_detail,
        'order_product' => $order_product, 'order_courier' => $order_courier, 'order_reminder_information' => $order_reminder_information, 'order_wire_check_detail' => $order_wire_check_detail, 'products' => $products, 'product_to_customers' => $product_to_customers
      ]);
    } else {
      return redirect()->back()->with('successmessage', 'You are not allowed');
    }
  }

  public function UnsubscribeOrder()
  {
    $has_lent_darts = false;
    $has_current_darts = false;
    $has_deposit = false;

    if (isset($_GET['order_id'])) {
      $order_id = $_GET['order_id'];
    }

    $order_detail = Subscription::where('id', $order_id)->first();

    $products = Product::where('user_id', Auth::user()->id)->get();

    foreach ($products as $product) {
      if ($product->active_status == 0 || $product->active_status == 1  || $product->active_status == 2) {
        $has_lent_darts = true;
      }
    }

    $has_current_darts = ProductToCustomer::where('subscription_id', $order_detail->id)->where('status', 'Shipped')->first();

    $deposit_cost = $order_detail->getUser->deposit_cost;
    if ($deposit_cost > 0) {
      $has_deposit = true;
    }




    Subscription::where('id', $order_detail->id)->update(['isunsubscribe' => '1']);
    Product::where('user_id', Auth::user()->id)->where('active_status', '1')->update(['active_status' => '2']);


    //=========================================================================//

    //1a and 1b - user has lent darts not sold, current darts and deposit / no deposit.
    if ($has_lent_darts && $has_current_darts && $has_deposit) {
      $message_body = '<p>We have received your cancellation request.<br><br>Kindly return your current darts.<br><br>You have a deposit of £' . $deposit_cost . ' remaining. Please contact us at customerservice@dartsinabottle.com to advise us of your preferred payment method. We can refund deposits though PayPal or cheque. <br><br>When we have confirmed receipt of your current darts, we will return your deposit. Your lent darts* will then be posted back and your account closed.<br><br><p>';
      $message_body .= '<p>*Please note that your lent darts may be with another user at the moment, in which case they will be sent back to you as soon as they are returned to us.</p>';
    }
    if ($has_lent_darts && $has_current_darts && !$has_deposit) {
      $message_body = '<p>We have received your cancellation request.<br><br>Kindly return your current darts.<br><br>When we have confirmed receipt, we will post your lent darts back, and close your account.*<br><br><p>';
      $message_body .= '<p>*Please note that your lent darts may be with another user at the moment, in which case they will be sent back to you as soon as they are returned to us.</p>';
    }
    //=========================================================================//

    //2a and 2b – user has lent darts not sold, no current darts and deposit/no deposit.
    if ($has_lent_darts && !$has_current_darts && $has_deposit) {
      $message_body = '<p>We have received your cancellation request.<br><br>You have a deposit of £' . $deposit_cost . ' remaining. Please contact us at customerservice@dartsinabottle.com to advise us of your preferred payment method. We can refund deposits though PayPal or cheque.<br><br>After the deposit has been returned, your lent darts will  be posted back and your account closed.*<br><br><p>';
      $message_body .= '<p>*Please note that your lent darts may be with another user at the moment, in which case they will be sent back to you as soon as they are returned to us.</p>';
    }
    if ($has_lent_darts && !$has_current_darts && !$has_deposit) {
      $message_body = '<p>We have received your cancellation request.<br><br>Your lent darts will be posted back to you as soon as possible.*<br><br>After they have been posted, we will close your account.<br><br><p>';
      $message_body .= '<p>*Please note that your lent darts may be with another user at the moment, in which case they will be sent back to you as soon as they are returned to us.</p>';
    }
    //=========================================================================//

    //3a and 3b – user has sold lent darts, has current darts and deposit/no deposit.
    if (!$has_lent_darts && $has_current_darts && $has_deposit) {
      $message_body = '<p>We have received your cancellation request.<br><br>Kindly return your current darts and when we have confirmed receipt, we will return your deposit and close your account.<br><br>You have a deposit of £' . $deposit_cost . ' remaining. Please contact us at customerservice@dartsinabottle.com to advise us of your preferred payment method. We can refund deposits though PayPal or cheque.<br><br><p>';
    }
    if (!$has_lent_darts && $has_current_darts && !$has_deposit) {
      $message_body = '<p>We have received your cancellation request.<br><br>Kindly return your current darts and when we have confirmed receipt, we will close your account.<br><br><p>';
    }
    //=========================================================================//

    //4a and 4b – user has sold lent darts, no current darts and deposit / no deposit.
    if (!$has_lent_darts && !$has_current_darts && $has_deposit) {
      $message_body = '<p>We have received your cancellation request.<br><br>You have a deposit of £' . $deposit_cost . ' remaining. Please contact us at customerservice@dartsinabottle.com to advise us of your preferred payment method. We can refund deposits though PayPal or cheque.<br><br><p>';
    }
    if (!$has_lent_darts && !$has_current_darts && !$has_deposit) {
      $message_body = '<p>We have received your cancellation request. We will process the request and close your account.<br><br>Thank you for being a member of dartsinabottle.<br><br>Good luck on the oche.<br><br><p>';
    }
    //=========================================================================//


    $data = array(
      'firstname'       => $order_detail->getUser->first_name,
      'lastname'        => $order_detail->getUser->last_name,
      'email'           => $order_detail->getUser->email,
      'message_body'         => $message_body
    );


    Mail::send('emails.unsubscribe-order-email',  $data, function ($message) use ($data) {
      $message->to($data['email'])
        ->cc(['customerservice@dartsinabottle.com'])
        ->subject('dartsinabottle Unsubscribe Information');
    });

    return response()->json(
      [
        "ok",
      ]
    );
  }

  public function logout()
  {
    Auth::logout();
    return redirect('login');
  }
}
