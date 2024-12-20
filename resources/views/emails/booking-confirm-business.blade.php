<!DOCTYPE html>

<html>

<?php

use Carbon\Carbon;
use App\BusinessPriceDetails;
use App\BusinessService;
use App\BusinessActivityScheduler;
use App\UserBookingDetail;
use App\UserFamilyDetail;
use App\StaffMembers;

	$sc_date = "—";
	$Datebooked = "—";
	$qty = "—";
	$b_type = "—";
	$sport_activity = "—";
	$company_name = "—";
	$select_service_type = "—";
	$program_name = "—";
	$activity_location = "—";
	$activity_for = "—";
	$difficult_level = "—";
	$bus_address = "—";
	$contact_number = "—";
	$program_desc = "—";
	$SpotsLeftdis = 0;
    $country = "United States";
	$service_type = '';
  
    $a  = [];

	$dt = Carbon::now();
	$url = env('APP_URL');
	$adu_qtystatus = $child_qtystatus = $infant_qtystatus = 0;
	$cart = session()->get('cart_item');

	foreach(@$BookingDetail as $BookingDetail1){
		$sportval = @$BookingDetail1['user_booking_detail']['sport'];
		$qty = str_replace(str_split('{""}'), ' ',@$BookingDetail1['user_booking_detail']['qty']);
		$Datebooked = date("m-d-Y", strtotime(@$BookingDetail1['user_booking_detail']['bookedtime'])); 
		$Datebooked = str_replace('-', '/', $Datebooked);  

		$scheduleddata = json_decode(@$BookingDetail1['user_booking_detail']['booking_detail'],true);
		if(@$scheduleddata['sessiondate'] != ''){
			$sc_date = date("m-d-Y", strtotime(@$scheduleddata['sessiondate']));
			$sc_date = str_replace('-', '/', $sc_date); 
		}

		$servicedata = BusinessActivityScheduler::where('id',@$BookingDetail1['user_booking_detail']['act_schedule_id'])->first();

		if(@$BookingDetail1['businessservices']['service_type']=='individual')
		{ 
			$b_type = 'Personal Training'; 
		}else { 
			$b_type =ucfirst(@$BookingDetail1['businessservices']['service_type']); 
		}

		$language_name = BusinessService::where('cid',@$BookingDetail1['businessservices']['cid'])->first(); 
		$language = @$language_name->languages;

		$today = date('Y-m-d');
	    $SpotsLeft = UserBookingDetail::where(['sport'=>@$BookingDetail1['businessservices']['id'],'act_schedule_id'=>@$servicedata->id])->whereDate('bookedtime', '=', $today)->count();
	  
	    if( @$servicedata->spots_available != ''){
	        $SpotsLeftdis = @$servicedata->spots_available  - $SpotsLeft;
	    }

	    $company_name = @$BookingDetail1['businessuser']['dba_business_name'];
	    $company_id = @$BookingDetail1['businessuser']['id'];
	    $sport_activity = @$BookingDetail1['businessservices']['sport_activity'];
	    $select_service_type = @$BookingDetail1['businessservices']['select_service_type'];
	    $program_name = @$BookingDetail1['businessservices']['program_name'];
	    $activity_location = @$BookingDetail1['businessservices']['activity_location'];
	    $activity_for = @$BookingDetail1['businessservices']['activity_for'];
	    $difficult_level = @$BookingDetail1['businessservices']['difficult_level'];

	    $a = json_decode(@$BookingDetail1['user_booking_detail']['participate'],true); 

	    $bus_address = @$BookingDetail1['businessuser']['address'].' , '.@$BookingDetail1['businessuser']['city'].' , '.@$BookingDetail1['businessuser']['state'].' , '.@$BookingDetail1['businessuser']['country'];
	    $contact_number = @$BookingDetail1['businessuser']['contact_number'];
	    $service_type = @$BookingDetail1['businessservices']['service_type'];
	    $program_desc = @$BookingDetail['businessservices']['program_desc'];

	    $instructor_name = @$bususername;
	    $instructor_id = @$BookingDetail1['businessservices']['instructor_id'];
	    if($instructor_id != ''){
	    	$instructor_dta = StaffMembers::select('name')->where('id',$instructor_id)->first();
	    	$instructor_name = $instructor_dta->name;
	    }
	}

	foreach ($cart as $key => $value) {
		foreach ($value as $key => $cartval) {
			if($cartval['code']== $sportval){
				$priceid = $cartval['priceid'];
				$totalpaid = $cartval['totalprice'];
				if(!empty($cartval['adult'])){
					if($cartval['adult']['quantity'] != '' && $cartval['adult']['quantity'] !=0){
						$adu_qtystatus = 1;
					}
				}
				if(!empty($cartval['child'])){
					if($cartval['child']['quantity'] != '' && $cartval['child']['quantity'] !=0){
						$child_qtystatus = 1; 
					}
					
				}
				if(!empty($cartval['infant'])){
					if($cartval['infant']['quantity'] != '' && $cartval['infant']['quantity'] !=0){
						$infant_qtystatus = 1;
					}
				}
			}
		}
	}
	
	$BusinessPriceDetails = BusinessPriceDetails::where('id',$priceid)->first();
	
	$adu_est_earn = $child_est_earn = $infant_est_earn = 0;
	if(date('l',strtotime($sc_date)) == 'Saturday' || date('l',strtotime($sc_date)) == 'Sunday'){
		if($adu_qtystatus != 0){
			$adu_est_earn = @$BusinessPriceDetails->weekend_infant_estearn;
		}
		if($child_qtystatus != 0){
			$child_est_earn = @$BusinessPriceDetails->weekend_infant_estearn;
		}
		if($infant_qtystatus != 0){
			$infant_est_earn = @$BusinessPriceDetails->weekend_infant_estearn;
		}
	}else{
		if($adu_qtystatus != 0){
			$adu_est_earn = @$BusinessPriceDetails->adult_estearn;
		}
		if($child_qtystatus != 0){
			$child_est_earn = @$BusinessPriceDetails->child_estearn;
		}
		if($infant_qtystatus != 0){
			$infant_est_earn = @$BusinessPriceDetails->infant_estearn;
		}
	}
	$totalest_earn = $adu_est_earn + $child_est_earn + $infant_est_earn;

?>

<body width="100%" style="margin: 0; padding: 0 !important; background-color:#ede9e6; margin:0 auto!important; padding:0!important; height:100%!important; width:100%!important; font-family:Poppins,Arial,sans-serif">
    <center role="article" aria-roledescription="email" lang="en" style="width: 100%;">
        <div style="background-color:#ede9e6;">
                 <table height="100%" width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td valign="top" align="left"  style="padding:35px 10px">
                        <div style="max-width: 680px; margin: 0 auto;">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="    font-family: Arial,sans-serif; text-align: center;  color: rgba(255,255,255,.5);  font-family: sans-serif;  font-size: 12px;  line-height: 18px; ">
                                <tr>
                                    <td style="padding:0 0 10px 0;">
                                        <!--<webversion style="text-decoration: underline; font-weight: bold; color: black;">View in web browser</webversion>-->
                                    </td>
                                </tr>
                            </table>
                             <table height="100%" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td  style="padding:21px 0px 0px;  background: #fff;">
                                        <!-- Email Body : BEGIN -->
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                                            <!-- Email Header : BEGIN -->
                                            <tr>
                                                <td style="padding: 0  0 18px 0; text-align: center">
                                                </td>
                                            </tr>
                                            <!-- Email Header : END -->
                                            <!-- Background Image with Text : BEGIN -->
                                            <tr>
                                                <td style="padding:0px 0px 0px">
                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>

                                                            <!-- Bulletproof Background Images c/o https://backgrounds.cm -->

                                                            <td style="text-align: center; background-color: #e4e4e4;">

                                                                <div>

                                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">

                                                                        <tr>

                                                                           

                                                                        </tr>

                                                                    </table>

                                                                </div>

                                                            </td>

                                                        </tr>

                                                    </table>

                                                </td>

                                            </tr>

                                            <!-- Background Image with Text : END -->

											

											<!-- Banner Image with Text : BEGIN -->

                                            <tr>

                                               <!-- <td style="text-align: left; padding: 15px 15px 40px;">-->
												<?php $url1 = $url.'/public/images/bg-1.png'; ?>
												<td style="text-align: center; background-image: url({{$url1}}); background-size: cover !important; padding: 15px 15px 98px;;">

                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">

                                                        <tr>

                                                            <td>

                                                                <div>

                                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">

                                                                        <tr><td style="font-size: 13px;text-align: left;"></td></tr>

																		<tr><td style="font-size: 13px;text-align: left;"></td></tr>

																		<tr><td style="font-size: 13px;text-align: left;"></td></tr>

																		<tr><td style="font-size: 13px;text-align: left;"></td></tr>

																		<tr>

																			<td style="text-align: center; padding: 25px 0px 15px 0px;">

																				<img src="{{$url}}/public/images/BUSSINESSLOGO.png" width="290"  alt="logo" border="0" style="height: auto;">

                                                                            </td>

																		</tr>

																		<tr><td style="font-size: 20px; font-weight: 600; text-align: center;">CONGRATULATIONS!</td></tr>

																			<tr><td style="font-size: 20px; font-weight: 600; text-align: center;">YOU HAVE A NEW BOOKING

																			</td>

																		</tr>

																		<tr><td style="font-size: 20px;  text-align: center;padding-top: 42px;"><a style="border: none;font-weight: 600;border-radius: 10px;padding: 7px;color: white;background-color: #fe0000; box-shadow: 10px 10px;text-decoration: none; font-size: 18px;" href="{{$url}}/manage/service/{{@$company_id}}">VIEW BOOKINGS</a></td></tr>

                                                                    </table>

                                                                </div>

                                                            </td>

                                                        </tr>

                                                    </table>

                                                </td>

                                            </tr>

                                            <!-- Banner Image with Text : END -->

											

											<!-- Red Background with Text : BEGIN -->

                                            <tr>

                                                <td style="padding:0px 0px 0px">

                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">

                                                        <tr>

                                                            <!-- Bulletproof Background Images c/o https://backgrounds.cm -->

                                                            <td style="text-align: center; background-color: #e4e4e4;">

                                                                <div>

                                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">

                                                                        <tr>

                                                                            <td style="text-align: center; padding: 15px 32px 15px;" align="center">

																				<span style="font-weight: 500; font-size: 20px; color: #000000;">Greetings {{ @$company_name}} </span> 

																				<p style="font-weight: 400; font-size: 13px; color: #000000; margin-bottom: 0px; margin-top: 0px;">This is to confirm that you have received a new booking from {!! $username !!}. </p>

																				<p style="font-weight: 400; font-size:13px; color: #000000; margin-bottom: 0px; margin-top: 0px;">Take a look at the details bellow and learn more about your customer. </p>

	                                                                        </td>

                                                                        </tr>

                                                                    </table>

                                                                </div>

                                                            </td>

                                                        </tr>

                                                    </table>

                                                </td>

                                            </tr>

                                            <!-- Red Background with Text : END -->

											

                                            <!-- Font Image : BEGIN -->

                                            <tr>

                                                <td style=" padding:0px 10px 0px; text-align: center" align="center">

                                                    <h6 style="font-size: 25px; font-weight: 600; color: #f91942;margin-bottom: 1px;">BOOKING DETAILS<h6>

                                                </td>

                                            </tr>

                                            <!-- Font Image : END -->





                                            <!-- Thumbnail Right, Text Left : BEGIN -->

                                            <tr>

                                                <td dir="rtl" height="100%" valign="top" width="100%" style="font-size:0; padding: 10px 10px; text-align: center; " align="center" valign="center">

                                                   

                                                    <div style="display:inline-block; margin: 0 -1px; max-width: 340px; min-width:200px; vertical-align:top; width:100%;">

                                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">

                                                            <tr>

                                                                <td dir="ltr" style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 20px 10px; text-align: left; height: 243px;">

																<h2 style="margin: 0 0 5px 0; font-family: 'Poppins',sans-serif; font-size: 15px; line-height: 50px; color: black; font-weight: 600;margin-bottom: 0px;"><img src="{{$url}}/public/images/1.png" width="30"  alt="logo" border="0" style="height: auto; margin-right:15px;">ACTIVITY INFO</h2>

																	<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Confirmation Booking #</h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">1</h2>

																			</td>

																		</tr>

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Price option:</h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{ @$BusinessPriceDetails['price_title']}} - {{ @$BusinessPriceDetails['pay_session']}} Sessions</h2>

																			</td>

																		</tr>

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Total Sessions:</h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right"> {{ @$SpotsLeftdis}}/{{@$servicedata->spots_available}}</h2>

																			</td>

																		</tr>

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Date Booked:</h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{@$Datebooked}}</h2>

																			</td>

																		</tr>

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Date scheduled:</h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black;font-weight: 300;margin-bottom: 0px;text-align: right;">{{@$sc_date}}</h2>

																			</td>

																		</tr>

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Time of Activity:</h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right"><?php 

																				if(@$servicedata['shift_start']!=''){

																					echo date('h:ia', strtotime( @$servicedata['shift_start'] )); 

																				}

																				if(@$servicedata['shift_end']!=''){

																					echo ' to '.date('h:ia', strtotime( @$servicedata['shift_end'] )); 

																				}?></h2>

																			</td>

																		</tr>

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Country:</h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{$country}}</h2>

																			</td>

																		</tr>

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Duration of activity:</h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">

													<?php 
														$tm = "—";
														if(@$servicedata->set_duration !=''){
															$time = explode(' ',$servicedata->set_duration);
															$hr =''; $min =''; $sec ='';
															if($time[0] != 0) {
																$hr = $time[0].' hr. ';
															}

															if($time[2] != 0) {
																$min=$time[2].' min. '; 
															}

															if($time[4]!=0) {
																$sec=$time[4].' sec.';
															}

															if($hr!='' || $min!='' || $sec!=''){
															 	$tm = $hr.$min.$sec;
															}
														} 
													?>							{{@$tm}}</h2>

																			</td>

																		</tr>

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Total Paid:  </h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">${{@$totalpaid}}</h2>

																			</td>

																		</tr>

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Booked by:  </h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right"> {{$username }}</h2>

																			</td>

																		</tr>

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Activity Type: </h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{@$sport_activity}} </h2>

																			</td>

																		</tr>

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Service Type: </h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{@$select_service_type}} </h2>

																			</td>

																		</tr>

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Program Name:</h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{@$program_name}} </h2>

																			</td>

																		</tr>

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Activity Location:</h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{@$activity_location}}</h2>

																			</td>

																		</tr>

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Great For: </h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right"> {{@$activity_for}} </h2>

																			</td>

																		</tr>

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Language: </h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{@$language}}</h2>

																			</td>

																		</tr>

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Participants: </h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{@$qty}}</h2>

																			</td>

																		</tr>

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Activity Skill Level:</h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right"> {{@$difficult_level}}</h2>

																			</td>

																		</tr>

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Membership Type:</h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{@$BusinessPriceDetails['membership_type']}}</h2>

																			</td>

																		</tr>

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Business Type: </h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{@$b_type}}</h2>

																			</td>

																		</tr>

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Who is participating:  </h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right"> 

																<?php
																    if(!empty($a)){
																        foreach($a as $data){
																            if($data['from'] == 'family'){
																                $family = UserFamilyDetail::where('id',$data['id'])->first();
																                echo @$family->first_name.' '.@$family->last_name."<br>";
																            }else{ ?>
																                {{ $username}}
																            <?php echo "<br>"; } 
																        } 
																    } ?>
																</h2>

																			</td>

																		</tr>

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;"></h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right"></h2>

																			</td>

																		</tr>

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Your Instructor Is:</h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{ @$instructor_name }}</h2>

																			</td>

																		</tr>

																		<tr>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Provider Company: </h2>

																			</td>

																			<td>

																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{ @$company_name }} </h2>

																			</td>

																		</tr>

																	</table>

																

                                                                </td>

                                                            </tr>

															<tr>

																	<td>Confirmation Booking #</td>

																	<td>1</td>

																</tr>

                                                        </table>

                                                    </div>

                                                  

                                                    <div style="display:inline-block; margin: 0 -1px; max-width: 320px; min-width:200px; vertical-align:top;">

													

                                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="border-spacing:0!important; border-collapse:collapse!important;  table-layout:fixed!important;   margin:0 auto!important">

                                                            <tr>

                                                                <td dir="ltr" style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 20px 10px 0px;; text-align: left; height: 120px;">

																<span style="margin: -44px 0 5px 0; font-family: 'Poppins',sans-serif; font-size: 15px; line-height: 50px; color: black; font-weight: 600;margin-bottom: 0px;"><img src="{{$url}}/public/images/2.png" width="30"  alt="logo" border="0" style="height: auto; margin-right:15px;">CLIENT INFO</span>

                                                                <h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Booking made by: {{ $username}}</h2>

																<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Email: {{ @$useremail }}</h2>

																<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">

                                                                </td>

                                                            </tr>

                                                        </table>

                                                    </div>

                                                </td>

                                            </tr>

                                          

											<tr>

												<td><h2 style="padding: 0px 0; text-align: center; font-size:14px; font-weight: normal; 

												margin-bottom: 15px;">To date, You have received 1 bookings and a have made a total of ${{@$totalest_earn}} from Fitnessity!.</h2></td>

											</tr>

											

											 <!-- Follow us: START -->

                                            <tr>

                                                <td style=" padding: 15px 10px 0px; background: black;">

                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" class="follow-us">

                                                        

                                                        <tr>

                                                            <td>

																<h5 style="color: white; text-align: center; font-weight: 400; margin-top: 7px; margin-bottom: 0px;">@ copyright 2022 Fitnessity, Inc.</h5>

																<h5 style="color: white; text-align: center; font-weight: 400; margin-top: 0px; margin-bottom: 7px;">Privacy Policy  | Terms of Service</h5>

																

                                                            </td>



                                                        </tr>

                                                    </table>

                                                </td>

                                            </tr>

                                            <!-- Follow us: END -->



                                        </table>

                                        <!-- Email Body : END -->

                                    </td>

                                </tr>

                               

                            </table>

                        

                        </div>

                    </td>

                </tr>

            </table>

        </div>

    </center>

</body>

</html>