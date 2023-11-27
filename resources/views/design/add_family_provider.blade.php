@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.profile.business_topbar')
	<!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
		<div class="page-content">
            <div class="container-fluid">
               <div class="row mb-3">
					<div class="col-12">
						<div class="page-heading">
							<label>Manage Accounts</label>
						</div>
					</div>
                </div><!--end row-->
				<div class="row">
					<div class="col-12">
						<div class="card" id="contact-view-detail">
							<div class="card-body text-center">
								<h4 class="fs-18 mb-5 mt-5">Select Account To Manage</h4>
								<div class="profile-user position-relative d-inline-block mx-auto mb-4 ml-1 mr-1">
									<img src="https://fitnessity-production.s3.amazonaws.com/customer/IUwmNesKNJtrlzkSgjex1bzQoXhtvteofsrr44qQ.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow" alt="user-profile-image">
									<!--<div class="avatar-xs p-0 rounded-circle profile-photo-edit">
										<label class="profile-photo-edit photo-option-set avatar-xs">
											<span class="avatar-title rounded-circle bg-light text-body shadow">
												<div class="multiple-options multi-oops">
													<div class="setting-icon family-provider">
														<i class="ri-more-fill"></i>
														<ul>
															<li>
																<a class="edit-family" href="http://dev.fitnessity.co/personal-profile/user-profile"><i class="fas fa-plus text-muted pr-13"></i> Edit</a>
															</li>
															<li>
																<a class="view-booikng" href="http://dev.fitnessity.co/personal/orders"> <i class="fas fa-plus text-muted pr-13"></i> Booking Info</a>
															</li>
															<li>
																<a href="http://dev.fitnessity.co/personal-profile/payment-info">
																<i class="fas fa-plus text-muted pr-13"></i> Payment History</a>
															</li>
														</ul>
													</div>
												</div>
											</span>
										</label>
									</div>-->
									<div class="manage-account-name">
										<h5 class="mb-1 mt-2">Nipa Soni</h5>
									</div>
								</div>
								

								<div class="profile-user position-relative d-inline-block mx-auto mb-4 ml-1 mr-1">
									<img src="https://fitnessity-production.s3.amazonaws.com/activity/5gmokEA2e4XKU4TSPDErZfFKJyYImLAVbVwXQHlk.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow" alt="user-profile-image">
									<!-- <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
										<label class="profile-photo-edit photo-option-set avatar-xs">
											<span class="avatar-title rounded-circle bg-light text-body shadow">
												<div class="multiple-options multi-oops">
													<div class="setting-icon family-provider">
														<i class="ri-more-fill"></i>
														<ul>
															<li>
																<a class="edit-family" href="http://dev.fitnessity.co/personal-profile/user-profile"><i class="fas fa-plus text-muted pr-13"></i> Edit</a>
															</li>
															<li>
																<a class="view-booikng" href="http://dev.fitnessity.co/personal/orders"> <i class="fas fa-plus text-muted pr-13"></i> Booking Info</a>
															</li>
															<li>
																<a href="http://dev.fitnessity.co/personal-profile/payment-info">
																<i class="fas fa-plus text-muted pr-13"></i> Payment History</a>
															</li>
														</ul>
													</div>
												</div>
											</span>
										</label>
									</div>-->
									<div class="manage-account-name">
										<h5 class="mb-1 mt-2">Ankita Patel</h5>
									</div>
								</div>

								<div class="profile-user position-relative d-inline-block mx-auto mb-4 ml-1 mr-1">
									<img src="https://fitnessity-production.s3.amazonaws.com/activity/0BONWLWRLmu672gJmdMvxmoVTIYgfey3X23klhXE.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow" alt="user-profile-image">
									<!-- <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
										<label class="profile-photo-edit photo-option-set avatar-xs">
											<span class="avatar-title rounded-circle bg-light text-body shadow">
												<div class="multiple-options multi-oops">
													<div class="setting-icon family-provider">
														<i class="ri-more-fill"></i>
														<ul>
															<li>
																<a class="edit-family" href="http://dev.fitnessity.co/personal-profile/user-profile"><i class="fas fa-plus text-muted pr-13"></i> Edit</a>
															</li>
															<li>
																<a class="view-booikng" href="http://dev.fitnessity.co/personal/orders"> <i class="fas fa-plus text-muted pr-13"></i> Booking Info</a>
															</li>
															<li>
																<a href="http://dev.fitnessity.co/personal-profile/payment-info">
																<i class="fas fa-plus text-muted pr-13"></i> Payment History</a>
															</li>
														</ul>
													</div>
												</div>
											</span>
										</label>
									</div> -->
									<div class="manage-account-name">
										<h5 class="mb-1 mt-2">Purvi Patel</h5>
									</div>
								</div>

								<div class="profile-user position-relative d-inline-block mx-auto mb-4 ml-1 mr-1">
									<img src="https://fitnessity-production.s3.amazonaws.com/activity/agnLoERqZaRjzjKffSzxzq2BH54AekTZJQ4bH4ol.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow" alt="user-profile-image">
									<!--<div class="avatar-xs p-0 rounded-circle profile-photo-edit">
										<label class="profile-photo-edit photo-option-set avatar-xs">
											<span class="avatar-title rounded-circle bg-light text-body shadow">
												<div class="multiple-options multi-oops">
													<div class="setting-icon family-provider">
														<i class="ri-more-fill"></i>
														<ul>
															<li>
																<a class="edit-family" href="http://dev.fitnessity.co/personal-profile/user-profile"><i class="fas fa-plus text-muted pr-13"></i> Edit</a>
															</li>
															<li>
																<a class="view-booikng" href="http://dev.fitnessity.co/personal/orders"> <i class="fas fa-plus text-muted pr-13"></i> Booking Info</a>
															</li>
															<li>
																<a href="http://dev.fitnessity.co/personal-profile/payment-info">
																<i class="fas fa-plus text-muted pr-13"></i> Payment History</a>
															</li>
														</ul>
													</div>
												</div>
											</span>
										</label>
									</div> -->
									<div class="manage-account-name">
										<h5 class="mb-1 mt-2">Alia Bhatt</h5>
									</div>
								</div>
								
								<div class="profile-user position-relative d-inline-block mx-auto mb-4 ml-1 mr-1">
									<div class="rounded-circle avatar-xl img-thumbnail user-profile-image shadow no-img-latter">
										<p class="character character-renovate">OA</p>
									</div>
									<!-- <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
										<label class="profile-photo-edit photo-option-set avatar-xs">
											<span class="avatar-title rounded-circle bg-light text-body shadow">
												<div class="multiple-options multi-oops">
													<div class="setting-icon family-provider">
														<i class="ri-more-fill"></i>
														<ul>
															<li>
																<a class="edit-family" href="http://dev.fitnessity.co/personal-profile/user-profile"><i class="fas fa-plus text-muted pr-13"></i> Edit</a>
															</li>
															<li>
																<a class="view-booikng" href="http://dev.fitnessity.co/personal/orders"> <i class="fas fa-plus text-muted pr-13"></i> Booking Info</a>
															</li>
															<li>
																<a href="http://dev.fitnessity.co/personal-profile/payment-info">
																<i class="fas fa-plus text-muted pr-13"></i> Payment History</a>
															</li>
														</ul>
													</div>
												</div>
											</span>
										</label>
									</div> -->
									<div class="manage-account-name">
										<h5 class="mb-1 mt-2">Olivia Anderson</h5>
									</div>
								</div>
								
								<a href="#" data-bs-toggle="modal" data-bs-target=".add-family-provider">
									<div class="profile-user position-relative d-inline-block mx-auto ml-1 mr-1">
										<div class="rounded-circle add-plus-option">
											<div class="round0plus">
												<i class="fas fa-plus"></i>
											</div>
										</div>
										<div class="manage-account-name">
											<h5 class="mb-1 mt-2">Add Family</h5>
										</div>
									</div>
								</a>
								
                            </div>
						</div>
					</div>
				</div>
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->

<div class="modal fade add-family-provider" tabindex="-1" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-80">
		<div class="modal-content">
			<div class="modal-header p-3">
				<h5 class="modal-title" id="exampleModalLabel">Add Family or Friends</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
			</div>
			<form action="http://dev.fitnessity.co/business/68/staff" method="post">
				<div class="modal-body">
					<div class="row">	
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="photo-select product-edit user-dash-img mb-10">
								<input type="hidden" name="old_pic" value="">
								<img src="http://dev.fitnessity.co/images/service-nofound.jpg" class="pro_card_img blah" id="showimg">
									<input type="file" id="profile_pic" name="profile_pic" class="text-center">
							</div>
						</div>
						<div class="col-lg-8 col-md-8">	
							<div class="row">
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
									<div class="form-group mb-10">
										<label>First Name</label>
										<input type="text" name="fname" class="form-control" required="required" value="">
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
									<div class="form-group mb-10">
										<label>Last Name</label>
										<input type="text" name="lname" id="lname" class="form-control" required="required" value="">
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
									<div class="form-group mb-10">
										<label>Gender</label>
										<select name="gender" id="gender" class="form-select" required="required">
											<option value="" hidden="">Select Gender</option>
											<option value="Male">Male</option>
											<option value="Female">Female</option>
										</select>
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
									<div class="form-group mb-10">	
										<label>Email</label>
										<input type="email" name="email" id="email" class="form-control" value="" required="required">
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
									<div class="form-group mb-10">
										<label>Relationship</label>
										<select name="relationship" id="relationship" class="form-select" required="required">
											<option value="" hidden="">Select Relationship</option>
											<option value="Brother">Brother</option>
											<option value="Sister">Sister</option>
											<option value="Father">Father</option>
											<option value="Mother">Mother</option>
											<option value="Wife">Wife</option>
											<option value="Husband">Husband</option>
											<option value="Son">Son</option>
											<option value="Daughter">Daughter</option>
											<option value="Friend">Friend</option>
										</select>
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
									<div class="form-group mb-10">
										<label>Birth date</label>
										<input type="text" class="form-control border-0 dash-filter-picker flatpickr-range flatpiker-with-border flatpickr-input active" name="birthdate" id="birthdate" readonly="readonly">
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
									<div class="form-group mb-10">
										<label>Mobile Number</label>
										<input type="text" name="mobile" id="mobile"  class="form-control" value="" data-behavior="text-phone" maxlength="14">
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
									<div class="form-group mb-10">
										<label>Emergency Contact Number</label>
										<input type="text" name="emergency_contact" id="emergency_contact" class="form-control" maxlength="14" value="" data-behavior="text-phone">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="hstack gap-2 justify-content-end">
						<button type="submit" id="btn_family" class="btn btn-red">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
	
	@include('layouts.business.footer')
<script>
	flatpickr('.flatpickr-range',{
		dateFormat: "m/d/Y",
        maxDate: "today",
	});
</script>
	

@endsection