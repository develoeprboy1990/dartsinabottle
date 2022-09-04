@extends('user.customer.customer-layout')
@section('title','Cart')
@section('content')
{{-- Header Content --}}
@include('user.customer.header-customer')
{{-- Header Content End  --}}
<div class="wrapper">
<div class="container">
@if(Session::has('successmessage'))
    <div class="alert alert-success alert-dismissable">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
     {{Session::get('successmessage')}}
   </div>
@endif

  <div class="row">
    <div class="col-xs-12 cart-form-col">
      <form class="cart-form">
          <div class="row bs-wizard" style="border-bottom:0;">
            <div class="col-xs-4 step-col complete">
              <div class="text-center stepnumber">Step 1</div>
              <div class="progress-line">
              <div class="progress">
                <div class="progress-bar"></div>
              </div>
              <a href="#" class="step-dot"></a> 
              </div>
              
              </div>
            <div class="col-xs-4 step-col complete"><!-- complete -->
              <div class="text-center stepnumber">Step 2</div>
              <div class="progress-line">
              <div class="progress">
                <div class="progress-bar"></div>
              </div>
              <a href="#" class="step-dot"></a> 
              </div>
              </div>
            <div class="col-xs-4 step-col complete active"><!-- active -->
              <div class="text-center stepnumber">Step 3</div>
              <div class="progress-line">
              <div class="progress">
                <div class="progress-bar"></div>
              </div>
              <a href="#" class="step-dot"></a> 
              </div>
               </div>
          </div>
          <h1 class="badges-title text-center">Review Your Order</h1>
           <div class="row cart-note-row">
           	<div class="col-xs-12 cart-note-col text-center">
            	<div class="well">
                <strong>Review Your Order</strong><br>
                Please check the details below are correct before continuing to checkout.
                </div>
            </div>
           </div>
           <div class="row cart-badge-row">
           	@if($get_cart)
           	@foreach($get_cart as $result)
            <div class="col-md-12 col-sm-12 col-xs-12 badge-col text-center">
            	<div class="well">
                <a style="cursor: pointer;" class="pull-right delete_cart_item" data-cart_id="{{$result['cart_id']}}"><img height="15" width="15" src="{{url('public/uploads/delete.png')}}"></a>
                  <div class="col-md-6 col-sm-12">
                    <div class="single-price">
                      <div class="price-header">
                        <div class="col-xs-6">
                        <h3 class="title">{{$result['darts_set']}} SETS</h3>
                        </div>
                        <div class="col-xs-6">
                          @php
                          for($set = 1;$set <= $result['darts_set']; $set ++)
                          {
                          @endphp
                          <img src="{{url('public/uploads/bottle.png')}}" alt="selected badge" class="bottle-img">
                          @php
                          }
                          @endphp
                      </div>
                      </div>
                      <div class="price-value">
                        <div class="value">
                          <span class="currency">£</span> <span class="amount">
                            {{$result['amount_prefix']}}.<span>{{$result['amount_sufix']}}</span></span> <span class="month">/month</span>
                        </div>
                      </div>
                      <ul class="deals">{!!$result['description']!!}</ul>
                    </div>
                  </div>
                  <div class="badge-total">
                    <table class="table">
                        <tbody>
                            <tr>
                               <th>Package Name:</th>
                               <td>{{$result['darts_set']}} SETS</td>
                            </tr>

                            <tr>
                               <th>1st Weight:</th>
                               <td>{{$result['sort_1']}}</td>
                            </tr>
                            <tr>
                               <th>2nd Weight:</th>
                               <td>{{$result['sort_2']}}</td>
                            </tr>
                            <tr>
                               <th>3rd Weight:</th>
                               <td>{{$result['sort_3']}}</td>
                            </tr>

                            <tr>
                              <th>Subtotal:</th>
                              <td>£{{number_format($result['subtotal'],2)}}</td>
                            </tr>

                            <tr>
                              <th>Deposit:</th>
                               <td>£{{number_format($result['deposit_cost'],2)}}</td>
                            </tr>

                            @if(@$result['discount_percent'] > 0)
                            <tr>
                              <th>Qty Discount:</th>
                              <td>{{$result['discount_percent']}} %</td>
                            </tr>
                            @endif
                            <tr>
                              <th>Total:</th>
                              <td>£{{number_format($result['original_total'],2)}}</td>
                            </tr>
                        </tbody>
                    </table>
                 </div> 
              </div>
              <p class="agree_checked col-md-6"><input type="checkbox" name="agree" id="agree_term_condictions" value=""> I have read and agreed to the <a style="text-decoration: underline;" target="_blank" href="{{url('terms-and-condition')}}">terms and conditions</a></p>
              <a href="{{url('checkout')}}" class="btn order-col pull-right">Complete Subscription <em class="fa fa-chevron-circle-right"></em></a>
            </div>
            @endforeach
            @endif
           </div>
           <!-- <div class="cart-button-row">
           	 <div class="row">
                <div class="col-sm-12 col-xs-12 button-col order-col text-right">
                	<a href="{{url('checkout')}}" class="btn button-col">Complete Subscription <em class="fa fa-chevron-circle-right"></em></a>
                </div>
              </div>
           </div> -->
      </form>
    </div>
  </div>
</div>
</div>
{{-- Footer Content --}}
@include('user.customer.footer-customer')
{{-- Footer Content End  --}}
@endsection
@section('javascript')
 <script src="{{asset('assets/customer/assets/js/customform.js')}}"></script>
@endsection