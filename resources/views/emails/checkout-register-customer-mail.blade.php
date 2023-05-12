<!DOCTYPE html>


<?php
	use App\CompanyInformation;
	use App\UserBookingDetail;
	use App\UserBookingStatus;
	use App\Repositories\BookingRepository;
	$oidarry = explode(',',$email_detail['orderdetalidary']);
	$company = CompanyInformation::where('id',$email_detail['cid'])->first();
	$url = env('APP_URL');
	$url1 = $url.'/public/images/bg-1.png';

	$odstatus = UserBookingStatus::where('id',$email_detail['booking_id'])->first();
	
	$user_type = $odstatus->user_type;
	if($user_type == "user"){
		$cus_name = $odstatus->user->firstname.' '.$odstatus->user->lastname;
	}else{
		$cus_name = $odstatus->customer->fname.' '.$odstatus->customer->lname;
	}
	$houserules = '';
	//echo  $company;
	if($company->businessterms != ''){
		$houserules = $company->businessterms->houserules;
	}
?>


<html>
    <body width="100%" style="margin: 0; padding: 0 !important; background-color:#ede9e6; margin:0 auto!important; padding:0!important; height:100%!important; width:100%!important; font-family:Poppins,Arial,sans-serif">

        <center role="article" aria-roledescription="email" lang="en" style="width: 100%;">
            <div style="background-color:#ede9e6;">
                     <table height="100%" width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td valign="top" align="left"  style="padding:35px 10px">
                            <div style="max-width: 680px; margin: 0 auto;">

                                 <table height="100%" width="100%" cellpadding="0" cellspacing="0" border="0">
                                   
                                    <tr>
                                        <td  style="padding:0px 0px 0px;  background: #fff;">
                                            <!-- Email Body : BEGIN -->
                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">

                                               
                                                <!-- Background Image with Text : BEGIN -->
                                                <tr>
                                                    <td style="padding:0px 0px 0px">
                                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                            <tr>
                                                                <td style="text-align: center; background-color: #e4e4e4;">
                                                                    <div>
                                                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                            <tr>
                                                                                <td style="text-align: left; padding: 0px 15px;">
																					<h3 style="font-size: 13px; font-weight: normal;">BOOKING CONFIRMATION</h3>
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
													<td style="text-align: center; background-image: url({{$url1}}); background-repeat: no-repeat; background-position: center; padding: 15px 15px 25px;">
                                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                            <tr>
                                                                <td>
                                                                    <div>
                                                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
																			<tr>
																				<td style="text-align: center; padding: 25px 0px 15px 0px;">
																					<img src="{{$url}}/public/images/logo1.png" width="225"  alt="logo" border="0" style="height: auto;">
                                                                                </td>
																			</tr>
																			<tr><td style="font-size: 28px; font-weight: 600; text-align: center;">BOOKING CONFIRMATION</td></tr>
																			<tr><td><a href="#" style="background: #ef1313;border: none;font-family: 'Poppins' ,sans-serif;font-size: 16px;line-height: 30px;  text-decoration: none;padding: 10px 0px;color: #ffffff;display: block;border-radius: 0;font-weight: 500;margin: auto;width:35%;height: 30px; margin-bottom: 30px; margin-top: 30px; border-radius: 10px; text-align: center;">VIEW BOOKING</a></td></tr>
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
                                                                                <td style="text-align: center; padding: 0px 28px 30px;" align="center">
																					<p style="font-weight: 500; font-size: 20px; color: #000000;">Greetings {{$cus_name}} </p>
																					<p style="font-weight: 400; font-size: 15px; color: #000000; margin-bottom: 0px; margin-top: 0px;">This is to notify you that your scheduled booking with {{$company->dba_business_name}} has been confirmed.  View the company's information and booking details below.   </p>
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
                                                        <h6 style="font-size: 25px; font-weight: 500; color: #f91942;margin-bottom: 1px;">BOOKING DETAILS<h6>
                                                    </td>
                                                </tr>
                                                <!-- Font Image : END -->


                                                <!-- Thumbnail Right, Text Left : BEGIN -->
                                                <tr>
                                                    <td dir="rtl" height="100%" valign="top" width="100%" style="font-size:0; padding: 10px 10px; text-align: center; " align="center" valign="center">
                                                       
															<table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: 0 -1px; width: 10%; float: left;">
                                                                <tr>
                                                                    <td dir="ltr" style=" padding: 20px 10px 0px;; text-align: left;">
																	<h2 style="margin: 55px 0 5px 0; font-weight: 400;"><img src="{{$url}}/images/2.png" width="30"  alt="logo" border="0" style="height: auto; margin-right:
																	15px;"></h2>
                                                                    </td>
                                                                </tr>
															</table>
                                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: 0 -1px; width: 90%; float: right; ">
                                                            	<?php $i=1;
                                                            		$totaltax = 0;
														          	$subtotaltax = 0;
														          	$tot_dis = 0;
														          	$tot_tip = 0;
														          	$service_fee = 0;
														          	$totprice_for_this  = 0;
                                                            		$booking_repo = new BookingRepository;
                                                            	?>
																@foreach($oidarry as $or)
																<?php $order_detail = UserBookingDetail::where('id',$or)->first();
																	  	$odt = $booking_repo->getorderdetailsfromodid($order_detail->booking_id,$or);
																	  	$totaltax += $odt['tax_for_this'];
																	  	$tot_dis += $odt['discount'];
               															$tot_tip += $odt['tip']; 
               															$service_fee += $odt['service_fee'];
               															$totprice_for_this += $odt['totprice_for_this'] ;
               													?>
                                                                <tr>
                                                                    <td dir="ltr" style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 10px 10px; text-align: left; height: 243px;">
                                                                    	@if($i==1)
																			<h2 style="margin: 0 0 5px 0; font-family: 'Poppins',sans-serif; font-size: 17px; line-height: 50px; color: black; font-weight: 600;margin-bottom: 0px;"> Your Booking Information  </h2>
																		@endif
																		@if($i!=1)
																		<h2 style="padding: 0px 0; text-align: center; border-bottom:2px solid #f91942;margin-bottom: 20px;"></h2>
																		@endif
																		<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
																			<tr>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Booking # </h2>
																				</td>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{$odt['confirm_id']}} </h2>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Program Name: </h2>
																				</td>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{$odt['program_name']}}</h2>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Date Scheduled:</h2>
																				</td>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">—</h2>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Time & Duration:</h2>
																				</td>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right"> 9:00 am to 10:00 am  |  1 hr</h2>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Catagory:</h2>
																				</td>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{ $odt['categoty_name']}}</h2>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Price Option:</h2>
																				</td>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{$odt['BusinessPriceDetails']['price_title']}}</h2>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Date Booked:</h2>
																				</td>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{$odt['created_at']}}</h2>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Number of Sessions:</h2>
																				</td>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{$odt['BusinessPriceDetails']['pay_session']}}</h2>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Membership Option: </h2>
																				</td>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{$odt['BusinessPriceDetails']['membership_type']}}</h2>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Participant Quantity: </h2>
																				</td>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{$odt['qty']}}</h2>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Who's Participating: </h2>
																				</td>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{$odt['parti_data']}}</h2>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Activity Type: </h2>
																				</td>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{$odt['sport_activity']}}</h2>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Service Type:</h2>
																				</td>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{$odt['select_service_type']}}</h2>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Membership Duration:</h2>
																				</td>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{$order_detail->expired_duration}}</h2>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Purchase Date: </h2>
																				</td>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{$odt['created_at']}}</h2>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Membership Activation Date: </h2>
																				</td>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{date('d-m-Y',strtotime($order_detail->contract_date))}}</h2>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Membership Expiration: </h2>
																				</td>
																				<td>
																					<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">{{date('d-m-Y',strtotime($order_detail->expired_at))}}</h2>
																				</td>
																			</tr>
																			
																		</table>
                                                                    </td>
                                                                </tr>
																<?php  $i++; ?>
																@endforeach
														</table>
														<table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: 0 -1px; width: 100%; float: left;">
															<tr>
                                                                <td dir="ltr" style="">
																	<table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: 0 -1px; width: 10%; float: left;">
																	<tr>
																		<td dir="ltr" style=" padding: 20px 10px 0px;; text-align: left;">
																			<h2 style="margin: 55px 0 5px 0; font-weight: 400;"><img src="{{$url}}/images/1.png" width="30"  alt="logo" border="0" style="height: auto; margin-right:	15px;"></h2>
																		</td>
																	</tr>
																	</table>
																	<?php $total_paid = 0;
																		$total_paid = $totprice_for_this + $totaltax + $tot_tip + $service_fee - $tot_dis; ?>
																	<table role="presentation" cellspacing="0" cellpadding="0" border="0"  style="margin: 0 -1px; width: 90%; float: right; box-shadow: 0px 5px 11px 0px rgba(0, 0, 0, .35); padding: 10px 10px; text-align: left;
																	border-radius: 4px; margin-bottom: 35px; margin-top: 25px;">
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 500;margin-bottom: 0px;">Payment Method: </h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 500;margin-bottom: 0px; text-align: right">{{$odt['pmt_type']}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Tip Amount: </h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">${{ $tot_tip}}</h2>
																			</td>
																		</tr>
																		
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Discount:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">${{ $tot_dis}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px;">Taxes & Fees:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 0px; text-align: right">${{ ($totaltax +  $service_fee )}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 500;margin-bottom: 0px;">Total Amount Paid </h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 14px; line-height: 22px; color: black; font-weight: 500;margin-bottom: 0px; text-align: right">${{round($total_paid)}}</h2>
																			</td>
																		</tr>
																		
																	</table>
																
                                                                </td>
                                                            </tr>
                                                         </table>	
                                                    </td>
                                                </tr>
                                                <!-- Thumbnail Right, Text Left : END -->
												
												
												<!-- Thumbnail Right, Text Left : BEGIN -->
                                                <tr>
                                                    <td dir="rtl" height="100%" width="100%" style="font-size:0; padding: 0px 10px; text-align: center; " align="center" valign="center">
													<h2 style="padding: 0px 0; text-align: center; border-bottom:2px solid #f91942;margin-bottom: 0px;"></h2>
                                                       
                                                    </td>
                                                </tr>
                                                <!-- Thumbnail Right, Text Left : END -->
												
												<tr>
													<td>
														<h2 style="padding: 0px 0; text-align: center; font-size:19px; font-weight: 500; margin-bottom: 15px;">Your Providers Business Information </h2>
													</td>
													
												</tr>
												<tr>
													<td>
														<p style="padding: 0px 60px; font-size: 15px; font-weight: normal; margin-bottom: 0px; margin-top: 0px;">Company Name: {{$company->dba_business_name}} </p>
													</td>
												</tr>
												<tr>
													<td>
														<p style="padding: 0px 60px; font-size: 15px; font-weight: normal; margin-bottom: 0px; margin-top: 0px;">Company Rep: {{$company->full_name}}</p>
													</td>
												</tr>
												<tr>
													<td>
														<p style="padding: 0px 60px; font-size: 15px; font-weight: normal; margin-bottom: 0px; margin-top: 0px;">Website: {{$company->business_website}} </p>
													</td>
												</tr>
												<tr>
													<td>
														<p style="padding: 0px 60px; font-size: 15px; font-weight: normal; margin-bottom: 0px; margin-top: 0px;">Location of Activity: </p>
													</td>
												</tr>
												
												<tr>
													<td style="width: 100%; text-align: center; margin-top: 25px; display: block;">
														<iframe 
														  width="400" 
														  height="270" 
														  frameborder="0" 
														  scrolling="no" 
														  marginheight="0" 
														  marginwidth="0" 
														  src="https://maps.google.com/maps?q= 40.777667,-73.981799&hl=es&z=14&amp;output=embed"
														 >
														 </iframe>
													</td>
												</tr>

												<tr>
													<td style="width: 100%; padding: 15px 138px;">
														<div style="display: inline-block; width: 100%; margin-bottom: 20px; background: #fff; border: 1px solid #ede9e9; border-radius: 6px;">
															<h4 style="padding: 13px 10px; margin-bottom: 0px; margin-top: 0px; font-size: 16px; font-weight: 500; border-bottom: 1px solid #ede9e9;">Business Info	</h4>	
															<div>
																<h2 style="padding: 0px 10px; margin-bottom: 0px;">
																	<img src="{{$url}}/images/email-map.png" alt="logo" style="height: auto; margin-right: 10px; width: 5%;" width="15" border="0">
																	<p style="display: inline-block; font-size: 15px; font-weight: normal; margin-top: 0px; margin-bottom: 0px; width: 91%;">{{$company->company_address()}}</p>
																</h2>
															</div>
															<div>
																<h2 style="padding: 0px 10px; margin-top: 0px; margin-bottom: 0px;">
																	<img src="{{$url}}/images/email-call.png" alt="logo" style="height: auto; margin-right: 10px;" width="15" border="0"><p style="display: inline-block; font-size: 15px; font-weight: normal; margin-top: 0px; margin-bottom: 0px;">{{$company->business_phone}}</p>
																</h2>
															</div>
															<div>
																<h2 style="padding: 0px 10px; margin-top: 0px; ">
																	<img src="{{$url}}/images/email-email.png" alt="logo" style="height: auto; margin-right: 10px;" width="15" border="0"><p style="display: inline-block; font-size: 15px; font-weight: normal; margin-top: 0px; margin-bottom: 0px">{{$company->business_email}}</p>
																</h2>
															</div>
														</div>
													</td>
												</tr>
												
												<tr>
													<td>
														<h2 style="padding: 0px 0; text-align: center; border-bottom:2px solid #f91942;margin-bottom: 0px;"></h2>
													</td>
												</tr>
												<div style="display:inline-block; margin: 0 -1px; vertical-align:top;">
														
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="border-spacing:0!important; border-collapse:collapse!important;  table-layout:fixed!important;   margin:0 auto!important">
                                                         <tr>
                                                              <td dir="ltr" style=" padding: 20px 10px 0px;; text-align: left;">
																	<h2 style="padding: 0px 0; text-align: center; font-size:19px; font-weight: 500; margin-bottom: 15px;">Things To Know </h2>
                                                               </td>
                                                        </tr>
														<tr>
															<td>
																<p style="padding: 0px 60px; font-size: 15px; font-weight: 500; margin-bottom: 15px; margin-top: 0px;">Know Before You Go: </p>
															</td>
                                                        </tr>
														<tr>
															<td>
																<p style="padding: 0px 60px; font-size: 14px; font-weight: normal; margin-bottom: 15px; margin-top: 0px;">{{$houserules}}</p>
																<p style="padding: 0px 60px; font-size: 14px; font-weight: normal; margin-bottom: 95px; margin-top: 0px;">Contact your provider for any further questions.</p>
																<p style="padding: 0px 20px; font-size: 14px; font-weight: 200; margin-bottom: 35px; margin-top: 0px;">To date, You have participated in 1 activites and posted a total of 0 reviews on Fitnessity!</p>
															</td>
                                                        </tr>
                                                     </table>
                                                </div>
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