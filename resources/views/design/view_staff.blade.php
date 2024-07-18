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
									<label>Manage Staff</label>
								</div>
							</div>
                            <!--end col-->
						</div>
                        <!--end row-->
						
						<div class="row">
							<div class="col-xxl-3 col-lg-3 col-sm-12">
								<div class="card">
									<div class="card-body p-4">
										<div>
											<div class="text-center">
												<div class="profile-user position-relative d-inline-block mx-auto  mb-4">
													<div class="avatar-xl">
														<span class="mini-stat-icon avatar-title msmall-font rounded-circle text-success bg-soft-red fs-4 uppercase">A</span>
                                          			</div>
													<!--<img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1669274706-1650612371-20.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow" alt="user-profile-image">-->
													<div class="avatar-xs p-0 rounded-circle profile-photo-edit">
														<input id="profile-img-file-input" type="file" class="profile-img-file-input">
														<label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
															<span class="avatar-title rounded-circle bg-light text-body shadow">
																<i class="ri-camera-fill"></i>
															</span>
														</label>
													</div>
												</div>
												<h5 class="fs-16 mb-1">Nipa Soni</h5> 
											</div>
											
											<div class="row">
												<div class="col-lg-12">
													<div class="form-group mt-10 mb-10">
														<label for="email">Full Name</label>
														<input type="text" class="form-control" name="Full Name" id="Full Name" size="30" placeholder="Full Name" value="" required="">
													</div>
													<div class="form-group mb-10">
														<label for="lname">Last Name</label>
														<input type="text" class="form-control" name="last_name">
													</div>
													<div class="form-group mb-10">
														<label for="cnumber">Cell Number</label>
														<input type="text" class="form-control" name="phone" data-behavior="text-phone">
													</div>
													<div class="form-group mb-10">
														<label for="email">Email</label>
														<input type="text" class="form-control" name="email">
													</div>
													<div class="form-group mb-10">
														<label for="email">Position</label>
														<select class="form-select" name="businessType" required="">
															<option value="individual" selected="">Instructure</option>
														</select>
													</div>
													<div class="form-group mb-10">
														<label class="position-gander">How Do You Identify?</label>
														<div>
															<input type="radio" id="male" name="fav_language" value="male">
															<label class="inner-fonts-staff" for="male">Male</label>
															<input type="radio" id="female" name="fav_language" value="Female">
															<label class="inner-fonts-staff" for="female">Female</label>
															<input type="radio" id="other" name="fav_language" value="Other">
															<label class="inner-fonts-staff" for="other">Other</label>
														</div>
													</div>
													<div class="form-group mb-10">
														<label for="address">Address</label>
														<input type="text" class="form-control" name="Address">
													</div>
													<div class="form-group mb-10">
														<label for="city">City</label>
														<input type="text" class="form-control" name="City">
													</div>
													<div class="form-group mb-10">
														<label for="state">State</label>
														<input type="text" class="form-control" name="State">
													</div>
													<div class="form-group mb-10">
														<label for="postcode">Post Code</label>
														<input type="text" class="form-control" name="Address">
													</div>
													<div class="form-group mb-10">
														<label for="email">Birthday <!-- <span id="star">*</span> --></label>
														<div class="input-group">
															<input type="text" class="form-control border-0 dash-filter-picker flatpickr-range flatpiker-with-border flatpickr-input active" data-range-date="false" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022" readonly="readonly">
														</div>
													</div>
													<div class="form-group mb-10">
														<label class="position-gander">Public Bio</label>
														<textarea class="form-control" id="" name="" rows="5">Tell us something about your staff member. Customers will learn more about who they are training with.
														</textarea> 
													</div>
													<div class="form-group mb-10 float-end">
														<button type="submit" class="btn btn-red" id="add-btn">Add</button>
													</div>
													
												</div>
												
											</div>
										</div>
									</div>
									<!--end card-body-->
									
								</div>
								<!--end card-->
							</div>
							<div class="col-xxl-9 col-lg-9 col-sm-12">
								<div class="card">
									<div class="card-header border-0 align-items-center d-flex">
										<h4 class="card-title mb-0 flex-grow-1">Staff Information</h4>
									</div><!-- end card header -->

									<div class="card-body pb-2">
										<div class="row">
											<div class="col-lg-2 col-md-3 col-sm-3">
												<div class="avatar-lg">
														<span class="mini-stat-icon avatar-title msmall-font rounded-circle text-success bg-soft-red fs-4 uppercase">A</span>
                                          			</div>
												<!--<div class="avatar-lg">
													<img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1669274706-1650612371-20.jpg" alt="user-img" class="img-thumbnail rounded-circle">
												</div>-->
											</div>
											<div class="col-lg-10 col-md-3 col-sm-9">
												<div class="row">
													<div class="col-lg-6 col-sm-12">
														<div class="mb-10">
															<div class="row">
																<div class="col-lg-4 col-sm-4 col-4">
																	<label> Name: </label>
																</div>
																<div class="col-lg-8 col-sm-8 col-8">
																	<span> Nipa Soni </span>
																</div>													
															</div>
														</div>
														<div class="mb-10">
															<div class="row">
																<div class="col-lg-4 col-sm-4 col-4">
																	<label> Cell Number: </label>
																</div>
																<div class="col-lg-8 col-sm-8 col-8">
																	<span> (+256) 2145-2156 </span>
																</div>													
															</div>
														</div>
														<div class="mb-10">
															<div class="row">
																<div class="col-lg-4 col-sm-4 col-4">
																	<label> Email: </label>
																</div>
																<div class="col-lg-8 col-sm-8 col-8">
																	<span>  contact@fitnessity.co </span>
																</div>													
															</div>
														</div>
														<div class="mb-10">
															<div class="row">
																<div class="col-lg-4 col-sm-4 col-4">
																	<label> Position: </label>
																</div>
																<div class="col-lg-8 col-sm-8 col-8">
																	<span>Instructure</span>
																</div>													
															</div>
														</div>
														<div class="mb-10">
															<div class="row">
																<div class="col-lg-4 col-sm-4 col-4">
																	<label> Gender: </label>
																</div>
																<div class="col-lg-8 col-sm-8 col-8">
																	<span>Female </span>
																</div>													
															</div>
														</div>
														<div class="mb-10">
															<div class="row">
																<div class="col-lg-4 col-sm-4 col-4">
																	<label> Address: </label>
																</div>
																<div class="col-lg-8 col-sm-8 col-8">
																	<span>XYZ Hilton Street, 125 Town US</span>
																</div>													
															</div>
														</div>
														
													</div>
													<div class="col-lg-6">
														<div class="mb-10">
															<div class="row">
																<div class="col-lg-4 col-sm-4 col-4">
																	<label> City: </label>
																</div>
																<div class="col-lg-8 col-sm-8 col-8">
																	<span>New York</span>
																</div>													
															</div>
														</div>
														<div class="mb-10">
															<div class="row">
																<div class="col-lg-4 col-sm-4 col-4">
																	<label> State: </label>
																</div>
																<div class="col-lg-8 col-sm-8 col-8">
																	<span>United States of America</span>
																</div>													
															</div>
														</div>
														<div class="mb-10">
															<div class="row">
																<div class="col-lg-4 col-sm-4 col-4">
																	<label> Post Code: </label>
																</div>
																<div class="col-lg-8 col-sm-8 col-8">
																	<span>157896</span>
																</div>													
															</div>
														</div>
														<div class="mb-10">
															<div class="row">
																<div class="col-lg-4 col-sm-4 col-4">
																	<label> Birthday: </label>
																</div>
																<div class="col-lg-8 col-sm-8 col-8">
																	<span>06-08-1994</span>
																</div>													
															</div>
														</div>
														<div class="mb-10">
															<div class="row">
																<div class="col-lg-4 col-sm-4 col-4">
																	<label> Public Bio: </label>
																</div>
																<div class="col-lg-8 col-sm-8 col-8">
																	<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
																</div>													
															</div>
														</div>
													</div>
														
													
												</div>
											</div>
										</div>
									</div><!-- end card body -->
								
								
								</div><!-- end card -->
								<div class="card" id="customerList">
									
									<div class="card-body">
										<div>
											<div class="table-responsive table-card mb-1">
												<table class="table table-hover table-centered align-middle table-nowrap mb-0 memberships-pack" id="customerTable">
													<thead class="table-light text-muted">
														<tr>
															<th scope="col" style="width: 50px;">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" id="checkAll" value="option">
																</div>
															</th>

															<th class="sort custom-sort" data-sort="activity">Activity</th>
															<th class="sort custom-sort" data-sort="program">Program</th>
															<th class="sort custom-sort" data-sort="map">Location</th>
															<th class="sort custom-sort" data-sort="days_of_week">Days of week</th>
															<th class="sort custom-sort" data-sort="position">Position</th>
															<th class="sort custom-sort" data-sort="service_type">Service Type</th>
															<th class="sort custom-sort" data-sort="duration">Duration</th>
															<th class="sort custom-sort" data-sort="time">Time</th>
														</tr>
													</thead>
													<tbody class="list form-check-all">
														<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="activity">s Krav Maga </td>
															<td class="program"> Womens Self Defense </td>
															<td class="map">At Business</td>
															<td class="days_of_week">03/26/2022</td>
															<td class="position"> 	Instructor</td>
															<td class="service_type"> 	Class</td>
															<td class="duration">2h 30m</td>
															<td class="time">1:00 pm to 3:30 pm </td>
														</tr>
														<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="activity">c Kickboxing</td>
															<td class="program">Kickboxing Level 1 for beginners</td>
															<td class="map">At Business</td>
															<td class="days_of_week">S,S </td>
															<td class="position"> Instructor</td>
															<td class="service_type"> Class</td>
															<td class="duration"> 45m</td>
															<td class="time">12:15 pm to 1:00 pm </td>
														</tr>
														<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="activity">c Kickboxing</td>
															<td class="program">Kickboxing Level 1 for beginners</td>
															<td class="map">At Business</td>
															<td class="days_of_week"> M,T,W,T,F </td>
															<td class="position">Instructor</td>
															<td class="service_type">Private Lesson</td>
															<td class="duration">45 m</td>
															<td class="time">6:15 pm to 7:00 pm </td>
														</tr>
														<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="activity">c Kickboxing</td>
															<td class="program">Personal Training </td>
															<td class="map">On Location</td>
															<td class="days_of_week">M,T,W,T,F,S,S </td>
															<td class="position"> Instructor</td>
															<td class="service_type">Private Lesson</td>
															<td class="duration">45 m</td>
															<td class="time">7:15 pm to 8:00 pm</td>
														</tr>
														<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="activity">ankita</td>
															<td class="program"> Personal Training </td>
															<td class="map">At Business</td>
															<td class="days_of_week">M,T,W,T,F,S,S</td>
															<td class="position"> 	Instructor</td>
															<td class="service_type">Private Lesson</td>
															<td class="duration">45 m</td>
															<td class="time">7:15 pm to 8:00 pm</td>
														</tr>
														<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="activity">ankita</td>
															<td class="program"> Personal Training </td>
															<td class="map">At Business</td>
															<td class="days_of_week">M,T,W,T,F,S,S</td>
															<td class="position"> 	Instructor</td>
															<td class="service_type">Private Lesson</td>
															<td class="duration">45 m</td>
															<td class="time">7:15 pm to 8:00 pm</td>
														</tr>
														<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="activity">nipa</td>
															<td class="program"> Personal Training </td>
															<td class="map">At Business</td>
															<td class="days_of_week">M,T,W,T,F,S,S</td>
															<td class="position"> 	Instructor</td>
															<td class="service_type">Private Lesson</td>
															<td class="duration">45 m</td>
															<td class="time">7:15 pm to 8:00 pm</td>
														</tr>
														<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="activity">ankita</td>
															<td class="program"> Personal Training </td>
															<td class="map">At Business</td>
															<td class="days_of_week">M,T,W,T,F,S,S</td>
															<td class="position"> 	Instructor</td>
															<td class="service_type">Private Lesson</td>
															<td class="duration">45 m</td>
															<td class="time">7:15 pm to 8:00 pm</td>
														</tr>
														<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="activity">ankita</td>
															<td class="program"> Personal Training </td>
															<td class="map">At Business</td>
															<td class="days_of_week">M,T,W,T,F,S,S</td>
															<td class="position"> 	Instructor</td>
															<td class="service_type">Private Lesson</td>
															<td class="duration">45 m</td>
															<td class="time">7:15 pm to 8:00 pm</td>
														</tr>
													
													
													
													
														
														
													</tbody>
												</table>
											</div>
											<div class="d-flex justify-content-end">
												<div class="pagination-wrap hstack gap-2">
													<a class="page-item pagination-prev disabled" href="#">
														Previous
													</a>
													<ul class="pagination listjs-pagination mb-0"></ul>
													<a class="page-item pagination-next" href="#">
														Next
													</a>
												</div>
											</div>
										</div>
									</div>
									
								</div>
							</div>
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