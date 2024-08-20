@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
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
	use App\{BusinessServiceReview,BusinessActivityScheduler};
	$pro_pic1 = '';
    $pro_pic = $service->profile_pic;
	if(!empty($pro_pic)){
		$pro_pic1 = (str_contains($pro_pic, ',')) ? explode(',', $pro_pic) : [$pro_pic];
	}

?>
<link rel='stylesheet' type='text/css' href="{{url('public/css/frontend/general.css')}}">
<link href="{{url('public/css/compare/style.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('public/css/compare/w3.css')}}" type="text/css" >
{{-- <link href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css" type="text/css" rel="stylesheet" /> --}}
<link rel='stylesheet' type='text/css' href="{{url('public/css/responsive.css')}}">


<script src="{{url('public/js/compare/Compare.js')}}"></script>
<script src="{{url('public/js/compare/jquery-1.9.1.min.js')}}"></script>



<!-- <script src="{{ url('public/js/jquery-ui.multidatespicker.js') }}"></script> -->
<script src="{{ url('public/js/jquery-ui.min.js') }}"></script>
<script src="{{env('/public/js/ratings.js')}}"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>


	<div id="mykickboxing" class="mykickboxing-activities kickboxing-moredetails p-activitydetails">
	   	<div class="container">
			<div class="row y-middle">
				<div class="col-lg-10">
					<div class="mb-25 mb--mv--0">
						<h3 class="details-titles mb-0">{{@$service->program_name}}</h3>
						<div class="service-review-desc d-inline-block">
							<div class="provider_review">
								<p class="mb-10"> {{$service->reviews()->count()}} Reviews </p> 
								<div class="rattxt activered"><i class="fa fa-star" aria-hidden="true"></i> {{$service->all_over_review}} </div>
							</div>
							<p class="caddress"> <b> Host: </b> <a href="{{ Config::get('constants.SITE_URL') }}/businessprofile/{{str_replace(' ','-',$company->dba_business_name).'/'.$company->id}}"> {{ $company->dba_business_name }} </a>{{$company->company_address() }} </p>
						</div>
					</div>
				</div>
				<div class="col-lg-2">
					<div class="text-right mb--mv--15">
						<div class="share-wish">
							<a href="#" class="mr-15"><i class="fas fa-share"></i> Share</a>
							<a href="#"><i class="far fa-heart"></i> Save</a>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<div class="st-gallery st-border-radius style-masonry">
	        			<div class="st-list-item-gallery">
	        				@if($service->cover_photo)
		                  		<a href="{{Storage::URL($service->cover_photo)}}" data-elementor-open-lightbox="no" class="item-gallery  firstfancyimg "  data-fancybox="gallery">
									<img src="{{Storage::URL($service->cover_photo)}}" alt="image">
								</a>
							@endif

		                    @foreach(@$pro_pic1 as $img) 
	                    		@if(!empty($img) && Storage::disk('s3')->exists($img))
	                    	 		@php $newary [] = $img; @endphp
	                    	 	@endif
	                    	@endforeach

		                    @foreach(@$pro_pic1 as $i => $img)
								<a href="{{Storage::URL($img)}}" data-elementor-open-lightbox="no" class="item-gallery @if(!$service->cover_photo && $i==0) firstfancyimg @endif @if( (!$service->cover_photo && $i > 4) || ($service->cover_photo && $i > 3)) hide @endif"  data-fancybox="gallery">
									<img src="{{Storage::URL($img)}}" alt="image">
								</a>
							 @endforeach

	             		</div>
	        			<div class="shares dropdown">
	            			<div class="btn-group">
	            				@if($service->video)
	                        		<a href="{{$service->video}}" class="btn btn-transparent has-icon radius st-video-popup" data-fancybox="gallery"><span class="fas fa-play"></span></a>
	                        	@endif
	                        	<a class="btn btn-transparent has-icon radius st-gallery-popup showphotos" ><span class="fas fa-th-large"></span>All photos</a>
	            			</div>
	        			</div>
	    			</div>
				</div>
			</div>
		
			<div class="st-service-feature separator-border-bottom">
				<div class="row y-middle">
					<div class="col-lg-2 col-sm-6 col-md-4">
						<div class="item d-flex align-items-lg-center">
							<div class="icon">
								<i class="fas fa-user-clock"></i>              
							</div>
							<div class="info">
								<div class="name">Service Type</div>
								<p class="value"> {{$service->select_service_type ?? 'N/A'}}</p>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-xs-12 col-sm-6 col-md-4">
						<div class="item d-flex align-items-lg-center">
							<div class="icon">
								<i class="fas fa-globe-asia"></i>
							</div>
							<div class="info">
								<div class="name">Language</div>
								<p class="value"> {{$company->business_service ? $company->business_service->languages : 'English'}}</p>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-xs-12 col-sm-6 col-md-4">
						<div class="item d-flex align-items-lg-center">
							<div class="icon">
								<i class="fas fa-map-marker-alt"></i>
							</div>
							<div class="info">
								<div class="name">Location</div>
								<p class="value">{{$service->activity_location ?? 'N/A'}}</p>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-xs-12 col-sm-6 col-md-4">
						<div class="item d-flex align-items-lg-center">
							<div class="icon">
								<i class="fas fa-hiking"></i>
							</div>
							<div class="info">
								<div class="name">Activity</div>
								<p class="value">{{$service->service_type ?? 'N/A'}}</p>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-xs-12 col-sm-6 col-md-4">
						<div class="item d-flex align-items-lg-center">
							<div class="icon">
								<i class="fas fa-female"></i>
							</div>
							<div class="info">
								<div class="name">Age</div>
								<p class="value">{{$service->age_range ?? 'N/A'}} </p>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-xs-12 col-sm-6 col-md-4">
						<div class="item d-flex align-items-lg-center">
							<div class="icon">
								<i class="fas fa-rocket"></i>
							</div>
							<div class="info">
								<div class="name">Skill Level</div>
								<p class="value">{{$service->difficult_level ?? 'N/A'}} </p>
							</div>
						</div>
					</div>
				</div>
			</div>

		   	<div class="row">

				<div class="col-lg-8 col-xs-12">
					<div class="separator-border-bottom">
						<h3 class="subtitle details-sp pb-0"> Description </h3>
						<p class="mb-30">{{ @$service['program_desc']  ?? 'N/A'}}</p>
					</div>

					@if($service->service_type == 'experience' && count($service->days_title_arry) > 0)
						<div class="separator-border-bottom">
							<h3 class="subtitle details-sp"> Itinerary </h3>
							<div class="live-preview mb-25 ">
								<div class="accordion accordion-border-box" id="itdefault-accordion-example">
									@foreach($service->days_title_arry as $i=>$title)
									<div class="accordion-item shadow">
										<h2 class="accordion-header" id="headingInOne">
											<button class="accordion-button fs-14 days-details" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInOne{{$i}}" aria-expanded="true" aria-controls="collapseInOne{{$i}}">
												<span> Day{{$i+1}}  </span>
												{{$title}}
											</button>
										</h2>
										<div id="collapseInOne{{$i}}" class="accordion-collapse collapse  @if($i==0) show @endif" aria-labelledby="headingInOne{{$i}}" data-bs-parent="#itdefault-accordion-example">
											<div class="accordion-body">
												<div class="row">
													<div class="col-lg-4 col-sm-6 col-xs-12">
														<div class="itinerary-image">
															@php
                                                            	$dayPic = @$service->days_img_arry[$i] != ''  ?  Storage::Url(@$service->days_img_arry[$i]) : url('/public/images/Upload-Icon.png');
                                                        	@endphp
															<img class="" src="{{$dayPic}}" alt="image">
														</div>
													</div>
													<div class="col-lg-8 col-sm-6 col-xs-12">
														 {{$service->days_desc_arry[$i]}}
														{{-- No charges are put in place by SlickText when subscribers join your text list. This does not mean however that charges 100% will not occur. Charges that may occur fall under part of the compliance statement stating "Message and Data rates may apply." --}}
													</div>
												</div>
											</div>
										</div>
									</div>
									{{-- <div class="accordion-item shadow">
										<h2 class="accordion-header" id="headingInTwo">
											<button class="accordion-button collapsed fs-14 days-details" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInTwo" aria-expanded="false" aria-controls="collapseInTwo">
												<span> Day 2 </span>
												Flight Around USA
											</button>
										</h2>
										<div id="collapseInTwo" class="accordion-collapse collapse" aria-labelledby="headingInTwo" data-bs-parent="#itdefault-accordion-example">
											<div class="accordion-body">
												<div class="row">
													<div class="col-lg-4 col-sm-6 col-xs-12">
														<div class="itinerary-image">
															<img class="" src="https://fitnessity-production.s3.amazonaws.com/activity/90R9Ri4W577QRFXawD80KDShqZ55bpGI6eXtCfVY.jpg" alt="image">
														</div>
													</div>
													<div class="col-lg-8 col-sm-6 col-xs-12">
														No charges are put in place by SlickText when subscribers join your text list. This does not mean however that charges 100% will not occur. Charges that may occur fall under part of the compliance statement stating "Message and Data rates may apply."
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="accordion-item shadow">
										<h2 class="accordion-header" id="headingInThree">
											<button class="accordion-button collapsed fs-14 days-details" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInThree" aria-expanded="false" aria-controls="collapseInThree">
												<span> Day 3 </span>
												Flight Around USA NYCC
											</button>
										</h2>
										<div id="collapseInThree" class="accordion-collapse collapse" aria-labelledby="headingInThree" data-bs-parent="#itdefault-accordion-example">
											<div class="accordion-body">
												<div class="row">
													<div class="col-lg-4 col-sm-6 col-xs-12">
														<div class="itinerary-image">
															<img class="" src="https://fitnessity-production.s3.amazonaws.com/activity/90R9Ri4W577QRFXawD80KDShqZ55bpGI6eXtCfVY.jpg" alt="image">
														</div>
													</div>
													<div class="col-lg-8 col-sm-6 col-xs-12">
														No charges are put in place by SlickText when subscribers join your text list. This does not mean however that charges 100% will not occur. Charges that may occur fall under part of the compliance statement stating "Message and Data rates may apply."
													</div>
												</div>
											</div>
										</div>
									</div> --}}
									@endforeach
								</div>

							</div>

							<!-- <div class="panel-group itinerary mb-30" id="dis-accordion" role="tablist" aria-multiselectable="true">

								@foreach($service->days_title_arry as $i=>$title)
								<div class="panel">
									<div class="panel-heading" role="tab" id="headingOne{{$i}}">
										<h4 class="panel-title days-details">
											<a role="button" data-toggle="collapse" data-parent="#dis-accordion" href="#AcollapseOne{{$i}}" aria-expanded="true" aria-controls="AcollapseOne{{$i}}">
												<span> Day {{$i+1}} </span>
												{{$title}}
											</a>
										</h4>
									</div>
									<div id="AcollapseOne{{$i}}" class="panel-collapse collapse @if($i==0) in @endif" role="tabpanel" aria-labelledby="headingOne{{$i}}">
										<div class="panel-body">
											<div class="row">
												<div class="col-lg-4 col-sm-6 col-xs-12">
													<div class="itinerary-image">
														@php
                                                            $dayPic = @$service->days_img_arry[$i] != ''  ?  Storage::Url(@$service->days_img_arry[$i]) : url('/public/images/Upload-Icon.png');
                                                        @endphp
														<img class="" src="{{$dayPic}}" alt="image">
													</div>
												</div>
												<div class="col-lg-8 col-sm-6 col-xs-12">
													<p>{{$service->days_desc_arry[$i]}}</p>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								@endforeach
							</div> -->
							<!-- end of #accordion -->
		  				</div>
		  			@endif

					<div class="separator-border-bottom">
						<h3 class="subtitle details-sp"> Things To Know </h3>
						<div class="live-preview mb-25">
							<div class="accordion accordion-border-box" id="default-accordion-example">
								<div class="accordion-item shadow">
									<h2 class="accordion-header" id="headingOne">
										<button class="accordion-button fs-14" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
											Know Before You Go
										</button>
									</h2>
									<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
										<div class="accordion-body">
											{{-- Although you probably won’t get into any legal trouble if you do it just once, why risk it? If you made your subscribers a promise, you should honor that. If not, you run the risk of a drastic increase in opt outs, which will only hurt you in the long run. --}}
											<p class="break-word">{!! @$service->know_before_you_go !!} </p>
										</div>
									</div>
								</div>
								<div class="accordion-item shadow">
									<h2 class="accordion-header" id="headingTwo">
										<button class="accordion-button collapsed fs-14" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
											What to Bring
										</button>
									</h2>
									<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#default-accordion-example">
										<div class="accordion-body">
											{{-- No charges are put in place by SlickText when subscribers join your text list. This does not mean however that charges 100% will not occur. Charges that may occur fall under part of the compliance statement stating "Message and Data rates may apply." --}}
											{{@$service->bring_wear  ?? 'N/A'}}
										</div>
									</div>
								</div>
								<div class="accordion-item shadow">
									<h2 class="accordion-header" id="headingThree">
										<button class="accordion-button collapsed fs-14" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
											Accessibility
										</button>
									</h2>
									<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#default-accordion-example">
										<div class="accordion-body">
											{{-- Now that you have a general idea of the amount of texts you will need per month, simply find a plan size that allows you to have this allotment, plus some extra for growth. Don't worry, there are no mistakes to be made here. You can always upgrade and downgrade. --}}
											{{@$service->accessibility  ?? 'N/A'}}
										</div>
									</div>
								</div>
								<div class="accordion-item shadow">
									<h2 class="accordion-header" id="headingFour">
										<button class="accordion-button collapsed fs-14" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
											Transportation Details
										</button>
									</h2>
									<div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#default-accordion-example">
										<div class="accordion-body">
											{{-- Now that you have a general idea of the amount of texts you will need per month, simply find a plan size that allows you to have this allotment, plus some extra for growth. Don't worry, there are no mistakes to be made here. You can always upgrade and downgrade. --}}
											{{@$service->desc_location  ?? 'N/A'}}
										</div>
									</div>
								</div>
								<div class="accordion-item shadow">
									<h2 class="accordion-header" id="headingFive">
										<button class="accordion-button collapsed fs-14" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
											Cancellation Policy
										</button>
									</h2>
									<div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#default-accordion-example">
										<div class="accordion-body">
											{{-- Now that you have a general idea of the amount of texts you will need per month, simply find a plan size that allows you to have this allotment, plus some extra for growth. Don't worry, there are no mistakes to be made here. You can always upgrade and downgrade. --}}
											{{@$service->cancellation_policy ?? 'N/A'}}
										</div>
									</div>
								</div>
								<div class="accordion-item shadow">
									<h2 class="accordion-header" id="headingSix">
										<button class="accordion-button collapsed fs-14" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
											Safety & Cleaning
										</button>
									</h2>
									<div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#default-accordion-example">
										<div class="accordion-body">
											{{-- Now that you have a general idea of the amount of texts you will need per month, simply find a plan size that allows you to have this allotment, plus some extra for growth. Don't worry, there are no mistakes to be made here. You can always upgrade and downgrade. --}}
											@if($service->id_proof == 1)
												Require the booker to have ID upon arrival for verificaiton of age and identity <br>
											@endif

											@if($service->id_vaccine == 1)
												Require the booker to have proof of Vacination. <br>
											@endif

											@if($service->id_covid == 1)
												Require the booker to have proof of a negative Covid-19 test. <br>
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="panel-group thingstoknow mb-30" id="things-accordion" role="tablist" aria-multiselectable="true">
							<div class="panel">
								<div class="panel-heading" role="tab" id="headingOne">
									<h4 class="panel-title days-details">
										<a role="button" data-toggle="collapse" data-parent="#things-accordion" href="#TcollapseOne" aria-expanded="true" aria-controls="TcollapseOne">
											Know Before You Go
										</a>
									</h4>
								</div>
								<div id="TcollapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
									<div class="panel-body">
										<p style="word-wrap: break-word">{!! @$service->know_before_you_go !!} </p>
									</div>
								</div>
							</div>

							<div class="panel">
								<div class="panel-heading" role="tab" id="headingTwo">
									<h4 class="panel-title days-details">
										<a class="collapsed" role="button" data-toggle="collapse" data-parent="#things-accordion" href="#TcollapseTwo" aria-expanded="false" aria-controls="TcollapseTwo">
											What to Bring
										</a>
									</h4>
								</div>
								<div id="TcollapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
									<div class="panel-body">
										<p>{{@$service->bring_wear  ?? 'N/A'}}</p>
									</div>
								</div>
							</div>

							<div class="panel">
								<div class="panel-heading" role="tab" id="headingThree">
									<h4 class="panel-title days-details">
										<a class="collapsed" role="button" data-toggle="collapse" data-parent="#things-accordion" href="#TcollapseThree" aria-expanded="false" aria-controls="TcollapseThree">
											Accessibility
										</a>
									</h4>
								</div>
								<div id="TcollapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
									<div class="panel-body">
										<p>{{@$service->accessibility  ?? 'N/A'}} </p>
									</div>
								</div>
							</div>
							
							<div class="panel">
								<div class="panel-heading" role="tab" id="headingFour">
									<h4 class="panel-title days-details">
										<a class="collapsed" role="button" data-toggle="collapse" data-parent="#things-accordion" href="#TcollapseFour" aria-expanded="false" aria-controls="TcollapseFour">
											Transportation Details
										</a>
									</h4>
								</div>
								<div id="TcollapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
									<div class="panel-body">
										<p>{{@$service->desc_location  ?? 'N/A'}}</p>
									</div>
								</div>
							</div>

							<div class="panel">
								<div class="panel-heading" role="tab" id="headingSix">
									<h4 class="panel-title days-details">
										<a class="collapsed" role="button" data-toggle="collapse" data-parent="#things-accordion" href="#TcollapseSix" aria-expanded="false" aria-controls="TcollapseSix">
											Cancellation Policy
										</a>
									</h4>
								</div>
								<div id="TcollapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
									<div class="panel-body">
										{{@$service->cancellation_policy ?? 'N/A'}}
									</div>
								</div>
							</div>

							<div class="panel">
								<div class="panel-heading" role="tab" id="headingSeven">
									<h4 class="panel-title days-details">
										<a class="collapsed" role="button" data-toggle="collapse" data-parent="#things-accordion" href="#TcollapseSeven" aria-expanded="false" aria-controls="TcollapseSeven">
											Safety & Cleaning
										</a>
									</h4>
								</div>
								<div id="TcollapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
									<div class="panel-body">
										<p>
											@if($service->id_proof == 1)
												Require the booker to have ID upon arrival for verificaiton of age and identity <br>
											@endif

											@if($service->id_vaccine == 1)
												Require the booker to have proof of Vacination. <br>
											@endif

											@if($service->id_covid == 1)
												Require the booker to have proof of a negative Covid-19 test. <br>
											@endif
										</p>
									</div>
								</div>
							</div>

						</div> -->
						<!-- end of #accordion -->
	  				</div>

	  				@if($service->service_type == 'experience' && $service->exp_highlight)
						<div class="separator-border-bottom">
							<h3 class="subtitle details-sp pb-0"> Highlights </h3>
							<div class="row ">
								<div class="col-lg-12">
									<div class="adventuresandtoures mb-30">
										<!-- <ul>
											<li><i class="fas fa-check-circle text-light-green"></i> {!!$service->exp_highlight !!}</li>
										</ul> -->

										{!!$service->exp_highlight !!}
									</div>
								</div>
							</div>
						</div>
					@endif

					@if($service->service_type == 'experience')
						<div class="separator-border-bottom">
							<h3 class="subtitle details-sp pb-0"> Included/Not Included </h3>
							<div class="row ">
								<div class="col-lg-6 col-sm-6  col-xs-12">
									<div class="adventuresandtoures mb-30">
										<ul>
											@foreach($service->included_items_ary as $items)
												<li><i class="fas fa-check-circle text-light-green"></i> {{$items}} </li>
											@endforeach
										</ul>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6  col-xs-12">
									<div class="adventuresandtoures mb-30">
										<ul>
											@foreach($service->not_included_items_ary as $items)
												<li><i class="fas fa-check-circle text-light-red"></i> {{$items}} </li>
											@endforeach
										</ul>
									</div>
									
								</div>
							</div>
						</div>
					@endif

					{{-- @if($service->businessServicesFaq()->count() > 0) --}}
						{{-- <div class="separator-border-bottom">
							<h3 class="subtitle details-sp"> Frequently asked questions </h3>
							<div class="live-preview mb-25">
								<div class="accordion accordion-border-box" id="Frdefault-accordion-example">
									@foreach($service->businessServicesFaq as $i=>$faq)
									<div class="accordion-item shadow">
										<h2 class="accordion-header" id="headingFrOne">
											<button class="accordion-button fs-14 days-details" type="button" data-bs-toggle="collapse{{$i}}" data-bs-target="#collapseFrOne{{$i}}" aria-expanded="true" aria-controls="collapseFrOne{{$i}}">
												{{$faq->faq_title}}            
											</button>
										</h2>
										<div id="collapseFrOne{{$i}}" class="accordion-collapse collapse show" aria-labelledby="headingFrOne{{$i}}" data-bs-parent="#Frdefault-accordion-example">
											<div class="accordion-body">
												{{$faq->faq_answer}} 
											</div>
										</div>
									</div>
									@endforeach --}}

									{{-- <div class="accordion-item shadow">
										<h2 class="accordion-header" id="headingFrTwo">
											<button class="accordion-button fs-14 days-details collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFrTwo" aria-expanded="false" aria-controls="collapseFrTwo">
												<span> Day 3 </span>
												Why do we use it ?
											</button>
										</h2>
										<div id="collapseFrTwo" class="accordion-collapse collapse" aria-labelledby="headingFrTwo" data-bs-parent="#Frdefault-accordion-example">
											<div class="accordion-body">
												No charges are put in place by SlickText when subscribers join your text list. This does not mean however that charges 100% will not occur. Charges that may occur fall under part of the compliance statement stating "Message and Data rates may apply."
											</div>
										</div>
									</div> --}}
								{{-- </div>
							</div> --}}
							<!-- <div class="panel-group fre-questions mb-30" id="Fre-accordion" role="tablist" aria-multiselectable="true">
								{{-- @foreach($service->businessServicesFaq as $i=>$faq) --}}
									<div class="panel">
										{{-- <div class="panel-heading" role="tab" id="headingfaq{{$i}}"> --}}
											<h4 class="panel-title days-details">
												{{-- <a role="button" data-toggle="collapse" data-parent="#fre-accordion" href="#Fcollapsefaq{{$i}}" aria-expanded="true" aria-controls="Fcollapsefaq{{$i}}"> --}}
													<span><i class="fas fa-question-circle"></i></span>
													{{-- {{$faq->faq_title}}                       --}}
												</a>
											</h4>
										</div>
										{{-- <div id="Fcollapsefaq{{$i}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfaq{{$i}}"> --}}
											{{-- <div class="panel-body">{{$faq->faq_answer}}  --}}
											</div>
										</div>
									</div>
								{{-- @endforeach --}}
							</div> -->
		  				{{-- </div> --}}
		  			{{-- @endif --}}


					  @if($service->businessServicesFaq()->count() > 0)
					  <div class="separator-border-bottom">
						  <h3 class="subtitle details-sp"> Frequently asked questions </h3>
						  <div class="live-preview mb-25">
							  <div class="accordion accordion-border-box" id="Frdefault-accordion-example">
								  @foreach($service->businessServicesFaq as $i => $faq)
									  <div class="accordion-item shadow">
										  <h2 class="accordion-header" id="headingFrOne{{$i}}">
											  <button class="accordion-button fs-14 days-details {{ $i === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFrOne{{$i}}" aria-expanded="{{ $i === 0 ? 'true' : 'false' }}" aria-controls="collapseFrOne{{$i}}">
												  {{$faq->faq_title}}            
											  </button>
										  </h2>
										  <div id="collapseFrOne{{$i}}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" aria-labelledby="headingFrOne{{$i}}" data-bs-parent="#Frdefault-accordion-example">
											  <div class="accordion-body">
												  {{$faq->faq_answer}} 
											  </div>
										  </div>
									  </div>
								  @endforeach
							  </div>
						  </div>
					  </div>
				  @endif
				  
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
					
	            	<div class="mainboxborder mb-25">	
						<div class="container">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="">
										<h3 class="date-title mt-10 mb-20"></h3>
										<label class="mb-10 fw-600">Step: 1 </label> <span class="">Select Date</span>
										<div class="">
											<div class="activityselect3 special-date mb-20">
												<input type="text" name="actfildate_forcart" id="actfildate_forcart" placeholder="Date" class="form-control" autocomplete="off"  onchange="updatedetail('{{$company->id}}','{{$sid}}','date','');" >
												<i class="fa fa-calendar"></i>
											</div>
										</div> 
									</div>
									<div class="border-bottom-grey mb-15"></div>
								</div>
								
								@php 
									$date = date('l').', '.date('F d,  Y'); 
									$totalquantity = 0;
								@endphp 
								<div id="updatefilterforcart">
								</div>
							</div> 
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<div class="font-red text-center mb-10" id="spoterror">
								</div>
							</div>
						</div> 
						
					</div>

					<div class="mainboxborder mb-25">
						<div class="container">
							<div class="row y-middle">
								<div class="col-lg-12">
									<div class="host-details">
										<h3 class="mb-20">Meet The Owner</h3>
									</div>
								</div>
								<div class="col-lg-4 col-xs-5">
									<div class="text-center host-photo">
										@if(Storage::disk('s3')->exists($company->owner_pic) && !empty($company->owner_pic) )
											<img alt="avatar" width="90" height="90" src="{{Storage::URL($company->owner_pic)}}" class="mb-15">        
										@else 
											<div class="company-list-text mb-10">
												<p class="character">{{substr($company->first_letter, 0, 1)}}</p>
											</div>
										@endif
										<p class="fs-18">{{$company->full_name}}</p>   
										<p>Host</p>
									</div>
								</div>
								<div class="col-lg-8 col-xs-7">
									<div class="row">
										<div class="col-lg-6 col-sm-6 col-xs-12">
											<div class="host-re-details r-host-re-detail">
												<label>{{$company->businessReview()->count()}}</label>
												<p>Review</p>
											</div>
											<div class="host-re-details r-host-re-detail">
												<label>{{$company->business_review_avg}} <i class="fa fa-star text-black" aria-hidden="true"></i></label>
												<p>Ratings</p>
											</div>
											<div class="host-re-details r-host-re-detail">
												<label>{{$company->UserBookingDetails()->count()}}</label>
												<p>Bookings</p>
											</div>
										</div>
										<div class="col-lg-6 col-sm-6 col-xs-12">
											<div class="host-re-details r-host-re-detail activity-top-border">
												<label>{{$company->years_of_hosting}}</label>
												<p>Years Hosting</p>
											</div>
											<div class="host-re-details r-host-re-detail">
												<label>{{$company->years_of_exp}} years</label>
												<p>Experience</p>
											</div>
											<div class="host-re-details r-host-re-detail">
												<label>{{$company->business_service ? $company->business_service->languages : 'English'}}</label>
												<p>Languages</p>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-lg-12">
									<div class="separator-border-bottom  mt-15 mb-15"></div>

									@if($company->born)
										<div class="country-born mb-15">
											<i class="fas fa-birthday-cake mr-15 d-inline"></i>
											<p class="d-inline">Country Born: {{$company->owner_country}}</p>
										</div>
									@endif

									@if($company->about_host)
										<div class="separator-border-bottom"></div>
										<div class="mt-10">
											<p><i class="fas fa-exclamation-circle"></i> {!! $company->about_host !!}</p>
										</div>
									@endif
								</div>
							</div>
						</div>
					</div>

					<div class="mainboxborder">
						<div class="container">
							<div class="row">
								<div class="col-lg-12">
									<div class="host-details">
										<h3 class="mb-20">Host Contact Details</h3>
									</div>
									<div class="host-contact">
										<label>Address</label>
										<p>{{$company->company_address()}}</p>

										<label>Phone</label>
										<p>{{$company->business_phone}}</p>

										<label>Email</label>
										<p>{{$company->business_email}}</p>

										<label>Website</label>
										<p>{{$company->business_website}}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
		        </div>	
			</div>

			<div class="row">
				<div class="col-lg-12">
					<div class="separator-border-bottom">
						<h3 class="subtitle details-sp font-32 pb-0"><i class="fa fa-star text-black" aria-hidden="true"></i> {{$service->all_over_review}} · {{$service->reviews->count()}} reviews</h3>
						
						<div class="row mb-30">
							<div class="col-lg-4">
								<div class="overall-rating  mb-15">
<<<<<<< HEAD
									<label>Overall rating</label>
=======
									<label>Overall rating </label>
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
									<div class="row y-middle">
										<div class="col-lg-2">
											<div class="rating-total-star">
												<span class="mb-0">5</span>
											</div>
										</div>
										<div class="col-lg-10">
											<div class="progress">
												<div class="progress-bar" role="progressbar" style="width: {{countStarRatings($sid)['star_5']}}%" aria-valuenow="{{countStarRatings($sid)['star_5']}}" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
									<div class="row y-middle">
										<div class="col-lg-2">
											<div class="rating-total-star">
												<span class="mb-0">4</span>
											</div>
										</div>
										<div class="col-lg-10">
											<div class="progress">
												<div class="progress-bar" role="progressbar" style="width: {{countStarRatings($sid)['star_4']}}%" aria-valuenow="{{countStarRatings($sid)['star_4']}}" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
									<div class="row y-middle">
										<div class="col-lg-2">
											<div class="rating-total-star">
												<span class="mb-0">3</span>
											</div>
										</div>
										<div class="col-lg-10">
											<div class="progress">
												<div class="progress-bar" role="progressbar" style="width: {{countStarRatings($sid)['star_3']}}%" aria-valuenow="{{countStarRatings($sid)['star_3']}}" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
									<div class="row y-middle">
										<div class="col-lg-2">
											<div class="rating-total-star">
												<span class="mb-0">2</span>
											</div>
										</div>
										<div class="col-lg-10">
											<div class="progress">
												<div class="progress-bar" role="progressbar" style="width: {{countStarRatings($sid)['star_2']}}%" aria-valuenow="{{countStarRatings($sid)['star_2']}}" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
									<div class="row y-middle">
										<div class="col-lg-2">
											<div class="rating-total-star">
												<span class="mb-0">1</span>
											</div>
										</div>
										<div class="col-lg-10">
											<div class="progress">
												<div class="progress-bar" role="progressbar"  style="width: {{countStarRatings($sid)['star_1']}}%" aria-valuenow="{{countStarRatings($sid)['star_1']}}" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-2 col-md-6 col-sm-6 col-6 right-border mb-15">
								<div class="mb-15">
									<label>Cleanliness</label>
									<div class="short-review">
										<h3>{{getBusinessServiceCount($sid,'cleanliness')}}</h3>	
										<i class="fas fa-pump-soap"></i>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-md-6 col-sm-3 col-sm-6 col-6 right-border mb-15">
								<div class="mb-15">
									<label>Check-in</label>
									<div class="short-review">
										<h3>{{getBusinessServiceCount($sid,'checkin')}}</h3>	
										<i class="fas fa-key"></i>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-md-6 col-sm-3 col-sm-6 col-6 right-border mb-15">
								<div class="mb-15">
									<label>Communication</label>
									<div class="short-review">
										<h3>{{getBusinessServiceCount($sid,'communication')}}</h3>	
										<i class="fas fa-comment-alt"></i>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-md-6 col-sm-3 col-sm-6 col-6 right-border mb-15">
								<div class="mb-15">
									<label>Customer Service </label>
									<div class="short-review">
										<h3>{{getBusinessServiceCount($sid,'customer_service')}}</h3>	
										<i class="fas fa-users-cog"></i>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-md-6 col-sm-3 col-sm-6 col-6 right-border mb-15">
								<div class="mb-15">
									<label>Location</label>
									<div class="short-review">
										<h3>{{getBusinessServiceCount($sid,'location')}}</h3>	
										<i class="fas fa-map-marker-alt"></i>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-md-6 col-6 col-sm-6 col-sm-3">
								<div class="mb-15">
									<label>Value</label>
									<div class="short-review">
										<h3>{{getBusinessServiceCount($sid,'value')}}</h3>	
										<i class="fas fa-hands"></i>
									</div>
								</div>
							</div>
							<!-- <div class="col-lg-2 col-xs-6 col-sm-3">
								<div class="mb-15">
									<label>Accuracy</label>
									<div class="short-review">
										<h3>{{getBusinessServiceCount($sid,'accuracy')}}</h3>	
										<i class="fas fa-check-circle"></i>
									</div>
								</div>
							</div> -->
						</div>
					</div>
					<div class="separator-border-bottom">
						<div class="mtb-30">
							<div class="row">
								{{-- @foreach($service->reviews()->latest()->limit(2)->get() as $review)
								<div class="col-lg-6">
									<div class="row y-middle mb-25">
										<div class="col-lg-2 col-md-2 col-sm-2 col-3">
											<div class="company-list-text mb-10">
												<p class="character">{{$review->User->first_letter}}</p>
											</div>
										</div>
										<div class="col-lg-10">
											<div class="review-sendername">
												<label>{{$review->User->full_name}}</label>
												<p>{{$review->User->country}} </p>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mt-15 inner-review-star">
												<div class="display-inline-b">
													@if($review->all_over_review > 0)
														@for($i = 1; $i < $review->all_over_review;$i++)
															<i class="fa fa-star text-black" aria-hidden="true"></i>
														@endfor
													@endif
												</div>												
												<div class="display-inline-b"><i class="fas fa-circle dot-fs"></i></div>
												<div class="display-inline-b">
													<label>{{$review->date}}</label>
												</div>
											</div>
											<div>
												<p>{{$review->title}}</p>
											</div>
											<div class="mt-15 mb-15">
												<a data-toggle="modal" data-bs-toggle="modal" data-bs-target="#exampleModal">Show More</a>
											</div>
										</div>
									</div>
								</div>
								@endforeach --}}
								@foreach($service->reviews()->latest()->limit(2)->get() as $review)
								<div class="col-lg-6">
									<div class="row y-middle mb-25">
										<div class="col-lg-2 col-md-2 col-sm-2 col-3">
											<div class="company-list-text mb-10">
<<<<<<< HEAD
												@if(is_object($review->User) && property_exists($review->User, 'profile_pic'))
													<p class="character">{{$review->User->profile_pic}}</p>
												@else
													<p class="character">{{$review->User->first_letter}}</p>
=======
												@if(is_object($review->User) && property_exists($review->User, 'first_letter'))
													<p class="character">{{$review->User->first_letter}}</p>
												@else
													<p class="character">N/A</p>
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
												@endif
											</div>
										</div>
										<div class="col-lg-10">
											<div class="review-sendername">
												@if(is_object($review->User))
													<label>{{$review->User->full_name}}</label>
													<p>{{$review->User->country}} </p>
												@else
													<label>Anonymous</label>
													<p>N/A</p>
												@endif
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mt-15 inner-review-star">
												<div class="display-inline-b">
													@if($review->all_over_review > 0)
														@for($i = 1; $i <= $review->all_over_review; $i++)
															<i class="fa fa-star text-black" aria-hidden="true"></i>
														@endfor
													@endif
												</div>
												<div class="display-inline-b"><i class="fas fa-circle dot-fs"></i></div>
												<div class="display-inline-b">
													<label>{{$review->date}}</label>
												</div>
											</div>
											<div>
												<p>{{$review->title}}</p>
											</div>
											<div class="mt-15 mb-15">
												<a data-toggle="modal" data-bs-toggle="modal" data-bs-target="#exampleModal">Show More</a>
											</div>
										</div>
									</div>
								</div>
							@endforeach
							
							</div>

							@if($service->reviews()->count() > 0)
								<div class="btn btn-red mb-15">
									<a data-toggle="modal" data-bs-toggle="modal" data-bs-target="#exampleModal">Show all {{$service->reviews()->count()}} reviews</a>
								</div>
							@endif

							<button class="btn btn-red mb-15 displayReview">Submit Review</button>
							<div class="review_section">
								<form id="submit_review" enctype="multipart/form-data">
									@csrf
									<input type="hidden" name="sid" value="{{ $sid}}">
									<div class="row">
										<div class="col-lg-12">
											<div class="mb-15">
												<input class="form-control" type="text" placeholder="Name *" name="name" id="name">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-15">
												<input class="form-control" type="text" placeholder="Title" name="title" id="title">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-15">
												<input type="file" id="avatar" class="form-control" name="images[]" accept="image/png, image/jpeg" multiple/>
											</div>
										</div>
										<div class="col-lg-5 col-sm-6 col-xs-12 ">
											<div class="mb-15 star-rating-review">
												<div class="row">
													<div class="col-lg-6 col-sm-6 col-xs-6">
														<label>Cleanliness</label>
													</div>
													<div class="col-lg-6 col-sm-6 col-xs-6">
														<div class="text-right">
 															<input type="hidden" name="cleanliness" id="cleanliness" value="0">
															<div id="cleanliness-stars" class="starrr stars" style="font-size:22px"></div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-6 col-sm-6 col-xs-6">
														<label>Accuracy</label>
													</div>
													<div class="col-lg-6 col-sm-6 col-xs-6">
														<div class="text-right">
															<input type="hidden" name="accuracy" id="accuracy" value="0">
															<div id="accuracy-stars" class="starrr" style="font-size:22px"></div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-6 col-sm-6 col-xs-6">
														<label>Check-In</label>
													</div>
													<div class="col-lg-6 col-sm-6 col-xs-6">
														<div class="text-right">
															<input type="hidden" name="checkin" id="checkin" value="0">
															<div  id="checkin-stars" class="starrr" style="font-size:22px"></div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-6 col-sm-6 col-xs-6">
														<label>Communication</label>
													</div>
													<div class="col-lg-6 col-sm-6 col-xs-6">
														<div class="text-right">
															<input type="hidden" name="communication" id="communication" value="0">
															<div id="communication-stars" class="starrr" style="font-size:22px"></div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-6 col-sm-6 col-xs-6">
														<label>Customer Service</label>
													</div>
													<div class="col-lg-6 col-sm-6 col-xs-6">
														<div class="text-right">
															<input type="hidden" name="customer_service" id="customer_service" value="0">
															<div id="customer_service-stars" class="starrr" style="font-size:22px"></div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-6 col-sm-6 col-xs-6">
														<label>Location</label>
													</div>
													<div class="col-lg-6 col-sm-6 col-xs-6">
														<div class="text-right">
															<input type="hidden" name="location" id="location" value="0">
															<div id="location-stars" class="starrr" style="font-size:22px"></div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-6 col-sm-6 col-xs-6">
														<label>Value</label>
													</div>
													<div class="col-lg-6 col-sm-6 col-xs-6">
														<div class="text-right">
															<input type="hidden" name="value" id="value" value="0">
															<div id="value-stars" class="starrr" style="font-size:22px"></div>
														</div>
													</div>
												</div>

											</div>
										</div>
										
										<div class="col-lg-7 col-sm-6 col-xs-12">
											<div class="mb-15">
												<textarea class="form-control" placeholder="Send us your Review" name="message" id="message" rows="10"></textarea>
											</div>
										</div>

										<div class="col-lg-12 col-sm-12 col-xs-12 fs-16 form-error font-red" id="error-message"></div>	

										<div class="col-lg-12 col-sm-12 col-xs-12">
											<button class="btn btn-red mt-10 mb-15"> Post Review </button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>

				</div>

				<div class="col-lg-12">
					<div class="mx-sp separator-border-bottom">
						<h3 class="subtitle details-sp font-32 mtb-15 pb-0">Where you'll be</h3>
						<div class="mb-25">
							<p>{{$company->company_address()}}</p>
						</div>
						<div class="widget map-mb-35" style="height:500px">
							<div class="mysrchmap">
								<div id="map_canvas" style="position: absolute; top: 0; right: 0; bottom: 0; left: 0;"></div>
							</div>
							<div class="maparea"></div>
						</div>
						<?php   
							$locations = []; 
			          		if($company->latitude != '' || $company->longitude  != ''){
								$lat = $company->latitude + ((floatVal('0.' . rand(1, 9)) * 1) / 10000);
								$long = $company->longitude + ((floatVal('0.' . rand(1, 9)) * 1) / 10000);
								$a = [$company->dba_business_name, $lat, $long,$company->id, $company->getCompanyImage()];
								array_push($locations, $a);
							}
						?>
					</div>
				</div>

				<div class="col-lg-12">
					<h3 class="subtitle text-center mtb-30">Other Activities Offered By {{$company->public_company_name}}</h3>

					<div class="row">
						<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
							<div class="container">
								<div class="row y-middle">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
										<div class="activityselect3 special-date dropdowns mb-15 ">
											<input type="text" name="actfildate" id="actfildate" placeholder="Date" class="form-control" onchange="actFilter('{{$company->id}}','{{$sid}}'')" autocomplete="off" value="{{date('M-d-Y')}}">
											<i class="fa fa-calendar"></i>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
										<div class="dropdowns mb-15">
											<select id="actfiloffer{{$sid}}" name="actfiloffer" class="form-control form-select activityselect1" onchange="actFilter('{{$company->id}}','{{$sid}}')">
												<option value="">Activity Offered</option>
												@if (!empty($activityOffered)) 
													@foreach ($activityOffered as  $off)
														<option>{{$off['sport_activity']}}</option>
													@endforeach
												@endif 
											</select>
										</div>
									</div>
									<div class="col-lg-3 col-md-4 col-xs-6">
										<div class="modal-filter-instant morefilter float-right mb-15">
											<p>More Filters &nbsp; <i class="fas fa-filter"></i></p>
										</div>
									</div>
									<div id="filteroption" class="mt-15" style="display: none">
										<div class="">
											<div class="row">
												<div class="col-md-6 col-sm-6 col-xs-6">
													<div class="dropdowns mb-15">
														<select id="actfillocation{{$sid}}" name="actfillocation" class="form-control form-select activityselect2" onchange="actFilter('{{$company->id}}','{{$sid}}')">
															<option value="">Location</option>
															<option value="Online">Online</option>
															<option value="At Business">At Business Address</option>
															<option value="On Location">On Location</option>
														</select>
													</div>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<div class="dropdowns mb-15">
														<select id="actfilmtype" name="actfilmtype" class="form-control form-select activityselmtype" onchange="actFilter('{{$company->id}}','{{$sid}}')">
															<option value="">Membership Type</option>
															<option>Drop In</option>
															<option>Semester</option>
														</select>
													</div>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<div class="dropdowns mb-15">
														<select id="actfilgreatfor{{$sid}}" name="actfilgreatfor" class="form-control form-select activityselgreatfor" onchange="actFilter('{{$company->id}}','{{$sid}}')">
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
													<div class="dropdowns mb-15">
														<select id="actfilbtype{{$sid}}" name="actfilbtype" class="form-control form-select activityselbtype" onchange="actFilter('{{$company->id}}','{{$sid}}')">
															<option value="">Business Type</option>
															<option value="individual">Personal Trainer</option>
															<option value="classes">Classes</option>
															<option value="events">Events</option>
															<option value="experience">Experience</option>
														</select>
													</div>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<div class="dropdowns mb-15">
														<select id="actfilsType{{$sid}}" name="actfilsType" class="form-control form-select activityselect5" onchange="actFilter('{{$company->id}}','{{$sid}}')">
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
										</div>
									</div> <!--filteroption -->
								</div>
							</div>
						</div>
					</div>

					<div  id="filtersearchdata">
						@include('activity.search_activity_file')
					</div>
				</div>
			</div>
		</div>
	</div>            

	<div class="modal fade" id="confirmredirection" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog counter-modal-size">
	        <div class="modal-content">
	            <div class="modal-body conuter-body">
	            	<div class="row">
	            		<div class="col-lg-12">
                     		<!-- <h4 class="modal-title partcipate-model">Almost Done! Before we add this to the cart, would you like to add another person to this booking? </h4> -->
                     		<h4 class="modal-title partcipate-model">Almost Done! continue add to the cart..</h4>
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

	{{-- <div class="modal fade " id="ActivtityFail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
	</div> --}}

	{{-- my code starts --}}
	{{-- <div class="modal fade" id="ActivityFail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog counter-modal-size">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body counter-body">
					<div class="row">
						<div class="col-lg-12">
							<h4 class="modal-title partcipate-model">You can't book this activity for today. Please add another time.</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	 --}}
	{{-- ends --}}
	<div class="modal fade" id="Countermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog counter-modal-size">
	        <div class="modal-content">
		
	           <div class="modal-header"> 
			   	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>  
	            <div class="modal-body conuter-body" id="Countermodalbody">
	            </div>            
	    	</div>                                                                       
	    </div>                                          
	</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
		<div class="modal-content w-100">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Reviews</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-4 col-sm-12 col-xs-12">
						<div class="modal-overall-rating  mb-15">
							<label>Overall rating</label>
							<div class="row y-middle">
								<div class="col-lg-2 col-sm-1 col-xs-2">
									<div class="modal-rating-total-star">
										<span class="mb-0">5</span>
									</div>
								</div>
								<div class="col-lg-10 col-sm-6 col-xs-10">
									<div class="progress">
										<div class="progress-bar" role="progressbar" style="width: {{countStarRatings($sid)['star_5']}}%" aria-valuenow="{{countStarRatings($sid)['star_5']}}"  aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>
							<div class="row y-middle">
								<div class="col-lg-2 col-sm-1 col-xs-2">
									<div class="modal-rating-total-star">
										<span class="mb-0">4</span>
									</div>
								</div>
								<div class="col-lg-10 col-sm-6 col-xs-10">
									<div class="progress">
										<div class="progress-bar" role="progressbar" style="width: {{countStarRatings($sid)['star_4']}}%" aria-valuenow="{{countStarRatings($sid)['star_4']}}"  aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>
							<div class="row y-middle">
								<div class="col-lg-2 col-sm-1 col-xs-2">
									<div class="modal-rating-total-star">
										<span class="mb-0">3</span>
									</div>
								</div>
								<div class="col-lg-10 col-sm-6 col-xs-10">
									<div class="progress">
										<div class="progress-bar" role="progressbar" style="width: {{countStarRatings($sid)['star_3']}}%" aria-valuenow="{{countStarRatings($sid)['star_3']}}"  aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>
							<div class="row y-middle">
								<div class="col-lg-2 col-sm-1 col-xs-2">
									<div class="modal-rating-total-star">
										<span class="mb-0">2</span>
									</div>
								</div>
								<div class="col-lg-10 col-sm-6 col-xs-10">
									<div class="progress">
										<div class="progress-bar" role="progressbar" style="width: {{countStarRatings($sid)['star_2']}}%" aria-valuenow="{{countStarRatings($sid)['star_2']}}"  aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>
							<div class="row y-middle">
								<div class="col-lg-2 col-sm-1 col-xs-2">
									<div class="modal-rating-total-star">
										<span class="mb-0">1</span>
									</div>
								</div>
								<div class="col-lg-10 col-sm-6 col-xs-10">
									<div class="progress">
										<div class="progress-bar" role="progressbar" style="width: {{countStarRatings($sid)['star_1']}}%" aria-valuenow="{{countStarRatings($sid)['star_1']}}"  aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>
						</div>
						<div>
							<div class="border-bottom-grey mb-15">
								<div class="row">
									<div class="col-lg-2 col-md-2 col-2">
										<div class="review-avatar-one">
											<i class="fas fa-pump-soap"></i>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-6">
										<div class="review-avatar-two">
											<label>Cleanliness</label>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-4">
										<div class="review-avatar-three text-right">
											<label>{{getBusinessServiceCount($sid,'cleanliness')}}</label>
										</div>
									</div>
								</div>
							</div>

							<div class="border-bottom-grey mb-15">
								<div class="row">
									<div class="col-lg-2 col-md-2 col-2">
										<div class="review-avatar-one">
											<i class="fas fa-key"></i>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-6">
										<div class="review-avatar-two">
											<label>Check-in</label>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-4">
										<div class="review-avatar-three text-right">
											<label>{{getBusinessServiceCount($sid,'checkin')}}</label>
										</div>
									</div>
								</div>
							</div>

							<div class="border-bottom-grey mb-15">
								<div class="row">
									<div class="col-lg-2 col-md-2 col-2">
										<div class="review-avatar-one">
											<i class="fas fa-comment-alt"></i>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-6">
										<div class="review-avatar-two">
											<label>Communication</label>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-4">
										<div class="review-avatar-three text-right">
											<label>{{getBusinessServiceCount($sid,'communication')}}</label>
										</div>
									</div>
								</div>
							</div>

							<div class="border-bottom-grey mb-15">
								<div class="row">
									<div class="col-lg-2 col-md-2 col-2">
										<div class="review-avatar-one">
											<i class="fas fa-users-cog"></i>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-6">
										<div class="review-avatar-two">
											<label>Customer Service</label>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-4">
										<div class="review-avatar-three text-right">
											<label>{{getBusinessServiceCount($sid,'customer_service')}}</label>
										</div>
									</div>
								</div>
							</div>

							<div class="border-bottom-grey mb-15">
								<div class="row">
									<div class="col-lg-2 col-md-2 col-2">
										<div class="review-avatar-one">
											<i class="fas fa-map-marker-alt"></i>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-6">
										<div class="review-avatar-two">
											<label>Location</label>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-4">
										<div class="review-avatar-three text-right">
											<label>{{getBusinessServiceCount($sid,'location')}}</label>
										</div>
									</div>
								</div>
							</div>

							<div class="border-bottom-grey mb-15">
								<div class="row">
									<div class="col-lg-2 col-md-2 col-2">
										<div class="review-avatar-one">
											<i class="fas fa-check-circle"></i>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-6">
										<div class="review-avatar-two">
											<label>Accuracy</label>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-4">
										<div class="review-avatar-three text-right">
											<label>{{getBusinessServiceCount($sid,'accuracy')}}</label>
										</div>
									</div>
								</div>
							</div>

							<div class="border-bottom-grey mb-15">
								<div class="row">
									<div class="col-lg-2 col-md-2 col-2">
										<div class="review-avatar-one">
											<i class="fas fa-hands"></i>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-6">
										<div class="review-avatar-two">
											<label>Value</label>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-4">
										<div class="review-avatar-three text-right">
											<label>{{getBusinessServiceCount($sid,'value')}}</label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-8 col-sm-12 col-xs-12">
						<div class="row mb-25">
							<div class="col-lg-6 col-sm-6 col-xs-6">
								<div class="modal-main-title">
								 	<label>{{$service->reviews()->count()}} reviews</label>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6 col-xs-6">
								<div class="float-right">
									<select onchange="getReview(this.value);">
										<option value="most">Most recent</option>
										<option value="highest">Highest rated</option>
										<option value="lowest">Lowest rated</option>
									</select>
								</div>
							</div>
						</div>

						<div class="reviewDiv">
							@include('activity.review' ,['reviews' => $service->reviews])
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div> -->
		</div>
  	</div>
</div>

<nav class="navbar navbar-default navbar-fixed-bottom hidden-lg visible-md visible-xs visible-sm book-now-skicky" style="background: none; border-top: none;">
  	<div class="container">
		<div class="col-xs-12">
	    	<p class="navbar-text navbar-right desktop-none" style="text-align:center;">
	    	<a href="#check_availability" class="showall-btn sticky-book-now" href="http://lvh.me:8080/activities/get_started/events">Book Now</a>
	    	</p>
		</div>
  	</div>
</nav>
@php 
   $company_data = null;
    if (Auth::check()) {
        $company_data = Auth::user()->current_company;
    }
@endphp
<<<<<<< HEAD
{{-- <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ env('MAP_KEY') }}&sensor=false"></script> --}}
@include('layouts.business.footer')

=======
@include('layouts.business.footer')

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ env('MAP_KEY') }}&sensor=false"></script>
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394

<!-- New JS -->
<script>

	$(document).ready(function() {
	    var ratingTypes = [
	        'cleanliness',
	        'accuracy',
	        'checkin',
	        'communication',
	        'customer_service',
	        'location',
	        'value'
	    ];

	    ratingTypes.forEach(function(type) {
	        $('#' + type + '-stars').starrr().on('starrr:change', function(e, value) {
	            $('#' + type).val(value);
	        });
	    });
	});


	function getReview(value){
		$.ajax({
            url: "{{route('get_review')}}", 
            type: 'POST',
            data:{
            	_token: '{{csrf_token()}}',
            	sid: '{{$sid}}',
            	type: value
            },
            success: function(response) {
            	$('.reviewDiv').html(response);
            }
        });
	}

	function validateForm() {
	    var name = $('#name').val();
	    var title = $('#title').val();
	    var message = $('#message').val();

	     var isValid = true;

	    $('.form-error').removeClass('font-green font-red font-danger').html(''); // Clear previous errors

	    if (name.trim() === '') {
	        $('.form-error').addClass('font-red').html('<div>Please enter your name.</div>');
	        isValid = false;
	    }
	    if (title.trim() === '') {
	        $('.form-error').addClass('font-red').html('<div>Please enter the review title.</div>');
	        isValid = false;
	    }
	    if (message.trim() === '') {
	        $('.form-error').addClass('font-red').html('<div>Please enter your message</div>');
	        isValid = false;
	    }

	    return isValid;
	}


	$('#submit_review').on('submit', function(event) {
        event.preventDefault(); 
        $('.form-error').removeClass('font-green font-red').html('');

        if (!validateForm()) {
            return false; // Exit if validation fails
        }

        var formData = new FormData(this);
<<<<<<< HEAD
		// alert('11');
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
        $.ajax({
            url: "{{route('save_business_service_reviews')}}", 
            type: 'POST',
            data: formData, 
            contentType: false,  // Set contentType to false when using FormData
        	processData: false, 
            success: function(response) {
              	if (response.errors) {
                	$.each(response.errors, function(index, error) {
                    	$('.form-error').addClass('font-red');
                    	$('.form-error').append('<div>' + error + '</div>');
                	});
              	}else{
                 	$('.form-error').addClass('font-green');
                 	$('.form-error').html(response.message);
                 	setTimeout(function() {
				        window.location.reload();
				    }, 1500);
              	}
          	},
	        error: function(xhr) {
	            if (xhr.responseJSON && xhr.responseJSON.errors) {
	                $.each(xhr.responseJSON.errors, function(index, error) {
	                    $('.form-error').addClass('font-red');
	                    $('.form-error').append('<div>' + error + '</div>');
	                });

	            } 
	        }
        });
    });

	$(".otherslider").owlCarousel({
        loop: true,
        autoplay: true,
		margin: 10,
        autoplayTimeout: 2000, //2000ms = 2s;
        autoplayHoverPause: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			},

			600: {
			  	items: 2
			},

			1024: {
			  	items: 3
			},
			
			1200: {
			  	items: 3
			},
			
			1366: {
			  	items: 3
			},
		  },
    });

</script>

<script>
	$('.review_section').addClass('hide')
	$('.displayReview').on('click',function(){
		$('.review_section').removeClass('hide')
		/*jQuery('.review_section').toggle();*/
	})
</script>

<script>
	$(document).ready(function() {
	  //$('.collapse.in').prev('.panel-heading').addClass('active');
	  $('#dis-accordion')
	    .on('show.bs.collapse', function(a) {
	      $(a.target).prev('.panel-heading').addClass('active');
	    })
	    .on('hide.bs.collapse', function(a) {
	      $(a.target).prev('.panel-heading').removeClass('active');
	    });
	});
</script>

<script>
	$(document).ready(function() {
	  //$('.collapse.in').prev('.panel-heading').addClass('active');
	  $('#Fre-accordion')
	    .on('show.bs.collapse', function(a) {
	      $(a.target).prev('.panel-heading').addClass('active');
	    })
	    .on('hide.bs.collapse', function(a) {
	      $(a.target).prev('.panel-heading').removeClass('active');
	    });
	});
</script>

<script>
	$(document).ready(function() {
  //$('.collapse.in').prev('.panel-heading').addClass('active');
  $('#things-accordion')
    .on('show.bs.collapse', function(a) {
      $(a.target).prev('.panel-heading').addClass('active');
    })
    .on('hide.bs.collapse', function(a) {
      $(a.target).prev('.panel-heading').removeClass('active');
    });
	});
</script>

<!-- New JS -->
<script>

	$(function () {
	    $('[data-toggle="tooltip"]').tooltip();
	});

	function getAllSelectedOptions() {
        var selectedOptions = [];

        $('#participantDiv').find('select').each(function() {
            var selectedValue = $(this).val();
            var dataType = $(this).find('option:selected').data('type');
            selectedOptions.push({ id: selectedValue, from: dataType });
        });
        
        return selectedOptions;
    }


	$(document).ready(function() {
		$(document).on("click", "#btnaddcart", function(){
			$('#spoterror').html('');
			var timechk = $('#timechk').val();
			var totalQty = parseInt($('#totalQty').val());
			var maxQty = parseInt($('#maxQty').val());
			
			if(timechk == 1){
				if(totalQty == 0){
					var message = '';

					if($('#cate_title').val() == ''){
						message = "Please select category. <br> <span class='fs-12'>Note: If the category is not available or the activity time has passed, please select another date.</span>";
					}else if($('#priceid').val() == ''){
						message = "Please select price option. <br> <span class='fs-12'>Note: If price option is not available then try another category.</span>";
					}else if($('#actscheduleid').val() == ''){
						if($('.notimeoption').html() != '' && $('.notimeoption').html() != undefined ){
							message = "<br>Please select time. <br> <span class='fs-12'>Note: If time is not available then try another category.</span>";
						}else{
							message = "<br>Please select time.";
						}
					}else{
						message = "Please select a participant.";
					}
					
					$('#spoterror').html(message);
				}else if(totalQty > maxQty ){
					$('#spoterror').html("You have "+maxQty+" sports left.");
				}else{
					var form = $("#addtocartform");

					var allSelected = true;
			        $('.familypart').each(function() {
			            if ($(this).find('option:selected').not('[value=""]').length === 0) {
			                allSelected = false;
			                return false;
			            }
			        });
        			if (allSelected) {
			           @if(Auth::check())
							var selectedOptions = getAllSelectedOptions();
							$.each(selectedOptions, function(index, option) {
					            form.append('<input type="hidden" name="participateAry['+index+'][id]" value="'+option.id+'">');
					            form.append('<input type="hidden" name="participateAry['+index+'][from]" value="'+option.from+'">');
					        });
					    @endif
						
				        var url = '{{route("addtocart")}}';
				        $.ajax({
				            type: "POST",
				            url: url,
				            data: form.serialize(),
				            success: function(data) {
				                if(data == 'no_spots'){
				                 	$('#spoterror').html("There Is No Spots left You Can't Add This Activity.");
				                }else{
				                	/*$(".btns-modal").html('<button type="button" class="addbusiness-btn-modal noborder" data-dismiss="modal">Add Another Person</button>     <a href="'+data+'" class=" addbusiness-btn-modal" id="redicttosuccess">Continue Add To Cart</a>');*/
				                	$(".btns-modal").html(' <a href="'+data+'" class=" addbusiness-btn-modal" id="redicttosuccess">Continue Add To Cart</a>');
				                	$('#confirmredirection').modal({ backdrop: 'static',keyboard: false});
				                }
				                $(".cartitmclass").load(location.href+" .cartitmclass>*","");
				            }
				        });
			        } else {
			        	$('#spoterror').html('<br>Please select all who is participant.');
			        }
					
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
		    $('#totalcnt').val(parseInt($('#totalcnt').val() + 1));
		    calculateTotal();
		    @if(Auth::check())
		    	participateCnt('adult');
		   	@endif
		});

    	$(document).on('click','.adultminus',function(){
			$('#adultcnt').val(parseInt($('#adultcnt').val()) - 1 );
			if ($('#adultcnt').val() <= 0) {
				$('#adultcnt').val(0);
			}
			$('#totalcnt').val(parseInt($('#totalcnt').val() - 1));
			if ($('#totalcnt').val() <= 0) {
				$('#totalcnt').val(0);
			}
			$('#adultCount').val(parseInt($('#adultcnt').val()));
			calculateTotal();
			@if(Auth::check())
				removeParticipateCnt('adult');
			@endif
	    });

	    $('#childcnt').prop('readonly', true);
		$(document).on('click','.childplus',function(){
			$('#childcnt').val(parseInt($('#childcnt').val()) + 1 );
			$('#totalcnt').val(parseInt($('#totalcnt').val() + 1));
			$('#childCount').val(parseInt($('#childcnt').val()));
			calculateTotal();
			@if(Auth::check())
				participateCnt('child');
			@endif
		});
    	$(document).on('click','.childminus',function(){
			$('#childcnt').val(parseInt($('#childcnt').val()) - 1 );
			$('#totalcnt').val(parseInt($('#totalcnt').val() - 1));
			if ($('#childcnt').val() <= 0) {
				$('#childcnt').val(0);
			}
			if ($('#totalcnt').val() <= 0) {
				$('#totalcnt').val(0);
			}
			$('#childCount').val(parseInt($('#childcnt').val()));
			calculateTotal();
			@if(Auth::check())
				removeParticipateCnt('child');
			@endif
	    }); 

	    $('#infantcnt').prop('disabled', true);
		$(document).on('click','.infantplus',function(){
			$('#infantcnt').val(parseInt($('#infantcnt').val()) + 1 );
			$('#totalcnt').val(parseInt($('#totalcnt').val()) + 1 );
			$('#infantCount').val(parseInt($('#infantcnt').val()));
			calculateTotal();
			@if(Auth::check())
				participateCnt('infant');
			@endif
		});
    	$(document).on('click','.infantminus',function(){
			$('#infantcnt').val(parseInt($('#infantcnt').val()) - 1 );
			$('#totalcnt').val(parseInt($('#totalcnt').val()) - 1 );
			if ($('#infantcnt').val() <= 0) {
				$('#infantcnt').val(0);
			}
			if ($('#totalcnt').val() <= 0) {
				$('#totalcnt').val(0);
			}
			$('#infantCount').val(parseInt($('#infantcnt').val()));
			calculateTotal();
			@if(Auth::check())
				removeParticipateCnt('infant');
			@endif
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

	@if(Auth::check() && !empty($company_data))
	function participateCnt(type){
			$.ajax({
	            type: "POST",
	            url: '{{route("get-participate-data")}}',
	            data: {
	            	'_token' : '{{csrf_token()}}',
	            	// 'cid' : '{{$company->id}}',
					'cid' : '{{$company_data->id}}',
	            	'priceid' : $('#selprice').val(),
	            	'type' : type,
	            },
	            success: function(data) {
	                $('#participantDiv').append(data);
	            }
	        });
		}
	@endif

	function removeParticipateCnt(type){
		$('#participantDiv').children('.'+type).last().remove();
	}

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
		if(chk == 1){
			$('#Countermodalbody').html('<div class="row "> <div class="col-lg-12 text-center"> <div class="modal-inner-txt scheduler-time-txt label-space"><label>You can\'t book this activity for today.</label><label> The time has passed.</label><label>Please choose another time.</label></div> </div></div>');
			setTimeout(function() {
				$('.participateDiv').html('<p>No Participate Available</p>');
			}, 2000);
			$('#Countermodal').modal('show');
		}else{
			updatedetail('{{$company->id}}',sid,'schedule',id);
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
		var actdate=$('#actfildate').val();
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
	// console.log(active_days);
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
					var start = new Date(active_days[i][0]);
					var end = new Date(active_days[i][1]);

					if (date >= start && date <= end) {
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
        updatedetail('{{$company->id}}','{{$sid}}','date','');
	});

	$(function() {
		$("#actfildate" ).datepicker( { 
			minDate: 0,
			changeMonth: true,
			changeYear:true,
			yearRange: "1960:2060"
		});
	});
									
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

	function getInsModal(scid){
		$('.hiddenALinkforIns').html('');
		var url= "/getInsData/?scheduleId="+scid;
			$('.hiddenALinkforIns').html('<a data-behavior="ajax_html_modal" data-url="'+url+'" id="hiddenALinkforIns"></a>');
			$('#hiddenALinkforIns')[0].click();
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
	                    '<img src="' + locations[i][4] + '" alt="fitnessity">' +
	                    '</div></div> </div>' +
	                    '<div class="row"><div class="col-lg-12" ><div class="content-claimed-business">' +
	                    '<div class="content-claimed-business-inner">' +
	                    '<div class="content-left-claimed">' +
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

