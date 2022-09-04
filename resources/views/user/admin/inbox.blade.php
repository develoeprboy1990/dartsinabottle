@extends('user.admin.admin-layout')
@section('title','Inbox')

@section('content')


       <!-- page content -->
      <div class="right_col" role="main">
        <div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                    Inbox 
                    
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
                  <h2> Your Inbox</h2>
                  {{-- @if($left_chat_menu !=null) --}}
                  <ul class="nav navbar-right panel_toolbox">
                   {{--  <li><a href="#"><i class="fa fa-chevron-up"></i></a>
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
                    </li> --}}
                  </ul>
                  <div class="clearfix"></div>
                 
                </div>
                <div class="x_content">
                  @if($left_chat_menu !=null)

                  <div class="row">

                    <div class="col-sm-3 mail_list_column">

                        
                    {{--  @foreach($admin_inbox as $inbox)  --}}

                      {{-- @if($inbox->read_status ==0)
                        @php
                          $circle_type="fa-circle";
                          $msg_div_class="give_customer_msg_div_color";
                        @endphp

                      @else
                        @php
                          $circle_type="fa-circle-o";
                          $msg_div_class="remove_customer_msg_div_color";

                        @endphp 
                      @endif --}}
                     {{--  <a href="#" class="inbox_message_body" data-parent_message_id={{$inbox->parent_message_id}} data-inbox_id='{{$inbox->id}}'>
                      <div class="mail_list {{$msg_div_class}}">
                        <div class="left">
                          <i class="fa {{$circle_type}}"></i> 
                        </div>
                        <div class="right">
                          <h3>{{$inbox->first_name." ".$inbox->last_name}} <small>{{$inbox->created_at}}</small></h3>
                          <p>{{$inbox->message}}</p>
                        </div>
                      </div>
                      </a>
                      @endforeach --}}
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
                          {{-- <p>{{$result['latest_message']}}</p> --}}
                          <p>{!!substr($result['latest_message'],0,35).'..'!!}</p>
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

                        <form id="send-message-to-customer">
                        {{csrf_field()}}
                        <div class="send-wrap ">
                         
                          <input type="hidden" name="chat_id" id="chat_id">
                          <input type="hidden" name="user_id" id="user_id">
                          <input type="hidden" name="redirect_page" value="no">
                            <textarea class="form-control send-message remove_disable" name="message_body" rows="3" placeholder="Write a reply..." id="message_content" required="true" disabled="true"></textarea>


                        </div>
                        <div class="btn-panel">
                           
                            {{-- <a href="#" class=" col-lg-4 text-right btn   send-message-btn pull-right" role="button"><i class="fa fa-plus"></i> Send Message</a> --}}
                            <input type="submit" class=" col-lg-4 text-right btn btn-primary   send-message-btn pull-right remove_disable" name="" disabled="true">

                            {{-- <input type="button" class=" col-lg-4 text-right btn btn-success   send-message-btn pull-right remove_disable" name="" disabled="true" value="Issue Resolved" style="color:white;"> --}}
                            <a  id="issue_resolved" href="#" class=" col-lg-4 text-right btn btn-success send-message-btn pull-right remove_disable" name="" disabled="true" style="color:white;">Issue Resolved</a>

                        </div>
                        </form>
                    </div>
                </div>
            </div>
            @else
              <h3>Your inbox is empty</h3>
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

