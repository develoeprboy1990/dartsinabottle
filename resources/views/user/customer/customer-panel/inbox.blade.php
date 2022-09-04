@extends('user.customer.customer-panel.customer-panel-layout')
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
             {{--  <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
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
                  {{-- @if($user_message == null) --}}
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#" data-toggle="modal" data-target="#send-message-modal" class="btn btn-success">Send New Message</a>
                    </li>
                    
                  </ul>
                  {{-- @endif --}}
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">


                  <div class="row">
                      @if($user_message != null)
                    <div class="col-sm-3 mail_list_column">

                        
                     {{-- @foreach($inboxes as $inbox) 

                      @if($inbox->read_status ==0)
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
                      <a href="#" class="message_body" data-inbox_id='{{$inbox->id}}'>
                      <div class="mail_list {{$msg_div_class}}">
                        <div class="left">
                          <i class="fa {{$circle_type}}"></i> 
                        </div>
                        <div class="right">
                          <h3>Admin <small>{{$inbox->created_at}}</small></h3>
                          <p>{{$inbox->message}}</p>
                        </div>
                      </div>
                      </a>
                      @endforeach --}}

                      @php
                        $k=0;
                      @endphp
                    @foreach($user_message as $result )

                       @if(Auth::user()->id ==$result['from_id'])
                            
                        @php
                          $aa='You:';
                        @endphp

                        @else
                        @php
                          $aa='';
                        @endphp
                       @endif

                       @if($result['read_status'] ==0 && $result['sent_by'] ==1)
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
                      <a href="#" class="left_chat_menu" data-chat_id='{{$result['chat_id']}}'>
                      <div class="mail_list {{$msg_div_class}}">
                        <div class="left">
                          <i class="fa {{$circle_type}}"></i> 
                        </div>
                        <div class="right">
                          <h3>Admin <small>{{$result['created_at']}}</small></h3>
                          <p><small>{{$aa}} </small>{!!substr($result['message'],0,35).'..'!!}</p>
                        </div>
                      </div>
                      </a>

                      @php
                        $k++;
                      @endphp
                  @endforeach   

                    </div>
                    <!-- /MAIL LIST -->


                    <!-- CONTENT MAIL -->
                    <div class="container">
    
    <div class="row">

       


        <div class="message-wrap col-lg-8">
            <div class="msg-wrap" id="show_chat_detail">


                {{-- <div class="media msg ">
                    <a class="pull-left" href="#">
                        <img class="media-object" data-src="" alt="64x64" style="width: 32px; height: 32px;" src="">
                    </a>
                    <div class="media-body">
                        <small class="pull-right time"><i class="fa fa-clock-o"></i> 12:10am</small>
                        <h5 class="media-heading">Naimish Sakhpara</h5>
                        <small class="col-lg-10">Location H-2, Ayojan Nagar, Near Gate-3, Near
                            Shreyas Crossing Dharnidhar Derasar,
                            Paldi, Ahmedabad 380007, Ahmedabad,
                            India
                            Phone 091 37 669307
                            Email aapamdavad.district@gmail.com</small>
                    </div>
                </div> --}}

              <div class="media msg ">
                   <p>Please select a message</p>
                </div>                
                
               

            </div>
            <form id="send-message-to-admin">
            {{csrf_field()}}
            <div class="send-wrap ">
             
              <input type="hidden" name="chat_id" id="chat_id">
              <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
              <input type="hidden" name="redirect_page" value="no">
                <textarea class="form-control send-message remove_disable" name="message_body" rows="3" placeholder="Write a reply..." id="message_content" disabled="true" required="true"></textarea>


            </div>
            <div class="btn-panel">
               
                {{-- <a href="#" class=" col-lg-4 text-right btn   send-message-btn pull-right" role="button"><i class="fa fa-plus"></i> Send Message</a> --}}
                <input type="submit" class="col-lg-4 text-right btn btn-success send-message-btn pull-right remove_disable" name="" disabled="true">
               <span id="show_issue_resolved_btn"></span>
            </div>
            </form>
        </div>
    </div>
</div>
                    <!-- /CONTENT MAIL -->
                    @else
                    <p>Your inbox is empty. Please click send message button to send message</p>
                    @endif

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- footer content -->
       
        <!-- /footer content -->



  
 {{-- Modal Starts  --}}
  
  <div class="modal fade" id="send-message-modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <form action="{{url('send-message-to-admin')}}" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Send Message</h4>
        </div>
        <div class="modal-body">
           
                
              {{csrf_field()}}
              
              <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
              <input type="hidden" name="redirect_page" value="ok">
              

              <div class="form-group">
                <label for="tracking number">Message</label>
                <textarea  name="message_body" id="message_body"  required="required" class="form-control col-md-7 col-xs-12"></textarea>  
              </div>


        </div>
        <br>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Send Message</button>
        </div>
      </div>
      </form>
    </div>
  </div>
{{-- Modal Ended --}}


      </div>
      <!-- /page content -->
   

  


  @endsection

