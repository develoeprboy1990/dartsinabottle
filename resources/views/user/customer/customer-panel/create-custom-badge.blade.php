@extends('user.customer.customer-panel.customer-panel-layout')
@section('title','Create Custom Badge')


@section('content')

  <div class="right_col" role="main">
        <div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>Define Your Customer Badge</h3>
            </div>
             

            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                {{-- <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                </div> --}}
              </div>
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
                  <h2>Add</h2>
                 {{--  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul> --}}
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form id="custom_badge_form" method="post" action="{{url('admin/courier')}}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                    
                    {{csrf_field()}}
          
                            
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Do you have any example? <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          
                        <label class="radio-inline">
                          <input type="radio" name="badge_example" value="yes" class="badge_example">Yes
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="badge_example" value="no" class="badge_example">No
                        </label>
                       
                      </div>
                    </div>


                    <div  style="display: none;" id="badge_example_file_div">
                    <hr>
                    <p style="color:red;margin-left: 266px;"> NOTE:  Example  means sample of badges </p>
                    <hr>

                    <div class="form-group" >
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Upload Examples<span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          
                      <input class="form-control" type="file" name="badge_example_file[]" multiple="true">
                       
                      </div>
                    </div>

                    </div>


                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Do you have any assets? <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          
                        <label class="radio-inline">
                          <input type="radio" name="badge_asset" value="yes" class="badge_asset">Yes
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="badge_asset" value="no" class="badge_asset">No
                        </label>
                       
                      </div>
                    </div>

                    <div id="asset_file_div" style="display: none;">
                    <hr>
                    <p style="color:red;margin-left: 266px;"> NOTE:  Asset means logo etc </p>
                    <hr>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="badge-assets"> Upload Assets
                      </label>

                      <div class="col-md-6 col-sm-6 col-xs-12">
                      {{-- <p>Asset means logo etc</p>     --}}
                      <input class="form-control" type="file" name="badge_asset_file[]" multiple="true">
                       
                      </div>
                    </div>

                    </div>  



                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Provide Description about Badge<span class="required">*</span> <span style="color:red;"> (Please tell about your badge i.e color size etc) </span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea class="form-control" id="badge_description" name="badge_description"></textarea>
                       
                       
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Badge Quantity<span class="required">*</span> 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         
                      <input class="form-control" type="number" name="badge_quantity">
                       
                       
                      </div>
                    </div>

                  


                    


                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        {{-- <button type="submit" class="btn btn-primary">Cancel</button> --}}
                        <button type="submit" class="btn btn-success" id="submit_btn">Submit</button>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>

          {{-- <script type="text/javascript">
            $(document).ready(function() {
              $('#birthday').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4"
              }, function(start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
              });
            });
          </script>
          --}}

        


          


        

         
        </div>
        <!-- /page content -->

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
        {{-- @include('user.customer.customer-panel.footer-customer-panel') --}}
        
        <!-- /footer content -->

      </div>

    @endsection