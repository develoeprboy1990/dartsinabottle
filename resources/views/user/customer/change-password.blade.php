@extends('user.customer.customer-layout')
@section('title','Change Password')
@section('content')
{{-- Header Content --}}
@include('user.customer.header-customer')
{{-- Header Content End  --}}
<div class="wrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-3 left_col">
        @include('user.customer.left-customer')
      </div>
      <div class="col-md-9">
       <div class="x_panel">
        <div class="x_title">
          <h2>Change Your Existing Password</h2>
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
                  <span style="color:red;" id="show_password_msg"></span>
                  <form id="change_password_form" method="post" action="{{url('change-password')}}"  data-parsley-validate class="form-horizontal form-label-left">
                    {{csrf_field()}}
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                   
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Current Password <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" id="current_password"  name="current_password" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> New Password <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" id="new_password"  name="new_password" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Confirm Password <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" id="confirm_password"  name="confirm_password" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    



                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </div>

                  </form>
                
        </div>
      </div>
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