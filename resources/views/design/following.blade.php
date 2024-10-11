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
							<label>Following</label>
						</div>
					</div>
                </div><!--end row-->
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body pt-0 card-350-body">
								<div class="mini-stats-wid mt-3 scheduler-box">
									<div class="row  d-flex align-items-center">
										<div class="col-lg-1 col-md-2 col-sm-2 col-3">
											<div class="flex-shrink-0 avatar-sm">
												<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">
													AP
												</span>
											</div>
										</div>
										<div class="col-lg-2 col-md-3 col-sm-3 col-5">
											<h6 class="mb-1">Purvi Patel</h6>
										</div>
										<div class="col-lg-3 col-md-2 col-sm-2 col-4">
											<div class="d-grid follow-counter">
												<span>Follower  3</span>
												<span>Following 6</span>
											</div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-6">
											<div class="d-grid text-center mmt-10">
												<label class="mb-0">Member Since</label>
												<span>July 2022</span>
											</div>
										</div>
										<div class="col-lg-3 col-md-2 col-sm-2 col-6">
											<div class="text-right">
												<button type="button" class="btn btn-red">Unfollow</button>
											</div>
										</div>
									</div>
								</div><!-- end -->
										
								<div class="mini-stats-wid mt-3 scheduler-box">
									<div class="row  d-flex align-items-center">
										<div class="col-lg-1 col-md-2 col-sm-2 col-3">
											<div class="flex-shrink-0 avatar-sm">
												<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">
													NP
												</span>
											</div>
										</div>
										<div class="col-lg-2 col-md-3 col-sm-3 col-5">
											<h6 class="mb-1">Nipa Soni</h6>
										</div>
										<div class="col-lg-3 col-md-2 col-sm-2 col-4">
											<div class="d-grid follow-counter">
												<span>Follower  3</span>
												<span>Following 6</span>
											</div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-6">
											<div class="d-grid text-center mmt-10">
												<label class="mb-0">Member Since</label>
												<span>July 2022</span>
											</div>
										</div>
										<div class="col-lg-3 col-md-2 col-sm-2 col-6">
											<div class="text-right">
												<button type="button" class="btn btn-red">Unfollow</button>
											</div>
										</div>
									</div>
								</div><!-- end -->
										
										
							</div><!-- end cardbody -->
						</div><!-- end card -->
					</div><!--end col-->
				</div><!--end row-->
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->

	
	@include('layouts.business.footer')
<script>
	flatpickr('.flatpickr-range',{
		dateFormat: "m/d/Y",
        maxDate: "today",
	});
</script>
	

@endsection