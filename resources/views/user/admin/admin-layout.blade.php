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

  <!-- new style added so that it will include all the libraries necessary -->
 <!--  <link href="{{asset('assets/admin/css/new_style.css')}}" rel="stylesheet" type="text/css"> -->

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

  <link href="{{asset('assets/jquery-ui.css')}}" rel="stylesheet" type="text/css" />
 

  <link href="{{asset('assets/sweetalert.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
  <link type="text/css" rel="stylesheet" href="{{asset('assets/jquery-te-1.4.0.css')}}" charset="utf-8" />
  
  <link href="{{asset('assets/admin/css/admin_style.css')}}" rel="stylesheet" type="text/css" />


  {{-- <link href="{{asset('assets/customer/css/style.css')}}" rel="stylesheet" type="text/css"> --}}



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

          <div class="navbar nav_title" style="border: 0;">
            <input type="hidden" id="site_url"  value="{{ url('') }}">
            <a href="{{url($home_page_url_boot->url)}}" class="site_title"><img src="{{url('public/uploads/logo_main.png')}}" style="width:200px;height: 40px;" ></a>
          </div>
          <div class="clearfix"></div>

          <!-- menu prile quick info -->
          <div class="profile">
            <div class="profile_pic">
              <img src="{{asset('assets/images/img.jpg')}}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2>Admin</h2>
            </div>
          </div>
          <!-- /menu prile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
              <h3>Admin</h3>
              <ul class="nav side-menu">
                <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
        
                <li><a><i class="fa fa-desktop"></i> Darts Management <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="{{url('admin/products')}}">Darts</a></li>
                    <li><a href="{{url('admin/customer-packages')}}">Packages</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-table"></i> Customers <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="{{url('admin/customers/pending')}}">Pending Email Customers</a></li>
                    <li><a href="{{url('admin/customers/address-pending')}}">Pending Address Customers</a></li>
                    <li><a href="{{url('admin/customers/payment-pending')}}">Pending Payment Customers</a></li>
                    <li><a href="{{url('admin/customers/active')}}">Active Customers</a></li>
                    <li><a href="{{url('admin/customers/suspended')}}">Suspended Customers</a></li>
                  </ul>
                </li>
                 <li><a><i class="fa fa-edit"></i> Options <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="{{url('admin/role')}}">Role Management</a></li>
                    <li><a href="{{url('admin/system-user')}}">System User</a></li>
                    <li><a href="{{url('admin/payment-types')}}">Payment Types</a></li>
                    <li><a href="{{url('admin/customer-groups')}}">Customer Groups</a></li>
                  </ul>
                </li>


                <li><a><i class="fa fa-bar-chart-o"></i> Subscriptions <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="{{url('admin/orders/pending')}}">Pending</a></li>
                    <li><a href="{{url('admin/orders/pending-shipment')}}">Pending Shipment</a></li>
                    <li><a href="{{url('admin/orders/shipped')}}">Shipped</a></li>
                    <li><a href="{{url('admin/orders/cancelled')}}">Cancelled</a></li>
                  </ul>
                </li>

                <li><a><i class="fa fa-edit"></i> Settings <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <!-- <li><a href="{{url('admin/home-page-url')}}">Set Home Page</a></li> -->
                    <li><a href="{{url('admin/content')}}">Contents</a>
                    </li>
                    
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
            <a href="{{url('admin/logout')}}" data-toggle="tooltip" data-placement="top" title="Logout">

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
                  <img src="{{asset('assets/images/img.jpg')}}" alt="">Admin
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                  <li><a href="{{url('admin/dashboard')}}">  Dashboard</a>
                  </li>

                  <li>
                    <a href="{{url('admin/change-password')}}">
                      <span>Change Password</span>
                    </a>
                  </li>
                  
                  <li><a href="{{url('admin/logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </li>
                </ul>
              </li>
              {{-- Inbox li end  --}}

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

  <!-- gauge js -->
  {{-- <script type="text/javascript" src="{{asset('assets/js/gauge/gauge.min.js')}}"></script> --}}
  {{-- <script type="text/javascript" src="{{asset('assets/js/gauge/gauge_demo.js')}}"></script> --}}
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
  {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
  <script type="text/javascript" src="{{asset('assets/jquery-te-1.4.0.min.js')}}"></script>
  <script src="{{asset('assets/jquery-ui.js')}}"></script>
  <script src="{{asset('assets/admin/js/admin_validate.js')}}"></script>
  @yield('my_javascript')
  {{-- <script src="{{asset('assets/customer/js/customer_validate.js')}}"></script> --}}


  <!-- flot js -->
  <!--[if lte IE 8]><script type="text/javascript" src="assets/js/excanvas.min.js"></script><![endif]-->
 {{--  <script type="text/javascript" src="{{asset('assets/js/flot/jquery.flot.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/flot/jquery.flot.pie.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/flot/jquery.flot.orderBars.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/flot/jquery.flot.time.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/flot/date.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/flot/jquery.flot.spline.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/flot/jquery.flot.stack.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/flot/curvedLines.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/flot/jquery.flot.resize.js')}}"></script> --}}
  {{-- <script>
    $(document).ready(function() {
      // [17, 74, 6, 39, 20, 85, 7]
      //[82, 23, 66, 9, 99, 6, 2]
      var data1 = [
        [gd(2012, 1, 1), 17],
        [gd(2012, 1, 2), 74],
        [gd(2012, 1, 3), 6],
        [gd(2012, 1, 4), 39],
        [gd(2012, 1, 5), 20],
        [gd(2012, 1, 6), 85],
        [gd(2012, 1, 7), 7]
      ];

      var data2 = [
        [gd(2012, 1, 1), 82],
        [gd(2012, 1, 2), 23],
        [gd(2012, 1, 3), 66],
        [gd(2012, 1, 4), 9],
        [gd(2012, 1, 5), 119],
        [gd(2012, 1, 6), 6],
        [gd(2012, 1, 7), 9]
      ];
      $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
        data1, data2
      ], {
        series: {
          lines: {
            show: false,
            fill: true
          },
          splines: {
            show: true,
            tension: 0.4,
            lineWidth: 1,
            fill: 0.4
          },
          points: {
            radius: 0,
            show: true
          },
          shadowSize: 2
        },
        grid: {
          verticalLines: true,
          hoverable: true,
          clickable: true,
          tickColor: "#d5d5d5",
          borderWidth: 1,
          color: '#fff'
        },
        colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
        xaxis: {
          tickColor: "rgba(51, 51, 51, 0.06)",
          mode: "time",
          tickSize: [1, "day"],
          //tickLength: 10,
          axisLabel: "Date",
          axisLabelUseCanvas: true,
          axisLabelFontSizePixels: 12,
          axisLabelFontFamily: 'Verdana, Arial',
          axisLabelPadding: 10
            //mode: "time", timeformat: "%m/%d/%y", minTickSize: [1, "day"]
        },
        yaxis: {
          ticks: 8,
          tickColor: "rgba(51, 51, 51, 0.06)",
        },
        tooltip: false
      });

      function gd(year, month, day) {
        return new Date(year, month - 1, day).getTime();
      }
    });
  </script> --}}

  <!-- worldmap -->
 {{--  <script type="text/javascript" src="{{asset('assets/js/maps/jquery-jvectormap-2.0.3.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/maps/gdp-data.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/maps/jquery-jvectormap-world-mill-en.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/maps/jquery-jvectormap-us-aea-en.js')}}"></script> --}}
  <!-- pace -->
  <script src="{{asset('assets/js/pace/pace.min.js')}}"></script>
  {{-- <script>
    $(function() {
      $('#world-map-gdp').vectorMap({
        map: 'world_mill_en',
        backgroundColor: 'transparent',
        zoomOnScroll: false,
        series: {
          regions: [{
            values: gdpData,
            scale: ['#E6F2F0', '#149B7E'],
            normalizeFunction: 'polynomial'
          }]
        },
        onRegionTipShow: function(e, el, code) {
          el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
        }
      });
    });
  </script> --}}
  <!-- skycons -->
  <script src="{{asset('assets/js/skycons/skycons.min.js')}}"></script>
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

  <!-- dashbord linegraph -->
  {{-- <script>
    Chart.defaults.global.legend = {
      enabled: false
    };

    var data = {
      labels: [
        "Symbian",
        "Blackberry",
        "Other",
        "Android",
        "IOS"
      ],
      datasets: [{
        data: [15, 20, 30, 10, 30],
        backgroundColor: [
          "#BDC3C7",
          "#9B59B6",
          "#455C73",
          "#26B99A",
          "#3498DB"
        ],
        hoverBackgroundColor: [
          "#CFD4D8",
          "#B370CF",
          "#34495E",
          "#36CAAB",
          "#49A9EA"
        ]

      }]
    };

    var canvasDoughnut = new Chart(document.getElementById("canvas1"), {
      type: 'doughnut',
      tooltipFillColor: "rgba(51, 51, 51, 0.55)",
      data: data
    });
  </script> --}}
  <!-- /dashbord linegraph -->
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
