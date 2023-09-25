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
															<input type="text" class="form-control border-0 flatpickr-range flatpiker-with-border" name="startDate" id="startDate"  readonly="readonly">
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
															<input type="text" class="form-control border-0 flatpickr-range flatpiker-with-border" name="endDate" id="endDate"  readonly="readonly">
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
													<div class="form-group mb-10">
														<select class="form-select" name="position" required="">
															<option value="print">Print this report</option>
															<option value="export">Export to excel</option>
															<option value="pdf">Export to PDF</option>
															<option value="report">Save this report</option>
														</select>
													</div>
													<button type="button" class="btn btn-black w-100 mb-25">
                                                        Go!
                                                    </button>
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
                                    <h4 class="card-title mb-0 flex-grow-1">{{$date}}</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="accordion accordion-border-box" id="default-accordion-example">

                                        	@forelse($reportData as $i=>$data)
                                            <div class="accordion-item shadow">
                                                <h2 class="accordion-header" id="heading{{$i}}">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
                                                        Credit Card (AMEX-Keyed)
                                                    </button>
                                                </h2>
                                                <div id="collapse{{$i}}" class="accordion-collapse collapse show" aria-labelledby="heading{{$i}}" data-bs-parent="#default-accordion-example">
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
                                            @empty
                                            @endforelse
										
                                            <div class="accordion-item shadow">
                                                <h2 class="accordion-header" id="headingThree">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseone" aria-expanded="false" aria-controls="collapseone">
                                                        Cash
                                                    </button>
                                                </h2>
                                                <div id="collapseone" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#default-accordion-example">
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
																						@php $tax = $totalTax = $totalPaid = 0 ; @endphp
																						@forelse($cashReport as $i=>$cData)
																							@if(count($cData->userBookingStatus->UserBookingDetail) >0 && $cData->Customer != '')
																							<tr>
																								<td>{{date('m-d-Y',strtotime($cData->created_at))}}</td>
																								<td><a href="{{url('business/'.$business_id.'/customers/'.$cData->Customer->id)}}" class="fw-medium">{{@$cData->Customer->full_name}}</a></td>
																								<td>{!!$cData->item_description($business_id)['itemDescription']!!}</td>
																								<td>{!! @$cData->item_description($business_id)['location'] !!}</td>
																								<td>--</td>
																								<td>{!!$cData->item_description($business_id)['itemPrice']!!}</td>
																								<td>{!!$cData->item_description($business_id)['qty']!!}</td>
																								<td>{!!$cData->item_description($business_id)['itemSubTotal']!!}</td>
																								<td>{!!$cData->item_description($business_id)['itemDis']!!}</td>
																								<td>{!!$cData->item_description($business_id)['itemTax']!!}</td>
																								<td>{!!$cData->item_description($business_id)['itemSubTotal']!!}</td>
																								<td>{!!$cData->item_description($business_id)['itemSubTotal']!!}</td>
																							</tr>
																							@php 
																								$totalTax += $cData->item_description($business_id)['totalTax'];
																								$totalPaid += $cData->item_description($business_id)['totalPaid'];
																							@endphp
																							@endif
																						@empty
                                            											@endforelse
																					</tbody>
																					<tfoot class="table-light">
																						<tr>
																							<td colspan="9"></td>
																							<td>Tax ${{$totalTax}}</td>
																							<td colspan="1"></td>
																							<td>Total ${{$totalPaid}}</td>
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
                                                <h2 class="accordion-header" id="headingFour">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                        Check
                                                    </button>
                                                </h2>
                                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#default-accordion-example">
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
																						@php $taxCheck = $totalTaxCheck = $totalPaidCheck = 0 ; @endphp
																						@forelse($checkReport as $i=>$cData)
																							@if(count($cData->userBookingStatus->UserBookingDetail) >0 && $cData->Customer != '')
																							<tr>
																								<td>{{date('m-d-Y',strtotime($cData->created_at))}}</td>
																								<td><a href="{{url('business/'.$business_id.'/customers/'.$cData->Customer->id)}}" class="fw-medium">{{@$cData->Customer->full_name}}</a></td>
																								<td>{!!$cData->item_description($business_id)['itemDescription']!!}</td>
																								<td>{!! @$cData->item_description($business_id)['location'] !!}</td>
																								<td>--</td>
																								<td>{!!$cData->item_description($business_id)['itemPrice']!!}</td>
																								<td>{!!$cData->item_description($business_id)['qty']!!}</td>
																								<td>{!!$cData->item_description($business_id)['itemSubTotal']!!}</td>
																								<td>{!!$cData->item_description($business_id)['itemDis']!!}</td>
																								<td>{!!$cData->item_description($business_id)['itemTax']!!}</td>
																								<td>{!!$cData->item_description($business_id)['itemSubTotal']!!}</td>
																								<td>{!!$cData->item_description($business_id)['itemSubTotal']!!}</td>
																							</tr>
																							@php 
																								$totalTaxCheck += $cData->item_description($business_id)['totalTax'];
																								$totalPaidCheck += $cData->item_description($business_id)['totalPaid'];
																							@endphp
																							@endif
																						@empty
                                            											@endforelse
																					</tbody>
																					<tfoot class="table-light">
																						<tr>
																							<td colspan="9"></td>
																							<td>Tax ${{$totalTaxCheck}}</td>
																							<td colspan="1"></td>
																							<td>Total ${{$totalPaidCheck}}</td>
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
                                                <h2 class="accordion-header" id="headingThree">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        Comp
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
																						@php $taxComp = $totalTaxComp = $totalPaidComp = 0 ; @endphp
																						@forelse($compReport as $i=>$cData)
																							@if(count($cData->userBookingStatus->UserBookingDetail) >0 && $cData->Customer != '')
																							<tr>
																								<td>{{date('m-d-Y',strtotime($cData->created_at))}}</td>
																								<td><a href="{{url('business/'.$business_id.'/customers/'.$cData->Customer->id)}}" class="fw-medium">{{@$cData->Customer->full_name}}</a></td>
																								<td>{!!$cData->item_description($business_id)['itemDescription']!!}</td>
																								<td>{!! @$cData->item_description($business_id)['location'] !!}</td>
																								<td>--</td>
																								<td>{!!$cData->item_description($business_id)['itemPrice']!!}</td>
																								<td>{!!$cData->item_description($business_id)['qty']!!}</td>
																								<td>{!!$cData->item_description($business_id)['itemSubTotal']!!}</td>
																								<td>{!!$cData->item_description($business_id)['itemDis']!!}</td>
																								<td>{!!$cData->item_description($business_id)['itemTax']!!}</td>
																								<td>{!!$cData->item_description($business_id)['itemSubTotal']!!}</td>
																								<td>{!!$cData->item_description($business_id)['itemSubTotal']!!}</td>
																							</tr>
																							@php 
																								$totalTaxComp += $cData->item_description($business_id)['totalTax'];
																								$totalPaidComp += $cData->item_description($business_id)['totalPaid'];
																							@endphp
																							@endif
																						@empty
                                            											@endforelse
																					</tbody>
																					<tfoot class="table-light">
																						<tr>
																							<td colspan="9"></td>
																							<td>Tax ${{$totalTaxComp}}</td>
																							<td colspan="1"></td>
																							<td>Total ${{$totalPaidComp}}</td>
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
                                           
                                            @forelse($reportData as $i=>$data)
                                            <div class="accordion-item shadow">
                                                <h2 class="accordion-header" id="heading{{$i}}Two">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$i}}Two" aria-expanded="false" aria-controls="collapse{{$i}}Two">
                                                        Comp
                                                    </button>
                                                </h2>
                                                <div id="collapse{{$i}}Two" class="accordion-collapse collapse" aria-labelledby="heading{{$i}}Two" data-bs-parent="#default-accordion-example">
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
                                            @empty
                                            @endforelse
                                            
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
