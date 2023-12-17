@inject('request', 'Illuminate\Http\Request')

@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')
	
	<!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
	
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
											<button type="button" class="btn btn-red"><i class="ri-add-line align-bottom me-1"></i> Add Announcement </button>
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
                                    <h5 class="card-title mb-0">Basic Datatables</h5>
                                </div>
                                <div class="card-body">
                                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
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
 <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="assets/js/pages/datatables.init.js"></script>
	<script>
	new DataTable('#example', {
		responsive: true
	});
	</script>
@endsection