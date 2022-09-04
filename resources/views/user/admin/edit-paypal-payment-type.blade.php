@extends('user.admin.admin-layout')
@section('title','Edit Payment Type')
@section('content')
  <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>Edit Payment Type</h3>
            </div>             
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                {{-- <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                </div> --}}
              </div>
            </div>
          </div>

          <div class="clearfix"></div>
          @if(Session::has('successmessage'))
                <div class="alert alert-success alert-dismissable">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
               {{Session::get('successmessage')}}
                </div>
            @endif

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Test Account</h2>                
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  {{ Form::open(['url' => 'admin/payment-types/'.$payment_type->id, 'method' => 'put', 'class' => 'form-horizontal form-label-left', 'id' => 'edit_payment_type_form']) }}
                    {{csrf_field()}}
                    <input type="hidden" name="payment_account_type" value="test" >

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="test_email"  name="test_email" required="required" class="form-control col-md-7 col-xs-12" value={{$payment_type->test_email}}>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Client ID<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="login_id_test"  name="login_id_test" required="required" class="form-control col-md-7 col-xs-12" value={{$payment_type->login_id_test}}>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SECRET<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="transaction_key_test"  name="transaction_key_test" required="required" class="form-control col-md-7 col-xs-12" value={{$payment_type->transaction_key_test}}>
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        {{-- <button type="submit" class="btn btn-primary">Cancel</button> --}}
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            </div>

        {{-- New Code Started  --}}
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Live Account</h2>                
                  <div class="clearfix"></div>
                  </div>
                    <div class="x_content">  
                        <div class="col-md-12 col-sm-12 col-xs-12">                           
                               {{ Form::open(['url' => 'admin/payment-types/'.$payment_type->id, 'method' => 'put', 'class' => 'form-horizontal form-label-left', 'id' => 'edit_payment_type_form']) }} 
                                {{csrf_field()}}                               
                                <input type="hidden" name="payment_account_type" value="live" >   
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="live_email"  name="live_email" required="required" class="form-control col-md-7 col-xs-12" value={{$payment_type->live_email}}>
                                  </div>
                                </div>                            
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="api-key">Client ID<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="login_id_live "  name="login_id_live" required="required" class="form-control col-md-7 col-xs-12" value="{{$payment_type->login_id_live}}">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="secret-key">SECRET<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="transaction_key_live" name="transaction_key_live"  required="required" class="form-control col-md-7 col-xs-12" value="{{$payment_type->transaction_key_live}}">
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

           <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Account Type</h2>                
                  <div class="clearfix"></div>
                  </div>
                    <div class="x_content">                       
                        <div class="col-md-4 col-sm-12 col-xs-12">                          
                              <br />                               
                               <form  method="post" action="{{url('admin/choose-account-type-process')}}" data-parsley-validate class="form-label-left">
                                {{csrf_field()}}
                                <input type="hidden" name="payment_type_id" value="{{$payment_type->id}}">                               
                                <p><strong>Choose Account</strong></p>                                
                                @php
                                if($payment_type->active_account == "test")
                                {
                                  $test_checked="checked";
                                } 
                                elseif ($payment_type->active_account == "live") 
                                {
                                  $live_checked="checked";                                   
                                } 
                                @endphp
                                <div class="radio">
                                  <label><input type="radio" name="active_account" value="test" {{@$test_checked}}>Test</label>
                                </div>
                                <div class="radio">
                                  <label><input type="radio" name="active_account" value="live" {{@$live_checked}}>Live</label>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    {{-- <button type="submit" class="btn btn-primary">Cancel</button> --}}
                                    <button type="submit" class="btn btn-success">Submit</button>
                                  </div>
                                </div>
                              </form>
                        </div>
                    </div>
              </div>
            </div>
          </div>
        {{-- New Code Ended  --}}       
        </div>
        <!-- /page content -->
        <!-- footer content -->
        <!-- /footer content -->
      </div>
    @endsection