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
									<button href="#" data-bs-toggle="modal" data-bs-target=".uploadfile" class="btn btn-red">Upload</button>
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
							<div class="col-lg-12">
								<div class="card">
									<div class="card-body client-tabs">
										<!-- Nav tabs -->
										<ul class="nav nav-tabs mb-3" role="tablist">
											<li class="nav-item">
												<a class="nav-link active" data-bs-toggle="tab" href="#client" role="tab" aria-selected="false">
													Clients
												</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" data-bs-toggle="tab" href="#beltpromotions" role="tab" aria-selected="false">
													Promotions
												</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" data-bs-toggle="tab" href="#clientstats" role="tab" aria-selected="false">
													Client Stats 
												</a>
											</li>
										</ul>
										<!-- Tab panes -->
										<div class="tab-content  text-muted">
											<div class="tab-pane active" id="client" role="tabpanel">
												<div class="row">
													<div class="col-lg-12">
														<div class="">
															<!-- Nav tabs -->
															<ul class="nav nav-tabs mb-3" role="tablist">
																<li class="nav-item">
																	<a class="nav-link active" data-bs-toggle="tab" href="#totalclient" role="tab" aria-selected="false">
																		Total Members (3)
																	</a>
																</li>
																<li class="nav-item">
																	<a class="nav-link" data-bs-toggle="tab" href="#activemembers" role="tab" aria-selected="false">
																		Active Members (5)
																	</a>
																</li>
																<li class="nav-item">
																	<a class="nav-link" data-bs-toggle="tab" href="#inactivemembers" role="tab" aria-selected="false">
																		Inactive Members (10)
																	</a>
																</li>
																<li class="nav-item">
																	<a class="nav-link" data-bs-toggle="tab" href="#prospects" role="tab" aria-selected="false">
																		Prospects (6)
																	</a>
																</li>
																<li class="nav-item">
																	<a class="nav-link" data-bs-toggle="tab" href="#suspended" role="tab" aria-selected="false">
																		Suspended (5)
																	</a>
																</li>
																<li class="nav-item">
																	<a class="nav-link" data-bs-toggle="tab" href="#owed" role="tab" aria-selected="false">
																		Owed (3)
																	</a>
																</li>
																<li class="nav-item">
																	<a class="nav-link" data-bs-toggle="tab" href="#atrisk" role="tab" aria-selected="false">
																		At-Risk (6)
																	</a>
																</li>
																<li class="nav-item">
																	<a class="nav-link" data-bs-toggle="tab" href="#bigspenders" role="tab" aria-selected="false">
																		Big Spenders (9)
																	</a>
																</li>
															</ul>
															<!-- Tab panes -->
															<div class="tab-content  text-muted">
																<div class="tab-pane active" id="totalclient" role="tabpanel">
																	<div class="row">
																		<div class="col-xl-12">
																			<div class="card">
																				<div class="card-header align-items-center d-flex">
																					<div class="container-fluid nopadding">
																						<div class="row y-middle">
																							<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																								<h4 class="card-title mb-0 flex-grow-1">Customers</h4>
																							</div>
																							<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																								<div class="multiple-options">
																									<div class="setting-icon">
																										<i class="ri-more-fill fs-26"></i>
																										<ul id="catUl0">
																											<li><a href="#" data-bs-toggle="modal" data-bs-target="#merge_customer"><i class="fas fa-plus text-muted"></i>Merge Clients</a></li>
																											</li>				
																										</ul>
																									</div>
																								</div>
																							</div>
																							<!--<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																								<div class="text-right">
																									<button class="btn btn-sm btn-soft-danger remove-list" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus"></i></button>
																								</div>									
																							</div>	-->		
																						</div>
																					</div>
																															
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
																											<a class="w-100" href="http://dev.fitnessity.co/design/clientsview" target="_blank">
																												<div class="row">
																													<div class="flex-shrink-0 avatar-sm customer-avatar">
																														<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">A</span>
																													</div>
																												
																													<div class="col-lg-2 col-md-3 col-sm-3 col-5">
																														<h6 class="mb-1">A Watts</h6>
																														<p class="text-muted mb-0">Last Attended:  </p>
																													</div>
																													<div class="col-lg-3 col-md-4 col-sm-4 col-3">
																														<div class="client-age">
																															<h6 class="mb-1">Age</h6>
																															<span>15</span>
																														</div>
																													</div>
																												</div>
																											</a>
																											<div class="flex-grow-1 ">
																												<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".customer-info1"><i class="ri-more-fill"></i></a>
																											</div>
																										</div>
																										<div class="mini-stats-wid d-flex align-items-center mt-3 scheduler-box">
																											<a class="w-100" href="http://dev.fitnessity.co/design/clientsview" target="_blank">
																												<div class="row">
																													<div class="flex-shrink-0 avatar-sm customer-avatar">
																														<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">A</span>
																													</div>
																												
																													<div class="col-lg-2 col-md-3 col-sm-3 col-5">
																														<h6 class="mb-1">Aaa Bbb</h6>
																														<p class="text-muted mb-0">Last Attended:  </p>
																													</div>
																													<div class="col-lg-3 col-md-4 col-sm-4 col-3">
																														<div class="client-age">
																															<h6 class="mb-1">Age</h6>
																															<span>20</span>
																														</div>
																													</div>
																												</div>
																											</a>
																											<div class="flex-grow-1 ">
																												<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".customer-info1"><i class="ri-more-fill"></i></a>
																											</div>
																										</div>
																						
																										<div class="mini-stats-wid d-flex align-items-center mt-3 scheduler-box">
																											<a class="w-100" href="http://dev.fitnessity.co/design/clientsview" target="_blank">
																												<div class="row">
																													<div class="flex-shrink-0 avatar-sm customer-avatar">
																														<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">A</span>
																													</div>
																												
																													<div class="col-lg-2 col-md-3 col-sm-3 col-5">
																														<h6 class="mb-1">Aadi Jambawalikar</h6>
																														<p class="text-muted mb-0">Last Attended:  </p>
																													</div>
																													<div class="col-lg-3 col-md-4 col-sm-4 col-3">
																														<div class="client-age">
																															<h6 class="mb-1">Age</h6>
																															<span>22</span>
																														</div>
																													</div>
																												</div>
																											</a>
																											<div class="flex-grow-1 ">
																												<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".customer-info1"><i class="ri-more-fill"></i></a>
																											</div>
																										</div>
																									
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
																											<a class="w-100" href="http://dev.fitnessity.co/design/clientsview" target="_blank">
																												<div class="row">
																													<div class="flex-shrink-0 avatar-sm customer-avatar">
																														<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">B</span>
																													</div>
																												
																													<div class="col-lg-2 col-md-3 col-sm-3 col-5">
																														<h6 class="mb-1">Barry H. Blackmon</h6>
																														<p class="text-muted mb-0">Last Attended:  </p>
																													</div>
																													<div class="col-lg-3 col-md-4 col-sm-4 col-3">
																														<div class="client-age">
																															<h6 class="mb-1">Age</h6>
																															<span>32</span>
																														</div>
																													</div>
																												</div>
																											</a>
																											<div class="flex-grow-1 ">
																												<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".customer-info1"><i class="ri-more-fill"></i></a>
																											</div>
																										</div>												  
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
																											<a class="w-100" href="http://dev.fitnessity.co/design/clientsview" target="_blank">
																												<div class="row">
																													<div class="flex-shrink-0 avatar-sm customer-avatar">
																														<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">C</span>
																													</div>
																												
																													<div class="col-lg-2 col-md-3 col-sm-3 col-5">
																														<h6 class="mb-1">Customer 1 fast cust</h6>
																														<p class="text-muted mb-0">Last Attended:  </p>
																													</div>
																													<div class="col-lg-3 col-md-4 col-sm-4 col-3">
																														<div class="client-age">
																															<h6 class="mb-1">Age</h6>
																															<span>30</span>
																														</div>
																													</div>
																												</div>
																											</a>
																											<div class="flex-grow-1 ">
																												<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".customer-info1"><i class="ri-more-fill"></i></a>
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
																</div>
																<div class="tab-pane" id="activemembers" role="tabpanel">
																	<h6>Coming soon</h6>
																</div>
																<div class="tab-pane" id="inactivemembers" role="tabpanel">
																	<h6>Coming soon</h6>
																</div>
																<div class="tab-pane" id="prospects" role="tabpanel">
																	<h6>Coming soon</h6>
																</div>
																<div class="tab-pane" id="suspended" role="tabpanel">
																	<h6>Coming soon</h6>
																</div>
																<div class="tab-pane" id="owed" role="tabpanel">
																	<h6>Coming soon</h6>
																</div>
																<div class="tab-pane" id="atrisk" role="tabpanel">
																	<h6>Coming soon</h6>
																</div>
																<div class="tab-pane" id="bigspenders" role="tabpanel">
																	<h6>Coming soon</h6>
																</div>
															</div>
														</div><!-- end card-body -->
													</div><!-- end card -->
												</div>
											</div>
											<div class="tab-pane" id="beltpromotions" role="tabpanel">
												<h6>Coming soon</h6>
											</div>
											<div class="tab-pane" id="clientstats" role="tabpanel">
												<div class="mb-55">
													<div class="row">
														<div class="col-lg-3 select-option-first">
															<label class="mt-10">Client Stats</label>
															<select class="form-select" name="know_from">
																<option value="active" selected="">Active</option>
																<option value="In-Active">In-Active</option>
															</select>
														</div>
														<div class="col-lg-3 select-option-first">
															<label class="mt-10">Select Year</label>
															<select class="form-select" name="know_from">
																<option value="2000" selected="">2000</option>
																<option value="2021">2021</option>
																<option value="2022">2022</option>
																<option value="2023">2023</option>
															</select>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-xl-4">
														<div class="card tot-member-hight box-border">
															<div class="card-body">
																<div class="d-flex align-items-center">
																	<div class="avatar-sm flex-shrink-0">
																		<span class="avatar-title bg-primary rounded-2 fs-2">
																			<i class="fas fa-users"></i>
																		</span>
																	</div>
																	<div class="flex-grow-1 overflow-hidden ms-3">
																		<div class="d-flex align-items-center mb-3">
																			<h4 class="fs-4 flex-grow-1 mb-0">Total Member</h4>
																		</div>
																	</div>
																</div>
																
																<div class="row">
																	<div class="col-lg-12">
																		<div class="member-count">
																			<h3>15</h3>
																		</div>
																	</div>
																</div>
															</div><!-- end card body -->
														</div>
													</div><!-- end col -->

													<div class="col-xl-8">
														<div class="card box-border">
														<div class="card-body">
															<img src="http://dev.fitnessity.co/dashboard-design/images/new-members.jpg" alt=" chat" width="100%">
														</div><!-- end card-body -->
														</div>
													</div><!-- end col -->
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="card">
															<div class="py-4 px-3 bg-light-grey">
																<h5 class="text-muted text-uppercase fs-13">Visitors</h5>
																<div class="d-flex align-items-center">
																	<div class="flex-grow-1 ms-3">
																		<h2 class="mb-0">0</h2>
																	</div>
																</div>
															</div>
														</div>														
													</div>
													<div class="col-lg-4">
														<div class="card">
															<div class="py-4 px-3 bg-light-grey">
																<h5 class="text-muted text-uppercase fs-13">Frozen</h5>
																<div class="d-flex align-items-center">
																	<div class="flex-grow-1 ms-3">
																		<h2 class="mb-0">0</h2>
																	</div>
																</div>
															</div>
														</div>														
													</div>
													<div class="col-lg-4">
														<div class="card">
															<div class="py-4 px-3 bg-light-grey">
																<h5 class="text-muted text-uppercase fs-13">Cancelled</h5>
																<div class="d-flex align-items-center">
																	<div class="flex-grow-1 ms-3">
																		<h2 class="mb-0">0</h2>
																	</div>
																</div>
															</div>
														</div>
														
													</div>
												</div><!-- end row -->
												<div class="row">
													<div class="col-xl-12">
														<div class="card box-border mt-25">
															<div class="card-header align-items-center d-flex">
																<h4 class="card-title mb-0 flex-grow-1">Member Growth</h4>
															</div><!-- end card header -->

															<div class="card-body">
																<div class="live-preview">
																	<div class="table-responsive table-card">
																		<table class="table align-middle table-nowrap mb-0">
																			<thead class="table-light">
																				<tr>
																					<th scope="col" style="width: 46px;">
																						<div class="form-check">
																							<input class="form-check-input" type="checkbox" value="" id="cardtableCheck">
																							<label class="form-check-label" for="cardtableCheck"></label>
																						</div>
																					</th>
																					<th scope="col">Month</th>
																					<th scope="col">Active Members</th>
																					<th scope="col">Visitors</th>
																					<th scope="col">Frozen</th>
																					<th scope="col">Cancelled</th>
																					<th scope="col">Growth <i class="fas fa-question calculat-question" data-bs-toggle="tooltip" data-bs-placement="top" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. "></i></th>
																					<th scope="col">Churn <i class="fas fa-question calculat-question" data-bs-toggle="tooltip" data-bs-placement="top" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. "></i>
																					<th scope="col">Net <i class="fas fa-question calculat-question" data-bs-toggle="tooltip" data-bs-placement="top" title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. "></i></th>
																				</tr>
																			</thead>
																			<tbody>
																				<tr>
																					<td>
																						<div class="form-check">
																							<input class="form-check-input" type="checkbox" value="" id="cardtableCheck01">
																							<label class="form-check-label" for="cardtableCheck01"></label>
																						</div>
																					</td>
																					<td>11/2024 <span class="badge text-bg-success">Current</span> </td>
																					<td>3</td>
																					<td>0</td>
																					<td>0</td>
																					<td>0</td>
																					<td>
																						0% 
																						
																					</td>
																					<td>0%</td>
																					<td>0%</td>
																				</tr>
																			
																			</tbody>
																		</table>
																	</div>
																</div>
															</div><!-- end card-body -->
														</div><!-- end card -->
													</div><!-- end col -->
												</div><!-- end row -->
											</div>
										</div>
									</div><!-- end card-body -->
								</div><!-- end card -->
							</div>
						</div>
						
											
						
					</div> <!-- end .h-100-->
                  </div> <!-- end col -->
                </div>
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->

<!-- Modal -->
<div class="modal fade" id="merge_customer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-40">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Merge Customer</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="app-search d-md-block">
                    <div class="position-relative mb-25">
                        <input type="text" class="form-control" placeholder="Enter customer name or email" autocomplete="off" id="search-options" value="">
                        <span class="mdi mdi-magnify search-widget-icon"></span>
                        <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
                    </div>
                    <!--<div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
                    
                        <div class="text-center pt-3 pb-1">
                            <a href="pages-search-results.html" class="btn btn-primary btn-sm">View All Results <i class="ri-arrow-right-line ms-1"></i></a>
                        </div>
                    </div> -->
                </form>
				<p>Select a customer below to merge this customer to. <span class="font-red">Note:</span> This cannot be undone once merged. All bookings and payments will transfer over to the selected customer below.  </p>
				<a href="">
					<div class="row y-middle">
						<div class="col-sm-auto col-auto">
							<div class="flex-shrink-0 avatar-sm ">
								<span class="marge-customer-f-text avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">A</span>
							</div>
						</div>
						<div class="col-lg-9 col-auto">
							<h6 class="mb-1">Darryl Phipps</h6>
							<p class="text-muted mb-0"> <strong>Email: </strong> darrylphipps@gmail.com </p>
						</div>
					</div>
				</a>				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-red">Merge Customers</button>
			</div>
		</div>
  	</div>
</div>
    
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-40">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Create Customer</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<p>Create a new customer by entering their name and email address.</p>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="mb-3">
                        	<label class="form-label">First Name </label>
                       		<input type="text" class="form-control">
                     	</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="mb-3">
                        	<label class="form-label">Last Name</label>
                       		<input type="text" class="form-control">
                     	</div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="mb-3">
                        	<label class="form-label">Email Address</label>
                       		<input type="text" class="form-control">
                     	</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-black">Cancel Create</button>
				<button type="button" class="btn btn-red">Create Customer</button>
			</div>
		</div>
  	</div>
</div>


	@include('layouts.business.footer')
	
@endsection