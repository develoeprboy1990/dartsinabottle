@extends('user.customer.customer-layout')
@section('title','Borrowed Darts')
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
          <h2>Borrowed Darts</h2>
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
              <th>Title</th>
              <th>Weight</th>                              
              <th>Weight Range</th>
              <th>Price</th>
              <th>Status</th>
              <th>Description</th>
              <th>Image</th>
            </tr>
          </thead>
          <tbody>
           @foreach($products as $product)
            <tr>
              <td>{{$product->getProduct->product_name}}</td>
              <td>{{$product->getProduct->product_weight}}</td>
              <td>{{$product->getProduct->product_weight_range}}</td>
              <td style="width:300px">
                @php
                $price = '';
                if($product->getProduct->product_price_type == "for_sale")
                {
                  $price='£'.$product->getProduct->product_price;
                } 
                elseif ($product->getProduct->product_price_type == "not_for_sale") 
                {
                  $price='Not For Sale';
                } 
                @endphp
                {{$price}}
              </td>
              <td>{{$product->status}}</td>
              <td>{!! $product->getProduct->product_description !!}</td>

               @if(file_exists( public_path().'/uploads/darts_img/'.$product->getProduct->product_image ))
              <td><a href="{{url('public/uploads/darts_img/'.$product->getProduct->product_image)}}"><img src="{{url('public/uploads/darts_img/'.$product->getProduct->product_image)}}" height="100px" width="100px"></a></td>
              @else
             <td><a href="{{url('public/uploads/darts_img/no-image.png')}}"><img src="{{url('public/uploads/darts_img/no-image.png')}}" height="100px" width="100px"></a></td>
              @endif
            </tr>
          @endforeach   
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