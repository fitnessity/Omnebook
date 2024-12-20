@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

	
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
                                <div class="row mb-3 pb-1 justify-content-md-center">
                                    @if((Auth::user()->currentPlan() && Auth::user()->currentPlan()->amount == 0 )|| Auth::user()->chkDaysLeft() < 14)
                                   
                                    @if(session('StaffLogin') == '')       
    									<div class="col-xxl-6 col-lg-7 col-md-12 col-12">
                                            @if(Auth::user()->freeTrial() == 'free')
    										<div class="remaining-days mb-15">
    											<div class="row y-middle" style="margin-top:5px;margin-bottom: 5px;">

                                                    @if(Auth::user()->chkDaysLeft() == 0)
        												<div class="col-lg-9 col-md-9 col-12">	
        													<p class="fs-13">                                                                                                                            
                                                                You are currently on free plan. Please upgrade your account to fully use your software.
        													</p>
        												</div>
														<div class="col-lg-3 col-md-3 col-12">
															<a href="{{route('choose-plan.index')}}" class="btn btn-success ml-15 float-right"><b> Upgrade </b></a>
														</div>
        											</div>
                                                    @else
                                                        <div class="col-lg-2 col-md-2 col-3">
                                                            <center>
                                                                <div class="avatar-xs flex-shrink-0">
                                                                    <span class="avatar-title bg-primary rounded-circle fs-15">{{Auth::user()->chkDaysLeft()}}</span>
                                                                </div>
                                                                <div class="days-left">
                                                                    <p>Days Left</p>
                                                                </div>
                                                            </center>
                                                        </div>
                                                        <div class="col-lg-10 col-md-10 col-9"> 
                                                            <p class="fs-13">
                                                                @if(Auth::user()->chkDaysLeft() == 0)
                                                                    You are currently on free plan. Please upgrade your account to fully use your software.<a href="{{route('choose-plan.index')}}" class="text-reset text-decoration-underline"><b>Upgrade</b></a>
                                                                @else
                                                                    You have {{Auth::user()->chkDaysLeft()}}  left in your @if($activePlan) plan. @else free trial. @endif To keep experiences all the features after the trial period, evert payment details and select a plan now to begin after your @if($activePlan) plan @else trial @endif is over.
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                    @endif

    										</div>
                                            @endif
    									</div>
                                    @endif     
                                        @if(Auth::user()->planDateDiffrence() >= 14)
    									<div class="col-6">
                                            <div class="card">
                                                <div class="card-body p-0">
                                                    <div class="alert alert-warning border-0 rounded-0 m-0 d-flex align-items-center" role="alert">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle text-warning me-2 icon-sm"></svg>
                                                        <div class="flex-grow-1 text-truncate">
                                                            Your plan expires in <b>{{Auth::user()->chkDaysLeft()}}</b> days.
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <a href="{{route('choose-plan.index')}}" class="text-reset text-decoration-underline"><b>Upgrade</b></a>
                                                        </div>
                                                    </div>

                                                    <div class="row align-items-end">
                                                        <div class="col-sm-8">
                                                            <div class="p-3">
                                                                <p class="fs-16 lh-base">@if(Auth::user()->chkDaysLeft() != 0) Upgrade your limited features free plan of Pay-As-You Go to the "Basic or Pro plan" @else Upgrade your free trial plan. @endif </p>
                                                                <div class="mt-3">
                                                                    <a href="{{route('choose-plan.index')}}" class="btn btn-success">Upgrade Account!</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="px-3">
                                                                <img src="{{url('dashboard-design/images/user-illustarator-2.png')}}" class="img-fluid" alt="omnebook" loading="lazy">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <!-- end card-body-->
                                            </div>
                                        </div>
                                        @endif
                                    @endif

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
                                                <h1 class="fs-16 mb-1">Good Morning, {{$name}} </h1>
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
                                                        </div> 
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn shadow-none"><i class="ri-pulse-line"></i></button>
                                                        </div>-->
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
                                                        <a href="{{route('business.booking_history',['business_id'=>$business_id])}}" class="text-decoration-underline" target="_blank">View Bookings</a>
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
                                                        <p class="fw-medium text-muted text-truncate mb-0">New Client | Month</p>
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
                                                        <a onclick="getNewClient('simple' ,'date' ,'open');" class="text-decoration-underline">View Customers</a>
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
                                                        <p class="fw-medium text-muted text-truncate mb-0">Reservations | Month</p>
                                                    </div>
                                                    <div class="increase flex-shrink-0">
                                                        @if($reserveMembersCountPercentage < 0)
                                                            <h5 class="text-danger fs-14 mb-0">
                                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i> {{$reserveMembersCountPercentage}} % </h5> <p>Decrease</p>
                                                        @else
                                                            <h5 class="text-success fs-14 mb-0">
                                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> + {{$reserveMembersCountPercentage}} % </h5> <p>Increase</p>
                                                        @endif 
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$reserveMembersCount}}">{{$reserveMembersCount}}</span></h4>
                                                        <a href="{{route('business_customer_index')}}" target="_blank" class="text-decoration-underline">View Customers</a>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title text-bg-primary rounded fs-3">
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
													<button type="button" class="btn btn-soft-secondary btn-sm shadow-none" onclick="getRevenueGoal('M')"> 1M</button>
													<button type="button" class="btn btn-soft-primary btn-sm shadow-none" onclick="getRevenueGoal('Y')"> 1Y </button>
                                                    <!-- <button type="button" class="btn btn-soft-secondary btn-sm shadow-none">ALL </button> -->
                                                </div>
                                            </div><!-- end card header -->

                                            <div class="card-header p-0 border-0 bg-soft-light">
                                                <div class="row g-0 text-center">
                                                    <div class="col-6 col-sm-3">
                                                        <div class="p-3 border border-dashed border-start-0">
															<h5 class="mb-1" id="revenue_year_span">$<span class="counter-value" data-target="{{@$revenueData->yearly_total_goal}}" >{{@$revenueData->yearly_total_goal ?? 0}}</span></h5>

                                                            <h5 class="mb-1 d-none" id="revenue_month_span">$<span class="counter-value" data-target="{{@$currentMonthRevenue ?? 0}}">{{@$currentMonthRevenue ?? 0}}</span></h5>
                                                            <p class="text-muted mb-0 revenue">Revenue Needed To Goal</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
													
                                                    <div class="col-6 col-sm-3">
                                                        <div class="p-3 border border-dashed border-start-0" style="padding: 0.4rem!important">
															<div class="flex-shrink-0">
																<div id="total_jobs" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
															</div>
                                                           <!--  <h4 class="fs-15 fw-semibold ff-secondary mb-3">$<span class="counter-value" data-target="{{$revenueAchivedPercentage}}">{{$revenueAchivedPercentage}}</span></h4> -->
                                                            <p class="text-muted mb-0 revenue">% of Revenue Acheived</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-sm-3">
                                                        <div class="p-3 border border-dashed border-start-0">
                                                            <h5 class="mb-1">$<span class="counter-value" data-target="{{$revenuePerDayNeeded}}">{{$revenuePerDayNeeded}}</span></h5>
                                                            <p class="text-muted mb-0 revenue">Revenue Needed Per Day</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-sm-3">
                                                        <div class="p-3 border border-dashed border-start-0 border-end-0">
                                                            <h5 class="mb-1">$<span class="counter-value" data-target="{{$revenueShouldbeOnDay}}">{{$revenueShouldbeOnDay}}</span></h5>
                                                            <p class="text-muted mb-0 revenue">Revenue You Should Be At Today</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                            </div><!-- end card header -->

                                            <div class="card-body p-0 pb-2">
                                                 
                                                <div class="w-100" id="graphDivY">
                                                    @include('business.revenue_graph',['graphData' =>$revenueDataAry, 'categoryData' => $categoryData,'graph_name' => 'projects-overview-chart_year'])
                                                </div>
                                                <div class="w-100" id="graphDivM">
                                                    @include('business.revenue_graph',['graphData' =>$revenueDataMonthAry, 'categoryData' => $categoryMonthData ,'graph_name' => 'projects-overview-chart_month'])
                                                </div>

												<div class="text-center">
													<a class="text-decoration-underline" href="#" data-bs-toggle="modal" data-bs-target=".monthly-financial">Manage Goals</a>
												</div>
                                            </div><!-- end card body -->
											
										</div><!-- end card -->
										<div class="col-md-12">
											<div class="card padding-15">
												<div class="row">
													<div class="col-xxl-3 col-lg-6 col-md-6 col-12">
														<div class="border-0 align-items-center text-center mb-15">
															<h4 class="payment-tracker flex-grow-1">Recurring Payments Tracker</h4>
															<h4 class="payment-tracker">
                                                            @if(date('M',strtotime($startDate)) == date('M',strtotime($endDate)) ) 
                                                               {{date('M',strtotime($startDate))}}, {{date('Y',strtotime($startDate))}} 
                                                            @else 
                                                                {{date('M',strtotime($startDate))}} to {{date('M',strtotime($endDate))}},
                                                                {{date('Y',strtotime($startDate))}} 
                                                            @endif</h4>
															<h4 class="fs-22 fw-semibold ff-secondary scheduled-payments">$<span class="counter-value" data-target="{{$recurringAmount}}">{{$recurringAmount}}</span></h4>
															<p class="mb-0">Scheduled Payments </p>
														</div>
													</div>
													<div class="col-xxl-3 col-lg-6 col-md-6 col-12">
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
																			<h4 class="fs-15 fw-semibold ff-secondary mb-3">$<span class="counter-value" data-target="{{$completeRecurringAmount}}">{{$completeRecurringAmount}}</span></h4>
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
													<div class="col-xxl-3 col-lg-6 col-md-6 col-12">
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
																			<h4 class="fs-15 fw-semibold ff-secondary mb-3">$<span class="counter-value" data-target="{{$reminingRecurringAmount}}">{{$reminingRecurringAmount}}</span></h4>
																			<p class="fw-medium text-muted text-truncate mb-0">Scheduled </p>
																		</div>
																		<div class="flex-shrink-0">
																			<div id="rejected_chart" data-colors='["--vz-danger"]' class="apex-charts" dir="ltr"></div>
																		</div>
																	</div>
																</div><!-- end card body -->
															</div>
														</div>
													</div>

                                                    <div class="col-xxl-3 col-lg-6 col-md-6 col-12">
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
                                                                            <h4 class="fs-15 fw-semibold ff-secondary mb-3">$<span class="counter-value" data-target="{{$failedRecurringAmount}}">{{$failedRecurringAmount}}</span></h4>
                                                                            <p class="fw-medium text-muted text-truncate mb-0">Failed </p>
                                                                        </div>
                                                                        <div class="flex-shrink-0">
                                                                            <div id="failed_chart" data-colors='["--vz-danger"]' class="apex-charts" dir="ltr"></div>
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
														<a class="alinkdrop dropdown-toggle cal-drop" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Show All Activities</a>
														<ul class="dropdown-menu activityschedule" aria-labelledby="dropdownMenuButton1">
															<li><a class="dropdown-item">Show All Activities</a></li>
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
							</div> <!-- end .h-100-->
                        </div> <!-- end col -->

                    </div>
                </div><!-- container-fluid -->
            </div><!-- End Page-content -->
        </div><!-- end main content-->
    </div><!-- END layout-wrapper -->
	<div class="modal fade view-booking" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-80">
            <div class="modal-content" id="bookingmodel">
            </div>
        </div>
    </div> 

    <div class="modal fade monthly-financial" tabindex="-1" aria-hidden="true">
    	<div class="modal-dialog modal-dialog-centered modal-80">
    		<div class="modal-content">
    			<div class="modal-header p-3">
    				<h5 class="modal-title" id="exampleModalLabel">Set & Track Your Monthly Financials Goals for {{date('Y')}}</h5>
    				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
    			</div>
    			<form action="{{route('set_revenue_goal')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{@$revenueData->id}}">
                    <input type="hidden" name="business_id" value="{{$business_id}}">
                    <input type="hidden" name="year" value="{{date('Y')}}">
                    <input type="hidden" name="url" value="{{request()->fullUrl()}}">
    				<div class="modal-body">
    					<div class="row">
    						<div class="col-lg-3 col-md-3 col-sm-3">
    							<div class="track-goal form-group mb-10">
    								<label>January</label>
    								<input type="text" class="form-control" name="jan_goal" id="jan_goal" required="" onkeyup="revenueTotal();" value="{{@$revenueData->jan_goal}}">
    							</div>
    						</div>
    						<div class="col-lg-3 col-md-3 col-sm-3">
    							<div class="track-goal form-group mb-10">
    								<label>February</label>
    								<input type="text" class="form-control" name="feb_goal" id="feb_goal" required="" onkeyup="revenueTotal();" value="{{@$revenueData->feb_goal}}">
    							</div>
    						</div>
    						<div class="col-lg-3 col-md-3 col-sm-3">
    							<div class="track-goal form-group mb-10">
    								<label>March</label>
    								<input type="text" class="form-control" name="mar_goal" id="mar_goal" required="" onkeyup="revenueTotal();" value="{{@$revenueData->mar_goal ?? 0}}">
    							</div>
    						</div>
    						<div class="col-lg-3 col-md-3 col-sm-3">
    							<div class="track-goal form-group mb-10">
    								<label>April</label>
    								<input type="text" class="form-control" name="apr_goal" id="apr_goal" required="" onkeyup="revenueTotal();" value="{{@$revenueData->apr_goal ?? 0}}">
    							</div>
    						</div>
    						<div class="col-lg-3 col-md-3 col-sm-3">
    							<div class="track-goal form-group mb-10">
    								<label>May</label>
    								<input type="text" class="form-control" name="may_goal" id="may_goal" required="" onkeyup="revenueTotal();" value="{{@$revenueData->may_goal ?? 0}}">
    							</div>
    						</div>
    						<div class="col-lg-3 col-md-3 col-sm-3">
    							<div class="track-goal form-group mb-10">
    								<label>June</label>
    								<input type="text" class="form-control" name="jun_goal" id="jun_goal" required="" onkeyup="revenueTotal();" value="{{@$revenueData->jun_goal ?? 0}}">
    							</div>
    						</div>
    						<div class="col-lg-3 col-md-3 col-sm-3">
    							<div class="track-goal form-group mb-10">
    								<label>July</label>
    								<input type="text" class="form-control" name="jul_goal" id="jul_goal" required="" onkeyup="revenueTotal();" value="{{@$revenueData->jul_goal ?? 0}}">
    							</div>
    						</div>
    						<div class="col-lg-3 col-md-3 col-sm-3">
    							<div class="track-goal form-group mb-10">
    								<label>August</label>
    								<input type="text" class="form-control" name="aug_goal" id="aug_goal" required="" onkeyup="revenueTotal();" value="{{@$revenueData->aug_goal ?? 0}}">
    							</div>
    						</div>
    						<div class="col-lg-3 col-md-3 col-sm-3">
    							<div class="track-goal form-group mb-10">
    								<label>September</label>
    								<input type="text" class="form-control" name="sep_goal" id="sep_goal" required="" onkeyup="revenueTotal();" value="{{@$revenueData->sep_goal ?? 0}}">
    							</div>
    						</div>
    						<div class="col-lg-3 col-md-3 col-sm-3">
    							<div class="track-goal form-group mb-10">
    								<label>October</label>
    								<input type="text" class="form-control" name="oct_goal" id="oct_goal" required="" onkeyup="revenueTotal();" value="{{@$revenueData->oct_goal ?? 0}}">
    							</div>
    						</div>
    						<div class="col-lg-3 col-md-3 col-sm-3">
    							<div class="track-goal form-group mb-10">
    								<label>November</label>
    								<input type="text" class="form-control" name="nov_goal" id="nov_goal" required="" onkeyup="revenueTotal();" value="{{@$revenueData->nov_goal ?? 0}}">
    							</div>
    						</div>
    						<div class="col-lg-3 col-md-3 col-sm-3">
    							<div class="track-goal form-group mb-10">
    								<label>December</label>
    								<input type="text" class="form-control" name="dec_goal" id="dec_goal" required="" onkeyup="revenueTotal();" value="{{@$revenueData->dec_goal ?? 0}}">
    							</div>
    						</div>
    						<div class="col-lg-3 col-md-3 col-sm-3">
    							<div class="yearly-total form-group mb-10">
    								<label class="font-red text-decoration">Yearly Total</label>
    								<input type="text" class="form-control" name="yearly_total_goal" id="yearly_total_goal" required="" readonly value="{{@$revenueData->yearly_total_goal ?? 0}}">
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


    <div class="modal fade view-client" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-80">
            <div class="modal-content" id="clientmodel">
            </div>
        </div>
    </div> 

	@include('layouts.business.footer')
    @include('layouts.business.scripts')

	<script type="text/javascript">
		flatpickr(".flatpickr-schedule", {
	        inline: true,
	        dateFormat: "Y-m-d",
	        maxDate: "2050-01-01",
	        onChange: function(selectedDates, dateStr, instance) {
	        	var type = $('.cal-drop').text();
		       	activityschedule(type,dateStr);
		    },
	     });

        date1 = '{{$startDateCalendar}}';
        date2 = '{{$endDateCalendar}}';
		flatpickr(".flatpickr-range", {
            altInput: true,
	        mode:  "range",
            altFormat: "m-d-Y",
	        dateFormat: "Y-m-d",
	        maxDate: "2050-01-01",
            defaultDate: [date1, date2],
            onChange: function(selectedDates, dateStr, instance) {
                url = '/dashboard/'+dateStr;
                setTimeout(function() {
                    window.location.href = url;
                }, 1000);
            },
	   });


        function revenueTotal(){
            var totalCount = 0;

            $('#jan_goal, #feb_goal, #mar_goal, #apr_goal, #may_goal, #jun_goal, #jul_goal, #aug_goal, #sep_goal, #oct_goal, #nov_goal, #dec_goal').each(function() {
                totalCount += parseInt($(this).val()) || 0;
            });

            $('#yearly_total_goal').val(totalCount);

        }

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
		  	$(this).parents('.dropdown-activity').find('.cal-drop').html(selText+' <span class="caret"></span>');
		  	type = selText;
		  	activityschedule(type,'');
		});

        var  category =["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
		$( document ).ready(function() {
            $('#graphDivY').addClass('d-none');
		    draw_chart_donut_revenue({{$in_person}}, {{$online}},'');
		    draw_chart_donut_category({{$ptdata}},{{$clsdata}},{{$expdata}},{{$evdata}},{{$prdata}},'');
		    <?php 
		    	$comp_color = $completedRecPercentage <= 20 ? '#FA4443':'#3577f1';
		    	$rem_color = $remainingRecPercentage <= 20 ? '#FA4443':'#3577f1';
                $failed_color = $failedRecPercentage <= 20 ? '#FA4443':'#3577f1';
                $revenue_color = $revenueAchivedPercentage <= 20 ? '#FA4443':'#3577f1';
		    ?>

		    draw_chart_radial_bar('{{$completedRecPercentage}}','new_jobs_chart' ,'{{$comp_color}}','105', "70%" ,'14px');
		    draw_chart_radial_bar('{{$remainingRecPercentage}}','rejected_chart','{{$rem_color}}','105', "70%",'14px');
            draw_chart_radial_bar('{{$failedRecPercentage}}','failed_chart','{{$failed_color}}','105', "70%",'14px');
            draw_chart_radial_bar('{{$revenueAchivedPercentage}}','total_jobs','{{$revenue_color}}','70', "70%",'10px');
            
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

		function getRevenueGoal(type)
		{
            if(type == 'Y'){
                $('#graphDivY').removeClass('d-none');
                $('#graphDivM').addClass('d-none');
                $('#revenue_year_span').removeClass('d-none');
                $('#revenue_month_span').addClass('d-none');
            }else{
                $('#graphDivM').removeClass('d-none');
                $('#graphDivY').addClass('d-none');
                $('#revenue_year_span').addClass('d-none');
                $('#revenue_month_span').removeClass('d-none');
            }

			/*$.ajax({
				url:"getRevenueAjax",
				method:"GET",
				data:{
					type: type
				},
				success:function(data)
				{
                    if(type == 'Y'){
                        $('#graphDivY').removeClass('d-none');
                    }else{
                        $('#graphDivY').addClass('d-none');
                    }
				}
			});*/
		}

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

		function draw_chart_radial_bar(data,name ,color,width,size,fontSize) {
			var options = {
	          	series: [data],
			    chart: {
			        type: "radialBar",
			        width: width,
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
			                size: size
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
			                    fontSize: fontSize,
			                    fontWeight: 600,
			                    offsetY: 8
			                }
			            }
			        }
			    },
	        };

	        (chart = new ApexCharts(document.querySelector("#"+name), options)).render();
		}
	</script>
 
<script>

    $( document ).ready(function() {
        category = <?php echo $categoryData; ?>;
        category1 = <?php echo $categoryMonthData; ?>;
        draw_chart_combo(@json($revenueDataAry) , category ,'projects-overview-chart_year');
        draw_chart_combo(@json($revenueDataMonthAry) , category1 ,'projects-overview-chart_month');
    });


    function draw_chart_combo(data,category,chartName){
        var options = {
            series: [{
                    name: "Revenue Last Year",
                    type: "bar",
                    data: data[0]
                }, {
                    name: "Revenue Goal",
                    type: "bar",
                    data: data[1]
                }, {
                    name: "Revenue So Far",
                    type: "bar",
                    data: data[2]
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

        var chart = new ApexCharts(document.querySelector("#" + chartName), options);
        chart.render();
    }

    function getNewClient(chk,type,open){  
            let date = '';
            if(chk == 'ajax'){
                date = $('#clientdate').val();
            }else if(chk == 'simple'){
                if(open == 'open'){
                    $('#clientmodel').html('');
                }
            }
           
            $.ajax({
                url:"{{route('getClientModelData')}}",
                xhrFields: {
                    withCredentials: true
                },
                type:"get",
                data:{
                    business_id:'{{$business_id}}',
                    cDate:date,
                    type:type
                },
                success:function(data){
                    $('#clientmodel').html(data);
                    if(open == 'open'){
                        $('.view-client').modal('show');
                    }
                }
            });
        } 
</script>


@endsection