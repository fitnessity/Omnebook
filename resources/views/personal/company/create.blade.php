@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')
	<?php 

		function timeSlotOptionforservice($lbl, $val) {
	        $start = "00:00"; //you can write here 00:00:00 but not need to it
	        $end = "23:30";
	        $tStart = strtotime($start);
	        $tEnd = strtotime($end);
	        $tNow = $tStart;
	        $startpm = "00:00"; //you can write here 00:00:00 but not need to it
	        $endpm = "11:30";
	        echo '<select name="'.$lbl.'" id="'.$lbl.'" class="'.$lbl.' form-control">';
	        echo '<option value="">Select Time</option>';
	        while($tNow <= $tEnd){
	            if($val == date("H:i",$tNow)) {
	                echo '<option selected value="'.date("H:i",$tNow).'">'.date("h:i A",$tNow).'</option>';
	            } else {
	                echo '<option value="'.date("H:i",$tNow).'">'.date("h:i A",$tNow).'</option>';
	            }
	            $tNow = strtotime('+15 minutes',$tNow);
	        }

	        echo '</select>';
	    }

   ?>

	@include('layouts.business.business_topbar')
	<div class="main-content">
		<div class="page-content">
         <div class="container-fluid">
            <div class="row">
               <div class="col">
                  <div class="h-100">
                     <div class="row mb-3">
								<div class="col-12">
									<div class="page-heading">
										<label>COMPANY SET UP</label>
									</div>
								</div>
							</div>
                     
                     <div class="row">
								<div class="col-xl-12">
									<div class="card">
										<div class="card-header align-items-center d-flex">
											<h4 class="card-title mb-0 flex-grow-1 nesting-steps-title">Business Details Setup</h4>
										</div>
										<div class="card-body">
											<div class="live-preview">
												<div class="accordion" id="default-accordion-example">
													<div class="accordion-item shadow">
														<h2 class="accordion-header" id="headingOne">
															<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
																Business Setup Details
															</button>
														</h2>

														<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
															<div class="accordion-body">
																<form action="{{route('personal.company.store')}}" method="post" enctype="multipart/form-data">
																	@csrf
																	<input type="hidden" name="cid" value="{{@$company->id}}">
																	<input type="hidden" name="step" value="1">
																	<div class="row">
																		<div class="col-lg-6 col-md-6">
																			<div class="form-group mt-10">
																				<label for="email">Legal Business Name <span id="star">*</span></label>
																				<input type="text" class="form-control" name="companyName" id="companyName" size="30" maxlength="255" placeholder="Company Name" value="{{@$company->company_name}}" required="">
																			</div>
																		</div>
																		<div class="col-lg-6 col-md-6">
																			<div class="form-group mt-10">
																				<label for="pwd">dba Business Name <span id="star">*</span>(If its the same as legal name, add it here again.)</label>
																				<input type="text" class="form-control" autocomplete="nope" name="dbaBusinessName" id="dbaBusinessName" placeholder="Dba Business name" value="{{@$company->dba_business_name}}" required="">
																			</div>
																		</div>
																		<div class="col-lg-6 col-md-6">
																			<div class="form-group mt-10">
																				<label for="pwd">Business Address <span id="star">*</span></label>
																				<input type="text" class="form-control pac-target-input" autocomplete="off" name="address" id="addressBusiness" placeholder="Address" value="{{@$company->address}}" required="" oninput="initMapCall('addressBusiness', 'cityBusiness', 'stateBusiness', 'countryBusiness', 'zipCodeBusiness', 'latitude', 'longitude')"> 
																			</div>
																		</div>
																		 <div id="map" style="display: none;"></div>
																		<div class="col-lg-6 col-md-6">
																			<div class="form-group mt-10">
																				<label for="pwd">Additional Address Info</label>
																				<input type="text" class="form-control" autocomplete="nope" name="additionalAddress" id="additionalAddress" placeholder="Additional Address" value="{{@$company->additional_address}}">
																			</div>
																		</div>
																		<div class="col-lg-6 col-md-6">
																			<div class="form-group mt-10">
																				<label for="City">City <span id="star">*</span></label>
																				<input type="text" class="form-control" name="city" id="cityBusiness" size="30" placeholder="City" maxlength="50" value="{{@$company->city}}" required="">
																			</div>
																		</div>
																		<div class="col-lg-6 col-md-6">
																			<div class="form-group mt-10">
																				<label for="State">State <span id="star">*</span></label>
																				<input type="text" class="form-control" name="state" id="stateBusiness" size="30" placeholder="State" maxlength="50" value="{{@$company->state}}" required="">
																			</div>
																		</div>
																		<div class="col-lg-6 col-md-6">
																			<div class="form-group mt-10">
																				<label for="zip">Zip Code <span id="star">*</span></label>
																				<input type="text" class="form-control" name="zipCode" id="zipCodeBusiness" size="30" placeholder="Zip Code" value="{{@$company->zip_code}}" maxlength="20" required="">
																			</div>
																		</div>
																		<input type="hidden" name="lon" id="longitude" value="{{@$company->longitude}}">
							        									<input type="hidden" name="lat" id="latitude" value="{{@$company->latitude}}">
							        									<input type="hidden" name="country" id="countryBusiness" value="{{@$company->country}}">
																		<div class="col-lg-6 col-md-6">
																			<div class="form-group mt-10">
																				<label for="location">Neighborhood/Location/Area</label>
																				<input type="text" class="form-control" name="neighborhood" id="neighborhood" size="30" placeholder="Neighborhood" value="{{@$company->neighborhood}}" maxlength="50">
																			</div>
																		</div>
																		<div class="col-lg-6 col-md-6">
																			<div class="form-group mt-10">
																				<label for="pno">Business Phone Number <span id="star">*</span></label>
																				<input type="text" class="form-control" name="businessPhone" id="businessPhone" placeholder="Business Phone" value="{{@$company->business_phone}}" required="" data-behavior="text-phone">
																			</div>
																		</div>
																		<div class="col-lg-6 col-md-6">
																			<div class="form-group mt-10">
																				<label for="email">Business Email <span id="star">*</span></label>
																				<input type="text" class="form-control" name="businessEmail" id="businessEmail" placeholder="Business email" value="{{@$company->business_email}}" required="">
																			</div>
																		</div>
																		<div class="col-lg-6 col-md-6">
																			<div class="form-group mt-10">
																				<label for="uname">Business Username <span id="star">*</span></label>
																				<input type="text" class="form-control" name="businessUserName" id="businessUserName" placeholder="Business User Tag" value="{{@$company->full_name}}" required="">
																			</div>
																		</div>
																		<div class="col-lg-6 col-md-6">
																			<div class="form-group mt-10">
																				<label for="web">Business Website</label>
																				<input type="text" class="form-control" name="website" id="website" placeholder="Business Website" value="{{@$company->business_website}}">
																			</div>
																		</div>
																		<div class="col-lg-6 col-md-6">
																			<div class="form-group mt-10">
																				<label for="btype">Business type <span id="star">*</span></label>
																				<select class="form-select" name="businessType" required="">
																					<option value="individual" {{@$company->business_type == 'individual' ? 'selected': ''}} >Individual</option>
																					<option value="business" {{@$company->business == 'individual' ? 'selected': ''}}>Business</option>
																				</select>
																			</div>
																		</div>
																		<div class="col-lg-6 col-md-6">
																			<div class="form-group mt-10">
																				<label for="video">Embed Video Code </label>
																				<input type="text" class="form-control" name="embedVideo" id="embedVideo" placeholder="Video Code" value="{{@$company->embed_video}}" maxlength="150">
																				<span id="b_embedvideo">Example: https://www.youtube.com/embed/<b>rW_fwcmyIfk</b></span>
																			</div>
																		</div>
																	</div>
																	<div class="dropdown-divider mt-20 mb-20"></div>
																	<div class="row">
																		<div class="col-lg-6 col-md-6">
																			<div class="form-group mt-10">
																				<label for="img">Upload Profile Image</label>
																				<input type="file" class="form-control" name="profilePic" id="profilePic" onchange="readURL(this);">
																				<input type="hidden" name="oldProfile" id="oldProfile" value="{{@$company->logo}}">
																			</div>
																		</div>
																		<div class="col-lg-6 col-md-6 text-center">
																			<div class="form-group mt-10">
																				<img src="{{ @$company->logo != '' ?Storage::Url(@$company->logo) : ''}}" class="pro_card_img blah" id="showimg">
																			</div>
																		</div>

																		<div class="col-lg-12">
																			<div class="form-group mt-10">
																				<label>Quick Business Intro</label>
																				<textarea class="form-control" rows="4" placeholder="Tell Us Somthing About Company..." name="shortDescription" id="shortDescription" maxlength="150">{{@$company->short_description}}</textarea>
																				<div class="word-counter">
																					<span id="companyDescLeft">150</span> 
																					Characters Left
																				</div>
																			</div>
																		</div>
																		<div class="col-lg-12">
																			<div class="form-group mt-10">
																				<label>Company Description</label>
																				<textarea class="form-control" rows="5" placeholder="Tell Us Somthing About Company in short..." name="aboutCompany" id="aboutCompany" maxlength="1000">{{@$company->about_company}}</textarea>
																				<div class="word-counter">
																					<span id="aboutCompanyLeft">1000</span> 
																					Characters Left
																				</div>
																			</div>
																		</div>

																		<div class="dropdown-divider mt-20 mb-20"></div>

																		<label class="mt-20 mb-20"><h5>About The Owner</h5></label>
																		<div class="col-lg-6 col-md-6">
																			<div class="form-group mt-10">
																				<label>Company Representative First Name <span id="star">*</span></label>
																				<input type="text" class="form-control" name="firstName" id="firstName" size="30" maxlength="80" placeholder="Company Representative First Name" value="{{@$company->first_name}}" required="">
																			</div>
																		</div>
																		<div class="col-lg-6 col-md-6">
																			<div class="form-group mt-10">
																				<label>Company Representative Last Name <span id="star">*</span></label>
																				<input type="text" class="form-control" name="lastName" id="lastName" size="30" maxlength="80" placeholder="Company Representative Last Name" value="{{@$company->last_name}}" required="">
																			</div>
																		</div>
																		<div class="col-lg-6 col-md-6">
																			<div class="form-group mt-10">
																				<label>Email</label>
																				<input type="email" class="form-control myemail" name="email" id="email" autocomplete="off" placeholder="Email Address" size="30" maxlength="80" value="{{@$company->email}}">
																			</div>
																		</div>
																		<div class="col-lg-6 col-md-6">
																			<div class="form-group mt-10">
																				<label>Contact Number </label>
																				<input type="text" class="form-control" name="contact" id="contact" size="30" placeholder="Contact No" value="{{@$company->contact_number}}" data-behavior="text-phone">
																				<span class="error" id="b_cot"></span>
																			</div>
																		</div>
																		
																		<div class="col-lg-6">
																			<div class="form-group mt-10">
																				<label>Country Born </label>
																				<select class="form-select" name="born" id="born">
																					<option>Select Country</option>
																					@foreach($countries as $country)
																						<option value="{{$country->id}}" {{@$company->born == $country->id ? 'selected' : ''}}>{{$country->country_name}}</option>
																					@endforeach
																				</select>
                                                                               <!--  <input type="text" class="form-control" name="born" id="born" placeholder="" value="{{@$company->born}}" maxlength="150"> -->
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-6">
																			<div class="form-group mt-10">
																				<label>Years of Hosting </label>
                                                                               <input type="text" class="form-control" name="years_of_hosting" id="years_of_hosting" placeholder="" value="{{@$company->years_of_hosting}}" maxlength="150">
                                                                            </div>
                                                                        </div> 

                                                                        <div class="col-lg-12">
																			<div class="form-group mt-10">
																				<label>About The Owner </label>
                                                                                <textarea name="about_host" id="about_host" class="form-control" rows="4" maxlength="150" required="" placeholder="Let your clients know something about you">{{@$company->about_host}}</textarea>
                                                                                <div class="float-right"><span id="aboutcLeft">200</span> Characters Left</div>
                                                                            </div>
                                                                        </div> 

                                                                       
                                                                        <div class="col-lg-6 col-md-6">
																			<div class="form-group mt-10">
																				<label for="img">Upload Owner Photo</label>
																				<input type="file" class="form-control" name="owner_pic" id="owner_pic" onchange="readURL(this);">
																				<input type="hidden" name="oldowner_pic" id="oldowner_pic" value="{{@$company->owner_pic}}">
																			</div>
																		</div>
																		@if(@$company->owner_pic)
																			<div class="col-lg-6 col-md-6 text-center">
																				<div class="form-group mt-10">
																					<img src="{{ @$company->owner_pic != '' ? Storage::Url(@$company->owner_pic) : ''}}" class="pro_card_img blah" id="showimg">
																				</div>
																			</div>
																		@endif

                                                                        <!-- <div class="col-lg-12">
																			<div class="form-group mt-10">
																				<label>Years of Experience </label>
                                                                                <input type="text" class="form-control" name="years_of_experience" id="years_of_experience" placeholder="" value="{{@$company->years_of_experience}}" maxlength="150">
                                                                            </div>
                                                                        </div> --> 


																		<div class="col-md-12 col-12">
																			<button type="submit" class="btn-red-primary btn-red float-right mt-15">Save </button>
																		</div>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div><!-- end card-body -->
									</div><!-- end card -->
								</div>
							</div><!--end row-->	
					
							@php 
								$organisation = json_decode(@$experience->frm_organisationname,true);
								$course = json_decode(@$experience->frm_course,true);
								$certification = json_decode(@$experience->certification,true);
								$skill = json_decode(@$experience->skill_type,true);
								$position = json_decode(@$experience->frm_position,true);
								$isPresentchk = json_decode(@$experience->frm_ispresentcheck,true);
								$serviceStart = json_decode(@$experience->frm_servicestart,true);
								$serviceEnd = json_decode(@$experience->frm_serviceend,true);
								$university = json_decode(@$experience->frm_university,true);
								$passingyear = json_decode(@$experience->frm_passingyear,true);
								$passingdate = json_decode(@$experience->frm_passingdate,true);
								$skillcompletion = json_decode(@$experience->skillcompletion,true);
				 				$skilldetail = json_decode(@$experience->frm_skilldetail,true);
							@endphp
							<div class="row">
								<div class="col-xl-12">
									<div class="card">
										<div class="card-header align-items-center d-flex">
											<h4 class="card-title mb-0 flex-grow-1 nesting-steps-title">Tells us About Your Experience</h4>
										</div><!-- end card header -->
										<form action="{{route('personal.company.store')}}" method="post" enctype="multipart/form-data">
											@csrf
											<input type="hidden" name="cid" value="{{@$company->id}}">
											<input type="hidden" name="step" value="2">
											<input type="hidden" name="id" value="{{@$experience->id}}">
											<div class="card-body">
												<div class="live-preview">
													<div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting">
														<div class="accordion-item shadow">
															<h2 class="accordion-header" id="accordionnestingExample0">
																<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse0" aria-expanded="false" aria-controls="accor_nestingExamplecollapse0">
																	Employment History
																</button>
															</h2>
															<div id="accor_nestingExamplecollapse0" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample0" data-bs-parent="#accordionnesting">
																<div class="accordion-body">
																	<div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3" id="empdetail_block">
																		
																		@if(!empty(@$organisation))
																			<input type="hidden"  name="Emp_count" id="Emp_count" value="{{ count(@$organisation) - 1}}" /> 
																			@for($i=0; $i < count(@$organisation); $i++)
																			<div class="accordion-item shadow" id="Emp_count{{$i}}">
																				<h2 class="accordion-header" id="accordionnesting2Example1{{$i}}">
																					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse1{{$i}}" aria-expanded="false" aria-controls="accor_nesting2Examplecollapse1{{$i}}">
																						<div class="container-fluid nopadding">
																							<div class="row">
																								<div class="col-lg-6 col-md-6 col-8">Employment Details</div>
																								@if($i!=0)
																								<div class="col-lg-6 col-md-6 col-4">
																									<div class="multiple-options">
																										<div class="setting-icon">
																											<i class="ri-more-fill"></i>
																											<ul>
																											   <li><a onclick="deletediv({{$i}},'Emp_count')"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
																											</ul>
																										</div>
																									</div>
																								</div>
																								@endif
																							</div>
																						</div>
																					</button>
																				</h2>
																				<div id="accor_nesting2Examplecollapse1{{$i}}" class="accordion-collapse collapse" aria-labelledby="accordionnesting2Example1{{$i}}" data-bs-parent="#empdetail_block">
																					<div class="accordion-body">
																						<div class="row">
																							<div class="col-lg-6 col-md-6">
																								<div class="form-group mt-10">
																									<label>Company Name </label>
																									<input type="text" name="frm_organisationname[]" id="frm_organisationname" placeholder="Organization name" class="form-control" maxlength="100" value="{{$organisation[$i]}}">
																								</div>
																							</div>
																							<div class="col-lg-6 col-md-6">
																								<div class="form-group mt-10">
																									<label>Position </label>
																									<input type="text" class="form-control" id="frm_position" name="frm_position[]" placeholder="Position" value="{{@$position[$i]}}" maxlength="100">
																								</div>
																							</div>
																							<div class="col-lg-12 col-md-6">
																								<div class="form-group mt-25">
																									<label class=" present_work_btn">
																										<input type="checkbox" name="frm_ispresentcheck[]" id="frm_ispresentcheck{{$i}}" onchange="checkstillwork(this.value,{{$i}})" {{@$isPresentchk[$i] == '0' ?  '' : "checked" }}>
																										<span>I Still Work Here</span>
																										<input type="hidden" name="frm_ispresent[]" id="frm_ispresent{{$i}}" value="1" >
																									</label>
																								</div>
																							</div>

																							<div class="col-lg-6 col-md-6" id="fromdiv{{$i}}">
																								<div class="form-group mt-10">
																									<label>From (mm/dd/yyyy)</label>
																									<div class="input-group">
																										<input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-from{{$i}} flatpiker-with-border "  value="{{ $serviceStart[$i] }}" id="from{{$i}}" name="frm_servicestart[]" placeholder="From">
																									</div>
																								</div>
																							</div>

																							<div class="col-lg-6 col-md-6 {{@$isPresentchk[$i] == '0' ?  '' : 'd-none' }}" id="todiv{{$i}}">
																								<div class="form-group mt-10" >
																									<label>To (mm/dd/yyyy)</label>
																									<div class="input-group">
																										<input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-to{{$i}} flatpiker-with-border"  value="{{ $serviceEnd[$i] != '' ? $serviceEnd[$i]  : ''}}" id="to{{$i}}" name="frm_serviceend[]" placeholder="To">
																									</div>
																								</div>
																							</div>

																							<script type="text/javascript">
																								flatpickr(".flatpickr-to{{$i}}", {
																							      dateFormat: "m/d/Y",
																							      maxDate: "01/01/2050",
																							   });

																							   flatpickr(".flatpickr-from{{$i}}", {
																							      dateFormat: "m/d/Y",
																							      maxDate: "01/01/2050",
																							   });
																							</script>
																						</div>
																					</div>
																				</div>
																			</div>
																			@endfor
																		@else
																			<input type="hidden"  name="Emp_count" id="Emp_count" value="0" /> 
																			<div class="accordion-item shadow" id="Emp_count0">
																				<h2 class="accordion-header" id="accordionnesting2Example0">
																					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse10" aria-expanded="false" aria-controls="accor_nesting2Examplecollapse10">
																						Employment Details
																					</button>
																				</h2>
																				<div id="accor_nesting2Examplecollapse10" class="accordion-collapse collapse" aria-labelledby="accordionnesting2Example0" data-bs-parent="#empdetail_block">
																					<div class="accordion-body">
																						<div class="row">
																							<div class="col-lg-6 col-md-6">
																								<div class="form-group mt-10">
																									<label>Company Name </label>
																									<input type="text" name="frm_organisationname[]" id="frm_organisationname" placeholder="Organization name" class="form-control" maxlength="100" value="">
																								</div>
																							</div>
																							<div class="col-lg-6 col-md-6">
																								<div class="form-group mt-10">
																									<label>Position </label>
																									<input type="text" class="form-control" id="frm_position" name="frm_position[]" placeholder="Position" value="" maxlength="100">
																								</div>
																							</div>
																							<div class="col-lg-12 col-md-6">
																								<div class="form-group mt-25">
																									<label class=" present_work_btn">
																										<input type="checkbox" name="frm_ispresentcheck[]" id="frm_ispresentcheck0" onchange="checkstillwork(this.value,0)" >
																										<span>I Still Work Here</span>
																										<input type="hidden" name="frm_ispresent[]" id="frm_ispresent0" value="1" >
																									</label>
																								</div>
																							</div>

																							<div class="col-lg-6 col-md-6" id="fromdiv0">
																								<div class="form-group mt-10" >
																									<label>From (mm/dd/yyyy)</label>
																									<div class="input-group">
																										<input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-from0 flatpiker-with-border"  value="" id="from0" name="frm_servicestart[]" placeholder="From">
																									</div>
																								</div>
																							</div>

																							<div class="col-lg-6 col-md-6" id="todiv0">
																								<div class="form-group mt-10" >
																									<label>To (mm/dd/yyyy)</label>
																									<div class="input-group">
																										<input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-to0 flatpiker-with-border"  value="" id="to0" name="frm_serviceend[]" placeholder="To">
																									</div>
																								</div>
																							</div>

																							<script type="text/javascript">
																								flatpickr(".flatpickr-to0", {
																							      dateFormat: "m/d/Y",
																							      maxDate: "01/01/2050",
																							   });

																							   flatpickr(".flatpickr-from0", {
																							      dateFormat: "m/d/Y",
																							      maxDate: "01/01/2050",
																							   });
																							</script>
																						</div>
																					</div>
																				</div>
																			</div>
																		@endif
																	</div>
																	<div class="col-md-12">
																		<div class="addanother">
																			<a class="add_employee"> + Add More</a>
																		</div>  
																	</div>
																</div>	
															</div>
														</div>

														<div class="accordion-item shadow">
															<h2 class="accordion-header" id="accordionnestingExample2">
																<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse2" aria-expanded="false" aria-controls="accor_nestingExamplecollapse2">
																	Education Details
																</button>
															</h2>
															<div id="accor_nestingExamplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample2" data-bs-parent="#accordionnesting">
																<div class="accordion-body">
																   <div class="accordion nesting3-accordion custom-accordionwithicon accordion-border-box mt-3" id="education_block">
																   	@if(!empty(@$course))
																   		<input type="hidden"  name="Edu_count" id="Edu_count" value="{{ count(@$course) - 1}}" />
																	   	@for($i=0; $i < count(@$course); $i++)
																			<div class="accordion-item shadow mt-2" id="Edu_count{{$i}}">
																				<h2 class="accordion-header" id="accordionnestingExampleec{{$i}}">
																					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapsec{{$i}}" aria-expanded="false" aria-controls="accor_nestingExamplecollapsec{{$i}}">
																						<div class="container-fluid nopadding">
																							<div class="row">
																								<div class="col-lg-6 col-md-6 col-8">Details</div>
																								@if($i!=0)
																								<div class="col-lg-6 col-md-6 col-4">
																									<div class="multiple-options">
																										<div class="setting-icon">
																											<i class="ri-more-fill"></i>
																											<ul>
																											   <li><a onclick="deletediv({{$i}},'Edu_count')"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
																											</ul>
																										</div>
																									</div>
																								</div>
																								@endif
																							</div>
																						</div>
																					</button>
																				</h2>
																				
																				<div id="accor_nestingExamplecollapsec{{$i}}" class="accordion-collapse collapse" aria-labelledby="accordionnestingExampleec{{$i}}" data-bs-parent="#accordionnesting3">
																					<div class="accordion-body">
																						<div class="row">
																							<div class="col-lg-6 col-md-6">
																								<div class="form-group mt-10">
																									<label>Degree - Course</label>
																									<input type="text" id="frm_course" name="frm_course[]" class="form-control frm_course" placeholder="Degree/Course (Obtained or Seeking)" value="{{ $course[$i] }}" maxlength="500">
																								</div>
																							</div>
																							<div class="col-lg-6 col-md-6">
																								<div class="form-group mt-10">
																									<label>University - School</label>
																									<input type="text" id="frm_university" name="frm_university[]" class="form-control frm_university" placeholder="University/School" value="{{ $university[$i] }}" maxlength="200">
																								</div>
																							</div>
																							<div class="col-lg-6 col-md-6">
																								<div class="form-group mt-10">
																									<label>Year Graduated (yyyy)</label>
																									<div class="input-group">
																										<input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-year{{$i}} flatpiker-with-border" value="{{ $passingyear[$i] }}"  id="passingyear" name="frm_passingyear[]" placeholder="Year graduated" >
																									</div>
																									<script>
																									flatpickr(".flatpickr-year{{$i}}",{
																								      dateFormat: "Y",
																								      maxDate: "2050",
																									});
																									</script>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																			@endfor
																		@else
																			<input type="hidden"  name="Edu_count" id="Edu_count" value="0" />
																			<div class="accordion-item shadow mt-2" id="Edu_count0">
																				<h2 class="accordion-header" id="accordionnestingExampleec0">
																					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapsec0" aria-expanded="false" aria-controls="accor_nestingExamplecollapsec0">
																						Details
																					</button>
																				</h2>
																				
																				<div id="accor_nestingExamplecollapsec0" class="accordion-collapse collapse" aria-labelledby="accordionnestingExampleec0" data-bs-parent="#accordionnesting3">
																					<div class="accordion-body">
																						<div class="row">
																							<div class="col-lg-6 col-md-6">
																								<div class="form-group mt-10">
																									<label>Degree - Course</label>
																									<input type="text" id="frm_course" name="frm_course[]" class="form-control frm_course" placeholder="Degree/Course (Obtained or Seeking)" value="" maxlength="500">
																								</div>
																							</div>
																							<div class="col-lg-6 col-md-6">
																								<div class="form-group mt-10">
																									<label>University - School</label>
																									<input type="text" id="frm_university" name="frm_university[]" class="form-control frm_university" placeholder="University/School" value="" maxlength="200">
																								</div>
																							</div>
																							<div class="col-lg-6 col-md-6">
																								<div class="form-group mt-10">
																									<label>Year Graduated (yyyy)</label>
																									<div class="input-group">
																										<input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-year0 flatpiker-with-border" value=""  id="passingyear" name="frm_passingyear[]" placeholder="Year graduated" >
																									</div>
																									<script>
																									flatpickr(".flatpickr-year0",{
																								      dateFormat: "Y",
																								      maxDate: "2050",
																									});
																									</script>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		@endif
																	</div>
																	<div class="col-md-12">
																		<div class="addanother">
																			<a class="add_education"> + Add More</a>
																		</div>  
																	</div>															
																</div>
															</div>
														</div>

														<div class="accordion-item shadow">
															<h2 class="accordion-header" id="accordionnestingExample3">
																<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse4" aria-expanded="false" aria-controls="accor_nestingExamplecollapse4">
																   Certification Details
																</button>
															</h2>
															<div id="accor_nestingExamplecollapse4" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample4" data-bs-parent="#accordionnesting">
																<div class="accordion-body">
																	<div class="accordion nesting4-accordion custom-accordionwithicon accordion-border-box mt-3" id="certificate_block">
																		@if(!empty(@$certification))
																			<input type="hidden"  name="certi_count" id="certi_count" value="{{count(@$certification)- 1}}" />
																			@for($i=0; $i < count(@$certification); $i++)
																			<div class="accordion-item shadow mt-2" id="certi_count{{$i}}">
																				<h2 class="accordion-header" id="accordioncerti{{$i}}">
																					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapsc{{$i}}" aria-expanded="false" aria-controls="accor_nestingExamplecollapsc{{$i}}">
																						<div class="container-fluid nopadding">
																							<div class="row">
																								<div class="col-lg-6 col-md-6 col-8"> Details </div>
																								@if($i!=0)
																								<div class="col-lg-6 col-md-6 col-4">
																									<div class="multiple-options">
																										<div class="setting-icon">
																											<i class="ri-more-fill"></i>
																											<ul>
																											   <li><a onclick="deletediv({{$i}},'certi_count')"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
																											</ul>
																										</div>
																									</div>
																								</div>
																								@endif
																							</div>
																						</div>
																					</button>
																				</h2>
																				<div id="accor_nestingExamplecollapsc{{$i}}" class="accordion-collapse collapse" aria-labelledby="accordioncerti{{$i}}" data-bs-parent="#accordioncerti{{$i}}">
																					<div class="accordion-body">
																						<div class="row">
																							<div class="col-lg-6 col-md-6">
																								<div class="form-group mt-10">
																									<label>Name of Certification </label>
																									<input type="text" id="certification" name="certification[]" class="form-control" placeholder="Name of Certification" value="{{ @$certification[$i] }}" maxlength="200">
																								</div>
																							</div>
																							<div class="col-lg-6 col-md-6">
																								<div class="form-group mt-10">
																									<label>Completion Date (mm/dd/yyyy)</label>
																									<div class="input-group">
																										<input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-cd{{$i}} flatpiker-with-border" id="completionyear" name="frm_passingdate[]" placeholder="Completion Date" autocomplete="off" value="{{ @$passingdate[$i] }}">
																									</div>
																									<script>
																									flatpickr(".flatpickr-cd{{$i}}",{
																								      dateFormat: "m/d/Y",
																								      maxDate: "01/01/2050",
																									});
																									</script>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																			@endfor
																		@else
																			<input type="hidden"  name="certi_count" id="certi_count" value="0" />
																			<div class="accordion-item shadow mt-2" id="certi_count0">
																				<h2 class="accordion-header" id="accordioncerti0">
																					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapsc0" aria-expanded="false" aria-controls="accor_nestingExamplecollapsc0">
																						Details
																					</button>
																				</h2>
																				<div id="accor_nestingExamplecollapsc0" class="accordion-collapse collapse" aria-labelledby="accordioncerti0" data-bs-parent="#accordioncerti0">
																					<div class="accordion-body">
																						<div class="row">
																							<div class="col-lg-6 col-md-6">
																								<div class="form-group mt-10">
																									<label>Name of Certification </label>
																									<input type="text" id="certification" name="certification[]" class="form-control" placeholder="Name of Certification" value="" maxlength="200">
																								</div>
																							</div>
																							<div class="col-lg-6 col-md-6">
																								<div class="form-group mt-10">
																									<label>Completion Date (mm/dd/yyyy)</label>
																									<div class="input-group">
																										<input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-cd0 flatpiker-with-border" id="completionyear" name="frm_passingdate[]" placeholder="Completion Date" autocomplete="off" value="">
																									</div>
																									<script>
																										flatpickr(".flatpickr-cd0",{
																									      dateFormat: "m-d-Y",
																									      maxDate: "01/01/2050",
																										});
																									</script>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		@endif
																	</div>
																	<div class="col-md-12">
																		<div class="addanother">
																			<a class="add_certificate"> + Add More</a>
																		</div>  
																	</div>
																</div>
															</div>
														</div>

														<div class="accordion-item shadow">
															<h2 class="accordion-header" id="accordionnestingExample5">
																<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse5" aria-expanded="false" aria-controls="accor_nestingExamplecollapse5">
																   Skills, Achievements And Awards
																</button>
															</h2>
															<div id="accor_nestingExamplecollapse5" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample5" data-bs-parent="#accordionnesting">
																<div class="accordion-body">
																	<div class="accordion nesting5-accordion custom-accordionwithicon accordion-border-box mt-3" id="skills_block">
																		@if(!empty(@$skill))
																			<input type="hidden"  name="skill_count" id="skill_count" value="{{ count(@$skill)- 1}}" />
																			@for($i=0; $i < count(@$skill); $i++)
																			<div class="accordion-item shadow mt-2" id="skill_count{{$i}}">
																				<h2 class="accordion-header" id="accordionnestingExamples{{$i}}">
																					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapses{{$i}}" aria-expanded="false" aria-controls="accor_nestingExamplecollapses{{$i}}">
																						<div class="container-fluid nopadding">
																							<div class="row">
																								<div class="col-lg-6 col-md-6 col-8"> Details </div>
																								@if($i!=0)
																								<div class="col-lg-6 col-md-6 col-4">
																									<div class="multiple-options">
																										<div class="setting-icon">
																											<i class="ri-more-fill"></i>
																											<ul>
																											   <li><a onclick="deletediv({{$i}},'skill_count')"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
																											</ul>
																										</div>
																									</div>
																								</div>
																								@endif
																							</div>
																						</div>
																					</button>
																				</h2>
																				<div id="accor_nestingExamplecollapses{{$i}}" class="accordion-collapse collapse" aria-labelledby="accordionnestingExamples{{$i}}" data-bs-parent="#accordionnesting5">
																					<div class="accordion-body">
																						<div class="row">
																							<div class="col-lg-6 col-md-6">
																								<div class="form-group mt-10">
																									<label for="pwd">Skill Type</label>
																									<select name="skill_type[]" id="skiils_achievments_awards1" class="form-select my-select">
																										<option value="">Select Item</option>
																										<option value="Skills" {{ ($skill[$i]=='Skills') ? 'selected' : '' }}>Skills</option>
																										<option value="Achievment" {{ ($skill[$i]=='Achievment') ? 'selected' : '' }}>Achievments</option>
																										<option value="Award" {{ ($skill[$i]=='Award') ? 'selected' : '' }}>Awards</option>
																									</select>
																								</div>
																							</div>
																							<div class="col-lg-6 col-md-6">
																								<div class="form-group mt-10">
																									<label>Completion Date (mm/dd/yyyy)</label>

																									<div class="input-group">
																										<input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-scd{{$i}} flatpiker-with-border" name="skillcompletion[]" id="skillcompletionpicker" value="{{ $skillcompletion[$i] }}">
																									</div>
																									<script>
																										flatpickr(".flatpickr-scd{{$i}}", {
																									      dateFormat: "m/d/Y",
																									      maxDate: "01/01/2050",
																							   		});
																									</script>
																								</div>
																							</div>
																							<div class="col-lg-6 col-md-6">
																								<div class="form-group mt-10">
																									<label for="pwd">Description</label>
																									<textarea name="frm_skilldetail[]" id="frm_skilldetail" placeholder="Description" cols="10" rows="3" class="form-control" maxlength="300">{{ $skilldetail[$i] }}</textarea>
																									<div class="word-counter">
																										<span id="frm_skilldetail_left">150</span> 
																										Characters Left 
																									</div>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																			@endfor
																		@else
																			<input type="hidden"  name="skill_count" id="skill_count" value="0" />
																			<div class="accordion-item shadow mt-2" id="skill_count0">
																				<h2 class="accordion-header" id="accordionnestingExamples0">
																					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapses0" aria-expanded="false" aria-controls="accor_nestingExamplecollapses0">
																						Details
																					</button>
																				</h2>
																				<div id="accor_nestingExamplecollapses0" class="accordion-collapse collapse" aria-labelledby="accordionnestingExamples0" data-bs-parent="#accordionnesting5">
																					<div class="accordion-body">
																						<div class="row">
																							<div class="col-lg-6 col-md-6">
																								<div class="form-group mt-10">
																									<label for="pwd">Skill Type</label>
																									<select name="skill_type[]" id="skiils_achievments_awards1" class="form-select my-select">
																										<option value="">Select Item</option>
																										<option value="Skills">Skills</option>
																										<option value="Achievment">Achievments</option>
																										<option value="Award">Awards</option>
																									</select>
																								</div>
																							</div>
																							<div class="col-lg-6 col-md-6">
																								<div class="form-group mt-10">
																									<label>Completion Date (mm/dd/yyyy)</label>

																									<div class="input-group">
																										<input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-scd0 flatpiker-with-border" name="skillcompletion[]" id="skillcompletionpicker" value="">
																									</div>
																									<script>
																										flatpickr(".flatpickr-scd0", {
																									      dateFormat: "m/d/Y",
																									      maxDate: "01/01/2050",
																							   		});
																									</script>
																								</div>
																							</div>
																							<div class="col-lg-6 col-md-6">
																								<div class="form-group mt-10">
																									<label for="pwd">Description</label>
																									<textarea name="frm_skilldetail[]" id="frm_skilldetail" placeholder="Description" cols="10" rows="3" class="form-control" maxlength="300"></textarea>
																									<div class="word-counter">
																										<span id="frm_skilldetail_left">150</span> 
																										Characters Left 
																									</div>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		@endif
																	</div>
																	<div class="col-md-12">
																		<div class="addanother">
																			<a class="add_skil"> + Add More</a>
																		</div>  
																	</div>
																</div>
															</div>
														</div>
														
														<div class="col-md-12 col-12">
															<button  class="btn-red-primary btn-red float-right mt-15 mb-10" @if(@$company->id == '') type="button" disable @else type="submit" @endif>Save </button>
														</div>
													</div>
												</div>
											</div><!-- end card-body -->
										</form>
									</div><!-- end card -->
								</div>
							</div>

							<div class="row">
								<div class="col-xl-12">
									<div class="card">
										<div class="card-header align-items-center d-flex">
											<h4 class="card-title mb-0 flex-grow-1">Company Specifics</h4>
										</div>

										<div class="card-body">
											<div class="live-preview">
												<div class="accordion" id="default-accordion-example">
													<div class="accordion-item shadow">
														<h2 class="accordion-header" id="headingTwo">
															<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
																Service Specifics
															</button>
														</h2>
														<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#default-accordion-example">
															<div class="accordion-body">
																<form action="{{route('personal.company.store')}}" method="post">
																	@csrf
																	<input type="hidden" name="cid" value="{{@$company->id}}">
																	<input type="hidden" name="step" value="3">
																	<div class="row">
																	<input type="hidden" name="id" value="{{@$service->id}}">
																	<div class="row">
																		<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
																			<div class="form-group mb-25">
																				<label for="email">Language(s) you and your staff speak ? (click all that apply) </label>
																				<select required="" name="languages[]" id="language" multiple="" tabindex="-1" data-ssid="ss-91931">
																					<option value="English">English</option>
																					<option value="Abkhazian">Abkhazian</option>
																					<option value="Afar">Afar</option>
																					<option value="Afrikaans">Afrikaans</option>
																					<option value="Albanian">Albanian</option>
																					<option value="Amharic">Amharic</option>
																					<option value="Arabic">Arabic</option>
																					<option value="Armenian">Armenian</option>
																					<option value="Assamese">Assamese</option>
																					<option value="Aymara">Aymara</option>
																					<option value="Azerbaijani">Azerbaijani</option>
																					<option value="Bashkir">Bashkir</option>
																					<option value="Basque">Basque</option>
																					<option value="Belarusian">Belarusian</option>
																					<option value="Bengali/Bangla">Bengali/Bangla</option>
																					<option value="Bhutani">Bhutani</option>
																					<option value="Bihari">Bihari</option>
																					<option value="Bislama">Bislama</option>
																					<option value="Breton">Breton</option>
																					<option value="Bulgarian">Bulgarian</option>
																					<option value="Burmese">Burmese</option>
																					<option value="Catalan">Catalan</option>
																					<option value="Cambodian">Cambodian</option>
																					<option value="Chinese">Chinese</option>
																					<option value="Corsican">Corsican</option>
																					<option value="Croatian">Croatian</option>
																					<option value="Czech">Czech</option>
																					<option value="Danish">Danish</option>
																					<option value="Dutch">Dutch</option>
																					<option value="Esperanto">Esperanto</option>
																					<option value="Estonian">Estonian</option>
																					<option value="Finnish">Finnish</option>
																					<option value="Fiji">Fiji</option>
																					<option value="Faeroese">Faeroese</option>
																					<option value="French">French</option>
																					<option value="Frisian">Frisian</option>
																					<option value="Galician">Galician</option>
																					<option value="Guarani">Guarani</option>
																					<option value="Gujarati">Gujarati</option>
																					<option value="Georgian">Georgian</option>
																					<option value="German">German</option>
																					<option value="Greek">Greek</option>
																					<option value="Greenlandic">Greenlandic</option>
																					<option value="Hausa">Hausa</option>
																					<option value="Hebrew">Hebrew</option>
																					<option value="Hindi">Hindi</option>
																					<option value="Hungarian">Hungarian</option>
																					<option value="Irish">Irish</option>
																					<option value="Interlingua">Interlingua</option>
																					<option value="Inupiak">Inupiak</option>
																					<option value="Indonesian">Indonesian</option>
																					<option value="Icelandic">Icelandic</option>
																					<option value="Italian">Italian</option>
																					<option value="Japanese">Japanese</option>
																					<option value="Javanese">Javanese</option>
																					<option value="Kazakh">Kazakh</option>
																					<option value="Kinyarwanda">Kinyarwanda</option>
																					<option value="Kirundi">Kirundi</option>
																					<option value="Kannada">Kannada</option>
																					<option value="Korean">Korean</option>
																					<option value="Kashmiri">Kashmiri</option>
																					<option value="Kurdish">Kurdish</option>
																					<option value="Kirghiz">Kirghiz</option>
																					<option value="Latin">Latin</option>
																					<option value="Lingala">Lingala</option>
																					<option value="Laothian">Laothian</option>
																					<option value="Lithuanian">Lithuanian</option>
																					<option value="Latvian/Lettish">Latvian/Lettish</option>
																					<option value="Malagasy">Malagasy</option>
																					<option value="Maori">Maori</option>
																					<option value="Macedonian">Macedonian</option>
																					<option value="Malayalam">Malayalam</option>
																					<option value="Mongolian">Mongolian</option>
																					<option value="Moldavian">Moldavian</option>
																					<option value="Marathi">Marathi</option>
																					<option value="Malay">Malay</option>
																					<option value="Maltese">Maltese</option>
																					<option value="Nauru">Nauru</option>
																					<option value="Nepali">Nepali</option>
																					<option value="Norwegian">Norwegian</option>
																					<option value="Occitan">Occitan</option>
																					<option value="(Afan)/Oromoor/Oriya">(Afan)/Oromoor/Oriya</option>
																					<option value="Persian">Persian</option>
																					<option value="Punjabi">Punjabi</option>
																					<option value="Polish">Polish</option>
																					<option value="Pashto/Pushto">Pashto/Pushto</option>
																					<option value="Portuguese">Portuguese</option>
																					<option value="Quechua">Quechua</option>
																					<option value="Rhaeto-Romance">Rhaeto-Romance</option>
																					<option value="Romanian">Romanian</option>
																					<option value="Russian">Russian</option>
																					<option value="Samoan">Samoan</option>
																					<option value="Sangro">Sangro</option>
																					<option value="Sanskrit">Sanskrit</option>
																					<option value="Shona">Shona</option>
																					<option value="Sindhi">Sindhi</option>
																					<option value="Singhalese">Singhalese</option>
																					<option value="Scots/Gaelic">Scots/Gaelic</option>
																					<option value="Serbo-Croatian">Serbo-Croatian</option>
																					<option value="Slovak">Slovak</option>
																					<option value="Slovenian">Slovenian</option>
																					<option value="Somali">Somali</option>
																					<option value="Serbian">Serbian</option>
																					<option value="Siswati">Siswati</option>
																					<option value="Sesotho">Sesotho</option>
																					<option value="Setswana">Setswana</option>
																					<option value="Spanish">Spanish</option>
																					<option value="Sundanese">Sundanese</option>
																					<option value="Swedish">Swedish</option>
																					<option value="Swahili">Swahili</option>
																					<option value="Tamil">Tamil</option>
																					<option value="Tibetan">Tibetan</option>
																					<option value="Telugu">Telugu</option>
																					<option value="Tajik">Tajik</option>
																					<option value="Thai">Thai</option>
																					<option value="Tigrinya">Tigrinya</option>
																					<option value="Turkmen">Turkmen</option>
																					<option value="Tagalog">Tagalog</option>
																					<option value="Tonga">Tonga</option>
																					<option value="Turkish">Turkish</option>
																					<option value="Tsonga">Tsonga</option>
																					<option value="Tatar">Tatar</option>
																					<option value="Twi">Twi</option>
																					<option value="Ukrainian">Ukrainian</option>
																					<option value="Urdu">Urdu</option>
																					<option value="Uzbek">Uzbek</option>
																					<option value="Vietnamese">Vietnamese</option>
																					<option value="Volapuk">Volapuk</option>
																					<option value="Welsh">Welsh</option>
																					<option value="Wolof">Wolof</option>
																					<option value="Xhosa">Xhosa</option>
																					<option value="Yiddish">Yiddish</option>
																					<option value="Yoruba">Yoruba</option>
																					<option value="Zulu">Zulu</option>
																				</select>
																			</div>
																		</div>
																		<div class="col-md-12 text-center">
																			<div class="form-group mb-25">
																				<label><h5>Hours of Operation</h5>Add your business hours and tell your customers when you're available for customer service, answering email and phone calls.</label><br>
																					<span style="font-size: 20px;font-weight: bold;">Hours</span><br>
																					<div class="custom-radio-btns">
																						<input type="radio" id="hours1" name="hours_opt" {{ (@$service->hours_opt == 'Open on selected hours') ? 'checked' : ''}} value="Open on selected hours" autocomplete="off" >
																						<span>Select hours</span>
																						<input type="radio" id="hours2" name="hours_opt" {{ (@$service->hours_opt == 'Temporalily closed') ? 'checked' : ''}} value="Temporalily closed" autocomplete="off">
																						<span>Temporalily closed</span>
																						<input type="radio" id="hours3" name="hours_opt" {{ (@$service->hours_opt == 'Permanently closed') ? 'checked' : ''}}value="Permanently closed" autocomplete="off">
																						<span>Permanently closed</span>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col-lg-12">
																			<div class="company-specifics-day company-specifics {{(@$service->hours_opt != 'Open on selected hours') ? 'd-none' : ''}}" id="selectdays" >
																				<div class="row">
																					<div class="col-lg-2 col-md-3 col-sm-2 col-xs-12">
																						<div class="form-group mb-10">
																							<label for="mon">Monday</label>
																						</div>
																					</div>

																					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																						<div class="form-group mb-10">{{timeSlotOptionforservice('mon_shift_start', @$service->mon_shift_start)}}</div>
																					</div>
																					
																					<div class="col-lg-2 col-sm-2 col-md-1 col-xs-12">
																						<div class="form-group text-center mmb-10">
																							To
																						</div>
																					</div>

																					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																						<div class="form-group mb-10">{{timeSlotOptionforservice('mon_shift_end', @$service->mon_shift_end)}}
																						</div>
																					</div>
																				</div>

																				<div class="row">
																					<div class="col-lg-2 col-md-3 col-sm-2 col-xs-12">
																						<div class="form-group mb-10">
																							<label for="tue">Tuesday</label>
																						</div>
																					</div>

																					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																						<div class="form-group mb-10">
																							{{timeSlotOptionforservice('tue_shift_start', @$service->tue_shift_start)}}
																						</div>
																					</div>
																					
																					<div class="col-lg-2 col-sm-2 col-md-1 col-xs-12">
																						<div class="form-group mmb-10 text-center">
																							To
																						</div>
																					</div>

																					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																						<div class="form-group mb-10">{{timeSlotOptionforservice('tue_shift_end', @$service->tue_shift_end)}}
																						</div>
																					</div>
																				</div>

																				<div class="row">
																					<div class="col-lg-2 col-md-3 col-sm-2 col-xs-12">	
																						<div class="form-group mb-10">
																							<label for="wed">Wednesday</label>
																						</div>
																					</div>
																					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																						<div class="form-group mb-10">{{timeSlotOptionforservice('wed_shift_start', @$service->wed_shift_start)}}
																						</div>
																					</div>																				

																					<div class="col-lg-2 col-sm-2 col-md-1 col-xs-12">
																						<div class="mmb-10 form-group text-center">
																							To
																						</div>
																					</div>

																					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																						<div class="form-group mb-10">
																							{{timeSlotOptionforservice('wed_shift_end', @$service->wed_shift_end)}}
																						</div>
																					</div>
																				</div>

																				<div class="row">
																					<div class="col-lg-2 col-md-3 col-sm-2 col-xs-12">
																						<div class="form-group mb-10">
																							<label for="thu">Thursday</label>
																						</div>
																					</div>
																					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																						<div class="form-group mb-10">
																							{{timeSlotOptionforservice('thu_shift_start', @$service->thu_shift_start)}}
																						</div>
																					</div>
																					
																					<div class="col-lg-2 col-sm-2 col-md-1 col-xs-12">
																						<div class="mmb-10 form-group text-center">
																							To
																						</div>
																					</div>
																					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																						<div class="form-group mb-10">
																							{{ timeSlotOptionforservice('thu_shift_end', @$service->thu_shift_end)}}
																						</div>
																					</div>
																				</div>
																				
																				<div class="row">
																					<div class="col-lg-2 col-md-3 col-sm-2 col-xs-12">
																						<div class="form-group mb-10">
																							<label for="fri">Friday</label>
																						</div>
																					</div>
																					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																						<div class="form-group mb-10">{{timeSlotOptionforservice('fri_shift_start', @$service->fri_shift_start)}}
																						</div>
																					</div>
																						
																					<div class="col-lg-2 col-sm-2 col-md-1 col-xs-12">
																						<div class="mmb-10 form-group text-center">
																							To
																						</div>
																					</div>

																					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																						<div class="form-group mb-10">{{timeSlotOptionforservice('fri_shift_end', @$service->fri_shift_end)}}
																						</div>
																					</div>
																				</div>

																				<div class="row">
																					<div class="col-lg-2 col-md-3 col-sm-2 col-xs-12">
																						<div class="form-group mb-10">
																							<label for="sat">Saturday</label>
																						</div>
																					</div>

																					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																						<div class="form-group mb-10">{{timeSlotOptionforservice('sat_shift_start', @$service->sat_shift_start)}}
																						</div>
																					</div>
																						
																					<div class="col-lg-2 col-md-1 col-sm-2 col-xs-12">
																						<div class="mmb-10 form-group text-center">
																							To
																						</div>
																					</div>

																					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">{{timeSlotOptionforservice('sat_shift_end', @$service->sat_shift_end)}}
																					</div>
																				</div>

																				<div class="row">
																					<div class="col-lg-2 col-md-3 col-sm-2 col-xs-12">
																						<div class="form-group mb-10">
																							<label for="sun">Sunday</label>
																						</div>
																					</div>

																					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																						<div class="form-group mb-10">{{timeSlotOptionforservice('sun_shift_start',
																							@$service->sun_shift_start)}}
																						</div>
																					</div>
																						
																					<div class="col-lg-2 col-sm-2 col-md-1 col-xs-12">
																						<div class="mmb-10 form-group text-center">
																							To
																						</div>
																					</div>

																					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																						<div class="form-group mb-10">{{timeSlotOptionforservice('sun_shift_end', @$service->sun_shift_end)}}
																						</div>
																					</div>
																						
																				</div>
																			</div>
																		</div>
																		<div class="col-lg-12">
																			<div id="selected_date_off mt-25">
																				<div class="row">
																					<div class="col-md-6 col-sm-6 col-xs-12">
																						<div class="form-group mb-15">
																							<label><strong>What is your time zone ?</strong> </label>
																							<select class="form-select" id="serTimeZone" name="serTimeZone">
																								<option value=""> Select Time Zone </option>
																								<option value="est" {{ (@$service->serTimeZone == 'est') ? 'selected' : ''}}>Eastern Standard Time - EST</option>
																								<option value="pst" {{ (@$service->serTimeZone == 'pst') ? 'selected' : ''}}>Pacific Standard Time - PST</option>
																								<option value="mst" {{ (@$service->serTimeZone == 'mst') ? 'selected' : ''}}>Mountain Standard Time - MST</option>
																								<option value="cst" {{ (@$service->serTimeZone == 'cst') ? 'selected' : ''}}>Central Standard Time - CST</option>
																							</select>
																						</div>
																						<div class="form-group mb-15">
																							<label><strong>Any Special Days Off ?</strong> </label>
																							<div class="special-date">     
																								<div class="input-group">
																									<input type="text" class="form-control flatpiker-with-border border-0 dash-filter-picker shadow flatpickr_multiple flatpickr-input active"readonly="readonly" id="daysOff" name="daysOff" value="">
																									<div class="input-group-text bg-primary border-primary text-white">
																										<i class="ri-calendar-2-line"></i>
																									</div>
																								</div>
																							</div>
																						</div>

																						<div class="form-group">
																							<label><strong>List amenities your business offers (Select that all apply)</strong> </label>
																							<select multiple id="offers" name="offers[]" >
																								<option value="Cardio Equipment">Cardio Equipment</option>
																								<option value="Strength Equipment">Strength Equipment</option>
																								<option value="Stretch Equipment">Stretch Equipment </option>
																								<option value="Equipment Rental">Equipment Rental</option>
																								<option value="Lounge Area">Lounge Area</option>
																								<option value="Waiting Area">Waiting Area</option>
																								<option value="Wifi">Wifi</option>
																								<option value="TV">TV</option>
																								<option value="Showers ">Showers </option>
																								<option value="Grooming Area">Grooming Area</option>
																								<option value="Pool ">Pool </option>
																								<option value="Jacuzzi  ">Jacuzzi </option>
																								<option value="Massage">Massage</option>
																								<option value="Salon">Salon</option>
																								<option value="Sauna">Sauna</option>
																								<option value="Steam Room">Steam Room</option>
																								<option value="Basketball court">Basketball court</option>
																								<option value="Tennis court">Tennis court</option>
																								<option value="Racquetball court">Racquetball court</option>
																								<option value="Track">Track</option>
																								<option value="Tanning beds">Tanning beds</option>
																								<option value="Juice Bar">Juice Bar</option>
																								<option value="Smoothie Bar">Smoothie Bar</option>
																								<option value="Bar Area">Bar Area</option>
																								<option value="Snacks">Snacks</option>
																								<option value="Nutritional Food">Nutritional Food</option>
																								<option value="Food Options">Food Options</option>
																								<option value="Cleaning Stations">Cleaning Stations</option>
																								<option value="Sanitizing stations">Sanitizing stations</option>
																								<option value="Lockers">Lockers</option>
																								<option value="Water Fountain">Water Fountain</option>
																								<option value="Bottle Fountain">Bottle Fountain</option>
																								<option value="Sound system">Sound system</option>
																								<option value="Social distancing">Social distancing</option>
																								<option value="Trained staff on AED">Trained staff on AED</option>
																								<option value="Trained CPR/ First Aid staff">Trained CPR/ First Aid staff </option>
																								<option value="Certified personal trainers">Certified personal trainers</option>
																								<option value="Alarm System">Alarm System</option>
																								<option value="Bike Parking">Bike Parking</option>
																								<option value="Car Parking">Car Parking</option>
																								<option value="Elevator">Elevator</option>
																								<option value="Security Cameras">Security Cameras</option>
																								<option value="Wheelchair accessible">Wheelchair accessible</option>
																								<option value="Outdoor seating">Outdoor seating</option>
																								<option value="Indoor seating">Indoor seating</option>
																							</select>
																						</div>
																					</div>

																					<div class="col-md-6 col-sm-6 col-xs-12" style="">
																						<div class="grey-box-date">
																							<div class="text-center">
																								<span class="select-date-off">Selected Date Off</span><br>
																								<label>Customers will not be able to book you on these days</label>
																							</div>

																							<div class="manual-remove"></div>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-12 float-right">
																				<button class="btn-red-primary btn-red float-right mt-15" @if(@$company->id == '') type="button" disable @else type="submit" @endif>Save </button>
																			</div>
																		</div>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div><!-- end card-body -->
									</div><!-- end card -->
								</div>

								<div class="col-xl-12">
									<div class="card">
										<div class="card-header align-items-center d-flex">
											<h4 class="card-title mb-0 flex-grow-1">Set Your Terms</h4>
										</div><!-- end card header -->

										<div class="card-body">
											<div class="live-preview">
												<div class="accordion" id="default-accordion-example">
													<div class="accordion-item shadow">
														<h2 class="accordion-header" id="headingThree">
															<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
																Terms
															</button>
														</h2>
														<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#default-accordion-example">
															<div class="accordion-body">
																<form action="{{route('personal.company.store')}}" method="post">
																	@csrf
																	<input type="hidden" name="cid" value="{{@$company->id}}">
																	<input type="hidden" name="id" value="{{@$terms->id}}">
																	<input type="hidden" name="step" value="4">
																	<div class="row">
																		<div class="col-md-6 col-sm-6 col-xs-12">
																			<div class="mb-25">
																				<p>Give your customers THINGS TO KNOW and information on how and what to prepare before they book.</p>
																			</div>
																			<div class="form-group mb-25">
																				<label for="house_rules">Know Before You Go </label>
																				<textarea placeholder="Tell your customers how they should conduct themselves when attending your place of business or participating in your activity. Set out a few guidelines to help things go smoothly." name="houserules" id="house_rules_terms" cols="30" rows="6" class="form-control" maxlength="1000">{{@$terms->houserules}}</textarea>
																				<div class="text-right word-counter">
																					<span id="house_rules_terms_left">1000</span> Characters Left
																				</div>
																			</div>
																			<div class="form-group mb-25">
																				<label for="cancelation_policy">Cancellation Policy </label>
																				<textarea placeholder="Let your customers know your rules about canceling a booking. Set your policy and regulations." name="cancelation" id="cancelation_policy" cols="30" rows="6" class="form-control" maxlength="1000">{{@$terms->cancelation}}</textarea>
																				<div class="text-right word-counter">
																					<span id="cancelation_policy_left">1000</span> Characters Left
																				</div>
																			</div>
																			<div class="form-group mb-25">
																				<label for="safety_cleaning">Safety and Cleaning Procedures <!-- <span id="star">*</span> --></label>
																				<textarea placeholder="Let your customers know your safety and cleaning procedures to keep them healthy and safe." name="cleaning" id="safety_cleaning" cols="30" rows="6" class="form-control" maxlength="1000">{{@$terms->cleaning}}</textarea>
																				<div class="text-right word-counter">
																					<span id="safety_cleaning_left">1000</span> Characters Left
																				</div>
																			</div>
																		</div>
																		
																		<div class="col-md-6 col-sm-6 col-xs-12">
																			<div class="mb-25">
																				<p>Select the section you require your clients to agree to upon completing registration.</p>
																			</div>
																			<div class="mb-15">
																				<label for="terms_1" class="col-md-12 terms-check1">
																					<input type="checkbox" value="1" class="chkdy" id="termcondfaq" name="termcondfaq" autocomplete="off" {{ (@$terms->termcondfaq==1) ? 'checked' : '' }}> Terms, Conditions, FAQ
																				</label>
																				<div id="termcondfaqdiv" style="display:{{ (@$terms->termcondfaq==1) ? 'block' : 'none' }}">
																					<textarea name="termcondfaqtext" id="ckeditor-classic" >{{@$terms->termcondfaqtext}}</textarea>
																				</div>

																				<!-- <div class="textsam" id="termcondfaqdiv"style="display:{{ (@$terms->termcondfaq==1) ? 'block' : 'none' }}">
																					<textarea class="form-control" placeholder="Terms, Conditions, FAQ" id="termcondfaqtext" name="termcondfaqtext" rows="5">{{@$terms->termcondfaqtext}}</textarea>
																					<div class="text-right word-counter">
																						<span id="termcondfaqtext_left">1000</span> Characters Left
																					</div>
																				</div> -->
																			</div>
																			
																			<div class="mb-15">
																				<label for="terms_2" class="terms-check2">
																					<input type="checkbox" value="1" class="chkdy" id="contractterm" name="contractterms" autocomplete="off" {{ (@$terms->contractterms==1) ? 'checked' : '' }}> Contract Terms ?
																				</label>
																				<div id="contracttermdiv" style="display:{{ (@$terms->contractterms==1) ? 'block' : 'none' }}">
																					<textarea name="contracttermstext" id="ckeditor-classic2">{{@$terms->contracttermstext}}</textarea>
																				</div>
																				<!-- <div class="col-md-12 textsam" id="contracttermdiv" style="display:{{ (@$terms->contractterms==1) ? 'block' : 'none' }}">
																					<textarea class="form-control" placeholder="Contract Terms" id="contracttermtext" name="contracttermstext" rows="8" maxlength="2000">{{@$terms->contracttermstext}}</textarea>
																					<div class="text-right word-counter">
																						<span id="contracttermtext_left">2000</span> Characters Left
																					</div>
																				</div> -->
																			</div>
																			
																			<div class="mb-15">
																				<label for="terms_3" class="col-md-12 terms-check3">
																					<input type="checkbox" value="1" class="chkdy" id="liabilitys" name="liability" autocomplete="off" {{ (@$terms->liability==1) ? 'checked' : '' }}> Liability Waiver
																				</label>
																				<div id="liabilitysdiv" style="display:{{ (@$terms->liability==1) ? 'block' : 'none' }}">
																					<textarea name="liabilitytext" id="ckeditor-classic3" >{{@$terms->liabilitytext}}</textarea>
																				</div>
																				<!-- <div class="col-md-12 textsam" id="liabilitysdiv" style="display:{{ (@$terms->liability==1) ? 'block' : 'none' }}">
																					<textarea class="form-control" placeholder="Liability Waiver" id="liabilitystext" name="liabilitytext" rows="5">{{@$terms->liabilitytext}}</textarea>
																					<div class="text-right word-counter">
																						<span id="liabilitystext_left">1000</span> Characters Left
																					</div>
																				</div> -->
																			</div>
																			
																			<div class="mb-15">
																				<label for="terms_4" class="col-md-12 terms-check4">
																					<input type="checkbox" value="1" class="chkdy" id="covids" name="covid" autocomplete="off" {{ (@$terms->covid==1) ? 'checked' : '' }}> Covid – 19 Protocols
																				</label>

																				<div id="covidsdiv" style="display:{{ (@$terms->covid==1) ? 'block' : 'none' }}">
																					<textarea name="covidtext" id="ckeditor-classic4">{{@$terms->covidtext}}</textarea>
																				</div>

																				<!-- <div class="col-md-12 textsam" id="covidsdiv" style="display:{{ (@$terms->covid==1) ? 'block' : 'none' }}">
																					<textarea class="form-control" placeholder="Covid – 19 Protocols" id="covidstext" name="covidtext" rows="5">{{@$terms->covidtext}}</textarea>
																					<div class="text-right word-counter">
																						<span id="covidstext_left">1000</span> Characters Left
																					</div>
																				</div> -->
																			</div>
																			
																			<div class="mb-15">
																				<label for="terms_5" class="col-md-12 terms-check5">
																					<input type="checkbox" value="1" class="chkdy" id="refundpolicy" name="refundpolicy" autocomplete="off" {{ (@$terms->refundpolicy==1) ? 'checked' : '' }}> Refund Policy
																				</label>

																				<div id="refundpolicydiv"  style="display:{{ (@$terms->refundpolicy==1) ? 'block' : 'none' }}">
																					<textarea name="refundpolicytext" id="ckeditor-classic5">{{@$terms->refundpolicytext}}</textarea>
																				</div>
																				<!-- <div class="col-md-12 textsam" id="refundpolicydiv" style="display:{{ (@$terms->refundpolicy==1) ? 'block' : 'none' }}">
																					<textarea class="form-control" placeholder="Refund Policy" id="refundpolicytext" name="refundpolicytext" rows="5">{{@$terms->refundpolicytext}}</textarea>
																					<div class="text-right word-counter">
																						<span id="refundpolicy_left">1000</span> Characters Left
																					</div>
																				</div> -->
																			</div>
																		</div>

																		<div class="col-md-12 col-12">
																			<button class="btn-red-primary btn-red float-right mt-15" @if(@$company->id == '') type="button" disable @else type="submit" @endif>Save </button>
																		</div> 
																	</div>
																</form>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> 
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
    
@include('layouts.business.footer')
@include('layouts.business.scripts')
	<script>
		$(document).ready(function(){ 
			$('#aboutcLeft').text(200-parseInt($("#about_host").val().length));
			$('#companyDescLeft').text(150-parseInt($("#shortDescription").val().length));
       		$('#aboutCompanyLeft').text(1000-parseInt($("#aboutCompany").val().length));
       		$('#house_rules_terms_left').text(1000-parseInt($("#house_rules_terms").val().length));
        	$('#cancelation_policy_left').text(1000-parseInt($("#cancelation_policy").val().length));
        	$('#safety_cleaning_left').text(1000-parseInt($("#safety_cleaning").val().length));
        /*	$('#termcondfaqtext_left').text(1000-parseInt($("#termcondfaqtext").val().length));
        	$('#contracttermtext_left').text(2000-parseInt($("#contracttermtext").val().length));
        	$('#refundpolicy_left').text(1000-parseInt($("#refundpolicytext").val().length));
        	$('#liabilitystext_left').text(1000-parseInt($("#liabilitystext").val().length));
        	$('#covidstext_left').text(1000-parseInt($("#covidstext").val().length));*/
        	$('#frm_skilldetail_left').text(150-parseInt($("#frm_skilldetail").val().length));


        	$("#about_host").on('input', function() {
            	$('#aboutcLeft').text(200-parseInt(this.value.length));
        	});

        	$("#frm_skilldetail").on('input', function() {
            	$('#frm_skilldetail_left').text(150-parseInt(this.value.length));
        	});
        	
       		$("#shortDescription").on('input', function() {
            	$('#companyDescLeft').text(150-parseInt(this.value.length));
        	});

        	$("#aboutCompany").on('input', function() {
            	$('#aboutCompanyLeft').text(1000-parseInt(this.value.length));
        	});

        	$("#house_rules_terms").on('input', function() {
            	$('#house_rules_terms_left').text(1000-parseInt(this.value.length));
	      	});

	      	$("#cancelation_policy").on('input', function() {
	         	$('#cancelation_policy_left').text(1000-parseInt(this.value.length));
        	});

        	$("#safety_cleaning").on('input', function() {
            	$('#safety_cleaning_left').text(1000-parseInt(this.value.length));
        	});

        	$("#termcondfaqtext").on('input', function() {
            	$('#termcondfaqtext_left').text(1000-parseInt(this.value.length));
        	}); 
        /*	$("#contracttermtext").on('input', function() {
            $('#contracttermtext_left').text(2000-parseInt(this.value.length));
        	});
        	$("#liabilitystext").on('input', function() {
            $('#liabilitystext_left').text(1000-parseInt(this.value.length));
        	}); 
        	$("#refundpolicytext").on('input', function() {
            $('#refundpolicy_left').text(1000-parseInt(this.value.length));
        	});
        	$("#liabilitytext").on('input', function() {
            $('#liabilitytext_left').text(1000-parseInt(this.value.length));
        	});
        	$("#covidstext").on('input', function() {
            $('#covidstext_left').text(1000-parseInt(this.value.length));
        	});*/


	      var special_dates = '{{ @$service->special_days_off }}';  
	      special_dates = special_dates.split(',');
	      $.each(special_dates, function( index, value ) {
	         if(value != "") {
	            $('.manual-remove').append('<button type="button" date="' + value + '" class="rounded-corner">' + value + ' x</button>');
	         }
	      });

			var langarr = [];
        	var languages = '{{ @$service->languages }}';
        	languages = languages.split(',');
        	$.each(languages, function( index, value ) {
           	langarr.push(value);
        	});
        	const displaySelect = new SlimSelect({
            select: '#language'
        	});
        	displaySelect.set(langarr);
        
        	var busiarr = [];
        	var serBusinessoff1 = '{{ @$service->serBusinessoff1 }}';
        	serBusinessoff1 = serBusinessoff1.split(',');
        	$.each(serBusinessoff1, function( index, value ) {
            busiarr.push(value);
        	});
        	const displaySelect1 = new SlimSelect({
            select: '#offers'
        	});
         displaySelect1.set(busiarr);

			$("body").on("click", ".add_employee", function(){
				var cnt=$('#Emp_count').val();
	      	cnt++;
	      	$('#Emp_count').val(cnt);
	      	var emp_details = "";
	      	Emp_count = "'Emp_count'";
	      	emp_details +='<div class="accordion-item shadow" id="Emp_count'+cnt+'"> <h2 class="accordion-header" id="accordionnesting2Example'+cnt+'"> <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse1'+cnt+'" aria-expanded="false" aria-controls="accor_nesting2Examplecollapse1'+cnt+'">     <div class="container-fluid nopadding"><div class="row"> <div class="col-lg-6 col-md-6 col-8"> Employment Details </div> <div class="col-lg-6 col-md-6 col-4"> <div class="multiple-options"> <div class="setting-icon"> <i class="ri-more-fill"></i> <ul> <li><a onclick="deletediv('+cnt+','+Emp_count+')"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li> </ul> </div> </div> </div> </div></div>        </button> </h2> <div id="accor_nesting2Examplecollapse1'+cnt+'" class="accordion-collapse collapse" aria-labelledby="accordionnesting2Example'+cnt+'" data-bs-parent="#empdetail_block"> <div class="accordion-body"> <div class="row"> <div class="col-lg-6 col-md-6"> <div class="form-group mt-10"> <label>Company Name </label> <input type="text" name="frm_organisationname[]" id="frm_organisationname" placeholder="Organization name" class="form-control" maxlength="100" value=""> </div> </div> <div class="col-lg-6 col-md-6"> <div class="form-group mt-10"> <label>Position </label> <input type="text" class="form-control" id="frm_position" name="frm_position[]" placeholder="Position" value="" maxlength="100"> </div> </div> <div class="col-lg-12 col-md-6"> <div class="form-group mt-25"> <label class=" present_work_btn"> <input type="checkbox" name="frm_ispresentcheck[]" id="frm_ispresentcheck'+cnt+'" onchange="checkstillwork(this.value,'+cnt+')" > <span>I Still Work Here</span> <input type="hidden" name="frm_ispresent[]" id="frm_ispresent'+cnt+'" value="1" > </label> </div> </div> <div class="col-lg-6 col-md-6" id="fromdiv'+cnt+'"> <div class="form-group mt-10" > <label>From (mm/dd/yyyy)</label> <div class="input-group"> <input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-from flatpiker-with-border" value="" id="from'+cnt+'" name="frm_servicestart[]" placeholder="From" data-behavior="flatpickr-date"> </div> </div> </div> <div class="col-lg-6 col-md-6" id="todiv'+cnt+'"> <div class="form-group mt-10" > <label>To (mm/dd/yyyy)</label> <div class="input-group"> <input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-to'+cnt+' flatpiker-with-border" value="" id="to'+cnt+'" name="frm_serviceend[]" placeholder="To" data-behavior="flatpickr-date"> </div> </div> </div> </div> </div> </div> </div>';
	      		$("#empdetail_block").append(emp_details);
	      });

	      $(document).on('focus', '[data-behavior~=flatpickr-date]', function(e){ 
	        //jQuery.noConflict();
	        $("[data-behavior~=flatpickr-date]").flatpickr( { 
	           	dateFormat: "m/d/Y",
			      maxDate: "01/01/2050",
			      minDate:"01/01/1960"
	        });
	    	});

	      $("body").on("click", ".add_education", function(){
				var cnt=$('#Edu_count').val();
	      	cnt++;
	      	$('#Edu_count').val(cnt);
	      	var edu_details = "";
	      	Edu_count = "'Edu_count'";
	      	edu_details +='<div class="accordion-item shadow mt-2" id="Edu_count'+cnt+'"> <h2 class="accordion-header" id="accordionnestingExampleec'+cnt+'"> <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapsec'+cnt+'" aria-expanded="false" aria-controls="accor_nestingExamplecollapsec'+cnt+'">         <div class="container-fluid nopadding"><div class="row"> <div class="col-lg-6 col-md-6 col-8"> Details </div> <div class="col-lg-6 col-md-6 col-4"> <div class="multiple-options"> <div class="setting-icon"> <i class="ri-more-fill"></i> <ul> <li><a onclick="deletediv('+cnt+','+Edu_count+')"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li> </ul> </div> </div> </div> </div></div>         </button> </h2> <div id="accor_nestingExamplecollapsec'+cnt+'" class="accordion-collapse collapse" aria-labelledby="accordionnestingExampleec'+cnt+'"" data-bs-parent="#accordionnesting3"> <div class="accordion-body"> <div class="row"> <div class="col-lg-6 col-md-6"> <div class="form-group mt-10"> <label>Degree - Course</label> <input type="text" id="frm_course" name="frm_course[]" class="form-control frm_course" placeholder="Degree/Course (Obtained or Seeking)" value="" maxlength="500"> </div> </div> <div class="col-lg-6 col-md-6"> <div class="form-group mt-10"> <label>University - School</label> <input type="text" id="frm_university" name="frm_university[]" class="form-control frm_university" placeholder="University/School" value="" maxlength="200"> </div> </div> <div class="col-lg-6 col-md-6"> <div class="form-group mt-10"> <label>Year Graduated (yyyy)</label> <div class="input-group"> <input type="text" class="form-control border-0 dash-filter-picker shadow flatpiker-with-border" value="" id="passingyear" name="frm_passingyear[]" placeholder="Year graduated" data-behavior=flatpickr-year> </div> </div> </div> </div> </div> </div> </div>';


	      	$("#education_block").append(edu_details);
	      });

	      $(document).on('focus', '[data-behavior~=flatpickr-year]', function(e){ 
	        //jQuery.noConflict();
	        $("[data-behavior~=flatpickr-year]").flatpickr( { 
	           	dateFormat: "Y",
			      maxDate: "2050",
			      minDate:"1960"
	        });
	    	});

	      $("body").on("click", ".add_certificate", function(){
				var cnt=$('#certi_count').val();
	      	cnt++;
	      	$('#certi_count').val(cnt);
	      	var certi_details = "";
	      	certi_count = "'certi_count'";
	      	certi_details +='<div class="accordion-item shadow mt-2" id="certi_count'+cnt+'"> <h2 class="accordion-header" id="accordioncerti'+cnt+'"> <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapsc'+cnt+'" aria-expanded="false" aria-controls="accor_nestingExamplecollapsc'+cnt+'">          <div class="container-fluid nopadding"><div class="row"> <div class="col-lg-6 col-md-6 col-8"> Details </div> <div class="col-lg-6 col-md-6 col-4"> <div class="multiple-options"> <div class="setting-icon"> <i class="ri-more-fill"></i> <ul> <li><a onclick="deletediv('+cnt+','+certi_count+')"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li> </ul> </div> </div> </div> </div></div>          </button> </h2> <div id="accor_nestingExamplecollapsc'+cnt+'" class="accordion-collapse collapse" aria-labelledby="accordioncerti'+cnt+'" data-bs-parent="#accordioncerti'+cnt+'"> <div class="accordion-body"> <div class="row"> <div class="col-lg-6 col-md-6"> <div class="form-group mt-10"> <label>Name of Certification </label> <input type="text" id="certification" name="certification[]" class="form-control" placeholder="Name of Certification" value="" maxlength="200"> </div> </div> <div class="col-lg-6 col-md-6"> <div class="form-group mt-10"> <label>Completion Date (mm/dd/yyyy)</label> <div class="input-group"> <input type="text" class="form-control border-0 dash-filter-picker shadow flatpiker-with-border" id="completionyear" name="frm_passingdate[]" placeholder="Completion Date" autocomplete="off" value="" data-behavior="flatpickr-date"> </div> </div> </div> </div> </div> </div> </div>';
					
	      	$("#certificate_block").append(certi_details);
	      });

	      $("body").on("click", ".add_skil", function(){
				var cnt=$('#skil_count').val();
	      	cnt++;
	      	$('#skil_count').val(cnt);
	      	var skill_details = "";
	      	skill_count = "'skill_count'";
	      	skill_details +='<div class="accordion-item shadow mt-2" id="skill_count'+cnt+'"> <h2 class="accordion-header" id="accordionnestingExamples'+cnt+'"> <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapses'+cnt+'" aria-expanded="false" aria-controls="accor_nestingExamplecollapses'+cnt+'">           <div class="container-fluid nopadding"><div class="row"> <div class="col-lg-6 col-md-6 col-8"> Details </div> <div class="col-lg-6 col-md-6 col-4"> <div class="multiple-options"> <div class="setting-icon"> <i class="ri-more-fill"></i> <ul> <li><a onclick="deletediv('+cnt+','+skill_count+')"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li> </ul> </div> </div> </div> </div></div>           </button> </h2> <div id="accor_nestingExamplecollapses'+cnt+'" class="accordion-collapse collapse" aria-labelledby="accordionnestingExamples'+cnt+'" data-bs-parent="#accordionnesting5"> <div class="accordion-body"> <div class="row"> <div class="col-lg-6 col-md-6"> <div class="form-group mt-10"> <label for="pwd">Skill Type</label> <select name="skill_type[]" id="skiils_achievments_awards1" class="form-select my-select"> <option value="">Select Item</option> <option value="Skills">Skills</option> <option value="Achievment">Achievments</option> <option value="Award">Awards</option> </select> </div> </div> <div class="col-lg-6 col-md-6"> <div class="form-group mt-10"> <label>Completion Date (mm/dd/yyyy)</label> <div class="input-group"> <input type="text" class="form-control border-0 dash-filter-picker shadow flatpiker-with-border" name="skillcompletion[]" id="skillcompletionpicker" value="" data-behavior="flatpickr-date"> </div> </div> </div> <div class="col-lg-6 col-md-6"> <div class="form-group mt-10"> <label for="pwd">Description</label> <textarea name="frm_skilldetail[]" id="frm_skilldetail" placeholder="Description" cols="10" rows="3" class="form-control" maxlength="300"></textarea> <div class="word-counter"> <span id="frm_skilldetail_left">150</span> Characters Left </div> </div> </div> </div> </div> </div> </div>';

	      	$("#skills_block").append(skill_details);
	      });

	      var fdate = [];
	    	var dDate = '{{ @$service->special_days_off }}';
	    	var  dateary = dDate.split(",");
	    	for (i = 0; i < dateary.length; i++) {
			   fdate.push(dateary[i]);
			}

			flatpickr(".flatpickr_multiple", {
				mode: "multiple",
			   dateFormat: "m/d/Y",
		      maxDate: "01/01/2050",
				
				defaultDate: fdate,
				onChange: function( selectedDates, dateStr, instance) {  
						if(dateStr.includes(', ')){
							dateStr = dateStr.slice((dateStr.lastIndexOf(', ')) + 1);
						}

						let list = '';
						$('.rounded-corner').each(function(i, obj) {
                  	list += $(this).attr('date')+',';
                  });

						if(dateStr != '' && !list.includes(dateStr)){
							$('.manual-remove').append('<button type="button" date="' + dateStr + '" class="rounded-corner">' + dateStr + ' x</button>')
						}
						instance.inline = true;
					}
		   });

		   $(document).on('click', '.rounded-corner', function() {
	        	var dates = removeValue($('#daysOff').val(), $(this).attr('date'));
	    	   var currentdate = $(this).attr('date');
	        	var dateObj = [];
	        	selectedDate = dates.split(',');
	        	for(var i=0; i<selectedDate.length;i++){
	        		if(selectedDate[i] !== $(this).attr('date')){
	            	dateObj.push(selectedDate[i]);
	        		}
	        	}
	      	$('#daysOff').val(dateObj);
	        	$(this).remove();
	    	});

		});

		function removeValue(list, value) {
        	return list.replace(new RegExp(",?" + value + ",?"), function(match) {
          	var first_comma = match.charAt(0) === ',',second_comma;
          	if (first_comma && (second_comma = match.charAt(match.length - 1) === ',')) {
            	return ',';
          	}
          	return '';
        	});
    	}

		function deletediv(i,cnt){
			var count=$('#'+cnt).val();
        	count--;
        	$('#'+cnt).val(count);
        	$('#'+cnt+i).remove();
		}

		function checkstillwork(val ,i){ 
		   if ( $("#frm_ispresentcheck"+i).is(":checked")){ 
		      $("#todiv"+i).addClass('d-none'); 
		      $("#frm_ispresent"+i).val('1');
		   }else{ 
		   	$("#todiv"+i).removeClass('d-none'); 
		   	$("#frm_ispresent"+i).val('0'); 
		   }
		}

		var p = new SlimSelect({
			select: '#language'
      });

      var p1 = new SlimSelect({
			select: '#offers'
		});

      $("#hours1").click(function () {
			$("#selectdays").removeClass('d-none');
		});
		$("#hours2").click(function () {
			$("#selectdays").addClass('d-none');
		});
		$("#hours3").click(function () {
			$("#selectdays").addClass('d-none');
		});
   </script>
	
	<script>
      $("#termcondfaq").click(function(){
         if($("#termcondfaq").is(':checked')) {
             $("#termcondfaqdiv").show();
         } else {
             $("#termcondfaqdiv").hide();
         }
      });

      $("#contractterm").click(function(){
         if($("#contractterm").is(':checked')) {
             $("#contracttermdiv").show();
         } else {
             $("#contracttermdiv").hide();
         }
      }); 

      $("#liabilitys").click(function(){
         if($("#liabilitys").is(':checked')) {
             $("#liabilitysdiv").show();
         } else {
             $("#liabilitysdiv").hide();
         }
      });

      $("#refundpolicy").click(function(){
         if($("#refundpolicy").is(':checked')) {
             $("#refundpolicydiv").show();
         } else {
             $("#refundpolicydiv").hide();
         }
      });    
  
      $("#covids").click(function(){
         if($("#covids").is(':checked')) {
             $("#covidsdiv").show();
         } else {
             $("#covidsdiv").hide();
         }    
      });    
	</script>

 	<script>
 		$(document).ready(function(){
 			ClassicEditor.create(document.querySelector("#ckeditor-classic2")).then(function(e) {
				e.ui.view.editable.element.style.height = "200px"
			}).catch(function(e) {
				console.error(e)
			});

			ClassicEditor.create(document.querySelector("#ckeditor-classic3")).then(function(e) {
				e.ui.view.editable.element.style.height = "200px"
			}).catch(function(e) {
				console.error(e)
			});

			ClassicEditor.create(document.querySelector("#ckeditor-classic4")).then(function(e) {
				e.ui.view.editable.element.style.height = "200px"
			}).catch(function(e) {
				console.error(e)
			});

			ClassicEditor.create(document.querySelector("#ckeditor-classic5")).then(function(e) {
				e.ui.view.editable.element.style.height = "200px"
			}).catch(function(e) {
				console.error(e)
			});
		});
 	</script>

@endsection