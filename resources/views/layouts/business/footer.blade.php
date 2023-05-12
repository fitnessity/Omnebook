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
        </div>
        <p class="copyright">© <?php echo date('Y'); ?> Fitnessity</p>
    </div>
</footer>
<p id="back-top" title="Back To Top">
    <a href="#top" class="cd-top"><span class="fa fa-arrow-up"></span></a>
</p>

<!-- Sticky Footer -->
<div  id="mysticky" class="navbar navbar-default navbar-fixed-bottom hidden-lg visible-md visible-xs visible-sm desktop-none" style="background: white;">
  <div class="container">
	<div class="col-xs-2">
		<div class="shortcut-sticky ">
			<a href="{{route('activities_index')}}" class="short-links">
				<i class="far fa-file-alt"></i>
				<label>Book</label>
			</a>
		</div>
	</div>
	<div class="col-xs-2">
		<div class="shortcut-sticky">
			<a href="{{route('profile-viewProfile')}}" class="short-links">
				<i class="fas fa-plus"></i>
				<label>Post</label>
			</a>
		</div>
	</div>
	<div class="col-xs-2">
		<div class="shortcut-sticky">
			<a href="{{route('carts_index')}}" class="short-links">
				<i class="fas fa-shopping-cart"></i>
				<label>Cart </label>
			</a>
		</div>
	</div>
	<div class="col-xs-3">
		<div class="shortcut-sticky">
			<a href="{{route('personal.orders.index')}}" class="short-links">
				<i class="fas fa-info"></i>
				<label>Bookings</label>
			</a>
		</div>
	</div>
	
	@if(Auth::check())
		<div class="col-xs-3">
			<div class="shortcut-sticky">
				<a class="short-links" onclick="openMobileNav()">
					<i class="fas fa-user"></i>
					<label>Profile</label>
				</a>
				
				<nav class="pc-sidebar">
					<div class="navbar-wrapper">
						<div id="myMobileSidepanel" class="sidepanel mysidepanel">
							<div class="navbar-content ps">
								<a href="javascript:void(0)" class="cancle fa fa-times" onclick="closeMobileNav()"></a>
								<ul class="pc-navbar">
									<li style="text-align: center;"> 
										@if(File::exists(public_path("/uploads/profile_pic/thumb/".Auth::user()->profile_pic)))
										<img src="{{ url('/public/uploads/profile_pic/thumb/'.Auth::user()->profile_pic) }}" alt="Fitnessity" class="sidemenupic" >
										@else
										<img src="{{ asset('/public/images/user-icon.png') }}" alt="Fitnessity" class="sidemenupic">
										  @endif
									</li>
									<li class="pc-caption"><span> Welcome</span></li>
									<li class="pc-caption-1">
										<span> {{ Auth::user()->firstname }} </span>
									</li>
									<li class="lp-tag">
										<span><?php echo "@"; ?>{{ Auth::user()->username }} </span>
									</li>
									<li class="lp-per-pro"> <span> Personal Profile </span> </li>
									<li class="border-1">
										<button class="btn-lp" type="button"><a style="color: white;" href="{{url('/activities')}}">Book An Activity </a> </button> 
									</li>
									<li class="pc-link">
									   <span class="pc-micon"><i class="fa fa-user"></i></span><a href="{{route('profile-viewProfile')}}" style="color: white;"> View Personal Profile</a>
									</li>
									<?php /*?> <li class="pc-link">
										  <span class="pc-micon"><i class="fa fa-user"></i></span>
										  <a href="{{route('profile-viewbusinessProfile')}}" style="color: white;">Business Profile</a>
									 </li><?php */?>
									 <li class="pc-link">
										 <span class="pc-micon"><i class="fas fa-cog"></i></span><a href="{{route('user-profile')}}" style="color: white;"> Edit Personal Profile</a>
									  </li>
									<!-- <li class="pc-link">
										   <span class="pc-micon"><i class="fas fa-calendar-alt"></i></span><a href="{{ Config::get('constants.SITE_URL') }}/personal-profile/calendar" style="color: white;">Calender</a>
									 </li> -->
									<li class="pc-link">
										<span class="pc-micon"><i class="fas fa-users"></i></span><a href="{{ Config::get('constants.SITE_URL') }}/personal-profile/add-family" style="color: white;">Manage Family</a>
									</li>
									<li class="pc-link">
										<span class="pc-micon"><i class="fas fa-file-alt"></i></span> <a href="{{ route('personal.orders.index')}}" style="color: white;"> Booking Info</a>
									</li>
									<li class="pc-link">
										<span class="pc-micon"><img src="{{ url('public/img/menu-icon2.svg') }}" alt=""></span><a href="{{ Config::get('constants.SITE_URL') }}/personal-profile/payment-info" style="color: white;">Payment Info</a>
									</li>
									<li class="pc-link">
										<span class="pc-micon"><img src="{{ url('public/img/menu-icon3.svg') }}" alt=""></span><a href="{{ Config::get('constants.SITE_URL') }}/personal-profile/calendar" style="color: white;">Calendar</a>
									</li>
									<li class="pc-link">
										 <span class="pc-micon"><i class="fa fa-envelope" aria-hidden="true"></i></span><a href="{{ Config::get('constants.SITE_URL') }}/booking-request" style="color: white;"> Inbox</a>
									</li>
									<li class="pc-link">
										<span class="pc-micon"><img src="{{ url('public/img/menu-icon1.svg') }}" alt=""></span><a href="{{ Config::get('constants.SITE_URL') }}/personal-profile/favorite" style="color: white;">Favorite</a>
									</li>
									<li class="pc-link">
										<span class="pc-micon"><img src="{{ url('public/img/menu-icon1.svg') }}" alt=""></span><a href="{{ Config::get('constants.SITE_URL') }}/personal-profile/followers" style="color: white;">Followers</a>
									</li>
									<li class="pc-link">
										<span class="pc-micon"><img src="{{ url('public/img/menu-icon1.svg') }}" alt=""></span><a href="{{ Config::get('constants.SITE_URL') }}/personal-profile/following" style="color: white;">Following</a>
									</li>
									
									 <?php /*?><li class="pc-link">
										 <span class="pc-micon"><img src="{{ url('public/img/menu-icon1.svg') }}" alt=""></span><a href="{{ Config::get('constants.SITE_URL') }}/personal-profile/user-profile" style="color: white;">User Profile</a>
									</li><?php */?>
									
									
									<!-- <li class="pc-link">
											 <span class="pc-micon"><i class="fas fa-user-plus"></i></span><a href="#" style="color: white;">Invite Friends</a>
									 </li> -->
									<li><div class="border-sidebar"></div></li>
									<li class="lp-per-pro"> <span>Business Center </span></li>
									<li class="pc-link">
										<span class="pc-micon"><i class="fas fa-clipboard-list"></i></span>
										<a href="{{ Config::get('constants.SITE_URL') }}/claim-your-business" style="color: white;">List My Business</a>
									</li>
									<li class="pc-link">
										<span class="pc-micon"><i class="fa fa-tasks"></i></span><a href="{{route('manageCompany')}}" style="color: white;">Manage My Business</a>
									</li>
									<li><div class="border-sidebar"></div></li>
									<li class="lp-per-pro"> <span>Support </span> </li>
									<li class="pc-link">
										<span class="pc-micon"><i class="fas fa-comments"></i></span>
										<a href="{{ Config::get('constants.SITE_URL') }}/feedback" style="color: white;">Give Feedback<br><p class="help-us-side">(Help us improve)<p></a>
									</li>	
									<li class="pc-link">
										<span class="pc-micon"><i class="fas fa-question-circle"></i></span>
										<a href="{{route('help')}}" style="color: white;">Help Desk</a>
									</li>
									<!-- <li class="pc-link">
											  <span class="pc-micon"><i class="fa fa-user-plus"></i></span>
											  <a href="#" style="color: white;">Invite Friends</a>
									 </li> -->
									 <li><div class="border-sidebar"></div></li>
									 <li class="pc-link">
										  <span class="pc-micon"><i class="fa fa-right-from-bracket"></i></span>
										  <a href="{{ Config::get('constants.SITE_URL') }}/userlogout" style="color: white;">Logout </a>
									  </li>
								</ul>
							</div>
							<p class="pri-1"> <a href="{{ Config::get('constants.SITE_URL') }}/privacy-policy" style="color: white;"> Privacy </a> - <a href="{{ Config::get('constants.SITE_URL') }}/terms-condition" style="color: white;">Terms </a></p>
							<p class="pri-2">Fitnessity, Inc 2021</p>
						</div>
					</div>
				</nav>
			</div>
		</div>
	@else
		<div class="col-xs-3">
			<div class="shortcut-sticky">
				<a href="{{route('userlogin')}}" class="short-links">
					<i class="fas fa-sign-in-alt"></i>
					<label>Login</label>
				</a>
			</div>
		</div>
	@endif
  </div>
</div>
<!-- Sticky Footer  -->

<script src="https://js.stripe.com/v3/"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>owl.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>jquery.flexslider.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>lightbox.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>sly.min.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>home.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>toastr.min.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>toastr-custom.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>JQueryValidate/jquery.validate.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>JQueryValidate/additional-methods.min.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>auth.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>jquery.blockUI.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>general.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>jquery-input-mask-phone-number.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="/public/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/public/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
function openMobileNav() {
	document.getElementById("myMobileSidepanel").style.width = "300px";
}

function closeMobileNav() {
	document.getElementById("myMobileSidepanel").style.width = "0";
}


</script>

<script>
	$(document).on('focus', '[data-behavior~=text-phone]', function(e){
        //jQuery.noConflict();
		$('[data-behavior~=text-phone]').usPhoneFormat({
        	format: '(xxx) xxx-xxxx',
		});
	});
		
	$(document).on('click', '[data-behavior~=ajax_html_modal]', function(e){
        var width = $(this).data('modal-width');
        if(width == undefined){
            width = '600px';
        }            
        e.preventDefault()
        $.ajax({
            url: $(this).data('url'),
            success: function(html){
                $('#ajax_html_modal .modal-body').html(html)
                $('#ajax_html_modal .modal-dialog').css({width:width});
                $('#ajax_html_modal').modal('show')
            }
        })
    });

    $(document).on('click', '[data-behavior~=send_receipt]', function(e){
        var item_type = $(this).data('item-type');
        e.preventDefault()
        if(item_type == 'no' || item_type == 'Membership'){
            var width = $(this).data('modal-width');
            if(width == undefined){
                width = '600px';
            }  
            $.ajax({
                url: $(this).data('url'),
                success: function(html){
                    $('#ajax_html_modal .modal-body').html(html)
                    $('#ajax_html_modal .modal-dialog').css({width:width});
                    $('#ajax_html_modal').modal('show')
                }
            });
        }else{
            alert("This is a Recurring Payment. A receipt is only for Membership or Activity Purchase.");
        }
    });

    function valid(email)
    {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test(email); //this will either return true or false based on validation
    }

    $(document).on('focus', '[data-behavior~=datepicker]', function(e){
        //jQuery.noConflict();
        $("[data-behavior~=datepicker]").datepicker( { 
           /* minDate: 0,*/
            changeMonth: true,
            changeYear: true ,
            yearRange: '1960:2060',
        });
    });

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
</script>