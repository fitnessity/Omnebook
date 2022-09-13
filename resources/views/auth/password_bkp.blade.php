    <!-- Modal content-->

      <div class="modal-body login-pad">


        <div class="pop-title">

          <h3>FORGOT PASSWORD</h3>

        </div>

        <button type="button" class="close modal-close" data-dismiss="modal">

          <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>

        </button>

        <div class="signup">

          <div id='systemMessagePassword'></div>

          <div class="signleft">
          <h3 id="msg"></h3>

          {!! Form::open(array('id' => 'frmforgotpassword', 'method' => 'POST')) !!}

            {!! csrf_field() !!}

              <input type="text" name="email" id="email" placeholder="Email" >
            
              <button class="btn btn-primary" id='login_submit' onclick="$('#frmforgotpassword').submit();">Send Email </button>

              <p class="donthave">Already Have Account ?

                <a href="/auth/jsModallogin" data-toggle="modal" data-target="#login_modal" onclick="openLoginModal('login')">GO BACK TO LOGIN</a>
              </p>

            <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">

            {!! Form::close() !!}

          </div>

        </div>

      </div>

<script>
$(document).on("ajaxComplete", function(){

    $("#frmforgotpassword").submit(function(e){

        e.preventDefault();

          // check for validation
          $('#frmforgotpassword').validate({

              rules: {
                email: {
                  required: true,
                  email: true
                }
              },
              messages: {
                email: {
                  required: "Please enter a valid email address",
                  email: "Please enter a valid email address",
                }
              },
          submitHandler: SendMail
        });
  });

});

function SendMail() {

    var validForm = $('#frmforgotpassword').valid();
    var posturl = '/password/email';

    if (validForm) {

      var formData = $("#frmforgotpassword").serialize();

      $.ajax({
          url:posturl,
          type:'POST',
          dataType: 'json',
          data:formData,
          beforeSend: function () {
            $('#login_submit').prop('disabled', true);
          },
          complete: function () {
            $('#login_submit').prop('disabled', false);
          },
          success: function (response) {
            console.log(response);
            showSystemMessages('#systemMessagePassword', response.type, response.msg);
          }
        });
    }
}
  
</script>