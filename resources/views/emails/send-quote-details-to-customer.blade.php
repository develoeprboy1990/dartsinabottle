@extends('emails.email-layout')
@section('title','Quote Details')
@section('content')
	
	<tr>
      <td bgcolor="#ffffff" style="padding: 40px 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555; width:100%; max-width:600px;"><p style="margin: 0;"> <strong>Hi {{$firstname}} {{$lastname}},</strong><br>

	<p>Custom Badge Identification Number: {{$identification_number}}</p>
    <p>Your Quote Details are: </p>
    <p>Price of One Badge: ${{$price_of_one_badge}}</p>
    <p>Weight of One Badge: {{$weight_of_one_badge}} Oz</p>
    <p>Total Bill: ${{$total_bill}}</p>
    <p>Description: {!!$description!!}</p>

    {{--  <a href="{{url('custom-badge/'.$identification_number.'/checkout')}}">Accept Quote</a>
     <a href="#">Reject Quote</a>	 --}}	

	{{-- <p><a href="{{url('activate-account/'.$user_id.'/'.$activation_code)}}">Activate Email</a></p>	 --}}

	

@endsection