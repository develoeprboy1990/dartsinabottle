@extends('user.admin.admin-layout')
@section('title','Url for Home Page')
@section('content')



 	<div class="right_col" role="main">
      <!-- page content -->

 		 <div class="page-title">
            <div class="title_left">
              <h3>Url for Home Page</h3>
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
            <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Set Home Page Url</h2>
                     
                        <div class="clearfix"></div>
                      </div>

                      <div class="x_content x_cont">
                    
                        {{-- Form --}}
                          <form action="{{url('admin/home-page-url')}}" method="POST">
                          {{csrf_field()}}

                            <div class="form-group">
                             <label for="line_name">Url:</label>
                               <input type="text" class="form-control" name="{{$home_page_url->id}}" value="{{$home_page_url->url}}" required="true">
                            </div>

                            <div class="form-group">
                             <label for="line_name">Admin 1:</label>
                               <input type="text" class="form-control" name="{{$admin_1->id}}" value="{{@$admin_1->url}}" required="true">
                            </div>

                            <div class="form-group">
                             <label for="line_name">Admin 2:</label>
                               <input type="text" class="form-control" name="{{$admin_2->id}}" value="{{@$admin_2->url}}" required="true">
                            </div>

                            
                             <button type="submit" class="btn btn-success">Submit</button>
                           </form>

                      </div>
                    </div>
                  </div>


            {{-- <div class="col-md-4  col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  
                  <h2>Details</h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                
                  Single line
                </p>  
                <p>Double line</p>
                </div>
              </div>
            </div> --}}
          </div>


         <!-- footer content -->
        @include('user.admin.footer')
       
        <!-- /footer content -->
       
      </div>
      <!-- /page content -->

@endsection
