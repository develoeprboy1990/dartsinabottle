<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
<link rel="shortcut icon" href="assets/website/images/4d-803x142.png" type="image/x-icon">
<meta name="description" content="">
<title>@yield('title')</title>

<!--Larvel Style-->
<link href="{{asset('assets/customer/assets/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/customer/assets/css/fontawesome.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/sweetalert.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/customer/css/style.css')}}" rel="stylesheet" type="text/css"> 
<link href="{{asset('assets/customer/assets/css/customer-style.css')}}" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<!--Larvel Style-->

<link rel="stylesheet" href="{{asset('assets/website/web/assets/mobirise-icons2/mobirise2.css')}}">
<link rel="stylesheet" href="{{asset('assets/website/web/assets/mobirise-icons-bold/mobirise-icons-bold.css')}}">
<link rel="stylesheet" href="{{asset('assets/website/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/website/bootstrap/css/bootstrap-grid.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/website/bootstrap/css/bootstrap-reboot.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/website/dropdown/css/style.css')}}">
<link rel="stylesheet" href="{{asset('assets/website/socicon/css/styles.css')}}">
<link rel="stylesheet" href="{{asset('assets/website/theme/css/style.css')}}">
<link rel="preload" href="https://fonts.googleapis.com/css?family=JetBrains+Mono:100,200,300,400,500,600,700,800,100i,200i,300i,400i,500i,600i,700i,800i&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=JetBrains+Mono:100,200,300,400,500,600,700,800,100i,200i,300i,400i,500i,600i,700i,800i&display=swap"></noscript>
<link rel="preload" as="style" href="{{asset('assets/website/mobirise/css/mbr-additional.css')}}">
<link rel="stylesheet" href="{{asset('assets/website/mobirise/css/mbr-additional.css')}}" type="text/css">


@if($analytics_code)
{!!$analytics_code->content!!}
@endif
</head>
<body>  
<input type="hidden" id="site_url"  value="{{ url('') }}">

@if($body_code)
{!!$body_code->content!!}
@endif
<section data-bs-version="5.1" class="menu menu1 cid-sBTUWB1imE" once="menu" id="menu1-1">
    <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
        <div class="container">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="{{url($home_page_url_boot->url)}}">
                        <img src="{{asset('assets/website/images/4d-803x142.png')}}" alt="" style="height: 4.6rem;">
                    </a>
                </span>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse" data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                    <li class="nav-item"><a class="nav-link link text-white display-7" href="{{ url('/')}}">Home</a></li>
                    @if(Auth::check()) 
                    <li class="nav-item"><a class="nav-link link text-white display-7" href="{{ url('dashboard')}}">My Account</a></li>
                    <li class="nav-item"><a class="nav-link link text-white display-7" href="{{ url('logout')}}">LOGOUT</a></li>
                    @else
                    <li class="nav-item"><a class="nav-link link text-white display-7" href="{{ url('login')}}">Login</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link link text-white display-7" href="#">Contact Us</a></li>
                </ul>                
                <div class="navbar-buttons mbr-section-btn"><a class="btn btn-warning display-4" href="{{ url('shop')}}">GET STARTED</a></div>
            </div>
        </div>
    </nav>
</section>
<section data-bs-version="5.1" class="header1 cid-sBTUWbBvMs" id="header01-0">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1600 900" width="1600" height="900" class="lottie__svg" preserveAspectRatio="none">
        <defs>
            <clipPath id="__lottie_element_56">
                <rect width="1600" height="900" x="0" y="0"></rect>
            </clipPath>
        </defs>
        <g clip-path="url(#__lottie_element_56)">
            <g transform="matrix(1,0,0,1,1389.843017578125,-225.20799255371094)" opacity="1" style="display: block;">
                <g opacity="1" transform="matrix(1,0,0,1,0,0)">
                    <path fill="rgb(255,237,168)" fill-opacity="1" d=" M-419.624755859375,415.6952209472656 C17.504684448242188,354.5908203125 503.072998046875,568.8040161132812 708.1630249023438,382.1440124511719 C913.2529907226562,195.4739990234375 407.1830139160156,25.333999633789062 407.1830139160156,-114.36599731445312 C407.1830139160156,-283.6960144042969 431.1730041503906,-345.0660095214844 316.9930114746094,-426.3559875488281 C146.18299865722656,-547.9760131835938 69.49299621582031,-405.5559997558594 -319.84698486328125,-361.5459899902344 C-641.4569702148438,-325.1860046386719 -1008.0747680664062,-305.5247802734375 -870.084716796875,-3.934781312942505 C-732.0947265625,297.65521240234375 -740.6259765625,460.5013732910156 -419.624755859375,415.6952209472656z">
                    </path>
                </g>
            </g>
        </g>
    </svg>
    @yield('content')
</section>
<section data-bs-version="5.1" class="scial1 cid-sBUg8EYY1q" id="social01-g">
    <svg class="svg-top" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1600 40" 
    style="enable-background:new 0 0 1600 40;" preserveAspectRatio="none">
        <style type="text/css">
            .st0 
        </style>
        <path class="st0" d="M-1,15.7c200.1,0,200.7,13.8,400.9,13.8C600,29.5,600.4,9.3,800.5,9.3S998.8,36.8,1199,36.8
  s201.9-21.1,402-21.1v24.1L-1,40V15.7z"></path>
    </svg>

    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="text-content col-12 col-md-12 col-lg-12">
                <h2 class="mbr-section-title mbr-fonts-style mb-3 display-2">
                    <strong>Follow Us</strong>
                </h2>
                <p class="mbr-text mbr-fonts-style mb-3 display-7">Follow us on the social media platforms below. We love hearing what you received and how you played with them!</p>
            </div>
            <div class="icons d-flex align-items-center justify-content-center col-12 col-md-12 mt-md-0 mt-2 flex-wrap">
                <a href="https://twitter.com/mobirise" target="_blank">
                    <span class="socicon-twitter socicon mbr-iconfont mbr-iconfont-social"></span>
                </a>
                <a href="https://www.facebook.com/pages/Mobirise/1616226671953247" target="_blank">
                    <span class="socicon-facebook socicon mbr-iconfont mbr-iconfont-social"></span>
                </a>
                <a href="https://www.youtube.com/c/mobirise" target="_blank">
                    <span class="socicon-youtube socicon mbr-iconfont mbr-iconfont-social"></span>
                </a>
                <a href="https://instagram.com/mobirise" target="_blank">
                    <span class="socicon-instagram socicon mbr-iconfont mbr-iconfont-social"></span>
                </a>
                <a href="https://www.behance.net/Mobirise" target="_blank">
                    <span class="socicon-behance socicon mbr-iconfont mbr-iconfont-social"></span>
                </a>
                <a href="https://vimeo.com/mobirise" target="_blank">
                    <span class="mbr-iconfont mbr-iconfont-social socicon-vimeo socicon"></span>
                </a>
            </div>
        </div>
    </div>
</section>
<section data-bs-version="5.1" class="footer1 cid-sBUgaYn7WO" once="footers" id="footer01-i">
    <svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1600 40" style="enable-background:new 0 0 1600 40;" preserveAspectRatio="none">
        <style type="text/css">
            .st0 
        </style>
        <path class="st0" d="M-1,15.7c200.1,0,200.7,13.8,400.9,13.8C600,29.5,600.4,9.3,800.5,9.3S998.8,36.8,1199,36.8
  s201.9-21.1,402-21.1v24.1L-1,40V15.7z"></path>
    </svg>
    <div class="container">
        <div class="row mbr-white">
            <div class="col-12 col-md-4 col-lg-3">
                
                <ul class="list mbr-fonts-style display-4">
                    <li class="mbr-text item-wrap">2915 Chenoweth Drive</li>
                    <li class="mbr-text item-wrap">Columbia 38401&nbsp;</li>
                    <li class="mbr-text item-wrap">Tennessee</li>
                    <li class="mbr-text item-wrap">mail@yoursite.com</li>
                </ul>
            </div>
            <div class="col-12 col-md-3 col-lg-3">
                
                <ul class="list mbr-fonts-style display-4">
                    <li class="mbr-text item-wrap">Facebook</li>
                    <li class="mbr-text item-wrap">Instagram</li>
                    <li class="mbr-text item-wrap">Twitter</li>
                </ul>
            </div>
            <div class="col-12 col-md-3 col-lg-3">
                
                <ul class="list mbr-fonts-style display-4">
                    <li class="mbr-text item-wrap">Subscribe to Newsletter</li>
                </ul>
            </div>
            <div class="col-12 col-md-2 col-lg-3">
                
                <ul class="list align-right mbr-fonts-style display-4">
                    <li class="mbr-text item-wrap">Home</li>
                    <li class="mbr-text item-wrap">About</li>
                    <li class="mbr-text item-wrap">Contacts</li>
                </ul>
            </div>
            
        </div>
    </div>
</section>



 
<!-- Larvel Scripts--> 
<script src="{{asset('assets/customer/assets/js/jquery.js')}}"></script> 
<script src="{{asset('assets/customer/assets/js/bootstrap.min.js')}}"></script> 
<script src="{{asset('assets/jquery.validate.min.js')}}"></script> 
<script src="{{asset('assets/additional-methods.min.js')}}"></script> 
<script src="{{asset('assets/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/bootstrap-select.min.js')}}"></script> 
<script src="{{asset('assets/jscolor.min.js')}}"></script>
<!-- Larvel Scripts--> 


<script src="{{asset('assets/website/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/website/smoothscroll/smooth-scroll.js')}}"></script>
<script src="{{asset('assets/website/ytplayer/index.js')}}"></script>
<script src="{{asset('assets/website/dropdown/js/navbar-dropdown.js')}}"></script>
<script src="{{asset('assets/website/sociallikes/social-likes.js')}}"></script>
<script src="{{asset('assets/website/theme/js/script.js')}}"></script>

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
</script>
@if($footer_code)
    {!!$footer_code->content!!}
@endif
</body>
</html>