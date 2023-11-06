@extends('user.admin.admin-layout')
@section('title','Customers')
@section('content')
  <div class="right_col" role="main">
      <!-- page content -->
     <div class="page-title">
            <div class="title_left">
              <h3>Customers</h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  {{-- <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span> --}}
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
          <div class="">
           <div class="col-md-12 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-bars"></i> Customer Detail</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    {{-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li> --}}
                    {{-- <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a> --}}
                      {{-- <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul> --}}

                    {{-- </li> --}}

                    {{--<li><a href="{{url('admin/customer-order-assets/'.$user_detail->id)}}" class="btn btn-success btn-sm">View Order Assets</a></li>--}}


                    {{-- <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li> --}}
                    <li><a class="btn btn-success" href="#" data-toggle="modal" data-target="#notes-modal">Notes</a>
                          </li>
                    <li role="presentation" class="dropdown">
                    <a  href="#" class="dropdown-toggle btn btn-success" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                                Options
                                <span class="caret"></span>
                            </a>
                    <ul id="menu6" class="dropdown-menu animated fadeInDown" role="menu">
                     
                      @if(($user_detail) && $user_detail->user_status ==1)
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('admin/customer/'.$user_detail->id.'/suspend-account')}}">Suspend Account</a>
                      </li>
                      <!--<li role="presentation" class="divider"></li>  
                      
                       <li > <a  href="#" data-toggle="modal" data-target="#assign-customer-group-modal">Assign Customer Group</a></li> -->
                      @endif

                      <li role="presentation" class="divider"></li>
                      
                      @if(($user_detail) && $user_detail->user_status ==2)
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('admin/customer/'.$user_detail->id.'/activate-account')}}">Activate Account</a>
                      </li>
                      @endif

                      <li><a href="#" data-toggle="modal" data-target="#update-deposit-modal">Update Deposit</a></li>
                      <li role="presentation" class="divider"></li> 

                      <li><a href="#" data-toggle="modal" data-target="#send-message-modal">Send Message</a></li>
                      <li role="presentation" class="divider"></li>                      
                      
                      <li><a  href="#" data-toggle="modal" data-target="#assign-payment-type-modal">Assign Payment Type</a></li>


                      
                      </li>
                    </ul>
                  </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <div class="col-xs-3">
                    <!-- required for floating -->
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tabs-left">
                      <li class="active"><a href="#basic_information" data-toggle="tab">Basic Information</a>
                      </li>
                      @if($user_detail->user_status != 0)
                      <li><a href="#shipping_information" data-toggle="tab">Shipping Information</a>
                      </li>
                      @endif
                      
                    </ul>
                  </div>

                  <div class="col-xs-9">
                    <!-- Tab panes -->
                    <div class="tab-content">
                      
                    @if($user_detail)
                      <div class="tab-pane active" id="basic_information">
                          
                          <div class="col-md-6 col-sm-6 col-xs-12 desc-col">
                                  <label>First Name</label>
                          </div>

                           <div class="col-md-6 col-sm-6 col-xs-12 desc-col">
                            @if($user_detail->first_name!=null)
                            {{$user_detail->first_name}}
                            @else
                            N/A
                            @endif

                           </div>
                          <div class="clearfix"></div>

                          <div class="col-md-6 col-sm-6 col-xs-12 desc-col">
                                  <label>Last Name</label>
                          </div>

                           <div class="col-md-6 col-sm-6 col-xs-12 desc-col">
                            @if($user_detail->last_name!=null)
                            {{$user_detail->last_name}}
                            @else
                            N/A
                            @endif

                           </div>
                          <div class="clearfix"></div>

                          

                          <div class="col-md-6 col-sm-6 col-xs-12 desc-col">
                                  <label>Email</label>
                          </div>

                           <div class="col-md-6 col-sm-6 col-xs-12 desc-col">
                            @if($user_detail->email!=null)
                            {{$user_detail->email}}
                            @else
                            N/A
                            @endif

                           </div>
                          <div class="clearfix"></div>

                          <div class="col-md-6 col-sm-6 col-xs-12 desc-col">
                            <label>Deposit</label>
                          </div>

                           <div class="col-md-6 col-sm-6 col-xs-12 desc-col">
                            @if($user_detail->deposit_cost!=null)
                            £{{$user_detail->deposit_cost}}
                            @else
                            N/A
                            @endif

                           </div>
                          <div class="clearfix"></div>




                      </div>
                     @endif 
                        
                      @if($user_detail->user_status != 0)  

                      
                      <div class="tab-pane" id="shipping_information">
                        @if($user_shipping_details->isNotEmpty())
                        @php
                          $shipping_counter=1;
                        @endphp
                        @foreach($user_shipping_details as $result)  
                        <h2>Shipping Information {{$shipping_counter}}</h2>
                        <div class="col-md-6 col-sm-6 col-xs-12 desc-col">
                          <label>Email</label>
                        </div>

                         <div class="col-md-6 col-sm-6 col-xs-12 desc-col">
                          @if($result->email!=null)
                          {{$result->email}}
                          @else
                          N/A
                          @endif

                         </div>
                         <div class="clearfix"></div>


                         <div class="col-md-6 col-sm-6 col-xs-12 desc-col">
                          <label>Address</label>
                        </div>

                         <div class="col-md-6 col-sm-6 col-xs-12 desc-col">
                          @if($result->address!=null)
                          {{$result->address}}
                          @else
                          N/A
                          @endif

                         </div>
                         <div class="clearfix"></div>

                        <div class="col-md-6 col-sm-6 col-xs-12 desc-col">
                          <label>Country</label>
                        </div>

                         <div class="col-md-6 col-sm-6 col-xs-12 desc-col">
                          @if($result->getCountry!=null)
                          {{$result->getCountry->name}}
                          @else
                          N/A
                          @endif

                         </div>
                         <div class="clearfix"></div>

                        <div class="col-md-6 col-sm-6 col-xs-12 desc-col">
                          <label>State</label>
                        </div>

                         <div class="col-md-6 col-sm-6 col-xs-12 desc-col">
                          @if($result->getState!=null)
                          {{$result->getState->name}}
                          @else
                          N/A
                          @endif

                         </div>
                         <div class="clearfix"></div>

                        <div class="col-md-6 col-sm-6 col-xs-12 desc-col">
                          <label>City</label>
                        </div>

                         <div class="col-md-6 col-sm-6 col-xs-12 desc-col">
                          @if($result->getCity!=null)
                          {{$result->getCity->name}}
                          @else
                          N/A
                          @endif

                         </div>
                         <div class="clearfix"></div>


                         <div class="col-md-6 col-sm-6 col-xs-12 desc-col">
                          <label>Phone</label>
                        </div>

                         <div class="col-md-6 col-sm-6 col-xs-12 desc-col">
                          @if($result->phone!=null)
                          {{$result->phone}}
                          @else
                          N/A
                          @endif

                         </div>
                         <div class="clearfix"></div>

                         <div class="col-md-6 col-sm-6 col-xs-12 desc-col">
                          <label>Zip</label>
                        </div>

                         <div class="col-md-6 col-sm-6 col-xs-12 desc-col">
                          @if($result->zip!=null)
                          {{$result->zip}}
                          @else
                          N/A
                          @endif

                         </div>
                         <div class="clearfix"></div>

                        @php
                          $shipping_counter++;
                        @endphp
                        @endforeach
                        @else
                        <p>No shipping detail found</p>
                        @endif
                      </div>
                     
                      
                      
                      @endif

                    </div>
                  </div>

                  <div class="clearfix"></div>

                </div>
              </div>
            </div>


            
          </div>

  <!-- Modal -->
  <div class="modal fade" id="edit_bade_size_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Badge Size</h4>
        </div>
        <div class="modal-body">
         {{ Form::open(['url' => '', 'method' => 'put', 'class' => 'form-horizontal form-label-left', 'id' => 'edit_card_size_form']) }}
                   
                   <input type="hidden" name="badge_size_id" id="badge_size_id">
                      <div class="form-group ">
                        <label for="text">Size:</label>
                        <br>
                      

                        <input type="text" class="form-control size-control1" id="update_size_from" placeholder="Enter size" name="size_from">
                        <span>*</span>
                        <input type="text" class="form-control size-control2" id="update_size_to" placeholder="Enter size" name="size_to" required="true">



                        
                       
                      </div>

                     <div class="form-group">
                        <label for="price">Weight:</label>
                        <input type="text" class="form-control" id="update_weight" placeholder="Enter weight" name="weight" required="true">
                      </div>


                      <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" class="form-control" id="update_price" placeholder="Enter price" name="price" required="true">
                      </div>
                     
                      <button type="submit" class="btn btn-success">Submit</button>
                    {{Form::close()}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>  
  {{-- Modal ended --}}


  {{-- Note Modal Starts  --}}
  
  <div class="modal fade" id="notes-modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Notes</h4>
        </div>
        <div class="modal-body">
            

             <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Note#</th>
                    <th width="80%">Note Description</th>
                    
                    <th width="20%">Action</th>
                  </tr>
                </thead>
                <tbody id="customer_note_table">
                
                  @if(count($customer_notes) > 0)
                      
                         @php
                           $note_counter=1;
                           
                         @endphp
                       

                        @foreach($customer_notes as $customer_note)  
                          <tr>
                            <td>{{$note_counter}}</td>
                            <td>{{$customer_note->note_description}}</td>
                            
                            <td><a class="delete-customer-note" data-customer_note_id="{{$customer_note->id}}" href="#" ><i class="fa fa-trash"></i></a></td>
                          </tr>

                          @php
                            $note_counter++;
                          @endphp
                        @endforeach
                    
                   @endif
              
                 
                 
                </tbody>
              </table>

             
    <div id="div_note">
  
    </div>
    <a id="add_more_note" href="#" class="btn btn-success" data-user_id="{{$user_detail->id}}">Add New Note</a> 

        </div>
        <br>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  </div>
{{-- Notes Modal Ended --}}


{{-- Message Modal Starts  --}}
  
  <div class="modal fade" id="send-message-modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <form action="{{url('admin/send-message-to-customer')}}" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Send Message</h4>
        </div>
        <div class="modal-body"> 
              {{csrf_field()}}              
              <input type="hidden" name="user_id" value="{{$user_detail->id}}">
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


{{-- Deposit Modal Starts  --}}
  
  <div class="modal fade" id="update-deposit-modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <form action="{{url('admin/update-customer-deposit')}}" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Deposit</h4>
        </div>
        <div class="modal-body"> 
              {{csrf_field()}}              
              <input type="hidden" name="user_id" value="{{$user_detail->id}}">
              <input type="hidden" name="redirect_page" value="ok">
              <div class="form-group">
                <label for="tracking number">Deposit</label>
                <input type="text" name="deposit_cost" id="deposit_cost"  required="required" class="form-control col-md-7 col-xs-12" value="{{$user_detail->deposit_cost}}">  
              </div>
        </div>
        <br>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Update Deposit</button>
        </div>
      </div>
      </form>
    </div>
  </div>
{{-- Modal Ended --}}


{{-- Payment Type Modal Starts  --}}
  
  <div class="modal fade" id="assign-payment-type-modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <form action="{{url('admin/assign-custom-payment-type')}}" method="post" id="assign_custom_payment_type_to_customer">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Assign Payment Type</h4>
        </div>
        <div class="modal-body">
           
                
              {{csrf_field()}}
              
              <input type="hidden" name="user_id" value="{{$user_detail->id}}">
              

              <div class="form-group">
                <label for="tracking number">Payment Types:</label>
                 
                @if($customer_custom_payment_types->count()<1)

                 @foreach($payment_types as $result)

                  
                   @if($result->id ==4 || $result->id ==5)
                    @php
                      $check_payment_type="checked";
                    @endphp
                   @else
                    @php
                      $check_payment_type="";
                    @endphp
                   @endif



                   <div class="checkbox">
                    <label><input type="checkbox" {{$check_payment_type}} name="payment_type[]" value="{{$result->id}}"> {{$result->name}}</label>
                   </div>
                 @endforeach  


                {{-- If Custome Payment Type is defined then this else works --}}
                @else
                
                @foreach($customer_custom_payment_types as $result)

                  @if($result->payment_type_id ==1)
                    @php
                      $credit_card_checked="checked";
                    @endphp
                  @elseif($result->payment_type_id ==2)
                    @php
                      $wire_checked="checked";
                    @endphp
                  @elseif($result->payment_type_id ==3)
                    @php
                      $check_checked="checked";
                    @endphp  
                    @elseif($result->payment_type_id ==4)
                    @php
                      $check_checked="checked";
                    @endphp  
                    @elseif($result->payment_type_id ==5)
                    @php
                      $check_checked="checked";
                    @endphp  

                  @endif

                 
                @endforeach 
                
                 <div class="checkbox">
                    <label><input type="checkbox" {{@$credit_card_checked}} name="payment_type[]" value="1"> Credit Card</label>
                  </div>
                 {{--  <div class="checkbox">
                    <label><input type="checkbox" {{@$wire_checked}} name="payment_type[]" value="2"> Wire</label>
                  </div> 
                  <div class="checkbox">
                    <label><input type="checkbox" {{@$check_checked}} name="payment_type[]" value="3"> Check</label>
                  </div>--}}

                  <div class="checkbox">
                    <label><input type="checkbox" {{@$check_checked}} name="payment_type[]" value="4"> PayPal</label>
                  </div>

                   <div class="checkbox">
                    <label><input type="checkbox" {{@$check_checked}} name="payment_type[]" value="5"> Stripe</label>
                  </div>

                @endif  {{--  End of @if($customer_custom_payment_types->count()<1) --}}

                
              </div>


        </div>
        <br>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Assign Payment Type</button>
        </div>
      </div>
      </form>
    </div>
  </div>
{{-- Payment Type Modal Ended --}}


{{-- authorize payment loader --}}
<div class="modal fade" id="loader_modal" role="dialog">
<div class="modal-dialog modal-sm">
<div class="modal-content">

<div class="modal-body">
  <h3 style="text-align:center;">Please wait</h3>

  <p style="text-align:center;"><img src="{{url('public/uploads/gif/waiting.gif')}}"></p>
</div>

</div>
</div>
</div>
{{-- authorize payment loader ended --}}


{{-- Customer Group Modal Started --}}
{{-- Modal Starts  --}}
  
  <div class="modal fade" id="assign-customer-group-modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <form action="{{url('admin/assign-customer-group')}}" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Assign Customer Group</h4>
        </div>
        <div class="modal-body">
           
                
              {{csrf_field()}}
              
              <input type="hidden" name="user_id" value="{{$user_detail->id}}">
              

              <div class="form-group">

                <label for="tracking number">Customer Groups</label>
                <select class="selectpicker form-control col-md-7 col-xs-12" required="required" data-live-search="true" title="Choose Customer Group" name="customer_group">
                 
                 @foreach($customer_groups as $result)
                
                     
                @if($user_detail->customer_group_id  != null)
                      @if($user_detail->customer_group_id ==  $result->id)

                         @php
                            $selected_group="selected";
                         @endphp 

                      @else
                       
                         @php
                            $selected_group="";
                         @endphp 

                      @endif

                 @else
                       @php
                          $selected_group="";
                       @endphp 
                 @endif 

                 <option value="{{$result->id}}" {{$selected_group}}> {{$result->name}} </option>
                 @endforeach

                </select>
               
              </div>


        </div>
        <br>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </div>
      </form>
    </div>
  </div>
{{-- Modal Ended --}}
{{-- Customer Group Modal Ended --}}

 
     
         <!-- footer content -->
        {{-- @include('user.admin.footer') --}}
       
        <!-- /footer content -->
       
      </div>
      <!-- /page content -->

@endsection

 @section('my_javascript')

     <script>
      $(document).ready(function(){
        $("#add_more_note").on('click',function(){

            var html_string='<form action="{{url('admin/add-customer-note')}}" method="post" id="add_customer_note_form">'+
              '{{csrf_field()}}'+
              ' <input type="hidden" name="user_id" value="{{$user_detail->id}}">'+
              ' <div class="form-group">'+
              '  <label for="Note Description">Enter Note Description</label>'+
              ' <textarea  name="note_description" id="note_description"  required="true" class="form-control col-md-7 col-xs-12"></textarea>'+
              ' </div>'+
                '<button class="btn btn-primary" id="save_customer_note">Save Note</button>'+
                '</form>';

              $("#div_note").append(html_string);  

              $("#add_more_note").hide();

          });          
        $(document).on('click','#save_customer_note',function(e){
            
            e.preventDefault();
           
           
            // return false;  
            // alert("click");
            // return false;
            if($("#note_description").val()==""){
              alert("Fileds are required");
              return false;
            }

            $.ajax({

              url:'{{url("admin/add-customer-note")}}',
              method:"post",
              dataType:"json",
              data:$("#add_customer_note_form").serialize(),
              success:function(data){
                
                var html_string='<tr>'+
                                 ' <td>'+data.count_rows+'</td>'+
                                 ' <td>'+data.note_description+'</td>'+
                                 ' <td><a class="delete-customer-note" href="#" data-customer_note_id="'+data.customer_note_id+'"><i class="fa fa-trash"></i></a></td>'+
                                 ' </tr>';
                
                
                $("#customer_note_table").append(html_string); 
                $("#note_description").val('');  



              },
              error:function(){

                alert("Error");
              }

            });

          });
        $(document).on('click','.delete-customer-note',function(e){
           var customer_note_id=$(this).data("customer_note_id");
           var hide_row=$(this).parent().parent();
           
           swal({
            title: "Are you sure?",
            text: "Your note will be deleted!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
          },
          function(){
          
          $.ajax({
            
            url:"{{url('admin/delete-customer-note')}}",
            method:"get",
            dataType:"json",
            data:{customer_note_id:customer_note_id},
            success:function(data){
              if(data=="ok"){
                hide_row.fadeOut(1000);
                swal.close();
                
                
              }
              else
              {
                alert("something went wrong");
              }
            },
            error:function(){
              alert("Error");
            }


          }); //ajax

         });
       });
        });
     </script>
    @endsection