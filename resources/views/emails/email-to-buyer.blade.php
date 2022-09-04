@extends('emails.email-layout')
@section('content')
	 <tr>
      <td bgcolor="#ffffff" style="padding: 40px 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555; width:100%; max-width:600px;"><p style="margin: 0;"> <strong>Hi {{$firstname}} {{$lastname}},</strong><br>

	<p>Congratulations. You must have found a set of darts that talk to you! Thank you for your purchase.<br></p>

	<p>You bought: <br>
	<table>
		<tr>
			<td style="width: 30%;"><img src="{{$product_picture}}" width="100" height="100" alt="{{$product_name}}" border="0"></td>
			<td style="width: 70%;">Title: <span style="text-decoration:underline;">{{$product_name}}</span><br>
			Weight: <span style="text-decoration:underline;">{{$product_weight}}</span><br>
			Price: <span style="text-decoration:underline;">£{{$product_price}}</span><br>
			Finder's Fee: <span style="text-decoration:underline;">£{{$buyer_fee}}</span><br>
			Total: <span style="text-decoration:underline;">£{{$buyer_total}}</span></td>
		</tr>
	</table></p>


<p>If you have any sets remaining in your current billing cycle, we will send your next dartsinabottle right away.<br><br>

If this set was the last set of your current billing cycle, please wait until your next one begins.<br><br>

<b>Please use the returns envelope you currently have to return your next set. </b></p>
@endsection