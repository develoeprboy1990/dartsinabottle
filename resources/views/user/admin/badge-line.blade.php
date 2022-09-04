@extends('user.admin.admin-layout')
@section('title','Badge Line')
@section('content')



 	<div class="right_col" role="main">
      <!-- page content -->

 		 <div class="page-title">
            <div class="title_left">
              <h3>Badge Line</h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
               {{--  <div class="input-group">
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
            <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Badge Line</h2>
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
                              <th>Line Name</th>
                              
                              <th>Price</th>
                              <th>Action</th>
                              
                            </tr>
                          </thead>
                          <tbody>
                           @if(count($badge_lines)>0)
                           @foreach($badge_lines as $badge_line)
                            <tr>
                              <td>{{$badge_line->name}}</td>
                          

                            
                              <td>${{$badge_line->price}}</td>
                              <td>
                              <a href="#" class="edit_badge_line" data-badge_line_id="{{$badge_line->id}}"><i class="fa fa-edit"></i></a> 

                                {{-- {{Form::open(array('url'=>'admin/badge-line/'.$badge_line->id,'method'=>'DELETE','id'=>'del_badge_line_form'.$badge_line->id)) }}
                                    <a href="#" class="delete_badge_line" data-badge_line_id="{{$badge_line->id}}"  title="Delete"><i class="fa fa-trash"></i></a>

                                {{Form::close()}}    --}}
                            
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
                  {{-- <h2>Add Badge Line</h2> --}}
                  <h2>Details</h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                 {{-- Form --}}
                 {{--   <form action="{{url('admin/badge-line')}}" method="POST">
                   {{csrf_field()}}
                      

                     <div class="form-group">
                      <label for="line_name">Select Line:</label>
                        <select class="form-control" name="line_name" id="line_name" required="true">
                          <option value="">Choose Line</option>
                          <option value="Single Line">Single Line</option>
                          <option value="Double Lines">Double Lines</option>
                          
                        </select>
                     </div>

                     

                      <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" class="form-control" id="price" placeholder="Enter price" name="price" required="true">
                      </div>
                     
                      <button type="submit" class="btn btn-success">Submit</button>
                    </form> --}}
                <p>
                  Single line
                </p>  
                <p>Double line</p>
                </div>
              </div>
            </div>
          </div>

  <!-- Modal -->
  <div class="modal fade" id="edit_badge_line_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Badge Line Price</h4>
        </div>
        <div class="modal-body">
         {{ Form::open(['url' => '', 'method' => 'put', 'class' => 'form-horizontal form-label-left', 'id' => 'edit_card_line_form']) }}
                   
          <input type="hidden" name="badge_line_id" id="badge_line_id">
          
           
                 
            

              <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="edit_price" placeholder="Enter price" name="price" required="true">
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
