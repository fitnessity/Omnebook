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
					<div class="row mb-3">
						<div class="col-12">
							<div class="page-heading">
								<label>Sales Report</label>
							</div>
						</div>
					</div>
		
					<div class="row">
						<div class="col-xxl-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h6 class="card-title mb-0 flex-grow-1">Sales</h6>
									</div>
								</div>
								<div class="row g-0">
									<div class="col-lg-6 col-md-6 col-sm-6">
										<div class="card-body">
											<div class="d-flex align-items-center mb-25">
												<div class="avatar-sm flex-shrink-0">
													<span class="avatar-title bg-primary rounded-circle fs-2">
														1
													</span>
												</div>
												<div class="flex-grow-1 ms-3 sale-date">
													<h2 class="mb-0">Choose Dates</h2>
												</div>
											</div>  
											<div class="row d-flex align-items-center">
												<div class="col-lg-3 col-md-4 col-sm-4">
													<label> Start Date </label>
												</div>
												<div class="col-lg-7 col-md-8 col-sm-8">
													<div class="form-group mb-10">	
														<div class="input-group">
															<input type="text" class="form-control border-0 flatpickr-range flatpiker-with-border flatpickr-input active" name="birthdate" id="birthdate" value="1969-12-31" readonly="readonly">
															<div class="input-group-text bg-primary border-primary text-white">
																<i class="ri-calendar-2-line"></i>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row d-flex align-items-center">
												<div class="col-lg-3 col-md-4 col-sm-4">
													<label> End Date </label>
												</div>
												<div class="col-lg-7 col-md-8 col-sm-8">
													<div class="form-group mb-25">	
														<div class="input-group">
															<input type="text" class="form-control border-0 flatpickr-range flatpiker-with-border flatpickr-input active" name="birthdate" id="birthdate" value="1969-12-31" readonly="readonly">
															<div class="input-group-text bg-primary border-primary text-white">
																<i class="ri-calendar-2-line"></i>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row justify-content-md-center">
												<div class="col-lg-6">
													<button type="button" class="btn btn-black w-100 mb-25">
                                                       Generate Reports
                                                    </button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6">
										<div class="card-body border-end-left">
											<div class="d-flex align-items-center mb-25">
												<div class="avatar-sm flex-shrink-0">
													<span class="avatar-title bg-primary rounded-circle fs-2">
														2
													</span>
												</div>
												<div class="flex-grow-1 ms-3 sale-date">
													<h2 class="mb-0">Export Options</h2>
												</div>
											</div> 	
											<div class="row justify-content-md-center">
												<div class="col-lg-6">
													<button type="button" class="btn btn-black w-100 mb-25">
                                                        Go!
                                                    </button>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12">
													<div class="options-to-print">
														<ul>
															<li><i class="fas fa-print"></i>Print this report</li>
															<li><i class="fas fa-file-excel"></i>Export to Excel</li>
															<li><i class="fas fa-file-pdf"></i>Export to PDF</li>
															<li><i class="fas fa-save"></i>Save this report</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- end card -->
						</div><!-- end col -->
					</div>
					
					<div class="row">
						<div class="col-xxl-12">
							<div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Thursday, June 1, 2023</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="accordion accordion-border-box" id="default-accordion-example">
                                            <div class="accordion-item shadow">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        Credit Card (AMEX-Keyed)
                                                    </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
                                                    <div class="accordion-body">
                                                        <div class="row">
															<div class="col-xl-12">
																<div class="card">
																	<div class="">
																		<div class="live-preview sales-report-table">
																			<div class="table-responsive">
																				<table class="table align-middle table-nowrap mb-25">
																					<thead class="table-light">
																						<tr>
																							<th scope="col">Sale Date </th>
																							<th scope="col">Client</th>
																							<th scope="col">Item name</th>
																							<th scope="col">Location</th>
																							<th scope="col">Notes</th>
																							<th scope="col">Item Price</th>
																							<th scope="col">Qty </th>
																							<th scope="col">Subtotal </th>
																							<th scope="col">Discount Amount</th>
																							<th scope="col">Tax </th>
																							<th scope="col">Item Total </th>
																							<th scope="col">Total Paid/Payment Method </th>
																						</tr>
																					</thead>
																					<tbody>
																						<tr>
																							<td>6/1/2023</td>
																							<td><a href="#" class="fw-medium">Nipa Soni</a></td>
																							<td>XYZ</td>
																							<td>Valor Mixed Martial Arts</td>
																							<td>--</td>
																							<td>$40.00</td>
																							<td>1</td>
																							<td>$40.00</td>
																							<td>$0.00</td>
																							<td>$0.00</td>
																							<td>$40.00</td>
																							<td>$40.00</td>
																						</tr>
																						<tr>
																							<td>6/1/2023</td>
																							<td><a href="#" class="fw-medium">Ankita Patel</a></td>
																							<td>XYZ</td>
																							<td>Valor Mixed Martial Arts</td>
																							<td>--</td>
																							<td>$50.00</td>
																							<td>1</td>
																							<td>$50.00</td>
																							<td>$0.00</td>
																							<td>$0.00</td>
																							<td>$50.00</td>
																							<td>$50.00</td>
																						</tr>
																						<tr>
																							<td>6/1/2023</td>
																							<td><a href="#" class="fw-medium">Nipa Soni</a></td>
																							<td>XYZ</td>
																							<td>Valor Mixed Martial Arts</td>
																							<td>--</td>
																							<td>$40.00</td>
																							<td>1</td>
																							<td>$40.00</td>
																							<td>$0.00</td>
																							<td>$0.00</td>
																							<td>$40.00</td>
																							<td>$40.00</td>
																						</tr>
																						<tr>
																							<td>6/1/2023</td>
																							<td><a href="#" class="fw-medium">Nipa Soni</a></td>
																							<td>XYZ</td>
																							<td>Valor Mixed Martial Arts</td>
																							<td>--</td>
																							<td>$40.00</td>
																							<td>1</td>
																							<td>$40.00</td>
																							<td>$0.00</td>
																							<td>$0.00</td>
																							<td>$40.00</td>
																							<td>$40.00</td>
																						</tr>
																						<tr>
																							<td>6/1/2023</td>
																							<td><a href="#" class="fw-medium">Nipa Soni</a></td>
																							<td>XYZ</td>
																							<td>Valor Mixed Martial Arts</td>
																							<td>--</td>
																							<td>$40.00</td>
																							<td>1</td>
																							<td>$40.00</td>
																							<td>$0.00</td>
																							<td>$0.00</td>
																							<td>$40.00</td>
																							<td>$40.00</td>
																						</tr>
																					</tbody>
																					<tfoot class="table-light">
																						<tr>
																							<td colspan="9"></td>
																							<td>Tax $0.00</td>
																							<td colspan="1"></td>
																							<td>Total $947.55</td>
																						</tr>
																					</tfoot>
																				</table>
																			</div>
																			<!-- end table responsive -->
																		</div>
																	</div><!-- end card-body -->
																</div><!-- end card -->
															</div><!-- end col -->
														</div>
														<!--end row-->
                                                    </div>
                                                </div>
                                            </div>
											
											<div class="accordion-item shadow">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        Credit Card (Visa/MC-Keyed)
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#default-accordion-example">
                                                    <div class="accordion-body">
														<div class="row">
															<div class="col-xl-12">
																<div class="card">
																	<div class="">
																		<div class="live-preview sales-report-table">
																			<div class="table-responsive">
																				<table class="table align-middle table-nowrap mb-25">
																					<thead class="table-light">
																						<tr>
																							<th scope="col">Sale Date </th>
																							<th scope="col">Client</th>
																							<th scope="col">Item name</th>
																							<th scope="col">Location</th>
																							<th scope="col">Notes</th>
																							<th scope="col">Item Price</th>
																							<th scope="col">Qty </th>
																							<th scope="col">Subtotal </th>
																							<th scope="col">Discount Amount</th>
																							<th scope="col">Tax </th>
																							<th scope="col">Item Total </th>
																							<th scope="col">Total Paid/Payment Method </th>
																						</tr>
																					</thead>
																					<tbody>
																						<tr>
																							<td>6/1/2023</td>
																							<td><a href="#" class="fw-medium">Nipa Soni</a></td>
																							<td>XYZ</td>
																							<td>Valor Mixed Martial Arts</td>
																							<td>--</td>
																							<td>$40.00</td>
																							<td>1</td>
																							<td>$40.00</td>
																							<td>$0.00</td>
																							<td>$0.00</td>
																							<td>$40.00</td>
																							<td>$40.00</td>
																						</tr>
																						<tr>
																							<td>6/1/2023</td>
																							<td><a href="#" class="fw-medium">Ankita Patel</a></td>
																							<td>XYZ</td>
																							<td>Valor Mixed Martial Arts</td>
																							<td>--</td>
																							<td>$50.00</td>
																							<td>1</td>
																							<td>$50.00</td>
																							<td>$0.00</td>
																							<td>$0.00</td>
																							<td>$50.00</td>
																							<td>$50.00</td>
																						</tr>
																						<tr>
																							<td>6/1/2023</td>
																							<td><a href="#" class="fw-medium">Nipa Soni</a></td>
																							<td>XYZ</td>
																							<td>Valor Mixed Martial Arts</td>
																							<td>--</td>
																							<td>$40.00</td>
																							<td>1</td>
																							<td>$40.00</td>
																							<td>$0.00</td>
																							<td>$0.00</td>
																							<td>$40.00</td>
																							<td>$40.00</td>
																						</tr>
																						<tr>
																							<td>6/1/2023</td>
																							<td><a href="#" class="fw-medium">Nipa Soni</a></td>
																							<td>XYZ</td>
																							<td>Valor Mixed Martial Arts</td>
																							<td>--</td>
																							<td>$40.00</td>
																							<td>1</td>
																							<td>$40.00</td>
																							<td>$0.00</td>
																							<td>$0.00</td>
																							<td>$40.00</td>
																							<td>$40.00</td>
																						</tr>
																						<tr>
																							<td>6/1/2023</td>
																							<td><a href="#" class="fw-medium">Nipa Soni</a></td>
																							<td>XYZ</td>
																							<td>Valor Mixed Martial Arts</td>
																							<td>--</td>
																							<td>$40.00</td>
																							<td>1</td>
																							<td>$40.00</td>
																							<td>$0.00</td>
																							<td>$0.00</td>
																							<td>$40.00</td>
																							<td>$40.00</td>
																						</tr>
																					</tbody>
																					<tfoot class="table-light">
																						<tr>
																							<td colspan="9"></td>
																							<td>Tax $0.00</td>
																							<td colspan="1"></td>
																							<td>Total $947.55</td>
																						</tr>
																					</tfoot>
																				</table>
																			</div>
																			<!-- end table responsive -->
																		</div>
																	</div><!-- end card-body -->
																</div><!-- end card -->
															</div><!-- end col -->
														</div>
														<!--end row-->
													</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
						</div>
					</div>
					
					<div class="row">
						<div class="col-xxl-12">
							<div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Thursday, June 1, 2023</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="accordion accordion-border-box" id="default-accordion-example">
                                            <div class="accordion-item shadow">
                                                <h2 class="accordion-header" id="headingthree">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                                        Credit Card (Visa/MC-Keyed)
                                                    </button>
                                                </h2>
                                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#default-accordion-example">
                                                    <div class="accordion-body">
                                                        <div class="row">
															<div class="col-xl-12">
																<div class="card">
																	<div class="">
																		<div class="live-preview sales-report-table">
																			<div class="table-responsive">
																				<table class="table align-middle table-nowrap mb-25">
																					<thead class="table-light">
																						<tr>
																							<th scope="col">Sale Date </th>
																							<th scope="col">Client</th>
																							<th scope="col">Item name</th>
																							<th scope="col">Location</th>
																							<th scope="col">Notes</th>
																							<th scope="col">Item Price</th>
																							<th scope="col">Qty </th>
																							<th scope="col">Subtotal </th>
																							<th scope="col">Discount Amount</th>
																							<th scope="col">Tax </th>
																							<th scope="col">Item Total </th>
																							<th scope="col">Total Paid/Payment Method </th>
																						</tr>
																					</thead>
																					<tbody>
																						<tr>
																							<td>6/1/2023</td>
																							<td><a href="#" class="fw-medium">Nipa Soni</a></td>
																							<td>XYZ</td>
																							<td>Valor Mixed Martial Arts</td>
																							<td>--</td>
																							<td>$40.00</td>
																							<td>1</td>
																							<td>$40.00</td>
																							<td>$0.00</td>
																							<td>$0.00</td>
																							<td>$40.00</td>
																							<td>$40.00</td>
																						</tr>
																						<tr>
																							<td>6/1/2023</td>
																							<td><a href="#" class="fw-medium">Ankita Patel</a></td>
																							<td>XYZ</td>
																							<td>Valor Mixed Martial Arts</td>
																							<td>--</td>
																							<td>$50.00</td>
																							<td>1</td>
																							<td>$50.00</td>
																							<td>$0.00</td>
																							<td>$0.00</td>
																							<td>$50.00</td>
																							<td>$50.00</td>
																						</tr>
																						<tr>
																							<td>6/1/2023</td>
																							<td><a href="#" class="fw-medium">Nipa Soni</a></td>
																							<td>XYZ</td>
																							<td>Valor Mixed Martial Arts</td>
																							<td>--</td>
																							<td>$40.00</td>
																							<td>1</td>
																							<td>$40.00</td>
																							<td>$0.00</td>
																							<td>$0.00</td>
																							<td>$40.00</td>
																							<td>$40.00</td>
																						</tr>
																						<tr>
																							<td>6/1/2023</td>
																							<td><a href="#" class="fw-medium">Nipa Soni</a></td>
																							<td>XYZ</td>
																							<td>Valor Mixed Martial Arts</td>
																							<td>--</td>
																							<td>$40.00</td>
																							<td>1</td>
																							<td>$40.00</td>
																							<td>$0.00</td>
																							<td>$0.00</td>
																							<td>$40.00</td>
																							<td>$40.00</td>
																						</tr>
																						<tr>
																							<td>6/1/2023</td>
																							<td><a href="#" class="fw-medium">Nipa Soni</a></td>
																							<td>XYZ</td>
																							<td>Valor Mixed Martial Arts</td>
																							<td>--</td>
																							<td>$40.00</td>
																							<td>1</td>
																							<td>$40.00</td>
																							<td>$0.00</td>
																							<td>$0.00</td>
																							<td>$40.00</td>
																							<td>$40.00</td>
																						</tr>
																					</tbody>
																					<tfoot class="table-light">
																						<tr>
																							<td colspan="9"></td>
																							<td>Tax $0.00</td>
																							<td colspan="1"></td>
																							<td>Total $947.55</td>
																						</tr>
																					</tfoot>
																				</table>
																			</div>
																			<!-- end table responsive -->
																		</div>
																	</div><!-- end card-body -->
																</div><!-- end card -->
															</div><!-- end col -->
														</div>
														<!--end row-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
						</div>
					</div>
					
					
					<div class="row">
						<div class="col-xxl-12">
							<div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Grand Total</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="live-preview">
										<div class="row">
											<div class="col-xl-12">
												<div class="live-preview sales-report-table">
													<div class="table-responsive">
														<table class="table align-middle table-nowrap">
															<thead class="table-light">
																<tr>
																	<th scope="col">Tax</th>
																	<th scope="col">Discount </th>
																	<th scope="col">Payment Method (Including tax)</th>
																	<th scope="col">Cash</th>
																	<th scope="col">Check</th>
																	<th scope="col">Credit Card</th>
																	<th scope="col">Comp.</th>
																	<th scope="col">Total</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>$0.00</td>
																	<td>$0.00</td>
																	<td>-</td>
																	<td>$0.00</td>
																	<td>$0.00</td>
																	<td>$0.00</td>
																	<td>$0.00</td>
																	<td>$0.00</td>
																</tr>
															</tbody>
														</table>
																<!-- end table -->			
													</div>
													<!-- end table responsive -->
												</div>
											</div><!-- end col -->
										</div>
										<!--end row-->
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
						</div>
					</div>
					
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
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
