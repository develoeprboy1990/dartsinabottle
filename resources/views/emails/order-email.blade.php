@extends('emails.email-layout')
@section('content')

	 <tr>
      <td bgcolor="#ffffff" style="padding: 40px 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555; width:100%; max-width:600px;"><p style="margin: 0;"> <strong>Hi {{$firstname}} {{$lastname}},</strong><br>


	<p>You have successfully subscribed to dartsinabottle.com</p>

	<p>Your order reference number is <strong>{{$order_number}}</strong></p>

	@if($choice =='Lend')
	<p>We will now send you a plastic bottle with a cork and a pre-paid envelope. When it arrives, please insert the points of your barrels into the cork and place it securely into the bottle. Return the envelope with your dartsinabottle at your earliest convenience.</p>

	<p>Once we receive your barrels you will be notified by email. Your barrels will then be viewable in the ‘My Darts/Lent barrels’ section of the website.</p>

	<p>You may then choose your first dartsinabottle from the ‘Browse’ page.</p> 
	@else
	<p>Choose your first set of barrels from the ‘Browse’ page or by clicking <a href="{{url('login')}}" target="_blank" style="text-decoration:underline;">here</a>. We hope you enjoy using our service.</p>
	@endif

    <p>Details are below.</p>

    <h3>Shipping Details</h3>
    <hr>
    <p><strong>Shipping Email:</strong> {{$shipping_email}}</p>
    <p><strong>Shipping Address Line 1:</strong> {{$shipping_address}}</p>
    <p><strong>Shipping Address Line 2:</strong> {{$shipping_address_2}}</p>
    <p><strong>Shipping Town/City:</strong> {{$shipping_city}}</p>
    <p><strong>Shipping Postcode:</strong> {{$shipping_zip}}</p>
    <p><strong>Shipping Phone:</strong> {{$shipping_phone}}</p>
    

    <h3>Billing Details</h3>
    <hr>
    <p><strong>Billing Email:</strong> {{$billing_detail->email}}</p>
    <p><strong>Billing Address Line 1:</strong> {{$billing_detail->address}}</p>
    <p><strong>Billing Address Line 2:</strong> {{$billing_detail->address_2}}</p>
    <p><strong>Billing Town/City:</strong> {{@$billing_detail->city_id}}</p>
    <p><strong>Billing Postcode:</strong> {{$billing_detail->zip}}</p>
    <p><strong>Billing Phone:</strong> {{$billing_detail->phone}}</p>

	<h3>Package Details</h3>
	<hr>
	@foreach($email_products_array as $result)
	<p><strong>Package:</strong> {{$result['package_id']}}</p>
	@if( $choice == 'Lend')
		<p><strong>You Chose:</strong>Lend + Deposit</p>
	@else
		<p><strong>You Chose:</strong>Deposit Only</p>
	@endif
	{{--<p><strong>Original Total:</strong> £{{number_format($result['product_original_total'],2)}}</p>
	<p><strong>Discounted Total:</strong> £{{number_format($result['product_discounted_total'],2)}}</p>--}}
	<hr>
	@endforeach

	<h3>Payment Type</h3>
	<p>{{$payment_type}}</p>

	<h3>Your Bill</h3>
	<p><strong>Sub Total:</strong> £{{number_format($discounted_total,2)}}</p>
	<p><strong>Deposit + Handling Fee:</strong> £{{number_format($oneTimeFee,2)}}</p>
	<p><strong>Total:</strong> £{{number_format($discounted_total+$oneTimeFee,2)}}</p>
@endsection