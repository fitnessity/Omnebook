@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')
	<!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
		<div class="page-content">
            <div class="container-fluid">
               <div class="row">
                  <div class="col">
                     <div class="h-100">
                        <div class="row mb-3">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="page-heading">
									<label>Membership Expirations</label>
								</div>
							</div>
							
                            <!--end col-->
						</div>
                        <!--end row-->
						
						<div class="row">
							<div class="col-xl-12">
								<div class="row">
							<div class="col-xxl-12">
								<div class="card">
									<div class="card-header">
										<div class="d-flex align-items-center">
											<h6 class="card-title mb-0 flex-grow-1">Filter</h6>
										</div>
									</div>
									<div class="row g-0">
										<div class="col-lg-6 col-md-6 col-sm-6">
											<div class="card-body">
												<div class="d-flex align-items-center mb-25">
													<div class="avatar-sm flex-shrink-0">
														<span class="avatar-title bg-primary rounded-circle fs-2">
															1
														</span>
													</div>
													<div class="flex-grow-1 ms-3 sale-date">
														<h2 class="mb-0">Choose Dates</h2>
													</div>
												</div>  
												<div class="row d-flex align-items-center">
													<div class="col-lg-3 col-md-4 col-sm-4">
														<label> Start Date </label>
													</div>
													<div class="col-lg-7 col-md-8 col-sm-8">
														<div class="form-group mb-10">	
															<div class="input-group">
																<input type="text" class="form-control border-0 flatpickr-range flatpiker-with-border flatpickr-input active" name="birthdate" id="birthdate" value="1969-12-31" readonly="readonly">
																<div class="input-group-text bg-primary border-primary text-white">
																	<i class="ri-calendar-2-line"></i>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="row d-flex align-items-center">
													<div class="col-lg-3 col-md-4 col-sm-4">
														<label> End Date </label>
													</div>
													<div class="col-lg-7 col-md-8 col-sm-8">
														<div class="form-group mb-25">	
															<div class="input-group">
																<input type="text" class="form-control border-0 flatpickr-range flatpiker-with-border flatpickr-input active" name="birthdate" id="birthdate" value="1969-12-31" readonly="readonly">
																<div class="input-group-text bg-primary border-primary text-white">
																	<i class="ri-calendar-2-line"></i>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="row justify-content-md-center">
													<div class="col-lg-6">
														<button type="button" class="btn btn-black w-100 mb-25">
														   Generate Reports
														</button>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6">
											<div class="card-body border-end-left">
												<div class="d-flex align-items-center mb-25">
													<div class="avatar-sm flex-shrink-0">
														<span class="avatar-title bg-primary rounded-circle fs-2">
															2
														</span>
													</div>
													<div class="flex-grow-1 ms-3 sale-date">
														<h2 class="mb-0">Export Options</h2>
													</div>
												</div> 	
												<div class="row justify-content-md-center">
													<div class="col-lg-6">
														<div class="form-group mb-10">
															<select class="form-select" name="position" required="">
																<option value="print">Print this report</option>
																<option value="export">Export to excel</option>
																<option value="pdf">Export to PDF</option>
																<option value="report">Save this report</option>
															</select>
														</div>
														<button type="button" class="btn btn-black w-100 mb-25">
															Go!
														</button>
													</div>
												</div>
												<!--<div class="row">
													<div class="col-lg-12">
														<div class="options-to-print">
															<ul>
																<li><i class="fas fa-print"></i>Print this report</li>
																<li><i class="fas fa-file-excel"></i>Export to Excel</li>
																<li><i class="fas fa-file-pdf"></i>Export to PDF</li>
																<li><i class="fas fa-save"></i>Save this report</li>
															</ul>
														</div>
													</div>
												</div>-->
											</div>
										</div>
									</div>
								</div>
								<!-- end card -->
							</div><!-- end col -->
						</div>
								<div class="card">
									<div class="card-header align-items-center d-flex">
										<h4 class="card-title mb-0 flex-grow-1">Jul, 2023</h4>
									</div><!-- end card header -->
									<div class="card-body">
									   <!--<div class="total-clients">
											<label>Jul, 2023</label>
										</div>-->
									   <div class="live-preview">
											<div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting">
												<div class="accordion-item shadow">
													<h2 class="accordion-header" id="accordionnestingExample1">
														<button class="accordion-button collapsed uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse1" aria-expanded="false" aria-controls="accor_nestingExamplecollapse1">
															Expiring in 30 days
														</button>
													</h2>
													<div id="accor_nestingExamplecollapse1" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample1" data-bs-parent="#accordionnesting">
														<div class="accordion-body">
															<div class="membership-expirations-table">
																<div class="table-responsive">
																	<table class="table mb-0">
																		<thead>
																			<tr>
																				<th>No</th>
																				<th>Name</th>
																				<th>Membership Type</th>
																				<th>Started on</th>
																				<th>End on</th>
																				<th></th>
																			</tr>
																		</thead>
																		<tbody>
																			<tr>
																				<td>1</td>
																				<td>Alia Abouzeid</td>
																				<td>6 month membership (Recurring)</td>
																				<td>2023-01-17</td>
																				<td>2023-07-17</td>
																				<td>
																					<a href="http://dev.fitnessity.co/business/68/customers/178"> View </a>
																				</td>
																			</tr>
																			<tr>
																				<td>2</td>
																				<td>Albina Glick</td>
																				<td>45 minute</td>
																				<td>2023-06-14</td>
																				<td>2023-07-14</td>
																				<td>
																					<a href="http://dev.fitnessity.co/business/68/customers/178"> View </a>
																				</td>
																			</tr>
																			<tr>
																				<td>3</td>
																				<td>Arya Soni</td>
																				<td>45 minute</td>
																				<td>2023-06-21</td>
																				<td>2023-07-21</td>
																				<td>
																					<a href="http://dev.fitnessity.co/business/68/customers/178"> View </a>
																				</td>
																			</tr>
																			<tr>
																				<td>4</td>
																				<td>gummy texas</td>
																				<td>1 Day Full Camp </td>
																				<td>2023-06-30 </td>
																				<td>2023-07-01 </td>
																				<td>
																					<a href="http://dev.fitnessity.co/business/68/customers/178"> View </a>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="accordion-item shadow">
													<h2 class="accordion-header" id="accordionnestingExample2">
														<button class="accordion-button collapsed uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse2" aria-expanded="false" aria-controls="accor_nestingExamplecollapse2">
															Expiring in 90 days
														</button>
													</h2>
													<div id="accor_nestingExamplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample2" data-bs-parent="#accordionnesting">
														<div class="accordion-body">
															<div class="membership-expirations-table">
																<div class="table-responsive">
																	<table class="table mb-0">
																		<thead>
																			<tr>
																				<th>No</th>
																				<th>Name</th>
																				<th>Membership Type</th>
																				<th>Started on</th>
																				<th>End on</th>
																				<th></th>
																			</tr>
																		</thead>
																		<tbody>
																			<tr>
																				<td>1</td>
																				<td>Ankita Patel</td>
																				<td>45 minute</td>
																				<td> 2023-06-26 </td>
																				<td>2023-07-26 </td>
																				<td>
																					<a href="http://dev.fitnessity.co/business/68/customers/178"> View </a>
																				</td>
																			</tr>
																			<tr>
																				<td>2</td>
																				<td>Arya Soni </td>
																				<td>30 Minutes </td>
																				<td>2023-06-21</td>
																				<td>2023-07-21</td>
																				<td>
																					<a href="http://dev.fitnessity.co/business/68/customers/178"> View </a>
																				</td>
																			</tr>
																			<tr>
																				<td>3</td>
																				<td>Nipa Soni</td>
																				<td>45 minute</td>
																				<td>2023-06-21</td>
																				<td>2023-07-21</td>
																				<td>
																					<a href="http://dev.fitnessity.co/business/68/customers/178"> View </a>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</div>
															</div>								  
														</div>
													</div>
												</div>
												<div class="accordion-item shadow">
													<h2 class="accordion-header" id="accordionnestingExample3">
														<button class="accordion-button collapsed uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse3" aria-expanded="false" aria-controls="accor_nestingExamplecollapse3">
														   All Expired Members 
														</button>
													</h2>
													<div id="accor_nestingExamplecollapse3" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample3" data-bs-parent="#accordionnesting">
														<div class="accordion-body">
															 <div class="membership-expirations-table">
																<div class="table-responsive">
																	<table class="table mb-0">
																		<thead>
																			<tr>
																				<th>No</th>
																				<th>Name</th>
																				<th>Membership Type</th>
																				<th>Started on</th>
																				<th>End on</th>
																				<th></th>
																			</tr>
																		</thead>
																		<tbody>
																			<tr>
																				<td>1</td>
																				<td>Alia Abouzeid</td>
																				<td>6 month membership (Recurring)</td>
																				<td>2023-01-17</td>
																				<td>2023-07-17</td>
																				<td>
																					<a href="http://dev.fitnessity.co/business/68/customers/178"> View </a>
																				</td>
																			</tr>
																			<tr>
																				<td>2</td>
																				<td>Albina Glick</td>
																				<td>45 minute</td>
																				<td>2023-06-14</td>
																				<td>2023-07-14</td>
																				<td>
																					<a href="http://dev.fitnessity.co/business/68/customers/178"> View </a>
																				</td>
																			</tr>
																			<tr>
																				<td>3</td>
																				<td>Arya Soni</td>
																				<td>45 minute</td>
																				<td>2023-06-21</td>
																				<td>2023-07-21</td>
																				<td>
																					<a href="http://dev.fitnessity.co/business/68/customers/178"> View </a>
																				</td>
																			</tr>
																			<tr>
																				<td>4</td>
																				<td>gummy texas</td>
																				<td>1 Day Full Camp </td>
																				<td>2023-06-30 </td>
																				<td>2023-07-01 </td>
																				<td>
																					<a href="http://dev.fitnessity.co/business/68/customers/178"> View </a>
																				</td>
																			</tr>
																			<tr>
																				<td>5</td>
																				<td>Ankita Patel</td>
																				<td>45 minute</td>
																				<td> 2023-06-26 </td>
																				<td>2023-07-26 </td>
																				<td>
																					<a href="http://dev.fitnessity.co/business/68/customers/178"> View </a>
																				</td>
																			</tr>
																			<tr>
																				<td>6</td>
																				<td>Arya Soni </td>
																				<td>30 Minutes </td>
																				<td>2023-06-21</td>
																				<td>2023-07-21</td>
																				<td>
																					<a href="http://dev.fitnessity.co/business/68/customers/178"> View </a>
																				</td>
																			</tr>
																			<tr>
																				<td>7</td>
																				<td>Nipa Soni</td>
																				<td>45 minute</td>
																				<td>2023-06-21</td>
																				<td>2023-07-21</td>
																				<td>
																					<a href="http://dev.fitnessity.co/business/68/customers/178"> View </a>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div><!-- end card-body -->
								</div><!-- end card -->
							</div><!--end col-->
						</div><!--end row-->						
					</div> <!-- end .h-100-->
                  </div> <!-- end col -->
                </div>
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->
    
@include('layouts.business.footer')
	
@endsection