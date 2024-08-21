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
							<label>Add Announcement</label>
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
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Title</label>
												<input type="text" class="form-control" required="">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group mb-3">
												<label class="form-label">Short Description</label>
												<textarea class="form-control" id="" placeholder="Enter your description" rows="3"></textarea>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group mb-3">
												<label class="form-label">Category</label>
												<select name="relationship[0]" id="relationship[0]" class="form-select" required="required">
													<option value="" selected="">Select Category</option>
													<option value="">Option 1</option>
													<option value="">Option 2</option>
													<option value="">Option 3</option>
													<option value="">Option 4</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-12">
											<div class="form-group mb-3">
												<label class="form-label">Start Date</label>
												<input type="text" class="form-control flatpickr" data-provider="flatpickr" id="JoiningdatInput" data-date-format="d M, Y" data-deafult-date="24 Nov, 2021" placeholder="Select date" />
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-12">
											<div class="form-group mb-3">
												<label class="form-label">Start Time</label>
												<input type="text" class="form-control" id="" value="">
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-6 col-12">
											<div class="form-group mb-3">
												<label class="form-label">End Date</label>
												<input type="text" class="form-control end-flatpickr" data-provider="flatpickr" id="JoiningdatInput" data-date-format="d M, Y" data-deafult-date="24 Nov, 2021" placeholder="Select date" />
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-12">
											<div class="form-group mb-3">
												<label class="form-label">End Time</label>
												<input type="text" class="form-control" id="" value="">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-10">
												<label class="form-label">Announcement</label>
												<textarea class="form-control" id="" placeholder="Enter your description" rows="5"></textarea>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="hstack gap-2 justify-content-end">
												<button type="submit" class="btn btn-red w-sm">Submit</button>
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
<script>
	flatpickr(".flatpickr", {
		dateFormat: "m/d/Y",
		maxDate: "01/01/2050",
		defaultDate: [new Date()],
	});
	
	flatpickr(".end-flatpickr", {
		dateFormat: "m/d/Y",
		maxDate: "01/01/2050",
		defaultDate: [new Date()],
	});
			 
</script>
@endsection