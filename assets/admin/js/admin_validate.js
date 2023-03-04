//var full_path="https://badge.aladdinapps.com/order/";
//var full_path="http://localhost/badges/";
var full_path = $('#site_url').val()+'/';

$(document).ready(function(){

    $("#description").jqte();
    $("#e_description").jqte();
    $("#wire_check_detail").jqte();
    $("#wire_check_detail_for_pending_payment").jqte();

    $('#myTable').DataTable({

    	 "order": [],
        responsive: true
    });

    $("#customer_table").dataTable({

        "order": [],
         responsive: true
    });

    $('.a_badge_types').selectpicker();
    $('.e_badge_types').selectpicker();

    $(".edit_bade_size").on('click',function(){

     var id=$(this).data('badge_size_id');
     
     $.ajax({

     	url:full_path+"admin/badge-size/"+id+"/edit",
     	method:"get",
     	dataType:"json",
     	data:{id:id},
     	success:function(data){
     		// alert(data.result);

     		$("#badge_size_id").val(id);
     		$("#update_size_from").val(data.result.size_from);
     		$("#update_size_to").val(data.result.size_to);
     		$("#update_weight").val(data.result.weight);
     		$("#update_price").val(data.result.price);
        $('.e_badge_types').selectpicker('val' , data.badge_size_types);


     		$("#edit_bade_size_modal").modal("show");
     	},
     	error:function(){

     		alert("Error");

     	}


     });	


    });

    $(document).on('click','.edit_product',function(){
        var id=$(this).data('product_id');
        $.ajax({
            url:full_path+"admin/product/"+id+"/edit",
            method:"get",
            dataType:"json",
            data:{id:id},
            success:function(data){
            // alert(data.result);
            $("#product_id").val(id);
            $("#e_title").val(data.product.product_name);
            $("#e_price_type  option[value="+data.product.product_price_type+"]").prop("selected", true);
            $("#e_price").val(data.product.product_price);
            $("#e_weight").val(data.product.product_weight);
            $("#e_weight_range  option[value="+data.product.product_weight_range+"]").prop("selected", true);
            $("#e_user_id  option[value="+data.product.user_id+"]").prop("selected", true);
            $("#e_description").jqteVal(data.product.product_description);

            $("#edit_product_modal").modal("show");
        },
        error:function(){
            alert("Error");
            }
        });  
    });

    $("#edit_product_form").on('submit',function(e){

      e.preventDefault();
      var product_id=$("#product_id").val();
      var formData = new FormData($(this)[0]);
      $.ajax({

        url:full_path+'admin/update-product/'+product_id,
        method:"POST",
        enctype: 'multipart/form-data',
        dataType:"json",
        data: formData,
        processData: false,
        contentType: false,
        success:function(data){
          if(data.error == false)
          {
            swal({ 
                  title: "Success!",
                  text: 'Edited Successfully',
                  type: "success",
                  closeOnClickOutside: false
                  },
                  function(){ 
                  window.location.reload();
                  }); 
          }

        },
        error:function(){

        }

      })


    });

    $(document).on('click','.delete_product',function(){
        var product_id=$(this).data('product_id');
        swal({
          title: "Are you sure?",
          text: "Your will not be able to recover this record once deleted!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(){
            $("#del_product_form"+product_id).submit();
        }); //swal
    });

    $("#edit_card_size_form").on('submit',function(e){

    	e.preventDefault();
    	var badge_size_id=$("#badge_size_id").val();

    	$.ajax({

    		url:full_path+'admin/badge-size/'+badge_size_id,
    		method:"PUT",
    		dataType:"json",
    		data:$("#edit_card_size_form").serialize(),
    		success:function(data){
    			
    			if(data.error == true)
    			{
    			   swal("Card with this size already exists");		
    			}	
    			else
    			{

    			  swal({ 
		            title: "Success!",
		            text: 'Edited Successfully',
		            type: "success",
		            closeOnClickOutside: false
		            },
		            function(){	
		            // $("#edit_bade_size_modal").modal("hide");
		            window.location.reload();
		            });			

    			}


    		},
    		error:function(){

    		}

    	})


    });

    $(".delete_badge_size").on('click',function(e){


    var badge_size_id=$(this).data('badge_size_id');

    swal({
      title: "Are you sure?",
      text: "Your will not be able to recover this record once deleted!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
    $("#del_badge_size_form"+badge_size_id).submit();
     

    }); //swal


});

    // $(".edit_bade_color").on('click',function(){
    $(document).on('click','.edit_bade_color',function(){

         var id=$(this).data('badge_color_id');
         
         $.ajax({

            url:full_path+"admin/badge-color/"+id+"/edit",
            method:"get",
            dataType:"json",
            data:{id:id},
            success:function(data){
                // alert(data.result);

                $("#badge_color_id").val(id);
                $("#edit_title").val(data.result.title);
                $("#edit_hexa_value").val(data.result.hexa_value);
                $("#edit_cmyk").val(data.result.cmyk);
                $("#edit_price").val(data.result.price);

                $("#edit_bade_color_modal").modal("show");
            },
            error:function(){

                alert("Error");

            }


         });    


    });
    
    $("#edit_card_color_form").on('submit',function(e){

            e.preventDefault();
            var badge_color_id=$("#badge_color_id").val();

            $.ajax({

                url:full_path+'admin/badge-color/'+badge_color_id,
                method:"PUT",
                dataType:"json",
                data:$("#edit_card_color_form").serialize(),
                success:function(data){
                    
                    if(data.error == true)
                    {
                       swal("Card with this color already exists");      
                    }   
                    else
                    {

                      swal({ 
                        title: "Success!",
                        text: 'Edited Successfully',
                        type: "success",
                        closeOnClickOutside: false
                        },
                        function(){ 
                        // $("#edit_bade_size_modal").modal("hide");
                        window.location.reload();
                        });         

                    }


                },
                error:function(){
                    alert("error");
                }

            })

    });
    $(".delete_badge_color").on('click',function(e){


        var badge_color_id=$(this).data('badge_color_id');

        swal({
          title: "Are you sure?",
          text: "Your will not be able to recover this record once deleted!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(){
          $("#del_badge_color_form"+badge_color_id).submit();
         }); //swal




    });
    $(document).on('click','.edit_badge_font',function(){

         var id=$(this).data('badge_font_id');
         
         $.ajax({

            url:full_path+"admin/badge-font/"+id+"/edit",
            method:"get",
            dataType:"json",
            data:{id:id},
            success:function(data){
                // alert(data.result);
                $("#badge_font_id").val(id);
                $("#edit_title").val(data.result.title);
                $("#edit_font_family_name").val(data.result.font_family_name);
                $("#edit_price").val(data.result.price);

                $("#edit_badge_font_modal").modal("show");
            },
            error:function(){

                alert("Error");

            }


         });    


    });
    $("#edit_card_font_form").on('submit',function(e){

            e.preventDefault();
            var badge_font_id=$("#badge_font_id").val();

            $.ajax({

                url:full_path+'admin/badge-font/'+badge_font_id,
                method:"PUT",
                dataType:"json",
                data:$("#edit_card_font_form").serialize(),
                success:function(data){
                    
                    if(data.error == true)
                    {
                       swal("Card with this font family already exists");      
                    }   
                    else
                    {

                      swal({ 
                        title: "Success!",
                        text: 'Edited Successfully',
                        type: "success",
                        closeOnClickOutside: false
                        },
                        function(){ 
                        // $("#edit_bade_size_modal").modal("hide");
                        window.location.reload();
                        });         

                    }


                },
                error:function(){
                    alert("error");
                }

            })

    });
    $(".delete_badge_font").on('click',function(e){


        var badge_font_id=$(this).data('badge_font_id');

        swal({
          title: "Are you sure?",
          text: "Your will not be able to recover this record once deleted!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(){
        $("#del_badge_font_form"+badge_font_id).submit();
         

        }); //swal


    });
    $(document).on('click','.edit_badge_line',function(){

         var id=$(this).data('badge_line_id');
         
         $.ajax({

            url:full_path+"admin/badge-line/"+id+"/edit",
            method:"get",
            dataType:"json",
            data:{id:id},
            success:function(data){
                // alert(data.result);

                $("#badge_line_id").val(id);
                
                $("#edit_price").val(data.result.price);

                $("#edit_badge_line_modal").modal("show");
            },
            error:function(){

                alert("Error");

            }


         });    


    });
    $("#edit_card_line_form").on('submit',function(e){

            e.preventDefault();
            var badge_line_id=$("#badge_line_id").val();

            $.ajax({

                url:full_path+'admin/badge-line/'+badge_line_id,
                method:"PUT",
                dataType:"json",
                data:$("#edit_card_line_form").serialize(),
                success:function(data){
                    
                    if(data.error == true)
                    {
                       swal("Card with this line already exists");      
                    }   
                    else
                    {

                      swal({ 
                        title: "Success!",
                        text: 'Edited Successfully',
                        type: "success",
                        closeOnClickOutside: false
                        },
                        function(){ 
                        // $("#edit_bade_size_modal").modal("hide");
                        window.location.reload();
                        });         

                    }


                },
                error:function(){
                    alert("error");
                }

            })

    });
    $(".delete_badge_line").on('click',function(e){


        var badge_line_id=$(this).data('badge_line_id');

        swal({
          title: "Are you sure?",
          text: "Your will not be able to recover this record once deleted!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(){
        $("#del_badge_line_form"+badge_line_id).submit();
         

        }); //swal


    });
    $(document).on('click','.edit_badge_discount',function(){

         var id=$(this).data('badge_discount_id');
         
         $.ajax({

            url:full_path+"admin/badge-discount/"+id+"/edit",
            method:"get",
            dataType:"json",
            data:{id:id},
            success:function(data){
               

                $("#badge_discount_id").val(id);  

                var html_string='<select class="selectpicker form-control"  name="badge_size_id" data-live-search="true"  title="Choose Badge" required="true"> ';
                for(var i=0;i<data.badge_sizes.length;i++){


                   if(data.badge_discount.badge_size_id == data.badge_sizes[i].id){

                      var give_select_tag="selected";

                   }
                   else{
                      var give_select_tag="";
                   } 


                  html_string+="<option value='"+data.badge_sizes[i].id+"' "+give_select_tag+">"+
                                data.badge_sizes[i].size_from+"x"+data.badge_sizes[i].size_to+
                                "</option>";        

                }

                html_string+=' </select>';
                $("#badge_size_select").html(html_string);
                $('.selectpicker').selectpicker('refresh');
                
                
                $("#edit_quantity_from").val(data.badge_discount.quantity_from);
                $("#edit_quantity_to").val(data.badge_discount.quantity_to);
                $("#edit_discount_percent").val(data.badge_discount.discount_percent);

                $("#edit_badge_discount_modal").modal("show");
            },
            error:function(){

                alert("Error");

            }


         });    


    });
    $(document).on('click','.edit_badge_coupon',function(){

         var id=$(this).data('badge_coupon_id');
         
         $.ajax({

            url:full_path+"admin/badge-coupon/"+id+"/edit",
            method:"get",
            dataType:"json",
            data:{id:id},
            success:function(data){
               

                $("#badge_coupon_id").val(id);  

    /*            var html_string='<select class="selectpicker form-control"  name="badge_size_id" data-live-search="true"  title="Choose Badge" required="true"> ';
                for(var i=0;i<data.badge_sizes.length;i++){
                   if(data.badge_coupon.badge_size_id == data.badge_sizes[i].id){
                      var give_select_tag="selected";
                   }
                   else{
                      var give_select_tag="";
                   }
                  html_string+="<option value='"+data.badge_sizes[i].id+"' "+give_select_tag+">"+
                                data.badge_sizes[i].size_from+"x"+data.badge_sizes[i].size_to+
                                "</option>";
                    }
                html_string+=' </select>';
                $("#badge_size_select").html(html_string);
                $('.selectpicker').selectpicker('refresh');*/
                
                
                $("#edit_coupon_code").val(data.badge_coupon.coupon_code);
                $("#edit_type").val(data.badge_coupon.type);
                $('.selectpicker').selectpicker('refresh');


                $("#edit_discount").val(data.badge_coupon.discount);
                $("#edit_number_to_be_used").val(data.badge_coupon.number_to_be_used);
                $("#edit_expiry_date").val(data.badge_coupon.expiry_date);
                
                $("#edit_badge_coupon_modal").modal("show");
            },
            error:function(){

                alert("Error");

            }


         });    


    });
    $("#edit_card_discount_form").on('submit',function(e){

            e.preventDefault();
            var badge_discount_id=$("#badge_discount_id").val();

            $.ajax({

                url:full_path+'admin/badge-discount/'+badge_discount_id,
                method:"PUT",
                dataType:"json",
                data:$("#edit_card_discount_form").serialize(),
                success:function(data){
                    
                    if(data.error == true)
                    {
                       swal("Card with this record already exists");      
                    }   
                    else
                    {

                      swal({ 
                        title: "Success!",
                        text: 'Edited Successfully',
                        type: "success",
                        closeOnClickOutside: false
                        },
                        function(){ 
                        // $("#edit_bade_size_modal").modal("hide");
                        window.location.reload();
                        });         

                    }


                },
                error:function(){
                    alert("error");
                }

            })

    });
    $("#edit_badge_coupon_modal").on('submit',function(e){
            e.preventDefault();
            var badge_coupon_id=$("#badge_coupon_id").val();
            $.ajax({
                url:full_path+'admin/badge-coupon/'+badge_coupon_id,
                method:"PUT",
                dataType:"json",
                data:$("#edit_card_coupon_form").serialize(),
                success:function(data){
                    if(data.error == true)
                    {
                       swal("Card with this record already exists");      
                    }   
                    else
                    {
                      swal({ 
                        title: "Success!",
                        text: 'Edited Successfully',
                        type: "success",
                        closeOnClickOutside: false
                        },
                        function(){ 
                        // $("#edit_bade_size_modal").modal("hide");
                        window.location.reload();
                        });         
                    }
                },
                error:function(){
                    alert("error");
                }
            })
    });
    $(".delete_badge_discount").on('click',function(e){


        var badge_discount_id=$(this).data('badge_discount_id');

        swal({
          title: "Are you sure?",
          text: "Your will not be able to recover this record once deleted!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(){
        $("#del_badge_discount_form"+badge_discount_id).submit();     

        }); //swal


    });
    $(".delete_badge_coupon").on('click',function(e){


        var badge_coupon_id=$(this).data('badge_coupon_id');

        swal({
          title: "Are you sure?",
          text: "Your will not be able to recover this record once deleted!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(){
        $("#del_badge_coupon_form"+badge_coupon_id).submit();
        }); //swal


    });
    $(document).on('click','.edit_role',function(){

         var id=$(this).data('role_id');
         
         $.ajax({

            url:full_path+"admin/role/"+id+"/edit",
            method:"get",
            dataType:"json",
            data:{id:id},
            success:function(data){
                // alert(data.result);

                $("#role_id").val(id);
                
                $("#edit_title").val(data.result.title);

                $("#edit_role_modal").modal("show");
            },
            error:function(){

                alert("Error");

            }


         });    


    });
    $("#edit_role_form").on('submit',function(e){

            e.preventDefault();
            var role_id=$("#role_id").val();

            $.ajax({

                url:full_path+'admin/role/'+role_id,
                method:"PUT",
                dataType:"json",
                data:$("#edit_role_form").serialize(),
                success:function(data){
                    
                    if(data.error == true)
                    {
                       swal("Failure! Role with this title already exists");      
                    }   
                    else
                    {

                      swal({ 
                        title: "Success!",
                        text: 'Edited Successfully',
                        type: "success",
                        closeOnClickOutside: false
                        },
                        function(){ 
                        // $("#edit_bade_size_modal").modal("hide");
                        window.location.reload();
                        });         

                    }


                },
                error:function(){
                    alert("error");
                }

            })

    });
    $(".delete_role").on('click',function(e){


        var role_id=$(this).data('role_id');

        swal({
          title: "Are you sure?",
          text: "Your will not be able to recover this record once deleted!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(){
        $("#del_role_form"+role_id).submit();
         

        }); //swal


    });
    $("#add_system_user").on('submit',function(e){
      e.preventDefault();

      if(($("#password").val() != $("#confirm_password").val()) || ($("#password").val()==""))
      {
        // swal("Password and Confirm Password not matched");
        $("#password").css('border','1px solid red');
        $("#confirm_password").css('border','1px solid red');
        return false;
      }
      // else
      // {
      //   return true;
      // }

      $.ajax({
        url:full_path+'admin/system-user',
        method:"post",
        dataType:"json",
        data:$("#add_system_user").serialize(),
        beforeSend:function(){

        },
        success:function(data){

          if(data.error ==  true){

            swal("User with this email already exists");
          }
          else
          {
            swal({ 
                        title: "Success!",
                        text: 'System User Added Successfully',
                        type: "success",
                        closeOnClickOutside: false
                        },
                        function(){ 
                        // $("#edit_bade_size_modal").modal("hide");
                        window.location.reload();
                        });    
          }

        },
        error:function(){
          alert("Error");
        }


      }); 


    });
    $(document).on('click','.edit_system_user',function(){

         var id=$(this).data('user_id');
         
         $.ajax({

            url:full_path+"admin/system-user/"+id+"/edit",
            method:"get",
            dataType:"json",
            data:{id:id},
            success:function(data){
               

                $("#user_id").val(id);  

                var html_string='<select class="selectpicker form-control"  name="user_role_id" data-live-search="true"  title="Choose Role" required="true"> ';
                for(var i=0;i<data.user_roles.length;i++){


                   if(data.user.user_role_id == data.user_roles[i].id){

                      var give_select_tag="selected";

                   }
                   else{
                      var give_select_tag="";
                   } 


                  html_string+="<option value='"+data.user_roles[i].id+"' "+give_select_tag+">"+
                                data.user_roles[i].title+"</option>";        

                }

                html_string+=' </select>';
                $("#user_role_select").html(html_string);
                $('.selectpicker').selectpicker('refresh');
                
                
                $("#edit_first_name").val(data.user.first_name);
                $("#edit_last_name").val(data.user.last_name);
                $("#edit_email").val(data.user.email);
                

                $("#edit_system_user_modal").modal("show");
            },
            error:function(){

                alert("Error");

            }


         });    


    });
    $("#edit_system_user_form").on('submit',function(e){

            e.preventDefault();
            var user_id=$("#user_id").val();

            $.ajax({

                url:full_path+'admin/system-user/'+user_id,
                method:"PUT",
                dataType:"json",
                data:$("#edit_system_user_form").serialize(),
                success:function(data){
                    
                    if(data.error == true)
                    {
                       swal("Failure! User with this email already exists");      
                    }   
                    else
                    {

                      swal({ 
                        title: "Success!",
                        text: 'Edited Successfully',
                        type: "success",
                        closeOnClickOutside: false
                        },
                        function(){ 
                        // $("#edit_bade_size_modal").modal("hide");
                        window.location.reload();
                        });         

                    }


                },
                error:function(){
                    alert("error");
                }

            })

    });
    $(".delete_system_user").on('click',function(e){


        var user_id=$(this).data('user_id');

        swal({
          title: "Are you sure?",
          text: "Your will not be able to recover this record once deleted!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(){
        $("#del_system_user"+user_id).submit();
         

        }); //swal


    });
    $(document).on('click', ".show_badge", function(){

      var order_product_id=$(this).data("order_product_id");

      $.ajax({

        method:"get",
        dataType:"json",
        url:full_path+"admin/get-badge-details",
        data:{order_product_id:order_product_id},
        success:function(data){
        
            // console.log(data);
            if(data.order_product['badge_bled_size_id'] == 5)
            {
              var bleed_style = 'width: auto; margin-left:0px; bottom:5px;';
            }
            else if(data.order_product['badge_bled_size_id'] == 6)
            {
              var bleed_style = 'width: 100%; margin-left:-5px; bottom:1px; border-top-left-radius: 0px;border-top-right-radius: 0px;';

            }

            if(data.order_product['badge_type_id'] == 1)
            {
              var selected_img = 'empty_image';

            }
            else if(data.order_product['badge_type_id'] == 2)
            {
              var selected_img = 'transparent_image';

            }
            else if(data.order_product['badge_type_id'] == 3)
            {
              var selected_img = 'empty_image';

            }

            if(data.order_product['badge_size_id'] == 11)
            {
              var bg_height = "min-height:212px";
            }
            else if(data.order_product['badge_size_id'] == 12)
            {
              var bg_height = "min-height:238px";
            }
            else if(data.order_product['badge_size_id'] == 13)
            {
              var bg_height = "min-height:168px";
            }
            else if(data.order_product['badge_size_id'] == 14)
            {
              var bg_height = "min-height:171px";
            }
            else if(data.order_product['badge_size_id'] == 15)
            {
              var bg_height = "min-height:238px";
            }



            console.log(data.badge_type_images);
            


           var html_string=' <figure> <img src="'+full_path+'public/uploads/badge_img/'+data.badge_type_images[selected_img]+'" class="img-responsive selected-img" alt="selected badge">'
                          +'<figcaption class="bg-selected-color" style="position: absolute; z-index: 1; left: 1px; right: 0px; bottom: 1px; border-radius: 5px; padding: 10px 10px; text-align: center; font-weight: 600; background-color:#'+data.badge_bg_full_color+';'+bg_height+';"  ></figcaption>'
                          +'  <figcaption class="selected-color" id="selectedtext" style="background-color:#'+data.order_product.badge_color+';'+bleed_style+'">'
                          +' <div id="firstline" class="firstline" style="font-family:' +data.font_family+'">'
                          +' <span style="font-size: '+data.order_product.firstline_font_size+'px; width: 100%; color:#'+data.order_product.font_color+'">'+data.order_product.enterText+'</span>'
                          +' </div>';

           if(data.order_product.enterText2 !=null){
              html_string+=' <div id="secondline" class="firstline" style="font-family:'+data.font_family+'">'
                          +' <span style="font-size: '+data.order_product.secondline_font_size+'px; width: 100%; color:#'+data.order_product.font_color+'">'+data.order_product.enterText2+'</span>'
                          +' </div>';

           }

           html_string+=' </figcaption></figure>'    
                      +' <div class="text-center"> <strong>Size '+data.order_product.size_from+' x '+data.order_product.size_to+' </strong> </div>';            

           if(data.order_product.enterText2 != null){
            var double_line_text=data.order_product.enterText2;
           }
           else{
            var double_line_text="None";
           }
           if(data.order_product.side == 'single_side'){
            var get_side="Single Sided";
           }
           else{
            var get_side="Double Sided";
           }
                      
           html_string+=' <table class="table" style="width: 51%;margin: 20px auto 0px;"> <tbody>'
                       +' <tr><th>Size</th><td>'+data.order_product.size_from+'x'+data.order_product.size_to+'</td>'
                       +' </tr>'
                       +' <tr> <th>Bleed Color</th> <td><div style="background-color: #'+data.order_product.badge_color+'; width: 20px; height: 20px; display: inline-block; vertical-align: middle; margin-right: 5px;"></div><span>'+data.badge_color_title+' (#'+data.order_product.badge_color+')</span></td>'
                       +' </tr>'
                       +' <tr><th>Single Line </th><td>'+data.order_product.enterText+'</td>'
                       +' </tr>';
                       
            if(double_line_text != "None")
            {
              html_string+=' <tr><th>Double Line </th><td>'+double_line_text+'</td>';
            }

            html_string+=' </tr>' 
                       +' <tr><th>Font Family Name</th><td>'+data.order_product.font_family_name+'</td>'
                       +' </tr>' 
                       +' <tr><th>Font Color</th><td><div style="background-color: #'+data.order_product.font_color+';width: 20px; height: 20px; display: inline-block; vertical-align: middle; margin-right: 5px;"></div><span>'+data.badge_font_color_title+' (#'+data.order_product.font_color+')</span></td>'
                       +' </tr>'
                       +' <tr><th>Side</th><td>'+get_side+'</td>'
                       +' </tr>' 
                       +' <tr><th>Badge Bleed Size</th><td>'+data.badge_bleed.title+'</td>'
                       +' </tr>'
                       +' <tr><th>Badge Type</th><td>'+data.badge_type.title+'</td>'
                       +' </tr>'
                       +' <tr> <th>Badge Background Color</th> <td><div style="background-color: #'+data.badge_bg_full_color+'; width: 20px; height: 20px; display: inline-block; vertical-align: middle; margin-right: 5px;"></div><span>'+data.badge_bg_full_color_title+' (#'+data.badge_bg_full_color+')</span></td>'
                       +' </tr>'
                       +' <tr><th>Quantity</th><td>'+data.order_product.total_badge_qty+'</td>'
                       +' </tr>' 
           html_string+=' </tbody></table>';             
           // alert(html_string);
           // return false;
           $("#badge_title").html('Custom Made Badge');
           $("#html_badge").html(html_string);
           $("#show_badge_modal").modal("show");
        },
        error:function(){
          alert("Error");
        }

      });

    });
    $(document).on('click','.show_product_badges',function(){

      var order_product_id=$(this).data("order_product_id");

      $.ajax({

        method:"get",
        dataType:"json",
        url:full_path+"admin/get-badge-details",
        data:{order_product_id:order_product_id},
        success:function(data){
                console.log(data.order_product)
                console.log(data.order_product_prod)
           var width = 50*data.order_product.size_from;
           var height = 60*data.order_product.size_to;

           var html_string=' <figure> <img width="'+width+'px" height="'+height+'px"  src="'+full_path+'public/uploads/badge_img/'+data.order_product_prod.image+'" class="img-responsive selected-img" alt="selected badge">';


           

           html_string+='</figure>'
                  +' <div class="text-center"> <strong>Size '+data.order_product.size_from+' * '+data.order_product.size_to+' </strong> </div>';        

                  
           html_string+=' <table class="table" style="width: 51%;margin: 20px auto 0px;"> <tbody>'
                       +' <tr><th>Title</th><td>'+data.order_product_prod.title+'</td>'
                       +' </tr>'
                       +' <tr><th>Size</th><td>'+data.order_product.size_from+'*'+data.order_product.size_to+'</td>'
                       +' </tr>'
                      
                       +' <tr><th>Quantity</th><td>'+data.order_product.total_badge_qty+'</td>'
                       +' </tr>' 
           html_string+=' </tbody></table>';                 

           // alert(html_string);
           // return false;
           $("#badge_title").html('Product');
           $("#html_badge").html(html_string);
           $("#show_badge_modal").modal("show");
        },
        error:function(){
          alert("Error");
        }

      });

    });
    $(".del_courear").on('click',function(){

        var courear_id=$(this).data('courear_id');

        swal({
          title: "Are you sure?",
          text: "Your will not be able to recover this record once deleted!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(){
        $("#del_courear_form"+courear_id).submit();
         

        }); //swal


        }); //.del_product
    $(".del_content").on('click',function(){

        var content_id=$(this).data('content_id');

        swal({
          title: "Are you sure?",
          text: "Your will not be able to recover this record once deleted!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(){
        $("#del_content_form"+content_id).submit();
        }); //swal
        }); //.del_content
    $('input[name=designer_note_confirmation]').on('change',function(){
        var note_confirmation=$(this).val();
        if(note_confirmation =="yes"){
          $("#designer_note_div").show();
        }
        else
        {
          $("#designer_note_div").hide();

        }



      }); 
    $('input[name=shipper_note_confirmation]').on('change',function(){
        
        var note_confirmation=$(this).val();
        if(note_confirmation =="yes"){

          $("#shipper_note_confirmation").show();

        }
        else
        {
          $("#shipper_note_confirmation").hide();

        }



      });
    $('input[name=shipper_note_confirmation_wire_check_with_payment]').on('change',function(){
        
        var note_confirmation=$(this).val();
        if(note_confirmation =="yes"){

          $("#shipper_note_confirmation_wire_check_with_payment").show();

        }
        else
        {
          $("#shipper_note_confirmation_wire_check_with_payment").hide();

        }



      });
    $('input[name=shipper_note_confirmation_wire_check_with_out_payment]').on('change',function(){
        
        var note_confirmation=$(this).val();
        if(note_confirmation =="yes"){

          $("#shipper_note_confirmation_wire_check_with_out_payment").show();

        }
        else
        {
          $("#shipper_note_confirmation_wire_check_with_out_payment").hide();

        }



      });
    $('input[name=shipper_note_confirmation_wire_check_whose_payment_is_done]').on('change',function(){
        
        var note_confirmation=$(this).val();
        if(note_confirmation =="yes"){

          $("#shipper_note_confirmation_wire_check_whose_payment_is_done").show();

        }
        else
        {
          $("#shipper_note_confirmation_wire_check_whose_payment_is_done").hide();

        }



      });
    $(".add_more_details").on('click',function(){

      $(".remove_more_details").show();
      // alert("Clicked");

      // var counter=parseInt($("#women_of_month_counter").val());
      var counter=parseInt($("#weight_price_counter").val());
      
      var new_counter=counter+1;
      $("#weight_price_counter").val(new_counter);


      // women_of_month_class
      var new_element=$(".weight_price_div").eq(0).clone();
      // alert(new_element);
       var num=$(".weight_price_div").length;
       // alert(num);  
        var new_num=num+1; 
       
          
        new_element.find('input').each(function(i){
             $(this).attr('name',$(this).attr('name')+new_num);
             
          });

        // new_element.find('select').each(function(i){
        //      $(this).attr('name',$(this).attr('name')+new_num);
             
        //   });

         $('.weight_price_div').last().after(new_element);
         $('.weight_price_div').last().find('input').val('');
         // $('.weight_price_div').last().find('select').prop('selectedIndex',0);

    });
    $(".remove_more_details").on('click',function(){

      var counter=parseInt($("#weight_price_counter").val());
      
      var new_counter=counter-1;

      $("#weight_price_counter").val(new_counter);

      var new_element=$(".weight_price_div").eq(0).clone();
        
      $('.weight_price_div').last().remove();
          
       

    });
    //Shipping-Management (state select list)  
    $(document).on('change',"#ship_management_country_select",function(){
      var country_id=$(this).val();
      
      $.ajax({

        url:full_path+"filter-state",
        method:"get",
        dataType:"json",  
        data:{country_id:country_id},
        success:function(data){

          var html_string='<div class="form-group"> <label for="state" class="control-label">State</label> <div class="col-xs-12">';
           html_string+=' <select class="selectpicker" id="ship_management_state_select"  data-live-search="true" multiple title="Choose State"  name="ship_management_state_select[]">';
          for(var i=0;i<data.length;i++){

            html_string+="<option value='"+data[i]['id']+"'>"+data[i]['name']+"</option>";



          }
          html_string+=" </select></div></div>";
            
           
           $("#ship_management_state_div").html(html_string); 
         
           $('.selectpicker').selectpicker('refresh');
            
        },
        error:function(){

          alert('Error');
        }

      });


    });
    // $(".shipping_management_edit").on('click',function(){
    $("#myTable tbody").on('click','.shipping_management_edit',function(){  

      $("#shipping_management_modal").modal('show');
       // return false; 
      var id=$(this).data("id");
      

      $.ajax({

        url:full_path+'admin/get-weight-price',
        method:'GET',
        dataType:'json',
        data:{id:id},
        success:function(data){

          // alert(data.counter);
          // alert(data.details);
          $("#weight_price_counter_modal").val(data.counter);
          $("#shipping_country_states_id").val(data.shipping_country_states_id);
          var html_string="";
          for(var i=0;i<data.counter;i++){

            // console.log(data.details[i].amount)+"<br />";
          if(i == 0)
          {
            html_string+='<div class="weight_price_div_modal"> <div class="col-xs-12">';
            html_string+=' <input class="form-control" placeholder="weight from" type="text" name="weight_from" value="'+data.details[i].weight_from+'">';
            html_string+=' <input class="form-control" placeholder="weight to" type="text" name="weight_to" value="'+data.details[i].weight_to+'">';
            html_string+=' <input class="form-control" type="text" placeholder="enter amount" name="amount" value="'+data.details[i].amount+'">'; 

            html_string+=' </div> <div class="ln_solid"></div> </div>';
          }
          else{
            html_string+='<div class="weight_price_div_modal"> <div class="col-xs-12">';
            html_string+=' <input class="form-control" placeholder="weight from" type="text" name="weight_from'+(i+1)+'" value="'+data.details[i].weight_from+'" >';
            html_string+=' <input class="form-control" placeholder="weight to" type="text" name="weight_to'+(i+1)+'" value="'+data.details[i].weight_to+'" >';
            html_string+=' <input class="form-control" type="text" placeholder="enter amount" name="amount'+(i+1)+'" value="'+data.details[i].amount+'" >'; 

            html_string+=' </div> <div class="ln_solid"></div> </div>';
          } 

          }
            
          $(".show_html_string").html(html_string);  
          return false;


        },
        error:function(){
          alert("Error");
        }


      });  

      // $("#shipping_management_modal").modal('show');




    });
    //Modal
    $(".add_more_details_modal").on('click',function(){

      $(".remove_more_details_modal").show();
      // alert("Clicked");

      // var counter=parseInt($("#women_of_month_counter").val());
      var counter=parseInt($("#weight_price_counter_modal").val());
      
      var new_counter=counter+1;
      $("#weight_price_counter_modal").val(new_counter);


      // women_of_month_class
      var new_element=$(".weight_price_div_modal").eq(0).clone();
      // alert(new_element);
       var num=$(".weight_price_div_modal").length;
       // alert(num);  
        var new_num=num+1; 
       
          
        new_element.find('input').each(function(i){
             $(this).attr('name',$(this).attr('name')+new_num);
             
          });

        // new_element.find('select').each(function(i){
        //      $(this).attr('name',$(this).attr('name')+new_num);
             
        //   });

         $('.weight_price_div_modal').last().after(new_element);
         $('.weight_price_div_modal').last().find('input').val('');
         // $('.weight_price_div').last().find('select').prop('selectedIndex',0);

    });
    $(".remove_more_details_modal").on('click',function(){

      var counter=parseInt($("#weight_price_counter_modal").val());
      
      var new_counter=counter-1;

      $("#weight_price_counter_modal").val(new_counter);

      var new_element=$(".weight_price_div_modal").eq(0).clone();
        
      $('.weight_price_div_modal').last().remove();
          
       

    });
    $("#myTable tbody").on('click','.shipping_management_delete',function(){
    var id= $(this).data('id');

    swal({
      title: "Are you sure?",
      text: "Your will not be able to recover this record once deleted!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
    window.location.href = full_path+"admin/shipping-management/"+id+"/delete";
     

    });



    }); //del_payment_category
    $("#myTable").on('click','.del_weight_price',function(){

    var id=$(this).data("id");



    swal({
      title: "Are you sure?",
      text: "Your will not be able to recover this record once deleted!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
    // window.location.href = full_path+"admin/delete-customer/"+customer_id+"/delete/"+page_status;
    // window.location.href=full_path+'delete-cart-item/'+cart_id;

    $("#del_weight_price_form"+id).submit();


    });
    });  //.del_weight_price
    $("#upload_asset").on('click',function(){
    // alert("ok");
      $("#asset_modal").modal("show");

    });
    $(".add_more_asset").on('click',function(){

      $(".remove_more_asset").show();
      // alert("Clicked");



      // var counter=parseInt($("#women_of_month_counter").val());
      var counter=parseInt($("#asset_counter").val());
      
      var new_counter=counter+1;
      $("#asset_counter").val(new_counter);


      // women_of_month_class
      var new_element=$(".asset_clone_div").eq(0).clone();
      // alert(new_element);
       var num=$(".asset_clone_div").length;
       // alert(num);  
        var new_num=num+1; 
       
          
        new_element.find('input').each(function(i){
             $(this).attr('name',$(this).attr('name')+new_num);
             $(this).attr('id',$(this).attr('id')+new_num);
             
          });

        // new_element.find('select').each(function(i){
        //      $(this).attr('name',$(this).attr('name')+new_num);
             
        //   });

         $('.asset_clone_div').last().after(new_element);
         $('.asset_clone_div').last().find('input').val('');
         // $('.weight_price_div').last().find('select').prop('selectedIndex',0);

      });
    $(".remove_more_asset").on('click',function(){

      var counter=parseInt($("#asset_counter").val());
      
      

      var new_counter=counter-1;
      if(new_counter == 1){
        $(".remove_more_asset").hide();
      }

      $("#asset_counter").val(new_counter);

      var new_element=$(".asset_clone_div").eq(0).clone();
        
      $('.asset_clone_div').last().remove();
          
       

    });
    $("#view_asset").on('click',function(){
    // alert("ok");
      var order_detail_id=$(this).data("order_detail_id");
      
      $.ajax({
        url:full_path+"admin/view-order-asset",
        method:"get",
        dataType:"json",
        data:{order_detail_id:order_detail_id},
        success:function(data){
          var loop_counter=data.assets.length;
          var html_string="";  
          if(loop_counter ==0){
            html_string+="<h2 style='color:red;'>No asset found for this order</h2>";
          }
          else
          {
            html_string+=' <table class="table"> <thead><tr>'
                          +'<th>Name</th>'
                          +'<th>Action</th>'
                          +'</tr>'
                          +'</thead>'
                          +'<tbody>';
            for(var i=0;i<loop_counter;i++){
              html_string+='<tr><td>'+data.assets[i].asset_file_name+'</td>'
                          +'<td> <a href="'+full_path+'public/uploads/order_assets/'+data.user_id+'/'+data.assets[i].asset_file+'" download><i class="fa fa-download"></i></a> <a style="cursor:pointer;" class="delete_order_asset" data-order_asset_id="'+data.assets[i].id+'" data-user_id="'+data.user_id+'"><i class="fa fa-trash"></i></a> </td></tr>'; 
            }
              html_string+=' </tbody></table>';              
          }

          $("#asset_data").html(html_string);
          $("#view_asset_modal").modal("show");


        },
        error:function(){
          alert("Error");
        }
      });
      

    });
    $(document).on('click','.delete_order_asset',function(){

      var hide_row=$(this).parent().parent();
      var order_asset_id=$(this).data('order_asset_id');
      var user_id=$(this).data('user_id');
      

        swal({
          title: "Are you sure?",
          text: "Your will not be able to recover this record once deleted!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(){
          // window.location.href = full_path+"admin/delete-order-asset/"+order_asset_id+'/'+user_id;
           $.ajax({
                
                url:full_path+"admin/delete-order-asset",
                method:"get",
                dataType:"json",
                data:{order_asset_id:order_asset_id,user_id:user_id},
                success:function(data){
                  if(data.error==false){
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
        }); //swal


    });
    $("#send_quote_form").on('submit',function(e){

      e.preventDefault();
      var formData = new FormData(this);
               $.ajax({

                method:"post",
                url:full_path+"admin/assign-quote",
                dataType:"json",
                // data:$("#signup_form").serialize(),
                data:formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                  $("#submit_btn").attr('disabled','true');
                  $('#loader_modal').modal({
                   backdrop: 'static',
                   keyboard: false
                 });

                  $("#loader_modal").modal('show');
                },
                success:function(data){
                  $("#submit_btn").removeAttr('disabled','true');
                  $("#loader_modal").modal('hide');

                  if(data.error == true)
                  {
                    swal('Something went wrong');
                  }
                  else
                  {
                    swal({ 
                      title: "Success!",
                      text: 'Quote Sent Successfully',
                      type: "success",
                      closeOnClickOutside: false
                    },
                    function(){ 

                      window.location.href=full_path+"admin/custom-badges/with-quote";
                      // window.location.reload();
                    });    
                        } //else

                      },
                      error:function(){
                        alert("Error");
                      }


                     }); // ajax


    });
    $(".left_chat_menu").on('click',function(){

          var chat_id=$(this).data('chat_id');
          var user_id=$(this).data('user_id');

          $("#issue_resolved").attr('data-chat_id',chat_id);
          // var make_url=full_path+'admin/archive/'+chat_id;
          // $("#issue_resolved").attr('href',make_url);

           $("#chat_id").val(chat_id);
           $("#user_id").val(user_id);

          $.ajax({

            url:full_path+'admin/get-chat-content',
            dataType:'json',
            data:{chat_id:chat_id},
            method:"get",
            success:function(data){
              var html_string="";
              for(var i=0; i<data.result.length;i++)
              {
                  if(data.result[i].from_id ==1)
                  {

                    var user_type="Admin";
                  }
                  else
                  {
                     var user_type=data.result[i].from;
                  }

                  html_string+='<div class="media msg " style="margin-bottom: 5px;"> <a class="pull-left" href="#">';
                  html_string+=' <img class="media-object"  style="width: 32px; height: 32px;" src="'+full_path+'public/uploads/users/default.png'+'"> </a>'; 
                  html_string+=' <div class="media-body"> <small class="pull-right time"><i class="fa fa-clock-o"></i> '+data.result[i].created_at+'</small>';
                  html_string+=' <h5 class="media-heading">'+user_type+' </h5>';
                  html_string+=' <small class="col-lg-10">'+data.result[i].message+' </small> </div></div>';
                


              }
              // alert(html_string);
              $("#show_chat_detail").html(html_string);
              $(".remove_disable").removeAttr('disabled',true); 
              // $("#chat_id").val(data.chat_id);                            

            },
            error:function(){
              alert("Error");
            }

          });


        });
    $("#send-message-to-customer").on('submit',function(e){
            
            e.preventDefault();

            $.ajax({

            url:full_path+'admin/send-message-to-customer-from-chat-box',
            method:'post',
            dataType:'json',
            data:$("#send-message-to-customer").serialize(),
            success:function(data){
              var html_string="";

                  html_string+='<div class="media msg "> <a class="pull-left" href="#">';
                  html_string+=' <img class="media-object"  style="width: 32px; height: 32px;" src="'+full_path+'public/uploads/users/default.png'+'"> </a>'; 
                  html_string+=' <div class="media-body"> <small class="pull-right time"><i class="fa fa-clock-o"></i> '+data.created_at+'</small>';
                  html_string+=' <h5 class="media-heading">'+'Admin'+' </h5>';
                  html_string+=' <small class="col-lg-10">'+data.message_body+' </small> </div></div>';

              $("#message_content").val("");    
              $("#show_chat_detail").append(html_string);

            },
            error:function(){

              alert("Error");

            }

          });  

        });
    $("#issue_resolved").on('click',function(){

         var chat_id = $(this).data("chat_id");

         

         swal({
          title: "Are you sure?",
          text: "Your chat wil move to Archive!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, archive it!",
          closeOnConfirm: false
        },
        function(){
        window.location.href = full_path+"admin/move-chat-to-archive/"+chat_id;
         

        });

        });  
    $("#assign_custom_payment_type_to_customer").on("submit",function(e){
        e.preventDefault();
        
        $.ajax({

          method:"post",
          dataType:"json",
          data:$("#assign_custom_payment_type_to_customer").serialize(),
          url:full_path+"admin/assign-custom-payment-type-to-customer",
          beforeSend:function(){
              $('#loader_modal').modal({
                backdrop: 'static',
                keyboard: false
              });
              
              $("#loader_modal").modal('show');
          },
          success:function(data){
              $("#loader_modal").modal('hide');
                if(data.error == false){
                  swal({ 
                      title: "Success!",
                      text: 'Payment Types Assigned Successfully',
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

        });



      });
    $("#ship_wire_check_order_with_payment_form").on("submit",function(e){
        e.preventDefault();

        $.ajax({

          method:"post",
          url:full_path+"admin/ship-wire-check-order-with-payment",
          dataType:"json",
          data:$("#ship_wire_check_order_with_payment_form").serialize(),
          beforeSend:function(){

          $('#loader_modal').modal({
           backdrop: 'static',
           keyboard: false
           });

          $("#loader_modal").modal('show');
          },
          success:function(data){
            $("#loader_modal").modal('hide');
            if(data.error == false){

              swal({ 
              title: "Success!",
              text: "Order Shipped Successfully",
              type: "success" 
              },
              function(){
              window.location.href=full_path+"admin/orders/shipped";
               
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
    $("#ship_wire_check_order_with_out_payment_form").on("submit",function(e){
        e.preventDefault();

        $.ajax({

          method:"post",
          url:full_path+"admin/ship-wire-check-order-with-out-payment",
          dataType:"json",
          data:$("#ship_wire_check_order_with_out_payment_form").serialize(),
          beforeSend:function(){

          $('#loader_modal').modal({
           backdrop: 'static',
           keyboard: false
           });

          $("#loader_modal").modal('show');
          },
          success:function(data){
            $("#loader_modal").modal('show');

            if(data.error == false){
              swal({ 
              title: "Success!",
              text: "Order Shipped with Pending Payment",
              type: "success" 
              },
              function(){
                window.location.href=full_path+"admin/orders/pending-wire-check-payment";
               
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
    $("#confirm_payment_only_form").on("submit",function(e){
        e.preventDefault();
        $.ajax({
          method:"post",
          url:full_path+"admin/confirm-payment-only",
          dataType:"json",
          data:$("#confirm_payment_only_form").serialize(),
          beforeSend:function(){

          $('#loader_modal').modal({
           backdrop: 'static',
           keyboard: false
           });

          $("#loader_modal").modal('show');
          },
          success:function(data){
            $("#loader_modal").modal('show');

            if(data.error == false){
              swal({ 
              title: "Success!",
              text: "Payment Done without Shipping",
              type: "success" 
              },
              function(){
                window.location.href=full_path+"admin/orders/pending-shipment";
              
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
    $("#ship_wire_check_order_whose_payment_is_done_form").on("submit",function(e){
        e.preventDefault();

        $.ajax({

          method:"post",
          url:full_path+"admin/ship-wire-check-order-whose-payment-is-done",
          dataType:"json",
          data:$("#ship_wire_check_order_whose_payment_is_done_form").serialize(),
          beforeSend:function(){

          $('#loader_modal').modal({
           backdrop: 'static',
           keyboard: false
           });

          $("#loader_modal").modal('show');
          },
          success:function(data){
            $("#loader_modal").modal('show');

            if(data.error == false){
              swal({ 
              title: "Success!",
              text: "Payment Done",
              type: "success" 
              },
              function(){
                window.location.href=full_path+"admin/orders/shipped";
              
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
    $("#ship_darts_order_whose_payment_is_done_form").on("submit",function(e){
        e.preventDefault();
        $.ajax({
          method:"post",
          url:full_path+"admin/ship-order-whose-payment-is-done",
          dataType:"json",
          data:$("#ship_darts_order_whose_payment_is_done_form").serialize(),
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
              text: "You have already send darts for Current Month",
              type: "warning" 
              },
              function(){
                window.location.href=full_path+"admin/orders/pending-shipment";
              
              });
            
            }
            else if(data.error == 'no subscribtion'){
              swal({ 
              title: "No subscribtion!",
              text: "subscribtion Not Found",
              type: "warning" 
              },
              function(){
                window.location.href=full_path+"admin/orders/shipped";
              
              });
            
            }
            else if(data.error == 'success'){
              swal({ 
              title: "Success!",
              text: "Darts Ship Done",
              type: "success" 
              },
              function(){
                window.location.href=full_path+"admin/orders/shipped";
              
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
    $(document).on('change',"#ship_darts_weight_id",function(){
      var weight_id=$(this).val();
      var order_details_id=$('#order_details_id').val();
       $.ajax({
        url:full_path+"admin/filter-product",
        method:"get",
        dataType:"json",  
        data:{weight_id:weight_id,order_details_id:order_details_id},
        success:function(data){
          var html_string='<label>Products</label>';
           html_string+=' <select class="selectpicker form-control"  name="product_id"  data-live-search="true" data-live-search-style="startsWith"  title="Choose Product"  required="true">';
          for(var i=0;i<data.length;i++){
            html_string+="<option value='"+data[i]['id']+"'>"+data[i]['product_name']+'('+data[i]['product_weight_range']+')'+"</option>";
          }
          html_string+=" </select>";
           $("#span_product").html(html_string); 
           $('.selectpicker').selectpicker('refresh');
        },
        error:function(){
          alert('Error');
        }
      });
    });

    $(".return_darts_order_whose_payment_is_done").on('click',function(e){

         var order_detail_id=$(this).data('order_detail_id');

        swal({
          title: "Are you sure?",
          text: "Your will not be able to recover this record once return!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, return it!",
          closeOnConfirm: false
        },      
        function(){
            $.ajax({
        url:full_path+"admin/confirm-return-darts",
        method:"get",
        dataType:"json",  
        data:{order_detail_id:order_detail_id},
          success:function(data){
            if(data.error == false){
              swal({ 
              title: "Success!",
              text: "Return Done",
              type: "success" 
              },
              function(){
                window.location.href=full_path+"admin/orders/pending";
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
    /*
        e.preventDefault();
        $.ajax({
          method:"post",
          url:full_path+"admin/confirm-return-darts",
          dataType:"json",
          
          data:{order_detail_id:order_detail_id},
          beforeSend:function(){
          $('#loader_modal').modal({
           backdrop: 'static',
           keyboard: false
           });
          $("#loader_modal").modal('show');
          },
          success:function(data){
            $("#loader_modal").modal('show');
            if(data.error == false){
              swal({ 
              title: "Success!",
              text: "Return Done",
              type: "success" 
              },
              function(){
                window.location.href=full_path+"admin/orders/pending-shipment";
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
    */
        }); //swal
    });


    $("#confirm_pending_payment_form").on("submit",function(e){
        e.preventDefault();
        $.ajax({

          method:"post",
          url:full_path+"admin/confirm-pending-payment",
          dataType:"json",
          data:$("#confirm_pending_payment_form").serialize(),
          beforeSend:function(){

          $('#loader_modal').modal({
           backdrop: 'static',
           keyboard: false
           });

          $("#loader_modal").modal('show');
          },
          success:function(data){
            $("#loader_modal").modal('show');

            if(data.error == false){
              swal({ 
              title: "Success!",
              text: "Payment Done",
              type: "success" 
              },
              function(){
                window.location.href=full_path+"admin/orders/shipped";
              
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
    $(document).on('click','#searchBtn',function(){
        var page_status=$("#page_status").val();
            $.ajax({
                method:'POST',
                dataType:'json',
                data:$('#searchForm').serialize(),
                url: full_path+'admin/advancedsearch/user',
                beforeSend: function(){
                    $('table').css('opacity', 0.5);
                },
                success: function(data){
                    // $("#send_mail_all_btn").hide();
                    $('table').css('opacity', 1);

                    // var table = $('#adListingTable').DataTable();
                    // table.destroy();
                    // var table = $('#adListingTable').DataTable();
                    $('#customer_table').dataTable().fnDestroy();
                    $('table').remove();


                    var html_string=' <table id="customer_table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">'
                                    +' <thead> <tr> '
                                    // +' <th><input type="checkbox"  id="checkedAll" class="all"></th>'
                                    +' <th></th>'
                                    +' <th>Name</th> '
                                    +' <th>Email</th>'
                                    +' <th>Country</th>'
                                    +' <th>State</th>'
                                    +' <th>City</th>'
                                    // +'<th>User Type</th>'

                                    +' <th>Email Verified</th>'
                                    +' <th>User Status</th>'
                                    +' <th>Customer Group</th>'
                                    +' <th>Created at</th>'
                                    +' <th>Action</th>'
                                    +' </tr> </thead> <tbody>';

                   
                    if(data.user_details.length>0) {
                        for (var i = 0; i < data.user_details.length; i++) {

                           

                           // Email Status
                            if(data.user_details[i].email_status ==0){
                               var email_status="No"; 
                            }
                            else{
                               var email_status="Yes"; 

                            }

                            
                            // User Status
                            if(data.user_details[i].user_status ==0){
                               var user_status="Pending"; 
                            }
                            else if(data.user_details[i].user_status ==1){
                               var user_status="Active"; 

                            }
                            else if(data.user_details[i].user_status ==2){
                               var user_status="Suspended"; 

                            }

                           


                            html_string += ' <tr> '
                                +' <td><input type="checkbox"  value="'+data.user_details[i].email+'" class="check checkSingle"></td>'
                                + ' <td>' + data.user_details[i].first_name+' '+data.user_details[i].last_name+ '</td>'
                                + ' <td>' + data.user_details[i].email + '</td>'
                                + ' <td>' + data.user_details[i].country_name + '</td>'
                                + ' <td>' + data.user_details[i].state_name + '</td>'
                                + ' <td>' + data.user_details[i].city_name + '</td>'
                                + ' <td>' + email_status + '</td>'
                                + ' <td>' + user_status + '</td>'
                                + ' <td>' + data.user_details[i].group_name + '</td>'
                                + ' <td>' + data.user_details[i].user_created_at+ '</td>'
                                + ' <td>'
                                + ' <a href="' + full_path + 'admin/customer/'+ data.user_details[i].user_table_id +'/detail"'+' class="" title="View Detail"><i class="fa fa-eye"></i></a>'
                                + ' </td>'
                                + ' </tr>';


                            
                        }
                    }
                    else{
                        // html_string+=' No listing found';
                        '{"draw": 0, "recordsTotal": 0, "recordsFiltered": 0, "data":[]}';
                    }
                     html_string+=' </tbody> </table>';

                    // $("#get_ad_listing_table_from_javascript").html(html_string);
                    $('#get_ad_listing_table_from_javascript').after(html_string);

                    var new_table=$("#customer_table").dataTable({

                        "order": [],
                        // "scrollY":        "200px",
                        // "scrollCollapse": true,
                        // "paging":         false,
                        "reload":true,


                    });

                    // new_table.reload();


                }
            });
        }); 
    $( "#first_name_advance_search" ).autocomplete({
          source: full_path+"admin/autocomplete-advance-search-for-users?type=first_name",
          minLength: 3
    });

    $( "#last_name_advance_search" ).autocomplete({
          source: full_path+"admin/autocomplete-advance-search-for-users?type=last_name",
          minLength: 3
    });

    $( "#email_advance_search" ).autocomplete({
          source: full_path+"admin/autocomplete-advance-search-for-users?type=email",
          minLength: 3
    });

     $(document).on("click",".checkSingle",function () {



          var show_mail_to_selected_user_button=false;
          $(".checkSingle").each(function(){

           if(this.checked){
            show_mail_to_selected_user_button=true;
          }

          if(show_mail_to_selected_user_button == true){
            $("#send_mail_to_selected_users").show();
          }
          else{
            $("#send_mail_to_selected_users").hide();
          }




        });



        });

        $(document).on("click","#send_mail_to_selected_users",function(){

          $("#mailModalForSelectedUsers").modal("show");
        });

        $(document).on("submit","#sendMailFormForSelectedUsers",function(e){
          e.preventDefault();
          if(($("#subject_for_selected_users").val() == "") || ($("#messsage_body_for_selected_users").val() == "")){
            alert("All Fields are required");
            return false;
          }
          var user_email_arr= [];
          $.when(
          $(".checkSingle").each(function(){

             if(this.checked){
                var user_id=$(this).val();
                user_email_arr.push(user_id);
             }

          })).then(function(){
             // var user_emails = user_email_arr.join(',');


           $.ajax({

            method:"post",
            dataType:"json",
            url:full_path+'admin/send-mail-to-selected-users',
            data:$("#sendMailFormForSelectedUsers").serialize()
            +'&user_email_arr='+user_email_arr,
            beforeSend:function(){
               $('#authorize_loader_modal').modal({
                backdrop: 'static',
                keyboard: false
              });
            
            $("#authorize_loader_modal").modal('show');
            },
            success:function(data){
            $("#authorize_loader_modal").modal('hide');
             if(data.error == false){
              swal({ 
              title: "Success!",
              text: "Mail Sent",
              type: "success" 
              },
              function(){
              window.location.reload();
              });

              }
             else{
              swal("Something went wrong");
             } 

            },
            error:function(){
              alert("Error");
            }
          }); //ajax


          });


        });


        $(document).on("click","#send_mail_all_btn",function(){

          var first_name=$("#first_name_advance_search").val(); 
          var last_name=$("#last_name_advance_search").val(); 
          var email=$("#email_advance_search").val(); 
          var group_name=$("#group_name").val(); 
          var country=$("#country_advance_search").val(); 
          var state=$("#state_advance_search").val(); 
          var city=$("#city_advance_search").val(); 

          $("#first_name_mail_modal").val(first_name);
          $("#last_name_mail_modal").val(last_name);
          $("#email_mail_modal").val(email);
          $("#group_name_mail_modal").val(group_name);
          $("#country_mail_modal").val(country);
          $("#state_mail_modal").val(state);
          $("#city_mail_modal").val(city);

          $("#mailModal").modal("show");


         
        });


        $("#sendMailForm").on("submit",function(e){

          e.preventDefault();
          if(($("#subject_for_all_users").val() == "") || ($("#messsage_body_for_all_users").val() == "")){
            alert("All Fields are required");
            return false;
          }

          $.ajax({

            method:"post",
            dataType:"json",
            url:full_path+'admin/send-mail-to-users',
            data:$("#sendMailForm").serialize(),
            beforeSend:function(){
               $('#authorize_loader_modal').modal({
                backdrop: 'static',
                keyboard: false
              });
            
            $("#authorize_loader_modal").modal('show');
            },
            success:function(data){
            $("#authorize_loader_modal").modal('hide');
             if(data.error == false){
              swal({ 
              title: "Success!",
              text: "Mail Sent",
              type: "success" 
              },
              function(){
              window.location.reload();
              });

              }
             else{
              swal("Something went wrong");

             } 

            },
            error:function(){
              alert("Error");
            }
          }); //ajax



        });


        $(document).on('change',"#country_advance_search",function(){
      var country_id=$(this).val();
      // var get_div=$(this).data('status');

      
      $.ajax({

        url:full_path+"filter-state",
        method:"get",
        dataType:"json",  
        data:{country_id:country_id},
        success:function(data){

          var html_string='<div class="col-md-3 col-xs-12 form-field"> <div class="form-group"> <label>State</label>';
           html_string+=' <select class="selectpicker form-control"  name="state_advance_search"  data-live-search="true" data-live-search-style="startsWith"  title="Choose State" id="state_advance_search">';
          for(var i=0;i<data.length;i++){

            html_string+="<option value='"+data[i]['id']+"'>"+data[i]['name']+"</option>";



          }
          html_string+=" </select></div></div>";
            
           
           $("#span_state").html(html_string); 
         
           $('.selectpicker').selectpicker('refresh');
            
        },
        error:function(){

          alert('Error');
        }

      });


    });

    $(document).on('change',"#state_advance_search",function(){
      var state_id=$(this).val();
      // var get_div=$(this).data('status');

      
      $.ajax({

        url:full_path+"filter-city",
        method:"get",
        dataType:"json",  
        data:{state_id:state_id},
        success:function(data){

          var html_string='<div class="col-md-3 col-xs-12 form-field"> <div class="form-group"> <label>City</label>';
           html_string+=' <select class="selectpicker form-control"  name="city_advance_search"  data-live-search="true" data-live-search-style="startsWith"  title="Choose City" id="city_advance_search">';
          for(var i=0;i<data.length;i++){

            html_string+="<option value='"+data[i]['id']+"'>"+data[i]['name']+"</option>";

          }

          html_string+=" </select></div></div>";
            
           
           $("#span_city").html(html_string); 
         
           $('.selectpicker').selectpicker('refresh');
            
        },
        error:function(){

          alert('Error');
        }

      });


});

});