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
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="page-heading">
									<label>Manage Customers</label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="import-export float-end mt-10">
									<button href="#" data-bs-toggle="modal" data-bs-target=".uploadfile" class="btn btn-red">Import List</button>
									<div class="modal fade uploadfile" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="myModalLabel">Upload file for customer</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													<div class="form-group mt-10">
														<label for="img">Choose File: </label>
														<input type="file" class="form-control" name="file" id="file" onchange="readURL(this)">
													</div>					
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-primary btn-red">Upload File</button>
												</div>
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
									</div><!-- /.modal -->
									
									<form method="get" action="http://dev.fitnessity.co/exportcustomer">
										<input type="hidden" name="chk" id="chk" value="empty">
										<input type="hidden" name="id" id="id" value="437">
										<button type="submit" class="btn btn-black">Export List</button> 
									</form>
								</div>
							</div>
							
                            <!--end col-->
						</div>
                        <!--end row-->
						
						<div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header align-items-center d-flex">
										<h4 class="card-title mb-0 flex-grow-1">Customers</h4>
									</div><!-- end card header -->
									<div class="card-body">
									   <div class="total-clients">
											<i class="fas fa-user-circle"></i>
											<label>You Have 3 Clients</label>
										</div>
									   <div class="live-preview">
											<div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting">
												<div class="accordion-item shadow">
													<h2 class="accordion-header" id="accordionnestingExample1">
														<button class="accordion-button collapsed uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse1" aria-expanded="false" aria-controls="accor_nestingExamplecollapse1">
															A
														</button>
													</h2>
													<div id="accor_nestingExamplecollapse1" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample1" data-bs-parent="#accordionnesting">
														<div class="accordion-body">
														   <div class="mini-stats-wid d-flex align-items-center mt-3 scheduler-box">
																<div class="flex-shrink-0 avatar-sm">
																	<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">
																		A
																	</span>
																</div>
																<div class="col-lg-2 col-md-3 col-sm-3 ms-3">
																	<h6 class="mb-1">Ankita Patel</h6>
																	<p class="text-muted mb-0">Last Attended: </p>
																</div>
																<div class="col-lg-3 col-md-4 col-sm-4 ms-3">
																	<div class="client-age">
																		<h6 class="mb-1">Age</h6>
																		<span>19</span>
																	</div>
																</div>
												
																<div class="flex-grow-1 ms-3">
																	<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".customer-info"><i class="ri-more-fill"></i></a>
																	<div class="modal fade customer-info" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
																		<div class="modal-dialog modal-dialog-centered customer-modal-width">
																			<div class="modal-content">
																				<div class="modal-header">
																					<h5 class="modal-title" id="myModalLabel">Manage Customers</h5>
																						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																					</div>
																					<div class="modal-body">
																						<div class="scheduler-table">
																							<div class="table-responsive">
																								<table class="table mb-0">
																									<thead>
																										<tr>
																											<th>Status</th>
																											<th>Active Memberships</th>
																											<th>Expiring Soon</th>
																											<th></th>
																											<th></th>
																										</tr>
																									</thead>
																									<tbody>
																										<tr>
																											<td>
																												 <p class="mb-0 font-green"> Active</p>
																											</td>
																											<td>
																												<p class="mb-0">0</p>
																											</td>
																											<td>
																												<p class="mb-0">0</p>
																											</td>
																											<td>
																												<div class="scheduled-btns">
																													<button type="submit" class="btn btn-red mb-10">Send Welcome Email</button>
																													<button type="button" class="btn btn-black mb-10">View Account</button>
																												</div>
																											</td>
																											<td>
																												<div class="scheduled-btns">
																													<button type="button" class="btn btn-red">Delete</button>
																												</div>
																											</td>
																										</tr>
																										
																									</tbody>
																								</table>
																							</div>
																						</div>
																					</div>
																					<div class="modal-footer">
																						<button type="button" class="btn btn-primary btn-red">Submit</button>
																					</div>
																				</div><!-- /.modal-content -->
																			</div><!-- /.modal-dialog -->
																	</div><!-- /.modal -->
																</div>
												
															</div><!-- end -->
											
															<div class="mini-stats-wid d-flex align-items-center mt-3 scheduler-box">
																<div class="flex-shrink-0 avatar-sm">
																	<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">
																		A
																	</span>
																</div>
																<div class="col-lg-2 col-md-3 col-sm-3 ms-3">
																	<h6 class="mb-1">Ankita Patel</h6>
																	<p class="text-muted mb-0">Last Attended: </p>
																</div>
																<div class="col-lg-3 col-md-4 col-sm-4 ms-3">
																	<div class="client-age">
																		<h6 class="mb-1">Age</h6>
																		<span>19</span>
																	</div>
																</div>
																
																<div class="flex-grow-1 ms-3">
																	<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".customer-info"><i class="ri-more-fill"></i></a>
																</div>
																
															</div><!-- end -->
														 
														</div>
													</div>
												</div>
												<div class="accordion-item shadow">
													<h2 class="accordion-header" id="accordionnestingExample2">
														<button class="accordion-button collapsed uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse2" aria-expanded="false" aria-controls="accor_nestingExamplecollapse2">
															B
														</button>
													</h2>
													<div id="accor_nestingExamplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample2" data-bs-parent="#accordionnesting">
														<div class="accordion-body">
														   <div class="mini-stats-wid d-flex align-items-center mt-3 scheduler-box">
																<div class="flex-shrink-0 avatar-sm">
																	<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">
																		B
																	</span>
																</div>
																<div class="col-lg-2 col-md-3 col-sm-3 ms-3">
																	<h6 class="mb-1">Barry H. Blackmon</h6>
																	<p class="text-muted mb-0">Last Attended: </p>
																</div>
																<div class="col-lg-3 col-md-4 col-sm-4 ms-3">
																	<div class="client-age">
																		<h6 class="mb-1">Age</h6>
																		<span>32</span>
																	</div>
																</div>
																
																<div class="flex-grow-1 ms-3">
																	<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".customer-info1"><i class="ri-more-fill"></i></a>
																	<div class="modal fade customer-info1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
																		<div class="modal-dialog modal-dialog-centered customer-modal-width">
																			<div class="modal-content">
																				<div class="modal-header">
																					<h5 class="modal-title" id="myModalLabel">Manage Customers</h5>
																						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																					</div>
																					<div class="modal-body">
																						<div class="scheduler-table">
																							<div class="table-responsive">
																								<table class="table mb-0">
																									<thead>
																										<tr>
																											<th>Status</th>
																											<th>Active Memberships</th>
																											<th>Expiring Soon</th>
																											<th></th>
																											<th></th>
																										</tr>
																									</thead>
																									<tbody>
																										<tr>
																											<td>
																												 <p class="mb-0 font-red"> Inactive</p>
																											</td>
																											<td>
																												<p class="mb-0">0</p>
																											</td>
																											<td>
																												<p class="mb-0">0</p>
																											</td>
																											<td>
																												<div class="scheduled-btns">
																													<button type="submit" class="btn btn-red mb-10">Send Welcome Email</button>
																													<button type="button" class="btn btn-black mb-10">View Account</button>
																												</div>
																											</td>
																											<td>
																												<div class="scheduled-btns">
																													<button type="button" class="btn btn-red">Delete</button>
																												</div>
																											</td>
																										</tr>
																										
																									</tbody>
																								</table>
																							</div>
																						</div>
																					</div>
																					<div class="modal-footer">
																						<button type="button" class="btn btn-primary btn-red">Submit</button>
																					</div>
																				</div><!-- /.modal-content -->
																			</div><!-- /.modal-dialog -->
																	</div><!-- /.modal -->
																</div>
																
															</div><!-- end -->													  
														</div>
													</div>
												</div>
												<div class="accordion-item shadow">
													<h2 class="accordion-header" id="accordionnestingExample3">
														<button class="accordion-button collapsed uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse3" aria-expanded="false" aria-controls="accor_nestingExamplecollapse3">
														   c
														</button>
													</h2>
													<div id="accor_nestingExamplecollapse3" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample3" data-bs-parent="#accordionnesting">
														<div class="accordion-body">
															 <div class="mini-stats-wid d-flex align-items-center mt-3 scheduler-box">
																<div class="flex-shrink-0 avatar-sm">
																	<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">
																		c
																	</span>
																</div>
																<div class="col-lg-2 col-md-3 col-sm-3 ms-3">
																	<h6 class="mb-1">Customer 1 fast cust</h6>
																	<p class="text-muted mb-0">Last Attended: </p>
																</div>
																<div class="col-lg-3 col-md-4 col-sm-4 ms-3">
																	<div class="client-age">
																		<h6 class="mb-1">Age</h6>
																		<span>30</span>
																	</div>
																</div>
																
																<div class="flex-grow-1 ms-3">
																	<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".customer-info2"><i class="ri-more-fill"></i></a>
																	<div class="modal fade customer-info2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
																		<div class="modal-dialog modal-dialog-centered customer-modal-width">
																			<div class="modal-content">
																				<div class="modal-header">
																					<h5 class="modal-title" id="myModalLabel">Manage Customers</h5>
																						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																					</div>
																					<div class="modal-body">
																						<div class="scheduler-table">
																							<div class="table-responsive">
																								<table class="table mb-0">
																									<thead>
																										<tr>
																											<th>Status</th>
																											<th>Active Memberships</th>
																											<th>Expiring Soon</th>
																											<th></th>
																											<th></th>
																										</tr>
																									</thead>
																									<tbody>
																										<tr>
																											<td>
																												 <p class="mb-0 font-red"> Inactive</p>
																											</td>
																											<td>
																												<p class="mb-0">0</p>
																											</td>
																											<td>
																												<p class="mb-0">0</p>
																											</td>
																											<td>
																												<div class="scheduled-btns">
																													<button type="submit" class="btn btn-red mb-10">Send Welcome Email</button>
																													<button type="button" class="btn btn-black mb-10">View Account</button>
																												</div>
																											</td>
																											<td>
																												<div class="scheduled-btns">
																													<button type="button" class="btn btn-red">Delete</button>
																												</div>
																											</td>
																										</tr>
																										
																									</tbody>
																								</table>
																							</div>
																						</div>
																					</div>
																					<div class="modal-footer">
																						<button type="button" class="btn btn-primary btn-red">Submit</button>
																					</div>
																				</div><!-- /.modal-content -->
																			</div><!-- /.modal-dialog -->
																	</div><!-- /.modal -->
																</div>
																
															</div><!-- end -->	
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
	
@endsection