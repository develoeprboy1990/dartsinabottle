<div class="left_col scroll-view">
    <input type="hidden" id="site_url"  value="{{ url('') }}">
    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <h3>{{@$user_boot->first_name." ".@$user_boot->last_name}}</h3>
      <ul class="nav side-menu">
        <li><a href="{{url('dashboard')}}"><i class="fa fa-home"></i> My Darts</a></li>
        <li><a href="{{url('lent-darts')}}"><i class="fa fa-bar-chart-o"></i> Lent Darts</a></li>
        <li><a href="{{url('current-darts')}}"><i class="fa fa-bar-chart-o"></i> Current Darts</a></li>
        <li><a href="{{url('borrowed-darts')}}"><i class="fa fa-bar-chart-o"></i> Borrowed Darts</a></li>
        <li><a href="{{url('orders/my-subscriptions')}}"><i class="fa fa-list"></i> My Subscriptions</a></li>
        <li><a href="{{url('update-paypal-email')}}"><i class="fa fa-key"></i> Update PayPal Email</a></li>
        <li><a href="{{url('change-password')}}"><i class="fa fa-key"></i> Change Password</a></li>
      </ul>
    </div>
    </div>
<!-- /sidebar menu -->
</div>