@extends('user.admin.admin-layout')
@section('title','System Users')
@section('content')



 	<div class="right_col" role="main">
      <!-- page content -->

 		 <div class="page-title">
            <div class="title_left">
              <h3>System Users</h3>
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
                        <h2>Users</h2>
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
                              <th>Name</th>
                              <th>Email</th>
                              <th>Role Title</th>
                              <th>Action</th>
                              
                            </tr>
                          </thead>
                          <tbody>
                           @if(count($results)>0)
                           @foreach($results as $result)
                            <tr>
                              <td>{{$result->first_name." ".$result->last_name }}</td>

                              <td>{{$result->email}}</td>
                              

                              <td>{{$result->title}}</td>
                              
                              <td>
                              <a href="#" class="edit_system_user" data-user_id="{{$result->u_id}}"><i class="fa fa-edit"></i></a> 

                                {{Form::open(array('url'=>'admin/system-user/'.$result->u_id,'method'=>'DELETE','id'=>'del_system_user'.$result->u_id)) }}
                                    <a href="#" class="delete_system_user" data-user_id="{{$result->u_id}}"  title="Delete"><i class="fa fa-trash"></i></a>

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


            <div class="col-md-4  col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Add System User</h2>
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
                   <form id="add_system_user" action="#" method="POST">
                   {{csrf_field()}}
                      

                     <div class="form-group">
                        <label for="first name">First Name:</label>
                        <input type="text" class="form-control" id="first_name" placeholder="Enter first name" name="first_name" required="true" onkeydown="return alphaOnly(event);" onblur="if (this.value == '') {document.getElementById('first_name').placeholder = 'Type Letters Only';}" onfocus="if (this.value == '') {document.getElementById('first_name').placeholder = 'First Name';}">
                      </div>

                      <div class="form-group">
                        <label for="last name">Last Name:</label>
                        <input type="text" class="form-control" id="last_name" placeholder="Enter last name" name="last_name" required="true" onkeydown="return alphaOnly(event);" onblur="if (this.value == '') {document.getElementById('last_name').placeholder = 'Type Letters Only';}" onfocus="if (this.value == '') {document.getElementById('last_name').placeholder = 'Last Name';}">
                      </div>
                       
                     

                      <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required="true">
                      </div>

                      <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required="true">
                      </div>

                      <div class="form-group">
                        <label for="confirm password">Confirm Password:</label>
                        <input type="password" class="form-control" id="confirm_password" placeholder="Enter confirm password" name="confirm_password" required="true">
                      </div>

                      <div class="form-group">
                      <label for="role_name">Select Role:</label>
                        <select class="selectpicker form-control" name="user_role" data-live-search="true"  title="Choose Role" required="true">
                         @foreach($user_roles as $user_role)
                         <option value="{{$user_role->id}}">{{$user_role->title}}</option>
                         @endforeach
                        </select>

                     </div>
                     
                      <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
              </div>
            </div>
          </div>

  <!-- Modal -->
  <div class="modal fade" id="edit_system_user_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit System User</h4>
        </div>
        <div class="modal-body">
         {{ Form::open(['url' => '', 'method' => 'put', 'class' => 'form-horizontal form-label-left', 'id' => 'edit_system_user_form']) }}

         <input type="hidden" name="user_id" id="user_id">

         <div class="form-group">
          <label for="first name">First Name:</label>
          <input type="text" class="form-control" id="edit_first_name" placeholder="Enter first name" name="first_name" required="true" onkeydown="return alphaOnly(event);" onfocus="if (this.value == '') {document.getElementById('edit_first_name').placeholder = 'Enter first Name';}">
        </div>

        <div class="form-group">
          <label for="last name">Last Name:</label>
          <input type="text" class="form-control" id="edit_last_name" placeholder="Enter last name" name="last_name" required="true" onkeydown="return alphaOnly(event);" onfocus="if (this.value == '') {document.getElementById('edit_last_name').placeholder = 'Enter last Name';}">
        </div>



        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="edit_email" placeholder="Enter email" name="email" required="true">
        </div>


        <div class="form-group">
          <label for="role_name">Select Role:</label>
         <span id="user_role_select"></span>

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
    <script type="text/javascript">
    function alphaOnly(event) {
       var key = event.keyCode;
       return ((key >= 65 && key <= 90) || key == 8 || key == 9);
}
  </script>
  {{-- Modal ended --}}
     
         <!-- footer content -->
        @include('user.admin.footer')
       
        <!-- /footer content -->
       
      </div>
      <!-- /page content -->

@endsection
