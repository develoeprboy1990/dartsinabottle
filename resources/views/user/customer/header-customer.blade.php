<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 logo hidden-xs">
                <a href="{{url($home_page_url_boot->url)}}"><img src="{{asset('assets/website/images/4d-803x142.png')}}"
                        alt="logo" class="img-responsive" ></a>
            </div>
            <div class="col-sm-8">
                <nav class="navbar">
                    <div class="navbar-header visible-xs">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{{url($home_page_url_boot->url)}}"><img
                                src="{{url('public/uploads/logo_main.png')}}" alt="logo" class="img-responsive" style="height: 45px;width:300px"></a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul id="main-menu" class="nav navbar-nav text-right pull-right">

                            <li id="menu-item-48" class=""><a href="{{ url('/about-us')}}">About Us</a></li>
                            <li id="menu-item-48" class=""><a href="{{ url('/faq')}}">F.A.Q</a></li>
                            @if(Auth::check())
                            <li id="menu-item-48" class=""><a href="{{ url('logout')}}">Logout</a></li>
                        <!--     <li id="menu-item-48" class="my-darts-btn-bg" style="background-color: #ffe161 !important;
border-color: #ffe161 !important;
color: #614f00 !important;
box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2);
border-radius: 4px;"><a href="{{url('dashboard')}}" class="btn my-darts-btn pull-right" style="background-color: #ffe161 !important;
border-color: #ffe161 !important;
color: #614f00 !important;">MY DARTS</a></li> -->
                            @else
                            <li id="menu-item-48" class=""><a href="{{ url('login')}}">Login</a></li>                            
                            @endif
                           <!--  <li id="menu-item-48" class=""><a href="{{ url('/')}}">Rules</a></li>
                            <li id="menu-item-48" class=""><a href="{{ url('/')}}">Faq</a></li>
                            <li id="menu-item-48" class=""><a href="{{ url('/')}}">Contact Us</a></li> -->
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>