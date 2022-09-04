@extends('user.admin.admin-layout')
@section('title','Badge Color')
@section('content')



 	<div class="right_col" role="main">
      <!-- page content -->

 		 <div class="page-title">
            <div class="title_left">
              <h3>Badge Color</h3>
            </div>
            <div class="title_right">
              {{-- <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                </div>
              </div> --}}
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
                        <h2>Badge Color</h2>
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
                              <th>Color Code</th>
                              <th>CMYK</th>
                              <th>Price</th>
                              <th>Action</th>
                              
                            </tr>
                          </thead>
                          <tbody>

                           @if(count($badge_colors)>0)
                           @foreach($badge_colors as $badge_color)
                            <tr>
                              <td>{{$badge_color->title}}</td>
                              <td>{{-- <span >

                               </span> --}}
                               <div style="background-color: {{"#".$badge_color->hexa_value}}; width: 20px; height: 20px;"> </div>
                              #{{$badge_color->hexa_value}}</td>

                              <td>{{$badge_color->cmyk}}</td>
                              <td>${{$badge_color->price}}</td>
                              <td>
                              <a href="#" class="edit_bade_color" data-badge_color_id="{{$badge_color->id}}"><i class="fa fa-edit"></i></a> 

                                {{Form::open(array('url'=>'admin/badge-color/'.$badge_color->id,'method'=>'DELETE','id'=>'del_badge_color_form'.$badge_color->id)) }}
                                    <a href="#" class="delete_badge_color" data-badge_color_id="{{$badge_color->id}}"  title="Delete"><i class="fa fa-trash"></i></a>

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
                  <h2>Add Badge Color</h2>
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
                   <form action="{{url('admin/badge-color')}}" method="POST">
                   {{csrf_field()}}
                      

                     <div class="form-group">
                        <label for="price">Title:</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" required="true">
                      </div>
                       
                     <div class="form-group">
                        <label for="price">Color:</label>
                        <input name="hexa_value" id="hexa_value" class="form-control jscolor" value="#E3E3E3" required="true">
                        
                      </div>

                      <div class="form-group">
                        <label for="price">CMYK:</label>
                        <input type="text" class="form-control" id="cmyk" placeholder="Enter cmyk value" name="cmyk" required="true">
                      </div>

                      <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" class="form-control" id="price" placeholder="Enter price" name="price" required="true">
                      </div>
                     
                      <button type="submit" class="btn btn-success">Submit</button>
                    </form>
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
                  <input type="text" class="form-control" id="edit_title" placeholder="Enter title" name="title" required="true">
              </div>
                         
             <div class="form-group">
                <label for="price">Color:</label>
                <input name="hexa_value" id="edit_hexa_value" class="form-control jscolor" value="#E3E3E3" required="true">
                
              </div>

              <div class="form-group">
                <label for="price">CMYK:</label>
                <input type="text" class="form-control" id="edit_cmyk" placeholder="Enter cmyk value" name="cmyk" required="true">
              </div>

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
