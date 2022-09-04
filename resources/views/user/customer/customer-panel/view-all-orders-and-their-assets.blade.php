@extends('user.customer.customer-panel.customer-panel-layout')
@section('title','Assets')

@section('content')


 <div class="right_col" role="main">

        <!-- top tiles -->
        <div class="row tile_count">
          
          <h1>Assets</h1>
          {{-- datatable --}}
               
         {{--  <div id="loader" style="display:none;position:relative;z-index:1000; ">
                   <img class="loader_checkout" src="{{url('public/uploads/gif/spinner.gif')}}">
          </div> --}}

   <div class="col-md-12 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Assets </h2>
                  <ul class="nav navbar-right panel_toolbox">
                    
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  {{-- Content --}}
                  

                
                @if($order_details->isNotEmpty())
                @foreach($order_details as $result_order_details)                
                  <div class="row">
                    <div class="col-md-12 col-xs-12">
                      <h2>Order# : {{$result_order_details->order_number}}</h2>
                    </div>
                  </div>



                 @if($result_order_details->getOrderAsset->isNotEmpty())
                   
                  <div class="row">
                  {{-- {{dd($result_outer->getAssetsResult)}} --}}
                  {{-- @if($result_outer->getAssetsResult->isNotEmpty()) --}}
                  @foreach($result_order_details->getOrderAsset as $result_get_order_asset)
                      <div class="col-md-2 col-xs-2">

                  
                     
                      <img src="{{url('public/uploads/order_assets/asset_file_icon.png')}}"  height="50px" width="50px">

                      
                      <br>

                      <a href="{{url('public/uploads/order_assets/'.Auth::user()->id.'/'.$result_get_order_asset->asset_file)}}" download><i class="fa fa-download"></i> {{$result_get_order_asset->asset_file_name}}</a>

                      </div>

                     
                  @endforeach

                    
                    
                
                    
                  </div>
                 @else
                 <p style="color:orange;">No asset found for this order</p> 
                 @endif 

                  <br>
                  <br>
               
              @endforeach    
              @else
              <p>No order found for this customer</p>
              @endif
               

                </div>
              </div>
            </div>
  

        </div>
        <!-- /top tiles -->

        
<!-- Modal -->
          
<!-- fim Modal-->

{{-- Loade Modal --}}
 
  {{-- Loader Modal End --}}



        <!-- footer content -->

        @include('user.customer.customer-panel.footer-customer-panel')
      
        <!-- /footer content -->
      </div>
      <!-- /page content -->

   

  


  @endsection

