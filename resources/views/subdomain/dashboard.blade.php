@inject('request', 'Illuminate\Http\Request')
@extends('subdomain.layouts.header')

@section('content')

	{{-- new code end --}}
	<div class="vertical-overlay"></div>
	<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<div class="row mb-3">
					<div class="col-12">
						<div class="text-right mb-3 mt-3">
							<a class="btn btn-red" id="purchaseMembershipBtn">Purchase A Membership </a>
						</div>
					 </div>
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



					<div class="col-xl-3 col-md-6">
						<div class="card card-animate">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div class="white-box flex-grow-1 overflow-hidden">
										<p class="fw-medium text-muted text-truncate mb-0">Self Check-In Options</p>
									</div>
								</div>
								<div class="d-flex align-items-end justify-content-between mt-4">
									<div class="fout-digit-info">
										<p> <b>4 Digit Code: </b> {{$customer->user->unique_code}}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					

					<div class="col-xxl-12 col-lg-12">
						<div class="card">
							<div class="card-header align-items-center d-flex">
								<h4 class="card-title mb-0 flex-grow-1 font-red">Your Upcoming Classes</h4>
							</div><!-- end card header -->

							<div class="mt-10 ml-10 fs-14" id="error-message"></div>	

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
																<a class="btn btn-red" @if(!$c->checked_at) onclick="checkin('{{$c->id}}');" @endif >@if($c->checked_at) Checked @else Check-In @endif</a>
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
											</tbody>
										</table>
									</div>
								</div>
							</div><!-- end card-body -->
						</div><!-- end card -->
					</div><!-- end col -->

			
					<!-- end col -->
					
				</div>
			</div><!-- container-fluid -->
		</div>
	</div>
	<!-- end main content-->
</div>
<!-- END layout-wrapper -->
{{-- @include('layouts.business.footer')
@include('layouts.business.scripts') --}}
{{-- modals starts --}}

<!-- Modal Structure -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
	<div class="modal-dialog ">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <h5 class="modal-title" id="bookingModalLabel">Booking Details</h5> -->
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<!-- Booking details will be loaded here -->
				<h5>booking</h5>
			</div>
		</div>
	</div>
</div>
{{-- end --}}

<!-- Modal Structure -->
<div class="modal fade" id="membershipModal" tabindex="-1" role="dialog" aria-labelledby="membershipModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl" role="document">
	<div class="modal-content">
		<div class="modal-header">
			{{-- <h5 class="modal-title" id="membershipModalLabel">Purchase Membership</h5> --}}
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

		</div>
		<div class="modal-body" id="modalBodyContent">
			<!-- Content will be loaded here via AJAX -->
		</div>
		<div class="modal-footer">
			{{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
		</div>
	</div>
</div>
</div>

<!-- Modal Structure -->
<div class="modal fade instructors" id="instructorModal" tabindex="-1" aria-labelledby="instructorModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
		{{-- <h5 class="modal-title" id="instructorModalLabel">Instructor Details</h5> --}}
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
		<div id="instructorContent">
			<!-- Content will be injected here -->
		</div>
		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-red" data-bs-dismiss="modal">Close</button>
		</div>
	</div>
	</div>
</div>
{{-- modal ends --}}
   {{-- membership modal starts --}}
   <div class="modal fade membership-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button type="button" class="btn-close" onclick="window.location.reload()"></button>
			</div>
			<div class="modal-body membership-modal-content"></div>
		</div>
	  </div>
</div>
{{-- modals end --}}
<!-- Flatpickr CSS -->
{{-- <script type="text/javascript">
	$(document).ready(function () { 
		$( ".birthdate" ).datepicker();
	});
</script> --}}
<script src="{{url('public/dashboard-design/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/confirmDate/confirmDate.js"></script>
<script src="{{url('public/js/jquery-input-mask-phone-number.js')}}"></script>
<script src="{{url('public/dashboard-design/js/feather.min.js')}}"></script>
<script src="{{url('public/dashboard-design/js/waves.min.js')}}"></script>
<script src="{{url('public/dashboard-design/js/app.js')}}"></script>
<script>
	$(document).ready(function() {
		$("#actfildate_forcart").datepicker();
	});
</script>	
<script type="text/javascript">

	function checkin(id) {
        $('#error-message').removeClass('text-danger font-green').html('');
		$.ajax({
            url: "{{route('quick-check-in')}}", 
            type: 'POST',
            data: {
                checkinId: id,
                _token: '{{ csrf_token() }}'  
            },
            success: function(response) {
                if (response.success) {
                	$('#error-message').addClass('font-green').html(response.message1);
                	setTimeout(function (e){
                		window.location.reload();
                	},2000);
                } else {
                    $('#error-message').addClass('text-danger').html(response.message || 'An error occurred. Please try again.');
                }
            },
            error: function(xhr, status, error) {
                $('#error-message').addClass('text-danger').html('An error occurred. Please try again.');
            }
        });
	}	
</script>

<script>
		$('#purchaseMembershipBtn').on('click', function() {
			var companyinfo = @json($business); 		
			var user = {{ auth()->id() }};
			var csrfToken = '{{ csrf_token() }}'; 
			$.ajax({
				url: '{{ route("membership_sub") }}', 
				method: 'POST',
				headers: {
                'X-CSRF-TOKEN': csrfToken 
               },

				data: {
					companyinfo: companyinfo,
					user:user,					
				},
				success: function(response) {
					$('#modalBodyContent').html(response);
					$('#membershipModal').modal('show');
				},
				error: function() {
					$('#modalBodyContent').html('<p>There was an error loading the content. Please try again.</p>');
					$('#membershipModal').modal('show');
				}
			});
		});
</script>

@endsection