@inject('request', 'Illuminate\Http\Request')

@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')
		
	<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<div class="row mb-3">
					<div class="col-12">
						<div class="page-heading">
							<label>Announcement</label>
						</div>
					</div>
				</div><!--end row-->
				<div class="row">
					<div class="col-xxl-12">
						<div class="card">	
							<div class="card-header align-items-center d-flex">
								<h4 class="card-title mb-0 flex-grow-1">Action</h4>
							</div>
							<div class="card-body">
								<div class="row y-middle">
									<div class="col-sm-auto">
										<div class="mb-20">
											<button type="button" class="btn btn-red" data-bs-toggle="modal" data-bs-target="#add_announcements"><i class="ri-add-line align-bottom me-1"></i> Add Announcement</button>
										</div>
									</div>
									<div class="col-sm-auto">
										<div class="mb-20">
											<button type="button" class="btn btn-red"><i class="fas fa-list me-1"></i> Categories </button>
										</div>
									</div>
								</div>
								<div class="row y-middle">
									<div class="col-lg-3">
										<label for="choices-publish-status-input" class="form-label">Category</label>
										<select class="form-select">
											<option value=""> -All- </option>
											<option value="">Option 1</option>
											<option value="">Option 2</option>
										</select>
									</div>
									<div class="col-lg-3">
										<label for="choices-publish-status-input" class="form-label">Visibility</label>
										<select class="form-select">
											<option value=""> Active </option>
											<option value=""> Inactive </option>
										</select>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title mb-0">Announcement</h5>
							</div>
							<div class="card-body">
								<table id="announcement_list" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
									<thead>
										<tr>
											<th data-ordering="false">Title</th>
											<th data-ordering="false">Category</th>
											<th data-ordering="false">Start Date</th>
											<th data-ordering="false">End Date</th>
											<th data-ordering="false">Actions</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												Coming Soon: Referendum
												<span class="badge badge-soft-success p-2">Visible</span>
											</td>
											<td>Referendum</td>
											<td>5/15/20  12:00 AM</td>
											<td>4/20/21  11:59 PM</td>
											<td>
												<div class="dropdown d-inline-block">
													<button class="btn btn-red btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
														<i class="ri-more-fill align-middle fs-10"></i>
													</button>
													<ul class="dropdown-menu dropdown-menu-end">
														<li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
														<li>
															<a class="dropdown-item remove-item-btn">
																<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
															</a>
														</li>
													</ul>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												Community Art Program
												<span class="badge badge-soft-success p-2">Visible</span>
											</td>
											<td>Landing-All</td>
											<td>5/1/21  10:00 AM</td>
											<td>4/15/22  11:59 PM</td>
											<td>
												<div class="dropdown d-inline-block">
													<button class="btn btn-red btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
														<i class="ri-more-fill align-middle fs-10"></i>
													</button>
													<ul class="dropdown-menu dropdown-menu-end">
														<li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
														<li>
															<a class="dropdown-item remove-item-btn">
																<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
															</a>
														</li>
													</ul>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												Employment Opportunities
												<span class="badge badge-soft-danger p-2">Invisible</span>
											</td>
											<td>Landing-All</td>
											<td>15/10/21  2:00 AM</td>
                                            <td>4/15/22  11:59 PM</td>
											<td>
												<div class="dropdown d-inline-block">
													<button class="btn btn-red btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
														<i class="ri-more-fill align-middle fs-10"></i>
													</button>
													<ul class="dropdown-menu dropdown-menu-end">
														<li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
														<li>
															<a class="dropdown-item remove-item-btn">
																<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
															</a>
														</li>
													</ul>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												Registration Forms Due
												<span class="badge badge-soft-danger p-2">Invisible</span>
											</td>
											<td>Landing-All</td>
											<td>8/6/21  2:00 AM</td>
											<td>12/31/22  11:59 PM</td>
											<td>
												<div class="dropdown d-inline-block">
													<button class="btn btn-red btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
														<i class="ri-more-fill align-middle fs-10"></i>
													</button>
													<ul class="dropdown-menu dropdown-menu-end">
														<li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
														<li>
															<a class="dropdown-item remove-item-btn">
																<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
															</a>
														</li>
													</ul>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												Variations of passages
												<span class="badge badge-soft-success p-2">Visible</span>
											</td>
											<td>Landing-All</td>
											<td>8/6/21  2:00 AM</td>
											<td>12/31/22  11:59 PM</td>
											<td>
												<div class="dropdown d-inline-block">
													<button class="btn btn-red btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
														<i class="ri-more-fill align-middle fs-10"></i>
													</button>
													<ul class="dropdown-menu dropdown-menu-end">
														<li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
														<li>
															<a class="dropdown-item remove-item-btn">
																<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
															</a>
                                                       </li>
													</ul>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												Established fact
												<span class="badge badge-soft-danger p-2">Invisible</span>
											</td>
											<td>Landing-All</td>
											<td>8/6/21  2:00 AM</td>
											<td>12/31/22  11:59 PM</td>
											<td>
												<div class="dropdown d-inline-block">
													<button class="btn btn-red btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
														<i class="ri-more-fill align-middle fs-10"></i>
													</button>
													<ul class="dropdown-menu dropdown-menu-end">
														<li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
														<li>
															<a class="dropdown-item remove-item-btn">
																<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
															</a>
														</li>
													</ul>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												Lorem Ipsum
												<span class="badge badge-soft-danger p-2">Invisible</span>
											</td>
											<td>Landing-All</td>
											<td>8/6/21  2:00 AM</td>
											<td>12/31/22  11:59 PM</td>
											<td>
												<div class="dropdown d-inline-block">
													<button class="btn btn-red btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
														<i class="ri-more-fill align-middle fs-10"></i>
													</button>
													<ul class="dropdown-menu dropdown-menu-end">
														<li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
														<li>
															<a class="dropdown-item remove-item-btn">
																<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
															</a>
														</li>
													</ul>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												Contrary to popular belief
												<span class="badge badge-soft-success p-2">Visible</span>
											</td>
											<td>Landing-All</td>
											<td>8/6/21  2:00 AM</td>
											<td>12/31/22  11:59 PM</td>
											<td>
												<div class="dropdown d-inline-block">
													<button class="btn btn-red btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
														<i class="ri-more-fill align-middle fs-10"></i>
													</button>
													<ul class="dropdown-menu dropdown-menu-end">
														<li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
														<li>
															<a class="dropdown-item remove-item-btn">
																<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
															</a>
														</li>
													</ul>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												Where can I get some
												<span class="badge badge-soft-success p-2">Visible</span>
											</td>
											<td>Landing-All</td>
											<td>8/6/21  2:00 AM</td>
											<td>12/31/22  11:59 PM</td>
											<td>
												<div class="dropdown d-inline-block">
													<button class="btn btn-red btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
														<i class="ri-more-fill align-middle fs-10"></i>
													</button>
													<ul class="dropdown-menu dropdown-menu-end">
														<li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
														<li>
															<a class="dropdown-item remove-item-btn">
																<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
															</a>
														</li>
													</ul>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												PageMaker including versions
												<span class="badge badge-soft-success p-2">Visible</span>
											</td>
											<td>Landing-All</td>
											<td>8/6/21  2:00 AM</td>
											<td>12/31/22  11:59 PM</td>
											<td>
												<div class="dropdown d-inline-block">
													<button class="btn btn-red btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
														<i class="ri-more-fill align-middle fs-10"></i>
													</button>
													<ul class="dropdown-menu dropdown-menu-end">
														<li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
														<li>
															<a class="dropdown-item remove-item-btn">
																<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
															</a>
														</li>
													</ul>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												Lorem Ipsum is not simply random text
												<span class="badge badge-soft-danger p-2">Invisible</span>
											</td>
											<td>Landing-All</td>
											<td>8/6/21  2:00 AM</td>
											<td>12/31/22  11:59 PM</td>
											<td>
												<div class="dropdown d-inline-block">
													<button class="btn btn-red btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
														<i class="ri-more-fill align-middle fs-10"></i>
													</button>
													<ul class="dropdown-menu dropdown-menu-end">
														<li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
														<li>
															<a class="dropdown-item remove-item-btn">
																<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
															</a>
														</li>
													</ul>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												What is Lorem Ipsum
												<span class="badge badge-soft-danger p-2">Invisible</span>
											</td>
											<td>Landing-All</td>
											<td>8/6/21  2:00 AM</td>
											<td>12/31/22  11:59 PM</td>
											<td>
												<div class="dropdown d-inline-block">
													<button class="btn btn-red btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
														<i class="ri-more-fill align-middle fs-10"></i>
													</button>
													<ul class="dropdown-menu dropdown-menu-end">
														<li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
														<li>
															<a class="dropdown-item remove-item-btn">
																<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
															</a>
														</li>
													</ul>
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
	</div>
</div><!-- END layout-wrapper -->

<!-- Modal -->
<div class="modal fade" id="add_announcements" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-50">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Required Settings</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="" autocomplete="off" class="needs-validation" novalidate="">
					<div class="row y-middle">
						<div class="col-lg-12">
							<div class="mb-3">
								<label class="form-label">Title</label>
								<input type="text" class="form-control" required="">
								<div class="float-right">Max to be <span id="programDescLeft"> 50</span></div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group mb-3">
								<label class="form-label">Short Description</label>
								<textarea class="form-control" id="" placeholder="Enter your description" rows="2"></textarea>
								<div class="float-right">Max to be <span id="programDescLeft"> 200</span></div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-2">
									<div class="form-check mb-3">
										<input class="form-check-input" type="checkbox" id="formCheck1">
										<label class="form-check-label" for="formCheck1">
											All
										</label>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="mb-3">
										<label class="form-label">Gender</label>
										<div>
											<form action="">
												<input class="form-check-input" type="checkbox" id="formCheck2">
												<label class="form-check-label mr-10" for="formCheck2">
													Male
												</label>

												<input class="form-check-input" type="checkbox" id="formCheck3">
												<label class="form-check-label mr-10" for="formCheck3">
													Female
												</label>
											</form>
										</div>
									</div>
								</div>

								<div class="col-lg-3">
									<div class="mb-3">
										<label class="form-label">Age</label>
										<div>
											<form action="">
												<input class="form-check-input" type="checkbox" id="formCheck4">
												<label class="form-check-label mr-10" for="formCheck4">
													Adult
												</label>

												<input class="form-check-input" type="checkbox" id="formCheck5">
												<label class="form-check-label mr-10" for="formCheck5">
													Kids
												</label>
											</form>
										</div>
									</div>
								</div>

								<div class="col-lg-4">
									<div class="mb-3">
										<label class="form-label">Status</label>
										<div>
											<form action="">
												<input class="form-check-input" type="checkbox" id="formCheck6">
												<label class="form-check-label mr-10" for="formCheck6">
													Active
												</label>

												<input class="form-check-input" type="checkbox" id="formCheck7">
												<label class="form-check-label mr-10" for="formCheck7">
													Inactive
												</label>

												<input class="form-check-input" type="checkbox" id="formCheck8">
												<label class="form-check-label mr-10" for="formCheck8">
													Prospects
												</label><br>

												<input class="form-check-input" type="checkbox" id="formCheck9">
												<label class="form-check-label mr-10" for="formCheck9">
													At-Risk
												</label>

												<input class="form-check-input" type="checkbox" id="formCheck10">
												<label class="form-check-label mr-10" for="formCheck10">
													Big-Spenders
												</label>
											</form>
										</div>
									</div>
								</div>

							</div>
						</div>

						<div class="col-lg-12">
							<div class="form-group mb-3">
								<label class="form-label">Programs</label>
								<select name="relationship[0]" id="relationship[0]" class="form-select" required="required">
									<option value="" selected="">Select Programs</option>
									<option value="">Option 1</option>
									<option value="">Option 2</option>
									<option value="">Option 3</option>
									<option value="">Option 4</option>
								</select>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="form-group mb-3">
								<label class="form-label">Category</label>
								<select name="relationship[0]" id="relationship[0]" class="form-select" required="required">
									<option value="" selected="">Select Category</option>
									<option value="">Option 1</option>
									<option value="">Option 2</option>
									<option value="">Option 3</option>
									<option value="">Option 4</option>
								</select>
							</div>
						</div>
						

						<div class="col-lg-6 col-md-6 col-sm-6 col-12">
							<div class="form-group mb-3">
								<label class="form-label">Start Date</label>
								<input type="text" class="form-control flatpickr" data-provider="flatpickr" id="JoiningdatInput" data-date-format="d M, Y" data-deafult-date="24 Nov, 2021" placeholder="Select date" />
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-12">
							<div class="form-group mb-3">
								<label class="form-label">Start Time</label>
								<input type="text" class="form-control" id="" value="">
							</div>
						</div>
										
						<div class="col-lg-6 col-md-6 col-sm-6 col-12">
							<div class="form-group mb-3">
								<label class="form-label">End Date</label>
								<input type="text" class="form-control end-flatpickr" data-provider="flatpickr" id="JoiningdatInput" data-date-format="d M, Y" data-deafult-date="24 Nov, 2021" placeholder="Select date" />
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-12">
							<div class="form-group mb-3">
								<label class="form-label">End Time</label>
								<input type="text" class="form-control" id="" value="">
							</div>
						</div>
						<div class="col-lg-12 col-md-6 col-sm-6 col-12">
							<div class="form-group mb-3">
								<input type="checkbox" id="Expire1" name="Expire1" value="Expire">
									<label for="Expire1"> Does This Announcement Expire ? 
										 <i class="fas fa-info-circle fs-15" data-bs-toggle="tooltip" data-bs-placement="right" title="Set your expiration time and date if you want this announcement to expire. This will remove it from the client announcement portal"></i>
									</label>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="">
								<label class="form-label">Announcement</label>
								<div id="ckeditor-classic">
									<p>Tommy Hilfiger men striped pink sweatshirt. Crafted with cotton. Material composition is 100% organic cotton. This is one of the world’s leading designer lifestyle brands and is internationally recognized for celebrating the essence of classic American cool style, featuring preppy with a twist designs.</p>
								</div>
							</div>
						</div>
					</div>
				</form>	
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-red">Submit</button>
			</div>
		</div>
	</div>
</div>

@include('layouts.business.footer')

	<script>
	new DataTable('#announcement_list', {
		responsive: true
	});
	</script>
@endsection