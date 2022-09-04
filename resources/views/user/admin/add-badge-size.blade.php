@extends('user.admin.admin-layout')
@section('title','Badge Size')
@section('content')



 	<div class="right_col" role="main">
      <!-- page content -->

 		 <div class="page-title">
            <div class="title_left">
              <h3>Badge Size</h3>
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
                        <h2>Badge Size</h2>
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
                              <th>Size</th>
                              <th>Weight</th>
                              <th>Price</th>
                              <th>Image</th>
                              <th>Empty Image</th>
                              <th>Transparent Image</th>
                              <th>Action</th>
                              
                            </tr>
                          </thead>
                          <tbody>
                           @foreach($badge_sizes as $badge_size)
                            <tr>
                              <td>{{$badge_size->size_from}} x {{$badge_size->size_to}}</td>
                              <td>{{$badge_size->weight}} Oz</td>
                              <td>${{$badge_size->price}}</td>
                              <td><a href="{{url('public/uploads/badge_img/'.$badge_size->image)}}"><img src="{{url('public/uploads/badge_img/'.$badge_size->image)}}" height="100px" width="100px"></a></td>

                              <td><a href="{{url('public/uploads/badge_img/'.$badge_size->empty_image)}}"><img src="{{url('public/uploads/badge_img/'.$badge_size->empty_image)}}" height="100px" width="100px"></a></td>

                              <td><a href="{{url('public/uploads/badge_img/'.$badge_size->transparent_image)}}"><img src="{{url('public/uploads/badge_img/'.$badge_size->transparent_image)}}" height="100px" width="100px"></a></td>
                              
                              <td>
                              <a href="#" class="edit_bade_size" data-badge_size_id="{{$badge_size->id}}"><i class="fa fa-edit"></i></a> 

                                {{Form::open(array('url'=>'admin/badge-size/'.$badge_size->id,'method'=>'DELETE','id'=>'del_badge_size_form'.$badge_size->id)) }}
                                    <a href="#" class="delete_badge_size" data-badge_size_id="{{$badge_size->id}}"  title="Delete"><i class="fa fa-trash"></i></a>

                                {{Form::close()}}   
                            
                              </td>
                              
                              
                            </tr>
                          @endforeach                           
                         
                          </tbody>
                        </table>

                      </div>
                    </div>
                  </div>


            <div class="col-md-4  col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Add Badge Size</h2>
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
                   <form action="{{url('admin/badge-size')}}" method="POST" enctype="multipart/form-data">
                   {{csrf_field()}}
                      <div class="form-group ">
                        <label for="text">Size:</label>
                        <br>
                      

                        <input type="text" class="form-control size-control1" id="size_from" placeholder="Enter size" name="size_from" required="true" onkeypress="return isNumber(event)">
                        <span>*</span>
                        <input type="text" class="form-control size-control2" id="size_to" placeholder="Enter size" name="size_to" required="true" onkeypress="return isNumber(event)">



                        
                       
                      </div>

                     <div class="form-group">
                        <label for="price">Weight:</label>
                        <input type="text" class="form-control" id="weight" placeholder="Enter weight" name="weight" required="true">
                      </div>


                      <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" class="form-control" id="price" placeholder="Enter price" name="price" required="true">
                      </div>

                      <div class="form-group">
                        <label>Available Types</label>
                        <select class="a_badge_types" multiple  name="a_badge_types[]"  id="a_badge_types" required="">
                          @foreach($badge_types as $badge_type) 
                           <option value="{{$badge_type->id}}">{{$badge_type->title}}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" class="form-control" id="image" name="image" required="true" accept=".jpg,.jpeg,.png" onchange="validateFileType()">
                      </div>

                       <div class="form-group">
                        <label for="image">Empty Image:</label>
                        <input type="file" class="form-control" id="empty_image" name="empty_image" required="true" accept=".jpg,.jpeg,.png" onchange="validateFileType1()">
                      </div>

                      <div class="form-group">
                        <label for="image">Transparent Image:</label>
                        <input type="file" class="form-control" id="transparent_image" name="transparent_image" required="true" accept=".jpg,.jpeg,.png" onchange="validateFileType2()">
                      </div>
                       
                      <button type="submit" class="btn btn-success">Submit</button>
                    </form>
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
                      

                        <input type="text" class="form-control size-control1" id="update_size_from" placeholder="Enter size" name="size_from" onkeypress="return isNumber(event)">
                        <span>*</span>
                        <input type="text" class="form-control size-control2" id="update_size_to" placeholder="Enter size" name="size_to" required="true" onkeypress="return isNumber(event)">



                        
                       
                      </div>

                     <div class="form-group">
                        <label for="price">Weight:</label>
                        <input type="text" class="form-control" id="update_weight" placeholder="Enter weight" name="weight" required="true">
                      </div>


                      <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" class="form-control" id="update_price" placeholder="Enter price" name="price" required="true">
                      </div>

                      <div class="form-group">
                        <label>Available Types</label>
                        <select class="e_badge_types" multiple  name="a_badge_sizes[]"  id="e_products" required="">
                          @foreach($badge_types as $badge_type) 
                           <option value="{{$badge_type->id}}">{{$badge_type->title}}</option>
                          @endforeach
                        </select>
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
   function isNumber(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57 || charCode == 9))
             return false;

          return true;
       }

    function validateFileType(){
        var fileName = document.getElementById("image").value;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
            return true;
        }else{
            alert("Only jpg/jpeg and png files are allowed!");
      document.getElementById('image').value = null; 
      return false;
        }   
    }

      function validateFileType1(){
        var fileName = document.getElementById("empty_image").value;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
            return true;
        }else{
            alert("Only jpg/jpeg and png files are allowed!");
      document.getElementById('empty_image').value = null; 
      return false;
        }   
    }

    function validateFileType2(){
        var fileName = document.getElementById("transparent_image").value;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
            return true;
        }else{
            alert("Only jpg/jpeg and png files are allowed!");
      document.getElementById('transparent_image').value = null; 
      return false;
        }   
    }
</script>

  {{-- Modal ended --}}
     
         <!-- footer content -->
        @include('user.admin.footer')
       
        <!-- /footer content -->
       
      </div>
      <!-- /page content -->

@endsection
