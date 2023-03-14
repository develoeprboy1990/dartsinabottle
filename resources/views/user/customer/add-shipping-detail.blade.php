@extends('user.customer.customer-layout')
@section('title','Add Shipping Detail')


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

    @if(Session::has('errormessage'))
    <div class="alert alert-danger alert-dismissable">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
     {{Session::get('errormessage')}}
   </div>
   @endif

    <div class="row">
      <div class="col-xs-12 checkout-form-col">
        <form class="" id="shipping_detail_form" method="post" action="{{url('add-shipping-detail')}}">
            
          {{csrf_field()}}  
          
          <div class="row checkout-field-row">
        
            <fieldset class="col-xs-12 checkout-fields-col">
            
            <h1 class="badges-title text-center"><em class="fa fa-user"></em>Shipping Details</h1>
              <div class="well">
                <div class="row">
                  
                  
                  <div class="col-sm-12 col-xs-12 form-group">
                    <label>Shipping Email*</label> 
                    <input type="email" name="shipping_email" id="shipping_email" class="form-control" value="{{$user->email}}" required="true">
                  </div>

                    <input type="hidden" name="country_id" id="shipping_country" class="form-control" value="United Kingdom" disabled="true" required="true"> 

                 <!--  <div class="col-sm-12 col-xs-12 form-group">
                    <label>Country*</label>
                    <select class="selectpicker form-control required" name="state_id" data-live-search="true"  title="Choose Country" id="shipping_state" required="true">
	                    @foreach($states as $state)
	                    <option value="{{$state->id}}">{{$state->name}}</option>
	                    @endforeach
		            </select>
                  </div>
                  -->
                
			      	
			         <!-- <span id="shipping_cities_div" style="display: none;"></span> -->
                  <div class="col-sm-12 col-xs-12 form-group">
                    <label>Address Line 1*</label> 
                    @if(@$shipping_detail->address != '' )
                    <input type="text" name="shipping_address" id="shipping_address" class="form-control" value="{{@$shipping_detail->address}}" required="true">
                    @else
                    <input type="text" name="shipping_address" id="shipping_address" class="form-control" value="{{ old('shipping_address') }}" required="true">
                    @endif
                    
                  </div>

                  <div class="col-sm-12 col-xs-12 form-group">
                    <label>Address Line 2</label> 
                     @if(@$shipping_detail->address_2 != '' )
                    <input type="text" name="shipping_address_2" id="shipping_address_2" class="form-control" value="{{@$shipping_detail->address_2}}" >
                     @else
                     <input type="text" name="shipping_address_2" id="shipping_address_2" class="form-control" value="{{ old('shipping_address_2') }}" >
                     @endif

                  </div>

                  <div class="col-sm-12 col-xs-12 form-group">
                    <label>Town/City*</label>
                     @if(@$shipping_detail->city_id != '' )
                    <input type="text" name="city_id" id="city_id" class="form-control" value="{{@$shipping_detail->city_id}}" required="true">
                    @else
                    <input type="text" name="city_id" id="city_id" class="form-control" value="{{ old('city_id') }}" required="true">
                    @endif
                  </div>

                  <div class="col-sm-12 col-xs-12 form-group">
                    <label>Postcode*</label> 
                  @if(@$shipping_detail->city_id != '' )
                  <input type="text" name="shipping_zip" id="shipping_zip" class="form-control" value="{{@$shipping_detail->zip}}" required="true">
                  @else
                  <input type="text" name="shipping_zip" id="shipping_zip" class="form-control" value="{{ old('shipping_zip') }}" required="true" >
                  @endif

                  </div>
                  <div class="col-sm-12 col-xs-12 form-group">
                    <label>Phone*</label> 
                    @if(@$shipping_detail->phone != '' )
                    <input type="text" name="shipping_phone" id="shipping_phone" class="form-control" value="{{@$shipping_detail->phone}}" required="true">
                    @else
                  <input type="text" name="shipping_phone" id="shipping_phone" class="form-control" value="{{ old('shipping_phone') }}" required="true" >
                  @endif
                  </div>  
                </div>                  
              </div>
              <div class="clearfix"></div>
              <div class="row checkout-btn-row">
                <div class="col-xs-6 checkout-btn pull-right text-right" >
                  <button type="submit" class="btn" id="submit_btn">Submit</button>
                </div>
              </div>
            </fieldset>
            
          </div>
        </form>

        {{-- Loader Modal --}}
        <div class="modal fade" id="loader_modal" role="dialog">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">

              <div class="modal-body">
                <h3 style="text-align:center;">Please wait</h3>

                <p style="text-align:center;"><img src="{{url('public/uploads/gif/waiting.gif')}}"></p>
              </div>

            </div>
          </div>
        </div>
        {{-- Loade Modal end --}}

      </div>
    </div>
  </div>
</div>
{{-- Footer Content --}}
@include('user.customer.footer-customer')
{{-- Footer Content End  --}}
@endsection	