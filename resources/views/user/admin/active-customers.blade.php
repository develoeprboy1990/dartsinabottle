@extends('user.admin.admin-layout')
@section('title','Customers')
@section('content')



 	<div class="right_col" role="main">
      <!-- page content -->

 		 <div class="page-title">
            <div class="title_left">
              <h3>Customers</h3>
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
                        <h2>Customers</h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li> <a class="btn btn-primary" id="send_mail_all_btn">Send Mail to All</a>
                          </li>
                          {{-- <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#">Settings 1</a>
                              </li>
                              <li><a href="#">Settings 2</a>
                              </li>
                            </ul>
                          </li> --}}
                         {{--  <li><a href="#"><i class="fa fa-close"></i></a>
                          </li> --}}
                        </ul>
                        <div class="clearfix"></div>
                      </div>

                      <div class="x_content">
                        {{-- Advance Search Start --}}

                      <div class="advanced-search">
                                <form id="searchForm">
                                    {{csrf_field()}}
                                <input type="hidden" id="page_status" name="page_status" value="{{$status}}">    
                             

                                 <div class="col-md-3 col-xs-12 form-field">

                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="first_name_advance_search" id="first_name_advance_search">
                                    </div>
                                </div>

                                <div class="col-md-3 col-xs-12 form-field">

                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" name="last_name_advance_search" id="last_name_advance_search">
                                    </div>
                                </div>

                                 <div class="col-md-3 col-xs-12 form-field">

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email_advance_search" id="email_advance_search">
                                    </div>
                                </div>

                                <!-- <div class="col-md-3 col-xs-12 form-field">

                                    <div class="form-group">
                                        <label>Customer Group</label>
                                        <select class="selectpicker form-control"  name="group_name"  data-live-search="true" data-live-search-style="startsWith"  title="Choose Customer Group" id="group_name">

                                            @foreach($customer_groups as $result)
                                                <option value="{{$result->id}}">{{$result->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div> -->


                                 <div class="col-md-3 col-xs-12 form-field">

                                 <div class="form-group">
                                        <label>Country</label>
                                        <select class="selectpicker form-control"  name="country_advance_search"  data-live-search="true" data-live-search-style="startsWith"  title="Choose Country" id="country_advance_search">

                                            @foreach($countries as $result)
                                                <option value="{{$result->id}}">{{$result->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                
                                <span id="span_state">
                                <div class="col-md-3 col-xs-12 form-field">

                                    <div class="form-group">
                                        <label>State</label>
                                        <select class="selectpicker form-control"  name="state_advance_search"  data-live-search="true" data-live-search-style="startsWith"  title="Choose State" id="state_advance_search">

                                           

                                        </select>
                                    </div>
                                </div>
                                </span>


                                <span id="span_city"> 
                                <div class="col-md-3 col-xs-12 form-field">

                                <div class="form-group">
                                        <label>City</label>
                                        <select class="selectpicker form-control"  name="city_advance_search"  data-live-search="true" data-live-search-style="startsWith"  title="Choose City" id="city_advance_search">

                                           
                                        </select>
                                </div>
                                </div>
                                </span> 






                                <div class="col-xs-12 form-field">
                                    <input type="button" id="searchBtn" class="btn btn-primary" style="background: #9167b7;" value="Search">
                                </div>

                                <div class="col-md-3 col-xs-12">
                                 </div>
                                <div class="col-md-4 col-xs-12 buttns"> </div>
                                </form>
                            </div>
                            <br>
                      {{-- Advance Search End --}}

                      <a class="btn btn-primary" id="send_mail_to_selected_users" style="display: none;">Send Mail to Selected Users</a>

                      <span id="get_ad_listing_table_from_javascript"></span>


                        <table id="customer_table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th></th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>PayPal Email</th>
                              <th>SET</th> 
                              <th>Deposit</th> 
                              <th>Shipping Country</th>
                              <th>City</th>
                              <th>Postal Code</th>
                              <th>User Status</th>
                              <th>Created At</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          @if(count($users)>0)
                          
                           @foreach($users as $user)
                            <tr>
                              <td>
                               <input type="checkbox"  value="{{ $user->email }}" class="check checkSingle">
                              </td>
                              <td>{{$user->first_name}}  {{$user->last_name}}</td>
                              <td>{{$user->email}}</td>
                              <td>{{$user->paypal_email}}</td>

                              <td>{{@$user->getSubscription->getProductDetail->getPackage->darts_set}}</td>
                              <td>£{{@$user->check_deporit($user->id)}}</td>

                              <td>{{(@$user->getCountry->name=="")?"Not provided yet":@$user->getCountry->name}}</td>
                              <td>{{(@$user->getShippingDetail->city_id=="")?"Not provided yet":@$user->getShippingDetail->city_id}}</td>
                              <td>{{(@$user->getShippingDetail->zip=="")?"Not provided yet":@$user->getShippingDetail->zip}}</td>
                              

                               @if($user->user_status == 0 )
                                
                                  @php
                                    $user_status="Pending";
                                  @endphp

                               @elseif($user->user_status == 1 )
                                  
                                  @php
                                    $user_status="Active";
                                  @endphp
                               @elseif($user->user_status == 2 )
                                  
                                  @php
                                    $user_status="Suspended";
                                  @endphp   
                               
                               @elseif($user->user_status == 3 )
                                  
                                  @php
                                    $user_status="Subscribed";
                                  @endphp   
                               
                              
                              @endif  

                              <td>{{$user_status}}</td>
                              
                              <td>{{$user->created_at}}</td>
                              
                               
                              
                              <td>
                             {{--  <a href="#" class="edit_bade_size" data-badge_size_id="{{$user->id}}"><i class="fa fa-edit"></i></a>  --}}

                               {{--  {{Form::open(array('url'=>'admin/badge-size/'.$user->id,'method'=>'DELETE','id'=>'del_badge_size_form'.$user->id)) }}
                                    <a href="#" class="delete_badge_size" data-badge_size_id="{{$user->id}}"  title="Delete"><i class="fa fa-trash"></i></a>

                                {{Form::close()}}   --}} 
                              
                               <a href="{{url('admin/customer/'.$user->id.'/detail')}}"><i class="fa fa-eye"></i></a> 
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
  <div class="modal fade" id="edit_bade_size_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Badge Size</h4>
        </div>
        <div class="modal-body">
         {{ Form::open(['url' => '', 'method' => 'put', 'class' => 'form-horizontal form-label-left', 'id' => 'edit_card_size_form']) }}
                   
                   <input type="hidden" name="badge_size_id" id="badge_size_id">
                      <div class="form-group ">
                        <label for="text">Size:</label>
                        <br>
                      

                        <input type="text" class="form-control size-control1" id="update_size_from" placeholder="Enter size" name="size_from">
                        <span>*</span>
                        <input type="text" class="form-control size-control2" id="update_size_to" placeholder="Enter size" name="size_to" required="true">



                        
                       
                      </div>

                     <div class="form-group">
                        <label for="price">Weight:</label>
                        <input type="text" class="form-control" id="update_weight" placeholder="Enter weight" name="weight" required="true">
                      </div>


                      <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" class="form-control" id="update_price" placeholder="Enter price" name="price" required="true">
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

  <!-- Send Mail to All Users Modal Start -->
<div id="mailModal" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3>Send Email
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </h3>
      </div>
      <form action="{{ url('admin/send-mail-to-users') }}" id="sendMailForm" method="post">
        <div class="modal-body"> {{ csrf_field() }}
          
          <label>Subject</label>
          <input type="text" name="subject" class="form-control" id="subject_for_all_users">
          <label>Message</label>
          <textarea class="form-control" name="message"  id="messsage_body_for_all_users"></textarea >
          
          <input type="hidden" name="page_status_mail_modal" value="{{$status}}">
          <input type="hidden" name="first_name_mail_modal" id="first_name_mail_modal">
          <input type="hidden" name="last_name_mail_modal" id="last_name_mail_modal">
          <input type="hidden" name="email_mail_modal" id="email_mail_modal">
          <input type="hidden" name="group_name_mail_modal" id="group_name_mail_modal">
          <input type="hidden" name="country_mail_modal" id="country_mail_modal">
          <input type="hidden" name="state_mail_modal" id="state_mail_modal">
          <input type="hidden" name="city_mail_modal" id="city_mail_modal">

          
         
        </div>
        {{-- <div class="col-md-offset-5">
          <label>
            <input type="checkbox" value="1" class="form-control" name="sendemail">
            Send Email </label>
        </div> --}}
        <div class="modal-footer">
          {{-- <button type="submit" class="btn btn-danger" id="subBtn" onclick="$('#sendMailForm')[0].reset();">Clear</button> --}}
          <button type="submit" class="btn btn-primary" id="subBtn2">Send</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Send Mail to All Users Modal Ended  -->

  <!-- Send Mail to Selected Users Modal Start -->
<div id="mailModalForSelectedUsers" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3>Send Email
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </h3>
      </div>
      <form  id="sendMailFormForSelectedUsers" method="post">
        <div class="modal-body"> {{ csrf_field() }}
          
          <label>Subject</label>
          <input type="text" name="subject" class="form-control" id="subject_for_selected_users">
          <label>Message</label>
          <textarea class="form-control" name="message"  id="messsage_body_for_selected_users"></textarea>
         
        </div>
        {{-- <div class="col-md-offset-5">
          <label>
            <input type="checkbox" value="1" class="form-control" name="sendemail">
            Send Email </label>
        </div> --}}
        <div class="modal-footer">
          {{-- <button type="submit" class="btn btn-danger" id="subBtn" onclick="$('#sendMailForm')[0].reset();">Clear</button> --}}
          <button type="submit" class="btn btn-primary">Send</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Send Mail to Selected Users Modal Ended  -->

{{-- authorize payment loader --}}
<div class="modal fade" id="authorize_loader_modal" role="dialog">
<div class="modal-dialog modal-sm">
<div class="modal-content">

<div class="modal-body">
  <h3 style="text-align:center;">Please wait</h3>

  <p style="text-align:center;"><img src="{{url('public/uploads/gif/waiting.gif')}}"></p>
</div>

</div>
</div>
</div>
{{-- Authorize Payment Loader Ended --}}
     
         <!-- footer content -->
        @include('user.admin.footer')
       
        <!-- /footer content -->
       
      </div>
      <!-- /page content -->

@endsection
