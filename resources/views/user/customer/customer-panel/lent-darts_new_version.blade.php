@extends('user.customer.customer-layout')
@section('title','Shop')
@section('content')
{{-- Header Content --}}
@include('user.customer.header-customer')
{{-- Header Content End  --}}
 <div class="container body">

    <div class="row">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <input type="hidden" id="site_url"  value="{{ url('') }}">

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
              <h3>{{$user_boot->first_name." ".$user_boot->last_name}}</h3>
              <ul class="nav side-menu">

                <li><a>My Darts <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="{{url('lent-darts')}}">Lent Darts</a></li> 
                    <li><a href="{{url('current-darts')}}">Current Darts</a></li>
                    <li><a href="{{url('borrowed-darts')}}">Borrowed Darts</a></li>
                  </ul>
                </li>
              
                <li><a>My Subscriptions <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="{{url('orders/my-subscriptions')}}">Subscriptions</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->
        </div>
      </div>

      <div class="col-md-9 right_col" role="main">
            <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Lent Darts</h2>
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
                              <th>Description</th>
                              <th>Image</th>
                            </tr>
                          </thead>
                          <tbody>
                           @foreach($products as $product)
                            <tr>
                              <td>{{$product->product_name}}</td>
                              <td>{{$product->product_weight}}</td>
                              <td>{{$product->product_weight_range}}</td>
                              <td style="width:300px">
                               
                              <form  method="post" action="{{url('choose-product-price-type-process')}}" data-parsley-validate class="form-label-left">
                                {{csrf_field()}}
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                @php
                                if($product->product_price_type == "for_sale")
                                {
                                  $test_checked="checked";
                                } 
                                elseif ($product->product_price_type == "not_for_sale") 
                                {
                                  $live_checked="checked";
                                } 
                                @endphp
                                <div class="radio">
                                  <label><input type="radio" name="product_price_type" value="for_sale" {{@$test_checked}}> Set Price</label>
                                  <b>£</b> <input type="text" name="product_price" id="product_price" value="{{$product->product_price}}">
                                </div><br><br>
                                <div class="radio">
                                  <label><input type="radio" name="product_price_type" value="not_for_sale" {{@$live_checked}}> Not For Sale</label>
                                </div>
                                <div class="ln_solid" style="margin:10px 0;"></div>
                                <div class="form-group pull-right">
                                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                  </div>
                                </div>
                              </form>
                              </td>
                              <td>{!! $product->product_description !!}</td>
                              <td><a href="{{url('public/uploads/darts_img/'.$product->product_image)}}"><img src="{{url('public/uploads/darts_img/'.$product->product_image)}}" height="100px" width="100px"></a></td>
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

  
{{-- Footer Content --}}
@include('user.customer.footer-customer')
{{-- Footer Content End  --}}
@endsection
@section('javascript')
 <script src="{{asset('assets/customer/assets/js/customform.js')}}"></script>
@endsection