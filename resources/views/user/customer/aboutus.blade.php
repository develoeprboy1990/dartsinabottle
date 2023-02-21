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
        </div>
        <div class="col-xs-4 about-page">
            <img src="{{url('public/uploads/dob-pic.jpg')}}" alt="selected badge" class="img-responsive">
            <h3 class="img-text">
                A darts themed birthday
            </h3><br>
            <img src="{{url('public/uploads/best-pose.jpg')}}" alt="selected badge" class="img-responsive">
            <h3 class="img-text">
                My best checkout, but not my best pose!
            </h3>
        </div>
        
        <div class="col-xs-8 about-page">
            I'm Robert, the creator of this website. I live and work in Beijing, having moved here in 2016. I'm the captain of a local pub team called Plan B, which plays in the Beijing International Darts League. About a year ago, I came up with the idea of darts in a bottle.<br><br>

I was spending a lot of time looking at darts online (they are even more overpriced in China!) and finding the 'right' set was becoming a bit of an obsession. I would spend hours looking for darts, add them to my 'favourites', buy them, and then soon realise they were not for me! The most vivid experience I remember is a set of Target Swiss points. I was sure they would suit me well, but within a few throws, I'd realised they were too grippy and the points were too fragile. That would have been about 70 pounds down the drain. Luckily, I managed to sell them to my friend Russ who works as a designer (he actually designed this homepage) just because he liked the packaging!<br><br>

One day I came up with the idea of a 'lovefilm' kind of website, but for darts. I had about 10 sets of darts at that point, and I decided I would be happy to share a set if it meant I could try others for a small monthly fee. I hope you agree it is a good way of not letting barrels go to waste, and for roughly a siz pounds a month, you get to try other sets (£24.99 for 4 sets a month).<br><br>

I strived to create a website where people are relaxed about sending a set of barrels in, safe in the knowledge that they could either sell them, get them back again when cancelling or if another user was dishonest, they would be compensated up to the tune of £40. You may notice that our terms and conditions are long, but it is to protect YOU the user, just as much as us.<br><br>

<h3> <b>Q & A</b> </h3>

What's your best checkout? <br>
A 156 against a Chinese friend in a best of 3 legs game. It was for the match!<br><br>

What sets do you use?<br>
Target Vapor 8 24g and occasionally Unicorn James Wade 20.5g.<br><br>

Is the Beijing International Darts League any good?<br>
Not really! There are a few good teams and several decent players, but for the most part it's an average level.<br><br> 

Favourite darting memory?<br>
Taylor beating MvG in 2013.
        </div>
    </div>
</div>
{{-- Footer Content --}}
@include('user.customer.footer-customer')
{{-- Footer Content End  --}}
@endsection