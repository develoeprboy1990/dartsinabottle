@extends('user.admin.admin-layout')
@section('title','Shipping Management')


@section('content')

  <div class="right_col" role="main">
        <div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>Shipping Management</h3>
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

        


          

               <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                <h2>Country</h2>
                <div class="clearfix"></div>
                </div>
          <form method="POST" action="{{url('admin/shipping-management')}}" class="form-horizontal form-label-left col-sm-4 pull-right choose-country-form">
          {{csrf_field()}}
         {{-- This input field is added because in dartsinabottle United Kingdom is default --}}
          <input type="hidden" name="ship_management_country_select" value="231">

           <div class="form-group">
                      <label class="control-label" for="country">Choose Country<span class="required"></span>
                      </label>
                      <div class="col-xs-12">

          <select class="selectpicker" data-live-search="true" id="ship_management_country_select" title="Choose Country" name="ship_management_country_select"  disabled="true">
           
              <option value="231" selected>United States</option>
            
          </select>
          </div>
          </div>

          <div class="form-group">
                      <label class="control-label" for="country">Choose State<span class="required"></span>
                      </label>
                      <div class="col-xs-12">

         <select class="selectpicker" id="ship_management_state_select"  data-live-search="true" multiple title="Choose State"  name="ship_management_state_select[]">

            @foreach($states as $state)
              <option value="{{$state->id}}">{{$state->name}}</option>
            @endforeach
          </select>
          </div>
          </div>

          <div id="ship_management_state_div">
              

          </div>
          <input type="hidden" name="weight_price_counter" value="1" id="weight_price_counter">
          <div class="form-group weight-form">
            <label class="control-label" for="country">Weight Details<span class="required"></span>
            </label>
            <div class="weight_price_div">
               <div class="col-xs-12">
               <input class="form-control" placeholder="weight from" type="text" name="weight_from">
               <input class="form-control" placeholder="weight to" type="text" name="weight_to">
               <input class="form-control" type="text" placeholder="enter amount" name="amount">

             </div>
              <div class="ln_solid"></div>
            </div>
            <div class="add-more-btn">
            <a class="btn btn-success btn-sm add_more_details">+</a>
            <a class="btn btn-danger btn-sm remove_more_details" style="display: none;">-</a>
            </div>
           </div>



            <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-xs-12 text-right">
          <input type="submit" value="submit" class="btn btn-info"> 
          </div>
          </div>  
           </form>


          
          
           

<div class="col-sm-8 listing-countries">
<table id="myTable" class="table table-striped table-bordered bulk_action ">
                          <thead>
                            <tr>
                              <th>Country Name</th>
                              <th>State Name</th>
                             
                              <th>Action</th>
                            </tr>
                          </thead>
                         <tbody>
                         @if($details != null)
                         @foreach($details as $detail) 
                         <tr>
                         <td>{{$detail['country_name']}}</td>
                         <td>{{$detail['state_name']}}</td>
                         <td>
                         <a href="#" class="shipping_management_edit" data-id="{{$detail['id']}}"><i class="fa fa-edit"></i></a>
                          
                         <a style="cursor: pointer;" class="shipping_management_delete" data-id="{{$detail['id']}}"><i class="fa fa-trash"></i></a>
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


        <!-- Modal -->
  <div class="modal fade" id="shipping_management_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Weight Price</h4>
        </div>

      
        
        <div class="modal-body">
          
        <form class="form-horizontal form-label-left col-sm-12  choose-country-form" method="post" action="{{url('admin/shipping-management/edit')}}"> 
        {{csrf_field()}}
        <input type="hidden" name="shipping_country_states_id" id="shipping_country_states_id">
        <input type="hidden" name="weight_price_counter_modal" id="weight_price_counter_modal" value="1">

          <div class="form-group weight-form">
            <label class="control-label" for="country">Weight Details<span class="required"></span>
            </label>
            <div class="show_html_string">
            <div class="weight_price_div_modal">
               <div class="col-xs-12">
               <input class="form-control" placeholder="weight from" type="text" name="weight_from">
               <input class="form-control" placeholder="weight to" type="text" name="weight_to">
               <input class="form-control" type="text" placeholder="enter amount" name="amount">

             </div>
              <div class="ln_solid"></div>
            </div>
            </div>
            <div class="add-more-btn">
            <a class="btn btn-success btn-sm add_more_details_modal">+</a>
            <a class="btn btn-danger btn-sm remove_more_details_modal" style="display: none;">-</a>
            </div>
           </div>

          <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-xs-12 text-right">
          <input type="submit" value="submit" class="btn btn-info"> 
          </div>
          </div>


          

        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-default">Save</button> --}}
        </div>
        </form>
      </div>
      
    </div>
  </div>
  {{-- Modal end --}}


        <!-- /page content -->

        <!-- footer content -->
        
        <!-- /footer content -->

      </div>

    @endsection