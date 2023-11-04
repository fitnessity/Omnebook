@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
@section('content')
<style>

	
	@media print {
		.printnone {
			display: none !important;
		}

		.exclude-from-print {
			display: block !important;
		}
	}
</style>
	@include('layouts.business.business_topbar')
	<!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
		<div class="page-content">
                <div class="container-fluid">
					<div class="row mb-3 printnone">
						<div class="col-12">
							<div class="page-heading">
								<a href="{{route('business.reports.index')}}" class="btn btn-red">Back</a>
							</div>
						</div>
								
						<div class="col-12">
							<div class="page-heading">
								<label>Sales Report</label>
							</div>
						</div>
					</div>
		
					<div class="row printnone">
						<div class="col-xxl-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h6 class="card-title mb-0 flex-grow-1">Filter</h6>
									</div>
								</div>
								<div class="row g-0">
									<div class="col-lg-6 col-md-6 col-sm-6">
										<div class="card-body">
											<div class="d-flex align-items-center mb-25">
												<div class="avatar-sm flex-shrink-0">
													<span class="avatar-title bg-primary rounded-circle fs-2">1</span>
												</div>
												<div class="flex-grow-1 ms-3 sale-date">
													<h2 class="mb-0">Choose Dates</h2>
												</div>
											</div>  
											<form method="GET">
												<input type="hidden" name="filterOptions" id="filterOptionsvalue" value="">
												<div class="row d-flex align-items-center">
													<div class="col-lg-3 col-md-4 col-sm-4">
														<label> Start Date </label>
													</div>
													<div class="col-lg-7 col-md-8 col-sm-8">
														<div class="form-group mb-10">	
															<div class="input-group">
																<input type="text" class="form-control border-0 flatpickr-range flatpiker-with-border" name="startDate" id="startDate"  readonly="readonly" value="{{$filterStartDate}}" placeholder="StartDate">
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
																<input type="text" class="form-control border-0 flatpickr-range flatpiker-with-border" name="endDate" id="endDate"  readonly="readonly" value="{{$filterEndDate}}"  placeholder="StartDate">
																<div class="input-group-text bg-primary border-primary text-white">
																	<i class="ri-calendar-2-line"></i>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="row justify-content-md-center">
													<div class="col-lg-6">
														<a class="btn btn-black w-100 mb-25" data-behavior="on_change_submit" id="generateReport"> Generate Reports </a>
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
													<h2 class="mb-0">Filter Options</h2>
												</div>
											</div> 
											<div class="row justify-content-md-center">
												<div class="col-lg-6">
													<div class="form-group mb-10">
														<select class="form-select" id="filterOptions" required="" data-behavior="on_change_submit">
															<option value="">Show All</option>
															<option value="category" {{@$filterOptions == 'category' ? 'selected' : ''}}>Sales By Category</option>
															<option value="source" {{@$filterOptions == 'source' ? 'selected' : ''}}>Sales by Source (Online vs In-Person)</option>
															<option value="priceOption" {{@$filterOptions == 'priceOption' ? 'selected' : ''}}>Sales by Price Option</option>
														</select>
													</div>
												</div>
											</div>
											<div class="d-flex align-items-center mb-25">
												<div class="avatar-sm flex-shrink-0">
													<span class="avatar-title bg-primary rounded-circle fs-2">
														3
													</span>
												</div>
												<div class="flex-grow-1 ms-3 sale-date">
													<h2 class="mb-0">Export Options</h2>
												</div>
											</div> 	
											<div class="row justify-content-md-center">
												<div class="col-lg-6">
													<div class="form-group mb-10">
														<select class="form-select" name="exportOptions" id="exportOptions" required="">
															<option value="">Select Export Options</option>
															<option value="print">Print this report</option>
															<option value="excel">Export to excel</option>
															<option value="pdf">Export to PDF</option>
														</select>
													</div>
													<button type="button" class="btn btn-black w-100 mb-25" onclick="exportData();">Go!</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- end card -->
						</div><!-- end col -->
					</div>
					
					@php $grandTax =  $grandDiscount =  $grandCash =  $grandCheck =  $grandCard = $grandComp = $grandTotal = 0; 
					@endphp
					<div class="row exclude-from-print mt-5">
						@foreach($sortedDates as $y=>$date)

						@php  
							$cardDetails = [];
					        $cardDetails1 = clone $cardReportrec; // Create a fresh copy of the query
					        $cardDetails1 = $cardDetails1->whereDate('transaction.created_at','=', $date->format('Y-m-d'));
					        
					        $cardDetails2 = clone $cardReportubs; // Create a fresh copy of the query
					        $cardDetails2 = $cardDetails2->whereDate('transaction.created_at','=', $date->format('Y-m-d'));

					        $cardDetails = $cardDetails1->get()->merge($cardDetails2->get());
					       
					        $cashData = clone $cashReport; // Create a fresh copy of the query
					        $cashData = $cashData->whereDate('transaction.created_at','=', $date->format('Y-m-d'))->get();
					        
					        $checkData = clone $checkReport; // Create a fresh copy of the query
							$checkData = $checkData->whereDate('transaction.created_at','=', $date->format('Y-m-d'))->get();

							$compData = clone $compReport; // Create a fresh copy of the query
							$compData = $compData->whereDate('transaction.created_at','=', $date->format('Y-m-d'))->get();
							$cardData = [];
					    @endphp

					    @if(count($cardDetails) > 0 ||count($cashData) > 0 || count($checkData) > 0 || count($compData) > 0 )
							<div class="col-xxl-12">
								<div class="card">
	                                <div class="card-header align-items-center d-flex">
	                                    <h4 class="card-title mb-0 flex-grow-1">{{$date->format('l, F j, Y')}}</h4>
	                                </div><!-- end card header -->

	                                <div class="card-body">
	                                    <div class="live-preview">
	                                        <div class="accordion accordion-border-box" id="default-accordion-example">
	                                        	@php
	                                        		if($filterOptions == 'source'){
	                                        			$cardCustomerData = $cardUserData = [];
														$cardDetails = collect($cardDetails)->groupBy('user_type');
														$cardCustomer = @$cardDetails['customer'];
														$cardUser = @$cardDetails['user'];
														if($cardCustomer){
															foreach ($cardCustomer as $key => $data1) 
			                                        		{
													            $stripeResponse = json_decode($data1->payload,true);
													            $card = $stripeResponse['charges']['data'][0]['payment_method_details']['card']['brand'];
												               	$cardCustomerData[$card][] = $data1;
												          	}
												        }
											          	if(count($cardCustomerData) > 0 ){
											          		$counter = 0;
											          		foreach($cardCustomerData as $i=>$data){ 
											          		@endphp
											          		<div class="accordion-item shadow">
				                                                <h2 class="accordion-header" id="headingcc-{{$counter}}{{$y}}">
				                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecc-{{$counter}}{{$y}}" aria-expanded="true" aria-controls="collapsecc-{{$counter}}{{$y}}">
				                                                        Credit Card ({{strtoupper($i)}}-Keyed) (In-Person)
				                                                    </button>
				                                                </h2>
				                                                <div id="collapsecc-{{$counter}}{{$y}}" class="accordion-collapse collapse" aria-labelledby="headingcc-{{$counter}}{{$y}}" data-bs-parent="#default-accordion-example">
				                                                    <div class="accordion-body">
				                                                        <div class="row">
																			<div class="col-xl-12">
																				<div class="card">
																					<div class="">
																						<div class="live-preview sales-report-table">
																							<div class="table-responsive">
																								<table class="table align-middle table-nowrap mb-25">
																									@include('business.sales_report.table_header_index')
																									<tbody>
																										@php $totalTaxCard = $totalPaidCard = $totalDiscountCard =  0 ; @endphp
																										@forelse($data as $i=>$dt)
																											@include('business.sales_report.table_data_index',['business_id' =>$business_id , 'dt' =>$dt])
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
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
				                                                    </div>
				                                                </div>
				                                            </div>
											          		@php 
											          		$counter++;
											          		}
											          	}

											          	if($cardUser){
												          	foreach ($cardUser as $key => $data1) 
			                                        		{
													            $stripeResponse = json_decode($data1->payload,true);
													            $card = $stripeResponse['charges']['data'][0]['payment_method_details']['card']['brand'];
												               	$cardUserData[$card][] = $data1;
												          	}
												        }

											          	if(count($cardUserData) > 0 ){
											          		$counter = 0;
											          		foreach($cardUserData as $i=>$data){ @endphp
											          		<div class="accordion-item shadow">
				                                                <h2 class="accordion-header" id="headingcu-{{$counter}}{{$y}}">
				                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecu-{{$counter}}{{$y}}" aria-expanded="true" aria-controls="collapsecu-{{$counter}}{{$y}}">
				                                                        Credit Card ({{strtoupper($i)}}-Keyed) (Online)
				                                                    </button>
				                                                </h2>
				                                                <div id="collapsecu-{{$counter}}{{$y}}" class="accordion-collapse collapse" aria-labelledby="headingcu-{{$counter}}{{$y}}" data-bs-parent="#default-accordion-example">
				                                                    <div class="accordion-body">
				                                                        <div class="row">
																			<div class="col-xl-12">
																				<div class="card">
																					<div class="">
																						<div class="live-preview sales-report-table">
																							<div class="table-responsive">
																								<table class="table align-middle table-nowrap mb-25">
																									@include('business.sales_report.table_header_index')
																									<tbody>
																										@php $totalTaxCard = $totalPaidCard = $totalDiscountCard =  0 ; @endphp
																										@forelse($data as $i=>$dt)
																											@include('business.sales_report.table_data_index',['business_id' =>$business_id , 'dt' =>$dt])
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
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
				                                                    </div>
				                                                </div>
				                                            </div>
											          		@php 
											          		$counter++;
											          		}
											          	}
	                                        		}else if($filterOptions == 'priceOption'){
	                                        			$cardPriceOption = [];
	                                        			if($cardDetails){
	                                        				$counter = 0;
												          	foreach ($cardDetails as $key => $data1){
													            $stripeResponse = json_decode($data1->payload,true);
													            $card = $stripeResponse['charges']['data'][0]['payment_method_details']['card']['brand'];
												               	$cardData[$card][] = $data1;
												          	}

												          	if(count($cardData) > 0 ){
												          		foreach($cardData as $key=>$cdt){
												          			$cardPriceOption = getGroupByPriceOption($cdt);
																	foreach($cardPriceOption as $priceOpt=>$cpo){
																	@endphp
													          		<div class="accordion-item shadow">
						                                                <h2 class="accordion-header" id="headingcp-{{$counter}}{{$y}}">
						                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecp-{{$counter}}{{$y}}" aria-expanded="true" aria-controls="collapsecp-{{$counter}}{{$y}}">
						                                                        Credit Card ({{strtoupper($key)}}-Keyed) - {{$priceOpt}}
						                                                    </button>
						                                                </h2>
						                                                <div id="collapsecp-{{$counter}}{{$y}}" class="accordion-collapse collapse" aria-labelledby="headingcp-{{$counter}}{{$y}}" data-bs-parent="#default-accordion-example">
						                                                    <div class="accordion-body">
						                                                        <div class="row">
																					<div class="col-xl-12">
																						<div class="card">
																							<div class="">
																								<div class="live-preview sales-report-table">
																									<div class="table-responsive">
																										<table class="table align-middle table-nowrap mb-25">
																											@include('business.sales_report.table_header_index')
																											<tbody>
																												@php $totalTaxCard = $totalPaidCard = $totalDiscountCard =  0 ; @endphp
																												@forelse($cpo as $i=>$dt)
																													@include('business.sales_report.table_data_index',['business_id' =>$business_id , 'dt' =>$dt])
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
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
						                                                    </div>
						                                                </div>
						                                            </div>
						                                           	@php 
						                                           	$counter++;
						                                       		}
											          		 	}
													        }
													    }
	                                        		}else if($filterOptions == 'category'){
	                                        			$cardCategoty = [];
	                                        			if($cardDetails){
												          	foreach ($cardDetails as $key => $data1){
													            $stripeResponse = json_decode($data1->payload,true);
													            $card = $stripeResponse['charges']['data'][0]['payment_method_details']['card']['brand'];
												               	$cardData[$card][] = $data1;
												          	}

												          	if(count($cardData) > 0 ){
												          		$counter = 0;
												          		foreach($cardData as $key=>$cdt){
												          			$cardCategoty = getGroupByCategoty($cdt);
																	foreach($cardCategoty as $priceOpt=>$cpo){
																	@endphp
													          		<div class="accordion-item shadow">
						                                                <h2 class="accordion-header" id="headingccate-{{$counter}}{{$y}}">
						                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseccate-{{$counter}}{{$y}}" aria-expanded="true" aria-controls="collapseccate-{{$counter}}{{$y}}">
						                                                        Credit Card ({{strtoupper($key)}}-Keyed) - {{$priceOpt}}
						                                                    </button>
						                                                </h2>
						                                                <div id="collapseccate-{{$counter}}{{$y}}" class="accordion-collapse collapse" aria-labelledby="headingccate-{{$counter}}{{$y}}" data-bs-parent="#default-accordion-example">
						                                                    <div class="accordion-body">
						                                                        <div class="row">
																					<div class="col-xl-12">
																						<div class="card">
																							<div class="">
																								<div class="live-preview sales-report-table">
																									<div class="table-responsive">
																										<table class="table align-middle table-nowrap mb-25">
																											@include('business.sales_report.table_header_index')
																											<tbody>
																												@php $totalTaxCard = $totalPaidCard = $totalDiscountCard =  0 ; @endphp
																												@forelse($cpo as $i=>$dt)
																													@include('business.sales_report.table_data_index',['business_id' =>$business_id , 'dt' =>$dt])
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
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
						                                                    </div>
						                                                </div>
						                                            </div>
						                                           	@php 
						                                           	$counter++;
						                                       		}
											          		 	}
													        }
													    }
	                                        		}else{
	                                        			foreach ($cardDetails as $key => $data1) 
		                                        		{
												            $stripeResponse = json_decode($data1->payload,true);
												            $card = $stripeResponse['charges']['data'][0]['payment_method_details']['card']['brand'];
											               	$cardData[$card][] = $data1;
											          	}
											          	if(count($cardData) > 0 ){
											          		foreach($cardData as $i=>$data){ @endphp
											          		<div class="accordion-item shadow">
				                                                <h2 class="accordion-header" id="headingc-{{$i}}{{$y}}">
				                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsec-{{$i}}{{$y}}" aria-expanded="true" aria-controls="collapsec-{{$i}}{{$y}}">
				                                                        Credit Card ({{strtoupper($i)}}-Keyed)
				                                                    </button>
				                                                </h2>
				                                                <div id="collapsec-{{$i}}{{$y}}" class="accordion-collapse collapse" aria-labelledby="heading{{$i}}{{$y}}" data-bs-parent="#default-accordion-example">
				                                                    <div class="accordion-body">
				                                                        <div class="row">
																			<div class="col-xl-12">
																				<div class="card">
																					<div class="">
																						<div class="live-preview sales-report-table">
																							<div class="table-responsive">
																								<table class="table align-middle table-nowrap mb-25">
																									@include('business.sales_report.table_header_index')
																									<tbody>
																										@php $totalTaxCard = $totalPaidCard = $totalDiscountCard =  0 ; @endphp
																										@forelse($data as $i=>$dt)
																											@include('business.sales_report.table_data_index',['business_id' =>$business_id , 'dt' =>$dt])
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
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
				                                                    </div>
				                                                </div>
				                                            </div>
											          		@php }
											          	}
	                                        		}
									          	@endphp
									          	
												@if(count($cashData) > 0 )
													@if($filterOptions == 'source')
														@php 
															$cashData = collect($cashData)->groupBy('user_type');
															$cashCustomer = @$cashData['customer'];
															$cashUser = @$cashData['user'];
														@endphp
														@if($cashCustomer)
			                                            <div class="accordion-item shadow">
			                                                <h2 class="accordion-header" id="headingcashC{{$y}}">
			                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecashC{{$y}}" aria-expanded="false" aria-controls="collapsecashC{{$y}}">
			                                                        Cash (In-Person) 
			                                                    </button>
			                                                </h2>
			                                                <div id="collapsecashC{{$y}}" class="accordion-collapse collapse" aria-labelledby="headingcashC{{$y}}" data-bs-parent="#default-accordion-example">
			                                                    <div class="accordion-body">
																	<div class="row">
																		<div class="col-xl-12">
																			<div class="card">
																				<div class="">
																					<div class="live-preview sales-report-table">
																						<div class="table-responsive">
																							<table class="table align-middle table-nowrap mb-25">
																								@include('business.sales_report.table_header_index')
																								<tbody>
																									@php 
																										$totalDiscount = $totalTax = $totalPaid = 0 ; 
																									@endphp
																									@forelse($cashCustomer as $i=>$cData)
																										@if(count($cData->userBookingStatus->UserBookingDetail) >0)
																											@include('business.sales_report.table_data_index',['business_id' =>$business_id , 'dt' =>$cData])
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
																									$grandCash += $totalPaid;
																									$grandTotal += $totalPaid;
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
																						</div><!-- end table responsive -->
																					</div>
																				</div><!-- end card-body -->
																			</div><!-- end card -->
																		</div><!-- end col -->
																	</div><!--end row-->
																</div>
			                                                </div>
			                                            </div>
			                                            @endif
			                                            @if($cashUser)
			                                            <div class="accordion-item shadow">
			                                                <h2 class="accordion-header" id="headingcashUser{{$y}}">
			                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecashUser{{$y}}" aria-expanded="false" aria-controls="collapsecashUser{{$y}}">
			                                                        Cash (Online) 
			                                                    </button>
			                                                </h2>
			                                                <div id="collapsecashUser{{$y}}" class="accordion-collapse collapse" aria-labelledby="headingcashUser{{$y}}" data-bs-parent="#default-accordion-example">
			                                                    <div class="accordion-body">
																	<div class="row">
																		<div class="col-xl-12">
																			<div class="card">
																				<div class="">
																					<div class="live-preview sales-report-table">
																						<div class="table-responsive">
																							<table class="table align-middle table-nowrap mb-25">
																								@include('business.sales_report.table_header_index')
																								<tbody>
																									@php 
																										$totalDiscount = $totalTax = $totalPaid = 0 ; 
																									@endphp
																									@forelse($cashUser as $i=>$cData)
																										@if(count($cData->userBookingStatus->UserBookingDetail) >0)
																											@include('business.sales_report.table_data_index',['business_id' =>$business_id , 'dt' =>$cData])
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
																									$grandCash += $totalPaid;
																									$grandTotal += $totalPaid;
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
																						</div><!-- end table responsive -->
																					</div>
																				</div><!-- end card-body -->
																			</div><!-- end card -->
																		</div><!-- end col -->
																	</div><!--end row-->
																</div>
			                                                </div>
			                                            </div>
			                                            @endif
			                                        @elseif($filterOptions == 'priceOption')
			                                        	@php 
			                                        		$cashPriceOption = [];
			                                        		$cashData = $cashData->filter(function ($item) {
													            return $item->UserBookingStatus && $item->UserBookingStatus->UserBookingDetail;
													        });

				                                        	if($cashData){
																foreach ($cashData as $key => $data) 
				                                        		{
														            $bDetails = $data->UserBookingStatus->UserBookingDetail;
														            foreach ($bDetails as $key => $dt) 
				                                        			{
				                                        				$name = $dt->business_price_detail_with_trashed->price_title;
				                                        				$cashPriceOption[$name][] = $data;
				                                        			}
													          	}
													        }
														@endphp

														@if(count($cashPriceOption) > 0 )
															@php $counter = 0; @endphp
											          		@foreach($cashPriceOption as $i=>$data)
											          			<div class="accordion-item shadow">
					                                                <h2 class="accordion-header" id="headingcashp{{$counter}}{{$y}}">
					                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecashp{{$counter}}{{$y}}" aria-expanded="false" aria-controls="collapsecashp{{$counter}}{{$y}}">
					                                                        Cash - {{$i}}
					                                                    </button>
					                                                </h2>
					                                                <div id="collapsecashp{{$counter}}{{$y}}" class="accordion-collapse collapse" aria-labelledby="headingcashp{{$counter}}{{$y}}" data-bs-parent="#default-accordion-example">
					                                                    <div class="accordion-body">
																			<div class="row">
																				<div class="col-xl-12">
																					<div class="card">
																						<div class="">
																							<div class="live-preview sales-report-table">
																								<div class="table-responsive">
																									<table class="table align-middle table-nowrap mb-25">
																										@include('business.sales_report.table_header_index')
																										<tbody>
																											@php 
																												$totalDiscount = $totalTax = $totalPaid = 0 ; 
																											@endphp
																											@forelse($data as $i=>$cData)
																												@if(count($cData->userBookingStatus->UserBookingDetail) >0)
																													@include('business.sales_report.table_data_index',['business_id' =>$business_id , 'dt' =>$cData])
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
																											$grandCash += $totalPaid;
																											$grandTotal += $totalPaid;
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
																								</div><!-- end table responsive -->
																							</div>
																						</div><!-- end card-body -->
																					</div><!-- end card -->
																				</div><!-- end col -->
																			</div><!--end row-->
																		</div>
					                                                </div>
					                                            </div>
					                                            @php $counter++; @endphp
											          		@endforeach
											          	@endif
											        @elseif($filterOptions == 'category')
											        	@php 
			                                        		$cashCategory = [];
			                                        		$cashData = $cashData->filter(function ($item) {
													            return $item->UserBookingStatus && $item->UserBookingStatus->UserBookingDetail;
													        });

				                                        	if($cashData){
																foreach ($cashData as $key => $data) 
				                                        		{
														            $bDetails = $data->UserBookingStatus->UserBookingDetail;
														            foreach ($bDetails as $key => $dt) 
				                                        			{
				                                        				$name = $dt->business_price_detail_with_trashed->business_price_details_ages_with_trashed->category_title;
				                                        				$cashCategory[$name][] = $data;
				                                        			}
													          	}
													        }
														@endphp

														@if(count($cashCategory) > 0 )
															@php $counter = 0; @endphp
											          		@foreach($cashCategory as $i=>$data)
											          			<div class="accordion-item shadow">
					                                                <h2 class="accordion-header" id="headingcashcate{{$counter}}{{$y}}">
					                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecashcate{{$counter}}{{$y}}" aria-expanded="false" aria-controls="collapsecashcate{{$counter}}{{$y}}">
					                                                        Cash - {{$i}}
					                                                    </button>
					                                                </h2>
					                                                <div id="collapsecashcate{{$counter}}{{$y}}" class="accordion-collapse collapse" aria-labelledby="headingcashcate{{$counter}}{{$y}}" data-bs-parent="#default-accordion-example">
					                                                    <div class="accordion-body">
																			<div class="row">
																				<div class="col-xl-12">
																					<div class="card">
																						<div class="">
																							<div class="live-preview sales-report-table">
																								<div class="table-responsive">
																									<table class="table align-middle table-nowrap mb-25">
																										@include('business.sales_report.table_header_index')
																										<tbody>
																											@php 
																												$totalDiscount = $totalTax = $totalPaid = 0 ; 
																											@endphp
																											@forelse($data as $i=>$cData)
																												@if(count($cData->userBookingStatus->UserBookingDetail) >0)
																													@include('business.sales_report.table_data_index',['business_id' =>$business_id , 'dt' =>$cData])
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
																											$grandCash += $totalPaid;
																											$grandTotal += $totalPaid;
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
																								</div><!-- end table responsive -->
																							</div>
																						</div><!-- end card-body -->
																					</div><!-- end card -->
																				</div><!-- end col -->
																			</div><!--end row-->
																		</div>
					                                                </div>
					                                            </div>
					                                            @php $counter++; @endphp
											          		@endforeach
											          	@endif
			                                        @else
			                                        	<div class="accordion-item shadow">
			                                                <h2 class="accordion-header" id="headingcashnormal{{$y}}">
			                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecashnormal{{$y}}" aria-expanded="false" aria-controls="collapsecashnormal{{$y}}">
			                                                        Cash 
			                                                    </button>
			                                                </h2>
			                                                <div id="collapsecashnormal{{$y}}" class="accordion-collapse collapse" aria-labelledby="headingcashnormal{{$y}}" data-bs-parent="#default-accordion-example">
			                                                    <div class="accordion-body">
																	<div class="row">
																		<div class="col-xl-12">
																			<div class="card">
																				<div class="">
																					<div class="live-preview sales-report-table">
																						<div class="table-responsive">
																							<table class="table align-middle table-nowrap mb-25">
																								@include('business.sales_report.table_header_index')
																								<tbody>
																									@php 
																										$totalDiscount = $totalTax = $totalPaid = 0 ; 
																									@endphp
																									@forelse($cashData as $i=>$cData)
																										@if(count($cData->userBookingStatus->UserBookingDetail) >0)
																											@include('business.sales_report.table_data_index',['business_id' =>$business_id , 'dt' =>$cData])
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
																									$grandCash += $totalPaid;
																									$grandTotal += $totalPaid;
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
																						</div><!-- end table responsive -->
																					</div>
																				</div><!-- end card-body -->
																			</div><!-- end card -->
																		</div><!-- end col -->
																	</div><!--end row-->
																</div>
			                                                </div>
			                                            </div>
		                                            @endif
	                                            @endif

	                                            @if(count($checkData) > 0 )
	                                           		@if($filterOptions == 'source')
														@php 
															$checkData = collect($checkData)->groupBy('user_type');
															$checkCustomer = @$checkData['customer'];
															$checkUser = @$checkData['user'];
														@endphp
														@if($checkCustomer)
			                                            <div class="accordion-item shadow">
			                                                <h2 class="accordion-header" id="headingcheckSoc{{$y}}">
			                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecheckSoc{{$y}}" aria-expanded="false" aria-controls="collapsecheckSoc{{$y}}">
			                                                        Check (In-Person)
			                                                    </button>
			                                                </h2>
			                                                <div id="collapsecheckSoc{{$y}}" class="accordion-collapse collapse" aria-labelledby="headingcheckSoc{{$y}}" data-bs-parent="#default-accordion-example">
			                                                    <div class="accordion-body">
																	<div class="row">
																		<div class="col-xl-12">
																			<div class="card">
																				<div class="">
																					<div class="live-preview sales-report-table">
																						<div class="table-responsive">
																							<table class="table align-middle table-nowrap mb-25">
																								@include('business.sales_report.table_header_index')
																								<tbody>
																									@php $totalDisCheck = $totalTaxCheck = $totalPaidCheck = 0 ; @endphp
																									@forelse($checkCustomer as $i=>$cData)
																										@if(count($cData->userBookingStatus->UserBookingDetail) >0)
																										@include('business.sales_report.table_data_index',['business_id' =>$business_id , 'dt' =>$cData])
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
																									$grandCheck += $totalPaidCheck;
																									$grandTotal += $totalPaidCheck;
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
			                                            @if($checkUser)
			                                            <div class="accordion-item shadow">
			                                                <h2 class="accordion-header" id="headingcheckSou{{$y}}">
			                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecheckSou{{$y}}" aria-expanded="false" aria-controls="collapsecheckSou{{$y}}">
			                                                        Check (Online)
			                                                    </button>
			                                                </h2>
			                                                <div id="collapsecheckSou{{$y}}" class="accordion-collapse collapse" aria-labelledby="headingcheckSou{{$y}}" data-bs-parent="#default-accordion-example">
			                                                    <div class="accordion-body">
																	<div class="row">
																		<div class="col-xl-12">
																			<div class="card">
																				<div class="">
																					<div class="live-preview sales-report-table">
																						<div class="table-responsive">
																							<table class="table align-middle table-nowrap mb-25">
																								@include('business.sales_report.table_header_index')
																								<tbody>
																									@php $totalDisCheck = $totalTaxCheck = $totalPaidCheck = 0 ; @endphp
																									@forelse($checkUser as $i=>$cData)
																										@if(count($cData->userBookingStatus->UserBookingDetail) >0)
																										@include('business.sales_report.table_data_index',['business_id' =>$business_id , 'dt' =>$cData])
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
																									$grandCheck += $totalPaidCheck;
																									$grandTotal += $totalPaidCheck;
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
																						</div><!-- end table responsive -->
																					</div>
																				</div><!-- end card-body -->
																			</div><!-- end card -->
																		</div><!-- end col -->
																	</div><!--end row-->
																</div>
			                                                </div>
			                                            </div>
			                                           	@endif
			                                        @elseif($filterOptions == 'priceOption')
			                                        	@php 
			                                        		$checkPriceOption = [];
			                                        		$checkData = $checkData->filter(function ($item) {
													            return $item->UserBookingStatus && $item->UserBookingStatus->UserBookingDetail;
													        });

				                                        	if($checkData){
																foreach ($checkData as $key => $data) 
				                                        		{
														            $bDetails = $data->UserBookingStatus->UserBookingDetail;
														            foreach ($bDetails as $key => $dt) 
				                                        			{
				                                        				$name = $dt->business_price_detail_with_trashed->price_title;
				                                        				$checkPriceOption[$name][] = $data;
				                                        			}
													          	}
													        }
														@endphp

														@if(count($checkPriceOption) > 0 )
															@php $counter = 0; @endphp
											          		@foreach($checkPriceOption as $i=>$data)
											          			<div class="accordion-item shadow">
					                                                <h2 class="accordion-header" id="headingcheckPrO{{$counter}}{{$y}}">
					                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecheckPrO{{$counter}}{{$y}}" aria-expanded="false" aria-controls="collapsecheckPrO{{$counter}}{{$y}}">
					                                                        Check - {{$i}}
					                                                    </button>
					                                                </h2>
					                                                <div id="collapsecheckPrO{{$counter}}{{$y}}" class="accordion-collapse collapse" aria-labelledby="headingcheckPrO{{$counter}}{{$y}}" data-bs-parent="#default-accordion-example">
					                                                    <div class="accordion-body">
																			<div class="row">
																				<div class="col-xl-12">
																					<div class="card">
																						<div class="">
																							<div class="live-preview sales-report-table">
																								<div class="table-responsive">
																									<table class="table align-middle table-nowrap mb-25">
																										@include('business.sales_report.table_header_index')
																										<tbody>
																											@php $totalDisCheck = $totalTaxCheck = $totalPaidCheck = 0 ; @endphp
																											@forelse($data as $i=>$cData)
																												@if(count($cData->userBookingStatus->UserBookingDetail) >0)
																												@include('business.sales_report.table_data_index',['business_id' =>$business_id , 'dt' =>$cData])
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
																											$grandCheck += $totalPaidCheck;
																											$grandTotal += $totalPaidCheck;
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
					                                            @php $counter++; @endphp
											          		@endforeach
											          	@endif
											        @elseif($filterOptions == 'category')
			                                        	@php 
			                                        		$checkcategory = [];
			                                        		$checkData = $checkData->filter(function ($item) {
													            return $item->UserBookingStatus && $item->UserBookingStatus->UserBookingDetail;
													        });

				                                        	if($checkData){
																foreach ($checkData as $key => $data) 
				                                        		{
														            $bDetails = $data->UserBookingStatus->UserBookingDetail;
														            foreach ($bDetails as $key => $dt) 
				                                        			{
				                                        				$name = $dt->business_price_detail_with_trashed->business_price_details_ages_with_trashed->category_title;
				                                        				$checkcategory[$name][] = $data;
				                                        			}
													          	}
													        }
														@endphp

														@if(count($checkcategory) > 0 )
															@php $counter = 0; @endphp
											          		@foreach($checkcategory as $i=>$data)
											          			<div class="accordion-item shadow">
					                                                <h2 class="accordion-header" id="headingcheckCat{{$counter}}{{$y}}">
					                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecheckCat{{$counter}}{{$y}}" aria-expanded="false" aria-controls="collapsecheckCat{{$counter}}{{$y}}">
					                                                        Check - {{$i}}
					                                                    </button>
					                                                </h2>
					                                                <div id="collapsecheckCat{{$counter}}{{$y}}" class="accordion-collapse collapse" aria-labelledby="headingcheckCat{{$counter}}{{$y}}" data-bs-parent="#default-accordion-example">
					                                                    <div class="accordion-body">
																			<div class="row">
																				<div class="col-xl-12">
																					<div class="card">
																						<div class="">
																							<div class="live-preview sales-report-table">
																								<div class="table-responsive">
																									<table class="table align-middle table-nowrap mb-25">
																										@include('business.sales_report.table_header_index')
																										<tbody>
																											@php $totalDisCheck = $totalTaxCheck = $totalPaidCheck = 0 ; @endphp
																											@forelse($data as $i=>$cData)
																												@if(count($cData->userBookingStatus->UserBookingDetail) >0)
																												@include('business.sales_report.table_data_index',['business_id' =>$business_id , 'dt' =>$cData])
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
																											$grandCheck += $totalPaidCheck;
																											$grandTotal += $totalPaidCheck;
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
																								</div><!-- end table responsive -->
																							</div>
																						</div><!-- end card-body -->
																					</div><!-- end card -->
																				</div><!-- end col -->
																			</div><!--end row-->
																		</div>
					                                                </div>
					                                            </div>
					                                            @php $counter++; @endphp
											          		@endforeach
											          	@endif
											        @else
											        	<div class="accordion-item shadow">
			                                                <h2 class="accordion-header" id="headingcheck{{$y}}">
			                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecheck{{$y}}" aria-expanded="false" aria-controls="collapsecheck{{$y}}">
			                                                        Check
			                                                    </button>
			                                                </h2>
			                                                <div id="collapsecheck{{$y}}" class="accordion-collapse collapse" aria-labelledby="headingcheck{{$y}}" data-bs-parent="#default-accordion-example">
			                                                    <div class="accordion-body">
																	<div class="row">
																		<div class="col-xl-12">
																			<div class="card">
																				<div class="">
																					<div class="live-preview sales-report-table">
																						<div class="table-responsive">
																							<table class="table align-middle table-nowrap mb-25">
																								@include('business.sales_report.table_header_index')
																								<tbody>
																									@php $totalDisCheck = $totalTaxCheck = $totalPaidCheck = 0 ; @endphp
																									@forelse($checkData as $i=>$cData)
																										@if(count($cData->userBookingStatus->UserBookingDetail) >0)
																										@include('business.sales_report.table_data_index',['business_id' =>$business_id , 'dt' =>$cData])
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
																									$grandCheck += $totalPaidCheck;
																									$grandTotal += $totalPaidCheck;
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
																						</div><!-- end table responsive -->
																					</div>
																				</div><!-- end card-body -->
																			</div><!-- end card -->
																		</div><!-- end col -->
																	</div><!--end row-->
																</div>
			                                                </div>
			                                            </div>
			                                        @endif
	                                            @endif

	                                            @if(count($compData) > 0 )
	                                            	@if($filterOptions == 'source')
														@php 
															$compData = collect($compData)->groupBy('user_type');
															$compCustomer = @$compData['customer'];
															$compUser = @$compData['user'];
														@endphp
														@if($compCustomer)
			                                            <div class="accordion-item shadow">
			                                                <h2 class="accordion-header" id="headingCompC{{$y}}">
			                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCompC{{$y}}" aria-expanded="false" aria-controls="collapseCompC{{$y}}">
			                                                        Comp (In-Person)
			                                                    </button>
			                                                </h2>
			                                                <div id="collapseCompC{{$y}}" class="accordion-collapse collapse" aria-labelledby="headingCompC{{$y}}" data-bs-parent="#default-accordion-example">
			                                                    <div class="accordion-body">
																	<div class="row">
																		<div class="col-xl-12">
																			<div class="card">
																				<div class="">
																					<div class="live-preview sales-report-table">
																						<div class="table-responsive">
																							<table class="table align-middle table-nowrap mb-25">
																								@include('business.sales_report.table_header_index')
																								<tbody>
																									@php $taxComp = $totalTaxComp = $totalPaidComp = 0 ; @endphp
																									@forelse($compCustomer as $i=>$cData)
																										@if(count($cData->userBookingStatus->UserBookingDetail) >0)
																										@include('business.sales_report.table_data_index',['business_id' =>$business_id , 'dt' =>$cData ,'type'=>'comp'])
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
			                                            @if($compUser)
			                                            	<div class="accordion-item shadow">
			                                                <h2 class="accordion-header" id="headingCompUser{{$y}}">
			                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCompUser{{$y}}" aria-expanded="false" aria-controls="collapseCompUser{{$y}}">
			                                                        Comp (Online)
			                                                    </button>
			                                                </h2>
			                                                <div id="collapseCompUser{{$y}}" class="accordion-collapse collapse" aria-labelledby="headingCompUser{{$y}}" data-bs-parent="#default-accordion-example">
			                                                    <div class="accordion-body">
																	<div class="row">
																		<div class="col-xl-12">
																			<div class="card">
																				<div class="">
																					<div class="live-preview sales-report-table">
																						<div class="table-responsive">
																							<table class="table align-middle table-nowrap mb-25">
																								@include('business.sales_report.table_header_index')
																								<tbody>
																									@php $taxComp = $totalTaxComp = $totalPaidComp = 0 ; @endphp
																									@forelse($compUser as $i=>$cData)
																										@if(count($cData->userBookingStatus->UserBookingDetail) >0)
																										@include('business.sales_report.table_data_index',['business_id' =>$business_id , 'dt' =>$cData ,'type'=>'comp'])
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
																						</div><!-- end table responsive -->
																					</div>
																				</div><!-- end card-body -->
																			</div><!-- end card -->
																		</div><!-- end col -->
																	</div><!--end row-->
																</div>
			                                                </div>
			                                            </div>
			                                           	@endif
			                                        @elseif($filterOptions == 'category')
			                                        	@php 
			                                        		$compCategory = [];
			                                        		$compData = $compData->filter(function ($item) {
													            return $item->UserBookingStatus && $item->UserBookingStatus->UserBookingDetail;
													        });

				                                        	if($compData){
																foreach ($compData as $key => $data) 
				                                        		{
														            $bDetails = $data->UserBookingStatus->UserBookingDetail;
														            foreach ($bDetails as $key => $dt) 
				                                        			{
				                                        				$name = $dt->business_price_detail_with_trashed->business_price_details_ages_with_trashed->category_title;
				                                        				$compCategory[$name][] = $data;
				                                        			}
													          	}
													        }
														@endphp

														@if(count($compCategory) > 0 )
															@php $counter = 0; @endphp
															@foreach($compCategory as $i=>$data)   	
				                                        	<div class="accordion-item shadow">
				                                                <h2 class="accordion-header" id="headingCompCat{{$y}}">
				                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCompCat{{$y}}" aria-expanded="false" aria-controls="collapseCompCat{{$y}}">
				                                                        Comp - {{$i}}
				                                                    </button>
				                                                </h2>
				                                                <div id="collapseCompCat{{$y}}" class="accordion-collapse collapse" aria-labelledby="headingCompCat{{$y}}" data-bs-parent="#default-accordion-example">
				                                                    <div class="accordion-body">
																		<div class="row">
																			<div class="col-xl-12">
																				<div class="card">
																					<div class="">
																						<div class="live-preview sales-report-table">
																							<div class="table-responsive">
																								<table class="table align-middle table-nowrap mb-25">
																									@include('business.sales_report.table_header_index')
																									<tbody>
																										@php $taxComp = $totalTaxComp = $totalPaidComp = 0 ; @endphp
																										@forelse($data as $i=>$cData)
																											@if(count($cData->userBookingStatus->UserBookingDetail) >0)
																											@include('business.sales_report.table_data_index',['business_id' =>$business_id , 'dt' =>$cData ,'type'=>'comp'])
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
																							</div><!-- end table responsive -->
																						</div>
																					</div><!-- end card-body -->
																				</div><!-- end card -->
																			</div><!-- end col -->
																		</div><!--end row-->
																	</div>
				                                                </div>
				                                            </div>
				                                            @php $counter++; @endphp
				                                            @endforeach
				                                        @endif
				                                    @elseif($filterOptions == 'priceOption')
			                                        	@php 
			                                        		$compPriceOption = [];
			                                        		$compData = $compData->filter(function ($item) {
													            return $item->UserBookingStatus && $item->UserBookingStatus->UserBookingDetail;
													        });

				                                        	if($compData){
																foreach ($compData as $key => $data) 
				                                        		{
														            $bDetails = $data->UserBookingStatus->UserBookingDetail;
														            foreach ($bDetails as $key => $dt) 
				                                        			{
				                                        				$name = $dt->business_price_detail_with_trashed->price_title;
				                                        				$compPriceOption[$name][] = $data;
				                                        			}
													          	}
													        }
														@endphp

														@if(count($compPriceOption) > 0 )
															@php $counter = 0; @endphp
															@foreach($compPriceOption as $i=>$data)   	
				                                        	<div class="accordion-item shadow">
				                                                <h2 class="accordion-header" id="headingCompPO{{$counter}}{{$y}}">
				                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCompPO{{$counter}}{{$y}}" aria-expanded="false" aria-controls="collapseCompPO{{$counter}}{{$y}}">
				                                                        Comp - {{$i}}
				                                                    </button>
				                                                </h2>
				                                                <div id="collapseCompPO{{$counter}}{{$y}}" class="accordion-collapse collapse" aria-labelledby="headingCompPO{{$counter}}{{$y}}" data-bs-parent="#default-accordion-example">
				                                                    <div class="accordion-body">
																		<div class="row">
																			<div class="col-xl-12">
																				<div class="card">
																					<div class="">
																						<div class="live-preview sales-report-table">
																							<div class="table-responsive">
																								<table class="table align-middle table-nowrap mb-25">
																									@include('business.sales_report.table_header_index')
																									<tbody>
																										@php $taxComp = $totalTaxComp = $totalPaidComp = 0 ; @endphp
																										@forelse($data as $i=>$cData)
																											@if(count($cData->userBookingStatus->UserBookingDetail) >0)
																											@include('business.sales_report.table_data_index',['business_id' =>$business_id , 'dt' =>$cData ,'type'=>'comp'])
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
																							</div><!-- end table responsive -->
																						</div>
																					</div><!-- end card-body -->
																				</div><!-- end card -->
																			</div><!-- end col -->
																		</div><!--end row-->
																	</div>
				                                                </div>
				                                            </div>
				                                            @php $counter++; @endphp
				                                            @endforeach
				                                        @endif
			                                        @else
			                                        	<div class="accordion-item shadow">
			                                                <h2 class="accordion-header" id="headingComp{{$y}}">
			                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseComp{{$y}}" aria-expanded="false" aria-controls="collapseComp{{$y}}">
			                                                        Comp
			                                                    </button>
			                                                </h2>
			                                                <div id="collapseComp{{$y}}" class="accordion-collapse collapse" aria-labelledby="headingComp{{$y}}" data-bs-parent="#default-accordion-example">
			                                                    <div class="accordion-body">
																	<div class="row">
																		<div class="col-xl-12">
																			<div class="card">
																				<div class="">
																					<div class="live-preview sales-report-table">
																						<div class="table-responsive">
																							<table class="table align-middle table-nowrap mb-25">
																								@include('business.sales_report.table_header_index')
																								<tbody>
																									@php $taxComp = $totalTaxComp = $totalPaidComp = 0 ; @endphp
																									@forelse($compData as $i=>$cData)
																										@if(count($cData->userBookingStatus->UserBookingDetail) >0)
																										@include('business.sales_report.table_data_index',['business_id' =>$business_id , 'dt' =>$cData ,'type'=>'comp'])
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
																						</div><!-- end table responsive -->
																					</div>
																				</div><!-- end card-body -->
																			</div><!-- end card -->
																		</div><!-- end col -->
																	</div><!--end row-->
																</div>
			                                                </div>
			                                            </div>
			                                        @endif
	                                            @endif
	                                       </div>
	                                    </div>
	                                </div><!-- end card-body -->
	                            </div><!-- end card -->
							</div>
						@endif
						@endforeach
					</div>
			
					<div class="row exclude-from-print mt-5">
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
																	<td>${{$grandCheck}}</td>
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
                </div><!-- container-fluid -->
            </div><!-- End Page-content -->
     	</div><!-- end main content-->
	</div><!-- END layout-wrapper -->


@include('layouts.business.footer')
	<script>
		flatpickr(".flatpickr-range", {
		   	altInput: true,
		   	altFormat: "m/d/Y",
	     	dateFormat: "Y-m-d",
	     	maxDate: "2050-01-01"
		});

	  
	    $(document).on('click', '[data-behavior~=on_change_submit]', function(e){
			e.preventDefault()
			$(this).parents('form').submit();
		});

		$(document).on('change', '[data-behavior~=on_change_submit]', function(e){
			$('#filterOptionsvalue').val(this.value);
			$('#generateReport').click();
		});

		function exportData(){
	
			let startDate = '<?= $filterStartDate ? $filterStartDate->format("Y-m-d") : ''; ?>' || $('#startDate').val();
			let endDate = '<?= $filterEndDate ? $filterEndDate->format("Y-m-d") : ''; ?>' ||  $('#endDate').val();
			var type = $('#exportOptions').val();
			var filename =  '';
			if(type != '' && type != 'print'){
				var downloadUrl = '{{ route("business.sales_report.export") }}' +
		        '?endDate=' + endDate +
		        '&startDate=' + startDate +
		        '&type=' + type;

			    if(type == 'excel'){
		    		filename = 'SalesReport.xlsx';
		    	}else if(type == 'pdf'){
		    		filename = 'SalesReport.pdf';
		    	}
			
			    var link = document.createElement('a');
			    link.href = downloadUrl;
			    link.download = 'SalesReport.xlsx';
			    document.body.appendChild(link);
			    link.click();
			    document.body.removeChild(link);
			}else if(type == 'print'){
				$('.accordion-button').removeClass('collapsed');
				$('.accordion-collapse').addClass('show');
				$('.table').removeClass('table-nowrap');

				$('.sales-report-table table thead tr th').css({
			        'background': '#ea1515',
			        'color': '#fff',
			        'padding': '10px 5px',
			        'border': '1px solid #878a99',
			        'border-collapse': 'collapse'
			    });
				print();

				$('.table').addClass('table-nowrap');
			}
		}

	</script>
@endsection
