    <!-- Modal content-->

      <div class="modal-body login-pad">


        <div class="pop-title">

          <h3>RESET PASSWORD</h3>

        </div>

        <button type="button" class="close modal-close" data-dismiss="modal">

          <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>

        </button>

        <div class="signup">

          <div id='systemMessage_frgtpwd'></div>

          <div class="signleft">
          <h3 id="msg"></h3>
            <form  id="frmfrgtpwd" method="post">

              <input type="text" name="frgtpwd_email" id="frgtpwd_email" placeholder="Email" >
              
            <button class="btn btn-primary" id='frgtpwd_submit' onclick="$('#frmfrgtpwd').submit();">Send Email </button>

            <p class="donthave">Already have an account? 

              <a href="/auth/jsModallogin" data-toggle="modal" data-target="#login_modal" onclick="openLoginModal('login')">LOGIN</a>

            </p>

            <input type="hidden" name="_token" id="token_forget" value="{{csrf_token()}}">
            </form>

          </div>          

        </div>

      </div>

<script>
$(document).on("ajaxComplete", function(){

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
          data:'email='+$("#frgtpwd_email").val() + "&_token="+$("#token_forget").val(),
          beforeSend: function () {
            $('#frgtpwd_submit').prop('disabled', true);
          },
          complete: function () {
            $('#frgtpwd_submit').prop('disabled', false);
          },
          success: function (response) { 
              showSystemMessages('#systemMessage_frgtpwd', response.type, response.msg);
          }
        });
    }
}
  
</script>