@extends('user.customer.customer-panel.customer-panel-layout')
@section('title','Lent Darts')
@section('content')
<div class="right_col" role="main">
  <!-- page content -->
  <div class="page-title">
    <div class="title_left">
      <h3>Lent Darts</h3>
    </div>
  </div>
  <div class="clearfix"></div>
  @if(Session::has('successmessage'))
  <div class="alert alert-success alert-dismissable">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
   {{Session::get('successmessage')}}
  </div>
  @endif

  @if(Session::has('warningmessage'))
  <div class="alert alert-warning alert-dismissable">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
   {{Session::get('warningmessage')}}
  </div>
  @endif
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Lent Darts</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content x_cont">
          <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Title</th>
                <th>Weight</th>                              
                <th>Weight Range</th>
                <th>Price</th>
                <th>Status</th>
                <th>Description</th>
                <th>Image</th>
              </tr>
            </thead>
            <tbody>
             @foreach($products as $product)
              <tr>
                <td>{{$product->product_name}}</td>
                <td>{{$product->product_weight}}</td>
                <td>{{$product->product_weight_range}}</td>
                <td style="width:300px">     
                @if($product->active_status == '1')            
                <form  class="form-label-left confirm-price-set" method="post" action="{{url('choose-product-price-type-process')}}" data-id="{{$product->id}}">
                  {{csrf_field()}}
                  <input type="hidden" name="product_id" value="{{$product->id}}">
                  @php
                  $test_checked = '';
                  $live_checked = '';
                  if($product->product_price_type == "for_sale")
                  {
                    $test_checked="checked";
                  } 
                  elseif ($product->product_price_type == "not_for_sale") 
                  {
                    $live_checked="checked";
                  } 
                  @endphp
                  <div class="radio">
                    <label>
                      <input type="radio" name="product_price_type" value="for_sale" {{@$test_checked}} id="for_sale" data-id="{{$product->id}}"> Set Price
                    </label>
                    <table id="set_darts_price_{{$product->id}}" <?php if($test_checked ==''){ ?> style="display:none" <?php } ?> >
                      <tr><td>Price (£):</td><td><input class="form-control req_class" type="text" name="product_price" id="product_price" value="{{$product->product_price}}" ></td></tr>
                      <tr><td>Paypal Email:</td><td><input class="form-control req_class" type="text" name="paypal_email" id="product_price" value="{{@$user_boot->paypal_email}}" style="margin-top: 10px"></td></tr> 
                    </table>
                  </div>
                  
                  <div class="ln_solid" style="margin:10px 0;"></div>
                  
                  <div class="radio">
                    <label>
                      <input type="radio" name="product_price_type" value="not_for_sale" {{@$live_checked}} id="not_for_sale" data-id="{{$product->id}}"> Not For Sale
                    </label>
                  </div> <br>

                  <div class="form-group pull-right">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
                       <input type="submit" class="btn btn-success" value="Submit">
                    </div>
                  </div>
                </form>
                @else
                  @php
                  $product_price_type = '';
                  if($product->product_price_type == 'not_for_sale')
                  { $product_price_type = 'not_for_sale'; }
                  elseif($product->product_price_type == 'for_sale')
                  { $product_price_type = '£'.$product->product_price;  }
                  @endphp
                  {{$product_price_type}}
                @endif
                </td>
                <td> 
                @php
                $product_status = '';
                if($product->active_status == '0')
                { $product_status = 'Pending'; }
                elseif($product->active_status == '1')
                { $product_status = 'Active';  }
                elseif($product->active_status == '2')
                { $product_status = 'Reserved';  }
                elseif($product->active_status == '3')
                { $product_status = 'Sold';  }
                @endphp
                {{$product_status}}</td>
                <td>{!! $product->product_description !!}</td>
                <td><a href="{{url('public/uploads/darts_img/'.$product->product_image)}}"><img src="{{url('public/uploads/darts_img/'.$product->product_image)}}" height="100px" width="100px"></a></td>
              </tr>
            @endforeach   
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
   <!-- footer content -->
@include('user.customer.customer-panel.footer-customer-panel')
<!-- /footer content -->
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $('input[name=product_price_type]').on('click',function(){
     /* if($(this).val() == 'for_sale'){
      $(".btn-success").show();
      }
      else{
      $(".btn-success").hide();
      }*/

    });  
    $('.confirm-price-set').on('submit', function (e) {      
        var error = false;                
        e.preventDefault();
        var product_price_type = $('input[name=product_price_type]:checked').val();

        //alert($(this).data('id'));

        if(product_price_type == 'for_sale')
        {
          $(this).find('.req_class').each(function () {
            if ($(this).val() == "") {
                error = true;
                $(this).addClass('input-error');
            } else {
                $(this).removeClass('input-error');
            }
          });
        }
        if (error == true) {
            return false;
        } 
        else {
          var datastring = $(".confirm-price-set").serialize();
              $.ajax({
                method: "post",
                url: full_path + "choose-product-price-type-process",
                dataType: "json",
                data: datastring,
                success: function (data) {
                    if (data.error == true && data.error_type == 1) {
                        var msg = data.msg;
                        var response_string = msg;
                        swal({
                            title: data.title,
                            text: data.text,
                            type: "error",
                            closeOnClickOutside: false
                        },
                            function () {
                               // window.location.reload();
                            });

                    }
                    else {
                        swal({
                            title: data.title,
                            text: data.text,
                            type: "success",
                            closeOnClickOutside: false
                        },
                            function () {
                               window.location.reload();
                            });
                    }
                }, // END SUCCESS
                error: function () {
                    alert("Error");
                } // END 
            }); // END AJAX
        } // END ELSE
    });
    });
</script>
<!-- /page content -->
@endsection