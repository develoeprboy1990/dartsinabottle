@extends('user.customer.customer-layout')
@section('title','Thankyou')
@section('content')
{{-- Header Content --}}
@include('user.customer.header-customer')
{{-- Header Content End  --}}
<!--deposit only customers-->
<div class="wrapper">
<div class="container" style="margin-top:5%;">
  <div class="row">
        <div class="jumbotron" style="box-shadow: 2px 2px 4px #000000;">
            <h2 class="text-center">Thank you for placing an order.</h2>
            <center>
              <div class="btn-group" style="margin-top:50px;">
                <a href="{{ url('browse')}}" class=" btn-lg btn-warning">BROWSE</a>
                <a href="{{url('dashboard')}}" class=" btn-lg btn-primary">My Darts</a>
              </div>
              <div class="btn-group" style="margin-top:50px;">
                <a href="{{url('/')}}" class=" btn-lg btn-default">Return to Homepage</a>
            </div>
          </center>
              <div class="btn-group" style="margin-top:50px;">
               <p> Thank you for subscribing to dartsinabottle<br>
Your order number is {{@$subscription->order_number}} and a confirmation email has been sent to {{@$subscription->getUser->email}}<br>
You can choose your first dartsinabottle from the ‘Browse’ button above.<br>
To choose future sets, access the ‘Browse’ page when you are logged in. <br><br>

If you would like to lend a set of barrels please send them to:<br><br>

37 Howieshill Road<br>
Cambuslang<br>
South Lanarkshire<br>
G72 8PW<br><br>

Once we receive them, you can set a price to sell them for under ‘My Darts/Lent Darts’. Your barrels would be shared with our other users and they would have the option to purchase them.</p>
            </div> 
            

        </div>
  </div>
</div>
{{-- Footer Content --}}
@include('user.customer.footer-customer')
{{-- Footer Content End  --}}
@endsection
@section('javascript')
@endsection