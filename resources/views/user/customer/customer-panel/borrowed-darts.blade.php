@extends('user.customer.customer-panel.customer-panel-layout')
@section('title','Borrowed Darts')
@section('content')
<div class="right_col" role="main">
  <div class="page-title">
    <div class="title_left">
      <h3>Borrowed Darts</h3>
    </div>
  </div>

  <div class="clearfix"></div>
  @if(Session::has('successmessage'))
  <div class="alert alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    {{Session::get('successmessage')}}
  </div>
  @endif
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
      <div class="x_title">
        <h2>Borrowed Darts</h2>
        <div class="clearfix"></div>
      </div>
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
              <td><a href="{{url('public/uploads/darts_img/'.$product->getProduct->product_image)}}"><img src="{{url('public/uploads/darts_img/'.$product->getProduct->product_image)}}" height="100px" width="100px"></a></td>
            </tr>
          @endforeach   
          </tbody>
        </table>
      </div>
      </div>
    </div>
  </div>     
</div>
<!-- /page content -->
@endsection