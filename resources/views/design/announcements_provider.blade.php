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
											<!-- <button type="button" class="btn btn-red" id="openFirstModalBtn"><i class="ri-add-line align-bottom me-1"></i> Add Announcement</button> -->
											<a class="btn btn-red" id="openFirstModalBtn" data-bs-toggle="modal" href="#exampleModalToggle" role="button"><i class="ri-add-line align-bottom me-1"></i> Add Announcement</a>
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
												<div class="d-inline">
													<button class="btn btn-black position-relative insights-p" onClick="insightsopenNaav()"><i class="far fa-lightbulb align-middle fs-10"></i> </button>
													<nav class="blog-sidebar">
														<div class="navbar-wrapper">
															<div id="insights_sidebar" class="blog-sidepanel">
																<div class="navbar-content">
																	<div class="">
																		<div class="container"> 
																			<div class="row">
																				<div class="col-lg-12 col-12">
																					<div class="text-right mt-15 mr-10">
																						<a href="javascript:void(0)" class="text-black fa fa-times" onClick="insightscloseNaav()"></a>
																					</div>
																				</div>
																			</div>	
																		</div>
																	</div>
																	<div class="container">
																		<div class="row">
																			<div class="col-xl-12">
																				<div class="card">
																					<div class="card-body">
																						<div class="mt-15 d-grid">
																							<label class="fs-16">Chiara Gorodesky</label>	
																							<span>	08/03/2024 03:05:15 PM</span>									
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Reached:</label>	
																							<span class="float-right fs-14"> 15 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Opened:</label>	
																							<span class="float-right fs-14"> 20 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<span class="fs-14 mb-0">Ankita patel open it on 08/03/2024 03:05:15 PM</span>	
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>																	
																</div>
															</div>
														</div>
													</nav>
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
												<div class="d-inline">
													<button class="btn btn-black position-relative insights-p" onClick="insightsopenNaav()"><i class="far fa-lightbulb align-middle fs-10"></i> </button>
													<nav class="blog-sidebar">
														<div class="navbar-wrapper">
															<div id="insights_sidebar" class="blog-sidepanel">
																<div class="navbar-content">
																	<div class="">
																		<div class="container"> 
																			<div class="row">
																				<div class="col-lg-12 col-12">
																					<div class="text-right mt-15 mr-10">
																						<a href="javascript:void(0)" class="text-black fa fa-times" onClick="insightscloseNaav()"></a>
																					</div>
																				</div>
																			</div>	
																		</div>
																	</div>
																	<div class="container">
																		<div class="row">
																			<div class="col-xl-12">
																				<div class="card">
																					<div class="card-body">
																						<div class="mt-15 d-grid">
																							<label class="fs-16">Chiara Gorodesky</label>	
																							<span>	08/03/2024 03:05:15 PM</span>									
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Reached:</label>	
																							<span class="float-right fs-14"> 15 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Opened:</label>	
																							<span class="float-right fs-14"> 20 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<span class="fs-14 mb-0">Ankita patel open it on 08/03/2024 03:05:15 PM</span>	
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>																	
																</div>
															</div>
														</div>
													</nav>
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
												<div class="d-inline">
													<button class="btn btn-black position-relative insights-p" onClick="insightsopenNaav()"><i class="far fa-lightbulb align-middle fs-10"></i> </button>
													<nav class="blog-sidebar">
														<div class="navbar-wrapper">
															<div id="insights_sidebar" class="blog-sidepanel">
																<div class="navbar-content">
																	<div class="">
																		<div class="container"> 
																			<div class="row">
																				<div class="col-lg-12 col-12">
																					<div class="text-right mt-15 mr-10">
																						<a href="javascript:void(0)" class="text-black fa fa-times" onClick="insightscloseNaav()"></a>
																					</div>
																				</div>
																			</div>	
																		</div>
																	</div>
																	<div class="container">
																		<div class="row">
																			<div class="col-xl-12">
																				<div class="card">
																					<div class="card-body">
																						<div class="mt-15 d-grid">
																							<label class="fs-16">Chiara Gorodesky</label>	
																							<span>	08/03/2024 03:05:15 PM</span>									
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Reached:</label>	
																							<span class="float-right fs-14"> 15 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Opened:</label>	
																							<span class="float-right fs-14"> 20 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<span class="fs-14 mb-0">Ankita patel open it on 08/03/2024 03:05:15 PM</span>	
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>																	
																</div>
															</div>
														</div>
													</nav>
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
												<div class="d-inline">
													<button class="btn btn-black position-relative insights-p" onClick="insightsopenNaav()"><i class="far fa-lightbulb align-middle fs-10"></i> </button>
													<nav class="blog-sidebar">
														<div class="navbar-wrapper">
															<div id="insights_sidebar" class="blog-sidepanel">
																<div class="navbar-content">
																	<div class="">
																		<div class="container"> 
																			<div class="row">
																				<div class="col-lg-12 col-12">
																					<div class="text-right mt-15 mr-10">
																						<a href="javascript:void(0)" class="text-black fa fa-times" onClick="insightscloseNaav()"></a>
																					</div>
																				</div>
																			</div>	
																		</div>
																	</div>
																	<div class="container">
																		<div class="row">
																			<div class="col-xl-12">
																				<div class="card">
																					<div class="card-body">
																						<div class="mt-15 d-grid">
																							<label class="fs-16">Chiara Gorodesky</label>	
																							<span>	08/03/2024 03:05:15 PM</span>									
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Reached:</label>	
																							<span class="float-right fs-14"> 15 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Opened:</label>	
																							<span class="float-right fs-14"> 20 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<span class="fs-14 mb-0">Ankita patel open it on 08/03/2024 03:05:15 PM</span>	
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>																	
																</div>
															</div>
														</div>
													</nav>
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
												<div class="d-inline">
													<button class="btn btn-black position-relative insights-p" onClick="insightsopenNaav()"><i class="far fa-lightbulb align-middle fs-10"></i> </button>
													<nav class="blog-sidebar">
														<div class="navbar-wrapper">
															<div id="insights_sidebar" class="blog-sidepanel">
																<div class="navbar-content">
																	<div class="">
																		<div class="container"> 
																			<div class="row">
																				<div class="col-lg-12 col-12">
																					<div class="text-right mt-15 mr-10">
																						<a href="javascript:void(0)" class="text-black fa fa-times" onClick="insightscloseNaav()"></a>
																					</div>
																				</div>
																			</div>	
																		</div>
																	</div>
																	<div class="container">
																		<div class="row">
																			<div class="col-xl-12">
																				<div class="card">
																					<div class="card-body">
																						<div class="mt-15 d-grid">
																							<label class="fs-16">Chiara Gorodesky</label>	
																							<span>	08/03/2024 03:05:15 PM</span>									
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Reached:</label>	
																							<span class="float-right fs-14"> 15 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Opened:</label>	
																							<span class="float-right fs-14"> 20 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<span class="fs-14 mb-0">Ankita patel open it on 08/03/2024 03:05:15 PM</span>	
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>																	
																</div>
															</div>
														</div>
													</nav>
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
												<div class="d-inline">
													<button class="btn btn-black position-relative insights-p" onClick="insightsopenNaav()"><i class="far fa-lightbulb align-middle fs-10"></i> </button>
													<nav class="blog-sidebar">
														<div class="navbar-wrapper">
															<div id="insights_sidebar" class="blog-sidepanel">
																<div class="navbar-content">
																	<div class="">
																		<div class="container"> 
																			<div class="row">
																				<div class="col-lg-12 col-12">
																					<div class="text-right mt-15 mr-10">
																						<a href="javascript:void(0)" class="text-black fa fa-times" onClick="insightscloseNaav()"></a>
																					</div>
																				</div>
																			</div>	
																		</div>
																	</div>
																	<div class="container">
																		<div class="row">
																			<div class="col-xl-12">
																				<div class="card">
																					<div class="card-body">
																						<div class="mt-15 d-grid">
																							<label class="fs-16">Chiara Gorodesky</label>	
																							<span>	08/03/2024 03:05:15 PM</span>									
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Reached:</label>	
																							<span class="float-right fs-14"> 15 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Opened:</label>	
																							<span class="float-right fs-14"> 20 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<span class="fs-14 mb-0">Ankita patel open it on 08/03/2024 03:05:15 PM</span>	
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>																	
																</div>
															</div>
														</div>
													</nav>
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
												<div class="d-inline">
													<button class="btn btn-black position-relative insights-p" onClick="insightsopenNaav()"><i class="far fa-lightbulb align-middle fs-10"></i> </button>
													<nav class="blog-sidebar">
														<div class="navbar-wrapper">
															<div id="insights_sidebar" class="blog-sidepanel">
																<div class="navbar-content">
																	<div class="">
																		<div class="container"> 
																			<div class="row">
																				<div class="col-lg-12 col-12">
																					<div class="text-right mt-15 mr-10">
																						<a href="javascript:void(0)" class="text-black fa fa-times" onClick="insightscloseNaav()"></a>
																					</div>
																				</div>
																			</div>	
																		</div>
																	</div>
																	<div class="container">
																		<div class="row">
																			<div class="col-xl-12">
																				<div class="card">
																					<div class="card-body">
																						<div class="mt-15 d-grid">
																							<label class="fs-16">Chiara Gorodesky</label>	
																							<span>	08/03/2024 03:05:15 PM</span>									
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Reached:</label>	
																							<span class="float-right fs-14"> 15 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Opened:</label>	
																							<span class="float-right fs-14"> 20 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<span class="fs-14 mb-0">Ankita patel open it on 08/03/2024 03:05:15 PM</span>	
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>																	
																</div>
															</div>
														</div>
													</nav>
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
												<div class="d-inline">
													<button class="btn btn-black position-relative insights-p" onClick="insightsopenNaav()"><i class="far fa-lightbulb align-middle fs-10"></i> </button>
													<nav class="blog-sidebar">
														<div class="navbar-wrapper">
															<div id="insights_sidebar" class="blog-sidepanel">
																<div class="navbar-content">
																	<div class="">
																		<div class="container"> 
																			<div class="row">
																				<div class="col-lg-12 col-12">
																					<div class="text-right mt-15 mr-10">
																						<a href="javascript:void(0)" class="text-black fa fa-times" onClick="insightscloseNaav()"></a>
																					</div>
																				</div>
																			</div>	
																		</div>
																	</div>
																	<div class="container">
																		<div class="row">
																			<div class="col-xl-12">
																				<div class="card">
																					<div class="card-body">
																						<div class="mt-15 d-grid">
																							<label class="fs-16">Chiara Gorodesky</label>	
																							<span>	08/03/2024 03:05:15 PM</span>									
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Reached:</label>	
																							<span class="float-right fs-14"> 15 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Opened:</label>	
																							<span class="float-right fs-14"> 20 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<span class="fs-14 mb-0">Ankita patel open it on 08/03/2024 03:05:15 PM</span>	
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>																	
																</div>
															</div>
														</div>
													</nav>
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
												<div class="d-inline">
													<button class="btn btn-black position-relative insights-p" onClick="insightsopenNaav()"><i class="far fa-lightbulb align-middle fs-10"></i> </button>
													<nav class="blog-sidebar">
														<div class="navbar-wrapper">
															<div id="insights_sidebar" class="blog-sidepanel">
																<div class="navbar-content">
																	<div class="">
																		<div class="container"> 
																			<div class="row">
																				<div class="col-lg-12 col-12">
																					<div class="text-right mt-15 mr-10">
																						<a href="javascript:void(0)" class="text-black fa fa-times" onClick="insightscloseNaav()"></a>
																					</div>
																				</div>
																			</div>	
																		</div>
																	</div>
																	<div class="container">
																		<div class="row">
																			<div class="col-xl-12">
																				<div class="card">
																					<div class="card-body">
																						<div class="mt-15 d-grid">
																							<label class="fs-16">Chiara Gorodesky</label>	
																							<span>	08/03/2024 03:05:15 PM</span>									
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Reached:</label>	
																							<span class="float-right fs-14"> 15 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Opened:</label>	
																							<span class="float-right fs-14"> 20 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<span class="fs-14 mb-0">Ankita patel open it on 08/03/2024 03:05:15 PM</span>	
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>																	
																</div>
															</div>
														</div>
													</nav>
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
												<div class="d-inline">
													<button class="btn btn-black position-relative insights-p" onClick="insightsopenNaav()"><i class="far fa-lightbulb align-middle fs-10"></i> </button>
													<nav class="blog-sidebar">
														<div class="navbar-wrapper">
															<div id="insights_sidebar" class="blog-sidepanel">
																<div class="navbar-content">
																	<div class="">
																		<div class="container"> 
																			<div class="row">
																				<div class="col-lg-12 col-12">
																					<div class="text-right mt-15 mr-10">
																						<a href="javascript:void(0)" class="text-black fa fa-times" onClick="insightscloseNaav()"></a>
																					</div>
																				</div>
																			</div>	
																		</div>
																	</div>
																	<div class="container">
																		<div class="row">
																			<div class="col-xl-12">
																				<div class="card">
																					<div class="card-body">
																						<div class="mt-15 d-grid">
																							<label class="fs-16">Chiara Gorodesky</label>	
																							<span>	08/03/2024 03:05:15 PM</span>									
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Reached:</label>	
																							<span class="float-right fs-14"> 15 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Opened:</label>	
																							<span class="float-right fs-14"> 20 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<span class="fs-14 mb-0">Ankita patel open it on 08/03/2024 03:05:15 PM</span>	
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>																	
																</div>
															</div>
														</div>
													</nav>
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
												<div class="d-inline">
													<button class="btn btn-black position-relative insights-p" onClick="insightsopenNaav()"><i class="far fa-lightbulb align-middle fs-10"></i> </button>
													<nav class="blog-sidebar">
														<div class="navbar-wrapper">
															<div id="insights_sidebar" class="blog-sidepanel">
																<div class="navbar-content">
																	<div class="">
																		<div class="container"> 
																			<div class="row">
																				<div class="col-lg-12 col-12">
																					<div class="text-right mt-15 mr-10">
																						<a href="javascript:void(0)" class="text-black fa fa-times" onClick="insightscloseNaav()"></a>
																					</div>
																				</div>
																			</div>	
																		</div>
																	</div>
																	<div class="container">
																		<div class="row">
																			<div class="col-xl-12">
																				<div class="card">
																					<div class="card-body">
																						<div class="mt-15 d-grid">
																							<label class="fs-16">Chiara Gorodesky</label>	
																							<span>	08/03/2024 03:05:15 PM</span>									
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Reached:</label>	
																							<span class="float-right fs-14"> 15 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Opened:</label>	
																							<span class="float-right fs-14"> 20 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<span class="fs-14 mb-0">Ankita patel open it on 08/03/2024 03:05:15 PM</span>	
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>																	
																</div>
															</div>
														</div>
													</nav>
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
												<div class="d-inline">
													<button class="btn btn-black position-relative insights-p" onClick="insightsopenNaav()"><i class="far fa-lightbulb align-middle fs-10"></i> </button>
													<nav class="blog-sidebar">
														<div class="navbar-wrapper">
															<div id="insights_sidebar" class="blog-sidepanel">
																<div class="navbar-content">
																	<div class="">
																		<div class="container"> 
																			<div class="row">
																				<div class="col-lg-12 col-12">
																					<div class="text-right mt-15 mr-10">
																						<a href="javascript:void(0)" class="text-black fa fa-times" onClick="insightscloseNaav()"></a>
																					</div>
																				</div>
																			</div>	
																		</div>
																	</div>
																	<div class="container">
																		<div class="row">
																			<div class="col-xl-12">
																				<div class="card">
																					<div class="card-body">
																						<div class="mt-15 d-grid">
																							<label class="fs-16">Chiara Gorodesky</label>	
																							<span>	08/03/2024 03:05:15 PM</span>									
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Reached:</label>	
																							<span class="float-right fs-14"> 15 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<label class="fs-14 mb-0">Total Opened:</label>	
																							<span class="float-right fs-14"> 20 </span>
																						</div>
																						<div class="border-bottom-grey mt-15 mb-15"></div>
																						<div class="">
																							<span class="fs-14 mb-0">Ankita patel open it on 08/03/2024 03:05:15 PM</span>	
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>																	
																</div>
															</div>
														</div>
													</nav>
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
<!-- <div class="modal fade" id="firstModal" tabindex="-1" aria-labelledby="firstModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-50 modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Required Settings</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="" autocomplete="off" class="needs-validation" novalidate="">
					<div class="row">
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
							<div class="border-bottom-grey mb-15 mt-15"></div>
						</div>
						
						<div class="col-lg-12">
							<div class="required-settings-btns contact-custom-dropdwon mb-15">
								<label class="form-label"> Select Contact List</label>
								<div class="checkbox-dropdown">
									Client Contact List
									<ul class="checkbox-dropdown-list">
										<li>
											<label><input type="checkbox" value="Vejle" name="city" class="mr-15" />Contact List</label>
										</li>
										<li>
											<label><input type="checkbox" value="Horsens" name="city" class="mr-15" />Option 1</label>
										</li>
										<li>
											<label><input type="checkbox" value="Kolding" name="city" class="mr-15" />Option 2</label>
										</li>
										<li>
											<label><input type="checkbox" value="Kolding" name="city" class="mr-15" />Option 3</label>
										</li>
									</ul>
								</div>
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
							<div class="border-bottom-grey mb-15 mt-15"></div>
						</div>

						<div class="col-lg-12 col-md-12 col-sm-12 col-12">
							<label class="form-label">Delivery Method</label>
							<div class="mb-15">
								<button type="button" class="btn btn-red mb-15 mmt-10" id="openSecondModalBtn">
									Deliver method
								</button>
								<div>
									<label>Edit your sms and push notification message</label>
								</div>
							</div>
						</div>
						
						<div class="col-lg-12">
							<div class="border-bottom-grey mb-15 mt-15"></div>
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
				<button type="button" class="btn btn-black" data-bs-toggle="modal" data-bs-target="#exampleModal">Preview</button>
			</div>
		</div>
	</div>
</div> -->

<!-- Modal -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-50">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Preview</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="mb-15">
					<div class="row y-middle">
						<div class="col-5">
							<div class="border-bottom-grey"></div>
						</div>
						<div class="col-2">
							<div class="text-center preview-emailtitle">
								<label>Email</label>
							</div>
						</div>
						<div class="col-5">
							<div class="border-bottom-grey"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="mb-20">
							<div class="profile-user position-relative d-inline-block w-100 push-notification-email">
								<img src="http://dev.fitnessity.co//public/uploads/slider/thumb/1648141166-snowboarding.jpg" class="img-thumbnail user-profile-image  shadow" alt="user-profile-image">
							</div>
						</div>
						<div class="mb-20">
							<div class="preview-text">
								<label>Thanks for Coming In!</label>
								<p class="mb-10">We hope you're happy with the experience you had at Valor Mixed Martial Arts! We're so glad that you stopped in.</p>
								<p class="mb-10">Visit Fitnessity to check out the other services that we offer and go get your next appointment on the books.</p>
								<p class="mb-0">Hope to see you again soon!</p>
								<p>Fitnessity </p>
							</div>
						</div>
					</div>
				</div>

				<div class="mb-15">
					<div class="row y-middle">
						<div class="col-5">
							<div class="border-bottom-grey"></div>
						</div>
						<div class="col-2">
							<div class="text-center preview-emailtitle">
								<label>SMS</label>
							</div>
						</div>
						<div class="col-5">
							<div class="border-bottom-grey"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="message-orange">
							<p class="message-content">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
							<a href="#" class="message-timestamp-right">Visit Customer Portal Link</a>
							 <div class="message-timestamp-right">SMS 13:37</div>
						</div>
					</div>
				</div>

				<div class="mb-15">
					<div class="row y-middle">
						<div class="col-5">
							<div class="border-bottom-grey"></div>
						</div>
						<div class="col-2">
							<div class="text-center preview-emailtitle">
								<label>Push Notification</label>
							</div>
						</div>
						<div class="col-5">
							<div class="border-bottom-grey"></div>
						</div>
					</div>
				</div>
				<div class="row justify-content-md-center">
					<div class="col-lg-6">
						<div class="push-noti-box">
							<div class="container">
								<div class="row">
									<div class="col-lg-6">
										<label>Fitnessity</label>
									</div>
									<div class="col-lg-6">
										<div class="text-right">
											<span>Now</span>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="push-noti-msg">
											<h1>Valor Mixed Martial Arts</h1>
											<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</p>
											<div class="text-right">
												<a href="#">Visit Customer Portal Link</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-red" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
  	</div>
</div> -->





<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  	<div class="modal-dialog modal-50 modal-dialog-centered modal-dialog-scrollable">
    	<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalToggleLabel">Required Settings</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="" autocomplete="off" class="needs-validation" novalidate="">
					<div class="row">
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
							<div class="border-bottom-grey mb-15 mt-15"></div>
						</div>
							
						<div class="col-lg-12">
							<div class="required-settings-btns contact-custom-dropdwon mb-15">
								<label class="form-label"> Select Contact List</label>
								<div class="checkbox-dropdown">
									Client Contact List
									<ul class="checkbox-dropdown-list">
										<li>
											<label><input type="checkbox" value="Vejle" name="city" class="mr-15" />Contact List</label>
										</li>
										<li>
											<label><input type="checkbox" value="Horsens" name="city" class="mr-15" />Option 1</label>
										</li>
										<li>
											<label><input type="checkbox" value="Kolding" name="city" class="mr-15" />Option 2</label>
										</li>
										<li>
											<label><input type="checkbox" value="Kolding" name="city" class="mr-15" />Option 3</label>
										</li>
									</ul>
								</div>
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
							<div class="border-bottom-grey mb-15 mt-15"></div>
						</div>

						<div class="col-lg-12 col-md-12 col-sm-12 col-12">
							<label class="form-label">Delivery Method</label>
							<div class="mb-15">
								<button type="button" class="btn btn-red mb-15 mmt-10" id="openSecondModalBtn" >
									Deliver method
								</button>
							<div>
							<label>Edit your sms and push notification message</label>
								</div>
							</div>
						</div>
							
						<div class="col-lg-12">
							<div class="border-bottom-grey mb-15 mt-15"></div>
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
				<button class="btn btn-black" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Preview</button>
			</div>
    	</div>
  	</div>
</div>
<div class="modal fade" id="secondModal" tabindex="1" aria-labelledby="secondModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-70 modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Welcome a new client</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="delivery-method-note mb-15">
							<i class="fas fa-info mr-10 "></i>
							<p class="mb-0">Remembar that message blasts may only contain Fitnessity links(e.g) reasons, any non Fitnessity linkes will be removed from SMS, push notifications and e-mails.</p>
						</div>
						<div class="mb-15 ">
							<div class="fs-15">
								<label class="mb-0">Your profile link:</label> <br>
								<a class="js-emaillink" href="http://dev.fitnessity.co/design/announcements_provider">http://dev.fitnessity.co/design/announcements_provider</a>
								<button class="js-emailcopybtn btn btn-red"><i class="far fa-copy lign-bottom me-1"></i> Copy Link</button>
							</div>
						</div>
						<div class="border-bottom-grey"></div>
					</div>
					<div class="col-lg-12">
						<div class="mt-20 mb-20">
							<label class="fs-18">SMS/Push notification </label>
						</div>
						<form>
							<div class="mb-4 pb-3">
								<label for="FormControlTextarea" class="form-label">Sms/Push Text </label>
								<textarea class="form-control" id="FormControlTextarea" rows="3">We hope you loved your experience at valor mixed martial arts! We're so glad that you stopped in. Visit http://dev.fitnessity.co or give us a call or visit us in person to get your next appointment on the books.</textarea>
								<span class="float-right" id="business_info_count">
									<span id="display_count_business">145</span> words. Words left : <span id="word_left_business">855</span>
								</span>
							</div>
						</form>
						<div class="border-bottom-grey mt-15"></div>
					</div>
					<!-- <div class="col-lg-12">
						<div class="mt-20 mb-20">
							<label class="fs-18">Email </label>
						</div>
						<div class="mb-20">
							<div class="profile-user position-relative d-inline-block w-100 push-notification-email">
                            	<img src="http://dev.fitnessity.co//public/uploads/slider/thumb/1648141166-snowboarding.jpg" class="img-thumbnail user-profile-image  shadow" alt="user-profile-image">
                                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                    <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                    <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                        <span class="avatar-title rounded-circle bg-light text-body shadow">
                                            <i class="ri-camera-fill"></i>
                                        </span>
                                    </label>
                                </div>
                            </div>
						</div>
						<form>
							<div class="mb-3">
								<label for="firstnameInput" class="form-label">Email Title</label>
								<input type="text" class="form-control" id="firstnameInput" value="Dave">
							</div>
							<div class="mb-4 pb-3">
								<label for="FormControlTextarea" class="form-label">Email Content </label>
								<textarea class="form-control" id="FormControlTextarea" rows="7">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.

								It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
								</textarea>
								<span class="float-right" id="business_info_count">
									<span id="display_count_business">145</span> words. Words left : <span id="word_left_business">855</span>
								</span>
							</div>
						</form>
						<div class="border-bottom-grey mb-15 mt-15"></div>
					</div> -->
					<div class="col-lg-12">
						<div class="mt-20 mb-20">
							<label class="fs-18">Delivery Timeline </label>
						</div>	
						<div class="mb-4 pb-3">
							<form action="">
								<select name="activity_type" data-behavior="on_change_submit" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
									<option value=""> 1 hour after client first visit </option>
									<option value="">2 hours after clients first visit (recommended)</option>
									<option value="">3 hour after client first visit</option>
									<option value="">5 hour after client first visit</option>
									<option value="">10 hour after client first visit</option>
								</select>
							</form>
						</div>
						<div class="border-bottom-grey mb-15 mt-15"></div>
					</div>
					<div class="col-lg-12">
						<div class="mt-20 mb-20">
							<label class="fs-18">Delivery Method </label>
						</div>
						<div class="mb-4 pb-3">
							<div class="">
								<div id="myRadioGroup">
									<input type="radio" name="cars" checked="checked" value="twoCarDiv"  /> <label class="fs-13 ml-5">Optimized delivery (recommended)</label> 
									<i class="fas fa-info-circle fs-15" data-bs-toggle="tooltip" data-bs-placement="right"  data-bs-original-title="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."></i> <br>

									<!-- <button type="button" class="btn-grey" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title=""><i class="fas fa-question fs-10"></i> </button> <br> -->
									
									<input type="radio" name="cars" value="threeCarDiv" /> <label class="fs-13 ml-5">Choose your delivery method</label> 
									
									<div id="twoCarDiv" class="desc">
										
									</div>
									<div id="threeCarDiv" class="desc">
										<div class="row">
											<div class="col-lg-12 col-md-4 col-sm-6 col-12">
												<div class="mt-15">
													<div class="form-check form-switch form-switch-dark form-switch-md mb-3">
														<input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck7" checked>
														<label class="form-check-label" for="SwitchCheck7">SMS</label>
														<i class="fas fa-info-circle fs-15" data-bs-toggle="tooltip" data-bs-placement="right"  data-bs-original-title="You have a limited number of free marketing SMS based on your subscription. After you use them all, SMS cost $0.005 each."></i>
													</div>
													<div class="mb-15 ml-15">
														<input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
														<label for="vehicle1" class="push-notification">Send SMS if push notification isn't available</label>
													</div>
												</div>
											</div>

											<div class="col-lg-12 col-md-4 col-sm-6 col-12">
												<div>
													<div class="form-check form-switch form-switch-dark form-switch-md mb-3">
														<input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck8" checked>
														<label class="form-check-label" for="SwitchCheck8">Push Notification</label>
													</div>
												</div>
											</div>

											<div class="col-lg-12 col-md-4 col-sm-6 col-12">
												<div>
													<div class="form-check form-switch form-switch-dark form-switch-md mb-3">
														<input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck9" checked>
														<label class="form-check-label" for="SwitchCheck9">Email</label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-red">Save</button>
			</div>
		</div>
  	</div>
</div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  	<div class="modal-dialog modal-50 modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Preview</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="mb-15">
					<div class="row y-middle">
						<div class="col-5">
							<div class="border-bottom-grey"></div>
						</div>
						<div class="col-2">
							<div class="text-center preview-emailtitle">
								<label>Email</label>
							</div>
						</div>
						<div class="col-5">
							<div class="border-bottom-grey"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="mb-20">
							<div class="profile-user position-relative d-inline-block w-100 push-notification-email">
								<img src="http://dev.fitnessity.co//public/uploads/slider/thumb/1648141166-snowboarding.jpg" class="img-thumbnail user-profile-image  shadow" alt="user-profile-image">
							</div>
						</div>
						<div class="mb-20">
							<div class="preview-text">
								<label>Thanks for Coming In!</label>
								<p class="mb-10">We hope you're happy with the experience you had at Valor Mixed Martial Arts! We're so glad that you stopped in.</p>
								<p class="mb-10">Visit Fitnessity to check out the other services that we offer and go get your next appointment on the books.</p>
								<p class="mb-0">Hope to see you again soon!</p>
								<p>Fitnessity </p>
							</div>
						</div>
					</div>
				</div>

				<div class="mb-15">
					<div class="row y-middle">
						<div class="col-5">
							<div class="border-bottom-grey"></div>
						</div>
						<div class="col-2">
							<div class="text-center preview-emailtitle">
								<label>SMS</label>
							</div>
						</div>
						<div class="col-5">
							<div class="border-bottom-grey"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="message-orange">
							<p class="message-content">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
							<a href="#" class="message-timestamp-right">Visit Customer Portal Link</a>
							<!-- <div class="message-timestamp-right">SMS 13:37</div> -->
						</div>
					</div>
				</div>

				<div class="mb-15">
					<div class="row y-middle">
						<div class="col-lg-5 col-md-5 col-sm-4 col-4">
							<div class="border-bottom-grey"></div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-4 col-4">
							<div class="text-center preview-emailtitle">
								<label>Push Notification</label>
							</div>
						</div>
						<div class="col-lg-5 col-md-5 col-sm-4 col-4">
							<div class="border-bottom-grey"></div>
						</div>
					</div>
				</div>
				<div class="row justify-content-md-center">
					<div class="col-lg-6">
						<div class="push-noti-box">
							<div class="container">
								<div class="row">
									<div class="col-lg-6 col-6">
										<label>Fitnessity</label>
									</div>
									<div class="col-lg-6 col-6">
										<div class="text-right">
											<span>Now</span>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="push-noti-msg">
											<h1>Valor Mixed Martial Arts</h1>
											<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</p>
											<div class="text-right">
												<a href="#">Visit Customer Portal Link</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-red" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Back</button>
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

	<script>
		var copyEmailBtn = document.querySelector('.js-emailcopybtn');  
		copyEmailBtn.addEventListener('click', function(event) {  
		// Select the email link anchor text  
		var emailLink = document.querySelector('.js-emaillink');  
		var range = document.createRange();  
		range.selectNode(emailLink);  
		window.getSelection().addRange(range);  

		try {  
			// Now that we've selected the anchor text, execute the copy command  
			var successful = document.execCommand('copy');  
			var msg = successful ? 'successful' : 'unsuccessful';  
			console.log('Copy email command was ' + msg);  
		} catch(err) {  
			console.log('Oops, unable to copy');  
		}  

		// Remove the selections - NOTE: Should use
		// removeRange(range) when it is supported  
		window.getSelection().removeAllRanges();  
		});
	</script>

	<script>
	$(".checkbox-dropdown").click(function () {
		$(this).toggleClass("is-active");
		});

		$(".checkbox-dropdown ul").click(function(e) {
			e.stopPropagation();
	});
	</script>
	
	<script>
		function insightsopenNaav() {
			document.getElementById("insights_sidebar").style.width = "300px";
		}

		function insightscloseNaav() {
			document.getElementById("insights_sidebar").style.width = "0";
		}
	</script>
	<script>
		$(document).ready(function() {
			$("div.desc").hide();
			$("input[name$='cars']").click(function() {
				var test = $(this).val();
				$("div.desc").hide();
				$("#" + test).show();
			});
		});
	</script>
	<script>
		// Function to open the first modal
		document.getElementById('openFirstModalBtn').addEventListener('click', function() {
			var firstModal = new bootstrap.Modal(document.getElementById('firstModal'));
			firstModal.show();
		});

		// Function to open the second modal without closing the first modal
		document.getElementById('openSecondModalBtn').addEventListener('click', function() {
			// Show the second modal
			var secondModal = new bootstrap.Modal(document.getElementById('secondModal'));
			secondModal.show();

			// Hide the backdrop of the first modal
			var firstModalBackdrop = document.querySelector('#firstModal .modal-backdrop');
			firstModalBackdrop.style.display = 'none';
		});
	</script>

@endsection