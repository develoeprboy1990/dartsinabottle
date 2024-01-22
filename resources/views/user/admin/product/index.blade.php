@extends('user.admin.admin-layout')
@section('title','Darts')
@section('content')
 	<div class="right_col" role="main">
      <!-- page content -->
 		 <div class="page-title">
            <div class="title_left">
              <h3>Darts</h3>
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
               <a href="javascript:void(0);" class="close" data-dismiss="alert" aria-label="close">×</a>
               {{Session::get('successmessage')}}
              </div>
            @endif
          <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Darts</h2>
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
                              <th>Weight Range</th>
                              <th>Weight</th>
                              <th>Length*Width</th>
                              <th>Price Type</th>
                              <th>Price</th>
                              <th>Description</th>
                              <th>User</th>
                              <th>Current Holder</th>
                              <th>Image</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                           @foreach($products as $product)
                            <tr>
                              <td>{{$product->product_name}}</td>
                              <td>{{$product->product_weight_range}}</td>
                              <td>{{$product->product_weight}}</td>
                              <td>{{@$product->product_length}}*{{@$product->product_width}}</td>
                              <td>
                                @php
                                $product_price_type = '';
                                if($product->product_price_type == "for_sale")
                                {
                                  $product_price_type="For Sale";
                                } 
                                elseif ($product->product_price_type == "not_for_sale") 
                                {
                                  $product_price_type="Not For Sale";
                                } 
                                @endphp
                                {{$product_price_type}}
                              </td>
                              <td>
                                @php
                                $product_price = '';
                                if($product->product_price != "")
                                {
                                  $product_price = '£'.$product->product_price;
                                } 
                                @endphp
                                {{$product_price}}</td>
                              <td>{!! $product->product_description !!}</td>
                              <td>{{@$product->getUser->first_name." ".@$product->getUser->last_name }}</td>
                              <td>{{@$product->getCurrentHolder->getUser->first_name." ".@$product->getCurrentHolder->getUser->last_name}}</td>
                              <td><a href="{{url('public/uploads/darts_img/'.$product->product_image)}}"><img src="{{url('public/uploads/darts_img/'.$product->product_image)}}" height="100px" width="100px"></a></td>
                              <td>
                                @php
                                $product_status = '';
                                if($product->active_status == '0')
                                { $product_status = 'Pending'; }
                                elseif($product->active_status == '1')
                                { $product_status = 'Active';  }
                                elseif($product->active_status == '2')
                                { $product_status = 'Reserved';  }
                                elseif($product->active_status == '3')
                                { $product_status = 'Sold';  }
                                @endphp
                                {{$product_status}}
                              </td>
                              <td><a href="javascript:void(0);" class="edit_product" data-product_id="{{$product->id}}"><i class="fa fa-edit"></i></a> 
                                {{Form::open(array('url'=>'admin/delete-product/'.$product->id,'method'=>'POST','id'=>'del_product_form'.$product->id)) }}
                                    <a href="javascript:void(0);" class="delete_product" data-product_id="{{$product->id}}"  title="Delete"><i class="fa fa-trash"></i></a>
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
                  <h2>Add Dart</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                 {{-- Form --}}
                   <form action="{{url('admin/add-product')}}" method="POST" enctype="multipart/form-data">
                   {{csrf_field()}}

                   <div class="form-group">
                        <label>Available Users</label>
                        <select class="e_badge_size form-control"   name="user_id"  id="user_id" required="">
                          <option value="" >Select User</option>
                          @foreach($users as $user) 
                           <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                          @endforeach
                        </select>
                      </div>

                     <div class="form-group">
                        <label for="price">Title:</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" required="true">
                      </div>

                      <div class="form-group">
                        <label>Available Weight Ranges</label>
                        <select class="a_badge_size form-control"   name="weight_range"  id="weight_range" required="">
                            <option value="" >Select Weight Range</option>
                            <option value="Light">Light (12-18g)</option>
                            <option value="Medium">Medium (19-22g)</option>
                            <option value="Heavy">Heavy (23g or more)</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="price">Weight(g):</label>
                        <input type="text" class="form-control" id="product_weight" placeholder="Enter Weight" name="product_weight" required="true">
                      </div>


                      <div class="form-group">
                        <label for="length">Length(mm):</label>
                        <input type="text" class="form-control" id="product_length" placeholder="Edit Length" name="product_length" required="true">
                      </div>


                      <div class="form-group">
                        <label for="width">Width(mm):</label>
                        <input type="text" class="form-control" id="product_width" placeholder="Edit Width" name="product_width" required="true">
                      </div>

                      <div class="form-group">
                        <label for="price">Price Type:</label>
                         <select class="a_badge_size form-control" name="product_price_type"  id="product_price_type" >
                            <option value="for_sale">For Sale</option>
                            <option value="not_for_sale" selected="selected">Not For Sale</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" id="price" placeholder="Enter price" name="price">
                      </div>

                      <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" placeholder="Enter description" name="description" required="true"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" class="form-control" id="image" name="image" required="true" accept=".jpg,.jpeg,.png" onchange="validateFileType()">
                      </div>
                      <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
              </div>
            </div>
          </div>

  <!-- Modal -->
   <div class="modal fade" id="edit_product_modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Dart</h4>
        </div>
        <div class="modal-body">
         <form id="edit_product_form" class="form-horizontal" method="POST" enctype="multipart/form-data">
                   {{csrf_field()}}
                   <input type="hidden" name="product_id" id="product_id">
                   {{csrf_field()}}
                     <div class="form-group">
                        <label for="price">Title:</label>
                        <input type="text" class="form-control" id="e_title" placeholder="Edit title" name="e_title" required="true">
                      </div>
                      <div class="form-group">
                        <label>Available Users</label>
                        <select class="e_badge_size form-control"   name="e_user_id"  id="e_user_id" required="">
                          <option value="" >Select User</option>
                          @foreach($users as $user) 
                           <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Available Weight Ranges</label>
                        <select class="e_badge_size form-control" name="e_weight_range"  id="e_weight_range" required="">
                          <option value="" >Select Weight Range</option>
                          <option value="Light">Light (12-18g)</option>
                          <option value="Medium">Medium (19-22g)</option>
                          <option value="Heavy">Heavy (23g or more)</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="price">Weight:</label>
                        <input type="text" class="form-control" id="e_weight" placeholder="Edit Weight" name="e_weight" required="true">
                      </div>

                      <div class="form-group">
                        <label for="length">Length:</label>
                        <input type="text" class="form-control" id="e_length" placeholder="Edit Length" name="e_length" required="true">
                      </div>


                      <div class="form-group">
                        <label for="width">Width:</label>
                        <input type="text" class="form-control" id="e_width" placeholder="Edit Width" name="e_width" required="true">
                      </div>


                      <div class="form-group">
                        <label for="price">Price Type:</label>
                         <select class="a_badge_size form-control" name="e_price_type"  id="e_price_type" >
                            <option value="" >Select Price Type</option>
                            <option value="for_sale">For Sale</option>
                            <option value="not_for_sale">Not For Sale</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" class="form-control" id="e_price" placeholder="Edit price" name="e_price" >
                      </div>
                      <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="e_description" placeholder="Enter description" name="e_description" required="true"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" class="form-control" id="e_image" name="e_image"  accept=".jpg,.jpeg,.png" onchange="validateFileType1()">
                      </div>         
                      <button type="submit" class="btn btn-success">Submit</button>
                    </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>  

<script type="text/javascript">
  function isNumber(evt){
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
        var fileName = document.getElementById("e_image").value;
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