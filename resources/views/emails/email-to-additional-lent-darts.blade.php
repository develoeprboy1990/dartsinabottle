@extends('emails.email-layout')
@section('content')
	 <tr>
      <td bgcolor="#ffffff" style="padding: 40px 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555; width:100%; max-width:600px;"><p style="margin: 0;"> <strong>Hi {{$firstname}} {{$lastname}},</strong><br>

	<p>Your additional set of lent darts have been added to our system.<br></p>

	<p>You sent: <br>
	<table>
		<tr>
			<td style="width: 30%;"><img src="{{$product_picture}}" width="100" height="100" alt="{{$product_name}}" border="0"></td>
			<td style="width: 70%;">Title: <span style="text-decoration:underline;">{{$product_name}}</span><br>
			Weight: <span style="text-decoration:underline;">{{$product_weight}}</span><br>
			Price: <span style="text-decoration:underline;">{{$product_price}}</span><br>
		</tr>
	</table></p>
	
<p>You can set a price to sell them for in your ‘My Darts’ page.<br><br>

Thank you for supporting dartsinabottle with extra tungsten!<br><br>

<a href="{{url('terms-and-condition')}}" target="_blank" style="text-decoration:underline;">*Terms and Conditions</a> apply. </p>
@endsection