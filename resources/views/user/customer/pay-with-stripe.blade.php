@extends('user.customer.customer-layout')
@section('title','Checkout')
@section('content')
{{-- Header Content --}}
@include('user.customer.header-customer')
{{-- Header Content End  --}}
<div class="wrapper">
    <form id="checkFromCheckOut" method="POST" action="{{url('order-thankyou-page')}}">
        {{csrf_field()}}
        <input type="hidden" name="from_checkout" id="from_checkout">
    </form>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 checkout-form-col checkout-form">
                <form class="checkout-form-class" method="post" action="{{route('place-order')}}">
                    {{csrf_field()}}
                    <div class="row checkout-field-row">
                        <div class="col-xs-12">

                    <input type="submit" id="place_order_button" class="btn btn-next" value="Purchase Now" {{@$place_order_disabled}}>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- loader --}}
<div class="modal fade" id="waiting_modal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <p style="text-align:center;"><img src="{{url('public/uploads/gif/waiting.gif')}}"></p>
            </div>
        </div>
    </div>
</div>
{{-- Footer Content --}}
@include('user.customer.footer-customer')
{{-- Footer Content End  --}}
@endsection
@section('javascript')
<script src="https://parsleyjs.org/dist/parsley.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
    Stripe.setPublishableKey("<?php echo config('app.STRIPE_KEY') ?>");
</script>
@endsection