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
										<label>Memberships Paused</label>
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
																	<option value="category" {{request()->filterOptions == 'category' ? 'selected' : ''}}>Booking By Category</option>
																	<option value="service" {{request()->filterOptions == 'service' ? 'selected' : ''}}>Booking By Service</option>
																	<option value="priceOption" {{request()->filterOptions == 'priceOption' ? 'selected' : ''}}>Booking By Price Option</option>
																</select>
															</div>
														</div>
													</div>

													<div class="d-flex align-items-center mb-25">
														<div class="avatar-sm flex-shrink-0">
															<span class="avatar-title bg-primary rounded-circle fs-2">3</span>
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
															<button type="button" class="btn btn-black w-100 mb-25" onclick="exportData();">Go!</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row exclude-from-print mt-5">
								@foreach($sortedDates as $y=>$date)
								@php 
									$bookingData = clone $bookings; // Create a fresh copy of the query
					        		$bookingData = $bookingData->whereDate('suspend_started',$date->format('Y-m-d'))->get();
								@endphp
								@if($bookingData->isNotEmpty())
									<div class="col-xl-12">
										<div class="card">
											<div class="card-header align-items-center d-flex">
												<h4 class="card-title mb-0 flex-grow-1" id="headingDate">{{$date->format('l, F j, Y')}}  </h4>
											</div><!-- end card header -->
											<div class="card-body">
												<input type="hidden" id="type" value="">
											   <div class="live-preview">
													<div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting">
														@if(request()->filterOptions == 'service')
															@php
																$bookingService = [];
																$bookingData = $bookingData->filter(function ($item) {
													            return $item->business_services_with_trashed;
													         });
																foreach ($bookingData as $key => $dt){
	                                        			$bookingService[$dt->business_services_with_trashed->program_name][] = $dt;
												          	}
												         @endphp
												         @if(count($bookingService) > 0 )
												         	@php $counter = 0; $displayChk = 0; @endphp
												         	@foreach($bookingService as $i=>$data)
												         	<div class="accordion-item shadow">
	                                                <h2 class="accordion-header" id="headingS{{$counter}}{{$y}}">
	                                                   <button class="accordion-button collapsed buttonaccodian" type="button" data-bs-toggle="collapse" data-bs-target="#collapseS{{$counter}}{{$y}}" aria-expanded="false" aria-controls="collapseS{{$counter}}{{$y}}">{{$i}}</button>
	                                                </h2>
	                                                <div id="collapseS{{$counter}}{{$y}}" class="accordion-collapse collapse buttonaccodiandiv" aria-labelledby="headingS{{$counter}}{{$y}}" data-bs-parent="#default-accordion-example">
	                                                   <div class="accordion-body">
	                                                   	@include('business.reports.booking.booking_detail',['bookDetails' =>$data,'dateKey' =>$y ,'loopkey'=>$counter])
	                                                   </div>
	                                                </div>
	                                             </div>
	                                             @php $counter++; @endphp
	                                             @endforeach
	                                          @endif
	                                       @elseif(request()->filterOptions == 'category')
															@php
																$bookingCategory = [];
																$bookingData = $bookingData->filter(function ($item) {
													            return $item->business_price_detail_with_trashed && $item->business_price_detail_with_trashed->business_price_details_ages_with_trashed;
													         });
																foreach ($bookingData as $key => $dt){
	                                        			$bookingCategory[$dt->business_price_detail_with_trashed->business_price_details_ages_with_trashed->category_title][] = $dt;
												          	}
												         @endphp
												         @if(count($bookingCategory) > 0 )
												         	@php $counter = 0; $displayChk = 0; @endphp
												         	@foreach($bookingCategory as $i=>$data)
												         	<div class="accordion-item shadow">
	                                                <h2 class="accordion-header" id="headingC{{$counter}}{{$y}}">
	                                                   <button class="accordion-button collapsed buttonaccodian" type="button" data-bs-toggle="collapse" data-bs-target="#collapseC{{$counter}}{{$y}}" aria-expanded="false" aria-controls="collapseC{{$counter}}{{$y}}">{{$i}}</button>
	                                                </h2>
	                                                <div id="collapseC{{$counter}}{{$y}}" class="accordion-collapse collapse buttonaccodiandiv" aria-labelledby="headingC{{$counter}}{{$y}}" data-bs-parent="#default-accordion-example">
	                                                   <div class="accordion-body">
	                                                   	@include('business.reports.booking.booking_detail',['bookDetails' =>$data,'dateKey' =>$y ,'loopkey'=>$counter])
	                                                   </div>
	                                                </div>
	                                             </div>
	                                             @php $counter++; @endphp
	                                             @endforeach
	                                          @endif
	                                       @elseif(request()->filterOptions == 'priceOption')
															@php
																$bookingPriceOption = [];
																$bookingData = $bookingData->filter(function ($item) {
													            return $item->business_price_detail_with_trashed;
													         });
																foreach ($bookingData as $key => $dt){
	                                        			$bookingPriceOption[$dt->business_price_detail_with_trashed->price_title][] = $dt;
												          	}
												         @endphp
												         @if(count($bookingPriceOption) > 0 )
												         	@php $counter = 0; $displayChk = 0; @endphp
												         	@foreach($bookingPriceOption as $i=>$data)
												         	<div class="accordion-item shadow">
	                                                <h2 class="accordion-header" id="headingOP{{$counter}}{{$y}}">
	                                                   <button class="accordion-button collapsed buttonaccodian" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOP{{$counter}}{{$y}}" aria-expanded="false" aria-controls="collapseOP{{$counter}}{{$y}}">{{$i}}</button>
	                                                </h2>
	                                                <div id="collapseOP{{$counter}}{{$y}}" class="accordion-collapse collapse buttonaccodiandiv" aria-labelledby="headingOP{{$counter}}{{$y}}" data-bs-parent="#default-accordion-example">
	                                                   <div class="accordion-body">
	                                                   	@include('business.reports.booking.booking_detail',['bookDetails' =>$data,'dateKey' =>$y ,'loopkey'=>$counter])
	                                                   </div>
	                                                </div>
	                                             </div>
	                                             @php $counter++; @endphp
	                                             @endforeach
	                                          @endif
														@else
															@php $displayChk = 0; @endphp
															@include('business.reports.booking.booking_detail',['bookDetails' =>$bookingData,'dateKey' =>$y])
														@endif
													</div>
												</div>
											</div>
										</div>
									</div>
								@endif
								@endforeach

								@if(@$displayChk == 1)
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
	
@include('business.reports.membership.membership_script',['filterStartDate'=>$filterStartDate ,'filterEndDate' =>$filterEndDate ,'page' => ''])

@endsection