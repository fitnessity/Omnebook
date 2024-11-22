    <!-- Modal content-->



      <div class="modal-body login-pad">





        <div class="pop-title">



          <h3>LOGIN</h3>



        </div>



        <button type="button" class="close modal-close" data-dismiss="modal">



          <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>



        </button>



        <div class="signup">



          <div id='systemMessage'></div>



          <div class="signleft login_form">

          <h3 id="msg"></h3>

            <form  id="frmlogin" method="post">



             <input type="hidden" name="social_login" id="social_login" value="0">

              <input type="hidden" name="social_provider" id="social_provider" value="">

              <input type="hidden" name="social_id" id="social_id" value="">

              <input type="hidden" name="social_name" id="social_name" value="">

              <input type="hidden" name="social_email" id="social_email" value=""> 

            

              <input type="text" name="email" id="email" placeholder="Email" >

            

              <input type="password" name="password" id="password" placeholder="Password">



                 <div class="remembermediv" >

                  <input type="checkbox" id="remember" name="remember" checked class="remembercheckbox" />

                  <span for="remember" class="rememberme">Remember me</span>

                 </div>

                

 

              

            <?php echo/* form_password($password);*/ $show_captcha=""; ?>



            <div id='capchaimg'><?php if ($show_captcha) { ?><?php echo $captcha_html; ?><?php } ?></div>



            <?php if ($show_captcha) { ?> <?php echo form_input($captcha); ?> <?php } ?>					



            <!-- <label class="rememberme"><?php /*echo form_checkbox($remember);*/ ?> Remember me</label>

 -->

            



            <button class="btn btn-primary" id='login_submit' onclick="$('#frmlogin').submit();">Log in</button>

            <br><br>

            <a href="/auth/jsModalpassword" data-toggle="modal" data-target="#password_modal" onclick="openLoginModal('password')" class="forgotpass">Forgot Password?</a>



            <p class="donthave">Don't have an account? 



              <!-- <a href="javascript:void(0);" onclick="openRegisterModal()">Sign Up</a> -->

              <a href="/auth/jsModalregister" data-toggle="modal" data-target="#register_modal" onclick="openLoginModal('register')">SIGN UP</a>



            </p>





            <?php /*echo form_close();*/ ?>

            <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">

            </form>



          </div>



          <!-- <div class="signor">



            <img src="



                 <?php echo Config::get('constants.FRONT_IMAGE'); ?>signor.jpg" height="403" width="59" />



          </div> -->

          

          <a href="/user/sport-alert" data-toggle="modal" data-target="#register_modal" onclick="openLoginModal('sport-alert')" style="display: none;" id="sportalert"></a>



          <div class="signright" style="width: 100%;text-align: center; display: grid;">



            <!-- <h4>Log in with a social network</h4> -->



            <div class="social-login">


              <!--{{ url('login/facebook') }}  -->
              <a href="/socialauth/socialLogin/facebook" class="fb-login" style="text-align: center;">

                <i class="fa fa-facebook" aria-hidden="true"></i>

                LOGIN WITH FACEBOOK

              </a>



              <!--<a href="/socialauth/socialLogin/twitter" class="tw-login"> 

                <i class="fa fa-twitter" aria-hidden="true"></i>

                LOGIN WITH TWITTER

              </a> -->



              <!-- <a href="/socialauth/socialLogin/linkedin" class="in-login">

                <i class="fa fa-linkedin" aria-hidden="true"></i>

                LOGIN WITH LINKEDIN

              </a>-->



             <!-- <a href="/socialauth/socialLogin/google" class="plus-login">

                <i class="fa fa-google-plus" aria-hidden="true"></i>LOGIN WITH GOOGLE-PLUS

              </a> -->



            </div>



          </div> 



        </div>



      </div>



<script>

$(document).on("ajaxComplete", function(){



    $("#frmlogin").submit(function(e){



        e.preventDefault();



          // check for validation

          $('#frmlogin').validate({



              rules: {

                password: {

                  required: true,

                  minlength: 6

                },

                email: {

                  required: true,

                  email: true

                },

                // captcha: "required"

              },

              messages: {

                password: {

                  required: "Provide a password",

                  minlength: jQuery.validator.format("Enter at least {0} characters")

                },

                email: {

                  required: "Please enter a valid email address",

                  email: "Please enter a valid email address",

                },

                captcha: "Enter your Confirmation Code"

              },

          submitHandler: LoginUser

        });

  });



});



function LoginUser() {



  // if($("#social_login").val() == 1) {

  //   var validForm = true;

  //   var posturl = '/socialauth/login';

  // }else {

  //   var validForm = $('#frmlogin').valid();

  //   var posturl = '/auth/login';

  // }



    var validForm = $('#frmlogin').valid();

    var posturl = '/auth/login';



    if (validForm) {



      var formData = $("#frmlogin").serialize();



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

            if (response.type == 'danger')

            {

              if (typeof (response.captcha_html) != undefined)

              {

                $('#capchaimg').html(response.captcha_html);

              }

            }

            else if (response.type == 'success')

            {    
                console.log('asdsad')
                if(localStorage.getItem('custom_url') != null &&  localStorage.getItem('custom_url') != 'undefined'){
                    
                    
                    console.log(localStorage.getItem('custom_url'))
                    window.location =  localStorage.getItem('custom_url');
                    localStorage.removeItem('custom_url');
                } else {

              // window.location = response.redirecturl;

              if(response.redirecturl != "" && response.redirecturl == '/user/sport-alert'){

                $('#sportalert').trigger('click');

              }
            else if(response.redirecturl == '/profile/viewProfile'){
                window.location = response.redirecturl;
            }
              else{
                window.location = response.redirecturl;
                setTimeout( function(){

                 // location.reload();

                }, 1000);

              }

            }
            }


            if (typeof (response.msg) != undefined)

            {

              showSystemMessages('#systemMessage', response.type, response.msg);

            }

          }

        });



    }

}

  

</script>
<style>
  .login_form{
    margin: 0 auto;
    float: none !important;
    width: 85%;
  }
  /*.modal-dialog.modal-lg{
    width: 40%;  
  }*/
</style>


<!-- <script>

  // This is called with the results from from FB.getLoginStatus().

  function statusChangeCallback(response) {

    console.log('statusChangeCallback');

    // The response object is returned with a status field that lets the

    // app know the current login status of the person.

    // Full docs on the response object can be found in the documentation

    // for FB.getLoginStatus().

    if (response.status === 'connected') {

      // Logged into your app and Facebook.      

      testAPI();

      

    } else if (response.status === 'not_authorized') {

      // The person is logged into Facebook, but not your app.

      // document.getElementById('status').innerHTML = 'Please log ' +

        'into this app.';

        showSystemMessages('#systemMessage', 'error', 'Please log into Facebook');

        window.location = response.redirecturl;

    } else {

      // The person is not logged into Facebook, so we're not sure if

      // they are logged into this app or not.

      // document.getElementById('status').innerHTML = 'Please log ' +

        'into Facebook.';

        showSystemMessages('#systemMessage', 'error', 'Please log into Facebook');

    }

  }



  // This function is called when someone finishes with the Login

  // Button.  See the onlogin handler attached to it in the sample

  // code below.

  function checkLoginState() {

    FB.getLoginStatus(function(response) {

      statusChangeCallback(response);

    });

  }



  window.fbAsyncInit = function() {

  FB.init({

    appId      : '1782510342021485',

    cookie     : true,  // enable cookies to allow the server to access 

                        // the session

    xfbml      : true,  // parse social plugins on this page

    version    : 'v2.8' // use graph api version 2.8

  });



  // Now that we've initialized the JavaScript SDK, we call 

  // FB.getLoginStatus().  This function gets the state of the

  // person visiting this page and can return one of three states to

  // the callback you provide.  They can be:

  //

  // 1. Logged into your app ('connected')

  // 2. Logged into Facebook, but not your app ('not_authorized')

  // 3. Not logged into Facebook and can't tell if they are logged into

  //    your app or not.

  //

  // These three cases are handled in the callback function.



  // FB.getLoginStatus(function(response) {

  //   statusChangeCallback(response);

  // });



  };



  // Load the SDK asynchronously

  (function(d, s, id) {

    var js, fjs = d.getElementsByTagName(s)[0];

    if (d.getElementById(id)) return;

    js = d.createElement(s); js.id = id;

    js.src = "//connect.facebook.net/en_US/sdk.js";

    fjs.parentNode.insertBefore(js, fjs);

  }(document, 'script', 'facebook-jssdk'));



  // Here we run a very simple test of the Graph API after login is

  // successful.  See statusChangeCallback() for when this call is made.

  function testAPI() {



    var url = '/me?fields=id,name,email,avtar,permissions';

      FB.api(url, function(response) {

        console.log(JSON.stringify(response));

        $("#social_login").val(1);

        $("#social_id").val(response.id);

        $("#social_name").val(response.name);

        $("#social_email").val(response.email);

        $("#social_provider").val('Facebook');

        // LoginUser();

    });



    /*FB.login(

        function(response) {

          alert('here 1');

            if (response.authResponse) {

               console.log('Welcome!  Fetching your information.... ');

               FB.api('/me', function(response) {

                   console.log('Good to see you, ' + response.email + '.');

                   alert('Good to see you, ' + response.email + '.');

               });

            } else {

                console.log('User cancelled login or did not fully authorize.');

            }

        },

        {

          scope:'email'

        }

      );*/





    /*console.log('Welcome!  Fetching your information.... ');

    FB.api('/me', function(response) {

      console.log("name: "+response.name);

      console.log("id: "+response.id);

      console.log("email: "+response.email);

      console.log("fname: "+response.first_name);

      showSystemMessages('#systemMessage', 'success', 'Successful login for: ' + response.name);     

    });*/

  }

</script> -->