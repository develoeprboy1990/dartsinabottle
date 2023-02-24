@extends('user.customer.customer-layout')
@section('title','GAME ON | Set Of Darts & Sell and Buy Darts | Dartsinabottle')
@section('description','Dartsinabottle offers to buy the best set of darts at reasonable prices and time duration. Here you can choose your required set of darts.')
@section('content')
{{-- Header Content --}}
@include('user.customer.header-customer')
{{-- Header Content End  --}}
<link rel="stylesheet" href="{{asset('assets/website/socicon/css/styles.css')}}">
<style type="text/css">
.mbr-iconfont-social {
  margin: 0.5rem;
  font-size: 32px;
  display: flex;
  border-radius: 50%;
  text-align: center;
  color: #ffffff;
  border: 2px solid #ffffff;
  justify-content: center;
  align-content: center;
  transition: all 0.3s;
  float: left;
padding: 6px;
}
.mbr-iconfont-social:hover {
  background-color: #ffffff;
  color: #000000;
}
[class^="socicon-"], [class*=" socicon-"] {
  font-family: 'Socicon' !important;
  speak: none;
  font-style: normal;
  font-weight: normal;
  font-variant: normal;
  text-transform: none;
  line-height: 1;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
</style>
<div class="container" style="margin-top:20px;margin-bottom:20px;">
  <div class="row">
    <div class="col-xs-12 badges-form-col">
      <form class="badges-form" action="{{ url('cart')}}" method="post">
        <!-- fieldset 1 start from here -->
          <fieldset id="fieldset-1">
          {{csrf_field()}}
          <div class="row bs-wizard" style="border-bottom:0;">
              <div class="col-xs-4 step-col complete active">
                <div class="text-center stepnumber">Step 1</div>
                <div class="progress-line">
                <div class="progress">
                  <div class="progress-bar"></div>
                </div>
                <a href="#" class="step-dot"></a> 
                </div>              
              </div>
              <div class="col-xs-4 step-col disabled"><!-- complete -->
                <div class="text-center stepnumber">Step 2</div>
                <div class="progress-line">
                <div class="progress">
                  <div class="progress-bar"></div>
                </div>
                <a href="#" class="step-dot"></a> 
                </div>
                </div>
              <div class="col-xs-4 step-col disabled"><!-- active -->
                <div class="text-center stepnumber">Step 3</div>
                <div class="progress-line">
                <div class="progress">
                  <div class="progress-bar"></div>
                </div>
                <a href="#" class="step-dot"></a> 
                </div>
                 </div>
            </div>
          
            <h1 class="badges-title text-center">How many sets would you like a month?</h1>
            <div class="row badges-row">
              
              <div class="col-xs-12 badges-sizes text-center">

                  @if(count($packages)>0)
                  @php
                    $i=1;
                  @endphp
                  @foreach($packages as $package)  
                  
                    @php
                    $array = explode('.', $package->price);
                    $give_active_class = '';
                    /* if($i ==1){
                      $give_active_class="active-img";
                    }
                    else{
                      $give_active_class="";
                    }   */ 
                    @endphp

          <div class="col-md-6 col-sm-12 package" data-package_id="{{$package->id}}">
            <div class="single-price">
              <div class="price-header">
                <div class="col-xs-6">
                <h3 class="title">{{$package->darts_set}} SETS</h3>
                </div>
                <div class="col-xs-6">
                  @php
                  for($set = 1;$set <= $package->darts_set; $set ++)
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
                    {{$array[0]}}.<span>{{$array[1]}}</span></span> <span class="month">/month</span>
                </div>
              </div>
              <ul class="deals">
                {!!$package->description!!}
              </ul>
            </div>
          </div>
                  @php
                    $i++;
                  @endphp
                  @endforeach
                  @endif
              </div>
            </div>
            <input type="hidden" name="package_id" id="package_id" value="">
            <div class="form-btn-group text-center">
              <button type="button" class="btn btn-next pull-right">Next &raquo;</button>
            </div>
          </fieldset>
        <!-- fieldset 1 end from here -->
      
        <!-- fieldset 2 start from here -->  
          <fieldset id="fieldset-2">        
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
              <div class="col-xs-4 step-col complete active"><!-- complete -->
                <div class="text-center stepnumber">Step 2</div>
                <div class="progress-line">
                <div class="progress">
                  <div class="progress-bar"></div>
                </div>
                <a href="#" class="step-dot"></a> 
                </div>
                </div>
              <div class="col-xs-4 step-col disabled"><!-- active -->
                <div class="text-center stepnumber">Step 3</div>
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
            <h1 class="badges-title text-center">How will you secure your account?</h1>
            <!-- <h3 class="text-center">(Choose in your order of preference.)</h3> -->
            <div class="row badges-row">
              <div class="col-md-8 col-sm-8 col-xs-7 badges-sizes text-center">

                <div class="col-md-6 col-sm-12 choice" data-choice_id="Lend">
                  <div class="single-weight">
                  <div class="price-header"><h3 class="title"></h3></div>
                  <div class="price-value">
                    <div class="value">
                      <span class="amount" >Lend &<br> deposit </span>
                    </div>
                  </div>
                  <ul class="deals">
                    <li>Share a set of barrels</li>
                    <li>£40.00 deposit</li>
                    <li>Both returned when you close your account</li>
                  </ul>
                </div>
                </div>
                <div class="col-md-6 col-sm-12 choice" data-choice_id="Deposit">
                  <div class="single-weight">
                  <div class="price-header"><h3 class="title"></h3></div>
                  <div class="price-value">
                    <div class="value">
                      <span class="amount">Deposit<br> only</span>
                    </div>
                  </div>
                  <ul class="deals">
                    <li>£50.00 deposit</li>
                    <li>Returned when you close your account</li>
                    <li>&nbsp;&nbsp;&nbsp;</li>
                  </ul>
                </div>
                </div>
                <div class="col-md-12 col-sm-12">
            <div class="form-btn-group text-center text-center">
             <div class="col-md-12 col-sm-12">
            <h4 class="text-center validate_next" style="text-align:left;">Choose to lend a set of barrels and pay a reduced deposit or pay a deposit only.</h4>
          </div>
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
                  <ul class="deals">{!!$package->description!!}</ul>
                </div>
            
              </div>
            
              <input type="hidden" name="choice_id" id="choice_id" value=""> 
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