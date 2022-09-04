@extends('user.admin.admin-layout')
@section('title','Badge Bleed size')
@section('content')



<div class="right_col" role="main">
    <!-- page content -->

   <div class="page-title">
          <div class="title_left">
            <h3>Badge Type</h3>
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
                      <h2>Badge Type </h2>
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
                            <th>Single Side Price</th>
                            <th>Double Side Price</th>
                            <th>Availabe</th>
                            <th>Action</th>
                            
                          </tr>
                        </thead>
                        <input type="hidden" name="editid" id="editid" value=""/> 
                        <tbody>
                         @foreach($BadgeTypes as $BadgeType)
                          <tr>
                            <td>{{$BadgeType->title}}</td>
                            <td>${{$BadgeType->price}}</td>
                            <td>${{$BadgeType->double_side_price}}</td>
                            <td>{{$BadgeType->available}}</td>
                            <td>
                            <a href="#" class="edit_badge_type_modal" data-badge_type_id="{{$BadgeType->id}}" data-toggle="modal" data-target="#edit_badge_type_modal" value=""><i class="fa fa-edit"></i></a> 

                            </td>    
                          </tr>
                          @endforeach
                        </tbody>
                      </table>

                    </div>
                  </div>
                </div>


          <!-- <div class="col-md-4  col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Add Badge Bled</h2>
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
                 <form action="{{url('admin/insert-badge-bled-size')}}" method="POST">
                 {{csrf_field()}}
                    
                    <div class="form-group">
                      <label for="price">Title:</label>
                <input type="text" class="form-control" id="bbs_title" placeholder="Enter Title" name=" bbs_title" required="true">
                    </div>
                   

                   

                    <div class="form-group">
                      <label for="price">Price:</label>
                      <input type="number" class="form-control" id="bb_price" placeholder="Enter price" name="bb_price" required="true">
                    </div>
                   
                    <button type="submit" class="btn btn-success">Submit</button>
                  </form>
              </div>
            </div>
          </div> -->
       

           <div class="col-md-4  col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Detail Badge Type</h2>
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
                <table>
                   <thead>
                          <tr>
                             <th></th>
                            <th></th>
                          </tr>
                        </thead>
                 
                </tr>
                <tbody>
                @foreach($BadgeTypes as $BadgeType)
                <tr>
                  <td>{{$BadgeType->title}}<br>&nbsp</td>
                </tr>
               
                @endforeach
                </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
         </div>
<!-- Modal -->
<div class="modal fade" id="edit_badge_type_modal" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Badge Type </h4>
      </div>
      <div class="modal-body">

            <form method="post" id="update_bt_form" class="update_bt_form">
                  
            <input type="hidden" name="badge_bt_id" id="badge_bt_id">
        
            <div class="form-group">
              <label for="font fmaily">Title:</label>
              <input type="text" class="form-control" id="edit_bt_title"  name="title" >
            </div>
                     

            <div class="form-group">
              <label for="price">Price:</label>
              <input type="text" class="form-control" id="edit_bt_price"  name="price">
            </div>

            <div class="form-group">
              <label for="price">Double Side Price:</label>
              <input type="text" class="form-control" id="edit_bt_ds_price"  name="price">
            </div>

            <div class="form-group">
              <input type="checkbox"  id="available"  name="available">
              <label for="available">Available</label>
            </div>
                     
              <input type="submit" class="btn btn-success update_bt_form" name="submit">
            </form>

      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
</div> 

<script type="text/javascript">
     $( document ).ready(function() {
     $(".edit_badge_type_modal").click(function(){
        var id = $(this).data('badge_type_id');
          // alert(id);
           $.ajax({
                method:"get",
                data:{id:id},
                url:'{{url("admin/get-badge-type-record")}}',
                success: function(response){
                  // alert(response.getBadgeBledRecord['title']);editid
                  $('#edit_bt_title').val(response.getBadgeType['title']);
                  $('#edit_bt_price').val(response.getBadgeType['price']);
                  $('#edit_bt_ds_price').val(response.getBadgeType['double_side_price']);
                  $('#badge_bt_id').val(response.getBadgeType['id']);

                  if(response.getBadgeType['available'] == 'yes')
                  {
                    $("#available").prop('checked', true);
                  }
                    
                }
             });
          });

     

     $(document).on('submit', '.update_bt_form', function(e){
          e.preventDefault();
          // alert('sdfdg');
          var id = $('#badge_bt_id').val();
          var title = $('#edit_bt_title').val();
          var price = $('#edit_bt_price').val();
          var ds_price = $('#edit_bt_ds_price').val();
          // var available = $('#available').val();
          var ischecked = $('#available').is(":checked");
          if(ischecked == true)
          {
            var available = 'yes';
          }
          else
          {
            var available = 'no';
          }

          $.ajax({
            method: 'POST',
              url: "{{ route('admin/update-badge-type-record') }}",
              
              data: {
                '_token': "{{csrf_token()}}",
                'id':id,
                'title':title,
                'price':price,
                'ds_price':ds_price,
                'available':available,
            },
  
              success: function(result){
                // alert('success');
                window.location.reload();
              },
              error: function (request, status, error) {
                alert(error);
              }
          });
      });
    });
</script>

{{-- Modal ended --}}
   
       <!-- footer content -->
      @include('user.admin.footer')
     
      <!-- /footer content -->
     
    </div>
    <!-- /page content -->

@endsection
