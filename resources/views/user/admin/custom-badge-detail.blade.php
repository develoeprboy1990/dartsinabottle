@extends('user.admin.admin-layout')
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
                          
                          
                        @if($custom_badge_detail->quote_status ==0 || $custom_badge_detail->quote_status ==2)
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-success" data-toggle="dropdown" role="button" aria-expanded="false">Options</a>
                            <ul class="dropdown-menu" role="menu">
                              
                              <li><a style="cursor: pointer;" data-toggle="modal" data-target="#send_quote_modal">Send Quote</a>
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
                        <th>Sample</th>
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
          
<!-- fim Modal-->

{{-- Quote Modal --}}
 <!-- Modal -->
  <div class="modal fade" id="send_quote_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Send Quote</h4>
        </div>
        <div class="modal-body">
          <form id="send_quote_form" enctype="multipart/form-data" action="{{url('admin/assign-quote')}}">
          {{csrf_field()}}
            <input type="hidden" name="custom_badge_detail_id" value="{{$custom_badge_detail->id}}">
            <div class="form-group">
              <label for="price">Price of One Badge:</label>
              <input type="text" class="form-control" id="price_of_one_badge" name="price_of_one_badge">
            </div>
            <div class="form-group">
              <label for="weight">Weight of One Badge:</label>
             <input type="text" class="form-control" id="weight_of_one_badge" name="weight_of_one_badge">
            </div>
            <div class="form-group">
              <label for="weight">Choose File:</label>
             <input type="file" class="form-control" id="example_badge_file" name="example_badge_file[]" multiple="true">
            </div>

            <div class="form-group">
              <label for="description">Description:</label>
             <textarea id="description" name="description"></textarea>
            </div>

          <input type="submit" class="btn btn-success" id="quote_submit_btn" value="Submit">


          </form>



        </div>
        <div class="modal-footer">
          </div>
        
      </div>
      
    </div>
  </div>
  
  {{-- Quote Modal End --}}



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

        @include('user.admin.footer')
        
      
        <!-- /footer content -->
      </div>
      <!-- /page content -->

   

  


  @endsection

