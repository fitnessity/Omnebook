 <style>
 .mt83{
  margin-top: 83px;
}
.close{
  opacity: 1 !important;
}
.signleft-customer form a {
    font-size: 13.5px;
    color: #777;
    padding-bottom: 0;
    text-align: left;
    float: none;
}
.t_c {
    font-size: 13.5px !important;
    color: #777 !important;
    padding-bottom: 0;
    text-align: left;
    float: none;}

button.FITNESS_ENTHUSIASTS_signup {
    margin-top: 22.4%;
}
.signleft {
    float: left;
    width: 45%;
}
.signright{
  width: 45%;
}
input,select {
  margin: 2.2% 0.5%;
    border: 1px solid #828282;
    padding: 16px 10px;
    width: 100%;
}
.modallink.mt20 {
    margin-top: 8% !important;
}
 </style>
 <!-- Modal content-->
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    var key = "<?php echo env('RE_CAP_SITE'); ?>";
    grecaptcha.render("captcha2", {sitekey: key, theme: "light"});
   var key = "<?php echo env('RE_CAP_SITE'); ?>";
    grecaptcha.render("captcha3", {sitekey: key, theme: "light"});
</script>
    <div class="modal-content">

      <div class="modal-body login-pad">

      <!-- signup_selection div starts -->
      <div id="signup_selection">

        <div class="pop-title"><h3>SIGN UP</h3></div>
          <button type="button" class="close modal-close" data-dismiss="modal">
            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
          </button>
         <div class="signup signup-new">
            <p class="sign-para">Fitnessity makes it easy to network, share your experiences with others and get more involved in multiple sports and fitness activities. It’s free to join and it’s for everyone.</p>
            


        
        <div class="signleft" style="width:45%">
          <div class="new-signup-middle">

            <h2>FITNESS ENTHUSIASTS </h2>
            <p style="margin-top: 25% !important;">Are you an athlete, parent, fitness enthusiast or new comer looking for training, activities, & adventures in multiple sports? Learn, share life experiences & make friends while interacting with a thriving fitness community near you.</p>
            <button style="margin-top:22.5%" type="button" onclick="$('#signup_selection').hide();$('#signup_normal').show();">SIGN UP</button>

            <a href="javascript:void();" onclick="$('#signup_selection').hide();$('#learnmoreCustomer').show();">LEARN MORE <i class="fa fa-angle-right" aria-hidden="true"></i></a>
          </div>
        </div>  
        <div class="signor">
          <img src="
          <?php echo Config::get('constants.FRONT_IMAGE'); ?>signor.jpg" height="403" width="59" />
        </div>
        <div class="signright" style="width:45%">
                <div class="new-signup-left">
                
                  <h2>FITNESSITY FOR BUSINESS</h2>
                  <p style="margin-top: 36% !important;"> Do you operate a gym, training facility, or other local business that offer sports or fitness oriented activities in multiple sports? Sign up and list your business for free and become a partner.</p>
                  <button type="button" onclick="$('#signup_selection').hide();$('#fitnessity_for_business').show();">SIGN UP</button>
                  <!-- <a href="javascript:void();" data-toggle="modal" data-target="#learnmore_modal"  onclick="openLoginModal('learnmore')">LEARN MORE <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                  <a href="javascript:void();" onclick="$('#signup_selection').hide();$('#learnmore').show();">LEARN MORE <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </div>          
            </div>

        <!-- Fitness Professional -->
      <!--  <div class="signor" >
          <img src="
          <?php echo Config::get('constants.FRONT_IMAGE'); ?>signor.jpg" height="403" width="59" />
        </div>
        <div class="signright">
          <div class="new-signup-right">

            <h2>FITNESS PROFESSIONAL </h2>
            <p style="margin-top: 25% !important;">Do you work as a personal trainer, coach, instructor, nutritionist, therapist or another provider offering services & activities in multiple sports? Sign up and list your business for free.<br><br></p>
            <button type="button" onclick="window.location.href = '/auth/registerProfessional'">SIGN UP</button>

            <a href="javascript:void();" onclick="$('#signup_selection').hide();$('#learnmoreCustomer').show();">LEARN MORE <i class="fa fa-angle-right" aria-hidden="true"></i></a>
          </div>
        </div> -->

      </div>

      <p class="already">Already have an account? <a href="/auth/jsModallogin" data-toggle="modal" data-target="#login_modal" onclick="openLoginModal('login')">Login</a></p>        

    </div>
    <!-- signup_selection div ends --> 

    <!-- signup_normal div starts --> 

    <div id="learnmore" style="display:none;">
      <div class="pop-title"><h3>LEARN MORE</h3></div>
      <button type="button" class="close" data-dismiss="modal"><img src="/images/close.jpg" height="70" width="34"/> </button>
      <div class="signup">
        <div class="learn-more-left">
          <ul>
            <li>
              <h3>Build your brand</h3>
              <p>Showcase all that your business has to offer </p>

              <p>Create competitive prices and programs to stand out</p>

              <p>Display your entire schedule in one place</p>
              <p>Highlight testimonials and ratings</p>
              <p>Feature your favorite photos</p>
            </li>
            <li>
              <h3>Get Bookings</h3>
              <p>Customers coming to Fitnessity are looking to book a lesson, class or adventure </p>

              <p>Submit a quote to a customer or get booked directly from your profile</p>

              <p>You will be notified by email for new request</p>
              <p>Check your profile for new jobs matching your skills in your area</p>
              <p>You have the option to say yes or no to a client’s request for service</p>
              <p>Make booking appointments and reserving classes easier</p>
            </li>
            <li>
              <h3>Connect with clients</h3>
              <p>Get discovered by new clients </p>

              <p>Share client testimonials</p>

              <p>Get ratings and reviews from past or current clients</p>
              <p>treamline messaging, add clients to your network</p>
              <p>Make booking appointments and reserving classes easier</p>
            </li>
            <li>
              <h3>Marketing made easy</h3>
              <p>Encourage social sharing</p>
              <p>Share your tips, news and more on your timeline and newsfeed.</p>
              <p>More to come</p>
            </li>
          </ul> 
        </div>                            
        <div class="by-sign">   
          <div class="qh-next">
            <a class="qh-continue" onclick="window.location.href = '/auth/registerBusiness'">JOIN NOW</a>
          </div>

        </div>
      </div>
    </div>

    <div id="learnmoreCustomer" style="display:none;">
      <div class="pop-title"><h3>LEARN MORE</h3></div>
      <button type="button" class="close modal-close" data-dismiss="modal">
        <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
      </button>
      <div class="signup">
        <div class="learn-more-left">
          <ul>
            <li>
              <h3>Tap into the fitness scene</h3>
              <p>Discover the best workouts, class or adventures in your area</p>

              <p>Find and follow popular studios and instructors</p>

              <p>Be the first to know about events and activities</p>

            </li>
            <li>
              <h3>Your whole fitness life in one place</h3>
              <p>Book a lesson, class, adventure or experience from local service providers </p>

              <p>Share a workout with a friend or make new ones</p>

              <p>Review and rate your favorite classes and instructors</p>

            </li>
            <li>
              <h3>A community of fitness enthusiasts</h3>
              <p>Connect with workout buddies in your area</p>

              <p>Interact with your favorite instructors</p>

              <p>Engage with fitness fanatics anywhere in the world</p>
              <p>Lorem ipsum dolor sit amet, consectetur 
              </li>

            </ul> 
          </div>                            
          <div class="by-sign">   
            <div class="qh-next">

              <button type="button" class="qh-continue" onclick="$('#learnmoreCustomer').hide();$('#signup_normal').show();">JOIN NOW</button>
            </div>

          </div>
        </div>
      </div>

      <div id="signup_normal" style="display:none;">

        <div class="pop-title">
        	<h3>SIGN UP</h3>
        </div>

        <button type="button" class="close modal-close" data-dismiss="modal">
        	<img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
        </button>						

        <div class="signup">		

          <div id='systemMessage'></div>

          <div class="signleft-customer">

            <form id="frmregister" method="post">

              <!-- <input type="text" name="social_login" id="social_login" value="0">
              <input type="text" name="social_provider" id="social_provider" value="">
              <input type="text" name="social_id" id="social_id" value="">
              <input type="text" name="social_name" id="social_name" value="">
              <input type="text" name="social_email" id="social_email" value=""> -->

  	         <!-- <input type="text" name="username" id="username" size="30" placeholder="User Name"> -->
  	         <input type="text" name="firstname" id="firstname" size="30" maxlength="80" placeholder="First Name">
  	         <input type="text" name="lastname" id="lastname" size="30" maxlength="80" placeholder="Last Name">
  	         <input type="text" name="username" id="username" size="30" maxlength="80" placeholder="user Name">
  	         <input type="email" name="email" id="email" size="30" placeholder="Email Address" size="30" maxlength="80">
             <input type="number" name="contact" id="contact" size="30" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Phone">
  	         <input type="password" name="password" id="password" size="30" placeholder="Password">
  	         <input type="password" name="confirm_password" id="confirm_password" size="30" placeholder='Confirm Password'>
             <input type="checkbox" id="b_trm1" class="form-check-input" value="1" style="position: relative;left: -48%;top: 26px;">
            <p style="font-size: 13.5px;float: none;margin-left: 3px;">I agree to Fitnessity <a href="/terms-condition" target="_blank">Terms of Service</a> and <a href="/privacy-policy" target="_blank">Privacy Policy</a></p> 
  	         <input type="hidden" name="_token" value="{{csrf_token()}}">
             <!-- <div  class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div> -->
             <div id="captcha2"></div>
             <div id="captcha_error_div" style="display:none;">
                <div class="error">
                Captcha is required
                </div>
              </div>
           </form>


          </div>

          <div class="signor"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>signor.jpg" height="403" width="59" /></div>
          <span style="margin-top:10px !important;"></span>
          <div class="signright-customer paddingTop">

            <h4>Sign up with a social network</h4>

            <div class="social-login">

              <a href="/socialauth/socialRegister/facebook/customer" class="fb-login">
                <i class="fa fa-facebook" aria-hidden="true"></i>
                SIGN UP WITH FACEBOOK
              </a>

              <a href="/socialauth/socialRegister/twitter/customer" class="tw-login">
                <i class="fa fa-twitter" aria-hidden="true"></i>
                SIGN UP WITH TWITTER
              </a>

              <a href="/socialauth/socialRegister/linkedin/customer" class="in-login">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
                SIGN UP WITH LINKEDIN
              </a>

              <a href="/socialauth/socialRegister/google/customer" class="plus-login">
                <i class="fa fa-google-plus" aria-hidden="true"></i>
                SIGN UP WITH GOOGLE-PLUS
              </a>

            </div>

          </div>

          <div class="modallink mt20">

            <!-- <p>By signing up, I agree to <a href="/terms-condition" data-toggle="modal" data-target="#terms_modal">Fitnessity Terms of Service</a> and <a href="/privacy-policy" data-toggle="modal" data-target="#terms_modal">Privacy Policy</a></p>  -->

            

            <!-- <button type="submit" class="btn btn-primary" id="register_submit">CREATE ACCOUNT</button> -->
            <div class="signup-new-customer">
            <button type="button"  style="margin:0px;" class="signup-new button" id="register_submit" onclick="$('#frmregister').submit();">CREATE ACCOUNT</button>
          </div>
          </div>

          <p>Already have an account? <a href="/auth/jsModallogin" data-toggle="modal" data-target="#login_modal" onclick="openLoginModal('login')">Login</a></p>

        </div>

      </div>

      <!-- signup_normal div ends --> 

    </div>
    
<!-- STEP1 FOR FITNESSITY FOR BUSINESS START -->

    <div id="fitnessity_for_business" style="display:none;">

        <div class="pop-title">
          <h3>STEP 1</h3>
        </div>

        <button type="button" class="close modal-close" data-dismiss="modal">
          <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
        </button>           

        <div class="signup">    

          <div id='systemMessage'></div>

          <div class="signleft-customer">

            <form id="frmregisterbusiness" method="post">
             <!-- <input type="text" name="usernameb" id="b_username" size="30" placeholder="User Name"> -->
             <input type="text" name="firstnameb" id="b_firstname" size="30" maxlength="80" placeholder="First Name">
             <span class="error" id="b_fn"></span>
             <input type="text" name="lastnameb" id="b_lastname" size="30" maxlength="80" placeholder="Last Name">
             <span class="error" id="b_ln"></span>
             <input type="email" name="emailb" id="b_email" size="30" placeholder="Email Address" size="30" maxlength="80">
             <span class="error" id="b_eml"></span>
             <input type="number" name="phone_number" id="b_contact" size="30" placeholder="Contact No" size="30" maxlength="10"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
             <span class="error" id="b_cot"></span>
             <input type="password" name="passwordb" id="b_password" size="30" placeholder="Password">
             <span class="error" id="b_pass"></span>
             <input type="password" name="confirm_passwordb" id="b_confirm_password" size="30" placeholder='Confirm Password'>
             <span class="error" id="b_cpass"></span>
             <input type="hidden" name="_token" id="b_token" value="{{csrf_token()}}">
             <!-- <div  class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div> -->
             
          </div>

          <div class="signor"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>signor.jpg" height="403" width="59" /></div>
          <span style="margin-top:10px !important;"></span>
          <div class="signright-customer paddingTop">

            <h4>Sign up with a social network</h4>

            <div class="social-login">

              <a href="/socialauth/socialRegister/facebook/customer" class="fb-login">
                <i class="fa fa-facebook" aria-hidden="true"></i>
                SIGN UP WITH FACEBOOK
              </a>

              <a href="/socialauth/socialRegister/twitter/customer" class="tw-login">
                <i class="fa fa-twitter" aria-hidden="true"></i>
                SIGN UP WITH TWITTER
              </a>

              <a href="/socialauth/socialRegister/linkedin/customer" class="in-login">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
                SIGN UP WITH LINKEDIN
              </a>

              <a href="/socialauth/socialRegister/google/customer" class="plus-login">
                <i class="fa fa-google-plus" aria-hidden="true"></i>
                SIGN UP WITH GOOGLE-PLUS
              </a>

            </div>

          </div>

          <div class="modallink mt20">

            <!-- <p>By signing up, I agree to <a href="/terms-condition" data-toggle="modal" data-target="#terms_modal">Fitnessity Terms of Service</a> and <a href="/privacy-policy" data-toggle="modal" data-target="#terms_modal">Privacy Policy</a></p>  -->

            <!-- <button type="submit" class="btn btn-primary" id="register_submit">CREATE ACCOUNT</button> -->
            <div class="signup-new-customer">
              <button type="button" id="b_v_1"  onclick="">Next Step</button>
            
          </div>
          </div>

          <p>Already have an account? <a href="/auth/jsModallogin" data-toggle="modal" data-target="#login_modal" onclick="openLoginModal('login')">Login</a></p>

        </div>

      </div>
<!-- STEP1 FOR FITNESSITY FOR BUSINESS END -->





<!-- STEP2 FOR FITNESSITY FOR BUSINESS START -->

<div id="fitnessity_for_business_step2" style="display:none;">

        <div class="pop-title">
          <h3>STEP 2</h3>
        </div>

        <button type="button" class="close modal-close" data-dismiss="modal">
          <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
        </button>           

        <div class="signup">    

          <div id='systemMessage'></div>

          <div class="signleft-customer">
             <input type="text" name="Companyname" id="b_companyname" size="30" maxlength="80" placeholder="Company Name">
              <span class="error" id="b_cmpo"></span>
             <input type="text" name="Address" id="b_address" placeholder="Address">
              <span class="error" id="b_addr"></span>
            
             <input type="text" name="State" id="b_state" size="30" placeholder="State" size="30" maxlength="80">
              <span class="error" id="b_sta"></span>
             <input type="text" name="City" id="b_city" size="30" placeholder="City" size="30" maxlength="80"> 
              <span class="error" id="b_ct"></span>
              
             <input type="number" name="Zip Code" id="b_zipcode" size="30" placeholder="Zip Code">
              <span class="error" id="b_zip"></span>
             <input type="text" name="Country" value="us" id="b_country" size="30" placeholder='Country'>
             
              <span class="error" id="b_cont"></span>
            </div>

          <div class="signor"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>signor.jpg" height="403" width="59" /></div>
          <span style="margin-top:10px !important;"></span>
          <div class="signright-customer paddingTop">

            <h4>Sign up with a social network</h4>

            <div class="social-login">

              <a href="/socialauth/socialRegister/facebook/customer" class="fb-login">
                <i class="fa fa-facebook" aria-hidden="true"></i>
                SIGN UP WITH FACEBOOK
              </a>

              <a href="/socialauth/socialRegister/twitter/customer" class="tw-login">
                <i class="fa fa-twitter" aria-hidden="true"></i>
                SIGN UP WITH TWITTER
              </a>

              <a href="/socialauth/socialRegister/linkedin/customer" class="in-login">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
                SIGN UP WITH LINKEDIN
              </a>

              <a href="/socialauth/socialRegister/google/customer" class="plus-login">
                <i class="fa fa-google-plus" aria-hidden="true"></i>
                SIGN UP WITH GOOGLE-PLUS
              </a>

            </div>

          </div>

          <div class="modallink mt20">

            <!-- <p>By signing up, I agree to <a href="/terms-condition" data-toggle="modal" data-target="#terms_modal">Fitnessity Terms of Service</a> and <a href="/privacy-policy" data-toggle="modal" data-target="#terms_modal">Privacy Policy</a></p>  -->
   

            <!-- <button type="submit" class="btn btn-primary" id="register_submit">CREATE ACCOUNT</button> -->
            <div class="signup-new-customer">
              <button type="button" id="b_v_2">Next Step</button>
            <!-- <button type="button"  style="margin:0px;" class="next_step" id="" onclick="$('').submit();">NEXT1</button> -->
          </div>
          </div>

          <p>Already have an account? <a href="/auth/jsModallogin" data-toggle="modal" data-target="#login_modal" onclick="openLoginModal('login')">Login</a></p>

        </div>

      </div>


<!-- STEP2 FOR FITNESSITY FOR BUSINESS END -->






<!-- STEP 3 FOR FITNESSITY FOR BUSINESS START -->

<div id="fitnessity_for_business_step3" style="display:none;">

        <div class="pop-title">
          <h3>STEP 3</h3>
        </div>

        <button type="button" class="close modal-close" data-dismiss="modal">
          <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
        </button>           

        <div class="signup">    

          <div id='systemMessage'></div>

          <div class="signleft-customer">

             <input type="number" name="b_EINnumber" maxlength="10" id="b_EINnumber" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" size="30" maxlength="80" placeholder="EIN Number">
             <span class="error" id="b_ein"></span>
             <input type="text" name="b_Establishmentyear" id="b_Establishmentyear" size="30" maxlength="80" placeholder="Establishment Year">
             <input type="checkbox" id="b_trm1" class="form-check-input" value="1" style="position: relative;left: -48%;top: 26px;">
            <p style="font-size: 13.5px;float: none;margin-left: 8px;margin-top: 1%;">I agree to Fitnessity <a href="/terms-condition" target="_blank" class="t_c">Terms of Service</a> and <a href="/privacy-policy" target="_blank" class="t_c">Privacy Policy</a></p> 
             <input type="hidden" name="_token" value="{{csrf_token()}}">
             <!-- <div  class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div> -->
             <div id="captcha3"></div>
             <div id="captcha_error_div">
                <div class="error">
                Captcha is required
                </div>
              </div>
             
           </form>
          </div>

          <div class="signor"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>signor.jpg" height="403" width="59" /></div>
          <span style="margin-top:10px !important;"></span>
          <div class="signright-customer paddingTop">

            <h4>Sign up with a social network</h4>

            <div class="social-login">

              <a href="/socialauth/socialRegister/facebook/customer" class="fb-login">
                <i class="fa fa-facebook" aria-hidden="true"></i>
                SIGN UP WITH FACEBOOK
              </a>

              <a href="/socialauth/socialRegister/twitter/customer" class="tw-login">
                <i class="fa fa-twitter" aria-hidden="true"></i>
                SIGN UP WITH TWITTER
              </a>

              <a href="/socialauth/socialRegister/linkedin/customer" class="in-login">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
                SIGN UP WITH LINKEDIN
              </a>

              <a href="/socialauth/socialRegister/google/customer" class="plus-login">
                <i class="fa fa-google-plus" aria-hidden="true"></i>
                SIGN UP WITH GOOGLE-PLUS
              </a>

            </div>

          </div>

          <div class="modallink mt20">

            <!-- <p>By signing up, I agree to <a href="/terms-condition" data-toggle="modal" data-target="#terms_modal">Fitnessity Terms of Service</a> and <a href="/privacy-policy" data-toggle="modal" data-target="#terms_modal">Privacy Policy</a></p>  -->

            <!-- <button type="submit" class="btn btn-primary" id="register_submit">CREATE ACCOUNT</button> -->
            <div class="signup-new-customer">
              <button type="button" id="b_submit">Submit</button>
            <!-- <button type="button"  style="margin:0px;" class="next_step" id="" onclick="$('').submit();">NEXT1</button> -->
          </div>
          </div>

          <p>Already have an account? <a href="/auth/jsModallogin" data-toggle="modal" data-target="#login_modal" onclick="openLoginModal('login')">Login</a></p>

        </div>

      </div>


<!-- STEP3FOR FITNESSITY FOR BUSINESS END -->


    
  <!-- </div> -->
<div id="map"></div>
<script>

       function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -33.8688, lng: 151.2195},
      zoom: 13
    });
    var input = document.getElementById('pac-input');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
       
      
        // Location details
        for (var i = 0; i < place.address_components.length; i++) {
      for (var j = 0; j < place.address_components[i].types.length; j++) {
        if (place.address_components[i].types[j] == "postal_code") {
          document.getElementById('z').innerHTML = place.address_components[i].long_name;
        }
        if (place.address_components[i].types[j] == "locality") {
          document.getElementById('c').innerHTML = place.address_components[i].long_name;
        }
        if (place.address_components[i].types[j] == "country") {
          document.getElementById('p').innerHTML = place.address_components[i].long_name;
        }
        if (place.address_components[i].types[j] == "administrative_area_level_1") {
          document.getElementById('p').innerHTML = place.address_components[i].long_name;
        }
      }
    } 
    });
}

$(document).on("ajaxComplete", function(){
  
      $("#register_submit").click(function(){
        $('#frmregister').submit();
      });

    $("#frmregister").submit(function(e){

        e.preventDefault();



        // if($("#social_login").val() == 1) {
        //   registerUser();
        // }

          // check for validation
          $('#frmregister').validate({
              rules: {
                  firstname: "required",
                  lastname: "required",
                  password: {
                    required: true,
                    minlength: 8
                  },
                  confirm_password: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password"
                  },
                  email: {
                    required: true,
                    email: true
                  },
                  captcha: "required"
              },
              messages: {
                  firstname: "Enter your Firstname",
                  lastname: "Enter your Lastname",
                  password: {
                    required: "Provide a password",
                    minlength: jQuery.validator.format("Enter at least {0} characters")
                  },
                  confirm_password: {
                    required: "Repeat your password",
                    minlength: jQuery.validator.format("Enter at least {0} characters"),
                    equalTo: "Enter the same password as above"
                  },
                  email: {
                    required: "Please enter a valid email address",
                    minlength: "Please enter a valid email address",
                    remote: jQuery.validator.format("{0} is already in use")
                },
                captcha: "Enter your Confirmation Code"
              },
              submitHandler: registerUser
        });
  });

});
    
function registerUser() {
    
      var captch_response = $('.g-recaptcha-response').val();

      if(captch_response == "" || captch_response == null || captch_response == undefined){
         $("#captcha_error_div").show();
          return false;
      }

        $('#register_submit').prop('disabled', true);
        var validForm = $('#frmregister').valid();
        var posturl = '/auth/register';

        if (validForm) {

          var formData = $("#frmregister").serialize();

          
          $.ajax({
              url:posturl,
              type:'POST',
              dataType: 'json',
              data:formData,
              beforeSend: function () {
                $('#register_submit').prop('disabled', true);
                showSystemMessages('#systemMessage', 'info', 'Please wait while we register you with Fitnessity.');
              },
              complete: function () {
                $('#register_submit').prop('disabled', true);
              },
              success: function (response) {
                  showSystemMessages('#systemMessage', response.type, response.msg);
                  if(response.type === 'success'){
                    window.location.href = response.redirecturl;
                  }else{
                    $('#register_submit').prop('disabled', false);    
                  }
                }
            });
        }
}
$('#b_v_1').click(function(){
    $(".error").empty();
    if($("#b_firstname").val()!=''){
        if($("#b_lastname").val()!=''){
                if($("#b_email").val()!=''){
                    if(($("#b_contact").val()!='')&& ($("#b_contact").val().length>=10)){
                            if(($("#b_password").val()!='') && $("#b_password").val().length >=6){
                                if($("#b_confirm_password").val()==$("#b_password").val()){
                                  //  $('#fitnessity_for_business').hide();$('#signup_selection').hide();$('#fitnessity_for_business_step2').show(); 
                                    $('#fitnessity_for_business').hide();$('#signup_selection').hide();$('#fitnessity_for_business_step2').show();
                                }else{
                                    $("#b_cpass").text("Not match confirm password");       
                                }
                            }else{
                                $("#b_pass").text("Please Enter the Password more then 8 character ");   
                            }
                    }else{
                        $("#b_cot").text("Please Enter the Contact number ");
                    }
                }else{
                    $("#b_eml").text("Please Enter the email");
                }
            }else{
    $("#b_ln").text("Please Enter the lastname ");
            }
    
    }else{
    $("#b_fn").text("Please Enter the firstname ");
    }
    });

   /* two */
   

   $('#b_v_2').click(function(){
    $(".error").empty();
    if($("#b_companyname").val()!=''){
        if($("#b_address").val()!=''){
                if($("#b_state").val()!=''){
                    if($("#b_city").val()!=''){
                        if($("#b_zipcode").val()!=''){
                            if($("#b_country").val()!=''){
                                $('#fitnessity_for_business_step2').hide();$('#signup_selection').hide();$('#fitnessity_professional_step').hide();$('#fitnessity_for_business_step3').show();
                            }else{
                                $("#b_cont").text("Please Enter the Country name ");
                            }
                        }else{
                            $("#b_zip").text("Please Enter the Zip code ");
                        }
                    }else{
                        $("#b_ct").text("Please Enter the City");
                    }
                }else{
                    $("#b_sta").text("Please Enter the State");
                }
            }else{
    $("#b_addr").text("Please Enter the Address ");
            }
    
    }else{
    $("#b_cmpo").text("Please Enter the Company");
    }
    });

    /* three 
    
    */
   $("#b_submit").click(function(){
    $(".error").empty();
    if($("#b_EINnumber").val()!=''){
        if($('#b_Establishmentyear').val()!=""){
            if($('#b_trm').prop("checked") == true){
                   // $('#fitnessity_for_business_step2').hide();$('#signup_selection').hide();$('#fitnessity_professional_step').hide();$('#fitnessity_for_business_step3').show();
                  b_submit();
            }else{
                alert("Please Accept Terms of Service");
            }
        }else{
            
            $("#b_estb").text("Please Enter the Establishment Year ");
        }
    }else{
        $("#b_ein").text("Please Enter the EIN number");
    }

   });

   function b_submit(){
var posturl = '/auth/registerBusiness';
 $('#b_submit').prop('disabled', true);
var formData = {
          firstname:$("#b_firstname").val(),
          lastname : $("#b_lastname").val(),
          email:$("#b_email").val(),
          phone_number:$("#b_contact").val(),
          password : $("#b_password").val(),
          company_name:$("#b_companyname").val(),
          address:$("#b_address").val(),
          state:$("#b_state").val(),
          city:$("#b_city").val(),
          zipcode:$("#b_zipcode").val(),
          b_EINnumber:$("#b_EINnumber").val(),
          b_Establishmentyear:$("#b_Establishmentyear").val(),
          country:$("#b_country").val(),
          _token:$("#b_token").val()
        }
        $.ajax({
              url:posturl,
              type:'POST',
              dataType: 'json',
              data:formData,
              headers: {'X-CSRF-TOKEN': $("#_token").val()},
              beforeSend: function () {
                $('#b_submit').prop('disabled', true);
                showSystemMessages('#systemMessage', 'info', 'Please wait while we register you with Fitnessity.');
              },
              complete: function () {
                $('#b_submit').prop('disabled', false);
              },
              success: function (response) {
                  showSystemMessages('#systemMessage', response.type, response.msg);
                  if(response.type === 'success'){
                    window.location.href = response.redirecturl;
                  }
                }
            });
   }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBeg1QiN3CKYXroVj8ivV9_Rq6E-xOkzno&libraries=places&callback=initMap"
        async defer></script>
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

    var url = '/me?fields=id,name,email,permissions';
      FB.api(url, function(response) {
        console.log(JSON.stringify(response));
        $("#social_login").val(1);
        $("#social_id").val(response.id);
        $("#social_name").val(response.name);
        $("#social_email").val(response.email);
        $("#social_provider").val('Facebook');
        $("#frmregister").submit();
    });
  }
</script> -->