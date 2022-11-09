@extends('user.customer.customer-layout')
@section('title','FAQ | Lend Borrow Darts & Buy Barrels near Me | Dartsinabottle')
@section('description','Here you can get answers to the frequently asked questions about our services including selling and buying darts, Lend and Borrow Darts, and much more.')
@section('content')
{{-- Header Content --}}
@include('user.customer.header-customer')
{{-- Header Content End  --}}
<div class="container">
    <div class="row faq-content">
        <h1 class="faq-txt">F.A.Q</h1>
        <hr>
        <div class="accordion">
            <div class="contentBx">
                <div class="lable">How it works</div>
                <div class="content">
                    <ul>
                        <li class="li-text">
                            You choose 2 or 4 sets a month, then select your preferred weights between light, medium and heavy. After subscribing, we send you a self-addressed prepaid envelope and a bottle with a cork. You insert your barrels into the cork, place the cork inside the bottle and return it to us in the envelope. We weigh your barrels and register them on our system. At this point, you can set a price to sell your barrels for. We then send your first set of barrels to try, based on your weight preference. You can do one of 3 things – buy (if the lender has set a price), return them for a new set to try, or keep using them for however long you stay subscribed. Meanwhile, the set that you sent in is being shared with our other members. It’s an easy and convenient way to try, buy and sell barrels.
                        </li>
                    </ul>
                </div>
            </div>
            <div class="contentBx">
                <div class="lable">Quality of barrels</div>
                <div class="content">
                    <ul>
                        <li class="li-text">
                            At dartsinabottle.com we only accept tungsten barrels. Please be aware that any sets you send in must be made of tungsten. Most sets of new barrels these days are between 80-95% tungsten. If you send a set of brass barrels in or another kind of material we will notify you. You must then send in a set of tungsten barrels (at your own cost) in order for us to start sending the 2 or 4 sets in your monthly subscription.
                        </li>
                    </ul>
                </div>
            </div>
            <div class="contentBx">
                <div class="lable">Deposits</div>
                <div class="content">
                    <ul>
                        <li class="li-text">
                            <b>Why do I need to pay a deposit?</b> <br>
                            1) To give you peace of mind –  If you send in a set of barrels that go missing without proof of postage, or are maliciously damaged while in the possession of another member, we can use that person’s deposit to compensate you. The maximum compensation amount is £40.
                            <br>2) To ensure users are trustworthy – Darts can be expensive (and sentimental) things. Nobody wants to send in an expensive or treasured set of darts only for another person to keep them. By paying a deposit, you ensure that any malicious or untrustworthy acts can be kept to a minimum. We want to create a safe, enjoyable, and reliable experience for all of our members.
                            <br>3) To encourage all kinds of darts to be sent in – At dartsinabottle.com we would like to see all shapes, sizes, and values of barrels shared. By setting a deposit we hope people will be comfortable sending in any set of barrels, whether it’s a 6-year-old set they used to play with or a brand spanking new set they just can’t get on with!
                        </li>
                        <li class="li-text">
                            <b>How do I ensure my deposit is kept safe?</b><br>
                            Care for the barrels in your possession, and when returning them, please obtain a proof of postage slip from your local post office and keep it safe. This ensures you made every effort to return the barrels. If we don’t receive them we can then use the proof of postage to make a claim.
                        </li>
                        <li class="li-text">
                            <b>What can impact my deposit?</b><br>
                            Returning barrels with points that have been visibly bent.<br>
                            Returning barrels that have clearly been damaged.<br>
                            Only returning 1 or 2 barrels instead of 3.<br>
                            Returning different barrels to what you were sent. <br>
                        </li>
                        <li class="li-text">
                            <b>What about replaceable points like Target Swiss Point etc.?</b><br>
                            The cost for us to replace them would come out of your deposit. We understand they break more easily than a fixed point, so if you receive a set with such points please ensure you are throwing at  a board with a surround and a soft floor underneath.
                        </li>
                    </ul>
                </div>
            </div>
            <div class="contentBx">
                <div class="lable">Subscription</div>
                <div class="content">
                    <ul>
                        <li class="li-text">
                            <b>2 sets or 4?</b> <br>
                            A 2 sets per month subscription means you can receive up to 2 sets of different barrels every 30 days. If you like to take your time getting to know new barrels, adjusting your throw to get the best out of them, etc., or just don’t have a lot of time to play, then this is a good choice to make. 
                            <br>If you want to try up to 4 different sets of barrels per month, this is the choice to make. Maybe you are the kind of player that knows within a few throws whether a set suits you, and don’t want to spend time adjusting your throw. Or, you might just want to try as many different styles as possible to narrow down your preferred barrels going forward. Or, like us, you just love trying new barrels.

                        </li>
                        <li class="li-text">
                            <b>Choosing preferred weights</b><br>
                            When you subscribe you are asked to choose your barrels in order of preference between light, medium, and heavy. We will do our best to ensure that your choice is met. For example, if you choose light, medium, heavy, we will send you a set of light barrels, unless you have already been sent all of the available light sets. In that instance, you would be sent a medium set as it is your 2nd choice of weight. 
                        </li>
                        <li class="li-text">
                            <b>Why don’t you let me choose specific barrels?</b><br>
                            The driving idea of dartsinabottle.com is to find the darts that talk to you. To do that, we feel it is conductive to try different barrel shapes and different levels of grip. You may believe that a straight barrel is your ideal shape, but in truth, it may be a tapered one. You may believe that a low-level grip suits you best, but it could be a medium or high grip depending on other factors. By assigning barrels based purely on weight, you are likely to receive a set that you can easily find your ‘range’ with. There are countless shapes and grips within that range that may be the darts for you. We hope you will find them with our help! 
                        </li>
                        <li class="li-text">
                            <b>Cancelling Process</b><br>
                            1) Cancel your subscription from the My Darts/My Subscriptions page, clicking the action icon and then the Cancel Subscription button. You will then receive an email clearly informing you of what needs to be done in order for us to fully close your account, depending on what has happened to your ‘lent darts’ (sold/unsold), ‘current darts’ (in possession/bought/none in possession) and deposit amount remaining. If you have a deposit to be returned, the email will ask you to inform us of how you would like it paid back (PayPal or cheque).
                            <br>2) When you have followed the instructions in the email we will return your deposit and close your account.
                        </li>
                    </ul>
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
                            6 St. Aidans Crescent<br>
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