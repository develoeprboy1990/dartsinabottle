@extends('user.customer.customer-layout')
@section('title','Contact')
@section('content')
{{-- Header Content --}}
@include('user.customer.header-customer')
{{-- Header Content End  --}}
<style>
.contact-content {
    color: #1a449a;
    margin: 10px 0px;
}

.contact-content h1 {
    text-align: center;
    /* font-size: 2.0rem; */
    text-transform: uppercase;
}

.contact-content a,
p {
    font-size: 2.0rem;
    text-align: center;
}

a:hover {
    text-decoration: underline;
}
</style>
<div class="container">
    <div class="row contact-content">
        <div class="col-xs-12">
            <h1> <b>Contact Us</b> </h1>
            <hr>
            <p>
                Help – <a href="#">customerservice@dartsinabottle.com</a> <br>
                Send additional sets <br>
                Please post your barrels to: <br>
                6 St. Aidans Crescent<br>
                Annfield Plain<br>
                DH9 7UT<br>
                Please include your name and email address As soon as we receive your barrels we will upload their details. You can then set a price in the ‘lent darts’ section of the website.
            </p>

        </div>
    </div>
</div>
{{-- Footer Content --}}
@include('user.customer.footer-customer')
{{-- Footer Content End  --}}
@endsection