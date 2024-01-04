@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.profile.business_topbar')
	<!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
		<div class="page-content">
            <div class="container-fluid">
               <div class="row mb-3">
					<div class="col-12">
						<div class="page-heading">
							<label>Select A Provider </label>
						</div>
					</div>
                </div><!--end row-->
				
				<div class="row">
					<div class="col-12">
						<div class="card" id="contact-view-detail">
							<div class="card-body text-center">
								<div class="booking-titles mb-15">
									<h4 class="fs-18">Start by Selecting A Provider</h4>
									<p>Select a provider to make reservation, view your bookings and memberships, payment history, news and more.</p>
								</div>
								<div class="row">
									@forelse($business as $bs)
									@php $customer = $bs->customers->where('user_id',@$id)->first(); @endphp
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<div class="card-body purchase-history mt-5 body-bg-gradient">
											<div class="d-flex flex-column h-100">
												<div class="d-flex mb-2">
													<div class="flex-grow-1 text-center">
														<h5 class="mb-1 fs-15"><a href="#" class="text-red fs-18">{{ $bs->public_company_name}}</a></h5>
														<div class="d-grid booking-activity">
															<span> Active Memberships: {{$bs->active_memberships_count_by_user_id(@$customer->id)}}</span>
															<span> Completed Memberships: {{$bs->completed_memberships_count_by_user_id(@$customer->id)}}</span>
															<span> Expiring Memberships: {{$bs->expired_soon_memberships_count_by_user_id(@$customer->id)}}</span>
															<span> Attenance: {{$bs->visits_count_by_user_id(@$customer->id)}} </span>
															<span> Notes & Alerts: {{$bs->notes_count_by_user_id(@$customer->id)}} </span>
														</div>
													</div>
												</div>
											</div>
											<div class="text-right"></div>
											<div class="card-footer bg-transparent border-top-dashed pt-8 footer-padding-remove">
												<div class="d-flex align-items-center">
													<div class="flex-grow-1 v-booking">
														<button type="button" class="btn btn-red float-left" onClick="getInfo({{$bs->id}})">Contact Info</button> 
													</div>
													<div class="flex-shrink-0">
														<a href="{{route('personal.dashboard' ,['business_id' => $bs->id,'customer_id' => request()->customer_id ,'type' => request()->type])}}" class="btn btn-red">Select</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									@empty
									@endforelse
								</div>
                            </div>							
						</div>
					</div>
				</div>
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->

<div class="modal fade contact-info" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>  
			<div class="modal-body rev-post-box contact-info-detail"></div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
	
@include('layouts.business.footer')

<script type="text/javascript">
	function  getInfo(company) {
		$.ajax({
			url:'{{route('personal.get-contact-info')}}',
			type:'POST',
			data:{
				_token:'{{csrf_token()}}',
				company:company,
			},
			success:function(response){
				$('.contact-info-detail').html(response);
				$('.contact-info').modal('show');
			},
		});
	}
</script>
@endsection