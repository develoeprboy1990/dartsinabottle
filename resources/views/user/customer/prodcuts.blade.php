@extends('user.customer.customer-layout')
@section('title','Products')
@section('content')

{{-- Header Content --}}
@include('user.customer.header-customer')
{{-- Header Content End  --}}

<div class="wrapper">
<div class="container">

@if(Session::has('successmessage'))

    <div class="alert alert-success alert-dismissable">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
     {{Session::get('successmessage')}}
   </div>
@endif

  <div class="row">
    <div class="col-xs-12 cart-form-col">
      <form class="cart-form">
                      
           
           <div class="row cart-badge-row">
           	
           	@if($products)
           	@foreach($products as $product)
            <div class="col-md-4 col-sm-4 col-xs-6 badge-col text-center">
            	<div class="well">
                <div class="selected-col">
                    
                  <div class="selectedbadge">

                  <div class="toparrow"><span><span>{{$product->size_from}}</span></span></div>
                  <div class="rightarrow"><span><span>{{$product->size_to}}</span></span></div>

                    @php
                      $width = 60*$product->size_from;
                      $height = 60*$product->size_to;
                    @endphp
                    
                    <figure> <img width="{{$width}}px" height="{{$height}}px" src="{{url('public/uploads/badge_img/'.$product->image)}}" class=" selected-img" alt="selected badge">

                    </figure>
                  </div>
                   
                    <div class="pre-imgsize text-center">Size {{$product->size_from}} x {{$product->size_to}}</div>
                    
                  </div>
                    <div class="badge-total">
                    <table class="table">
                        <tbody>
                            <tr>
                               <th>Title:</th>
                               <td>{{$product->title}}</td>
                            </tr>

                            <tr>
                               <th>Price per unit:</th>
                               <td>{{$product->price}}</td>
                            </tr>

                            <tr>
                               <th>Quantity:</th>
                               <td><input class="form-control" type="number" value="1" name="pro_qty" id="pro_qty_{{$product->id}}" min="" max="" ></td>
                            </tr>
                            
                            <tr>
                              <th>Description:</th>
                              <td>{!! $product->description !!}</td>
                            </tr>

                            <tr>
                              <td colspan="2">
                                <a href="javascript:void(0)" class="btn add-to-cart"  data-product_id="{{$product->id}}">
                                  Add to Cart 
                                </a> 
                              </td>                             
                            </tr>
                            
                        </tbody>
                    </table>
                 </div> 
                </div>
            </div>
            @endforeach
            @else
            <h2 style="text-align: center;">No Products</h2>
            @endif
           
            
           </div>
          
           <div class="cart-button-row">
           	 <div class="row">
            	<div class="col-sm-6 col-xs-6 button-col another-badge-col">
                	
                </div>
                <div class="col-sm-6 col-xs-6 button-col order-col text-right">
              
                </div>
            </div>
           </div>

      </form>
    </div>
  </div>
</div>
</div>


{{-- Footer Content --}}
@include('user.customer.footer-customer')
{{-- Footer Content End  --}}

  <!-- Modal -->
  <div class="modal fade" id="edit_badge_detail_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Badge Quantity</h4>
        </div>
        <form action="#" method="post" id="edit_badge_detail_form">
        {{csrf_field()}}
        <div class="modal-body">
          
          <span id="edit_cart_content">
             
          </span>	
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default" id="update_quantity_btn">Update <span style="display: none;" id="update_cart_loader"><img src="{{url('public/uploads/gif/cart_loader.gif')}}"></span></button>
        </div>
        </form>
      </div>
      
    </div>
  </div>
  {{-- Modal End --}}

@endsection
@section('javascript')

 <script src="{{asset('assets/customer/assets/js/customform.js')}}"></script>
 {{-- <script src="{{asset('assets/fittext.min.js')}}"></script> --}}
{{--  <script>
    $(".second_line_class").fitText(0.5, { minFontSize: '1px', maxFontSize: '18px' });
 </script> --}}
<!-- <script>
  $(document).ready(function(){

  });
</script>  -->
@endsection 