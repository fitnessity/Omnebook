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
											<a href="http://dev.fitnessity.co/design/announce_pro_add_announcements" type="button" class="btn btn-red"><i class="ri-add-line align-bottom me-1"></i> Add Announcement </a>
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



@include('layouts.business.footer')

	<script>
	new DataTable('#announcement_list', {
		responsive: true
	});
	</script>
@endsection