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
							<div class="col-6">
								<div class="page-heading">
									<label>Manage Company </label>
								</div>
							</div>
							<div class="col-6">
								<div class="mt-10 float-right">
									<a href="#" class="btn btn-red" name="btnedit" id="btnedit" value="Edit">Create Company</a>
								</div>
							</div>
                            <!--end col-->
						</div>
                        <!--end row-->
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body pt-0 card-350-body ">
										<h6 class="text-uppercase fw-semibold mt-4 mb-3 text-muted"></h6>
										<div class="nw-user-detail-block  nw-user-detail">
											<div class="row">
												<div class="col-lg-1 col-md-2 col-sm-2 col-3">
													<div class="company-list-text mb-10">
														<p class="character">A</p>
													</div>
												</div>
												<div class="col-lg-10 col-md-8 col-sm-8 col-7">
													<p class="texttr">Arya Company</p>
													<p class="texttr">Nipa Soni</p>
												</div>
												<div class="col-lg-1 col-md-2 col-sm-2 col-2">
													<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".activity-scheduler "><i class="ri-more-fill"></i></a>
												<div class="modal fade activity-scheduler" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered modal-70">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="myModalLabel">Manage Company </h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																</div>
																<div class="modal-body">
																	<div class="row">
																		<div class="col-lg-6 col-md-12 col-sm-12">
																			<div class="manage-txt mb-10">
																				<label class="mmt-10">OVERVIEW</label>
																				<span>1 PERSONAL TRAINER SERVICES | 0 BOOKINGS THIS WEEK | 0 PROGRAM EXPIRING SOON </span>
																				<span>0 GYM / STUDIO SERVICES  | 0 BOOKINGS THIS WEEK | 5 PROGRAM EXPIRING SOON </span>
																				<span>0 EXPERIEINCE SERVICES | 0 BOOKINGS THIS WEEK | 1 PROGRAM EXPIRING SOON </span>
																				<span>0 EVENTS SERVICES | 0 BOOKINGS THIS WEEK | 1 PROGRAM EXPIRING SOON </span>
																			</div>
																		</div>
																		<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
																			<div class="btn-inline">
																				<input type="submit" class="btn btn-red mb-10 width-100 mwidth-50" name="btnedit" id="btnedit" value="Edit Business Info">
																				<input type="submit" class="btn btn-black mb-10 width-100 mwidth-50" name="btncreateservice" id="btncreateservice" value="Create A New Service">
																				<input type="submit" class="btn btn-red mb-10 width-100 mwidth-30" name="btnview" id="btnview" value="View Business Profile">
																			</div>
																		</div>
																		<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
																			<div class="btn-inline">
																				<input type="submit" class="btn btn-black mb-10 width-100 mwidth-30" name="btnmanageservice" id="btnmanageservice" value="Manage Service">
																				<input type="button" class="btn btn-red mb-10 width-100 mwidth-30" id="changestatus_437" value="ACTIVATE" data-cid="437" onclick="statuschange(this.getAttribute('data-cid'));">
																				<input type="button" class="btn btn-black mb-10 width-100 mwidth-30" value="Delete"  >
																			</div>
																		</div>
																	</div>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-primary btn-red">Submit</button>
																</div>
															</div><!-- /.modal-content -->
														</div><!-- /.modal-dialog -->
													</div><!-- /.modal -->
												</div>
											</div>	
										</div>										
									</div><!-- end cardbody -->
								</div><!-- end card -->
								<div class="card">
									<div class="card-body pt-0 card-350-body ">
										<h6 class="text-uppercase fw-semibold mt-4 mb-3 text-muted"></h6>
										<div class="nw-user-detail-block  nw-user-detail">
											<div class="row">
												<div class="col-lg-1 col-md-2 col-sm-2 col-3">
													<img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1670847631-gettyimages-820294498-612x612.jpg" alt="" class="avatar-1">
												</div>
												<div class="col-lg-10 col-md-8 col-sm-8 col-7">
													<p class="texttr">Nipa Soni</p>
												</div>
												<div class="col-lg-1 col-md-2 col-sm-2 col-2">
													<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".activity-scheduler "><i class="ri-more-fill"></i></a>
												</div>
											</div>	
										</div>										
									</div><!-- end cardbody -->
								</div><!-- end card -->
								<div class="card">
									<div class="card-body pt-0 card-350-body ">
										<h6 class="text-uppercase fw-semibold mt-4 mb-3 text-muted"></h6>
										<div class="nw-user-detail-block  nw-user-detail">
											<div class="row">
												<div class="col-lg-1 col-md-2 col-sm-2 col-3">
													<img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1683350278-discover.jpg" alt="" class="avatar-1">
												</div>
												<div class="col-lg-10 col-md-8 col-sm-8 col-7">
													<p class="texttr">Arya pvt lmt</p>
													<p class="texttr">Arya soni</p>
												</div>
												<div class="col-lg-1 col-md-2 col-sm-2 col-2">
													<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".activity-scheduler "><i class="ri-more-fill"></i></a>
												</div>
											</div>	
										</div>										
									</div><!-- end cardbody -->
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
	<script>
		flatpickr(".flatpickr-range", {
	        dateFormat: "m/d/Y",
	        maxDate: "01/01/2050",
			defaultDate: [new Date()],
	     });
	</script>

@endsection