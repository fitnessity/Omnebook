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
											<form method="GET">
												<div class="row d-flex align-items-center">
													<div class="col-lg-3 col-md-4 col-sm-4">
														<label> Start Date </label>
													</div>
													<div class="col-lg-7 col-md-8 col-sm-8">
														<div class="form-group mb-10">	
															<div class="input-group">
																<input type="text" class="form-control border-0 flatpickr-range flatpiker-with-border" name="startDate" id="startDate"  readonly="readonly" value="{{$filterStartDate->format('m/d/Y')}}">
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
																<input type="text" class="form-control border-0 flatpickr-range flatpiker-with-border" name="endDate" id="endDate"  readonly="readonly" value="{{$filterEndDate->format('m/d/Y')}}">
																<div class="input-group-text bg-primary border-primary text-white">
																	<i class="ri-calendar-2-line"></i>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="row justify-content-md-center">
													<div class="col-lg-6">
														<a class="btn btn-black w-100 mb-25" data-behavior="on_change_submit"> Generate Reports </a>
			
													</div>
												</div>
											</form>
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
					
					@php $grandTax =  $grandDiscount =  $grandCash =  $grandcheck =  $grandCard = $grandComp = $grandTotal = 0; 
					@endphp
					<div class="row">
						@foreach($sortedDates as $y=>$date)

						@php  
					        $cashData = clone $cashReport; // Create a fresh copy of the query
					        $cashData = $cashData->whereDate('transaction.created_at','=', $date->format('Y-m-d'))->get();

					        $checkData = clone $checkReport; // Create a fresh copy of the query
							$checkData = $checkData->whereDate('transaction.created_at','=', $date->format('Y-m-d'))->get();

							$compData = clone $compReport; // Create a fresh copy of the query
							$compData = $compData->whereDate('transaction.created_at','=', $date->format('Y-m-d'))->get();

					    @endphp

					    @if(count($cashData) > 0 || count($checkData) > 0 || count($compData) > 0 )
							<div class="col-xxl-12">
								<div class="card">
	                                <div class="card-header align-items-center d-flex">
	                                    <h4 class="card-title mb-0 flex-grow-1">{{$date->format('l, F j, Y')}}</h4>
	                                </div><!-- end card header -->

	                                <div class="card-body">
	                                    <div class="live-preview">
	                                        <div class="accordion accordion-border-box" id="default-accordion-example">

	                                        	@forelse($cardReport as $i=>$data)
	                                            <div class="accordion-item shadow">
	                                                <h2 class="accordion-header" id="heading{{$i}}{{$y}}">
	                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$i}}{{$y}}" aria-expanded="true" aria-controls="collapse{{$i}}{{$y}}">
	                                                        Credit Card ({{strtoupper($i)}}-Keyed)
	                                                    </button>
	                                                </h2>
	                                                <div id="collapse{{$i}}{{$y}}" class="accordion-collapse collapse" aria-labelledby="heading{{$i}}{{$y}}" data-bs-parent="#default-accordion-example">
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
																							<tbody>
																							@php $totalTaxCard = $totalPaidCard = $totalDiscountCard =  0 ; @endphp
																							@forelse($data as $i=>$dt)
																								<tr>
																									<td> {{date('m-d-Y',strtotime($dt->created_at))}}</td>
																									<td>@if($dt->getCustomer($business_id) != '') 
																										<a href="{{url('business/'.$business_id.'/customers/'.@$dt->getCustomer($business_id)->id)}}" class="fw-medium">{{@$dt->getCustomer($business_id)->full_name}}</a>
																										@else N/A
																									@endif</td>
																									<td>{!!$dt->item_description($business_id)['itemDescription']!!}</td>
																									<td>{!! @$dt->item_description($business_id)['location'] !!}</td>
																									<td>{!!$dt->item_description($business_id)['notes']!!}</td>
																									<td>{!!$dt->item_description($business_id)['itemPrice']!!}</td>
																									<td>{!!$dt->item_description($business_id)['qty']!!}</td>
																									<td>{!!$dt->item_description($business_id)['itemPrice']!!}</td>
																									<td>{!!$dt->item_description($business_id)['itemDis']!!}</td>
																									<td>{!!$dt->item_description($business_id)['itemTax']!!}</td>
																									<td>{!!$dt->item_description($business_id)['itemSubTotal']!!}</td>
																									<td>{!!$dt->item_description($business_id)['itemSubTotal']!!}</td>
																								</tr>
																								@php 
																									$totalTaxCard += $dt->item_description($business_id)['totalTax'];

																									$totalDiscountCard += $dt->item_description($business_id)['totalDis'];

																									$totalPaidCard += $dt->item_description($business_id)['totalPaid'];
																								@endphp
																							@empty
	                                            											@endforelse
																						</tbody>
																						@php $grandTax += $totalTaxCard;
																							$grandDiscount += $totalDiscountCard;
																							$grandCard += $totalPaidCard;
																							$grandTotal += $totalPaidCard;
																						@endphp
																						<tfoot class="table-light">
																							<tr>
																								<td colspan="9"></td>
																								<td>Tax ${{$totalTaxCard}}</td>
																								<td colspan="1"></td>
																								<td>Total ${{$totalPaidCard}}</td>
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
												
												@if(count($cashData) > 0 )
	                                            <div class="accordion-item shadow">
	                                                <h2 class="accordion-header" id="headingone{{$y}}">
	                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseone{{$y}}" aria-expanded="false" aria-controls="collapseone{{$y}}">
	                                                        Cash
	                                                    </button>
	                                                </h2>
	                                                <div id="collapseone{{$y}}" class="accordion-collapse collapse" aria-labelledby="headingone{{$y}}" data-bs-parent="#default-accordion-example">
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
																							@php $totalDiscount = $totalTax = $totalPaid = 0 ; @endphp
																							@forelse($cashData as $i=>$cData)
																								@if(count($cData->userBookingStatus->UserBookingDetail) >0 && $cData->Customer != '')
																								<tr>
																									<td>{{date('m-d-Y',strtotime($cData->created_at))}}</td>
																									<td><a href="{{url('business/'.$business_id.'/customers/'.$cData->Customer->id)}}" class="fw-medium">{{@$cData->Customer->full_name}}</a></td>
																									<td>{!!$cData->item_description($business_id)['itemDescription']!!}</td>
																									<td>{!! @$cData->item_description($business_id)['location'] !!}</td>
																									<td>{!!$cData->item_description($business_id)['notes']!!}</td>
																									<td>{!!$cData->item_description($business_id)['itemPrice']!!}</td>
																									<td>{!!$cData->item_description($business_id)['qty']!!}</td>
																									<td>{!!$cData->item_description($business_id)['itemPrice']!!}</td>
																									<td>{!!$cData->item_description($business_id)['itemDis']!!}</td>
																									<td>{!!$cData->item_description($business_id)['itemTax']!!}</td>
																									<td>{!!$cData->item_description($business_id)['itemSubTotal']!!}</td>
																									<td>{!!$cData->item_description($business_id)['itemSubTotal']!!}</td>
																								</tr>
																								@php 
																									$totalTax += $cData->item_description($business_id)['totalTax'];

																									$totalDiscount += $cData->item_description($business_id)['totalDis'];

																									$totalPaid += $cData->item_description($business_id)['totalPaid'];
																								@endphp
																								@endif
																							@empty
	                                            											@endforelse
																						</tbody>
																						@php $grandTax += $totalTax;
																							$grandDiscount += $totalDiscount;
																							$grandCash = $totalPaid;
																							$grandTotal += $grandCash;
																						@endphp
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
	                                            @endif

	                                            @if(count($checkData) > 0 )
	                                            <div class="accordion-item shadow">
	                                                <h2 class="accordion-header" id="headingFour{{$y}}">
	                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour{{$y}}" aria-expanded="false" aria-controls="collapseFour{{$y}}">
	                                                        Check
	                                                    </button>
	                                                </h2>
	                                                <div id="collapseFour{{$y}}" class="accordion-collapse collapse" aria-labelledby="headingFour{{$y}}" data-bs-parent="#default-accordion-example">
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
																							@php $totalDisCheck = $totalTaxCheck = $totalPaidCheck = 0 ; @endphp
																							@forelse($checkData as $i=>$cData)
																								@if(count($cData->userBookingStatus->UserBookingDetail) >0 && $cData->Customer != '')
																								<tr>
																									<td>{{date('m-d-Y',strtotime($cData->created_at))}}</td>
																									<td><a href="{{url('business/'.$business_id.'/customers/'.$cData->Customer->id)}}" class="fw-medium">{{@$cData->Customer->full_name}}</a></td>
																									<td>{!!$cData->item_description($business_id)['itemDescription']!!}</td>
																									<td>{!! @$cData->item_description($business_id)['location'] !!}</td>
																									<td>{!!$cData->item_description($business_id)['notes']!!}</td>
																									<td>{!!$cData->item_description($business_id)['itemPrice']!!}</td>
																									<td>{!!$cData->item_description($business_id)['qty']!!}</td>
																									<td>{!!$cData->item_description($business_id)['itemPrice']!!}</td>
																									<td>{!!$cData->item_description($business_id)['itemDis']!!}</td>
																									<td>{!!$cData->item_description($business_id)['itemTax']!!}</td>
																									<td>{!!$cData->item_description($business_id)['itemSubTotal']!!}</td>
																									<td>{!!$cData->item_description($business_id)['itemSubTotal']!!}</td>
																								</tr>
																								@php 
																									$totalTaxCheck += $cData->item_description($business_id)['totalTax'];

																									$totalDisCheck += $cData->item_description($business_id)['totalDis'];

																									$totalPaidCheck += $cData->item_description($business_id)['totalPaid'];
																								@endphp
																								@endif
																							@empty
	                                            											@endforelse
																						</tbody>
																						@php $grandTax += $totalTaxCheck;
																							$grandDiscount += $totalDisCheck;
																							$grandCheck = $totalPaidCheck;
																							$grandTotal += $grandCheck;
																						@endphp
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
	                                            @endif

	                                            @if(count($compData) > 0 )
	                                            <div class="accordion-item shadow">
	                                                <h2 class="accordion-header" id="headingThree{{$y}}">
	                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree{{$y}}" aria-expanded="false" aria-controls="collapseThree{{$y}}">
	                                                        Comp
	                                                    </button>
	                                                </h2>
	                                                <div id="collapseThree{{$y}}" class="accordion-collapse collapse" aria-labelledby="headingThree{{$y}}" data-bs-parent="#default-accordion-example">
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
																							@forelse($compData as $i=>$cData)
																								@if(count($cData->userBookingStatus->UserBookingDetail) >0 && $cData->Customer != '')
																								<tr>
																									<td>{{date('m-d-Y',strtotime($cData->created_at))}}</td>
																									<td><a href="{{url('business/'.$business_id.'/customers/'.$cData->Customer->id)}}" class="fw-medium">{{@$cData->Customer->full_name}}</a></td>
																									<td>{!!$cData->item_description($business_id)['itemDescription']!!}</td>
																									<td>{!! @$cData->item_description($business_id)['location'] !!}</td>
																									<td>{!!$cData->item_description($business_id)['notes']!!}</td>
																									<td>{!!$cData->item_description($business_id)['itemPrice']!!}</td>
																									<td>{!!$cData->item_description($business_id)['qty']!!}</td>
																									<td>{!!$cData->item_description($business_id)['itemPrice']!!}</td>
																									<td>{!!$cData->item_description($business_id)['itemDis']!!}</td>
																									<td>{!!$cData->item_description($business_id)['itemTax']!!}</td>
																									<td>{!!$cData->item_description($business_id)['itemSubTotal']!!}</td>
																									<td>$0</td>
																								</tr>
																								@php 
																									$totalTaxComp += $cData->item_description($business_id)['totalTax'];
																									$totalPaidComp += 0;
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
	                                            @endif

	                                        </div>
	                                    </div>
	                                </div><!-- end card-body -->
	                            </div><!-- end card -->
							</div>
						@endif
						@endforeach
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
																	<td>${{$grandTax}}</td>
																	<td>${{$grandDiscount}}</td>
																	<td>-</td>
																	<td>${{$grandCash}}</td>
																	<td>${{$grandcheck}}</td>
																	<td>${{$grandCard}}</td>
																	<td>${{$grandComp}}</td>
																	<td>${{$grandTotal}}</td>
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
	        maxDate: "01/01/2050"
	   	});

	  
	    $(document).on('click', '[data-behavior~=on_change_submit]', function(e){
			e.preventDefault()
			$(this).parents('form').submit();
		});

	</script>
@endsection
