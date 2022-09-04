//var full_path="https://badge.aladdinapps.com/order/";
//var full_path="http://localhost/badges/";
var full_path = $('#site_url').val()+'/';
$(document).ready(function(){

  $(document).on('change',"#shipping_state",function(){
  var state_id=$(this).val();
  
  $.ajax({

    url:full_path+"filter-city",
    method:"get",
    dataType:"json",  
    data:{state_id:state_id},
    success:function(data){

      var html_string='<div class="col-sm-12 col-xs-12 form-group"> <label>City/Town*</label>';
       html_string+=' <select class="selectpicker form-control required" id="shipping_city"  data-live-search="true" title="Choose City/Town"  name="city_id" required="true">';
      for(var i=0;i<data.length;i++){

        html_string+="<option value='"+data[i]['id']+"'>"+data[i]['name']+"</option>";



      }
      html_string+=" </select></div>";
        
       $("#shipping_cities_div").show();  
       $("#shipping_cities_div").html(html_string); 
       $('.selectpicker').selectpicker('refresh');
        
    },
    error:function(){

      alert('Error');
    }

  });


});

  $('.edit_badge_detail').on('click',function(){

  var cart_id=$(this).data('cart_id');

  $.ajax({

    method:"get",
    dataType:"json",
    url:full_path+"edit-cart",
    data:{cart_id:cart_id},
    beforeSend:function(){
      $(this).attr('disabled','true');
      $("#cart_loader"+cart_id).show();

    },
    success:function(data){
      $(this).removeAttr('disabled','true');
      $("#cart_loader"+cart_id).hide();

      // alert(data);
      // return false;
      var html_string= ''
                      +' <div class="form-group">  <label for="quantity">Badge Quantity</label>'
                      +' <input type="number" class="form-control" id="edit_total_badge_qty" placeholder="Enter quantity" name="total_badge_qty" value="'+data.cart.total_badge_qty+'" min="1">'                         
                      +' </div> ';

                      html_string+=' <input type="hidden" class="form-control" id="cart_id"  name="cart_id" value="'+cart_id+'">';

                      $("#edit_cart_content").html(html_string);

                      $("#edit_badge_detail_modal").modal("show");


    },
    error:function(){
      alert("Error");
    }

  });



});

  $('.edit_product_detail').on('click',function(){

  var cart_id=$(this).data('cart_id');

  $.ajax({

    method:"get",
    dataType:"json",
    url:full_path+"edit-product-cart",
    data:{cart_id:cart_id},
    beforeSend:function(){
      $(this).attr('disabled','true');

    },
    success:function(data){
      $(this).removeAttr('disabled','true');
      $("#cart_loader"+cart_id).hide();

      // alert(data);
      // return false;
      var html_string= ''
                      +' <div class="form-group">  <label for="quantity">Badge Quantity</label>'
                      +' <input type="number" class="form-control" id="edit_total_badge_qty" placeholder="Enter quantity" name="total_badge_qty" value="'+data.cart.total_badge_qty+'" min="1">'                         
                      +' </div> ';

                      html_string+=' <input type="hidden" class="form-control" id="prod_cart_id"  name="prod_cart_id" value="'+cart_id+'">';

                      $("#edit_cart_content").html(html_string);

                      $("#edit_badge_detail_modal").modal("show");


    },
    error:function(){
      alert("Error");
    }

  });



});

  $('#check_promo_button').on('click',function(){

  var coupon_code=$('#coupon_code').val();

  var subtotal = $(this).data("subtotal");
  var user_id = $(this).data("user_id");
  var shipping_cost = $(this).data("shipping_cost");

 $.ajax({
    method:"get",
    dataType:"json",
    url:full_path+"admin/check-coupon/",
    data:{coupon_code:coupon_code,subtotal:subtotal,user_id:user_id},
    beforeSend:function(){
       $("#waiting_modal").modal('show');
    },
    success:function(data){
    $("#waiting_modal").modal('hide');

    if(data.error == false){
      $("#amount_td").text(data.subtotal+shipping_cost);
      $(".coupon_error").css('color','#1b78be');
      $(".coupon_error").text(data.msg);
      $(".coupon_discount").val(data.coupon_discount);
      $(".amount").val(data.subtotal+shipping_cost);
      
    }else
    {
      $(".coupon_error").css('color','red');
      $(".coupon_error").text(data.msg);
      $(".coupon_discount").val(data.coupon_discount);
      $('#coupon_code').val('');
    }

    },
    error:function(){
      alert("Error");
    }



  });
});

  $("#edit_badge_detail_form").on('submit',function(e){

  e.preventDefault();
  // console.log($("#edit_badge_detail_form").serialize());
  // return;

  if($("#edit_total_badge_qty").val()<1){
      swal("Atleast 1 item is required");
      return false;
  }

  $.ajax({
    url:full_path+"edit-cart",
    dataType:"json",
    method:"post",
    data:$("#edit_badge_detail_form").serialize(),
    beforeSend:function(){
      $("#update_cart_loader").show();
      $("#update_quantity_btn").attr('disabled','true');

    },
    success:function(data){
      $("#update_cart_loader").hide();
      $("#update_quantity_btn").removeAttr('disabled','true');

      if(data.error == false){
        swal({ 
            title: "Success!",
            text: 'Badge Quantity Edited Successfully',
            type: "success",
            closeOnClickOutside: false
            },
            function(){ 
            window.location.reload();
         });  
      }
      else
      {
        swal("Something went wrong");
      }

    },
    error:function(){
      alert("Error");
    }

  });

});

  $(".delete_cart_item").on('click',function(e){


    var cart_id=$(this).data('cart_id');

   swal({
        title: "Delete this order?",
        text: "You will not be able to recover it.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: full_path+"delete-cart-item",
            method: "get",
            data: {
                cart_id: cart_id
            },
            dataType: "json",
            success: function (data) {
                if(data =="ok"){
                 swal({ 
                      title: "Success!",
                      text: 'Package Deleted Successfully',
                      type: "success",
                      closeOnClickOutside: false
                      },
                      function(){ 
                      window.location.href = full_path+'shop';
                      //window.location.reload();
                   });  
                }
            },
            error: function () {
                swal("Error deleting!", "Please try again", "error");
            }
        });
    });


});

  $(".delete_prod_cart_item").on('click',function(e){


    var cart_id=$(this).data('cart_id');

   swal({
        title: "Are you sure?",
        text: "You will not be able to recover this record!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: full_path+"delete-prod-cart-item",
            method: "get",
            data: {
                cart_id: cart_id
            },
            dataType: "json",
            success: function (data) {
                if(data =="ok"){
                 swal({ 
                      title: "Success!",
                      text: 'Badge Deleted Successfully',
                      type: "success",
                      closeOnClickOutside: false
                      },
                      function(){ 
                      window.location.reload();
                   });  
                }
            },
            error: function () {
                swal("Error deleting!", "Please try again", "error");
            }
        });
    });


});

  $(document).on('change',"#add_more_shipping_state",function(){
  
  var state_id=$(this).val();
  
  $.ajax({

    url:full_path+"filter-city",
    method:"get",
    dataType:"json",  
    data:{state_id:state_id},
    beforeSend:function(){
      
      $("#state_loader").show();
      // $("#add_more_shipping_state").attr('disabled','true');  
    },
    success:function(data){
      
      $("#state_loader").hide();
      // $("#add_more_shipping_state").removeAttr('disabled','true');  

      var html_string='<div class="form-group"> <label>City</label>';
       html_string+=' <select class="selectpicker form-control required" id="add_more_shipping_city"  data-live-search="true" title="Choose City"  name="city_id">';
      for(var i=0;i<data.length;i++){

        html_string+="<option value='"+data[i]['id']+"'>"+data[i]['name']+"</option>";



      }
      html_string+=" </select></div>";
        
         
       $("#div_add_more_shipping_city").html(html_string); 
       $('.selectpicker').selectpicker('refresh');
        
    },
    error:function(){

      alert('Error');
    }

  });


});

  $("#add_more_shipping_detail_form").on('submit',function(e){
  e.preventDefault();
  $.ajax({

    method:"post",
    url:full_path+'add-more-shipping-detail',
    dataType:'json',
    data:$("#add_more_shipping_detail_form").serialize(),
    beforeSend:function(){
      $("#add_more_shipping_detail_loader").show();
      $("#add_more_shipping_detail_add_btn").attr('disabled','true');
    },
    success:function(data){

      if(data =="ok"){
       $("#add_more_shipping_detail_loader").hide();
       $("#add_more_shipping_detail_add_btn").removeAttr('disabled','true');


         swal({ 
              title: "Success!",
              text: 'New Shipping Information Added Successfully.Please choose your shipping information from the dropdown',
              type: "success",
              closeOnClickOutside: false
              },
              function(){ 
              window.location.reload();
           }); 
      }
   },
   error:function(){
    alert("Error");
   }

  })

});

  $("#user_shipping_info").on('change',function(){
  var id=$(this).val();

  if(id==""){
    
            $("#address").val('');
            $("#state").val('');
            $("#city").val('');
            $("#zip_code").val('');
            $("#phone_number").val('');
            $("#email_address").val('');
            // $(".shipping_id").val('');
    swal("Please choose your shipping Information");
    return false;
  }
  $.ajax({
    method:"get",
    url:full_path+'user-shipping-information',
    dataType:"json",
    data:{id:id},
    beforeSend:function(){
      $('#waiting_modal').modal({
            backdrop: 'static',
            keyboard: false
          });
          
      $("#waiting_modal").modal('show');
    },
    success:function(data){

      if(data.error == false){

            $("#billing_checkbox").prop("checked",false);
            $("#waiting_modal").modal('hide');
            $("#address").val(data.shipping_detail.address);
            // $("#state").val(data.state);
            // $("#city").val(data.city);
            $("#zip_code").val(data.shipping_detail.zip);
            $("#phone_number").val(data.shipping_detail.phone);
            $("#email_address").val(data.shipping_detail.email);
            // $(".shipping_id").val(data.shipping_detail.id);

            // Shipping state and city started
            var html_string = '<div class="col-sm-4 col-xs-12 form-group highlight_select">'
                              +'<label>State </label>'
                              +'<select class="selectpicker form-control required" name="state" data-live-search="true"  title="Choose State" id="state" data-selector_type="select">'; 
            for(var i=0;i<data.states.length;i++){

              if(data.states[i].id == data.shipping_detail.state_id){
                var ship_state_select="selected";
              }
              else{
                var ship_state_select="";

              }
              html_string+=' <option value="'+data.states[i].id+'" '+ship_state_select+'>'+data.states[i].name+' </option>';

            }
            html_string+=' </select> </div>';

            
            html_string+= ' <span id="shipping_details_city_div"> <div class="col-sm-4 col-xs-12 form-group highlight_select">'
                        +' <label>City </label>'
                        +' <select class="selectpicker form-control required" name="city" data-live-search="true"  title="Choose City" id="city" data-selector_type="select">'; 
            for(var i=0;i<data.cities.length;i++){

              if(data.cities[i].id == data.shipping_detail.city_id){
                var ship_city_select="selected";
              }
              else{
                var ship_city_select="";

              }
              html_string+=' <option value="'+data.cities[i].id+'" '+ship_city_select+'>'+data.cities[i].name+' </option>';

            }
            html_string+=' </select> </div> </span>';   

            $("#fill_state_cities_data").html(html_string);
            
            $('.selectpicker').selectpicker('refresh');

            // Shipping state and city ended


            $("#pay_from_existing_authorize_card").removeAttr('disabled','true');

            //code related to shipping cost and sub totals
           
            if(data.get_total_values.shipping_cost == null){

            $("#shipping_amount_td").addClass('give_shipping_error'); 
            $("#shipping_amount_td").html("Shipping Cost not defined");
            $("#place_order_button").attr('disabled','true');
            $("#pay_from_existing_authorize_card").attr('disabled','true');
            $(".amount").val("");

            }
            else
            {
              
              $("#shipping_amount_td").removeClass('give_shipping_error'); 

              

            
            $("#shipping_amount_td").html("$"+data.get_total_values.shipping_cost);
            $("#place_order_button").removeAttr('disabled','true');
            $(".amount").val(data.get_total_values.final_total);

            }

            if(data.get_total_values.state_tax == 0.00){

            $(".state_tax_tr").css('display' , 'none'); 
            $("#state_tax_td").html("State tax not defined");


            }
            else
            {
              
            $(".state_tax_tr").css('display' , 'block'); 
            $("#state_tax_td").html("$"+data.get_total_values.state_tax);
          

            }
            $("#sub_total_td").html(data.get_total_values.total_sub_total);
            $("#discounted_total_td").html(data.get_total_values.total_discounted_total);
            $("#amount_td").html(data.get_total_values.final_total);
            $(".shipping_cost").val(data.get_total_values.shipping_cost);
            $(".sub_total").val(data.get_total_values.total_sub_total);
            $(".discounted_total").val(data.get_total_values.total_discounted_total);


            //code related to shipping cost and sub totals ended

           
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

  $(document).on('change','input[name=billing_checkbox]',function(){

    $('#waiting_modal').modal({
      backdrop: 'static',
      keyboard: false
    });
    $("#waiting_modal").modal('show');
    var ischecked= $(this).is(':checked');    

    if(ischecked){
      var country_id=230;
      var city_id=$("#city_id").val();
      var first_name=$("#first_name").val();
      var last_name=$("#last_name").val();
      var address=$("#address").val();
      var address_2=$("#address_2").val();
      var zip_code=$("#zip_code").val();
      var phone_number=$("#phone_number").val();
      var email_address=$("#email_address").val();

      $("#billing_first_name").val(first_name);
      $("#billing_last_name").val(last_name);
      $("#billing_address").val(address);
      $("#billing_address_2").val(address_2);
      $("#billing_city").val(city_id);
      $("#billing_zip_code").val(zip_code);
      $("#billing_phone_number").val(phone_number);
      $("#billing_email").val(email_address);
      $("#waiting_modal").modal('hide');


      $('.selectpicker').selectpicker('refresh');
    }else{
      $("#billing_first_name").val('');
      $("#billing_last_name").val('');
      $("#billing_address").val('');
      $("#billing_address_2").val('');
      $("#billing_city").val('');
      $("#billing_zip_code").val('');
      $("#billing_phone_number").val('');
      $("#billing_email").val('');
      $("#waiting_modal").modal('hide');
    }

  });

  $(document).on('change',"#billing_state",function(){
  
  var state_id=$(this).val();
  
  $.ajax({

    url:full_path+"filter-city",
    method:"get",
    dataType:"json",  
    data:{state_id:state_id},
    beforeSend:function(){
      
      $("#billing_state_loader").show();
      // $("#add_more_shipping_state").attr('disabled','true');  
    },
    success:function(data){
      
      $("#billing_state_loader").hide();
      // $("#add_more_shipping_state").removeAttr('disabled','true');  

      var html_string='<div class="col-sm-4 col-xs-12 form-group highlight_select"> <label>City/Town</label>';
       html_string+=' <select class="selectpicker form-control required" id="billing_city"  data-live-search="true" title="Choose City/Town"  name="billing_city" data-selector_type="select">';
      for(var i=0;i<data.length;i++){

        html_string+="<option value='"+data[i]['id']+"'>"+data[i]['name']+"</option>";



      }
      html_string+=" </select></div>";
        
         
       $("#billing_city_div").html(html_string); 
       $('.selectpicker').selectpicker('refresh');
        
    },
    error:function(){

      alert('Error');
    }

  });


});

  // reorder
  $('#reorder-form').on('submit', function (e) {
        var error=false;
        e.preventDefault();
        $(this).find('input[type="text"],input[type="email"],select').each(function () {
            if ($(this).val() == "") {
              alert("error");
                error=true; 
                // e.preventDefault();
                $(this).addClass('input-error');
                // return false;
            } else {

                $(this).removeClass('input-error');
            }
        });

        if(error == true){
          return false;
        }
        else
        {


        $.ajax({

           method:"post",
           url:full_path+"reorder",
           dataType:"json",
           data:$("#reorder-form").serialize(),
           beforeSend: function(){
             
            $('#authorize_waiting_modal').modal({
                backdrop: 'static',
                keyboard: false
              });
              
            $("#authorize_waiting_modal").modal('show');


            },
           success:function(data){
        
              $("#authorize_waiting_modal").modal('hide');


              // $("#payment_loader").hide();
             
              if(data.error == true && data.error_type==1)
              { 
                  
                var c_c_p_r_get_code=data.c_c_p_r_get_code;
                var c_c_p_r_get_text=data.c_c_p_r_get_text;

                var response_string="Error! Customer profile not created successfully\n"+"Response: "+c_c_p_r_get_code+" "+c_c_p_r_get_text;
                 swal({ 
                  title: "Error!",
                  text: response_string,
                  type: "error",
                  closeOnClickOutside: false
                  },
                  function(){
                  // window.location.href = full_path+'shop';
                  window.location.reload();
                });                  

                
              }

              else if(data.error == true && data.error_type==2){
                
              if(data.error_code ==8)
               {
                var response_string="Payment failed. Credit card has expired!";
                   swal({ 
                    title: "Error!",
                    text: response_string,
                    type: "error",
                    closeOnClickOutside: false
                    },
                    function(){
                    // window.location.href = full_path+'shop';
                    window.location.reload();
                  });
               }
               else
               {

                var error_code=data.error_code;
                var error_message=data.error_message;

                var response_string="Customer profile not charged successfully\n"+"Response: "+error_code+" "+error_message;
                 swal({ 
                  title: "Error!",
                  text: response_string,
                  type: "error",
                  closeOnClickOutside: false
                  },
                  function(){
                  // window.location.href = full_path+'shop';
                  window.location.reload();
                });   

               }

                  
              }

             else if(data.error == true && data.error_type==3){

                var msg=data.msg;
                var response_string=msg;
                   swal({ 
                    title: "Error!",
                    text: response_string,
                    type: "error",
                    closeOnClickOutside: false
                    },
                    function(){
                    // window.location.href = full_path+'shop';
                    window.location.reload();
                  });
                  
             }  

              else 
              {
                // var text_msg="Paymenttt doneeee\n"+"testing";
                swal({ 
                title: "Success!",
                text: 'Payment done',
                type: "success",
                closeOnClickOutside: false
                },
                function(){
                window.location.href = full_path+'shop';
                });
              }
           },
           error:function(){
            alert("Error");
           } 


        });  //ajax
        } //else

    });  //reorder-form end  

  $("#pay_from_existing_authorize_card").on('click',function(){
    
   // e.preventDefault();
    // $("#card_number, #card_cvv, #card_month, #card_year").removeClass('input-error');
   
    //billing details
    var billing_first_name=$("#billing_first_name").val();
    var billing_last_name=$("#billing_last_name").val();
    var billing_address=$("#billing_address").val();
    var billing_country=$("#billing_country").val();
    var billing_state=$("#billing_state").val();
    var billing_city=$("#billing_city").val();
    var billing_zip_code=$("#billing_zip_code").val();
    var billing_phone_number=$("#billing_phone_number").val();
    var billing_email=$("#billing_email").val();

    // shipping details
    var first_name=$("#first_name").val();
    var last_name=$("#last_name").val();
    var address=$("#address").val();
    var country=$("#country").val();
    var state=$("#state").val();
    var city=$("#city").val();
    var phone_number=$("#phone_number").val();
    var zip_code=$("#zip_code").val();
    var email=$("#email_address").val();

    var customer_internal_reference_no=$("#customer_internal_reference_no").val();
    var order_note=$("#order_note").val();

    var html_string='  <input type="hidden" name="billing_first_name" class="billing_first_name" value="'+billing_first_name+'">'
                    +' <input type="hidden" name="billing_last_name" class="billing_last_name" value="'+billing_last_name+'">'
                    +' <input type="hidden" name="billing_address" class="billing_address" value="'+billing_address+'">'
                    +' <input type="hidden" name="billing_country" class="billing_country" value="'+billing_country+'">'
                    +' <input type="hidden" name="billing_state" class="billing_state" value="'+billing_state+'">'
                    +' <input type="hidden" name="billing_city" class="billing_city" value="'+billing_city+'">'
                    +' <input type="hidden" name="billing_zip_code" class="billing_zip_code" value="'+billing_zip_code+'">'
                    +' <input type="hidden" name="billing_phone_number" class="billing_phone_number" value="'+billing_phone_number+'">'
                    +' <input type="hidden" name="billing_email" class="billing_email" value="'+billing_email+'">'
                    +' <input type="hidden" name="customer_internal_reference_no"  value="'+customer_internal_reference_no+'">'
                    +' <input type="hidden" name="order_note"  value="'+order_note+'">';

        html_string+=' <input type="hidden" name="first_name"  value="'+first_name+'">'
                    +' <input type="hidden" name="last_name"  value="'+last_name+'">'             
                    +' <input type="hidden" name="address"  value="'+address+'">'             
                    +' <input type="hidden" name="country"  value="'+country+'">'             
                    +' <input type="hidden" name="state"  value="'+state+'">'             
                    +' <input type="hidden" name="city"  value="'+city+'">'             
                    +' <input type="hidden" name="phone_number"  value="'+phone_number+'">'             
                    +' <input type="hidden" name="zip_code"  value="'+zip_code+'">'             
                    +' <input type="hidden" name="email"  value="'+email+'">';             

    $("#fill_billing_details_fields").html(html_string);                
    $('#place_order_button').prop("disabled",true);


      $.ajax({

        url:full_path+'authorize/charge-existing-customer-profile',
        dataType:'json',
        method:'post',
        data:$("#existing_authorize_credit_card").serialize(),
        beforeSend:function(){
          // swal({
          //   title: "Please wait!",
          //   closeOnClickOutside: false,
          //   showConfirmButton:false  
          //    });
          $('#authorize_waiting_modal').modal({
            backdrop: 'static',
            keyboard: false
          });
          
          $("#authorize_waiting_modal").modal('show');


        },
        success:function(data){
          $("#authorize_waiting_modal").modal('hide');
          if(data.error == true && data.error_type==1)
          { 
              
            var error_code=data.error_code;
            var error_message=data.error_message;

            var response_string="Customer profile not charged successfully\n"+"Response: "+error_code+" "+error_message;
             swal({ 
              title: "Error!",
              text: response_string,
              type: "error",
              closeOnClickOutside: false
              },
              function(){
              // window.location.href = full_path+'shop';
              window.location.reload();
            });                  

            
          }
          else if(data.error == true && data.error_type==2){
            var response_string=data.error_message;

            swal({ 
              title: "Error!",
              text: response_string,
              type: "error",
              closeOnClickOutside: false
              },
              function(){
              // window.location.href = full_path+'shop';
              window.location.reload();
            });

          }

          else
          {
            swal({ 
            title: "Success!",
            text: 'Order Placed successfully',
            type: "success",
            closeOnClickOutside: false
            },
            function(){
            window.location.href = full_path+'order-thankyou-page';
            });
          }

        },
        error:function(){
          alert("Error");

        }


      });
        


});

  $("#user_custom_badge_shipping_info").on('change',function(){
  var id=$(this).val();
  var custom_badge_detail_id=$("#custom_badge_detail_id").val();
  // var sub_total=$("#sub_total_test").val();



  if(id==""){
    
            $("#address").val('');
            $("#state").val('');
            $("#city").val('');
            $("#zip_code").val('');
            $("#phone_number").val('');
            $("#email_address").val('');
            $(".shipping_id").val('');
    swal("Please choose your shipping Information");
    return false;
  }
  $.ajax({
    method:"get",
    url:full_path+'user-custom-badge-shipping-information',
    dataType:"json",
    data:{id:id,custom_badge_detail_id:custom_badge_detail_id},
    beforeSend:function(){
      $('#waiting_modal').modal({
            backdrop: 'static',
            keyboard: false
          });
          
      $("#waiting_modal").modal('show');
    },
    success:function(data){
      if(data.error == false){
            $("#waiting_modal").modal('hide');
            $("#address").val(data.shipping_detail.address);
            $("#state").val(data.state);
            $("#city").val(data.city);
            $("#zip_code").val(data.shipping_detail.zip);
            $("#phone_number").val(data.shipping_detail.phone);
            $("#email_address").val(data.shipping_detail.email);
            $(".shipping_id").val(data.shipping_detail.id);
            $("#pay_from_existing_authorize_card_custom_badge").removeAttr('disabled','true');

            //code related to shipping cost and sub totals
           
            if(data.get_total_values.shipping_cost == null){

            $("#shipping_amount_td").addClass('give_shipping_error'); 
            $("#shipping_amount_td").html("Shipping Cost not defined");
            $("#place_order_button").attr('disabled','true');
            $("#pay_from_existing_authorize_card_custom_badge").attr('disabled','true');
            $(".amount").val("");

            }
            else
            {
              
              $("#shipping_amount_td").removeClass('give_shipping_error'); 

              

            
            $("#shipping_amount_td").html(data.get_total_values.shipping_cost);
            $("#place_order_button").removeAttr('disabled','true');
            $(".amount").val(data.get_total_values.final_total);

            }
            $("#sub_total_td").html(data.get_total_values.total_sub_total);
            // $("#discounted_total_td").html(data.get_total_values.total_discounted_total);
            $("#amount_td").html(data.get_total_values.final_total);
            $(".shipping_cost").val(data.get_total_values.shipping_cost);
            $(".sub_total").val(data.get_total_values.total_sub_total);
            // $(".discounted_total").val(data.get_total_values.total_discounted_total);


            //code related to shipping cost and sub totals ended

           
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

  // custom-badge-checkout-form
  $('#custom-badge-checkout-form').on('submit', function (e) {

        var error=false;
        e.preventDefault();

        var payment_type_id =  $(".payment_type_id").val();

        
        if($('input[name=payment_type]').is(':checked')){
          error =false;
          $("#payment_type_div").removeClass('highlight-border');

        }
        else{
          error =true;
          $("#payment_type_div").addClass('highlight-border');
          return false;

        }

        if(payment_type_id ==1)
        {
        $(this).find('.validation_of_card').each(function () {
            if ($(this).val() == "") {
              
              
                error=true; 
                // e.preventDefault();
                $(this).addClass('input-error');
                // return false;
            } else {

                $(this).removeClass('input-error');
            }
        });
       }
      
        if(error == true){
          return false;
        }
        else
        {


        $.ajax({

           method:"post",
           url:full_path+"place-custom-badge-order",
           dataType:"json",
           data:$("#custom-badge-checkout-form").serialize(),
           beforeSend: function(){
             
            $('#authorize_waiting_modal').modal({
                backdrop: 'static',
                keyboard: false
              });
              
            $("#authorize_waiting_modal").modal('show');


            },
           success:function(data){
        
              $("#authorize_waiting_modal").modal('hide');


              // $("#payment_loader").hide();
             
              if(data.error == true && data.error_type==1)
              { 
                  
                var c_c_p_r_get_code=data.c_c_p_r_get_code;
                var c_c_p_r_get_text=data.c_c_p_r_get_text;

                var response_string="Error! Customer profile not created successfully\n"+"Response: "+c_c_p_r_get_code+" "+c_c_p_r_get_text;
                 swal({ 
                  title: "Error!",
                  text: response_string,
                  type: "error",
                  closeOnClickOutside: false
                  },
                  function(){
                  // window.location.href = full_path+'shop';
                  window.location.reload();
                });                  

                
              }

              else if(data.error == true && data.error_type==2){
                
              if(data.error_code ==8)
               {
                var response_string="Payment failed. Credit card has expired!";
                   swal({ 
                    title: "Error!",
                    text: response_string,
                    type: "error",
                    closeOnClickOutside: false
                    },
                    function(){
                    // window.location.href = full_path+'shop';
                    window.location.reload();
                  });
               }
               else
               {

                var error_code=data.error_code;
                var error_message=data.error_message;

                var response_string="Customer profile not charged successfully\n"+"Response: "+error_code+" "+error_message;
                 swal({ 
                  title: "Error!",
                  text: response_string,
                  type: "error",
                  closeOnClickOutside: false
                  },
                  function(){
                  // window.location.href = full_path+'shop';
                  window.location.reload();
                });   

               }

                  
              }

             else if(data.error == true && data.error_type==3){

                var msg=data.msg;
                var response_string=msg;
                   swal({ 
                    title: "Error!",
                    text: response_string,
                    type: "error",
                    closeOnClickOutside: false
                    },
                    function(){
                    // window.location.href = full_path+'shop';
                    window.location.reload();
                  });
                  
             }  

              else 
              {
                // var text_msg="Paymenttt doneeee\n"+"testing";
                swal({ 
                title: "Success!",
                text: 'Payment done',
                type: "success",
                closeOnClickOutside: false
                },
                function(){
                window.location.href = full_path+'dashboard';
                });
              }
           },
           error:function(){
            alert("Error");
           } 


        });  //ajax
        } //else

    });  //custom-badge-checkout-form end

  $("#pay_from_existing_authorize_card_custom_badge").on('click',function(){
    
   // e.preventDefault();
    // $("#card_number, #card_cvv, #card_month, #card_year").removeClass('input-error');
   
    //billing details
    var billing_first_name=$("#billing_first_name").val();
    var billing_last_name=$("#billing_last_name").val();
    var billing_address=$("#billing_address").val();
    var billing_country=$("#billing_country").val();
    var billing_state=$("#billing_state").val();
    var billing_city=$("#billing_city").val();
    var billing_zip_code=$("#billing_zip_code").val();
    var billing_phone_number=$("#billing_phone_number").val();
    var billing_email=$("#billing_email").val();

    // shipping details
    var first_name=$("#first_name").val();
    var last_name=$("#last_name").val();
    var address=$("#address").val();
    var country=$("#country").val();
    var state=$("#state").val();
    var city=$("#city").val();
    var phone_number=$("#phone_number").val();
    var zip_code=$("#zip_code").val();
    var email=$("#email_address").val();

    var customer_internal_reference_no=$("#customer_internal_reference_no").val();
    var order_note=$("#order_note").val();

    var html_string='  <input type="hidden" name="billing_first_name" class="billing_first_name" value="'+billing_first_name+'">'
                    +' <input type="hidden" name="billing_last_name" class="billing_last_name" value="'+billing_last_name+'">'
                    +' <input type="hidden" name="billing_address" class="billing_address" value="'+billing_address+'">'
                    +' <input type="hidden" name="billing_country" class="billing_country" value="'+billing_country+'">'
                    +' <input type="hidden" name="billing_state" class="billing_state" value="'+billing_state+'">'
                    +' <input type="hidden" name="billing_city" class="billing_city" value="'+billing_city+'">'
                    +' <input type="hidden" name="billing_zip_code" class="billing_zip_code" value="'+billing_zip_code+'">'
                    +' <input type="hidden" name="billing_phone_number" class="billing_phone_number" value="'+billing_phone_number+'">'
                    +' <input type="hidden" name="billing_email" class="billing_email" value="'+billing_email+'">'
                    +' <input type="hidden" name="customer_internal_reference_no"  value="'+customer_internal_reference_no+'">'
                    +' <input type="hidden" name="order_note"  value="'+order_note+'">';
         
         html_string+=' <input type="hidden" name="first_name"  value="'+first_name+'">'
                     +' <input type="hidden" name="last_name"  value="'+last_name+'">'             
                     +' <input type="hidden" name="address"  value="'+address+'">'             
                     +' <input type="hidden" name="country"  value="'+country+'">'             
                     +' <input type="hidden" name="state"  value="'+state+'">'             
                     +' <input type="hidden" name="city"  value="'+city+'">'             
                     +' <input type="hidden" name="phone_number"  value="'+phone_number+'">'             
                     +' <input type="hidden" name="zip_code"  value="'+zip_code+'">'             
                     +' <input type="hidden" name="email"  value="'+email+'">';                      

    $("#fill_billing_details_fields").html(html_string);                
    $('#place_order_button').prop("disabled",true);


      $.ajax({

        url:full_path+'charge-existing-card-custom-badge',
        dataType:'json',
        method:'post',
        data:$("#existing_authorize_credit_card_custom_badge").serialize(),
        beforeSend:function(){
          // swal({
          //   title: "Please wait!",
          //   closeOnClickOutside: false,
          //   showConfirmButton:false  
          //    });
          $('#authorize_waiting_modal').modal({
            backdrop: 'static',
            keyboard: false
          });
          
          $("#authorize_waiting_modal").modal('show');


        },
        success:function(data){
          $("#authorize_waiting_modal").modal('hide');
          if(data.error == true && data.error_type==1)
          { 
              
            var error_code=data.error_code;
            var error_message=data.error_message;

            var response_string="Customer profile not charged successfully\n"+"Response: "+error_code+" "+error_message;
             swal({ 
              title: "Error!",
              text: response_string,
              type: "error",
              closeOnClickOutside: false
              },
              function(){
              // window.location.href = full_path+'shop';
              window.location.reload();
            });                  

            
          }
          else if(data.error == true && data.error_type==2){
            var response_string=data.error_message;

            swal({ 
              title: "Error!",
              text: response_string,
              type: "error",
              closeOnClickOutside: false
              },
              function(){
              // window.location.href = full_path+'shop';
              window.location.reload();
            });

          }

          else
          {
            swal({ 
            title: "Success!",
            text: 'Order Placed Successfully',
            type: "success",
            closeOnClickOutside: false
            },
            function(){
            // window.location.href = full_path+'shop';
            // window.location.href = full_path+'orders/pending-design';
            window.location.href = full_path+'order-thankyou-page';
            });
          }

        },
        error:function(){
          alert("Error");

        }


      });
        


}); //Pay from existing card (custom badge)

  // Checkout Payment Type Start
  $('input[name=payment_type]').on('click',function(){
   $(".payment_type_id").val($(this).val());
   var package_id = $(this).data("package_id");
   var platform_fee = parseFloat($(this).data("platform_fee"));
   var deposit_platform_fee = $('.deposit_platform_fee').data("deposit_platform_fee");
   var final_total = $('.final_total').data("final_total");

   var deposit_platform_fee = parseFloat(deposit_platform_fee);
   var final_total = parseFloat(final_total);
   
   
   //Credit Card 
   if($(this).val() ==1){
      $("#credit_card_payment_div").show();
      $("#wire_payment_div").hide();
      $("#check_payment_div").hide();
      $("#paypal_payment_div").hide();
      $("#stripe_payment_div").hide();
   }

   //Wire
   else if($(this).val() ==2){
      $("#credit_card_payment_div").hide();
      $("#wire_payment_div").show();
      $("#check_payment_div").hide();
      $("#paypal_payment_div").hide();
      $("#stripe_payment_div").hide();
   }

   //Check
   else if($(this).val() ==3){
      $("#credit_card_payment_div").hide();
      $("#wire_payment_div").hide();
      $("#check_payment_div").show();
      $("#paypal_payment_div").hide();
      $("#stripe_payment_div").hide();
   }

   //PayPal
   else if($(this).val() ==4){
      $("#credit_card_payment_div").hide();
      $("#wire_payment_div").hide();
      $("#check_payment_div").hide();
      $("#paypal_payment_div").show();
      $("#stripe_payment_div").hide();

      $(".deposit_platform_fee").text((deposit_platform_fee+platform_fee).toFixed(2));
      $(".final_total").text((final_total+platform_fee).toFixed(2));

      $("#place_order_button").val('Place Order');
      $("#place_order_button").css( "background-color", "blue");
      $("#checkout-btn").show();

   }

   //Stripe
   else if($(this).val() ==5){
      $("#credit_card_payment_div").hide();
      $("#wire_payment_div").hide();
      $("#check_payment_div").hide();
      $("#paypal_payment_div").hide();
      $("#stripe_payment_div").show();
      
      $(".deposit_platform_fee").text((deposit_platform_fee+platform_fee).toFixed(2));
      $(".final_total").text((final_total+platform_fee).toFixed(2));

      $("#place_order_button").css( "background-color", "#1a449a");
      $("#place_order_button").val('Purchase Now');

      //$("#checkout-btn-paypal").hide();
      $("#checkout-btn").show();
   }

});
  // Checkout Payment Type Ended

    // Checkout Payment Type Start
  $('input[name=product_price_type]').on('click',function(){
   //$(".payment_type_id").val($(this).val());

   var id = $(this).data('id');
   

   //For Sale 
   if($(this).val() =="for_sale"){
      $("#set_darts_price_"+id).show();
   }

   //Not For Sale
   else if($(this).val() =="not_for_sale"){
      $("#set_darts_price_"+id).hide();
   }

});
  // Checkout Payment Type Ended

  $("#address").on("focusout",function(){

  var shipping_address= $(this).val();
  $.ajax({
    method:"get",
    dataType:"json",
    url:full_path+"get-shipping-detials-against-address",
    data:{shipping_address:shipping_address},
    beforeSend:function(){
      $('#waiting_modal').modal({
            backdrop: 'static',
            keyboard: false
          });
          
      $("#waiting_modal").modal('show');
    },
    success:function(data){
    if(data.address_matched_error == false)
    {
            $("#billing_checkbox").prop("checked",false);
            $("#user_shipping_info").val("");

            $("#waiting_modal").modal('hide');
            $("#first_name").val(data.shipping_detail.first_name);
            $("#last_name").val(data.shipping_detail.last_name);
            $("#address").val(data.shipping_detail.address);
            
            $("#zip_code").val(data.shipping_detail.zip);
            $("#phone_number").val(data.shipping_detail.phone);
            $("#email_address").val(data.shipping_detail.email);


            // $("#shipping_id").val(data.shipping_detail.id);
            var html_string = '<div class="col-sm-4 col-xs-12 form-group highlight_select">'
                              +'<label>State </label>'
                              +'<select class="selectpicker form-control required" name="state" data-live-search="true"  title="Choose State" id="state" data-selector_type="select">'; 
            for(var i=0;i<data.states.length;i++){

              if(data.states[i].id == data.shipping_detail.state_id){
                var ship_state_select="selected";
              }
              else{
                var ship_state_select="";

              }
              html_string+=' <option value="'+data.states[i].id+'" '+ship_state_select+'>'+data.states[i].name+' </option>';

            }
            html_string+=' </select> </div>';

            
            html_string+= ' <span id="shipping_details_city_div"> <div class="col-sm-4 col-xs-12 form-group highlight_select">'
                        +' <label>City </label>'
                        +' <select class="selectpicker form-control required" name="city" data-live-search="true"  title="Choose City" id="city" data-selector_type="select">'; 
            for(var i=0;i<data.cities.length;i++){

              if(data.cities[i].id == data.shipping_detail.city_id){
                var ship_city_select="selected";
              }
              else{
                var ship_city_select="";

              }
              html_string+=' <option value="'+data.cities[i].id+'" '+ship_city_select+'>'+data.cities[i].name+' </option>';

            }
            html_string+=' </select> </div> </span>';   

            $("#fill_state_cities_data").html(html_string);
           
            $('.selectpicker').selectpicker('refresh');


            // New Code Started
            // Code related to shipping cost and sub totals

            $("#pay_from_existing_authorize_card").removeAttr('disabled','true');
            if(data.final_array.get_total_values.shipping_cost == null){

            $("#shipping_amount_td").addClass('give_shipping_error'); 
            $("#shipping_amount_td").html("Shipping Cost not defined");
            $("#place_order_button").attr('disabled','true');
            $("#pay_from_existing_authorize_card").attr('disabled','true');
            $(".amount").val("");

            }
            else
            {
              
              $("#shipping_amount_td").removeClass('give_shipping_error'); 

              

            
            $("#shipping_amount_td").html("$"+data.final_array.get_total_values.shipping_cost);
            $("#place_order_button").removeAttr('disabled','true');
            $(".amount").val(data.final_array.get_total_values.final_total);

            }
            $("#sub_total_td").html(data.final_array.get_total_values.total_sub_total);
            $("#discounted_total_td").html(data.final_array.get_total_values.total_discounted_total);
            $("#amount_td").html(data.final_array.get_total_values.final_total);
            $(".shipping_cost").val(data.final_array.get_total_values.shipping_cost);
            $(".state_tax").val(data.final_array.get_total_values.state_tax);
            $(".sub_total").val(data.final_array.get_total_values.total_sub_total);
            $(".discounted_total").val(data.final_array.get_total_values.total_discounted_total);


            //code related to shipping cost and sub totals ended
            // New Code Ended

      }
      else
      {
        $("#waiting_modal").modal('hide');
      }
    },
    error:function(){
      alert("error");
    }


  });

});

  $(document).on("change","#state",function(){

var country_id=231;
var state_id=$(this).val();
// var city_id=$("#city").val();
// var address=$("#address").val();


$.ajax({

  method:"get",
  dataType:"json",
  url:full_path+"get-all-details-on-state-change",
  data:{country_id:country_id,state_id:state_id},
  beforeSend:function(){
  
    $('#waiting_modal').modal({
          backdrop: 'static',
          keyboard: false
        });
        
    $("#waiting_modal").modal('show');
  },
  success:function(data){
   
    $("#waiting_modal").modal("hide");
    if(data.error == false){

      var html_string='<div class="col-sm-4 col-xs-12 form-group highlight_select"> <label>City</label>';
      html_string+=' <select class="selectpicker form-control required" name="city" data-live-search="true"  title="Choose City" id="city" data-selector_type="select">';
      
      for(var i=0;i<data.get_cities_for_shipping_state.length;i++){
        html_string+="<option value='"+data.get_cities_for_shipping_state[i]['id']+"'>"+data.get_cities_for_shipping_state[i]['name']+"</option>";

      }

      html_string+=" </select></div>";
        
         
      $("#shipping_details_city_div").html(html_string); 
      $('.selectpicker').selectpicker('refresh');


      // New Code Started
      //code related to shipping cost and sub totals
      $("#pay_from_existing_authorize_card").removeAttr('disabled','true');
      if(data.final_array.get_total_values.shipping_cost == null){

      $("#shipping_amount_td").addClass('give_shipping_error'); 
      $("#shipping_amount_td").html("Shipping Cost not defined");
      $("#place_order_button").attr('disabled','true');
      $("#pay_from_existing_authorize_card").attr('disabled','true');
      $(".amount").val("");

      }
      else
      {
        
      $("#shipping_amount_td").removeClass('give_shipping_error'); 
      $("#shipping_amount_td").html("$"+data.final_array.get_total_values.shipping_cost);
      $("#place_order_button").removeAttr('disabled','true');
      $(".amount").val(data.final_array.get_total_values.final_total);

      }

      if(data.final_array.get_total_values.state_tax == 0.00){

      $(".state_tax_tr").css('display' , 'none'); 
      $("#state_tax_td").html("State tax not defined");


      }
      else
      {
        
      $(".state_tax_tr").css('display' , 'block'); 
      $("#state_tax_td").html("$"+data.final_array.get_total_values.state_tax);
    

      }

      $("#sub_total_td").html(data.final_array.get_total_values.total_sub_total);
      $("#discounted_total_td").html(data.final_array.get_total_values.total_discounted_total);
      $("#amount_td").html(data.final_array.get_total_values.final_total);
      $(".shipping_cost").val(data.final_array.get_total_values.shipping_cost);
      $(".state_tax").val(data.final_array.get_total_values.state_tax);
      $(".sub_total").val(data.final_array.get_total_values.total_sub_total);
      $(".discounted_total").val(data.final_array.get_total_values.total_discounted_total);


      //code related to shipping cost and sub totals ended
      // New Code Ended

    } //if(data.error)

  },
  error:function(){
    alert("Error");
  }

}); //ajax



});

  $("#custom_badge_address").on("focusout",function(){

  var shipping_address= $(this).val();
  var custom_badge_id=$("#custom_badge_id").val();
  $.ajax({
    method:"get",
    dataType:"json",
    url:full_path+"get-shipping-detials-against-address-custom-badge",
    data:{shipping_address:shipping_address,custom_badge_id:custom_badge_id},
    beforeSend:function(){
      $('#waiting_modal').modal({
            backdrop: 'static',
            keyboard: false
          });
          
      $("#waiting_modal").modal('show');
    },
    success:function(data){
    if(data.address_matched_error == false)
    {
            $("#billing_checkbox").prop("checked",false);
            $("#user_shipping_info").val("");

            $("#waiting_modal").modal('hide');
            $("#first_name").val(data.shipping_detail.first_name);
            $("#last_name").val(data.shipping_detail.last_name);
            $("#custom_badge_address").val(data.shipping_detail.address);
            
            $("#zip_code").val(data.shipping_detail.zip);
            $("#phone_number").val(data.shipping_detail.phone);
            $("#email_address").val(data.shipping_detail.email);


            // $("#shipping_id").val(data.shipping_detail.id);
            var html_string = '<div class="col-sm-4 col-xs-12 form-group highlight_select">'
                              +'<label>State </label>'
                              +'<select class="selectpicker form-control required" name="state" data-live-search="true"  title="Choose State" id="state" data-selector_type="select">'; 
            for(var i=0;i<data.states.length;i++){

              if(data.states[i].id == data.shipping_detail.state_id){
                var ship_state_select="selected";
              }
              else{
                var ship_state_select="";

              }
              html_string+=' <option value="'+data.states[i].id+'" '+ship_state_select+'>'+data.states[i].name+' </option>';

            }
            html_string+=' </select> </div>';

            
            html_string+= ' <span id="shipping_details_city_div"> <div class="col-sm-4 col-xs-12 form-group highlight_select">'
                        +' <label>City </label>'
                        +' <select class="selectpicker form-control required" name="city" data-live-search="true"  title="Choose City" id="city" data-selector_type="select">'; 
            for(var i=0;i<data.cities.length;i++){

              if(data.cities[i].id == data.shipping_detail.city_id){
                var ship_city_select="selected";
              }
              else{
                var ship_city_select="";

              }
              html_string+=' <option value="'+data.cities[i].id+'" '+ship_city_select+'>'+data.cities[i].name+' </option>';

            }
            html_string+=' </select> </div> </span>';   

            $("#fill_state_cities_data").html(html_string);
           
            $('.selectpicker').selectpicker('refresh');



            //code related to shipping cost and sub totals
            $("#pay_from_existing_authorize_card_custom_badge").removeAttr('disabled','true');
            if(data.final_array.get_total_values.shipping_cost == null){

            $("#shipping_amount_td").addClass('give_shipping_error'); 
            $("#shipping_amount_td").html("Shipping Cost not defined");
            $("#place_order_button").attr('disabled','true');
            $("#pay_from_existing_authorize_card_custom_badge").attr('disabled','true');
            $(".amount").val("");

            }
            else
            {
              
            $("#shipping_amount_td").removeClass('give_shipping_error'); 

            $("#shipping_amount_td").html(data.final_array.get_total_values.shipping_cost);
            $("#place_order_button").removeAttr('disabled','true');
            $(".amount").val(data.final_array.get_total_values.final_total);

            }
            $("#sub_total_td").html(data.final_array.get_total_values.sub_total);
            // $("#discounted_total_td").html(data.final_array.get_total_values.total_discounted_total);
            $("#amount_td").html(data.final_array.get_total_values.final_total);
            $(".shipping_cost").val(data.final_array.get_total_values.shipping_cost);
            $(".state_tax").val(data.final_array.get_total_values.state_tax);
            $(".sub_total").val(data.final_array.get_total_values.sub_total);
            // $(".discounted_total").val(data.get_total_values.total_discounted_total);


            //code related to shipping cost and sub totals ended

      }
      else
      {
        $("#waiting_modal").modal('hide');
      }
    },
    error:function(){
      alert("error");
    }


  });

});

  //$('.badges-sizes ul li:first').click();
  var color = $('.badges-color ul li:first span').attr('data-hex');
  $('.selected-color').css('background-color', color)

  var color = $('.font-color ul li:first span').attr('data-hex');
  $('#firstline, #secondline').css('color', color)

  $(".buy_darts_for_sale").on('click',function(e){

     var order_detail_id=$(this).data('order_detail_id');
     
    swal({
      title: "Are you sure?",
      text: "Do you want to buy these darts?",
      type: "info",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Yes!",
      closeOnConfirm: false
    },      
    function(){
        $.ajax({
                url:full_path+"confirm-buy-darts",
                method:"get",
                dataType:"json",  
                data:{order_detail_id:order_detail_id},
                  success:function(data){
                    if(data.error == false){
                      swal({ 
                      title: "Success!",
                      text: "Order placed. Please continue to PayPal.",
                      type: "success" 
                      },
                      function(){
                        window.location.href=data.redirect;//full_path+"borrowed-darts";
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
    }); //swal
});

});