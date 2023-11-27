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
							<label>Documents & Contracts </label>
						</div>
					</div>
				</div><!--end row-->
				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header align-items-center d-flex">
								<h4 class="card-title mb-0 flex-grow-1">Documents</h4>
							</div><!-- end card header -->
							<div class="card-body">
								<div class="row y-middle">
									<div class="col-lg-4 col-md-4 col-12">
										 <div class="">
											<span>Lorem Ipsum</span>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-10">
										 <div class="">
											<span><i class="fas fa-link"></i> Uploaded on 11/19/2023</span>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-2">
										<div class="multiple-options">
											<div class="setting-icon">
												<i class="ri-more-fill"></i>
												<ul>
													<li><a href=""><i class="fas fa-plus text-muted"></i>Download</a></li>
													<li class="dropdown-divider"></li>
													<li><a href=""><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
												</ul>
											</div>
										</div>
									</div>
									
									<div class="col-lg-4 col-md-4 col-12">
										 <div class="">
											<span>Lorem Ipsum</span>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-10">
										 <div class="">
											<span><i class="fas fa-link"></i> Uploaded on 11/19/2023</span>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-2">
										<div class="multiple-options">
											<div class="setting-icon">
												<i class="ri-more-fill"></i>
												<ul>
													<li><a href=""><i class="fas fa-plus text-muted"></i>Download</a></li>
													<li class="dropdown-divider"></li>
													<li><a href=""><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
												</ul>
											</div>
										</div>
									</div>
									
								</div>
							</div><!-- end card Body -->
						</div>
					</div>
				</div>
										
			</div><!-- container-fluid -->
		</div>
	</div><!-- end main content-->
	
</div><!-- END layout-wrapper -->
	
	
@include('layouts.business.footer')