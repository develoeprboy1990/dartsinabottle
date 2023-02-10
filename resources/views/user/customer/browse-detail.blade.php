@extends('user.customer.customer-layout')
@section('title','Get Started | Set Of Darts & Sell and Buy Darts | Dartsinabottle')
@section('description','Dartsinabottle offers to buy the best set of darts at reasonable prices and time duration. Here you can choose your required set of darts.')
@section('content')
{{-- Header Content --}}
@include('user.customer.header-customer')
{{-- Header Content End  --}}
<div class="container" style="margin-top:20px;margin-bottom:20px;">
  <div class="row">
    <div class="col-xs-12 badges-form-col">
      <form class="badges-form" action="{{ url('cart')}}" method="post">
        <!-- fieldset 1 start from here -->          
      

            <div class="form-btn-group text-center text-center">
              <div class="col-md-5 col-md-5 col-sm-5 pull-left">
              <a href="{{ url('browse')}}"><button type="button" class="btn btn-previous pull-left">&laquo; Previous</button></a>
            </div>

            <div class="col-md-5 col-md-5 col-sm-5 pull-right">
              <label class="col-md-4 col-md-4 col-sm-4 pull-left" style="text-align:right;padding: 11px 0px;">Sort by:</label>
               <div class="col-md-8 col-md-8 col-sm-8 pull-right">
                  <select name="sorting" id="sorting" class="form-control form-control-sm">
                     <option value="ASC" @if($sortby == 'ASC') selected @endif>Weight: light to haevy</option>
                     <option value="DESC" @if($sortby == 'DESC') selected @endif>Weight: heavy to light</option>
                  </select>
               </div>
            </div>
      
            </div>
            <h1 class="badges-title text-center">{{$type}}</h1>
            <div class="row badges-row">              
              <div class="col-xs-12 badges-sizes text-center">
                 @foreach($products as $product) 
                <div class="col-md-4 col-sm-12" style="margin-bottom: 30px;">
                  <a href="{{url('public/uploads/darts_img/'.$product->product_image)}}"  data-fancybox="images" data-caption="{{@$product->product_name}}">
                    <img src="{{url('public/uploads/darts_img/'.$product->product_image)}}" height="300px" width="300px" ></a></br>
                  {!!@ $product->product_description!!}<br>
                  {{@$product->product_weight}} g<br>
                  
                    @if(@$order_details->status == 2)
                      @if($product->active_status == '1')
                        <button type="button" class="btn confirm-send" data-product_id="{{@$product->id}}" >Send</button>
                      @else
                        <button type="button" class="btn confirm-inuse" disabled>In Use</button>
                      @endif
                    @endif
                    <!-- 
                    On clicking send button first check if he is lend user or deposit user
                    
                    1)if lend user then check he send the lend darts or not.if yes then allow him to process with sweet alreat.

                    2)if deposit user then allow him to procced with sweet alreat.
                    -->
                </div>
                @endforeach
              </div>
            </div>
            <!-- <h1 class="badges-title text-center">+ many more</h1> -->
        
      </form>
    </div>
  </div>
</div>
{{-- Footer Content --}}
@include('user.customer.footer-customer')
{{-- Footer Content End  --}}
@endsection
@section('javascript')
 <script src="{{asset('assets/customer/assets/js/customform.js')}}"></script>
 <script type="text/javascript">
 $("#sorting").on('change', function() {
    var sortBy = 'sortby_'+this.value;

    var url =  "<?php echo url()->current(); ?>";

    if(url.includes('sortby'))
    {
      url = url.slice(0, url.lastIndexOf('/'));
    }

    var url = url+"/"+sortBy;
    window.location.href = url;
  });

  $(document).ready(function () {

    $('.confirm-send').on('click', function (e){    
        var error = false;                
        e.preventDefault();
        var product_id=$(this).data("product_id");

        $.ajax({
            headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },            
            method: "post",
            url: full_path + "verify-customer-choice",
            dataType: "json",
             data:{"product_id":product_id},
            success: function (data) {
              if (data.error == true && data.error_type == 1) {
                var msg = data.msg;
                var response_string = msg;
                swal({
                  title: data.title,
                  text: data.text,
                  type: "error",
                  closeOnClickOutside: false
                });
              }else if (data.error == true && data.error_type == 2) {
                var msg = data.msg;
                var response_string = msg;
                swal({
                  title: data.title,
                  text: data.text,
                  type: "error",
                  closeOnClickOutside: false
                });
              }
              else {
                swal({
                title: data.title,
                text: data.text,
                icon: 'warning',
                type: "warning",
                closeOnClickOutside: false,
                confirmButtonText: "Yes, send them.",
                showCancelButton: true,
                },
                function () {
                  $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },  
                    method:"post",
                    url:full_path+"ship-order-whose-payment-is-done",
                    dataType:"json",
                    data:{"product_id":product_id},
                    beforeSend:function(){

                      $('#loader_modal').modal({
                        backdrop: 'static',
                        keyboard: false
                      });
                      $("#loader_modal").modal('show');
                    },
                    success:function(data){
                      $("#loader_modal").modal('hide');
                      if(data.error == 'limit reached'){
                        swal({ 
                          title: "Limit Reached!",
                          text: "You have already been sent darts for the current billing period. Please try again later.",
                          icon: 'warning',
                          type: "warning" ,
                          closeOnClickOutside: false
                        },
                        function(){
                          //window.location.href=full_path+"current-darts";
                        
                        });
                      
                      }
                      else if(data.error == 'no subscribtion'){
                        swal({ 
                        title: "No subscribtion!",
                        text: "subscribtion Not Found",
                        type: "warning" 
                        },
                        function(){
                         // window.location.href=full_path+"orders/my-subscriptions";
                        
                        });
                      
                      }
                      else if(data.error == 'success'){
                        swal({ 
                        title: "Success!",
                        text: "Your dartsinabottle will be sent out.",
                        type: "success" 
                        },
                        function(){
                          //window.location.href=full_path+"current-darts";
                        
                        });
                      
                      }

                      else{
                        swal("Something went wrong");
                      }

                    },
          error:function(){
            alert("Error");
          }

        });
                });
              }
            }, // END SUCCESS
            error: function () {
            alert("Error");
            } // END 
          }); // END AJAX
        
    });
  });
</script>
@endsection

