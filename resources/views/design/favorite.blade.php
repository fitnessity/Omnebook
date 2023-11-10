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
							<label>Favorite</label>
						</div>
					</div>
                </div><!--end row-->
				<div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="text-right">
										<button type="button" class="btn btn-red">Activity</button>
									</div>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="d-flex align-items-center text-muted mb-4">
                                            <div class="flex-shrink-0 me-3 position-relative">
                                                <img src="http://dev.fitnessity.co/public/uploads/profile_pic/1680496223-_107093277_gettyyoga.jpg" class="rounded avatar-xl shadow opacity-6" alt="...">
												<div class="ratings-txt"><span>0</span> / 5</div>
                                            </div>

                                            <div class="flex-grow-1">
                                                <h5 class="fs-14">MMA Adult Class </h5>
												<span><i class="fas fa-asterisk"></i> MMA</span>
                                            </div>
											
											<div class="flex-grow-1">
                                                <div class="multiple-options">
													<div class="setting-icon">
														<i class="ri-more-fill"></i>
														<ul>
															<li>
																<a href=""><i class="fas fa-plus text-muted"></i>View Listing</a>
															</li>
															<li>
																<a href=""><i class="ri-delete-bin-fill text-muted"></i>Delete</a>
															</li>
														</ul>
													</div>
												</div>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center text-muted mb-4">
                                            <div class="flex-shrink-0 me-3 position-relative">
                                                <img src="http://dev.fitnessity.co/public/images/service-nofound.jpg" class="rounded avatar-xl shadow opacity-6" alt="...">
												<div class="ratings-txt"><span>4</span> / 5</div>
                                            </div>

                                            <div class="flex-grow-1">
                                                <h5 class="fs-14">Extreme Bungee Jumping  </h5>
												<span><i class="fas fa-asterisk"></i> Bungee Jumping</span>
                                            </div>
											
											<div class="flex-grow-1">
                                                <div class="multiple-options">
													<div class="setting-icon">
														<i class="ri-more-fill"></i>
														<ul>
															<li>
																<a href=""><i class="fas fa-plus text-muted"></i>View Listing</a>
															</li>
															<li>
																<a href=""><i class="ri-delete-bin-fill text-muted"></i>Delete</a>
															</li>
														</ul>
													</div>
												</div>
                                            </div>
                                        </div>

                                       <div class="d-flex align-items-center text-muted mb-4">
                                            <div class="flex-shrink-0 me-3 position-relative">
                                                <img src="http://dev.fitnessity.co/public/uploads/profile_pic/images (3).jfif" class="rounded avatar-xl shadow opacity-6" alt="...">
												<div class="ratings-txt"><span>0</span> / 5</div>
                                            </div>

                                            <div class="flex-grow-1">
                                                <h5 class="fs-14">Beach Volleyball BIRMINGHAM </h5>
												<span><i class="fas fa-asterisk"></i> Beach Vollyball</span>
                                            </div>
											
											<div class="flex-grow-1">
                                                <div class="multiple-options">
													<div class="setting-icon">
														<i class="ri-more-fill"></i>
														<ul>
															<li>
																<a href=""><i class="fas fa-plus text-muted"></i>View Listing</a>
															</li>
															<li>
																<a href=""><i class="ri-delete-bin-fill text-muted"></i>Delete</a>
															</li>
														</ul>
													</div>
												</div>
                                            </div>
                                        </div>
										
										<div class="d-flex align-items-center text-muted mb-4">
                                            <div class="flex-shrink-0 me-3 position-relative">
                                                <img src="http://dev.fitnessity.co/public/images/service-nofound.jpg" class="rounded avatar-xl shadow opacity-6" alt="...">
												<div class="ratings-txt"><span>0</span> / 5</div>
                                            </div>

                                            <div class="flex-grow-1">
                                                <h5 class="fs-14">Summer Camp at Valor </h5>
												<span><i class="fas fa-asterisk"></i> Day Camp</span>
                                            </div>
											
											<div class="flex-grow-1">
                                                <div class="multiple-options">
													<div class="setting-icon">
														<i class="ri-more-fill"></i>
														<ul>
															<li>
																<a href=""><i class="fas fa-plus text-muted"></i>View Listing</a>
															</li>
															<li>
																<a href=""><i class="ri-delete-bin-fill text-muted"></i>Delete</a>
															</li>
														</ul>
													</div>
												</div>
                                            </div>
                                        </div>
										
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->

	
	@include('layouts.business.footer')


@endsection