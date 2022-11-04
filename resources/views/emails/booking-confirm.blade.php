<!DOCTYPE html>
<html>
<?php

use Carbon\Carbon;
use App\BusinessPriceDetails;
use App\BusinessService;
use App\UserBookingDetail;
use App\BusinessActivityScheduler;
use App\BusinessTerms;
use App\UserFamilyDetail;
	
	$url = env('APP_URL');
	$dt = Carbon::now();
	$cart = session()->get('cart_item');
	foreach ($cart as $key => $value) {
		foreach ($value as $key => $cartval) {
			if($cartval['code']== @$BookingDetail['user_booking_detail']['sport']){
				$priceid = $cartval['priceid'];
				$totalpaid = $cartval['totalprice'];
			}
		}
	}	

	$qty = str_replace(str_split('{""}'), ' ',@$BookingDetail['user_booking_detail']['qty']);
	
	$Datebooked = date("m-d-Y", strtotime(@$BookingDetail['user_booking_detail']['bookedtime'])); 
	$Datebooked = str_replace('-', '/', $Datebooked);  

	$scheduleddata = json_decode(@$BookingDetail['user_booking_detail']['booking_detail'],true);
	$sc_date = date("m-d-Y", strtotime($scheduleddata['sessiondate']));
	$sc_date = str_replace('-', '/', $sc_date);  

	$servicedata = BusinessActivityScheduler::where('id',@$BookingDetail['user_booking_detail']['act_schedule_id'])->first();

	/*$BusinessPriceDetails = BusinessPriceDetails::where(['id'=>$priceid,'serviceid' =>@$BookingDetail['user_booking_detail']['sport']])->first();*/
	$BusinessPriceDetails = BusinessPriceDetails::where('id',$priceid)->first();

	if(@$BookingDetail['businessservices']['service_type']=='individual')
	{ 
		$b_type = 'Personal Training'; 
	}else { 
		$b_type =ucfirst(@$BookingDetail['businessservices']['service_type']); 
	}

	$language_name = BusinessService::where('cid',@$BookingDetail['businessservices']['cid'])->first(); 
	$language = @$language_name->languages;

	$today = date('Y-m-d');
    $SpotsLeftdis = 0;
    $SpotsLeft = UserBookingDetail::where(['sport'=>@$BookingDetail['businessservices']['id'],'act_schedule_id'=>$servicedata->id])->whereDate('bookedtime', '=', $today)->count();
  
    if( @$servicedata->spots_available != ''){
        $SpotsLeftdis = @$servicedata->spots_available  - $SpotsLeft;
    }

	/*$country = '';*/
    /*if(@$BookingDetail['businessuser']['country'] == 'usa' || @$BookingDetail['businessuser']['country'] == 'USA' || @$BookingDetail['businessuser']['country'] == 'United states' )
    {*/
    	$country = "United States";
    /*}*/

	$homerule = '';
	$cancelrule = '';
	$cleanrule = '';
    $BusinessTerms = BusinessTerms::where('cid',@$BookingDetail['businessservices']['cid'])->first();
    $homerule =  @$BusinessTerms->houserules;
    $cancelrule =  @$BusinessTerms->cancelation;
    $cleanrule =  @$BusinessTerms->cleaning;

    $meetup_location = '';
    $included_items = [];
    $notincluded_items = [];
    $bring_wear = [];
    $included_items = explode (",", @$BookingDetail['businessservices']['included_items']);
    $notincluded_items = explode (",", @$BookingDetail['businessservices']['notincluded_items']);
    $bring_wear = $str_arr = explode (",", @$BookingDetail['businessservices']['bring_wear']);
    $meetup_location = @$BookingDetail['businessservices']['meetup_location'];

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
                                                                            <td style="text-align: left; padding: 15px;">BOOKING CONFIRMATION
                                                                            </td>
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
																				<img src="{{$url}}/public/images/logo1.png" width="225"  alt="logo" border="0" style="height: auto;">
                                                                            </td>
																		</tr>
																		<tr><td style="font-size: 28px; font-weight: 600; text-align: center;">BOOKING CONFIRMATION</td></tr>
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
                                                                            <td style="text-align: center; padding: 0px 28px 14px 28px;" align="center">
																				<p style="font-weight: 500; font-size: 20px; color: #000000; margin: 10px 0px 2px 0px">Greetings {!! @$BookingDetail['user']['firstname'] !!} {!! @$BookingDetail['user']['lastname'] !!}  </p>
																				<p style="font-weight: 400; font-size: 13px; color: #000000; margin-bottom: 0px; margin-top: 0px;">This is to notify you that your scheduled booking with {{ @$BookingDetail['businessuser']['company_name'] }} has been confirmed.   </p>
																				<p style="font-weight: 400; font-size: 13px; color: #000000; margin-bottom: 0px; margin-top: 0px;">View the company's information and your booking details below. </p>
																				<p style="font-weight: 400; font-size: 13px; color: #000000;margin-bottom: 0px; margin-top: 0px;">This company required that you understand & agree to their terms below before you arrive.  </p>
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
                                                    <h6 style="font-size: 25px; font-weight: 800; color: #f91942;margin-bottom: 1px;">BOOKING DETAILS<h6>
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
																<h2 style="margin: 0 0 5px 0; font-family: 'Poppins',sans-serif; font-size: 15px; line-height: 50px; color: black; font-weight: 600;margin-bottom: 0px;"><img src="{{$url}}/public/images/1.png" width="30"  alt="logo" border="0" style="height: auto; margin-right:
																15px;"> ACTIVITY INFO  </h2>
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
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right"> {{ @$SpotsLeftdis}}/
																				 {{@$servicedata->spots_available}}</h2>
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
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">
																				{{@$sc_date}}</h2>
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
																					echo ' to '.date('h:ia', strtotime( $servicedata['shift_end'] )); 
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
													?>							{{@$tm}}
																				</h2>
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
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{ @$BookingDetail['user']['firstname'] }} {{ @$BookingDetail['user']['lastname'] }}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Activity Type: </h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right"> {{@$BookingDetail['businessservices']['sport_activity']}} </h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Service Type: </h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{@$BookingDetail['businessservices']['select_service_type']}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Program Name:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{@$BookingDetail['businessservices']['program_name']}} </h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Activity Location:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right"> {{@$BookingDetail['businessservices']['activity_location']}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Great For: </h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right"> {{@$BookingDetail['businessservices']['activity_for']}} </h2>
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
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">Easy</h2>
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
																				
																<?php  $a = json_decode(@$BookingDetail['user_booking_detail']['participate'],true); 
																    if(!empty($a)){
																        foreach($a as $data){
																            if($data['from'] == 'family'){
																                $family = UserFamilyDetail::where('id',$data['id'])->first();
																                echo @$family->first_name.' '.@$family->last_name."<br>";
																            }else{ ?>
																                {{ @$BookingDetail['user']['firstname'] }} {{ @$BookingDetail['user']['lastname']}}
																            <?php echo "<br>"; } 
																        } 
																    } ?>

																				</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Your Instructor Is:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{ @$BookingDetail['businessuser']['first_name'] }} {{ @$BookingDetail['businessuser']['last_name'] }}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Provider Company: </h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{ @$BookingDetail['businessuser']['company_name'] }} </h2>
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
                                                                <td dir="ltr" style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 20px 10px 0px;; text-align: left; height: 243px;">
																<h2 style="margin: -44px 0 5px 0; font-family: 'Poppins',sans-serif; font-size: 15px; line-height: 50px; color: black; font-weight: 600;margin-bottom: 0px;"><img src="{{$url}}/public/images/2.png" width="30"  alt="logo" border="0" style="height: auto; margin-right:
																15px;">PROVIDER BUSINESS INFO  </h2>
                                                                <h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Provider Company Name: {{ @$BookingDetail['businessuser']['company_name'] }}</h2>
																<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Email: {{ @$BookingDetail['businessuser']['email'] }} </h2>
																<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Provider Address: {{@$BookingDetail['businessuser']['address']}}, {{@$BookingDetail['businessuser']['city']}}, {{@$BookingDetail['businessuser']['state']}}, {{@$BookingDetail['businessuser']['country']}}</h2>
																<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Phone Number:  {{ @$BookingDetail['businessuser']['contact_number']}}</h2>
																<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Contact Person: {{ @$BookingDetail['businessuser']['first_name'] }} {{ @$BookingDetail['businessuser']['last_name'] }} </h2>
																<h2 style="padding: 0px 0; text-align: center; border-bottom:2px solid #f91942;margin-bottom: 0px;"></h2>
                                                                </td>
                                                            </tr>
															<tr>
                                                                <td dir="ltr" style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 0px 10px; text-align: left; height: 243px;">
																<h2 style="margin: -43px 0 5px 0; font-family: 'Poppins',sans-serif; font-size: 15px; line-height: 50px; color: black; font-weight: 600;margin-bottom: -5px; text-align: center;">KNOW BEFORE YOU GO  </h2>
                                                                <h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 600;margin-bottom: 0px;margin-bottom: 5;">House Rules</h2>
																<p style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; margin-bottom: 5px; font-weight: 300; text-align: justify;">{{$homerule}}</p>
																
																<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 600;margin-bottom: 0px;margin-bottom: 5px;">Cancelation Policy</h2>
																<p style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; margin-bottom: 5px; font-weight: 300; text-align: justify;">{{$cancelrule}}</p>
																
																<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 600;margin-bottom: 0px;margin-bottom: 5px;">Safety and Cleaning Procedures</h2>
																<p style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; margin-bottom: 5px; font-weight: 300; text-align: justify;">{{$cleanrule}}</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
													<h2 style="padding: 0px 0; text-align: center; border-bottom:2px solid #f91942;margin-bottom: 0px;"></h2>
                                                </td>
                                            </tr>
                                            <!-- Thumbnail Right, Text Left : END -->
											
											<tr>
                                                <td style=" padding:8px 10px 8px; text-align: center" align="center">
                                                    <span style="font-size: 15px; font-weight: 600; color: #000;margin-bottom: 1px;">AGREE TO THE TERMS
                                                    </span> 
                                                </td>
                                            </tr>
											<!-- Thumbnail Right, Text Left : BEGIN -->
                                            <tr>
                                                <td dir="rtl" height="100%" width="100%" style="font-size:0; padding: 0px 10px; text-align: center; " align="center" valign="center">
                                                   
                                                    <div style="display:inline-block; margin: 0px -1px; max-width: 340px; min-width:200px; width:100%;">
                                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                            <tr>
                                                                <td dir="ltr" style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 0px 10px; text-align: justify; height: 243px;">
																	<p style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; margin-bottom: 5px; font-weight: 300; ">
																	Provider may require additional information or verification below from the participants. If you see a Yes or No, please be prepared to present the information required.</p>
																	
																	<h2 style="font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: red; margin-bottom: 5px; font-weight: 300; display: inline; margin-right: 15px;">Yes </h2><p style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; margin-bottom: 5px; font-weight: 300; display: inline;">Provider requires participants to have ID upon arrival for verification of age and identity.</p><br>
																	
																	<h2 style="font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; margin-bottom: 5px; font-weight: 300; display: inline; margin-right: 15px;">No </h2><p style="margin: 0 0 10px 0; display: inline; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; margin-bottom: 5px; font-weight: 300;">Provider requires participants to have proof of vaccination.</p><br>
																	
																	<h2 style="font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; margin-bottom: 5px; font-weight: 300; display: inline; margin-right: 15px;">No </h2><p style="margin: 0 0 10px 0;display: inline; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; margin-bottom: 5px; font-weight: 300;">Provider requires participants to have proof of a negative Covid-19 test.</p>
                                                                </td>
                                                            </tr>
															
                                                        </table>
                                                    </div>
                                                  
                                                    <div style="display:inline-block; margin: px -1px; max-width: 320px; min-width:200px; vertical-align:top;">
													
                                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="border-spacing:0!important; border-collapse:collapse!important;  table-layout:fixed!important;   margin:0 auto!important">

															<tr style="vertical-align: top">
                                                                <td dir="ltr" style="vertical-align: top; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 0px 10px; text-align: left; height: 243px;">
																	<p style="font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; margin-bottom: 5px; font-weight: 300;">
																	This provider required that you agreed to some terms and conditions before arriving for the activity.</p>
																	<br>
																	<h2 style="font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; margin-bottom: 5px; font-weight: 300; display: inline; margin-right: 15px;">Agreed Terms Below </h2>
																	<br>
																	<p style="margin: 0 0 10px 0;display: inline; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; margin-bottom: 5px; font-weight: 300;">Liability Waiver, Covid-19 Protocols, Terms, Conditions, FAQ Contract Policy, Refund Policy</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
											
                                            	@if(@$BookingDetail['businessservices']['service_type']=='experience')
                                                    <h2 style="padding: 0px 0; text-align: center; border-bottom:2px solid #f91942;margin-bottom: 0px;"></h2>
                                                @endif
                                                </td>
                                            </tr>
                                            <!-- Thumbnail Right, Text Left : END -->

                                            @if(@$BookingDetail['businessservices']['service_type']=='experience')
												
	                                            <tr>
	                                                <td style=" padding:15px 10px 15px; text-align: center" align="center">
	                                                    <span style="font-size: 15px; font-weight: 600; color: #000;margin-bottom: 1px;">SEE YOUR ITINERARY
	                                                    </span> 
	                                                </td>
	                                            </tr>
	                                            <tr>
	                                                <td dir="rtl" height="100%" width="100%" style="font-size:0; padding: 0px 10px; text-align: center; " align="center" valign="center">
	                                                   
	                                                    <div style="display:inline-block; margin: 0px -1px; max-width: 340px; min-width:200px; width:100%;">
	                                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
	                                                            <tr>
	                                                                <td dir="ltr" style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 0px 10px; text-align: justify; height: 243px;vertical-align: top;">
	                                                                	<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 600;margin-bottom: 5px;">What should Guest Bring and Wear? </h2>

																		<ul>
																			@foreach($bring_wear as $b_wear)
																			<li style="list-style-type: number; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: #000;font-weight: 300; margin-left: -31px;
																				margin-top: -10px;
																			">{{$b_wear}}</li>
																			@endforeach
																			<!-- <li style=" list-style-type: number; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: #000;font-weight: 300;margin-left: -28px;">Activity Equipment </li>
																			<li style=" list-style-type: number; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: #000;font-weight: 300;margin-left: -28px;">Food </li>
																			<li style=" list-style-type: number; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: #000;font-weight: 300;margin-left: -28px;">Water </li> -->
																		</ul>
																	@if($meetup_location != '')
																		<h2 style="margin: 0 0 10px 0;font-family: 'Poppins', sans-serif; font-size: 13px;line-height: 22px; color: black; font-weight: 600; 
																			margin-bottom: 5px;">Meeting point and what to look for?</h2>
																		<p style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; margin-bottom: 5px; font-weight: 300;">
																		{{$meetup_location}}</p>
																	@endif
	                                                                </td>
	                                                            </tr>
	                                                        </table>
	                                                    </div>
	                                                  
	                                                    <div style="display:inline-block; margin: px -1px; max-width: 320px; min-width:200px; vertical-align:top;">
														
	                                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="border-spacing:0!important; border-collapse:collapse!important;  table-layout:fixed!important;   margin:0 auto!important">

																<tr>
	                                                                <td dir="ltr" style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 0px 10px; text-align: justify; height: 243px;">
	                                                                	<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 600;margin-bottom: 0px;margin-bottom: 5px;">What will you be doing?</h2>
																		<p style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; margin-bottom: 5px; font-weight: 300;">
																		{{@$BookingDetail['businessservices']['program_desc']}}</p>

																		<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 600;margin-bottom: 0px;">What's Included with this experience? </h2>
																		<ul>
																			@foreach($included_items as $incitem)
																			<li style="list-style-type: number; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: #000;font-weight: 300; margin-left: -31px;
																				margin-top: -10px;
																			">{{$incitem}}</li>
																			@endforeach
																			<!-- <li style=" list-style-type: number; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: #000;font-weight: 300;margin-left: -28px;">Activity Equipment </li> -->
																		</ul>

																		<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: black; font-weight: 600;margin-bottom: 0px;">What's not Included with this experience? </h2>

																		<ul>
																			@foreach($notincluded_items as $notincitem)
																			<li style="list-style-type: number; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: #000;font-weight: 300; margin-left: -31px;
																				margin-top: -10px;
																			">{{$notincitem}}</li>
																			@endforeach
																			<!-- <li style=" list-style-type: number; font-family: 'Poppins', sans-serif; font-size: 13px; line-height: 22px; color: #000;font-weight: 300;margin-left: -28px;">Activity Equipment </li> -->
																		</ul>
	                                                                </td>
	                                                            </tr>
	                                                        </table>
	                                                    </div>
	                                                </td>
	                                            </tr>
	                                       	@endif
											<tr>
												<td><h2 style="padding: 0px 0; text-align: center; font-size:14px; font-weight: normal; margin-bottom: 15px;">To date, You have booked 1 activities and posted a total of 1 reviews on Fitnessity! <a style="color: red; text-decoration: underline;"  href="{{$url}}/activities">Book More</a></h2></td>
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