@extends('user.customer.customer-layout')
@section('title','Heavy Darts for Rent | Dartsinabottle')
@section('metatitle','Heavy Darts for Rent | Dartsinabottle')
@section('description','Looking for heavy darts to rent? Dartsinabottle has got you covered! Check out our selection of heavy darts available for rent.')
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
              <div class="col-md-5 col-md-5 col-sm-5 pull-left" style="width:30%; padding-left:0; margin-left:0;">
                <a href="{{ url('browse')}}"><button type="button" class="btn btn-previous pull-left">&laquo; Previous</button></a>
              </div>

              <div class="col-md-5 col-md-5 col-sm-5 pull-right" style="width:70%; padding-right:0; margin-right:-14px;">
                <label class="col-md-4 col-md-4 col-sm-4 custom-label" style="text-align:right;padding: 11px 0px;">Sort by:</label>
                <div class="col-md-8 col-md-8 col-sm-8 pull-right">
                    <select name="sorting" id="sorting" class="form-control form-control-sm">
                      <option value="W_ASC" @if($sortby == 'W_ASC') selected @endif>Weight: light to heavy</option>
                      <option value="W_DESC" @if($sortby == 'W_DESC') selected @endif>Weight: heavy to light</option>

                      <option value="L_DESC" @if($sortby == 'L_DESC') selected @endif>Dimensions : long to short</option>
                      <option value="L_ASC" @if($sortby == 'L_ASC') selected @endif>Dimensions : short to long</option>

                      <option value="N_ASC" @if($sortby == 'N_ASC') selected @endif>Dimensions : narrow to wide</option>
                      <option value="N_DESC" @if($sortby == 'N_DESC') selected @endif>Dimensions : wide to narrow</option>
                    </select>
                </div>
              </div>
            </div>
          </br>
          <div class="row form-btn-group">
            <h1 class="text-center">Heavy Darts for Rent</h1>
          </div>
            <div class="row badges-row">              
              <div class="col-xs-12 badges-sizes text-center">
                <p class="about-page">
                  If you’re looking for heavy darts for rent, Dartsinabottle is the place to be. Our heavy darts are made from high-quality materials that ensure durability and accuracy. Whether you’re a professional or a beginner, our heavy darts are perfect for anyone who wants to improve their dart game. Browse our selection of heavy darts to find the right one for you.
                </p>
                 @foreach($products as $product) 
                <div class="col-md-4 col-sm-12" style="margin-bottom: 30px;">
                  <a href="{{url('public/uploads/darts_img/'.$product->product_image)}}"  data-fancybox="images" data-caption="{{@$product->product_name}}">
                    <img src="{{url('public/uploads/darts_img/'.$product->product_image)}}" height="300px" width="300px" alt="Heavy Darts for Rent" ></a></br>
                  {!!@ $product->product_description!!}<br>
                  {{@$product->product_weight}} g<br>
                  @if($product->product_length != '')
                  {{@$product->product_length}}mm * {{@$product->product_width}}mm<br>
                  @endif
                  
                    @if(@$order_details->status == 4)
                      @if($product->active_status == '1')
                        <button type="button" class="btn confirm-send" data-product_id="{{@$product->id}}" >Send</button>
                      @elseif($product->active_status == '3')
                        <button type="button" class="btn" disabled>Sold</button>
                      @else
                      <button type="button" class="btn" disabled>In Use</button>
                      @endif
                    @else
                      @if($product->active_status == '1')
                      <a href="{{ url('subscribe')}}"><button type="button" class="btn" >In Stock</button></a>
                      @elseif($product->active_status == '3')
                      <button type="button" class="btn" disabled>Sold</button>
                      @else
                      <button type="button" class="btn" disabled>In Use</button>
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

