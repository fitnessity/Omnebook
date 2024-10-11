 <style>
 .mt83{
  margin-top: 83px;
}
input {
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
  
</script>
<script>
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
            


        
        <div class="signleft">
          <div class="new-signup-middle">

            <h2>FITNESS ENTHUSIASTS </h2>
            <p style="margin-top: 25% !important;">Are you an athlete, parent, fitness enthusiast or new comer looking for training, activities, & adventures in multiple sports? Learn, share life experiences & make friends while interacting with a thriving fitness community near you.</p>
            <button type="button" onclick="$('#signup_selection').hide();$('#signup_normal').show();">SIGN UP</button>

            <a href="javascript:void();" onclick="$('#signup_selection').hide();$('#learnmoreCustomer').show();">LEARN MORE <i class="fa fa-angle-right" aria-hidden="true"></i></a>
          </div>
        </div>  
        <div class="signor">
          <img src="
          <?php echo Config::get('constants.FRONT_IMAGE'); ?>signor.jpg" height="403" width="59" />
        </div>
        <div class="signright">
                <div class="new-signup-left">
                
                  <h2>FITNESSITY FOR BUSINESS</h2>
                  <p style="margin-top: 36% !important;"> Do you operate a gym, training facility, or other local business that offer sports or fitness oriented activities in multiple sports? Sign up and list your business for free and become a partner.</p>
                  <button type="button" onclick="$('#signup_selection').hide();$('#fitnessity_for_business').show();">SIGN UP</button>
                  <!-- <a href="javascript:void();" data-toggle="modal" data-target="#learnmore_modal"  onclick="openLoginModal('learnmore')">LEARN MORE <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                  <a href="javascript:void();" onclick="$('#signup_selection').hide();$('#learnmore').show();">LEARN MORE <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </div>          
            </div>

        <!-- Fitness Professional -->
        <div class="signor">
          <img src="
          <?php echo Config::get('constants.FRONT_IMAGE'); ?>signor.jpg" height="403" width="59" />
        </div>
        <div class="signright">
          <div class="new-signup-right">

            <h2>FITNESS PROFESSIONAL </h2>
            <p style="margin-top: 25% !important;">Do you work as a personal trainer, coach, instructor, nutritionist, therapist or another provider offering services & activities in multiple sports? Sign up and list your business for free.<br><br></p>
            <button type="button" onclick="$('#signup_selection').hide();$('#fitnessity_professional').show();">SIGN UP</button>

            <a href="javascript:void();" onclick="$('#signup_selection').hide();$('#learnmoreCustomer').show();">LEARN MORE <i class="fa fa-angle-right" aria-hidden="true"></i></a>
          </div>
        </div>

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
             <input type="number" name="contactb" id="b_contact" size="30" placeholder="Contact No" size="30" maxlength="10"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
             <span class="error" id="b_cot"></span>
             <input type="password" name="passwordb" id="b_password" size="30" placeholder="Password">
             <span class="error" id="b_pass"></span>
             <input type="password" name="confirm_passwordb" id="b_confirm_password" size="30" placeholder='Confirm Password'>
             <span class="error" id="b_cpass"></span>
             <input type="hidden" name="_token" id="b_token" value="{{csrf_token()}}">
             <!-- <div  class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div> -->
             <!-- <div id="captcha2"></div>
             <div id="captcha_error_div" style="display:none;">
                <div class="error">
                Captcha is required
                </div>
              </div> -->
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
             <input type="text" name="Address" id="b_address" size="30" maxlength="80" placeholder="Address">
              <span class="error" id="b_addr"></span>
             <input type="text" name="State" id="b_state" size="30" placeholder="State" size="30" maxlength="80">
              <span class="error" id="b_sta"></span>
             <input type="text" name="City" id="b_city" size="30" placeholder="City" size="30" maxlength="80">
              <span class="error" id="b_ct"></span>
             <input type="number" name="Zip Code" id="b_zipcode" size="30" placeholder="Zip Code">
              <span class="error" id="b_zip"></span>
             <input type="text" name="Country" id="b_country" size="30" placeholder='Country'>
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

             <input type="number" name="b_EINnumber" id="b_EINnumber" size="30" maxlength="80" placeholder="EIN Number">
             <span class="error" id="b_ein"></span>
             <input type="text" name="b_Establishmentyear" id="b_Establishmentyear" size="30" maxlength="80" placeholder="Establishment Year">
             <span class="error" id="b_estb"></span>
             <div id="captcha2"></div>
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

            <p><input type="checkbox" id="b_trm" class="form-check-input" value="1"> By signing up, I agree to Fitnessity <a href="/terms-condition" target="_blank">Terms of Service</a> and <a href="/privacy-policy" target="_blank">Privacy Policy</a></p>   

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















<!-- STEP1 FOR FITNESSITY Professional START -->

    <div id="fitnessity_professional" style="display:none;">

        <div class="pop-title">
          <h3>STEP 1</h3>
        </div>

        <button type="button" class="close modal-close" data-dismiss="modal">
          <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
        </button>           

        <div class="signup">    

          <div id='systemMessage'></div>

          <div class="signleft-customer">

            <form id="frmregister" method="post">

             <input type="text" name="firstnamep" id="p_firstname" size="30" maxlength="80" placeholder="First Name">
             <span class="error" id="p_fn"></span>
             <input type="text" name="lastnamep" id="p_lastname" size="30" maxlength="80" placeholder="Last Name">
             <span class="error" id="p_ ln"></span>
             <input type="email" name="emailp" id="p_email" size="30" placeholder="Email Address" size="30" maxlength="80">
             <span class="error" id="p_eml"></span>
             <input type="number" name="contactp" id="p_contact" size="30" placeholder="Contact No" size="30" maxlength="10"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
             <span class="error" id="p_cot"></span>
             <input type="password" name="passwordp" id="p_password" size="30" placeholder="Password">
             <span class="error" id="p_pass"></span>
             <input type="password" name="confirm_passwordp" id="p_confirm_password" size="30" placeholder='Confirm Password'>
             <span class="error" id="p_cpass"></span>
             <input type="hidden" name="_token" id="p_token" value="{{csrf_token()}}">
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
              <button type="button" id="p_v_1" onclick="">Next Step</button>
            <!-- <button type="button"  style="margin:0px;" class="next_step" id="" onclick="$('').submit();">NEXT1</button> -->
          </div>
          </div>

          <p>Already have an account? <a href="/auth/jsModallogin" data-toggle="modal" data-target="#login_modal" onclick="openLoginModal('login')">Login</a></p>

        </div>

      </div>
<!-- STEP1 FOR FITNESSITY prefessional END -->





<!-- STEP2 FOR FITNESSITY prefessional START -->

<div id="fitnessity_professional_step2" style="display:none;">

        <div class="pop-title">
          <h3>STEP 2</h3>
        </div>

        <button type="button" class="close modal-close" data-dismiss="modal">
          <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
        </button>           

        <div class="signup">    

          <div id='systemMessage'></div>

          <div class="signleft-customer">

           

            
             <input type="text" name="Companyname" id="p_companyname" size="30" maxlength="80" placeholder="Company Name">
             <span class="error" id="p_cmpo"></span>
             <input type="text" name="Address" id="p_address" size="30" maxlength="80" placeholder="Address">
             <span class="error" id="p_addr"></span>
             <input type="text" name="State" id="p_state" size="30" placeholder="State" size="30" maxlength="80">
             <span class="error" id="p_sta"></span>
             <input type="text" name="City" id="p_city" size="30" placeholder="City" size="30" maxlength="80">
             <span class="error" id="p_ct"></span>
             <input type="number" name="Zip Code" id="p_zipcode" size="30" placeholder="Zip Code">
             <span class="error" id="p_zip"></span>
             <input type="text" name="Country" id="p_country" size="30" placeholder='Country'>
             <span class="error" id="p_cont"></span>
            
           
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
              <button type="button" id="p_v_2">Next Step</button>
            <!-- <button type="button"  style="margin:0px;" class="next_step" id="" onclick="$('').submit();">NEXT1</button> -->
          </div>
          </div>

          <p>Already have an account? <a href="/auth/jsModallogin" data-toggle="modal" data-target="#login_modal" onclick="openLoginModal('login')">Login</a></p>

        </div>

      </div>


<!-- STEP2 FOR FITNESSITY Professional END -->






<!-- STEP 3 FOR FITNESSITY Professional START -->

<div id="fitnessity_professional_step3" style="display:none;">

        <div class="pop-title">
          <h3>STEP 3</h3>
        </div>

        <button type="button" class="close modal-close" data-dismiss="modal">
          <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
        </button>           

        <div class="signup">    

          <div id='systemMessage'></div>

          <div class="signleft-customer">

           
             
             <input type="number" name="EINnumber" id="p_EINnumber" size="30" maxlength="80" placeholder="EIN Number">
             <span class="error" id="p_ein"></span>
             <input type="number" name="SSNnumber" id="p_SSNnumber" size="30" maxlength="80" placeholder="SSN Number">
             <span class="error" id="p_ssn"></span>
             <input type="text" name="Establishmentyear" id="p_Establishmentyear" size="30" maxlength="80" placeholder="Establishment Year">
             <span class="error" id="p_estb"></span>
           
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
            
            <p><input type="checkbox" id="p_trm" class="form-check-input" value=""> By signing up, I agree to Fitnessity <a href="/terms-condition" target="_blank">Terms of Service</a> and <a href="/privacy-policy" target="_blank">Privacy Policy</a></p>   

            <!-- <button type="submit" class="btn btn-primary" id="register_submit">CREATE ACCOUNT</button> -->
            <div class="signup-new-customer">
              <button type="button" id="p_submit">Submit</button>
            <!-- <button type="button"  style="margin:0px;" class="next_step" id="" onclick="$('').submit();">NEXT1</button> -->
          </div>
          </div>

          <p>Already have an account? <a href="/auth/jsModallogin" data-toggle="modal" data-target="#login_modal" onclick="openLoginModal('login')">Login</a></p>

        </div>

      </div>


<!-- STEP3FOR FITNESSITY professional END -->


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

             <input type="text" name="firstname" id="c_firstname" size="30" maxlength="80" placeholder="First Name">
             <span class="error" id="c_fn"></span>
             <input type="text" name="lastname" id="c_lastname" size="30" maxlength="80" placeholder="Last Name">
             <span class="error" id="c_ln"></span>
             <input type="email" name="email" id="c_email" size="30" placeholder="Email Address" size="30" maxlength="80">
             <span class="error" id="c_eml"></span>
             <input type="number" name="contact" id="c_contact" size="30" placeholder="Contact No" size="30" maxlength="10"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
             <input type="password" name="password" id="c_password" size="30" placeholder="Password">
             <span class="error" id="c_pass"></span>
             <input type="password" name="confirm_password" id="c_confirm_password" size="30" placeholder='Confirm Password'>
             <span class="error" id="c_cpass"></span>
             <input type="hidden" name="_token" value="{{csrf_token()}}">
             <div  class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div> 
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

            <p>By signing up, I agree to Fitnessity <a href="/terms-condition" target="_blank">Terms of Service</a> and <a href="/privacy-policy" target="_blank">Privacy Policy</a></p>   

            <!-- <button type="submit" class="btn btn-primary" id="register_submit">CREATE ACCOUNT</button> -->
            <div class="signup-new-customer">
            <button type="button"  style="margin:0px;" class="signup-new button" id="register_submit" onclick="">CREATE ACCOUNT</button>
          </div>
          </div>

          <p>Already have an account? <a href="/auth/jsModallogin" data-toggle="modal" data-target="#login_modal" onclick="openLoginModal('login')">Login</a></p>

        </div>

      </div>

      <!-- signup_normal div ends --> 

    </div>
    
  <!-- </div> -->

<script>
  
$(document).ready(function(){
  
      $("#register_submit").click(function(){

    $(".error").empty();
    if($("#c_firstname").val()!=''){
        if($("#c_lastname").val()!=''){
                if($("#c_email").val()!=''){
                    if(($("#c_contact").val()!='') && ($("#c_contact").val().length>=10)){
                            if(($("#c_password").val()!='')&& $("#c_password").val().length >=8){
                                if($("#c_confirm_password").val()==$("#c_password").val()){
                                   registerUser();
                                }else{
                                    $("#c_cpass").text("Not match confirm password");       
                                }
                            }else{
                                $("#c_pass").text("Please Enter the Password, more then 8 character");   
                            }
                    }else{
                        $("#c_cot").text("Please Enter the Contact number");
                    }
                }else{
                    $("#c_eml").text("Please Enter the Email");
                }
            }else{
    $("#c_ln").text("Please Enter the Lastname ");
            }
    
    }else{
    $("#c_fn").text("Please Enter the Firstname ");
    }
        
      });

    


    
function registerUser() {
  
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
                            if(($("#b_password").val()!='') && $("#b_password").val().length >=8){
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
   $('#p_v_1').click(function(){
    $(".error").empty();
    if($("#p_firstname").val()!=''){
        if($("#p_lastname").val()!=''){
                if($("#p_email").val()!=''){
                    if(($("#p_contact").val()!='') && ($("#p_contact").val().length>=10)){
                            if(($("#p_password").val()!='') && $("#p_password").val().length >=8 ){
                                if($("#p_confirm_password").val()==$("#p_password").val()){
                                    $('#fitnessity_professional').hide();$('#signup_selection').hide();$('#fitnessity_professional_step2').show();
                                }else{
                                    $("#p_cpass").text("Not match confirm password");       
                                }
                            }else{
                                $("#p_pass").text("Please Enter the more then 8 character ");   
                            }
                    }else{
                        $("#p_cot").text("Please Enter the Contact");
                    }
                }else{
                    $("#p_eml").text("Please Enter the Email");
                }
            }else{
    $("#p_ln").text("Please Enter the Lastname");
            }
    
    }else{
    $("#p_fn").text("Please Enter the Firstname");
    }
    });

   /* two */
   

   $('#p_v_2').click(function(){
    $(".error").empty();
    if($("#p_companyname").val()!=''){
        if($("#p_address").val()!=''){
                if($("#p_state").val()!=''){
                    if($("#p_city").val()!=''){
                        if($("#p_zipcode").val()!=''){
                            if($("#p_country").val()!=''){
                                $('#fitnessity_professional_step2').hide();$('#signup_selection').hide();$('#fitnessity_professional_step3').show();
                            }else{
                                $("#p_cont").text("Please Enter the Country");
                            }
                        }else{
                            $("#p_zip").text("Please Enter the ZipCode");
                        }
                    }else{
                        $("#p_ct").text("Please Enter the City");
                    }
                }else{
                    $("#p_sta").text("Please Enter the State");
                }
            }else{
    $("#p_addr").text("Please Enter the Address");
            }
    
    }else{
    $("#p_cmpo").text("Please Enter the Company");
    }
    });

    /* three 
    
    */
   $("#p_submit").click(function(){
    $(".error").empty();
    if($("#p_EINnumber").val()!=''){
        if($("#p_SSNnumber").val()!=''){
        if($('#p_Establishmentyear').val()!=""){
            if($('#p_trm').prop("checked") == true){
               // $('#fitnessity_professional_step2').hide();$('#signup_selection').hide();$('#fitnessity_professional_step3').hide();
                  p_submit();
            }else{
                alert("Please Accept Terms of Service");
            }
        }else{
            
            $("#p_estb").text("Please Enter the Establishment year");
        }
        }else{
            $("#p_ssn").text("Please Enter the SSN");
        }
    }else{
        $("#p_ein").text("Please Enter the EIN");
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
                $('#b_submit').prop('disabled', true);
              },
              success: function (response) {
                  showSystemMessages('#systemMessage', response.type, response.msg);
                  if(response.type === 'success'){
                    window.location.href = response.redirecturl;
                  }else{
                    $('#b_submit').prop('disabled', false);    
                  }
                }
            });
   }
   function p_submit(){
var posturl = '/auth/registerProfessional';
 $('#p_submit').prop('disabled', true);
var formData = {
          firstname:$("#p_firstname").val(),
          lastname : $("#p_lastname").val(),
          email:$("#p_email").val(),
          phone_number:$("#p_contact").val(),
          password : $("#p_password").val(),
          company_name:$("#p_companyname").val(),
          address:$("#p_address").val(),
          state:$("#p_state").val(),
          city:$("#p_city").val(),
          zipcode:$("#p_zipcode").val(),
          p_EINnumber:$("#p_EINnumber").val(),
          p_Establishmentyear:$("#p_Establishmentyear").val(),
          country:$("#p_country").val(),
          _token:$("#p_token").val()
        }
        $.ajax({
              url:posturl,
              type:'POST',
              dataType: 'json',
              data:formData,
              headers: {'X-CSRF-TOKEN': $("#_token").val()},
              beforeSend: function () {
                $('#p_submit').prop('disabled', true);
                showSystemMessages('#systemMessage', 'info', 'Please wait while we register you with Fitnessity.');
              },
              complete: function () {
                $('#p_submit').prop('disabled', true);
              },
              success: function (response) {
                  showSystemMessages('#systemMessage', response.type, response.msg);
                  if(response.type === 'success'){
                    window.location.href = response.redirecturl;
                  }else{
                    $('#p_submit').prop('disabled', false);    
                  }
                }
            });
   }
   });
</script>
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

  // Load the SDK fbAsyncInithronously
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