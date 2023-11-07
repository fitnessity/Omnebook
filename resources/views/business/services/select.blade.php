@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
@section('content')

    @include('layouts.business.business_topbar')

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="h-100">
                            <div class="row mb-3 pb-1">
								<div class="col-12">
									<div class="page-heading">
										<label>Create Services & Prices</label>
									</div>
									<div class="page-sub-title step1">
										<label>GET STARTED BY SELECTING A SERVICE YOU OFFER BELOW</label>
										<p>Click on one of the services below to start creating a service to offer. Only select the type of business that best represents the type of experiences you offer your clients. Don’t worry; you can set up more than one type of business type.</p>
									</div>
								</div>
                                <!--end col-->
                            </div>
                            <!--end row-->

                            <div class="step1">
                            	<div class="row">
                                    <div class="col-xl-3 col-md-6 col-sm-6">
                                        <!-- card -->
                                        <a class="card card-animate fix-box" data-id="individual">
                                            <div class="card-body">
                                                <div class="text-center selection-service">
													<img src="{{url('/public/images/newimage/bus-individual.png')}}" class="pro_card_img1">
                                                </div>
                                                <div class="text-center mt-4 service-details">
													<div class="selecting-title">Personal Trainer</div>
													<p>A provider offers one-on-one personal training, coaching, nutrition advice, or instructions.</p>
                                                </div>
                                                <div class="box-footer">
													<button type="button" class="btn-red select-event"> Select </button>
												</div>
                                            </div><!-- end card body -->
                                        </a><!-- end card -->
                                    </div><!-- end col -->

                                    <div class="col-xl-3 col-md-6 col-sm-6">
                                        <!-- card -->
                                        <a class="card card-animate fix-box" data-id="classes">
                                           <div class="card-body">
                                                <div class="text-center selection-service">
													<img src="{{url('/public/images/newimage/bus-gym.png')}}" class="pro_card_img1">
                                                </div>
                                                <div class="text-center mt-4 service-details">
													<div class="selecting-title">CLASSES</div>
													<p>A provider offers group fitness workouts and classes at a gym, studio, or facility.</p>
                                                </div>
                                                <div class="box-footer">
													<button type="button" class="btn-red select-event"> Select </button>
												</div>
                                            </div><!-- end card body -->
                                        </a><!-- end card -->
                                    </div><!-- end col -->

                                    <div class="col-xl-3 col-md-6 col-sm-6">
                                        <!-- card -->
                                        <a class="card card-animate fix-box" data-id="experience">
                                            <div class="card-body">
                                                <div class="text-center selection-service">
													<img src="{{url('/public/images/newimage/bus-experience.png')}}" class="pro_card_img1">
                                                </div>
                                                <div class="text-center mt-4 service-details">
													<div class="selecting-title">Adventures & Tours</div>
													<p>A provider that offers an adventurous activity or an experience surrounding the activity.</p>
                                                </div>
                                                <div class="box-footer">
													<button type="button" class="btn-red select-event"> Select </button>
												</div>
                                            </div><!-- end card body -->
                                        </a><!-- end card -->
                                    </div><!-- end col -->

                                    <div class="col-xl-3 col-md-6 col-sm-6">
                                        <!-- card -->
                                        <a class="card card-animate fix-box" data-id="events">
                                            <div class="card-body">
                                                <div class="text-center selection-service">
													<img src="{{url('/public/dashboard-design/images/yoga.jpeg')}}" class="pro_card_img1">
                                                </div>
                                                <div class="text-center mt-4 service-details">
													<div class="selecting-title">EVENTS</div>
													<p>You offer events, seminars, races, marathons, meets, tournaments and more.</p>
                                                </div>
                                                <div class="box-footer">
													<button type="button" class="btn-red select-event"> Select </button>
												</div>
                                            </div><!-- end card body -->
                                        </a><!-- end card -->
                                    </div><!-- end col -->
                                </div> <!-- end row-->
                            </div>

                            <div class="step2 d-none" >
                            	<div class="row">
									<div class="col-md-12">
										<div class="card">
											<div class="card-body">
												<!-- Nav tabs -->
												<ul class="nav nav-tabs nav-tabs-custom nav-success nav-justified mb-3" role="tablist">
													<li class="nav-item">
														<a class="nav-link service-nav" data-bs-toggle="tab" href="#individual" role="tab" data-id="individual">
															Personal Trainer
														</a>
													</li>
													<li class="nav-item">
														<a class="nav-link service-nav" data-bs-toggle="tab" href="#classes" role="tab" data-id="classes">
															Classes
														</a>
													</li>
													<li class="nav-item">
														<a class="nav-link service-nav" data-bs-toggle="tab" href="#experience" role="tab" data-id="experience">
															Experience
														</a>
													</li>
													<li class="nav-item">
														<a class="nav-link service-nav" data-bs-toggle="tab" href="#events" role="tab" data-id="events">
															Events
														</a>
													</li>
												</ul>

												<!-- Tab panes -->

												<div class="tab-content text-muted">
													<div class="row">
                                                        <input type="hidden" name="service_type" id="service_type" value="">
														<div class="col-lg-2 col-md-4 col-6">
															<input type="button" class="btn service-btn wp-100" value="Create Service" id="createService">
														</div>
														<div class="col-lg-2 col-md-4 col-6">
															<div class="dropdown mb-15">
																<button class="btn btn-secondary btn-selection dropdown-toggle wp-100" type="button" id="btnManageService" data-bs-toggle="dropdown" aria-expanded="false" @if($business_id == '' )disabled @endif>
																	Manage Service
																</button>
																<ul class="dropdown-menu dropdown-menu-dark selection-item-wrap manageserviceUL" aria-labelledby="btnManageService" style="">

															@if(isset($companyService) && !empty($companyService))
                        										@foreach($companyService as $cs => $service)
																	<li class="{{ $service->service_type }}"><a class="dropdown-item" href="{{route('business.services.create',['serviceType'=> $service->service_type ,'serviceId'=> $service->id])}}" > {{ $service->sport_activity}} - {{ $service->program_name}}  </a></li>
																@endforeach
                        									@endif	
																</ul>
															</div>
														</div>
													</div>
						
													<div class="tab-pane" id="individual" role="tabpanel">
														<div class="row">
															<div class="col-md-12">
																<div class="personal-trainer">
																	<p>Add the details and prices for your personal training services.</p>
																</div>
																<!-- Accordions -->
																<div class="accordion nesting-accordion custom-accordionwithicon accordion-border-box" id="accordionnestingone">
																	<div class="accordion-item">
																		<h2 class="accordion-header tips-accordion" id="accordionnestingExample1">
																			<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse1" aria-expanded="true" aria-controls="accor_nestingExamplecollapse1">
																				Recommended Tips to Do :
																			</button>
																		</h2>
																		<div id="accor_nestingExamplecollapse1" class="accordion-collapse collapse show" aria-labelledby="accordionnestingExample1" data-bs-parent="#accordionnestingone">
																			<div class="accordion-body tips">
																				<ul>
																					<li>Create a professional profile. It's your website and resumer to potential clients.</li>
																					<li>Sell your business and show what makes your business the best.</li>
																					<li>Take professional high-resolution pictures.</li>
																					<li>Showcase your certifications, awards, education, and experience.</li>
																				</ul>
																			</div>
																		</div>
																	</div>
																  
																	<div class="accordion-item">
																		<h2 class="accordion-header tips-accordion" id="accordionnestingExample2">
																			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse2" aria-expanded="false" aria-controls="accor_nestingExamplecollapse2">
																				Tips Not to Do :
																			</button>
																		</h2>
																		<div id="accor_nestingExamplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample2" data-bs-parent="#accordionnestingone">
																			<div class="accordion-body tips">
																				<ul>
																					<li>You have images that are not professional, creepy, or uncomfortable to clients.</li>
																					<li>Not having a well-planned experiences.</li>
																					<li>Just going with the flow will not give you repeat business.</li>
																					<li>Creating a generic service that customers can easily do on their own.</li>
																					<li>Offering a service or experience you are not qualified or skilled to do.</li>
																				</ul>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="tab-pane" id="classes" role="tabpanel">
														<div class="row">
															<div class="col-md-12">
																<div class="personal-trainer">
																	<p>Add the details for your group class, boot camp, clinic, and more.</p>
																</div>
																<!-- Accordions -->
																<div class="accordion nesting-accordion custom-accordionwithicon accordion-border-box" id="accordionnestingtwo">
																	<div class="accordion-item">
																		<h2 class="accordion-header tips-accordion" id="accordionnestingExample3">
																			<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse3" aria-expanded="true" aria-controls="accor_nestingExamplecollapse3">
																				Recommended Tips to Do :
																			</button>
																		</h2>
																		<div id="accor_nestingExamplecollapse3" class="accordion-collapse collapse show" aria-labelledby="accordionnestingExample3" data-bs-parent="#accordionnestingtwo">
																			<div class="accordion-body tips">
																				<ul>
																					<li>Create a professional profile. It's your website and resumes to potentials clients.</li>
																					<li>Sell your business and show what makes your business the best</li>
																					<li>Take professional pictures and make your customers feel welcomed.</li>
																				</ul>
																			</div>
																		</div>
																	</div>
																	  
																	<div class="accordion-item">
																		<h2 class="accordion-header tips-accordion" id="accordionnestingExample4">
																			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse4" aria-expanded="false" aria-controls="accor_nestingExamplecollapse4">
																				Tips Not to Do :
																			</button>
																		</h2>
																		<div id="accor_nestingExamplecollapse4" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample4" data-bs-parent="#accordionnestingtwo">
																			<div class="accordion-body tips">
																				<ul>
																					<li>Posting images or videos that are not of professional manner, creepy, or uncomfortable.</li>
																					<li>Not having a well-planned experience.</li>
																					<li>Just going with the flow will not give you repeat business.</li>
																					<li>Creating a generic service that customers can easily do on their own.</li>
																					<li>Offering a service you are not qualified or skilled to do.</li>
																				</ul>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="tab-pane" id="experience" role="tabpanel">
														<div class="row">
															<div class="col-md-12">
																<div class="personal-trainer">
																	<p>Create your itinerary, service details, and prices for your experience. Let customers know what the plans are. Describe what you will do with your customers. What's unique and sets you apart from other similar experiences? How will you make customers feel included and engaged during your time together? Being specific about what guests will do on your activity is important. Set up a detailed itinerary so that guests know what to expect.</p>
																</div>
																<!-- Accordions -->
																<div class="accordion nesting-accordion custom-accordionwithicon accordion-border-box" id="accordionnestingthree">
																	<div class="accordion-item">
																		<h2 class="accordion-header tips-accordion" id="accordionnestingExample5">
																			<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse5" aria-expanded="true" aria-controls="accor_nestingExamplecollapse5">
																				Recommended Tips to Do :
																			</button>
																		</h2>
																		<div id="accor_nestingExamplecollapse5" class="accordion-collapse collapse show" aria-labelledby="accordionnestingExample5" data-bs-parent="#accordionnestingthree">
																			<div class="accordion-body tips">
																				<ul>
																					<li>Create an experience around your activity.</li>
																					<li>Make it unique and different.</li>
																					<li>Think about your meet-up points and how customers will get to you.</li>
																					<li>Think about what your experience includes and what your customers will need to bring.</li>
																					<li>Think about your plans and think about the experience your customer will have.</li>
																				</ul>
																			</div>
																		</div>
																	</div>
																	  
																	<div class="accordion-item">
																		<h2 class="accordion-header tips-accordion" id="accordionnestingExample6">
																			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse6" aria-expanded="false" aria-controls="accor_nestingExamplecollapse6">
																				Tips Not to Do :
																			</button>
																		</h2>
																		<div id="accor_nestingExamplecollapse6" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample6" data-bs-parent="#accordionnestingthree">
																			<div class="accordion-body tips">
																				<ul>
																					<li>Having no experience planned around your activity.</li>
																					<li>Not having a well-planned experience.</li>
																					<li>Giving incomple information is not recommended.</li>
																					<li>Creating generic experiences and activities customers can easily do on their own.</li>
																					<li>Offering an experience you are not qualified or skilled to host.</li>
																				</ul>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="tab-pane" id="events" role="tabpanel">
														<div class="row">
															<div class="col-md-12">
																<div class="personal-trainer">
																	<p>Add the details for your upcoming event.</p>
																</div>
															<!-- Accordions -->
																<div class="accordion nesting-accordion custom-accordionwithicon accordion-border-box" id="accordionnestingfour">
																	<div class="accordion-item">
																		<h2 class="accordion-header tips-accordion" id="accordionnestingExample6">
																			<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse6" aria-expanded="true" aria-controls="accor_nestingExamplecollapse6">
																				Recommended Tips to Do :
																			</button>
																		</h2>
																		<div id="accor_nestingExamplecollapse6" class="accordion-collapse collapse show" aria-labelledby="accordionnestingExample6" data-bs-parent="#accordionnestingfour">
																			<div class="accordion-body tips">
																				<ul>
																					<li>Create an experience around your activity.</li>
																					<li>Make it unique and different.</li>
																					<li>Think about your meet-up points and how customers will get to you.</li>
																					<li>Think about what your experience includes and what your customers will need to bring.</li>
																					<li>Think about your plans and think about the experience your customer will have.</li>
																				</ul>
																			</div>
																		</div>
																	</div>
																	  
																	<div class="accordion-item">
																		<h2 class="accordion-header tips-accordion" id="accordionnestingExample7">
																			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse7" aria-expanded="false" aria-controls="accor_nestingExamplecollapse7">
																				Tips Not to Do :
																			</button>
																		</h2>
																		<div id="accor_nestingExamplecollapse7" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample7" data-bs-parent="#accordionnestingfour">
																			<div class="accordion-body tips">
																				<ul>
																					<li>Having no experience planned around your activity.</li>
																					<li>Not having a well-planned experience.</li>
																					<li>Giving incomple information is not recommended.</li>
																					<li>Creating generic experiences and activities customers can easily do on their own.</li>
																					<li>Offering an experience you are not qualified or skilled to host.</li>
																				</ul>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div><!-- end card-body -->
										</div><!-- end card -->
									</div>
								</div>
                            </div>
                            
                        </div> <!-- end .h-100-->
                    </div> <!-- end col -->
                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
        <!-- end main content-->
</div>
    <!-- END layout-wrapper -->

	@include('layouts.business.footer')

<script>

	$(document).ready(function() {
	 
	  	$('.service-nav').on('click', function (e) {
		    var service_type = $(e.target).attr('data-id');
		    $("#service_type").val(service_type);
		});

		$('.card-animate').on('click', function (e) {
		    var service_type = $(this).attr('data-id');
		    $('.nav-tabs a[href="#'+service_type+'"]').tab('show');
		    $("#service_type").val(service_type);
		    $(".step1").addClass("d-none");
		    $(".step2").removeClass("d-none");
		});

	  	$("#btnManageService").click(function () {
	        var service_type = $("#service_type").val();
	        $(".manageserviceUL li").hide();
	        $(".manageserviceUL li."+service_type).show();
	    });


        $("#createService").click(function () {
            var service_type = $("#service_type").val();
            window.location.href = "/business/"+{{$business_id}}+"/services/create?serviceType="+service_type;
        });
	});
	
</script>
@endsection