@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')
@section('content')

<?php 
													 
use App\BusinessActivityScheduler;
use App\BusinessPriceDetails;
use App\BusinessServiceReview;
use App\BusinessServicesFavorite;

$total_quantity=0;
 $item_price=0;
print_r($cart["cart_item"]);
if(!empty($cart["cart_item"])) {
    foreach($cart['cart_item'] as $item){
        $total_quantity = count($cart["cart_item"]);
        $item_price = $item_price + $item["totalprice"];
    }
    $cartdata = $cart['cart_item'][$pid];
    $totalprice = $cart['cart_item'][$pid]['totalprice'];
    if ($cart['cart_item'][$pid]['image']!="") {
    	if (File::exists(public_path("/uploads/profile_pic/" . $cart['cart_item'][$pid]['image']))) {
    			$profilePicact = url('/public/uploads/profile_pic/' . $cart['cart_item'][$pid]['image']);
    	} else {
    			$profilePicact = url('/public/images/service-nofound.jpg');
    	}
    }else{ $profilePicact = url('/public/images/service-nofound.jpg'); }

    $bookschedulercart = BusinessActivityScheduler::where('id', $cartdata["actscheduleid"])->limit(1)->orderBy('id', 'ASC')->first();
    $timecart = $tot_dura= '';
    if(@$bookschedulercart->shift_end !=''){
			$timecart =  date('h:ia', strtotime( @$bookschedulercart->shift_end)).' - '.date('h:ia', strtotime( @$bookschedulercart->shift_end));
		} 
		if(@$bookschedulercart->set_duration !=''){
			$tm=explode(' ',$bookschedulercart->set_duration);
			$hr=''; $min=''; $sec='';
			if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
			if($tm[2]!=0){ $min=$tm[2].'min. '; }
			if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
			if($hr!='' || $min!='' || $sec!='')
			{ 
				$tot_dura = $hr.$min.$sec; 
			} 
		}
}
?>
<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>compare/style.css">

<div id="" class="mykickboxing-activities" style="padding-top: 130px">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="cart-title cart-success">
					<h5>SUCCESSFULLY ADDED TO YOUR CART</h5>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-5">
				<div class="bookedcard">
					<h5>You Just Booked With </h5>
					<div class="row">
						<div class="col-md-2 col-sm-2 col-xs-3">
							<div class="userblock-card">
								<div class="login_links">
									<?php 
										if(@$companyData->logo != ''){
	    								if (File::exists(public_path("/uploads/profile_pic/" . $companyData->logo))) {
	    									$profilePic = url('/public/uploads/profile_pic/' . $companyData->logo);
	    								} else {
	    									$profilePic = url('/public/images/service-nofound.jpg');
	    								}
	    							}else{ $profilePic = url('/public/images/service-nofound.jpg'); }
	    					?>
									<img src="{{$profilePic}}">
								</div>
							</div>
						</div>
						<div class="col-md-10 col-xs-9">
							<div class="img-title">
								<span>{{@$companyData->company_name}}</span>
								<p>{{@$companyData->address}}, {{@$companyData->city}}, {{@$companyData->state }} {{@$companyData->zip_code}}</p>
							</div>
						</div>
					</div>
					<div class="border-center"> </div>
					<div class="cart-items">
						<span>You have {{$total_quantity}} items In Your Cart</span>
					</div>
					<div class="cart-total">
						<label>Cart Total: </label>
						<span>${{$item_price}}</span>
					</div>
				</div>
				
			</div>
			<div class="col-md-7">
				<div class="row">
					<div class="col-md-4 col-sm-4">
						<div class="cart-itme-img">
							<img src="{{$profilePicact}}">
						</div>
					</div>
					<div class="col-md-8 col-sm-8">
						<div class="kick-adul">
							<h5>{{$cartdata['name']}}</h5>
							<h4>Booking Details</h4>
							<div class="cart-details">
								<span>@if($cartdata['sesdate']!='' && $cartdata['sesdate']!='0')
												{{date('l, jS \of F Y', strtotime( $item["sesdate"] ))}}
											@else  {{date('l, jS \of F Y')}} @endif</span>
								<span>{{$timecart}}</span>
								<span>Price: {{$totalprice}}</span>
								<span>Participants: @if(!empty($item['adult'])) @if($item['adult']['quantity']  != 0) Adult - {{$item['adult']['quantity']}} @endif @endif 
                     @if(!empty($item['child']))  @if($item['child']['quantity']  != 0) Children - {{$item['child']['quantity']}} @endif @endif
										@if(!empty($item['infant'])) @if($item['infant']['quantity'] != 0) Infant - {{$item['infant']['quantity'] }} @endif @endif </span>
								<span>Service Type: {{@$sdata->select_service_type}} </span>
								<span>Duration: {{$tot_dura}}</span>
								<span>Activity Location:  {{@$sdata->activity_location}}</span>
								<span>Service For: {{@$sdata->activity_for}}</span>
								<span>Age:  {{@$sdata->age_range}}</span>
								<span>Language: {{@$ser->languages}} </span>
								<span>Skill Level: {{@$sdata->difficult_level}}</span>
								<!-- <span>Instructor: Darryl Phipps</span> -->
							</div>
						</div>
					</div>
					<div class="col-md-7 col-sm-12">
						<div class="cart-btns-continues">
							<div class="btn-cart-modal">
								<a type="submit" href="{{route('activities_index')}}" class="btn btn-black mt-10" >Continue Shopping</a>
							</div>
							<div class="btn-cart-info instant-detail-booknow">
								@if(Auth::user())
									<a type="submit" href="{{route('payments_card')}}" class="btn btn-red mt-10" >View Cart & Checkout</a>
								@else
									<a type="submit" class="btn btn-red mt-10" data-toggle="modal" data-target="#cartcheckout">View Cart & Checkout</a>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="cart-border"> </div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="cart-title">
					<h5>DISCOVER MORE BELOW</h5>
				</div>
			</div>
		</div>
		
		<section class="ptb-65 plr-60 float-left w-100 discover_activities" id="counter">
			<div class="container-fluid">
				<div class="cart-sub-title">
					<span>View Other Activities Provided by {{@$companyData->company_name}} ({{count($discovermore)}} items) <a class="cart-view" href="{{url('/activity-details/'.$pid)}}"> View All</a> </span>
				</div>
				<?php if (isset($discovermore) && count($discovermore)>0) { ?>
					<div class="owl-slider kickboxing-slider cart-slider">
						<div id="carousel-slider" class="owl-carousel">
							<?php
								$companyid = $companylat = $companylon = $companyname  = $latitude = $longitude = $serviceid = $companylogo = $companyaddress= $profilePic ="";
								$companycity = $companycountry = $pay_price  = "";
									$servicetype = [];
									foreach ($discovermore as $loop => $service) {
										$company = $price = $businessSp = [];
										$serviceid = $service['id'];
										$sport_activity = $service['sport_activity'];
										$servicetype[$service['service_type']] = $service['service_type'];
										$area = !empty($service['area']) ? $service['area'] : 'Location';

										$companyid = $companyData->id;
										$companyaddress = $companyData->address;
										$companyname = $companyData->company_name;
										$companycity = $companyData->city;
										$companycountry = $companyData->country;
										$companylogo = $companyData->logo;
										$companylat = $companyData->latitude;
										$companylon = $companyData->longitude;
													
										if ($service['profile_pic']!="") {
											if(str_contains($service['profile_pic'], ',')){
									    	$pic_image = explode(',', $service['profile_pic']);
										    if( $pic_image[0] == ''){
										       $p_image  = $pic_image[1];
										    }else{
										       $p_image  = $pic_image[0];
										    }
										  }else{
										  	$pic_image = $service['profile_pic'];
										   	$p_image = $service['profile_pic'];
											}

											if (file_exists( public_path() . '/uploads/profile_pic/' . $p_image)) {
										   	$profilePic = url('/public/uploads/profile_pic/' . $p_image);
											}else {
										   	$profilePic = url('/public/images/service-nofound.jpg');
											}
										}else{ $profilePic = '/public/images/service-nofound.jpg'; }

										$bookscheduler='';
										$time='';
										$bookscheduler = BusinessActivityScheduler::where('serviceid', $service['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
										if(@$bookscheduler[0]['set_duration']!=''){
											$tm=explode(' ',$bookscheduler[0]['set_duration']);
											$hr=''; $min=''; $sec='';
											if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
											if($tm[2]!=0){ $min=$tm[2].'min. '; }
											if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
											if($hr!='' || $min!='' || $sec!='')
											{ $time =  $hr.$min.$sec; } 
										}
										$pricearr = [];
										$price_all = '';
										$price_allarray = BusinessPriceDetails::where('serviceid', $service['id'])->get();
										if(!empty($price_allarray)){
											foreach ($price_allarray as $key => $value) {
												$pricearr[] = $value->pay_price;
											}
										}
										if(!empty($pricearr)){
											$price_all = min($pricearr);
										}        
							?>
								<div class="item">
								<div class="kickboxing-block">
									@if(Auth::check())
										<?php
											$loggedId = Auth::user()->id;
											$favData = BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$service['id'])->first();                   
										?>
										<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
											<div class="inner-owl-slider-hire">
												<div id="owl-demo-learn_thismon{{$service['id']}}" class="owl-carousel owl-theme">
													<?php 
														$i = 0;
														if(is_array($pic_image)){
															foreach($pic_image as $img){
																$profilePic1 = '';
																if($img != ''){
																	if (file_exists( public_path() . '/uploads/profile_pic/' . $img)) {
											           				$profilePic1 = url('/public/uploads/profile_pic/' . $img);
																	}
											         		} 

										        				if($profilePic1 != ''){ ?>
																	<div class="item-inner">
																		<img src="{{$profilePic1}}" class="productImg">
																	</div>
																<?php }
															}
														}else{
															if (file_exists( public_path() . '/uploads/profile_pic/' . $pic_image)) {
										   					$profilePic1 = url('/public/uploads/profile_pic/' . $pic_image);
										    				}else {
										       				$profilePic1 = url('/public/images/service-nofound.jpg');
										    				} ?>
															<div class="item-inner">
																<img src="{{$profilePic1}}">
															</div>
													<?php } ?>
												</div>
											</div>
											<script type="text/javascript">
												$(document).ready(function() {
												  	$("#owl-demo-learn_thismon{{$service['id']}}").owlCarousel({
													   navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
													   items : 1, 
													   loop:true,
													   nav:true,
													   dots: false,
												  	});
												});
											</script>
											<div class="serv_fav1" ser_id="{{$service['id']}}">
												<a class="fav-fun-2" id="serfav{{$service['id']}}">
													<?php
													if( !empty($favData) ){ ?>
														<i class="fas fa-heart"></i>
														<?php }
														else{ ?>
													<i class="far fa-heart"></i>
											 <?php } ?></a>
											</div>
											@if($price_all != '')
												<span>From ${{$price_all}}/Person</span>
											@endif
										</div>
									@else
										<div class="kickboxing-topimg-content">
											<div class="inner-owl-slider-hire">
												<div id="owl-demo-learn_thismon{{$service['id']}}" class="owl-carousel owl-theme">
													<?php 
														$i = 0;
														if(is_array($pic_image)){
															foreach($pic_image as $img){
																$profilePic1 = '';
																if($img != ''){
																	if (file_exists( public_path() . '/uploads/profile_pic/' . $img)) {
											           				$profilePic1 = url('/public/uploads/profile_pic/' . $img);
																	}
											         		} 

										        				if($profilePic1 != ''){ ?>
																	<div class="item-inner">
																		<img src="{{$profilePic1}}" class="productImg">
																	</div>
																<?php }
															}
														}else{
															if (file_exists( public_path() . '/uploads/profile_pic/' . @$pic_image) &&  @$pic_image != '' ) {
										   					$profilePic1 = url('/public/uploads/profile_pic/' . $pic_image);
										    				}else {
										       				$profilePic1 = url('/public/images/service-nofound.jpg');
										    				} ?>
															<div class="item-inner">
																<img src="{{$profilePic1}}">
															</div>
													<?php } ?>
												</div>
											</div>
											<script type="text/javascript">
												$(document).ready(function() {
												  	$("#owl-demo-learn_thismon{{$service['id']}}").owlCarousel({
													   navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
													   items : 1, 
													   loop:true,
													   nav:true,
													   dots: false,
												  	});
												});
											</script>
											<a class="fav-fun-2" href="{{ Config::get('constants.SITE_URL') }}/userlogin" ><i class="far fa-heart"></i></a>
											@if($price_all != '')	
											  <span>From ${{$price_all}}/Person</span>
											@endif
										</div>
									@endif
									<?php
										$reviews_count = BusinessServiceReview::where('service_id', $service['id'])->count();
										$reviews_sum = BusinessServiceReview::where('service_id', $service['id'])->sum('rating');
										$reviews_avg=0;
										if($reviews_count>0)
										{	
											$reviews_avg= round($reviews_sum/$reviews_count,2); 
										}
									?>
									<div class="bottom-content">
										<div class="class-info">
											 <div class="row"> 
												<div class="col-md-7 ratingtime"> 
													<div class="activity-inner-data">
														<i class="fas fa-star"></i>
														<span>{{$reviews_avg}} ({{$reviews_count}})</span>
													</div>
													@if($time != '')
														<div class="activity-hours">
															<span>{{$time}}</span>
														</div>
													@endif

													<div class="claimed">
														<span>@if($companyData->is_verified == 1)
																		CLAIMED
																	@else
																		UNCLAIMED
																	@endif</span>
													</div>
											</div>
												<div class="col-md-5 country-instant">
													<div class="activity-city">
														<span>{{$companycity}}, {{$companycountry}}</span>
													</div>
												</div>
											</div>
										</div>
											<?php
												$redlink = str_replace(" ","-",$companyname)."/".$service['cid'];
												$service_type='';
												if($service['service_type']!=''){
													if( $service['service_type']=='individual' ) $service_type = 'Personal Training'; 
													else if( $service['service_type']=='classes' )	$service_type = 'Group Classe'; 
													else if( $service['service_type']=='experience' ) $service_type = 'Experience'; 
												}
											?>
											<div class="activity-information">
												<span><a 
													  <?php if (Auth::check()) { ?> 
														  href="{{ Config::get('constants.SITE_URL') }}/businessprofile/{{$redlink}}" 
													  <?php } else { ?>
														  href="{{ Config::get('constants.SITE_URL') }}/userlogin" 
													  <?php }?>
														  target="_blank">{{ $service['program_name'] }}</a>
												</span>
												<p>{{ $service_type }}  | {{ $service['sport_activity'] }}</p>
											</div>
											<hr>
											<div class="all-details">
												<a class="showall-btn" href="/activity-details/{{$serviceid}}">More Details</a>
											</div>
										</div>
									</div>
								</div>
									<?php } ?>
						</div>
					</div>
				
				<?php
					}else{ ?>
					<div class="kickboxing-slider cart-slider">
						<label class="text-center success-cart">This provider has no other services at this time.</label>
					</div>
				<?php } ?>
			</div>
		</section>
	</div>
</div>

<!-- The Modal Checkout-->
<div class="modal fade compare-model" id="cartcheckout">
    <div class="modal-dialog cartcheckout">
        <div class="modal-content">
			<div class="modal-header" style="text-align: right;"> 
			  	<div class="closebtn">
					<button type="button" class="close close-btn-design manage-customer-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
			</div>

            <!-- Modal body -->
            <div class="modal-body body-space">
				<div class="row"> 
                    <div class="col-lg-12">
					   <h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 600;">Continue To Checkout</h4>
					</div>
					<div class="col-lg-12 btns-modal">
						<a href="{{route('addcheckoutsession')}}" class="addbusiness-btn-modal cart-btn-width">Log in</a>
						<a href="#" class="addbusiness-btn-modal"data-toggle="modal" data-target="#registermodal">Continue as Guest</a>
					</div>
				 </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<!-- The Modal Registraion-->
<div class="modal fade compare-model" id="registermodal">
    <div class="modal-dialog registermodal">
        <div class="modal-content">
			<div class="modal-header" style="text-align: right;"> 
			  	<div class="closebtn">
					<button type="button" class="close close-btn-design manage-customer-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
			</div>

            <!-- Modal body -->
            <div class="modal-body body-tbm register-bg">
				<div class="row"> 
                    <div class="col-lg-6 col-xs-12 register-modal">
						<div class="logo-my">
							<a href="#"> <img src="{{url('/public/images/logo-small.jpg')}}"> </a>
						</div>
						<div class="manage-customer-from">
							<form id="frmregister" method="post">
								<div class="register-pop-title ftitle1">
									<h3>Tell Us About You</h3>
								</div>
								<div id='systemMessage'></div>
                    			<input type="hidden" name="_token" value="{{csrf_token()}}">
								<input type="text" name="firstname" id="firstname" size="30" maxlength="80" placeholder="First Name">
								<input type="text" name="lastname" id="lastname" size="30" maxlength="80" placeholder="Last Name">
								<input type="text" name="username" id="username" size="30" maxlength="80" placeholder="Username" autocomplete="off">
								<input type="email" name="email" id="email" class="myemail" size="30" placeholder="e-Mail" maxlength="80" autocomplete="off">
								<input type="text" name="contact" id="contact" size="30" maxlength="14" autocomplete="off" placeholder="Phone" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeyup="changeformate()">
								<input type="text" id="dob" name="dob" class=" dobdate" placeholder="Date Of Birth (mm/dd/yyyy)">
								<input type="password" name="password" id="password" size="30" placeholder="Password" autocomplete="off">
								<input type="password" name="confirm_password" id="confirm_password" size="30" placeholder="Confirm Password" autocomplete="off">
								<div class="row check-txt-center">
									<div class="col-md-8">
										<div class="terms-wrap wrap-sp">
											<input type="checkbox" name="b_trm1" id="b_trm1" class="form-check-input" value="1">
											<label for="b_trm1">I agree to Fitnessity <a href="/terms-condition" target="_blank">Terms of Service</a> and <a href="/privacy-policy" target="_blank">Privacy Policy</a></label>
										</div>
                    					<div id='termserror'></div><br>
										<button type="button" style="margin-bottom: 10px;" class="signup-new" id="register_submit" onclick="$('#frmregister').submit();">Create Account</button><br>
										<button type="button" style="margin-bottom: 10px; display: none;" class="signup-new" id="continue_cart" onclick="gotocart();">Continue</button>
									</div>
								</div>
							</form>
						</div>
                    </div>
				 </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

@include('layouts.footer')

<script type="text/javascript">
	$(document).ready(function () {

		$("#frmregister").submit(function (e) {
            e.preventDefault();
            $('#frmregister').validate({
                rules: {
                    firstname: "required",
                    lastname: "required",
                    username: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    dob: {
                        required: true,
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    confirm_password: {
                        required: true,
                        minlength: 8,
                        equalTo: "#password"
                    },
                },
                messages: {
                    firstname: "Enter your Firstname",
                    lastname: "Enter your Lastname",
                    username: "Enter your Username",
                    email: {
                        required: "Please enter a valid email address",
                        minlength: "Please enter a valid email address",
                        remote: jQuery.validator.format("{0} is already in use")
                    },
                    dob: {
                        required: "Please provide your date of birth",
                    },
                    password: {
                        required: "Provide a password",
                        minlength: jQuery.validator.format("Enter at least {0} characters")
                    },
                    confirm_password: {
                        required: "Repeat your password",
                        minlength: jQuery.validator.format("Enter at least {0} characters"),
                        equalTo: "Enter the same password as above"
                    },
                },
                submitHandler: registerUser
            });
        });

        $('#email').on('blur', function() {
	        var posturl = '{{route("emailvalidation")}}';
	        var formData = $("#frmregister").serialize();
	        $.ajax({
                url: posturl,
                type: 'get',
                dataType: 'json',
                data: formData,  
                 beforeSend: function () {
                    $("#systemMessage").html('');
                },             
                success: function (response) {                    
                    $("#systemMessage").html(response.msg).addClass('alert-class alert-danger');  
                }
            });
	    });

	    

	  	$(document).on('click', '.serv_fav1', function(){
        var ser_id = $(this).attr('ser_id');
        // var _token = $("input[name='_token']").val();
        var _token = $('meta[name="csrf-token"]'). attr('content');
        $.ajax({
            type: 'POST',
            url: '{{route("service_fav")}}',
            data: {
                _token: _token,
                ser_id: ser_id
            },
            success: function (data) {
                if(data.status=='like')
				{
					$('#serfav'+ser_id).html('<i class="fas fa-heart"></i>');
				}
				else
				{
					$('#serfav'+ser_id).html('<i class="far fa-heart"></i>');
				}
            }
        });
    });
  	});


	function gotocart(){
		window.location = '{{route("payments_card")}}'
	}

	function getAge() {
        var dateString = document.getElementById("dob").value;
        var today = new Date();
        var birthDate = new Date(dateString);
        var age = today.getFullYear() - birthDate.getFullYear();
        if(age < 13)
        {
            var agechk = '0';
        } else {
           var agechk = '1';
        }
        return agechk;
    }

    function registerUser() {

        var valchk = getAge();
        var validForm = $('#frmregister').valid();
        var posturl = '/auth/postRegistration_as_guest';
        if (!jQuery("#b_trm1").is(":checked")) {
           $("#termserror").html('Plese Agree Terms of Service and Privacy Policy.').addClass('alert-class alert-danger');
            return false;
        }
        if(valchk == 1){
            $('#register_submit').prop('disabled', true);
            if (validForm) {

                var formData = $("#frmregister").serialize();
                $.ajax({
                    url: posturl,
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    beforeSend: function () {
                        
                        $('#register_submit').prop('disabled', true).css('background','#999999');
                        showSystemMessages('#systemMessage', 'info', 'Please wait while we register you with Fitnessity.');
                        $("#systemMessage").html('Please wait while we register you with Fitnessity.').addClass('alert-class alert-danger');
                    },
                    complete: function () {
                    
                        $('#register_submit').prop('disabled', true).css('background','#999999');
                    },
                    success: function (response) {
                        $("#systemMessage").html(response.msg).addClass('alert-class alert-danger');
                        showSystemMessages('#systemMessage', response.type, response.msg);
                        if (response.type === 'success') {
                        	$('#continue_cart').css('display','block');
                            //window.location.href = response.redirecturl;
                        } else {
                            $('#register_submit').prop('disabled', false).css('background','#ed1b24');
                        }
                    }
                });
            }
        
        }else{
            $("#systemMessage").html('You must be at least 13 years old.').addClass('alert-class alert-danger');
        }
    }

    function changeformate() {
        /*alert($('#contact').val());*/
        var con = $('#contact').val();
        var curchr = con.length;
        if (curchr == 3) {
            $("#contact").val("(" + con + ")" + "-");
        } else if (curchr == 9) {
            $("#contact").val(con + "-");
        }
    }
</script>
<script>
jQuery("#carousel-slider").owlCarousel({
  autoplay: true,
  rewind: true, /* use rewind if you don't want loop */
  margin: 20,
   /*
  animateOut: 'fadeOut',
  animateIn: 'fadeIn',
  */
  responsiveClass: true,
  autoHeight: true,
  autoplayTimeout: 7000,
  smartSpeed: 800,
  nav: true,
  navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
  responsive: {
    0: {
      items: 1
    },

    600: {
      items: 3
    },

    1024: {
      items: 3
    },

    1366: {
      items: 3
    }
  }
});
</script>
@endsection

