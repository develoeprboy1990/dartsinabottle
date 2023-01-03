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
                <div class="col-md-4 col-sm-12" style="margin-bottom: 30px;">
                  <a href="{{url('public/uploads/darts_img/'.$product->product_image)}}"  data-fancybox="images" data-caption="{{@$product->product_name}}">
                    <img src="{{url('public/uploads/darts_img/'.$product->product_image)}}" height="300px" width="300px" ></a></br>
                  <b>{{@$product->product_name}}</b><br>
                  {!!@ $product->product_description!!}<br>
                  {{@$product->product_weight}} g<br>
                  
                </div>
                @endforeach
              </div>
            </div>
        
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