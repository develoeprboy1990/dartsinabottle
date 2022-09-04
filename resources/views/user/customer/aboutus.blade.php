@extends('user.customer.customer-layout')
@section('title','Shop')
@section('content')
{{-- Header Content --}}
@include('user.customer.header-customer')
{{-- Header Content End  --}}
<div class="container">
    <div class="row">
        <div class="col-xs-12 about-page">
            <h1> <b>About Us</b> </h1>
            <hr>
            Creator <br>
            Robert Grant <br>
            I’m a British ex-pat living in Beijing. I started playing darts as a child and I currently play once a week
            in the Beijing International Darts League. The standard isn’t great, but it is a great time! <br> <br>
            I came up with the idea for dartsinabottle last year. Since I arrived in China I have spent a lot of time
            browsing shopping websites, seeing what barrels might be my next set. What I noticed though is that a set
            you think might be great isn’t always a good match in reality. With barrels ranging in price so much, it can
            be a risky business to buy new sets, and it can lead to disappointment as well as a smaller bank balance!
            <br><br>
            I wanted to create a place where people can send in unused or unloved barrels, and try ‘new’ sets in
            exchange. The end goal is that you find a set that really matches your game, whether they are old ones that
            you may never have considered or a newish set that you didn’t want to splash out on!
            <br><br><br>
            More about me – I have hit plenty of 180s, but I’m too inconsistent to be considered a properly good player,
            averaging around 45-55 most days. My highest checkout is a 156 that you can see below, and my best run of
            ‘perfect darts’ is 5, multiple times.
            <br><br><br>
            Business
            <br>
            Dartsinabottle.com is a family-run business, with our central location being in England.
            <br><br>
        </div>
        <div class="col-md-6 img-left">
            <img src="{{url('public/uploads/dob-pic.jpg')}}" alt="selected badge" class="owner-img img-responsive">
            <h3 class="img-text">
                A darts themed birthday
            </h3>
        </div>
        <div class="col-md-6 img-right">
            <img src="{{url('public/uploads/best-pose.jpg')}}" alt="selected badge" class="owner-img img-responsive">
            <h3 class="img-text">
                Not my best pose
            </h3>
        </div>
    </div>
</div>
{{-- Footer Content --}}
@include('user.customer.footer-customer')
{{-- Footer Content End  --}}
@endsection