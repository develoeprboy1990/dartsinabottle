<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>@yield('title')</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="@yield('description')">
<meta name="author" content="">
<link href="{{asset('assets/customer/assets/css/bootstrap.min.css')}}" rel="stylesheet"> 
<link href="{{asset('assets/customer/assets/css/fontawesome.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/sweetalert.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="preload" href="https://fonts.googleapis.com/css?family=JetBrains+Mono:100,200,300,400,500,600,700,800,100i,200i,300i,400i,500i,600i,700i,800i&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=JetBrains+Mono:100,200,300,400,500,600,700,800,100i,200i,300i,400i,500i,600i,700i,800i&display=swap"></noscript>
<link href="{{asset('assets/customer/css/style.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/customer/assets/css/customer-style.css')}}" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>

{{-- Data Tables Outside --}}
<link href="{{asset('assets/js/datatables/jquery.dataTables.min.css ')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/js/datatables/buttons.bootstrap.min.css ')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/js/datatables/fixedHeader.bootstrap.min.css ')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/js/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/js/datatables/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/fancybox.min.css')}}" rel="stylesheet" type="text/css" />
{{-- Datatables end --}}
<style type="text/css">
.preloader {
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   z-index: 9999;   
   background-image: url('public/uploads/badge_img/Preloader.gif');
   background-repeat: no-repeat; 
   background-color: rgba(0,0,0,0.6);
   background-position: center;
}
</style>
@if($analytics_code)
    {!!$analytics_code->content!!}
@endif
</head>
<body>
<input type="hidden" id="site_url"  value="{{ url('') }}">
@if($body_code)
    {!!$body_code->content!!}
@endif
@yield('content')
<script src="{{asset('assets/customer/assets/js/jquery.js')}}"></script> 
<script src="{{asset('assets/customer/assets/js/bootstrap.min.js')}}"></script> 
<script src="{{asset('assets/jquery.validate.min.js')}}"></script> 
<script src="{{asset('assets/additional-methods.min.js')}}"></script> 
<script src="{{asset('assets/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/bootstrap-select.min.js')}}"></script> 

{{-- Datatbale jquery --}}
<script src="{{asset('assets/js/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatables/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('assets/js/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/js/datatables/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/datatables/jszip.min.js')}}"></script>
<script src="{{asset('assets/js/datatables/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/js/datatables/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/js/datatables/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/js/datatables/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/datatables/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('assets/js/datatables/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('assets/js/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/datatables/responsive.bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/datatables/dataTables.scroller.min.js')}}"></script>
{{-- Datatable jquery end --}}

<script src="{{asset('assets/js/jquery.fancybox.min.js')}}"></script>


@yield('javascript')
<script src="{{asset('assets/customer/js/customer_validate.js')}}"></script>
<script type="text/javascript">
$('.nav li.dropdown').click(function() {
    if ($(this).hasClass('open')){
        $(this).removeClass('open'); 
    } else {
        $('li.dropdown').removeClass('open');
        $(this).addClass('open');
    }
});
</script>
<script type="text/javascript">
$(window).on("load",function(){
    $('.preloader').fadeOut('slow');
});
$('#myTable').DataTable({
searching: false, 
paging: false, 
info: false,
 "order": [],
 responsive: true
});
jQuery(function(){
   jQuery('#myTable tbody tr td:first').click();
});
  /* formats a VALID postcode nicely: AB120XY -> AB1 0XY */ 

$("#shipping_zip,#billing_zip_code").blur(function() 
{
 var p = $("#shipping_zip").val();

 if (isValidPostcode(p)) { 
        var postcodeRegEx = /(^[A-Z]{1,2}[0-9]{1,2})([0-9][A-Z]{2}$)/i; 
        return p.replace(postcodeRegEx,"$1 $2"); 
    } else {
          swal({
          title: "Error!",
          text: "Please enter a valid UK postcode.",
          type: "error",
          closeOnClickOutside: false
          });
        $(this).val('');
        return p;
    }
});

/* tests to see if string is in correct UK style postcode: AL1 1AB, BM1 5YZ etc. */ 
function isValidPostcode(p) { 
  var postcodeRegEx = /[A-Z]{1,2}[0-9]{1,2} ?[0-9][A-Z]{2}/i; 
  return postcodeRegEx.test(p); 
}
</script>
<script async defer type="text/javascript" id="cookieinfo" src="//cookieinfoscript.com/js/cookieinfo.min.js" data-bg="#0072BB" data-fg="#FFFFFF" data-link="#FFFFFF" data-cookie="CarishTCforCookies" data-text-align="left" data-close-text="GOT IT" data-divlinkbg="#67B500" data-linkmsg="Find out more" data-moreinfo="http://dartsinabottle.com/darts_demo/privacy-policy" data-message="This site uses cookies to ensure the best browsing experience on our website. By continuing to browse the site, you are agreeing to our use of cookies."></script>
@if($footer_code)
    {!!$footer_code->content!!}
@endif
</body>
</html>