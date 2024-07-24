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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"  id="ajax_html_modal" data-bs-focus="false">
	<div class="modal-dialog modal-dialog-centered" id="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-btn-modal"></button>
			</div>
			<div class="modal-body"></div>
		</div>
	</div>
</div>


<!-- my code statt -->


<!-- ends -->
<footer id="footer" class="printnone  @if(  request()->is('*register_ep*') || request()->is('*check-in-welcome*') || request()->is('*quick-checkin*')|| request()->is('*check-in-portal*')) d-none @endif" >
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
            <?php $footer_fitnessity = App\Cms::where('status', '1')
                    ->where('content_alias', 'footer_content')->get(); ?>
            @foreach($footer_fitnessity as $footercon)
                <div class="footer-logo">
                    <img @if($footercon->banner_image) src="{{url('/public/uploads/cms/'.$footercon->banner_image)}}"   @else  src="/public/images/fitnessity-logo-white.png"   @endif  style="width:250px;">
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
					<a href="{{route('staff_login')}}">Staff Login</a>
                </div> 
                <div class="footer-bottom-left social-footer">
                    <ul>
                        <li><a href="https://twitter.com/Fitnessitynyc" target="_blank" ><img src="{{asset('public/img/twitter.png')}}" width="30px" height="30px" height="30px" alt="Fitnessity" loading="lazy"/></a>&nbsp;&nbsp;</li>
                        <li><a href="https://www.instagram.com/fitnessityofficial/?hl=en" target="_blank"><img src="{{asset('public/img/instagram.png')}}" width="30px" height="30px" alt="Fitnessity" loading="lazy"/></a>&nbsp;&nbsp;</li>
                        <li><a href="https://www.facebook.com/fitnessityofficial" target="_blank"><img src="{{asset('public/img/facebook.png')}}" width="30" height="30px" alt="Fitnessity" loading="lazy"/></a>&nbsp;&nbsp;</li>
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
<div  id="mystickyCustomer" class="navbar navbar-default navbar-fixed-bottom hidden-lg visible-md visible-xs visible-sm desktop-none-customer" style="background: white;">
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
				<label>Accounts</label>
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
										<img src="{{ Storage::disk('s3')->exists(Auth::user()->profile_pic) ? Storage::URL(Auth::user()->profile_pic) : url('/images/user-icon.png') }}" alt="Fitnessity"  class="sidemenupic" loading="lazy">
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
									   <span class="pc-micon"><img src="{{asset('/public/img/social-profile.png')}}" alt="Fitnessity" loading="lazy"></span><a href="{{route('profile-viewProfile')}}" style="color: white;" loading="lazy"> View Personal Profile</a>
									</li>

									<li class="pc-link">
										<span class="pc-micon"><img src="{{asset('/public/img/edit-2.png')}}" alt="Fitnessity" loading="lazy"></span><a href="{{url('/personal/profile')}}" style="color: white;">Edit Profile & Password</a>
									</li>

									<li class="pc-link">
										<span class="pc-micon"><img src="{{asset('/public/img/menu-icon5.svg')}}" alt="Fitnessity" loading="lazy"></span><a href="{{route('personal.manage-account.index')}}" style="color: white;"> Manage Accounts</a>
									</li>
								
									<li class="pc-link"> 
										<span class="pc-micon"><img src="{{ url('public/img/menu-icon3.svg') }}" alt="Fitnessity" loading="lazy"></span>
										<a href="{{ url('/personal/calendar')}}" style="color: white;">Calendar</a>
									</li>

									<li class="pc-link">
										<span class="pc-micon"><img src="{{asset('/public/img/credit-card.png')}}" alt="Fitnessity" loading="lazy"></span><a href="{{route('personal.credit-cards')}}" style="color: white;">Credit Card</a>
									</li>

									<li class="pc-link">
										<span class="pc-micon"><img src="{{asset('/public/img/favorite.png')}}" alt="Fitnessity" loading="lazy"></span><a href="{{route('personal.favourite')}}" style="color: white;">Favorite</a>
									</li>
									<li class="pc-link">
										<span class="pc-micon"><img src="{{asset('/public/img/follower.png')}}" alt="Fitnessity" loading="lazy"></span><a href="{{route('personal.followers')}}" style="color: white;">Followers</a>
									</li>
									<li class="pc-link">
										<span class="pc-micon"><img src="{{asset('/public/img/follower.png')}}" alt="Fitnessity" loading="lazy"></span><a href="{{route('personal.following')}}" style="color: white;">Following</a>
									</li>
									
									<!-- <li class="pc-link">
											 <span class="pc-micon"><i class="fas fa-user-plus"></i></span><a href="#" style="color: white;">Invite Friends</a>
									 </li> -->
									<li><div class="border-sidebar"></div></li>
									<li class="lp-per-pro"> <span>Business Center </span></li>
									<li class="pc-link">
										<span class="pc-micon"><i class="fas fa-clipboard-list"></i></span>
										<a href="{{ Config::get('constants.SITE_URL') }}/claim-your-business" style="color: white;"> Create A Business</a>
									</li>

									@if(count(Auth::user()->company) > 0)
										<li class="pc-link">
											<span class="pc-micon"><i class="fa fa-tasks"></i></span><a href="{{route('business_dashboard')}}"  style="color: white;">Manage My Business</a>
										</li>

										@if(!Session('StaffLogin'))
											<li class="pc-link">
												<span class="pc-micon"><i class="fa fa-tasks"></i></span><a href="{{route('staff_login')}}"  style="color: white;">Staff Login</a>
											</li>
										@endif
									@endif


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
							<p class="pri-2">Fitnessity, Inc {{date('Y')}}</p>
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



  
    <script src="{{url('/public/dashboard-design/js/bootstrap.bundle.min.js')}}"></script>


	<!--<script src="{{url('/public/dashboard-design/js/dashboard-projects.init.js')}}"></script>-->


	<!-- profile-setting init js -->
	<script src="{{url('/public/dashboard-design/js/profile-setting.init.js')}}"></script>
	<script src="https://js.stripe.com/v3/"></script>
	
    <script src="{{ url('public/js/JQueryValidate/jquery.validate.js') }}"></script>
    <script src="{{ url('public/js/JQueryValidate/additional-methods.min.js') }}"></script>
    <script src="{{ url('public/js/jquery-input-mask-phone-number.js') }}"></script>
    <script src="{{ url('public/js/moment.js') }}"></script>
    <!-- <script src="assets/js/pages/datatables.init.js"></script> -->
  
    <!-- init js -->
    <!-- <script src="{{url('/public/dashboard-design/js/pickr.min.js')}}"></script>
    <script src="{{url('/public/dashboard-design/js/form-pickers.init.js')}}"></script> -->

 

    <script src="{{url('/public/dashboard-design/js/form-file-upload.init.js')}}"></script> 

    <script src="{{url('/public/dashboard-design/js/password-addon.init.js')}}"></script> 

    <script src="{{url('/public/dashboard-design/js/dragula.min.js')}}"></script> 
    <script src="{{url('/public/dashboard-design/js/dom-autoscroller.min.js')}}"></script> 
    
    <!-- <script src="{{url('/public/dashboard-design/js/todo.init.js')}}"></script>  -->
    
 <!-- new design end -->
 <script src="{{url('/public/js/owl.js')}}"></script>    
<!-- <script src="<?php echo Config::get('constants.FRONT_JS'); ?>owl.js"></script> -->
<script src="{{ url('public/js/jquery.flexslider.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ env('MAP_KEY') }}"></script>
<script type="text/javascript">
    	function initMapCall(addressInputID, cityElementID, stateElementID, countryElementID, zipcodeElementID, latElementID, lonElementID) {
        	var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -33.8688, lng: 151.2195},
            zoom: 13
        	});

        	var input = document.getElementById(addressInputID);
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
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));

            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
            var address = '';
            var badd = '';
            var sublocality_level_1 = '';
            if (place.address_components) {
                address = [
                  (place.address_components[0] && place.address_components[0].short_name || ''),
                  (place.address_components[1] && place.address_components[1].short_name || ''),
                  (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);

            // Location details
            for (var i = 0; i < place.address_components.length; i++) {
               if(place.address_components[i].types[0] == 'postal_code'){
                  $('#' + zipcodeElementID).val(place.address_components[i].long_name);
               }

               if(place.address_components[i].types[0] == 'locality'){
                  $('#' + cityElementID).val(place.address_components[i].long_name);
               }

               if(place.address_components[i].types[0] == 'sublocality_level_1'){
                  sublocality_level_1 = place.address_components[i].long_name;
               }

               if(place.address_components[i].types[0] == 'street_number'){
                  badd = place.address_components[i].long_name ;
               }

               if(place.address_components[i].types[0] == 'route'){
                   badd += ' '+place.address_components[i].long_name ;
               } 

               if(place.address_components[i].types[0] == 'country'){
	                $('#'+countryElementID).val(place.address_components[i].long_name);
	            }

               if(place.address_components[i].types[0] == 'administrative_area_level_1'){
                  $('#'+stateElementID).val(place.address_components[i].long_name);
               }
            }

            if(badd == ''){
	          	$('#'+addressInputID).val(sublocality_level_1);
	        	}else{
	          	$('#'+addressInputID).val(badd);
	        	}

            $('#'+latElementID).val(place.geometry.location.lat());
        		$('#'+lonElementID).val(place.geometry.location.lng());
         });
      }
 	</script>
 	
<script>
function openMobileNav() {
	document.getElementById("myMobileSidepanel").style.width = "300px";
}

function closeMobileNav() {
	document.getElementById("myMobileSidepanel").style.width = "0";
}


</script>

<script type="text/javascript">
	function  sendmailTocustomer(cid,bid) {
		$.ajax({
			url:'{{route("sendemailtocutomer")}}',
			type:"GET",
			xhrFields: {
            withCredentials: true
         },
			data:{
				cid:cid,
				bid:bid,
			},
			success:function(response){
				if(response == 'success'){
                    //$('.reviewerro').html('Email Successfully Sent..');
                  alert('Email Successfully Sent..');
                }else{
                    //$('.reviewerro').html("Can't Mail on this Address. Plese Check your Email..");
                  alert("Can't Mail on this Address. Plese Check Email..");
                }
			}
		});
	}
	
	$(document).on('click', '[data-behavior~=ajax_html_modal]', function(e){
		$("#modal-dialog").removeClass();
		$("#modal-dialog").addClass('modal-dialog modal-dialog-centered');
        var width = $(this).data('modal-width');
        var reload = $(this).data('reload');
        if(width == undefined){
            // width = 'modal-50';
        }
         var chkbackdrop  =   $(this).attr('data-modal-chkBackdrop');            
        e.preventDefault()
        $.ajax({
            url: $(this).data('url'),
            success: function(html){
            	$('#ajax_html_modal .modal-body').html(html)
                $('#ajax_html_modal .modal-dialog').addClass(width);
                if(reload == 1 ){
                	$('#close-btn-modal').attr('onclick', 'window.location.reload()');
                }else{
                	$('#close-btn-modal').removeAttr('onclick');
                }
            	if(chkbackdrop == 1){
            		$('#ajax_html_modal').modal({ backdrop: 'static', keyboard: false });
            		$('#ajax_html_modal').modal('show')

        		}else{
                    $('#ajax_html_modal').modal('show')
        		}
            }
        })
    });

    $(document).on('click', '[data-behavior~=send_receipt]', function(e){
        var item_type = $(this).data('item-type');
        e.preventDefault()
        /*if(item_type == 'no' || item_type == 'Membership'){*/
            var width = $(this).data('modal-width');
            if(width == undefined){
                width = 'modal-50';
            }  
            $.ajax({
                url: $(this).data('url'),
                success: function(html){
                    $('#ajax_html_modal .modal-body').html(html)
                    $('#ajax_html_modal .modal-dialog').addClass(width);
                    $('#ajax_html_modal').modal('show')
                }
            });
        /*}else{
            alert("This is a Recurring Payment. A receipt is only for Membership or Activity Purchase.");
        }*/
    });

	$(document).on('focus', '[data-behavior~=text-phone]', function(e){
        //jQuery.noConflict();
		$('[data-behavior~=text-phone]').usPhoneFormat({
        	format: '(xxx) xxx-xxxx',
		});
	});
		
    function valid(email)
    {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test(email); //this will either return true or false based on validation
    }

    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(email)) {
            return false;
        }else {
            return true;
        }
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
<script>
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

</script>



