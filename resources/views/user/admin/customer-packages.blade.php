@extends('user.admin.admin-layout')
@section('title','Customer Packages')


@section('content')

  <div class="right_col" role="main">
        <div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>View Customer Packages</h3>
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
                        <h2>Packages</h2>
                        <!-- <ul class="nav navbar-right panel_toolbox">
                          <a href="{{url('admin/customer-groups/create')}}" class="btn btn-primary">Add Customer Package</a>
                        </ul> -->
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        
                        <table id="product_table" class="table table-striped table-bordered bulk_action">
                          <thead>
                            <tr>
                              <th>Darts SETS</th>
                              <th>Price</th>
                              <th>Interval</th>
                              <th>Created at</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                         <tbody>
                         @if(count($customer_packages)>0)
                         @foreach($customer_packages as $result)
                            <tr>
                              <td>{{$result->darts_set}} SETS</a></td>
                              <td>£ {{$result->price}}</a></td>
                              <td>£ {{$result->darts_interval}} DAYS</a></td>
                              <td>{{$result->created_at}}</td>
                              <td>
                                <a href="{{ url('admin/customer-packages/'.$result->id.'/edit') }}" title="Edit"><i class="fa fa-pencil"></i></a>
                             {{--{{Form::open(array('url'=>'admin/customer-packages/'.$result->id,'method'=>'DELETE','id'=>'del_product_form'.$result->id )) }}
                                    <a href="#" class="del_customer_group"  data-customer_group_id="{{$result->id}}"  title="Delete"><i class="fa fa-trash"></i></a>
                                {{Form::close()}} --}}
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

          {{-- <script type="text/javascript">
            $(document).ready(function() {
              $('#birthday').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4"
              }, function(start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
              });
            });
          </script>
          --}}

        


          


        

         
        </div>
        <!-- /page content -->


       


{{-- Loade Modal --}}
 <div class="modal fade" id="loader_modal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        
        <div class="modal-body">
          <h3 style="text-align:center;">Loading Product Details</h3>

          <p style="text-align:center;"><img src="{{url('public/uploads/gif/payment-waiting.gif')}}"></p>
        </div>
        
      </div>
    </div>
  </div>
  {{-- Loader Modal End --}}

  {{-- Product Inventory History Modal --}}


        <!-- footer content -->
        
        <!-- /footer content -->

      </div>

    @endsection

    @section('javascript')




    @endsection