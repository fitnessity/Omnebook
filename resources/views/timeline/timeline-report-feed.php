@extends('layouts.profile')

@section('content')
<div class="login-box">
  <div class="login-logo">
  <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>logo.png" height="100%" width="100%" />
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    
    <!-- display flash message -->
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info', ] as $msg)
          @if(Session::has('alert-' . $msg))

          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach
    </div>
    <!-- end flash-message -->

    <div id='systemMessage'></div>

    <form  id="frmlogin" method="post">
    {{ csrf_field() }}
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div> -->
        <!-- /.col -->
        <div class="col-xs-6">
          <button class="btn btn-primary btn-block btn-flat" id='login_submit' onclick="$('#frmlogin').submit();">Log in </button>
        </div>
         <div class="col-xs-6">
          <a  href="/admin/forgotpassword" class="btn btn-danger btn-block btn-flat">Forgot Password</a>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->

   <!--  <a href="#">I forgot my password</a> --><br>
    <!-- <a href="/admin/register" class="btn btn-primary btn-block btn-flat">Register a new membership</a> -->
    <!-- <button type="submit" class="btn btn-danger btn-block btn-flat">Forgot Password</button> -->
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<script>
$(document).on("ready", function(){

    $("#frmlogin").submit(function(e){
        e.preventDefault();
        LoginUser();
  });
});

function LoginUser() {

    var validForm = $('#frmlogin').valid();
    var posturl = '/admin/login';

    if (validForm) {

      var formData = $("#frmlogin").serialize();

      $.ajax({
          url:posturl,
          type:'POST',
          dataType: 'json',
          data:formData,
          beforeSend: function () {
            $('#login_submit').prop('disabled', true);
            $('#frmlogin').css("opacity", "0.5");
          },
          complete: function () {
            $('#login_submit').prop('disabled', false);
            $('#frmlogin').css("opacity", "1");
          },
          success: function (response) {               
            showSystemMessages('#systemMessage', response.type, response.msg);
            if (response.type == 'success')
            {
              window.location = '/admin/dashboard';
            }
          }
        });

    }
}

</script>
@stop