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
							<label>Announcement Category</label>
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
											<button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-red">
												<i class="ri-add-line align-bottom me-1"></i>Add Categories 
											</button>
											<a href="http://dev.fitnessity.co/design/announce_pro_add_category" class="btn btn-red"><i class="ri-add-line align-bottom me-1"></i> Add Categories </a>
										</div>
									</div>
									<div class="col-sm-auto">
										<div class="mb-20">
											<button type="button" class="btn btn-red"><i class="fas fa-bullhorn me-1"></i> Announcement </button>
										</div>
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
											<th data-ordering="false">Category</th>
											<th data-ordering="false">Number of Announcements</th>
											<th data-ordering="false">Actions</th>
										</tr>
									</thead>
									<tbody>										
										<tr>
											<td>Referendum</td>
											<td>5</td>
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
											<td>Landing-All</td>
											<td>0</td>
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
											<td>COVID-19 Announcements</td>
											<td>15</td>
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
											<td>District</td>
											<td>20</td>
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
											<td>Community</td>
											<td>3</td>
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
											<td>Fundraisers</td>
											<td>5</td>
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
											<td>Library</td>
											<td>5</td>
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
											<td>Birch Middle</td>
											<td>5</td>
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
<div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Required Settings</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="" autocomplete="off" class="needs-validation" novalidate="">
					<div class="row y-middle">
						<div class="col-lg-12 col-sm-12 col-md-12">
							<div class="mb-3">
								<label class="form-label">Category Name</label>
								<input type="text" class="form-control"  value="" required="">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-red">Add</button>
				<button type="button" class="btn btn-black">Reset</button>
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