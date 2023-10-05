@extends('user.customer.customer-layout')
@section('title','Subscription Detail')
@section('content')
{{-- Header Content --}}
@include('user.customer.header-customer')
{{-- Header Content End  --}}
<div class="wrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-3 left_col">
        @include('user.customer.left-customer')
      </div>
      <div class="col-md-9 right_col">
       <div class="x_panel">
        <div class="x_title">
          <h2>Subscription Detailasdfasdf</h2>          
          <div class="clearfix"></div>
          <div class="pull-right top_search panel-group">
            @if($order_detail->status==1 || $order_detail->status==2 || $order_detail->status==4)
              <div class="input-group">
                <div class="dropdown">
                @if($order_detail->isunsubscribe ==0)
                <a style="cursor: pointer;" class="btn cancel-subscription btn-primary" data-order_id="{{$order_detail->id}}" >Cancel Subscription</a>
                @endif
                </div>
              </div> 
            @endif
          </div>
        </div>
        @if($order_detail->isunsubscribe ==1 && $order_detail->status !=3)
        <div class="clearfix"></div>
        <div class="alert alert-info alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong class="blink">Note! Request already received. Check your email</strong> 
        </div>
        @endif
        <div class="clearfix"></div>
        @if(Session::has('successmessage'))
        <div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        {{Session::get('successmessage')}}
        </div>
        @endif
      <div class="x_content x_cont">          
      <div class="my_box_setting">
      <div class="panel-group col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading give_panel_color"><h3>Customer Information</h3></div>
          <div class="panel-body">
            <table class="table table-hover" style="border: 0px;">
           <tbody>
              <tr>
                <th>First Name</th>
                  <td>{{ $order_detail->getUser->first_name}}</td>
              </tr>    

              <tr>
                <th>Last Name</th>
                  <td>{{$order_detail->getUser->last_name}}</td>
              </tr>  

              <tr>
                <th>Email</th>
                <td>{{$order_detail->getUser->email}}</td>  
              </tr>
              <tr>
                <th>Registered at</th>
                <td>{{$order_detail->getUser->created_at}}</td>  
              </tr>                 
          </tbody>
          </table>
          </div>
        </div>
      </div>
      <div class="panel-group col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading give_panel_color"><h3>Order Information</h3></div>
          <div class="panel-body">
            <table class="table table-hover" style="border: 0px;">
           <tbody>
              <tr>
                <th>Order# </th>
                  <td>{{ $order_detail->order_number}}</td>
              </tr> 

              <tr>
                <th>Order Note </th>
                  <td>{{($order_detail->order_note!=null)?$order_detail->order_note:"
                  N/A"}}</td>
              </tr>     

               <tr>
                <th>Created at </th>
                  <td>{{ $order_detail->created_at}}</td>
              </tr>  

              <!-- <tr>
                <th>Total Items</th>
                <td>{{$order_detail->total_products}}</td>  
             </tr>
             <tr>
                <th>Total Weight</th>
                <td>{{($order_detail->total_weight != null)?$order_detail->total_weight.' Oz':'N/A'}}</td>  
             </tr> -->
            

             <tr>
                <th>Sub Total</th>
                <td>£{{ number_format($order_detail->sub_total,2) }}</td>  
             </tr>

             {{-- 0 means Normam Order --}}
             @if($order_detail->order_type == 0) 
             <tr>
                <th>Discounted Total</th>
                <td>£{{ number_format($order_detail->discounted_total,2) }}</td>  
             </tr> 
             @endif 

             @if($order_detail->coupon_code != '') 
             <tr>
                <th>Promo Code Discount</th>
                <td>£{{ number_format($order_detail->coupon_discount,2) }}<br>
                  {{$order_detail->coupon_code}}</td>  
             </tr> 
             @endif 

             <tr>
                <th>Total</th>
                <td>£{{ number_format($order_detail->total,2) }}</td>  
             </tr>

              
          </tbody>
          </table>
          </div>
        </div>
      </div>
      <div class="panel-group col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading give_panel_color"><h3>Shipping Information</h3></div>
          <div class="panel-body">
              <table class="table table-hover" style="border: 0px;">
           <tbody>
              
              <tr>
                <th>First Name </th>
                  <td>{{ $order_detail->getShippingDetail->first_name}}</td>
              </tr> 

              <tr>
                <th>Last Name </th>
                  <td>{{ $order_detail->getShippingDetail->last_name}}</td>
              </tr>
              
              <tr>
                <th>Email </th>
                  <td>{{ $order_detail->getShippingDetail->email}}</td>
              </tr>

             <tr>
                <th>Address Line 1</th>
                <td>{{$order_detail->getShippingDetail->address}}</td>  
             </tr>

             <tr>
                <th>Address Line 2</th>
                <td>{{$order_detail->getShippingDetail->address_2}}</td>  
             </tr>

             <tr>
                <th>Town/City</th>
                <td>{{$order_detail->getShippingDetail->city_id}}</td>  
             </tr> 

             <tr>
                <th>Postcode</th>
                <td>{{$order_detail->getShippingDetail->zip}}</td>  
             </tr>

             <tr>
                <th>Phone</th>
                <td>{{$order_detail->getShippingDetail->phone}}</td>  
             </tr>
          </tbody>
          </table>
          </div>
        </div> 
      </div>
      <div class="panel-group col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading give_panel_color"><h3>Billing Information</h3></div>
          <div class="panel-body">
              <table class="table table-hover" style="border: 0px;">
           <tbody>

              <tr>
                <th>Email </th>
                  <td>{{ @$order_detail->getBillingDetail->email}}</td>
              </tr> 
             <tr>
                <th>Address Line 1</th>
                <td>{{@$order_detail->getBillingDetail->address}}</td>  
             </tr>
             <tr>
                <th>Address Line 2</th>
                <td>{{@$order_detail->getBillingDetail->address_2}}</td>  
             </tr>
             <tr>
                <th>Town/City</th>
                <td>{{@$order_detail->getBillingDetail->city_id}}</td>  
             </tr>
             <tr>
                <th>Postcode</th>
                <td>{{@$order_detail->getBillingDetail->zip}}</td>  
             </tr>

            <tr>
              <th>Phone</th>
              <td>{{@$order_detail->getBillingDetail->phone}}</td>  
            </tr>  
              
          </tbody>
          </table>
          </div>
        </div>
       
      </div>
      @if($order_detail->order_type == 0)
      <div class="panel-group col-sm-6">
        <div class="panel panel-primary">
          <div class="panel-heading give_panel_color"><h3>Subscribe Item</h3></div>
          <div class="panel-body">
              <table class="table table-hover" style="border: 0px;">
           <tbody>
              <tr>
                <th>Package </th>
                  <td>{{$order_product->getPackage->darts_set}} SETS/Month</td>
              </tr>    
              <tr>
                <th>Unit Price</th>
                @php 
                $unit_price = $order_product->s_i_sub_total/$order_product->total_qty;
                @endphp
                <td>£{{number_format($unit_price, 2)}}</td>  
              </tr>

             <tr>
                <th>Sub Total</th>
                <td>£{{ number_format($order_product->s_i_sub_total, 2) }}</td>  
             </tr>

             <!-- <tr>
                <th>Discount Percent</th>
                <td>{{$order_product->discount_percent}}%</td>  
             </tr>

             <tr>
                <th>Discounted Total</th>
                <td>£{{ number_format($order_product->s_i_d_t, 2) }}</td>  
             </tr> -->                  
              
          </tbody>
          </table>
          </div>
        </div>
      </div>
      @endif

      {{-- Paypal Code Ended --}}
      @if($order_detail->payment_type_id == 4)   
      <div class="panel-group col-sm-6">
        <div class="panel panel-primary">
          <div class="panel-heading give_panel_color"><h3>Paypal Details</h3></div>
          <div class="panel-body">
              <table class="table table-hover" style="border: 0px;">
           <tbody>
              

              <tr>
                <th>Customer Profile Id </th>
                  <td>{{-- $order_detail->getAuthorizeProfile->customer_profile_id--}}</td>
              </tr>    

              <tr>
                <th>Payment Profile Id</th>
                <td>{{--$order_detail->getAuthorizeProfile->payment_profile_id--}}</td>  
             </tr>

             <tr>
                <th>Transaction Id</th>
                <td>{{--$order_detail->getAuthorizeProfile->getAuthorizeTranscationDetail->charge_customer_profile_transaction_id--}}</td>  
             </tr>
          </tbody>
          </table>
          </div>
        </div>
       
      </div>
      @endif 

      @if($order_detail->payment_type_id == 5)   
      <div class="panel-group col-sm-6">
        <div class="panel panel-primary">
          <div class="panel-heading give_panel_color"><h3>Stripe Details</h3></div>
          <div class="panel-body">
              <table class="table table-hover" style="border: 0px;">
           <tbody>
              <tr>
                <th>Stripe ID </th>
                  <td>{{$order_detail->stripe_id}}</td>
              </tr>    
              <tr>
                <th>Stripe Status</th>
                <td>{{$order_detail->stripe_status}}</td>  
             </tr>
             <tr>
                <th>Stripe Plan</th>
                <td>{{$order_detail->stripe_plan}}</td>  
             </tr>
          </tbody>
          </table>
          </div>
        </div>
      </div>
      @endif 
    </div>    
    @if($order_detail->order_type == 0)
    <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Shipped Darts</h2>
                <div class="clearfix"></div>
              </div>

              <div class="x_content">
                <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Weight</th>
                      <th>Weight Range</th>
                      <th>Price</th>
                      <th>Description</th>
                      <th>Image</th>
                      <th>Status</th>
                      <th>Ship Darts Date</th>
                      <th>Return Darts Date</th>
                    </tr>
                  </thead>
                  <tbody>
                   @if(count($product_to_customers)>0)
                   @foreach($product_to_customers as $product_to_customer)
                    <tr>
                      <td>{{$product_to_customer->getProduct->product_name}}</td>
                      <td>{{$product_to_customer->getProduct->product_weight}}</td>
                      <td>{{$product_to_customer->getProduct->product_weight_range}}</td>
                      <td style="width:300px">
                        @php
                        $price = '';
                        if($product_to_customer->getProduct->product_price_type == "for_sale")
                        {
                          $price='£'.$product_to_customer->getProduct->product_price;
                        } 
                        elseif ($product_to_customer->getProduct->product_price_type == "not_for_sale") 
                        {
                          $price='Not For Sale';
                        } 
                        @endphp
                        {{$price}}
                      </td>
                      <td>{!! $product_to_customer->getProduct->product_description !!}</td>
                      
                      @if(file_exists( public_path().'/uploads/darts_img/'.$product_to_customer->getProduct->product_image ))
                      <td><a href="{{url('public/uploads/darts_img/'.$product_to_customer->getProduct->product_image)}}"><img src="{{url('public/uploads/darts_img/'.$product_to_customer->getProduct->product_image)}}" height="100px" width="100px"></a></td>
                      @else
                      <td><a href="{{url('public/uploads/darts_img/no-image.png')}}"><img src="{{url('public/uploads/darts_img/no-image.png')}}" height="100px" width="100px"></a></td>
                      @endif
                      <td>{{$product_to_customer->status}}</td>
                      <td>{{$product_to_customer->created_at}}</td>
                      <td>{{$product_to_customer->returned_at}}</td>
                    </tr>
                  @endforeach  
                  @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        @endif    
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
{{--  loader --}}
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
<script>
$(document).ready(function(){
  $(document).on('click','.cancel-subscription',function(e){
     var order_id=$(this).data("order_id");
     
     swal({
      title: "Unsubscribe?",
      text: "Are you sure you want to unsubscribe from dartsinabottle?",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Yes, unsubscribe.",
      closeOnConfirm: false
    },
    function(){
    
    $.ajax({
      
      url:"{{url('unsubscribe-order')}}",
      method:"get",
      dataType:"json",
      data:{order_id:order_id},
      beforeSend: function () {
      $('#waiting_modal').modal({
          backdrop: 'static',
          keyboard: false
      });
      $("#waiting_modal").modal('show');

      }, //END Before Send
      success:function(data){
        $("#waiting_modal").modal('hide');
        if(data=="ok"){
            swal({
            title: "Success!",
            text: "Request received - please check your email.",
            type: "success",
            closeOnClickOutside: false
            },
            function () {
            window.location.reload();    
            });
        }
        else
        {
          alert("something went wrong");
        }
      },
      error:function(){
        alert("Error");
      }


    }); //ajax

   });
 });
});
</script>  
@endsection