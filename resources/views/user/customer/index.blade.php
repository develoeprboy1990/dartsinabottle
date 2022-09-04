<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/website/images/4d-803x142.png" type="image/x-icon">
    <meta name="description" content="">  
    <title>Home</title>
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
    </head>
    <body>  
        <!--Header-->
        <section data-bs-version="5.1" class="menu menu1 cid-sBTUWB1imE" once="menu" id="menu1-1">
            <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
                <div class="container">
                    <div class="navbar-brand">
                        <span class="navbar-logo">
                            <a href="#">
                                <img src="{{asset('assets/website/images/4d-803x142.png')}}" alt="Dartsinabottle" style="height:4rem;width: 13.6rem;">
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
                            <!-- <li class="nav-item"><a class="nav-link link text-white display-7" href="{{ url('/')}}">Home</a></li> -->
                            <li class="nav-item"><a class="nav-link link text-white display-7" href="{{ url('faq')}}">F.A.Q</a></li>
                            @if(Auth::check()) 
                            <li class="nav-item"><a class="nav-link link text-white display-7" href="{{ url('logout')}}">Logout</a></li>
                            @else
                            <li class="nav-item"><a class="nav-link link text-white display-7" href="{{ url('login')}}">Login</a></li>
                            @endif
                            <!-- <li class="nav-item"><a class="nav-link link text-white display-7" href="#">Contact Us</a></li> -->
                        </ul>
                        @if(Auth::check()) 
                        <div class="navbar-buttons mbr-section-btn"><a class="btn btn-warning display-4" href="{{ url('dashboard')}}">MY DARTS</a></div>
                        @else
                        <div class="navbar-buttons mbr-section-btn"><a class="btn btn-warning display-4" href="{{ url('shop')}}">GET STARTED</a></div>
                        @endif
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
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-12 col-lg-5 m-auto">
                        <div class="image-wrapper md-pb">
                            <img class="w-100" src="{{asset('assets/website/images/4-1.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg m-auto">
                        <div class="text-wrapper align-left">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Lend and borrow darts.-->
        <section data-bs-version="5.1" class="features5 cid-sBUeZxDTz4" id="features05-2">    
            <svg class="svg-top" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1600 40" style="enable-background:new 0 0 1600 40;" preserveAspectRatio="none">
                <style type="text/css">
                    .st0 
                </style>
                <path class="st0" d="M-1,15.7c200.1,0,200.7,13.8,400.9,13.8C600,29.5,600.4,9.3,800.5,9.3S998.8,36.8,1199,36.8
        s201.9-21.1,402-21.1v24.1L-1,40V15.7z"></path>
            </svg>
            <div class="container">
                <div class="row">
                    <div class="col-12 pb-3 col-lg-9">
                        <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-1"><strong>Lend and borrow darts.</strong></h3>
                        <h5 class="mbr-section-subtitle mbr-fonts-style align-center mb-0 mt-2 display-2">Find the darts that talk to you! <div><br></div></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="card col-12 col-md-6 col-lg-3">
                        <div class="card-wrapper">
                            <div class="card-box align-center">
                                <div class="iconfont-wrapper">
                                    <span class="mbr-iconfont mbrib-target"></span>
                                </div>
                                <h5 class="card-title mbr-fonts-style display-5"><strong>BORROW</strong></h5>
                                <p class="card-text mbr-fonts-style display-7">Borrow up to 4 sets a month</p>
                            </div>
                        </div>
                    </div>
                    <div class="card col-12 col-md-6 col-lg-3">
                        <div class="card-wrapper">
                            <div class="card-box align-center">
                                <div class="iconfont-wrapper">
                                    <span class="mbr-iconfont mbrib-target"></span>
                                </div>
                                <h5 class="card-title mbr-fonts-style display-5"><strong>BUY</strong></h5>
                                <p class="card-text mbr-fonts-style display-7">Buy sets of barrels that are for sale</p>
                            </div>
                        </div>
                    </div>
                    <div class="card col-12 col-md-6 col-lg-3">
                        <div class="card-wrapper">
                            <div class="card-box align-center">
                                <div class="iconfont-wrapper">
                                    <span class="mbr-iconfont mbrib-target"></span>
                                </div>
                                <h5 class="card-title mbr-fonts-style display-5"><strong>SELL</strong></h5>
                                <p class="card-text mbr-fonts-style display-7">Sell your lent barrels</p>
                            </div>
                        </div>
                    </div>            
                </div>
            </div>
        </section>
        <!--START-->
        <section data-bs-version="5.1" class="content1 cid-sWK5gyGRNK" id="content01-0">    
            <svg class="svg-top" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1600 40" style="enable-background:new 0 0 1600 40;" preserveAspectRatio="none">
                <style type="text/css">
                    .st0 
                </style>
                <path class="st0" d="M-1,15.7c200.1,0,200.7,13.8,400.9,13.8C600,29.5,600.4,9.3,800.5,9.3S998.8,36.8,1199,36.8
        s201.9-21.1,402-21.1v24.1L-1,40V15.7z"></path>
            </svg>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-12 col-lg-5 image-wrapper m-auto">
                        <img class="w-100 md-pb" src="{{asset('assets/website/images/3d-1-998x177.png')}}" alt="">
                    </div>
                    <div class="col-12 col-md-12 col-lg m-auto">
                        <div class="text-wrapper align-left">
                            
                            @if(Auth::check()) 
                        <div class="mbr-section-btn mt-3"><a class="btn btn-lg btn-primary-outline display-2" href="{{ url('dashboard')}}">MY DARTS</a></div>
                        @else
                        <div class="mbr-section-btn mt-3"><a class="btn btn-lg btn-primary-outline display-2" href="{{ url('shop')}}">START</a></div>
                        @endif

                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--RULES OF DARTSINABOTTLE-->
        <section data-bs-version="5.1" class="timeline2 cid-sBUfR1pTVP" id="timeline02-a">
            <div class="mbr-overlay" style="opacity: 0.9; background-color: rgb(26, 68, 154);">
            </div>
            <svg class="svg-top" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1600 40" style="enable-background:new 0 0 1600 40;" preserveAspectRatio="none">
                <style type="text/css">
                    .st0 
                </style>
                <path class="st0" d="M-1,15.7c200.1,0,200.7,13.8,400.9,13.8C600,29.5,600.4,9.3,800.5,9.3S998.8,36.8,1199,36.8
        s201.9-21.1,402-21.1v24.1L-1,40V15.7z"></path>
            </svg>
            <div class="container">
                <div class="mbr-section-head">
                    <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-1"><strong>RULES OF DARTSINABOTTLE</strong></h3>
                </div>
                <div class="timelines-container mt-4">
                    <div class="row timeline-element first-separline mb-5">
                        <div class="timeline-date col-12">
                            <div class="timeline-date-wrapper">
                                <p class="mbr-timeline-date display-7">STEP 1</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="image-wrapper">
                                <img class="w-100 md-pb" src="{{asset('assets/website/images/-1.fw-1024x896.png')}}" alt="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="timeline-text-wrapper">
                                <h4 class="mbr-timeline-title mbr-fonts-style mb-0 display-2"><strong>Subscribe & Lend</strong></h4>
                                <p class="mbr-text mbr-fonts-style mt-3 mb-0 display-7">
                                    Join us and we will send you a pre-paid self-addressed envelope. Pop the set of barrels you wish to lend inside. We will add them to our system and you can view them in your 'lent darts' section.</p>  
                            </div>
                        </div>
                    </div>
                    <div class="row timeline-element first-separline mb-5">
                        <div class="timeline-date col-12">
                            <div class="timeline-date-wrapper">
                                <p class="mbr-timeline-date display-7">STEP 2</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="timeline-text-wrapper">
                                <h4 class="mbr-timeline-title mbr-fonts-style mb-0 display-2"><strong>Play and Return</strong></h4>
                                <p class="mbr-text mbr-fonts-style mt-3 mb-0 display-7">We then send your first set of barrels to try, based on the weight preferences you chose when subscribing. If you don't like what you feel, return them and recieve your next set. Easy! </p>  
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="image-wrapper">
                                <img class="w-100 md-pb" src="{{asset('assets/website/images/-1.fw.fw-1024x896.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="row timeline-element first-separline mb-5">
                        <div class="timeline-date col-12">
                            <div class="timeline-date-wrapper">
                                <p class="mbr-timeline-date display-7">STEP 3</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="image-wrapper">
                                <img class="w-100 md-pb" src="{{asset('assets/website/images/-1.fw.fww.fw-1024x896.png')}}" alt="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="timeline-text-wrapper">
                                <h4 class="mbr-timeline-title mbr-fonts-style mb-0 display-2"><strong>Buy & Sell</strong></h4>
                                <p class="mbr-text mbr-fonts-style mt-3 mb-0 display-7">You can set a price to sell your barrels for. If someone else likes them, they can purchase the barrels. It is just as easy to buy the sets you like - go to the 'current darts' section, make the purchase and keep them permanently!<br>Have lots of sets to sell? You can send in additional 'lent darts' and increase your chances of making a sale!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section data-bs-version="5.1" class="list1 cid-sBUfSVK3HR" id="list01-b">
            
            <svg class="svg-top" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1600 40" style="enable-background:new 0 0 1600 40;" preserveAspectRatio="none">
                <style type="text/css">
                    .st0 
                </style>
                <path class="st0" d="M-1,15.7c200.1,0,200.7,13.8,400.9,13.8C600,29.5,600.4,9.3,800.5,9.3S998.8,36.8,1199,36.8
        s201.9-21.1,402-21.1v24.1L-1,40V15.7z"></path>
            </svg>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="counter-container col-md-12 col-lg-12">
                        
                        <div class="mbr-text mbr-fonts-style display-7">
                            <ul>
                                <li>Never get the same set twice - we always send barrels you have not received previously</li>
                                <li>All postage costs covered by subscription (excluding additional barrels sent in)</li>
                                <li>Choose your preference based on weight. Light (12g-18g). Medium (19g-22g). Heavy (23g-36g)</li>
                                <li>Try barrels you may never have considered - they could be the darts that talk to you!</li>
                                <li>For every 50 new subscribers, we add a BRAND NEW set of barrels. You never know what you will receive on dartsinabottle.com!</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Footer-->
        <section data-bs-version="5.1" class="scial1 cid-sBUg8EYY1q" id="social01-g">
            <svg class="svg-top" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1600 40" style="enable-background:new 0 0 1600 40;" preserveAspectRatio="none">
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
                    </div>
                </div>
            </div>
        </section>
        <script src="{{asset('assets/website/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/website/smoothscroll/smooth-scroll.js')}}"></script>
        <script src="{{asset('assets/website/ytplayer/index.js')}}"></script>
        <script src="{{asset('assets/website/dropdown/js/navbar-dropdown.js')}}"></script>
        <script src="{{asset('assets/website/sociallikes/social-likes.js')}}"></script>
        <script src="{{asset('assets/website/theme/js/script.js')}}"></script>
    </body>
</html>