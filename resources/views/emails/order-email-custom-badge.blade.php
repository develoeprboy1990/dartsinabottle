@extends('emails.email-layout')
@section('content')

	 <tr>
      <td bgcolor="#ffffff" style="padding: 40px 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555; width:100%; max-width:600px;"><p style="margin: 0;"> <strong>Hi {{$firstname}} {{$lastname}},</strong><br>


    <p>Thank you for placing your order with Badge Buddies. Order Details are below.</p>
    <p>Order#: <strong>{{$order_number}}</strong></p>
    <p>Badge Identification#: <strong>{{$badge_identification_number}}</strong></p>

    <h3>Shipping Details</h3>
    <hr>
    <p><strong>Shipping Email:</strong> {{$shipping_email}}</p>
    <p><strong>Shipping Address:</strong> {{$shipping_address}}</p>
    <p><strong>Shipping Country:</strong> {{$shipping_country}}</p>
    <p><strong>Shipping State:</strong> {{$shipping_state}}</p>
    <p><strong>Shipping City:</strong> {{$shipping_city}}</p>
    <p><strong>Shipping Phone:</strong> {{$shipping_phone}}</p>
    
    <p><strong>Shipping Zip:</strong> {{$shipping_zip}}</p>


    <h3>Billing Details</h3>
    <hr>
    <p><strong>Billing Email:</strong> {{$billing_detail->email}}</p>
    <p><strong>Billing Address:</strong> {{$billing_detail->address}}</p>
    <p><strong>Billing Country:</strong> {{@$billing_detail->getCountry->name}}</p>
    <p><strong>Billing State:</strong> {{@$billing_detail->getState->name}}</p>
    <p><strong>Billing City:</strong> {{@$billing_detail->getCity->name}}</p>
    <p><strong>Billing Phone:</strong> {{$billing_detail->phone}}</p>
    <p><strong>Billing Zip:</strong> {{$billing_detail->zip}}</p>

	<h3>Ordered Items</h3>
	<hr>
	
	<p><strong>Weight of One Badge:</strong> {{$weight_of_one_badge}}</p>
	<p><strong>Ordered Quantity:</strong> {{$ordered_quantity}}</p>

	<hr>
	

	<h3>Payment Type</h3>
	<p>{{$payment_type}}</p>

	<h3>Total Weight of Badges</h3>
	<p>{{$total_weight_of_products}} Oz</p>

	<h3>Your Bill</h3>
	<p><strong>Shipping Cost:</strong> ${{$total_ship_cost}}</p>
	{{-- <p><strong>Original Total:</strong> ${{$original_total}}</p> --}}

	<p><strong>Total with Shipping Cost: </strong> ${{$final_total_with_shipping_cost}}</p>
@endsection
