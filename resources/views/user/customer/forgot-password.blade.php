<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Reset Password</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<!-- Le styles -->
<link href="{{asset('assets/customer/assets/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/customer/assets/css/fontawesome.css')}}" rel="stylesheet" type="text/css">

<link href="{{asset('assets/sweetalert.min.css')}}" rel="stylesheet" type="text/css" />

<link href="{{asset('assets/customer/css/style.css')}}" rel="stylesheet" type="text/css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<style type="text/css">

.my-error-class {
    color:#FF0000;  /* red */
}  

</style>
</head>

<body>
{{-- Header Content --}}
@include('user.customer.header-customer')
{{-- Header Content End  --}}   
  <div class="wrapper">
  <div class="container">
   
    @if(Session::has('successmessage'))

    <div class="alert alert-danger alert-dismissable">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
     {{Session::get('successmessage')}}
   </div>
   @endif

    <div class="row">
      <h1 class="badges-title text-center"><em class="fa fa-user"></em> Reset your password</h1>

      <div class="col-xs-12 checkout-form-col">
        <form action="{{url('process-forgot-password')}}" method="post">
          {{csrf_field()}}
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required="true">
          </div>

          <div class="form-group">
            <label for="confirm-password">Confirm Password:</label>
            <input type="password" class="form-control" id="confirm_password" placeholder="Enter confirm password" name="confirm_password" required="true">
          </div>

          <input type="hidden" name="password_reset_token" value="{{$password_reset_token}}">
          <input type="hidden" name="user_id" value="{{$user_id}}">
          
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
       

      </div>
    </div>
  </div>
</div>

{{-- Footer Content --}}
@include('user.customer.footer-customer')
{{-- Footer Content End  --}}

<!-- Main Scripts--> 
<script src="{{asset('assets/customer/assets/js/jquery.js')}}"></script> 
<script src="{{asset('assets/customer/assets/js/bootstrap.min.js')}}"></script> 
<script src="{{asset('assets/jquery.validate.min.js')}}"></script> 
<script src="{{asset('assets/additional-methods.min.js')}}"></script> 
<script src="{{asset('assets/sweetalert.min.js')}}"></script>


<script>
    
  
      



    </script>
</body>
</html>