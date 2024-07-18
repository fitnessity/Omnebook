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
									<label>Activity Scheduler</label>
								</div>
							</div>
                            <!--end col-->
						</div>
                        <!--end row-->
						
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header border-0">
										<div class="row">
											<div class="col-xxl-6 col-lg-6 col-md-5 col-sm-5">
												<div class="scheduler-info">
													<label>Program Name: </label>
													<span> Beach Volleyball BIRMINGHAM <br></span>
												</div>
												<div class="scheduler-info">
													<label>Category: </label>
													<span> Beach vollybal session</span>
												</div>
												<div class="scheduler-info">
													<label>Date: </label>
													<span> Tuesday, May 30 , 2023 </span>
												 </div>
												 <div class="scheduler-info">
													<label>Time: </label>
													<span> 11:00 AM  - 12:00 PM</span>
												 </div>
												 <div class="scheduler-info">
													<label>Duration:  </label>
													<span> 1 hour </span>
												 </div>
												 <div class="scheduler-info">
													<label>Spots: </label>
													<span> 2/3 </span>
												 </div>
											</div>
											<div class="col-xxl-6 col-lg-6 col-md-7 col-sm-7">
												<div class="float-right">
													<div class="search-set manage-search manage-space">
														<div class="client-search">
															<div class="position-relative">
																<input type="text" class="form-control" placeholder="Search for client" autocomplete="off" id="search-options" value="">
																<span class="mdi mdi-magnify search-widget-icon"></span>
																<span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
															</div>
															<div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
																
															</div>
														</div>
													</div>
													<div class="btn-client-search">
														<button type="button" class="btn-red-primary btn-red mmt-10" id="">Add </button>
													</div>
												</div>													
											</div>
										</div>
									</div>
									<div class="card-body pt-0 card-350-body">
										
										<div class="mini-stats-wid d-flex align-items-center mt-3 scheduler-box">
											<div class="flex-shrink-0 avatar-sm">
												<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">
													AP
												</span>
											</div>
											<div class="col-lg-2 col-md-3 col-sm-3 ms-3">
												<h6 class="mb-1">Ankita Patel</h6>
											</div>
											<div class="col-lg-3 col-md-4 col-sm-4 ms-3">
												<select class="form-select valid price-info" data-behavior="change_price_title" data-booking-checkin-detail-id="260">
													<option value="" selected="">Choose option</option>
													<option value="775">Beach vollybal session</option>
													<option value="812">Beach vollybal session</option>
												</select>
											</div>
											
											<div class="flex-grow-1 ms-3">
												<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".checking-details"><i class="ri-more-fill"></i></a>
												<div class="modal fade checking-details" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered width-50 bsw-35">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="myModalLabel">Activity Scheduler</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
															</div>
															<div class="modal-body">
																<div class="scheduler-table">
																	<div class="table-responsive">
																		<table class="table mb-0">
																			<thead>
																				<tr>
																					<th>Remaining</th>
																					<th>Expiration</th>
																					<th></th>
																					<th></th>
																					<th></th>
																				</tr>
																			</thead>
																			<tbody>
																				<tr>
																					<td>
																						<p class="mb-0"> N/A</p>
																					</td>
																					<td>
																						<p class="mb-0"> N/A</p>
																					</td>
																					<td>
																						<p class="mb-0"> Check In</p>
																						<p class="mb-0"> Late Cancel</p>
																					</td>
																					<td>
																						<div class="scheduled-btns">
																							<button type="submit" class="btn btn-red mb-10">Purchase</button>
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
													ns
												</span>
											</div>
											<div class="col-lg-2 col-md-3 col-sm-3 ms-3">
												<h6 class="mb-1">Nipa Soni</h6>
											</div>
											<div class="col-lg-3 col-md-4 col-sm-4 ms-3">
												<select class="form-select valid price-info" data-behavior="change_price_title" data-booking-checkin-detail-id="260">
													<option value="" selected="">Choose option</option>
													<option value="775">Beach vollybal session</option>
													<option value="812">Beach vollybal session</option>
												</select>
											</div>
											
											<div class="flex-grow-1 ms-3">
												<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".checking-details"><i class="ri-more-fill"></i></a>
											</div>
											
										</div><!-- end -->
										<div class="mini-stats-wid d-flex align-items-center mt-3 scheduler-box">
											<div class="flex-shrink-0 avatar-sm">
												<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">
													pp
												</span>
											</div>
											<div class="col-lg-2 col-md-3 col-sm-3 ms-3">
												<h6 class="mb-1">Purvi Patel</h6>
											</div>
											<div class="col-lg-3 col-md-4 col-sm-4 ms-3">
												<select class="form-select valid price-info" data-behavior="change_price_title" data-booking-checkin-detail-id="260">
													<option value="" selected="">Choose option</option>
													<option value="775">Beach vollybal session</option>
													<option value="812">Beach vollybal session</option>
												</select>
											</div>
											
											<div class="flex-grow-1 ms-3">
												<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".checking-details"><i class="ri-more-fill"></i></a>
											</div>
											
										</div><!-- end -->
										
									</div><!-- end cardbody -->
								</div><!-- end card -->
							</div><!--end col-->
						</div><!--end row-->	
						
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