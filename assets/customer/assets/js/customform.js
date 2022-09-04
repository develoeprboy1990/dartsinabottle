var full_path = $('#site_url').val()+'/';
var full_bg_color = 0;
$(document).ready(function () {
    $('.badges-form fieldset:first-child').fadeIn('slow');

    $('.badges-form').attr('autocomplete', 'off');

    $('.badges-form input[type="text"],input[type="email"],input[type="tel"],select').on('focus', function () {
        $(this).removeClass('input-error');
    });

    // next step
    $('.badges-form .btn-next').on('click', function () {
      $('html,body').animate({
    scrollTop: $(".badges-form").offset().top - 5
  }, 'slow');

        var parent_fieldset = $(this).parents('fieldset');
        var next_step = true;


        parent_fieldset.find('input[type="text"],input[type="email"],input[type="tel"],select,input[name=package_id]').each(function () {
            if ($(this).val() == "") {
                console.log(this);
                if(this.name == "package_id"){
                  
                   $(".empty_color_error").addClass('input-error'); 
                }
                
                $(this).addClass('input-error');
                next_step = false;
            } else {
                $(this).removeClass('input-error');
            }
        });

        parent_fieldset.find('input[name=badge_full_bg_color_id]').each(function () {
          if ($(this).val() == "") {
            if(this.name == "badge_full_bg_color_id" && full_bg_color == 1){
                // alert(this.name+" and "+full_bg_color);    
               $(".empty_full_bg_color_error").addClass('input-error'); 
                next_step = false;

            }  
          } 
          

        });

        // parent_fieldset.find('input[name=badge-type-radio]').each(function () {
        //   if($(this).is(":checked")) {
        //     $('#get_badge_size_types').removeClass('input-error');

        //   } 
        //   else
        //   {
        //     $('#get_badge_size_types').addClass('input-error'); 
        //         next_step = false; 
        //   }
          

        // });

        if (next_step) {
            parent_fieldset.fadeOut(400, function () {
                $(this).next().fadeIn();
            });
        }

    });

    // previous step
    $('.badges-form .btn-previous').on('click', function () {
        $(this).parents('fieldset').fadeOut(400, function () {
            $(this).prev().fadeIn();
        });
    });

    // submit
    $('.badges-form').on('submit', function (e) {
        $(this).find('input[type="text"],input[type="email"],input[type="tel"],select,input[name=sort_1],input[name=sort_2],input[name=sort_3]').each(function () {

            if ($(this).val() == "") {
                e.preventDefault();
                $(".validate_next").addClass('weight-error');
                /*if(this.name == "selectcolor"){

                   $(".empty_font_color_error").addClass('input-error'); 
                }*/

                //$(this).addClass('input-error');

            } else {
                $(this).removeClass('input-error');
            }
        });

    });

    $('.cart-form .order-col').on('click', function () {

          if ($('#agree_term_condictions').is(":checked")){
             window.location.href = full_path+"checkout";
             $(".agree_checked").css({ 'border' : ''});
          } else {
            $(".agree_checked").css({"border":"1px solid #ff0000"});
            return false;
          }
    });


    $('#agree_term_condictions').change(function() {
        if(this.checked) {
          $(".agree_checked").css({ 'border' : ''});
        }
    });

      $('.select-color').click(function(){
        // alert("asdskafj");
      $(".empty_color_error").removeClass('input-error'); 
      var badge_color_id=$(this).data('badge_color_id');
      // alert(badge_color_id);
      $("#badge_color_id").val(badge_color_id);

      var badge_color_hax=$(this).data('hex');
      $("#badge_color_hax").val(badge_color_hax);

      $('.badges-color ul li').removeClass('active-color');
      $(this).parent().addClass('active-color');
      var color = $(this).attr('data-hex');
      $('.selected-color').css('background-color', color);
      })

      $('.select-full-bg-color').click(function(){
          $(".empty_full_bg_color_error").removeClass('input-error'); 
            // alert("asdskafj");
          var badge_full_bg_color_id=$(this).data('badge_full_bg_color_id');
          // alert(badge_full_bg_color_id);

          $("#badge_full_bg_color_id").val(badge_full_bg_color_id);

          var badge_full_bg_color_hax=$(this).data('hex');
          $("#badge_full_bg_color_hax").val(badge_full_bg_color_hax);

          $('.badges-color ul li').removeClass('active-color');
          $(this).parent().addClass('active-color');
          var color = $(this).attr('data-hex');
          // alert(color);
          $('.bg-selected-color').css("background-color", color);
      })

      $('.select-font-color').click(function(){
      var font_color_hax=$(this).data('hex');
      $("#color-selector").val(font_color_hax);

      $('.font-color ul li').removeClass('active-color');
      $(this).parent().addClass('active-color');
      var color = $(this).attr('data-hex');

    $('#firstline, #secondline').css('color', color)

      })


      
	
/*	$('.select-img').click(function(){
		$('.select-img').removeClass('active-img');
		
		$(this).addClass('active-img');
		var selectedImage = $(this).attr('data-src');
		
		var imageSize = $('.imgsize').html();
		
		$('.selected-img').attr('src', selectedImage)
		$('.pre-imgsize').closest().html(imageSize);
	})*/

// Badge-Type-Radio Button
  
  $(document).on('click' , '.badge-type' ,function(){
    if ($(this).is(":checked")) {

    full_bg_color = 0;
    var badge_type_id=$(this).data('id');
    // alert("Badge Type id = "+badge_type_id);
    $('#badge_type_id').val(badge_type_id);
    
    var badge_type_title=$(this).data('type');
    var badge_size_id  = $('#badge_size_id').val();

    // alert("Badge size id = "+badge_size_id);

    if(badge_type_id == 1)
    {
      $("#badge_full_bg_color_id").val("");
      $('.full-color').css("display" , "none");
      var badge_type = 'empty_image'; 
      $('.bg-selected-color').css("display" , "none");

    }
    else if(badge_type_id == 2)
    {
      $("#badge_full_bg_color_id").val("");
      $('.full-color').css("display" , "none");
      var badge_type = 'transparent_image'; 
      $('.bg-selected-color').css("display" , "none");

    }
    else if(badge_type_id == 3)
    {
      full_bg_color = 1;
      $('.full-color').css("display" , "block");
      var badge_type = 'empty_image'; 
      $('.bg-selected-color').css("display" , "block");
      if(badge_size_id == 11)
      {
        $('.bg-selected-color').css("min-height" , "212px");
      }
      else if(badge_size_id == 12)
      {
        $('.bg-selected-color').css("min-height" , "238px");
      }
      else if(badge_size_id == 13)
      {
        $('.bg-selected-color').css("min-height" , "168px");
      }
      else if(badge_size_id == 14)
      {
        $('.bg-selected-color').css("min-height" , "171px");
      }
      else if(badge_size_id == 15)
      {
        $('.bg-selected-color').css("min-height" , "238px");
      }
    }
    // alert(full_path+"admin/get-badge-type-image");
    $.ajax({
      type: "GET",
      url: full_path+"admin/get-badge-type-image",
      data: {badge_size_id:badge_size_id},
      success: function(data){
        // alert(data.badge_size[badge_type]);
      $('.selected-img').attr('src', full_path+"public/uploads/badge_img/"+data.badge_size[badge_type]);
      

      }

    });

    }
  });

  $('.add-to-cart').click(function(){
    var product_id = $(this).data('product_id');
    var qty = $('#pro_qty_'+product_id).val();
    $.ajax({
      method: "get",
      url: full_path+"product-cart",
      dataType: 'json',
      data: {product_id:product_id , qty:qty },
      success: function(data){
        if(data.success == true)
        {
          toastr.success('Success!', 'Badge added Successfully.',{"positionClass": "toast-bottom-right"});
          window.location.href = full_path+"cart";
        }     

      }

    });

    
  });
	

  $('.package').click(function(){
    $('.single-price').removeClass('active-img');
    $(this).find('.single-price').addClass('active-img');
    var package_id=$(this).data('package_id');
    $("#package_id").val(package_id);

    $.ajax({

      url:full_path+"get-package/"+package_id,
      method:"get",
      dataType:"json",
      success:function(data){
        // alert(data.result);
        $('#package_preview').html(data.html);
      },
      error:function(){

        alert("Error");

      }


     });

    
  });

  $('.weight').click(function(){

    if ($(this).hasClass('disabled')) {
    }
    else
    {
    var weight_id = $(this).data('weight_id');

    if($("#sort_1").val() == '' &&  $("#sort_2").val() == '' && $("#sort_3").val() == '') 
    {

      $("#sort_1").val(weight_id);
      $(this).find('.single-weight').addClass('gold-choice');
      $(this).find('.price-header h3').html('1st Choice');

    }
    else if($("#sort_2").val() == '' && $("#sort_3").val() == '')
    {
      $("#sort_2").val(weight_id);
      $(this).find('.single-weight').addClass('silver-choice');
      $(this).find('.price-header h3').html('2nd Choice');
    }
    else if($("#sort_3").val() == '')
    {
      $("#sort_3").val(weight_id);
      $(this).find('.single-weight').addClass('bronze-choice');
      $(this).find('.price-header h3').html('3rd Choice');
    }
    $(this).addClass('disabled');
    }
  });

  $('.btn-choose_againg').click(function(){
      $("#sort_1").val('');
      $("#sort_2").val('');
      $("#sort_3").val('');
      $('.weight').removeClass("disabled");
      $('.single-weight').removeClass("gold-choice silver-choice bronze-choice");
      $('.weight .single-weight .price-header h3').html('');


  });
  
	$('.badges-sizes ul li').click(function(){
    $('.full-color').css('display' , 'none');
    var badge_size_id=$(this).data('badge_size_id');
    var badge_size_from=$(this).data('badge_size_from');
    var badge_size_to=$(this).data('badge_size_to');
    
    $("#badge_size_id").val(badge_size_id);
    $('.select-img').removeClass('active-img');
		$(this).find('.select-img').addClass('active-img');
		
    var selectedImage = $(this).find('.select-img').attr('data-src');
		var imageSize = $(this).find('.imgsize').html();

		$('.selected-img').attr('src', selectedImage);
    $('.pre-top-arrow').html(badge_size_from);
    $('.pre-right-arrow').html(badge_size_to);
    $('.pre-imgsize').html(imageSize);
    $('.bg-selected-color').css("display" , "none");
    $('#badge_type_id_1').prop('checked', true);

	});
	
	
	
	$('#color-selector').click(function(){
		var colorSelector = $(this).attr('value');
		$('.selected-color').css('color', colorSelector)
	})
	
	
// this function used to show text in (selectedtext) element
$('#text-selector').on('keyup', function(){
	var firstline = $(this).val();

        var width = $("#firstline").width();
        var height = $("#firstline").height();
        // var fontSize = 2;
        if(firstline.length ==1){
          var fontSize=18;
        }
        else
         {
        var fontSize = 2;

         } 
        var html;
		
        html = '<span style="font-size:' + fontSize + 'pt;" data-font-size="'+fontSize+'">' + firstline + '</span>';
        $("#firstline_font_size").val(fontSize);
        $("#firstline").html(html);
        var textArea = $("#firstline").children();

        textArea.css('width', 'auto');

        if (firstline.length > 0) {
            while (textArea.width() < (width - 10)) {
                if (textArea.height() > (height+0)) {
                    textArea.css('font-size', fontSize - 1);
                    $("#firstline_font_size").val(fontSize - 1);
                    //textArea.data('font-size', fontSize - 1);
                    break;
                }
                fontSize = parseInt(textArea.css('font-size'), 10);
				
                textArea.css('font-size', fontSize + 1);
                $("#firstline_font_size").val(fontSize + 1);
                //textArea.data('font-size', fontSize + 1);
                   
            }
        }
        textArea.css('width', '100%');
});

$(document).on('keyup', '#text2-selector', function(){
	      var secondline = $(this).val();
        
        var width = $("#secondline").width();
        var height = $("#secondline").height();
        if(secondline.length ==1){
          var fontSize=18;
        }
        else
         {
        var fontSize = 2;

         } 
        var html;
		
        
         html = '<span style="font-size:' + fontSize + 'pt;">' + secondline + '</span>'
        $("#secondline_font_size").val(fontSize);
        $("#secondline").html(html);
        var textArea = $("#secondline").children();
        // console.log(textArea.width());
        textArea.css('width', 'auto');

        if (secondline.length > 0) {
            while (textArea.width() < (width - 10)) {
                if (textArea.height() > (height+0)) {
                    textArea.css('font-size', fontSize - 1);
                    $("#secondline_font_size").val(fontSize - 1);
                    break;
                }
                fontSize = parseInt(textArea.css('font-size'), 10);
                textArea.css('font-size', fontSize + 1);
                $("#secondline_font_size").val(fontSize + 1);
            }
        }
        textArea.css('width', '100%');

});
  
// end here


/*$('#color-selector').change(function(){ 
var custom_color = $(this).val();
custom_color = '#'+custom_color;

	 $('#firstline, #secondline').css('color', custom_color);
}); */
$('#font-selector').change(function(){ 

     //var selected_font_family=$("#font-selector option:selected").text();


    var selected_font_family=$("#font-selector option:selected").data('fontfamily');
     
	 $('#firstline, #secondline').css('font-family', selected_font_family);
}); 
	      
var selector ;	   
$('#line-selector').on('change', function(){ 	 
	 selector = $(this).val();

    

	if(selector == '2')
	{
    $("#selectedtext").addClass('manage-height');
		$('#dl').html('<input type="text" name="enterText2" class="form-control" id="text2-selector" value="" autocomplete="off">');

  }
	else
	{
    $("#selectedtext").removeClass('manage-height');
    $('#dl').html('');	
		$('#secondline').html('');	
	}

     //new code
    var get_side_val=$('input[name=side]:checked').val();
    
      if(get_side_val == "double_side"){

   
  var html_string=' <div class="form-group">';   
  
 
  if(selector ==1){
    var single_line_text=$("#text-selector").val(); 
   
    html_string +=' <label>Enter Back Side Text</label>  '
                 +' <input type="text" name="back_side_text" autocomplete="off" class="form-control" id="" value="'+single_line_text+'">'; 
  }
  else if(selector ==2){
    
     var single_line_text=$("#text-selector").val(); 
   
    html_string +=' <label>Enter Back Side Text</label>  '
                 +' <input type="text" name="back_side_text" autocomplete="off" class="form-control" id="" value="'+single_line_text+'">'; 

    var double_line_text=$("#text2-selector").val(); 
    html_string +='<br> <input type="text" name="back_side_text2" autocomplete="off" class="form-control" id="" value="'+double_line_text+'">';
  
  }
  
  html_string+='</div>';
  $("#back_side_text_span").html(html_string);
}
else{
  $("#back_side_text_span").html("");

}
// New Code Ended

});


$(document).on('click','input[name=side]',function(){

  // $('input[name=side]:checked');
  var get_side_val=$(this).val();
  var line_val=$("#line-selector").val();


  if(get_side_val == "double_side"){

   
  var html_string=' <div class="form-group">';   
  
  // Double Side

  if(line_val ==1){
    var single_line_text=$("#text-selector").val(); 
   
    html_string +=' <label>Enter Back Side Text</label>  '
                 +' <input type="text" name="back_side_text" autocomplete="off" class="form-control" id="" value="'+single_line_text+'">'; 
  }
  else if(line_val ==2){
    
     var single_line_text=$("#text-selector").val(); 
   
    html_string +=' <label>Enter Back Side Text</label>  '
                 +' <input type="text" name="back_side_text" autocomplete="off" class="form-control" id="" value="'+single_line_text+'">'; 

    var double_line_text=$("#text2-selector").val(); 
    html_string +='<br> <input type="text" name="back_side_text2" autocomplete="off" class="form-control" id="" value="'+double_line_text+'">';
  
  }
  
  html_string+='</div>';
  $("#back_side_text_span").html(html_string);
}
else{
  $("#back_side_text_span").html("");

}

});   
});