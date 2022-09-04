@extends('user.admin.admin-layout')
@section('title','Badge Coupon')
@section('content')


 	<div class="right_col" role="main">
      <!-- page content -->

 		 <div class="page-title">
            <div class="title_left">
              <h3>Promo Code</h3>
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

          <p>
            <button class="btn btn-primary pull-right" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
              Add Promo Code
            </button>
          </p>
          <div class="clearfix"></div>

          <div class="collapse" id="collapseExample">
            <div class="card card-body">
              <div class="row" id="coupon_code_div">
                <div class="col-md-12  col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Add Promo Code</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <br />
                       <form action="{{url('admin/badge-coupon')}}" method="POST">
                       {{csrf_field()}}
                         <div class="form-group">
                            <label for="coupon_code">Promo Code:</label>
                            <input type="text" class="form-control" id="coupon_code" placeholder="Enter Coupon Code" name="coupon_code" required="true">
                          </div>
                          <div class="form-group">
                          <label for="line_name">Select Type:</label>
                            <select class="selectpicker form-control" name="type" data-live-search="true"  title="Choose Type">
                            <option value="Fixed" selected="selected">Fixed</option>
                            <option value="Percentage">Percentage</option>
                            </select>
                         </div>

                          <div class="form-group">
                            <label for="discount_percent">Dicount:</label>
                            <input type="text" class="form-control" id="discount" placeholder="Enter Discount" name="discount" required="true">
                          </div>

                          <div class="form-group">
                            <label for="number_to_be_used">Use up to:</label>
                            <input type="text" class="form-control" id="number_to_be_used" placeholder="Enter Number of time to be used" name="number_to_be_used" required="true">
                          </div>

                           <div class="form-group">
                            <label for="expiry_date">Date of Expiry:</label>
                            <input type="date" class="form-control" id="expiry_date" placeholder="mm/dd/yyyy" name="expiry_date" required="true">
                          </div>
                         
                          <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                  </div>
                </div>
              
              </div>
            </div>
          </div>



          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Promo Code</h2>
                      
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content x_cont">
                        <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Code</th>
                              <th>Type</th>
                              <th>Discount</th>
                              <th>Canbeused</th>
                              <th>Status</th>
                              <th>Expiry Date</th>
                              <th>Action</th>
                              
                            </tr>
                          </thead>
                          <tbody>
                           @if(count($badge_coupons)>0) 
                           @foreach($badge_coupons as $badge_coupon)
                              <tr>
                                <td>{{$badge_coupon->coupon_code}}</td>
                                <td>{{$badge_coupon->type}}</td>
                                <td>{{$badge_coupon->discount}}</td>
                                <td>{{$badge_coupon->number_to_be_used}}</td>
                                <td>{{$badge_coupon->status}}</td>
                                <td>{{$badge_coupon->expiry_date}}</td>
                                <td>
                                  <a href="#" class="edit_badge_coupon" data-badge_coupon_id="{{$badge_coupon->id}}"><i class="fa fa-edit"></i></a> 

                                    {{Form::open(array('url'=>'admin/badge-coupon/'.$badge_coupon->id,'method'=>'DELETE','id'=>'del_badge_coupon_form'.$badge_coupon->id)) }}
                                        <a href="#" class="delete_badge_coupon" data-badge_coupon_id="{{$badge_coupon->id}}"  title="Delete"><i class="fa fa-trash"></i>
                                        </a>
                                  {{Form::close()}}   
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
  <div class="modal fade" id="edit_badge_coupon_modal" role="dialog">
    <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Promo Code</h4>
        </div>
        <div class="modal-body">
         {{ Form::open(['url' => '', 'method' => 'put', 'class' => 'form-horizontal form-label-left', 'id' => 'edit_card_coupon_form']) }}
          <input type="hidden" name="badge_coupon_id" id="badge_coupon_id">
          <div class="form-group">
          <label for="coupon_code">Coupon Code:</label>
          <input type="text" class="form-control" id="edit_coupon_code" placeholder="Enter Coupon Code" name="coupon_code" required="true">
          </div>
          <div class="form-group">
          <label for="line_name">Select Type:</label>
          <select class="selectpicker form-control" name="type" id="edit_type"  title="Choose Type">
          <option value="Fixed">Fixed</option>
          <option value="Percentage">Percentage</option>
          </select>
          </div>
          <div class="form-group">
          <label for="discount_percent">Dicount:</label>
          <input type="text" class="form-control" id="edit_discount" placeholder="Enter Discount" name="discount" required="true">
          </div>
          <div class="form-group">
              <label for="number_to_be_used">Use up to:</label>
              <input type="text" class="form-control" id="edit_number_to_be_used" placeholder="Enter Number of time to be used" name="number_to_be_used" required="true">
            </div>
          <div class="form-group">
              <label for="expiry_date">Date of Expiry:</label>
              <input type="date" class="form-control" id="edit_expiry_date" placeholder="mm/dd/yyyy" name="expiry_date" required="true">
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
