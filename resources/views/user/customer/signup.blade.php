<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Signup</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="">
<meta name="author" content="">

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
   </div>
   @endif

    <div class="row">
      <div class="col-xs-12 checkout-form-col">
        <form class="" id="signup_form" >
            
          {{csrf_field()}}  
          
          <div class="row checkout-field-row">
          
            <fieldset class="col-xs-12 checkout-fields-col">
            
          
            
            
            <h1 class="badges-title text-center"><em class="fa fa-user"></em> Signup</h1>
              <div class="well">
                <div class="row">
                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>First Name</label> 
                    <input type="text" name="first_name" id="first_name" class="form-control" value="">
                  </div>
                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" value="">
                  </div>
                  <div class="col-sm-12 col-xs-12 form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" value="">
                  </div>
                  <div class="col-sm-12 col-xs-12 form-group">
                    <label>Confirm Email Address</label>
                    <input type="email" name="confirm_email" id="confirm_email" class="form-control" value="">
                  </div>

                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password" class="form-control" value="">
                  </div>
                  <div class="col-sm-6 col-xs-12 form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" value="">
                  </div>

                  <!-- <div class="col-sm-12 col-xs-12 form-group">
                    <label>Business Name</label>
                    <input type="text" name="business_name" id="business_name" class="form-control">
                  </div> -->

                 
                
                  
                </div>
              </div>
              <div class="clearfix"></div>
              <div>
                <a href="{{url('login')}}"><strong>Already have an account? Login</strong></a>
                
              </div>
              <div class="row checkout-btn-row">
                <div class="col-xs-6 checkout-btn pull-right text-right" >
                  <button type="submit" class="btn" id="submit_btn">Submit</button>
                </div>
              </div>
            </fieldset>
            
        
            
            
            
          </div>
        </form>

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
        // Extend jQuery Validate with a custom method
        $.validator.addMethod("uniqueName", function(value, element) {
          // Retrieve the value of the last name field
          var lastNameValue = $("#last_name").val();

          // Check if the first name and last name are identical
          if (value === lastNameValue) {
              // Return false if identical
              return false;
          } else {
              // Return true if not identical
              return true;
          }
        }, "First name and last name cannot be identical.");


        $(document).ready(function(){
          $("#signup_form").validate({

            errorClass:"my-error-class",
            rules:{

              'first_name':{
                  required:true,
                  uniqueName: true
              },
              'last_name':{
                  required:true,
              },
              'email':{
                required:true,
                email:true,
              },
              'confirm_email':{
                required:true,
                email:true,
                equalTo:"#email",

              },
              'password':{
                required:true,
                minlength:5,
              },
              'confirm_password':{
                required:true,
                minlength:5,
                equalTo:"#password",

              },
              
            },
            messages:{
              'confirm_password':{
                equalTo:"Password and Confirm Password doesn't match",
              },
              'confirm_email':{
                equalTo:"Email and Confirm Email doesn't match",

              }
            },

            submitHandler: function (signup_form) {
                
                 $.ajax({

                  method:"post",
                  url:"{{url('signup')}}",
                  dataType:"json",
                  data:$("#signup_form").serialize(),
                  beforeSend:function(){
                    $("#submit_btn").attr('disabled','true');
                    $('#loader_modal').modal({
                     backdrop: 'static',
                     keyboard: false
                    });
          
                    $("#loader_modal").modal('show');
                  },
                  success:function(data){
                    $("#submit_btn").removeAttr('disabled','true');
                    $("#loader_modal").modal('hide');

                    if(data.error == true)
                    {
                      swal(data.message);
                    }
                    else
                    {
                      swal({ 
                      title: "Successfully Registered",
                      text: 'Please check your email to activate your account',
                      type: "success",
                      closeOnClickOutside: false
                      },
                      function(){ 
                      
                      // window.location.reload();
                      window.location.href = "{{ url('login')}}";
                      });    
                    } //else

                  },
                  error:function(){
                    alert("Error");
                  }


                 }); // ajax

             return false; // required to block normal submit since you used ajax
         },


          });


    


        }); //document.ready function
  
      



    </script>
</body>
</html>