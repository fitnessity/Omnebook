@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.business.new-header')
	
	<div class="page-content-two">
		<div class="container">
			<div class="row mb-3">
				<div class="col-12">
					<div class="card-body">
						<div class="row y-middle">
							<div class="col-5">
								<div class="text-center welcome-text mb-35">
									<label>Welcome to</label>
									<div class="welcome-logo mb-15">
										<img src="{{url('dashboard-design/images/fitnessity-for-business.png')}}">
									</div>
								</div>
								<div class="onboared text-center">
									<h3>It's easy to get started on Fitnessity</h3>
								</div>
							</div>
							<div class="col-7">
								<div class="row y-middle">
									<div class="col-8">
										<div class="onboared-steps mb-15">
											<label>1 Tell us about your business</label>
										</div>
									</div>
									<div class="col-4">
										<div class="onboard-img mb-15">
											<img src="{{url('dashboard-design/images/onboard-1.png')}}" alt="">
										</div>
									</div>
								</div>
								
								<div class="dropdown-divider mb-15"> </div>
								<div class="row y-middle">
									<div class="col-8">
										<div class="onboared-steps">
											<label>2 Tell us about you</label>
										</div>
									</div>
									<div class="col-4">
										<div class="onboard-img mb-15">
											<img src="{{url('dashboard-design/images/onboard-2.png')}}" alt="">
										</div>
									</div>
								</div>
											
								<div class="dropdown-divider mb-15"> </div>
								<div class="row y-middle">
									<div class="col-8">
										<div class="onboared-steps">
											<label>3 Tell us where to send your money</label>
										</div>
									</div>
									<div class="col-4">
										<div class="onboard-img mb-15">
											<img src="{{url('dashboard-design/images/onboard-3.png')}}" alt="">
										</div>
									</div>
								</div>
								
								<div class="dropdown-divider mb-15"> </div>
								<div class="row y-middle">
									<div class="col-8">
										<div class="onboared-steps">
											<label>4 Choose your membership option</label>
										</div>
									</div>
									<div class="col-4">
										<div class="onboard-img mb-15">
											<img src="{{url('dashboard-design/images/onboard-4.png')}}" alt="">
										</div>
									</div>
								</div>
											
							</div>
						</div>
					</div>
				</div>
			</div> <!-- end row-->
		</div><!-- container -->
		<div class="dropdown-divider mb-15"> </div>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="text-right">
						<a href="{{route('onboard_process.index' ,['cid' => $cid])}}" class="btn btn-red">Get Started</a>
					</div> 
				</div>
			</div>
		</div>
	</div><!-- End Page-content -->
</div><!-- END layout-wrapper -->
	
	
	
	
@include('layouts.business.footer')
@endsection