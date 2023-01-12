<!DOCTYPE html>
<html>
<?php

	use App\BusinessPriceDetails;
	use App\UserBookingStatus;
	use App\UserBookingDetail;
	use App\BusinessActivityScheduler;
	use App\BusinessServices;
	use App\CompanyInformation;
	use App\UserFamilyDetail;
    use App\Repositories\BookingRepository;

    $bookings  = new BookingRepository ;
    $odt = $bookings->getorderdetailsfromodid($email_detail['oid'],$email_detail['odetailid']);
    $url = env('APP_URL');
?>
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
                                        	<!-- Email Header : BEGIN -->
								            <tr>
								              	<td style="text-align: center; padding: 7px 0px 0px 0px;">
													<img src="{{$url}}/public/images/logo1.png" width="225"  alt="logo" border="0" style="height: auto;">
								                </td>
								            </tr>
									    <!-- Email Header : END -->
                                            <!-- Background Image with Text : BEGIN -->
                                            <tr>
                                                <td style="padding:0px 0px 0px">
                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td style="text-align: center; background-color: #ea1515; color: #fff;">
                                                                <div>
                                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                        <tr>
                                                                            <td style="padding: 10px; font-size: 21px;">Booking Receipt
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

                                            <!-- Thumbnail Right, Text Left : BEGIN -->
                                            <tr>
                                                <td dir="rtl" height="100%" valign="top" width="100%" style="font-size:0; padding: 10px 10px; text-align: center; " align="center" valign="center">
                                                   
                                                    <div style="display:inline-block; margin: 0 -1px; vertical-align:top; width:100%;">
                                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                            <tr>
                                                                <td dir="ltr" style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 20px 10px; text-align: left; height: 243px;">
																	<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">Booking# </h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$odt['confirm_id']}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">Total Price</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">${{$odt['totprice_for_this']}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">price option:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right"> {{$odt['price_opt']}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">total remainnig:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{ $odt['to_rem']}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">program name:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$odt['program_name']}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">expiration date:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$odt['end_activity_date']}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">date booked:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$odt['created_at']}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">reserved date:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$odt['bookedtime']}}
																				</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">booked by:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$odt['nameofbookedby']}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">check in date: </h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$odt['bookedtime']}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">check in time: </h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$odt['shift_start']}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">activity type: </h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$odt['sport_activity']}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">service type:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$odt['select_service_type']}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">activity location:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$odt['activity_location']}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">activity duration:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$odt['time']}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">great for:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$odt['activity_for']}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">PARTICIPANTS# </h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$odt['qty']}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">WHO IS PRATICIPATING?</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$odt['parti_data']}}</h2>
																			</td>
																		</tr>
																		
																		
																	</table>
																
                                                                </td>
                                                            </tr>
															
                                                        </table>
                                                    </div>
                                                  
                                                </td>
                                            </tr>
                                          
                                            <!-- Thumbnail Right, Text Left : END -->

											<tr>
                                                <td dir="rtl" height="100%" valign="top" width="100%" style="font-size:0; padding: 10px 10px; text-align: center; " align="center" valign="center">
                                                   
                                                    <div style="display:inline-block; margin: 0 -1px; vertical-align:top; width:100%;">
                                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                            <tr>
                                                                <td dir="ltr" style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 20px 10px; text-align: left;">
																	<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
																		<tr>
																			<td style="border-bottom: 1px solid #000;">
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 6px; margin-top: 6px;">Payment Type</h2>
																			</td>
																			<td style="border-bottom: 1px solid #000;">
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 6px; margin-top: 6px;; text-align: right">CC ending in ********{{$odt['last4']}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td style="border-bottom: 1px solid #000;">
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 6px; margin-top: 6px;">Sub-total</h2>
																			</td>
																			<td style="border-bottom: 1px solid #000;">
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 6px; margin-top: 6px; text-align: right">${{$odt['totprice_for_this']}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td style="border-bottom: 1px solid #000;">
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 6px; margin-top: 6px;">Taxes & Service Fees</h2>
																			</td>
																			<td style="border-bottom: 1px solid #000;">
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 6px; margin-top: 6px; text-align: right"> ${{$odt['tax_for_this']}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td style="border-bottom: 1px solid #000;">
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 6px; margin-top: 6px;">Grand Total</h2>
																			</td>
																			<td style="border-bottom: 1px solid #000;">
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 6px; margin-top: 6px; text-align: right">${{$odt['main_total']}}</h2>
																			</td>
																		</tr>
																	</table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
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