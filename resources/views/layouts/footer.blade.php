<?php use App\Cms; ?>
<style>
.f-btn-news{
  background: #f53b49;
  border: none;
  padding: 7px;
  border-radius: 13px;
  color: white;
  width: 100%;
  font-size: 15px;
  font-weight: 500;
}
.f-send-news{
  background: #f53b49;
  float: left;
  color: white;
  padding: 9px;
  border: none;
  border-radius: 5px;
  margin-top: 5px;
  width: 50%;
}
.sp-foot{
  margin-top: 6px;
}
.social-footer{margin-top:180px;}

@media screen and (max-width: 400px){
  .social-footer{margin-top:0px;}
}
@media screen and (min-width: 401px) and (max-width: 767px){
  .social-footer{margin-top:0px;}
}
@media screen and (min-width: 768px) and (max-width: 992px){
  .social-footer{margin-top:0px;}
}
</style>
<div class="modal fade compare-model" id="ajax_html_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="text-align: right;"> 
                <div class="closebtn">
                    <button type="button" class="close close-btn-design manage-customer-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <div class="modal-body body-tbm"></div>
        </div>
    </div>
</div>
<footer id="footer">
     @if(session()->has('alert-success'))
                        <div class="alert alert-success">
                            {{ session()->get('alert-success') }}
                        </div>
                    @endif
        <div class="alert alert-success newslattermsg" style="display: none;">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong> Subscribe Succesfully !</strong>                          
        </div>
        <div class="cat-container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <?php $footer_fitnessity = Cms::where('status', '1')
                        ->where('content_alias', 'footer_content')->get(); ?>
                @foreach($footer_fitnessity as $footercon)
                    <div class="footer-logo">
                        <img src="/public/images/fitnessity_logo1.png" style="width:250px">
                        <p style="text-align: justify; padding: 5px 50px 5px 0px">
                            {!!$footercon->content!!}
                        </p>
                        <div class="footer-bottom-left">
                            <p class="location">
                                {!!$footercon->address!!}<br/>
                                <i class="far fa-envelope"></i><a href="mailto:{{$footercon->email}}"> {{$footercon->email}} </a>
                            </p>
                        </div>
                    </div>
                @endforeach
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div class="footer-link">
                        <a href="{{ url('') }}">FITNESSITY</a><br/>
                        <?php /*?><a href="{{ Config::get('constants.SITE_URL') }}/about-us">About Us</a>
                        <a href="{{ Config::get('constants.SITE_URL') }}/be-a-part">Be A Part</a>
                        <a href="{{ Config::get('constants.SITE_URL') }}/discover">Discover</a>
                        <a href="{{ Config::get('constants.SITE_URL') }}/hire-trainer">Hire Trainer</a><?php */?>
                        <a href="{{ Config::get('constants.SITE_URL') }}/privacy-policy">Privacy Policy</a>
                        <a href="{{ Config::get('constants.SITE_URL') }}/terms-condition">Terms & Condition</a>
                        <a href="{{ Config::get('constants.SITE_URL') }}/about-us">About Us</a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div class="footer-link">
                        <a href="#">BUSINESS</a><br/>
                        <a href="{{ Config::get('constants.SITE_URL') }}/claim-your-business">Claim your Business</a>
                    </div> 
                    <div class="footer-bottom-left social-footer">
                        <ul>
                            <li><a href="https://twitter.com/Fitnessitynyc" target="_blank" ><img src="{{ URL::to('public/img/twitter.png')}}" width="30" /></a>&nbsp;&nbsp;</li>
                            <li><a href="https://www.instagram.com/fitnessityofficial/?hl=en" target="_blank"><img src="{{ URL::to('public/img/instagram.png')}}" width="30" /></a>&nbsp;&nbsp;</li>
                            <li><a href="https://www.facebook.com/fitnessityofficial" target="_blank"><img src="{{ URL::to('public/img/facebook.png')}}" width="30" /></a>&nbsp;&nbsp;</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div class="footer-link">
                        <a href="{{route('help')}}">NEED HELP?</a><br/>
                        <a href="{{ Config::get('constants.SITE_URL') }}/contact-us">Contact Us</a>
                        <a href="{{route('help')}}">Help Center</a>
                        <a id="btn_feedback" href="{{ Config::get('constants.SITE_URL') }}/feedback">Send Us Feedback</a>  
                       
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <?php /*?><a href="#" style="color:#fff">Subscribe to stay informed with updates and what's new</a><br/><br/>
                    <div class="footer-logo">
                        <label style="display: none;" id="name-error" class="error" for="name">!</label>
                        <label style="display: none;" id="email-error" class="error" for="name"></label>
                        <form method="post" id="newsletterfrm" action="{{url('addnewsletter')}}">
                            @csrf
                            <div class="input_div float-left w-100">
                                <div class="set_input float-left w-100">
                                    <label for="newsletter_name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" >                                    
                                </div>
                                <div class="set_input float-left w-100">
                                    <label for="newsletter_email">e-Mail</label>
                                    <input type="text" id="email" name="email" class="form-control" >
                                </div>                               
                            </div>
                            <div class="float-left w-100">
                                <button class="btn-u newslatterfrm" type="button">Subscribe</button>
                            </div>
                        </form>
                    </div><?php */?>
                </div>
            </div>
            <p class="copyright">© <?php echo date('Y'); ?> Fitnessity</p>
        </div>
    </footer>
    <p id="back-top" title="Back To Top">
        <a href="#top" class="cd-top"><span class="fa fa-arrow-up"></span></a>
    </p>
    <script src="<?php echo Config::get('constants.FRONT_JS'); ?>owl.js"></script>
    <script src="<?php echo Config::get('constants.FRONT_JS'); ?>jquery.flexslider.js"></script>
    <script src="<?php echo Config::get('constants.FRONT_JS'); ?>lightbox.js"></script>
    <script src="<?php echo Config::get('constants.FRONT_JS'); ?>sly.min.js"></script>
    <script src="<?php echo Config::get('constants.FRONT_JS'); ?>home.js"></script>
    <script src="<?php echo Config::get('constants.FRONT_JS'); ?>toastr.min.js"></script>
    <script src="<?php echo Config::get('constants.FRONT_JS'); ?>toastr-custom.js"></script>
    <script src="<?php echo Config::get('constants.FRONT_JS'); ?>bootstrap.min.js"></script>
    <script src="<?php echo Config::get('constants.FRONT_JS'); ?>JQueryValidate/jquery.validate.js"></script>
    <script src="<?php echo Config::get('constants.FRONT_JS'); ?>JQueryValidate/additional-methods.min.js"></script>
    <script src="<?php echo Config::get('constants.FRONT_JS'); ?>auth.js"></script>
    <script src="<?php echo Config::get('constants.FRONT_JS'); ?>jquery.blockUI.js"></script>
    <script src="<?php echo Config::get('constants.FRONT_JS'); ?>general.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js" integrity="sha512-CryKbMe7sjSCDPl18jtJI5DR5jtkUWxPXWaLCst6QjH8wxDexfRJic2WRmRXmstr2Y8SxDDWuBO6CQC6IE4KTA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="/public/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="/public/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).on('click', '[data-behavior~=ajax_html_modal]', function(e){
            e.preventDefault()
            $.ajax({
                url: $(this).data('url'),
                success: function(html){
                    $('#ajax_html_modal .modal-body').html(html)
                    $('#ajax_html_modal').modal('show')
                }
            })
        });

        $(function(){
            $("[data-behavior~=datepicker]").datepicker( { 
                minDate: 0,
                changeMonth: true,
                changeYear: true   
            });
        })

        $(document).ready(function() {
            // hide #back-top first
            $("#back-top").hide();
            // fade in #back-top
            $(function() {
                $(window).scroll(function() {
                    if ($(this).scrollTop() > 150) {
                        $('#back-top').fadeIn();
                    } else {
                        $('#back-top').fadeOut();
                    }
                });

                // scroll body to 0px on click
                $('#back-top a').click(function() {
                    $('body,html').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                });
            });
        });
        function opensub(){
            $("#newsletterfrm").css("display", "block");
        }

        $(".newslatterfrm").click(function(){
            var _token = $("input[name='_token']").val();
            var name = $('#name').val();
            var email = $('#email').val();
            $('#name-error').html("");
            $('#email-error').html("");
            var ret = true;
            if($("#name").val()=="")
            {         
               $('#name-error').css("display","block");      
               $('#name-error').html("Name field is required.");
                return false;
            }
            if($("#email").val()=="")
            {            
               $('#email-error').css("display","block");   
               $('#email-error').html("email field is required.");
                return false;
            }

            if(ret == true){
                    $.ajax({
                    type: 'POST',
                    url: '{{route("addnewsletter")}}',
                    data: {
                        _token:_token,
                        name:name,
                        email:email
                    },
                    success: function(data) {
                        if(data.success=='false'){
                            $('#email-error').css("display","block");
                            $('#email-error').html("Email already exist!");
                        }
                        if(data.success=='success'){
                            $('.newslattermsg').css("display","block");
                            $('#name').val("");
                            $('#email').val("");

                        }                        
                    }
                });
            }
            });

    </script>
