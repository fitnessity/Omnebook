@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')
@include('layouts.profile.business_topbar')
	
	<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<div class="row mb-3">
					<div class="col-12">
						<div class="page-heading">
							<label>Announcement & News</label>
						</div>
					</div>
				</div><!--end row-->
				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="row">
								<div class="col-lg-12">
									<div class="position-relative ">
										<div class="header-img-announcement">
											<img src="{{url('/dashboard-design/images/announcement.jpg')}}" alt="" class="" />
										</div>
										<div class="announcement-text-format">
											<div class="announcement-banner">
												<label>Announcements</label>
											</div>
											<div class="top-area-announcement">
												<div class="top-search-announcement">
													<form method="get" action="/activities/">
														<input type="text" name="label" id="" placeholder="Search articles" autocomplete="off" value="">
															<button id="serchbtn"><i class="fa fa-search"></i></button>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="">
										<div class="card-body">
											<div class="row">
												<div class="col-lg-3 col-md-3 col-12">
													<div class="text-right">
													<input type="text" class="form-control flatpickr" data-provider="flatpickr" id="JoiningdatInput" data-date-format="d M, Y" data-deafult-date="24 Nov, 2021" placeholder="Select date" />
													</div>
												</div>
											</div>
											<!-- Nav tabs -->
											<ul class="nav nav-tabs mb-3 mt-3" role="tablist">
												<li class="nav-item">
													<a class="nav-link active" data-bs-toggle="tab" href="#All" role="tab" aria-selected="false">
														All 
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-bs-toggle="tab" href="#News" role="tab" aria-selected="false">
														News
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-bs-toggle="tab" href="#Activities" role="tab" aria-selected="false">
														Activities
													</a>
												</li>
											</ul>
											<!-- Tab panes -->
											<div class="tab-content text-muted">
												<div class="tab-pane active" id="All" role="tabpanel">
													<div class="mb-10">
														<div class="row y-middle">
															<div class="col-lg-1 col-md-2 col-3">
																<div class="announcement-day">
																	<span>Today</span>
																	<span>03:00</span>
																</div>
															</div>
															<div class="col-lg-10 col-md-10 col-9 border-left">
																<div class="announcement-heading">
																	<h5>Welcome to the Era of zero !</h5>
																	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="text-right">
																	<button class="btn btn-red btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-eye-fill fs-14"></i></button>
																</div>
															</div>
														</div>
													</div>
													
													<div class="mb-10">
														<div class="row y-middle">
															<div class="col-lg-1 col-md-2 col-3">
																<div class="announcement-day">
																	<span>Jun 03</span>
																	<span>2020</span>
																</div>
															</div>
															<div class="col-lg-10 col-md-10 col-9 border-left">
																<div class="announcement-heading">
																	<h5>The Era of Zero is Coming!</h5>
																	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="text-right">
																	<button class="btn btn-red btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-eye-fill fs-14"></i></button>
																</div>
															</div>
														</div>
													</div>
													
													<div class="mb-10">
														<div class="row y-middle">
															<div class="col-lg-1 col-md-2 col-3">
																<div class="announcement-day">
																	<span>Jun 02</span>
																	<span>2020</span>
																</div>
															</div>
															<div class="col-lg-10 col-md-10 col-9 border-left">
																<div class="announcement-heading">
																	<h5>Trading Ethereum Derivatives</h5>
																	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="text-right">
																	<button class="btn btn-red btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-eye-fill fs-14"></i></button>
																</div>
															</div>
														</div>
													</div>
													
													<div class="mb-10">
														<div class="row y-middle">
															<div class="col-lg-1 col-md-2 col-3">
																<div class="announcement-day">
																	<span>Jun 01</span>
																	<span>2020</span>
																</div>
															</div>
															<div class="col-lg-10 col-md-10 col-9 border-left">
																<div class="announcement-heading">
																	<h5>How do I Add Margin to a Position ?</h5>
																	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="text-right">
																	<button class="btn btn-red btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-eye-fill fs-14"></i></button>
																</div>
															</div>
														</div>
													</div>
													
												</div>
												<div class="tab-pane" id="News" role="tabpanel">
													
												</div>
												<div class="tab-pane" id="Activities" role="tabpanel">
													
												</div>
											</div>
										</div><!-- end card-body -->
									</div><!-- end card -->
								</div>
							</div>
							<div class="card-body">
								
							</div><!-- end card Body -->
						</div>
					</div>
				</div>
								
			</div><!-- container-fluid -->
		</div>
	</div><!-- end main content-->
	
</div><!-- END layout-wrapper -->
	
	
@include('layouts.business.footer')

<script>
	flatpickr(".flatpickr", {
		dateFormat: "m/d/Y",
		maxDate: "01/01/2050",
		defaultDate: [new Date()],
	});			 
</script>
@endsection