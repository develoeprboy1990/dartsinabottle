@extends('user.customer.customer-layout')
@section('title','Privay Policy')
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
        <div class="col-xs-12" >
            <h1> <b>TERMS AND CONDITIONS</b> </h1>
            <hr>
<p style="text-align:left;">Before using our website: PLEASE READ CAREFULLY THESE TERMS AND CONDITIONS OF USE.</p>

<p style="text-align:left;">These terms and conditions of use (hereinafter referred to as “Terms”) set forth the conditions of use of our website (hereinafter referred to as “site”) of dartsinabottle (hereinafter referred to as the “Company”).</p>

<p style="text-align:left;">By using this site, you agree to be legally bound between you and dartsinabottle (“company,” we,” us,” our”).</p>

<p style="text-align:left;">We refer to the barrels that you lend as LENT darts and the barrels you receive from other users as; -
<ul>
    <li>CURRENT darts (the barrels currently in your possession that we have sent you from other users LENT darts); and </li>
    <li>BORROWED darts (the barrels you have previously received from other users LENT darts and returned to us)</li>
</ul>
LENT darts must be tungsten barrels. We do not accept barrels of any other material or metal such as nickel silver or brass.</p>

<p style="text-align:left;">
    <b style="text-decoration: underline;">USE</b><br>
You shall use our site to connect with people who will send their own LENT darts in, and these darts will be shared with other users.<br>
We do not provide whole sets of darts. We only send out barrels. You will not receive any flights or stems from us.
</p> 

<p style="text-align:left;">
    <b style="text-decoration: underline;">PRIVACY POLICY</b><br>
You agree and acknowledge that you have read and understood our privacy policy, and you will adhere to the guidelines laid out.</p>

<p style="text-align:left;">
    <b style="text-decoration: underline;">REGISTRATION</b><br>
You will have to sign up and register, including your username, email address, and personalised password.</p>

<p style="text-align:left;">
    <b style="text-decoration: underline;">PAYMENT</b><br> 
Upon registration, you will choose your subscription plan. The cheapest plan is £14.99 a month (to borrow two sets a month, 30 days), and the most expensive one is £24.99 to borrow four sets a month.<br>
The payments shall be made via Paypal or Stripe.<br>
You will also need to pay a one-off payment of £40, which will be kept as your deposit.<br>
A handling fee is added to your initial payment. This is used for packaging costs.<br>
Your dartsinabottle membership will continue and automatically renew until terminated. <br>
To use dartsinabottle, you must have three functioning IDENTICAL (identical, meaning the same brand, model, and weight) tungsten barrels to lend and provide us with a Payment Method.<br>
Suppose payment is not successfully settled due to expiration, insufficient funds, or otherwise, and you do not cancel your account. In that case, we may suspend your access to the service until we have successfully charged a valid Payment Method.<br>
You must cancel your membership before it renews to avoid billing the membership fees to your Payment Method for the next billing cycle (see “Cancellation” below).</p>

<p style="text-align:left;">
    <b style="text-decoration: underline;">CANCELLATION POLICY</b><br>
    <span style="text-decoration: underline;">Cancellation:</span> You can start the process to cancel your dartsinabottle membership at any time. To start the cancellation process, log in to your account, go to the 'My Darts' page, click 'My Subscriptions’, and then 'Cancel Subscription’. <br>
After choosing to cancel, you must return any outstanding CURRENT darts in your possession. When we have received those darts and they have been checked to be in working condition, we will process the return of any outstanding deposit, cancel your monthly subscription and return your LENT darts to you after they are returned to us by whoever has them. <br>
WE ARE NOT RESPONSIBLE FOR DELAYS IN LENT DARTS BEING RETURNED. Should you cancel your subscription payment via Paypal or Stripe, you authorise us to keep your lent darts until you have returned those in your possession.<br>
<span style="text-decoration: underline;">Changes to the Price and Subscription Plans:</span> We reserve the right to change our subscription plans or adjust pricing for our service or any components thereof in any manner and at any time as we may determine in our sole and absolute discretion. Except as otherwise expressly provided in these Terms of Use, any price changes or changes to your subscription plan will take effect following your notice.</p>

<p style="text-align:left;">
    <b style="text-decoration: underline;">NO REFUNDS</b><br>
Payments are nonrefundable, and there are no refunds or credits for partially used membership periods or partially used sets of darts.</p>

<p style="text-align:left;">
    <b style="text-decoration: underline;">INTELLECTUAL PROPERTY</b><br>
You agree and acknowledge that the site and its elements are the company's property and are protected by copyright, trademark, and any other applicable laws.</p>

<p style="text-align:left;">
    <b style="text-decoration: underline;">LINKS TO OTHER THIRD-PARTY SITES</b><br>
Our services may contain links to other sites not operated by us, and these links may include the one used for payment processing. By clicking on the third-party links, you agree to their privacy policy and Terms and Conditions.</p>

<p style="text-align:left;">
    <b style="text-decoration: underline;">INDEMNIFICATION</b><br>
By using these services offered by us, you agree to hold harmless and indemnify the company from any claims, damages, liability, injury, or third-party claims arising from your use of our website in terms of any misuse of the site, breach of the terms of these terms or any violation of any law.</b>
<p style="text-align:left;">
    <b style="text-decoration: underline;">LIMITATION ON LIABILITY</b><br>
You agree that under no circumstances shall we be liable for any direct or indirect damages arising from the use of the site and the consequences thereof.</p>
<p style="text-align:left;">
    <b style="text-decoration: underline;">WARRANTIES</b><br> 
YOU ACKNOWLEDGE THAT BARRELS ARE PROVIDED “AS IS,” AND WE MAKE NO GUARANTEES OR WARRANTIES THAT THEY WILL ALWAYS FUNCTION WITHOUT IMPERFECTIONS OR DAMAGE, WHICH MAY RENDER THEM UNUSABLE. <br>
TO THE EXTENT PERMITTED BY LAW, WE DISCLAIM ALL WARRANTIES. WE CAN NOT GUARANTEE AGAINST ANY UNFORESEEN CIRCUMSTANCES THAT ARE BEYOND OUR CONTROL AND AGAINST ANY NEGLIGENCE CAUSED BY ANY THIRD PARTY.<br>
WE ALWAYS ATTEMPT TO PROVIDE A GREAT EXPERIENCE. STILL, WE DO NOT REPRESENT OR WARRANT THAT (A) THE SERVICES WILL ALWAYS BE DAMAGE-FREE AND (B) THE SERVICE WILL ALWAYS FUNCTION WITHOUT DELAYS, DISRUPTIONS OR IMPERFECTIONS.<br>
WE WARRANT THAT WE CAN NOT PREDICT WHEN OR IF AN ISSUE WILL ARISE WITH THE BARRELS, AND UNDER NO CIRCUMSTANCE WILL WE BE LIABLE FOR ANY DAMAGED OR BROKEN POINTS, SCRATCHED BARRELS, OR OTHER DAMAGE CAUSED.</p>
<p style="text-align:left;">
    <b style="text-decoration: underline;">ACCOUNT TERMINATION</b><br> 
We may terminate or suspend your access to or use of your Account or close your Account for any reason stated in this Terms and Conditions and violation or breach of the same with advance notice to you, and we will return your LENT darts once we have received any outstanding CURRENT darts in your possession.</p>
<p style="text-align:left;">
    <b style="text-decoration: underline;">SHIPPING POLICY</b><br>
Upon subscribing to dartsinabottle, we will send you an envelope containing a prepaid self-addressed envelope and a plastic bottle with a cork top. You will insert your LENT barrels into the cork top (so the barrels are contained in the bottle) and send the bottle back to us via the self-addressed envelope.<br>  
When we have received your LENT darts, we will assign CURRENT darts to you based on your weight preference chosen at sign-up. If barrels in your 1st choice of weight are not available, we will send out barrels in the weight of your 2nd choice. Likewise, if your 2nd choice of weight is not available, we will send out barrels in your 3rd choice of weight.  These will be posted in a bottle inside an envelope containing another prepaid self-addressed envelope.<br>
When you wish to return your CURRENT darts to receive a new set, you must place them in the bottle and cork top again and return them to us in the prepaid self-addressed envelope. <br> 
The first envelope we send will be posted via Royal Mail 1st class.<br>
ALL POSTAGE THEREAFTER WILL BE DONE VIA ROYAL MAIL 2ND CLASS. 'CURRENT' DARTS SENT TO YOU WILL BE SENT VIA 2ND CLASS SIGNED FOR. THE PREPAID ENVELOPES THAT YOU RETURN YOUR 'CURRENT' DARTS IN WILL BE STANDARD 2ND CLASS. PLEASE ALLOW UP TO 3 WORKING DAYS FOR DELIVERY.<br>
The length of time each shipping method will typically take is as follows;<br>
<ul>
    <li>- From the time you have subscribed to receiving the initial envelopes to send LENT darts – 2-3 working days</li>
    <li>- From the time you are sending back CURRENT darts to receiving new CURRENT DARTS – 5-7 working days</li>
</ul>
The address you provide shall be a home address.<br>
WE STRONGLY ADVISE THAT YOU OBTAIN A PROOF OF POSTING CERTIFICATE WHEN SENDING IN YOUR LENT DARTS AND RETURNING CURRENT DARTS. WE RESERVE THE RIGHT TO SUSPEND YOUR MEMBERSHIP SHOULD YOU CLAIM THAT DARTS HAVE BEEN RETURNED TO US WHEN WE HAVE NOT RECEIVED THEM, IN FACT, AND YOU CAN NOT PROVIDE ANY PROOF OF POSTING.<br>
IN THE EVENT YOU SEND YOUR CURRENT DARTS BACK, BUT WE HAVE NOT RECEIVED THEM, AND YOU HAVE NO PROOF OF POSTAGE, WE ARE AUTHORISED TO USE YOUR DEPOSIT TO COMPENSATE THE OTHER USER TO WHOM THE LENT DARTS BELONG TO.<br>
IN THE EVENT THE ABOVE HAPPENS AND YOU AGAIN STATE THAT CURRENT DARTS HAVE BEEN RETURNED, WITHOUT PROOF OF POSTAGE, WE ARE AUTHORISED TO KEEP YOUR LENT BARRELS AND SUSPEND/CANCEL YOUR MEMBERSHIP. This is to keep dartsinabottle a safe and honest way of sharing barrels.<br>
In the event you send back 1 or 2 barrels of your current darts instead of 3 we are authorised to use your deposit to compensate the user who sent said darts. 
In the event you send back different CURRENT DARTS to what you were sent, we are authorised to use your deposit to compensate the other user.<br>
In the event you send back CURRENT DARTS where one or more points have been broken, we are authorised to use your deposit to replace the point(s). The amount that we take from your deposit to compensate others is wholly decided by us. You will be notified through email of the costs and your newly updated deposit amount. <br>
</p>
<p style="text-align:left;">
    <b style="text-decoration: underline;">PURCHASE (selling/buying)</b><br>
By default, your LENT darts are set as ‘NOT FOR SALE.’<br>
You can choose a price to sell your LENT darts for by entering a price on the ‘Lent Darts’ page.<br>
You agree that any user currently in possession of your LENT darts may buy them.<br>
You agree that when selling barrels, dartsinabottle will keep a 10% 'Finder's Fee', taken from the price you set to sell your LENT darts for. Funds will be transferred to you later via PayPal. <br>
PLEASE ALLOW UP TO 24 HOURS TO RECEIVE THE FUNDS. THE FUNDS WILL BE SENT TO THE PAYPAL EMAIL ADDRESS THAT YOU ENTER WHEN CHOOSING A PRICE TO SELL YOUR LENT DARTS. YOU MAY UPDATE THIS PAYPAL EMAIL ADDRESS IN THE MY DARTS SECTION OF THE WEBSITE.<br>
You agree that when purchasing CURRENT barrels, you will be charged a 'Finder's Fee' of 7.5%, up to a maximum of £2.99.</p>
<p style="text-align:left;">
    <b style="text-decoration: underline;">GOVERNING LAW</b><br>
These terms of use shall be governed by the laws of The United Kingdom.</p>
<p style="text-align:left;">
    <b style="text-decoration: underline;">MODIFICATION</b><br>
We reserve the right to modify or change these terms from time to time for any reason at our discretion without notice.<br>
We shall notify you of any changes to these Terms by any reasonable means, including but without limitation, by posting the revised version of the Terms on the site.<br>
You should, therefore, periodically visit the website page to review the most current terms.</p>
<p style="text-align:left;">
    <b style="text-decoration: underline;">ASSIGNMENT</b><br>
We may assign our rights and obligations under these terms to any of our partners or any third parties at any time.</p>
<p style="text-align:left;">
    <b style="text-decoration: underline;">CONTACTS</b><br>
We undertake to be available for any query or concern regarding our service on the website through the following contact details;<br>
customerservice@dartsinabottle.com</p>
<p style="text-align:left;">
    <b style="text-decoration: underline;">ENTIRE AGREEMENT</b><br>
These terms and conditions constitute the entire agreement between you and us.<br>
These terms and conditions operate to the fullest extent permissible by law.</p>








        </div>
    </div>
</div>
{{-- Footer Content --}}
@include('user.customer.footer-customer')
{{-- Footer Content End  --}}
@endsection