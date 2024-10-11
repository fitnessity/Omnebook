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
                        <div class="row mb-3">
							<div class="col-12">
								<div class="page-heading">
									<label>Add Family or Friends</label>
								</div>
							</div>
                            <!--end col-->
						</div>
                        <!--end row-->
						<div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-body">
										<div class="live-preview">
											<div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting">
												<div class="accordion-item shadow">
													<h2 class="accordion-header" id="accordionnestingExample1">
														<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse1" aria-expanded="true" aria-controls="accor_nestingExamplecollapse1">
															Add
														</button>
													</h2>
													<div id="accor_nestingExamplecollapse1" class="accordion-collapse collapse show" aria-labelledby="accordionnestingExample1" data-bs-parent="#accordionnesting">
														<div class="accordion-body">
															
															<div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting2">
																<div class="accordion-item shadow">
																	<h2 class="accordion-header" id="accordionnesting2Example1">
																		<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse1" aria-expanded="true" aria-controls="accor_nesting2Examplecollapse1">
																			<div class="container-fluid nopadding">
                                                                                <div class="row">
                                                                                    <div class="col-lg-6 col-md-6 col-8">
																						Ankita Patel
                                                                                    </div>
                                                                                    <div class="col-lg-6 col-md-6 col-4">
                                                                                        <div class="multiple-options">
                                                                                            <div class="setting-icon">
                                                                                                <i class="ri-more-fill"></i>
                                                                                                <ul>
                                                                                                    <li>
																										<a href="#"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>
																									</li>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
																			
																		</button>
																	</h2>
																	<div id="accor_nesting2Examplecollapse1" class="accordion-collapse collapse show" aria-labelledby="accordionnesting2Example1" data-bs-parent="#accordionnesting2">
																		<div class="accordion-body">
																			<div class="container-fluid nopadding">
																				<div class="row">
																					<div class="col-lg-4 col-md-6 col-sm-6">
																						<div class="form-group mb-15">
																							<input type="hidden" name="cus_id[0]" id="cus_id[0]" value="335">
																							<input type="text" name="fname[0]" id="fname[0]" placeholder="First Name" class="form-control" required="required" value="ankita">
																						</div>
																					</div>
																					
																					<div class="col-lg-4 col-md-6 col-sm-6">
																						<div class="form-group mb-15">
																							<input type="text" name="lname[0]" id="lname[0]" placeholder="Last Name" class="form-control" required="required" value="Patel">
																						</div>
																					</div>
																					
																					<div class="col-lg-4 col-md-6 col-sm-6">
																						<div class="form-group mb-15">
																							<select name="gender[0]" id="gender[0]" class="form-select" required="required">
																								<option value="" hidden="">Select Gender</option>
																								<option value="Male">Male</option>
																								<option selected="" value="Female">Female</option>
																							</select>
																						</div>
																					</div>
																					
																					<div class="col-lg-4 col-md-6 col-sm-6">
																						<div class="form-group mb-15">
																							<input type="email" name="email[0]" id="email[0]" placeholder="Email" class="form-control" value="ankita@gmail.com" required="required">
																						</div>
																					</div>
																					
																					<div class="col-lg-4 col-md-6 col-sm-6">
																						<div class="form-group mb-15">
																							<select name="relationship[0]" id="relationship[0]" class="form-select" required="required">
																								<option value="" hidden="">Select Relationship</option>
																								<option value="Brother">Brother</option>
																								<option value="Sister">Sister</option>
																								<option selected="" value="Father">Father</option>
																								<option value="Mother">Mother</option>
																								<option value="Wife">Wife</option>
																								<option value="Husband">Husband</option>
																								<option value="Son">Son</option>
																								<option value="Daughter">Daughter</option>
																								<option value="Friend">Friend</option>
																							</select>
																						</div>
																					</div>
																					
																					<div class="col-lg-4 col-md-6 col-sm-6">
																						<div class="form-group mb-15">
																							<div class="input-group">
																								<input type="text" class="form-control border-0 dash-filter-picker width-flatpiker flatpickr-range flatpiker-with-border flatpickr-input active" data-range-date="false" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022" readonly="readonly">
																							</div>
																						</div>
																					</div>
																					
																					<div class="col-lg-4 col-md-6 col-sm-6">
																						<div class="form-group mb-15">
																							<input type="text" name="mobile[0]" id="mobile0" placeholder="Mobile" class="form-control" value="(546) 454-5645" maxlength="14" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" onkeyup="changeformate('mobile0')">
																						</div>
																					</div>
																					
																					<div class="col-lg-4 col-md-6 col-sm-6">
																						<div class="form-group mb-15">
																							<input type="text" name="emergency_contact[0]" id="emergency_contact0" placeholder="Emergency Contact Number" class="form-control" maxlength="14" value="" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" onkeyup="changeformate('emergency_contact0')">
																							<input type="hidden" name="removed_family[0]" id="removed_family0" value="">
																						</div>
																					</div>
																					
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="accordion-item shadow">
																	<h2 class="accordion-header" id="accordionnesting2Example2">
																		<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting2Examplecollapse2">
																			<div class="container-fluid nopadding">
                                                                                <div class="row">
                                                                                    <div class="col-lg-6 col-md-6 col-8">
																						Add Family or Friends
                                                                                    </div>
                                                                                    <div class="col-lg-6 col-md-6 col-4">
                                                                                        <div class="multiple-options">
                                                                                            <div class="setting-icon">
                                                                                                <i class="ri-more-fill"></i>
                                                                                                <ul>
                                                                                                    <li>
																										<a href="#"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>
																									</li>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
																		</button>
																	</h2>
																	<div id="accor_nesting2Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting2Example2" data-bs-parent="#accordionnesting2">
																		<div class="accordion-body">
																			<div class="container-fluid nopadding">
																				<div class="row">
																					<div class="col-lg-4 col-md-6 col-sm-6">
																						<div class="form-group mb-15">
																							<input type="hidden" name="cus_id[0]" id="cus_id[0]" value="335">
																							<input type="text" name="fname[0]" id="fname[0]" placeholder="First Name" class="form-control" required="required" value="ankita">
																						</div>
																					</div>
																					
																					<div class="col-lg-4 col-md-6 col-sm-6">
																						<div class="form-group mb-15">
																							<input type="text" name="lname[0]" id="lname[0]" placeholder="Last Name" class="form-control" required="required" value="Patel">
																						</div>
																					</div>
																					
																					<div class="col-lg-4 col-md-6 col-sm-6">
																						<div class="form-group mb-15">
																							<select name="gender[0]" id="gender[0]" class="form-select" required="required">
																								<option value="" hidden="">Select Gender</option>
																								<option value="Male">Male</option>
																								<option selected="" value="Female">Female</option>
																							</select>
																						</div>
																					</div>
																					
																					<div class="col-lg-4 col-md-6 col-sm-6">
																						<div class="form-group mb-15">
																							<input type="email" name="email[0]" id="email[0]" placeholder="Email" class="form-control" value="ankita@gmail.com" required="required">
																						</div>
																					</div>
																					
																					<div class="col-lg-4 col-md-6 col-sm-6">
																						<div class="form-group mb-15">
																							<select name="relationship[0]" id="relationship[0]" class="form-select" required="required">
																								<option value="" hidden="">Select Relationship</option>
																								<option value="Brother">Brother</option>
																								<option value="Sister">Sister</option>
																								<option selected="" value="Father">Father</option>
																								<option value="Mother">Mother</option>
																								<option value="Wife">Wife</option>
																								<option value="Husband">Husband</option>
																								<option value="Son">Son</option>
																								<option value="Daughter">Daughter</option>
																								<option value="Friend">Friend</option>
																							</select>
																						</div>
																					</div>
																					
																					<div class="col-lg-4 col-md-6 col-sm-6">
																						<div class="form-group mb-15">
																							<div class="input-group">
																								<input type="text" class="form-control border-0 dash-filter-picker width-flatpiker flatpickr-range flatpiker-with-border flatpickr-input active" data-range-date="false" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022" readonly="readonly">
																							</div>
																						</div>
																					</div>
																					
																					<div class="col-lg-4 col-md-6 col-sm-6">
																						<div class="form-group mb-15">
																							<input type="text" name="mobile[0]" id="mobile0" placeholder="Mobile" class="form-control" value="(546) 454-5645" maxlength="14" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" onkeyup="changeformate('mobile0')">
																						</div>
																					</div>
																					
																					<div class="col-lg-4 col-md-6 col-sm-6">
																						<div class="form-group mb-15">
																							<input type="text" name="emergency_contact[0]" id="emergency_contact0" placeholder="Emergency Contact Number" class="form-control" maxlength="14" value="" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" onkeyup="changeformate('emergency_contact0')">
																							<input type="hidden" name="removed_family[0]" id="removed_family0" value="">
																						</div>
																					</div>
																					
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="container-fluid nopadding">
																<div class="row">
																	<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																		<div class="form-group mt-10">
																			<a class="addmore_addfamily">+ Add More</a>
																		</div>
																	</div>
																	<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																		<input type="submit" name="btn_family" id="btn_family" value="Submit" class="btn btn-red float-end mt-10">
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
							<!--end col-->
						</div>
						<!--end row-->
					</div> <!-- end .h-100-->
                  </div> <!-- end col -->
                </div>
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->



	
	@include('layouts.business.footer')
	<script>
		flatpickr(".flatpickr-range", {
	        dateFormat: "m/d/Y",
	        maxDate: "01/01/2050",
			defaultDate: [new Date()],
	     });
	</script>

@endsection