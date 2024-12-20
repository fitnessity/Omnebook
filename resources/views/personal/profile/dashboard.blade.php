@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')
@include('layouts.profile.business_topbar')

	<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<div class="row mb-3">
					<div class="col-12">
						<div class="text-center">
							<div class="">
								@if(!$business->getCompanyImage())
								<div class="company-list-text mb-10">
					          		<p class="character">{{$business->first_letter}}</p>
					          	</div>
								@else
									<img src="{{$business->getCompanyImage()}}" alt="" class="avatar">
								@endif
							</div>
							<div class="page-heading">
								<label>{{$business->public_company_name}}</label>
							</div>
						</div>
					</div>
				
				</div><!--end row-->	
				<div class="row mb-3 pb-1">
					<div class="col-12">
						<div class="d-flex align-items-lg-center flex-lg-row flex-column">
							<div class="flex-grow-1">
								<h4 class="fs-17 mb-1">Welcome Back, {{$name}} </h4>
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
										<p class="fw-medium text-muted text-truncate mb-0"> Total Attendance | Month</p>
									</div>
									<div class="increase flex-shrink-0">
										@if(@$attendancePct < 0)
                                            <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>{{@$attendancePct}} % </h5> <p>Decrease</p>
                                        @else
                                            <h5 class="text-success fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> + {{@$attendancePct}} % </h5> <p>Increase</p>
                                        @endif      
									</div>
								</div>
								<div class="d-flex align-items-end justify-content-between mt-4">
									<div>
										<h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$attendanceCnt}}">{{$attendanceCnt}}</span></h4>
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

					<div class="col-xl-3 col-md-6"><!-- card -->
						<div class="card card-animate">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div class="white-box flex-grow-1 overflow-hidden">
										<p class="fw-medium text-muted text-truncate mb-0">Total Bookings | Month</p>
									</div>
									<div class="decrease flex-shrink-0">
										@if(@$bookingPct < 0)
                                            <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>{{@$bookingPct}} % </h5> <p>Decrease</p>
                                        @else
                                            <h5 class="text-success fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> + {{@$bookingPct}} % </h5> <p>Increase</p>
                                        @endif  

									</div>
								</div>
								<div class="d-flex align-items-end justify-content-between mt-4">
									<div>
										<h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$bookingCnt}}">{{$bookingCnt}}</span></h4>
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
					

					<div class="col-xxl-12 col-lg-12">
						<div class="card">
							<div class="card-header align-items-center d-flex">
								<h4 class="card-title mb-0 flex-grow-1 font-red">Your Upcoming Classes</h4>
							</div><!-- end card header -->

							<div class="card-body">
								<div class="live-preview">
									<div class="table-responsive">
										<table class="table align-middle table-nowrap mb-0">
											<thead>
												<tr>
													<th scope="col">Session</th>
													<th scope="col">Program Name </th>
													<th scope="col">Time and Date</th>
													<th scope="col">Membership</th>
													<th scope="col"> </th>
													<th scope="col"> </th>
												</tr>
											</thead>
											<tbody>
												@forelse(@$classes as $c)
													<tr>
														<th scope="row">{{@$c->order_detail->getRemainingSessionAfterAttend()."/".@$c->order_detail->pay_session}}</th>
														<td>{{ @$c->order_detail->business_services_with_trashed->program_name }} </td>
														<td>{{ date('m/d/Y' ,strtotime($c->checkin_date))}}  {{ date("g:i A", strtotime(@$c->scheduler->shift_start))}} </td>
														<td> {{ @$c->order_detail->business_price_detail_with_trashed->price_title }}</td>
														<td>
															<div class="">
																<a class="btn btn-red" href="http://dev.fitnessity.co/design/register_ep">Check-In</a>
															</div>
														</td>
														<td>
															<div class="">
																<a class="btn btn-red" href="{{ url('/personal/orders') . '?' . http_build_query(['business_id' => request()->business_id, 'customer_id' => request()->has('customer_id') ? request()->customer_id : null,'type' => request()->has('type') ? request()->type : null]) }}">View Booking</a>
															</div>
														</td>
													</tr>
												@empty
													<tr><td>No Upcoming Class Available</td></tr>
												@endforelse
												
												<!-- <tr>
													<th scope="row">9991/10000 </th>
													<td>Kickboxing Class </td>
													<td>02/21/2024 10:00 AM (45 Min) </td>
													<td>Go Golfers - 30 Minute Private (01 Pack) </td>
													<td>
														<div class="">
															<a class="btn btn-red" href="http://dev.fitnessity.co/design/register_ep">Check-In</a>
														</div>
													</td>
													<td>
														<div class="">
															<a class="btn btn-red" href="http://dev.fitnessity.co/personal/orders?business_id=68">View Booking</a>
														</div>
													</td>
												</tr> -->
											</tbody>
										</table>
									</div>
								</div>
							</div><!-- end card-body -->
						</div><!-- end card -->

						<!--<div class="card">
							<div class="card-header align-items-center d-flex">
								<h4 class="card-title mb-0 flex-grow-1">Your Upcoming Classes</h4>
							</div>

							<div class="card-body">
								<div class="d-flex align-middle y-middle">
									<div class="row">
										<div class="col-md-1 col-2"><h5 class="fs-15">Session</h5></div>
										<div class="col-md-2 col-2"><h5 class="fs-15">Program Name </h5></div>															
										<div class="col-md-3 col-3"><h5 class="fs-15">Time and Date</h5></div>					
										<div class="col-md-3 col-4"><h5 class="fs-15">Membership</h5></div>
										<div class="col-md-3 col-3"></div>
								
									@forelse(@$classes as $c)
										@if($c->order_detail && $c->scheduler)
										<div class="dashed-border mb-5 w-100">												
											<div class="row y-middle">
												<div class="col-md-1 col-2">
													{{ @$c->order_detail->getremainingsession()."/".@$c->order_detail->pay_session }}
												</div>
												<div class="col-md-2 col-2">
													Kickboxing Class
												</div>
												<div class="col-md-3 col-3">
													02/21/2024 10:00 AM (45 Min)
													 {{ date('m/d/Y' ,strtotime($c->checkin_date))}}  {{ date("g:i A", strtotime(@$c->scheduler->shift_start))}} 
												</div>
												<div class="col-md-3 col-3">
													{{ @$c->order_detail->business_services_with_trashed->program_name }} - {{ @$c->order_detail->business_price_detail_with_trashed->price_title }}
												</div>
												<div class="col-md-3 col-4">
													<div class="flex-grow-1 ms-3 text-end">
														<a class="btn btn-red float-right mb-10" href="{{ url('/personal/orders') . '?' . http_build_query(['business_id' => request()->business_id, 'customer_id' => request()->has('customer_id') ? request()->customer_id : null,'type' => request()->has('type') ? request()->type : null]) }}">View Booking</a>
														<a class="btn btn-red float-right mb-10 mr-10" href="http://dev.fitnessity.co/design/register_ep">Check-In</a>
													</div>
												</div>
											</div>												
										</div>
										@endif
									@empty
										No Upcoming Class Available
									@endforelse
								</div>
							</div>
						</div>  -->
					</div><!-- end col -->

					<div class="col-xxl-8 col-lg-8">
						<div class="card">
							<div class="card-header align-items-center d-flex">
								<h4 class="card-title mb-0 flex-grow-1">Important Alerts</h4>
							</div><!-- end card-header -->

							<div class="card-body">
								<div class="dashed-border">
									<div class="d-flex align-middle y-middle mb-5">
										<div class="flex-shrink-0">
											<i class="fa fa-user fs-18"></i>
										</div>
										<div class="flex-grow-0 ms-3">
											<h6 class="mb-1 lh-base">Total Active Memberships <span class="font-red">({{$activeMembershipCnt}})({{$activeMembershipCntNew}} New)</span></h6>
										</div>
										<div class="flex-grow-1 ms-3 text-end">
											<a class="btn btn-red" href="{{ url('/personal/orders') . '?' . http_build_query(['business_id' => request()->business_id, 'customer_id' => request()->has('customer_id') ? request()->customer_id : null,'type' => request()->has('type') ? request()->type : null]) }}">View</a>
										</div>
									</div><!-- end -->
								</div>
								<div class="dashed-border">
									<div class="d-flex mt-4 y-middle mb-5">
										<div class="flex-shrink-0">
											<i class="fa fa-sticky-note fs-18"></i>
										</div>
										<div class="flex-grow-0 ms-3">
											<h6 class="mb-1 lh-base"> Notes & Alerts <span class="font-red">({{$notesCnt}})({{$notesCntNew}} New)</span> </h6>
										</div>
										<div class="flex-grow-1 ms-3 text-end">
											<a class="btn btn-red" href="{{ url('/personal/notes-alerts') . '?' . http_build_query([ 'business_id' => request()->business_id ,'customer_id' => request()->has('customer_id') ? request()->customer_id : null,'type' => request()->has('type') ? request()->type : null]) }}">View</a>
										</div>
									</div><!-- end -->
								</div>
								<div class="dashed-border">
									<div class="d-flex mt-4 y-middle mb-5">
										<div class="flex-shrink-0">
											<i class="fa fa-bullhorn fs-18"></i>
										</div>
										<div class="flex-grow-0 ms-3">
											<h6 class="mb-1 lh-base">Announcements & News <span class="font-red">({{$announcemetCnt}})({{$announcemetCntNew}} New)</span></h6>
										</div>
										<div class="flex-grow-1 ms-3 text-end">
											<a class="btn btn-red" href="{{route('personal.announcement-news' ,['business_id' => request()->business_id])}}">View</a>
										</div>
									</div><!-- end -->
								</div>
								<div class="dashed-border">
									<div class="d-flex mt-4 y-middle mb-5">
										<div class="flex-shrink-0">
											<i class="fa fa-file fs-18"></i>
										</div>
										<div class="flex-grow-0 ms-3">
											<h6 class="mb-1 lh-base">Documents & Terms Alerts <span class="font-red">({{$docCnt}})({{$docCntNew}} New)</span></h6>
										</div>
										<div class="flex-grow-1 ms-3 text-end">
											<a class="btn btn-red" href="{{ url('/personal/documents-contract') . '?' . http_build_query(['business_id' => request()->business_id, 'customer_id' => request()->has('customer_id') ? request()->customer_id : null,'type' => request()->has('type') ? request()->type : null]) }}">View</a>
										</div>
									</div><!-- end -->
								</div>
							</div><!-- end card body -->
						</div><!-- end card -->
					</div><!-- end col -->
					
				</div>
			</div><!-- container-fluid -->
		</div>
	</div><!-- end main content-->
</div><!-- END layout-wrapper -->
@include('layouts.business.footer')
@include('layouts.business.scripts')
@endsection