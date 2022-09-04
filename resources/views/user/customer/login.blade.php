<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Login</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!-- Le styles -->
<link href="{{asset('assets/customer/assets/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/customer/assets/css/fontawesome.css')}}" rel="stylesheet" type="text/css">

<link href="{{asset('assets/sweetalert.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="preload" href="https://fonts.googleapis.com/css?family=JetBrains+Mono:100,200,300,400,500,600,700,800,100i,200i,300i,400i,500i,600i,700i,800i&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=JetBrains+Mono:100,200,300,400,500,600,700,800,100i,200i,300i,400i,500i,600i,700i,800i&display=swap"></noscript>
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

    <div class="alert alert-success alert-dismissable">

     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
     {{Session::get('successmessage')}}
      @if(Session::has('user_id'))
      <a href="#" id="re_act_mail" class="btn btn-primary" data-id="{{Session::get('user_id')}}">Resend Activation email</a>
      @endif
   </div>
   @endif

    <div class="row">
      <div class="col-xs-12 checkout-form-col">
        <form class="" id="login_form" action="{{url('login')}}" method="post">
            
          {{csrf_field()}}  
          
          <div class="checkout-field-row login-row">
            <fieldset class="checkout-fields-col login-col">
            <h1 class="badges-title text-center"><em class="fa fa-user"></em> Login</h1>
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" value="">
                  </div>
                  
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password" class="form-control" value="">
                  </div>

                  <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                    @if($errors->has('g-recaptcha-response'))
                        <span class="invalid-feedback" style="display:block; color:red">
                            <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                        </span>

                    @endif
                  </div>
                 
              <div class="clearfix"></div>
              <div class="signupbtn-col text-center">
                <a href="{{url('signup')}}" class="btn signupbtn">Don't have an account? Signup</a>
                <a href="{{url('send-forgot-password-link')}}" class="btn frgt-btn">Forgot  Password?</a>
              </div>
              
                <div class="login-submit-btn text-center" >
                  <button type="submit" class="btn" id="submit_btn">Log In</button>
                </div>
            </fieldset>
          </div>
        </form>
        <div class="modal" id="loader_modal" role="dialog">
              <div class="modal-dialog modal-sm">
                <div class="modal-content"style="width:600px; height: 200px;margin-top: 150px;margin-left: -220px;">
                  <div class="modal-body">
                    <h3 style="text-align:center;">Please wait</h3>

                    <img src="{{ asset('public/uploads/badge_img/Preloader.gif')}}" style="width: 600px; margin-left: -20px;margin-top: -130px;">
                  </div>
                </div>
              </div>
            </div>

        {{-- Loader Modal --}}
        <div class="modal fade" id="loader_modal" role="dialog">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-body">
                <h3 style="text-align:center;">Please wait</h3>
                <p style="text-align:center;"><img src="{{url('public/uploads/gif/waiting.gif')}}"></p>
              </div>
            </div>
          </div>
        </div>
        {{-- Loade Modal end --}}
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
  $(document).ready(function(){
    $("#login_form").validate({
      errorClass:"my-error-class",
      rules:{              
        'email':{
          required:true,
          email:true,
        },              
        'password':{
          required:true,
          minlength:5,
        },
      },
    });
    $('#re_act_mail').click(function(){
      var user_id = $(this).data('id');
      // alert(user_id);
      swal({
          title: "Are you sure?",
          text: "Resend activation email?’",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#5A738E",
          confirmButtonText: "Yes, Send it!",
          cancelButtonText: "Cancel",
   
          closeOnConfirm: true,
          closeOnCancel: false
              },
          function (isConfirm) {
            if (isConfirm) {
      $.ajax({

      url:"{{ url('resend-activation-email') }}",
      method:"get",
      dataType:"json",
      data:{user_id:user_id},
      beforeSend: function(){
            $('#loader_modal').modal('show');
          },
       success: function(data)
        {

          if(data.success === true){
            // alert(data.failed_contacts);
   $('#loader_modal').modal('hide');
    swal("Send successfully", "", "success" , );
    swal({
    title: "Success!",
    
    text : "Email sent successfully.",
    type: "success",
    confirmButtonText: "Close" 
   });
    setTimeout(function(){ window.location.reload(); }, 4000);

  }
  
}, error: function () {
    $('#loader_modal').modal('hide');
    swal("Sorry, SomeThing Went Wrong!", "", "error");
}
});
}
else {
swal("Cancelled", "", "error");
}


     });
    });
  }); //document.ready function
</script>
</body>
</html>