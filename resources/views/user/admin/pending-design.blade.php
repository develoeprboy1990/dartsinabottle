@extends('user.admin.admin-layout')
@section('title','Pending Designs')
@section('content')



 	<div class="right_col" role="main">
      <!-- page content -->

 		 <div class="page-title">
            <div class="title_left">
              <h3>Pendign Design</h3>
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
            <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Orders</h2>
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

                      <div class="x_content">
                       {{--  <p class="text-muted font-13 m-b-30">
                          Responsive is an extension for DataTables that resolves that problem by optimising the table's layout for different screen sizes through the dynamic insertion and removal of columns from the table.
                        </p> --}}
                        <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Customer Name</th>
                              <th>Customer Email</th>
                              <th>Order Number</th>
                              <th>Order Type</th>
                              <th>Payment Type</th>
                              <th>Payment</th>
                              <th>Created At</th>
                              <th>Action</th>
                              
                            </tr>
                          </thead>
                          <tbody>
                           @if(count($order_details)>0)
                           @foreach($order_details as $order_detail)
                            <tr>
                              <td>{{$order_detail->getUser->first_name." ".$order_detail->getUser->last_name }}</td>
                              <td>{{$order_detail->getUser->email}}</td>
                              <td>{{$order_detail->order_number}}</td>
                              @if($order_detail->order_type == 0)
                              @php
                                $order_type="Normal Order";
                              @endphp
                              @else
                              @php
                                $order_type="Custom Badge Order";
                              @endphp
                              @endif
                              <td>{{@$order_type}}</td>
                              <td>{{@$order_detail->getPaymentType->name}}</td>
                              <td>{{($order_detail->payment_status == 1)?"Done":"Pending"}}</td>
                              <td>{{$order_detail->created_at}}</td>
                              <td>
                              <a href="{{url('admin/order/'.$order_detail->id.'/detail')}}" class=""><i class="fa fa-eye"></i></a> 

                             {{--    {{Form::open(array('url'=>'admin/badge-color/'.$order_detail->id,'method'=>'DELETE','id'=>'del_badge_color_form'.$order_detail->id)) }}
                                    <a href="#" class="delete_badge_color" data-badge_color_id="{{$order_detail->id}}"  title="Delete"><i class="fa fa-trash"></i></a>

                                {{Form::close()}}  --}}  
                            
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

  <!-- Modal -->
  <div class="modal fade" id="edit_bade_color_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Badge Color</h4>
        </div>
        <div class="modal-body">
         {{ Form::open(['url' => '', 'method' => 'put', 'class' => 'form-horizontal form-label-left', 'id' => 'edit_card_color_form']) }}
                   
          <input type="hidden" name="badge_color_id" id="badge_color_id">
          
              <div class="form-group">
                 <label for="price">Title:</label>
                  <input type="text" class="form-control" id="edit_title" placeholder="Enter title" name="title">
              </div>
                         
             <div class="form-group">
                <label for="price">Color:</label>
                <input name="hexa_value" id="edit_hexa_value" class="form-control jscolor" value="#E3E3E3">
                
              </div>

              <div class="form-group">
                <label for="price">CMYK:</label>
                <input type="text" class="form-control" id="edit_cmyk" placeholder="Enter cmyk value" name="cmyk">
              </div>

              <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="edit_price" placeholder="Enter price" name="price">
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
