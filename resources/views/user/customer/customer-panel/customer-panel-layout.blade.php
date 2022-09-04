<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title> @yield('title') </title>

  <!-- Bootstrap core CSS -->

  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">

  <link href="{{asset('assets/fonts/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css/animate.min.css')}}" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
  {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css/maps/jquery-jvectormap-2.0.3.css')}}" /> --}}
  <link href="{{asset('assets/css/icheck/flat/green.css ')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/floatexamples.css ')}}" rel="stylesheet" type="text/css" />
  {{-- Data Tables Outside --}}
  
   <link href="{{asset('assets/js/datatables/jquery.dataTables.min.css ')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/js/datatables/buttons.bootstrap.min.css ')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/js/datatables/fixedHeader.bootstrap.min.css ')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/js/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/js/datatables/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
{{-- Datatables end --}}

  <link href="{{asset('assets/sweetalert.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
  
  <link type="text/css" rel="stylesheet" href="{{asset('assets/jquery-te-1.4.0.css')}}" charset="utf-8" />
  

  <link href="{{asset('assets/customer/css/customer-panel.css ')}}" rel="stylesheet" type="text/css" />


  <!-- <link href="{{asset('assets/customer/css/style.css')}}" rel="stylesheet" type="text/css"> -->



  <script src="{{asset('assets/js/jquery.min.js')}}"></script>
  <script src="{{asset('assets/js/nprogress.js')}}"></script>

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>


<body class="nav-md">

  <div class="container body">


    <div class="main_container">

      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <input type="hidden" id="site_url"  value="{{ url('') }}">
          <div class="navbar nav_title" style="border: 0;">
            <a href="{{url($home_page_url_boot->url)}}" class="site_title"><img src="{{url('public/uploads/logo_main.png')}}" style="width:200px;height: 40px;" ></a>
          </div>
          <div class="clearfix"></div>

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
              <ul class="nav side-menu">

                <li><a href="{{url('dashboard')}}"><i class="fa fa-home"></i> My Darts</a></li>
                <li><a href="{{url('lent-darts')}}"><i class="fa fa-bar-chart-o"></i> Lent Darts</a></li>
                <li><a href="{{url('current-darts')}}"><i class="fa fa-bar-chart-o"></i> Current Darts</a></li>
                <li><a href="{{url('borrowed-darts')}}"><i class="fa fa-bar-chart-o"></i> Borrowed Darts</a></li>
              
                <li><a><i class="fa fa-bar-chart-o"></i>My Subscriptions <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="{{url('orders/my-subscriptions')}}">Subscriptions</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a href="{{url('logout')}}" data-toggle="tooltip" data-placement="top" title="Logout">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <nav class="" role="navigation">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="{{asset('assets/images/img.jpg')}}" alt="">{{@$user_boot->first_name." ".@$user_boot->last_name}}
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                  <li><a href="{{('dashboard')}}">Dashboard</a>
                  </li>
                  <li>
                    <a href="{{('change-password')}}">
                      <span>Change Password</span>
                    </a>
                  </li>
                 <li><a href="{{url('logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </li>
                </ul>
              </li>

              {{-- Inbox li --}}
                {{--<li role="presentation" class="dropdown">
                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-envelope-o"></i>
                  <span class="badge bg-green">{{$inbox_counter}}</span>
                </a>
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                  @if($inbox_for_top)
                  
                      @foreach($inbox_for_top as $inbox_data)
                      <li>
                        <a href="{{url('inbox')}}">
                          <span class="image">
                                            <img src="{{url('assets/images/img.jpg')}}" alt="Profile Image" />
                                        </span>
                          <span>
                                            <span>Admin</span>
                          <span class="time">{{$inbox_data['created_at']}}</span>
                          </span>
                          <span class="message">
                                            {!!$inbox_data['message_body']!!}
                                        </span>
                        </a>
                      </li>
                     @endforeach 
                  
                  @else
                  <li>
                  <span>No new message</span>  
                  </li>
                  @endif   

                      <li>
                    <div class="text-center">
                      <a href="{{url('inbox')}}">
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                      </a>
                    </div>
                  </li>

                </ul>
              </li>--}}
              {{-- Inbox li End --}}


            </ul>
          </nav>
        </div>

      </div>
      <!-- /top navigation -->

        {{-- Page Content Start --}}
        @yield('content')
        {{-- Page Content Ended --}}
    </div>

  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>

  <!-- bootstrap progress js -->
  <script src="{{asset('assets/js/progressbar/bootstrap-progressbar.min.js')}}"></script>
  <script src="{{asset('assets/js/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <!-- icheck -->
  <script src="{{asset('assets/js/icheck/icheck.min.js')}}"></script>
  <!-- daterangepicker -->
  <script type="text/javascript" src="{{asset('assets/js/moment/moment.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/datepicker/daterangepicker.js')}}"></script>
  <!-- chart js -->
  {{-- <script src="{{asset('assets/js/chartjs/chart.min.js')}}"></script> --}}

  <script src="{{asset('assets/js/custom.js')}}"></script>
  
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

  <script src="{{asset('assets/sweetalert.min.js')}}"></script>
  <script src="{{asset('assets/jscolor.min.js')}}"></script>
  <script src="{{asset('assets/bootstrap-select.min.js')}}"></script>
  
  <script type="text/javascript" src="{{asset('assets/jquery-te-1.4.0.min.js')}}"></script>
  <script src="{{asset('assets/customer/js/customer_panel_validate.js')}}"></script>



  <!-- worldmap -->
 {{--  <script type="text/javascript" src="{{asset('assets/js/maps/jquery-jvectormap-2.0.3.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/maps/gdp-data.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/maps/jquery-jvectormap-world-mill-en.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/maps/jquery-jvectormap-us-aea-en.js')}}"></script> --}}
  <!-- pace -->
  <script src="{{asset('assets/js/pace/pace.min.js')}}"></script>
  <script src="{{asset('assets/js/skycons/skycons.min.js')}}"></script>
  <script src="{{asset('assets/customer/js/customer_validate.js')}}"></script>
  <script>
    var icons = new Skycons({
        "color": "#73879C"
      }),
      list = [
        "clear-day", "clear-night", "partly-cloudy-day",
        "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
        "fog"
      ],
      i;

    for (i = list.length; i--;)
      icons.set(list[i], list[i]);

    icons.play();
  </script>

  <!-- datepicker -->
  <script type="text/javascript">
    $(document).ready(function() {

      var cb = function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
      }

      var optionSet1 = {
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2015',
        dateLimit: {
          days: 60
        },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        buttonClasses: ['btn btn-default'],
        applyClass: 'btn-small btn-primary',
        cancelClass: 'btn-small',
        format: 'MM/DD/YYYY',
        separator: ' to ',
        locale: {
          applyLabel: 'Submit',
          cancelLabel: 'Clear',
          fromLabel: 'From',
          toLabel: 'To',
          customRangeLabel: 'Custom',
          daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
          monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          firstDay: 1
        }
      };
      $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
      $('#reportrange').daterangepicker(optionSet1, cb);
      $('#reportrange').on('show.daterangepicker', function() {
        console.log("show event fired");
      });
      $('#reportrange').on('hide.daterangepicker', function() {
        console.log("hide event fired");
      });
      $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
      });
      $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
        console.log("cancel event fired");
      });
      $('#options1').click(function() {
        $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
      });
      $('#options2').click(function() {
        $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
      });
      $('#destroy').click(function() {
        $('#reportrange').data('daterangepicker').remove();
      });
    });
  </script>
  <script>
    NProgress.done();
  </script>
  <!-- /datepicker -->
  <!-- /footer content -->
</body>

</html>
