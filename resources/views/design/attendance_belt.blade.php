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
							<label>Attendance & Belt</label>
						</div>
					</div>
				</div><!--end row-->
				<div class="row">
					<div class="col-xxl-12">
						<div class="card">
							<div class="card-header card-dark">
								<div class="row y-middle">	
									<div class="col-lg-8">
										<div class="attendance-title">
											<h3>Attendance History</h3>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="input-group">
											<input type="text" class="form-control border-0 dash-filter-picker shadow" data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
											<div class="input-group-text bg-primary border-primary text-white">
												<i class="ri-calendar-2-line"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-auto">
										<div class="d-grid attendance-count mt-25">
											<label>Check-Ins</label>
											<span>0</span>
										</div>
									</div>
									<div class="col-sm-auto">
										<div class="d-grid attendance-count mt-25">
											<label>Years</label>
											<span>0</span>
										</div>
									</div>
									<div class="col-sm-auto">
										<div class="d-grid attendance-count mt-25">
											<label>Months</label>
											<span>0</span>
										</div>
									</div>
									<div class="col-sm-auto">
										<div class="d-grid attendance-count mt-25">
											<label>Days</label>
											<span>0</span>
										</div>
									</div>
									<div class="col-sm-auto">
										<div class="d-grid attendance-count mt-25">
											<label>Hours</label>
											<span>0</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- end col -->
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header border-0 align-items-center">
								<div class="row">
									<div class="col-lg-5 col-sm-4">
										<h4 class="card-title mb-0 flex-grow-1">Attendance</h4>
									</div>
									<div class="col-lg-3 col-sm-4">
										<div class="text-right mmb-10">
											<button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
												Day
											</button>
											<button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
												Week
											</button>
											<button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
												Month
											</button>
										</div>
									</div>
									<div class="col-lg-4 col-sm-4">
										<div class="input-group">
											<input type="text" class="form-control border-0 shadow" data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
											<div class="input-group-text bg-primary border-primary text-white">
												<i class="ri-calendar-2-line"></i>
											</div>
										</div>
									</div>
								</div>
								
								
								
							</div><!-- end card header -->

							<div class="card-body p-0 pb-2">
								<div class="w-100">
									<div id="customer_impression_charts" data-colors='["--vz-success", "--vz-primary", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
								</div>
							</div><!-- end card body -->
						</div><!-- end card -->
					</div><!-- end col -->	
					<div class="col-xxl-12">
						<div class="card">	
							<div class="card-header align-items-center d-flex card-dark">
								<h4 class="card-title mb-0 flex-grow-1">Ranks</h4>
							</div>
							<div class="card-body">
								<div class="row y-middle">
									<div class="col-lg-5 col-sm-5 col-12">
										<div>
											<label>Martial Arts Schools</label>
										</div>
									</div>
									<div class="col-lg-5 col-sm-5 col-12">
										<div class="d-flex mmb-10">
											<input type="color" class="form-control form-control-color w-50 mr-10" id="colorPicker" value="#f06548"> 
											<span class="mt-8"> Orange Belt</span>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2 col-12">
										<div class="selected-date">
											<span>12/13/2023</span>
											<label>Promoted</label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div><!-- container-fluid -->
		</div>
	</div><!-- end main content-->
	
</div><!-- END layout-wrapper -->

@include('layouts.business.footer')
@endsection