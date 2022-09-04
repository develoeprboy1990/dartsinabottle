@extends('user.customer.customer-layout')
@section('title','My Subscriptions')
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
      <div class="col-md-9">
       <div class="x_panel">
        <div class="x_title">
          <h2>ALL Subscriptions</h2>
          <div class="clearfix"></div>
        </div>
        @if(Session::has('successmessage'))
        <div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        {{Session::get('successmessage')}}
        </div>
        @endif
        <div class="x_content x_cont">          
          <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Customer Name</th>
              <th>Customer Email</th>
              <th>Order Number</th>
              <th>Package Type</th>
              <th>Payment Type</th>
              <th>Payment Status</th>
              <th>Order Status</th>
              <th>Created At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
           @if(count($order_details)>0)
           @foreach($order_details as $order_detail)
            <tr>
              <td>{{$order_detail->getUser->first_name." ".$order_detail->getUser->last_name }}</td>
              <td>{{$order_detail->getUser->email}}</td>
              <td>{{$order_detail->order_number}}</td>
              <td>{{@$order_detail->getProductDetail->getPackage->darts_set}} SETS/Month</td>


              {{-- Payment Type Start --}}
              {{-- @if(@$order_detail->getPaymentType)
           
              @endif --}}
              <td>{{@$order_detail->getPaymentType->name}}</td>
              <td>{{(@$order_detail->payment_status==1)?"Done":"Pending"}}</td>
              

              {{-- Payment Type Ended --}}

              <td>
                @if($order_detail->status == 0)
                Pending
                @elseif($order_detail->status == 1 || $order_detail->status == 2)
                Active
                @elseif($order_detail->status == 3)
                Cancelled
                @endif
              </td>
              <td>{{$order_detail->created_at}}</td>
              <td>
              <a href="{{url('order/'.$order_detail->id.'/detail')}}" class=""><i class="fa fa-eye"></i></a> 
              </td>
              
              
            </tr>
          @endforeach  
          @endif  
          </tbody>
        </table>
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
@endsection