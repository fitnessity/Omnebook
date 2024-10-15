@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
@section('content')
<?php
	use Illuminate\Support\Str;
	use Illuminate\Support\Facades\Auth;
?>



<link rel='stylesheet' type='text/css' href="{{url('/public/css/frontend/general.css')}}">
<link href="{{url('/public/css/compare/style.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('/public/css/compare/w3.css')}}" rel="stylesheet" type="text/css" />
<link href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css" type="text/css" rel="stylesheet" />
<script src="{{url('/public/js/compare/Compare.js')}}"></script>
<script src="{{url('/public/js/compare/jquery-1.9.1.min.js')}}"></script>
<script src="{{ url('public/js/jquery-ui.multidatespicker.js') }}"></script>
<script src="{{ url('public/js/jquery-ui.min.js') }}"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<style>
	.instant-hire-activites {
	margin-top: 60px;
	}
</style>
@if(@$getstarteddata != '')
<section class="instant-hire" >
	<div class="instant-banner">
		<img src="{{url('/public/uploads/discover/thumb/'.@$getstarteddata->image) }}" alt="Fitnessity">
		<h4>{{@$getstarteddata->title}}</h4>
	</div>
</section>
@endif

<section class="instant-hire-activites @if(count($bookschedulers) <= 0) mar-tp @endif">
	<div class="container-fluid">
		
		
		@includeWhen($bookschedulers, 'activity._next_8_hour_header', ['bookschedulers' => $bookschedulers])
		
	<section class="direc-hire" >
		<div class="">
			<div class="row">
				<div class="col-md-6">
					<div class="title">
						<h3>{{$name}} Activities</h3>
					</div>
				</div>
				<div class="col-md-6">
                <?php if (isset($allactivities) && count($allactivities) > 0) { ?>
					<div class="direc-right distance-block map-sp">
						<div class="mapsb">Show Maps
							<label class="switch" for="maps">
								<input type="checkbox" name="maps" id="maps">
								<span class="slider round"></span>
							</label>
						</div>
					</div>
                <?php } ?>
				</div>
				<div class="col-md-8 leftside-kickboxing kicks" id="leftside-kick">
					<div class="row" id="activitylist">
						<?php
			            $companyid = $companylat = $companylon = $companyname  = $latitude = $longitude = $serviceid = $companylogo = $companyaddress= "";
							$companycity = $companycountry = $pay_price  = "";
							$locations = []; 
							$locationforhover = ''; 
			            if (isset($allactivities) && count($allactivities) > 0) {
			              $servicetype = [];
			              $locationforhover = []; 
			               foreach ($allactivities as $loop => $service) {
			                  $company = $price = $businessSp = [];
									$serviceid = $service['id'];
	                        $sport_activity = $service['sport_activity'];
	                        $servicetype[$service['service_type']] = $service['service_type'];
	                        $area = !empty($service['area']) ? $service['area'] : 'Location';
	                        $company = App\CompanyInformation::where('id', $service['cid'])->first();
                           if($company != '') {
                              $companyid = $company->id;
                              $companyaddress = $company->address;
                              $companyname = $company->dba_business_name;
										$companycity = $company->city;
										$companycountry = $company->country;
										$companylogo = $company->logo;
										$companylat = $company->latitude;
										$companylon = $company->longitude;
	                        }
			                            
                     		$profilePic =  Storage::disk('s3')->exists($service->first_profile_pic()) ? Storage::URL($service->first_profile_pic()) : url('/images/service-nofound.jpg');  
				                  	$pic_image = explode(',',$service['profile_pic']);

									$bookscheduler= '';
									$bookscheduler = App\BusinessActivityScheduler::where('serviceid', $service['id'])->orderBy('id', 'ASC')->first();
									$time = @$bookscheduler != '' ? @$bookscheduler->get_duration() : '';
									$price_all = $service->min_price();

									$locationforhover = '';
									$al = [];
			                  if($companylat != '' || $companylon  != ''){
			                     $lat = $companylat + ((floatVal('0.' . rand(1, 9)) * 1) / 10000);
			                    	$long = $companylon + ((floatVal('0.' . rand(1, 9)) * 1) / 10000);
			                    	$a = [$companyname, $lat, $long, $companyid, $companylogo];
			                    	$al[] = $companyname;
			                    	$al[] = $lat;
			                    	$al[] = $long;
			                    	$al[] = $companyid;
			                    	$al[] = $companylogo;
			                    		
			                     $locationforhover = json_encode($al);
			                     array_push($locations, $a);
							}
	                    ?>
						<div class="col-md-4 col-sm-4 col-map-show limitload">
							<div class="selectProduct" data-id="{{ $service['id'] }}" data-title="{{ $service['program_name'] }}" data-name="{{ $service['program_name'] }}" data-companyname="{{ $companyname }}" data-email="" data-address="{{ $companyaddress }}" data-img="{{ $profilePic }}" data-price="{{ $pay_price }}" data-token="{{ csrf_token() }}"> 
								<div class="kickboxing-block" onmouseover="bigImg({{$locationforhover}});">
									@if(Auth::check())
										@php
                                	$loggedId = Auth::user()->id;
                                	$favData = App\BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$service['id'])->first();                   
                  				@endphp
                        		<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}"  >
											<div class="inner-owl-slider-hire">
												<div id="owl-demo-learn{{$service['id']}}" class="owl-carousel owl-theme" >
													@if(is_array($pic_image))
														@foreach($pic_image as $img)
															@if(Storage::disk('s3')->exists($img) && $img != '' )
																<img src="{{Storage::URL($img)}}" class="productImg" alt="Fitnessity">
															@else
																<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity">
															@endif
														@endforeach
													@else
														@if(Storage::disk('s3')->exists($pic_image) && $pic_image != '' )
															<div class="item-inner">
																<img src="{{Storage::URL($pic_image)}}" alt="Fitnessity">
															</div>
														@else
															<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity">
														@endif
													@endif
												</div>
											</div>
											<script type="text/javascript">
												$(document).ready(function() {
												  	$("#owl-demo-learn{{$service['id']}}").owlCarousel({
													   navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
													   items : 1, 
													   loop:true,
													   nav:true,
													   dots: false,
												  	});
												});
											</script>
											<div class="serv_fav1" ser_id="{{$service['id']}}" data-id = "serfavall">	
												<a class="fav-fun-2" id="serfavall{{$service['id']}}">
                                    	@if( !empty($favData) )
                                        	<i class="fas fa-heart"></i>
													@else
                                    		<i class="far fa-heart"></i>
                                    	@endif
                                     </a>
	                            	</div>
										</div>
                  			@else
                      			<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
											<div class="inner-owl-slider-hire">
												<div id="owl-demo-learn{{$service['id']}}" class="owl-carousel owl-theme">
													@if(is_array($pic_image))
														@foreach($pic_image as $img)
															<div class="item-inner">
																@if(Storage::disk('s3')->exists($img) && $img != '' )
																	<img src="{{Storage::URL($img)}}" class="productImg" alt="Fitnessity">
																@else
																	<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity">
																@endif
															</div>
														@endforeach
													@else
														@if(Storage::disk('s3')->exists($pic_image) && $pic_image != '' )
															<div class="item-inner">
																<img src="{{Storage::URL($pic_image)}}" alt="Fitnessity">
															</div>
														@else
															<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity">
														@endif
													@endif
												</div>
											</div>
											<script type="text/javascript">
												$(document).ready(function() {
												  	$("#owl-demo-learn{{$service['id']}}").owlCarousel({
													   navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
													   items : 1, 
													   loop:true,
													   nav:true,
													   dots: false,
													  /* onResized: callback,*/
												  	});
												});
											</script>
	                              <a class="fav-fun-2" href="{{ Config::get('constants.SITE_URL') }}/userlogin" ><i class="far fa-heart"></i></a>
	                              @if($price_all != '')	
	                               	<span>From ${{$price_all}}/Person</span>
	                              @endif
	                            </div>
                  			@endif
                  			@php
										$reviews_count =  App\BusinessServiceReview::where('service_id', $service['id'])->count();
										$reviews_sum =  App\BusinessServiceReview::where('service_id', $service['id'])->sum('rating');
										$reviews_avg=  $reviews_count>0 ? round($reviews_sum/$reviews_count,2):0;
									@endphp
									
									<div class="bottom-content">
										<div class="class-info">
											<div class="row">
												<div class="col-md-7 col-xs-7 ratingtime">
													<div class="activity-inner-data">
														<i class="fas fa-star"></i>
														<span>{{$reviews_avg}} ({{$reviews_count}})</span>
													</div>
													@if($time != '')
														<div class="activity-hours">
															<span>{{$time}}</span>
														</div>
													@endif
												</div>
												<div class="col-md-5 col-xs-5 country-instant">
													<div class="activity-city">
														<span>{{$companycity}}, {{$companycountry}}</span>
													</div>
												</div>
											</div>
										</div>
										@php
											$redlink = str_replace(" ","-",$companyname)."/".$service['cid'];
										@endphp
										<div class="activity-information activites-height">
											<span><a 
												@if (Auth::check())  
				                           href="{{ Config::get('constants.SITE_URL') }}/businessprofile/{{$redlink}}" 
				                        @else 
				                           href="{{ Config::get('constants.SITE_URL') }}/userlogin" 
				                        @endif
				                        
				                        target="_blank">{{ $service['program_name'] }}</a>
											</span>
											<span><a  @if (Auth::check())  
	                                    		href="{{ route('businessprofiletimeline',['user_name'=>str_replace(" ","-",$companyname),'id'=>$service['cid']])}}" 
	                                		@else 
	                                    	href="{{ route('userlogin') }}"  
	                                		@endif
	                                    target="_blank"  class="companyalink">{{$companyname}}</a></span>
											
											<p>{{ $service->formal_service_types() }} | {{ $service['sport_activity'] }}</p>
										</div>
										<hr>
										<div class="all-details">
											<!-- <a class="showall-btn" data-toggle="modal" data-target="#mykickboxing3">Book Now</a> -->
											<a class="showall-btn" href="/activity-details/{{$serviceid}}">Book Now</a>
											<p class="addToCompare" id='compid{{$service["id"]}}' title="Add to Compare">COMPARE SIMILAR +</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<script type="text/javascript">
							function bigImg(locations) {
								const element = document.querySelector("#leftside-kick");
								var setval = element.classList.contains("kicks");
								if(setval == false){
								   	var map1 = ''
								    var infowindow1 = ''
								    var marker1 = ''
								    var markers1 = []
								    var circle = ''
								    $('#map_canvas').empty();

								    if (locations.length != 0) {  console.log('!empty');
								        map1 = new google.maps.Map(document.getElementById('map_canvas'), {
								            zoom:18,
								            center: new google.maps.LatLng(locations[1], locations[2]),
								            mapTypeId: google.maps.MapTypeId.ROADMAP,
								        });
								        infowindow1 = new google.maps.InfoWindow();
								        var bounds = new google.maps.LatLngBounds();
								        var marker1;
								        var icon1 = {
								            url: "{{url('/public/images/hoverout2.png')}}",
								            scaledSize: new google.maps.Size(50, 50),
								            labelOrigin: {x: 25, y: 16}
								        };
							            var labelText1 = 1
							            marker1 = new google.maps.Marker({
							                position: new google.maps.LatLng(locations[1],locations[2]),
							                map: map1,
							                icon: icon1,
							                title: labelText1.toString(),
							                label: {
							                    text: labelText1.toString(),
							                    color: '#222222',
							                    fontSize: '12px',
							                    fontWeight: 'bold'
							                }
							            });
							         
							            bounds.extend(marker1.position);
							            var img_path1 = "{{Config::get('constants.USER_IMAGE_THUMB')}}";
							            var contents1 =
							                    '<div class="card-claimed-business"> <div class="row"><div class="col-lg-12" >' +
							                    '<div class="img-claimed-business">' +
							                    '<img src=' + img_path1 + encodeURIComponent(locations[4]) + ' alt="">' +
							                    '</div></div> </div>' +
							                    '<div class="row"><div class="col-lg-12" ><div class="content-claimed-business">' +
							                    '<div class="content-claimed-business-inner">' +
							                    '<div class="content-left-claimed">' +
							                    '<a href="/pcompany/view/' + locations[3] + '">' + locations[0] + '</a>' +
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

							            google.maps.event.addListener(marker1, 'mouseover', (function (marker1, contents1, infowindow1) {
							                return function () {
							                    infowindow1.setPosition(marker1.latLng);
							                    infowindow1.setContent(contents1);
							                    infowindow1.open(map1, this);
							                };
							            })(marker1, contents1, infowindow1));
							            markers1.push(marker1);
								        	        
								        $('.mysrchmap').show()
								    } else {
								        $('#mapdetails').hide()
								    }
								}
							}
						</script>

						<?php
                    		}
                		}else{
                		?> 
                		<div class="col-md-4 col-sm-4 col-map-show limitload"><p>There is no activity found</p></div>
                		<?php } ?>
					</div>

				</div>

				<div class="col-md-4 col-sm-12 col-xs-12 kickboxing_mapone mapskick">
					<div class="mysrchmap" style="display:none;height: 100%;min-height: 700px;">
						<div id="map_canvas" style="position: absolute; top: 0; right: 0; bottom: 0; left: 0;"></div>
					</div>
					<div class="maparea">
						<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24176.251535935986!2d-73.96828678121815!3d40.76133318281456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258c4d85a0d8d%3A0x11f877ff0b8ffe27!2sRoosevelt%20Island!5e0!3m2!1sen!2sin!4v1620041765199!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
					</div>
				</div>
				<div class="pagenation" style="display:none">
	                <a href="#" class="active">1</a>
	                <a href="#">2</a>
	            </div>
	        </div>
	        @if(count($allactivities)>0)
			<?php /*?><div class="row align-self-center">
				<div class="col-md-6">
					<div class="text-center ptb-65">
					<button id="load_more_button" class="showall-btn" type="button" onclick="loadMoreData('{{$name}}');">Load More</button>
					</div>
				</div>
			</div><?php */?>
			@endif
		</div>
	</section>
		
		<div class="row align-self-center">
			<div class="col-md-6 col-xs-12">
				<div class="find-business">
					<div class="row">
						<div class="col-md-8">
							<div class="">
								<p>Can't Find A Business Offering Your Favorite Activity?</p>
								<p class="inner-txt">You can add a business to fitnessity for free.</p>
							</div>
						</div>
						<div class="col-md-4">
							<div class="btn-txt">
								<a href="#" class="showall-btn" data-bs-toggle="modal" data-bs-target="#addbusiness">Add A Business</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>		
</section>      

<!--preview panel-->
<div class="w3-container w3-center">
    <div class="w3-row w3-card-4 w3-round-large w3-border comparePanle w3-margin-top">
        <div class="w3-row">
            <div class="w3-col l12 m12 s12 w3-margin-top">
                <h4 style="text-transform: uppercase; font-weight: bold; margin-bottom: 30px;">
                    Added for Comparison
                    <span title="Close" class="closeItems" style="float:right; padding-right:15px; cursor: pointer;color:#ea1515">
                    <i class="fas fa-times-circle"></i> </span>
                </h4>                            
            </div>
        </div>
        <div class=" titleMargin w3-container comparePan">
            <button type="button" class="btn btn-primary notActive cmprBtn addtcmpr-btn" data-bs-toggle="modal" data-bs-target="#myModal">Compare</button>
        </div>
    </div>
</div>

<!--end of preview panel-->
<!-- The Modal Add Business-->
<div class="modal fade compare-model" id="addbusiness">
    <div class="modal-dialog modal-lg business">
        <div class="modal-content">
			<div class="modal-header" style="text-align: right;"> 
			  	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

            <!-- Modal body -->
            <div class="modal-body">
				<div class="row contentPop">
					<div class="col-lg-12">
					   <h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 600;">ADD BUSINESS</h4>
					</div>
                    <div class="col-lg-12">
                        <div class="modal-inner-txt">
                        	<p>Are you a customer or business owner wanting to add information about a business? <br>It’s free to add to Fitnessity!</p>
                        </div>
                    </div>
					<div class="col-lg-12 btns-modal">
						<a href="{{route('addbusinesscustomer')}}" class="addbusiness-btn-modal">I'M A CUSTOMER</a>
						<a href="{{route('businessClaim')}}" class="addbusiness-btn-black">I'M A BUSINESS OWNER</a>
					</div>
				 </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<!-- The Modal -->
<div class="modal fade compare-model" id="myModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
			<div class="modal-header" style="text-align: right;">
			  <!-- <button class="clear_compare_list" type="button" style="color: white; border-color: red; background-color: red; margin-top: -5px;" data-dismiss="modal">×</button> -->
			  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

            <!-- Modal body -->

            <div class="modal-body" style="padding: 0px;">
				<div class="row contentPop">
					<div class="col-lg-12 theme-black-bgcolor">
					   <h4 class="modal-title" style="text-align: center; color: white; line-height: inherit; padding: 6px;">COMPARE WITH SIMILAR ITEMS</h4>
					</div>
                    <div class="col-lg-12" style="padding-left: 0;padding-right: 0;">
                        <div class="comparetable compare-records-div">
                        </div>
                    </div>
				</div>
            </div>
        </div>
    </div>
</div>

<!-- comparision popup-->

<!--end of comparision popup-->

<!--  warning model  -->


<div id="WarningModal" class="w3-modal">
    <div class="w3-modal-content warningModal">
        <header class="w3-container w3-teal" style="background-color:#f53b49 !important;">
            <h3>
                <span>&#x26a0;</span> You cannot compare more then 3 Activity
                <button id="warningModalClose" onclick="document.getElementById('id01').style.display='none'" class="w3-btn w3-hexagonBlue w3-margin-bottom" style="float:right;background-color:#f53b49 !important;">X</button>
            </h3>
        </header>
        <div class="w3-container">
            <h4>Maximum of Three products are allowed for comparision</h4>
        </div>
    </div>
</div>

<!--  end of warning model  -->

<div class="modal fade compare-model11" id="actreview">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="text-align: right;">
            	<!-- <button class="clear_compare_list" type="button" style="color: white; border-color: red; background-color: red; margin-top: -5px;" id="closeActreview" >×</button> -->
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="padding: 0px;">
				<div class="row">
					<div class="col-lg-12">
                    	<div id="actreviewBody" class="service-review actreviewBody">
                        	
                        </div>
            		</div>
				</div>
			</div>     
		</div>
	</div>
</div>                  

<!-- The Modal Add Business-->
    <div class="modal fade compare-model" id="addbusiness">
        <div class="modal-dialog modal-lg business">
            <div class="modal-content">
				<div class="modal-header" style="text-align: right;"> 
					<div class="closebtn">
						<button type="button" class="close close-btn-design-part" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
				</div>
                <!-- Modal body -->
                <div class="modal-body">
					<div class="row">
						<div class="col-lg-12">
							<h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 600;">ADD BUSINESS</h4>
						</div>
                        <div class="col-lg-12">
                            <div class="modal-inner-txt">
                                <p>Are you a customer or business owner wanting to add information about a business? <br>It’s free to add to Fitnessity!</p>
                            </div>
                        </div>
						<div class="col-lg-12 btns-modal">
							<a href="{{route('addbusinesscustomer')}}" class="addbusiness-btn-modal">I'M A CUSTOMER</a>
							<a href="{{route('businessClaim')}}" class="addbusiness-btn-black">I'M A BUSINESS OWNER</a>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
<!-- end modal -->

@include('layouts.business.footer')
	
<script type="text/javascript">
	$(document).ready(function () {
		 $(".mapsb .switch .slider").click(function () { 
	    	console.log("Hello!");
	    		//$('.owl-carousel').trigger('refresh.owl.carousel');
	    		//$('#owl-demo-learn124').trigger('refresh.owl.carousel');
				//$('.owl-carousel').trigger('destroy.owl.carousel');
				 /*var $carousel = $('#owl-demo-learn123');
        		$carousel.data('owl.carousel')._invalidated.width = true;
        		$carousel.trigger('refresh.owl.carousel');
				console.log("Hello after!");*/
	    		/*$('#owl-demo-learn123').owlCarousel('refresh');*/
				window.dispatchEvent(new Event('resize'));
				
	       	$(".kickboxing_mapone").toggleClass("mapskick");
	       	$(".leftside-kickboxing").toggleClass("kicks");
	   });
	});

</script>

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ env('MAP_KEY') }}&sensor=false"></script>

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
</script>

<script type="text/javascript">
	function changeactpr(aid,val,part,div,maid)
	{
		var n = val.split('~~');
		var pr; var qty;
		var actfilparticipant=$('#actfilparticipant'+maid).val();
		
		if(actfilparticipant!='')
		{
			pr=actfilparticipant*n[1]; 
			qty=actfilparticipant;
		}
		else{ 
			qty=1; 
			if( n[1]!='' ){ pr=qty*n[1]; } else { pr='100'; }
		}
		var data = '<p>Price Option: '+n[0]+' Session</p><p>Participants: '+qty+'</p><p>Total: $'+pr+'/person</p>';
		var book 
		if(div=='book'){
			$('#book'+maid+aid).html(data);
			$('#pricequantity'+maid+aid).val(qty);
			$('#price'+maid+aid).val(pr);
			$('#priceid'+maid+aid).val(n[2]);
			$('#totprice'+maid).html(pr + ' USD');
			$('#paysession'+maid).html('Price Option: '+ n[0] + ' Session');
		}
		else if (div=='bookmore'){
			console.log(aid);
			$('#bookmore'+maid+aid).html(data);
			$('#pricebookmore'+maid+aid).val(pr);
			$('#priceid'+maid+aid).val(n[2]);
		}
		else if (div=='bookajax'){
			$('#bookajax'+maid+aid).html(data);
			$('#pricebookajax'+maid+aid).val(pr);
			$('#pricequantity'+maid+aid).val(qty);
			$('#priceid'+maid+aid).val(n[2]);
		}
	}

	function loadMoreData(name){ 
		var _token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			url: "{{route('load-data')}}",
			type: 'POST',
			data:{
				_token: _token,
				name:name,
			},
			success: function (response) {
				if(response != ''){
				}
			}
		});
	}

</script>

<script>
	jQuery("#carousel-slidertwo").owlCarousel({
	  autoplay: true,
	  rewind: true, /* use rewind if you don't want loop */
	  margin: 20,
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
		
		1200: {
	      items: 5
	    },
		
	    1366: {
	      items: 5
	    },
	  },
	});
</script>

<script>
	jQuery("#carousel-sliderthree").owlCarousel({
	  autoplay: true,
	  rewind: true, /* use rewind if you don't want loop */
	  margin: 20,
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
		
		1200: {
	      items: 5
	    },
		
	    1366: {
	      items: 5
	    },
	  },
	});
</script>

<script>
	jQuery("#carousel-sliderfour").owlCarousel({
	  autoplay: true,
	  rewind: true, /* use rewind if you don't want loop */
	  margin: 20,
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
		
		1200: {
	      items: 5
	    },
		
	    1366: {
	      items: 5
	    },
	  },
	});
</script>

<script>
	jQuery("#carousel-sliderfive").owlCarousel({
	  autoplay: true,
	  rewind: true, /* use rewind if you don't want loop */
	  margin: 20,
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
		
		1200: {
	      items: 5
	    },
		
	    1366: {
	      items: 5
	    },
	  },
	});
</script>

<script>
	jQuery("#carousel-slidersix").owlCarousel({
	  autoplay: true,
	  rewind: true, /* use rewind if you don't want loop */
	  margin: 20,
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
		
		1200: {
	      items: 5
	    },
		
	    1366: {
	      items: 5
	    },
	  },
	});
</script>
@endsection