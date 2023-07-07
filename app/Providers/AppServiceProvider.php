<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\HomePageUrl;
use Corcel;
use App\Post;
use App\UserMessage;
use App\Chat;
use App\Cart;
use App\Content;
use DB;
use App\PaymentType;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    Schema::defaultStringLength(191);
    //if(Auth::user()){
    view()->composer('user.customer*', function ($view) {
      // dd("tet");
      if (Auth::user()) {
        $user_boot = User::where('id', Auth::user()->id)->first();
        // Mesasge code end
        $view->with(['user_boot' => $user_boot]);
      }
    });

    view()->composer('user.customer*', function ($view) {
      $body_code = Content::where('title', 'body code')->first();
      $footer_code = Content::where('title', 'Footer')->first();
      $analytics_code = Content::where('title', 'Analytics')->first();
      $view->with(['body_code' => @$body_code, 'footer_code' => @$footer_code, 'analytics_code' => @$analytics_code]);
    });

    view()->composer(['user.customer.header-customer', 'user.customer.footer-customer'], function ($view) {

      // -------------------------- Old Working Menu Start-------------------

      // Cart Code Started
      if (isset($_COOKIE["user_cookie"])) {
        $count_cart_boot = Cart::where('user_cookie', $_COOKIE["user_cookie"])->sum('total_badge_qty');
        // $cart_result_boot=Cart::
        // select(DB::raw('SUM(total_badge_qty) as quantity'),'badge_size_id')
        // ->where('user_cookie',$_COOKIE["user_cookie"])
        // ->groupBy(DB::raw('badge_size_id'))->get();

        $cart_result_boot = Cart::select('total_badge_qty', 'badge_size_id')
          ->where('user_cookie', $_COOKIE["user_cookie"])
          ->get();

        // dd($cart_result_boot);

      }
      // dd(@$count_cart_boot);
      // Cart Code Ended

      $view->with(['cart_result_boot' => @$cart_result_boot, 'count_cart_boot' => @$count_cart_boot]);
    });
    // customer composer end
    view()->composer('user*', function ($view) {

      $home_page_url_boot = HomePageUrl::where('id', 1)->first();
      // dd($home_page_url_boot);   
      $view->with(['home_page_url_boot' => $home_page_url_boot]);
    });


   /* $stripe_detail = PaymentType::where('id', 5)->where('status', 1)->first();
     if ($stripe_detail->active_account == 'test') {
      config(['app.STRIPE_KEY'    => $stripe_detail->login_id_test]);
      config(['app.STRIPE_SECRET' => $stripe_detail->transaction_key_test]);
    } elseif ($stripe_detail->active_account == 'developer') {
      config(['app.STRIPE_KEY'    => $stripe_detail->api_key]);
      config(['app.STRIPE_SECRET' => $stripe_detail->secret_key]);
    } else {
      config(['app.STRIPE_KEY'    => $stripe_detail->login_id_live]);
      config(['app.STRIPE_SECRET' => $stripe_detail->transaction_key_live]);
    } */

    $paypal_detail = PaymentType::where('id', 4)->where('status', 1)->first();
    config(['app.PAYPAL_EMAIL' => $paypal_detail->live_email]);
    config(['app.Client_ID'    => $paypal_detail->login_id_live]);
    config(['app.SECRET'       => $paypal_detail->transaction_key_live]);
    config(['paypal.mode'  => 'live']);

    if ($paypal_detail->active_account == 'test') {
      config(['paypal.mode'  => 'sandbox']);
      config(['app.PAYPAL_EMAIL'  => $paypal_detail->test_email]);
      config(['app.Client_ID'     => $paypal_detail->login_id_test]);
      config(['app.SECRET'        => $paypal_detail->transaction_key_test]);
    }

    //dd(config('app.STRIPE_SECRET'));

  }

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //dd(config('app.STRIPE_KEY'));
  }
}
