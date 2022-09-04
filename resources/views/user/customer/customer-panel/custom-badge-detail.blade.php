@extends('user.customer.customer-panel.customer-panel-layout')
@section('title','Custom Badge Detail')

@section('content')


 <div class="right_col" role="main">

        <!-- top tiles -->
        <div class="row tile_count">
          
          <h1>Custom Badge Details</h1>
          {{-- datatable --}}
               
         {{--  <div id="loader" style="display:none;position:relative;z-index:1000; ">
                   <img class="loader_checkout" src="{{url('public/uploads/gif/spinner.gif')}}">
          </div> --}}

   <div class="col-md-12 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Details </h2>
                      <ul class="nav navbar-right panel_toolbox">
                          
                          
                        @if($custom_badge_detail->quote_status ==1 )
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-success" data-toggle="dropdown" role="button" aria-expanded="false">Options</a>
                            <ul class="dropdown-menu" role="menu">
                              
                             {{--  <li><a href="{{url('custom-badge/'.$custom_badge_detail->id.'/checkout')}}" >Accept Quote</a>
                              </li> --}}
                              <li><a href="{{url('custom-badge/'.$custom_badge_detail->identification_number.'/checkout')}}" >Accept Quote</a>
                              </li>
                              
                            
                              <li><a style="cursor: pointer;" data-toggle="modal" data-target="#quote_rejection_modal">Reject Quote</a>
                              </li>
                              
                              
                            </ul>
                          </li>
                        @endif 
                          
                        </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  {{-- Content --}}
                  

                 @if($custom_badge_detail->count()>0)
                  
                   <div class="row">
                      <div class="col-md-12 col-xs-12">
                        <h2>Badge Identification Number</h2>
                      </div>
                   </div>

                   <p>{{$custom_badge_detail->identification_number}}</p> 


                    <div class="row">
                      <div class="col-md-12 col-xs-12">
                        <h2>Badge Description</h2>
                      </div>
                    </div>

                 
                  
                   <p>{!!$custom_badge_detail->badge_description!!}</p> 

                    <div class="row">
                      <div class="col-md-12 col-xs-12">
                        <h2>Badge Quantity</h2>
                      </div>

                    </div> 
                   <p>{{$custom_badge_detail->badge_quantity}}</p> 
                      
                   <div class="row">
                      <div class="col-md-12 col-xs-12">
                        <h2>Badge Examples</h2>
                      </div>

                   </div> 
                   <div class="row">
                 
                   @if($custom_badge_detail->getCustomBadgeExample->count()>0)

                   @php
                     $e=1;
                   @endphp
                   @foreach($custom_badge_detail->getCustomBadgeExample as $result)
                   <div class="col-md-3">
                     <a href="{{url('public/uploads/custom-badge/examples/'.$result->badge_example_file)}}" download><i class="fa fa-download"></i> Example {{$e}}</a>
                   </div>
                   @php
                     $e++;
                   @endphp
                   @endforeach

                   @else
                   <div class="col-md-3">
                   <p>N/A</p>
                   </div>
                   @endif
                  
                     
                   </div>


                  


                  {{-- Badge Assets --}}
                   <div class="row">
                      <div class="col-md-12 col-xs-12">
                        <h2>Badge Assets</h2>
                      </div>

                   </div> 
                   <div class="row">
                 
                   @if($custom_badge_detail->getCustomBadgeAsset->count()>0)

                   @php
                     $a=1;
                   @endphp
                   @foreach($custom_badge_detail->getCustomBadgeAsset as $result)
                   <div class="col-md-3">
                     <a href="{{url('public/uploads/custom-badge/assets/'.$result->badge_asset_file)}}" download><i class="fa fa-download"></i> Asset {{$a}}</a>
                   </div>
                   @php
                     $a++;
                   @endphp
                   @endforeach

                   @else
                   <div class="col-md-3">
                   <p>N/A</p>
                   </div>
                   @endif
                  
                     
                   </div>


                  @endif
              
               

                </div>
              </div>
            </div>
  {{-- Quote Panel --}}

@if($custom_badge_quotes->count()>0)

   <div class="col-md-12 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Quote Details </h2>
                {{--    <ul class="nav navbar-right panel_toolbox">
                          
                          
                        @if($custom_badge_detail->quote_status ==0)
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-success" data-toggle="dropdown" role="button" aria-expanded="false">Options</a>
                            <ul class="dropdown-menu" role="menu">
                              
                              <li><a style="cursor: pointer;" data-toggle="modal" data-target="#send_quote_modal">Send Quote</a>
                              </li>
                              
                            </ul>
                          </li>
                        @endif 
                          
                        </ul> --}}
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  {{-- Content --}}
                  
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Price of One Badge</th>
                        <th>Weight of One Badge</th>
                        <th>Total Price</th>
                        <th>Description</th>
                        <th>Samples</th>
                        <th>Quote Status</th>

                      </tr>
                    </thead>
                    <tbody>
                      @foreach($custom_badge_quotes as $result)
                      <tr>
                        <td>${{$result->price_of_one_badge}}</td>
                        <td>{{$result->weight_of_one_badge}} Oz</td>
                        <td>${{$result->price_of_one_badge * $custom_badge_detail->badge_quantity}}</td>
                        <td>{!!$result->description!!}</td>
                        @if($result->getCustomBadgeQuoteFile->count()>0)
                        <td>
                        @php
                         $q=1; 
                        @endphp
                        @foreach($result->getCustomBadgeQuoteFile as $result_file)  
                        <p><a href="{{url('public/uploads/custom-badge/quote-files/'.$result_file['example_badge_file'])}}" download><i class="fa fa-download"></i> Sample {{$q}}</a></p>
                        @php
                          $q++;
                        @endphp
                        @endforeach
                        </td>
                        @endif
                       {{--  <td>
                        @if($result->rejection_status == 0) 
                        <a class="btn btn-danger btn-xs reject_quote" data-custom_badge_quote_id="{{$result->id}}">Reject Quote</a> <a class="btn btn-success btn-xs">Accept Quote</a>
                        @else
                        --
                        @endif

                        </td> --}}
                        <td>
                        @if($result->rejection_status == 1) 
                        <a class="btn btn-danger btn-xs reject_quote">Rejected</a>
                        @elseif($result->rejection_status == 0) 
                        <a class="btn btn-success btn-xs">Latest</a>
                        @elseif($result->rejection_status == 2) 
                        <a class="btn btn-success btn-xs">Accepted</a>
                        @endif

                        </td>
                      </tr>
                      @endforeach
                      
                    </tbody>
                  </table>

              
                  
                </div>
              </div>
            </div>

@endif

 {{-- Quote Panel end --}}

        </div>
        <!-- /top tiles -->

        
<!-- Modal -->
   
  <div class="modal fade" id="quote_rejection_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <form id="quote_rejection_form">
      {{csrf_field()}}
      {{-- <input type="hidden" name="custom_badge_quote_id" value="" id="custom_badge_quote_id"> --}}
      <input type="hidden" name="custom_badge_detail_id" value="{{$custom_badge_detail->id}}" id="custom_badge_detail_id">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Quote Rejection</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="email">Reason for Quote Rejection:</label>
            <textarea class="form-control" name="reason_for_rejection" required="true"></textarea> 
            </div>
         
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="quote_rejection_form_submit_btn" >Submit</button>
        </div>
      </div>
       </form>
      
    </div>
  </div>         
<!--  Modal-->

 {{-- Loader Modal --}}
    <div class="modal fade" id="loader_modal" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">

          <div class="modal-body">
            <h3 style="text-align:center;">Please wait</h3>
            <p style="text-align:center;"><img src="{{url('public/uploads/gif/waiting.gif')}}"></p>
          </div>

    </div>
    </div>
    </div>
   {{-- Loade Modal end --}}




        <!-- footer content -->

        @include('user.customer.customer-panel.footer-customer-panel')
      
        <!-- /footer content -->
      </div>
      <!-- /page content -->

   

  


  @endsection

