@extends('admin.layouts.index')
@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>FITNESSITY</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <div id='systemMessage_frgtpwd'></div>
    <form id="frmfrgtpwd" method="post">
        <div class="form-group has-feedback">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <input type="email" name="frgtpwd_email" id="frgtpwd_email" class="form-control" placeholder="Email">
            
        </div>
        
        <div class="row">
          <div class="col-xs-12">
            <button class="btn btn-primary btn-block btn-flat" id='frgtpwd_submit' onclick="$('#frmfrgtpwd').submit();">Send Email</button>
          </div>
        </div>
        <br>
        <p class="donthave login-box-msg">Already have an account?
          <a href="/admin" >LOGIN</a>
        </p>
        <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
    </form>   
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<script>
$(document).ready(function(){

    $("#frmfrgtpwd").submit(function(e){

        e.preventDefault();

          // check for validation
          $('#frmfrgtpwd').validate({

              rules: {
                frgtpwd_email: {
                  required: true,
                  email: true
                }
              },
              messages: {
                frgtpwd_email: {
                  required: "Please enter a valid email address",
                  email: "Please enter a valid email address",
                }
              },
          submitHandler: SendResetPasswordMail
        });
  });

});

function SendResetPasswordMail() {

    var validForm = $('#frmfrgtpwd').valid();
    var posturl = '/password/email';

    if (validForm) {

      var formData = $("#frmfrgtpwd").serialize();

      $.ajax({
          url:posturl,
          type:'POST',
          dataType: 'json',
          data:'email='+$("#frgtpwd_email").val() + "&_token="+$("#token").val(),
          beforeSend: function () {
            $('#frgtpwd_submit').prop('disabled', true);
          },
          complete: function () {
            $('#frgtpwd_submit').prop('disabled', false);
          },
          success: function (response) { 
              console.log(response);
              showSystemMessages('#systemMessage_frgtpwd', response.type, response.msg);
          }
        });
    }
}
</script>
@stop