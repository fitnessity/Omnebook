@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')

   <div class="main-content">
		<div class="page-content">
         <div class="container-fluid">
            <div class="row">
               <div class="col">
                  <div class="h-100">
							<!-- <div class="row">
								<div class="col-lg-12">
									<div class="float-right">
										<form class="client-search" action="{{route('business_customer_index', ['business_id' => $request->current_company->id])}}" method="get">
											<input type="hidden" id="customer-id" name="customer_id" value="">
											<div class="search-set">
												<div class="position-relative">
													<input type="text" id="serchclient" name="fname" placeholder="Search for client" autocomplete="off" value="{{Request::get('fname')}}" class="search-input">
													
													<span class="mdi mdi-magnify search-widget-icon"></span>
													<span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
												</div>
												<div class="dropdown-menu dropdown-menu-lg" id="search-dropdown"></div>
											</div>
											<div class="btn-client-search">
												<button type="submit" class="btn-red-primary btn-red mmt-10" id="">Search </button>
											</div>
										</form>
									</div>
								</div>
							</div> -->
                     <div class="row mb-3">
								<div class="col-6">
									<div class="page-heading">
										<label>Activity Scheduler </label>
									</div>
								</div>
								<!-- <div class="col-6">
									<div class="service-create">
										<input type="submit" class="btn btn-red" data-bs-toggle="modal" data-bs-target=".new-client-steps" value="Add New Client">
									</div>
								</div> -->
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="card">
										<div class="card-header border-0">
											<h4 class="card-title mb-0">Date</h4>
										</div><!-- end cardheader -->
										<div class="card-body pt-0 card-350-body">
											<form method="GET">
												<div class="row">
													<div class="col-xxl-3 col-lg-4 col-md-7 col-sm-6">
														<div class="input-group mmb-10">
															<input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-range" name="date" autocomplete="off" value="{{$filterDate->format('m/d/Y')}}" data-behavior="on_change_submit">
															<div class="input-group-text bg-primary border-primary text-white">
																<i class="ri-calendar-2-line"></i>
															</div>
														</div>
													</div>
													<div class="col-xxl-2 col-lg-3 col-md-5 col-sm-5">
														<div class="steps-title mmb-10">
															<div class="mb-3">
																<select name="activity_type" data-behavior="on_change_submit" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
																	<option value=""> Show All Activities </option>
																	<option value="individual" @if(request()->activity_type == 'individual') selected @endif>Personal Trainer</option>
																	<option value="classes" @if(request()->activity_type == 'classes') selected @endif>Classes</option>
																	<option value="events" @if(request()->activity_type == 'events') selected @endif>Events</option>
																	<option value="experience" @if(request()->activity_type == 'experience') selected @endif>Experience</option>
																</select>
															</div>
														</div>												
													</div>
												</div>
											</form>

											<h6 class="text-uppercase fw-semibold mt-4 mb-3 text-muted"></h6>
											@php $total_reservations = 0; @endphp
											@foreach ($schedules as $i=>$schedule)
												@php 
													$total_reservations += $schedule->spots_reserved($filterDate);
													$schedule_end = strtotime($filterDate->format('Y/m/d').' '.$schedule['shift_end']);
											 	@endphp
												<div class="mini-stats-wid d-flex align-items-center mt-3 scheduler-box">
													<div class="flex-shrink-0 right-spretar">
														<p class="text-muted mb-0">{{date('h:i A', strtotime($schedule['shift_start']))}}</p>
														<p class="text-muted mb-0">{{date('h:i A', strtotime($schedule['shift_end']))}}</p>
													</div>
													<div class="flex-shrink-0 avatar-sm ms-3">
														<a href="{{route('business.schedulers.checkin_details.index',['scheduler'=>$schedule->id, 'date' =>$filterDate->format('m/d/Y')])}}" class="cursor-pointer">
															<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4">
																{{$schedule->spots_left($filterDate)}}/{{$schedule->spots_available}}
															</span>
														</a>
													</div>
													<div class="flex-grow-1 ms-3">
														<h3 class="fs-15 mb-1"> @if($schedule->business_service()->exists())  {{$schedule->businessPriceDetailsAges->category_title}} @endif </h3>
														<p class="mb-1"> @if($schedule->business_service()->exists()) {{$schedule->business_service->program_name}} @endif @if($schedule->businessPriceDetailsAges()->exists()) @endif  </p> 
														
														<p class="text-muted mb-0">with {{$schedule->company_information->public_company_name}} @if($schedule->business_service()->exists()) {{$schedule->business_service->activity_location}} @endif </p>
													</div>
													<div class="flex-grow-1 ms-3">
														<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".activity-scheduler{{$i}}"><i class="ri-more-fill"></i></a>
													</div>
												</div>

												<div class="modal fade activity-scheduler{{$i}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered modal-70">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="myModalLabel">Activity Scheduler</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
															</div>
															<div class="modal-body">
																<div class="scheduler-table">
																	<div class="table-responsive">
																		<table class="table mb-0">
																			<thead>
																				<tr>
																					<th>Status</th>
																					<th>Duration</th>
																					<th>Location</th>
																					<th> Instructor</th>
																					<th></th>
																				</tr>
																			</thead>
																			<tbody>
																				@php $cancelchk = $schedule->activity_cancel()->where(['cancel_date'=>$filterDate->format('Y-m-d'),'act_cancel_chk'=>1])->first(); @endphp
																				<tr>
																					<td>
																						<label class="overlay-activity-label">
																							@if ($schedule_end < time()) 			Activity Completed 
																							@elseif($cancelchk != '') 
																								Activity Canceled  
																							@else Activity Remaining @endif</label>
																					</td>
																					<td>
																						<div class="scheduled-activity-info">
																							<span>{{$schedule->get_duration()}}  </span>
																						</div>
																					</td>
																					<td>
																						<div class="scheduled-location">
																							<span> @if($schedule->business_service()->exists()) {{$schedule->business_service->activity_location}}@endif </span>
																						</div>
																					</td>
																					<td>
																						<div class="scheduled-location">
																							<span> {{ $schedule->business_service()->exists() ? ( $schedule->business_service->BusinessStaff()->exists() ? ucfirst($schedule->business_service->BusinessStaff->full_name) : "N/A" )  : "N/A"}}</span>
																						</div>
																					</td>
																					<td>
																						<?php 
																							$serviceType = $schedule->business_service()->exists() ? $schedule->business_service->service_type : '' ;

																							$serviceId= $schedule->business_service()->exists() ? $schedule->business_service->id : '' ;
																						?>
																						<div class="scheduled-btns">
																	                  <a class="btn-red mb-10 text-center" href="{{route('business.services.create',['serviceType'=>$serviceType,'serviceId'=>$serviceId])}}" target="_blank">Edit</a>

																	                  <button type="button" class="btn-black" data-behavior="ajax_html_modal" data-url="{{route('business.schedulers.delete_modal', ['schedulerId' => $schedule->id, 'date' => $filterDate->format('m/d/Y'), 'return_url' => url()->full()])}}"  @if($schedule_end < time()) disabled @endif>Cancel</button>
																	               </div>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											@endforeach

											<div class="row">
												<div class="col-md-6 col-xs-12 col-sm-6">
													<div class="activities-details mt-10">
														<label>Total Activities Today: </label> <span id="sccount"> {{count($schedules)}}   </span>
														<label>Total Reservations Today:</label> <span id="rescount">{{$total_reservations}}   </span> 
														<label>Next Date:</label>
														{{$filterDate->addDay()->format('m/d/Y')}}
													</div>
												</div>
												<div class="col-md-6 col-xs-12 col-sm-6">
													<div class="pre-next-btns pre-nxt-btn-space mt-10">
														<a class="btn-previous btn-sp btn-black" href="{{route('business.schedulers.index', array_merge(request()->query(), ['date' => $filterDate->subDay()->format('m/d/Y')]))}}" disabled="" id="btn-pre">
															<i class="fas fa-caret-left preday-arrow"></i>Previous Day
														</a>
														
														<a class="btn-previous btn-red" id="btn-next" href="{{route('business.schedulers.index', array_merge(request()->query(), ['date' => $filterDate->addDay()->format('m/d/Y')]))}}">Next Day <i class="fas fa-caret-right nextday-arrow"></i></a>
													</div>
												</div>
											</div>
										</div><!-- end cardbody -->
									</div><!-- end card -->
								</div><!--end col-->
							</div>		
						</div>
               </div> 
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade new-client-steps" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-80">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body body-tbm">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 space-remover ">
						<div class="manage-customer-modal-title">
							<h4>Add A New Client Manually</h4> <h3>- Or -</h3>
						</div>
						<div class="manage-customer-from">
							<div id="divstep1" style="display: block;">
								<form id="frmregister" method="post">
									<h4 class="heading-step">Step 1</h4>
									<div id="systemMessage" class="alert-msgs"></div>
									<input type="hidden" name="_token">
									<input type="hidden" name="business_id" value="68">
									<input type="text" name="firstname" id="firstname" size="30" maxlength="80" placeholder="First Name">
									<input type="text" name="lastname" id="lastname" size="30" maxlength="80" placeholder="Last Name">
									<input type="text" name="username" id="username" size="30" maxlength="80" placeholder="Username" autocomplete="off">
									<input type="email" name="email" id="email" class="myemail" size="30" placeholder="Email-Address" maxlength="80" autocomplete="off">
									<input type="text" name="contact" id="contact" size="30" maxlength="14" autocomplete="off" placeholder="Phone" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
									<input type="text" class="form-control border-0 dash-filter-picker flatpiker-with-border flatpickr-range-birthdate" data-range-date="false" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
									
									<div class="row check-txt-center">
										<div class="col-lg-8 col-md-12 col-9">
											<div class="terms-wrap wrap-sp">
												<input type="checkbox" name="b_trm1" id="b_trm1" class="form-check-input" value="1">
												<label for="b_trm1" class="modalregister-private">I agree to Fitnessity <a href="/terms-condition" target="_blank">Terms of Service</a> and <a href="/privacy-policy" target="_blank">Privacy Policy</a></label>
											</div>
											<div id="termserror"></div><br>
											<button type="button" style="margin-bottom: 10px;" class="signup-new btn-red" id="register_submit" onclick="$('#frmregister').submit();">Continue</button><br>
										</div>
									</div>	
								</form>
							</div>
							
							<div id="divstep2" style="display: none;">
								<form action="#">
									<div class="sign-step_2">
										<div class="filledstep-bar">
											<div class="row">
												<div class="col-sm-12">
													<span class="filledstep"></span>
													<span class=""></span>
													<span class=""></span>
													<span class=""></span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<div class="error" id="systemMessage"></div>
												<div class="prfle-wrap">
													<img src="" alt="">
													N
												</div>
												<div class="reg-email-step2">nipavadhavana@gmail.com</div>
												<h2>Welcome to Fitnessity</h2>
												<div class="reg-title-step2"><input type="text" name="" id="" value="@nipa" readonly=""></div>
												<p>Your answer to the next few question will help us find the right ideas for you</p>
												<div class="signup-step-btn">
													<button type="button" class="signup-new btn-red" id="step2_next">Next</button>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
							
							<div id="divstep3" style="display: none;">
								<form action="#">
									<h4 class="heading-step">Step 2</h4>
									<input type="hidden" name="cust_id" id="cust_id" value="">
									<div class="sign-step_3">
										<div class="filledstep-bar">
											<div class="row">
												<div class="col-sm-12">
													<span class="filledstep"></span>
													<span class="filledstep"></span>
													<span></span>
													<span></span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<h2>How do you Identify?</h2>
												<div class="error" id="systemMessage"></div>
												<div class="form-group">
													<span class="error" id="err_gender"></span>
													<div class="radio">
														<label for="male">Male<input type="radio" name="gender" id="male" value="male" class=""><span class="checkmark"></span></label>
													</div>
													<div class="radio">
														<label for="female">Female<input type="radio" name="gender" id="female" value="female" class=""><span class="checkmark"></span></label>
													</div>
													<div class="radio">
														<label for="other">Specify another<input type="radio" name="gender" id="other" value="other" class=""><span class="checkmark"></span></label>
														<input class="border-none" type="text" name="othergender" id="othergender">
													</div>
												</div>
												<div class="signup-step-btn">
													<button type="button" class="signup-new btn-red" id="step3_next">Next</button>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
							
							<div id="divstep4" style="display: none;">
								<form action="#">
									<h4 class="heading-step">Step 3</h4>
									<div class="sign-step_4">
										<div class="filledstep-bar">
											<div class="row">
												<div class="col-sm-12">
													<span class="filledstep"></span>
													<span class="filledstep"></span>
													<span class="filledstep"></span>
													<span></span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<ul class="">
													<li><i class="fa fa-check"></i><span>Registration Information</span></li>
													<li><i class="fa fa-check"></i><span>Your Identification</span></li>
												</ul>
												<ul class="nav nav-tabs nav-stacked">
													<li class="active"><a data-bs-toggle="tab" data-bs-target="#add_personel_info" role="tab" aria-controls="add_personel_info" aria-selected="true"><span class="stp-numbr">3</span> <span>Add Personal Information</span></a></li>
													<li><a data-bs-toggle="tab" data-bs-target="#adding_photo" role="tab" aria-controls="adding_photo" aria-selected="false"><span class="stp-numbr">4</span> <span>Adding Photo</span></a></li>
													<li><a data-bs-toggle="tab" data-bs-target="#" role="tab" aria-controls=""><span class="stp-numbr" aria-selected="false">5</span> <span>Adding Family Member</span></a></li>
												</ul>
												
												<div class="tab-content">
													<div id="add_personel_info" class="tab-pane fade show active manage-customer-from-step-two">
														<div class="error" id="systemMessage"></div>
														<div class="form-group">
															<input type="text" class="form-control" autocomplete="nope" name="Address" id="b_address" placeholder="Address" value="">
															<span class="error" id="err_address_sign"></span>
														</div>
														<div id="map" style="display: none;"></div>
														<input type="hidden" name="lon" id="lon" value="">
														<input type="hidden" name="lat" id="lat" value="">
														<div class="form-group">
															<input type="text" class="form-control" name="Country" id="b_country" size="30" placeholder="Country" value="" maxlength="20">
															<span class="error" id="err_country_sign"></span>
														</div>
														<div class="form-group">
															<input type="text" class="form-control" name="City" id="b_city" size="30" placeholder="City" maxlength="50" value="">
															<span class="error" id="err_city_sign"></span>
														</div>
														<div class="form-group">
															<input type="text" class="form-control" name="State" id="b_state" size="30" placeholder="State" maxlength="50" value="">
															<span class="error" id="err_state_sign"></span>
														</div>
														<div class="form-group">
															<input type="text" class="form-control" name="ZipCode" id="b_zipcode" size="30" placeholder="Zip Code" value="" maxlength="20">
															<span class="error" id="err_zipcode_sign"></span>
														</div>
														<div class="signup-step-btn">
															<button type="button" class="signup-new btn-red" id="step4_next">Next</button>
														</div>
													</div>
													<div id="adding_photo" class="tab-pane fade">
														<div class="upload-wrp-content">
															<p><b>Put a face to the name </b>and improve your adds to networking success.</p>
															<p>People prefer to network with members who has a profile photo, but if don't have one ready to upload, you can add it later.</p>
														</div>
														<div class="">
															<div class="upload-img">
																<input type="file" name="file_upload" id="file" onchange="">
																<div class="upload-img-msg">
																	<p>Touble uploading profile photo?</p>
																</div>
															</div>
														</div>
														<div class="signup-step-btn">
															<button type="button" class="signup-new btn-red" id="fileimgnext">Upload</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
							
							<div id="divstep5" style="display: none;">
								<form action="#" enctype="multipart/form-data" id="myformprofile">
									<h4 class="heading-step">Step 4</h4>
									<div class="sign-step_4">
										<div class="filledstep-bar">
											<div class="row">
												<div class="col-sm-12">
													<span class="filledstep"></span>
													<span class="filledstep"></span>
													<span class="filledstep"></span>
													<span></span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<ul class="">
													<li><i class="fa fa-check"></i><span>Registration Information</span></li>
													<li><i class="fa fa-check"></i><span>Your Identification</span></li>
													<li><i class="fa fa-check"></i><span>Add Personal Information</span></li>
												</ul>
												<ul class="nav nav-tabs nav-stacked">
													<li class="active"><a data-toggle="tab" data-bs-target="#adding_photo" role="tab" aria-controls="adding_photo" class="active" aria-selected="true"><span class="stp-numbr">4</span> <span>Adding Photo</span></a></li>
													<li class=""><a data-toggle="tab" data-bs-target="#" role="tab" class="" aria-controls="" aria-selected="false"><span class="stp-numbr">5</span> <span>Adding Family Member</span></a></li>
												</ul>
												
												<div class="tab-content">
												   
													<div id="adding_photo" class="tab-pane fade show active">
														<div class="upload-wrp-content">
															<p><b>Put a face to the name </b>and improve your adds to networking success.</p>
															<p>People prefer to network with members who has a profile photo, but if don't have one ready to upload, you can add it later.</p>
														</div>
														<div class="">
															<div class="upload-img">
																<input type="file" name="file_upload_profile" id="file_upload_profile" onchange="">
																<div class="upload-img-msg">
																	<p>Touble uploading profile photo?</p>
																</div>
															</div>
														</div>
														<div class="signup-step-btn">
															<button type="button" class="signup-new btn-red" id="step44_next">Next</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
							
							<div id="divstep6" style="display: none;">
								<form action="#" id="familyform">
									<h4 class="heading-step">Step 5</h4>
									<div class="sign-step_5">
										<div class="filledstep-bar">
											<div class="row">
												<div class="col-sm-12">
													<span class="filledstep"></span>
													<span class="filledstep"></span>
													<span class="filledstep"></span>
													<span class="filledstep"></span>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-12">
												<h2>Activities are much more fun with family</h2>
												<div class="error" id="systemMessage"></div>
												<h4><b>Add Your Family Members Information</b></h4>
												<div class="error" id="familyerrormessage"></div>
												<input type="hidden" name="familycnt" id="familycnt" value="0">
												<div id="familymaindiv">
													<div class="accordion" id="default-accordion-example">
														<div class="accordion-item shadow">
															<h2 class="accordion-header" id="headingOne">
																<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
																	Family Member #1
																</button>
															</h2>
															<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
																<div class="accordion-body">
																	<div class="form-group">
																		<input type="text" name="fname[]" id="fname" class="form-control first_name required" placeholder="First Name">
																		<span class="error" id="err_fname"></span>
																	</div>
																	<div class="form-group">
																		<input type="text" name="lname[]" id="lname" class="form-control last_name required" placeholder="Last Name">
																		<span class="error" id="err_lname"></span>
																	</div>
																	<div>
																		<input type="text" class="form-control border-0 dash-filter-picker flatpiker-with-border flatpickr-range-birthdate" data-range-date="false" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
																	</div>
																	<div class="form-group">
																		<select name="relationship[]" id="relationship" class="form-select relationship required">
																			<option value="">Select Relationship</option>
																			<option value="Brother">Brother</option>
																			<option value="Sister">Sister</option>
																			<option value="Father">Father</option>
																			<option value="Mother">Mother</option>
																			<option value="Wife">Wife</option>
																			<option value="Husband">Husband</option>
																			<option value="Son">Son</option>
																			<option value="Daughter">Daughter</option>
																		</select>
																		<span class="error" id="err_relationship"></span>
																	</div>
																	<div class="form-group">
																		<input maxlength="14" type="text" name="mphone[]" id="mphone" class="form-control mobile_number" placeholder="Mobile Phone" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
																		<span class="error" id="err_mphone"></span>
																	</div>
																	<div class="form-group">
																		<input maxlength="14" type="text" name="emergency_phone[]" id="emergency_phone" class="form-control emergency_phone" placeholder="Emergency Contact Number" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
																		<span class="error" id="err_emergency_phone"></span>
																	</div>
																	<div class="form-group">
																		<select name="gender[]" id="gender" class="form-select gender" required="">
																			<option value="">Select Gender</option>
																			<option value="male">Male</option>
																			<option value="female">Female</option>
																			<option value="other">Specify other</option>
																		</select>
																		<span class="error" id="err_gender"></span>
																	</div>
																	<div class="form-group">
																		<input type="email" name="emailid[]" id="emailid" class="form-control email" placeholder="Email">
																		<span class="error" id="err_emailid"></span>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="new-client" id="familydiv0">
														
													</div>
												</div>
											</div>
										</div>
										<div class="signup-step-btn">
											<button type="button" class="signup-new btn-red mb-10 mt-25" id="add_family">Add New Family Member</button>
											<button type="button" class="signup-new btn-red mb-10" id="step5_next">Save</button>
											<button type="button" class="signup-new btn-red mb-10" id="skip5_next">Skip</button>
										</div>
									</div>
								</form>
							</div>
							
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 space-remover manage-customer-gray-bg">
						<div class="manage-customer-search search-info">
							<h3>Onboard A New Client Fast</h3>
							<h4>Search for your clients on Fitnessity</h4>
							<p>“Your client could already have an account on Fitnessity.<br>If so, get access and sync their information fast.”</p>
						</div>
						<div class="row check-txt-center claimyour-business">
							<div class="col-md-10 col-xs-10 col-8 frm-claim">
								<input id="clients_name" style="margin-top:10px;" type="text" class="form-control" placeholder="Search by typing your clients name" autocomplete="off" data-customer-id="">
								
								<div class="request-access" style="display:none">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  
	@include('layouts.business.footer')
	<script>
		flatpickr(".flatpickr-range", {
	      dateFormat: "m/d/Y",
	      maxDate: "01/01/2050",
	      enable:[{
	      	"from":'today',
	      	"to" : "01/01/2050",
	      }],
	   });
		 
		 flatpickr(".flatpickr-range-birthdate", {
	        dateFormat: "m/d/Y",
	        maxDate: "01/01/2050",
			defaultDate: [new Date()],
	     });
			 
	</script>

	<script type="text/javascript">
		$(document).on('change', '[data-behavior~=on_change_submit]', function(e){
			e.preventDefault()

			$(this).parents('form').submit();

		});
		$(document).on('click', '[data-behavior~=disable_scheduler]', function(e){
			e.preventDefault()
		});

		$(document).ready(function () {
        	var business_id = '{{$request->current_company->id}}';
        	var url = "{{ url('/business/business_id/customers') }}";
        	url = url.replace('business_id', business_id);

        	$( "#serchclient" ).autocomplete({
            source: url,
            focus: function( event, ui ) {
                 return false;
            },
            select: function( event, ui ) {
                $("#serchclient").val( ui.item.fname + ' ' +  ui.item.lname);
                $('#customer-id').val( ui.item.id);
                 return false;
            }
        	}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            let profile_img = '<div class="collapse-img"><div class="company-list-text" style="height: 50px;width: 50px;"><p style="padding: 0;">' + item.fname + '</p></div></div> ';

            if(item.profile_pic_url){
                profile_img = '<img class="searchbox-img" src="' + (item.profile_pic_url ? item.profile_pic_url : '') + '" style="">';            
            }

            var inner_html = '<div class="row rowclass-controller"></div><div class="row"><div class="col-md-3 nopadding text-center">' + profile_img + '</div><div class="col-md-9 div-controller">' + 
                      '<p class="pstyle"><label class="liaddress">' + item.fname + ' ' +  item.lname  + (item.age ? ' (' + item.age+ '  Years Old)' : '') + '</label></p>' +
                      '<p class="pstyle liaddress">' + item.email +'</p>' + 
                      '<p class="pstyle liaddress">' + item.phone_number + '</p></div></div>';
           
            return $( "<li></li>" )
                    .data( "item.autocomplete", item )
                    .append(inner_html)
                    .appendTo( ul );
        	};
      });
	</script>

@endsection