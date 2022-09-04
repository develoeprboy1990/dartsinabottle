$(document).ready(function () {
    $('.reorder-form fieldset:first-child').fadeIn('slow');

    $('.reorder-form input[type="text"],input[type="email"],input[type="tel"],select').on('focus', function () {
        $(this).removeClass('input-error');
    });

    // next step
    $('.reorder-form .btn-next').on('click', function () {
        
        // alert("cll");
        // alert($("#billing_state").val());
        // return false;
        var parent_fieldset = $(this).parents('fieldset');
        var next_step = true;

    //     parent_fieldset.find('input[type="text"],input[type="email"],select').each(function () {
    //         if ($(this).val() == "") {
    //             $(this).addClass('input-error');
    //         next_step = false;
    //         }
			 // else {
    //             $(this).removeClass('input-error');
    //         }
    //     });
     parent_fieldset.find('.req_class').each(function () {
            if ($(this).val() == "") {
                $(this).addClass('input-error');
                // $('.hit_select bs-placeholder').addClass('input-error');
            next_step = false;
            }

             else {
                $(this).removeClass('input-error');
                // $('.hit_select bs-placeholder').removeClass('input-error');

            }
        });
        // alert(next_step);


        if (next_step) {
            parent_fieldset.fadeOut(400, function () {
                $(this).next().fadeIn();
            });
        }
    });

    // previous step
    $('.reorder-form .btn-previous').on('click', function () {
        $(this).parents('fieldset').fadeOut(400, function () {
            $(this).prev().fadeIn();
        });
    });

    // submit
    $('.reorder-form').on('submit', function (e) {
        e.preventDefault();
        var error_check=false;
        
        $(this).find('input[type="text"],select').each(function () {
            if ($(this).val() == "") {
                // e.preventDefault();
                error_check=true;
                $(this).addClass('input-error');
                
            } 
            else{
                error_check=false;
                $(this).removeClass('input-error');

            }
        });


        if(error_check ==  true)
        {
          return false;
        }
        else
        {
        
           $.ajax({

           method:"post",
           url:full_path+"reorder",
           dataType:"json",
           data:$(".reorder-form").serialize(),
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
        }

      

     
});






	

	
	
	
	
$("input[name='billShipSame']").click(function(e){
        $(".billing-fields").toggle();	
		
 });	

});




    



