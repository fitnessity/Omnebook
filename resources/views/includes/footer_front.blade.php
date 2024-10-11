<footer>
    <div class="container">
    
    <div class="row">
    	<div class="col-md-3">
            <div class="footer-logo">
                <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>logo-footer-250x53.png"/>
                <p>Subscribe to stay informed with updates and news.</p>
                <span style="display:none;color:orange;" id="thank_you"> Thank you for subscribing newsletter! </span>
                <span style="display:none;color:yellow;" id="already_register"> You have already subscribed newsletter! </span>
                <span style="display:none;color:red;" id="invalid_data"> Please enter valid details! </span>
                <span style="display:none;color:red;" id="error_msg"> Something went wrong, please try after sometime! </span>
    
                <form method="post" id="submit_newsletter">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input type="text" name="name" id="newsletter_name" class="form-control" placeholder="Enter Name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                            <input type="email" id="newsletter_email" placeholder="Enter Email Address" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row col-md-12 form-group">
                        <button class="btn-u" type="submit" >Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-3">
            <div class="footer-link">
                <h1>FINESSITY</h1>
                <a href="/about-us">- About Us</a>
                <a href="/claim-your-business">- Claim your Business</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="footer-link">
                <h1>NEED HELP ?</h1>
                <!-- <a href="#">- Help Center Us</a> -->
                <a href="/contact-us">- Contact Us</a>
                <!-- <a href="#">- Send Us Inquiry</a> -->
                <a href="{{route('help')}}">- Help Center</a>
                <a data-toggle="modal" id="btn_feedback" data-target="#feedback_modal" href="/feedback/jsModalfeedback">
                    - Send Us Feedback
                </a>
                <!-- <a href="#">- Send Us Feedback</a> -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="footer-bottom-left">
                    <div class="sitemap">
                        <ul>
                            <li><a href="/terms-condition"> TERMS OF USE </a></li>
                            <li>|</li>
                            <li><a href="/privacy-policy">PRIVACY POLICY </a></li>
                            
                        </ul>
                    </div>
                    <p class="location">
                        <i class="fa fa-map-marker"></i>
                        
                        Headquarted in New York City, NY
                    </p>
                    <ul>
                        
                        <li><i class="fa fa-envelope"></i> <a href="mailto:info@fitnessity.com">contact@fitnessity.co</a></li>
                    </ul>
                </div>
                 <div class="social-icon">
                        <a href="https://www.facebook.com/fitnessityofficial/" class="fb" target="_blank">&nbsp;</a>
                        <a href="https://twitter.com/Fitnessitynyc" class="tw" target="_blank">&nbsp;</a>
                        <a href="https://www.linkedin.com/company/fitnessity/about/?viewAsMember=true" class="in" target="_blank">&nbsp;</a>
                        
                    </div>
                <div class="footer-link-button-say">
                    <button type="button" class="btn btn-info btn-lg header-right-menu footer-button-align" data-toggle="modal" id="btn_feedback" data-target="#feedback_modal" href="/feedback/jsModalfeedback" style="display:none">
                        SAY SOMETHING ABOUT FITNESSITY
                    </button>
                </div>
        </div>
        
    </div>
    
     <?php /*?>   <div class="footer-logo">
            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>logo-footer-250x53.png"/>
            <p>Subscribe to stay informed with updates and news.</p>
            <span style="display:none;color:orange;" id="thank_you"> Thank you for subscribing newsletter! </span>
            <span style="display:none;color:yellow;" id="already_register"> You have already subscribed newsletter! </span>
            <span style="display:none;color:red;" id="invalid_data"> Please enter valid details! </span>
            <span style="display:none;color:red;" id="error_msg"> Something went wrong, please try after sometime! </span>

            <form method="post" id="submit_newsletter">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <input type="text" name="name" id="newsletter_name" class="form-control" placeholder="Enter Name" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                        <input type="email" id="newsletter_email" placeholder="Enter Email Address" class="form-control" required/>
                    </div>
                </div>
                <div class="row col-md-12 form-group">
                    <button class="btn-u" type="submit" >Subscribe</button>
                </div>
            </form>
        </div>
      <div class="footer-link">
            <!-- <h1>COMPANY</h1> -->
            <h1>FINESSITY</h1>
            <a href="/about-us">- About Us</a>
            <a href="/claim-your-business">- Claim your Business</a>
            <!--  <a href="#">- Team</a>
            <a href="#">- Blog</a> -->
        </div>
         
        <div class="footer-link">
            <h1>NEED HELP ?</h1>
            <!-- <a href="#">- Help Center Us</a> -->
            <a href="/contact-us">- Contact Us</a>
            <!-- <a href="#">- Send Us Inquiry</a> -->
            <a href="{{route('help')}}">- Help Center</a>
            <a data-toggle="modal" id="btn_feedback" data-target="#feedback_modal" href="/feedback/jsModalfeedback">
                - Send Us Feedback
            </a>
            <!-- <a href="#">- Send Us Feedback</a> -->
        </div>
        <div class="footer-bottom-block">
            <div class="footer-bottom-left">
                <div class="sitemap">
                    <ul>
                        <li><a href="/terms-condition"> TERMS OF USE </a></li>
                        <li>|</li>
                        <li><a href="/privacy-policy">PRIVACY POLICY </a></li>
                        <!-- <li>|</li> -->
                        <!-- <li><a href="#">  SITEMAP</a></li>
                        <li>|</li> -->
                    </ul>
                </div>
                <p class="location">
                    <i class="fa fa-map-marker"></i>
                    <!-- 123456 Street Name, London -->
                    Headquarted in New York City, NY
                </p>
                <ul>
                    <!-- <li><i class="fa fa-phone"></i> (1800) 987-12341   </li>
                    <li>|</li>
                    <li><i class="fa fa-fax"></i> 1800) 987-12341</li>
                    <li>|</li> -->
                    <!-- <li><i class="fa fa-envelope"></i> <a href="mailto:info@fitnessity.com">info@fitnessity.com</a></li> -->
                    <li><i class="fa fa-envelope"></i> <a href="mailto:info@fitnessity.com">contact@fitnessity.co</a></li>
                </ul>
            </div>
            <div class="footer-right">
                <div class="social-icon">
                    <a href="https://www.facebook.com/fitnessityofficial/" class="fb" target="_blank">&nbsp;</a>
                    <a href="https://twitter.com/Fitnessitynyc" class="tw" target="_blank">&nbsp;</a>
                    <a href="https://www.linkedin.com/company/fitnessity/about/?viewAsMember=true" class="in" target="_blank">&nbsp;</a>
                    {{-- <a href="https://www.google.com/?q=fitnessity" class="plus" target="_blank">&nbsp;</a> --}}
                </div>
                <!-- <div class="app">
                    <a href="#"><i class="fa fa-apple"></i>
                    Download<br/><span>on the app store</span></a>
                    <a href="#"><i class="fa fa-android"></i>
                    Download<br/><span>on the app store</span></a>
                </div> -->
            </div>
            <div class="footer-link-button-say">
                <button type="button" class="btn btn-info btn-lg header-right-menu footer-button-align" data-toggle="modal" id="btn_feedback" data-target="#feedback_modal" href="/feedback/jsModalfeedback" style="display:none">
                    SAY SOMETHING ABOUT FITNESSITY
                </button>
            </div>
        </div>
    </div><?php */?>
    <p class="copyright"><?php echo Config::get('constants.copyright_text');?></p>
    
</footer>
    
    <link href="{{url('/public/css/toastr.min.css')}}" rel="stylesheet">
    <link href="{{url('/public/css/toastr-custom.css')}}" rel="stylesheet">

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
    <script src="{{url('/public/css/toastr.min.js')}}"></script>
    <script src="{{url('/public/css/toastr-custom.js')}}"></script>


    @if(!Auth::guest() && Auth::user()->role == "business")

        @if(Auth::user()->status == "draft")
        <!-- <div class="flash-message">
            <p class="alert alert-danger" style="font-size:16px;">Complete your profile and submit to Fitnessity Review Process in order to get Fitnessity access.</p>
        </div> -->
        <script>
            $(document).ready(function() {
                user_notice('danger', 'Complete your profile and submit to Fitnessity Review Process in order to get Fitnessity access.');
            });
        </script>
        @endif

         @if(Auth::user()->status == "review_pending")
        <!-- <div class="flash-message">
            <p class="alert alert-danger" style="font-size:16px;">Your profile is under Fitnessity Review Process.</p>
        </div> -->
        <script>
            $(document).ready(function() {
                user_notice('danger', 'Your profile is under Fitnessity Review Process.');
            });
        </script>
        
        @endif

        @if(Auth::user()->status == "rejected")
       <!--  <div class="flash-message">
            <p class="alert alert-danger" style="font-size:16px;">You need to modify few things in your profile to complete Fitnessity Review Process.</p>
        </div> -->
        <script>
            $(document).ready(function() {
                user_notice('danger', 'You need to modify few things in your profile to complete Fitnessity Review Process.');
            });
        </script>
        @endif

    @endif

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))
            <script>
                $(document).ready(function() {
                    var msg = "<?php echo Session::get('alert-' . $msg); ?>";
                    var type = "<?php echo $msg; ?>";
                    
                    showSystemMessages("", type, msg, "");
                });
            </script>
          <!-- <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p> -->
          @endif
        @endforeach
    </div>
   

    <!-- display error message starts -->
   

    

        
<div id='tempDiv'></div>
<script src="{{url('/public/js/bootstrap.min.js')}}"></script>
<script src="{{url('/public/js/JQueryValidate/jquery.validate.js')}}"></script>
<script src="{{url('/public/js/JQueryValidate/additional-methods.min.js')}}"></script>
<script src="{{url('/public/js/auth.js')}}"></script>
<script src="{{url('/public/js/jquery.blockUI.js')}}"></script>
<script src="{{url('/public/js/general.js')}}"></script>
<!--<script src="<?php //echo Config::get('constants.FRONT_JS'); ?>bootstrap-datepicker.js"></script>-->

<script>
    $(document).ready(function()
    {
        $("#submit_newsletter").submit(function(e)
        {
            e.preventDefault();
            var a=$("#newsletter_name").val();
                null==a.match(/^[a-zA-Z ]*$/)||""==a?(
                $("span#invalid_data").css("display","block"),
                $("span#already_register").css("display","none"),
                $("span#thank_you").css("display","none"),
                $("span#error_msg").css("display","none")
                ):
                b=$("#newsletter_email").val();
                null==b.match(/[a-z0-9]+(?:.[a-z0-9]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/)||""==a?(
                $("span#invalid_data").css("display","block"),
                $("span#already_register").css("display","none"),
                $("span#thank_you").css("display","none"),
                $("span#error_msg").css("display","none")
                ):
                $.ajax(
                {
                    type:"POST",
                    url:"/newsletters/saveNewsletter",
                    data:"name="+a+"&email="+b+"&_token="+$('#token').val(),
                    success:function(a)
                    {
                        $('#submit_newsletter')[0].reset();
                        1==a?($("span#invalid_data").css("display","none"),
                            $("span#already_register").css("display","block"),
                            $("span#thank_you").css("display","none"),
                            $("span#error_msg").css("display","none")
                            ):
                        2==a?($("span#invalid_data").css("display","none"),
                            $("span#already_register").css("display","none"),
                            $("span#thank_you").css("display","block"),
                            $("span#error_msg").css("display","none")
                            ):
                        ($("span#invalid_data").css("display","none"),
                            $("span#already_register").css("display","none"),
                            $("span#thank_you").css("display","none"),
                            $("span#error_msg").css("display","block")
                    )}
                })
        })
    });
</script>
<script>
    $(document).ready(function(){
        // hide #back-top first
        $("#back-top").hide();        
        // fade in #back-top
        $(function () {
            $(window).scroll(function () {
                if ($(this).scrollTop() > 150) {
                    $('#back-top').fadeIn();
                } else {
                    $('#back-top').fadeOut();
                }
            });

            // scroll body to 0px on click
            $('#back-top a').click(function () {
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        });
    });
</script>