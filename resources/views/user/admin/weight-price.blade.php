@extends('user.admin.admin-layout')
@section('title','Weight Price')


@section('content')

  <div class="right_col" role="main">
        <div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>Product Weight Price Management</h3>
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
                        <h2>View</h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <a href="{{url('admin/weight-price/create')}}" class="btn btn-primary">Add</a>
                          
                          
                          
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        
                        <table id="myTable" class="table table-striped table-bordered bulk_action">
                          <thead>
                            <tr>
                              <th>Weight Range</th>
                              <th>Amount</th>
                              
                              <th>Created at</th>
                              <th>Updated at</th> 
                              <th>Action</th>
                              
                            </tr>
                          </thead>
                         <tbody>
                         @if(count($details)>0)
                         @foreach($details as $detail)
                            <tr>
                              <td>{{$detail->weight_from."-".$detail->weight_to}} Oz</td>
                              <td>${{$detail->amount}}</td>
                              
                             
                              
                              <td>{{$detail->created_at}}</td>
                              <td>{{$detail->updated_at}}</td>
                              <td>
                                 {{-- <a href="{{url('admin/customerdetail/'.$detail->user_id)}}" title="View"><i class="fa fa-eye"></i></a> --}}
                                  <a href="{{ url('admin/weight-price/'.$detail->id.'/edit') }}" title="Edit"><i class="fa fa-pencil"></i></a>
                              
                                  {{Form::open(array('url'=>'admin/weight-price/'.$detail->id,'method'=>'DELETE','id'=>'del_weight_price_form'.$detail->id ))}}

                                    <a href="#" class="del_weight_price" data-id="{{$detail->id}}"  title="Delete"><i class="fa fa-trash"></i></a>

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

        <!-- footer content -->
       
        <!-- /footer content -->

      </div>

    @endsection

    @section('javascript')




    @endsection