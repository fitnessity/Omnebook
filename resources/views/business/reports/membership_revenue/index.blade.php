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
	            <div class="row">
	               <div class="col">
	                  <div class="h-100">
	                     <div class="row mb-3 printnone">
	                     	<div class="col-12">
								<div class="page-heading">
									<a href="{{route('business.reports.index')}}" class="btn btn-red">Back</a>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="page-heading">
									<label>Revenue and Membership Breakdown</label>
								</div>
							</div><!--end col-->
						</div><!--end row-->
								
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
													<input type="hidden" name="filterOptions" id="filterOptionsvalue" value="{{request()->filterOptions}}">
													<div class="row d-flex align-items-center">
														<div class="col-lg-3 col-md-4 col-sm-4">
															<label> Start Date </label>
														</div>
														<div class="col-lg-7 col-md-8 col-sm-8">
															<div class="form-group mb-10">	
																<div class="input-group">
																	<input type="text" class="form-control border-0 flatpickr-range flatpiker-with-border" name="startDate" id="startDate" readonly="readonly" value="{{$filterStartDate}}" placeholder="StartDate">
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
															<button type="button" class="btn btn-black w-100 mb-25" data-behavior="on_change_submit" id="generateReport"> Generate Reports </button>
														</div>
													</div>
												</form>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6">
											<div class="card-body border-end-left">
												<div class="d-flex align-items-center mb-25">
													<div class="avatar-sm flex-shrink-0">
														<span class="avatar-title bg-primary rounded-circle fs-2">2</span>
													</div>
													<div class="flex-grow-1 ms-3 sale-date"><h2 class="mb-0">Export Options</h2></div>
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
														<button type="button" class="btn btn-black w-100 mb-25" onclick="exportData();"id="go_btn"> Go!</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						@php 
							$revenueTotals = [ 'Classes' => 0, 'Personal Training' => 0, 'Experience' => 0, 'Events' => 0]; 
    						$grandTotal = $adultCount = $childCount = $infantCount = $totalListed =  $adult = $child = $infant = $adultR = $childR = $infantR = 0; $tdMembership = $tdRevenue = $tdProduct  = '';
    					
							foreach($memberships as $i=>$m){
						        $revenue = $m->getMembershipRevenue($filterStartDate, $filterEndDate,$business_id);

								$adult += $m->getRevenueByType('adult',$filterStartDate, $filterEndDate,$business_id);
								$child += $m->getRevenueByType('child',$filterStartDate, $filterEndDate,$business_id);
								$infant += $m->getRevenueByType('infant',$filterStartDate, $filterEndDate,$business_id);
								$adultRevenue += $m->getRevenueByType('adult',$filterStartDate, $filterEndDate,$business_id);
								$childRevenue += $m->getRevenueByType('child',$filterStartDate, $filterEndDate,$business_id);
								$infantRevenue += $m->getRevenueByType('infant',$filterStartDate, $filterEndDate,$business_id);

								$singlePmt += $revenue ;
								$grandTotal += $revenue ;

								$revenueTotals[$m->BusinessServices->formal_service_types()] += $revenue;
							  
							    $tdMembership .= '<tr>
							    	<td>'.($i+1).'</td>
							    	<td>'.$m->BusinessServices->program_name.' - '.$m->price_title.'</td>
							    	<td>'.$m->BusinessServices->formal_service_types().'</td>
							    	<td>'.$m->getMembershipFor($filterStartDate,$filterEndDate,$business_id).'</td>
							    	<td>'.$m->getMembershipPrice($filterStartDate,$filterEndDate,$business_id).'</td>
							    	<td>'.$m->getMembershipQty($filterStartDate,$filterEndDate,$business_id).'</td>
							    	<td>$'.$revenue.'</td>
							    </tr>';
							}

							foreach($recurringMemberships as $i=>$m){
								$recurringRevenue = $m->getRecurringMembershipRevenue($filterStartDate, $filterEndDate,$business_id);

								$adultR += $m->getRecurringRevenueByType('adult',$filterStartDate, $filterEndDate,$business_id);
								$childR += $m->getRecurringRevenueByType('child',$filterStartDate, $filterEndDate,$business_id);
								$infantR += $m->getRecurringRevenueByType('infant',$filterStartDate, $filterEndDate,$business_id);

								$adultRevenue += $m->getRecurringRevenueByType('adult',$filterStartDate, $filterEndDate,$business_id);
								$childRevenue += $m->getRecurringRevenueByType('child',$filterStartDate, $filterEndDate,$business_id);
								$infantRevenue += $m->getRecurringRevenueByType('infant',$filterStartDate, $filterEndDate,$business_id);

								$recurringPmt += $recurringRevenue ;
								$grandTotal += $recurringRevenue ;

								$revenueTotals[$m->BusinessServices->formal_service_types()] += $recurringRevenue;
							  
							    $tdRevenue .= '<tr>
							    	<td>'.($i+1).'</td>
							    	<td>'.$m->BusinessServices->program_name.' - '.$m->price_title.'</td>
							    	<td>'.$m->BusinessServices->formal_service_types().'</td>
							    	<td>'.$m->getRecurringMembershipFor($filterStartDate,$filterEndDate,$business_id).'</td>
							    	<td>'.$m->getRecurringMembershipPrice($filterStartDate,$filterEndDate,$business_id).'</td>
							    	<td>'.$m->getRecurringMembershipQty($filterStartDate,$filterEndDate,$business_id).'</td>
							    	<td>$'.$recurringRevenue.'</td>
							    </tr>';
							}

							foreach($products as $i=>$p){
								$productRevenue += $p->getProductRevenue($filterStartDate,$filterEndDate,$business_id);
								$grandTotal += $p->getProductRevenue($filterStartDate,$filterEndDate,$business_id);
							  	$totalListed = count($products);
							    $tdProduct .= '<tr>
							    	<td>'.($i+1).'</td>
							    	<td>'.$p->name.'</td>
							    	<td><label>In-Stock : </label> '.$p->getSoldProducts().', <label>Low Quantity: </label> '.$p->low_quantity_alert.', <label>Sold-Out:</label> '.$p->soldProducts($filterStartDate,$filterEndDate).' </td>
							    	<td>'.$p->getProductPrice($filterStartDate,$filterEndDate,$business_id).'</td>
							    	<td>'.$p->getProductQty($filterStartDate,$filterEndDate,$business_id).'</td>
							    	<td>'.$p->getProductRevenue($filterStartDate,$filterEndDate,$business_id).'</td>
							    </tr>';
							}

						@endphp

						<div class="row exclude-from-print mt-5">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header align-items-center d-flex">
										<h4 class="card-title mb-0 flex-grow-1" id="headingDate">{{$filterStartDate->format('l, F j, Y')}} to {{$filterEndDate->format('l, F j, Y')}}</h4>
									</div><!-- end card header -->
									<div class="card-body">
										<input type="hidden" id="type" value="">
									    <div class="live-preview">
											<div class="membership-expirations-table">
												<div class="table-responsive">
													<h4 class="card-title mb-10 mt-10 flex-grow-1 text-left" > Single Payment Membership: Infant(${{$infant}}) Kids (${{$child}}) Adults (${{$adult}})  Total (${{$singlePmt}})</h4>
													<table class="table mb-10">
														<thead>
															<tr>
																<th>No</th>
																<th>Program Name</th>
																<th>Membership Type</th>
																<th>Membership For</th>
																<th>Price</th>
																<th>Qty</th>
																<th>Revenue</th>
															</tr>
														</thead>
														<tbody>
															@if($memberships->isEmpty())
													            <tr><td colspan="7">No Membership Available.</td></tr>
													        @else
													        	{!!$tdMembership!!}
													        @endif
														</tbody>
													</table>
												</div>

												<div class="table-responsive">
													<h4 class="card-title mb-10 mt-10 flex-grow-1 text-left" >Recurring Membership:  Infant(${{$infantR}}) Kids (${{$childR}}) Adults (${{$adultR}})  Total (${{$recurringPmt}})</h4>
													<table class="table mb-10">
														<thead>
															<tr>
																<th>No</th>
																<th>Program Name</th>
																<th>Membership Type</th>
																<th>Membership For</th>
																<th>Price</th>
																<th>Qty</th>
																<th>Revenue</th>
															</tr>
														</thead>
														<tbody>
															@if($recurringMemberships->isEmpty())
													            <tr><td colspan="7">No Recurring Membership Available.</td></tr>
													        @else
													        	{!!$tdRevenue!!}
													        @endif
														</tbody>
													</table>
												</div>

												<div class="table-responsive">
													<h4 class="card-title mb-10 mt-10 flex-grow-1 text-left"> Product Shop:  Total Listed ({{$totalListed}})</h4>
													<table class="table mb-10">
														<thead>
															<tr>
																<th>No</th>
																<th>Product Name</th>
																<th>Product info</th>
																<th>Price</th>
																<th>Qty</th>
																<th>Revenue</th>
															</tr>
														</thead>
														<tbody>
															@if($products->isEmpty())
													            <tr><td colspan="7">No Product Available.</td></tr>
													        @else
													        	{!!$tdProduct!!}
													        @endif
														</tbody>
													</table>
												</div>

												<div class="table-responsive">
													<h4 class="card-title mb-10 mt-10 flex-grow-1 text-left"> Revenue Breakdown</h4>
													<table class="table mb-10">
														<thead>
															<tr>
																<th>Infant</th>
																<th>Kids</th>
																<th>Adults</th>
																<th>Classes</th>
																<th>Personal Training</th>
																<th>Experience</th>
																<th>Events</th>
																<th>Product</th>
																<th>Recurring</th>
																<th>Single Payment</th>
																<th>Total</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>${{$infantRevenue}}</td>
																<td>${{$childRevenue}}</td>
																<td>${{$adultRevenue}}</td>
																<td>${{$revenueTotals['Classes']}}</td>
																<td>${{$revenueTotals['Personal Training']}}</td>
																<td>${{$revenueTotals['Experience']}}</td>
																<td>${{$revenueTotals['Events']}}</td>
																<td>${{$productRevenue}}</td>
																<td>${{$recurringPmt}}</td>
																<td>${{$singlePmt}}</td>
																<td>${{$grandTotal}}</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							@if(empty($memberships))
							<div class="col-xl-12">
								<div class="card">
									<div class="mt-10 mb-10 ml-5">
										<span class="mr-10 ml-5" >No Bookings To Display</span>
									</div>
								</div>
							</div>
							@endif
						</div>					
					</div> 
	               </div> 
            	</div>
         	</div><!-- container-fluid -->
       	</div><!-- End Page-content -->
    </div><!-- end main content-->
</div><!-- END layout-wrapper -->
    
@include('layouts.business.footer')
@include('layouts.business.scripts')
	
@php $downloadUrl = route("business.membership_revenue.export"); @endphp

@include('business.reports.script',['filterStartDate'=>$filterStartDate ,'filterEndDate' =>$filterEndDate ,'page' => '','excelFileName' =>'Membership-Revenue.xlsx','pdfFileName' =>'Membership-Revenue.pdf' ,'downloadUrl' =>$downloadUrl ])


@endsection