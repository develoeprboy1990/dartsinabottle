@extends('user.admin.admin-layout')
@section('title','Badge Font')
@section('content')



 	<div class="right_col" role="main">
      <!-- page content -->

 		 <div class="page-title">
            <div class="title_left">
              <h3>Badge Font</h3>
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
                        <h2>Badge Font</h2>
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
                              <th>Font Family Name</th>
                              
                              <th>Price</th>
                              <th>Action</th>
                              
                            </tr>
                          </thead>
                          <tbody>
                           @if(count($badge_fonts)>0)
                           @foreach($badge_fonts as $badge_font)
                            <tr>
                              <td>{{$badge_font->title}}</td>
                              <td>{{$badge_font->font_family_name}}</td>
                          

                            
                              <td>${{$badge_font->price}}</td>
                              <td>
                              <a href="#" class="edit_badge_font" data-badge_font_id="{{$badge_font->id}}"><i class="fa fa-edit"></i></a> 

                                {{Form::open(array('url'=>'admin/badge-font/'.$badge_font->id,'method'=>'DELETE','id'=>'del_badge_font_form'.$badge_font->id)) }}
                                    <a href="#" class="delete_badge_font" data-badge_font_id="{{$badge_font->id}}"  title="Delete"><i class="fa fa-trash"></i></a>

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
                  <h2>Add Badge Font</h2>
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
                   <form action="{{url('admin/badge-font')}}" method="POST">
                   {{csrf_field()}}
                      
                      <div class="form-group">
                        <label for="price">Title:</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title" required="true" onkeydown="return alphaOnly(event);" onblur="if (this.value == '') {document.getElementById('title').placeholder = 'Type Letters Only';}" onfocus="if (this.value == '') {document.getElementById('title').placeholder = 'Enter Title';}">
                      </div>
                     

                     <div class="form-group">
                        <label for="price">Font Family Name:</label>
                        <input type="text" class="form-control" id="font_family_name" placeholder="Enter Font Family Name" name="font_family_name" required="true" onkeydown="return alphaOnly(event);" onblur="if (this.value == '') {document.getElementById('font_family_name').placeholder = 'Type Letters Only';}" onfocus="if (this.value == '') {document.getElementById('font_family_name').placeholder = 'Enter Font Family Name';}">
                      </div>
                     

                     

                      <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" id="price" placeholder="Enter price" name="price" required="true">
                      </div>
                     
                      <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
              </div>
            </div>
          </div>

  <!-- Modal -->
  <div class="modal fade" id="edit_badge_font_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Font Family</h4>
        </div>
        <div class="modal-body">
         {{ Form::open(['url' => '', 'method' => 'put', 'class' => 'form-horizontal form-label-left', 'id' => 'edit_card_font_form']) }}
                   
          <input type="hidden" name="badge_font_id" id="badge_font_id">
          
              <div class="form-group">
                <label for="font fmaily">Title:</label>
                <input type="text" class="form-control" id="edit_title" placeholder="Enter Title" name="title" required="true" onkeydown="return alphaOnly(event);" onfocus="if (this.value == '') {document.getElementById('edit_title').placeholder = 'Enter Title';}">
              </div>
                 
                 <div class="form-group">
                <label for="font fmaily">Font Family Name:</label>
                <input type="text" class="form-control" id="edit_font_family_name" placeholder="Enter Font Family" name="font_family_name" required="true" onkeydown="return alphaOnly(event);" onfocus="if (this.value == '') {document.getElementById('edit_font_family_name').placeholder = 'Enter Font Family';}">
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
