<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Admin Login! | dartsinabottle</title>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <!-- Bootstrap core CSS -->

  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">

  <link href="{{asset('assets/fonts/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css/animate.min.css')}}" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css/icheck/flat/green.css')}}" rel="stylesheet">


  <script src="{{asset('assets/js/jquery.min.js')}}"></script>

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body style="background:#F7F7F7;">
  @if(Session::has('successmessage'))

       <div class="alert alert-success alert-dismissable">
                 <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                 {{Session::get('successmessage')}}
      </div>
  @endif

  <div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

    <div id="wrapper">
      <div id="login" class="animate form">
        <section class="login_content">
          <form method="post" action="{{url('admin/login')}}">
          {{csrf_field()}} 

            <h1>Login Form</h1>
            <div>
              <input type="email" name="email" class="form-control" placeholder="Enter your email" required="true" />
            </div>
            <div>
              <input type="password" name="password" class="form-control" placeholder="Password" required="true" />
            </div>

            <div>
                <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                @if($errors->has('g-recaptcha-response'))
                    <span class="invalid-feedback" style="display:block; color:red">
                        <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                    </span>

                @endif
            </div>
            <br>

            <div>
              <input type="submit" name="admin_login" class="btn btn-default submit" value="Log in"> 
              <a class="reset_pass" href="#">Lost your password?</a>
            </div>
            <div class="clearfix"></div>
            <div class="separator">
              <div class="clearfix"></div>
              <br />
              <div>
                <h1><img src="{{url('public/uploads/logo.png')}}"></h1>
                <p>©2022 All Rights Reserved. dartsinabottle. Privacy and Terms</p>
              </div>
            </div>
          </form>
          <!-- form -->
        </section>
        <!-- content -->
      </div>
    </div>
  </div>

</body>

</html>
