@extends('user.customer.customer-panel.customer-panel-layout')
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
            

            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2> Your Archive</h2>
                  {{-- @if($user_message == null) --}}
                  {{-- <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#" data-toggle="modal" data-target="#send-message-modal" class="btn btn-success">Send New Message</a>
                    </li>
                    
                  </ul> --}}
                  {{-- @endif --}}
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">


                  <div class="row">
                      @if($user_message != null)
                    <div class="col-sm-3 mail_list_column">

                        
                   

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
                          <p><small>{{$aa}} </small>{{$result['message']}}</p>
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


                

              <div class="media msg ">
                   <p>Please select a message</p>
                </div>                
                
               

            </div>
            {{-- <form id="send-message-to-admin">
            {{csrf_field()}}
            <div class="send-wrap ">
             
              <input type="hidden" name="chat_id" id="chat_id">
              <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
              <input type="hidden" name="redirect_page" value="no">
                <textarea class="form-control send-message remove_disable" name="message_body" rows="3" placeholder="Write a reply..." id="message_content" disabled="true" required="true"></textarea>


            </div>
            <div class="btn-panel">
               
                
                <input type="submit" class=" col-lg-4 text-right btn btn-success send-message-btn pull-right remove_disable" name="" disabled="true">
            </div>
            </form> --}}
        </div>
    </div>
</div>
                    <!-- /CONTENT MAIL -->
                    @else
                    <p>Your archive is empty.</p>
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

