@extends('user.customer.customer-layout')
@section('title','Current Darts')
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
          <h2>Current Darts</h2>
          <div class="clearfix"></div>
        </div>
        @if(Session::has('successmessage'))
        <div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        {{Session::get('successmessage')}}
        </div>
        @endif

        @if(Session::has('cancelmessage'))
        <div class="alert alert-warning alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        {{Session::get('cancelmessage')}}
        </div>
        @endif
        <div class="x_content x_cont">          
          <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Title</th>
                <th>Price</th>
                <th>Weight</th>                              
                <th>Weight Range</th>
                <th>Description</th>
                <th>Image</th>
              </tr>
            </thead>
            <tbody>
              @if($product != null)
              <tr>
                <td>{{@$product->getProduct->product_name}}</td>
                <td style="width:300px">
                  @if($product->getProduct->product_price_type == "for_sale")
                  @php
                      $price = number_format((float)$product->getProduct->product_price, 2, '.', '');
                      $amount = 0;
                      $total = 0;
                      if($price >= '39.00'){
                        $amount = 2.99;
                        $total = $price + $amount;
                      }else{
                        $amount = number_format((float)($price*1.075)-$price, 2, '.', '');
                        $total  = number_format((float)$price + $amount, 2, '.', '');
                      }
                  @endphp
                  <br class="mobile-current-darts-price" />
                  Darts £{{$price}}<br>
                  Finder’s Fee £{{$amount}}<br>
                  Total £{{$total}}<br>
                   <a style="cursor: pointer;" class="btn btn-primary buy_darts_for_sale" data-order_detail_id="{{$product->subscription_id}}">Buy Darts</a>
                  @elseif($product->getProduct->product_price_type == "not_for_sale")
                  Not For Sale
                  @elseif($product->getProduct->product_price_type == "")
                  Not For Sale
                  @endif
                </td>
                <td>{{$product->getProduct->product_weight}}</td>
                <td>{{$product->getProduct->product_weight_range}}</td>
                <td>{!! $product->getProduct->product_description !!}</td>


                @if(file_exists( public_path().'/uploads/darts_img/'.$product->getProduct->product_image ))
              <td><a href="{{url('public/uploads/darts_img/'.$product->getProduct->product_image)}}"><img src="{{url('public/uploads/darts_img/'.$product->getProduct->product_image)}}" height="100px" width="100px"></a></td>
              @else
             <td><a href="{{url('public/uploads/darts_img/no-image.png')}}"><img src="{{url('public/uploads/darts_img/no-image.png')}}" height="100px" width="100px"></a></td>
              @endif

              </tr>
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