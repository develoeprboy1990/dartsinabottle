@extends('user.customer.customer-panel.customer-panel-layout')
@section('title','Custom Designs')
@section('content')



 	<div class="right_col" role="main">
      <!-- page content -->

 		 <div class="page-title">
            <div class="title_left">
              <h3>Pendign Design</h3>
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
            <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Custom Badges</h2>
                        <ul class="nav navbar-right panel_toolbox">
                          
                         <li><a href="{{url('create-custom-badge')}}" class="btn btn-success">Create Custom Badge</a></li>
                          
                        </ul>
                        <div class="clearfix"></div>
                      </div>

                      <div class="x_content">
                       {{--  <p class="text-muted font-13 m-b-30">
                          Responsive is an extension for DataTables that resolves that problem by optimising the table's layout for different screen sizes through the dynamic insertion and removal of columns from the table.
                        </p> --}}
                        <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Customer Name</th>
                              <th>Customer Email</th>
                              <th>Badge Identification Number</th>
                              <th>Created At</th>
                              <th>Action</th>
                              
                            </tr>
                          </thead>
                          <tbody>
                           @if($custom_badge_details->count()>0)
                           @foreach($custom_badge_details as $result)
                            <tr>
                              <td>{{$result->getUser->first_name." ".$result->getUser->last_name }}</td>
                              <td>{{$result->getUser->email}}</td>
                              <td>{{$result->identification_number}}</td>
                              <td>{{$result->created_at}}</td>
                              <td>
                              <a href="{{url('custom-badge/'.$result->id.'/detail')}}" class=""><i class="fa fa-eye"></i></a> 

                             
                            
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

  <!-- Modal -->
  
  {{-- Modal ended --}}
     
         <!-- footer content -->
        @include('user.customer.customer-panel.footer-customer-panel')
       
        <!-- /footer content -->
       
      </div>
      <!-- /page content -->

@endsection
