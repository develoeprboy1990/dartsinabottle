@extends('emails.email-layout')
@section('content')
	 <tr>
      <td bgcolor="#ffffff" style="padding: 40px 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555; width:100%; max-width:600px;"><p style="margin: 0;"> <strong>Hello {{$firstname}} {{$lastname}},</strong><br>

	<p>We have received your barrels and they have been successfully added to our system.<br></p>

	<p>You sent: <br>
	<table>
		<tr>
			<td style="width: 30%;"><img src="{{$product_picture}}" width="100" height="100" alt="{{$product_name}}" border="0"></td>
			<td style="width: 70%;">Title: <span style="text-decoration:underline;">{{$product_name}}</span><br>
			Weight: <span style="text-decoration:underline;">{{$product_weight}}</span><br>
			Price: <span style="text-decoration:underline;">{{$product_price}}</span><br>
		</tr>
	</table></p>


<p>You can view them in the My Darts / Lent Darts section of our website.<br><br>

You may now choose your first dartsinabottle. Please log in to the site and go to the ‘Browse’ page or click <a href="{{url('login')}}" target="_blank" style="text-decoration:underline;">here</a>.<br><br>
@endsection