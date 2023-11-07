@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')
@section('content')
<style type="text/css">
/*Prevent text selection*/
span{
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
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
	use App\{UserBookingDetail,BusinessServices,BusinessService,BusinessPriceDetails,BusinessPriceDetailsAges,BusinessServiceReview,BusinessTerms,User,BusinessActivityScheduler,BusinessServicesFavorite,CompanyInformation,BusinessReview,BusinessStaff};
	use Carbon\Carbon;

	$sid = $service->id;

    $comp_data = $service->company_information;
    $businessSp = $comp_data->business_service;
    $languages = (!empty($businessSp['languages'])) ? $businessSp['languages'] : '';

	$comp_address = $comp_data->company_address();
	$address = '';
	$address .= ($comp_data->city) ? ', ' . $comp_data->city : '';
	$address .= ($comp_data->country) ? ', ' . $comp_data->country : '';
	$address .= ($comp_data->zip_code) ? ' ' . $comp_data->zip_code : '';

	if($service->instructor_id != ''){
		$staffdata = $service->BusinessStaff;
	    $profilePicact = $staffdata->profile_pic_url ?? url('/public/images/service-nofound.jpg');
	}else{
		$staffdata = $comp_data;
		$profilePicact = url('/uploads/profile_pic/thumb/'.$staffdata->logo);
	}

	$companyname = $comp_data->dba_business_name;
	$companyid = $comp_data->id;

	$BusinessTerms = BusinessTerms::where('cid', $comp_data->id)->first();
	$cancelation = !empty($BusinessTerms) ? $BusinessTerms->cancelation : '';
	$cleaning = !empty($BusinessTerms) ? $BusinessTerms->cleaning : '';

	$companyid = $service->cid;
	$redlink = str_replace(" ","-",$companyname)."/".$companyid;

	$pro_pic1 = '';
    $pro_pic = $service->profile_pic;
	if(!empty($pro_pic)){
		$pro_pic1 = (str_contains($pro_pic, ',')) ? explode(',', $pro_pic) : [$pro_pic];
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

   	<div class="container">
	   	<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="modal-banner modal-banner-sp galleryfancy">
					@php $i=0; $newary= []; @endphp
					@if(is_array(@$pro_pic1) && !empty(@$pro_pic1))
                    	@foreach(@$pro_pic1 as $img) 
                    		@if(!empty($img) && Storage::disk('s3')->exists($img))
                    	 		@php $newary [] = $img; @endphp
                    	 	@endif
                    	@endforeach
                        @foreach(@$pro_pic1 as $img)
                            @if(!empty($img) && Storage::disk('s3')->exists($img))
	                            <div @if(count(@$newary) == 1) class="single-banner" @elseif(count(@$newary) == 2) class="dual-banner" @elseif(count(@$newary) == 3) class="three-banner"  @else class="bannar-size" @endif @if($i>3) style="display:none" @endif>
			                    	<a href="{{Storage::URL($img)}}" title=""  class="dimgfit firstfancyimg" data-fancybox="gallery">
									<img src="{{Storage::URL($img)}}">
									@if($i==3) <button class="showall-btn showphotos" ><i class="fas fa-bars"></i>Show all photos</button> @endif
			                        </a>
								</div>	                            
							@endif
							@php $i++; @endphp
                        @endforeach
	                @else
	                	@if(!empty($pro_pic1) &&  Storage::disk('s3')->exists($pro_pic1))
	                	<div class="single-banner">
							<a href="{{Storage::URL($pro_pic1)}}" title=""  class="dimgfit firstfancyimg" data-fancybox="gallery">
								<img src="{{Storage::URL($pro_pic1)}}">
				            </a>
						</div>
                        @endif
                    @endif
				</div>
			</div>

			<div class="col-lg-8 col-xs-12">
				<h3 class="details-titles">{{@$service['program_name']}}</h3>
				<p class="caddress"> <b> Provider: </b> <a href="{{ Config::get('constants.SITE_URL') }}/businessprofile/{{$redlink}}"> {{ $companyname }} </a>{{$address }}
				</p>
				<div class="service-review-desc">
					<div class="provider_review">
					<?php
						$reviews_count = BusinessServiceReview::where('service_id', $sid)->count();
						$reviews_sum = BusinessServiceReview::where('service_id', $sid)->sum('rating');
						
						$reviews_avg=0;
						if($reviews_count>0)
						{ 
							$reviews_avg = round($reviews_sum/$reviews_count,2); 
						}
					?>
						<p class="mb-10"> {{$reviews_count}} Reviews </p> 
						<div class="rattxt activered"><i class="fa fa-star" aria-hidden="true"></i> {{$reviews_avg}} </div>
					</div>
				</div>
				<h3 class="subtitle details-sp"> Description </h3>
				<p>{{ @$service['program_desc'] }}</p>
				<h3 class="subtitle details-sp"> Program Details: </h3>
				<div class="row">
					<div class="col-md-5 col-sm-5 col-xs-12">
						<div class="prdetails">
							<div class="mb-10">
								<label>Service Type: </label>
								<span> {{@$service['select_service_type']}}  </span>
							</div>
							<div class="mb-10">
								<label>Service For: </label>
								<span> {{@$service['activity_for']}}  </span>
							</div>
							<div class="mb-10">
								<label>Language:</label>
								<span> {{@$languages}}</span>
							</div>
							<div class="mb-10">
								<label>Instructor:</label>
								<span>@if(@$staffdata != '') {{@$staffdata->full_name}}  @else "N/A" @endif </span>
							</div>
						</div>
					</div>
					<div class="col-md-7 col-sm-7 col-xs-12">
						<div class="prdetails">
							<div class="mb-10">
								<label>Activity: </label>
								<span>{{@$service['sport_activity']}}</span>
							</div>
							<div class="mb-10">
								<label>  Age: </label>
								<span>{{@$service['age_range'] }} </span>
							</div>
							<div class="mb-10">
								<label> Skill Level: </label>
								<span>{{@$service['difficult_level']}} </span>
							</div>
							<div class="mb-10">
								<label>  Activity Location: </label>
								<span>{{@$service['activity_location'] }}</span>
							</div>
						</div>
					</div>
				</div>

				<h3 class="subtitle details-sp font-32 mt-20">Things To Know </h3>
				
				<h3 class="subsubtitle details-sp">Know Before You Go</h3>
				<p class="mb-20">@if($service['know_before_you_go'] != '') <?php echo nl2br($service['know_before_you_go']);?> @else No Details Found @endif</p>

				<h3 class="subsubtitle details-sp">Cancelation Policy</h3>
				<p class="mb-20">@if($cancelation != '') <?php echo nl2br($cancelation);?> @else No Details Found @endif</p>

				<h3 class="subsubtitle details-sp">Safety and Cleaning Procedures</h3>
				<p class="mb-20">@if($cleaning != '') <?php echo nl2br($cleaning);?> @else No Details Found @endif</p>
				
				
				<div class="row">
					<div class="col-md-9">
                    <h3 class="subtitle details-sp mt-20">Location</h3>
						<div class="widget mx-sp">
							<h4 class="widget-title">Provider: {{$companyname }}</h4>
							<div class="widget" style="height:300px">
								<div class="mysrchmap">
									<div id="map_canvas" style="position: absolute; top: 0; right: 0; bottom: 0; left: 0;"></div>
								</div>
								<div class="maparea"></div>
							</div>
							<?php   
								$locations = []; 
		                        if($comp_data->latitude != '' || $comp_data->longitude  != ''){
									$lat = $comp_data->latitude + ((floatVal('0.' . rand(1, 9)) * 1) / 10000);
									$long = $comp_data->longitude + ((floatVal('0.' . rand(1, 9)) * 1) / 10000);
		                    		$a = [$companyname, $lat, $long, $companyid, $comp_data->logo];
		                            array_push($locations, $a);
								}
								
							?>
							<div class="map-info">
                            	@if(@$comp_address != '')
								<span>
									<i class="fas fa-map-marker-alt map-fa"></i>
									<p>{{$comp_address}}</p>
								</span>
                                @endif
                                @if(@$comp_data->contact_number != '')
								<span>
									<i class="fas fa-phone-alt map-fa"></i>
									<p>{{$comp_data->contact_number}}</p>
								</span>
                                @endif
                                @if(@$comp_data->email != '')
								<span>
									<i class="fa fa-envelope map-fa"></i>
									<p>{{$comp_data->email}}</p>
								</span>
                                @endif
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-12 col-sm-12 col-xs-12 instructor-details @if(@$staffdata != '')  d-none @endif ">
					<div class="row">
						<div class="col-md-3 col-sm-3 col-xs-12">
							<div class="instructor-img">
								<img src="{{$profilePicact}}">
							</div>
						</div>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<div class="instructor-inner-details">
								<label>Instructor:</label>
								<span>{{@$staffdata->full_name}}</span>
							</div>
							<div>
								<p>{{@$staffdata->bio}}</p>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row" id="user_ratings_div{{$sid}}">
					<div class="col-md-12 col-xs-12">
						<h3 class="subtitle mt-50">Submit A Review </h3>
					</div>
					<div class="col-md-8 col-sm-8 col-xs-12"> 
						<h3 class="subtitle1"> 
							<div class="row">
								<div class="col-md-3 col-sm-2"> Reviews: </div>
								<div class="col-md-9 col-sm-10">
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

									$business_reviews_avg = $business_reviews_per= $reviews_avg = $reviews_per=0;
									if($business_reviews_count>0)
									{ 
										$business_reviews_avg = round($business_reviews_sum/$business_reviews_count,2); 
										$business_sum_of_rating = $business_reviews_count*5;
										$business_totalRating = $business_reviews_avg * $business_reviews_count;
										$business_reviews_per = ($business_totalRating/$business_sum_of_rating)*100;
									}

									$reviews_count = BusinessServiceReview::where('service_id', $sid)->count();
									$reviews_sum = BusinessServiceReview::where('service_id', $sid)->sum('rating');
									
									if($reviews_count>0)
									{ $reviews_avg = round($reviews_sum/$reviews_count,2); 
										$sum_of_rating = $reviews_count*5;
										$totalRating = $reviews_avg * $reviews_count;
										$reviews_per = ($totalRating/$sum_of_rating)*100;
									}
								?>
									<p class="mb-10"> {{$reviews_count}} Reviews </p> 
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
									$reviews_people = BusinessServiceReview::where('service_id', $sid)->orderBy('id','desc')->limit(6)->get(); 
								?>
	                            @if(!empty($reviews_people))
	                                @foreach($reviews_people as $people)
	                                	<?php $userinfo = User::find($people->user_id); ?>
	                                    <a href="<?php echo config('app.url'); ?>/userprofile/{{@$userinfo->username}}" target="_blank" title="{{@$userinfo->firstname}} {{@$userinfo->lastname}}">
	                                        @if(File::exists(public_path("/uploads/profile_pic/thumb/".@$userinfo->profile_pic)))
	                                        <img src="{{ url('/public/uploads/profile_pic/thumb/'.@$userinfo->profile_pic) }}" alt="{{@$userinfo->firstname}} {{@$userinfo->lastname}}">
	                                        @else
	                                            <?php
	                                            $pf=substr(@$userinfo->firstname, 0, 1).substr(@$userinfo->lastname, 0, 1);
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
	    							$reviews = BusinessServiceReview::where('service_id', $sid)->get();
	    						?>
	                        	@if(!empty($reviews))
	                                @foreach($reviews as $review)
	                                <?php $userinfo = User::find($review->user_id); ?>
								<div class="ser-rev-user">
										<div class="col-md-2 col-sm-2 col-xs-3 pl-0 pr-0">
											@if(File::exists(public_path("/uploads/profile_pic/thumb/".@$userinfo->profile_pic)))
	                                            <img class="rev-img" src="{{ url('/public/uploads/profile_pic/thumb/'.@$userinfo->profile_pic) }}" alt="{{@$userinfo->firstname}} {{@$userinfo->lastname}}">
	                                        @else
	                                            <?php
	                                            $pf=substr(@$userinfo->firstname, 0, 1).substr(@$userinfo->lastname, 0, 1);
	                                            echo '<div class="reviewlist-img-text"><p>'.$pf.'</p></div>'; ?>
	                                        @endif
										</div>
										<div class="col-md-10 col-sm-10 col-xs-9 pl-0">
											<h4> {{@$userinfo->firstname}} {{@$userinfo->lastname}}
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
								@endforeach
	        					@endif
							</div>
						</div>
					</div>
				</div>	
			</div>	
				
	        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            	<h3 class="subtitle details-sp mb-20 mtxt-cnter text-center" id="check_availability"> Check Availability </h3>
            	
            	<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="book-instantly mb-20 text-center">
							<a class="font-red"> Book Instantly  </a>
							<span class="book-tool-tip" data-toggle="tooltip" data-placement="top" title="This provider allows you to make booking with them Immediately.">
								<i class="fas fa-info"></i>
							</span>
						</div>
					</div>
				</div>
				<div class="activered text-center mb-10" id="spoterror"></div>
            	<div class="mainboxborder">	
					<div class="row">

						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="">
								<h3 class="date-title mt-10 mb-10"></h3>
								<label class="mb-10">Step: 1 </label> <span class="">Select Date</span>

								<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="activityselect3 special-date mb-20">
											<input type="text" name="actfildate_forcart" id="actfildate_forcart" placeholder="Date" class="form-control" autocomplete="off"  onchange="updatedetail({{$companyid}},{{$sid}},'date','');" >
											<i class="fa fa-calendar"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						@php 
							$date = date('l').', '.date('F d,  Y'); 
							$totalquantity = 0;
						@endphp 
						<div id="updatefilterforcart">
						</div>
					</div>  
				</div>
	        </div>	

	        <div class="col-md-12 col-xs-12 mb-80">
            	@if(count($activities_search)>0)
					<div class="col-md-12 col-sm-12 col-xs-12">
						<h3 class="subtitle text-center mtb-30">Other Activities Offered By This Provider</h3>
					</div>
				@endif
            	<div class="modal-sidebox">
					<div class="row">
						<div class="col-md-5 col-sm-12 col-xs-12">
                        	<div class="col-md-12 col-xs-12">
							<div class="modal-filter-instant morefilter">
								<p>More Filters &nbsp; <i class="fas fa-filter"></i></p>
							</div>
                            </div>
						
                        @php 
							$actoffer = BusinessServices::where('cid',$companyid)->groupBy('sport_activity')->get()->toArray();
						@endphp
						<div class="col-md-6 col-sm-6 col-xs-6">
							<div class="activityselect3 special-date dropdowns">
								<input type="text" name="actfildate" id="actfildate{{$sid}}" placeholder="Date" class="form-control" onchange="actFilter({{$companyid}},{{$sid}})" autocomplete="off" value="{{date('M-d-Y')}}">
								<i class="fa fa-calendar"></i>
							</div>
							<script>
								$( function() {
									$( "#actfildate{{$sid}}" ).datepicker( { 
										minDate: 0,
										changeMonth: true,
										changeYear:true,
							        	yearRange: "1960:2060"} );
								  } );
							</script>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<div class="dropdowns">
								<select id="actfiloffer{{$sid}}" name="actfiloffer" class="form-control activityselect1" onchange="actFilter({{$companyid}},{{$sid}})">
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
		                            <select id="actfillocation{{$sid}}" name="actfillocation" class="form-control activityselect2" onchange="actFilter({{$companyid}},{{$sid}})">
		                                <option value="">Location</option>
		                                <option value="Online">Online</option>
		                                <option value="At Business">At Business Address</option>
		                                <option value="On Location">On Location</option>
		                            </select>
		                        </div>
	                        </div>
	                        <div class="col-md-6 col-sm-6 col-xs-6">
	                        	<div class="dropdowns">
		                            <select id="actfilmtype" name="actfilmtype" class="form-control activityselmtype" onchange="actFilter({{$companyid}},{{$sid}})">
		                                <option value="">Membership Type</option>
		                                <option>Drop In</option>
		                                <option>Semester</option>
		                            </select>
		                        </div>
	                        </div>
	                        <div class="col-md-6 col-sm-6 col-xs-6">
	                        	<div class="dropdowns">
		                            <select id="actfilgreatfor{{$sid}}" name="actfilgreatfor" class="form-control activityselgreatfor" onchange="actFilter({{$companyid}},{{$sid}})">
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
		                            <select id="actfilbtype{{$sid}}" name="actfilbtype" class="form-control activityselbtype" onchange="actFilter({{$companyid}},{{$sid}})" >
		                                <option value="">Business Type</option>
		                                <option value="individual">Personal Trainer</option>
		                                <option value="classes">Classes</option>
		                                <option value="events">Events</option>
		                                <option value="experience">Experience</option>
	                            	</select>
	                            </div>
	                        </div>
	                        <div class="col-md-6 col-sm-6 col-xs-6">
	                        	<div class="dropdowns">
		                            <select id="actfilsType{{$sid}}" name="actfilsType" class="form-control activityselect5" onchange="actFilter({{$companyid}},{{$sid}})">
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
                        </div> <!--filteroption -->     
					</div><!-- col-5 -->
                    <div class="col-md-12 col-sm-12 col-xs-12">    
                        <div id="filtersearchdata">
	 						@forelse($activities_search as $service) 
	 							@php
			                        $companyData = CompanyInformation::where('id',$service['cid'])->first();
			                        $companyname = $companyData ? $companyData['dba_business_name'] : '';
						            $companycity = $companyData ? $companyData['city'] : '';
						            $companycountry = $companyData ? $companyData['country'] : '';

			                        $profilePic = $service->first_profile_pic();
			                        $profilePic =  Storage::disk('s3')->exists($profilePic) ? Storage::url($profilePic) : '/public/images/service-nofound.jpg';
			                     
			                     	$businessServiceReview = BusinessServiceReview::where('service_id', $service['id']);
									$reviews_avg = $businessServiceReview->count() >0 ? round($businessServiceReview->sum('rating')/$businessServiceReview->count(),2) :0 ;
									
									$redlink = str_replace(" ","-",$companyname)."/".$service['cid'];
									$service_type = $service->formal_service_types();
									
									$price_all = $service->min_price();
									
									$bookscheduler= '';
									$bookscheduler = App\BusinessActivityScheduler::where('serviceid', $service['id'])->orderBy('id', 'ASC')->first();
									$time = @$bookscheduler != '' ? @$bookscheduler->get_duration() : '';
								@endphp
								@if($loop->index < 3 && $time != '')
									<div class="col-md-4 col-sm-6 col-xs-12 ">
										<div class="find-activity">
											<div class="row">
												<div class="col-md-5 col-sm-5 col-xs-12">
													<div class="img-modal-left customer-details">
														<img src="{{ $profilePic }}" >
													</div>
												</div>
												<div class="col-md-7 col-sm-7 col-xs-12 activity-data">
													<div class="row">
														<div class="col-md-6 col-sm-6 col-xs-6">
															<div class="activity-inner-data">
																<i class="fas fa-star"></i>
																<span> {{$reviews_avg}} ({{$businessServiceReview->count()}})  </span>
															</div>
															@if($time != '')
																<div class="activity-hours">
																	<span>{{$time}}</span>
																</div>
															@endif
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6">
															<div class="activity-city">
																<span>{{$companycity}}, {{$companycountry}}</span>
																@if(Auth::check())
																 	@php
																		$favData = BusinessServicesFavorite::where('user_id',Auth::user()->id)->where('service_id',$service['id'])->first();              
																 	@endphp
																	<div class="serv_fav1" ser_id="{{$service['id']}}">
																		<a class="fav-fun-2" id="serfav{{$service['id']}}">
																			<i class="{{ !empty($favData) ? 'fas' : 'far' }} fa-heart"></i>
																	    </a>
																	</div>
																@else
																	<a class="fav-fun-2" href="{{ Config::get('constants.SITE_URL') }}/userlogin" ><i class="far fa-heart"></i></a>
																@endif
															</div>
														</div>
													</div>
													<div class="activity-information">
														<span>
															@if(Auth::check())
															    <a href="{{ Config::get('constants.SITE_URL') }}/businessprofile/{{ $redlink }}" target="_blank">
															@else
															    <a href="{{ Config::get('constants.SITE_URL') }}/userlogin" target="_blank">
															@endif
							                                    {{ $service['program_name'] }}</a></span>
														<p>{{ $service_type }} | {{ $service['sport_activity'] }}</p>
														<a class="showall-btn" href="{{route('activities_show',['serviceid'=>  $service['id']])}}">Book Now</a>
													</div>
													@if($price_all != '')
														<div>
															<span class="activity-time">From {!!$price_all!!}/Person</span>
														</div>
													@endif
												</div>
											</div>
										</div>
									</div>
								@endif
							@empty		
								<div class="col-md-4">
									<p class="noactivity"> There Is No Activity</p>
								</div>	
							@endforelse					
						</div>
					</div>
                       
				</div>
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

	<div class="modal fade " id="confirmredirection">
	    <div class="modal-dialog counter-modal-size">
	        <div class="modal-content">
	            <div class="modal-body conuter-body">
	            	<div class="row">
	            		<div class="col-lg-12">
                     		<h4 class="modal-title partcipate-model">Almost Done! Before we add this to the cart, would you like to add another person to this booking? </h4>
                    	</div>
                    </div>
                </div>          
        		<div class="modal-footer conuter-body">
        			<div class="btns-modal"> 
        			</div>
        		</div>
			</div>                                                                       
		</div>                                          
	</div>

	<div class="modal fade " id="ActivtityFail">
	    <div class="modal-dialog counter-modal-size">
	        <div class="modal-content">
	            <div class="modal-body conuter-body">
	            	<div class="row">
	            		<div class="col-lg-12">
                     		<h4 class="modal-title partcipate-model">You can't book this activity for today.Please add another time.</h4>
                    	</div>
                    </div>
                </div>
			</div>                                                                       
		</div>                                          
	</div>

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
	    	</div>                                                                       
	    </div>                                          
	</div>
</div>

<nav class="navbar navbar-default navbar-fixed-bottom hidden-lg visible-md visible-xs visible-sm book-now-skicky" style="background: none; border-top: none;">
  	<div class="container">
		<div class="col-xs-12">
	    	<p class="navbar-text navbar-right" style="text-align:center;">
	    	<a href="#check_availability" class="showall-btn sticky-book-now" href="http://lvh.me:8080/activities/get_started/events">Book Now</a>
	    	</p>
		</div>
  	</div>
</nav>

@include('layouts.footer')

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ env('MAP_KEY') }}&sensor=false"></script>


<script>

	$(function () {
	    $('[data-toggle="tooltip"]').tooltip();
	});

	$(document).ready(function() {
		$(document).on("click", "#btnaddcart", function(){
			$('#spoterror').html('');
			var timechk = $('#timechk').val();
			var totalQty = parseInt($('#totalQty').val());
			var maxQty = parseInt($('#maxQty').val());
			
			if(timechk == 1){
				if(totalQty == 0){
					$('#spoterror').html("Please select a participate.");
				}else if(totalQty > maxQty ){
					$('#spoterror').html("You have "+maxQty+" sports left.");
				}else{
					var form = $("#addtocartform");
			        var url = '{{route("addtocart")}}';
			        $.ajax({
			            type: "POST",
			            url: url,
			            data: form.serialize(),
			            success: function(data) {
			                if(data == 'no_spots'){
			                 	$('#spoterror').html("There Is No Spots left You Can't Add This Activity.");
			                }else{
			                	$(".btns-modal").html('<button type="button" class="addbusiness-btn-modal noborder" data-dismiss="modal">Add Another Person</button>     <a href="'+data+'" class=" addbusiness-btn-modal" id="redicttosuccess">Continue Add To Cart</a>');
			                	$('#confirmredirection').modal({ backdrop: 'static',keyboard: false});
			                }
			                $(".cartitmclass").load(location.href+" .cartitmclass>*","");
			            }
			        });
				}
		    }else{
		    	$('#ActivtityFail').modal('show');
		    }
		}); 

		$('.showphotos').on('click', function(e) {
			$('.firstfancyimg').click();
		});
	});

	$('.firstfancyimg').click(function(){
	  	$.fancybox.close();
	});
</script>

<script>
	$(document).ready(function () {
		var uniqueAids = {};
		$('#add-one').prop('readonly', true);
		$(document).on('click','.addonplus',function(){
			id = $(this).attr('aid');
			$('#add-one'+id).val(parseInt($('#add-one'+id).val()) + 1 );
			if (!uniqueAids[id]) {
		      	uniqueAids[id] = true; // Mark aid as unique
		    }

		    var commaSeparatedAids = Object.keys(uniqueAids).join(',');
		    $('#addOnServicesId').val(commaSeparatedAids);
		    setAddOnServiceTotal();
		});
    	$(document).on('click','.addonminus',function(){
    		id = $(this).attr('aid');
    		if (!uniqueAids[id]) {
		      	uniqueAids[id] = true; // Mark aid as unique
		    }

			$('#add-one'+id).val(parseInt($('#add-one'+id).val()) - 1 );
			if ($('#add-one'+id).val() <= 0) {
				$('#add-one'+id).val(0);
		    	delete uniqueAids[id];
			}
			
		    var commaSeparatedAids = Object.keys(uniqueAids).join(',');
		    $('#addOnServicesId').val(commaSeparatedAids);

		    setAddOnServiceTotal();
	    });

	    $('#adultcnt').prop('readonly', true);
		$(document).on('click','.adultplus',function(){
		    $('#adultcnt').val(parseInt($('#adultcnt').val()) + 1 );
		    $('#adultCount').val(parseInt($('#adultcnt').val()));
		    calculateTotal();
		});

    	$(document).on('click','.adultminus',function(){
			$('#adultcnt').val(parseInt($('#adultcnt').val()) - 1 );
			if ($('#adultcnt').val() <= 0) {
				$('#adultcnt').val(0);
			}
			$('#adultCount').val(parseInt($('#adultcnt').val()));
			calculateTotal();
	    });

	    $('#childcnt').prop('readonly', true);
		$(document).on('click','.childplus',function(){
			$('#childcnt').val(parseInt($('#childcnt').val()) + 1 );
			$('#childCount').val(parseInt($('#childcnt').val()));
			calculateTotal();
		});
    	$(document).on('click','.childminus',function(){
			$('#childcnt').val(parseInt($('#childcnt').val()) - 1 );
			if ($('#childcnt').val() <= 0) {
				$('#childcnt').val(0);
			}
			$('#childCount').val(parseInt($('#childcnt').val()));
			calculateTotal();
	    }); 

	    $('#infantcnt').prop('disabled', true);
		$(document).on('click','.infantplus',function(){
			$('#infantcnt').val(parseInt($('#infantcnt').val()) + 1 );
			$('#infantCount').val(parseInt($('#infantcnt').val()));
			calculateTotal();
		});
    	$(document).on('click','.infantminus',function(){
			$('#infantcnt').val(parseInt($('#infantcnt').val()) - 1 );
			if ($('#infantcnt').val() <= 0) {
				$('#infantcnt').val(0);
			}
			$('#infantCount').val(parseInt($('#infantcnt').val()));
			calculateTotal();
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
	function  setAddOnServiceTotal() {
		var totalQty =  0;
		var sQty = '';
		var addOnServicesId = $('#addOnServicesId').val();
		var idArray = addOnServicesId.split(','); 
		for (var i = 0; i < idArray.length; i++) {
			sQty +=  $('#add-one' + idArray[i]).val() + ',';
		    qty  =   parseFloat($('#add-one' + idArray[i]).val()) || 0;
		    price =   parseFloat($('#add-one' + idArray[i]).attr('apirce')) || 0;
			totalQty += qty * price;
		}
		if (sQty.endsWith(",")) {
		  	sQty = sQty.slice(0, -1);
		}
		sQty = (addOnServicesId != '') ? sQty : '';
		$('#addOnServicesQty').val(sQty);
		$('#addOnServicesTotalPrice').val(totalQty);		
		calculateTotal();
	}

	function calculateTotal(){
		var adultCount = parseInt($('#adultCount').val()) || 0;
		var childCount = parseInt($('#childCount').val()) || 0;
		var infantCount = parseInt($('#infantCount').val()) || 0;
		var adultPrice = parseFloat($('#adultDiscountPrice').val()) || 0;
		var childPrice = parseFloat($('#childDiscountPrice').val()) || 0;
		var infantPrice = parseFloat($('#infantDiscountPrice').val()) || 0;
		var addOnServicesTotalPrice = parseFloat($('#addOnServicesTotalPrice').val()) || 0;

		var total = (adultCount * adultPrice) + (childCount * childPrice) + (infantCount * infantPrice);
		var totalQty =  adultCount + childCount + infantCount;
		total = (addOnServicesTotalPrice != '') ? ( total + addOnServicesTotalPrice) : total;
		$('#totalQty').val(totalQty);
		$('#textPrice').html('$'+ parseFloat(total)+' USD' || '$0 USD');
		$('#priceTotal').val(parseFloat(total) || 0);
		$('#price').val(parseFloat(total) || 0);
	}

	function addhiddentime(id,sid,chk) {
		updatedetail({{$companyid}},sid,'schedule',id);
		if(chk == 1){
			$('#Countermodalbody').html('<div class="row "> <div class="col-lg-12 text-center"> <div class="modal-inner-txt scheduler-time-txt label-space"><label>You can\'t book this activity for today.</label><label> The time has passed.</label><label>Please choose another time.</label></div> </div></div>');
			$('#Countermodal').modal('show');
		}
	}

	function updatedetail(cid,sid,type,val){
		var actdate = $('#actfildate_forcart').val();
		var serviceid = sid;
		var categoryId = $('#selcatpr').val();
		var priceId = $('#selprice').val();
		var scheduleId = $('.checkbox-option:checked').attr('id');
		if(type == 'date'){
			categoryId = '';
			scheduleId = '';
			priceId = '';
			scheduleId = '';
		}else if(type == 'category'){
			categoryId = val;
			scheduleId = '';
			priceId = '';
		}else if(type == 'price'){
			priceId = val;
			scheduleId = ''
		}else if(type == 'schedule'){
			scheduleId = val;
		}
		
		var _token = $("input[name='_token']").val();
		$.ajax({
			url: "{{route('act_detail_filter_for_cart')}}",
			type: 'POST',
			dataType: 'JSON',
			data:{
				_token: _token,
				type: 'POST',
				actdate:actdate,
				serviceid:serviceid,
				companyid:cid,
				categoryId:categoryId,
				priceId:priceId,
				scheduleId:scheduleId,
			},
			success: function (response) {
				if(response != ''){
					$('#updatefilterforcart').html(response.html);
					$('#sesdate'+sid).val(actdate);
					$('.date-title').html(response.date);
				}else{
					$('#updatefilterforcart').html('');
				}
			}
		});
	}

	function actFilter(cid,sid){   
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
			}
		});
	}
</script>

<?php
	$next_available_date = null;
	$activities = BusinessActivityScheduler::where('serviceid', $sid)->get();
	$result = $arrayofdates = [];
	foreach($activities as $local_activity){
		$activity_next_available_date = $local_activity->next_available_date();
		if($activity_next_available_date != ''){
			if ($next_available_date === null || $activity_next_available_date < $next_available_date) {
	            $next_available_date = $activity_next_available_date;
	        }
		}
		array_push($result, [$local_activity->starting, $local_activity->end_activity_date, $local_activity->activity_days]);
	}
	
	if($next_available_date == null){
		$next_available_date = new DateTime();
	}
?>
 <script>
	var active_days = JSON.parse('<?php echo json_encode($result)?>');
	const days = [ 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday',]
	$( function() {
		$( "#actfildate_forcart" ).datepicker( { 
			minDate: 0,
			changeMonth: true,
			changeYear:true,
        	yearRange: "1960:2060",
        	dateFormat: "M-dd-yy",
        	beforeShowDay: function(date){
        		for(var i=0; i<active_days.length; i++){
        			start = new Date(active_days[i][0] + " 00:00:00");
        			end = new Date(active_days[i][1] + " 00:00:00");

        			if(date >= start && date <= end){
        				if(active_days[i][2].match(days[date.getDay()])){
        					return [1];	
        				}
        			}
        		}
        		return [0];
        	}
		});
	});

	$( function() {
		$('#actfildate_forcart').val('{{$next_available_date->format('M-d-Y')}}');
        updatedetail('{{$companyid}}','{{$sid}}','date','');
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
						$(".provider_review").load(location.href+" .provider_review >*","");
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
</script>

<script src="/public/js/ratings.js"></script>

<script>
	$(document).ready(function () {
	    var locations = @json($locations);
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
	    }
	});
</script>

@endsection

