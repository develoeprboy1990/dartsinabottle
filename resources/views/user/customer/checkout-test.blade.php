@extends('user.customer.customer-layout')
@section('title','Checkout')
@section('content')
{{-- Header Content --}}
@include('user.customer.header-customer')
{{-- Header Content End  --}}
<div class="wrapper">
  <form id="checkFromCheckOut" method="POST" action="{{url('order-thankyou-page')}}">
    {{csrf_field()}}
    <input type="hidden" name="from_checkout" id="from_checkout">
  </form>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 checkout-form-col checkout-form">
        <form class="checkout-form-class" method="post" action="{{url('place-order')}}" >
          {{csrf_field()}}
          <div class="row checkout-field-row"> 
            <div class="row">
              <div class="col-md-6 col-xs-12">
                <h1 class="badges-title text-center"><em class="fa fa-user"></em> Shipping Info</h1>
                  <div class="row">
               @if(count($shipping_detail)>1)
               <div class="col-md-6">
               <label>Choose your previous shipping</label>
                  <select class="form-control required" name="user_shipping_info"  id="user_shipping_info">
                    <!-- <option value="">Choose Shipping Info</option>  -->  
                      @php
                         $s_c=1; 
                      @endphp 

                      @foreach($shipping_detail as $result_shipping_detail)                      
                       @if($s_c==1 )
                          @php
                            $give_selected='selected';
                          @endphp
                       @else
                          @php
                            $give_selected='';   
                          @endphp   
                       @endif
                        <option value="{{$result_shipping_detail->id}}" {{$give_selected}}>Shipping Information {{$s_c}}</option>                        
                        @php
                          $s_c++;
                        @endphp
                      @endforeach
                </select>
               </div> 
               @endif
            </div>
                  <br>
                  <div class="clearfix"></div>
                  <div class="well">
                <div class="row">
                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control req_class" value="{{$shipping_detail[0]->first_name}}"  disabled="true">
                  </div>
                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control req_class" value="{{$shipping_detail[0]->last_name}}"  disabled="true">
                  </div>
                  <div class="col-xs-12 form-group">
                    <label>Address Line 1</label>
                    <input type="text" name="address" id="address" class="form-control req_class" value="{{$shipping_detail[0]->address}}"  disabled="true">
                  </div>
                  <div class="col-xs-12 form-group">
                    <label>Address Line 2</label>
                    <input type="text" name="address_2" id="address_2" class="form-control " value="{{$shipping_detail[0]->address_2}}"  disabled="true">
                  </div>
                  <div class="col-sm-12 col-xs-12 form-group">
                    <label>Town/City</label>
                    @if($shipping_detail[0]->city_id)
                    <input type="text" name="city_id" id="city_id" class="form-control req_class" value="{{$shipping_detail[0]->city_id}}" disabled="true">
                    @endif
                  </div>
                  <div class="col-sm-12 col-xs-12 form-group">
                    <label>Postcode</label>
                    <input type="text" name="zip_code" id="zip_code" class="form-control req_class" value="{{$shipping_detail[0]->zip}}"  disabled="true">
                  </div>
                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>Phone</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control req_class" value="{{$shipping_detail[0]->phone}}"  disabled="true">
                  </div>
                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>Email Address</label>
                    <input type="text" name="email" id="email_address" class="form-control req_class" value="{{$shipping_detail[0]->email}}"  disabled="true">
                  </div>
                </div>
              </div>
                  <div class="clearfix"></div>
              </div>    
              <div class="col-md-6 col-xs-12">           
                <h1 class="badges-title text-center"><em class="fa fa-gbp"></em> Billing Info</h1>
                <div class="checkbox same-as-shipping">
                  <label><input type="checkbox" name="billing_checkbox" class="checkbox" id="billing_checkbox">
                    Is your billing address the same as your shipping address?</label>
                </div>
                <div class="well billing-fields">
                  <div class="row">
                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>First Name</label>
                    <input type="text" name="billing_first_name" id="billing_first_name" class="form-control req_class" value="{{$user->first_name}}">
                  </div>
                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>Last Name</label>
                    <input type="text" name="billing_last_name" class="form-control req_class" id="billing_last_name" value="{{$user->last_name}}">
                  </div>
                  <div class="col-xs-12 form-group">
                    <label>Address Line 1</label>
                    <input type="text" name="billing_address" class="form-control req_class" value="" id="billing_address">
                  </div>

                  <div class="col-xs-12 form-group">
                    <label>Address Line 2</label>
                    <input type="text" name="billing_address_2" class="form-control" value="" id="billing_address_2">
                  </div>
                  
                  <input type="hidden" name="billing_country" class="form-control req_class" value="230" id="billing_country" >


                  <div class="col-sm-12 col-xs-12 form-group">
                    <label>Town/City</label>
                    <input type="text" name="billing_city" class="form-control req_class" value="" id="billing_city">
                  </div>

                  <div class="col-sm-12 col-xs-12 form-group">
                    <label>Postcode</label>
                    <input type="text" name="billing_zip_code" id="billing_zip_code" class="form-control req_class" value="">
                  </div>
                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>Phone</label>
                    <input type="text" name="billing_phone_number" id="billing_phone_number" class="form-control req_class" value="">
                  </div>
                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>Email Address</label>
                    <input type="text" name="billing_email" id="billing_email" class="form-control req_class" value="">
                  </div>
                </div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>                      
            <div class="col-xs-12">
              <h1 class="badges-title text-center"><em class="fa fa-credit-card"></em>Payment Info</h1>
              <div id="payment_type_div" style="margin-bottom: 15px;" class="pull-right">
                @if($customer_custom_payment_types->count()<1)
                  <label class="radio-inline highlight_select">
                    <img src="{{url('public/uploads/paypal.png')}}" alt="logo" class="img-responsive">
                    <input type="radio" class="req_class" name="payment_type" id="payment_type_4" value="4" data-selector_type="select" data-package_id="{{$ordered_items->package_id}}" data-platform_fee="{{$paypal_fee}}">PayPal
                  </label>
                  
                  <label class="radio-inline highlight_select">
                    <img src="{{url('public/uploads/stripe.png')}}" alt="logo" class="img-responsive" style="width:200px;">
                    <input type="radio" class="req_class" name="payment_type" id="payment_type_5" value="5" data-selector_type="select" data-package_id="{{$ordered_items->package_id}}" data-platform_fee="{{$stripe_fee}}">Stripe
                  </label>
                @else
                  @foreach($customer_custom_payment_types as $result)
                  <label class="radio-inline"><input type="radio" name="payment_type" id="payment_type_{{$result->id}}" value="{{@$result->getPaymentType->id}}">{{@$result->getPaymentType->name}}</label>
                  @endforeach
                @endif
              </div>
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-md-8 col-xs-12 payment-col">
                  <!--
                  <div class="well" style="margin-bottom: 15px;">
                  <div class="form-group">
                  <label>Customer Internal Reference Number</label>
                  <input type="text" name="customer_internal_reference_no" id="customer_internal_reference_no" class="form-control">
                  </div>
                  <div class="form-group">
                  <label>Order Note</label>
                  <textarea name="order_note" id="order_note" class="form-control"></textarea>
                  </div>
                  </div>
                  -->
                  <div class="well" style="display:none"  id="stripe_payment_div">
                     <div class="row">
                     @php
                       if($get_result_array['get_total_values']['shipping_cost']== null){
                        $pay_existing_disabled="disabled";
                        }
                        else
                        {
                          $pay_existing_disabled="";
                        }
                      @endphp
                      <div class="col-xs-12 form-group"> 
                     <label for="">Credit / Debit Card Number</label>
                     <input class="form-control validation_of_card req_class_stripe" id="cardNumber" name="cardNumber"  data-stripe="number" data-parsley-type="number" maxlength="16" data-parsley-trigger="change focusout" data-parsley-class-handler="#cc-group" type="text">
                      </div> 
                      <div class="col-sm-4 col-xs-12 form-group">
                        <label for="">CVC</label>
                        <input class="form-control validation_of_card req_class_stripe" id="ccv"  data-stripe="cvc" data-parsley-type="number" data-parsley-trigger="change focusout" maxlength="4" data-parsley-class-handler="#ccv-group" type="text">
                      </div>
                      <div class="col-sm-4 col-xs-12 form-group highlight_select" >                     
                          {!! Form::label(null, 'Ex. Month') !!}
                          {!! Form::selectMonth(null, null, [
                              'class'                 => 'form-control req_class_stripe',
                              'data-stripe'           => 'exp-month',
                              'id'                    =>'exp-month',
                              'data-selector_type'    =>'select'
                          ], '%m') !!}
                      </div>
                      <div class="col-sm-4 col-xs-12 form-group">                 
                           {!! Form::label(null, 'Ex. Year') !!}
                          {!! Form::selectYear(null, date('Y'), date('Y') + 10, null, [
                              'class'             => 'form-control req_class_stripe',
                              'data-stripe'       => 'exp-year',
                              'id'                    =>'exp-year',
                              'data-selector_type'    =>'select'
                              ]) !!}
                      </div>
                    </div>
                  </div>  

                  <div id="paypal_payment_div" style="max-height:350px;">
                    <img src="{{url('public/uploads/emails/banner.jpg')}}" alt="logo" class="img-responsive">
                     <!-- <div class="row">
                      <div class="col-xs-12">
                        <div class="panel panel-info">
                          <div class="panel-heading">Paypal Details </div>
                          <div class="panel-body">

                          <div id="paypal-button-container">


 
                          </div>
                          </div>
                        </div>
                       </div>
                      
                     </div> -->
                  </div>
                </div>
                <div class="col-md-4 col-xs-12 payment-detail pull-right">                	 
                 @if($get_result_array['get_cart'] != null)
                  <div class="well">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th>Package</th>
                          <th>Quantity</th>
                        </tr>
                       @if($ordered_items != null)
                        <tr class="total">
                         <td class="kcartGrandTotal">{{$ordered_items->darts_set}} SETS / MONTH </td>
                          <td class="kcartGrandTotal">{{$ordered_items->total_qty}}</td>
                        </tr>
                        @endif                  
                      </tbody>
                    </table>
                  </div>
                  <div class="well">
                      <table class="table">
                        <tbody>
                          <!-- <tr>
                            <th>Weight Order:</th>
                            <td class="kcartShipTotal">{{$ordered_items->sort_1}} | {{$ordered_items->sort_2}} | {{$ordered_items->sort_3}}</td>
                          </tr> -->
                          <tr class="total">
                            <th>Sub Total:</th>
                            <td class="kcartGrandTotal">£<span id="discounted_total_td">{{ number_format($get_result_array['get_total_values']['total_discounted_total'] , 2) }}</span></td>
                          </tr>
                          <!-- <tr>
                          <td><input type="text" name="coupon_code" id="coupon_code" class="form-group form-control" autocomplete="off" placeholder="Enter Promo Code"  style="line-height: 0px;margin-bottom: 0px;"></td>
                          <td><input type="button" id="check_promo_button" class="btn" value="APPLY" data-subtotal="{{$get_result_array['get_total_values']['total_discounted_total']}}"
                          data-shipping_cost="{{$get_result_array['get_total_values']['shipping_cost']}}"
                          data-user_id="{{$user->id}}"  style="color: #fff;  line-height: 0px;">
                          </td>
                          </tr> -->
                          <tr><td colspan="2"><span class="coupon_error"></span></td></tr>
                          @php
                          if($get_result_array['get_total_values']['state_tax'] == 0.00)
                          {
                            $display_val = "none;";
                          }
                          else
                          {
                            $display_val = "block;";
                          }
                          @endphp
                          <tr class="total">
                            <th>Deposit + Handling Fee:</th>
                            <td class="kcartGrandTotal">£<span id="amount_td" class="deposit_platform_fee" data-deposit_platform_fee="{{number_format($get_result_array['get_total_values']['deposit_cost'], 2)}}">{{number_format($get_result_array['get_total_values']['deposit_cost'], 2)}}
                            </span></td>
                          </tr>
                          <tr class="total">
                            <th>Total:</th>
                            <td class="kcartGrandTotal">£<span id="amount_td" class="final_total" data-final_total="{{number_format($get_result_array['get_total_values']['final_total'], 2)}}">{{number_format($get_result_array['get_total_values']['final_total'], 2)}}
                            </span></td>
                          </tr>
                        </tbody>
                      </table>
                </div>                
                @endif
                </div>
              </div>
              <input type="hidden" name="payment_type_id" class="payment_type_id">
              <input type="hidden" name="package_id" class="package_id" value="{{$ordered_items->package_id}}">
              <input type="hidden" name="sort_1" class="sort_1" value="{{$ordered_items->sort_1}}">
              <input type="hidden" name="sort_2" class="sort_2" value="{{$ordered_items->sort_2}}">
              <input type="hidden" name="sort_3" class="sort_3" value="{{$ordered_items->sort_3}}">
              <input type="hidden" name="choice" class="choice" value="{{$ordered_items->choice}}">
              <input type="hidden" name="shipping_id" class="shipping_id" value="{{$shipping_detail[0]->id}}">              
              <input type="hidden" name="total_products" id="total_products" value="{{$get_result_array['get_total_values']['total_items']}}">
              <input type="hidden" name="sub_total" id="sub_total" value="{{$get_result_array['get_total_values']['total_sub_total']}}">
              <input type="hidden" name="deposit_cost" id="deposit_cost" value="{{$get_result_array['get_total_values']['deposit_cost']}}">
              <input type="hidden" name="shipping_cost" class="shipping_cost" value="{{$get_result_array['get_total_values']['shipping_cost']}}">
              <input type="hidden" name="state_tax" class="state_tax" value="{{$get_result_array['get_total_values']['state_tax']}}">
              <input type="hidden" name="total_weight_of_products" class="total_weight_of_products" value="{{$get_result_array['get_total_values']['weight']}}">              
              <input type="hidden" name="discounted_total" class="discounted_total" value="{{$get_result_array['get_total_values']['total_discounted_total']}}">              
              <input type="hidden" name="amount" class="amount" value="{{$get_result_array['get_total_values']['final_total']}}">
              <input type="hidden" name="coupon_discount" class="coupon_discount" value="0">
              <input type="hidden" name="customer_internal_reference_no" id="customer_internal_reference_no" value="" >
              <input type="hidden" name="order_note" id="order_note" value="">
             
              <div class="row checkout-btn-row">

                <div class="col-sm-6 col-xs-12 checkout-btn pull-right text-right" id="checkout-btn" style="display: none;">
                @if($get_result_array['get_total_values']['shipping_cost'] == null)
                  @php
                    $place_order_disabled="disabled";
                  @endphp
                @else
                  @php
                    $place_order_disabled="";
                  @endphp
                @endif
                    <input type="submit" id="place_order_button" class="btn btn-next" value="Purchase Now" {{$place_order_disabled}}>
                </div>


                <div class="col-sm-6 col-xs-12 checkout-btn pull-right text-right" id="checkout-btn-paypal" style="display: none;">
                <!-- <input type="submit" id="paypal_order_button" class="btn btn-next" value="Place Now" {{$place_order_disabled}}> -->
                </div>
                
                
              </div>

              <div class="row">
                <div class="col-md-12">
                    <span class="payment-errors" style="color: red;margin-top:10px;"></span>
                </div>
              </div>              
            </div>
          </div>          
        </form>
      </div>
    </div>
  </div>
</div>
{{--  loader --}}
<div class="modal fade" id="waiting_modal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">
          <p style="text-align:center;"><img src="{{url('public/uploads/gif/waiting.gif')}}"></p>
        </div>        
      </div>
    </div>
  </div>
{{-- Footer Content --}}
@include('user.customer.footer-customer')
{{-- Footer Content End  --}}
@endsection
@section('javascript')
<script src="https://parsleyjs.org/dist/parsley.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<!-- <script src="https://www.paypal.com/sdk/js?client-id=AZp22rGSpvsorKZv4aVvGNZjEHTMuxaqod0Wp1KoiVyOCFQ0-GPlftbfHANEBVGzRPaRHp4wp-6RoE3r&vault=true&intent=subscription"></script> -->

<script>
  Stripe.setPublishableKey("<?php echo config('app.STRIPE_KEY') ?>");


 /*  paypal.Buttons({
            createSubscription: function(data, actions) {
              return actions.subscription.create({
                'plan_id': 'P-8YP765731P759873TMJRQK4Y' // Creates the subscription
              });
            },
            onApprove: function(data, actions) {
              alert('You have successfully created subscription ' + data.subscriptionID); // Optional message given to subscriber
            }
          }).render('#paypal-button-container'); // Renders the PayPal button */

</script>
<script src="{{asset('assets/customer/assets/js/checkout.js')}}"></script>



@endsection