@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')
	
	
	<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<div class="row">
          <div class="col">
            <div class="h-100">
              <div class="row mb-3">
								<div class="col-6">
									<div class="page-heading">
										<label>Settings</label>
									</div>
								</div> <!--end col-->
						  </div>	
							<div class="row">
								<div class="col-12">
									<div class="card">
										<div class="card-body">
											<div class="row">
												<div class="col-12 col-lg-4 col-md-4">
													<div class="reports-title">
														<label>Business Details Settings</label>
													</div>
												</div>
												<div class="col-12 col-lg-6 col-md-8">
													<div class="card card-body box-border">
														<div class="d-grid align-items-center">
															<div class="report-links">
																<a href="#">Company Details</a>
															</div>
															<div class="report-links">
																<a href="#">Company Specifics</a>
															</div>
															<div class="report-links">
																<a href="{{route('business.tax.index')}}">Taxes</a>
															</div>
															<div class="report-links remove-border">
																<a href="#">Blocked Days Off</a>
															</div>
														</div>
													</div>												
												</div>
											</div>
											
											<div class="row">
												<div class="col-12 col-lg-4 col-md-4">
													<div class="reports-title">
														<label>Customer Settings </label>
													</div>
												</div>
												<div class="col-12 col-lg-6 col-md-8">
													<div class="card card-body box-border">
														<div class="d-grid align-items-center">
															<div class="report-links">
																<a href="#">New Customer</a>
															</div>
															<div class="report-links">
																<a href="#">Gender Options</a>
															</div>
															<div class="report-links">
																<a href="#">Allow Pronouns Display</a>
															</div>
															<div class="report-links remove-border">
																<a href="#">Referrals</a>
															</div>
														</div>
													</div>												
												</div>
											</div>
																					
											<div class="row">
												<div class="col-12 col-lg-4 col-md-4">
													<div class="reports-title d-grid">
														<label>Documents</label>
														<span class="fs-14">Terms & Agreements</span>
													</div>
												</div>
												<div class="col-12 col-lg-6 col-md-8">
													<div class="card card-body box-border">
														<div class="d-grid align-items-center">
															<div class="report-links">
																<a href="#">Terms, Conditions, FAQ</a>
																<div class="f-right">
																	<ul class="list-inline hstack gap-2 mb-0">
																		<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Add" data-bs-original-title="Add">
																			<a class="text-primary d-inline-block" data-bs-target="#termsadd" data-bs-toggle="modal">
																				<i class="ri-add-fill fs-18"></i>
																			</a>
																		</li>
																		<li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Edit" data-bs-original-title="Edit">
																			<a data-bs-target="#editterm" data-bs-toggle="modal" class="text-primary d-inline-block edit-item-btn">
																				<i class="ri-pencil-fill fs-16"></i>
																			</a>
																		</li>
																		<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Remove" data-bs-original-title="Remove">
																			<a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteterm">
																				<i class="ri-delete-bin-5-fill fs-16"></i>
																			</a>
																		</li>
																	</ul>
																</div>
																
															</div>
															<div class="report-links">
																<a href="#">Liability Wavier</a>
															</div>
															<div class="report-links">
																<a href="#">Contract Agreement</a>
															</div>
															<div class="report-links">
																<a href="#">Refund Policy</a>
															</div>
															<div class="report-links">
																<a href="#">Cleaning Protocols</a>
															</div>
															<div class="report-links remove-border">
																<a href="#">Product Return Policy</a>
															</div>
														</div>
													</div>												
												</div>
											</div>
											
											
											<div class="row">
												<div class="col-12 col-lg-4 col-md-4">
													<div class="reports-title">
														<label>Subscriptions & Payments</label>
													</div>
												</div>
												<div class="col-12 col-lg-6 col-md-8">
													<div class="card card-body box-border">
														<div class="d-grid align-items-center">
															<div class="report-links">
																<a href="{{route('business.subscription.index')}}">Manage Account</a>
															</div>
															<!-- <div class="report-links">
																<a href="#">Manage Card On File</a>
															</div>
															<div class="report-links remove-border">
																<a href="#">Payment History</a>
															</div> -->
														</div>
													</div>												
												</div>
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div> <!-- end .h-100-->
          </div> <!-- end col -->
        </div>
			</div>
		</div>
	</div>

<!-- Modal -->
<div class="modal fade" id="termsadd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="mb-3">
							<label>Title</label>
							<input type="text" class="form-control" id="category_title" name="category_title" required="">
						</div>
					</div>
					<div class="col-lg-12">
						<label>Description</label>
						<div id="contracttermdiv" style="display:block">
							<textarea name="contracttermstext" id="ckeditor-classic"></textarea>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div> -->
		</div>
	</div>
</div>
	

<!-- Modal -->
<div class="modal fade" id="editterm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="mb-3">
							<label>Title</label>
							<input type="text" class="form-control" id="category_title" name="category_title" required="">
						</div>
					</div>
					<div class="col-lg-12">
						<label>Description</label>
						<div id="contracttermdiv" style="display:block">
							<textarea name="contracttermstext" id="ckeditor-classic2"></textarea>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div> -->
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteterm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="mb-3 text-center">
							<label class="fs-20 ">Are you sure you want to delete ?</label>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div> -->
		</div>
	</div>
</div>
@include('layouts.business.footer')
@include('layouts.business.scripts')
	<script type="text/javascript">
        CKEDITOR.replace("ckeditor-classic");
		CKEDITOR.replace("ckeditor-classic2");
    </script>


@endsection