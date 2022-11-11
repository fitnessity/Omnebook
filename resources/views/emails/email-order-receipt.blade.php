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

	$booking_status = UserBookingStatus::where('id',$email_detail['oid'])->first();
	$booking_details = UserBookingDetail::where('id',$email_detail['odetailid'])->first();
	$business_services = BusinessServices::where('id',@$booking_details->sport)->first();
	$businessuser= CompanyInformation::where('id', @$business_services->cid)->first();
	$BusinessPriceDetails = BusinessPriceDetails::where(['id'=>@$booking_details->priceid,'serviceid' =>@$booking_details->sport])->first();
	$schedulerdata = BusinessActivityScheduler::where(['serviceid' => @$booking_details->sport ,'id' =>@$booking_details->act_schedule_id ])->first();
	if(@$businessuser->logo != "") {
            if (file_exists( public_path() . '/uploads/profile_pic/thumb/' . @$businessuser->logo)) {
               $com_pic = url('/public/uploads/profile_pic/thumb/' . @$businessuser->logo);
            }else {
               $com_pic = url('/public/images/service-nofound.jpg');
            }

        }else{ $com_pic = '/public/images/service-nofound.jpg'; }

        $SpotsLeftdis = 0;
        $SpotsLeft = [];
        $SpotsLeft = UserBookingDetail::where('act_schedule_id' ,@$booking_details->act_schedule_id)->whereDate('bookedtime', '=', @$booking_details->bookedtime)->get()->toArray();
        
        $totalquantity = 0;
        foreach($SpotsLeft as $data1){
           
            $item = json_decode($data1['qty'],true);
            if($item['adult'] != '')
                $totalquantity += $item['adult'];
            if($item['child'] != '')
                $totalquantity += $item['child'];
            if($item['infant'] != '')
                $totalquantity += $item['infant'];
        }
        if( @$schedulerdata['spots_available'] != ''){
            $SpotsLeftdis =  @$schedulerdata['spots_available'] - $totalquantity;
        }

        $time='';
        if(@$schedulerdata->set_duration != ''){
            $tm = explode(' ',$schedulerdata->set_duration);
            $hr=''; $min=''; $sec='';
            if($tm[0]!=0){ $hr=$tm[0].' hour '; }
            if($tm[2]!=0){ $min=$tm[2].' minutes '; }
            if($tm[4]!=0){ $sec=$tm[4].' seconds'; }
            if($hr!='' || $min!='' || $sec!='')
            { $time =  $hr.$min.$sec; } 
        }


        $booking_details_for_sub_total = UserBookingDetail::where('booking_id',$email_detail['oid'])->get();
        $sub_totprice = 0;
        foreach( $booking_details_for_sub_total as $bds){
            $aprice = json_decode($bds->price,true); 
            $sub_price_adu = $sub_price_chi = $sub_price_inf = 0;
            if( !empty($aprice['adult']) ){ 
                $sub_price_adu = $aprice['adult']; 
            }
            if( !empty($aprice['child']) ){
                $sub_price_chi = $aprice['child']; 
            }
            if( !empty($aprice['infant']) ){
                $sub_price_inf = $aprice['infant']; 
            }

            $a = json_decode($bds->qty,true);
            if( !empty($a['adult']) ){  
                $sub_totprice += $sub_price_adu * $a['adult'];
            }
            if( !empty($a['child']) ){
                $sub_totprice += $sub_price_chi * $a['child'];
            }
            if( !empty($a['infant']) ){ 
                $sub_totprice += $sub_price_inf * $a['infant'];
            }
        }

        $tot_amount_cart = 0;
        if(@$booking_status->amount != ''){
            $tot_amount_cart = @$booking_status->amount;
        }
        
        $taxval = 0;
        $taxval = $tot_amount_cart - $sub_totprice; 
        
        $tax_for_this = $taxval / count(@$booking_details_for_sub_total);

        $aprice = json_decode(@$booking_details->price,true); 
        $aprice_adu = $aprice_chi = $aprice_inf = 0;
        if( !empty($aprice['adult']) ){ 
            $aprice_adu = $aprice['adult']; 
        }
        if( !empty($aprice['child']) ){
            $aprice_chi = $aprice['child']; 
        }
        if( !empty($aprice['infant']) ){
            $aprice_inf = $aprice['infant']; 
        }

        $qty = '';
        $totprice_for_this = 0;
        $a = json_decode(@$booking_details->qty,true);
        if( !empty($a['adult']) ){ 
            $qty .= 'Adult: '.$a['adult']; 
            $totprice_for_this += $aprice_adu * $a['adult'];
        }
        if( !empty($a['child']) ){
            $qty .= '<br> Child: '.$a['child']; 
            $totprice_for_this += $aprice_chi * $a['child'];
        }
        if( !empty($a['infant']) ){
            $qty .= '<br>Infant: '.$a['infant']; 
            $totprice_for_this += $aprice_inf * $a['infant'];
        }

        $main_total =  $tax_for_this + $totprice_for_this;

        if(@$booking_status->order_id != ''){
            $order_id = @$booking_status->order_id;
        }else{ 
           $order_id =  "—"; 
        }

        if(@$schedulerdata->spots_available != ''){
            $to_rem = $SpotsLeftdis.' / '.@$schedulerdata->spots_available;
        }else{ 
            $to_rem = "—"; 
        }

        if(@$business_services->program_name != ''){
            $program_name = @$business_services->program_name;
        }else{
            $program_name = "—"; 
        }

        if(@$schedulerdata->end_activity_date != ''){
            $end_activity_date = date('d-m-Y', strtotime(@$schedulerdata->end_activity_date));
        }else{ 
            $end_activity_date = "—"; 
        }

        if(@$booking_details->created_at != ''){
            $created_at = date('d-m-Y', strtotime(@$booking_details->created_at));
        }else{ 
            $created_at = "—"; 
        }

        if(@$booking_details->bookedtime != ''){
            $bookedtime = date('d-m-Y', strtotime(@$booking_details->bookedtime));
        }else{ 
            $bookedtime = "—"; 
        }

        if(Auth::user()->firstname != '' && Auth::user()->lastname != ''){
            $nameofbookedby = Auth::user()->firstname.' '.Auth::user()->lastname;
        }else{ 
            $nameofbookedby = "—"; 
        }

        if(@$business_services->sport_activity != ''){
            $sport_activity = $business_services->sport_activity;
        }else{ 
            $sport_activity=  "—"; 
        } 

        if(@$business_services->select_service_type != ''){
            $select_service_type = $business_services->select_service_type;
        }else{ 
            $select_service_type=  "—"; 
        }
        if(@$business_services->activity_for != ''){
            $activity_for = $business_services->activity_for;
        }else{ 
            $activity_for=  "—"; 
        }
        if(@$business_services->activity_location != ''){
            $activity_location = $business_services->activity_location;
        }else{ 
            $activity_location=  "—"; 
        }

        if(@$business_services->activity_location != ''){
            $price_opt = @$BusinessPriceDetails->price_title.' - '.@$BusinessPriceDetails->pay_session.' Sessions';
        }else{ 
            $price_opt=  "—"; 
        }

        if(@$schedulerdata->shift_start != ''){
            $shift_start = date('h:i a', strtotime( @$schedulerdata->shift_start ));
        }else{
            $shift_start=  "—"; 
        }
		$participateqty = str_replace(str_split('{""}'), ' ',@$booking_details->qty);

		$stripe = new \Stripe\StripeClient(
            config('constants.STRIPE_KEY')
        );

        if(@$booking_status->stripe_id != ''){
            $payment_intent = $stripe->paymentIntents->retrieve(
                $booking_status->stripe_id,
                []
            );
        }

        $last4 = $payment_intent['charges']['data'][0]['payment_method_details']['card']['last4'];
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
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$order_id}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">Total Price</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">${{$totprice_for_this}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">price option:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right"> {{$price_opt}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">total remainnig:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{ $to_rem}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">program name:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$program_name}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">expiration date:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$end_activity_date}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">date booked:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$created_at}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">reserved date:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$bookedtime}}
																				</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">booked by:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$nameofbookedby}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">check in date: </h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$bookedtime}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">check in time: </h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$shift_start}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">activity type: </h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$sport_activity}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">service type:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$select_service_type}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">activity location:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$activity_location}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">activity duration:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$time}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">great for:</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{$activity_for}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">PARTICIPANTS# </h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">{{@$participateqty}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;"></h2>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px;text-transform: uppercase;">WHO IS PRATICIPATING?</h2>
																			</td>
																			<td>
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 4px; text-align: right">
															<?php  $apname = json_decode(@$booking_details->participate,true);
															    if(!empty(@$apname)){
															        foreach(@$apname as $data){
															            if($data['from'] == 'family'){
															                $family = UserFamilyDetail::where('id',$data['id'])->first();
															                echo @$family->first_name.' '.@$family->last_name."<br>";
															            }else{ 
															            	echo Auth::user()->firstname .' ' .@Auth::user()->lastname;
															            	echo "<br>"; 
															            } 
															        } 
															    } 
															?>
														    	
														    </h2>
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
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 6px; margin-top: 6px;; text-align: right">CC ending in ********{{$last4}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td style="border-bottom: 1px solid #000;">
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 6px; margin-top: 6px;">Sub-total</h2>
																			</td>
																			<td style="border-bottom: 1px solid #000;">
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 6px; margin-top: 6px; text-align: right">${{$totprice_for_this}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td style="border-bottom: 1px solid #000;">
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 6px; margin-top: 6px;">Taxes & Service Fees</h2>
																			</td>
																			<td style="border-bottom: 1px solid #000;">
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 6px; margin-top: 6px; text-align: right"> ${{$tax_for_this}}</h2>
																			</td>
																		</tr>
																		<tr>
																			<td style="border-bottom: 1px solid #000;">
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 6px; margin-top: 6px;">Grand Total</h2>
																			</td>
																			<td style="border-bottom: 1px solid #000;">
																				<h2 style="margin: 0 0 10px 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 22px; color: black; font-weight: 300;margin-bottom: 6px; margin-top: 6px; text-align: right">${{$main_total}}</h2>
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