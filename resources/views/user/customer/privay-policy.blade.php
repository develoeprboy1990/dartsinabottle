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
            <h1> <b>Privay Policy</b> </h1>
            <hr>
<p style="text-align:justify;">This Privacy Policy elaborates our policies on collecting, using, and disclosing your information when you use our services. It informs you on your entitled privacy rights and how the law protects you.</p>

<p style="text-align:justify;">By using this website, you agree to the provisions and covenants in this privacy policy.</p>
<p style="text-align:justify;"><b style="text-decoration: underline;">Information Collection and Use</b> – We may collect data to identify you or contact you. The collected data will include your personal information, which includes but is not limited to your name, phone number, and email address.</p>

<p style="text-align:justify;"><b style="text-decoration: underline;">Log Data</b> – whenever you join your account on our website, we collect information from your browser. It will enable us to provide maximum usage of our services.</p>

<p style="text-align:justify;"><b style="text-decoration: underline;">Tracking and Cookies</b> – Cookies are data that we use on our website. We employ cookies and similar technology to keep track of your setting to know which account you have used for logging into.</p>

<p style="text-align:justify;"><b style="text-decoration: underline;">Service Provider</b> – We will employ the services of third-party service providers to assist in carrying out our services on our behalf and our request. The benefits to be provided will require the third parties to have access to your personal information, and the services to be provided include but are not limited to the following; -
<ul>
    <li>i.  Doing Delivery.</li>
    <li>ii. Getting feedback.</li>
    <li>iii.    Getting analysis on our services</li></ul>
</p>

<p style="text-align:justify;"><b style="text-decoration: underline;">Security</b> – We value your trust in sharing your personal information, and we are committed to protecting the collected data from you. We shall employ reasonable security measures to secure and safeguard your personal information from unauthorized third-party access. We shall retain the information collected as long as required to continue supplying you with our services and any third-party partners we have.</p>

<p style="text-align:justify;"><b style="text-decoration: underline;">Copyright Policy</b> – All and any intellectual property is copyrighted by us and we own exclusive rights over them.  </p>

<p style="text-align:justify;"><b style="text-decoration: underline;">Indemnity</b> – We shall provide all reasonable protection to the information collected and provided by you. Remember, however, that the use of the internet is not 100% secure, and therefore you share your information at your own risk.</p>

<p style="text-align:justify;"><b style="text-decoration: underline;">Links to Other Sites</b> – Our services may contain links to other sites not operated by us, and these links may include the one used for payment processing. By clicking on the third-party links, you agree to their privacy policy. </p>

<p style="text-align:justify;"><b style="text-decoration: underline;">Updates</b> – If you as a user wish to make a change or update your Account opened with us, please email customerservice@dartsinabottle.com</p> 

<p style="text-align:justify;"><b style="text-decoration: underline;">Changes to this Policy</b> – we might change, review or modify our privacy policy any time from time to time without your consultation. We will post the updated privacy policy on our website, and your continued use of our website indicates your agreement to the reviewed privacy policy.</p> 

<p style="text-align:justify;"><b style="text-decoration: underline;">Contact Us</b> – If you have any queries, comments, or concerns about this privacy policy, contact us at customerservice@dartsinabottle.com</p>




        </div>
    </div>
</div>
{{-- Footer Content --}}
@include('user.customer.footer-customer')
{{-- Footer Content End  --}}
@endsection