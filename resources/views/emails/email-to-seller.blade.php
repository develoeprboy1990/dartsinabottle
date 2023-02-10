@extends('emails.email-layout')
@section('content')
	 <tr>
      <td bgcolor="#ffffff" style="padding: 40px 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555; width:100%; max-width:600px;"><p style="margin: 0;"> <strong>Hi {{$firstname}} {{$lastname}},</strong><br>

	<p>Congratulations! You sold some darts on dartsinabottle.com<br></p>

	<p>You sold: <br>
		<table>
		<tr>
			<td style="width: 30%;"><img src="{{$product_picture}}" width="100" height="100" alt="alt_text" border="0"></td>
			<td style="width: 70%;">Title: <span style="text-decoration:underline;">{{$product_name}}</span><br>
			Weight: <span style="text-decoration:underline;">{{$product_weight}}</span><br>
			Price: <span style="text-decoration:underline;">£{{$product_price}}</span><br>
			Finder's Fee: <span style="text-decoration:underline;">£{{$seller_fee}}</span><br>
			Total: <span style="text-decoration:underline;">£{{$seller_total}}</span></td>
		</tr>
	</table>
	</p>
	<p>Please allow 24 hours for the funds to be transferred via PayPal.</p>
	<p>Remember, you can send additional sets to us at any time. They will be shared with our users and you can set a price to sell them for.</p>
@endsection