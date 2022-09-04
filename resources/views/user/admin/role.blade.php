@extends('user.admin.admin-layout')
@section('title','Role Management')
@section('content')



 	<div class="right_col" role="main">
      <!-- page content -->

 		 <div class="page-title">
            <div class="title_left">
              <h3>Role Management</h3>
            </div>
            <div class="title_right">
              {{-- <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                </div>
              </div>s --}}
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
                        <h2>Role</h2>
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
                              <th>Title</th>
                              <th>Action</th>
                              
                            </tr>
                          </thead>
                          <tbody>
                           @if(count($roles)>0)
                           @foreach($roles as $role)
                            <tr>
                              <td>{{$role->title}}</td>
                              <td>
                              @if($role->id !=1)
                              <a href="#" class="edit_role" data-role_id="{{$role->id}}"><i class="fa fa-edit"></i></a> 
                              
                                {{Form::open(array('url'=>'admin/role/'.$role->id,'method'=>'DELETE','id'=>'del_role_form'.$role->id)) }}
                                    {{-- <a href="#" class="delete_role" data-role_id="{{$role->id}}"  title="Delete"><i class="fa fa-trash"></i></a> --}}

                                {{Form::close()}}   
                              @endif
                              </td>
                              
                              
                            </tr>
                          @endforeach  
                          @endif                         
                         
                          </tbody>
                        </table>

                      </div>
                    </div>
                  </div>


           {{--  <div class="col-md-4  col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Add Role</h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                 
                   <form action="{{url('admin/role')}}" method="POST">
                   {{csrf_field()}}
                      

                     <div class="form-group">
                        <label for="price">Title:</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" required="true">
                     </div>
                       
                     
                     
                      <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
              </div>
            </div> --}}
          </div>

  <!-- Modal -->
  <div class="modal fade" id="edit_role_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Role</h4>
        </div>
        <div class="modal-body">
         {{ Form::open(['url' => '', 'method' => 'put', 'class' => 'form-horizontal form-label-left', 'id' => 'edit_role_form']) }}
                   
          <input type="hidden" name="role_id" id="role_id">
          
              <div class="form-group">
                 <label for="price">Title:</label>
                  <input type="text" class="form-control" id="edit_title" placeholder="Enter title" name="title" required="true">
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
