<?php
include(base_path().'/buddy/wp-load.php');
?>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <style>
   .modal{
       z-index:99999;
   }
.mybtns{
  float: left;
    color: #bdbdbd;
    font-family: 'Roboto Condensed', sans-serif;
    padding: 7px 15px;
    font-size: 16px;
    background: none;
    transition: 0.5s;
    border: none;
    text-transform: uppercase;
}
   section.search {
    position: absolute;
    background: #ffffff;
    width: 100%;
    display: none;
}
#srfld{
    width: 792px;
    border: none;
    display: inherit;
    float: left;
    webkit-box-shadow: unset !important;
    box-shadow:unset;
}
.close-search{
    float: right;
    background: #b9babc;
    color: #ffff;
    right: 18px;
    position: absolute;
    top: 14px;
    border-radius: 135px;
    padding: 5px 10px;
}
.srbtn{
    float: left;
    margin-left: 15px;
    margin-right: 7px;
    border: 0;
    background: transparent;
    font-size: 23px;
    color: #b9babc;
}
   </style> 
  
    <section class="search">
<div class="container-fluid">
<div class="row">	
    
		<a href="#" class="close-search clsbtn"><i class="fa fa-times" aria-hidden="true"></i></a>
	</div>

</div>
    </section>
        <header>        

            <div class="logo 11">

                <a href="/"> <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>logo_new.png" height="63" width="300" /> </a>

            </div>

            <div id="nav">

                <div class="dropdown header-search" style="display:none">
                     <form id="searchform" method="post" action="/filter">
                     {!! Form::token() !!}
                    <!-- <button class="btn btn-primary" type="button" data-toggle="dropdown"> -->
                        <!-- LOREM IPSUM  -->
                        <input type="text" name="label" placeholder="Type to Search" style="background-color: black;color:white;padding:8px" value="@if(isset($selected_label) && $selected_label != NULL){{$selected_label }}@endif">
                       
                         <input type="hidden" name="top" id="top" value="topfilter">
                        <!-- <i class="fa fa-angle-down"></i>  </button> -->

                   <!--  <ul class="dropdown-menu">

                        <li><a href="#">Lorem ipsum</a></li>

                        <li><a href="#">Lorem ipsum</a></li>

                        <li><a href="#">Lorem ipsum</a></li>

                    </ul> -->

                    <button type="submit" class="btn btn-info btn-lg header-search-a" data-toggle="modal" data-target="#myModal3"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>search.png" height="17" width="19" /></button>
                    </form>
                    <!-- Modal -->

                    <!--<div class="modal fade" id="myModal3" role="dialog">

                        <div class="modal-dialog modal-elg">


                            <div class="modal-content">

                                <div class="modal-body login-pad">

                                    <div class="pop-title">

                                        <h3>OPTIONS IS YOURS</h3>

                                    </div>

                                    <button type="button" class="close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>/close.jpg" height="70" width="34"/> </button>

                                    <div class="signup advance-search-popup">

                                        <p class="advance-para">Choose how you would like to search and hire a service</p>

                                        <div class="signleft">

                                            <h3>QUICK HIRE</h3>

                                            <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima</p>

                                            <a href="#">CONTINUE</a>

                                        </div>

                                        <div class="signright">

                                            <h3>DIRECT HIRE</h3>

                                            <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima</p>

                                            <a href="#">CONTINUE</a>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>-->

                </div>

                <nav class="navbar navbar-inverse">

                    <!-- <div class="navbar-header">

                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">

                        <span class="icon-bar"></span>

                        <span class="icon-bar"></span>

                        <span class="icon-bar"></span>

                        </button>

                    </div> -->

                    <div class="collapse navbar-collapse" id="myNavbar">

                       <!--  <ul class="nav navbar-nav"> -->

                            <!-- <li><a href="#">BROWSE       </a></li> -->

                            <!-- <li><a href="#">HOW IT WORKS</a></li> -->

                            <!-- <li><a href="/store">STORE</a></li> -->

                            <!-- <li><a href="/userevents">EVENTS</a></li> -->

                            <!-- <li><a href="/jobs">JOBS</a></li> -->

                            <!-- <li><a href="/network/getcontacts">NETWORK</a></li> -->

                        <!-- </ul> -->

                    </div>

                </nav>

            </div>

            <div class="header-right">

               <!--  <button type="button" class="btn btn-info btn-lg header-right-menu" data-toggle="modal" id="btn_feedback" data-target="#feedback_modal" href="/feedback/jsModalfeedback" style="margin-right:20px;">
                SAY SOMETHING ABOUT FITNESSITY
                </button> -->

                @if (Auth::guest())

                <button type="button" class="btn btn-info btn-lg header-right-menu" data-toggle="modal" data-target="#login_modal" 
                href="/auth/jsModallogin" id="loginbtn"><i class="fa fa-unlock-alt" aria-hidden="true"></i></button>

                <button type="button" class="btn btn-info btn-lg header-right-menu signupmodal" data-toggle="modal" data-target="#register_modal"
                href="/auth/jsModalregister" onclick="$('#fitnessity_for_business').hide();$('#learnmoreCustomer').hide();$('#learnmore').hide();$('#fitnessity_for_business_step2').hide();$('#fitnessity_for_business_step3').hide();$('#fitnessity_professional').hide();$('#fitnessity_professional_step2').hide();$('#fitnessity_professional_step3').hide();$('input').val('');$('.error.b_eml').hide()">SIGN UP</button>

                <!-- <a href="/auth/jsModalregister" class="header-right-menu" data-toggle="modal" data-target="#register_modal">SIGN UP</a> -->

                @else
                <button type="button" style="display:none" class="btn btn-info btn-lg header-right-menu" data-toggle="modal" data-target="#login_modal" 
                href="/auth/jsModallogin" id="loginbtn"><i class="fa fa-unlock-alt" aria-hidden="true"></i></button>

                <?php $loggedinUser = Auth::user(); ?>
                @if($loggedinUser['role'] == "customer")
                @if(Request::url() == 'https://fitnessity.co/profile/viewProfile')
                <a type="button" class="btn btn-info btn-lg header-right-menu"
                href="{{url('/?ver=activitybook')}}" id="booklessonbtn"> BOOK AN ACTIVITY <i class="fa fa-angle-right"></i></a>
                @else
                <button type="button" class="btn btn-info btn-lg header-right-menu" data-toggle="modal" data-target="#lesson_modal"
                href="/lesson/jsModallesson/booklesson" id="booklessonbtn"> BOOK AN ACTIVITY <i class="fa fa-angle-right"></i></button>
                @endif
                @endif
                
                <a type="button" class="btn btn-info btn-lg header-right-menu"
                href="{{url('/reviews')}}"> WRITE A REVIEW <i class="fa fa-angle-right"></i></a>
                
                <button type="button" style="display:none;" class="btn btn-info btn-lg header-right-menu signupmodal" data-toggle="modal" data-target="#register_modal"
                href="/auth/jsModalregister" onclick="$('#fitnessity_for_business').hide();$('#learnmoreCustomer').hide();$('#learnmore').hide();$('#fitnessity_for_business_step2').hide();$('#fitnessity_for_business_step3').hide();$('#fitnessity_professional').hide();$('#fitnessity_professional_step2').hide();$('#fitnessity_professional_step3').hide();$('input').val('');$('.error.b_eml').hide()">SIGN UP</button>
                 @if((strpos(Request::url(), 'pcompany/view')) !== false)
                 <a type="button" style="cursor:hand;" class="header-right-menu topbtn" id="btn_myprofile1">MY PROFILE </a>
                 @else
                 <a href="/profile/viewProfile" class="header-right-menu topbtn" id="btn_myprofile">MY PROFILE </a>
                 @endif
                 
                <form method="post" id="buddyloginform" action="/buddy/wp-login.php" style="float: left;margin-right: 5px; display:none">
        <input type="hidden" name="log" id="user_login" value="<?php echo substr($loggedinUser['email'], 0, strpos($loggedinUser['email'], "@"));?>">
        <input type="hidden" name="pwd" id="user_pass" value="<?php echo $loggedinUser['buddy_key'];?>">
        <input type="hidden" name="redirect_to" id="redirect_to" value="{{URL::to('/buddy')}}">
        <input type="hidden" value="<?php echo wp_create_nonce();?>" name="_wpnonce">
        <input type="submit" name="wp-submit" class="header-right-menu topbtn my_act_feed" value="My Activity Feed"> 
        </form>

                <button type="button" class="btn btn-info btn-lg btnlogout"  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  data-toggle="tooltip" title="" data-original-title="Logout" >
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
      </form><i class="fa fa-unlock-alt" aria-hidden="true"></i></button>

                @endif

            </div>

            <!-- login modal -->
            <div class="modal fade" id="login_modal" role="dialog">
              <div class="modal-dialog modal-lg">
                    <div class="modal-content" id="login_modal_content"></div>
              </div>
            </div>

            <!-- signup modal -->
            <div class="modal fade" id="register_modal" role="dialog">
              <div class="modal-dialog modal-lg">
                    <div class="modal-content" id="register_modal_content">
                        
                    </div>
              </div>
            </div>

            <!-- forgot password modal -->
            <div class="modal fade" id="password_modal" role="dialog">
              <div class="modal-dialog modal-lg">
                    <div class="modal-content" id="password_modal_content"></div>
              </div>
            </div>

            <!-- feedback modal -->
            <div class="modal fade" id="feedback_modal" role="dialog">
              <div class="modal-dialog modal-lg">
                    <div class="modal-content" id="feedback_modal_content"></div>
              </div>
            </div>

            <!-- network modal -->
            <div class="modal fade" id="network_modal" role="dialog">
              <div class="modal-dialog modal-lg">
                    <div class="modal-content" id="network_modal_content"></div>
              </div>
            </div>

             <!-- sports modal -->
            <div class="modal fade" id="sports_modal" role="dialog">
              <div class="modal-dialog modal-lg">
                    <div class="modal-content" id="sports_modal_content"></div>
              </div>
            </div>

            <div id="lesson_section">
                <!-- book a lesson modal -->
                <div class="modal fade active" id="lesson_modal" role="dialog">
                  <div class="modal-dialog modal-lg" style="width: 90%;">
                        <div class="modal-content" id="lesson_modal_content"></div>
                  </div>
                </div>
            </div>
            

    </header>
    
    <!--end header-->

    <script>

    $(document).ready(function(){
        if(window.location.href.split('?showstep=').pop() == 1 ){
            $(".signupmodal").click()
        }
        $(".modal").on("shown.bs.modal", function(){ 
            $('body').addClass('modal-open');
        });
        
        $("#btn_myprofile1").click(function(){
            formdata = new FormData();
            var token = '{{csrf_token()}}';
            formdata.append("_token",token)
            $.ajax({
              url:'/profile/switchaccount',
              type:'POST',
              dataType: 'json',
              data:formdata,
              processData: false,
              contentType: false,
              headers: {'X-CSRF-TOKEN': $("#_token").val()},
              success: function (response) {
                  if(response.type === 'success'){
                     // $('#upgradeProfileForm').modal('hide'); 
                    window.location.href= "/profile/viewProfile";
                  }
                }
            });
        })

        $(".modal").on("hidden.bs.modal", function(){
            var modal_id = $(this).attr('id');
            if(modal_id == "feedback_modal") {
              $(this).find("#rating").val("");
              $(this).find("#stars").find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty");
              $(this).find("#comment").val("");
              $(this).find("#suggestion").val("");
              if(!$(this).find("#name").attr("readonly"))
                $(this).find("#name").val("");
              if(!$(this).find("#email").attr("readonly"))
                $(this).find("#email").val("");
              $(this).find("#systemMessage").html('');
            } else if(modal_id == "register_modal") {
                $(this).find('#signup_normal').show();
                $(this).find('#signup_selection').hide();
                $(this).find("#firstname").val("");
                $(this).find("#lastname").val("");
                $(this).find("#email").val("");
                $(this).find("#password").val("");
                $(this).find("#confirm_password").val("");
                $(this).find("label.error").remove();
                grecaptcha.reset();
            }
            else{
              $(this).removeData();
              // $(this).find("#systemMessage").html(''); 
            }
        });

        $("button").click(function() {

            // $('#signup_selection').hide();
            // $('#signup_normal').show();
        });

        //register validations

        // fetch param from url
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : sParameterName[1];
                }
            }
        };
        
        //if found the success param and its true than open login modal
        var status = getUrlParameter('success');
        if(status === "true"){
            $('#loginbtn').trigger('click');
        }
        
    });    
    
    function openLoginModal(modalname) {
        if(modalname == 'login') {
            $("#register_modal").modal('hide');
            $("#password_modal").modal('hide');
          }
        else if(modalname == 'register') {
            // $("#learnmore_modal").modal('hide');
            // $("#communitylearnmore_modal").modal("hide");
            $("#login_modal").modal('hide');            
            $("#password_modal").modal('hide');
          }
        else if(modalname == 'password') {
            $("#login_modal").modal('hide');
            $("#register_modal").modal('hide');
          }
        else if(modalname == 'learnmore') {
            $("#login_modal").modal('hide');
            $("#register_modal").modal('hide');
        }
        else if(modalname == 'terms_condition') {
            $("#terms_modal").modal('show');
        }
        else if(modalname == 'sport-alert') {
            $("#login_modal").modal('hide');
        }           
    }
    
    </script>