@extends('user.customer.customer-layout')
@section('title','Get Started | Set Of Darts & Sell and Buy Darts | Dartsinabottle')
@section('description','Dartsinabottle offers to buy the best set of darts at reasonable prices and time duration. Here you can choose your required set of darts.')
@section('content')
{{-- Header Content --}}
@include('user.customer.header-customer')
{{-- Header Content End  --}}
<div class="container" style="margin-top:20px;margin-bottom:20px;">
  <div class="row">
    <div class="col-xs-12 badges-form-col">
      <form class="badges-form" action="{{ url('cart')}}" method="post">
        <!-- fieldset 1 start from here -->          
      

            <div class="form-btn-group text-center text-center">
              <a href="{{ url('browse')}}"><button type="button" class="btn btn-previous pull-left">&laquo; Previous</button></a>
            </div>
            <h1 class="badges-title text-center">{{$type}}</h1>

            <div class="row badges-row">              
              <div class="col-xs-12 badges-sizes text-center">
                 @foreach($products as $product) 
                <div class="col-md-4 col-sm-12 ">
                  <img src="{{url('public/uploads/darts_img/'.$product->product_image)}}" ></br>
                  {{$product->product_name}}
                </div>
                @endforeach
              </div>
            </div>
            <!-- <div class="form-btn-group text-center text-center">
              <a href="{{ url('browse')}}"><button type="button" class="btn btn-previous pull-left">&laquo; previous</button></a>
            </div> -->
        <!-- fieldset 1 end from here -->
      
        <!-- fieldset 2 start from here -->  
          <fieldset id="fieldset-1">        
          <div class="row bs-wizard" style="border-bottom:0;">
              <div class="col-xs-6 step-col complete">
                <div class="text-center stepnumber">Step 1</div>
                <div class="progress-line">
                <div class="progress">
                  <div class="progress-bar"></div>
                </div>
                <a href="#" class="step-dot"></a> 
                </div>
                </div>
              <div class="col-xs-6 step-col complete active"><!-- complete -->
                <div class="text-center stepnumber">Step 2</div>
                <div class="progress-line">
                <div class="progress">
                  <div class="progress-bar"></div>
                </div>
                <a href="#" class="step-dot"></a> 
                </div>
                </div>
            </div>
          
          <div class="form-btn-group text-center text-center">
              <button type="button" class="btn btn-previous pull-left">&laquo; Previous</button>
              <button type="submit" class="btn pull-right">Next &raquo;</button>
          </div>
            <h1 class="badges-title text-center">Which weights would you like?</h1>
            <h3 class="text-center">(Choose in your order of preference.)</h3>
            <!-- <h3 class="text-center">Please choose your preferred weights before clicking next</h3> -->
            <div class="row badges-row">
              <div class="col-md-8 col-sm-8 col-xs-7 badges-color">

                <div class="col-md-4 col-sm-12 weight" data-weight_id="Light">
                  <div class="single-weight">
                  <div class="price-header"><h3 class="title"></h3></div>
                  <div class="price-value">
                    <div class="value">
                      <span class="amount" >Light</span> <span class="month">12-18g</span>
                    </div>
                  </div>
                  <ul class="deals"></ul>
                </div>
                </div>
                <div class="col-md-4 col-sm-12 weight" data-weight_id="Medium">
                  <div class="single-weight">
                  <div class="price-header"><h3 class="title"></h3></div>
                  <div class="price-value">
                    <div class="value">
                      <span class="amount">Medium</span> <span class="month">19-22g</span>
                    </div>
                  </div>
                  <ul class="deals"></ul>
                </div>
                </div>
                <div class="col-md-4 col-sm-12 weight" data-weight_id="Heavy">
                  <div class="single-weight">
                  <div class="price-header"><h3 class="title"></h3></div>
                  <div class="price-value">
                    <div class="value">
                      <span class="amount">Heavy</span> <span class="month">23g+</span>
                    </div>
                  </div>
                  <ul class="deals"></ul>
                </div>
                </div>


              </div>

              <div class="col-md-4 col-sm-4 col-xs-5 selected-row color-badge">
            
                <div class="single-weight" id="package_preview" style="cursor: default;">
                  <div class="price-header">
                <div class="col-xs-6">
                <h3 class="title">2 SETS</h3>
                </div>
                <div class="col-xs-6">
                  <img src="{{url('public/uploads/bottle.png')}}" alt="selected badge" class="bottle-img">
                </div>
              </div>
                  <div class="price-value">
                <div class="value">
                  <span class="currency">£</span> <span class="amount">
                    14.<span>99</span></span> <span class="month">/month</span>
                </div>
              </div>
                  <ul class="deals">{!!@$package->description!!}</ul>
                </div>
            
              </div>
            
              <input type="hidden" name="sort_1" id="sort_1" value=""> 
              <input type="hidden" name="sort_2"  id="sort_2" value="">
              <input type="hidden" name="sort_3" id="sort_3" value=""> 
            </div>
            <div class="form-btn-group text-center text-center">
              <button type="button" class="btn btn-previous pull-left">&laquo; previous</button>
              <button type="submit" class="btn pull-right">Next &raquo;</button>
            </div>
          </fieldset>
        <!-- fieldset 2 end from here -->
      </form>
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