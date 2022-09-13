    <script src="https://www.google.com/recaptcha/api.js"></script>
    
        <header>        

            <div class="logo">

                <a href="/"> <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>logo-300x63.png" height="63" width="300" /> </a>

            </div>

            <div id="nav">

                <div class="dropdown header-search" style="display:none">
                     <form id="searchform" method="post" action="/filter">
                    <!-- <button class="btn btn-primary" type="button" data-toggle="dropdown"> -->
                        <!-- LOREM IPSUM  -->
                        <input type="text" name="label" placeholder="Type to Search" style="background-color: black;color:white;padding:8px" value="@if(isset($selected_label) && $selected_label != NULL){{$selected_label }}@endif">
                         <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
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

                <button type="button" class="btn btn-info btn-lg header-right-menu" data-toggle="modal" data-target="#register_modal"
                href="/auth/jsModalregister" onclick="$('#learnmoreCustomer').hide();$('#learnmore').hide();">SIGN UP</button>

                <!-- <a href="/auth/jsModalregister" class="header-right-menu" data-toggle="modal" data-target="#register_modal">SIGN UP</a> -->

                @else

                <?php $loggedinUser = Auth::user(); ?>
                @if($loggedinUser['role'] == "customer")
                <button type="button" class="btn btn-info btn-lg header-right-menu" data-toggle="modal" data-target="#lesson_modal"
                href="/lesson/jsModallesson/booklesson" id="booklessonbtn"> BOOK A LESSON <i class="fa fa-angle-right"></i></button>
                @endif

                <a href="/timeline" class="header-right-menu topbtn" id="btn_myprofile">MY PROFILE </a>

                <button type="button" class="btn btn-info btn-lg btnlogout" data-toggle="modal" id="btn_logout" 
                title="Logout" onclick="window.location = '/auth/logout'" ><i class="fa fa-unlock-alt" aria-hidden="true"></i></button>

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
                  <div class="modal-dialog modal-lg">
                        <div class="modal-content" id="lesson_modal_content"></div>
                  </div>
                </div>
            </div>
            

    </header>
    
    <!--end header-->

    <script>

    $(document).ready(function(){

        $(".modal").on("shown.bs.modal", function(){ 
            $('body').addClass('modal-open');
        });

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
                $(this).find('#signup_selection').show();
                $(this).find('#signup_normal').hide();
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