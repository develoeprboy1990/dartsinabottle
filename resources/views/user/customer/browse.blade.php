@extends('user.customer.customer-layout')
@section('title','Darts for Rent - Browse Our Selection | Dartsinabottle')
@section('metatitle','Darts for Rent - Browse Our Selection | Dartsinabottle')
@section('description','Browse our selection of darts available for rent at Dartsinabottle. We have a variety of darts to choose from at affordable prices.')
@section('content')
{{-- Header Content --}}
@include('user.customer.header-customer')
{{-- Header Content End  --}}
<style type="text/css">
  .single-weight .price-header{
    padding:0px 0px 86px;
  }
  .single-weight .value{
    padding: 32px 0px 0px 0px;
  }
</style>
<div class="container" style="margin-top:20px;margin-bottom:20px;">
  <div class="row">
    <div class="col-xs-12 badges-form-col">
      <form class="badges-form" action="{{ url('cart')}}" method="post">
        <!-- fieldset 1 start from here -->          
            <h1 class="badges-title text-center">Darts for Rent</h1>

            <div class="row badges-row">              
              <div class="col-xs-12 badges-sizes text-center">
                 <p class="about-page">At Dartsinabottle, we offer a wide selection of darts available for rent. Our darts are made from high-quality materials that ensure durability and accuracy. We have a variety of light, medium, and heavy darts that cater to all skill levels. Browse our website to find the perfect dart/sets for your next game. We are committed to providing quality darts at affordable prices.</p>
                <a href="browse/Light/sortby_W_ASC">
                  <div class="col-md-4 col-sm-12 " data-weight_id="Light" >
                  <div class="single-weight light-choice">
                  <div class="price-header"><h3 class="title"></h3></div>
                  <div class="price-value">
                    <div class="value">
                      <span class="amount" >Light</span> <span class="month">12-18g</span>
                    </div>
                  </div>
                  <ul class="deals"><li><h3 class="title">{{$light_products}} SETS</h3></li></ul>
                </div>
                </div>
                </a>

                <a href="browse/Medium/sortby_W_ASC">
                  <div class="col-md-4 col-sm-12 " data-weight_id="Medium">
                  <div class="single-weight medium-choice">
                  <div class="price-header"><h3 class="title"></h3></div>
                  <div class="price-value">
                    <div class="value">
                      <span class="amount">Medium</span> <span class="month">19-22g</span>
                    </div>
                  </div>
                  <ul class="deals"><li><h3 class="title">{{$medium_products}} SETS</h3></li></ul>
                </div>
                </div>
                </a>

                <a href="browse/Heavy/sortby_W_ASC">
                <div class="col-md-4 col-sm-12 " data-weight_id="Heavy">
                  <div class="single-weight heavy-choice">
                  <div class="price-header"><h3 class="title"></h3></div>
                  <div class="price-value">
                    <div class="value">
                      <span class="amount">Heavy</span> <span class="month">23g+</span>
                    </div>
                  </div>
                  <ul class="deals"><li><h3 class="title">{{$heavy_products}} SETS</h3></li></ul>
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