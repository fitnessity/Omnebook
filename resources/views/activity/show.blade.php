@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')
@section('content')
<style type="text/css">
.qty .count {
    color: #000;
    display: inline-block;
    vertical-align: top;
    font-size: 22px;
    line-height: 30px;
    padding: 0 2px
    ;min-width: 35px;
    text-align: center;
}
.qty .plus {
    cursor: pointer;
    display: inline-block;
    vertical-align: top;
    width: 30px;
    height: 30px;
    color: #000;
    font: 30px/1 Arial,sans-serif;
    text-align: center;
    border-radius: 50%;
    }
.qty .minus {
    cursor: pointer;
    display: inline-block;
    vertical-align: top;
    width: 30px;
	color: #000;
    height: 30px;
    font: 30px/1 Arial,sans-serif;
    text-align: center;
    border-radius: 50%;
    background-clip: padding-box;
}
.bg-darkbtn {
    border: 1px solid #000;
}
/*Prevent text selection*/
span{
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}
.count {  
    border: 0;
    width: 2%;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input:disabled{
    background-color:white;
}
   
</style>
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
    use App\StaffMembers;

	$sid = $serviceid;
	$service = BusinessServices::where('id',$serviceid)->first();
	$businessSp = BusinessService::where('cid', $service['cid'])->first();
	if(!empty($businessSp)) {
        $languages = $businessSp['languages'];
    }     

    $cancelation = $cleaning = $houserules = $comp_address = $Phonenumber = '';
    $email = $companylat = $companylon  = $companylogo = '';
    $comp_data = CompanyInformation::where('id', $service['cid'])->first();
    
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

	$staffdata = StaffMembers::where(['id'=>$service->instructor_id])->first(); 

	$companyname = $comp_data->company_name;
	$companyid = $comp_data->id;
	$Phonenumber = $comp_data->contact_number;
	$companylon = $comp_data->longitude;
	$companylat = $comp_data->latitude;
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
	$sercatefirst = BusinessPriceDetailsAges::where('serviceid',  @$serviceid )->orderBy('id', 'ASC')->first();
	//DB::enableQueryLog();
	if(@$sercatefirst != ''){
    	$servicePr = BusinessPriceDetails::where('serviceid',  @$serviceid )->orderBy('id', 'ASC')->where('category_id',@$sercatefirst['id'])->get()->toArray();
	}

	//dd(\DB::getQueryLog());
    $todayday = date("l");
    $todaydate = date('m/d/Y');
    $maxspotValue = 0;
	if(!empty(@$sercatefirst)){
    	$bus_schedule = BusinessActivityScheduler::where('category_id',@$sercatefirst['id'])->whereRaw('FIND_IN_SET("'.$todayday.'",activity_days)')->where('starting','<=',$todaydate )->where('end_activity_date','>=',date('Y-m-d') )->get();
    	$maxspotValue = BusinessActivityScheduler::where('serviceid',  @$serviceid )->whereRaw('FIND_IN_SET("'.$todayday.'",activity_days)')->where('starting','<=',$todaydate )->where('end_activity_date','>=',date('Y-m-d') )->max('spots_available');
	}

    // print_r($bus_schedule);
    $start =$end= $time= '';$timedata = '';$Totalspot= $spot_avil= 0;  $SpotsLeftdis = 0 ;
    $i=0;
    if(!empty(@$bus_schedule)){
        foreach($bus_schedule as $data){
        	if($i==0){
        		$SpotsLeftdis = 0; 
				$SpotsLeft = UserBookingDetail::where('act_schedule_id',$data['id'])->whereDate('bookedtime', '=', date('Y-m-d'))->get()->toArray();
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
				if( $data['spots_available'] != ''){
					$SpotsLeftdis = $data['spots_available'] - $totalquantity;
				} 
				
	            $expdate  = date('m/d/Y', strtotime($data['end_activity_date']));
	            $date_now = new DateTime();
	            $expdate = new DateTime($expdate);
	            if($SpotsLeftdis != 0){
	            	if($date_now <= $date_now){
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
		            $i++;
	            }
           	}
        }
    }
 	/*echo $timedata;exit();*/
	$selectval = $priceid = $total_price_val = '' ;
	$adult_cnt =$child_cnt =$infant_cnt =0;
	$adult_price = $child_price = $infant_price =0;
	if(date('l') == 'Saturday' || date('l') == 'Sunday'){
        $total_price_val =  @$servicePrfirst['adult_weekend_price_diff'] + @$servicePrfirst['child_weekend_price_diff'] + @$servicePrfirst['infant_weekend_price_diff'] ;
        if(@$servicePrfirst['adult_weekend_price_diff'] != ''){
        	$adult_price = @$servicePrfirst['adult_weekend_price_diff'];
        	$adult_cnt = 1;
        }

        if(@$servicePrfirst['child_weekend_price_diff'] != ''){
        	$child_price = @$servicePrfirst['child_weekend_price_diff'];
        	$child_cnt = 1;
        }

        if(@$servicePrfirst['infant_weekend_price_diff'] != ''){
        	$infant_price = @$servicePrfirst['infant_weekend_price_diff'];
        	$infant_cnt = 1;
        }
       
        $i=1;
        if (!empty(@$servicePr)) {
            foreach ($servicePr as  $pr) {
                if($i==1){
            		$priceid =$pr['id'];
            	}
                $selectval .='<option value="'.$pr['id'].'">'.$pr['price_title'].'</option>';
                $i++;
            }
        }
    }else{
		/*print_r($servicePr); exit;*/
		if(!empty(@$servicePr))
		{

			$total_price_val =  @$servicePrfirst['adult_cus_weekly_price'] + @$servicePrfirst['child_cus_weekly_price'] + @$servicePrfirst['infant_cus_weekly_price'];
			if(@$servicePrfirst['adult_cus_weekly_price'] != ''){
				$adult_price = @$servicePrfirst['adult_cus_weekly_price'];
	        	$adult_cnt = 1;
	        }

	        if(@$servicePrfirst['child_cus_weekly_price'] != ''){
	        	$child_price = @$servicePrfirst['child_cus_weekly_price'];
	        	$child_cnt = 1;
	        }

	        if(@$servicePrfirst['infant_cus_weekly_price'] != ''){
	        	$infant_price = @$servicePrfirst['infant_cus_weekly_price'];
	        	$infant_cnt = 1;
	        }
			$i=1;
            foreach ($servicePr as  $pr) {
            	if($i==1){
            		$priceid =$pr['id'];
            	}
				$selectval .='<option value="'.$pr['id'].'">'.$pr['price_title'].'</option>';
				$i++;
			}
		}
    }

	$mbox =''; 
    if (!empty(@$servicePr)) {
    	foreach ($servicePr as  $pr) {
            $mem_ary [] =  $pr['membership_type'];
        }
        $mem_ary = array_unique($mem_ary);
        foreach ($mem_ary as  $pr) {
            $mbox .='<option value="'.$pr.'">'.$pr.'</option>';
        }
    }


    $activities_search = BusinessServices::where('cid', $service['cid'])->where('is_active', '1')->where('id', '!=' , $serviceid)->limit(2)->orderBy('id', 'DESC')->get();

    $pro_pic = $service->profile_pic;
    $pro_pic = substr($pro_pic, 0, -1);
    if (strpos($pro_pic, ',') !== false) {
        $pro_pic1 = explode(',', $pro_pic);
    }else{
        $pro_pic1 = $pro_pic;
    }

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
				<div class="modal-banner modal-banner-sp galleryfancy">
					@php $i=0; @endphp
					@if(is_array(@$pro_pic1))
	                    @if(!empty(@$pro_pic1))
	                        @foreach(@$pro_pic1 as $img)
	                            @if(!empty($img) && File::exists(public_path("/uploads/profile_pic/".$img)))

	                            <div class="bannar-size" @if($i>4) style="display:none" @endif>
			                    	<a href="{{ url('/public/uploads/profile_pic/'.$img)}}" title=""  class="dimgfit firstfancyimg" data-fancybox="gallery">
									<img src="{{ url('/public/uploads/profile_pic/'.$img)}}">
									@if($i==3) <button class="showall-btn showphotos" ><i class="fas fa-bars"></i>Show all photos</button> @endif
			                        </a>
								</div>	                            
								
								@endif
								@php $i++; @endphp
	                        @endforeach
	                    @endif
	                @else
	                	@if(!empty($pro_pic1) && File::exists(public_path("/uploads/profile_pic/".$pro_pic1)))
						<div class="bannar-size">
	                    	<a href="{{ url('/public/uploads/profile_pic/'.$pro_pic1)}}" title=""  class="dimgfit firstfancyimg" data-fancybox="gallery">
							<img src="{{ url('/public/uploads/profile_pic/'.$pro_pic1)}}">
							<button class="showall-btn showphotos" ><i class="fas fa-bars"></i>Show all photos</button> 
	                        </a>
						</div>
                        @endif
                    @endif
                	
					<!-- <div class="bannar-size">
                    	<a href="{{ url('/public/uploads/gallery/720/thumb/BLUE+-+turtle.jpg')}}" title="" class="dimgfit" data-fancybox="gallery">
						<img src="{{ url('/public/uploads/gallery/720/thumb/BLUE+-+turtle.jpg')}}">
                        </a>
					</div>
					<div class="bannar-size">
                    	<a href="{{ url('/public/uploads/gallery/720/thumb/BLUE+-+turtle.jpg')}}" title="" class="dimgfit" data-fancybox="gallery">
						<img src="{{ url('/public/uploads/gallery/720/thumb/BLUE+-+turtle.jpg')}}">
                        </a>
					</div>
					<div class="bannar-size">
                    	<a href="{{ url('/public/uploads/gallery/720/thumb/BLUE+-+turtle.jpg')}}" title="" class="dimgfit" data-fancybox="gallery">
							<img src="{{ url('/public/uploads/gallery/720/thumb/BLUE+-+turtle.jpg')}}">
                        </a>
						<button class="showall-btn showphotos" ><i class="fas fa-bars"></i>Show all 8 photos</button>
					</div> -->
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
							<!-- <div>
								<label>Duration: </label>
								<span> </span>
							</div> -->
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
								<span>@if(@$staffdata->name != '') {{@$staffdata->name }} @else — @endif </span>
							</div>
						</div>
					</div>
					<div class="col-md-7 col-sm-7 col-xs-12">
						<div class="prdetails">
							<!-- <div>
								<label>Spots Left:</label>
								<span> </span>
							</div> -->
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
										<div class="activityselect3 special-date">
											<input type="text" name="actfildate_forcart" id="actfildate_forcart" placeholder="Date" class="form-control" autocomplete="off"  onchange="updatedetail({{$companyactid}},{{$serviceid}});" value="{{date('M-d-Y')}}">
											<i class="fa fa-calendar"></i>
										</div>
									</div>
									<!-- <div class="col-md-6 col-sm-6 col-xs-6">
										<select id="actfiloffer_forcart" name="actfiloffer_forcart" class="form-control activityselect1" onchange="updateparticipate({{$companyactid}},{{$serviceid}});">
											<option value="">Participant #</option>
										</select>
									</div> -->
								</div>
							</div>
						</div>
						@php $date = date('l').', '.date('F d,  Y'); @endphp 
						<div id="updatefilterforcart">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="choose-calendar-time">
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<h3 class="date-title">{{$date}}</h3>
									
											<label>Step: 1 </label> <span class="">Select Category</span>
											<select id="selcatpr<?php echo $serviceid;?>" name="selcatpr{{$serviceid}}" class="price-select-control" onchange="changeactsession('{{$serviceid}}','{{$serviceid}}',this.value,'book','simple')">
												<?php $c=1;  
													if (!empty($sercate)) { 
														foreach ($sercate as  $sc) {
															echo '<option value="'.$sc['id'].'">'.$sc['category_title'].'</option>';
															$c++;
														}
													}
												?>
											</select>
											
											<label>Step: 2 </label> <span class=""> Select Membership Type</span>
											<div id="memberoption">
												<select id="actfilmtype{{$serviceid}}" name="actfilmtype" class="form-control activityselect1 instant-detail-membertypre" onchange="chngemember({{$serviceid}});">												<?php echo $mbox; ?>
												</select>
											</div>
											<label>Step: 3 </label> <span class="">Select Price Option</span>
											<div class="priceoption" id="pricechng{{$serviceid}}{{$serviceid}}">
												<select id="selprice{{$serviceid}}" name="selprice{{$serviceid}}" class="price-select-control" onchange="changeactpr('{{$serviceid}}',this.value,'{{@$spot_avil}}','book','{{$serviceid}}')">
													<?php echo $selectval; ?>
												</select>
											</div>	
										</div>
										<?php $bschedule = BusinessActivityScheduler::where('serviceid', $serviceid)->orderBy('id', 'ASC')->where('category_id',@$sercatefirst['id'])->where('end_activity_date','>=',date('Y-m-d'))->whereRaw('FIND_IN_SET("'.date("l").'",activity_days)')->get();
										$bschedulefirst = BusinessActivityScheduler::where('serviceid', $serviceid)->orderBy('id', 'ASC')->where('category_id',@$sercatefirst['id'])->where('end_activity_date','>=',date('Y-m-d'))->whereRaw('FIND_IN_SET("'.date("l").'",activity_days)')->first();
										?>
										<div class="col-md-6 col-sm-6 col-xs-12 membership-opti">
											<div class="membership-details">
												<h3 class="date-title">Booking Details</h3>
												<label>Step: 4 </label> <span class=""> Select Time</span>
												<div class="row" id="timeschedule">
													<?php $i=1;$totalquantity = 0;?>
													@if(!empty(@$bschedule) && count(@$bschedule)>0)
													@foreach(@$bschedule as $bdata)
													<?php $SpotsLeftdis = 0; ?>
													<?php $SpotsLeft = UserBookingDetail::where('act_schedule_id',$bdata['id'])->whereDate('bookedtime', '=', date('Y-m-d'))->get();
														$totalquantity = 0;
														foreach($SpotsLeft as $data){
															$item = json_decode($data['qty'],true);
															if($item['adult'] != '')
									                            $totalquantity += $item['adult'];
									                        if($item['child'] != '')
									                            $totalquantity += $item['child'];
									                        if($item['infant'] != '')
									                            $totalquantity += $item['infant'];
														}
													if( $bdata['spots_available'] != ''){
        												$SpotsLeftdis = $bdata['spots_available'] - $totalquantity;
        											} ?>
													<div class="col-md-6">
														<div class="donate-now">
															<input type="radio" id="{{$bdata['id']}}" name="amount" value="{{$bdata['shift_start']}}" onclick="addhiddentime({{$bdata['id']}},{{$serviceid}});" 
															@if($i==1) @if($SpotsLeftdis != 0)  checked  <?php $i++;?> @endif @endif/>
																<label for="{{$bdata['id']}}" >{{$bdata['shift_start']}}</label>
																<p class="end-hr">@if($SpotsLeftdis == 0) Sold Out @else {{$SpotsLeftdis}}/{{$bdata['spots_available']}} Spots Left @endif </p>
														</div>
													</div>
													@endforeach
													@else 
														<p class="notimeoption">No time option available Select category to view available times</p>
															
													@endif
												</div>
												<div id="book<?php echo $service["id"].$service["id"]; ?>">
													
													<div class="price-cat">
														<label>Category:</label>
														@if(@$sercatefirst['category_title'] != '')
															<span>{{@$sercatefirst['category_title']}}</span>
														@endif
													</div>
													
													
													<div id="timeduration">
														<label>Duration:</label>
														@if($timedata != '')
															<span>{{$timedata}}</span>
														@endif
													</div>
													
													<div>
														<label>Price Title:</label>
														@if(@$servicePrfirst['price_title'] != '')
															<span>{{@$servicePrfirst['price_title']}}</span>
														@endif	
													</div>
														
													<div>
														<label>Price Option:</label>
														@if(@$servicePrfirst['pay_session'] != '')
														<span>{{@$servicePrfirst['pay_session']}} Session</span>@endif
													</div>
													
													
													<div>
														<label>Membership:</label>
														@if(@$servicePrfirst['membership_type'] != '')
														<span>{{@$servicePrfirst['membership_type']}} @if(@$servicePrfirst['is_recurring_adult'] == 1) (Recurring) @endif</span>
														@endif
													</div>
													
													<div class="personcategory" >
														<span>Adults x {{$adult_cnt}} = ${{$adult_price}}</span>
														<span>Kids x {{$child_cnt}} = ${{$child_price}}</span>
														<span>Infants x {{$infant_cnt}} = ${{$infant_price}}</span>
													</div>
													
													<div>
														<label>Total </label>
														@if(@$total_price_val != '')
															<span id="totalprice">
														${{@$total_price_val}} USD</span>
														@else
															<span id="totalprice">
														$0 USD</span>
														@endif
													</div>
												</div>
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
									<input type="hidden" name="time_hidden" id="time_hidden{{$serviceid}}{{$serviceid}}" @if($timedata != '' ) value="{{$timedata}}" @endif>
									<input type="hidden" name="sportsleft_hidden" id="sportsleft_hidden{{$serviceid}}{{$serviceid}}" value="{{$Totalspot}}">

									<input type="hidden" name="memtype_hidden" id="memtype_hidden{{$serviceid}}{{$serviceid}}" @if(@$servicePrfirst['membership_type'] != '') value="{{@$servicePrfirst['membership_type'] }}@if(@$servicePrfirst['is_recurring_adult'] == 1) (Recurring) @endif" @endif>

									<form method="post" action="/addtocart" id="{{$serviceid}}">
										@csrf
										<input type="hidden" name="pid" value="{{$serviceid}}"  />
										<input type="hidden" name="persontype" id="persontype" value="adult"/>
										<input type="hidden" name="quantity" id="pricequantity{{$serviceid}}{{$serviceid}}" value="1" class="product-quantity"/>

										<input type="hidden" name="aduquantity" id="adupricequantity" value="{{$adult_cnt}}" class="product-quantity"/>
										<input type="hidden" name="childquantity" id="childpricequantity" value="{{$child_cnt}}" class="product-quantity"/>
										<input type="hidden" name="infantquantity" id="infantpricequantity" value="{{$infant_cnt}}" class="product-quantity"/>

										<input type="hidden" name="cartaduprice" id="cartaduprice" value="{{$adult_price}}" class="product-quantity"/>
										<input type="hidden" name="cartchildprice" id="cartchildprice" value="{{$child_price}}" class="product-quantity"/>
										<input type="hidden" name="cartinfantprice" id="cartinfantprice" value="{{$infant_price}}" class="product-quantity"/>

									   <input type="hidden" name="pricetotal" id="pricetotal{{$serviceid}}{{$serviceid}}" value="{{$total_price_val}}" class="product-price"/>
									   <input type="hidden" name="price" id="price{{$serviceid}}{{$serviceid}}" value="{{$total_price_val}}" class="product-price" />
										<input type="hidden" name="session" id="session{{$serviceid}}" value="{{@$servicePrfirst['pay_session']}}" />
										<input type="hidden" name="priceid" value="{{$priceid}}" id="priceid{{$serviceid}}" />
										<input type="hidden" name="actscheduleid" value="{{@$bschedulefirst->id}}" id="actscheduleid{{$serviceid}}" />
										<input type="hidden" name="sesdate" value="{{date('Y-m-d')}}" id="sesdate{{$serviceid}}" />
										<input type="hidden" name="cate_title" value="{{@$sercatefirst['category_title']}}" id="cate_title{{$service['id']}}{{$service['id']}}" />
										
										<div id="cartadd">
									
										@if($totalquantity >= @$bschedulefirst->spots_available && @$bschedulefirst->spots_available !=0)
											<a href="javascript:void(0)" class="btn btn-addtocart mt-10" style="pointer-events: none;" >Sold Out</a>
										@else
                                            @if( @$total_price_val !='' && $timedata != '')
												<div id="addcartdiv">
													<div class="btn-cart-modal">
														<input type="submit" value="Add to Cart" class="btn btn-black mt-10"  id="addtocart"/>
													</div>
													<div class="btn-cart-modal instant-detail-booknow">
														<input type="submit" value="Book Now" class="btn btn-red mt-10" id="booknow">
													</div>
												</div>
										  	@endif
										@endif
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>  
				</div>

				<h3 class="subtitle details-sp">Things To Know </h3>
				
				<h3 class="subtitle details-sp">Know Before You Go</h3>
				@if($houserules != '')
					<p>{{$houserules}}</p>
				@else
					<p>No Details Found</p>
				@endif
				
				<h3 class="subtitle details-sp">Cancelation Policy</h3>
				@if($cancelation != '')
					<p>{{$cancelation}}</p>
				@else
					<p>No Details Found</p>
				@endif
				
				<h3 class="subtitle details-sp">Safety and Cleaning Procedures</h3>
				@if($cleaning != '')
					<p>{{$cleaning}}</p>
				@else
					<p>No Details Found</p>
				@endif
				
				<div class="row">
					<div class="col-md-9">
						<div class="widget mx-sp">
							<h4 class="widget-title">Provider: {{$companyname }}</h4>
							<div class="widget" style="height:300px">
								<div class="mysrchmap">
									<div id="map_canvas" style="position: absolute; top: 0; right: 0; bottom: 0; left: 0;"></div>
								</div>
								<div class="maparea">
									<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24176.251535935986!2d-73.96828678121815!3d40.76133318281456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258c4d85a0d8d%3A0x11f877ff0b8ffe27!2sRoosevelt%20Island!5e0!3m2!1sen!2sin!4v1620041765199!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
								</div>
							</div>
							<?php   
								$locations = []; 
		                        if($companylat != '' || $companylon  != ''){
		                          //  $lat = $companylat + ((floatVal('0.' . rand(1, 9)) * 1) / 10000);
		                    		//$long = $companylon + ((floatVal('0.' . rand(1, 9)) * 1) / 10000);
									//$lat = 40.777671;
									//$long = -73.9839877;
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
				
				@if(@$staffdata != '') 
				<?php 
					if (@$staffdata->image != "") {
				    	if (File::exists(public_path("/uploads/profile_pic/thumb/" . @$staffdata->image))){
				    		$profilePicact = url('/public/uploads/profile_pic/thumb/' . @$staffdata->image);
				    	}else{
				    		$profilePicact = url('/public/images/service-nofound.jpg');
				    	}
				    }else{ $profilePicact = url('/public/images/service-nofound.jpg'); }
	    		?>
				<div class="col-md-12 col-sm-12 col-xs-12 instructor-details">
					<div class="row">
						<div class="col-md-3 col-sm-3 col-xs-12">
							<div class="instructor-img">
								<img src="{{$profilePicact}}">
							</div>
						</div>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<div class="instructor-inner-details">
								<label>Instructor:</label>
								<span>{{@$staffdata->name}}</span>
							</div>
							<div>
								<p>{{@$staffdata->description}}</p>
							</div>
						</div>
					</div>
				</div>
				@endif 
				
				<div class="row" id="user_ratings_div{{$serviceid}}">
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
							<div>
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
								<input type="text" name="actfildate" id="actfildate{{$serviceid}}" placeholder="Date" class="form-control" onchange="actFilter({{$companyactid}},{{$serviceid}})" autocomplete="off" value="{{date('M-d-Y')}}">
								<i class="fa fa-calendar"></i>
							</div>
							<script>
								$( function() {
									$( "#actfildate{{$serviceid}}" ).datepicker( { 
										minDate: 0,
										changeMonth: true,
										changeYear:true,
							        	yearRange: "1960:2060"} );
								  } );
							</script>
						</div>
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
						<div id="filteroption" style="display: none">
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
		                            <select id="actfilmtype" name="actfilmtype" class="form-control activityselmtype" onchange="actFilter({{$companyactid}},{{$serviceid}})">
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
						@if(count($activities_search)>0)
						<div class="col-md-12 col-sm-12 col-xs-12">
							<h3 class="subtitle text-center">Other Activities Offered By This Provider</h3>
						</div>
						@endif
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
										else if( $service['service_type']=='classes' )	$service_type = 'Group Class'; 
										else if( $service['service_type']=='experience' ) $service_type = 'Experience'; 
									}
									$pricearr = [];
									$price_all = '';
									$ser_date = '';
									$price_allarray = BusinessPriceDetails::where('serviceid', $service['id'])->get();
									if(!empty($price_allarray)){
										foreach ($price_allarray as $key => $value) {
											if(date('l') == 'Saturday' || date('l') == 'Sunday'){
												$pricearr[] = $value->adult_weekend_price_diff;
											}else{
												$pricearr[] = $value->adult_cus_weekly_price;
											}
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


<div class="modal fade" id="Countermodal">
    <div class="modal-dialog counter-modal-size">
        <div class="modal-content">
           <div class="modal-header"> 
				<div class="closebtn">
					<button type="button" class="close close-btn-design" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
			</div>  
            <div class="modal-body conuter-body" id="Countermodalbody">
            </div>            
            <div class="modal-footer conuter-body">
                <button type="button" onclick="getbookdetails({{$sid}});" class="btn btn-primary rev-submit-btn">Save</button>
            </div>
    	</div>                                                                       
    </div>                                          
</div>

<div id="busireview" class="modal modalbusireview" tabindex="-1">
    <div class="modal-dialog rating-star" role="document">
        <div class="modal-content">
            <div class="modal-header" style="padding:10px 36px 10px 11px!important; text-align: right;min-height: 40px;">
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
	                        <input type="hidden" name="rating" id="rating" value="0">
                            <div class="rvw-overall-rate rvw-ex-mrgn">
								<span>Rating</span>
								<div id="stars" data-service="{{$sid}}" class="starrr" style="font-size:22px"></div>
							</div>
							<input type="text" name="rtitle{{$sid}}" id="rtitle{{$sid}}" placeholder="Review Title" class="inputs" />
	                    	<textarea placeholder="Write your review" name="review{{$sid}}" id="review{{$sid}}"></textarea>
	                        <input type="file" name="rimg{{$sid}}[]" id="rimg{{$sid}}" class="inputs" multiple="multiple" />
	                        <div class="reviewerro" id="reviewerro{{$sid}}"> </div>
	                    	<input type="button" onclick="submit_rating({{$sid}})" value="Submit" class="btn rev-submit-btn mt-10">
	                    	<script>
							 $('#stars').on('starrr:change', function(e, value){
								$('#rating').val(value);
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

<script>
$(document).ready(function() {
	$('.showphotos').on('click', function(e) {
		$('.firstfancyimg').click();
	});
});
</script>
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
            url: "{{url('/public/images/hoverout2.png')}}",
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
	    $('#adultcnt').prop('readonly', true);
		$(document).on('click','.adultplus',function(){
			$('#adultcnt').val(parseInt($('#adultcnt').val()) + 1 );
		});
    	$(document).on('click','.adultminus',function(){
			$('#adultcnt').val(parseInt($('#adultcnt').val()) - 1 );
			if ($('#adultcnt').val() <= 0) {
				$('#adultcnt').val(0);
			}
	    });

	    $('#childcnt').prop('readonly', true);
		$(document).on('click','.childplus',function(){
			$('#childcnt').val(parseInt($('#childcnt').val()) + 1 );
		});
    	$(document).on('click','.childminus',function(){
			$('#childcnt').val(parseInt($('#childcnt').val()) - 1 );
			if ($('#childcnt').val() <= 0) {
				$('#childcnt').val(0);
			}
	    }); 

	    $('#infantcnt').prop('disabled', true);
		$(document).on('click','.infantplus',function(){
			$('#infantcnt').val(parseInt($('#infantcnt').val()) + 1 );
		});
    	$(document).on('click','.infantminus',function(){
			$('#infantcnt').val(parseInt($('#infantcnt').val()) - 1 );
			if ($('#infantcnt').val() <= 0) {
				$('#infantcnt').val(0);
			}
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
	function getbookdetails(sid){
		$('#errordiv').html('');
		var aducnt = $('#adultcnt').val();
		var chilcnt = $('#childcnt').val();
		var infcnt = $('#infantcnt').val();
		var maxlengthval = $('#maxlengthval').val() ;
		maxlengthval = parseInt(maxlengthval);
		
		if(typeof(aducnt) == 'undefined'){
			aducnt = 0;
		}
		if(typeof(chilcnt) == 'undefined'){
			chilcnt = 0;
		}
		if(typeof(infcnt) == 'undefined'){
			infcnt = 0;
		}
		
		var totalcnt = parseInt(aducnt) + parseInt(chilcnt) + parseInt(infcnt);
	
		if(aducnt ==0 && chilcnt==0 && infcnt==0){
			$('#errordiv').html('Please Select participate');
			$('#cartadd').html('');
		}else if(maxlengthval == 0){
			$('#cartadd').html('<div id="cartadd"><a href="javascript:void(0)" class="btn btn-addtocart mt-10" style="pointer-events: none;">Sold Out</a></div>');
			$('#errordiv').html('Please Select another Category or Activity.');
			
		}else if(totalcnt > maxlengthval){
			$('#errordiv').html('Sports left only '+maxlengthval);
			$('#cartadd').html('<div id="addcartdiv"><a href="javascript:void(0)" class="btn btn-addtocart mt-10" style="pointer-events: none;" >Sold Out</a>');
		}else{
			var aduprice = $('#adultprice').val();
			var childprice = $('#childprice').val();
			var infantprice = $('#infantprice').val();
			var totalprice = 0;
			var totalpriceadult = 0;
			var totalpricechild = 0;
			var totalpriceinfant = 0; 
			if(typeof(aduprice) != "undefined" && aduprice != null){
				totalpriceadult = parseInt(aducnt)*parseInt(aduprice);
				if(aducnt != 0){
					$('#cartaduprice').val(aduprice);
				}else{
					$('#cartaduprice').val(0);
				}
			}

			if(typeof(childprice) != "undefined" && childprice != null){
				totalpricechild = parseInt(chilcnt)*parseInt(childprice);
				if(chilcnt != 0){
					$('#cartchildprice').val(childprice);
				}else{
					$('#cartchildprice').val(0);
				}
			}
			if(typeof(infantprice) != "undefined" && infantprice != null){
				totalpriceinfant = parseInt(infcnt)*parseInt(infantprice);
				if(infcnt != 0){
					$('#cartinfantprice').val(infantprice);
				}else{
					$('#cartinfantprice').val(0);
				}
			}

			var adult = '';
			var child = '';
			var infant = '';
			if(aducnt != 0){
				adult = '<span>Adults x '+aducnt+' = $'+totalpriceadult+'</span>';
			}

			if(chilcnt != 0){
				child = '<span>Kids x  '+chilcnt+' = $'+totalpricechild+'</span>';
			}

			if(infcnt != 0){
				infant = '<span>Infants x  '+infcnt+' = $'+totalpriceinfant+'</span>';
			}
			
			totalprice = parseInt(totalpriceadult)+parseInt(totalpricechild)+parseInt(totalpriceinfant);
			$('.personcategory').html(adult+child+infant);
			$('#totalprice').html('$'+totalprice+' USD');
			$('#adupricequantity').val(aducnt);
			$('#childpricequantity').val(chilcnt);
			$('#infantpricequantity').val(infcnt);

			$('#pricetotal'+sid+sid).val(totalprice);
			$("#Countermodal").modal('hide');
			$('#cartadd').html('<div id="addcartdiv"><div class="btn-cart-modal"><input type="submit" value="Add to Cart" class="btn btn-black mt-10"  id="addtocart"/></div><div class="btn-cart-modal instant-detail-booknow"><input type="submit" value="Book Now" class="btn btn-red mt-10" id="booknow"></div></div>');
		}
	}

	function addhiddentime(id,sid) {
		var actscheduleid = $('#actscheduleid'+sid).val(id);
		var pricetitleid = $('#selprice'+sid).val();
		var sesdate = $('#sesdate'+sid).val();
		/*alert(pricetitleid);*/
		var _token = $("input[name='_token']").val();
		$.ajax({
			url: "{{route('getmodelbody')}}",
			type: 'POST',
			data:{
				_token: _token,
				type: 'POST',
				pricetitleid:pricetitleid,
				serviceid:sid,
				actscheduleid:id,
				dateval:sesdate
			},
			success: function (response) {
				if(response != ''){
					var data = response.split('~~');
					$('#Countermodalbody').html(data[0]);
					$('#book'+sid+sid).html(data[1]);
					$('#cartadd').html('');
				}
			}
		});
		$('#priceid'+sid).val(pricetitleid);
		$('#Countermodal').modal('show');
	}

	function updateparticipate(cid,sid){
		var participate= $('#actfiloffer_forcart').val();
		$('.personcategory').html('<span>Adults x '+participate+' </span><span>Kids x 0</span><span>Infants x 0</span>');
		var price = 0;
		price =$('#price'+sid+sid).val();
		var totalprice  = price*participate;
		$('#totalprice').html('$'+totalprice+' USD');
		if(totalprice != 0)
		{
			$('#pricetotal'+sid+sid).val(totalprice);
		}
		$('#pricequantity'+sid+sid).val(participate);
	}

	function updatedetail(cid,sid){
		var actdate = $('#actfildate_forcart').val();
		var serviceid =sid;
		/*$('#pricequantity'+sid+sid).val(Participant)
		$('#sesdate'+sid+sid).val(date);*/
		var _token = $("input[name='_token']").val();
		$.ajax({
			url: "{{route('act_detail_filter_for_cart')}}",
			type: 'POST',
			data:{
				_token: _token,
				type: 'POST',
				actdate:actdate,
				serviceid:serviceid,
				companyid:cid,
			},
			success: function (response) {
				if(response != ''){
					$('#updatefilterforcart').html(response);
					$('#sesdate'+sid).val(actdate);
				}else{
					$('#updatefilterforcart').html('');
				}
			}
		});
	}

	function actFilter(cid,sid)
	{   
		var actdate=$('#actfildate'+sid).val();
		var actfilparticipant=$('#actfilparticipant'+sid).val();
		var actoffer=$('#actfiloffer'+sid).val();
		var actloc=$('#actfillocation'+sid).val();
		var actfilmtype=$('#actfilmtype').val();
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
		$( "#actfildate_forcart" ).datepicker( { 
			minDate: 0,
			changeMonth: true,
			changeYear:true,
        	yearRange: "1960:2060"
		} );
	} );
</script>
<script>
	$( function() {
		$( "#actfildate0" ).datepicker( {
		 	minDate: 0,
			changeMonth: true,
			changeYear:true,
        	yearRange: "1960:2060"
        } );
	} );
</script>

<script type="text/javascript">	
	function submit_rating(sid)
	{
		@if(Auth::check())
		//var formData = $("#sreview"+sid).serialize();
		var formData = new FormData();
		var rating=$('#rating').val();
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
						$('#rating').val(' ');
						$('#review').val(' '); $('#rtitle'+sid).val(' ');
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
			$('#rating').val(' ');
			$('#review').val(' ');
			return false;
		}
		@else
			$('#reviewerro'+sid).show(); 
			$('#reviewerro'+sid).html('Please login in your account to review this activity');
			$('#rating').val(' ');
			$('#review').val(' ');
			return false;
		@endif	
	}

	function changeactpr(aid,val,part,div,maid)
	{
		/*var n = val.split('!^');
	    var datan = '';
	    var session = '';
	    var id = '';
	    var pr1 = 0;
	    var price_title = '—';
	    var memtype_hidden = '';
	    var persontype = '';
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
	        if(datan[2] != ''){
	          	persontype = datan[2];
	            $('#persontype').val(datan[2]);
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
		var bookdata ='';
		if(category_title != ''){
			bookdata += '<div class="price-cat"><label>Category: </label><span> '+ category_title +'</span></div>';
		}
		if(time != ''){
			bookdata += '<div><label>Duration: </label><span>'+ time +'</span></div>';
		}
		if(price_title != ''){
			bookdata += '<div><label>Price Title: </label><span>'+ price_title+'</span></div>';
		}
		if(session != ''){
			bookdata += '<div><label>Price Option: </label><span>'+session+' Session</span></div>';
		}

		if(session != ''){
			bookdata += '<div><label>Membership: </label><span> '+memtype_hidden+'</span></div><div class="personcategory"><span>Adults x 1</span><span>Kids x 0</span><span>Infants x 0</span></div>';
		}
		if(pr1 !=''){
			bookdata += '<div><label>Total </label><span id="totalprice">$'+pr1+' USD</span></div>';
		}
		bookdata += '</div>';

		if(div=='book'){
			$('#book'+maid+aid).html(bookdata);
			$('#pricequantity'+maid+aid).val(qty);
			$('#price'+maid+aid).val(pr);
			$('#pricetotal'+maid+aid).val(pr);
			$('#priceid'+aid).val(id);
		}

		else if (div=='bookmore'){
			console.log(aid);
			$('#bookmore'+maid+aid).html(bookdata);
			$('#pricebookmore'+maid+aid).val(pr);
			$('#priceid'+aid).val(id);
		}

		else if (div=='bookajax'){
			$('#bookajax'+maid+aid).html(bookdata);
			$('#pricebookajax'+maid+aid).val(pr);
			$('#pricequantity'+maid+aid).val(qty);
			$('#priceid'+aid).val(id);	
		}
		$("#actfiloffer_forcart option:selected").prop("selected", false);*/
	}

	function chngemember(sid) {
		var actfilmtype = $('#actfilmtype'+sid).val();
		var catid = $('#selcatpr'+sid).val();
		$.ajax({
			url: "{{route('pricemember')}}",
			type: 'POST',
			xhrFields: {
				withCredentials: true
		    },
			data:{
				_token: '{{csrf_token()}}',
				type: 'POST',
				mtype:actfilmtype,
                sid:sid,
                catid:catid,
			},

			success: function (response) { /*alert(response);*/
				$("#pricechng"+sid+sid).html(response);
				var selval = $("#selprice"+sid).val();
				$("#priceid"+sid).val(selval);
			}
		});
	}

	function changeactsession(main,aid,val,div,simple)
	{   
	   /* alert('hii');*/
	    var price_title = $('#price_title_hidden'+main+aid).val();
	    var sesdate = $('#sesdate'+aid).val();
	    var time = $('#time_hidden'+main+aid).val();
	    var sportsleft = $('#sportsleft_hidden'+main+aid).val();
	    var pricequantity = $('#pricequantity'+main+aid).val();
	    if(div =='book'){
	        var price = $('#price'+main+aid).val();
	    }else if (div =='bookmore'){
	        var price = $('#pricebookmore'+main+aid).val();
	    }else{
	        var price = $('#pricebookajax'+main+aid).val();   
	    }

	    var session = $('#session'+main+aid).val();
		if(aid != '')
		{
			$.ajax({
				url: "{{route('pricecategory')}}",
				type: 'POST',
				xhrFields: {
					withCredentials: true
			    },
				data:{
					_token: '{{csrf_token()}}',
					type: 'POST',
					actid:aid,
					catid:val,
	                sid:main,
	                div:div,
	                filtertype:simple,
	                sesdate:sesdate,
				},

				success: function (response) { /*alert(response);*/
					var dat = response.split('~~~~~~~~');
					var bookdata='';
					var catedata='';
					var timedata='';
					var cattitle='';
					var timedata12='';
					var pricelistdata='';
					var memberoption='';
					
					if(dat[0] != ''){
						box = dat[0].split('^^');
						pricelistdata = box[0];
						memberoption = box[1];
					}
					// alert(pricelistdata);
					var catedata = dat[1].split('****');
					if(catedata[0] != ''){
						bookdata = catedata[0];
					}
					/*alert(catedata[1]);*/
					if(catedata[1] != ''){
						dt = catedata[1].split('!!~');
						timedata = dt[0];
						cdata = dt[1].split('*^');
						cattitle = cdata[0];
						getval = cdata[1].split('^~^');
						setime = getval[0];
						id= getval[1];
					}
					$("#pricechng"+main+aid).html(pricelistdata);
					$("#memberoption").html(memberoption);
					if(div =='book'){
	                    $('#book'+main+aid).html(bookdata);
	                }else if (div =='bookmore'){
	                    $('#bookmore'+main+aid).html(bookdata);
	                }else{
	                    $('#bookajax'+main+aid).html(bookdata);
	                }

	                if(cattitle != ''){
	                    $('#cate_title'+main+aid).val(cattitle);
	                }
	                if(timedata == 'no' || timedata == ''){
	            	 	$('#addcartdiv').html('');
	            	 	$('#timeschedule').html(setime);
	            	}else{
	            		
	            		$('#timeschedule').html(setime);
	            		$('#time_hidden'+main+aid).val(timedata);
						$('#addcartdiv').html('<div class="btn-cart-modal">	<input type="submit" value="Add to Cart" class="btn btn-black mt-10"  id="addtocart"/></div><div class="btn-cart-modal instant-detail-booknow"><input type="submit" value="Book Now" class="btn btn-red mt-10" id="booknow"></div>');
	            	}
	            	$('#actscheduleid'+aid).val(id);
	            	$("#actfiloffer_forcart option:selected").prop("selected", false);
				}
			});
		}
	}
</script>
<script src="/public/js/ratings.js"></script>

@endsection

