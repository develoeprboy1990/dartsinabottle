@extends('user.customer.customer-layout')
@section('title','Checkout')
@section('content')
{{-- Header Content --}}
@include('user.customer.header-customer')
{{-- Header Content End  --}}
<div class="wrapper">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 checkout-form-col checkout-form">
        <form id="custom-badge-checkout-form">
          
          {{csrf_field()}}
          <div class="row checkout-field-row">
          
            <fieldset class="col-xs-12 checkout-fields-col">
            
            <div class="row bs-wizard" style="border-bottom:0;">
            <div class="col-xs-4 step-col complete active" id="shippingstep">
              <div class="text-center stepnumber">Shipping</div>
              <div class="progress-line">
                <div class="progress">
                  <div class="progress-bar"></div>
                </div>
                <a href="#" class="step-dot"></a> </div>
            </div>
            <div class="col-xs-4 step-col disabled" id="billingstep"><!-- complete -->
              <div class="text-center stepnumber">Billing</div>
              <div class="progress-line">
                <div class="progress">
                  <div class="progress-bar"></div>
                </div>
                <a href="#" class="step-dot"></a> </div>
            </div>
            <div class="col-xs-4 step-col disabled" id="paymentstep"><!-- complete -->
              <div class="text-center stepnumber">Payment</div>
              <div class="progress-line">
                <div class="progress">
                  <div class="progress-bar"></div>
                </div>
                <a href="#" class="step-dot"></a> </div>
            </div>
          </div>
            
            
            <h1 class="badges-title text-center"><em class="fa fa-user"></em> Shipping Info</h1>
            <div class="row">
               <div class="col-md-6">
                 <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#add_more_shipping_detail_modal">Add more shipping detail 

                 </a>
               </div>

               @if(count($shipping_detail)>1)
               <div class="col-md-6">
                  <select class="form-control required" name="user_shipping_info"  id="user_custom_badge_shipping_info">
                    <option value="">Choose Shipping Info</option>    
                      
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
            <div class="clearfix"></div>
              <div class="well">
                <div class="row">
                <input type="hidden" id="custom_badge_id" name="custom_badge_id" value="{{$id}}">
                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control req_class" value="{{$shipping_detail[0]->first_name}}">
                  </div>

                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control req_class" value="{{$shipping_detail[0]->last_name}}">
                  </div>

                  <div class="col-xs-12 form-group">
                    <label>Address</label>
                    <input type="text" name="address" id="custom_badge_address" class="form-control req_class" value="{{$shipping_detail[0]->address}}">
                  </div>

                  <div class="col-sm-4 col-xs-12 form-group">
                    <label>Country</label>
                    @if($shipping_detail[0]->getCountry)
                    <input type="text" name="country" id="country" class="form-control req_class" value="{{$shipping_detail[0]->getCountry->name}}" disabled="true">
                    @endif
                  </div>

                  <span id="fill_state_cities_data">

                  <span id="shipping_details_state_div">
                  
                   
                    <div class="col-sm-4 col-xs-12 form-group highlight_select">
                      <label>State </label>
                      <select class="selectpicker form-control required" name="state" data-live-search="true"  title="Choose State" id="state" data-selector_type="select">
                        
                        @foreach($states as $state)
                          @if($shipping_detail[0]->state_id == $state->id)
                             @php
                              $set_ship_state_selected="selected";    
                             @endphp  
                          @else
                             @php
                             $set_ship_state_selected="";    
                             @endphp
                          @endif

                         <option value="{{$state->id}}" {{$set_ship_state_selected}}>{{$state->name}}</option>
                        @endforeach 
                      
                      </select>
                    </div>
                  
                  </span>


                 <span id="shipping_details_city_div">
                 
                  
                   <div class="col-sm-4 col-xs-12 form-group highlight_select">
                     <label>City </label>
                     <select class="selectpicker form-control required" name="city" data-live-search="true"  title="Choose City" id="city" data-selector_type="select">
                       
                       @foreach($shipping_cities as $result)
                         @if($shipping_detail[0]->city_id == $result->id)
                            @php
                             $set_ship_city_selected="selected";    
                            @endphp  
                         @else
                            @php
                            $set_ship_city_selected="";    
                            @endphp
                         @endif

                        <option value="{{$result->id}}" {{$set_ship_city_selected}}>{{$result->name}}</option>
                       @endforeach 

                     </select>
                   </div>
                 
                 </span>

                 </span>

                  {{-- <div class="col-sm-4 col-xs-12 form-group">
                    <label>City</label>
                    @if($shipping_detail[0]->getCity)
                    <input type="text" name="name" id="city" class="form-control req_class" value="{{$shipping_detail[0]->getCity->name}}" >
                    @endif
                  </div> --}}
                  
                  <div class="col-sm-12 col-xs-12 form-group">
                    <label>Zip Code</label>
                    <input type="text" name="zip_code" id="zip_code" class="form-control req_class" value="{{$shipping_detail[0]->zip}}">
                  </div>
                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control req_class" value="{{$shipping_detail[0]->phone}}">
                  </div>
                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>Email Address</label>
                    <input type="text" name="email" id="email_address" class="form-control req_class" value="{{$shipping_detail[0]->email}}">
                  </div> 

                </div>
              </div>
              <div class="clearfix"></div>
              <div class="row checkout-btn-row">
                <div class="col-xs-6 checkout-btn pull-right text-right" >
                  <button type="button" class="btn btn-next">Next</button>
                </div>
              </div>
            </fieldset>
            
            <fieldset class="col-xs-12 checkout-fields-col">
            
            <div class="row bs-wizard" style="border-bottom:0;">
            <div class="col-xs-4 step-col complete" id="shippingstep">
              <div class="text-center stepnumber">Shipping</div>
              <div class="progress-line">
                <div class="progress">
                  <div class="progress-bar"></div>
                </div>
                <a href="#" class="step-dot"></a> </div>
            </div>
            <div class="col-xs-4 step-col complete active" id="billingstep"><!-- complete -->
              <div class="text-center stepnumber">Billing</div>
              <div class="progress-line">
                <div class="progress">
                  <div class="progress-bar"></div>
                </div>
                <a href="#" class="step-dot"></a> </div>
            </div>
            <div class="col-xs-4 step-col disabled" id="paymentstep"><!-- complete -->
              <div class="text-center stepnumber">Payment</div>
              <div class="progress-line">
                <div class="progress">
                  <div class="progress-bar"></div>
                </div>
                <a href="#" class="step-dot"></a> </div>
            </div>
          </div>
            
            <h1 class="badges-title text-center"><em class="fa fa-dollar"></em> Billing Info</h1>
              <div class="checkbox same-as-shipping">
                  <label>
                    <input type="checkbox" name="billing_checkbox" class="checkbox" id="billing_checkbox">
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
                    <label>Address</label>
                    <input type="text" name="billing_address" class="form-control req_class" value="" id="billing_address">
                  </div>
                  
                  <div class="col-sm-4 col-xs-12 form-group">
                    <label>Country</label>
                    <input type="text" name="billing_country" class="form-control req_class" value="United States" id="billing_country" disabled="true">
                  </div>

                  

                 <span id="fill_shipping_state_cities">
                  <div class="col-sm-4 col-xs-12 form-group hit_select highlight_select">
                     <label>State<span style="display: none;" id="billing_state_loader"><img src="{{url('public/uploads/gif/cart_loader.gif')}}"></span></label>
                      <select class="selectpicker form-control required" name="billing_state" data-live-search="true"  title="Choose State" id="billing_state" data-selector_type="select">
                          
                              
                        @foreach($states as $state)
                        <option value="{{$state->id}}">{{$state->name}}</option>
                        @endforeach

                      </select>
                 
                  </div>

                

                  <span id="billing_city_div">
                    
                  </span>

                  </span>

                  <div class="col-sm-12 col-xs-12 form-group">
                    <label>Zip Code</label>
                    <input type="text" name="billing_zip_code" id="billing_zip_code" class="form-control req_class" value="">
                  </div>
                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>Phone Number</label>
                    <input type="text" name="billing_phone_number" id="billing_phone_number" class="form-control req_class" value="">
                  </div>
                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>Email Address</label>
                    <input type="text" name="billing_email" id="billing_email" class="form-control req_class" value="">
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="row checkout-btn-row">
                <div class="col-xs-6 checkout-btn">
                  <button type="button" class="btn btn-previous">Previous</button>
                </div>
                <div class="col-xs-6 checkout-btn pull-right text-right" >
                  <button type="button" class="btn btn-next">Next</button>
                </div>
              </div>
            </fieldset>
            
            <fieldset class="col-xs-12 checkout-fields-col">
            
            <div class="row bs-wizard" style="border-bottom:0;">
            <div class="col-xs-4 step-col complete active" id="shippingstep">
              <div class="text-center stepnumber">Shipping</div>
              <div class="progress-line">
                <div class="progress">
                  <div class="progress-bar"></div>
                </div>
                <a href="#" class="step-dot"></a> </div>
            </div>
            <div class="col-xs-4 step-col complete" id="billingstep"><!-- complete -->
              <div class="text-center stepnumber">Billing</div>
              <div class="progress-line">
                <div class="progress">
                  <div class="progress-bar"></div>
                </div>
                <a href="#" class="step-dot"></a> </div>
            </div>
            <div class="col-xs-4 step-col complete active" id="paymentstep"><!-- complete -->
              <div class="text-center stepnumber">Payment</div>
              <div class="progress-line">
                <div class="progress">
                  <div class="progress-bar"></div>
                </div>
                <a href="#" class="step-dot"></a> </div>
            </div>
          </div>
            
            
            <h1 class="badges-title text-center"><em class="fa fa-credit-card"></em> Payment Info</h1>

            <div id="payment_type_div" style="margin-bottom: 15px;">
            @if($customer_custom_payment_types->count()<1)
            <label class="radio-inline"><input type="radio" name="payment_type" value="1">Credit Card</label>

            @else

            @foreach($customer_custom_payment_types as $result)
            <label class="radio-inline"><input type="radio" name="payment_type" value="{{@$result->getPaymentType->id}}">{{@$result->getPaymentType->name}}</label>
            @endforeach
            @endif
            </div>


              <div class="row">
                <div class="col-md-8 col-xs-12 payment-col">
                 <div class="well" style="margin-bottom: 15px;">

<input type="hidden" name="customer_internal_reference_no" id="customer_internal_reference_no" value="">
                          {{-- <div class="form-group">
                          <label>Customer Internal Reference Number</label>
                      <input type="text" name="customer_internal_reference_no" id="customer_internal_reference_no" class="form-control">
                      </div> --}}
                      <div class="form-group">
                          <label>Order Note</label>
                      <textarea name="order_note" id="order_note" class="form-control"></textarea>
                    </div> 

                 </div>

                  <div class="well" style="display: none;" id="credit_card_payment_div">
                   <div class="row">
                   @php
                     if($bill_details['shipping_cost']== null){
                      $pay_existing_disabled="disabled";
                      }
                      else
                      {
                        $pay_existing_disabled="";
                      }
                    @endphp

                   <div class="col-xs-12 form-group">
                   @if($authorize_customer_profile) 
                   @php
                     if($pay_from_existing_card_array["error"] == false)
                     {
                       $give_disable_class_for_existing_card="";
                       $last_4_digit=$pay_from_existing_card_array["last_4_digit"];
                     }
                     else
                     {
                       $give_disable_class_for_existing_card="disabled";
                       $last_4_digit="Something went wrong";
                     }
                   @endphp

                      <button type="button" class="btn btn-success btn-lg" id="pay_from_existing_authorize_card_custom_badge" {{$pay_existing_disabled}} {{$give_disable_class_for_existing_card}}>Pay from existing card ( {{@$last_4_digit}} ) </button>
                      <p style="color:red;">If pay from existing card. Then billing details attached with your previous card will be saved</p>
                   @endif
                   </div>
                   
                    <div class="col-xs-12 form-group">
                      <label>Credit Card Number</label>
                      <input type="text" name="card_number" id="card_number" class="form-control validation_of_card" value="">
                    </div>
                    <div class="col-sm-4 col-xs-12 form-group">
                      <label>CVV Code</label>
                      <input type="text" name="card_cvv" id="card_cvv" class="form-control validation_of_card" value="">
                    </div>
                    <div class="col-sm-4 col-xs-12 form-group">
                      <label>Expiration Month</label>
                      <select name="card_month" class="form-control validation_of_card" id="card_month" isrequired="">
                        <option  value="">Expiration Month</option>
                        <option value="01">01 (Jan)</option>
                        <option value="02">02 (Feb)</option>
                        <option value="03">03 (Mar)</option>
                        <option value="04">04 (Apr)</option>
                        <option value="05">05 (May)</option>
                        <option value="06">06 (Jun)</option>
                        <option value="07">07 (Jul)</option>
                        <option value="08">08 (Aug)</option>
                        <option value="09">09 (Sep)</option>
                        <option value="10">10 (Oct)</option>
                        <option value="11">11 (Nov)</option>
                        <option value="12">12 (Dec)</option>
                      </select>
                    </div>
                    <div class="col-sm-4 col-xs-12 form-group">
                      <label>Expiration year</label>
                      <select name="card_year" class="form-control kform_spacer validation_of_card" id="card_year" isrequired="">
                        <option  value="">Expiration Year</option>
                        @php
                          $current_year=date('Y');
                          $final_year=$current_year+10;
                        @endphp
                        @for($current_year;$current_year<=$final_year;$current_year++)
                          <option value="{{$current_year}}">{{$current_year}}</option>
                          
                        @endfor
                        
                      </select>
                    </div>
                  </div>
                </div> 

                 {{-- Wire Start --}}
                <div class="well" style="display: none;" id="wire_payment_div">
                   <div class="row">
                    <div class="col-xs-12">
                      <div class="panel panel-info">
                        <div class="panel-heading">Wire Details</div>
                        <div class="panel-body">{!!$wire_detail->wire_detail!!}</div>
                      </div>
                     </div>
                    
                   </div>
                </div>
                {{-- Wire Ended --}}

                {{-- Check Start --}}
                <div class="well" style="display: none;" id="check_payment_div">
                   <div class="row">
                    
                    <div class="col-xs-12">
                      <div class="panel panel-info">
                        <div class="panel-heading">Check Details</div>
                        <div class="panel-body">{!!$check_detail->check_detail!!}</div>
                      </div>
                    
                   </div>
                   </div>
                </div>
                {{-- Check Ended --}}

                </div>
                {{-- End of <div class="col-md-8 col-xs-12 payment-col"> --}}

                <div class="col-md-4 col-xs-12 payment-detail">
                	 
               

                  <div class="well">
                      <table class="table">
                        <tbody>
                          <tr>
                            <th>Shipping Amount:</th>
                            @if($bill_details['shipping_cost']!= null)
                            <td class="kcartShipTotal">$<span id="shipping_amount_td">{{$bill_details['shipping_cost']}}</span></td>
                            @else
                            <td class="kcartShipTotal"><span id="shipping_amount_td" class="give_shipping_error">Shipping cost not defined</span></td>
                            @endif
                          </tr>
                          <tr>
                            <th>Price of One Badge:</th>
                            <td class="kcartShipTotal">${{$bill_details['price_of_one_badge']}}</td>
                          </tr>
                          <tr>
                            <th>Weight of One Badge:</th>
                            <td class="kcartShipTotal">{{$bill_details['weight_of_one_badge']}}lbs</td>
                          </tr>
                          <tr>
                            <th>Total Weight:</th>
                            <td class="kcartShipTotal">{{$bill_details['weight']}}lbs</td>
                          </tr>
                          <tr>
                            <th>Total Items:</th>
                            <td class="kcartSubTotal">{{$bill_details['total_items']}}</td>
                          </tr>
                         
                          <tr class="total">
                            <th>Sub Total:</th>
                            <td class="kcartGrandTotal">
                            $<span id="sub_total_td">{{$bill_details['sub_total']}}</span></td>
                          </tr>

                         


                          
                          {{-- Here shipping cost added in this total --}}
                         {{--  <tr class="total"> 
                            <th>Total:</th>
                            <td class="kcartGrandTotal">${{$bill_details['get_total_values']['total_discounted_total']}}</td>
                          </tr> --}}
                           <tr class="total"> 
                            <th>Total:</th>
                            <td class="kcartGrandTotal">$<span id="amount_td">{{$bill_details['final_total']}}</span></td>
                          </tr>

                        </tbody>
                      </table>
   
                </div>

                
                {{-- @endif --}}
                </div>
              </div>
             
             
            <input type="hidden" name="payment_type_id" class="payment_type_id">

             <input type="hidden" name="custom_badge_detail_id" id="custom_badge_detail_id" value="{{$id}}">


              <input type="hidden" name="shipping_id" class="shipping_id" value="{{$shipping_detail[0]->id}}">

              <input type="hidden" name="total_products" id="total_products" value="{{$bill_details['total_items']}}">
              <input type="hidden" name="sub_total" class="sub_total" value="{{$bill_details['sub_total']}}">

              <input type="hidden" name="shipping_cost" class="shipping_cost" value="{{$bill_details['shipping_cost']}}">

              <input type="hidden" name="total_weight_of_products" class="total_weight_of_products" value="{{$bill_details['weight']}}">
              
              {{-- <input type="hidden" name="discounted_total" class="discounted_total" value="{{$bill_details['total_discounted_total']}}"> --}}
              
              <input type="hidden" name="amount" class="amount" value="{{$bill_details['final_total']}}">


              <div class="row checkout-btn-row">
                <div class="col-xs-6 checkout-btn">
                  <button type="button" class="btn btn-previous">Previous</button>
                </div>
                <div class="col-xs-6 checkout-btn pull-right text-right">

                @if($bill_details['shipping_cost'] == null)
                  @php
                    $place_order_disabled="disabled";
                  @endphp
                @else
                  @php
                    $place_order_disabled="";
                  @endphp
                @endif
                    <input type="submit" id="place_order_button" class="btn" value="Place Order" {{$place_order_disabled}}>
                </div>
              </div>
            </fieldset>
            
          </div>
        </form>

        {{-- Pay from existing Card --}}

        @if($authorize_customer_profile)
           <form class="form-horizontal" id="existing_authorize_credit_card_custom_badge">    
                                 {{csrf_field()}}
                                <span id="fill_billing_details_fields">
                                  
                                </span>  
                                <input type="hidden" name="payment_type_id" class="payment_type_id">

                                <input type="hidden" name="custom_badge_detail_id" value="{{$id}}">
                                <input type="hidden" name="shipping_id" class="shipping_id" value="{{$shipping_detail[0]->id}}">

                                 <input type="hidden" name="main_id" value="{{$authorize_customer_profile->id}}">

                                 <input type="hidden" name="authorize_customer_profile_id" value="{{$authorize_customer_profile->customer_profile_id}}">

                                 <input type="hidden" name="authorize_payment_profile_id" value="{{$authorize_customer_profile->payment_profile_id}}">

                                
                                  

                                  <input type="hidden" name="total_products"  value="{{$bill_details['total_items']}}">
                                  <input type="hidden" name="sub_total" class="sub_total" value="{{$bill_details['sub_total']}}">

                                  <input type="hidden" name="shipping_cost" class="shipping_cost" value="{{$bill_details['shipping_cost']}}">

                                  <input type="hidden" name="total_weight_of_products"  class="total_weight_of_products" value="{{$bill_details['weight']}}">
                                  
                                  {{-- <input type="hidden" name="discounted_total" class="discounted_total" value="{{$bill_details['total_discounted_total']}}"> --}}
                                  
                                  <input type="hidden" name="amount" class="amount" value="{{$bill_details['final_total']}}">
                                                   

                                 {{-- <input type="hidden" class="c_original_total" name="original_total" value="{{$original_total}}">

                                 <input type="hidden" class="c_sub_total" name="sub_total" value="{{$sub_total}}">   
                                 <input type="hidden" name="d_percent" value="{{$dis_category}}">


                                 <input type="hidden" name="checkout_shipping_id" class="checkout_shipping_id" value="{{$shipping_details[0]->id}}">

                                <input type="hidden" name="total_weight" value="{{$total_weight}}">
                                <input type="hidden" class="total_ship_cost" name="total_ship_cost" value="{{$shipping_cost}}"> --}}


                                 
                                </form>

          @endif        
        {{-- Pay from existing Card end --}}

      </div>
    </div>
  </div>
</div>
{{-- Footer Content --}}
@include('user.customer.footer-customer')
{{-- Footer Content End  --}}

 <!-- Modal -->
  <div class="modal fade" id="add_more_shipping_detail_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Another Shipping Detail</h4>
        </div>
        <form action="{{url('place-order')}}" method="post" id="add_more_shipping_detail_form">
        {{csrf_field()}}
        <div class="modal-body">

            <div class="form-group">
              <label>Shipping Email</label> 
              <input type="email" name="shipping_email" id="add_more_shipping_email" class="form-control" value=""  required="true">
            </div>

            

            

            <div class="form-group">
              <label for="country">Country:</label>
              <input type="text" class="form-control" id="add_more_shipping_country" name="country_id" value="United States" disabled="true">
            </div>


            <div class="form-group">
             <label>State <span style="display: none;" id="state_loader"><img src="{{url('public/uploads/gif/cart_loader.gif')}}"></span></label>
                    <select class="selectpicker form-control required" name="state_id" data-live-search="true"  title="Choose State" id="add_more_shipping_state">
                        
                            
                      @foreach($states as $state)
                      <option value="{{$state->id}}">{{$state->name}}</option>
                      @endforeach

                    </select>
            </div>

            <span id="div_add_more_shipping_city">
                            
            </span>

            <div class="form-group">
              <label>Address</label> 
               <input type="text" name="shipping_address" id="add_more_shipping_address" class="form-control" value="" required="true">
            </div>

            <div class="form-group">
              <label>Phone</label> 
               <input type="text" name="shipping_phone" id="add_more_shipping_phone" class="form-control" value="" required="true">
            </div>

             <div class="form-group">
              <label>Zip</label> 
               <input type="text" name="shipping_zip" id="add_more_shipping_zip" class="form-control" value="" required="true">
            </div>


            
       

         
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default" id="add_more_shipping_detail_add_btn">Add <span style="display: none;" id="add_more_shipping_detail_loader"><img src="{{url('public/uploads/gif/cart_loader.gif')}}"></span></button>
        </div>
        </form>
      </div>
      
    </div>
  </div>
  {{-- Modal End --}}


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

{{-- Authorize Payment Loader --}}
  <div class="modal fade" id="authorize_waiting_modal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        
        <div class="modal-body">
          
          <h2>Please Wait</h2>
          <p style="text-align:center;"><img src="{{url('public/uploads/gif/waiting.gif')}}"></p>
        </div>
        
      </div>
    </div>
  </div>

@endsection

@section('javascript')
 <script src="{{asset('assets/customer/assets/js/checkout.js')}}"></script>
@endsection	