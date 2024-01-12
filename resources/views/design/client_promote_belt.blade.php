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
							<label>Manage Client Promotions </label>
						</div>
					</div>
				</div><!--end row-->
				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header align-items-center d-flex">
                                <div class="float-right">
								    <div class="search-set manage-search manage-space">
									    <div class="client-search">
										    <div class="position-relative">
											    <input type="text" class="form-control" placeholder="Search for client" autocomplete="off" id="search-options" value="">
											    <span class="mdi mdi-magnify search-widget-icon"></span>
											    <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
										    </div>
									    </div>
							        </div>
                                </div>
							</div><!-- end card header -->
							<div class="card-body">
								<div class="row">
                                    <div class="col-lg-2 col-xxl-2">
                                        <button type="button" class="btn btn-red mr-5  w-100 mb-25" data-bs-toggle="modal" data-bs-target="#exampleModal">Promote</button>
                                    </div>
                                    <div class="col-lg-3 col-xxl-2">
                                        <button type="button" class="btn btn-red mr-5 w-100 mb-25">Update Progress</button>
                                    </div>
                                    <div class="col-lg-3 col-xxl-2">
                                        <div class="mb-25">
                                            <select class="form-select valid price-info" data-behavior="change_price_title" data-booking-checkin-detail-id="260">
												<option value="" selected="">More Actions</option>
												<option value="775">Option 1</option>
												<option value="812">Option 2</option>
											</select>
										</div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-15">
                                            <label>Clients With Completed Criteria 00</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table id="announcement_list" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 10px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                                    </div>
                                                </th>
                                                <th data-ordering="false">Student Name</th>
                                                <th data-ordering="false">Level</th>
                                                <th data-ordering="false">Date Achieved</th>
                                                <th data-ordering="false">Progress</th>
                                                <th data-ordering="false">Hours At Level</th>
                                            </tr>
                                        </thead>
                                        <tbody>										
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                    </div>
                                                </th>
                                                <td>Nipa Soni</td>
                                                <td><div class="d-flex"><div class="cgreen w-50px mr-5"></div> <span class="lh-24">Green Belt</span></div></td>
                                                <td>11/19/2023</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>        
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                    </div>
                                                </th>
                                                <td>Ankita Patel</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="cyellow w-50px mr-5">
                                                            <div class="inner-belt">                                                                                                    
                                                            </div>
                                                        </div>
                                                        <span class="lh-24">Yellow Belt-1 Stripe</span>
                                                    </div>
                                                </td>
                                                <td>12/5/2022</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>      
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                    </div>
                                                </th>
                                                <td>Purvi Patel</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="cred w-50px mr-5">
                                                        </div>
                                                        <span class="lh-24">Red Belt</span>
                                                    </div>
                                                </td>
                                                <td>12/5/2022</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>                               
                                        </tbody>
                                    </table>
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


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Promote</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-md-center">
                    <div class="col-sm-auto">
                        <a href="http://dev.fitnessity.co/design/manually_promote" class="btn btn-red mr-5 mb-25">Manually Promote</a>
                        <button type="button" class="btn btn-red mr-5 mb-25">Automatically Promote</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.business.footer')
<script>
	new DataTable('#announcement_list', {
		responsive: true
	});
</script>

@endsection