@extends('user.customer.customer-layout')
@section('title','My Darts')
@section('content')
{{-- Header Content --}}
@include('user.customer.header-customer')
{{-- Header Content End  --}}
<div class="wrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <div class="x_panel">
          <div class="x_title">
            <h2>My Darts</h2>
            <div class="clearfix"></div>
          </div>
          @if(Session::has('successmessage'))
          <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            {{Session::get('successmessage')}}
          </div>
          @endif
        </div>
        <div class="x_content x_cont">          
          <div class="row tile_count d-none">
            <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 ">
              <a href="{{url('lent-darts')}}">
                <div class="right">
                  <div class="count"><img src="{{url('public/uploads/Lent-Darts.png')}}" alt="logo" class="img-responsive" ></div>
                  <div class="count_bottom" style="text-align:center;">Lent Darts</div>
                </div>
              </a>
            </div>
            <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 ">
              <a href="{{url('current-darts')}}">
                <div class="right">
                  <div class="count"><img src="{{url('public/uploads/Current-Darts.png')}}" alt="logo" class="img-responsive" ></div>
                  <div class="count_bottom" style="text-align:center;">Current Darts</div>
                </div>
              </a>
            </div>
            <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 ">
              <a href="{{url('borrowed-darts')}}">
                <div class="right">
                  <div class="count"><img src="{{url('public/uploads/Borrowed-Darts.png')}}" alt="logo" class="img-responsive" ></div>
                  <div class="count_bottom" style="text-align:center;">Borrowed Darts</div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 left_col">
        @include('user.customer.left-customer')
      </div>
    </div>
  </div>
</div>
{{--  loader --}}
<div class="modal fade" id="waiting_modal" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">
        <p style="text-align:center;"><img src="{{url('public/uploads/gif/waiting.gif')}}"></p>
      </div>        
    </div>
  </div>
</div>
{{-- Footer Content --}}
@include('user.customer.footer-customer')
{{-- Footer Content End  --}}
@endsection
@section('javascript')
@endsection