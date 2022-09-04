@extends('user.admin.admin-layout')
@section('title','Badge Discount')
@section('content')



 	<div class="right_col" role="main">
      <!-- page content -->

 		 <div class="page-title">
            <div class="title_left">
              <h3>Badge Discount</h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                </div>
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
            <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Badge Discount</h2>
                       {{--  <ul class="nav navbar-right panel_toolbox">
                          <li><a href="#"><i class="fa fa-chevron-up"></i></a>
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
                          <li><a href="#"><i class="fa fa-close"></i></a>
                          </li>
                        </ul> --}}
                        <div class="clearfix"></div>
                      </div>

                      <div class="x_content x_cont">
                       {{--  <p class="text-muted font-13 m-b-30">
                          Responsive is an extension for DataTables that resolves that problem by optimising the table's layout for different screen sizes through the dynamic insertion and removal of columns from the table.
                        </p> --}}
                        <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Badge Size</th>
                              <th>Quantity</th>
                              <th>Discount Percent</th>
                              <th>Action</th>
                              
                            </tr>
                          </thead>
                          <tbody>
                          {{-- {{dd($badge_sizes->badge_discounts)}} --}}
                          {{-- @foreach($badge_sizes->badge_discounts as $result)
                            {{$result->quantity}}
                          @endforeach --}}
                           @if(count($badge_details)>0)
                          
                          
                           @foreach($badge_details as $badge_detail)

                             {{-- @foreach($badge_size->badge_discounts::orderBy('id','DESC') as $result2) --}}

                              <tr>
                                <td>{{$badge_detail->size_from}}*{{$badge_detail->size_to}}</td>
                                <td>{{$badge_detail->quantity_from}} - {{$badge_detail->quantity_to}}</td>
                          

                              
                                <td>{{$badge_detail->discount_percent}}%</td>
                                <td>
                                  <a href="#" class="edit_badge_discount" data-badge_discount_id="{{$badge_detail->discount_id}}"><i class="fa fa-edit"></i></a> 

                                    {{Form::open(array('url'=>'admin/badge-discount/'.$badge_detail->discount_id,'method'=>'DELETE','id'=>'del_badge_discount_form'.$badge_detail->discount_id)) }}
                                        <a href="#" class="delete_badge_discount" data-badge_discount_id="{{$badge_detail->discount_id}}"  title="Delete"><i class="fa fa-trash"></i>
                                        </a>

                                  {{Form::close()}}   
                              
                                </td>
                                
                                
                              </tr>
                            {{-- @endforeach   --}}
                          @endforeach  
                          @endif                         
                         
                          </tbody>
                        </table>

                      </div>
                    </div>
                  </div>


            <div class="col-md-4  col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Add Badge Discount</h2>
                  {{-- <ul class="nav navbar-right panel_toolbox">
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
                 {{-- Form --}}
                   <form action="{{url('admin/badge-discount')}}" method="POST">
                   {{csrf_field()}}
                      

                     <div class="form-group">
                      <label for="line_name">Select Badge:</label>
                        <select class="selectpicker form-control" name="badge_size_id[]" data-live-search="true" multiple title="Choose Badge">
                         @foreach($badge_sizes as $badge_size)
                         <option value="{{$badge_size->id}}">{{$badge_size->size_from}} * {{$badge_size->size_to}}</option>
                         @endforeach
                        </select>

                     </div>

                     <div class="form-group">
                        <label for="qyantity">Quantity:</label>
                        <br>
                        <input type="text" class="form-control" id="quantity_from" placeholder="From" name="quantity_from" required="true" style="width: 30%;display: inline-block;">
                        <span> - </span>
                        
                        <input type="text" class="form-control" id="quantity_to" 
                        placeholder="To" name="quantity_to" required="true" style="width: 30%;display: inline-block;">
                        
                      </div>

                      <div class="form-group">
                        <label for="discount_percent">Dicount Percent:</label>
                        <input type="text" class="form-control" id="discount_percent" placeholder="Enter discount_percent" name="discount_percent" required="true">
                      </div>
                     
                      <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
              </div>
            </div>
          </div>

  <!-- Modal -->
  <div class="modal fade" id="edit_badge_discount_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Badge Discount</h4>
        </div>
        <div class="modal-body">
         {{ Form::open(['url' => '', 'method' => 'put', 'class' => 'form-horizontal form-label-left', 'id' => 'edit_card_discount_form']) }}
                   
          <input type="hidden" name="badge_discount_id" id="badge_discount_id">
          
          <div class="form-group">
            <label for="line_name">Select Badge:</label>
            <span id="badge_size_select">
              
              
            </span>
            {{-- <select class="selectpicker form-control"  name="badge_size_id[]" data-live-search="true" multiple title="Choose Badge"> --}}
            {{--  @foreach($badge_sizes as $badge_size)
             <option value="{{$badge_size->id}}">{{$badge_size->size_from}} * {{$badge_size->size_to}}</option>
             @endforeach --}}
           {{-- </select> --}}

         </div>

         <div class="form-group">
          <label for="qyantity">Quantity:</label>
          <br>
          
          <input type="text" class="form-control" id="edit_quantity_from" placeholder="Enter qyantity" name="quantity_from" required="true" style="width: 30%;display: inline-block;">
          <span> - </span>
          <input type="text" class="form-control" id="edit_quantity_to" placeholder="Enter qyantity" name="quantity_to" required="true" style="width: 30%;display: inline-block;">
        </div>

        <div class="form-group">
          <label for="discount_percent">Dicount Percent:</label>
          <input type="text" class="form-control" id="edit_discount_percent" placeholder="Enter discount_percent" name="discount_percent" required="true">
        </div>
                       
        <button type="submit" class="btn btn-success">Submit</button>

        {{Form::close()}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>  
  {{-- Modal ended --}}
     
         <!-- footer content -->
        @include('user.admin.footer')
       
        <!-- /footer content -->
       
      </div>
      <!-- /page content -->

@endsection
