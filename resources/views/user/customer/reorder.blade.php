@extends('user.customer.customer-layout')
@section('title','Reorder')
@section('content')
{{-- Header Content --}}
@include('user.customer.header-customer')
{{-- Header Content End  --}}
<div class="wrapper">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 checkout-form-col checkout-form">
        
        <form class="reorder-form">
          
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
                  <select class="form-control required" name="user_shipping_info"  id="user_shipping_info">
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
                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>First Name</label>
                    <input type="text" name="name" class="form-control req_class" value="{{$user->first_name}}" disabled="true">
                  </div>
                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>Last Name</label>
                    <input type="text" name="name" class="form-control req_class" value="{{$user->last_name}}" disabled="true">
                  </div>
                  <div class="col-xs-12 form-group">
                    <label>Address</label>
                    <input type="text" name="name" id="address" class="form-control req_class" value="{{$shipping_detail[0]->address}}" disabled="true">
                  </div>

                  <div class="col-sm-4 col-xs-12 form-group">
                    <label>Country</label>
                    <input type="text" name="name" id="country" class="form-control req_class" value="United States"
                    disabled="true">
                  </div>
                    
                  <div class="col-sm-4 col-xs-12 form-group">
                    <label>State</label>
                    <input type="text" name="name" id="state" class="form-control req_class" value="{{$shipping_detail[0]->getState->name}}" disabled="true">
                    
                  </div>

                  <div class="col-sm-4 col-xs-12 form-group">
                    <label>City</label>
                    <input type="text" name="name" id="city" class="form-control req_class" value="{{$shipping_detail[0]->getCity->name}}"  disabled="true">
                  </div>
                  
                  <div class="col-sm-4 col-xs-12 form-group">
                    <label>Zip Code</label>
                    <input type="text" name="name" id="zip_code" class="form-control req_class" value="{{$shipping_detail[0]->zip}}" disabled="true">
                  </div>
                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>Phone Number</label>
                    <input type="text" name="name" id="phone_number" class="form-control req_class" value="{{$shipping_detail[0]->phone}}" disabled="true">
                  </div>
                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>Email Address</label>
                    <input type="text" name="name" id="email_address" class="form-control req_class" value="{{$shipping_detail[0]->email}}" disabled="true">
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
                  <div class="col-sm-4 col-xs-12 form-group hit_select">
                     <label>State<span style="display: none;" id="billing_state_loader"><img src="{{url('public/uploads/gif/cart_loader.gif')}}"></span></label>
                      <select class="selectpicker form-control required" name="billing_state" data-live-search="true"  title="Choose State" id="billing_state">
                          
                              
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
              <div class="row">
                <div class="col-md-8 col-xs-12 payment-col">
                  <div class="well">
                   <div class="row">
                    <div class="col-xs-12 form-group">
                      <label>Credit Card Number</label>
                      <input type="text"  name="card_number" class="form-control req_class" value="">
                    </div>
                    <div class="col-sm-4 col-xs-12 form-group">
                      <label>CVV Code</label>
                      <input type="text" name="card_cvv" class="form-control req_class" value="">
                    </div>
                    <div class="col-sm-4 col-xs-12 form-group">
                      <label>Expiration Month</label>
                      <select name="card_month" class="form-control req_class" isrequired="">
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
                      <select name="card_year" class="form-control kform_spacer req_class" isrequired="">
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
                </div>  </div>
                <div class="col-md-4 col-xs-12 payment-detail">
                	 
                 @if(count($order_products)>0)

                 <div class="well">
                      <table class="table">
                        <tbody>
                          {{-- <tr>
                            <th>Shipping Amount:</th>
                            <td class="kcartShipTotal">$0.00</td>
                          </tr> --}}
                          <tr>
                            <th>Badge</th>
                            <th>Quantity</th>
                          </tr>
                         
                         @if(count($order_products)>0)
                         @foreach($order_products as $ordered_item)
                          <tr class="total">
                           
                            <td class="kcartGrandTotal">{{$ordered_item->size_from}}*{{$ordered_item->size_to}} </td>
                            <td class="kcartGrandTotal">{{$ordered_item->total_badge_qty}}</td>
                          </tr>
                          @endforeach
                          @endif



                         

                        </tbody>
                      </table>
   
                </div>

                  <div class="well">
                      <table class="table">
                        <tbody>
                          {{-- <tr>
                            <th>Shipping Amount:</th>
                            <td class="kcartShipTotal">$0.00</td>
                          </tr> --}}
                          <tr>
                            <th>Total Items:</th>
                            <td class="kcartSubTotal">{{$order_detail->total_products}}</td>
                          </tr>
                         
                          <tr class="total">
                            <th>Sub Total:</th>
                            <td class="kcartGrandTotal">
                            ${{$order_detail->sub_total}}</td>
                          </tr>

                          <tr class="total">
                            <th>Dicounted Total:</th>
                            <td class="kcartGrandTotal">${{$order_detail->discounted_total}}</td>
                          </tr>


                          <tr class="total"> 
                          {{-- Here shipping cost added in this total --}}
                            <th>Total:</th>
                            <td class="kcartGrandTotal">${{$order_detail->total}}</td>
                          </tr>

                        </tbody>
                      </table>
   
                </div>

                
                @endif
                </div>
              </div>
              <input type="hidden" name="shipping_id" id="shipping_id" value="{{$shipping_detail[0]->id}}">

              <input type="hidden" name="total_products" value="{{$order_detail->total_products}}">
              <input type="hidden" name="sub_total" value="{{$order_detail->sub_total}}">
              
              <input type="hidden" name="discounted_total" value="{{$order_detail->discounted_total}}">
              
              <input type="hidden" name="amount" value="{{$order_detail->total}}">
              <input type="hidden" name="order_detail_id" value="{{$order_detail->id}}">

              <div class="row checkout-btn-row">
                <div class="col-xs-6 checkout-btn">
                  <button type="button" class="btn btn-previous">Previous</button>
                </div>
                <div class="col-xs-6 checkout-btn pull-right text-right">
                  <input type="submit" class="btn" value="Place Order">
                </div>
              </div>
            </fieldset>
            
          </div>
        </form>
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
 <script src="{{asset('assets/customer/assets/js/re-order.js')}}"></script>
@endsection	