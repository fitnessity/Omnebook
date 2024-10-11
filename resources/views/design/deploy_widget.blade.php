@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')
@include('layouts.profile.business_topbar')

<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<div class="row mb-3 pb-1">
					<div class="col-12">
						<div class="d-flex align-items-lg-center flex-lg-row flex-column">
							<div class="flex-grow-1">
								<h4 class="fs-17 mb-1">Deploy Your Widget</h4>
							</div>
						</div>
					</div>
				</div>
                <div class="row">
                    <div class="col-12">
                        <div class="plug-in">
                            <label>Use a plugin</label>
                            <p>This will help you drop your widget right onto your Facebook page.</p>
                        </div>
                    </div>
                </div>
				<div class="row">
					<div class="col-xl-3 col-md-6">
						<!-- card -->
						<div class="card card-animate">
							<div class="card-body">
                                <div class="deploy-connect text-center">
                                    <i class="fab fa-facebook"></i>
                                    <h3>Go to Facebook</h3>
                                </div>
							</div><!-- end card body -->
						</div><!-- end card -->
					</div><!-- end col -->
				</div>

                <div class="row">
                    <div class="col-12">
                        <div class="garb-plug-in">
                            <label class="fs-17 mb-1">Grab the code</label>
                            <p>Put your widget anywhere on your site. All you have to do is copy and paste the code where you want it to appear.</p>
                            <h3 class="fs-15">Do you need help putting the widget code on your site?</h3>
                            <p>Here's a step-by-step guide on how to put the code on your wordpress site.</p>
                        </div>
                    </div>
                </div>

				<div class="row">
					<div class="col-lg-12">
						<div class="card">
                            <div class="card-body">
                               <div class="copy-code">
                                    <textarea class="form-control" placeholder="<script src=http://dev.fitnessity.co//public/dashboard-design/js/jquery-3.6.4.min.js></script><script src=https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCr7-ilmvSu8SzRjUfKJVbvaQZYiuntduw async defer></script> <script async src=https://www.googletagmanager.com/gtag/js?id=G-KQRG55N3Q1></script>" id="des-info-description-input" rows="4" required=""></textarea>
                                    <button class="btn btn-red mt-15">Copy</button>
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

@endsection