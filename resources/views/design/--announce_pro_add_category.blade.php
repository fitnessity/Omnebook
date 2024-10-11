@inject('request', 'Illuminate\Http\Request')

@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')
	
		<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<div class="row mb-3">
					<div class="col-12">
						<div class="page-heading">
							<label>Add Announcement Category</label>
						</div>
					</div>
				</div><!--end row-->
				<div class="row">
					<div class="col-xxl-12">
						<div class="card">	
							<div class="card-header align-items-center d-flex">
								<h4 class="card-title mb-0 flex-grow-1">Required Settings</h4>
							</div>
							<div class="card-body">
								<form id="" autocomplete="off" class="needs-validation" novalidate="">
									<div class="row y-middle">
										<div class="col-lg-6">
											<div class="mb-3">
												<label class="form-label">Category Name</label>
												<input type="text" class="form-control"  value="" required="">
											</div>
											<div class="mb-3">
												<button type="submit" class="btn btn-red w-sm">Add</button>
												<button type="submit" class="btn btn-black w-sm">Reset</button>
											</div>
										</div>
									</div>
								</form>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- END layout-wrapper -->
	

@include('layouts.business.footer')

@endsection