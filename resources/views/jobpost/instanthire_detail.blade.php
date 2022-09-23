@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')
@section('content')

<?php
	use App\UserBookingDetail;
	use App\BusinessServices;
	use App\BusinessService;
	use App\BusinessPriceDetails;
	use App\BusinessPriceDetailsAges;
	use App\BusinessServiceReview;
	use App\BusinessTerms;
	use App\User;
	use App\BusinessActivityScheduler;
	use App\BusinessServicesFavorite;
	use App\CompanyInformation;
	use App\BusinessReview;
	use Carbon\Carbon;

	$sid = $serviceid;
	$service = BusinessServices::where('id',$serviceid)->first();
 	$bookscheduler = BusinessActivityScheduler::where('serviceid', $serviceid)->limit(1)->orderBy('id', 'ASC')->get()->toArray();
 	$tduration = '';
 	if(@$bookscheduler[0]['set_duration']!=''){
		$tm=explode(' ',$bookscheduler[0]['set_duration']);
		$hr=''; $min=''; $sec='';

		if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
		if($tm[2]!=0){ $min=$tm[2].'min. '; }
		if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
		if($hr!='' || $min!='' || $sec!='')
		{ 
			$tduration = $hr.$min.$sec;
		} 
	} 
	$today = date('Y-m-d');
	$SpotsLeft = UserBookingDetail::where('sport', @$serviceid )->whereDate('created_at', '=', $today)->sum('qty');
	if( !empty($service['group_size']) ){
		$SpotsLeftdis = $service['group_size']-$SpotsLeft;
	}

	$businessSp = BusinessService::where('cid', $service['cid'])->first();
	if(!empty($businessSp)) {
        $languages = $businessSp['languages'];
    }     

    $cancelation = $cleaning = $houserules = $comp_address = $Phonenumber = '';
    $email = $companylat = $companylon  = $companylogo = '';
    $comp_data = CompanyInformation::where('id', $service['cid'])->first();
    // echo $Instructordata;
    
	$Instruname = $comp_data->first_name .' '. $comp_data->last_name;
	if($comp_data->address != ''){
		$comp_address = $comp_data->address.', ';
	}
	if($comp_data->city != ''){
		$comp_address .= $comp_data->city.', ';
	}
	if($comp_data->state != ''){
		$comp_address .= $comp_data->state.', ';
	}
	if($comp_data->country != ''){
		$comp_address .= $comp_data->country;
	}


	$companyname = $comp_data->company_name;
	$companyid = $comp_data->id;
	$Phonenumber = $comp_data->contact_number;
	$companylon = $comp_data->latitude;
	$companylat = $comp_data->longitude;
	$companylogo  = $comp_data->logo ;
	$email = $comp_data->email;

	$BusinessTerms = BusinessTerms::where('cid', $comp_data->id)->first();
	if(!empty($BusinessTerms)){
		$cancelation = $BusinessTerms->cancelation;
		$cleaning = $BusinessTerms->cleaning;
		$houserules = $BusinessTerms->houserules;
	}

	$current_act = BusinessServices::where('id', $serviceid)->limit(1)->get()->toArray();
	$companyactid = $current_act[0]['cid'];
	$redlink = str_replace(" ","-",$companyname)."/".$companyid;
	$address = '';
	if(!empty($companycity)) { 
		$address .= $companycity; 
	}
    if(!empty($companycountry)) 
    { 
    	$address .= ', '.$companycountry; 
	}
    if(!empty($companyzip)) {
     	$address .=', '.$companyzip; 
 	} 


	$servicePr=[]; $bus_schedule=[];
	$servicePrfirst = BusinessPriceDetails::where('serviceid',  @$serviceid )->orderBy('id', 'ASC')->first();
	$sercate = BusinessPriceDetailsAges::where('serviceid',  @$serviceid )->orderBy('id', 'ASC')->get()->toArray();
	$sercatefirst = BusinessPriceDetailsAges::where('serviceid',  @$serviceid )->orderBy('id', 'ASC')->get()->first();
	//DB::enableQueryLog();
	if(!empty(@$sercatefirst)){
    	$servicePr = BusinessPriceDetails::where('serviceid',  @$serviceid )->orderBy('id', 'ASC')->where('category_id',@$sercatefirst['id'])->get()->toArray();
	}

	//dd(\DB::getQueryLog());
    $todayday = date("l");
    $todaydate = date('m/d/Y');
	if(!empty(@$sercatefirst)){
    	$bus_schedule = BusinessActivityScheduler::where('category_id',@$sercatefirst['id'])->whereRaw('FIND_IN_SET("'.$todayday.'",activity_days)')->where('starting','<=',$todaydate )->get();
	}

    /*  print_r($bus_schedule);*/
    $start =$end= $time= '';$timedata = '';$Totalspot= $spot_avil= 0;  $SpotsLeft =0 ;
    if(!empty(@$bus_schedule)){
        foreach($bus_schedule as $data){
            if($data['scheduled_day_or_week'] == 'Days'){
                $daynum = '+'.$data['scheduled_day_or_week_num'].' days';
                $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
            }else if($data['scheduled_day_or_week'] == 'Months'){
                $daynum = '+'.$data['scheduled_day_or_week_num'].' month';
                $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
            }else if($data['scheduled_day_or_week'] == 'Years'){
                $daynum = '+'.$data['scheduled_day_or_week_num'].' years';
                $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
            }else{
                $daynum = '+'.$data['scheduled_day_or_week_num'].' week';
                $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
            }  

            if($todaydate <=$expdate){
                if(@$data['shift_start']!=''){
                    $start = date('h:i a', strtotime( $data['shift_start'] ));
                    $timedata .= $start;
                }
                if(@$data['shift_end']!=''){
                    $end = date('h:i a', strtotime( $data['shift_end'] ));
                    $timedata .= ' - '.$end;
                } 

                if(@$data['set_duration']!=''){
                    $tm=explode(' ',$data['set_duration']);
                    $hr=''; $min=''; $sec='';
                    if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
                    if($tm[2]!=0){ $min=$tm[2].'min. '; }
                    if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
                    if($hr!='' || $min!='' || $sec!='')
                    { 
                    	$time = $hr.$min.$sec; 
                        $timedata .= ' / '.$time;
                    } 
                }

            }

            $today = date('Y-m-d');
            $SpotsLeft = UserBookingDetail::where('sport',  @$serviceid )->whereDate('created_at', '=', $today)->sum('qty');
            $SpotsLeftdis=0;
            if( !empty($data['spots_available']) ){
                $spot_avil=$data['spots_available'];
                $SpotsLeftdis = $data['spots_available']-$SpotsLeft;
                $Totalspot = $SpotsLeftdis.'/'.@$data['spots_available'];
            }
        }
    }
	$selectval = $priceid = $total_price_val = '' ;
	$adultcnt = $childcnt = $infantcnt = 0;
	if(date('l') == 'Saturday' || date('l') == 'Sunday'){
        $total_price_val =  @$servicePrfirst['adult_weekend_price_diff'];
        $i=1;
        if (!empty(@$servicePr)) {
            foreach ($servicePr as  $pr) {
                if($i==1){
                	$rec = '';
                 	if(@$servicePrfirst['is_recurring_adult'] == 1) {
                 		$rec = "(Recurring)"; 
                 	}
                    $priceid =$pr['id'];
                    $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_weekend_price_diff'].'~~'.$pr['id'].'!^'.$pr['price_title'].'^^'.$pr['membership_type'].$rec.'">Select Price Option</option>'; }
                if($pr['adult_weekend_price_diff'] != ''){
                	$rec = '';
                	if(@$servicePrfirst['is_recurring_adult'] == 1) {
                 		$rec = "(Recurring)"; 
                 	}
                	$adultcnt = 1;
                    $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_weekend_price_diff'].'~~'.$pr['id'].'!^'.$pr['price_title'].'^^'.$pr['membership_type'].$rec.'">Adult - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['adult_weekend_price_diff'].'</option>';}
                if($pr['child_cus_weekly_price'] != ''){
                	$rec = '';
                	if(@$servicePrfirst['is_recurring_child'] == 1) {
                 		$rec = "(Recurring)"; 
                 	}
                	$childcnt = 1;
                    $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['child_weekend_price_diff'].'~~'.$pr['id'].'!^'.$pr['price_title'].'^^'.$pr['membership_type'].$rec.'">Child - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['child_weekend_price_diff'].'</option>';
                }
                if($pr['infant_cus_weekly_price'] != ''){
                	$rec = '';
                	if(@$servicePrfirst['is_recurring_infant'] == 1) {
                 		$rec = "(Recurring)"; 
                 	}
                	$infantcnt = 1;
                    $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['infant_weekend_price_diff'].'~~'.$pr['id'].'!^'.$pr['price_title'].'^^'.$pr['membership_type'].$rec.'">Infant - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['infant_weekend_price_diff'].'</option>';
                }$i++;
            }
        }
    }else{
		/*print_r($servicePr); exit;*/
		if(!empty(@$servicePr))
		{
			$total_price_val =  @$servicePrfirst['adult_cus_weekly_price'];
			$i=1;
            foreach ($servicePr as  $pr) {
				if($i==1){ 
					$rec = '';
                 	if(@$servicePrfirst['is_recurring_adult'] == 1) {
                 		$rec = "(Recurring)"; 
                 	}
					$priceid =$pr['id'];
					$selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_cus_weekly_price'].'~~'.$pr['id'].'!^'.$pr['price_title'].'^^'.$pr['membership_type'].$rec.'">Select Price Option</option>'; }
				if($pr['adult_cus_weekly_price'] != ''){
					$rec = '';
                 	if(@$servicePrfirst['is_recurring_adult'] == 1) {
                 		$rec = "(Recurring)"; 
                 	}
					$adultcnt = 1;
					$selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_cus_weekly_price'].'~~'.$pr['id'].'!^'.$pr['price_title'].'^^'.$pr['membership_type'].$rec.'">Adult - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['adult_cus_weekly_price'].'</option>';}
				if($pr['child_cus_weekly_price'] != ''){
					$rec = '';
                	if(@$servicePrfirst['is_recurring_child'] == 1) {
                 		$rec = "(Recurring)"; 
                 	}
					$childcnt = 1;
					$selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['child_cus_weekly_price'].'~~'.$pr['id'].'!^'.$pr['price_title'].'^^'.$pr['membership_type'].$rec.'">Child - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['child_cus_weekly_price'].'</option>';
				}
				if($pr['infant_cus_weekly_price'] != ''){
					$rec = '';
                	if(@$servicePrfirst['is_recurring_infant'] == 1) {
                 		$rec = "(Recurring)"; 
                 	}
					$infantcnt = 1;
					$selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['infant_cus_weekly_price'].'~~'.$pr['id'].'!^'.$pr['price_title'].'^^'.$pr['membership_type'].$rec.'">Infant - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['infant_cus_weekly_price'].'</option>';
				}$i++;
			}
		}
    }

    $activities_search = BusinessServices::where('cid', $service['cid'])->where('is_active', '1')->where('id', '!=' , $serviceid)->limit(2)->orderBy('id', 'DESC')->get();
   /* print_r($activities_search);exit();*/

  /* echo $selectval ;exit();*/
?>

<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>compare/style.css">
<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>compare/w3.css">
<link href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css" type="text/css" rel="stylesheet" />
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/Compare.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/jquery-1.9.1.min.js"></script>
<script src="{{ url('public/js/jquery-ui.multidatespicker.js') }}"></script>
<script src="{{ url('public/js/jquery-ui.min.js') }}"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<div id="mykickboxing" class="mykickboxing-activities kickboxing-moredetails" style="padding-top: 78px">
<!-- The Modal Add Business-->
   	<div class="container-fluid">
	   	<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="modal-banner modal-banner-sp">
					<div class="bannar-size">
						<img src="{{ url('/public/uploads/gallery/720/thumb/BLUE+-+turtle.jpg')}}">
					</div>
					<div class="bannar-size">
						<img src="{{ url('/public/uploads/gallery/720/thumb/BLUE+-+turtle.jpg')}}">
					</div>
					<div class="bannar-size">
						<img src="{{ url('/public/uploads/gallery/720/thumb/BLUE+-+turtle.jpg')}}">
					</div>
					<div class="bannar-size">
						<img src="{{ url('/public/uploads/gallery/720/thumb/BLUE+-+turtle.jpg')}}">
						<button class="showall-btn showphotos"><i class="fas fa-bars"></i>Show all 8 photos</button>
					</div>
				</div>
			</div>
			<div class="col-lg-7 col-xs-12">
				<!--<img src="http://fitnessity.co/public/uploads/profile_pic/thumb/1653996182-aerobics.jpg" class="kickboximg-big">-->
				<h3 class="details-titles">{{@$service['program_name']}}</h3>
				<p class="caddress"> <b> Provider: </b> <a href="{{ Config::get('constants.SITE_URL') }}/businessprofile/{{$redlink}}"> {{ $companyname }} </a>{{$address }}
				</p>
				<h3 class="subtitle details-sp"> Description </h3>
				<p>{{ @$service['program_desc'] }}</p>
				<h3 class="subtitle details-sp"> Program Details: </h3>
				<div class="row">
					<div class="col-md-5 col-sm-5 col-xs-12">
						<div class="prdetails">
							<div>
								<label>Duration: </label>
								<span> {{$tduration}}</span>
							</div>
							<div>
								<label>Service Type: </label>
								<span> {{@$service['select_service_type']}}  </span>
							</div>
							<div>
								<label>Service For: </label>
								<span> {{@$service['activity_for']}}  </span>
							</div>
							<div>
								<label>Language:</label>
								<span> {{@$languages}}</span>
							</div>
							<div>
								<label>Instructor:</label>
								<span>{{@$Instruname}}  </span>
							</div>
						</div>
					</div>
					<div class="col-md-7 col-sm-7 col-xs-12">
						<div class="prdetails">
							<div>
								<label>Spots Left:</label>
								<span> {{$Totalspot}}</span>
							</div>
							<div>
								<label>Activity: </label>
								<span>{{@$service['sport_activity']}}</span>
							</div>
							<div>
								<label>  Age: </label>
								<span>  {{@$service['age_range'] }} </span>
							</div>
							<div>
								<label> Skill Level: </label>
								<span>{{@$service['difficult_level']}} </span>
							</div>
							<div>
								<label>  Activity Location: </label>
								<span>{{@$service['activity_location'] }}</span>
							</div>
						</div>
					</div>
				</div>
				<h3 class="subtitle details-sp"> Check Availability </h3>
				<div class="mainboxborder">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="activities-calendar">
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="activityselect3 special-date" onchange="updatedetail({{$serviceid}});">
											<input type="text" name="actfildate_forcart" id="actfildate_forcart" placeholder="Date" class="form-control" onchange="actFilter" autocomplete="off" >
											<i class="fa fa-calendar"></i>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-6">
										<select id="actfiloffer_forcart" name="actfiloffer_forcart" class="form-control activityselect1" onchange="updatedetail({{$serviceid}});">
											<option value="">Participant #</option>
											<?php for($i=1; $i<=@$spot_avil; $i++){
												echo '<option value="'.$i.'">'.$i.'</option>';
											}?>
										</select>
									</div>
								</div>
							</div>
						</div>
						@php $date = date('l').', '.date('F d,  Y'); @endphp 
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="choose-calendar-time">
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12">
										<h3 class="date-title">{{$date}}</h3>
										<label>Step: 1 </label> <span class=""> Select Membership Type</span>
										<select id="actfilmtype{{$serviceid}}" name="actfilmtype" class="form-control activityselect1 instant-detail-membertypre">
											<option>Drop In</option>
											<option>Semester</option>
										</select>
										
										<label>Step: 2 </label> <span class="">Select Category</span>
										<select id="selcatpr<?php echo $serviceid;?>" name="selcatpr{{$serviceid}}" class="price-select-control" onchange="changeactsession('{{$serviceid}}','{{$serviceid}}',this.value,'book')">
											<?php $c=1;  
												if (!empty($sercate)) { 
													foreach ($sercate as  $sc) {
														echo '<option value="'.$sc['id'].'">'.$sc['category_title'].'</option>';
														$c++;
													}
												}
											?>
										</select>
										
										<label>Step: 3 </label> <span class="">Select Price Option</span>
										<div class="priceoption" id="pricechng{{$serviceid}}{{$serviceid}}">
											<select id="selprice{{$serviceid}}" name="selprice{{$serviceid}}" class="price-select-control" onchange="changeactpr('{{$serviceid}}',this.value,'{{@$spot_avil}}','book','{{$serviceid}}')">
												<?php echo $selectval; ?>
											</select>
										</div>
										
										
										
										<!--<div class="calendar-time-details">
											<div class="start-time">
												<span>11:00 am</span>
												<p class="start-hr">1hr.</p>
												<label class="end-time-details">End Time</label>-->
												<!--<p class="end-hr">2hr. </p>
											</div>
											<div class="end-time">
												<span>12:23 am</span>
												<p class="start-hr">2hr. 20min.</p>
												<label class="end-time-details">End Time</label>
												<<p class="end-hr">3hr. </p>
											</div>
											<div class="end-time">
												<span>6:00 pm</span>
												<p class="start-hr">1hr.</p>
												<label class="end-time-details">End Time</label>-->
												<!--<p class="end-hr">3hr. </p>
											</div>
										</div>-->
										<!--<div class="calendar-time-details">
											<div class="end-time">
												<span>7:00 pm</span>
												<p class="start-hr">1hr. 21min.</p>
												<label class="end-time-details">End Time</label>-->
												<!--<p class="end-hr">2hr. 5min </p>
											</div>
											<div class="end-time">
												<span>10:00 pm</span>
												<p class="start-hr">1hr. 6min</p>
												<label class="end-time-details">End Time</label>-->
												<!--<p class="end-hr">3hr. </p>
											</div>
											<div class="end-time">
												<span>12:05 pm</span>
												<p class="start-hr">1hr.</p>
												<label class="end-time-details">End Time</label>-->
												<!--<p class="end-hr">4hr.</p>
											</div>
										</div>-->
										<!--<div>
											<div class="start-time">
												<span>12:00 am</span>
											</div>
											<div class="end-time">
												<span>3:00 pm</span>
											</div>
										</div>-->
									</div>
									<?php 
										$servicePr = BusinessPriceDetails::where('serviceid', $serviceid)->orderBy('id', 'ASC')->get()->toArray();
									?>
									<div class="col-md-6 col-sm-6 col-xs-12 membership-opti">
										<div class="membership-details">
											<h3 class="date-title">Booking Details</h3>
											<label>Step: 4 </label> <span class=""> Select Time</span>
											<div class="row">
												<div class="col-md-6">
													<div class="donate-now">
														<input type="radio" id="a25" name="amount" checked="checked" />
															<label for="a25" id="a25">11:00 am</label>
															<p class="end-hr">1/20 Spots Left </p>
													</div>
												</div>
												<div class="col-md-6">
													<div class="donate-now">
														<input type="radio" id="a50" name="amount" />
															<label for="a50" id="a50">6:00 pm</label>
															<p class="end-hr">1/20 Spots Left </p>
													</div>
												</div>
												<div class="col-md-6">
													<div class="donate-now">
														<input type="radio" id="a51" name="amount" />
															<label for="a51" id="a51">12:23 am</label>
															<p class="end-hr">1/20 Spots Left </p>
													</div>
												</div>
												
												<div class="col-md-6">
													<div class="donate-now">
														<input type="radio" id="a52" name="amount" checked="checked" />
															<label for="a52" id="a52">7:00 pm</label>
															<p class="end-hr">1/20 Spots Left </p>
													</div>
												</div>
												<div class="col-md-6">
													<div class="donate-now">
														<input type="radio" id="a53" name="amount" />
															<label for="a53" id="a53">10:00 pm</label>
															<p class="end-hr">1/20 Spots Left. </p>
													</div>
												</div>
												<div class="col-md-6">
													<div class="donate-now">
														<input type="radio" id="a54" name="amount" />
															<label for="a54" id="a54">12:05 pm</label>
															<p class="end-hr">1/20 Spots Left</p>
													</div>
												</div>
											</div>
											<div id="book<?php echo $service["id"].$service["id"]; ?>">
												@if(@$sercatefirst['category_title'] != '')
													<div class="price-cat">
														<label>Category:</label>
														<span>{{@$sercatefirst['category_title']}}</span>
													</div>
												@endif
												@if($timedata != '')
												<div>
													<label>Duration:</label>
													<span>{{$timedata}}</span>
												</div>
												@endif
												@if(@$servicePrfirst['price_title'] != '')
													<div>
														<label>Price Title:</label>
														<span>{{@$servicePrfirst['price_title']}}</span>
													</div>
												@endif									@if(@$servicePrfirst['pay_session'] != '')
													<div>
														<label>Price Option:</label>
														<span>{{@$servicePrfirst['pay_session']}}</span>
													</div>
												@endif
												@if(@$servicePrfirst['membership_type'] != '')
												<div>
													<label>Membership:</label>
													<span>{{@$servicePrfirst['membership_type']}} @if(@$servicePrfirst['is_recurring_adult'] == 1) (Recurring) @endif</span>
												</div>
												@endif
												@if($adultcnt != 0 && $infantcnt != 0 && $childcnt != 0)
												<div class="personcategory">
													<span>Adults x {{$adultcnt}} </span>
													<span>Kids x {{$childcnt}}</span>
													<span>Infants x {{$infantcnt}}</span>
												</div>
												@endif
											</div>
											<!--<div class="price-option">
												<label id="paysession{{$serviceid}}">Price Option: {{@$servicePr[0]['pay_session']}} Session</label>
												<span>Adults x 1 </span>
												<span>Kids x 0</span>
												<span>Infants x 0</span>
											</div>
											<div class="total-price">
												<label> Total </label>
												<span id="totprice{{$serviceid}}">{{@$servicePr[0]['pay_price']}} USD</span>
											</div>-->
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-xs-12">
							<div class="indetails-btn">
								@if(!empty(@$servicePrfirst))
									<input type="hidden" name="price_title_hidden" id="price_title_hidden{{$serviceid}}{{$serviceid}}" value="{{@$servicePrfirst['price_title']}}">
								@endif
								<input type="hidden" name="time_hidden" id="time_hidden{{$serviceid}}{{$serviceid}}" @if($timedata != 0 ) value="{{$timedata}}" @endif>
								<input type="hidden" name="sportsleft_hidden" id="sportsleft_hidden{{$serviceid}}{{$serviceid}}" value="{{$Totalspot}}">

								<input type="hidden" name="memtype_hidden" id="memtype_hidden{{$serviceid}}{{$serviceid}}" @if(@$servicePrfirst['membership_type'] != '') value="{{@$servicePrfirst['membership_type'] }}@if(@$servicePrfirst['is_recurring_adult'] == 1) (Recurring) @endif" @endif>

								<form method="post" action="/addtocart" id="{{$serviceid}}">
									@csrf
									<input type="hidden" name="pid" value="{{$serviceid}}" size="2" />
									<input type="hidden" name="quantity" id="pricequantity{{$serviceid}}{{$serviceid}}" value="1" class="product-quantity" size="2" />
								   <input type="hidden" name="price" id="price{{$serviceid}}{{$serviceid}}" value="{{$total_price_val}}" class="product-price" size="2" />
									<input type="hidden" name="session" id="session{{$serviceid}}" value="{{@$servicePrfirst['pay_session']}}" />
									<input type="hidden" name="priceid" value="{{$priceid}}" id="priceid{{$serviceid}}" />
									<input type="hidden" name="sesdate" value="{{date('Y-m-d')}}" id="sesdate{{$serviceid}}" />
									<input type="hidden" name="cate_title" value="{{@$sercatefirst['category_title']}}" id="cate_title{{$service['id']}}{{$service['id']}}" />
									<span id="span{{$service['id']}}" name="span{{$service['id']}}"> </span>
									@if($SpotsLeft >= $spot_avil && $spot_avil!=0)
										<a href="javascript:void(0)" class="btn btn-addtocart mt-10" style="pointer-events: none;" >Sold Out</a>
									@else
									  @if( !empty(@$servicePrfirst) )
										@if( @$servicePrfirst['adult_cus_weekly_price']!='' && @$timedata!='' )
												<div class="btn-cart-modal">
													<input type="submit" value="Add to Cart" onclick="changeqnt('<?php echo $service["id"]; ?>')" class="btn btn-black mt-10"  id="addtocart{{$service['id']}}{{$service['id']}}"/>
												</div>
										@endif
									  @endif
									@endif
								</form>

								<div class="btn-cart-modal instant-detail-booknow">
									<input type="submit" value="Book Now" class="btn btn-red mt-10" >
								</div>
							</div>
						</div>
					</div>  
					<!-- <div class="col-md-12 col-xs-12">
						<div class="indetails-btn">
							<div class="btn-cart-modal">
								<input type="submit" value="Add To Cart" class="btn btn-black mt-10" >
							</div>
							<div class="btn-cart-modal instant-detail-booknow">
								<input type="submit" value="Book Now" class="btn btn-red mt-10" >
							</div>
						</div>
					</div> -->
				</div>

				<h3 class="subtitle details-sp">Things To Know </h3>
				
				<h3 class="subtitle details-sp">Know Before You Go</h3>
				<p>{{$houserules}}</p>
				
				<h3 class="subtitle details-sp">Cancelation Policy</h3>
				<p>{{$cancelation}}</p>
				
				<h3 class="subtitle details-sp">Safety and Cleaning Procedures</h3>
				<p>{{$cleaning}}</p>
				
				<div class="row">
					<div class="col-md-9">
						<div class="widget mx-sp">
							<h4 class="widget-title">Provider: {{$companyname }}</h4>
							<div class="widget" style="height:300px" id="mapdetails">
				            	<div class="google-map">
									<div class="get-img"><!--<img src="/images/newimage/map.jpg" alt="images" class="img-fluid">-->
				                    	<div id="map_canvas" style="position: absolute; top: 0; right: 0; bottom: 0; left: 0;height:300px"></div>
				                    </div>
								</div>
				            </div>
							<div class="maparea modal-map">
								<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24176.251535935986!2d-73.96828678121815!3d40.76133318281456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258c4d85a0d8d%3A0x11f877ff0b8ffe27!2sRoosevelt%20Island!5e0!3m2!1sen!2sin!4v1620041765199!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
							</div>

							<?php   
								$locations = []; 
		                        if($companylat != '' || $companylon  != ''){
		                            $lat = $companylat + ((floatVal('0.' . rand(1, 9)) * 1) / 10000);
		                    		$long = $companylon + ((floatVal('0.' . rand(1, 9)) * 1) / 10000);
		                    		$a = [$companyname, $lat, $long, $companyid, $companylogo];
		                            array_push($locations, $a);
								}
							?>
							<div class="map-info">
								<span>
									<i class="fas fa-map-marker-alt map-fa"></i>
									<p>{{$comp_address}}</p>
								</span>
								<span>
									<i class="fas fa-phone-alt map-fa"></i>
									<p>{{$Phonenumber}}</p>
								</span>
								<span>
									<i class="fa fa-envelope map-fa"></i>
									<p>{{$email}}</p>
								</span>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-12 col-sm-12 col-xs-12 instructor-details">
					<div class="row">
						<div class="col-md-3 col-sm-3 col-xs-12">
							<div class="instructor-img">
								<img src="{{url('public/uploads/profile_pic/thumb/1653996182-aerobics.jpg')}}">
							</div>
						</div>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<div class="instructor-inner-details">
								<label>Instructor:</label>
								<span>Darryl Phipps</span>
							</div>
							<div>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<h3 class="subtitle">Submit A Review </h3>
					</div>
					<div class="col-md-8 col-sm-8 col-xs-12"> 
						<h3 class="subtitle"> 
							<div class="row">
								<div class="col-md-2 col-sm-2"> Reviews: </div>
								<div class="col-md-10 col-sm-10">
									<p> <a class="activered f-16 font-bold"> By Everyone </a>
										<a class="f-16 font-bold pepole-color"> | By People I know </a>
									</p>
								</div>
							</div>
						</h3>
						<div class="service-review-desc">
							<div class="row">
								<div class="col-md-12">
								<?php
									$business_reviews_count = BusinessReview::where('page_id', $companyid)->count();
									$business_reviews_sum = BusinessReview::where('page_id', $companyid)->sum('rating');

									$business_reviews_avg=0;
									$business_reviews_per=0;
									if($business_reviews_count>0)
									{ $business_reviews_avg = round($business_reviews_sum/$business_reviews_count,2); 
										$business_sum_of_rating = $business_reviews_count*5;
										$business_totalRating = $business_reviews_avg * $business_reviews_count;
										$business_reviews_per = ($business_totalRating/$business_sum_of_rating)*100;
									}

									$reviews_count = BusinessServiceReview::where('service_id', $serviceid)->count();
									$reviews_sum = BusinessServiceReview::where('service_id', $serviceid)->sum('rating');
									
									$reviews_avg=0;
									$reviews_per=0;
									if($reviews_count>0)
									{ $reviews_avg = round($reviews_sum/$reviews_count,2); 
										$sum_of_rating = $reviews_count*5;
										$totalRating = $reviews_avg * $reviews_count;
										$reviews_per = ($totalRating/$sum_of_rating)*100;
									}
								?>
	                    
									<p> {{$reviews_count}} Reviews </p> 
									<div class="rattxt activered"><i class="fa fa-star" aria-hidden="true"></i> {{$reviews_avg}} </div>
								</div>
							</div>
						</div>
						<div class="progress-bar-main">
							<div class="pro-inner">
								<div class="review-name">
									<label>Review for Activity</label>
									<label>Review for Business </label>
								</div>
								<div class="progress-bar-widget">
									<div class="progress pr-bt"> 
										<div class="progress-bar" role="progressbar" aria-valuenow="{{$reviews_avg}}"
										aria-valuemin="0" aria-valuemax="100" style="width:{{$reviews_per}}%">
											<span class="sr-only">{{$reviews_per}}% Complete</span>
										</div>
									</div>
									<div class="progress">
										<div class="progress-bar" role="progressbar" aria-valuenow="{{$business_reviews_avg}}"
										aria-valuemin="0" aria-valuemax="100" style="width:{{$business_reviews_per}}%">
											<span class="sr-only">{{$business_reviews_per}}% Complete</span>
										</div>
									</div>
								</div>
								<div class="process-number">
									<label>{{$reviews_avg}}</label>
									<label>{{$business_reviews_avg}}</label>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-4 col-sm-4"> 
						<a class="btn submit-rev mt-10 rev-new" data-toggle="modal" data-target="#busireview"> Submit Review </a>
						<div class="rev-follow">
							<a href="#" class="rev-follow-txt">{{$reviews_count}} Followers Reviewed This</a>
							<div class="users-thumb-list">
								<?php 
									$reviews_people = BusinessServiceReview::where('service_id', $serviceid)->orderBy('id','desc')->limit(6)->get(); 
								?>
	                            @if(!empty($reviews_people))
	                                @foreach($reviews_people as $people)
	                                	<?php $userinfo = User::find($people->user_id); ?>
	                                    <a href="<?php echo config('app.url'); ?>/userprofile/{{@$userinfo->username}}" target="_blank" title="{{$userinfo->firstname}} {{$userinfo->lastname}}" data-toggle="tooltip">
	                                        <!--<img src="{{ url('public//images/newimage/userlist-1.jpg') }}" alt="">  -->
	                                        @if(File::exists(public_path("/uploads/profile_pic/thumb/".$userinfo->profile_pic)))
	                                        <img src="{{ url('/public/uploads/profile_pic/thumb/'.$userinfo->profile_pic) }}" alt="{{$userinfo->firstname}} {{$userinfo->lastname}}">
	                                        @else
	                                            <?php
	                                            $pf=substr($userinfo->firstname, 0, 1).substr($userinfo->lastname, 0, 1);
	                                            echo '<div class="admin-img-text"><p>'.$pf.'</p></div>'; ?>
	                                        @endif
	                                    </a>
	                                @endforeach
	                            @endif
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12">	
						<div class="ser-review-list">
							<div id="user_ratings_div{{$serviceid}}">
								<?php
	    							$reviews = BusinessServiceReview::where('service_id', $serviceid)->get();
	    						?>
	                        	@if(!empty($reviews))
	                                @foreach($reviews as $review)
	                                <?php $userinfo = User::find($review->user_id); ?>
								<div class="ser-rev-user">
										<div class="col-md-2 col-sm-2 col-xs-3 pl-0 pr-0">
											@if(File::exists(public_path("/uploads/profile_pic/thumb/".$userinfo->profile_pic)))
	                                            <img class="rev-img" src="{{ url('/public/uploads/profile_pic/thumb/'.$userinfo->profile_pic) }}" alt="{{$userinfo->firstname}} {{$userinfo->lastname}}">
	                                        @else
	                                            <?php
	                                            $pf=substr($userinfo->firstname, 0, 1).substr($userinfo->lastname, 0, 1);
	                                            echo '<div class="reviewlist-img-text"><p>'.$pf.'</p></div>'; ?>
	                                        @endif
										</div>
										<div class="col-md-10 col-sm-10 col-xs-9 pl-0">
											<h4> {{$userinfo->firstname}} {{$userinfo->lastname}}
											<div class="rattxt activered"><i class="fa fa-star" aria-hidden="true"></i> {{$review->rating}}  </div> </h4> 
											<p class="rev-time"> {{date('d M-Y',strtotime($review->created_at))}} </p>
										</div>
								</div>
								<div class="rev-dt">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="mx-sp">
												<p class="mb-15"> {{$review->title}} </p>
												<p> {{$review->review}} </p>
											</div>
										</div>
									</div>
									<?php
										if( !empty($review->images) ){
											$rimg=explode('|',$review->images);
											echo '<div class="listrimage">';
											foreach($rimg as $img)
											{ ?>
	                                        	<a href="{{ url('/public/uploads/review/'.$img) }}" data-fancybox="group" data-caption="{{$review->title}}">
												<img src="{{ url('/public/uploads/review/'.$img) }}" alt="Fitnessity" />
	                                            </a>
	                                            <?php
											}
											echo '</div>';
										}
									?>                                    
								</div>
								<!-- <div class="rev-admin">
									<h4> Author </h4>
									<p> Thank you, Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
								</div> -->
								@endforeach
	        					@endif
							</div>
						</div>
					</div>
				</div>	
			</div>	
				
	        <div class="col-lg-5 col-sm-12 col-xs-12">
	            <div class="modal-sidebox">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="modal-filter-instant morefilter">
								<p>More Filter<i class="fas fa-filter"></i></p>
							</div>
						</div>
						@php 
							$actoffer = BusinessServices::where('cid',$companyactid)->groupBy('sport_activity')->get()->toArray();
						@endphp
						<div class="col-md-6 col-sm-6 col-xs-6">
							<div class="activityselect3 special-date dropdowns">
								<input type="text" name="actfildate" id="actfildate{{$serviceid}}" placeholder="Date" class="form-control" onchange="actFilter({{$companyactid}},{{$serviceid}})" autocomplete="off" >
								<i class="fa fa-calendar"></i>
							</div>
							<script>
								$( function() {
									$( "#actfildate{{$serviceid}}" ).datepicker( { minDate: 0 } );
								  } );
							</script>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<div class="dropdowns">
								<select id="actfilparticipant{{$serviceid}}" name="actfilparticipant" class="form-control activityselect4" onchange="actFilter({{$companyactid}},{{$serviceid}})">
		                            <option value="">Participant #</option>
		                            <?php for($i=1; $i<=100; $i++){
										echo '<option value="'.$i.'">'.$i.'</option>';
									}?>
		                        </select>
		                    </div>
						</div>
						<div id="filteroption" style="display: none">
							<div class="col-md-6 col-sm-6 col-xs-6">
								<div class="dropdowns">
									<select id="actfiloffer{{$serviceid}}" name="actfiloffer" class="form-control activityselect1" onchange="actFilter({{$companyactid}},{{$serviceid}})">
	                                	<option value="">Activity Offered</option>
										@if (!empty($actoffer)) 
											@foreach ($actoffer as  $off)
		                               	 		<option>{{$off['sport_activity']}}</option>
		                               		@endforeach
	                               		@endif 
	                            	</select>
								</div>
	                        </div>
	                        <div class="col-md-6 col-sm-6 col-xs-6">
	                        	<div class="dropdowns">
		                            <select id="actfillocation{{$serviceid}}" name="actfillocation" class="form-control activityselect2" onchange="actFilter({{$companyactid}},{{$serviceid}})">
		                                <option value="">Location</option>
		                                <option value="Online">Online</option>
		                                <option value="At Business">At Business Address</option>
		                                <option value="On Location">On Location</option>
		                            </select>
		                        </div>
	                        </div>
	                        <div class="col-md-6 col-sm-6 col-xs-6">
	                        	<div class="dropdowns">
		                            <select id="actfilmtype{{$serviceid}}" name="actfilmtype" class="form-control activityselmtype" onchange="actFilter({{$companyactid}},{{$serviceid}})">
		                                <option value="">Membership Type</option>
		                                <option>Drop In</option>
		                                <option>Semester</option>
		                            </select>
		                        </div>
	                        </div>
	                        <div class="col-md-6 col-sm-6 col-xs-6">
	                        	<div class="dropdowns">
		                            <select id="actfilgreatfor{{$serviceid}}" name="actfilgreatfor" class="form-control activityselgreatfor" onchange="actFilter({{$companyactid}},{{$serviceid}})">
		                                <option value="">Great For</option>
		                                <option>Individual</option>
		                                <option>Kids</option>
		                                <option>Teens</option>
		                                <option>Adults</option>
		                                <option>Family</option>
		                                <option>Groups</option>
		                                <option>Paralympic</option>
		                                <option>Prenatal</option>
		                                <option>Any</option>
		                            </select>
	                            </div>
	                        </div>
	                        <div class="col-md-6 col-sm-6 col-xs-6">
	                        	<div class="dropdowns">
		                            <select id="actfilbtype{{$serviceid}}" name="actfilbtype" class="form-control activityselbtype" onchange="actFilter({{$companyactid}},{{$serviceid}})" >
		                                <option value="">Business Type</option>
		                                <option value="individual">Personal Trainer</option>
		                                <option value="classes">Gym/Studio</option>
		                                <option value="experience">Experience</option>
	                            	</select>
	                            </div>
	                        </div>
	                        <div class="col-md-6 col-sm-6 col-xs-6">
	                        	<div class="dropdowns">
		                            <select id="actfilsType{{$serviceid}}" name="actfilsType" class="form-control activityselect5" onchange="actFilter({{$companyactid}},{{$serviceid}})">
		                                <option value="">Service Type</option>
		                                <option>Personal Training</option>
		                                <option>Coaching</option>
		                                <option>Therapy</option>
		                                <option>Group Class</option>
		                                <option>Seminar</option>
		                                <option>Workshop</option>
		                                <option>Clinic</option>
		                                <option>Camp</option>
		                                <option>Team</option>
		                                <option>Corporate</option>
		                                <option>Tour</option>
		                                <option>Adventure</option>
		                                <option>Retreat</option>
		                                <option>Workshop</option>
		                                <option>Seminar</option>
		                                <option>Private experience</option>
		                            </select>
		                        </div>
	                        </div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<h3 class="subtitle text-center">Other Activities Offered By This Provider</h3>
						</div>
						<div id="filtersearchdata">
	 						<?php
							if (!empty($activities_search)) { 
								$companyid = $companyname = $serviceid = $companycity = $companycountry = $pay_price  = "";
								foreach ($activities_search as  $service) {
									$company = $price = $businessSp = [];
									$serviceid = $service['id'];
			                        $sport_activity = $service['sport_activity'];
			                        $companyData = CompanyInformation::where('id',$service['cid'])->first();
			                        if (isset($companyData)) {

	                                    $companyid = $companyData['id'];
	                                    $companyname = $companyData['company_name'];
										$companycity = $companyData['city'];
										$companycountry = $companyData['country'];
			                                
			                        }
			                       
			                        if ($service['profile_pic']!="") {
										if(File::exists(public_path("/uploads/profile_pic/thumb/" . $service['profile_pic']))) {
			                            	$profilePic = url('/public/uploads/profile_pic/thumb/'.$service['profile_pic']);
										} else {
											$profilePic = '/public/images/service-nofound.jpg';
										}
									}else{ $profilePic = '/public/images/service-nofound.jpg'; }
									
									$reviews_count = BusinessServiceReview::where('service_id', $service['id'])->count();
									$reviews_sum = BusinessServiceReview::where('service_id', $service['id'])->sum('rating');
									$reviews_avg=0;
									if($reviews_count>0)
									{	
										$reviews_avg= round($reviews_sum/$reviews_count,2); 
									}
									$redlink = str_replace(" ","-",$companyname)."/".$service['cid'];
									$service_type='';
									if($service['service_type']!=''){
										if( $service['service_type']=='individual' ) $service_type = 'Personal Training'; 
										else if( $service['service_type']=='classes' )	$service_type = 'Group Classe'; 
										else if( $service['service_type']=='experience' ) $service_type = 'Experience'; 
									}
									$pricearr = [];
									$price_all = '';
									$ser_date = '';
									$price_allarray = BusinessPriceDetails::where('serviceid', $service['id'])->get();
									if(!empty($price_allarray)){
										foreach ($price_allarray as $key => $value) {
											$pricearr[] = $value->pay_price;
										}
									}
									if(!empty($pricearr)){
										$price_all = min($pricearr);
									}
									
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
							?>
								<div class="col-md-12 col-sm-8 col-xs-12 ">
									<div class="find-activity">
										<div class="row">
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="img-modal-left">
													<img src="{{ $profilePic }}" >
												</div>
											</div>
											<div class="col-md-8 col-sm-8 col-xs-12 activity-data">
												<div class="activity-inner-data">
													<i class="fas fa-star"></i>
													<span> {{$reviews_avg}} ({{$reviews_count}})  </span>
												</div>
												@if($time != '')
													<div class="activity-hours">
														<span>{{$time}}</span>
													</div>
												@endif
												<div class="activity-city">
													<span>{{$companycity}}, {{$companycountry}}</span>
													@if(Auth::check())
													<?php
					                                	$loggedId = Auth::user()->id;
					                                	$favData = BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$service['id'])->first();              
					                                ?>
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
						                            @else
						                            	<a class="fav-fun-2" href="{{ Config::get('constants.SITE_URL') }}/userlogin" ><i class="far fa-heart"></i></a>
													@endif
												</div>
												<div class="activity-information">
													<span><a 
						                                <?php if (Auth::check()) { ?> 
						                                    href="{{ Config::get('constants.SITE_URL') }}/businessprofile/{{$redlink}}" 
						                                <?php } else { ?>
						                                    href="{{ Config::get('constants.SITE_URL') }}/userlogin" 
						                                <?php }?>
						                                    target="_blank">{{ $service['program_name'] }}</a></span>
													<p>{{ $service_type }} | {{ $service['sport_activity'] }}</p>
													<a class="showall-btn" href="/activity-details/{{$service['id']}}">More Details</a>
												</div>
												@if($price_all != '')
													<div>
														<span class="activity-time">From ${{$price_all}}/Person</span>
													</div>
												@endif
											</div>
										</div>
									</div>
								</div>
							<?php 
								
									}
								}else{ ?>
									<div class="col-md-4">
										<p class="noactivity"> There Is No Activity</p>
									</div>
							<?php	} ?>
						</div>
					</div>
	            </div>
	        </div>	
		</div>
   	</div>            
<!-- end modal -->

<div id="busireview" class="modal modalbusireview" tabindex="-1">
    <div class="modal-dialog rating-star" role="document">
        <div class="modal-content">
            <div class="modal-header" style="padding:10px 40px 10px 10px; text-align: right;min-height: 30px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
			</div>
            <div class="modal-body">
            	<div class="rev-post-box">
                	<form method="post" enctype="multipart/form-data" name="sreview{{$sid}}" id="sreview{{$sid}}" >
                    @csrf
							<div class="clearfix"></div>
							<input type="hidden" name="serviceid{{$sid}}" id="serviceid{{$sid}}" value="{{$sid}}">
	                        <input type="hidden" name="rating{{$sid}}" id="rating{{$sid}}" value="0">
                            <div class="rvw-overall-rate rvw-ex-mrgn">
								<span>Rating</span>
								<div id="stars{{$sid}}" data-service="{{$sid}}" class="starrr" style="font-size:22px"></div>
							</div>
							<input type="text" name="rtitle{{$sid}}" id="rtitle{{$sid}}" placeholder="Review Title" class="inputs" />
	                    	<textarea placeholder="Write your review" name="review{{$sid}}" id="review{{$sid}}"></textarea>
	                        <input type="file" name="rimg{{$sid}}[]" id="rimg{{$sid}}" class="inputs" multiple="multiple" />
	                        <div class="reviewerro" id="reviewerro{{$sid}}"> </div>
	                    	<input type="button" onclick="submit_rating({{$sid}})" value="Submit" class="btn rev-submit-btn mt-10">
	                    	<script>
							 $('#stars{{$sid}}').on('starrr:change', function(e, value){
								$('#rating{{$sid}}').val(value);
							 });
							</script>
					</form>
				</div>
            </div> <!--body-->
		</div>
	</div>
</div>
</div>

@include('layouts.footer')


<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDSB1-X7Uoh3CSfG-Sw7mTLl4vtkxY3Cxc&sensor=false"></script>
<script>
$(document).ready(function () {
	
	var locations = @json($locations);
   /* alert(locations);*/
    var map = ''
    var infowindow = ''
    var marker = ''
    var markers = []
    var circle = ''
	$('#map_canvas').empty();

    if (locations.length != 0) {  console.log('!empty');
        map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom:18,
            center: new google.maps.LatLng(locations[0][1], locations[0][2]),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        });
        infowindow = new google.maps.InfoWindow();
        var bounds = new google.maps.LatLngBounds();
        var marker, i;
        var icon = {
            url: "https://development.fitnessity.co/public/images/hoverout2.png",
            scaledSize: new google.maps.Size(50, 50),
			labelOrigin: {x: 25, y: 16}
        };
        for (i = 0; i < locations.length; i++) {
            var labelText = i + 1
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
				icon: icon,
                title: labelText.toString(),
                label: {
                    text: labelText.toString(),
                    color: '#222222',
                    fontSize: '12px',
                    fontWeight: 'bold'
                }
            });

            bounds.extend(marker.position);

            var img_path = "{{Config::get('constants.USER_IMAGE_THUMB')}}";
            var contents =
                    '<div class="card-claimed-business"> <div class="row"><div class="col-lg-12" >' +
                    '<div class="img-claimed-business">' +
                    '<img src=' + img_path + encodeURIComponent(locations[i][4]) + ' alt="">' +
                    '</div></div> </div>' +
                    '<div class="row"><div class="col-lg-12" ><div class="content-claimed-business">' +
                    '<div class="content-claimed-business-inner">' +
                    '<div class="content-left-claimed">' +
                    '<a href="/pcompany/view/' + locations[i][3] + '">' + locations[i][0] + '</a>' +
                    '<ul>' +
                    '<li class="fill-str"><i class="fa fa-star"></i></li>' +
                    '<li class="fill-str"><i class="fa fa-star"></i></li>' +
                    '<li class="fill-str"><i class="fa fa-star "></i></li>' +
                    '<li><i class="fa fa-star"></i></li>' +
                    '<li><i class="fa fa-star"></i></li>' +
                    '<li class="count">25</li>' +
                    '</ul>' +
                    '</div>' +
                    '<div class="content-right-claimed"></div>' +
                    '</div>' +
                    '</div></div></div>' +
                    '</div>';

            google.maps.event.addListener(marker, 'mouseover', (function (marker, contents, infowindow) {
                return function () {
                    infowindow.setPosition(marker.latLng);
                    infowindow.setContent(contents);
                    infowindow.open(map, this);
                };
            })(marker, contents, infowindow));
            markers.push(marker);
        }

		//nnn commented on 18-05-2022 - its not displaying proper map
       // map.fitBounds(bounds);
       // map.panToBounds(bounds);
		
		$('.mysrchmap').show()
    } else {
        $('#mapdetails').hide()
        
		/*console.log('else map');
        map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom: 8,
            center: new google.maps.LatLng(42.567200, -83.807250),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        $('.mysrchmap').show()*/
    }
});
</script>

<script>
	$(document).ready(function () {
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

	    $(document).on('click', '.morefilter', function(){
	    	if($(filteroption).is(":visible")){
	    		$('#filteroption').hide();
	    	}else{
	    		$('#filteroption').show();
	    	}

	    });
	});
</script>

<script>

	function updatedetail(sid){
		var Participant = $('#actfiloffer_forcart').val();
		var date = $('#actfildate_forcart').val();
		$('#pricequantity'+sid+sid).val(Participant)
		$('#sesdate'+sid+sid).val(date)
	}

	function actFilter(cid,sid)
	{   
		var actdate=$('#actfildate'+sid).val();
		var actfilparticipant=$('#actfilparticipant'+sid).val();
		var actoffer=$('#actfiloffer'+sid).val();
		var actloc=$('#actfillocation'+sid).val();
		var actfilmtype=$('#actfilmtype'+sid).val();
		var actfilgreatfor=$('#actfilgreatfor'+sid).val();
		var btype=$('#actfilbtype'+sid).val();
		var actfilsType=$('#actfilsType'+sid).val();
		var _token = $("input[name='_token']").val();
		var serviceid =sid;
		var pr; var qty;
		//alert(actfiloffer);
		$.ajax({
			url: "{{route('act_detail_filter')}}",
			type: 'POST',
			data:{
				_token: _token,
				type: 'POST',
				actoffer:actoffer,
				actloc:actloc,
				actfilmtype:actfilmtype,
				actfilgreatfor:actfilgreatfor,
				actfilparticipant:actfilparticipant,
				btype:btype,
				actdate:actdate,
				actfilsType:actfilsType,
				serviceid:serviceid,
				companyid:cid,
			},
			success: function (response) {
				/*alert(response);*/
				if(response != ''){
					$('#filtersearchdata').html(response);
				}else{
					$('#filtersearchdata').html('<div class="col-md-12 col-sm-8 col-xs-12 "><p>No Activity Found.</p></div>');
				}
				/*var data = response.split('~~~~');
				$('#actsearch'+sid).html(data[0]);
				$('#statact'+sid).html(data[1]);
				//alert($('#price'+sid).val());
				var firstval=$("#selprice"+sid).prop("selectedIndex", 1).val();
				if(actdate!=''){
					var actdt = actdate.split('/');
					$('#sesdate'+sid+sid).val(actdt[2]+'-'+actdt[0]+'-'+actdt[1]);
				}*/		
			}
		});
	}
</script>

<script>
	$( function() {
		$( "#actfildate_forcart" ).datepicker( { minDate: 0 } );
	} );
</script>
<script>
	$( function() {
		$( "#actfildate0" ).datepicker( { minDate: 0 } );
	} );
</script>

<script type="text/javascript">	
	function submit_rating(sid)
	{
		@if(Auth::check())
		//var formData = $("#sreview"+sid).serialize();
		var formData = new FormData();
		var rating=$('#rating'+sid).val();
		var review=$('#review'+sid).val();
		var rtitle=$('#rtitle'+sid).val();
		var _token = $("input[name='_token']").val();
		
		TotalFiles = $('#rimg'+sid)[0].files.length;
		
		let rimg = $('#rimg'+sid)[0];
		for (let i = 0; i < TotalFiles; i++) {
			formData.append('rimg' + i, rimg.files[i]);
		}
		formData.append('TotalFiles', TotalFiles);
	    formData.append('rtitle', rtitle);
		formData.append('review', review);
		formData.append('rating', rating);
		formData.append('sid', sid);
		formData.append('_token', _token);
		
		if(rating!='' && review!='')
		{ 
			$.ajax({
				url: "{{route('save_business_service_reviews')}}",
				type: 'POST',
	            contentType: 'multipart/form-data',
	            cache: false,
	            contentType: false,
	            processData: false,
	            data: formData,
				success: function (response) {
					$('.progress-bar-main').load(' .progress-bar-main > *')
					if(response=='submitted')
					{	$('#reviewerro'+sid).show(); $('#reviewerro'+sid).html('Review submitted'); 
						//$("#user_ratings_div"+sid).load(location.href + " #user_ratings_div"+sid);
						$("#user_ratings_div"+sid).load(location.href+" #user_ratings_div"+sid+">*","");
						$('#rating'+sid).val(' ');
						$('#review'+sid).val(' '); $('#rtitle'+sid).val(' ');
					}
					else if(response=='already')
					{ $('#reviewerro'+sid).show(); 
						$('#reviewerro'+sid).html('You have already submitted your review for this activity.'); }
					else if(response=='addreview')
					{ $('#reviewerro'+sid).show(); $('#reviewerro'+sid).html('Add your review and select rating for activity');  }
					
				}
			});
		}
		else
		{
			$('#reviewerro'+sid).show(); 
			$('#reviewerro'+sid).html('Please add your reivew and select rating'); 
			$('#rating'+sid).val(' ');
			$('#review'+sid).val(' ');
			return false;
		}
		@else
			$('#reviewerro'+sid).show(); 
			$('#reviewerro'+sid).html('Please login in your account to review this activity');
			$('#rating'+sid).val(' ');
			$('#review'+sid).val(' ');
			return false;
		@endif	
	}

	function changeactpr(aid,val,part,div,maid)
	{
		var n = val.split('!^');
	    var datan = '';
	    var session = '';
	    var id = '';
	    var pr1 = 0;
	    var price_title = '—';
	    var memtype_hidden = '';
	    if(n[0] != ''){
	    	datan1 = n[0].split('~~');
	    	if(datan1[0] != ''){
	    		session =  datan1[0]; 
	    	}
	    	if(datan1[1] != ''){
				pr1 =  datan1[1]; 
	    	}
	    	if(datan1[2] != ''){
	    		id=datan1[2];
	    	}
	    }
	    if(n[1] != ''){
	        datan = n[1].split('^^');
	        if(datan[0] != ''){
	            price_title = datan[0];
	            $('#price_title_hidden'+maid+aid).val(datan[0]);
	        }
	        if(datan[1] != ''){
	            memtype_hidden = datan[1];
	            $('#memtype_hidden'+maid+aid).val(datan[1]);
	        }
	    }
		var pr; var qty;
		var actfilparticipant=$('#actfilparticipant'+maid).val();
		var category_title = $('#cate_title'+maid+aid).val();
	    var time = $('#time_hidden'+maid+aid).val();
	    var sportsleft = $('#sportsleft_hidden'+maid+aid).val();
		if(actfilparticipant!='')
		{
			pr=actfilparticipant*pr1; 
			qty=actfilparticipant;
		}
		else{ 
			qty=1; 
			if( pr1!='' ){ pr=qty*pr1; } else { pr='100'; }
		}
		var infantcnt = 0;
		var childcnt = 0;
		var adultcnt = 0;
		var bookdata = '<div class="price-cat"><label>Category: </label><span> '+ category_title +'</span></div><div><label>Duration: </label><span>'+ time +'</span></div><div><label>Price Title: </label><span>'+ price_title+'</span></div><div><label>Price Option: </label><span>'+session+' Session</span></div><div><label>Membership: </label><span> '+memtype_hidden+'</span></div><div class="personcategory"><span>Adults x '+adultcnt+'</span><span>Kids x '+childcnt+'</span><span>Infants x '+infantcnt+'</span></div></div>';

		if(div=='book'){
			$('#book'+maid+aid).html(bookdata);
			$('#pricequantity'+maid+aid).val(qty);
			$('#price'+maid+aid).val(pr);
			$('#priceid'+maid+aid).val(id);
		}

		else if (div=='bookmore'){
			console.log(aid);
			$('#bookmore'+maid+aid).html(bookdata);
			$('#pricebookmore'+maid+aid).val(pr);
			$('#priceid'+maid+aid).val(id);
		}

		else if (div=='bookajax'){
			$('#bookajax'+maid+aid).html(bookdata);
			$('#pricebookajax'+maid+aid).val(pr);
			$('#pricequantity'+maid+aid).val(qty);
			$('#priceid'+maid+aid).val(id);
		}
	}
</script>




@endsection