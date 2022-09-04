
$(document).ready(function () {
    $('.badges-form fieldset:first-child').fadeIn('slow');

    $('.badges-form input[type="text"],input[type="email"],input[type="tel"],select').on('focus', function () {
        $(this).removeClass('input-error');
    });

    // next step
    $('.badges-form .btn-next').on('click', function () {
        var parent_fieldset = $(this).parents('fieldset');
        var next_step = true;

        parent_fieldset.find('input[type="text"],input[type="email"],input[type="tel"],select').each(function () {
            if ($(this).val() == "") {
                $(this).addClass('input-error');
                next_step = false;
            } else {
                $(this).removeClass('input-error');
            }
        });

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

        $(this).find('input[type="text"],input[type="email"],input[type="tel"],select').each(function () {
            if ($(this).val() == "") {
                e.preventDefault();
                $(this).addClass('input-error');
            } else {
                $(this).removeClass('input-error');
            }
        });

    });


	$('.select-color').click(function(){
		$('.badges-color ul li').removeClass('active-color');
		$(this).parent().addClass('active-color');
		var color = $(this).attr('data-hex');
		$('.selected-color').css('background-color', color)
	})
	
/*	$('.select-img').click(function(){
		$('.select-img').removeClass('active-img');
		
		$(this).addClass('active-img');
		var selectedImage = $(this).attr('data-src');
		
		var imageSize = $('.imgsize').html();
		
		$('.selected-img').attr('src', selectedImage)
		$('.pre-imgsize').closest().html(imageSize);
	})*/
	
	
	$('.badges-sizes ul li').click(function(){
		$('.select-img').removeClass('active-img');
		$(this).find('.select-img').addClass('active-img');
		var selectedImage = $(this).find('.select-img').attr('data-src');
		var imageSize = $(this).find('.imgsize').html();
		$('.selected-img').attr('src', selectedImage);
		$('.pre-imgsize').html(imageSize);
	})
	
	
	
	$('#color-selector').click(function(){
		var colorSelector = $(this).attr('value');
		$('.selected-color').css('color', colorSelector)
	})
	
	
// this function used to show text in (selectedtext) element

$('#text-selector').on('keyup', function(){
	var firstline = $(this).val();
	
	
	
	

        

        var width = $("#firstline").width();
        var height = $("#firstline").height();
        var fontSize = 2;
        var html;
		
        
        html = '<span style="font-size:' + fontSize + 'pt;">' + firstline + '</span>';
        
        $("#firstline").html(html);
        var textArea = $("#firstline").children();

        textArea.css('width', 'auto');

        if (firstline.length > 0) {
            while (textArea.width() < (width - 10)) {
                if (textArea.height() > (height+3)) {
                    textArea.css('font-size', fontSize - 1);
                    break;
                }
                fontSize = parseInt(textArea.css('font-size'), 10);
                textArea.css('font-size', fontSize + 1);
            }
        }
        textArea.css('width', '100%');
    
	
	
	
	
	
	
	
	
	
	$('#firstline').html(firstline);
});

$(document).on('keyup', '#text2-selector', function(){
	var secondline = $(this).val();
	
	
	
	
        var width = $("#secondline").width();
        var height = $("#secondline").height();
        var fontSize = 2;
        var html;
		
        
         html = '<table style="font-size:' + fontSize + 'pt;"><tr><td>' ;
            html += '</td></tr><tr><td>' + secondline + '</tr></td></table>';
        
        $("#secondline").html(html);
        var textArea = $("#secondline").children();

        textArea.css('width', 'auto');

        if (secondline.length > 0) {
            while (textArea.width() < (width - 10)) {
                if (textArea.height() > (height+3)) {
                    textArea.css('font-size', fontSize - 1);
                    break;
                }
                fontSize = parseInt(textArea.css('font-size'), 10);
                textArea.css('font-size', fontSize + 1);
            }
        }
        textArea.css('width', '100%');
	
	
	
	
	$('#secondline').html(secondline);
});
  
// end here



$('#color-selector').change(function(){ 
var custom_color = $(this).val();
custom_color = '#'+custom_color;

	 $('#firstline, #secondline').css('color', custom_color);
}); 
$('#font-selector').change(function(){ 
	 $('#firstline, #secondline').css('font-family', $(this).val());
}); 
	      
var selector ;	   
$('#line-selector').on('change', function(){ 	 
	 selector = $(this).val();
	if(selector == 'doubleline')
	{
		$('#dl').html('<input type="text" name="enterText2" class="form-control" id="text2-selector" value="">');
	}
	else
	{
		$('#dl').html('');	
	}
});

   
});








    



