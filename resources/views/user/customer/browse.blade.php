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
            <h1 class="badges-title text-center">Browse</h1>
            <div class="row badges-row">              
              <div class="col-xs-12 badges-sizes text-center">
                <a href="browse/detail/Light">
                  <div class="col-md-4 col-sm-12 " data-weight_id="Light" >
                  <div class="single-weight light-choice">
                  <div class="price-header"><h3 class="title"></h3></div>
                  <div class="price-value">
                    <div class="value">
                      <span class="amount" >Light</span> <span class="month">12-18g</span>
                    </div>
                  </div>
                  <ul class="deals"><li><h3 class="title">6 SETS</h3></li></ul>
                </div>
                </div>
                </a>

                <a href="browse/detail/Medium">
                  <div class="col-md-4 col-sm-12 " data-weight_id="Medium">
                  <div class="single-weight medium-choice">
                  <div class="price-header"><h3 class="title"></h3></div>
                  <div class="price-value">
                    <div class="value">
                      <span class="amount">Medium</span> <span class="month">19-22g</span>
                    </div>
                  </div>
                  <ul class="deals"><li><h3 class="title">7 SETS</h3></li></ul>
                </div>
                </div>
                </a>

                <a href="browse/detail/Heavy">
                <div class="col-md-4 col-sm-12 " data-weight_id="Heavy">
                  <div class="single-weight heavy-choice">
                  <div class="price-header"><h3 class="title"></h3></div>
                  <div class="price-value">
                    <div class="value">
                      <span class="amount">Heavy</span> <span class="month">23g+</span>
                    </div>
                  </div>
                  <ul class="deals"><li><h3 class="title">6 SETS</h3></li></ul>
                </div>
                </div>
                </a> 
              </div>
            </div>
        <!-- fieldset 1 end from here -->
      
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