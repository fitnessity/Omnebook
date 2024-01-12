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
							<label>Promote</label>
						</div>
					</div>
				</div><!--end row-->
				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body">
                                <div class="alert alert-primary shadow" role="alert">                                   
                                    Jane Jones has been selected for promotion. Select a level to confirm
                                </div>       
                                <table id="announcement_list" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th data-ordering="false">Client Name</th>
                                            <th data-ordering="false">Current Level</th>
                                            <th data-ordering="false">Skills Completed </th>
                                            <th data-ordering="false">Promote</th>
                                            <th data-ordering="false">Details </th>
                                        </tr>
                                    </thead>
                                    <tbody>										
                                        <tr>
                                            <td>Nipa Soni</td>
                                            <td>Green Belt</td>
                                            <td>00/00</td>
                                            <td><button type="button" class="btn btn-red">Update</button></td>
                                            <td>
                                                <ul class="list-inline hstack gap-2 mb-0">
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="View" data-bs-original-title="View">
                                                        <a href="#" class="text-red d-inline-block" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                            <i class="ri-eye-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>                                            
                                        </tr>                                  
                                    </tbody>
                                </table>           
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
    <div class="modal-dialog modal-dialog-centered modal-50 modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-xxl-12">
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#Level" role="tab" aria-selected="false">
                                Level
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#Curriculum" role="tab" aria-selected="false">
                                Curriculum 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#Attendance" role="tab" aria-selected="false">
                                Attendance
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#Feedback" role="tab" aria-selected="true">
                                Feedback
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content  text-muted">
                        <div class="tab-pane active" id="Level" role="tabpanel">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Program Name & Category Name</h4>
                                </div>
                                <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table caption-top table-nowrap mb-0" id="sortable-table">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">Current Level</th>
                                                <th scope="col">Show level</th>
                                                <th scope="col">Hours on level</th>
                                                <th scope="col">Date promoted</th>
                                                <th scope="col">Completed Skills </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="sortable-row">
											    <td> Green Belt </td>
											    <td> Orange Belt </td>
											    <td> 5 </td>
											    <td></td>
										        <td>10/50</td>
										    </tr>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="Curriculum" role="tabpanel">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Program Name & Category Name</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="dashed-border fs-15 mb-3">
                                                <label><i class="far fa-check-circle mr-15"></i>Mastered Sparring Techniques #1-21</label>
                                            </div>
                                            <div class="dashed-border fs-15 mb-3">
                                                <label><i class="far fa-check-circle mr-15"></i>Assist with Instructing 15 Beginner Classes</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3 align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Category</h4>
                                            </div><!-- end card header -->

                                            <div class="">
                                                <div class="live-preview">
                                                    <div class="accordion" id="default-accordion-example">
                                                        <div class="accordion-item shadow">
                                                            <h2 class="accordion-header" id="headingOne">
                                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                     Attendance 
                                                                </button>
                                                            </h2>
                                                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
                                                                <div class="accordion-body">
                                                                    <div>
                                                                        <label>Client Can View Progress</label>
                                                                        <div class="">
                                                                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" checked>
                                                                            <label for="vehicle1"> Yes</label><br>
                                                                            <input type="checkbox" id="vehicle2" name="vehicle2" value="Bike">
                                                                            <label for="vehicle2"> No</label><br>
                                                                        </div>
                                                                        <div class="dashed-border mb-3">
                                                                            <label>Attendance Attend 100 Classes</label>
                                                                            <div class="progress bg-soft-primary mb-4">
                                                                                <div class="progress-bar bg-primary-purple bg-gradient" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                        </div>     
                                                                        <div class="dashed-border mb-3">
                                                                            <label>Attendance be at this level for 6 months</label>
                                                                            <div class="progress bg-soft-primary mb-4">
                                                                                <div class="progress-bar bg-primary-purple bg-gradient" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                        </div> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="accordion-item shadow">
                                                            <h2 class="accordion-header" id="headingTwo">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                    Kicks
                                                                </button>
                                                            </h2>
                                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#default-accordion-example">
                                                                <div class="accordion-body">
                                                                    <div>
                                                                        <label>Client Can View Progress</label>
                                                                        <div class="">
                                                                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" checked>
                                                                            <label for="vehicle1"> Yes</label><br>
                                                                            <input type="checkbox" id="vehicle2" name="vehicle2" value="Bike">
                                                                            <label for="vehicle2"> No</label><br>
                                                                        </div>
                                                                        <div class="dashed-border mb-3">
                                                                            <label>Attendance Attend 100 Classes</label>
                                                                            <div class="progress bg-soft-primary mb-4">
                                                                                <div class="progress-bar bg-primary-purple bg-gradient" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                        </div>     
                                                                        <div class="dashed-border mb-3">
                                                                            <label>Attendance be at this level for 6 months</label>
                                                                            <div class="progress bg-soft-primary mb-4">
                                                                                <div class="progress-bar bg-primary-purple bg-gradient" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                        </div> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="accordion-item shadow">
                                                            <h2 class="accordion-header" id="headingThree">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                    Where does it come from ?
                                                                </button>
                                                            </h2>
                                                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#default-accordion-example">
                                                                <div class="accordion-body">
                                                                    Now that you have a general idea of the amount of texts you will need per month, simply find a plan size that allows you to have this allotment, plus some extra for growth. Don't worry, there are no mistakes to be made here. You can always upgrade and downgrade.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-none code-view">
                                        
                                                </div>
                                            </div><!-- end card-body -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="Attendance" role="tabpanel">
                            <h6>Messages</h6>
                        </div>
                        <div class="tab-pane" id="Feedback" role="tabpanel">
                            <h6>Settings</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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