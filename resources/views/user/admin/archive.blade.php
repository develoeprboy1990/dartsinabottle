@extends('user.admin.admin-layout')
@section('title','Archive')

@section('content')


       <!-- page content -->
      <div class="right_col" role="main">
        <div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                    Archive 
                    
                </h3>
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

          <div class="row">

            <div class="col-md-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2> Your Archive</h2>
                 {{--  @if($left_chat_menu !=null) --}}
                  <ul class="nav navbar-right panel_toolbox">
                   
                  </ul>
                  <div class="clearfix"></div>
                 
                </div>
                <div class="x_content">
                @if($left_chat_menu !=null)

                  <div class="row">

                    <div class="col-sm-3 mail_list_column">

                        
                 
                      @php
                        $i=0;
                      @endphp
                       @foreach($left_chat_menu as $result) 
                      
                       
                        @if($result['read_status'] ==0 && $result['sent_by'] ==0)
                        @php
                          $circle_type="fa-circle";
                          $msg_div_class="give_customer_msg_div_color";
                        @endphp

                      @else
                        @php
                          $circle_type="fa-circle-o";
                          $msg_div_class="remove_customer_msg_div_color";

                        @endphp 
                      @endif

                       <a href="#" class="left_chat_menu" data-user_id={{$result["user_id"]}}  data-chat_id='{{$result["chat_id"]}}'>
                      <div class="mail_list {{$msg_div_class}}">
                        <div class="left">
                          <i class="fa {{$circle_type}}"></i> 
                        </div>
                        <div class="right">
                          <h3>{{$result['first_name']." ".$result['last_name']}} <small>{{$result['created_at'] }}</small></h3>
                          <p>{{$result['latest_message']}}</p>
                        </div>
                      </div>
                      </a>
                      @endforeach


                    </div>
                    <!-- /MAIL LIST -->


                    <!-- CONTENT MAIL -->
              <div class="container">
    
                   <div class="row">

                    <div class="message-wrap col-lg-8">
                        <div class="msg-wrap" id="show_chat_detail">

                          <div class="media msg ">
                               <p>Please select a chat</p>
                            </div>                
                    
                        </div>

                        {{-- <form id="send-message-to-customer">
                        {{csrf_field()}}
                        <div class="send-wrap ">
                         
                          <input type="hidden" name="chat_id" id="chat_id">
                          <input type="hidden" name="user_id" id="user_id">
                          <input type="hidden" name="redirect_page" value="no">
                            <textarea class="form-control send-message remove_disable" name="message_body" rows="3" placeholder="Write a reply..." id="message_content" required="true" disabled="true"></textarea>


                        </div>
                        <div class="btn-panel">
                           
                            
                            <input type="submit" class=" col-lg-4 text-right btn btn-success   send-message-btn pull-right remove_disable" name="" disabled="true">
                        </div>
                        </form> --}}
                    </div>
                </div>
            </div>
          
             @else
            
              <h3>Your archive is empty</h3>
            @endif
                    <!-- /CONTENT MAIL -->
                  </div>
                </div>

              </div>

            </div>

          </div>
        </div>



        <!-- footer content -->
       
        <!-- /footer content -->






      </div>
      <!-- /page content -->
   

  


  @endsection

