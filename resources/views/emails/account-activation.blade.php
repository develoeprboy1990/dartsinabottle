@extends('emails.email-layout')
@section('title','Account Activation')
@section('content')

	<tr>
      <td bgcolor="#ffffff" style="padding: 40px 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555; width:100%; max-width:600px;"><p style="margin: 0;"> <strong>Hi {{$firstname}} {{$lastname}},</strong><br>

	
    <p>Your Login Details are: </p>

	<p>Username: <b>{{$email}}</b> </p>

	<p>Password: <b>{{$password}}</b></p>

	<p><a href="{{url('activate-account/'.$user_id.'/'.$activation_code)}}">Activate Email</a></p>	

	

@endsection