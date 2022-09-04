//var full_path="http://badge.aladdinapps.com/order/";
// var full_path="http://localhost/badge-buddies/";


var full_path = $('#site_url').val()+'/';

$(document).ready(function(){

$("#badge_description").jqte();


$('#myTable').DataTable({

       "order": [],
         responsive: true
    });

$(document).on('click','.show_badges',function(){

  var order_product_id=$(this).data("order_product_id");

  $.ajax({

    method:"get",
    dataType:"json",
    url:full_path+"get-badge-details",
    data:{order_product_id:order_product_id},
    success:function(data){
            console.log(data.order_product)
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
       var html_string=' <figure> <img src="'+full_path+'public/uploads/badge_img/'+data.badge_type_images[selected_img]+'" class="img-responsive selected-img" alt="selected badge">'
                     +'<figcaption class="bg-selected-color" style="position: absolute; z-index: 1; left: 1px; right: 0px; bottom: 1px; border-radius: 5px; padding: 10px 10px; text-align: center; font-weight: 600; background-color:#'+data.badge_bg_full_color+';'+bg_height+';"  ></figcaption>'
                      +'  <figcaption class="selected-color" id="selectedtext" style="background-color:#'+data.order_product.badge_color+';'+bleed_style+'">'
                      +' <div id="firstline" class="firstline" style="font-family:'+data.font_family+'">'
                      +' <span style="font-size: '+data.order_product.firstline_font_size+'px; width: 100%; color:#'+data.order_product.font_color+'">'+data.order_product.enterText+'</span>'
                      +' </div>';

       if(data.order_product.enterText2 !=null){
          html_string+=' <div id="secondline" class="firstline" style="font-family:'+data.font_family+'">'
                      +' <span style="font-size: '+data.order_product.secondline_font_size+'px; width: 100%; color:#'+data.order_product.font_color+'">'+data.order_product.enterText2+'</span>'
                      +' </div>';

       }

       

       html_string+=' </figcaption></figure>'
       			  +' <div class="text-center"> <strong>Size '+data.order_product.size_from+' * '+data.order_product.size_to+' </strong> </div>';		    

       if(data.order_product.enterText2 != null){
        var double_line_text=data.order_product.enterText2;
       }
       else{
        var double_line_text="N/A";
       }
       if(data.order_product.side == 'single_side'){
        var get_side="Single Sided";
       }
       else{
        var get_side="Double Sided";
       }
              
       html_string+=' <table class="table" style="width: 51%;margin: 20px auto 0px;"> <tbody>'
                   +' <tr><th>Size</th><td>'+data.order_product.size_from+'*'+data.order_product.size_to+'</td>'
                   +' </tr>'
                   +' <tr><th>Bleed Color</th> <td><div style="background-color: #'+data.order_product.badge_color+'; width: 20px; height: 20px; display: inline-block; vertical-align: middle; margin-right: 5px;"></div><span>'+data.badge_color_title+'(#'+data.order_product.badge_color+')</span></td>'
                   +' </tr>'
                   +' <tr><th>Single Line </th><td>'+data.order_product.enterText+'</td>'
                   +' </tr>' 
                   +' <tr><th>Double Line </th><td>'+double_line_text+'</td>'
                   +' </tr>' 
                   +' <tr><th>Font Family Name</th><td>'+data.order_product.font_family_name+'</td>'
                   +' </tr>' 
                   +' <tr><th>Font Color</th><td><div style="background-color:#'+data.order_product.font_color+';width: 20px; height: 20px; display: inline-block; vertical-align: middle; margin-right: 5px;"></div><span>'+data.badge_font_color_title+' (#'+data.order_product.font_color+')</span></td>'
                   +' </tr>'
                   +' <tr><th>Side</th><td>'+get_side+'</td>'
                   +' </tr>'
                   +' <tr> <th>Badge Background Color</th> <td><div style="background-color: #'+data.badge_bg_full_color+'; width: 20px; height: 20px; display: inline-block; vertical-align: middle; margin-right: 5px;"></div><span>'+data.badge_bg_full_color_title+' (#'+data.badge_bg_full_color+')</span></td>'
                   +' </tr>'
                   +' <tr><th>Badge Bleed</th><td>'+data.badge_bleed.title+'</td>'
                   +' </tr>'
                   +' <tr><th>Badge Type</th><td>'+data.badge_type.title+'</td>'
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
    url:full_path+"get-badge-details",
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

$(".badge_example").on("click",function(){

  var get_val=$(this).val();
  if(get_val == "yes"){
    $("#badge_example_file_div").fadeIn();
  } 
  else
  {
    // alert("no");
    $("#badge_example_file_div").fadeOut();

  }

});

$(".badge_asset").on("click",function(){

  var get_val=$(this).val();
  if(get_val == "yes"){
    $("#asset_file_div").fadeIn();
  } 
  else
  {
    // alert("no");
    $("#asset_file_div").fadeOut();

  }

});


$("#custom_badge_form").on('submit',function(e){

  e.preventDefault();
  var formData = new FormData(this);
           $.ajax({

            method:"post",
            url:full_path+"create-custom-badge",
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
                  text: 'Custom Badge details sent successfully. Admin will send you quote on apporval of badge',
                  type: "success",
                  closeOnClickOutside: false
                },
                function(){ 

                  window.location.href=full_path+"custom-badges/pending";
                  // window.location.reload();
                });    
                    } //else

                  },
                  error:function(){
                    alert("Error");
                  }


                 }); // ajax


});


// $(".reject_quote").on('click',function(){

//   var custom_badge_quote_id=$(this).data("custom_badge_quote_id");
//   $("#custom_badge_quote_id").val(custom_badge_quote_id);

//   $("#quote_rejection_modal").modal("show");

// });

$("#quote_rejection_form").on("submit",function(e){
  e.preventDefault();

  $.ajax({
    method:"post",
    url:full_path+"reject-quote",
    dataType:"json",
    data:$("#quote_rejection_form").serialize(),
    beforeSend:function(){
      $("#quote_rejection_form_submit_btn").attr('disabled','true');
      $('#loader_modal').modal({
       backdrop: 'static',
       keyboard: false
     });

      $("#loader_modal").modal('show');
      },
    success:function(data){
      

      if(data.error == false){
          $("#loader_modal").modal('hide');
          $("#quote_rejection_form_submit_btn").removeAttr('disabled','true');
          swal({ 
            title: "Success!",
            text: 'Quote Rejected Successfully.',
            type: "success",
            closeOnClickOutside: false
          },
          function(){ 

            window.location.href=full_path+"custom-badges/rejected-quote";
            // window.location.reload();
          }); 

      }

    },
    error:function(){
     alert("Error");      
    }

  });

});


  $(document).on('click','.left_chat_menu',function(){

    var chat_id=$(this).data('chat_id');
    $("#chat_id").val(chat_id);
    // $("#modal_inbox_id").val(inbox_id);
    // $(this).find('div').removeClass('give_customer_msg_div_color');
    // alert(inbox_id);
      $.ajax({
         method:"get",
         dataType:'json',
         url:full_path+'fetch-chat-content',
         data:{chat_id:chat_id},
         success:function(data){

        
          // $("#display_message_content").html(data.inbox.message);


          // alert(data.result[0].message);
          // alert(data.result.length);
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

              html_string+='<div class="media msg "> <a class="pull-left" href="#">';
              html_string+=' <img class="media-object"  style="width: 32px; height: 32px;" src="'+full_path+'public/uploads/users/default.png'+'"> </a>'; 
              html_string+=' <div class="media-body"> <small class="pull-right time"><i class="fa fa-clock-o"></i> '+data.result[i].created_at+'</small>';
              html_string+=' <h5 class="media-heading">'+user_type+' </h5>';
              html_string+=' <small class="col-lg-10">'+data.result[i].message+' </small> </div></div>';
            


          }
          // alert(html_string);
          $("#show_chat_detail").html(html_string);
          // $("#message_time").html(data.inbox.created_at);
          // $("#content_mail").show();
          // $(".remove_disable").attr('disabled',false);
          $('.remove_disable').removeAttr("disabled",true);  

          if(data.from_id !=1) //this is used to display issue resolved btn
          {
              $("#show_issue_resolved_btn").html(' <a href="#" class="col-lg-4 text-right btn btn-success send-message-btn pull-right remove_disable" id="issue_resolved_customer" data-chat_id="'+chat_id+'">Issue Resolved</a>');

          }
          else
          {
              $("#show_issue_resolved_btn").html(''); 
          }

         },
         error:function(){

            alert("Error");
         }


      });

  });


  $("#send-message-to-admin").on('submit',function(e){
      e.preventDefault();

      $.ajax({

        url:full_path+'send-message-to-admin-from-chat-box',
        method:'post',
        dataType:'json',
        data:$("#send-message-to-admin").serialize(),
        success:function(data){
          var html_string="";

              html_string+='<div class="media msg "> <a class="pull-left" href="#">';
              html_string+=' <img class="media-object"  style="width: 32px; height: 32px;" src="'+full_path+'public/uploads/users/default.png'+'"> </a>'; 
              html_string+=' <div class="media-body"> <small class="pull-right time"><i class="fa fa-clock-o"></i> '+data.created_at+'</small>';
              html_string+=' <h5 class="media-heading">'+data.from+' </h5>';
              html_string+=' <small class="col-lg-10">'+data.message_body+' </small> </div></div>';

          $("#message_content").val("");    
          $("#show_chat_detail").append(html_string);

        },
        error:function(){

          alert("Error");

        }

      });  

  });

    // $("#issue_resolved_customer").on('click',function(){
    $(document).on('click','#issue_resolved_customer',function(){

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
    window.location.href = full_path+"move-chat-to-archive/"+chat_id;
     

    });

    });

});
