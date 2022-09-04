@extends('user.admin.admin-layout')
@section('title','Dashboard')
@section('content')



      <!-- page content -->
      <div class="right_col" role="main">

        <!-- top tiles -->
        <div class="row tile_count">
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Active Users</span>
              <div class="count">{{$active_users}}</div>
              <!-- <span class="count_bottom"><i class="green">4% </i> From last Week</span> -->
            </div>
          </div>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-clock-o"></i> Unshipped Orders</span>
              <div class="count">{{$pending_shipments}}</div>
              <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span> -->
            </div>
          </div>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Shipped Orders</span>
              <div class="count green">{{$shipped_orders}}</div>
              <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> -->
            </div>
          </div>
<!--           <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Credit Card Order</span>
              <div class="count">4,567</div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
            </div>
          </div>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
              <div class="count">2,315</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
          </div>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
              <div class="count">7,325</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
          </div>
 -->
        </div>

        <br />

       


       

        

        <!-- footer content -->
        {{-- @include('user.admin.footer') --}}
        
        <!-- /footer content -->
        
      </div>
      <!-- /page content -->

@endsection