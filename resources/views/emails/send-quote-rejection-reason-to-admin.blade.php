@extends('emails.email-layout')
@section('title','Quote Details')
@section('content')
	
	
	<tr>
      <td bgcolor="#ffffff" style="padding: 40px 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555; width:100%; max-width:600px;"><p style="margin: 0;"> <strong>Hi Admin,</strong><br>

	<p><strong>Custom Badge Identification Number:</strong> {{$identification_number}}</p>
    <p><strong>Reason for Rejection:</strong> {{$reason_for_rejection}} </p>
    	   

	{{-- <p><a href="{{url('activate-account/'.$user_id.'/'.$activation_code)}}">Activate Email</a></p>	 --}}

	

@endsection