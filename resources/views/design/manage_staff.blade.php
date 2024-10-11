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
							<div class="col-lg-12">
								<div class="card" id="customerList">
									<div class="card-header border-bottom-dashed">

										<div class="row g-4 align-items-center">
											<div class="col-sm">
												<div>
													<h5 class="card-title mb-0">Staff List</h5>
												</div>
											</div>
										</div>
									</div>
									<div class="card-body border-bottom-dashed border-bottom">
										<form>
											<div class="row g-3">
												<div class="col-xl-6 col-sm-8 col-md-8 col-12">
													<div class="row g-3">
														<div class="col-lg-4 col-md-5 col-sm-4">
															<div>
																<button type="button" class="btn btn-red w-100" data-bs-toggle="modal" id="create-btn" data-bs-target=".addstaff">Add Staff</button>
															</div>
														</div>
														<div class="col-lg-8 col-md-7 col-sm-8">
															<div class="search-box">
																<input type="text" class="form-control search" placeholder="Search Staff Name">
																<i class="ri-search-line search-icon"></i>
															</div>
														</div>
													</div>
												</div>
												<!--end col-->
												<div class="col-xl-6 col-sm-4 col-md-4 col-12">
													<div class="row g-3">
														<div class="col-lg-4 col-sm-9 col-md-9 col-6">
															<div>
																<button type="button" class="btn btn-red w-100" onclick="SearchData();"></i>Search</button>
															</div>
														</div>
														<!--end col-->
														<div class="col-lg-8 col-sm-3 col-md-3 col-6">
															<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".manage-position"><i class="ri-more-fill"></i></a>
														</div>
													</div>
												</div>
											</div>
											<!--end row-->
										</form>
									</div>
									<div class="card-body">
										<div>
											<div class="table-responsive table-card mb-1">
												<table class="table align-middle" id="customerTable">
													<thead class="table-light text-muted">
														<tr>
															<th scope="col" style="width: 50px;">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" id="checkAll" value="option">
																</div>
															</th>

															<th class="sort" data-sort="customer_name">Profile Image</th>
															<th class="sort" data-sort="email">Full Name</th>
															<th class="sort" data-sort="phone">Position</th>
															<th class="sort" data-sort="status">Status</th>
															<th class="sort" data-sort="action">Action</th>
														</tr>
													</thead>
													<tbody class="list form-check-all">
														<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="">
																<div class="avatar-xsmall">
																	<span class="mini-stat-icon avatar-title xsmall-font rounded-circle text-success bg-soft-red fs-4 uppercase">A</span>
                                          						</div>
															</td>
															<td class="customer_name">Nipa Soni</td>
															<td class="email">Instructure</td>
															<td class="status">
																<span class="badge badge-soft-success text-uppercase">Active</span>
															</td>
															<td>
																<ul class="list-inline hstack gap-2 mb-0">
																	<li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
																		<a href="#showModal" data-bs-toggle="modal" class="font-black d-inline-block edit-item-btn">
																			<i class="ri-pencil-fill fs-16"></i>
																		</a>
																	</li>
																	<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
																		<a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteRecordModal">
																			<i class="ri-delete-bin-5-fill fs-16"></i>
																		</a>
																	</li>
																</ul>
															</td>
														</tr>
														<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="">
																<img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1669274706-1650612371-20.jpg" alt="" class="avatar-xs rounded-circle me-2 shadow">
															</td>
															<td class="customer_name">Black jack</td>
															<td class="email">Instructure</td>
															<td class="status">
																<span class="badge badge-soft-success text-uppercase">Active</span>
															</td>
															<td>
																<ul class="list-inline hstack gap-2 mb-0">
																	<li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
																		<a href="#showModal" data-bs-toggle="modal" class="font-black d-inline-block edit-item-btn">
																			<i class="ri-pencil-fill fs-16"></i>
																		</a>
																	</li>
																	<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
																		<a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteRecordModal">
																			<i class="ri-delete-bin-5-fill fs-16"></i>
																		</a>
																	</li>
																</ul>
															</td>
														</tr>
															<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="">
																<img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1669274706-1650612371-20.jpg" alt="" class="avatar-xs rounded-circle me-2 shadow">
															</td>
															<td class="customer_name">Ardella Franecki</td>
															<td class="email">Instructure</td>
															<td class="status">
																<span class="badge badge-soft-danger text-uppercase">Inactive</span>
															</td>
															<td>
																<ul class="list-inline hstack gap-2 mb-0">
																	<li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
																		<a href="#showModal" data-bs-toggle="modal" class="font-black d-inline-block edit-item-btn">
																			<i class="ri-pencil-fill fs-16"></i>
																		</a>
																	</li>
																	<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
																		<a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteRecordModal">
																			<i class="ri-delete-bin-5-fill fs-16"></i>
																		</a>
																	</li>
																</ul>
															</td>
														</tr>
															<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="">
																<img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1669274706-1650612371-20.jpg" alt="" class="avatar-xs rounded-circle me-2 shadow">
															</td>
															<td class="customer_name">Aarya test</td>
															<td class="email">Instructure</td>
															<td class="status">
																<span class="badge badge-soft-success text-uppercase">Active</span>
															</td>
															<td>
																<ul class="list-inline hstack gap-2 mb-0">
																	<li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
																		<a href="#showModal" data-bs-toggle="modal" class="font-black d-inline-block edit-item-btn">
																			<i class="ri-pencil-fill fs-16"></i>
																		</a>
																	</li>
																	<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
																		<a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteRecordModal">
																			<i class="ri-delete-bin-5-fill fs-16"></i>
																		</a>
																	</li>
																</ul>
															</td>
														</tr>
															<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="">
																<img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1669274706-1650612371-20.jpg" alt="" class="avatar-xs rounded-circle me-2 shadow">
															</td>
															<td class="customer_name">Phipps Darryl</td>
															<td class="email">Instructure</td>
															<td class="status">
																<span class="badge badge-soft-danger text-uppercase">Inactive</span>
															</td>
															<td>
																<ul class="list-inline hstack gap-2 mb-0">
																	<li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
																		<a href="#showModal" data-bs-toggle="modal" class="font-black d-inline-block edit-item-btn">
																			<i class="ri-pencil-fill fs-16"></i>
																		</a>
																	</li>
																	<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
																		<a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteRecordModal">
																			<i class="ri-delete-bin-5-fill fs-16"></i>
																		</a>
																	</li>
																</ul>
															</td>
														</tr>
															<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="">
																<img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1669274706-1650612371-20.jpg" alt="" class="avatar-xs rounded-circle me-2 shadow">
															</td>
															<td class="customer_name">Smith Deacon</td>
															<td class="email">Instructure</td>
															<td class="status">
																<span class="badge badge-soft-success text-uppercase">Active</span>
															</td>
															<td>
																<ul class="list-inline hstack gap-2 mb-0">
																	<li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
																		<a href="#showModal" data-bs-toggle="modal" class="font-black d-inline-block edit-item-btn">
																			<i class="ri-pencil-fill fs-16"></i>
																		</a>
																	</li>
																	<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
																		<a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteRecordModal">
																			<i class="ri-delete-bin-5-fill fs-16"></i>
																		</a>
																	</li>
																</ul>
															</td>
														</tr>
															<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="">
																<img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1669274706-1650612371-20.jpg" alt="" class="avatar-xs rounded-circle me-2 shadow">
															</td>
															<td class="customer_name">smith george</td>
															<td class="email">Instructure</td>
															<td class="status">
																<span class="badge badge-soft-danger text-uppercase">Inactive</span>
															</td>
															<td>
																<ul class="list-inline hstack gap-2 mb-0">
																	<li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
																		<a href="#showModal" data-bs-toggle="modal" class="font-black d-inline-block edit-item-btn">
																			<i class="ri-pencil-fill fs-16"></i>
																		</a>
																	</li>
																	<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
																		<a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteRecordModal">
																			<i class="ri-delete-bin-5-fill fs-16"></i>
																		</a>
																	</li>
																</ul>
															</td>
														</tr>
															<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="">
																<img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1669274706-1650612371-20.jpg" alt="" class="avatar-xs rounded-circle me-2 shadow">
															</td>
															<td class="customer_name">Test Discover</td>
															<td class="email">Instructure</td>
															<td class="status">
																<span class="badge badge-soft-success text-uppercase">Active</span>
															</td>
															<td>
																<ul class="list-inline hstack gap-2 mb-0">
																	<li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
																		<a href="#showModal" data-bs-toggle="modal" class="font-black d-inline-block edit-item-btn">
																			<i class="ri-pencil-fill fs-16"></i>
																		</a>
																	</li>
																	<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
																		<a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteRecordModal">
																			<i class="ri-delete-bin-5-fill fs-16"></i>
																		</a>
																	</li>
																</ul>
															</td>
														</tr>
															<tr>
															<th scope="row">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																</div>
															</th>
															<td class="">
																<img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1669274706-1650612371-20.jpg" alt="" class="avatar-xs rounded-circle me-2 shadow">
															</td>
															<td class="customer_name">Nipa Soni</td>
															<td class="email">Instructure</td>
															<td class="status">
																<span class="badge badge-soft-danger text-uppercase">Inactive</span>
															</td>
															<td>
																<ul class="list-inline hstack gap-2 mb-0">
																	<li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
																		<a href="#showModal" data-bs-toggle="modal" class="font-black d-inline-block edit-item-btn">
																			<i class="ri-pencil-fill fs-16"></i>
																		</a>
																	</li>
																	<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
																		<a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteRecordModal">
																			<i class="ri-delete-bin-5-fill fs-16"></i>
																		</a>
																	</li>
																</ul>
															</td>
														</tr>
														
													</tbody>
												</table>
												<div class="noresult" style="display: none">
													<div class="text-center">
														<lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
														<h5 class="mt-2">Sorry! No Result Found</h5>
														<p class="text-muted mb-0">We've searched more than 150+ customer We did not find any customer for you search.</p>
													</div>
												</div>
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
							<!--end col-->
						</div>
						<!--end row-->
					
						<!--end row-->
					</div> <!-- end .h-100-->
                  </div> <!-- end col -->
                </div>
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->

<div class="modal fade addstaff" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-80">
		<div class="modal-content">
			<div class="modal-header p-3">
				<h5 class="modal-title" id="exampleModalLabel">Add New Staff</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
			</div>
			<form action="http://dev.fitnessity.co/business/68/staff" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-3">
							<div class="photo-select">
								<img src="http://dev.fitnessity.co//public/images/service-nofound.jpg" class="pro_card_img blah" id="showimg">
								<input type="file" id="files" class="hidden">
								<label for="files">Upload Image</label>
							</div>
							<p>Upload an image to showcase your staff</p>
						</div>
						<div class="col-lg-9 col-md-9 col-sm-9">
							<div class="row">
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="form-group mb-10">
										<label for="fname">First Name</label>
										<input type="text" class="form-control" name="first_name">
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="form-group mb-10">
										<label for="lname">Last Name</label>
										<input type="text" class="form-control" name="last_name">
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="form-group mb-10">
										<label for="cnumber">Cell Number</label>
										<input type="text" class="form-control" name="phone" data-behavior="text-phone">
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="form-group mb-10">
										<label for="email">Email</label>
										<input type="text" class="form-control" name="email">
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="form-group mb-10">
										<label for="position">Position</label> 
										<a class="float-end">Add Position</a>
										<select class="form-select" name="businessType" required="">
											<option value="individual" selected="">Instructure</option>
										</select>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
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
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="form-group mb-10">
										<label for="address">Address</label>
										<input type="text" class="form-control" name="Address">
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="form-group mb-10">
										<label for="city">City</label>
										<input type="text" class="form-control" name="City">
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="form-group mb-10">
										<label for="state">State</label>
										<input type="text" class="form-control" name="State">
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="form-group mb-10">
										<label for="postcode">Post Code</label>
										<input type="text" class="form-control" name="Address">
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="form-group mb-10">
										<label for="email">Birthday <!-- <span id="star">*</span> --></label>
										<div class="input-group">
											<input type="text" class="form-control border-0 dash-filter-picker flatpickr-range flatpiker-with-border flatpickr-input active" data-range-date="false" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022" readonly="readonly">
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12">
									<div class="form-group mb-10 text-border public-bio">
										<label class="position-gander">Public Bio</label>
										<textarea class="form-control" id="" name="" rows="4" cols="80">Tell us something about your staff member. Customers will learn more about who they are training with.
										</textarea> 
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="hstack gap-2 justify-content-end">
						<button type="submit" class="btn btn-red" id="add-btn">Add</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade manage-position" tabindex="-1" aria-modal="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Add Positions</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="form-group mt-10">
							<label>Manage Positions</label>
							<input type="text" class="form-control" name="positions" id="positions" placeholder="Positions">
						</div>
					</div>	
					<div class="col-md-12 col-12">
						<button type="submit" class="btn-red-primary btn-red float-right mt-15">Submit</button>
					</div>					
				</div>
			</div>
		</div>
	</div>
</div>
	
	<!-- list.js min js -->
	<script src="{{asset('/public/dashboard-design/js/list.min.js')}}"></script>
	<script src="{{asset('/public/dashboard-design/js/list.pagination.min.js')}}"></script>
	
	<!-- ecommerce-customer init js -->
    <script src="{{asset('/public/dashboard-design/js/ecommerce-customer-list.init.js')}}"></script>
	
	
	@include('layouts.business.footer')
	<script>
		flatpickr(".flatpickr-range", {
	        dateFormat: "m/d/Y",
	        maxDate: "01/01/2050",
			defaultDate: [new Date()],
	     });
	</script>

@endsection