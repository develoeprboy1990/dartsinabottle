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
                <div class="lable">How it works</div>
                <div class="content">
                    dartsinabottle is a unique service that shares our own barrels and our user’s barrels around, based purely on weight preference.<br>
                    To join our community of darts-sharing fans, you need to:
                    <ul>
                        <li class="li-text">
                            have a set of tungsten barrels you are willing to share
                        </li>
                        <li class="li-text">
                            pay a deposit (which is returned when you end your subscription)
                        </li>
                        
                    </ul>
                </div>
            </div>
            <div class="contentBx">
                <div class="lable">Quality of barrels</div>
                <div class="content">
                    All the barrels we share on dartsinabottle are tungsten. This is to ensure that we offer a quality service. The barrels we have from our own stock are tungsten, and we ask that our users send the same. If you send a set made of another material, we will not start your subscription until we receive a tungsten set.
                </div>
            </div>
            <div class="contentBx">
                <div class="lable">Deposits</div>
                <div class="content">
                    We request that each user pays a £40 deposit for the following reasons:<br>
                    <ul>
                    <li class="li-text">It helps to ensure that all users are trustworthy</li>
                    <li class="li-text">It encourages users to send in good-quality barrels</li>
                    <li class="li-text">If barrels go missing while in the possession of another user, we can compensate you</li>
                    </ul>
                </div>
            </div>
            <div class="contentBx">
                <div class="lable">Subscription</div>
                <div class="content">
                During the signing up process you need to do the following:<br>
                <ul>
                <li class="li-text">select two sets or four sets every month</li>
                <li class="li-text">Choose your weight preference in order (between light, medium and heavy)</li>
                </ul>
                We will do our best to ensure that your choice is met. For example, if you choose light, medium, heavy, we will send you a set of light barrels, unless you have already been sent all of the available light sets. In that instance, you would be sent a medium set as it is your 2nd choice of weight.

                </div>
            </div>
            <div class="contentBx">
                <div class="lable">Sending/Receiving</div>
                <div class="content">
                    <ul>
                        <li class="li-text">
                            <b>Sending my own barrels</b> <br>
                            After you subscribe, we will send out a prepaid Self-Addressed Envelope containing a bottle and cork. Insert the barrels into the cork, place it inside the bottle and return to us at your earliest convenience. Please ensure you obtain a proof of postage certificate from your local post office, and keep it safe until your next set of barrels has been sent out. 
                        </li>
                        <li class="li-text">
                            <b>How long before I receive my first set? </b><br>
                            Around 5-8 days. In order to receive your first set, you must send your own barrels first following the process above. When your barrels have been received and processed, we send out your first set. If you delay in sending us your barrels, the time will increase.  
                        </li>
                        <li class="li-text">
                            <b>How do I return darts?</b><br>
                            It is the same process as sending your own barrels in. Every time we send you darts in a bottle, we also send a prepaid self-addressed envelope. Simply insert the used barrels into the cork, place inside the bottle and return to us in the envelope provided, obtaining a proof of postage certificate from your Post Office. 
                        </li>
                    </ul>
                </div>
            </div>
            <div class="contentBx">
                <div class="lable">Sending extra sets</div>
                <div class="content">
                    <ul>
                        <li class="li-text">
                            <b>Why?</b><br>
                            One feature of dartsinabottle.com is the ability to buy and sell sets of barrels. If you would like to try and sell more sets, you may post them to us. Once they have been received and processed, you can set a price for them on the ‘Lent Darts’ page of our website. The barrels are shared with our other users, and they have the option to purchase them.
                        </li>
                        <li class="li-text">
                            <b>How?</b><br>
                            If you would like to send additional sets please post them to: <br>
                            St. Aidan's Crescent<br>
                            Annfield Plain<br>
                            DH9 7UT<br>
                        </li>
                        <p class="li-text">
                            <b> Please note we do not send out a pre-paid envelope for sending in additional sets. You must pay the postage and packaging costs yourself.</b> However, if a user purchases your barrels you do not need to pay any more postage and packaging costs, as they are already in the hands of whoever wants them! 
                        </p>
                    </ul>
                </div>
            </div>
            <div class="contentBx">
                <div class="lable">Buying/Selling</div>
                <div class="content">
                    <ul>
                        <li class="li-text">
                            <b>How do I buy a set I like?</b><br>
                            Found a set you like? Great! Go to the ‘My Darts/‘Current Darts’ page and click the ‘Buy Darts’ button. You will be redirected to PayPal to complete the purchase. Once paid for, you do not need to return those barrels. The user selling them will be notified of the purchase. If you have any sets remaining in your monthly subscription we will send them out. (barrels only, no pre-paid envelope) Please use the prepaid envelope from the set you bought to return the following one. 
                        </li>
                        <li class="li-text">
                            <b>How do I receive money for selling my barrels?</b><br>
                            When setting a price for your lent barrels, you are asked to enter a PayPal email address. We transfer the funds to you using the address entered. Please allow 24 hours for the money to be transferred. 
                        </li>
                    </ul>
                </div>
            </div>
            <div class="contentBx">
                <div class="lable">Cancelling Subscription</div>
                <div class="content">
                Cancel your subscription from the My Darts/My Subscriptions page, by clicking the action icon and then the Cancel Subscription button. You will then receive an email informing you of what needs to be done in order for us to fully close your account.<br>
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