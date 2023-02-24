@extends('user.customer.customer-layout')
@section('title','FAQ | Lend Borrow Darts & Buy Barrels near Me | Dartsinabottle')
@section('description','Here you can get answers to the frequently asked questions about our services including selling and buying darts, Lend and Borrow Darts, and much more.')
@section('content')
{{-- Header Content --}}
@include('user.customer.header-customer')
{{-- Header Content End  --}}
<style type="text/css">
    .content{
        color: #1a449a;
    }
</style>
<div class="container">
    <div class="row faq-content">
        <h1 class="faq-txt">F.A.Q</h1>
        <hr>
        <div class="accordion">
            <div class="contentBx">
                <div class="lable">What is dartsinabottle?</div>
                <div class="content">
                    dartsinabottle is a unique service that lets you rent barrels. You can receive up to 2 or 4 sets every 30 days, one set at a time. You can play with a set for as long as you like, or return it for your next one. The barrels on our site are a mix of our own and others shared by our users.
                    <br>
                    To join our community, you need to pay a monthly subscription, and do one of the following two things:
                    <ul>
                        <li class="li-text">
                            Pay a deposit only of £50
                        </li>
                        <li class="li-text">
                            Pay a reduced deposit of £40 and lend us a set of barrels to be shared around
                        </li>
                        
                    </ul>
                </div>
            </div>
            <div class="contentBx">
                <div class="lable">What kind of barrels do you have?</div>
                <div class="content">
                    All of the barrels we share on dartsinabottle are tungsten alloys. We ask that any sets you lend are also of the same material. We have darts ranging from 12g in weight all the way up to 48g. You can view all of our sets on the ‘Browse’ page.
                </div>
            </div>
            <div class="contentBx">
                <div class="lable">Why do I need to pay a deposit?</div>
                <div class="content">
                    We request that each user pays a deposit for the following reasons:<br>
                    <ul>
                    <li class="li-text">It helps to ensure that users are as trustworthy as possible</li>
                    <li class="li-text">It encourages users to send in good-quality barrels</li>
                    <li class="li-text">You can be compensated should a set of your lent barrels go missing</li>
                    </ul>
                </div>
            </div>
            <div class="contentBx">
                <div class="lable">How do I subscribe?</div>
                <div class="content">
                Go to our ‘Game On’ page to start the signup process.<br>
                During the signing-up process you need to do the following:<br>
                <ul>
                <li class="li-text">Select two sets or four sets every month</li>
                <li class="li-text">Choose a way to secure your account (deposit only or reduced deposit + lend a set)</li>
                </ul>
                We accept payment via PayPal and all major credit/debit cards using Stripe. <br>
                If you pay a deposit only you are able to select your first set immediately from our ‘Browse’ page.<br>
                If you choose to pay a reduced deposit and lend us a set, we will send you an empty bottle and a pre-paid envelope. Once we have received your lent barrels in the provided bottle and envelope, you may choose your first set from the ‘Browse’ page. 
                </div>
            </div>
            <div class="contentBx">
                <div class="lable">How do I choose sets?</div>
                <div class="content">
                    Choose your next set from the ‘Browse’ page. Our barrels are divided into 3 weight ranges – light, medium and heavy. If a set is listed as ‘available’ you may select it. If a set is listed as ‘in use’, it is currently with another user and not available at the moment. After choosing a set you will be asked to confirm your selection, and you will be notified by email. 
                </div>
            </div>
            <div class="contentBx">
                <div class="lable">How do I return sets?</div>
                <div class="content">
                    All postage is done via Royal Mail. Return your current barrels in the provided bottle and prepaid envelope. We STRONGLY suggest you obtain a proof of postage certificate from your local post office. They will happily provide one if you ask. Please see our terms and conditions for more details.
                </div>
            </div>
            <div class="contentBx">
                <div class="lable">How do I buy sets?</div>
                <div class="content">
                You may purchase sets that you are currently in possession of via PayPal. These are referred to as your ‘Current Darts’ and can be found in the ‘My Darts’ dashboard. Navigate to that page and click the ‘Buy Darts’ button. You will be redirected to PayPal to complete the purchase.<br>
                Once paid for, you do not need to return those barrels. If you have any sets remaining in your monthly subscription, you may choose your next set immediately. Please use the prepaid envelope from the set you bought to return the following one.
                </div>
            </div>
            <div class="contentBx">
                <div class="lable">How do I sell sets?</div>
                <div class="content">
                Any sets you send to us can be listed for sale at no extra cost to you. When logged in, go to the ‘Lent Darts’ page which is accessible from the ‘My Darts’ dashboard. You may then set a price to sell your barrels for. These may be purchased by our other users, or by dartsinabottle.<br>
                When setting a price for your lent barrels, you are asked to enter a PayPal email address. Should you sell a set, we will transfer the funds via PayPal within 24 hours.<br>
                We charge a small handling fee of 8.5% - this is generally less than the commission that eBay takes. As well as a reduced commission, we do not charge a ‘listing’ fee.
                </div>
            </div>
            <div class="contentBx">
                <div class="lable">Can I send extra sets?</div>
                <div class="content">
                You may send us extra sets at any time to the address below. Please note that you will need to pay the postage. However, if a user chooses to buy them, you do not need to pay any extra postage fees as they are already in the hands of whoever bought them.<br>
                Please post additional sets to:<br>
                37 Howieshill Road<br>
                Cambuslang<br>
                South Lanarkshire<br>
                G72 8PW
                </div>
            </div>
            <div class="contentBx">
                <div class="lable">How do I cancel my account?</div>
                <div class="content">
                Cancel your subscription from the My Darts/My Subscriptions page, by clicking the ‘action’ icon and then the ‘Cancel Subscription’ button. You will then receive an email informing you of what needs to be done in order for us to fully close your account.<br>
                When you have followed the instructions in the email we will return any outstanding deposit and close your account.
                </div>
            </div>
            
        </div>
    </div>
</div>
<script>
const accordion = document.getElementsByClassName('contentBx');
for (i = 0; i < accordion.length; i++) {
    accordion[i].addEventListener('click', function() {
        $('.contentBx').not(this).removeClass('active');
        this.classList.toggle('active')

    })
}
</script>
{{-- Footer Content --}}
@include('user.customer.footer-customer')
{{-- Footer Content End  --}}
@endsection