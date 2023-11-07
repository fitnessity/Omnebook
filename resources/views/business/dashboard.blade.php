@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>

    <meta charset="utf-8" />
    <title>Fitnessity </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">


    <!-- Layout config Js-->
    <script src="{{asset('/public/dashboard-design/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('/public/dashboard-design/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/public/dashboard-design/css/simplebar.min.css')}}" rel="stylesheet" type="text/css" />
	
    <!-- Style Css-->
    <link href="{{asset('/public/dashboard-design/css/style.css')}}" rel="stylesheet" type="text/css" />
	
	<!-- Custom Css-->
    <link href="{{asset('/public/dashboard-design/css/custom.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('/public/dashboard-design/css/responsive.css')}}" rel="stylesheet" type="text/css" />
	
	<!-- icon -->
	<link rel="stylesheet" type="text/css" href="{{asset('/public/dashboard-design/css/icons.min.css')}}" />

</head>
	
@section('content')

    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.business.business_topbar')

        <!-- ========== App Menu ========== -->
        @include('layouts.business.businesssidebar')
        <!-- Left Sidebar End -->

        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div class="h-100">
                                <div class="row mb-3 pb-1">
                                    <div class="col-12">
                                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                            <div class="flex-grow-1">
                                                @php 
                                                    if(session('StaffLogin') != '') {
                                                        $staff = App\BusinessStaff::find(session('StaffLogin'));
                                                        $name = ucwords(@$staff->full_name);
                                                    }else {
                                                        $name = ucwords(Auth::user()->full_name);
                                                    }
                                                @endphp
                                                <h4 class="fs-16 mb-1">Good Morning, {{$name}} </h4>
                                                <p class="text-muted mb-0">Here's a snap shot of what's happening with <b>{{ ucwords($dba_business_name)}}</b> today.</p>
                                            </div>
                                            <div class="mt-3 mt-lg-0">
                                                <form action="javascript:void(0);">
                                                    <div class="row g-3 mb-0 align-items-center">
                                                        <div class="col-sm-auto">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-range"  data-range-date="true" data-date-format="d M, Y" >
                                                                <div class="input-group-text bg-primary border-primary text-white">
                                                                    <i class="ri-calendar-2-line"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-auto">
                                                            <button type="button" class="btn btn-soft-success shadow-none"><i class="ri-add-circle-line align-middle me-1"></i> Add Product</button>
                                                        </div> -->
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn shadow-none"><i class="ri-pulse-line"></i></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="white-box flex-grow-1 overflow-hidden">
                                                        <p class="fw-medium text-muted text-truncate mb-0"> Total Sales | Month</p>
                                                    </div>
                                                    <div class="increase flex-shrink-0">
                                                        @if($totalsalePercentage < 0)
                                                            <h5 class="text-danger fs-14 mb-0">
                                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i> {{$totalsalePercentage}} % </h5> <p>Decrease</p>
                                                        @else
                                                            <h5 class="text-success fs-14 mb-0">
                                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> + {{$totalsalePercentage}} % </h5> <p>Increase</p>
                                                        @endif 
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="{{$totalSales}}">{{$totalSales}}</span></h4>
                                                        <a href="{{route('business.sales_report.index')}}" target="_blank" class="text-decoration-underline">View Sales Report</a>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-success rounded fs-3">
                                                            <i class="bx bx-dollar-circle"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->

                                    <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="white-box flex-grow-1 overflow-hidden">
                                                        <p class="fw-medium text-muted text-truncate mb-0">Total Bookings | Month</p>
                                                    </div>
                                                    <div class="decrease flex-shrink-0">
                                                        @if($bookingCountPercentage < 0)
                                                            <h5 class="text-danger fs-14 mb-0">
                                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i> {{$bookingCountPercentage}} % </h5> <p>Decrease</p>
                                                        @else
                                                            <h5 class="text-success fs-14 mb-0">
                                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> + {{$bookingCountPercentage}} % </h5> <p>Increase</p>
                                                        @endif 
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$bookingCount}}">{{$bookingCount}}</span></h4>
                                                        <a href="{{route('business.schedulers.index',['business_id'=>$business_id])}}" class="text-decoration-underline" target="_blank">View Bookings</a>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-info rounded fs-3">
                                                            <i class="bx bx-shopping-bag"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->

                                    <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="white-box flex-grow-1 overflow-hidden">
                                                        <p class="fw-medium text-muted text-truncate mb-0">Customers | Month</p>
                                                    </div>
                                                    <div class="increase flex-shrink-0">
                                                        @if($customerCountPercentage < 0)
                                                            <h5 class="text-danger fs-14 mb-0">
                                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i> {{$customerCountPercentage}} % </h5> <p>Decrease</p>
                                                        @else
                                                            <h5 class="text-success fs-14 mb-0">
                                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> + {{$customerCountPercentage}} % </h5> <p>Increase</p>
                                                        @endif 
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$customerCount}}">{{$customerCount}}</span></h4>
                                                        <a href="{{route('business_customer_index')}}" target="_blank" class="text-decoration-underline">View Customers</a>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-warning rounded fs-3">
                                                            <i class="bx bx-user-circle"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->

                                    <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="white-box flex-grow-1 overflow-hidden">
                                                        <p class="fw-medium text-muted text-truncate mb-0"> Store Sales | Month</p>
                                                    </div>
                                                    <div class="decrease flex-shrink-0">
                                                       <h5 class="text-danger fs-14 mb-0">
                                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i> -3.57 %
                                                        </h5>
														<p>Decrease</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="0">0</span></h4>
                                                        <a href="" target="_blank" class="text-decoration-underline">View Sales Report</a>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-danger rounded fs-3">
                                                            <i class="bx bx-wallet"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->
                                </div> <!-- end row-->

                                <div class="row">
                                    <div class="col-xl-8">
                                        <div class="card">
                                            <div class="card-header border-0 align-items-center d-flex flip-view">
                                                <h4 class="card-title mb-0 flex-grow-1">Revenue Goal Tracker </h4>
												 <h4 class="card-title mb-0 flex-grow-1">Current Month: {{date('M')}} of {{date('Y')}} </h4>
                                                <div>
													 <button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
                                                        1M
                                                    </button>
													<button type="button" class="btn btn-soft-primary btn-sm shadow-none">
                                                        1Y
                                                    </button>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
                                                        ALL
                                                    </button>
                                                </div>
                                            </div><!-- end card header -->

                                            <div class="card-header p-0 border-0 bg-soft-light">
                                                <div class="row g-0 text-center">
                                                    <div class="col-6 col-sm-3">
                                                        <div class="p-3 border border-dashed border-start-0">
															<h5 class="mb-1">$<span class="counter-value" data-target="30000">0</span></h5>
                                                            <p class="text-muted mb-0 revenue">Revenue Needed To Goal</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
													
                                                    <div class="col-6 col-sm-3">
                                                        <div class="p-3 border border-dashed border-start-0" style="padding: 0.4rem!important">
															<div class="flex-shrink-0">
																<div id="total_jobs" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
															</div>
                                                            <!-- <h5 class="mb-1">$<span class="counter-value" data-target="30000">0</span></h5> -->
                                                            <p class="text-muted mb-0 revenue">% of Revenue Acheived</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-sm-3">
                                                        <div class="p-3 border border-dashed border-start-0">
                                                            <h5 class="mb-1">$<span class="counter-value" data-target="2500">0</span></h5>
                                                            <p class="text-muted mb-0 revenue">Revenue Needed Per Day</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-sm-3">
                                                        <div class="p-3 border border-dashed border-start-0 border-end-0">
                                                            <h5 class="mb-1">$<span class="counter-value" data-target="16400">0</span></h5>
                                                            <p class="text-muted mb-0 revenue">Revenue You Should Be At Today</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                            </div><!-- end card header -->

                                            <div class="card-body p-0 pb-2">
                                                <div class="w-100">
                                                    <div id="projects-overview-chart" data-colors='["--vz-primary", "--vz-warning", "--vz-success"]' class="apex-charts" dir="ltr"></div>
                                                </div>
												<div class="text-center">
													<a class="text-decoration-underline" href="#" data-bs-toggle="modal" data-bs-target=".monthly-financial">Manage Goals</a>
												</div>
                                            </div><!-- end card body -->
											
										</div><!-- end card -->
										<div class="col-md-12">
											<div class="card padding-15">
												<div class="row">
													<div class="col-lg-4 col-md-6">
														<div class="border-0 align-items-center text-center mb-15">
															<h4 class="payment-tracker flex-grow-1">Recurring Payments Tracker</h4>
															<h4 class="payment-tracker">
                                                            @if(date('M',strtotime($startDate)) == date('M',strtotime($endDate)) ) 
                                                               {{date('M',strtotime($startDate))}}, {{date('Y',strtotime($startDate))}} 
                                                            @else 
                                                                {{date('M',strtotime($startDate))}} to {{date('M',strtotime($endDate))}},
                                                                {{date('Y',strtotime($startDate))}} 
                                                            @endif</h4>
															<h4 class="fs-22 fw-semibold ff-secondary scheduled-payments">$<span class="counter-value" data-target="{{$totalRecurringPmt}}">{{$totalRecurringPmt}}</span></h4>
															<p class="mb-0">Scheduled Payments </p>
														</div>
													</div>
													<div class="col-lg-4 col-md-6">
														<div class="border-0 align-items-center">
															<div class="card card-animate overflow-hidden set-data mb-15">
																<div class="position-absolute start-0" style="z-index: 0;">
																	<svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
																		<style>
																			.s0 {
																				opacity: .05;
																				fill: var(--vz-info)
																			}
																		</style>
																		<path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z" />
																	</svg>
																</div>
																<div class="card-body" style="z-index:1 ;">
																	<div class="d-flex align-items-center">
																		<div class="flex-grow-1 overflow-hidden">
																			<h4 class="fs-15 fw-semibold ff-secondary mb-3">$<span class="counter-value" data-target="{{$compltedpmtcnt}}">{{$compltedpmtcnt}}</span></h4>
																			<p class="fw-medium text-muted text-truncate mb-0">Paid So Far </p>
																		</div>
																		<div class="flex-shrink-0">
																			<div id="new_jobs_chart" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
																		</div>
																	</div>
																</div><!-- end card body -->
															</div>
														</div>
													</div>
													<div class="col-lg-4 col-md-6">
														<div class="border-0 align-items-center">
															<div class="card card-animate overflow-hidden set-data mb-15">
																<div class="position-absolute start-0" style="z-index: 0;">
																	<svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
																		<style>
																			.s0 {
																				opacity: .05;
																				fill: var(--vz-info)
																			}
																		</style>
																		<path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z" />
																	</svg>
																</div>
																<div class="card-body" style="z-index:1 ;">
																	<div class="d-flex align-items-center">
																		<div class="flex-grow-1 overflow-hidden">
																			<h4 class="fs-15 fw-semibold ff-secondary mb-3">$<span class="counter-value" data-target="{{$remainigpmtcnt}}">{{$remainigpmtcnt}}</span></h4>
																			<p class="fw-medium text-muted text-truncate mb-0">Owed </p>
																		</div>
																		<div class="flex-shrink-0">
																			<div id="rejected_chart" data-colors='["--vz-danger"]' class="apex-charts" dir="ltr"></div>
																		</div>
																	</div>
																</div><!-- end card body -->
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
                                    </div><!-- end col -->

                                    <div class="col-xl-4">
										<div class="card">
											<div class="card-header border-0">
												<div class="row">
													<div class="col-6">
														<h4 class="card-title mb-15 calendar-title">Todays Schedule</h4>
													</div>
												</div>
												<div class=" pt-0">
													<div class="upcoming-scheduled mb-55 position-relative">
														<input type="text" class="form-control flatpickr-schedule"   data-deafult-date="today" data-inline-date="true" data-min-date="{{date('d M, Y')}}">
													</div>
													<div class="dropdown-activity mt-4 mb-3">
														<a class="alinkdrop dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Show All Activites</a>
														<ul class="dropdown-menu activityschedule" aria-labelledby="dropdownMenuButton1">
															<li><a class="dropdown-item">Show All Activites</a></li>
															<li><a class="dropdown-item">Personal Training</a></li>
															<li><a class="dropdown-item">Classes</a></li>
															<li><a class="dropdown-item">Events</a></li>
															<li><a class="dropdown-item">Experience</a></li>
														</ul>
													</div>
													<div class="scheduledata">
														@if(!empty($activitySchedule) && count($activitySchedule)>0)
															@foreach($activitySchedule as $as)
																@php 
																	$SpotsLeftdis = 0;
																	$bs = new  \App\Repositories\BookingRepository;
																	$bookedspot = $bs->gettotalbooking($as->id,date('Y-m-d')); 
																	$SpotsLeftdis = $as->spots_available - $bookedspot; 
																@endphp
															<div class="mini-stats-wid d-flex align-items-center mt-3">
																<div class="flex-shrink-0 avatar-sm">
																	<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-success fs-4 multiple-activites">
																		{{$SpotsLeftdis}}/{{$as->spots_available}} 
																		<label>Spots left</label>
																	</span>
																</div>
																<div class="flex-grow-1 ms-3 activity-info">
																	<h6 class="mb-1">{{@$as->business_service->program_name}}</h6>
																	<p class="text-muted mb-0">{{@$as->businessPriceDetailsAges->category_title}}</p>
																	<p class="text-muted mb-0">{{@$as->business_service->price_details()->first()->price_title}}</p>
																</div>
																<div class="flex-shrink-0 ms-3">
																	<p class="text-muted mb-0 color-black">{{date('h:i A', strtotime($as->shift_start))}}</p>
																	<p class="text-muted mb-0 color-black">{{date('h:i A', strtotime($as->shift_end))}}</p>
																</div>
															</div><!-- end -->
															@endforeach
														@endif	
													</div>
													<div class="mt-3 text-center">
														<a href="{{route('business.schedulers.index',['business_id'=> $business_id])}}" class="text-muted text-decoration-underline">View Full Schedule</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								
								<div class="row">
									<div class="col-lg-3 col-md-6">
										<div class="card">
											<div class="card-header align-items-center d-flex">
												<h4 class="card-title mb-0 flex-grow-1">Bookings & Revenue By Category</h4>
												<div class="flex-shrink-0">
                                                    <button type="button" class="btn btn-soft-secondary btn-sm shadow-none" onclick="makeDonutChart('1','category','{{$startDate}}','{{$endDate}}')">
                                                        1 M
                                                    </button>
													<button type="button" class="btn btn-soft-primary btn-sm shadow-none" onclick="makeDonutChart('all','category','{{$startDate}}','{{$endDate}}')">
                                                        All
                                                    </button>
                                                </div>
											</div><!-- end card header -->
											<div class="card-body">
												<div id="cat_d_crt">
													<div id="updating_donut_chart" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div> 
												</div>
											</div><!-- end card-body -->
										</div>
									</div>
									<div class="col-lg-3 col-md-6">
										<div class="card">
											<div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Bookings & Revenue Source</h4>
                                                <div class="flex-shrink-0">
                                                    <button type="button" class="btn btn-soft-secondary btn-sm shadow-none" onclick="makeDonutChart('1','revenue','{{$startDate}}','{{$endDate}}')">
                                                        1 M
                                                    </button>
													<button type="button" class="btn btn-soft-primary btn-sm shadow-none"  onclick="makeDonutChart('all' ,'revenue','{{$startDate}}','{{$endDate}}')">
                                                        All
                                                    </button>
                                                </div>
                                            </div><!-- end card header -->
											<div class="card-body">
												<div id="rev_d_crt">
													<div id="revenue_donut_chart" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
												</div>
												<div class="col-md-12 text-center">
													<a href="{{route('personal.orders.index',['business_id'=>$business_id])}}" target="_blank">View Bookings</a>
												</div>
											</div><!-- end card-body -->
										</div>
									</div>
									<div class="col-lg-6 col-md-12">
										<div class="card">
                                            <div class="card-header align-items-center d-flex flip-view">
                                                <h4 class="card-title mb-0 flex-grow-1">Expiring Memberships & Packages</h4>
                                                <div class="flex-shrink-0">
                                                    <button type="button" class="btn btn-soft-primary btn-sm shadow-none" onclick="getExpiringMembership('30','{{$startDate}}','{{$endDate}}')">
                                                        30D
                                                    </button>
													<button type="button" class="btn btn-soft-secondary btn-sm shadow-none" onclick="getExpiringMembership('90','{{$startDate}}','{{$endDate}}')">
                                                        90D
                                                    </button>
													<!-- <button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
                                                        All
                                                    </button> -->
                                                </div>
                                            </div><!-- end card header -->
											<div class="month-year align-items-center d-flex flip-view">
                                                <h4 class="card-title mb-0 flex-grow-1">{{date('M')}}, {{date('Y')}}</h4>
                                                <div class="flex-shrink-0">
                                                    <h4 class="card-title mb-0 flex-grow-1 expiring-text">Expiring in the next 30 days</h4>
                                                </div>
                                            </div>

                                            <div class="card-body">
                                                <div class="table-responsive table-card table-custom-dash">
                                                    <table class="table table-hover table-centered align-middle table-nowrap mb-0 memberships-pack">
														<thead>
															<tr>
																<td>No</td>
																<td>Name</td>
																<td>Membership Type</td>
																<td>Started on</td>
																<td>End on</td>
																<td>Action</td>
															</tr>
														</thead>
                                                        <tbody id="ExpiringMembership">
                                                        	@if(!empty($expiringMembership) && count($expiringMembership) >0)
	                                                        	@foreach($expiringMembership as $key=>$emp )
                                                                @if($emp->Customer != '' && $emp->business_price_detail != '')
	                                                            <tr>
	                                                                <td>
	                                                                   <h5 class="fs-14 my-1 fw-normal">{{ $key+1}}</h5>
	                                                                </td> 

	                                                                <td>
	                                                                   <h5 class="fs-14 my-1 fw-normal">{{@$emp->Customer->full_name}} </h5>
	                                                                </td>
	                                                                <td>
	                                                                   <h5 class="fs-14 my-1 fw-normal">@if(@$emp->business_price_detail()->exists()) {{ @$emp->business_price_detail->price_title}} @endif</h5>
	                                                                </td>
	                                                                <td>
	                                                                   <h5 class="fs-14 my-1 fw-normal">{{date('m-d-Y', strtotime($emp->contract_date))}} </h5>  
	                                                                </td>
	                                                                <td>
	                                                                    <h5 class="fs-14 my-1 fw-normal">{{date('m-d-Y', strtotime($emp->expired_at))}}  </h5>
	                                                                </td>
	                                                                <td>
	                                                                   <a href="{{route('business_customer_show',['business_id'=>$emp->business_id,'id'=>@$emp->Customer->id])}}"> View </a>
	                                                                </td>
	                                                            </tr>
                                                                @endif
	                                                            @endforeach
	                                                        @else
	                                                         	<tr>
	                                                                <td>
	                                                                   <h5 class="fs-14 my-1 fw-normal">No Membership expires this month</h5>
	                                                                </td>
	                                                            </tr>
															@endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
									</div>
								</div>
								</div>
							</div> <!-- end .h-100-->
                        </div> <!-- end col -->

                        <div class="col-auto layout-rightside-col">
                            <div class="overlay"></div>
                            <div class="layout-rightside">
                                <div class="card h-100 rounded-0">
                                    <div class="card-body p-0">
                                            <div class="p-3">
                                                <h6 class="text-muted mb-0 text-uppercase fw-semibold">Recent Activity</h6>
                                            </div>
                                            <div data-simplebar style="max-height: 410px;" class="p-3 pt-0">
                                                <div class="acitivity-timeline acitivity-main">
                                                    @foreach($todayBooking as $tb)
                                                    <div class="acitivity-item d-flex">
                                                        <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                                                            <div class="avatar-title bg-soft-success text-success rounded-circle shadow">
                                                                <i class="ri-shopping-cart-2-line"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1 lh-base">{{$tb->booking->order_id}}</h6>
                                                            <p class="text-muted mb-1"><b>Activity : </b>{{$tb->business_services->program_name}} </p>
                                                            <p class="text-muted mb-1"><b>Price : </b> ${{$tb->subtotal + $tb->getperoderprice() }}</p>
                                                            <small class="mb-0 text-muted">{{date('H:i A' ,strtotime($tb->created_at))}} Today</small>
                                                        </div>
                                                    </div>
                                                    @endforeach

                                                    @foreach($notificationAry as $nd)
                                                        <div class="acitivity-item d-flex">
                                                            <div class="flex-shrink-0">
                                                                @if( $nd['image'] != '')
                                                                    <img src="{{$nd['image']}}" alt="" class="avatar-xs rounded-circle acitivity-avatar shadow" />
                                                                @else
                                                                    <div class="avatar-xsmall">
                                                                       <span class="mini-stat-icon avatar-title xsmall-font rounded-circle text-success bg-soft-red fs-4 uppercase">{{$nd['fl']}}</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="flex-grow-1 ms-3 mb-10">
                                                                <h6 class="mb-1 lh-base">{{$nd['title']}}</h6>
                                                                <p class="text-muted mb-2 fst-italic">@if($nd['type'] == 'comment') "{{$nd['text']}}" @else {!!$nd['text'] !!} @endif</p>
                                                                <small class="mb-0 text-muted">{{$nd['date']}}</small>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                    @if(count($notificationAry) == 0 && count($todayBooking) == 0)
                                                       <p class="text-center mb-3">Not Available</p>
                                                    @endif
                                                </div>
                                            </div>
                                        <div class="p-3 mt-2">
                                            <h6 class="text-muted mb-3 text-uppercase fw-semibold">Top Booked Memberships
                                            </h6>
                                            @if(count($topBookedCategories) > 0)
                                                <div class="row mb-10">
                                                    <div class="col-md-6 col-6">
														<span class="font-weight-600 color-grey"> Category Name</span>
													</div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="row">
                                                            <div class="col-md-5 col-5">
																<span class="font-weight-600 color-grey">Paid</span>
															</div>
                                                            <div class="col-md-7 col-7">
																<span class="font-weight-600 color-grey">Booked</span>
															</div>
                                                        </div>
                                                    </div> 
                                                </div>

                                                <div class="row">
                                                    @foreach(@$topBookedCategories as $i=> $tbc)
                                                        @if($i< 10)
                                                        <div class="col-md-6 col-6">
                                                            <span class="text-muted">{{$i+1}}. {{$tbc['name']}} </span>
                                                        </div>
                                                        <div class="col-md-6 col-6">
                                                            <div class="row">
                                                                <div class="col-md-6 col-6">
                                                                    <span class="text-muted">${{$tbc['paid']}}</span>
                                                                </div>
                                                                <div class="col-md-6 col-6">
                                                                    <span class="text-muted">{{$tbc['booked']}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @else
                                                <span>No Categories Available </span>
                                            @endif
                                        </div>

                                        <!--<div class="p-3">
                                            <h6 class="text-muted mb-3 text-uppercase fw-semibold">Products Reviews</h6>
                                           
                                            <div class="swiper vertical-swiper" style="height: 250px;">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <div class="card border border-dashed shadow-none">
                                                            <div class="card-body">
                                                                <div class="d-flex">
                                                                    <div class="flex-shrink-0 avatar-sm">
                                                                        <div class="avatar-title bg-light rounded shadow">
                                                                            <img src="" alt="" height="30">
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <div>
                                                                            <p class="text-muted mb-1 fst-italic text-truncate-two-lines"> " Great product and looks great, lots of features. "</p>
                                                                            <div class="fs-11 align-middle text-warning">
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="text-end mb-0 text-muted">
                                                                            - by <cite title="Source Title">Force Medicines</cite>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <div class="card border border-dashed shadow-none">
                                                            <div class="card-body">
                                                                <div class="d-flex">
                                                                    <div class="flex-shrink-0">
                                                                        <img src="" alt="" class="avatar-sm rounded shadow">
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <div>
                                                                            <p class="text-muted mb-1 fst-italic text-truncate-two-lines"> " Amazing template, very easy to understand and manipulate. "</p>
                                                                            <div class="fs-11 align-middle text-warning">
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-half-fill"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="text-end mb-0 text-muted">
                                                                            - by <cite title="Source Title">Henry Baird</cite>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <div class="card border border-dashed shadow-none">
                                                            <div class="card-body">
                                                                <div class="d-flex">
                                                                    <div class="flex-shrink-0 avatar-sm">
                                                                        <div class="avatar-title bg-light rounded shadow">
                                                                            <img src="" alt="" height="30">
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <div>
                                                                            <p class="text-muted mb-1 fst-italic text-truncate-two-lines"> "Very beautiful product and Very helpful customer service."</p>
                                                                            <div class="fs-11 align-middle text-warning">
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-line"></i>
                                                                                <i class="ri-star-line"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="text-end mb-0 text-muted">
                                                                            - by <cite title="Source Title">Zoetic Fashion</cite>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <div class="card border border-dashed shadow-none">
                                                            <div class="card-body">
                                                                <div class="d-flex">
                                                                    <div class="flex-shrink-0">
                                                                        <img src="" alt="" class="avatar-sm rounded shadow">
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <div>
                                                                            <p class="text-muted mb-1 fst-italic text-truncate-two-lines">" The product is very beautiful. I like it. "</p>
                                                                            <div class="fs-11 align-middle text-warning">
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-half-fill"></i>
                                                                                <i class="ri-star-line"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="text-end mb-0 text-muted">
                                                                            - by <cite title="Source Title">Nancy Martino</cite>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->

                                        <div class="p-3">
                                            <h6 class="text-muted mb-3 text-uppercase fw-semibold">Recent activity reviews</h6>
                                            
                                            @foreach($services as $service)
                                                @php  
                                                    $rating =0;
                                                    $reviews_count = App\BusinessServiceReview::where('service_id', $service->id)->count();
                                                    $reviews_sum = App\BusinessServiceReview::where('service_id', $service->id)->sum('rating'); 
                                                    $rating = $reviews_count != 0 ? round($reviews_sum/$reviews_count,2) : 0;
                                                @endphp
                                                <h6 class="text-muted mb-3 fw-semibold mt-5">{{$service->program_name}} activity reviews</h6>
                                                <div class="bg-light px-3 py-2 rounded-2 mb-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <div class="fs-16 align-middle text-warning">
                                                                @for($i= 1;$i<=$rating;$i++)
                                                                    @if($i>5)
                                                                        @break(0);
                                                                    @endif
                                                                    <i class="ri-star-fill"></i>
                                                                @endfor

                                                                @if(5-$rating > 0)
                                                                    @for($i= 1;$i<=5-$rating;$i++)
                                                                        @if($rating - $i == 0.5)
                                                                            <i class="ri-star-half-fill"></i>
                                                                        @endif
                                                                    @endfor
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <h6 class="mb-0">{{$rating}} out of 5</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            
                                        </div>

                                        <div class="card sidebar-alert bg-light border-0 text-center mx-4 mb-0 mt-3">
                                            <div class="card-body">
                                                <img src="" alt="">
                                                <div class="mt-4">
                                                    <h5>Refer Another Provider</h5>
                                                    <p class="text-muted lh-base"> Get a Free Month membership for each provider you refer and they claim or create a business account with Fitnessity</p>
                                                    <button type="button" class="btn btn-red">Invite Now</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div> <!-- end card-->
                            </div> <!-- end .rightbar-->
                        </div> <!-- end col -->
                    </div>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
	
<div class="modal fade monthly-financial" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-80">
		<div class="modal-content">
			<div class="modal-header p-3">
				<h5 class="modal-title" id="exampleModalLabel">Set & Track Your Monthly Financials Goals for {Year}</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
			</div>
			<form action="http://dev.fitnessity.co/business/68/staff" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-3">
							<div class="track-goal form-group mb-10">
								<label>January</label>
								<input type="text" class="form-control" name="jan" required="">
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<div class="track-goal form-group mb-10">
								<label>February</label>
								<input type="text" class="form-control" name="fab" required="">
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<div class="track-goal form-group mb-10">
								<label>March</label>
								<input type="text" class="form-control" name="march" required="">
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<div class="track-goal form-group mb-10">
								<label>April</label>
								<input type="text" class="form-control" name="april" required="">
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<div class="track-goal form-group mb-10">
								<label>May</label>
								<input type="text" class="form-control" name="may" required="">
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<div class="track-goal form-group mb-10">
								<label>June</label>
								<input type="text" class="form-control" name="june" required="">
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<div class="track-goal form-group mb-10">
								<label>July</label>
								<input type="text" class="form-control" name="july" required="">
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<div class="track-goal form-group mb-10">
								<label>August</label>
								<input type="text" class="form-control" name="august" required="">
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<div class="track-goal form-group mb-10">
								<label>September</label>
								<input type="text" class="form-control" name="september" required="">
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<div class="track-goal form-group mb-10">
								<label>October</label>
								<input type="text" class="form-control" name="october" required="">
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<div class="track-goal form-group mb-10">
								<label>November</label>
								<input type="text" class="form-control" name="november" required="">
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<div class="track-goal form-group mb-10">
								<label>December</label>
								<input type="text" class="form-control" name="december" required="">
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<div class="yearly-total form-group mb-10">
								<label class="font-red text-decoration">Yearly Total</label>
								<input type="text" class="form-control" name="yearly-total" required="" readonly>
							</div>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<div class="hstack gap-2 justify-content-end">
						<button type="submit" class="btn btn-red">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
	@include('layouts.business.footer')

	<script type="text/javascript">
		flatpickr(".flatpickr-schedule", {
	        inline: true,
	        dateFormat: "Y-m-d",
	        maxDate: "2050-01-01",
	        onChange: function(selectedDates, dateStr, instance) {
	        	var type = $('.dropdown-toggle').text();
		       	activityschedule(type,dateStr);
		    },
	     });
        date1 = '{{$startDateCalendar}}';
        date2 = '{{$endDateCalendar}}';
		flatpickr(".flatpickr-range", {
	        mode:  "range",
	        dateFormat: "m-d-Y",
	        maxDate: "01-01-2050",
            defaultDate: [date1, date2],
            onChange: function(selectedDates, dateStr, instance) {
                window.location.href= '/dashboard/'+dateStr;
            },
	     });


		function activityschedule(type,date){
			$.ajax({
		  		type: "post",
	            url: "{{route('getscheduleactivity')}}",
	            data: {
	            	type: type,
	            	date: date,
	            	_token: $('meta[name="csrf-token"]').attr('content')
	            },
	            success: function(data){
	            	$('.scheduledata').html(data);
	            }
		  	});
		}

		$(".activityschedule li a").click(function(){
		  	var selText = $(this).text();
		  	$(this).parents('.dropdown-activity').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
		  	type = selText;
		  	if(selText == 'Personal Training'){
		  		type = 'individual';
		  	}
		  	activityschedule(type,'');
		});

		$( document ).ready(function() {
		    draw_chart_donut_revenue({{$in_person}}, {{$online}},'');
		    draw_chart_donut_category({{$ptdata}},{{$clsdata}},{{$expdata}},{{$evdata}},{{$prdata}},'');
		    <?php 
		    	$comp_color = $completedtdata <= 20 ? '#FA4443':'#3577f1';
		    	$rem_color = $remainingdata <= 20 ? '#FA4443':'#3577f1';
		    ?>

		    draw_chart_radial_bar({{$completedtdata}},'new_jobs_chart' ,'{{$comp_color}}');
		    draw_chart_radial_bar({{$remainingdata}},'rejected_chart','{{$rem_color}}');
            category =["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
		    draw_chart_combo('','' , category);
		});

		function getExpiringMembership(days,sDate,eDate){
			$('.expiring-text').html('Expiring in the next '+days+' days');
			$.ajax({
		  		type: "post",
	            url: "{{route('getExpiringMembership')}}",
	            data: {
	            	days: days,
	            	_token: $('meta[name="csrf-token"]').attr('content'),
                    startDate: sDate,
                    endDate: eDate,  
	            },
	            success: function(data){
	            	$('#ExpiringMembership').html(data);
	            }
		  	});
		}

		function makeDonutChart(val,type,sDate,eDate)
		{
			$.ajax({
				url:"{{route('bookingchart')}}",
				method:"GET",
				data:{
					val: val,
					type: type,
                    startDate: sDate,
                    endDate: eDate,   
				},
				success:function(data)
				{
					if(type == 'revenue'){
						var in_person =  JSON.parse(data).in_person;
						var online =JSON.parse(data).online;
						draw_chart_donut_revenue(in_person,online,'ajax');
					}else{
						var ptdata =  JSON.parse(data).ptdata;
						var clsdata =JSON.parse(data).clsdata;
						var expdata =JSON.parse(data).expdata;
						var evdata =JSON.parse(data).evdata;
						var prdata =JSON.parse(data).prdata;
						draw_chart_donut_category(ptdata,clsdata,expdata,evdata,prdata,'ajax');
					}
				}
			});
		}

		/*function getRevenueGoal(val)
		{
			$.ajax({
				url:"",
				method:"GET",
				data:{
					val: val,
					type: type
				},
				success:function(data)
				{draw_chart_combo();
				}
			});
		}*/

		function draw_chart_donut_revenue(in_person,online, type) {
			var options = {
	          	series: [in_person, online],
	          	labels: ['In-Person', 'Online'],
	          	chart: {
	          		height: 300,
	          		type: 'donut',
	       	 	},
		        dataLabels: {
		          	enabled: false,
		        },
		        responsive: [{
		          	breakpoint: 480,
		          	options: {
			            legend: {
			              show: false
			            }
		          	}
	        	}],
		        legend: {
		        	position: 'bottom',
		            bottom: 'center', 
		            itemHeight: 8,
		            itemWidth: 8
		        }
	        };
	        if(type == 'ajax'){
	        	$("#revenue_donut_chart").remove();
	        	$("#rev_d_crt").append('<div id="revenue_donut_chart" class="apex-charts" dir="ltr"></div>');
	        }
	        (chart = new ApexCharts(document.querySelector("#revenue_donut_chart"), options)).render();
	        
		}
		
		function draw_chart_donut_category(ptdata,clsdata,expdata,evdata,prdata,type) {
			var options = {
	          	series: [ptdata,clsdata,expdata,evdata,prdata],
	          	labels: ['Personal Training', 'Classes','Experiences','Events','Products'],
	          	chart: {
	          		height: 300,
	          		type: 'donut',
	       	 	},
		        dataLabels: {
		          enabled: false
		        },
		        responsive: [{
		          	breakpoint: 480,
		          	options: {
			            legend: {
			              show: false
			            }
		          	}
	        	}],
		        legend: {
		        	position: 'bottom',
		            bottom: 'center', 
		            itemHeight: 8,
		            itemWidth: 8
		        }
	        };

	        if(type == 'ajax'){
	        	$("#updating_donut_chart").remove();
	        	$("#cat_d_crt").append('<div id="updating_donut_chart" class="apex-charts" dir="ltr"></div>');
	        }
	        (chart = new ApexCharts(document.querySelector("#updating_donut_chart"), options)).render();
		}

		function draw_chart_radial_bar(data,name ,color) {
			var options = {
	          	series: [data],
			    chart: {
			        type: "radialBar",
			        width: 105,
			        sparkline: {
			            enabled: !0
			        }
			    },
			    dataLabels: {
			        enabled: !1
			    },
			    colors: [color],
			    plotOptions: {
			        radialBar: {
			            hollow: {
			                margin: 0,
			                size: "70%"
			            },
			            track: {
			                margin: 1
			            },
			            dataLabels: {
			                show: !0,
			                name: {
			                    show: !1
			                },
			                value: {
			                    show: !0,
			                    fontSize: "16px",
			                    fontWeight: 600,
			                    offsetY: 8
			                }
			            }
			        }
			    },
	        };

	        (chart = new ApexCharts(document.querySelector("#"+name), options)).render();
		}

		function draw_chart_combo(data,type,category){
			var options = {
		        series: [{
	            	name: "Revenue Last Year",
                    type: "bar",
                    data: [1, 65, 46, 68, 49, 61, 42, 44, 78, 52, 63, 67]
                }, {
                    name: "Revenue Goal",
                    type: "bar",
                    data: [ 1, 7, 17, 21, 1, 40, 11, 5, 9, 7, 52, 63]
                }, {
                    name: "Revenue So Far",
                    type: "bar",
                    data: [1, 49, 7, 61, 11, 11, 5, 9, 7, 4, 65, 35]
                }],
                chart: {
                    height: 374,
                    type: "line",
                    toolbar: {
                        show: !1
                    }
                },
                stroke: {
                    curve: "smooth",
                    dashArray: [0, 3, 0],
                    width: [0, 0, 0]
                },
                xaxis: {
                    categories: category,
                    axisTicks: {
                        show: !1
                    },
                    axisBorder: {
                        show: !1
                    }
                },
                legend: {
                    show: !0,
                    horizontalAlign: "center",
                    offsetX: 0,
                    offsetY: -5,
                    markers: {
                        width: 9,
                        height: 9,
                        radius: 6
                    },
                    itemMargin: {
                        horizontal: 10,
                        vertical: 0
                    }
                },
                plotOptions: {
                    bar: {
                        columnWidth: "30%",
                        barHeight: "70%"
                    }
                },
                tooltip: {
                    shared: !0,
                    y: [{
                        formatter: function(e) {
                            return void 0 !== e ? "$" + e.toFixed(2) : e
                        }
                    }, {
                        formatter: function(e) {
                            return void 0 !== e ? "$" + e.toFixed(2)  : e
                        }
                    }, {
                        formatter: function(e) {
                            return void 0 !== e ? "$" + e.toFixed(2) : e
                        }
                    }]
                },
        };
        	(chart = new ApexCharts(document.querySelector("#projects-overview-chart"), options)).render();
		}

        var radialBar = ( options = {
	        series: [80],
	        chart: {
		      	width: 70,
		        type: 'radialBar',
		        sparkline: {
		            enabled: !0
		        }
        	},
        	dataLabels: {
		       enabled: !1
		    },
		    plotOptions: {
		        radialBar: {
		            hollow: {
		                margin: 0,
		                size: "60%"
		            },
		            track: {
		                margin: 1
		            },
		            dataLabels: {
		                show: !0,
		                name: {
		                    show: !1
		                },
		                value: {
		                    show: !0,
		                    fontSize: "10px",
		                    fontWeight: 800,
		                    offsetY: 5
		                }
		            }
		        }
   		 	},
        },(chart = new ApexCharts(document.querySelector("#total_jobs"), options)).render())
	</script>
@endsection